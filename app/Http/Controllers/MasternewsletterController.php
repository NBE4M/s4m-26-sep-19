<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Photo;
use App\Log;
use App\Video;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\PhotosController;
use App\Http\Requests;
use App\Http\Controllers\EventLogController;
use App\Right;
use App\Newsletter;
use App\NewsletterArticles;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Aws\Laravel\AwsFacade as AWS;
use Aws\Laravel\AwsServiceProvider;
use Helper;

class MasternewsletterController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    private $rightObj;

    public function __construct() {
        $this->middleware('auth');
        $this->rightObj = new Right();
    }

    public function index() {
      
        if (!Session::has('users')) {
            return redirect()->intended('/auth/login');
        }
        $rightId = 83;
        /* Right mgmt start */
        // $currentChannelId = $this->rightObj->getCurrnetChannelId($rightId);
        // $channels = $this->rightObj->getAllowedChannels($rightId);
        if (!$this->rightObj->checkRights($rightId))
            return redirect('/dashboard');
        /* Right mgmt end */

        $newsletters = DB::table('master_newsletter')->where('is_deleted', '0')->orderBy('created_at', 'DESC')->paginate(config('constants.recordperpage'));
        return view('maternewsletter.list', compact('newsletters'));
    }

    /**
     * Show the form for creating a new resource. - FB Interface
     *
     * @return Response
     */
    public function create() {
        if (!Session::has('users')) {
            return redirect()->intended('/auth/login');
        }
        $uid = Session::get('users')->id;
        /* Right mgmt start */
        $rightId = 84;
        // $currentChannelId = $this->rightObj->getCurrnetChannelId($rightId);
        $channels = $this->rightObj->getAllowedChannels($rightId);
        if (!$this->rightObj->checkRights($rightId))
            return redirect('/dashboard');
        /* Right mgmt end */
         
        return view('maternewsletter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {

        if (!Session::has('users')) {
            return redirect()->intended('/auth/login');
        }
         $user = Session::get('users');
        $uid = $user->id;
        /* Right mgmt start */
        $rightId = 84;
        // $currentChannelId = $request->channel_sel;
        if (!$this->rightObj->checkRights($rightId))
            return redirect('/dashboard');
        /* Right mgmt end */
        // $allowedChannels = $this->rightObj->getAllowedChannels($rightId);
        // if (!trim($request->title)) {
        //     $channel = DB::table('channels')->select('channel')->where('channel_id', $currentChannelId)->first();
        //     $title = $channel->channel . date('-Y-M-d');
        // } else {
        //     $title = $request->title;
        // }

        $title = $request->title;
        $newsletter = new Newsletter();
        // $newsletter->channel_id = $request->channel_sel;
        $newsletter->title = $title;
        $newsletter->save();
        Session::flash('message', 'Your Newsletter has been added successfully.');
        return redirect('cms/newsletter');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        // echo $_GET['margin']; exit;
       
        if (!Session::has('users')) {
            return redirect()->intended('/auth/login');
        }
        $uid = Session::get('users')->id;
        $newsletter = Newsletter::find($id);

        /* Right mgmt start */
        $rightId = 83;
        // $currentChannelId = $newsletter->channel_id;
        // $channels = $this->rightObj->getAllowedChannels($rightId);
        if (!$this->rightObj->checkRights($rightId))
            return redirect('/dashboard');
        
         $margin=1;
        if(isset($_GET['margin'])){
            $margin=$_GET['margin'];
        }
        // $margin=30;
        
        /* Right mgmt end */
      
        $latestArticles = DB::table('articles')
                        ->Leftjoin('authors', 'articles.author_id', '=', 'authors.author_id')
                        ->JOIN('category', 'category.category_id', '=', 'articles.category_id')
						
                        ->select(DB::raw('articles.article_id,articles.title,articles.article_id,articles.publish_date,articles.publish_time,group_concat(authors.name) as name'))
                        ->where('status', 'P')
                        // ->where('articles.channel_id',$currentChannelId)
						
						// ->whereNotIn('category.category_id', [35])
                        ->whereRaw("concat(publish_date,' ',publish_time)>= now() - INTERVAL ? DAY",[$margin])
                        ->whereRaw("articles.article_id not in (select article_id from master_newsletter_articles where master_newsletter_id=$id and is_deleted=0)")
                        ->groupBy('articles.article_id')
			->orderBy('articles.publish_date','DESC')
			->orderBy('articles.publish_time','DESC')->get();	

 // DB::enableQueryLog();

        $assignedArticles = DB::table('articles')
                ->join('master_newsletter_articles', 'articles.article_id', '=', 'master_newsletter_articles.article_id')
                ->Leftjoin('authors', 'articles.author_id', '=', 'authors.author_id')
				
                ->select(DB::raw('master_newsletter_articles.id as asigned_id,articles.article_id,articles.title,articles.article_id,articles.publish_date,articles.publish_time,
                    group_concat(authors.name) as name'))
                ->where('master_newsletter_articles.master_newsletter_id', $id)
                ->where('master_newsletter_articles.is_deleted', '0')
                ->where('articles.status', 'P')
			
                ->groupBy('articles.article_id','asigned_id','master_newsletter_articles.sequence')
                ->orderBy('master_newsletter_articles.sequence')
		->orderBy('articles.publish_date','DESC')
		->orderBy('articles.publish_time','DESC')
                ->get();

           //dd(DB::getQueryLog());
        

        return view('maternewsletter.edit', compact( 'newsletter', 'latestArticles', 'assignedArticles','margin'));
    }

    /**
     * Show the form for editing the specified resource. - Ajax Get
     *
     * @param  int  $id
     * @return Response
     */
    
    /* */
    
    // Sorting articles within a newsletter
    // @param int $id , Request  as $request
    public function sortNewsletter($id,Request $request) {
        $newLetterId=$id;
        foreach($request->item as $k => $itm){
            $newsLetterArticle=NewsletterArticles::find($itm);
            $newsLetterArticle->sequence=$k+1;
            $newsLetterArticle->updated_at = date('Y-m-d H:i:s');
            $newsLetterArticle->save();
        }
        
        
        $newsletter=Newsletter::find($newLetterId);
        $newsletter->updated_at=date('Y-m-d H:i:s');
        $newsletter->update();
        
        
        if($newsletter->channel_id=='1')
            exec("/usr/bin/php /var/www/html/cms/public/cronscript/cronjobnew.php 'section=newsletter'");
        elseif($newsletter->channel_id=='2')
             exec("/usr/bin/php /var/www/html/cms/public/hotcronscript/cronjobnew.php 'section=newsletter'");
        elseif($newsletter->channel_id=='5')
             exec("/usr/bin/php /var/www/html/cms/public/dscronscript/cronjobnew.php 'section=newsletter'");
	elseif($newsletter->channel_id=='3')
             exec("/usr/bin/php /var/www/html/cms/public/bwsccronscript/cronjobnew.php 'section=newsletter'"); 
        elseif($newsletter->channel_id=='7')
             exec("/usr/bin/php /var/www/html/cms/public/bweecronscript/cronjobnew.php 'section=newsletter'"); 
        elseif($newsletter->channel_id=='4')
             exec("/usr/bin/php /var/www/html/cms/public/bwcio/cronjobnew.php 'section=newsletter'");
        elseif($newsletter->channel_id=='9')
             exec("/usr/bin/php /var/www/html/cms/public/bwedcronscript/cronjobnew.php 'section=newsletter'");
        elseif($newsletter->channel_id=='8')
             exec("/usr/bin/php /var/www/html/cms/public/bwhr/cronjobnew.php 'section=newsletter'");
       
    }   
    //End end of sorting newsletter
    public function assign(Request $request) {
        $EventLogController = new EventLogController;
        $uid = Session::get('users')->id;
        foreach ($request->checkItem as $articleId) {
            $newArticle = new NewsletterArticles();
            $newArticle->master_newsletter_id = $request->newsletterId;
            $newArticle->article_id = $articleId;
            $newArticle->sequence = 0;
            $newArticle->is_deleted = 0;
            $newArticle->updated_at = date('Y-m-d H:i:s');
            $newArticle->save();
        }
        
        $newsletter = Newsletter::find($request->newsletterId);
        $newsletter->updated_at=date('Y-m-d H:i:s');
        $newsletter->save();
         if($_POST['newsletterId']=='1'){
             $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'create_newsletter','description'=>'Morning Post Newsletter has been Created by user','article_id'=>$request->newsletterId]);
        }
        elseif($_POST['newsletterId']=='2'){
             $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'create_newsletter','description'=>'Newsupdate Newsletter has been Created by user','article_id'=>$request->newsletterId]);
         }
        elseif($_POST['newsletterId']=='5'){
             $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'create_newsletter','description'=>'Breaking news Newsletter has been Created by user','article_id'=>$request->newsletterId]);
         }
    elseif($_POST['newsletterId']=='3'){
         $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'create_newsletter','description'=>'Afternoon Post Newsletter has been Created by user','article_id'=>$request->newsletterId]);
         }  
        elseif($_POST['newsletterId']=='4'){
             $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'create_newsletter','description'=>'Evening Post Newsletter has been Created by user','article_id'=>$request->newsletterId]);
         }
        if($newsletter->channel_id=='1')
            exec("/usr/bin/php /var/www/html/cms/public/cronscript/cronjob.php 'section=newsletter'");
        elseif($newsletter->channel_id=='2')
             exec("/usr/bin/php /var/www/html/cms/public/hotcronscript/cronjob.php 'section=newsletter'");
        elseif($newsletter->channel_id=='5')
             exec("/usr/bin/php /var/www/html/cms/public/dscronscript/cronjob.php 'section=newsletter'");
	elseif($newsletter->channel_id=='3')
             exec("/usr/bin/php /var/www/html/cms/public/bwsccronscript/cronjob.php 'section=newsletter'"); 
        elseif($newsletter->channel_id=='7')
             exec("/usr/bin/php /var/www/html/cms/public/bweecronscript/cronjob.php 'section=newsletter'");  
        elseif($newsletter->channel_id=='4')
             exec("/usr/bin/php /var/www/html/cms/public/bwcio/cronjob.php 'section=newsletter'");
        elseif($newsletter->channel_id=='9')
             exec("/usr/bin/php /var/www/html/cms/public/bwedcronscript/cronjob.php 'section=newsletter'");
        elseif($newsletter->channel_id=='8')
             exec("/usr/bin/php /var/www/html/cms/public/bwhr/cronjob.php 'section=newsletter'");

        //exec("/usr/bin/php /var/www/html/public/hotcron/cronjob.php 'section=newsletter'");

        Session::flash('message', 'Your article(s) assigned in newsletter.');
        return redirect('/newsletter/manage/' . $request->newsletterId);
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request) {
        if (!Session::has('users')) {
            return redirect()->intended('/auth/login');
        }
        $uid = Session::get('users')->id;
        $newsletter = Newsletter::find($request->newsletterId);

        /* Right mgmt start */
        $rightId = 83;
        // $currentChannelId = $request->channel_sel;
        // $channels = $this->rightObj->getAllowedChannels($rightId);
        if (!$this->rightObj->checkRights($rightId))
            return redirect('/dashboard');
        // if (!trim($request->title)) {
        //     $channel = DB::table('channels')->select('channel')->where('channel_id', $currentChannelId)->first();
        //     $title = $channel->channel . date('-Y-M-d');
        // } else {
        //     $title = $request->title;
        // }
        $title = $request->title;
        $newsletter->channel_id = $request->channel_sel;
        $newsletter->title = $title;
        if($request->deactivate){

            $newsletter->status=0;
            Session::flash('message', 'Your Newsletter has been updated successfully.');
        }
        if($request->activate){
            $newsletter->status=1;
            Session::flash('message', 'Your Newsletter has been updated successfully.');
        }else{
            Session::flash('message', 'Your Newsletter has been updated successfully.');
        }
        $newsletter->save();
        Session::flash('message', 'Your Newsletter has been updated successfully.');
        return redirect('/newsletter');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return None
     */
    public function destroy() {
         if (!Session::has('users')) {
            return 'Please login first.';
        }
        $user = Session::get('users');
        $uid = $user->id;

         /* Right mgmt start */
         $rightId=83;
         // $currentChannelId=$this->rightObj->getCurrnetChannelId($rightId);
        // echo $currentChannelId.'--'.$rightId;
        if(!$this->rightObj->checkRights($rightId)){
            return 'You are not authorized to access';
        }   
        /* Right mgmt end */
        
        
        if (isset($_GET['option'])) {
            $ids = $_GET['option'];
        }
        $EventLogController = new EventLogController;
        //echo $id ; exit;
        $ids=  explode(',',$ids);
        foreach($ids as $id){
            $na = NewsletterArticles::find($id);
            $na->is_deleted = 1;
            $na->updated_at = date('Y-m-d H:i:s');
            $na->save();
        }
        $newsletter=Newsletter::find($na->master_newsletter_id);
        $newsletter->updated_at=date('Y-m-d H:i:s');
        $newsletter->update();
        /*event controller*/
         if($_GET['newsletterId']=='1'){
             $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'delete_newsletter','description'=>'Morning Post Newsletter has been Deleted by user','article_id'=>$_GET['newsletterId']]);
        }
        elseif($_GET['newsletterId']=='2'){
             $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'delete_newsletter','description'=>'Newsupdate Newsletter has been Deleted by user','article_id'=>$_GET['newsletterId']]);
         }
        elseif($_GET['newsletterId']=='5'){
             $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'delete_newsletter','description'=>'Breaking news Newsletter has been Deleted by user','article_id'=>$_GET['newsletterId']]);
         }
    elseif($_GET['newsletterId']=='3'){
         $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'delete_newsletter','description'=>'Afternoon Post Newsletter has been Deleted by user','article_id'=>$_GET['newsletterId']]);
         }  
        elseif($_GET['newsletterId']=='4'){
             $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'delete_newsletter','description'=>'Evening Post Newsletter has been Deleted by user','article_id'=>$_GET['newsletterId']]);
         }
        /*event controller*/
        if($newsletter->channel_id=='1'){
            exec("/usr/bin/php /var/www/html/cms/public/cronscript/cronjob.php 'section=newsletter'");
        }
        elseif($newsletter->channel_id=='2'){
             exec("/usr/bin/php /var/www/html/cms/public/hotcronscript/cronjob.php 'section=newsletter'");
         }
        elseif($newsletter->channel_id=='5'){
             exec("/usr/bin/php /var/www/html/cms/public/dscronscript/cronjob.php 'section=newsletter'");
         }
	elseif($newsletter->channel_id=='3'){
             exec("/usr/bin/php /var/www/html/cms/public/bwsccronscript/cronjob.php 'section=newsletter'");
         }
        elseif($newsletter->channel_id=='7')
             exec("/usr/bin/php /var/www/html/cms/public/bweecronscript/cronjob.php 'section=newsletter'");  
        elseif($newsletter->channel_id=='4'){
             exec("/usr/bin/php /var/www/html/cms/public/bwcio/cronjob.php 'section=newsletter'");
         }
        elseif($newsletter->channel_id=='9')
             exec("/usr/bin/php /var/www/html/cms/public/bwedcronscript/cronjob.php 'section=newsletter'");
        elseif($newsletter->channel_id=='8')
             exec("/usr/bin/php /var/www/html/cms/public/bwhr/cronjob.php 'section=newsletter'");
         Session::flash('message', 'Your article(s) Deleted in newsletter.');
        return redirect('/newsletter/manage/' . $request->newsletterId);
    }
    
    
    public function destroyNewsletter() {
        
         if (!Session::has('users')) {
            return 'Please login first.';
        }
        
         /* Right mgmt start */
        $rightId=83;
         $currentChannelId=$this->rightObj->getCurrnetChannelId($rightId);
        // echo $currentChannelId.'--'.$rightId;
        if(!$this->rightObj->checkRights($currentChannelId,$rightId)){
            return 'You are not authorized to access';
        }   
        /* Right mgmt end */
        
        
        if (isset($_GET['option'])) {
            $ids = $_GET['option'];
        }
        $delArr = explode(',', $ids);
        
        foreach ($delArr as $id) { 
            $na = Newsletter::find($id);
            $na->is_deleted = 1;
            $na->updated_at = date('Y-m-d H:i:s');
            $na->save();
        }
        
        return 'success';
    }



    /*newsletter*/
         public function Morning_N_Page_New1(Request $request)
    {
        DB::enableQueryLog();

         /*$ArrRecentArticleGuestColumn = Articleauthor::orderBy('article_id','DESC')->take(3)->get();*/  

                   $ArrViewArticle = DB::table('articles')
                    ->JOIN('master_newsletter_articles', 'articles.article_id', '=', 'master_newsletter_articles.article_id')
                    ->JOIN('article_category', 'article_category.article_id', '=', 'articles.article_id')
                    ->JOIN('category', 'category.category_id', '=', 'article_category.category_id')
                     ->JOIN('photos', 'photos.owner_id', '=', 'articles.article_id')
                   
                    ->select('articles.*','category.name','photos.photopath','master_newsletter_articles.master_newsletter_id')
                   // ->select('article.*','master_newsletter_articles.master_newsletter_id')
                    ->where('master_newsletter_id', 1)->where('is_deleted', 0)->orderBy('master_newsletter_articles.sequence','ASC')->take(6)->get();
                    
                     $ArrRecentArticleGuestColumn = DB::table('articles')
                    ->JOIN('master_newsletter_articles', 'articles.article_id', '=', 'master_newsletter_articles.article_id')
                    ->JOIN('article_category', 'article_category.article_id', '=', 'articles.article_id')
                    ->JOIN('category', 'category.category_id', '=', 'article_category.category_id')
                    ->select('articles.*','category.name','master_newsletter_articles.master_newsletter_id')
                    ->where('master_newsletter_id', 1)->where('is_deleted', 0)->orderBy('master_newsletter_articles.sequence','ASC')
                    ->skip(6)->take(6)->get();

        $ArrRecentCategoryAricle = DB::table('articles')
                    ->JOIN('article_category', 'articles.article_id', '=', 'article_category.article_id')
                    ->JOIN('category', 'category.category_id', '=', 'article_category.category_id')
                    ->select('articles.*','category.name','article_category.category_id')->where('article_category.category_id', '=', '35')->orderBy('articles.publish_date','DESC')->orderBy('articles.publish_time','DESC')->take(3)->get();   
         
        //$ArrRecentShowcaseVideo = Video::where('video_type', '=', 2)->take(3)->get();            
                   
/*$ArrViewArticleIB = DB::table('article')
                    ->JOIN('article_category', 'article.article_id', '=', 'article_category.article_id')
                    ->JOIN('category', 'category.category_id', '=', 'article_category.category_id')
                     ->where('category.category_id', 35)->orderBy('article.publish_date','DESC')->orderBy('article.publish_time','DESC')->take(5)->get();
  */                


         //dd(DB::getQueryLog());
        return view('newsletter.morning_post_new1', compact('ArrViewArticle',
                                                        'ArrRecentShowcaseVideo',
                                                        'ArrRecentCategoryAricle',
                                                        'ArrRecentArticleGuestColumn'
                                                        
                                                     ));
    }




    /*newsletter send mailer*/
    public function sendmailer(Request $request)
    {
        DB::enableQueryLog();
            if (!Session::has('users')) {
            return redirect()->intended('/auth/login');
        }
        $user = Session::get('users');
        $uid = $user->id;
        /* Right mgmt start */
        $subject = $request->subject;
        $postval = $request->postval;
        $url_html = $request->url;
        $description = $request->desc;
        $fromName = $request->fromname;
        $sendval = $request->sendval;
        $html = file_get_contents($url_html);
        if ($sendval=='livemail') {
              $list = 's4m-database-10-aug';
              $event_type = 'fire_newsletter';
        }else{
              $list = 's4md16may18_test';
              $event_type = 'test_newsletter';
        }
        date_default_timezone_set('Asia/Kolkata');
        $date = date('Y-m-d h:i:s');
        $time = date("h:i:s");
        $url = 'https://api.elasticemail.com/v2/email/send';
        try{
                $post = array('from' => 'mailer@samachar4media.com',
                'fromName' => $fromName,
                'apikey' => '7342e740-305d-4385-9195-da406e7b2633',
                'subject' => $subject,
                'lists' => $list,
                'bodyHtml' => $html,
                'bodyText' => $html,
                'isTransactional' => false);
                $ch = curl_init();
                curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $post,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_SSL_VERIFYPEER => true
                ));
                $result=curl_exec($ch);
                curl_close ($ch);
                $EventLogController = new EventLogController;
            $EventLogController->eventstore(['userid'=>$uid,'event_type'=>$event_type,'description'=>$description,'article_id'=>$postval]);
                }
                catch(Exception $ex){
                echo $ex->getMessage();
                }
                echo $result;   
    }

    public function searchIdResult($id)
    {
        $latestArticles = DB::table('articles')
                        ->Leftjoin('authors', 'articles.author_id', '=', 'authors.author_id')
                        ->JOIN('category', 'category.category_id', '=', 'articles.category_id')
                        
                        ->select(DB::raw('articles.article_id,articles.title,articles.article_id,articles.publish_date,articles.publish_time,group_concat(authors.name) as name'))
                        ->where([['articles.status', 'P'],['articles.article_id',$id]])
                        // ->whereRaw("concat(publish_date,' ',publish_time)>= now() - INTERVAL ? DAY",[$margin])
                        ->whereRaw("articles.article_id not in (select article_id from master_newsletter_articles where master_newsletter_id=$id and is_deleted=0)")
                        ->first();
        return response()->json($latestArticles);             
    }

}
