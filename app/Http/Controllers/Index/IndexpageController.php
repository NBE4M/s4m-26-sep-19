<?php
namespace App\Http\Controllers\Index;
use Config;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Mostread;
use App\Models\Article;
use App\Models\Video;
use App\ArticleF;
use App\Articles;
use App\Breaking;
use App\Ytube;
use App\Category;
use App\Models\Contactus;
use Session;
use Carbon\Carbon;
use App\Menu;
use View;
use File;
use App\Album;
use App\Tag;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Helper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;


class IndexpageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | index Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles requesting users for the application and
    | redirecting them to your home screen. The controller uses a trait
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
        if (Cache::has('menus')) {
            $menus= Cache::get('menus');
        }else{
            $menus = Menu::with('children')->where([['parent_id','0'],['active','1']])->orderby('ordering','asc')->get();
            Cache::put('menus', $menus, 20);
        };
        if (Cache::has('breaking')) {
            $breaking= Cache::get('breaking');
        }else{
            $breaking = Breaking::where('status','Active')->orderby('news_id','desc')->first();
            Cache::put('breaking', $breaking, 20);
        };
         if (Cache::has('polls')) {
            $polls= Cache::get('polls');
            $poll_answer= Cache::get('poll_answer');
        }else{
            $polls=  DB::table('poll')->where('status', '1')->orderBy('id', 'desc')->first();
            if(isset($polls)){
            $poll_answer = DB::table('poll_answer')->where('poll_id', $polls->id)->get();
        }else{
            $poll_answer = ''; 
        }
            Cache::put('polls', $polls, 10);
            Cache::put('poll_answer', $poll_answer, 10);
        };
        if (Cache::has('industry-briefing')) {
            $industryBriefing= Cache::get('industry-briefing');
        }else{
            $industryBriefing = Article::select(DB::raw('CONCAT(publish_date,publish_time) AS pickdate'),'title','url','photopath','phototitle','category_name')->where([['category_id',3],['web_exclusive',0]])->orderby('publish_date','desc')->orderby('publish_time','desc')->limit(4)->get();
            Cache::put('industry-briefing', $industryBriefing, 20);
        };

        if (Cache::has('social-media')) {
            $socialM= Cache::get('social-media');
        }else{
            $socialM = Article::select(DB::raw('CONCAT(publish_date,publish_time) AS pickdate'),'title','summary','url','photopath','phototitle','category_name','category_hname')->where([['category_id',13],['web_exclusive',0]])->orderby('publish_date','desc')->orderby('publish_time','desc')->limit(10)->get();
            Cache::put('social-media', $socialM, 20);
        };
        $date = date("Y-m-d H:i:s");
        $lastsevenday = '2019-02-23'; //date('Y-m-d', strtotime('-2 week', strtotime($date)));   
        if (Cache::has('rightsidemostRead')) {
            $rightsidemostRead= Cache::get('rightsidemostRead');
        }else{
            $rightsidemostRead = DB::table('article_feature')->select('title','url','photopath','phototitle','category_ename','category_hname','sequence')->where('sequence','!=', 0)->orderby('sequence','asc')->limit(5)->get();
        };
        // dd($rightsidemostRead);     
        if (Cache::has('most-read')) {
            $mostRead= Cache::get('most-read');
        }else{
            $mostRead = Mostread::Join('article','article_most_read.article_id','=','article.article_id')->select(DB::raw('CONCAT(article.publish_date,article.publish_time) AS pickdate,article.article_id,article.title,article.url,article.publish_date,article.photopath,article.category_hname,article.category_name,article.summary'))
            ->where('article_most_read.article_id','!=',0)
            ->where('article.publish_date','>=',$lastsevenday)
            ->orderBy('article_most_read.number_hits','desc')
            ->take(6)->distinct()->get();
            Cache::put('most-read', $mostRead, 20);
        };
        if (Cache::has('vicharmanch')) {
            $vicharmanch= Cache::get('vicharmanch');
        }else{
            $vicharmanch = Article::select(DB::raw('CONCAT(publish_date,publish_time) AS pickdate'),'title','summary','url','photopath','phototitle','category_name','category_hname')->where([['category_id',11],['web_exclusive',0]])->orderby('publish_date','desc')->orderby('publish_time','desc')->limit(3)->get();
            Cache::put('vicharmanch', $vicharmanch, 20);
        };
        if (Cache::has('videos')) {
            $videos= Cache::get('videos');
        }else{
            $videos = Ytube::orderby('publish_date','desc')->take(5)->get();
            Cache::put('videos', $videos, 20);
        };
        if (Cache::has('frontalbum')) {
            $frontalbum= Cache::get('frontalbum');
        }else{
            $frontalbum = Album::Join('photos as p', 'album.id', '=', 'p.owner_id')
                          ->select(DB::raw('album.id as albumId,album.title as album_title,album.description as album_desc,p.title as photo_title,p.description as photo_desc,p.photopath,p.photo_id'))->where([['album.valid',1],['p.owned_by','album'],['p.active',1]])->orderBy('p.photo_id', 'desc')->groupby('album.id')->take(10)->get();
            Cache::put('frontalbum', $frontalbum, 20);
        };
        if (Cache::has('techworld')) {
            $tech= Cache::get('techworld');
        }else{
            $tech = Article::select(DB::raw('CONCAT(publish_date,publish_time) AS pickdate'),'title','summary','url','photopath','phototitle','category_name')->where('category_id',64)->orderby('publish_date','desc')->orderby('publish_time','desc')->limit(6)->get();
            Cache::put('techworld', $tech, 20);
        };
      //   $useragent = isset($_SERVER['HTTP_USER_AGENT'])
      //   ? strtolower($_SERVER['HTTP_USER_AGENT'])
      //   : '';
      // if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
      //   $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='section' order by bid asc"));  
      //   }else{ 
      //   $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='section' order by bid asc"));  
      //   }

        View::share('frontalbum',$frontalbum);
        View::share('videos',$videos);
        View::share('tech',$tech);
        View::share('menus',$menus);
        View::share('breaking',$breaking); 
        View::share('industryBriefing',$industryBriefing);
        View::share('socialM',$socialM);
        View::share('rightsidemostRead',$rightsidemostRead);
        View::share('mostRead',$mostRead);
        View::share('vicharmanch',$vicharmanch);
        View::share('polls',$polls);
        View::share('poll_answer',$poll_answer);
        // View::share('parents',$parents);
    }

    public function index(Request $request)
    {
               
        if (Cache::has('homeSlide')) {
            $homeSlide= Cache::get('homeSlide');
        }else{
        	$homeSlide = DB::table('article_feature')->select('title','url','photopath','phototitle','category_ename','category_hname','sequence')->where('sequence','!=', 0)->orderby('sequence','asc')->limit(5)->get();
        	Cache::put('homeSlide', $homeSlide, 20);
        };
        
        if (Cache::has('customSection')) {
            $customSection= Cache::get('customSection');
        }else{
            $customSection = DB::table('custom_section')->select('title','url','photopath','phototitle','category_ename','category_hname','sequence')->where('sequence','!=', 0)->orderby('sequence','asc')->limit(4)->get();
            Cache::put('customSection', $customSection, 20);
        }; 

        if (Cache::has('media-forum')) {
            $mediaForum= Cache::get('media-forum');
        }else{
            $mediaForum = Article::select(DB::raw('CONCAT(publish_date,publish_time) AS pickdate'),'title','url','category_name')->where([['category_id',4],['web_exclusive',0]])->orderby('publish_date','desc')->orderby('publish_time','desc')->limit(5)->get();
            Cache::put('media-forum', $mediaForum, 20);
        };
        
        if (Cache::has('admission-jobs')) {
            $jobs= Cache::get('admission-jobs');
        }else{
            $jobs = Article::select(DB::raw('CONCAT(publish_date,publish_time) AS pickdate'),'title','summary','url','photopath','phototitle','category_name')->where([['category_id',7],['web_exclusive',0]])->orderby('publish_date','desc')->orderby('publish_time','desc')->limit(6)->get();
            Cache::put('admission-jobs', $jobs, 20);
        };        
        if (Cache::has('interviews')) {
            $interview= Cache::get('interviews');
        }else{
            $interview = Article::select(DB::raw('CONCAT(publish_date,publish_time) AS pickdate'),'title','summary','url','photopath','phototitle','category_name','category_hname')->where([['category_id',5],['web_exclusive',0]])->orderby('publish_date','desc')->orderby('publish_time','desc')->limit(2)->get();
            Cache::put('interviews', $interview, 20);
        };
        
        if (Cache::has('brand-speaks')) {
            $brandSpeaks= Cache::get('brand-speaks');
        }else{
            $brandSpeaks = Article::select(DB::raw('CONCAT(publish_date,publish_time) AS pickdate'),'title','summary','url','photopath','phototitle','category_name')->where([['category_id',66],['web_exclusive',0]])->orderby('publish_date','desc')->orderby('publish_time','desc')->limit(4)->get();
            Cache::put('brand-speaks', $brandSpeaks, 20);
        };
        if (Cache::has('advertisement')) {
            $Adv= Cache::get('advertisement');
        }else{
            $Adv = Article::select(DB::raw('CONCAT(publish_date,publish_time) AS pickdate'),'title','summary','url','photopath','phototitle','category_name')->where([['category_id',8],['web_exclusive',0]])->orderby('publish_date','desc')->orderby('publish_time','desc')->limit(4)->get();
            Cache::put('advertisement', $Adv, 20);
        };
        
        if (Cache::has('telescope')) {
            $telS= Cache::get('telescope');
        }else{
            $telS = Article::select(DB::raw('CONCAT(publish_date,publish_time) AS pickdate'),'title','summary','url','photopath','phototitle','category_name')->where([['category_id',10],['web_exclusive',0]])->orderby('publish_date','desc')->orderby('publish_time','desc')->limit(10)->get();
            Cache::put('telescope', $telS, 20);
        };
        if (Cache::has('poetry')) {
            $poetry= Cache::get('poetry');
        }else{
            $poetry = Article::select(DB::raw('CONCAT(publish_date,publish_time) AS pickdate'),'title','summary','url','photopath','phototitle','category_name')->where([['category_id',72]])->orderby('publish_date','desc')->orderby('publish_time','desc')->limit(4)->get();
            Cache::put('poetry', $poetry, 20);
        };
        
        $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
        if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='home' order by bid asc"));  }else{
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='home' order by bid asc"));
        }

    return view('welcome',compact('menus','homeSlide','industryBriefing','mediaForum','jobs','mostRead','vicharmanch','interview','brandSpeaks','Adv','mainNews','telS','socialM','videos','frontalbum','polls','poll_answer','breaking','parents','poetry','customSection'));
    }

    public function section($section)
    {
        
        $sectionArticles = Article::select(DB::raw('CONCAT(publish_date,publish_time) AS pickdate'),'title','summary','url','authorname','author_id','photopath','phototitle','category_name')->where('category_name',$section)->orderby('publish_date','desc')->orderby('publish_time','desc')->paginate(20);
            
        if (Cache::has('sectionmostRead')) {
            $sectionmostRead= Cache::get('sectionmostRead');
        }else{
            $sectionmostRead = Article::select(DB::raw('CONCAT(publish_date,publish_time) AS pickdate'),'title','summary','url','photopath','phototitle')->where('category_id',9)->orderby('publish_date','desc')->orderby('publish_time','desc')->limit(5)->get();
            Cache::put('sectionmostRead', $sectionmostRead, 20);
        };
        $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
        if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='section' order by bid asc"));  }else{
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='section' order by bid asc"));
        }
       
        $meta = Category::where([['e_name',$section],['valid',1]])->first();
        $title =  $meta->mtitle ? $meta->mtitle:'';
        $metatitle = $meta->mtitle ? $meta->mtitle:'';
        $metadescription = $meta->mdesc ? $meta->mdesc:'';
        $metatag = $meta->mkeyword ? $meta->mkeyword:'';
        $ogimage = '';
        $ogurl = url('/').'/'.$section.'-news.html';
        $section = $meta->name;
        return view('article.section', compact('menus','sectionArticles','sectionmostRead','industryBriefing','parents','metatitle','metadescription','metatag','ogimage','ogurl','section','title'));
    }

    public function story(Request $request,$section,$title,$id)
    {     
        $section = str_replace('-news',' ', $section);
        
                if (Cache::has('articles-'.$id)) {
                $articles= Cache::get('articles-'.$id);
                }else{
                $articles = Article::join('authors as au','au.author_id','=','article.author_id')->where('article_id',$id)->get();
                Cache::put('articles-'.$id, $articles, 20);
                };

                if( count( $articles ) == 0)
                {
                return view('errors.404');
                }

                if (Cache::has('articlesrelate-'.$id)) {
                $articlesrelate= Cache::get('articlesrelate-'.$id);
                }else{
                $articlesrelate = Article::join('authors as au','au.author_id','=','article.author_id')->where([['category_name',$section],['article_id','!=',$id],['category_name','!=',null]])->orderby('article_id','desc')->orderby('publish_date','desc')->orderby('publish_time','desc')->limit(10)->get();
                Cache::put('articlesrelate-'.$id, $articlesrelate, 20);
                };
                if (Cache::has('storymostRead')) {
                    $storymostRead= Cache::get('storymostRead');
                }else{
                    $storymostRead = Article::select(DB::raw('CONCAT(publish_date,publish_time) AS pickdate'),'title','summary','url','photopath','phototitle','category_name')->where('category_id',9)->orderby('publish_date','desc')->orderby('publish_time','desc')->limit(4)->get();
                    Cache::put('storymostRead', $storymostRead, 20);
                };
          
            $article= $articles[0];
            $articleurl = preg_replace( "/\r|\n/", "", $article->url);
            if ($request->url() !== $articleurl) {
            return Redirect::to($articleurl, 301); 
            } 
            $url = action('Index\IndexpageController@Amp_Article_landing_page', ['section' => Helper::rscUrl($section),'title'=> Helper::rscUrl($title),'id'=> $id]);
            $metatitle = $article->title;
            $metadescription = $article->summary;
            $metatag = $article->tags;
            $ogimage = Config::get('constants.storagepath').$article->photopath;;
            $ogurl = $article->url;
            $xy = explode('/',$article->url);
            $yz = end($xy);
            $zx = explode (".", $yz);
            $vx = current($zx);
            $vy = explode ("-", $vx);
            $sliced = array_slice($vy, 0, -1); 
            $string = ucwords(implode(" ", $sliced));
            $title = $article->title.' | '.$string;
        $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
      if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='story' order by bid asc"));  
        }else{ 
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='story' order by bid asc"));  
        }
         
        return view('article.story', compact('articles','articlesrelate','socialM','storymostRead','metatitle','title','metadescription','metatag','ogimage','ogurl','parents'));
    }

    public function photogallery()
    {
        $shareAlbum = Album::Join('photos as p', 'album.id', '=', 'p.owner_id')
                          ->select(DB::raw('album.id,album.title as album_title,album.description as album_desc,p.title as photo_title,p.description as photo_desc,p.photopath,p.photo_id,album.updated_at as albumDate'))->where([['album.valid',1],['p.owned_by','album'],['p.active',1]])->groupby('album.id')->orderBy('p.photo_id', 'desc')->paginate(10);
        $metatitel = 'Photo, Image Gallery - Samachar4media';
        $ogtitel =  'Photo, Image Gallery - Samachar4media';
        $ogimage = '';
        $ogurl = '';
        $canonical = '';
        $metatag = 'media news photo gallery, marketing news image gallery, advertising news picture gallery';
        $metadescription = 'Samachar4media meida, advertising, photo, image, picture gallery page India.';
        $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
        if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='section' order by bid asc"));  }else{
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='section' order by bid asc"));
        }
        return view('photogallery.album', compact('shareAlbum','ArrViewPhotos','metatitel','ogtitel','ogimage','ogurl','canonical','metadescription','ArrRecentFeatureNewsList','menus','arrmostread','ArrRecenttopnews','ArrRecentImportaintNewsHeaderList','ArrRecentNewsMiddelbarList','ArrMenuSLatestVideo','parents'));
    
    }

    public function galleryExplore($title,$id)
    {
        $galleryPic = Album::Join('photos as p', 'album.id', '=', 'p.owner_id')->select(DB::raw('album.id ,album.title as album_title,album.description as album_desc,p.title as photo_title,p.description as photo_desc,p.photopath,p.photo_id,album.updated_at as pickdate'))->where([['album.valid',1],['p.owned_by','album'],['p.active',1],['album.id',$id]])->orderBy('p.photo_id', 'desc')->get();
        $otherGallery = Album::Join('photos as p', 'album.id', '=', 'p.owner_id')->select(DB::raw('album.id ,album.title as album_title,album.description as album_desc,p.title as photo_title,p.description as photo_desc,p.photopath,p.photo_id'))->where([['album.valid',1],['p.owned_by','album'],['p.active',1],['album.id','!=',$id]])->orderBy('p.photo_id', 'desc')->get();
        $metatitel = $galleryPic[0]->album_title;
        $title = $galleryPic[0]->album_title;
        $ogtitel =  'Photo, Image Gallery - Samachar4media';
        $ogimage = '';
        $ogurl = '';
        $canonical = '';
        $metatag = 'media news photo gallery, marketing news image gallery, advertising news picture gallery';
        $metadescription = $galleryPic[0]->album_desc;
                    $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
      if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='story' order by bid asc"));  
        }else{ 
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='story' order by bid asc"));  
        }
        return view('photogallery.gallery', compact('galleryPic','otherGallery','ArrViewPhotos','metatitel','ogtitel','ogimage','ogurl','canonical','metadescription','ArrRecentFeatureNewsList','menus','arrmostread','ArrRecenttopnews','ArrRecentImportaintNewsHeaderList','ArrRecentNewsMiddelbarList','ArrMenuSLatestVideo','parents','title'));
    }

    public function videoGallery(Request $request)
    {
        $galleryVideo  = DB::table('youtubevideo')->select()->orderby('publish_date','desc')->paginate(20);
        // $arrmostread = $this->arrmostread;
        // $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
        // $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        // $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
        // $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
        // $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        // $menus = $this->menus;
        // $parents = $this->parents;
        $metatitel = 'Video News, Most Searches and Trending Video, Video Gallery - Samachar4media';
        $ogtitel =  'Video News, Most Searches and Trending Video, Video Gallery - Samachar4media';
        $ogimage = '';
        $ogurl = $request->url();
        $canonical = $request->url();
        $metatag = 'video news, trending video in India, most searches video, amazing videos, video gallery';
        $metadescription = 'Samachar4media provides latest and breaking news videos and most searches and trending video in India.';
        $ogdescription = '';
                $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
        if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='section' order by bid asc"));  }else{
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='section' order by bid asc"));
        }
        return view('video.videoGallery', compact('galleryVideo','ArrRecentFeatureNewsList','menus','arrmostread','ArrRecentImportaintNewsHeaderList','ArrRecentNewsMiddelbarList','ArrMenuSLatestVideo','metatitel','ogtitel','ogimage','metatag','parents'));
    }
    public function videoExplore(Request $request,$title,$id)
    {
        $ArrViewVideo  = DB::table('youtubevideo')->where('yid',$id)->get();
        $ArrlistingVideos  = DB::table('youtubevideo')->where('yid','!=',$id)->orderby('publish_date','desc')->paginate(20);
        // $arrmostread = $this->arrmostread;
        // $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
        // $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        // $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
        // $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
        // $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        // $menus = $this->menus;
        // $parents = $this->parents;
        $title = $ArrViewVideo[0]->title;
        $metatitle = $ArrViewVideo[0]->title;
        $ogtitle =  $ArrViewVideo[0]->title;
        $ogimage = $ArrViewVideo[0]->img_thumb;
        $ogurl = $request->url();
        $canonical = $request->url();
        $metatag = 'video news, trending video in India, most searches video, amazing videos, video gallery';
        $metadescription = 'Samachar4media provides latest and breaking news videos and most searches and trending video in India.';
        $ogdescription = 'Samachar4media provides latest and breaking news videos and most searches and trending video in India.';
                $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
      if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='story' order by bid asc"));  
        }else{ 
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='story' order by bid asc"));  
        }
        return view('video.videoy_listing', compact('ArrlistingVideos','ArrViewVideo','ArrRecentFeatureNewsList','menus','arrmostread','ArrRecentImportaintNewsHeaderList','ArrRecentNewsMiddelbarList','ArrMenuSLatestVideo','metatitle','ogtitle','ogimage','metatag','parents','ogurl','canonical','title'));
    }

    public function pollResult($id,Request $request)
    {
        $sum = DB::table('poll_answer')->where('poll_id', $id)->sum('vote');

        $polls = DB::table('poll as p')->join('poll_answer as pa','p.id','=','pa.poll_id')->where([['p.id', $id],['p.status', '1']])->get();
        // $pollsArch = DB::table('poll as p')->join('poll_answer as pa','p.id','=','pa.poll_id')->where('p.status', 2)->groupby('pa.poll_id')->get();
        if ($polls->isEmpty()) {
           return Redirect::to('/',301)->with('This poll is not active !');
        }       
        
        $pollarch = array();
        $pollsArch = DB::table('poll')->where('status',2)->orderBy('id', 'desc')->get();
        $paginatedItems = DB::table('poll')->where('status',2)->orderBy('id', 'desc')->paginate(10);
        foreach($pollsArch as $k=> $pol)
        {
            $pollAnswer = DB::table('poll_answer')->where('poll_id', $pol->id)->get();
            $sumArch = DB::table('poll_answer')->where('poll_id', $pol->id)->sum('vote');       
            
            if(count($pollAnswer) > 0 ){
                $pollarch[$pol->id]['question'] = $pol->question;
                $pollarch[$pol->id]['sum'] = $sumArch;
                $pollarch[$pol->id]['anss']  = array();
                foreach($pollAnswer as $ans)
                {
                    $pollarch[$pol->id]['anss'][$ans->id]['answer'] = $ans->answer;
                    $pollarch[$pol->id]['anss'][$ans->id]['vote'] = $ans->vote;
                }
                
            }
    // dd($pollarch[$pol->id]['anss']);
        // $currentPage = LengthAwarePaginator::resolveCurrentPage();
 
        // // Create a new Laravel collection from the array data
        // $itemCollection = collect($pollarch);
 
        // // Define how many items we want to be visible in each page
        // $perPage = 10;
 
        // // Slice the collection to get the items to display in current page
        // $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
 
        // // Create our paginator and pass it to the view
        // $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        // // set url path for generted links
        // $paginatedItems->setPath($request->url());
        }
        $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
        if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='section' order by bid asc"));  }else{
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='section' order by bid asc"));
        }

        return view('polls/pollresult',compact('menus','polls','poll_answer','sum','paginatedItems','parents'));
    }

    public function Contactus($value='')
    { 
        $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
        if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='section' order by bid asc"));  }else{
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='section' order by bid asc"));
        }
        return view('contactUs',compact('parents'));
    }
public function gdpr_page($value='')
    { 
        $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
        if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='section' order by bid asc"));  }else{
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='section' order by bid asc"));
        }
        return view('gdpr',compact('parents'));
    }
    public function tags(Request $request)
    {   
        // $currentURL = $request->url();
        //     if ($currentURL != "https://www.Samachar4media.com/tags.html") {
        //     $href = "https://www.Samachar4media.com/tags.html";
        //     return Redirect::to($href, 301); 
        //     }
            // $arrmostread = $this->arrmostread;
            // $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
            // $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            // $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
            // $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
            // $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            // $menus = $this->menus;
        
                $limit = 100;

                $tagshash  = DB::select("CALL gettag($limit)");
            $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
        if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='section' order by bid asc"));  }else{
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='section' order by bid asc"));
        }
            
        return view('tags', compact('tagshash','article','ArrlistingArticlespinit','menus','photogallery','ArrTageListing','arrmostread','ArrMenuSLatestVideo','metatitel','ogtitel','ogimage','metatag',
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

    public function tags_list(Request $request,$name){
     $tagslist = DB::table('tags')->where('tag', 'LIKE', $name.'%')->orderby('tags_id','desc')->limit(100)->get();

        $html='';
        foreach ($tagslist as $product) {
             $html.='<a href="'.url("tags").'/'.str_slug($product->tag).'/name.html" ><button type="button" class="btn tags-btn btn-sm">'.$product->tag.'</button></a>';
        }
        if ($request->ajax()) {
            return $html;
        }
    }

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
                $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
      if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='story' order by bid asc"));  
        }else{ 
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='story' order by bid asc"));  
        }
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

    public function Authorrepo_listing_page(Request $request)
    {
        $ArrAuthorListing = DB::table('authors')->where('valid', '=', 1)->orderby('author_id','asc')->paginate(10);

        $ArrAuthorDetails='';
        $metatitel = 'Samachar4media All Author Profile Page';
        $ogtitel =  '';
        $ogimage = '';
        $ogurl = '';
        $metatag = 'advertising author news, media author news, author';
        $canonical = '';
        $metadescription = 'Samachar4media Author cover advertising, media, digital marketing, PR Industry and agency news in India';
        $ogdescription = '';
        
        $display_name = 'Author';
                $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
        if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='section' order by bid asc"));  }else{
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='section' order by bid asc"));
        }
        return view('article.author_listing', compact('ArrAuthorListing',
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


     /*authors*/
     public function Author_wise_Article_listing_page(Request $request,$name,$id)
    {
     
       $ArrlistingArticles =  Article::with('author')->select(DB::raw('CONCAT(publish_date,publish_time) AS pickdate'),'article_id','title','url','publish_date','publish_time','photopath','authorname','author_id','summary')->where('author_id', '=', $id)->orderby('publish_date','desc')->orderby('publish_time','desc')->paginate(20);
       $authorbio =  DB::table('authors')->where('author_id', '=', $id)->where('valid', '=', 1)->first();
       
        $ArrAuthorDetails='';
        $metatitel = 'Authors profile - Samachar4media';
        $ogtitel =  '';
        $ogimage = '';
        $ogurl = '';
        $metatag = 'Authors page';
        $canonical = '';
        $metadescription = 'Today top advertising news, media, marketing, digital news updates and trending topics story at Samachar4media.com';
        $ogdescription = '';
        $display_name = 'Authors';
                $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
      if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='story' order by bid asc"));  
        }else{ 
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='story' order by bid asc"));  
        }
        return view('article.author_bio_listing', compact('ArrlistingArticles',
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
    public function sitemap(Request $request)
    {  
                $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
        if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='section' order by bid asc"));  }else{
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='section' order by bid asc"));
        }
        $sitemap = DB::table('tbl_menu')->select('id','title','slug')->where('id','!=','18')->get(); 
        return view('sitemap',compact('menus','arrmostread','metatitel','ogtitel','ogimage','metatag','ogurl','metadescription','ogdescription','parents','sitemap'));
    }
    public function privacy(Request $request)
    {  
                $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
        if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='section' order by bid asc"));  }else{
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='section' order by bid asc"));
        }    
        return view('privacy',compact('menus','arrmostread','metatitel','ogtitel','ogimage','metatag','ogurl','metadescription','ogdescription','parents'));
    }
    public function term_page(Request $request)
    {  
                $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
        if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='section' order by bid asc"));  }else{
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='section' order by bid asc"));
        }    
        return view('term',compact('menus','arrmostread','metatitel','ogtitel','ogimage','metatag','ogurl','metadescription','ogdescription','parents'));
    }
    public function cookie_page(Request $request)
    {  
                $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
        if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='section' order by bid asc"));  }else{
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='section' order by bid asc"));
        }    
        return view('cookie',compact('menus','arrmostread','metatitel','ogtitel','ogimage','metatag','ogurl','metadescription','ogdescription','parents'));
    } 
    public function subscriber(Request $request)
    {  
        $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
        if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='section' order by bid asc"));  }else{
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='section' order by bid asc"));
        }    
        return view('subscriber',compact('menus','arrmostread','metatitel','ogtitel','ogimage','metatag','ogurl','metadescription','ogdescription','parents'));
    }   
    /*others*/
    public function breakingNewsDelete()
    {
        $newsUpdate = DB::table('breaking_news')->update(['status'=>'Inactive']);
        Cache::forget('breaking');
    }

    public function Amp_Article_landing_page(Request $request,$section ='',$title ='',$id ='')
    {
            if (Cache::has('articles_'.$id)) {
                $articles= Cache::get('articles_'.$id);
                }else{
                $articles = Article::with('albums', 'albums.photos','author')->select(DB::raw('CONCAT(publish_date,publish_time) AS pickdate'),'article.*')->where('article_id',$id)->get();
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
            $ogimage = 'https://www.samachar4media.com/images/e4m-logo.png';
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

            $xy = explode('/',$ArrViewArticle->url);
            $yz = end($xy);
            $zx = explode (".", $yz);
            $vx = current($zx);
            $vy = explode ("-", $vx);
            $sliced = array_slice($vy, 0, -1); 
            $string = ucwords(implode(" ", $sliced));
            $title = $ArrViewArticle->title.' | '.$string;
        $ArrRecentFeatureNewsList =DB::table('article_feature')->join('article','article.article_id','=','article_feature.story_key_id')->select('article_feature.*','article.category_name','article.summary','article.article_id')->orderby('article_feature.sequence','asc')->orderby('article.publish_date','desc')->limit(10)->get();
        // $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
        

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
                                                            'menus',
                                                            'title'
                                                       ));
    }

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

    public function liveYoutubeData()
    {
        $baseUrl = 'https://www.googleapis.com/youtube/v3/';
        // https://developers.google.com/youtube/v3/getting-started
        $apiKey = 'AIzaSyAmdbfcEfCL07eWwnFDeGmlarLrSGxoZxs';
        // If you don't know the channel ID see below
        $channelId = 'UCqMEhxJQQaFwLH4PUtXjQcw';

        $params = [
            'id'=> $channelId,
            'part'=> 'contentDetails',
            'key'=> $apiKey
        ];
         $url = $baseUrl . 'channels?' . http_build_query($params);
        $json = json_decode(file_get_contents($url), true);

        $playlist = $json['items'][0]['contentDetails']['relatedPlaylists']['uploads'];

        $params = [
            'part'=> 'snippet',
            'playlistId' => $playlist,
            'maxResults'=> '10',
            'key'=> $apiKey
        ];
        $url = $baseUrl . 'playlistItems?' . http_build_query($params);
        $json = json_decode(file_get_contents($url), true);
        foreach($json['items'] as $video){
                $user = Ytube::firstOrNew(array(
                'vid' => $video['snippet']['resourceId']['videoId']
                ));
            if ($user->exists) {

            }else{

                if (isset($video['snippet']['thumbnails']['maxres']['url'])) {
                    $imgthu = $video['snippet']['thumbnails']['maxres']['url'];
                }
                else{
                     $imgthu  = $video['snippet']['thumbnails']['standard']['url'];
                }


                $user->vid = $video['snippet']['resourceId']['videoId'];
                $user->title = $video['snippet']['title'];
                $user->img_thumb = $imgthu;
                $user->publish_date = $video['snippet']['publishedAt'];
                $user->save();
            }
        }
      /*  while(isset($json['nextPageToken'])){
            $nextUrl = $url . '&pageToken=' . $json['nextPageToken'];
            $json = json_decode(file_get_contents($nextUrl), true);
            foreach($json['items'] as $video)
           $user = Ytube::firstOrNew([
                'vid' => $video['snippet']['resourceId']['videoId'],
                ]);
                if ($user->exists) {

                } else {
                    Ytube::create([
                'vid' => $video['snippet']['resourceId']['videoId'],
                'title' => $video['snippet']['title'],
                'img_thumb' => $video['snippet']['thumbnails']['high']['url'],
                'publish_date'=>$video['snippet']['publishedAt']
            ]);
                }
        }*/

            echo 'data fetched!!!';
    }

    public function newsletterArchive($id)
    {
        $exists = File::exists('newsletterhtml/morning-post-'.$id.'.html');
        $exists2 = File::exists('newsletterhtml/evening-post-'.$id.'.html');
        $pervious = DB::table('newsletter_archive')->select('published_date')->orderby('id','desc')->groupby('published_date')->limit(10)->get();
       
        if ($exists || $exists2) {
            if ($exists != null) {
                $html = file_get_contents(url('newsletterhtml/morning-post').'-'.$id.'.html');
            } else {
                $html = '';
            }
            if ($exists2 != null) {
                $htmlEve = file_get_contents(url('newsletterhtml/evening-post').'-'.$id.'.html');
            } else {
                $htmlEve = '';
            }                    
            
            return view('newletter/newsletter_archive',compact('html','htmlEve','pervious'));
        }else{
            $names = File::allFiles('newsletterhtml/');
            foreach ($names as $key => $value) {
                $manuals[] = pathinfo($value);
            }
            foreach ($manuals as $k => $v) {
                    $dates[] = explode('-post-', $v['filename']);
                }
                       
            $html = '';
            $htmlEve = '';

            return view('newletter/newsletter_archive',compact('html','htmlEve','pervious'));
        }

    }

    public function autoComplete(Request $request) {
        $query = $request->get('term','');
        $products=Tag::where('tag','LIKE','%'.$query.'%')->orderby('tags_id','desc')->get();
        // $products=Article::whereRaw("MATCH(title,tags) AGAINST(? IN NATURAL LANGUAGE MODE)",array($query))->orderby('publish_date','desc')->get();
        $data=array();
        foreach ($products as $product) {
                $data[]=array('value'=>$product->tag,'id'=>$product->tags_id);
        }
        if(count($data))
             return $data;
        else
            return false;// ['value'=>'No Result Found','id'=>''];
    }

    /*search*/
      public function searcharticle(Request $request,$result)
        {
            if ($request->search_text != null) {
                $result = $request->search_text;
            }
        $searchArticles=Article::select(DB::raw('CONCAT(publish_date,publish_time) AS pickdate'),'article_id','title','url','publish_date','publish_time','photopath','authorname','author_id','category_name','summary','phototitle')->whereRaw(
      "MATCH(title,tags) AGAINST(? IN NATURAL LANGUAGE MODE)",array($result))->where('publish_date','!=',null)->orderby('publish_date','desc')->orderby('publish_time','desc')->paginate(20);
        if ($searchArticles->isEmpty()) {
            return abort(404);
        }
        $ArrAuthorDetails='';
        $metatitel = '';
        $ogtitel =  '';
        $ogimage = '';
        $ogurl = '';
        $metatag = $result;
        $canonical = '';
        $metadescription = '';
        $ogdescription = '';
        $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
        if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='section' order by bid asc"));  }else{
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='section' order by bid asc"));
        }

        return view('article.search_listing', compact('searchArticles',
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
                                                        'ArrRecentFeatureNewsList',
                                                        'result'
                                                      ));
        }
        public function tagarticle($result)
        {
            
        $searchArticles=Article::select(DB::raw('CONCAT(publish_date,publish_time) AS pickdate'),'article_id','title','url','publish_date','publish_time','photopath','authorname','author_id','category_name','summary','phototitle')->whereRaw(
      "MATCH(title,tags) AGAINST(? IN NATURAL LANGUAGE MODE)",array($result))->where('publish_date','!=',null)->orderby('publish_date','desc')->orderby('publish_time','desc')->paginate(20);

        $ArrAuthorDetails='';
        $metatitel = '';
        $ogtitel =  '';
        $ogimage = '';
        $ogurl = '';
        $metatag = $result;
        $canonical = '';
        $metadescription = '';
        $ogdescription = '';
        $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
        if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='section' order by bid asc"));  }else{
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='section' order by bid asc"));
        }
        return view('article.search_listing', compact('searchArticles',
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
                                                        'ArrRecentFeatureNewsList',
                                                        'result'
                                                      ));
        }
    public function Contactus_Submited(Request $request)
    {  
    	return Redirect::to('contact-us.html')->with('message', 'We are unable to processed right now! Right back soon!');
        $contact = new Contactus();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save(); 
        $data =['name'=>$request->name,'email'=>$request->email,'subject'=>$request->subject,'msg'=>$request->message];
        $subject =   $request->subject;  
        Mail::send('emails.contact',$data, function($message) use($subject)
        {
            $message->to('s4m@exchange4media.com')->subject($subject);
        });
//        Session::flash(); 
// Session::flash('alert-class', 'alert-success'); 
        return Redirect::to('contact-us.html')->with('message', 'Submit your  message successfully');  // <<<<<<<<< see this line
    }

    public function oldStoryRedirect($title)
    {
        $url = Articles::where('slug',$title)->firstOrFail();
        return Redirect()->to($url->url,301);
    }

    /*feature*/
    public function Latest_Article_listing_page(Request $request)
    {     
        $ArrlistingArticles =   Article::select(DB::raw('CONCAT(publish_date,publish_time) AS pickdate'),'article_id','title','url','publish_date','publish_time','photopath','phototitle','authorname','author_id','summary')->orderby('publish_date','desc')->orderby('publish_time','desc')->paginate(20);
        $metatitel = 'मीडिया की दुनिया की खबरें,  विज्ञापन जगत की खबरें | Media News, Advertising News, Media Industry Updates';
        $ogtitel =  'मीडिया की दुनिया की खबरें,  विज्ञापन जगत की खबरें | Media News, Advertising News, Media Industry Updates';
        $ogimage = 'http://www.samachar4media.com/images/logo.png';
        $ogurl = 'https://www.samachar4media.com/';
        $metatag = 'Latest News of  Print Media, News Channels, Digital Media, Hindi Media, Hindi Journalists हिदी पत्रकारिता, पत्रकार, मीडिया, खबरें, मीडिया की दुनिया की खबरें';
        $canonical = '';
        $metadescription = 'Read all latest advertising news, media, marketing, digital, PR Agency news updates, trending topics story and article at Exchange4media.com';
        $ogdescription = '';
        $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
        if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='section' order by bid asc"));  }else{
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='section' order by bid asc"));
        }
        $display_name = 'Latest';
        return view('article.all_article_listing', compact('ArrlistingArticles',
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
}

