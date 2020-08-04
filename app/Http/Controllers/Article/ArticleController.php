<?php

namespace App\Http\Controllers\Article;
use Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Google\Cloud\Storage\StorageClient;
use League\Flysystem\Filesystem;
use League\Flysystem\Plugin\GetWithMetadata;
use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;
use App\Models\Article;
use App\Models\Category;
use App\Models\Author;
use App\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\Models\Topic;
use App\Models\TagListingWithArticle;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect; 
use Str;
use DateTime;
use App\Menu;
use Carbon\Carbon;
use Analytics;
use App\Models\Mostread;
use Spatie\Analytics\Period;
//use DB;
use Helper;
use File;
class ArticleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Article Controller
    |--------------------------------------------- -----------------------------
    |
    | This controller handles requesting users for the application and
    | redirecting them to your article landing screen. The controller uses a trait
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
        $ArrMenuSLatestVideo=  DB::table('youtubevideo')->select('title','img_thumb','vid','yid')->orderby('publish_date','desc')->limit(10)->get();
        Cache::put('ArrMenuSLatestVideo', $ArrMenuSLatestVideo, 1000);
        };
        
        if (Cache::has('ArrRecentImportaintNewsHeaderList')) {
        $ArrRecentImportaintNewsHeaderList= Cache::get('ArrRecentImportaintNewsHeaderList');
        }else{
        $ArrRecentImportaintNewsHeaderList = DB::table('article')->select('article_id','title','url','publish_date','publish_time','photopath','phototitle','category_name')->where('important', 1)->where('priority','!=', 0)->where('category_id','!=', 35)->orderby('priority','asc')->orderby('article_id','desc')->orderby('publish_date','desc')->orderby('publish_time','desc')->limit(10)->get();
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
        $ArrRecentNewsMiddelbarList = Article::select('article_id','title','url','publish_date','publish_time','photopath','phototitle','category_name')->where('important', 0)->where('web_exclusive', 0)->where('category_id','!=', 35)->orderby('publish_date','desc')->orderby('publish_time','desc')->limit(10)->get();
        Cache::put('ArrRecentNewsMiddelbarList', $ArrRecentNewsMiddelbarList, 1000);
        };

        if (Cache::has('menus')) {
        $menus= Cache::get('menus');
        }else{
        $menus = Menu::with('children')->where('parent_id','=',0)->orderby('ordering','asc')->get();
        Cache::put('menus', $menus, 1000);
        };

        if (Cache::has('ArrRecentFeatureNewsList')) {
        $ArrRecentFeatureNewsList= Cache::get('ArrRecentFeatureNewsList');
        }else{
        $ArrRecentFeatureNewsList =DB::table('article_feature')->select(DB::raw('article_feature.*'))->orderby('sequence','asc')->orderby('publish_date','desc')->where('sequence','!=',1)->limit(5)->get();
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

     public function Article_landing_page(Request $request,$section,$title,$id)
    {      

                if (Cache::has('articles-'.$id)) {
                $articles= Cache::get('articles-'.$id);
                }else{
                $articles = Article::with('albums', 'albums.photos','author')->where('article_id',$id)->get();
                Cache::put('articles-'.$id, $articles, 1000);
                };

                if( count( $articles ) == 0)
                {
                return view('errors.404');
                }

                if (Cache::has('articlesrelate-'.$id)) {
                $articlesrelate= Cache::get('articlesrelate-'.$id);
                }else{
                $articlesrelate = Article::with('albums', 'albums.photos','author')->where('category_id',$articles[0]->category_id)->where('article_id','!=',$id)->orderby('article_id','desc')->orderby('publish_date','desc')->orderby('publish_time','desc')->limit(10)->get();
                Cache::put('articlesrelate-'.$id, $articlesrelate, 1000);
                };

          
            $article= $articles[0];
            if (count($articles[0]->albums) > 0) {
            $photogallery= $articles[0]->albums[0]['photos'];
            }else{
            $photogallery= 'null';
            }
            $ArrTageListing =  $articles[0]->tags;
            $tag = preg_replace('/[,]+/', '|', trim($ArrTageListing));
            $articleurl = preg_replace( "/\r|\n/", "", $article->url);
            if ($request->url() !== $articleurl) {
            return Redirect::to($articleurl, 301); 
            } 
            $url = action('Article\ArticleController@Amp_Article_landing_page', ['section' => Helper::rscUrl($section),'title'=> Helper::rscUrl($title),'id'=> $id]);
            $metatitel = $article->title;
            $metadescription = $article->summary;
            $metatag = $article->tags;
            $ogimage = Config::get('constants.awsbaseurl').$article->photopath;
            $ogurl = $article->url;
            $canonicalstory1= action('Article\ArticleController@Article_landing_page', ['section' => Helper::rscUrl($section),'title'=> Helper::rscUrl($title),'id'=> $id]);
            $canonicalstory = strtolower($canonicalstory1);
            $canonical= $url;
            if (Cache::has('ArrlistingArticlespinit')) {
            $ArrlistingArticlespinit= Cache::get('ArrlistingArticlespinit');
            }else{
            $ArrlistingArticlespinit =   Article::where('category_name',$section)->orderby('publish_date','desc')->orderby('publish_time','desc')->where('is_pinned', 1)->limit(1)->get();
            Cache::put('ArrlistingArticlespinit', $ArrlistingArticlespinit, 1000);
            };
            $arrmostread = $this->arrmostread;
            $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
            $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
            $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
            $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            $menus = $this->menus;
           $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
      if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='story' order by bid asc"));  
        }else{ 
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='story' order by bid asc"));  
        }
         
        return view('article.article_landing', compact('article','ArrlistingArticlespinit','menus','photogallery','ArrTageListing','arrmostread','ArrMenuSLatestVideo','metatitel','ogtitel','ogimage','metatag',
                                                        'ogurl',
                                                        'canonical',
                                                        'metadescription',
                                                        'ogdescription',
                                                        'ArrRecentImportaintNewsHeaderList',
                                                        'ArrRecentFeatureNewsList',
                                                        'ArrRecentNewsMiddelbarList',
                                                        'articlesrelate',
                                                        'parents'
                                                      ));
    }   

    public function Amp_Article_landing_page(Request $request,$section ='',$title ='',$id ='')
    {
             if (Cache::has('articles_'.$id)) {
                $articles= Cache::get('articles_'.$id);
                }else{
                $articles = Article::with('albums', 'albums.photos','author')->where('article_id',$id)->get();
                Cache::put('articles_'.$id, $articles, 1000);
                };

                if( count( $articles ) == 0)
                {
                return view('errors.404');
                }

            $ArrViewArticle = $articles[0];
            if (count($articles[0]->albums) > 0) {
            $photogallery= $articles[0]->albums[0]['photos'];
            }else{
            $photogallery= 'null';
            }
            $ArrTageListing =  $articles[0]->tags;
            $tag = preg_replace('/[,]+/', '|', trim($ArrTageListing));
        $contentnew=$this->ampify($ArrViewArticle->description);
       if(isset($ArrViewArticle->meta_title) && !empty($ArrViewArticle->meta_title)){       
            $metatitel = $ArrViewArticle->meta_title;
            $ogtitel = $ArrViewArticle->meta_title;
         }else{
            $metatitel = $ArrViewArticle->title;
            $ogtitel = $ArrViewArticle->title;
        }
        if(isset($ArrViewArticle->meta_desc) && !empty($ArrViewArticle->meta_desc)){ 
            $metadescription = $ArrViewArticle->meta_desc;
            $ogdescription = $ArrViewArticle->meta_desc;
        }
        else{
            $metadescription = $ArrViewArticle->summary;
            $ogdescription = $ArrViewArticle->summary;
        }
        
        if(isset($ArrViewArticle->photopath) && !empty($ArrViewArticle->photopath)){
            $ogimage = Config::get('constants.awsbaseurl').$ArrViewArticle->photopath;
             $ogimagenew  = Config::get('constants.awsbaseurl').$ArrViewArticle->photopath;
        }else{
            $ogimage = 'https://www.exchange4media.com/images/e4m-logo.png';
        }
        if(isset($ArrViewArticle->url) && !empty($ArrViewArticle->url)){
            $ogurl = $ArrViewArticle->url;
            $url= $ArrViewArticle->url;
        }else{

            $ogurl = action('Article\ArticleController@Article_landing_page', ['section' => Helper::rscUrl($section),'title'=> Helper::rscUrl($title),'id'=> $id]);
            $url= $ArrViewArticle->url;
        }
        
         if (Cache::has('ArrRecentNewslist_'.$id)) {
                $ArrRecentNewslist= Cache::get('ArrRecentNewslist_'.$id);
                }else{
               $ArrRecentNewslist=Article::with('albums', 'albums.photos','author')->where('category_id',$articles[0]->category_id)->where('article_id','!=',$id)->orderby('article_id','desc')->orderby('publish_date','desc')->orderby('publish_time','desc')->limit(5)->get();
                Cache::put('ArrRecentNewslist_'.$id, $ArrRecentNewslist, 1000);
                };

        $arrmostread = $this->arrmostread;
        $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
        $ArrRecentFeatureNewsList =DB::table('article_feature')->join('article','article.article_id','=','article_feature.story_key_id')->select('article_feature.*','article.category_name','article.article_id')->orderby('article_feature.sequence','asc')->orderby('article.publish_date','desc')->limit(10)->get();
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $menus = $this->menus;

        return view('article.amp_article_landing', compact('ArrViewArticle',
                                                            'url',
                                                            'ArrRecentNewslist',
                                                            'metatitel',
                                                            'ogtitel',
                                                            'ogimage',
                                                            'ogimagenew',
                                                            'ogurl',
                                                            'metadescription',
                                                            'ogdescription',
                                                            'contentnew',
                                                            'photogallery',
                                                            'ArrTageListing',
                                                            'ArrRecentImportaintNewsHeaderList',
                                                            'ArrRecentFeatureNewsList',
                                                            'ArrRecentNewsMiddelbarList',
                                                            'articlesrelate',
                                                            'ArrMenuSLatestVideo',
                                                            'arrmostread',
                                                            'menus'
                                                            
                                                       ));
    }  
    public function Category_Article_listing_page(Request $request,$section)
    {
    	
      if (preg_match("/^[A-Z]/", $section )) {
        $section = strtolower($section);
          $href = "/".$section."-news.html";
       return Redirect::to($href, 301); 
      }
     
        $ArrlistingArticlespinit =  Article::select('article_id','title','url','publish_date','publish_time','photopath','authorname','author_id','category_name')->where('category_name',$section)->orderby('publish_date','desc')->orderby('publish_time','desc')->where('is_pinned', 1)->first();
         if (empty($ArrlistingArticlespinit)) {
          $ArrlistingArticlespinit =  Article::select('article_id','title','url','publish_date','publish_time','photopath','authorname','author_id','category_name')->where('category_name',$section)->orderby('publish_date','desc')->orderby('publish_time','desc')->first();
         }
        $ArrlistingArticles =   Article::join('category','article.category_id','=','category.category_id')->select('category.mtitle','category.mdesc','category.mkeyword','article_id','title','url','publish_date','publish_time','photopath','authorname','author_id','summary')->where('category_name',$section)->orderby('publish_date','desc')->orderby('publish_time','desc')->where('article_id','!=', $ArrlistingArticlespinit->article_id)->paginate(20);
       
        $ArrAuthorDetails='';
       $metatitel = $ArrlistingArticles[0]->mtitle;
        $ogtitel =  '';
        $ogimage = '';
        $ogurl = '';
        $metatag = $ArrlistingArticles[0]->mkeyword;
        $canonical = '';
        $metadescription = $ArrlistingArticles[0]->mdesc;
        $ogdescription = '';
        $arrmostread = $this->arrmostread;
        $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
        $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $menus = $this->menus;
        $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
      if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='section' order by bid asc"));  
        }else{ 
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='section' order by bid asc"));  
        }
        return view('article.article_listing', compact('ArrlistingArticles',
                                                      'ArrlistingArticlespinit',
                                                        'menus',
                                                        'arrmostread',
                                                        'ArrMenuSLatestVideo',
                                                        'metatitel',
                                                        'ogtitel',
                                                        'ogimage',
                                                        'metatag',
                                                        'ogurl',
                                                        'canonical',
                                                        'metadescription',
                                                        'ogdescription',
                                                        'ArrRecentImportaintNewsHeaderList',
                                                        'ArrRecentNewsMiddelbarList',
                                                        'ArrRecentFeatureNewsList',
                                                        'parents'
                                                      ));
    } 




     public function Interview_Article_listing_page(Request $request, $cdate='')
    {  
         if ($cdate != '') {
             $display_name = 'Date-wise Article';
              $ArrlistingArticles =   Article::select('article_id','title','url','publish_date','publish_time','photopath','authorname','author_id','summary')->where('publish_date',$cdate)->orderby('publish_date','desc')->orderby('publish_time','desc')->paginate(20);
        }
        else{
             $display_name = 'Interview Article';
            $ArrlistingArticles =   Article::select('article_id','title','url','publish_date','publish_time','photopath','authorname','author_id','summary')->where('news_type',3)->orderby('publish_date','desc')->orderby('publish_time','desc')->paginate(20);
        }
        $ArrAuthorDetails='';
        $metatitel = 'Interview With Media, Marketing and Advertising professionals People - Exchange4media';
        $ogtitel =  '';
        $ogimage = '';
        $ogurl = '';
        $metatag = 'media expert interview, advertising professionals interview, marketing interview, advertising and marketing professionals interview';
        $canonical = '';
        $metadescription = 'Exchange4media has done interesting informations interview with media, marketing and advertising professionals or experts';
        $ogdescription = '';
        $arrmostread = $this->arrmostread;
        $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
        $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $menus = $this->menus;
         $parents = $this->parents;
        return view('article.interview_listing', compact('ArrlistingArticles',
                                                      'ArrlistingArticlespinit',
                                                        'menus',
                                                        'display_name',
                                                        'parents',
                                                        'arrmostread',
                                                        'ArrMenuSLatestVideo',
                                                        'metatitel',
                                                        'ogtitel',
                                                        'ogimage',
                                                        'metatag',
                                                        'ogurl',
                                                        'canonical',
                                                        'metadescription',
                                                        'ogdescription',
                                                        'ArrRecentImportaintNewsHeaderList',
                                                        'ArrRecentNewsMiddelbarList',
                                                        'ArrRecentFeatureNewsList'
                                                      ));
    } 

    /*guest coloum*/
      public function guestcoloum_Article_listing_page(Request $request, $cdate='')
    {  
    	$ArrlistingArticles =   Article::select('article_id','title','news_type','url','publish_date','publish_time','photopath','authorname','author_id','summary')->where('author_type',3)->orderby('publish_date','desc')->orderby('publish_time','desc')->paginate(20);
      
        $metatitel = 'Guest Column Of Advertising, Media, Digital Marketing, PR Industry Expert - Exchange4media';
        $ogtitel =  '';
        $ogimage = '';
        $ogurl = '';
        $metatag = 'guest column advertising news, guest column media news, guest column';
        $canonical = '';
        $metadescription = 'Exchange4media has guest column of advertising, media, digital marketing, PR Industry and agency expert story';
        $ogdescription = '';
        $arrmostread = $this->arrmostread;
        $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
        $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $menus = $this->menus;
         $parents = $this->parents;
         $display_name = 'Guest Column';
        return view('article.interview_listing', compact('ArrlistingArticles',
                                                      'ArrlistingArticlespinit',
                                                        'menus',
                                                        'display_name',
                                                        'parents',
                                                        'arrmostread',
                                                        'ArrMenuSLatestVideo',
                                                        'metatitel',
                                                        'ogtitel',
                                                        'ogimage',
                                                        'metatag',
                                                        'ogurl',
                                                        'canonical',
                                                        'metadescription',
                                                        'ogdescription',
                                                        'ArrRecentImportaintNewsHeaderList',
                                                        'ArrRecentNewsMiddelbarList',
                                                        'ArrRecentFeatureNewsList'
                                                      ));
    } 
/*guest coloum*/


    /*feature*/
     public function Feature_Article_listing_page(Request $request)
    {   
        $ArrlistingArticles =   Article::select('article_id','title','url','publish_date','publish_time','photopath','authorname','author_id','summary')->where('article.web_exclusive', '=', 1)->orderby('publish_date','desc')->orderby('publish_time','desc')->paginate(20);
        $metatitel = 'Today Top Advertising News, Latest Media Agency News, Digital Marketing News Stories And Articles - Exchange4media';
        $ogtitel =  '';
        $ogimage = '';
        $ogurl = '';
        $metatag = 'top advertising news story, top media breaking news article, top marketing news articles, top digital trending topics stories';
        $canonical = '';
        $metadescription = 'Today top advertising news, media, marketing, digital news updates and trending topics story at Exchange4media.com';
        $ogdescription = '';
        $arrmostread = $this->arrmostread;
        $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
        $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $menus = $this->menus;
         $parents = $this->parents;
        $display_name = 'Feature';
        return view('article.interview_listing', compact('ArrlistingArticles',
                                                      'ArrlistingArticlespinit',
                                                        'menus',
                                                        'display_name',
                                                        'parents',
                                                        'arrmostread',
                                                        'ArrMenuSLatestVideo',
                                                        'metatitel',
                                                        'ogtitel',
                                                        'ogimage',
                                                        'metatag',
                                                        'ogurl',
                                                        'canonical',
                                                        'metadescription',
                                                        'ogdescription',
                                                        'ArrRecentImportaintNewsHeaderList',
                                                        'ArrRecentNewsMiddelbarList',
                                                        'ArrRecentFeatureNewsList'
                                                      ));
    } 
    /*feature*/
     /*feature*/
     public function Latest_Article_listing_page(Request $request)
    {
     
        $ArrlistingArticles =   Article::select('article_id','title','url','publish_date','publish_time','photopath','authorname','author_id','summary')->where('important', 0)->where('web_exclusive', 0)->orderby('publish_date','desc')->orderby('publish_time','desc')->paginate(20);
        $metatitel = 'Advertising Agency News, TV Media Agency News, Digital Marketing News Stories And Articles - Exchange4media';
        $ogtitel =  '';
        $ogimage = '';
        $ogurl = '';
        $metatag = 'advertising news story, media breaking news article, latest marketing news articles, digital trending topics stories, PR updates story';
        $canonical = '';
        $metadescription = 'Read all latest advertising news, media, marketing, digital, PR Agency news updates, trending topics story and article at Exchange4media.com';
        $ogdescription = '';
        $arrmostread = $this->arrmostread;
        $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
        $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $menus = $this->menus;
        $parents = $this->parents;
        $display_name = 'Latest';
        return view('article.interview_listing', compact('ArrlistingArticles',
                                                          'display_name',
                                                      'ArrlistingArticlespinit',
                                                        'menus',
                                                        'parents',
                                                        'arrmostread',
                                                        'ArrMenuSLatestVideo',
                                                        'metatitel',
                                                        'ogtitel',
                                                        'ogimage',
                                                        'metatag',
                                                        'ogurl',
                                                        'canonical',
                                                        'metadescription',
                                                        'ogdescription',
                                                        'ArrRecentImportaintNewsHeaderList',
                                                        'ArrRecentNewsMiddelbarList',
                                                        'ArrRecentFeatureNewsList'
                                                      ));
    } 
    /*feature*/
     /*editor*/
     public function Editor_Article_listing_page(Request $request)
    {
     $ArrlistingArticles =   Article::select('article_id','title','url','publish_date','publish_time','photopath','authorname','author_id','summary')->where('article.important', '=', 1)->orderby('publish_date','desc')->orderby('publish_time','desc')->paginate(20);
        $metatitel = 'Editor Picks Of Advertising, TV Media Digital Marketing Agency - Exchange4media';
        $ogtitel =  '';
        $ogimage = '';
        $ogurl = '';
        $metatag = 'editor picks';
        $canonical = '';
        $metadescription = 'Today top advertising news, media, marketing, digital news updates and trending topics story at Exchange4media.com';
        $ogdescription = '';
        $display_name = 'Editor picks';
        $arrmostread = $this->arrmostread;
        $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
        $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $menus = $this->menus;
         $parents = $this->parents;
        return view('article.interview_listing', compact('ArrlistingArticles',
                                                      'ArrlistingArticlespinit',
                                                        'menus',
                                                        'parents',
                                                        'arrmostread',
                                                        'ArrMenuSLatestVideo',
                                                        'display_name',
                                                        'metatitel',
                                                        'ogtitel',
                                                        'ogimage',
                                                        'metatag',
                                                        'ogurl',
                                                        'canonical',
                                                        'metadescription',
                                                        'ogdescription',
                                                        'ArrRecentImportaintNewsHeaderList',
                                                        'ArrRecentNewsMiddelbarList',
                                                        'ArrRecentFeatureNewsList'
                                                      ));
    } 
    /*feature*/

     /*authors*/
     public function Author_wise_Article_listing_page(Request $request,$name,$id)
    {
     
        $ArrlistingArticles =  Article::with('author')->select('article_id','title','url','publish_date','publish_time','photopath','authorname','author_id','summary')->where('author_id', '=', $id)->orderby('publish_date','desc')->orderby('publish_time','desc')->paginate(20);
       $authorbio =  DB::table('authors')->where('author_id', '=', $id)->where('valid', '=', 1)->first();
         
        $ArrAuthorDetails='';
        $metatitel = 'Authors profile - Exchange4media';
        $ogtitel =  '';
        $ogimage = '';
        $ogurl = '';
        $metatag = 'Authors page';
        $canonical = '';
        $metadescription = 'Today top advertising news, media, marketing, digital news updates and trending topics story at Exchange4media.com';
        $ogdescription = '';
        $display_name = 'Authors';
        $arrmostread = $this->arrmostread;
        $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
        $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $menus = $this->menus;
         $parents = $this->parents;
        return view('article.interview_listing', compact('ArrlistingArticles',
                                                      'authorbio',
                                                        'menus',
                                                        'parents',
                                                        'arrmostread',
                                                        'ArrMenuSLatestVideo',
                                                        'display_name',
                                                        'metatitel',
                                                        'ogtitel',
                                                        'ogimage',
                                                        'metatag',
                                                        'ogurl',
                                                        'canonical',
                                                        'metadescription',
                                                        'ogdescription',
                                                        'ArrRecentImportaintNewsHeaderList',
                                                        'ArrRecentNewsMiddelbarList',
                                                        'ArrRecentFeatureNewsList'
                                                      ));
    } 
    /*authors*/

     /*tags*/
     public function Tag_wise_Article_listing_page(Request $request,$name)
    {
        $TagArticleList =  Article::select(DB::raw('CONCAT(publish_date,publish_time) AS pickdate'),'article_id','title','url','publish_date','publish_time','photopath','phototitle','authorname','author_id','summary')->where(DB::raw('CONCAT(article.tags)'),'REGEXP', str_slug($name,' '))->orderby('publish_date','desc')->orderby('publish_time','desc')->paginate(10);
      
        $ArrAuthorDetails='';
        $metatitel = 'Editor Picks Of Advertising, TV Media Digital Marketing Agency - Samachar4media';
        $ogtitel =  'tags,keywords';
        $ogimage = '';
        $ogurl = 'http://www.s4m-dev.org/tags.html';
        $metatag = 'editor picks,tags,keywords';
        $canonical = '';
        $metadescription = 'Today top advertising news, media, marketing, digital news updates and trending topics story at Samachar4media.com';
        $ogdescription = '';
        $display_name = 'TAGS';
        // $arrmostread = $this->arrmostread;
        // $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
        // $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        // $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
        // $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
        // $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        // $menus = $this->menus;
        //  $parents = $this->parents;
        return view('article.interview_listing', compact('TagArticleList',
                                                      'ArrlistingArticlespinit',
                                                        'menus',
                                                        'parents',
                                                        'arrmostread',
                                                        'ArrMenuSLatestVideo',
                                                        'display_name',
                                                        'metatitel',
                                                        'ogtitel',
                                                        'ogimage',
                                                        'metatag',
                                                        'ogurl',
                                                        'canonical',
                                                        'metadescription',
                                                        'ogdescription',
                                                        'ArrRecentImportaintNewsHeaderList',
                                                        'ArrRecentNewsMiddelbarList',
                                                        'ArrRecentFeatureNewsList'
                                                      ));
    } 
    /*tags*/
    /*amp*/

      public function ampify($html='') {
            $html = str_ireplace(
            ['<img','<video','/video>','<audio','/audio>','<iframe'],
            ['<amp-img','<amp-video','/amp-video>','<amp-audio','/amp-audio>','<amp-iframe'],
            $html
            );
            $html = preg_replace('/<amp-img(.*?)style(.*?)>/', '<amp-img width="300" height="300" layout="responsive"$1></amp-img>',$html);
            $html = preg_replace('/<amp-img width="300" height="300" layout="responsive" align="middle" border="1"/', '<amp-img width="300" height="300" layout="responsive"$1></amp-img>',$html);
            $html = preg_replace('/<td(.*?)style(.*?)>/', '<td></td>',$html);
            $html = preg_replace('/<tr(.*?)style(.*?)>/', '<tr></tr>',$html);
            $html = preg_replace('/<table(.*?)style(.*?)>/', '<table></table>',$html);
            $html=preg_replace('#(<[a-z ]*)(style=("|\')(.*?)("|\'))([a-z ]*>)#', '\\1\\6', $html);
            $html = preg_replace('/<amp-iframe(.*?)>/', '<amp-iframe width="300" height="300" sandbox="allow-scripts allow-same-origin" layout="responsive"$1></amp-iframe>',$html);
            $html = preg_replace('/<amp-video(.*?)>/', '<amp-video$1></amp-video>',$html);
            $html = strip_tags($html,'<h1><h2><h3><h4><h5><h6><a><p><ul><ol><li><blockquote><q><cite><ins><del><strong><em><code><pre><svg><table><thead><tbody><tfoot><th><tr><td><dl><dt><dd><article><section><header><footer><aside><figure><time><abbr><div><span><hr><small><br><amp-img><amp-audio><amp-video><amp-ad><amp-anim><amp-carousel><amp-fit-rext><amp-image-lightbox><amp-instagram><amp-lightbox><amp-twitter><amp-youtube><amp-iframe>');
            return $html;
}
/*amp*/







    public function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array(
        'd' => 'day',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

 public function countmostread() {
  
        $analytics = Analytics::fetchMostVisitedPages(Period::days(7));
        $ingredients = [];
        foreach ($analytics as $key => $value) {

      $whatIWant = substr($value['url'], strpos($value['url'], "_") + 1);
     
      $id =  (explode(".",$whatIWant));
      $lastWord = substr($id[0], strrpos($id[0], '-') + 1);
      
       $ingredients[] =[
            'article_id' => $lastWord,
            'number_hits' => $value['pageViews'],
       ];
        }
        DB::table('article_most_read')->truncate();
        DB::table('article_most_read')->insert($ingredients);
        return view('partials/mostread',["analytics"=>$analytics]);
    }

       public function counttags() {
        $tagshash  = DB::select("CALL counttag()");
        
    }

        public function Author_listing_page(Request $request)
    {
        $ArrAuthorListing = DB::table('authors')->where('author_type_id', '=', 3)->where('valid', '=', 1)->orderby('name','asc')->paginate(100);
           $ArrAuthorDetails='';
        $metatitel = 'Best Author, Guest From Media, advertising industry - Exchange4media';
        $ogtitel =  '';
        $ogimage = '';
        $ogurl = '';
        $metatag = 'media marketing author, advertising media guest';
        $canonical = '';
        $metadescription = 'Exchange4media has best Media, advertising industry author and guest from india.';
        $ogdescription = '';
        $arrmostread = $this->arrmostread;
        $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
        $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $menus = $this->menus;
         $parents = $this->parents;
          $display_name = 'Guest Author';
        return view('article.author_listing', compact('ArrlistingArticles',
                                                       'ArrAuthorListing',
                                                        'menus',
                                                        'parents',
                                                        'arrmostread',
                                                        'ArrMenuSLatestVideo',
                                                        'metatitel',
                                                        'ogtitel',
                                                        'ogimage',
                                                        'metatag',
                                                        'ogurl',
                                                        'canonical',
                                                        'metadescription',
                                                        'ogdescription',
                                                        'display_name',
                                                        'ArrRecentImportaintNewsHeaderList',
                                                        'ArrRecentNewsMiddelbarList',
                                                        'ArrRecentFeatureNewsList'
                                                      ));
}



        public function Authorrepo_listing_page(Request $request)
    {
        $ArrAuthorListing = DB::table('authors')->where('author_type_id', '=', 2)->where('valid', '=', 1)->orderby('name','asc')->paginate(100);

           $ArrAuthorDetails='';
        $metatitel = 'Exchange4media All Author Profile Page';
        $ogtitel =  '';
        $ogimage = '';
        $ogurl = '';
        $metatag = 'advertising author news, media author news, author';
        $canonical = '';
        $metadescription = 'Exchange4media Author cover advertising, media, digital marketing, PR Industry and agency news in India';
        $ogdescription = '';
        $arrmostread = $this->arrmostread;
        $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
        $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $menus = $this->menus;
         $parents = $this->parents;
         $display_name = 'Author';
        return view('article.author_listing', compact('ArrlistingArticles',
                                                      'ArrAuthorListing',
                                                        'menus',
                                                        'parents',
                                                        'arrmostread',
                                                        'ArrMenuSLatestVideo',
                                                        'metatitel',
                                                        'ogtitel',
                                                        'ogimage',
                                                        'metatag',
                                                        'ogurl',
                                                        'canonical',
                                                        'metadescription',
                                                        'ogdescription',
                                                        'ArrRecentImportaintNewsHeaderList',
                                                        'ArrRecentNewsMiddelbarList',
                                                        'display_name',
                                                        'ArrRecentFeatureNewsList'
                                                      ));
}

public function all_Article_listing_page(Request $request){
		$ArrlistingArticles =   Article::select('article_id','title','url','publish_date','publish_time','photopath','authorname','author_id','summary')->orderby('publish_date','desc')->orderby('publish_time','desc')->paginate(25);
		$ArrAuthorDetails='';
		$metatitel = 'Advertising Agency News, TV Media Agency News, Digital Marketing News Stories And Articles - Exchange4media';
		$ogtitel =  '';
		$ogimage = '';
		$ogurl = '';
		$metatag = 'advertising news story, media breaking news article, latest marketing news articles, digital trending topics stories, PR updates story';
		$canonical = '';
		$metadescription = 'Read all latest advertising news, media, marketing, digital, PR Agency news updates, trending topics story and article at Exchange4media.com';
		$ogdescription = '';
        $arrmostread = $this->arrmostread;
        $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
        $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
        $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        $menus = $this->menus;
         $parents = $this->parents;
        $display_name = 'All Articles';
        return view('article.interview_listing', compact('ArrlistingArticles',
                                                          'display_name',
                                                      'ArrlistingArticlespinit',
                                                        'menus',
                                                        'parents',
                                                        'arrmostread',
                                                        'ArrMenuSLatestVideo',
                                                        'metatitel',
                                                        'ogtitel',
                                                        'ogimage',
                                                        'metatag',
                                                        'ogurl',
                                                        'canonical',
                                                        'metadescription',
                                                        'ogdescription',
                                                        'ArrRecentImportaintNewsHeaderList',
                                                        'ArrRecentNewsMiddelbarList',
                                                        'ArrRecentFeatureNewsList'
                                                      ));
    } 
}