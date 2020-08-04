<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
use App\Article;
use Artisan;
use Mail;
use Illuminate\Support\Facades\Storage;
use Session;
use Config;
use App\Http\Controllers\Auth;


class ScheduleArticle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:article';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedular Article';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $articles = DB::table('articles')->join('photos', 'articles.article_id', '=', 'photos.owner_id')->join('users','articles.user_id','=','users.id')->join('category','articles.category_id','=','category.category_id')
        ->select(DB::raw('photos.photopath,articles.article_id,articles.title,articles.url,summary,HOUR(articles.publish_time) as hour,users.name as username,category.e_name as catname'))
        ->where('articles.status', '=', 'SD')
        ->whereDate('articles.publish_date', '=', Carbon::now()->toDateString())
        ->groupBy('hour')
        ->get();
        
        foreach ($articles as $article) {
          if (date('H')==$article->hour) {
           $updatearticle = Article::find($article->article_id);
            $updatearticle->url = config('constants.SiteBaseurl').$article->catname.'-news/'.str_slug($article->url).'-'.$article->article_id.'.html';
            $updatearticle->status = 'P';
            $updatearticle->update();
            $url = config('constants.SiteBaseurl').$article->catname.'-news/'.str_slug($article->url).'-'.$article->article_id.'.html';
            $this->sendmail($article->title,$article->article_id,$url,$article->summary,$article->photopath,$article->username);
          }            
        }
       $this->forget();
        return 'success';
    }

    public function sendmail($title,$id,$url,$summary,$photopath,$username){
        $mail = Storage::get('public/mailDetails.txt');
        $mails = preg_split('/\s+/', $mail);
        foreach($mails as $key => $value){
            $exp[] = explode("=", $value, 2);   
            }
          $to = $exp[0][1];
          $cc = explode(',',$exp[1][1]);
          Mail::send('emails.publish_email', ['name' =>$username,'url'=>$url,'title'=>$title,'summary'=>$summary,'photopath'=>$photopath], function ($message) use ($title,$to,$cc) {
            $message->to($to)->cc($cc)->subject('S4M News Alert - '.$title);
            });
        }
    public function forget() {
        $url= config('constants.SiteBaseurl').'/cache/clear';
        $data = array($url);
        $this->multiRequest($data);
    }
}
