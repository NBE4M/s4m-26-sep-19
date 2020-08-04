<?php
namespace App\Http\Controllers;
use App\ArticleAuthor;
use App\ArticleCategory;
use App\ArticleTag;
use App\ArticleTopic;
use App\Category;
use App\Breaking;
use App\Photo;
use Artisan;
use App\Right;
use App\UserRight;
use App\ArticleF;
use App\User;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Toolkito\Larasap\SendTo;
use File;
use Config;
use App\Http\Controllers\EventLogController;
use Validator;
use Session;
use Storage;
use App\Article;
use App\QuickByte;
use App\Album;
use App\Channel;
use App\AuthorType;
use App\Country;
use App\State;
use App\Author;
use App\NewsType;
use App\MasterVideo;
use App\Http\Controllers\Auth;
use App\Http\Controllers\AuthorsController;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Classes\UploadHandler;
use App\Classes\FileTransfer;
use App\Classes\Zebra_Image;
use Aws\Laravel\AwsFacade as AWS;
use Helper;
use Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class ArticlesController extends Controller {
    private $rightObj;
    public function __construct() {
        $this->middleware('auth');
       $this->rightObj = new Right();
    }

    public function index($option) {
        
        if (!Session::has('users')) {
            return redirect()->intended('/auth/login');
        }
        $uid = Session::get('users')->id;
        $rightLabel = "";
        $selectedNewType=0;
        $rightId = '';
        //exit;
        switch ($option) {
            case "drafts":
                $status = 'S';
                $page = "drafts";
                $rightLabel = "drafts";
                
                break;
            case "new":
                $status = 'N';
                $rightLabel = "newArticles";
                $rightId = 11;
                break;
            case "scheduled":
                $status = 'SD';
                $rightLabel = "scheduledArticles";
                $rightId = 15;
                break;
            case "published":
                $status = 'P';
                $rightLabel = "publishedArticles";
                $rightId = 16;
                break;
            case "missedarticles":
                $status = '';
                $rightLabel = "missedArticles";
                $rightId = 16;
                break;
            case "lockedarticles":
                $status = 'L';
                $rightLabel = "lockedArticles";
                $rightId = 16;
                break;
            case "deleted":
                $status = 'D';
                $rightLabel = "deletedArticles";
                $rightId = 17;
                break;
           case "priority":
                $status = 'P';
                $rightLabel = "topArticles";
                $rightId = 17;
                break;
        }
        /* Right mgmt start */
        // $currentChannelId = $this->rightObj->getCurrnetChannelId($rightId);
        // $channels = $this->rightObj->getAllowedChannels($rightId);

        if (!$this->rightObj->checkRights($rightId))
            return redirect('/dashboard');
        /* Right mgmt end */
        $editor = '';
        $newstype = DB::table('news_type')->where('valid', '1')->get();
        //For My Drafts Page
        if ($option == 'drafts') {
            $q = DB::table('articles')
                    //->join('users');
                    ->Leftjoin('authors', 'articles.author_id', '=', 'authors.author_id')
                    ->select(DB::raw('articles.article_id,articles.url,articles.title,articles.article_id,articles.publish_date,articles.publish_time,articles.updated_at,
                    group_concat(authors.name) as name'))
                    ->where('status', $status)
                    ->where('user_id', $uid);

            if (isset($_GET['searchin'])) {
                if ($_GET['searchin'] == 'title') {
                    $q->where('articles.title', 'like', '%' . $_GET['keyword'] . '%');
                }
                if (@$_GET['searchin'] == 'article_id') {
                    $q->where('articles.article_id', $_GET['keyword']);
                }
            }
            $q->groupBy('articles.article_id');
            $q->orderBy('articles.article_id', 'DESC');
            $articles = $q->paginate(config('constants.recordperpage'));
        }
         elseif ($option == 'priority') {
            $articles = DB::table('articles')
                    ->select(DB::raw('article_id,priority,title,publish_date,publish_time'))
                    ->where('important', 1)
                    ->orderBy('publish_date', 'desc')->orderBy('publish_time', 'desc')
                    ->limit(5)->get();

        }
        elseif ($option == 'missedarticles') {
            $q = DB::table('articles')
                    //->join('users');
                    ->Leftjoin('authors', 'articles.author_id', '=', 'authors.author_id')
                    ->select(DB::raw('articles.article_id,articles.title,articles.article_id,articles.publish_date,articles.publish_time,
                    group_concat(authors.name) as name'))
                    ->where('status', $status)
                    ->orwhere('publish_date', '0000-00-00');

            if (isset($_GET['searchin'])) {
                if ($_GET['searchin'] == 'title') {
                    $q->where('articles.title', 'like', '%' . $_GET['keyword'] . '%');
                }
                if (@$_GET['searchin'] == 'article_id') {
                    $q->where('articles.article_id', $_GET['keyword']);
                }
            } 
            $q->groupBy('articles.article_id');
            $q->orderBy('articles.article_id', 'DESC');
            $articles = $q->paginate(config('constants.recordperpage'));
        }
        elseif ($option == 'lockedarticles') {
            $q = DB::table('articles')
                ->Leftjoin('authors', 'articles.author_id', '=', 'authors.author_id')
                ->Leftjoin('users', 'articles.locked_by', '=', 'users.id')
                ->select(DB::raw('articles.locked_by,users.name as username,articles.article_id,articles.title,articles.article_id,articles.publish_date,articles.publish_time,
                    group_concat(authors.name) as name'))
                ->where('locked_by','!=' ,'');

            if (isset($_GET['searchin'])) {
                if ($_GET['searchin'] == 'title') {
                    $q->where('articles.title', 'like', '%' . $_GET['keyword'] . '%');
                }
                if (@$_GET['searchin'] == 'article_id') {
                    $q->where('articles.article_id', $_GET['keyword']);
                }
            }
            $q->groupBy('articles.article_id');
            $q->orderBy('articles.article_id', 'DESC');
            $articles = $q->paginate(config('constants.recordperpage'));
        }
        else {
            $i = 0;
            $articles = array();
            $condition = '';
            $q = DB::table('articles')
                    ->Leftjoin('authors', 'articles.author_id', '=', 'authors.author_id')
                    ->where('status',$status);
            if ($option == 'new') {
                $q->join('users', 'articles.user_id', '=', 'users.id');
                $q->select(DB::raw('articles.article_id,articles.url,articles.title,articles.created_at,articles.publish_date,articles.publish_time,group_concat(authors.name) as name,articles.channel_id,articles.locked_by,users.name as username'));
                $q->orderBy('articles.created_at', 'desc');
            } else {
                $q->select(DB::raw('articles.article_id,articles.title,articles.publish_date,articles.publish_time,group_concat(authors.name) as name,articles.channel_id,articles.locked_by'));
                if ($option == 'scheduled') {
                    $q->orderBy('articles.updated_at', 'desc');
                } else {
                    $q->orderBy('articles.publish_date', 'desc');
                    $q->orderBy('articles.publish_time', 'desc');
                }
            }
            if (isset($_GET['searchin'])) {
                if ($_GET['searchin'] == 'title') {
                    $q->where('articles.title', 'like', '%' . $_GET['keyword'] . '%');
                }
                if (@$_GET['searchin'] == 'article_id') {
                    $q->where('articles.article_id', $_GET['keyword']);
                }
                if (@$_GET['searchin'] == 'author') {
                    $q->where('authors.name', 'like', '%' . $_GET['keyword'] . '%');
                }
                if (@$_GET['searchin'] == 'published') {
                    $q->where('articles.publish_date', 'like', '%' . $_GET['keyword'] . '%');
                }
            }
            if(isset($_GET['newstype'])){
               echo $selectedNewType=$_GET['newstype'];
                if(trim($selectedNewType)){
                    $q->where('articles.news_type',$selectedNewType);
                }
            }
            $articles = $q->groupBy('articles.article_id')->paginate(config('constants.recordperpage'));
            $editor = DB::table('users')
                    ->join('articles', 'users.id', '=', 'articles.locked_by')
                    ->select('users.name', 'articles.article_id')
                    ->where('status', $status)
                    ->get();
            
        }
        $data  = DB::table('article_feature')
                    ->select(DB::raw('article_feature.*'))
                    ->orderby('sequence','asc')->orderby('publish_date','desc')->limit(100)->get();
                   
          if (count($data) > 0) {
              return view('articles.' . $option, compact('articles','data','articlestop', 'editor', 'channels', 'currentChannelId','newstype','selectedNewType'));
          }else{
             $data  = DB::table('article_feature')
                    ->select(DB::raw('article_feature.*'))
                    ->orderby('sequence','asc')->orderby('publish_date','desc')->limit(100)->get();
             return view('articles.' . $option, compact('articles','data','articlestop', 'editor', 'channels', 'currentChannelId','newstype','selectedNewType'));
          }
       
    }

    function imageUpload() {
        $arg['script_url'] = url('article/image/upload');
        $upload_handler = new UploadHandler($arg);
    }

    function imageEdit(Request $request) {  
        $photo = Photo::find($request->id);
        $article = '';
        if ($photo->owned_by == 'article') {
            $article = Article::find($photo->owner_id);
        }
        return view('layouts.imageEdit', compact('photo', 'article'));
    }

    function storeImageDetail(Request $request) {
     
        parse_str($request->detail);
        $photo = Photo::find($photo_id);

        if ($photo->owned_by == 'article') {
            $article = Article::find($photo->owner_id);
            $photo->title = $imagetitlep;
            $photo->photo_by = $imagebyp;
            //social_image_popup
            $return = ' <td>
                            <img alt="article" src="' . config('constants.SiteBaseurl') . config('constants.awarticleimagethumbtdir') . $photo->photopath . '">
                        </td>
                        <td>' . $photo->title . ' / ' . $photo->photo_by . '</td>
                <input type="hidden" id="' . $photo->photo_id . '" name="deleteImagel">
                <td class="center"><button class="btn btn-mini btn-danger" id="deleteImage" name="' . $photo->photo_id . '" onclick="$(this).MessageBox(' . $photo->photo_id . ')" type="button">Dump</button>
                    <button class="btn btn-mini btn-edit" id="deleteImage" name="image' . $photo->photo_id . '" onclick="editImageDetail(' . $photo->photo_id . ',\'article\')" type="button">Edit</button>
                    <img style="width:20%; display:block; margin-left:15px;display:none;" alt="loader" src="' . asset('images/photon/preloader/76.gif') . '"></td>
               ';
            $updatearray = array('updated_at' => date('Y:m:d H:i:s'));
            if (isset($social_image_popup)) {
                $updatearray['social_image'] = $social_image_popup;
            }elseif($article->social_image==$photo->photopath){
                 $updatearray['social_image']='';
            }
            // print_r($updatearray); exit;
            DB::table('articles')
                    ->where('article_id', $photo->owner_id)
                    ->update($updatearray);
        } elseif ($photo->owned_by == 'quickbyte') {
            $photo->title = $imagetitlep;
            $photo->photo_by = $imagebyp;
            $photo->description = $descriptionp;
            $return = '
                                            <td width="20%">
                                                <img style="width:40%;" alt="user" src="' . config('constants.SiteBaseurl') . config('constants.awquickbytesimagethumbtdir') . $photo->photopath . '">
                                            </td>
                                            <td width="20%">' . $photo->title . '</td>
                                             <td width="30%" class="tdimagedesc">' . $photo->description . '</td>
                                            <td width="15%">' . $photo->photo_by . '</td>
                                    <input type="hidden" id="' . $photo->photo_id . '" name="deleteImagel">
                                    <td with="15%" class="center">
                                        <button class="btn btn-mini btn-danger" id="deleteImage" name="' . $photo->photo_id . '" onclick="$(this).MessageBox(' . $photo->photo_id . ')" type="button">Dump</button>
                                        <button class="btn btn-mini btn-edit" id="deleteImage" name="image' . $photo->photo_id . '" onclick="editImageDetail(' . $photo->photo_id . ',\'quickbyte\')" type="button">Edit</button>
                                        <img style="width:20%; display:block; margin-left:15px;display:none;" alt="loader" src="' . asset('images/photon/preloader/76.gif') . '"></td>
                                   ';

            DB::table('quickbyte')
                    ->where('id', $photo->owner_id)
                    ->update(['updated_at' => date('Y:m:d H:i:s')]);
        } elseif ($photo->owned_by == 'album') {
            $photo->title = $imagetitlep;
            $photo->photo_by = $imagebyp;
            $photo->description = $descriptionp;
            $photo->source = $photosourcep;
            $photo->source_url = $sourceurlp;
            $return = '
                                            <td width="20%">
                                                <img style="width:40%;" alt="album image" src="' . config('constants.SiteBaseurl') . config('constants.awalbumimagedir') . $photo->photopath . '">
                                            </td>
                                           <td width="20%">' . $photo->title . '</td>
                                             <td width="30%" class="tdimagedesc">' . $photo->description . '</td>
                                            <td width="15%">' . $photo->photo_by . '</td>
                                    <input type="hidden" id="' . $photo->photo_id . '" name="deleteImagel">
                                    <td with="15%" class="center">
                                        <button class="btn btn-mini btn-danger" id="deleteImage" name="' . $photo->photo_id . '" onclick="$(this).MessageBox(' . $photo->photo_id . ')" type="button">Dump</button>
                                        <button class="btn btn-mini btn-edit" id="deleteImage" name="image' . $photo->photo_id . '" onclick="editImageDetail(' . $photo->photo_id . ',\'album\')" type="button">Edit</button>
                                        <img style="width:20%; display:block; margin-left:15px;display:none;" alt="loader" src="' . asset('images/photon/preloader/76.gif') . '"></td>
                                    ';
            DB::table('album')
                    ->where('id', $photo->owner_id)
                    ->update(['updated_at' => date('Y:m:d H:i:s')]);
        }
        $photo->save();
        return $return;
        //print_r($request->all());
    }

    /*
     * Check if The User ID passed has Rights to Edit the Article
     *
     * passes User ID, Article ID, User Rights
     * @returns boolean 1:0
     */

    public function sortImage($id, Request $request) {

        foreach ($request->row as $k => $itm) {
            $articlePhoto = Photo::find($itm);
            $articlePhoto->sequence = $k + 1;
            $articlePhoto->updated_at = date('Y-m-d H:i:s');
            $articlePhoto->save();
        }

        DB::table('articles')
                ->where('id', $id)
                ->update(['updated_at' => date('Y:m:d H:i:s')]);
    }

    public function hasRightOnArticle($uid, $article_userid, $rights) {
        //$asd = fopen("/home/sudipta/log.log", 'a+');
        //fwrite($asd, " ONE :Has no right ::" . $uid . " user_id :" . $article_userid . " \n");

        $canAccess = 0;
        //Is the Author, Has user_id or Is EditArticle
        if (($uid == $article_userid)) {
            //Is the Owner of the Article - Continue
            $canAccess = 1;
            //fwrite($asd, " Has no right ::" . $uid . " user_id :" . $article_userid . " \n");
        } else {
            //echo '<pre>';
            //print_r($rights);
            $canAccess = 0;
            foreach ($rights as $right) {
                //Check if has right for Edit Article
                //fwrite($asd, "TWO Has no right ::" . $uid . " user_id :" . $right->label . " \n");
                if ($right->label == 'editArticle') { //echo 'passed';; exit;
                    //If has right - Continue
                    $canAccess = 1;
                    //fwrite($asd, " Has  ::" . $uid . " user_id :" . $article_userid . " \n");
                }
                /* else{
                  $canAccess = 0;
                  } */
            }
        }
        //fwrite($asd, " Return value ::" . $uid . " user_id :" . $canAccess . " \n");
        // fclose($asd);
        //echo $canAccess;exit;
        return $canAccess;
    }

    /*
     * Edit Article Display Proces
     *
     * @passes Article ID     *
     * @returns to Edit Article View
     *
     */

    public function show($id) {

        $uid = Session::get('users')->id;
        if (!($uid)) {
            return redirect('/auth/login');
        }
        $userTup = User::find($uid);
        if (!($article = Article::find($id))) {
            Session::flash('error', 'This Article ID not found in database.');
            return redirect('/article/list/new');
        }
        $addArticle = Article::find($id);
                DB::table('articles')
                    ->where('article_id', $id)
                    ->update(['locked_by' => $uid]);
        $rightId = 8;
        // $currentChannelId = $addArticle->channel_id;
        // $channels = $this->rightObj->getAllowedChannels($rightId);
        if (!$this->rightObj->checkRights($rightId))
            return redirect('/dashboard');
        $addArticle->locked_at = date('Y-m-d H:i:s');
        $addArticle->save();
        $photos = DB::table('photos')->where('valid', '1')
                ->where('owned_by', 'article')
                ->where('owner_id', $article->article_id)
                ->orderBy('sequence')
                ->get();

        $postAs = AuthorType::where('valid', '=', '1')->get();
        $newstype = DB::table('news_type')->where('valid', '1')->get();
        $tags = json_encode(DB::table('tags')
                        ->select('tags.tags_id as id', 'tags.tag as name')
                        ->join('article_tags', 'tags.tags_id', '=', 'article_tags.tags_id')
                        ->where('tags.valid', '1')
                        ->where('article_tags.valid', '1')
                        ->where('article_tags.article_id', $id)
                        ->get());
         if($article->author_type!=6){            
            $arrAuth = DB::table('articles')
                            ->join('authors', 'authors.author_id', '=', 'articles.author_id')
                            ->select('articles.author_id as id', 'authors.name')
                            ->where('articles.article_id', '=', $id)->get();
            //print_r($arrAuth); exit;
        }
        $authors=json_encode($arrAuth);
        $category = DB::table('category')->where('valid', '1')->where('parent_id','0')->orderBy('name')->get();
        $album = DB::table('album')->orderBy('id','desc')->get();
        $whatsup = DB::table('tbl_whatsapp_article')->select(DB::raw('count(id) as cn'),'publish_date','publish_time')->where('publish_date',date('Y-m-d'))->first();
         $timestamp = strtotime($whatsup->publish_time) + 60*60 + 60*60;
         $whtasuptime = date('H:i:s', $timestamp);
        //dd($article);
        return view('articles.edit', compact('article','authors', 'rights','album', 'postAs', 'newstype','tags','photos','category','userTup','whatsup','whtasuptime'));
    }

    public function getRights($uid, $parentId = 0) {
        //DB::enableQueryLog();
        $rights = DB::table('rights')
                ->join('user_rights', 'user_rights.rights_id', '=', 'rights.rights_id')
                ->where('user_rights.user_id', '=', $uid)
                ->where(function($rts) use ($parentId) {
                    $rts->where('rights.parent_id', '=', 0)->orwhere('rights.parent_id', '=', $parentId);
                })
                ->get();

//        $query = DB::getQueryLog();
//        $lastQuery = end($query);
//        print_r($lastQuery);
//        
        // echo count($rights);exit;
        return $rights;
    }

    /*generate newslatr*/
    
    /*generate news*/

    public function create() {
        
        if (!Session::has('users')) {
            return redirect()->intended('/auth/login');
        }
        $uid = Session::get('users')->id;
        /* Right mgmt start */
        $rightId = 2;
        // $currentChannelId = $this->rightObj->getCurrnetChannelId($rightId);
        // $channels = $this->rightObj->getAllowedChannels($rightId);
        if (!$this->rightObj->checkRights($rightId))
            return redirect('/dashboard');
        /* Right mgmt end */
        $postAs = AuthorType::where('valid', '=', '1')->orderBy('label')->get();
        $p1 = DB::table('author_type')->where('valid', '1')->pluck('label', 'author_type_id');
        //$country = Country::where('valid', '=', '1')->get();
        //$states = State::where('valid', '=', '1')->orderBy('name')->get();
        $newstype = DB::table('news_type')->where('valid', '1')->get();
        $category = DB::table('category')->where('valid', '1')->where('parent_id','0')->orderBy('name')->get();
        $album = DB::table('album')->orderBy('id','desc')->get();
         $whatsup = DB::table('tbl_whatsapp_article')->select(DB::raw('count(id) as cn'),'publish_date','publish_time')->where('publish_date',date('Y-m-d'))->first();
         $timestamp = strtotime($whatsup->publish_time) + 60*60 + 60*60;
         $whtasuptime = date('H:i:s', $timestamp);
        //$campaign = DB::table('campaign')->where('channel_id', $currentChannelId)->where('valid', '1')->get();
        return view('articles.create', compact('channels', 'p1','album', 'postAs', 'country', 'states', 'newstype', 'category', 'event', 'campaign', 'tags', 'currentChannelId','whatsup','whtasuptime'));
    }

    /*
     * Any Update after First Save
     *
     */

    public function update(Request $request) {
        
        if (!Session::has('users')) {
            return redirect()->intended('/auth/login');
        }
        DB::table('articles')
            ->where('article_id', $request->id)
            ->update(['locked_by' => null,'locked_at'=>null]);
        /* Right mgmt start */
        $rightId = 8;
        if (!$this->rightObj->checkRights($rightId))
            return redirect('cms/dashboard');
        if ($request->status != 'P') {
           $check = Article::where([['slug',$request->url],['article_id','!=',$request->id]])->first();
            if (empty($check) == false) {
                Session::flash('message', 'Slug Already Exist.');
                return redirect()->back()->with('message', 'Slug Already Exist.');
            }
        }
       
            if ($request->get('rimage')) {
            foreach ($request->get('rimage') as $key => $value) {
                $oldPhoto = Photo::find($key);
                $articleImage = new Photo();
                $articleImage->photopath = $oldPhoto->photopath;
                $articleImage->photo_by = $value;
                $articleImage->title = isset($request->rtitle[$key]) ? $request->rtitle[$key] : '';
                // $articleImage->channel_id = $request->channel_sel;
                $articleImage->owned_by = 'article';
                $articleImage->owner_id = $request->id;
                $articleImage->active = '1';
                $articleImage->created_at = date('Y-m-d H:i:s');
                $articleImage->updated_at = date('Y-m-d H:i:s');
                $articleImage->save();
            }
        }
        $images = explode(',', $request->uploadedImages);
        $images = array_filter($images);
        if (count($images) == 0) {
            $photosCount = DB::table('photos')->where('valid', '1')
                    ->where('owned_by', 'article')
                    ->where('owner_id', $request->id)
                    ->count();
            if (($photosCount == 0) && (trim($request->video_Id) != '') && (trim($request->video_Id) != '0')) {
                $selectedvideo = MasterVideo::find($request->video_Id);
                if ($selectedvideo->video_by == 'inhouse') {
                    $source = config('constants.SiteBaseurl') . config('constants.awvideothumb') . urlencode($selectedvideo->video_thumb_name);
                    $dest = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $selectedvideo->video_thumb_name;
                    if (copy($source, $dest)) {
                        $images[] = $selectedvideo->video_thumb_name;
                    }
                }
            }
        }
        $fileTran=new FileTransfer();
        if ($request->related_image_search == null) {
        foreach ($images as $image){ 
                $articleImage = new Photo();
                $articleImage->photopath = $image;
                $articleImage->imagefullPath = '';
                $articleImage->photo_by = isset($request->photographby[$image]) ? $request->photographby[$image] : '';
                $articleImage->title = isset($request->imagetitle[$image]) ? $request->imagetitle[$image] : '';
                $articleImage->owned_by = 'article';
                $articleImage->owner_id = $request->id;
                $articleImage->active = '1';
                $articleImage->created_at = date('Y-m-d H:i:s');
                $articleImage->updated_at = date('Y-m-d H:i:s');
                $articleImage->save();
				Storage::disk('gcs')->put(
				$image,
				file_get_contents(config('constants.UploadImg').$image),
				\Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
				);
} 
}
$innerImage = Storage::disk('publicPath')->allFiles();
            foreach ($innerImage as $key => $value) {
                Storage::disk('gcs')->put($value,file_get_contents(config('constants.EditorImg').$value),
                    \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
                    );
            }
        /* Right mgmt end */
        $uid = $request->user()->id;
        $articlecatname = DB::table('category')->select('e_name','name')->where('category_id', $request->category1)->get();
        $arrcatname = strtolower($articlecatname[0]->e_name);
        $hindicatname = strtolower($articlecatname[0]->name);
        $article = Article::find($request->id);
        $oldAuthorType=$article->author_type;
        // $article->channel_id = $request->channel_sel;
        $article->category_id = $request->category1;
        $article->author_type = $request->authortype;
        $article->album_id = $request->albumid;
        $article->is_columnist = $article->author_type == '4' ? 1 : 0;
        $article->title = $request->title;
        $article->author_id = $request->author != '' ? $request->author:1;
        $article->pr_name = $request->pname;
        $article->pr_email = $request->pemail;
        $article->pr_number = $request->pmobile;
        if ($request->status == 'P' || $request->status == 'SD') {
              $article->slug = $request->url;
                $articletitle = str_slug($request->url);
                $customurl = config('constants.SiteBaseurl').$arrcatname.'-news/'.$articletitle.'-'.$request->id.'.html';
                $article->url = $customurl;  
        }else{
                
                $article->slug = $request->url;
                $article->url = $request->url;
        }
        
        $title = $request->title;
        $article->summary = $request->summary;
        $description = $request->description;
        $search = "/cms/kcfinder/upload/images/";
        $replace = config('constants.SiteCmsurl');
        $content = str_replace($search,$replace,$description);
        $article->description = $content;
        $article->news_type = $request->newstype? $request->newstype : 1;
        $article->hide_image = $request->hide_image ? 1 : 0;
        $article->is_pinned = $request->pinit ? 1 : 0;
        // if ($request->status == 'N') {
        //     $article->url =  config('constants.SiteBaseurl').$arrcatname.'-news'.'/'.$articletitle.'-'.$request->id.'.html';
        //     $article->for_homepage = 1;
        //     $article->publish_time = date("H:i:s", mktime(0, 0, 0));
        // } else {
        //     $article->for_homepage = $request->for_homepage ? 1 : 0;
        // }
        if ($request->important=='e') {
        $article->important = 1;
        $article->web_exclusive =0;
        }elseif($request->important=='f'){
        $article->important = 0;
        $article->web_exclusive =1;
        }else{
        $article->important = 0;
        $article->web_exclusive =0;
        }
       
        //echo $request->status;exit;
        if ($request->status != 'SV'){
            
            $article->status = $request->status;
        }
        
        //Only for Schedule Article Action
        if ($request->status == 'SD') {
            $article->url = $customurl;
            $article->publish_date = trim($request->datepicked) ? $request->datepicked : date('Y-m-d');
            $article->publish_time = trim($request->timepicked) ? $request->timepicked : date('H:i:s');
           
        } elseif ($request->status == 'P') {
               $images = explode(',', $request->uploadedImages);
                if (empty($images[0])) {
                    $photoimg = $request->uploadedimg;
                    $phototitle = $request->uploadedtitle;
                }else{
                    $photoimg = $request->uploadedImages;
                    $phototitle = isset($request->imagetitle[$request->uploadedImages]) ? $request->imagetitle[$request->uploadedImages] : '';
                }

                if ($request->important=='f') {
                    
                DB::delete('delete from article_feature where sequence >= 10');
                $articlef = new ArticleF();
                $articlef->story_key_id = $request->id;
                $articlef->title = $request->title;
                $article->url = $customurl;
                $articlef->photopath = $request->photoimg;
                $articlef->phototitle = $request->phototitle;
                $articlef->category_hname = $hindicatname;
                $articlef->category_ename = $arrcatname;
                $articlef->sequence = '0';
                $articlef->story_type = 'article';
                $articlef->publish_date = date('Y-m-d H:i:s');
                $articlef->created_at = date('Y-m-d H:i:s');
                $articlef->updated_at = date('Y-m-d H:i:s');
                $articlef->save();
                Cache::forget('homeSlide');
               
            }elseif($request->important=='e') {
            $article->important = 1;
            $article->web_exclusive =0;
            }else{
            $article->important = 0;
            $article->web_exclusive =0;
            }
            $article->publish_date = date('Y-m-d');
            $article->publish_time = date('H:i:s');
            $this->sendmail($title,$request->id,$customurl,$request->summary,$photoimg);
             if($request->post_fb) {
            $this->sendfb($request->url,$message);
            }
            if($request->post_tw) {
            $this->sendtwiter($message,$customurl);
            }
            if ($request->pemail) {
             $images = explode(',', $request->uploadedImages);
                if (empty($images[0])) {
                    $photoimg = $request->uploadedimg;
                    $phototitle = $request->uploadedtitle;
                }else{
                    $photoimg = $request->uploadedImages;
                    $phototitle = isset($request->imagetitle[$request->uploadedImages]) ? $request->imagetitle[$request->uploadedImages] : '';
                }
            $pemail = explode(',', $request->pemail);
            $pemail = array_unique($pemail);
            $pname = explode(',', $request->pname);
            $pname = array_unique($pname);
            foreach (array_combine($pname, $pemail) as $key => $to) {
                $this->sendmailtopr($title,$request->id,$customurl,$to,$key,$article->summary,$photoimg);
            }
        }
        
/*after first time publish*/
        $key = md5(date('dmY') . 'samachar4media');
            $url= config('constants.SiteBaseurl').'/rss/article/'. $request->id.'?key='. $key;
            $url1=config('constants.SiteBaseurl').'/rss/category/'.$request->category1.'?key=' . $key.'<br>';
            $url2= config('constants.SiteBaseurl').'rss/all-sitemap.xml?key='. $key;
            $url3= config('constants.SiteBaseurl').'rss/sitemap-date/'.date('Y-m-d').'?key='. $key;
            $url4= config('constants.SiteBaseurl').'rss/google-news-sitemap?key=' . $key;
            $data = array($url,$url1,$url2,$url3,$url4);
            $this->multiRequest($data);
            if ($request->status == 'P' || $request->status == 'SD') {
            $this->reload(config('constants.SiteBaseurl').$arrcatname.'-news/'.$articletitle.'-'.$request->id.'.html');
            }else{
                $this->reload($request->url);
            }
        }
        if ($request->status == 'SV'){
            $article->publish_date = $request->datepicked;
            $article->publish_time = $request->timepicked;
         }
        $article->update();
        $this->updatedescads($article->article_id,$article->description);
        if($request->post_whatsup) {
        $this->callnewapi($customurl);
        DB::table('tbl_whatsapp_article')->insert(
        ['article_id' => $article->article_id, 'user_id' =>$uid,'publish_date' =>date('Y-m-d'),'publish_time' =>date('H:i:s')]
        );
        }
        $this->forget($article->article_id);
        $file = new Filesystem;
        $directory= public_path().'/cms/kcfinder/upload/images/';
        $file->cleanDirectory($directory);  
        $id = $request->id;
        if ($article->status =='P') {
                if ($request->important=='f') {
                $images = explode(',', $request->uploadedImages);
                if (empty($images[0])) {
                    $photoimg = $request->uploadedimg;
                    $phototitle = $request->uploadedtitle;
                }else{
                    $photoimg = $request->uploadedImages;
                    $phototitle = isset($request->imagetitle[$request->uploadedImages]) ? $request->imagetitle[$request->uploadedImages] : '';
                }
                //dd($photoimg);
                $article->important = 0;
                $article->web_exclusive =1;
                $articled = ArticleF::where('story_key_id',$request->id)->get(); 
                if (count($articled) > 0) {
                    
                DB::table('article_feature')
                ->where('story_key_id', $request->id)
                ->update(['title' => $request->title,'url'=>$request->url,'photopath'=>$photoimg,'phototitle'=>$phototitle]);
                }else{
                    
                    DB::delete('delete from article_feature where sequence >= 10');
                $articlef = new ArticleF();
                $articlef->story_key_id = $request->id;
                $articlef->title = $request->title;
                $articlef->url = $request->url;
                $articlef->photopath = $photoimg;
                $articlef->phototitle = $phototitle;
                $articlef->category_hname = $hindicatname;
                $articlef->category_ename = $arrcatname;
                $articlef->sequence = '0';
                $articlef->story_type = 'article';
                $articlef->publish_date = $article->publish_date.' '.$article->publish_time;
                $articlef->created_at = date('Y-m-d H:i:s');
                $articlef->updated_at = date('Y-m-d H:i:s');
                $articlef->save();
                Cache::forget('homeSlide');
                
                }
        }elseif($request->important=='e') {
           $article->important = 1;
           $article->web_exclusive =0;
        }else{
			$article->important = 0;
			$article->web_exclusive =0;
        }
            $key = md5(date('dmY') . 'samachar4media');
            $url= config('constants.SiteBaseurl').'/rss/article/'. $request->id.'?key='. $key;
            $url1=config('constants.SiteBaseurl').'/rss/category/'.$request->category1.'?key=' . $key.'<br>';
            $url2= config('constants.SiteBaseurl').'rss/all-sitemap.xml?key='. $key;
            $url3= config('constants.SiteBaseurl').'rss/sitemap-date/'.date('Y-m-d').'?key='. $key;
            $url4= config('constants.SiteBaseurl').'rss/google-news-sitemap?key=' . $key;
            $data = array($url,$url1,$url2,$url3,$url4);
            $this->multiRequest($data);
            $this->reload($request->url);
        }
        $arrExistingTags = DB::table('article_tags')->where('article_id', '=', $id)->get();
        //fwrite($asd, " Tags count found : ".count($arrExistingTags)."  \n");
        if (count($arrExistingTags) > 0) {
            foreach ($arrExistingTags as $eachTag) {
                //fwrite($asd, " Each Tag Being Deleted : ".$eachTag->a_tags_id."  \n");
                $delTag = ArticleTag::find($eachTag->a_tags_id);
                $delTag->delete();
            }
        }
        //Add New Tags
        if ($request->Taglist) {
            //echo $request->Taglist;exit;
            $articleids = explode(',', $request->Taglist);
            $articleids = array_unique($articleids);
            foreach ($articleids as $key => $value) {
                $article_tags = new ArticleTag();
                $article_tags->article_id = $id;
                $article_tags->tags_id = $value;
                $article_tags->save();
            }
        }

        if ($request->status == 'P') {
                $EventLogController = new EventLogController;
                $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'publish_article','description'=>'Published Article','article_id'=>$request->id]);
                Cache::forget($arrcatname);
                Session::flash('message', 'Your Article has been Published successfully. It will appear on website shortly.');
                return redirect('/article/list/published');
        }
        
        if($article->status == 'N') {
        $EventLogController = new EventLogController;
        $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'save_article','description'=>'Saved Article','article_id'=>$request->id]);
        Session::flash('message', 'Your Article has been Saved successfully.');
        return redirect('/article/list/new');
        }elseif($article->status == 'P') {
        $EventLogController = new EventLogController;
        $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'save_article','description'=>'Saved Article','article_id'=>$request->id]);
        Cache::forget($arrcatname);
        Session::flash('message', 'Your Article has been Saved successfully.');
        return redirect('/article/list/published');
        } elseif ($article->status == 'D') {
           // $delarrf = ArticleF::find($request->id);
            //$delarrf->delete();
            $key = md5(date('dmY') . 'samachar4media');
            $url= config('constants.SiteBaseurl').'/rss/article/'. $request->id.'?key='. $key;
            $url1=config('constants.SiteBaseurl').'/rss/category/'.$request->category1.'?key=' . $key.'<br>';
            $url2= config('constants.SiteBaseurl').'rss/all-sitemap.xml?key='. $key;
            $url3= config('constants.SiteBaseurl').'rss/sitemap-date/'.date('Y-m-d').'?key='. $key;
             $url4= config('constants.SiteBaseurl').'rss/google-news-sitemap?key=' . $key;
            $data = array($url,$url1,$url2,$url3,$url4);
            $this->multiRequest($data);
            $this->forget($request->id);

        $EventLogController = new EventLogController;
        $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'delete_article','description'=>'Deleted Article','article_id'=>$request->id]);
        Cache::forget($arrcatname);
        Cache::forget('homeSlide');
        Session::flash('message', 'Your Article has been Deleted successfully.');
        return redirect('/article/list/deleted');
        } elseif ($article->status == 'SD') {
        $EventLogController = new EventLogController;
        $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'schedule_article','description'=>'Scheduled Article','article_id'=>$request->id]);
        Session::flash('message', 'Your Article has been Scheduled successfully.');
        return redirect('/article/list/scheduled');
        } else {
        $EventLogController = new EventLogController;
        $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'draft_article','description'=>'saved in draft','article_id'=>$request->id]);
        Cache::forget($arrcatname);
        Session::flash('message', 'Your Article has been saved in your draft successfully.');
        return redirect('/article/list/drafts');
        }
        //return Redirect::to('/dashboard');
        //return view('/dashboard');
    }
      /*first time create story article*/
    public function store(Request $request) {
        
        if (!Session::has('users')) {
            return redirect()->intended('/auth/login');
        }
        
        $rightId = 2;
        // $currentChannelId = $request->channel_sel;
        if (!$this->rightObj->checkRights($rightId))
            return redirect('cms/dashboard');
        if ($request->status == 'S') {
            $validator = Validator::make($request->all(), [
            'title' => 'required|unique:articles',          
            ]);
            if ($validator->fails()) {
                return redirect('article/create')
                            ->withErrors($validator)
                            ->withInput();
            }
        }else{
            $validator = Validator::make($request->all(), [
            'title' => 'required|unique:articles',
            'slug' => 'required|unique:articles',            
            ]);
            if ($validator->fails()) {
                return redirect('article/create')
                            ->withErrors($validator)
                            ->withInput();
            }
        }
        
        $uid = $request->user()->id;

        $articlelastid = DB::table('articles')->select('article_id')->orderby('article_id','desc')->limit(1)->get();
        $artid = $articlelastid[0]->article_id+1;
        $articlecatname = DB::table('category')->select('e_name','name')->where('category_id', $request->category1)->get();
        $arrcatname = strtolower($articlecatname[0]->e_name);
        $hindicatname = strtolower($articlecatname[0]->name);
         
        DB::beginTransaction();
        try {
            $article = new Article();
            // $article->channel_id = $request->channel_sel;
            $article->user_id = $uid;
            $article->author_type = $request->authortype;
            $article->album_id = $request->albumid;
            $article->is_columnist = $article->author_type == '4' ? 1 : 0;
            $article->title = $request->title;
            $article->pr_name = $request->pname;
            $article->pr_email = $request->pemail;
            $article->pr_number = $request->pmobile;
            $title = $request->title;            
            $article->summary = $request->summary;
            $description = $request->description;
            if ($request->status == 'P' || $request->status == 'SD') {
              $article->slug = $request->slug;
                $articletitle = str_slug($request->slug);
                $customurl = config('constants.SiteBaseurl').$arrcatname.'-news/'.$articletitle.'-'.$artid.'.html';
                $article->url = $customurl;  
            }else{
                    
                    $article->slug = str_slug($request->slug);
                    $article->url = str_slug($request->slug);
            }
            
            $search = "/cms/kcfinder/upload/images/";
            $replace = config('constants.SiteCmsurl');
            $content = str_replace($search,$replace,$description);
            $article->description = $content;
            $article->news_type = $request->newstype? $request->newstype : 1;
            $article->priority = 0;
            $article->category_id = $request->category1;
            $article->author_id = $request->author != '' ? $request->author:1;
            $images = explode(',', $request->uploadedImages);
            $images = array_filter($images);

            if (count($images) == 0) {
                $photosCount = DB::table('photos')->where('valid', '1')
                        ->where('owned_by', 'article')
                        ->where('owner_id', $article->article_id)
                        ->count();
                if (($photosCount == 0) && (trim($request->video_Id) != '') && (trim($request->video_Id) != '0')) {
                    $selectedvideo = MasterVideo::find($request->video_Id);
                    if ($selectedvideo->video_by == 'inhouse') {
                        $source = config('constants.SiteBaseurl') . config('constants.awvideothumb') . urlencode($selectedvideo->video_thumb_name);
                        $dest = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $selectedvideo->video_thumb_name;
                        if (copy($source, $dest)) {
                            $images[] = $selectedvideo->video_thumb_name;
                        }
                    }
                }
            }

            $fileTran=new FileTransfer();
            if ($request->related_image_search == null) {
            foreach ($images as $image){ 
                try{
                    $articleImage = new Photo();
                    $articleImage->photopath = $image;
                    $articleImage->imagefullPath = '';
                    $articleImage->photo_by = isset($request->photographby[$image]) ? $request->photographby[$image] : '';
                    $articleImage->title = isset($request->imagetitle[$image]) ? $request->imagetitle[$image] : '';
                    $articleImage->owned_by = 'article';
                    $articleImage->owner_id = $artid;
                    $articleImage->active = '1';
                    $articleImage->created_at = date('Y-m-d H:i:s');
                    $articleImage->updated_at = date('Y-m-d H:i:s');
                    $articleImage->save();
                    Storage::disk('gcs')->put(
                    $image,
                    file_get_contents(config('constants.UploadImg').$image),
                    \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
                    );
                
                    }catch(ValidationException $e){
                    return Redirect::to('article/create')
                    ->withErrors( $e->getErrors() )
                    ->withInput();
                    }catch(\Exception $e)
                    {
                        DB::rollback();
                        throw $e;
                    }
            }
        }
            if ($request->get('rimage')) {
                foreach ($request->get('rimage') as $key => $value) {
                    $oldPhoto = Photo::find($key);
                    try{
                    $articleImage = new Photo();
                    $articleImage->photopath = $oldPhoto->photopath;
                    $articleImage->photo_by = $value;
                    $articleImage->title = isset($request->rtitle[$key]) ? $request->rtitle[$key] : '';
                    // $articleImage->channel_id = $request->channel_sel;
                    $articleImage->owned_by = 'article';
                    $articleImage->owner_id = $artid;
                    $articleImage->active = '1';
                    $articleImage->created_at = date('Y-m-d H:i:s');
                    $articleImage->updated_at = date('Y-m-d H:i:s');
                    $articleImage->save();
                    }catch(ValidationException $e){
                    return Redirect::to('article/create')
                    ->withErrors( $e->getErrors() )
                    ->withInput();
                    }catch(\Exception $e)
                    {
                        DB::rollback();
                        throw $e;
                    }
                }
            }
            $innerImage = Storage::disk('publicPath')->allFiles();

            foreach ($innerImage as $key => $value) {
            	Storage::disk('gcs')->put($value,file_get_contents(config('constants.EditorImg').$value),
                    \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
                    );
            }
        
            if ($request->important=='e') {
                $article->important = 1;
                $article->web_exclusive =0;
            }elseif($request->important=='f'){
                $article->important = 0;
                $article->web_exclusive =1;
            }else{
                $article->important = 0;
                $article->web_exclusive =0;
            }
                $article->is_pinned = $request->pinit ? 1 : 0;
                $article->status = $request->status;
            if ($request->status == 'N') {
                $article->for_homepage = 1;
                $article->publish_date = date('Y-m-d');
                $article->publish_time = date('H:i:s');
            } else {
                $article->publish_date = date('Y-m-d');
                $article->publish_time = date('H:i:s');
                $article->for_homepage = $request->for_homepage ? 1 : 0;
            }
            if ($request->status == 'SD') {
                $article->publish_date = trim($request->datepicked) ? $request->datepicked : date('Y-m-d');
                $article->publish_time = trim($request->timepicked) ? $request->timepicked : date('H:i:s');
            } elseif ($request->status == 'P') {
                    $images = explode(',', $request->uploadedImages);
                    if (empty($images[0])) {
                    $photoimg = $request->uploadedimg;
                    $phototitle = $request->uploadedtitle;
                    }else{
                    $photoimg = $request->uploadedImages;
                    $phototitle = isset($request->imagetitle[$request->uploadedImages]) ? $request->imagetitle[$request->uploadedImages] : '';
                    }
                if ($request->important=='f') {
                    DB::delete('delete from article_feature where sequence >= 10');
                    $articlef = new ArticleF();
                    $articlef->story_key_id = $artid;
                    $articlef->title = $request->title;
                    $articlef->url = config('constants.SiteBaseurl').$arrcatname.'-news/'.$articletitle.'-'.$artid.'.html';
                    $articlef->photopath = $request->uploadedImages;
                    $articlef->phototitle = isset($request->imagetitle) ? $request->imagetitle[$request->uploadedImages] : '';
                    $articlef->category_hname = $hindicatname;
                    $articlef->category_ename = $arrcatname;
                    $articlef->sequence = '0';
                    $articlef->story_type = 'article';
                    $articlef->publish_date = date('Y-m-d H:i:s');
                    $articlef->created_at = date('Y-m-d H:i:s');
                    $articlef->updated_at = date('Y-m-d H:i:s');
                    $articlef->save();
                    Cache::forget('homeSlide');
            }
                $article->publish_date = date('Y-m-d');
                $article->publish_time = date('H:i:s');

                $this->sendmail($title,$artid,config('constants.SiteBaseurl').$arrcatname.'-news/'.$articletitle.'-'.$artid.'.html',$request->summary,$request->uploadedImages);
                if ($request->pemail) {
                    $pemail = explode(',', $request->pemail);
                    $pemail = array_unique($pemail);
                    $pname = explode(',', $request->pname);
                    $pname = array_unique($pname);
                    foreach (array_combine($pname, $pemail) as $key => $to) {
                    $this->sendmailtopr($title,$artid,config('constants.SiteBaseurl').$arrcatname.'-news/'.$articletitle.'-'.$artid.'.html',$to,$key,$request->summary,$request->uploadedImages);
                    }
            } 
                if($request->post_fb) {
                $this->sendfb(config('constants.SiteBaseurl').$arrcatname.'-news/'.$articletitle.'-'.$artid.'.html',$title);
                }
                if($request->post_tw) {
                    $url = config('constants.SiteBaseurl').$arrcatname.'-news/'.$articletitle.'-'.$artid.'.html';
                $this->sendtwiter($title,$url);
                }
            }
            $article->save();
            $this->updatedescads($article->article_id,$article->description);
        }catch(ValidationException $e){
            return Redirect::to('article/create')
            ->withErrors( $e->getErrors() )
            ->withInput();
        }catch(\Exception $e)
        {
            DB::rollback();
            throw $e;
        }
        DB::commit();

        // $createUrlAfterSave = config('constants.SiteBaseurl').$arrcatname.'/'.$articletitle.'-'.$article->article_id.'.html';
        // $urlupdate = Article::where('article_id',$article->article_id)->update(['url' => $createUrlAfterSave]);
          if($request->post_whatsup) {
            $this->callnewapi(config('constants.SiteBaseurl').$arrcatname.'-news/'.$articletitle.'-'.$artid.'.html');
            DB::table('tbl_whatsapp_article')->insert(
                    ['article_id' => $article->article_id, 'user_id' =>$uid,'publish_date' =>date('Y-m-d'),'publish_time' =>date('H:i:s')]
                    );
            }

        $file = new Filesystem;
        $directory= public_path().'/cms/kcfinder/upload/images/';
        $file->cleanDirectory($directory);
        $id = $article->article_id;
        //Article Tags - Save
        if ($request->Taglist) {
            $articleids = explode(',', $request->Taglist);
            $articleids = array_unique($articleids);
            foreach ($articleids as $key => $value) {
                $article_tags = new ArticleTag();
                $article_tags->article_id = $id;
                $article_tags->tags_id = $value;
                $article_tags->save();
            }
        }

        if($request->status == 'P') {
             /*direct publish*/
            $key = md5(date('dmY') . 'samachar4media');
            $url= config('constants.SiteBaseurl').'rss/article/'.$artid.'?key='. $key;
            $url1=config('constants.SiteBaseurl').'rss/category/'.$request->category1.'?key=' . $key.'<br>';
            $url2= config('constants.SiteBaseurl').'rss/all-sitemap.xml?key='. $key;
            $url3= config('constants.SiteBaseurl').'rss/sitemap-date/'.date('Y-m-d').'?key='. $key;
             $url4= config('constants.SiteBaseurl').'rss/google-news-sitemap?key=' . $key;
            $dataarray = array($url,$url1,$url2,$url3,$url4);
            $this->multiRequest($dataarray);
            $this->reload(config('constants.SiteBaseurl').$arrcatname.'-news/'.$articletitle.'-'.$artid.'.html');

            $EventLogController = new EventLogController;
            $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'publish_article','description'=>'Published Article','article_id'=>$article->article_id]);
            if($request->post_fb == 'fbpost') {
            $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'post_on_facebook','description'=>'Posted On Facebook','article_id'=>$article->article_id]);
            }
            if($request->post_tw == 'twpost') {
            $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'post_on_Twitter','description'=>'Posted On Twitter','article_id'=>$article->article_id]);
            }
            Cache::forget($arrcatname);
            Session::flash('message', 'Your Article has been Published successfully. It will appear on website shortly.');
            Session::flash('message1', 'Your Article has been Published successfully. It will appear on website shortly And Posted On Social Media Plateform.');
            return redirect('/article/list/published');
             
        }
         /*end direct publish from create article by editor and admin*/
        if ($request->status == 'N') {
              $EventLogController = new EventLogController;
            $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'create_article','description'=>'Created Article','article_id'=>$article->article_id]);
            Session::flash('message', 'Your Article has been Saved successfully.');
            return redirect('/article/list/new');
        }
        if ($request->status == 'D') {
            $EventLogController = new EventLogController;
            $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'delete_article','description'=>'Deleted Article','article_id'=>$article->article_id]);
            Session::flash('message', 'Your Article has been Deleted successfully.');
            Cache::forget($arrcatname);
            return redirect('/article/list/deleted');
        }
        if ($request->status == 'S') {
             $EventLogController = new EventLogController;
            $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'draft_article','description'=>'saved in Drafts','article_id'=>$article->article_id]);
            Session::flash('message', 'Your Article has been saved successfully in - My Drafts.');
            return redirect('/article/list/drafts');
        }
        if ($article->status == 'SD') {
            $EventLogController = new EventLogController;
            $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'schedule_article','description'=>'Scheduled Article','article_id'=>$article->article_id]);
            Session::flash('message', 'Your Article has been Scheduled successfully.');
            return redirect('/article/list/scheduled');
        }

        return redirect('/article/list/new');

        //return redirect('/dashboard');
        //return Redirect::to('/dashboard');
        //return view('/dashboard');
    }

    /**
     * Adding Author Details to Author Table by Author Controller
     *
     * @param Request $request
     * @internal param $data
     */
    public function postAuthor() {
        $data = Request;
        //Add Author fields sent to Author Table
        //AuthorsController->AuthorsController::store($request);
        $p = sizeof($data);
        //  $p = $data;
        //print_r($_POST);
        //$l = fopen('/home/sudipta/check.log','w+');
        //fwrite($l," SIZEOF ".$p);
        //Author::create($request);
        //AuthorsController->store($request);
        return;
    }

    public function destroy() {

        if (!Session::has('users')) {
            return 'Please login first.';
        }
        $id = Session::get('users');
        $uid = $id->id;

        /* Right mgmt start */
        $rightId = 13;

        // $currentChannelId = $this->rightObj->getCurrnetChannelId($rightId);
        // $channels = $this->rightObj->getAllowedChannels($rightId);
        if (!$this->rightObj->checkRights($rightId)) {
            return 'You are not authorized to access';
        }
        /* Right mgmt end */

        if (isset($_POST['option'])) {
            $newsid = $_POST['option'];
        }
        $delArr = explode(',', $newsid);

        //fwrite($asd, " Del Arr Count: ".count($delArr)." \n\n");
        
        foreach ($delArr as $d) {
            //fwrite($asd, " Delete Id : ".$d." \n\n");
            $deleteAl = Article::find($d);

            if ($deleteAl->status != 'S') {
                $deleteAl->status = 'D';
                $deleteAl->status = ' ';
                  $EventLogController = new EventLogController;
                $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'delete_article','description'=>'delete article by user','article_id'=>$deleteAl->article_id]);
                $deleteAl->save();
                //return $deleteAl->status;
            } else {
                // Delete releted content before deleting article. 
                $deleteAl->delete();
                 //return 'NO';
            }
        }
        Artisan::call('cache:clear');
        return 'success';
    }


    public function destroyfeaturenews() {
        if (!Session::has('users')) {
            return 'Please login first.';
        }
        $id = Session::get('users');
        $uid = $id->id;
        /* Right mgmt start */
        $rightId = 13;
        // $currentChannelId = $this->rightObj->getCurrnetChannelId($rightId);
        // $channels = $this->rightObj->getAllowedChannels($rightId);
        if (!$this->rightObj->checkRights($rightId)) {
            return 'You are not authorized to access';
        }
        /* Right mgmt end */
        if (isset($_GET['option'])) {
            $id = $_GET['option'];
        }
        $delArr = explode(',', $id);
        
        foreach ($delArr as $d) {
        DB::table('article_feature')->where('story_key_id',$d)->delete();
        DB::table('articles')->where('article_id',$d)->update(['web_exclusive'=>0]);
        }
        Cache::forget('homeSlide');
        Artisan::call('cache:clear');
        return 'success';
    }

    public function publishBulk() {

        if (!Session::has('users')) {
            return 'Please login first.';
        }
        $id = Session::get('users');
        $uid = $id->id;
        /* Right mgmt start */
        $rightId = 12;
        // $currentChannelId = $this->rightObj->getCurrnetChannelId($rightId);
        // $channels = $this->rightObj->getAllowedChannels($rightId);
        if (!$this->rightObj->checkRights($rightId))
            return 'You are not authorized to access';
        /* Right mgmt end */
        if (isset($_GET['option'])) {
            $id = $_GET['option'];
        }
        $delArr = explode(',', $id);
        
        //fwrite($asd, " Del Arr Count: ".count($delArr)." \n\n");
        foreach ($delArr as $d) {
            //fwrite($asd, " Delete Id : ".$d." \n\n");
            $deleteAl = Article::find($d);

            $deletephoto = Photo::where('owner_id',$d)->first();
            
             $url = $deleteAl->url;
             $title = $deleteAl->title;
            $deleteAl->status = 'P';
             $EventLogController = new EventLogController;
            $EventLogController->eventstore(['userid'=>$uid,'event_type'=>'publish_article','description'=>'publish new article','article_id'=>$deleteAl->article_id]);
            $deleteAl->publish_date = date('Y-m-d');
            $deleteAl->publish_time = date('H:i:s');
            
            $deleteAl->save();
            $this->sendmail($title,$d,$url,$deleteAl->summary,$deletephoto->photopath);
               
               
        }
        $this->forget('1');
        return 'success';
    }

   /* public function publishScheduledArticle() {
        $articles = DB::table('articles')
                ->where('status', 'SD')
                ->where('publish_date', '<=', date('Y-m-d'))
                ->where('publish_time', '<=', date('H:i:s'))
                ->get();
        echo count($articles);exit;
        foreach ($articles as $article) {
            $updatearticle = Article::find($article->article_id);
            $updatearticle->status = 'P';
            $updatearticle->update();
        }
        return 'success';
    }*/
    function relatedImage(Request $request) {
               $total = 25;
                $imagequery = "select photo_id,photopath,photo_by,title from photos where valid='1' and photopath!='' and owned_by='article' AND photopath like '%" . $request->search_key . " %' or title like '%" . $request->search_key . "%' order by updated_at desc limit " . $total;
                $images = DB::select($imagequery);
                foreach ($images as $image) {
                    $imgids[] = $image->photo_id;
                    $related_images[] = array('image_url' => config('constants.SiteCmsurl'). $image->photopath, 'image_id' => $image->photo_id, 'photo_by' => $image->photo_by, 'image_name' => $image->photopath, 'title' => $image->title,'tag_name' => $image->title);
                }
        return json_encode($related_images);
    }

    public static function compareByCount($a, $b) {
        return strcmp($a->cs, $b->cs);
    }

    public function dropzoneUploadFile(Request $request){
        $imageName = $request->file->getClientOriginalName();
        $request->file->move(public_path('files\thumbnail'), $imageName);
        return response()->json(['success'=>$imageName]);
    }


    public function deleteUnusedImages()
{
    $file_types = array(
        'gif',
        'jpg',
        'jpeg',
        'png'
    );
    $directory = public_path().'/files';
    $files = File::allFiles($directory);

    foreach ($files as $file)
    {
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (in_array($ext, $file_types)) {

            if(DB::table('photos')->where('photopath', '=', $file)->count())
                continue; // continue if the picture is in use

            echo 'removed' . basename($file)."<br />";
            unlink($file); // delete if picture isn't in use
        }
    }
}
 public function sortarticle(Request $request) {
            DB::table('articles')
            ->where('important', 1)
            ->where('priority','!=', 0)
            ->update(['priority' => "0"]);
        foreach($request->item as $k => $itm){
            $newsLetterArticle=Article::find($itm);
            $newsLetterArticle->priority=$k+1;
            $newsLetterArticle->save();
            $this->forget($itm);
        }
        Cache::forget('homeSlide');
    }
    public function sortfarticle(Request $request) {
        foreach($request->item as $k => $itm){
            $newsLetterArticle=ArticleF::find($itm);
            $newsLetterArticle->sequence=$k+1;
            $newsLetterArticle->updated_at = date('Y-m-d H:i:s');
            $newsLetterArticle->save();
            $this->forget($itm);
        }
        Cache::forget('homeSlide');
    }

       public function searchRelatedres(Request $request) {
        
        $files = DB::table('tbl_high_resolution_images')
                ->where('name', 'like', '%' . $request->search_key . '%')
                ->get();

         foreach ($files as $attachment) {
            $related_images[] = array('image_url' =>config('constants.SiteBaseurl') . config('constants.awarticleimageextralargedir').'pic/'.trim($attachment->name),'image_id' => '1', 'tag_name' => trim($attachment->name), 'tag_id' => '1', 'photo_by' => '1', 'image_name' => trim($attachment->name), 'title' => $request->search_key);
        }
        return json_encode($related_images);
    }

    /*cron function*/
public function multiRequest($data, $options = array()) {
  // array of curl handles
  $curly = array();
  // data to be returned
  $result = array();
  // multi handle
  $mh = curl_multi_init();
  // loop through $data and create curl handles
  // then add them to the multi-handle
  foreach ($data as $id => $d) {
    $curly[$id] = curl_init();
    $url = (is_array($d) && !empty($d['url'])) ? $d['url'] : $d;
    curl_setopt($curly[$id], CURLOPT_URL,            $url);
    curl_setopt($curly[$id], CURLOPT_HEADER,         0);
    curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curly[$id],CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    // post?
    if (is_array($d)) {
      if (!empty($d['post'])) {
        curl_setopt($curly[$id], CURLOPT_POST,       1);
        curl_setopt($curly[$id], CURLOPT_POSTFIELDS, $d['post']);
      }
    }
    // extra options?
    if (!empty($options)) {
      curl_setopt_array($curly[$id], $options);
    }
 
    curl_multi_add_handle($mh, $curly[$id]);
  }
  // execute the handles
  $running = null;
  do {
    curl_multi_exec($mh, $running);
  } while($running > 0);
  // get content and remove handles
  foreach($curly as $id => $c) {
    $result[$id] = curl_multi_getcontent($c);
    curl_multi_remove_handle($mh, $c);
  }
  // all done
  curl_multi_close($mh);
  return $result;
}

public function sendmail($title,$id,$url,$summary,$photopath){
        $mail = Storage::get('public/mailDetails.txt');
        $mails = preg_split('/\s+/', $mail);
        foreach($mails as $key => $value){
            $exp[] = explode("=", $value, 2);   
            }
          $to = $exp[0][1];
          $cc = explode(',',$exp[1][1]);

        Mail::send('emails.publish_email', ['name' =>Session::get('users')->name,'url'=>$url,'title'=>$title,'summary'=>$summary,'photopath'=>$photopath], function ($message) use ($title,$to,$cc) {
            $message->to($to)->cc($cc)->subject('S4M News Alert - '.$title);
            }); ///->cc('tech@exchange4media.com')->cc('e4msales@exchange4media.com')->cc('milan.bhat@exchange4media.com')
            $this->forget($id);
        }

public function sendmailtopr($title,$id,$url,$to,$name,$summary,$photopath){
    $mail = Storage::get('public/mailDetails.txt');
        $mails = preg_split('/\s+/', $mail);
        foreach($mails as $key => $value){
            $exp[] = explode("=", $value, 2);   
            }
          $to = $exp[0][1];
          $cc = explode(',',$exp[1][1]);
    Mail::send('emails.publish_emailtopr', ['name' =>$name,'title' =>$title,'url'=>$url,'summary'=>$summary,'photopath'=>$photopath], function ($message) use ($title,$to,$cc) {
            $message->to($to)->cc($cc)->subject('We have got you featured !!! - '.$title);
            });
}

        // public function sendtwiter($title,$url){
        //      $posturl=$title. ','.$url;
        //      SendTo::Twitter($posturl);
        // }
        //  public function sendfb($url,$title){
        //     SendTo::Facebook(
        //     'link',
        //     [
        //     'link' => $url,
        //     'message' => $title
        //     ]
        //     );
        // }

        public function reload($url)
            {
                $graph = 'https://graph.facebook.com/v3.1/';
                $post = 'id='.urlencode($url).'&scrape=true&access_token=EAAK1aHWSfiABAAUNqK1QZAx94u9ZCLxTnjVIzb7KvO7KSZBbmWIicYJ1XxwDPiydJF7Ty8c0GAyoGj0A0NXSrMuKVciOsDgDaVhmZCzImHorGL7DHnhBUiQiZCgCc7gG70JZAkKVEHZAZAeDoga72RxbV3PuHJW6CQiZBCb3aCI1ctPsuZA5UyniRaYjjqIvAw8xkZD';
                return $this->send_post($graph, $post);
            }
        private function send_post($url, $post)
        {
            $r = curl_init();
            curl_setopt($r, CURLOPT_URL, $url);
            curl_setopt($r, CURLOPT_POST, 1);
            curl_setopt($r, CURLOPT_POSTFIELDS, $post);
            curl_setopt($r, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($r, CURLOPT_CONNECTTIMEOUT, 5);
            $data = curl_exec($r);
            curl_close($r);
            return $data;
        }



 public function callAPI($method, $url, $data){
        $curl = curl_init();
        switch ($method){
            case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
            case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);                              
            break;
            default:
        if ($data)
        $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'apikey: d0bfe0f862b68edafa2f47f092d4b3bd_12435_f62395509a655de312a721efd',
        'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // EXECUTE:
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
}



public function callnewapi($url){
$data_array =  array(
        "apikey" => 'd0bfe0f862b68edafa2f47f092d4b3bd_12435_f62395509a655de312a721efd',
        "message"        => $url,
        "attachment"        => '',
        "date"        => '',
        "category"        => '',
        "targeting_id"        => '',
        "Duration"        => '',
);
$make_call = $this->callAPI('POST', 'https://rest.messengerpeople.com/api/newsletter', json_encode($data_array));
$response = json_decode($make_call, true);
}

public function breakingNews()
{
    $newsData = Breaking::orderby('news_id','desc')->paginate(10);
    
    return view('articles.breaking',compact('newsData'));
}

public function breakingNewsStore(Request $request)
{
    $validator = Validator::make($request->all(), [
            'news_title' => 'required|unique:breaking_news',            
            ]);
            if ($validator->fails()) {
                return redirect('breaking/article')
                            ->withErrors($validator)
                            ->withInput();
        }
        if ($request->status = 'Active') {
            DB::table('breaking_news')->update(['status'=>'Inactive']);
        } 
    $storeData = Breaking::create([
            'news_label' => $request->news_label ? $request->news_label:'Breaking news',
            'news_title' => $request->news_title,
            'news_url' => $request->news_url,
            'status' => $request->status           
        ]);
    Cache::forget('breaking');
    return redirect('breaking/article');
}
public function breakingNewsEdit(Request $request)
{
    $newsUpdate = Breaking::where('news_id',$request->news_id)->update(['news_title'=>$request->news_title,'news_url' => $request->news_url,'status'=>$request->status]);
    Cache::forget('breaking');
    return redirect('breaking/article');
}
// update  Description Ads Article
   public function tbn_ads_inside_content( $content ) {
                $ads = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Responsive-Ads-S4m -->
<ins class="adsbygoogle"
   style="display:block"
   data-ad-client="ca-pub-5224870874807163"
   data-ad-slot="4999267707"
   data-ad-format="auto"
   data-full-width-responsive="true"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>';
                $p_array = explode('</p>', $content );
                $p_count = 3;
                if( !empty( $p_array ) ){
                for ($i = 0; $i <count($p_array); $i++ ) {

                if ($i == '3' || $i == '7' || $i == '11' || $i == '15')
                array_splice( $p_array, $i, 0, $ads );
                }
                $output = '';
                foreach( $p_array as $key=>$value ){
                if ($key==0) {
                   $output .= $value;
                }else{
                    $output .= '</p>'. $value;
                }
                }
                }
                return $output;

 }

public function updatedescads($id,$desc)
{
    $contect = $this->tbn_ads_inside_content($desc);
    DB::table('article')->where('article_id', $id)
    ->update(['descriptionads' => $contect]);
}
// update  Description Ads Article
/*cache*/
public function forget($id) {
    Cache::forget('ArrMenuSLatestVideo');
    Cache::forget('ArrRecentImportaintNewsHeaderList');
    Cache::forget('ArrRecentMiddelPanelCategoryAricles');
    Cache::forget('arrmostread');
    Cache::forget('ArrRecentNewsMiddelbarList');
    Cache::forget('menus');
    Cache::forget('ArrRecentFeatureNewsList');
    Cache::forget('articles-'.$id);
    Cache::forget('articlesrelate-'.$id);

}
}
