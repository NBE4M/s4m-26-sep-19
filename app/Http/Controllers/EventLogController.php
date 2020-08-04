<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Log;
use App\Article;
use Request;
use Carbon\Carbon;
use App\AuthorType;
use Session;
use Storage;
use Artisan;
use Config;
use Mail;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\AuthController;


class EventLogController extends Controller {
 
    public function index(){

        $notification = DB::table('events_logs')->select()->orderBy('event_id', 'desc')->join('users','events_logs.userid','=','users.id')->limit(4);

        return view('layouts.master', compact('notification'));

    }


     public function publishScheduledArticle() {

        $articles = DB::table('articles')->join('photos', 'articles.article_id', '=', 'photos.owner_id')
        ->select(DB::raw('photos.photopath,articles.article_id,articles.title,articles.url,summary,HOUR(articles.publish_time) as hour'))
        ->where('articles.status', '=', 'SD')
        ->whereDate('articles.publish_date', '=', Carbon::now()->toDateString())
        ->groupBy('hour')
        ->get();
        
        foreach ($articles as $article) {
          if (date('H')==$article->hour) {
           $updatearticle = Article::find($article->article_id);
            $updatearticle->status = 'P';
            $updatearticle->update();
            $this->sendmail($article->title,$article->article_id,$article->url,$article->summary,$article->photopath);
                

          }
            
        }
        $exitCode = Artisan::call('cache:clear');
        return 'success';
    }

    public function priview($id){

           $articles = Article::join('category','articles.category_id','=','category.category_id')->join('photos','articles.article_id','=','photos.owner_id')->select('category.name as cname','articles.article_id','photos.photopath','articles.title','articles.summary','articles.description')->where([['articles.status','N'],['articles.article_id',$id]])->get();
           
           if( count( $articles ) == 0)
                {
                return view('errors.404');
                }
            $article= $articles[0];

            return view('preview', compact('article'));
        }


    public function sendmail($title,$id,$url,$summary,$photopath){
      $article = new ArticlesController;
      $mail = Storage::get('public/mailDetails.txt');
        $mails = preg_split('/\s+/', $mail);
        foreach($mails as $key => $value){
            $exp[] = explode("=", $value, 2);   
            }
          $to = $exp[0][1];

          $cc = explode(',',$exp[1][1]);
      Mail::send('emails.publish_email', ['name' =>'Admin','url'=>$url,'title'=>$title,'summary'=>$summary,'photopath'=>$photopath], function ($message) use ($title,$to,$cc) {
     $message->to($to)->cc($cc)->subject('S4M News Alert - '.$title);
      });
      $key = md5(date('dmY') . 'samachar4media');
      $url1= config('constants.SiteBaseurl').'rss/article/'. $id.'?key='. $key;
      $url2=  config('constants.SiteBaseurl').'rss/sitemap-date/'.date('Y-m-d').'?key='. $key;
      $url3=config('constants.SiteBaseurl').'rss/all-sitemap.xml?key='. $key;
      $data1 = array($url1,$url2,$url3);
      $r = $article->multiRequest($data1);
      $exitCode = Artisan::call('cache:clear');
        }
  public function sendmailtopr($title,$id,$url,$to,$name,$summary,$photopath){
    $mail = Storage::get('public/mailDetails.txt');
        $mails = preg_split('/\s+/', $mail);
        foreach($mails as $key => $value){
            $exp[] = explode("=", $value, 2);   
            }
          $to = $exp[0][1];

          $cc = explode(',',$exp[1][1]);
            Mail::send('emails.publish_emailtopr', ['name' =>$name,'title' =>$title,'url'=>$url,'summary'=>$summary,'photopath'=>$photopath], function ($message) use ($title,$to) {
            $message->to($to)->subject('We have got you featured !!! - '.$title);
            });
        }


   public function eventstore($request){

       Log::create([
           'event_date' => date('Y-m-d H:i:s'),
           'event_time' => date('H:i:s'),
           'event_type' => $request['event_type'],
           'userid' => $request['userid'],
           'description' => $request['description'],
           'article_id' => $request['article_id'],
           'flag'=>'1',
       ]);
   }

   public function show(){
       $date = date("Y-m-d", strtotime("-1 week"));
       $uid = Session::get('users')->id;
      if ($uid==1) {
       $log_event = DB::table('events_logs')->select()->where('events_logs.event_date','>',$date)->orderBy('event_id', 'desc')->join('users','events_logs.userid','=','users.id');
      }else{
        $log_event = DB::table('events_logs')->select()->where('events_logs.event_date','>',$date)->where('events_logs.userid','!=',1)->orderBy('event_id', 'desc')->join('users','events_logs.userid','=','users.id');
      }

       if (isset($_GET['searchin'])) {
           if ($_GET['searchin'] == 'name') {
               $log_event->where('users.name', 'like', '%' . $_GET['keyword'] . '%')->get();
           }
           if (@$_GET['searchin'] == 'article_id') {
               $log_event->where('events_logs.article_id', $_GET['keyword'])->get();
           }
       }
       $log_activity = $log_event->paginate(config('constants.recordperpage'));

       return view('layouts.logActivities', compact('log_activity'));

   }

   /*repoprt*/
       public function reporteditor(Request $request) {
       $uid = Session::get('users')->id;
        $postAs = DB::table('author_type')->select('*')->whereNotIn('author_type_id', [1,4,6])->get();
       $user = DB::table('users')->select('*')->where('id','!=',1)->get();
       $log_event = DB::table('articles')->select()->where('user_id','==',1)->orderBy('article_id', 'desc');
       $log_activity = $log_event->paginate(config('constants.recordperpage'));
       return view('layouts.reporteditor', compact('log_activity','user','postAs'));

   }
    
public function reporteditorsearch(Request $request)
{
if($request)
{
 $uid = $_GET['search'];
 $output="";
 if ($_GET['type']=='user_type') {
  $products = DB::table('authors')->select('*')->where('author_type_id','=',$uid)->get();
  foreach ($products as $key => $product) {
     $output.='<option value='.$product->author_id.'>'.$product->name.'</option>';
}
 }else{
  //DB::enableQueryLog();
  if(isset($_GET['enddate'])) {
  $products=DB::table('articles')->join('article_author','articles.article_id','=','article_author.article_id')->join('authors','article_author.author_id','=','authors.author_id')->join('article_category','articles.article_id','=','article_category.article_id')->join('category','article_category.category_id','=','category.category_id')->select('category.name as cname','authors.name','articles.article_id','articles.title','articles.publish_date')->where('authors.author_id','=',$uid)->where('articles.status','=','p')->where('articles.publish_date','>=',$_GET['sdate'])
            ->where('articles.publish_date','<=',$_GET['enddate'])->orderBy('articles.article_id','desc')->get();
           /* dd(
            DB::getQueryLog()
        );*/
            //print_r($products);
    
  }else{
     $products=DB::table('articles')->join('article_author','articles.article_id','=','article_author.article_id')->join('authors','article_author.author_id','=','authors.author_id')->join('article_category','articles.article_id','=','article_category.article_id')->join('category','article_category.category_id','=','category.category_id')->select('category.name as cname','authors.name','articles.article_id','articles.title','articles.publish_date')->where('article_author.author_id','=',$uid)->where('articles.status','=','p')->orderBy('articles.article_id','desc')->get();
  }
//dd(DB::getQueryLog());
if($products)
{
   
foreach ($products as $key => $product) {
  $social_cat = $product->cname;
                $social_cat = strtolower($social_cat);
                $social_cat = preg_replace("/[^a-z0-9_\s-]/", "", $social_cat);
                $social_cat = preg_replace("/[\s-]+/", " ", $social_cat);
                $social_cat = preg_replace("/[\s_]/", "-", $social_cat);
                $social_title = $product->title;
                $social_title = strtolower($social_title);
                $social_title = preg_replace("/[^a-z0-9_\s-]/", "", $social_title);
                $social_title = preg_replace("/[\s-]+/", " ", $social_title);
                $social_title = preg_replace("/[\s_]/", "-", $social_title);
                $social_article_id = $product->article_id;
               //$source = Config::get('constants.SiteBaseurl');
               //$social_url =  $source .$social_cat.'/'.$social_title.'_'.$social_article_id.'.html';
                $social_url = config('constants.SiteBaseurl').'/'.$social_cat.'/'.$social_title.'_'.$social_article_id.'.html';
$output.='<tr>'.
'<td>'.$product->article_id.'</td>'.
'<td>'.$product->title.'</td>'.
'<td>'.$product->name.'</td>'.
'<td>'.$product->publish_date.'</td>'.
'<td>'.$social_url.'</td>'.
'</tr>';
}
}else{
	$output = 'No data Found';
}
   }
   return Response($output);
 }
}
}
