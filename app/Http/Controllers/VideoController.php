<?php
namespace App\Http\Controllers;
use App\Author;
use App\Tag;
use Illuminate\Http\Request;
use DB;
use Input;
use Session;
use App\Right;
use App\MasterVideo;
use App\VideoCategory;
use App\VideoTag;
use App\ArticleF;
use App\Http\Requests;
use App\Http\Controllers\Auth;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\Controller;
use App\Photo;
use Storage;
use App\Classes\FileTransfer;
use Aws\Laravel\AwsFacade as AWS;
use Aws\Laravel\AwsServiceProvider;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    private $rightObj;
    public function __construct() {
        $this->middleware('auth');
        $this->rightObj= new Right();
    
    }
    
    
    public function index()
    {
        //echo count($arr);exit;
        //
        
        /* Right mgmt start */
        $rightId=62;
        $currentChannelId=$this->rightObj->getCurrnetChannelId($rightId);
        $channels=$this->rightObj->getAllowedChannels($rightId);
        
        if(!$this->rightObj->checkRights($currentChannelId,$rightId))
            return redirect('/dashboard');
        /* Right mgmt end */
                
        if(!Session::has('users')){
            return redirect()->intended('/auth/login');
        }
        $uid = Session::get('users')->id;
        $rightLabel = "";
        //Get QB Array
        $q = MasterVideo::where('video_status',1)
                ->select('id','video_title','updated_at','video_thumb_name');
            if (isset($_GET['searchin'])) {
                if ($_GET['searchin'] == 'title') {
                    $q->where('video_title', 'like', '%' . trim($_GET['keyword']) . '%');
                }
                if (@$_GET['searchin'] == 'id') {
                    $q->where('id', trim($_GET['keyword']));
                }
            }
            

       $videos=$q->where('channel_id','=',$currentChannelId)->orderBy('id','desc')->paginate(config('constants.recordperpage'));
       return view('video.published', compact('videos','channels','currentChannelId'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
		
        //Authenticate User
        if (!Session::has('users')) {
            return redirect()->intended('/auth/login');
        }
        
        /* Right mgmt start */
        $rightId=65;
        // $currentChannelId=$this->rightObj->getCurrnetChannelId($rightId);
        // $channels=$this->rightObj->getAllowedChannels($rightId);
        $category = DB::table('category')->where('valid','1')->orderBy('name')->get();
        if(!$this->rightObj->checkRights($rightId))
            return redirect('/dashboard');
        /* Right mgmt end */
        
		
        
        //$asd = fopen("/home/sudipta/log.log", 'a+');
        $uid = Session::get('users')->id;
        //$channels = VideoController::getUserChannels($uid);
        $authors = Author::where('author_type_id','=',2)->get();
      
        $p1= DB::table('author_type')->where('valid','1')->whereIn('author_type_id',[1,2])->pluck('label','author_type_id');
        //fclose($asd);
		
        return view('video.upload-new-Video', compact('uid','channels','p1','authors','currentChannelId','category'));
    }
    /*
     * Get Page Rights of the User
     */
    public function getRights($uid, $parentId=56){
        DB::enableQueryLog();
        
        $rights = DB::table('rights')
        ->join('user_rights','user_rights.rights_id','=','rights.rights_id')
        ->where('user_rights.user_id','=',$uid)
        ->where(function($rts) use ($parentId){
                    $rts->where('rights.parent_id','=',0)->orwhere('rights.parent_id','=',$parentId) ;
             })
        ->get();
        $query = DB::getQueryLog();
        $lastQuery = end($query);
        //print_r($lastQuery); exit;
        return $rights;
    }
    /**
     * Get channel Array for User ID
     *
     * @param User ID
     * @return Array
     */
    public function getUserChannels($userID){

        $channels = DB::table('channels')
            ->join('rights','rights.pagepath','=','channels.channel_id')
            ->join('user_rights', 'user_rights.rights_id','=','rights.rights_id')
            ->select('channels.*')
            ->where('rights.label', '=', 'channel')
            ->where('user_rights.user_id', '=', $userID)
            ->orderBy('channel')    
            ->get();

        return $channels;
    }
    
    
    function imageUpload(){
      //  echo 'test';exit;
        $arg['script_url']=url('album/image/upload');
        $upload_handler = new UploadHandler($arg);
    }
    

    public function uploadImg(Request $request){

        //$asd = fopen("/home/sudipta/log.log", 'a+');
        //fwrite($asd, "Upload Images:".var_dump($_POST)." \n");
        //fclose($asd);
        return;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    { 
        /* Right mgmt start */
        $rightId=65;
      //  print_r($_POST);
      //  print_r($_FILES);
      
        $currentChannelId=$request->channel;
        if(!$this->rightObj->checkRights($currentChannelId,$rightId))
            return redirect('/dashboard');
        /* Right mgmt end */
        
         // print_r($request->all()); 
  
        $uid = $request->user()->id;
        $fileTran = new FileTransfer();
        $video = new MasterVideo();
        if($request ->video_thumb_name !=''){
            $file = $request->file('video_thumb_name');
            $filename = str_random(6) . '_' . $request->file('video_thumb_name')->getClientOriginalName();
            $fileTran->uploadFile($file, config('constants.awvideothumb'), $filename,false);
            $destination =config('constants.awvideothumb_small');
            $fileTran->resizeAndTransferFile($filename,'90X68',config('constants.awvideothumb'),$destination);
            $video->video_thumb_name = $filename;
            if (config('constants.store_location') != 'local') {
                  unlink($_SERVER['DOCUMENT_ROOT'] . '/files/'.config('constants.awvideothumb').$filename);
            }
            Storage::disk('mastervideothumb')->put($filename,
                 file_get_contents(config('constants.UploadImg').config('constants.awvideothumb').$filename),
                \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
                );
        }
        // Add Arr Data to Album Table //
        $video->channel_id = $request->channel;
        $video->video_title = $request->video_title;
        $video->video_soruce = $request->video_source;
        $video->advertiser = $request->advertiser;
        $video->industry = $request->industry;
        $video->agency = $request->agency;
        $video->video_type = $request->video_type;    
        $video->video_summary = $request->video_summary;
        $video->video_code = $request->embed_code;
        $video->video_status = '1';
        $video->campaign_id = '0';
        $video->save();
        $id = $video->id;
         //Video Tags - Save
        if ($request->Taglist) {
            $videoids = explode(',', $request->Taglist);
            $videoids = array_unique($videoids);
            foreach ($videoids as $key => $value) {
                $video_tags = new VideoTag();
                $video_tags->video_id = $id;
                $video_tags->tags_id = $value;
                $video_tags->save();
            }
        }
       //video Category - Save
            for ($i = 1; $i <= 4; $i++) {
                $video_category = new VideoCategory();
                $video_category->video_id = $id;
                $label = "category" . $i;
                if ($request->$label == '') {
                    break;
                }
                $video_category->category_id = $request->$label;
                $video_category->level = $i;
                $video_category->save();
            }

            Session::flash('message', 'Your video has been Upload successfully.');
            return redirect('/video/list?channel='.$request->channel);
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {   
       
        $video=MasterVideo::find($id);
        
        /* Right mgmt start */
        $rightId=65;
        $currentChannelId=$video->channel_id;
        $channels=$this->rightObj->getAllowedChannels($rightId);
        if(!$this->rightObj->checkRights($currentChannelId,$rightId))
            return redirect('/dashboard');
        /* Right mgmt end */
       $tags = json_encode(DB::table('tags')
                        ->select('tags.tags_id as id', 'tags.tag as name')
                        ->join('video_tags', 'tags.tags_id', '=', 'video_tags.tags_id')
                        ->where('tags.valid', '1')
                        ->where('video_tags.valid', '1')
                        ->where('video_tags.video_id', $id)
                        ->get()); 
       #$tags=  json_encode(DB::table('tags')
                #->select('tags_id as id','tag as name')
                #->whereIn('tags_id',explode(',',$video->tags))->get());
       $campaign = DB::table('campaign')->where('channel_id',$currentChannelId)->where('valid', '1')->get();
       $category = DB::table('category')->where('channel_id','=',$currentChannelId)->where('valid','1')->orderBy('name')->get();
       $acateg2 = DB::table('video_category')
                    ->where('video_id', '=', $id)->get();
        
        $cateStr = array();
        $acateg = array();
        
        foreach ($acateg2 as $ac) {
            $lable = 'c' . $ac->level;
            $cateStr[$lable] = $ac->category_id;
                    
            switch ($ac->level) {
                case "1":
                    $catlbl = DB::table('category')->where('category_id', '=', $ac->category_id)->get();
                    $acateg[0]['level'] = 1;
                    $acateg[0]['category_id'] = $ac->category_id;
                    $acateg[0]['name'] = $catlbl[0]->name;
                    break;
                case "2":
                    $catlbl = DB::table('category')->where('category_id', '=', $ac->category_id)->get();
                    $acateg[1]['level'] = 2;
                    $acateg[1]['category_id'] = $ac->category_id;
                    $acateg[1]['name'] = $catlbl[0]->name;
                    ;
                    break;
                case "3":
                    $catlbl = DB::table('category')->where('category_id', '=', $ac->category_id)->get();
                    $acateg[2]['level'] = 3;
                    $acateg[2]['category_id'] = $ac->category_id;
                    $acateg[2]['name'] = $catlbl[0]->name;
                    break;
                case "4":
                    $catlbl = DB::table('category')->where('category_id', '=', $ac->category_id)->get();
                    $acateg[3]['level'] = 4;
                    $acateg[3]['category_id'] = $ac->category_id;
                    $acateg[3]['name'] = $catlbl[0]->name;
                    ;
                    break;
            }
            
        }

        if (!isset($acateg[0])) {
            unset($acateg[1]);
            unset($acateg[2]);
            unset($acateg[3]);
        } elseif (!isset($acateg[1])) {
            unset($acateg[2]);
            unset($acateg[3]);
        } elseif (!isset($acateg[2])) {
            unset($acateg[3]);
        }
       
        $uid = Session::get('users')->id;
        //$channels = VideoController::getUserChannels($uid);
        return view('video.edit', compact('video','tags','channels','campaign','acateg','category'));
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {//Update album
        
        /* Right mgmt start */
        $rightId=65;
        //dd($request->all()); 
        $currentChannelId=$request->channel;
        if(!$this->rightObj->checkRights($currentChannelId,$rightId))
            return redirect('/dashboard');
        /* Right mgmt end */
        
        
        $video = MasterVideo::find($request->id);
        $fileTran = new FileTransfer();
       
         if($request ->video_thumb_name !=''){
            $file = $request->file('video_thumb_name');
            $filename = str_random(6) . '_' . $request->file('video_thumb_name')->getClientOriginalName();
            $fileTran->uploadFile($file, config('constants.awvideothumb'), $filename,false);
            $destination =config('constants.awvideothumb_small');
            $fileTran->resizeAndTransferFile($filename,'90X68',config('constants.awvideothumb'),$destination);
            $video->video_thumb_name = $filename;
           
            Storage::disk('mastervideothumb')->put($filename,
                file_get_contents(config('constants.UploadImg').config('constants.awvideothumb').$filename),
                \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
                );
             if (config('constants.store_location') != 'local') {
                  unlink($_SERVER['DOCUMENT_ROOT'] . '/files/'.config('constants.awvideothumb').$filename);
            }

        }else{
            $video->video_thumb_name = $request->video_thumb_name_second;

        }

      
        $video->channel_id = $request->channel;
        $video->video_title = $request->video_title;
        $video->video_soruce = $request->video_source;
        $video->advertiser = $request->advertiser;
        $video->industry = $request->industry;
        $video->agency = $request->agency;
        $video->video_type = $request->video_type;    
        $video->video_summary = $request->video_summary;
        $video->video_code = $request->embed_code;
        $video->video_status = '1';
        $video->campaign_id = '0';
        $video->save();
        
        $id = $request->id;
        
        //Video Tags - Save New: Delete Old
        $arrExistingTags = DB::table('video_tags')->where('video_id', '=', $id)->get(); 
       
        if (count($arrExistingTags) > 0) {
            foreach ($arrExistingTags as $eachTag) {
                $delTag = VideoTag::find($eachTag->v_tags_id);
                $delTag->delete();
            }
        }
        //Add New Tags
        if ($request->Taglist) {
            $videoids = explode(',', $request->Taglist);
            $videoids = array_unique($videoids);
            foreach ($videoids as $key => $value) {
                $video_tags = new VideoTag();
                $video_tags->video_id = $id;
                $video_tags->tags_id = $value;
                $video_tags->save();
            }
        }        
        
        
        
        DB::table('video_category')->where('video_id','=',$id)->delete();
        //video Category - update
        for ($i = 1; $i <= 4; $i++) {
            $video_category = new VideoCategory();
            $video_category->video_id = $id;
            $label = "category" . $i;
            if ($request->$label == '') {
                break;
            }
            $video_category->category_id = $request->$label;
            $video_category->level = $i;
            $video_category->save();
        }
        
        
       
            
        Session::flash('message', 'Your Video has been Published successfully.');
        return redirect('/video/list?channel='.$request->channel);
       
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {  DB::delete('delete from article_feature where sequence >= 15');
            $id = $_GET['option'];
            $title = $_GET['title'];
            $thumb = $_GET['thumb'];
            $vid = $_GET['vid'];
                $articlef = new ArticleF();
                $articlef->story_key_id = $vid;
                $articlef->title = $title;
                $articlef->url = config('constants.SiteBaseurl').'videos'.'/'.str_slug($title).'-'.$vid.'.html';
                $articlef->photopath = $thumb;
                $articlef->phototitle = $title;
                $articlef->sequence = '0';
                $articlef->story_type = 'video';
                $articlef->publish_date =  date('Y-m-d H:i:s');
                $articlef->created_at = date('Y-m-d H:i:s');
                $articlef->updated_at = date('Y-m-d H:i:s');
                $articlef->save();
        return;
    }
    
    public function returnJson() {
        //DB::enableQueryLog();
        $matchText = $_GET['q'];
        $video = new MasterVideo;
        //->all()
        $rst = $video->where('video_title', "like", $matchText . '%')->select('id as id', 'video_title as name')->get();
          return response()->json($rst);
    }

    /*front*/

     public function Video_listing_page(Request $request)
    {
        parent::__construct();
       
        $ArrRecentNewsMiddelbarList=$this->ArrRecentNewsMiddelbarList;
        $source = Config::get('constants.JSON_FILE');
        $ArrRecentImportantNewsall = json_decode(file_get_contents($source), true);
        $ArrRecentImportaintNewsHeaderList   = json_encode($ArrRecentImportantNewsall['Important']);
        $ArrMenuSLatestNews   = json_encode($ArrRecentImportantNewsall['MenuSLatestNews']);
        $ArrMenuSLatestVideo   = json_encode($ArrRecentImportantNewsall['MenuSLatestVideo']);
        $ArrMenuSTag   = json_encode($ArrRecentImportantNewsall['MenuSTag']);
        $ArrRecentImportantNewsFooter   = json_encode($ArrRecentImportantNewsall['ArrRecentImportantNewsFooter']);
        $ArrRecentNewsFooter   = json_encode($ArrRecentImportantNewsall['ArrRecentNewsFooter']);
        $ArrRecentFooterPanelCategoryAricles   = json_encode($ArrRecentImportantNewsall['ArrRecentFooterPanelCategoryAricles']);
        $ArrRecentArticleMiddelPanelGuestColumn   = json_encode($ArrRecentImportantNewsall['RecentArticleMiddelPanelGuestColumn']);
        $ArrRecentMiddelPanelCategoryAricles   = json_encode($ArrRecentImportantNewsall['RecentMiddelPanelCategoryAricles']);
        $ArrRecentVidioRightPanelslider = isset($ArrRecentImportantNewsall['ArrRecentVidioRightPanelslider']) ? json_encode($ArrRecentImportantNewsall['ArrRecentVidioRightPanelslider']):json_encode(array());
        $ArrRecentRightPanelTelevisionAricles   = isset($ArrRecentImportantNewsall['ArrRecentRightPanelTelevisionAricles']) ? json_encode($ArrRecentImportantNewsall['ArrRecentRightPanelTelevisionAricles']):json_encode(array());
        
        $ArrRecentRightPanelGSTAricles   = isset($ArrRecentImportantNewsall['ArrRecentRightPanelGSTAricles']) ? json_encode($ArrRecentImportantNewsall['ArrRecentRightPanelGSTAricles']):json_encode(array());
        
        $ArrRecentRightPanelDigitalAricles   = isset($ArrRecentImportantNewsall['ArrRecentRightPanelDigitalAricles']) ? json_encode($ArrRecentImportantNewsall['ArrRecentRightPanelDigitalAricles']) :json_encode(array());
        $ArrRecentRightPanelOutofHomeAricles   = isset($ArrRecentImportantNewsall['ArrRecentRightPanelOutofHomeAricles']) ? json_encode($ArrRecentImportantNewsall['ArrRecentRightPanelOutofHomeAricles']):json_encode(array());
        $ArrRecentRightPanelPrintAricles   = isset($ArrRecentImportantNewsall['ArrRecentRightPanelPrintAricles']) ? json_encode($ArrRecentImportantNewsall['ArrRecentRightPanelPrintAricles']):json_encode(array());
        $ArrRecentRightPanelRadioAricles = isset($ArrRecentImportantNewsall['ArrRecentRightPanelRadioAricles']) ? json_encode($ArrRecentImportantNewsall['ArrRecentRightPanelRadioAricles']): json_encode(array());
        $ArrRecentCompanyTopicsList=isset($ArrRecentImportantNewsall['ArrRecentCompanyTopicsList']) ? json_encode($ArrRecentImportantNewsall['ArrRecentCompanyTopicsList']):json_encode(array());
        $ArrRecentPeopleTopicsList=isset($ArrRecentImportantNewsall['ArrRecentPeopleTopicsList']) ? json_encode($ArrRecentImportantNewsall['ArrRecentPeopleTopicsList']):json_encode(array());
         $ArrlistingVideos =  Youtube::listChannelVideos('UC13NIM-ePLUiKf37-ZhVMkw', 50 ,'date');
         //$ArrlistingVideos = new \Illuminate\Pagination\Paginator($ArrlistingVideos1, 10);
         
    
        $metatitel = 'Video News, Most Searches and Trending Video, Video Gallery - Exchange4media';
        $ogtitel =  '';
        $ogimage = '';
        $ogurl = '';
        $canonical = '';
        $metatag = 'video news, trending video in India, most searches video, amazing videos, video gallery';
        $metadescription = 'Exchange4media provides latest and breaking news videos and most searches and trending video in India.';
        $ogdescription = '';

        return view('video.video_listing', compact('ArrlistingVideos',
                                                            'metatitel',
                                                            'ogtitel',
                                                            'metatag',
                                                            'ogimage',
                                                            'ogurl',
                                                            'canonical',
                                                            'metadescription',
                                                            'ogdescription',
                                                            'ArrRecentNewsMiddelbarList',
                                                            'ArrRecentArticleMiddelPanelGuestColumn',
                                                            'ArrRecentMiddelPanelCategoryAricles',
                                                            'ArrRecentImportaintNewsHeaderList',
                                                            'ArrRecentImportaintNewsHeaderList',
                                                            'ArrMenuSLatestNews',
                                                            'ArrMenuSLatestVideo',
                                                            'ArrMenuSTag',
                                                            'ArrRecentNewsFooter',
                                                            'ArrRecentImportantNewsFooter',
                                                            'ArrRecentRightPanelTelevisionAricles',
                                                            'ArrRecentRightPanelGSTAricles',
                                                            'ArrRecentRightPanelDigitalAricles',
                                                            'ArrRecentRightPanelOutofHomeAricles',
                                                            'ArrRecentRightPanelPrintAricles',
                                                            'ArrRecentVidioRightPanelslider',
                                                            'ArrRecentRightPanelRadioAricles',
                                                            'ArrRecentPeopleTopicsList',
                                                            'ArrRecentCompanyTopicsList',
                                                            'ArrRecentFooterPanelCategoryAricles'));
    } 

}

