<?php
namespace App\Http\Controllers\Photogallery;
use Config;
//use App\Http\Controllers\Controller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use Helper;
use DB;
use App\Menu;
use Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\Models\Mostread;
use App\Models\Article;
use App\Models\Category;
use Carbon\Carbon;
class PhotogalleryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Pthotogallery Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles requesting users for the application and
    | redirecting them to your PthotoGallery screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
    {
        if (Cache::has('ArrMenuSLatestVideo')) {
        $ArrMenuSLatestVideo= Cache::get('ArrMenuSLatestVideo');
        }else{
        $ArrMenuSLatestVideo=  DB::table('youtubevideo')->select('title','img_thumb','vid','yid')->orderby('publish_date','desc')->limit(40)->get();
        Cache::put('ArrMenuSLatestVideo', $ArrMenuSLatestVideo, 1000);
        };


        if (Cache::has('ArrRecentImportaintNewsHeaderList')) {
        $ArrRecentImportaintNewsHeaderList= Cache::get('ArrRecentImportaintNewsHeaderList');
        }else{
        $ArrRecentImportaintNewsHeaderList = DB::table('article')->select('article_id','title','url','publish_date','publish_time','photopath','phototitle','category_name')->where('important', 1)->where('priority','!=', 0)->where('category_id','!=', 35)->orderby('priority','asc')->orderby('article_id','desc')->orderby('publish_date','desc')->limit(10)->get();
        Cache::put('ArrRecentImportaintNewsHeaderList', $ArrRecentImportaintNewsHeaderList, 1000);
        };


        if (Cache::has('ArrRecentMiddelPanelCategoryAricles')) {
        $ArrRecentMiddelPanelCategoryAricles= Cache::get('ArrRecentMiddelPanelCategoryAricles');
        }else{
        $ArrRecentMiddelPanelCategoryAricles = Article::select('article_id','title','url','publish_date','publish_time','photopath','phototitle')->orderby('publish_date','desc')->orderby('publish_time','desc')->where('category_id',35)->limit(4)->get();
        Cache::put('ArrRecentMiddelPanelCategoryAricles', $ArrRecentMiddelPanelCategoryAricles, 1000);
        };

 

        $date = date("Y-m-d H:i:s"); //23-02-2015
        $lastsevenday =  date('Y-m-d H:i:s', strtotime('-1 week', strtotime($date)));    
        if (Cache::has('arrmostread')) {
        $arrmostread= Cache::get('arrmostread');
        }else{
        $arrmostread = Mostread::Join('article','article_most_read.article_id','=','article.article_id')
        ->select(DB::raw('article.article_id,article.title,article.url,article.publish_date,article.photopath'))
        ->where('article_most_read.article_id','!=',0)
        ->where('article.publish_date','>=',$lastsevenday)
        ->orderBy('article_most_read.number_hits','desc')
        ->take(5)->distinct()->get();
        Cache::put('arrmostread', $arrmostread, 1000);
        };



 if (Cache::has('ArrRecentNewsMiddelbarList')) {
    $ArrRecentNewsMiddelbarList= Cache::get('ArrRecentNewsMiddelbarList');
}else{
    $ArrRecentNewsMiddelbarList = Article::select('article_id','title','url','publish_date','publish_time','photopath','phototitle')->where('important', 0)->where('web_exclusive', 0)->where('category_id','!=', 35)->orderby('publish_date','desc')->orderby('publish_time','desc')->limit(10)->get();
    Cache::put('ArrRecentNewsMiddelbarList', $ArrRecentNewsMiddelbarList, 1000);
};



if (Cache::has('menus')) {
    $menus= Cache::get('menus');
}else{
    $menus = Menu::with('children')->where('parent_id','=',0)->orderby('ordering','asc')->get();
    Cache::put('menus', $menus, 10);
};

if (Cache::has('ArrRecentFeatureNewsList')) {
    $ArrRecentFeatureNewsList= Cache::get('ArrRecentFeatureNewsList');
}else{
    $ArrRecentFeatureNewsList =DB::table('article_feature')->select(DB::raw('article_feature.*'))->orderby('sequence','asc')->orderby('publish_date','desc')->where('sequence','!=',1)->limit(4)->get();
    Cache::put('ArrRecentFeatureNewsList', $ArrRecentFeatureNewsList, 1000);
};
      $this->arrmostread = $arrmostread;
      $this->ArrMenuSLatestVideo = $ArrMenuSLatestVideo;
      $this->ArrRecentNewsMiddelbarList = $ArrRecentNewsMiddelbarList;
      $this->ArrRecentImportaintNewsHeaderList = $ArrRecentImportaintNewsHeaderList;
      $this->ArrRecentFeatureNewsList = $ArrRecentFeatureNewsList;
      $this->ArrRecentNewsMiddelbarList = $ArrRecentNewsMiddelbarList;
      $this->menus = $menus;
       $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
      if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='section' order by bid asc"));  
        }else{ 
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='section' order by bid asc"));  
        }
        $this->parents = $parents;
    }
    public function Pthoto_Gallery_listing_page(Request $request)
    {
        $ArrlistingPhotos  = Album::with('photos')->where('valid','1')->orderby('id','desc')->paginate(20);
        $metatitel = 'Photo Gallery - Exchange4media';
        $ogtitel =  '';
        $ogimage = '';
        $ogurl = '';
        $canonical = '';
        $metatag = 'Photos news, trending video in India, most searches Photo, amazing Photos, Photo gallery';
        $metadescription = 'Exchange4media photo, image, picture gallery page india.';
        $metatag = 'media news photo gallery, marketing news image gallery, advertising news picture gallery';
            $arrmostread = $this->arrmostread;
            $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
            $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
            $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
            $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            $menus = $this->menus;
            $parents = $this->parents;
        return view('photogallery.photogallery_listing', compact('ArrlistingPhotos','ArrViewPhotos','metatitel','ogtitel','ogimage','ogurl','canonical','metadescription','parents','ogdescription','ArrRecentFeatureNewsList','menus','arrmostread','ArrRecenttopnews','ArrRecentImportaintNewsHeaderList','ArrRecentNewsMiddelbarList','ArrMenuSLatestVideo'));
    }  

    public function Pthoto_Gallery_landing_page(Request $request,$title,$id)
    {  
        $ptitle = str_replace('-', ' ', $title);
        $ArrViewPhotos  = Album::with('photos')->where('id',$id)->first();
        $ArrlistingPhotos  = Album::with('photos')->where('id','!=',$id)->where('valid','1')->orderby('id','desc')->paginate(20);
        $title = $title;
        $metatitel = preg_replace("/[^A-Za-z0-9_]/"," ", $title);
        $ogtitel =  preg_replace("/[^A-Za-z0-9_]/"," ", $title);
        $ogimage = Config::get('constants.AwsBaseurl').Config::get('constants.ALBUM_IMAGE_DIR');
         $ogimagenew = Config::get('constants.AwsBaseurl').Config::get('constants.ALBUM_IMAGE_DIR');
        $ogurl = action('Photogallery\PhotogalleryController@Pthoto_Gallery_landing_page', ['title'=> Helper::rscUrl($title),'id'=> $id]);
        $canonical = action('Photogallery\PhotogalleryController@Pthoto_Gallery_landing_page', ['photogallery' => 'photogallery','title'=> Helper::rscUrl($title),'id'=> $id]);
        $metadescription = '';
        $ogdescription = '';
            $arrmostread = $this->arrmostread;
            $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
            
            $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
            $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
            $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            $menus = $this->menus;
            $parents = $this->parents;
        return view('photogallery.photogallery_landing', compact('ArrlistingPhotos','ArrViewPhotos','metatitel','ogtitel','ogimage','ogurl','canonical','metadescription','parents','ogdescription','ArrRecentFeatureNewsList','menus','arrmostread','ArrRecenttopnews','ArrRecentImportaintNewsHeaderList','ArrRecentNewsMiddelbarList','ArrMenuSLatestVideo'));
    }  



        public function create_photojson(Request $request){
        $ArrlistingPhotos =Album::with('photos')->where('valid','1')->orderby('id','desc')->limit(20)->get();
       $rules = array(
            'data' =>$ArrlistingPhotos,
        );
        $source = Config::get('constants.JSON_PHOTO');
            //print_r($source);die;
            $fp = fopen($source, 'w');
            fwrite($fp, json_encode($rules));
            fclose($fp);

             Storage::disk('gcs')->put('photopage.json',
            file_get_contents(public_path()."/jsonfile/photopage.json"),
            \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
            );
    }
}
