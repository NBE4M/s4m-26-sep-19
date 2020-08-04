<?php

namespace App\Http\Controllers\Contactus;
use Config;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Contactus;

use Response;
use App\Models\Mostread;
use DB;
use App\Models\Article;
use App\Models\Category;
use App\Models\Author;
use App\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Session;
use App\Models\Subscribenewsletter;
use Mail;
use App\Models\Topic;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect; 
use Str;
use URL;
use DateTime;
use App\Menu;
use Carbon\Carbon;
class ContactusController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Contactus Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles requesting users for the application and
    | redirecting them to your Contactus landing screen. The controller uses a trait
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
        $ArrRecentNewsMiddelbarList = Article::select('article_id','title','url','publish_date','publish_time','photopath','phototitle')->where('important', 0)->where('web_exclusive', 0)->where('category_id','!=', 35)->orderby('publish_date','desc')->orderby('publish_time','desc')->limit(10)->get();
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
    public function Contactus_page(Request $request)
    {  
            $arrmostread = $this->arrmostread;
            $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
            $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
            $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
            $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            $menus = $this->menus;
            $parents = $this->parents;
        return view('contactus.contactus',compact('article','ArrlistingArticlespinit','menus','photogallery','ArrTageListing','arrmostread','ArrMenuSLatestVideo','metatitel','ogtitel','ogimage','metatag',
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



    /*other*/
    public function privacy_page(Request $request)
    {  
            $arrmostread = $this->arrmostread;
            $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
            $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
            $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
            $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            $menus = $this->menus;
            $parents = $this->parents;
        return view('privacy',compact('article','ArrlistingArticlespinit','menus','photogallery','ArrTageListing','arrmostread','ArrMenuSLatestVideo','metatitel','ogtitel','ogimage','metatag',
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

    public function term_page(Request $request)
    {  
            $arrmostread = $this->arrmostread;
            $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
            $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
            $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
            $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            $menus = $this->menus;
            $parents = $this->parents;
        return view('term',compact('article','ArrlistingArticlespinit','menus','photogallery','ArrTageListing','arrmostread','ArrMenuSLatestVideo','metatitel','ogtitel','ogimage','metatag',
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

    public function gdpr_page(Request $request)
    {  
            $arrmostread = $this->arrmostread;
            $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
            $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
            $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
            $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            $menus = $this->menus;
            $parents = $this->parents;
        return view('gdpr',compact('article','ArrlistingArticlespinit','menus','photogallery','ArrTageListing','arrmostread','ArrMenuSLatestVideo','metatitel','ogtitel','ogimage','metatag',
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

    public function cookie_page(Request $request)
    {  
            $arrmostread = $this->arrmostread;
            $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
            $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
            $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
            $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            $menus = $this->menus;
            $parents = $this->parents;
        return view('cookie',compact('article','ArrlistingArticlespinit','menus','photogallery','ArrTageListing','arrmostread','ArrMenuSLatestVideo','metatitel','ogtitel','ogimage','metatag',
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


     public function sitemap(Request $request)
    {  
            // $arrmostread = $this->arrmostread;
            // $ArrMenuSLatestVideo = $this->ArrMenuSLatestVideo;
            // $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            // $ArrRecentImportaintNewsHeaderList = $this->ArrRecentImportaintNewsHeaderList;
            // $ArrRecentFeatureNewsList = $this->ArrRecentFeatureNewsList;
            // $ArrRecentNewsMiddelbarList = $this->ArrRecentNewsMiddelbarList;
            // $menus = $this->menus;
            // $parents = $this->parents;
        return view('sitemap',compact('article','ArrlistingArticlespinit','menus','photogallery','ArrTageListing','arrmostread','ArrMenuSLatestVideo','metatitel','ogtitel','ogimage','metatag',
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
    /*others*/


   

     public function tags(Request $request)
    {   $currentURL = $request->url();
            if ($currentURL != "https://www.samachar4media.com/tags.html") {
            $href = "https://www.samachar4media.com/tags.html";
            return Redirect::to($href, 301); 
            }
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
    
                $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='home' order by bid asc"));
                }else{ 
                $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='home' order by bid asc"));  
                }
                $limit = 100;
                $tagshash  = DB::select("CALL gettag($limit)");
             
               
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



    /*subscription*/


    public function Subscribenewsletter_Submited(Request $request)
    {   
        
        $user = Subscribenewsletter::firstOrNew(array(
            'email' => $request->s_email
            ));
    if ($user->exists) {
        return 'email address is already registered'; 
        }else{
        $Subscribenewsletter = new Subscribenewsletter();
        $Subscribenewsletter->email = $request->s_email;
        $Subscribenewsletter->stype = $request->stype;
        $Subscribenewsletter->statuss = 'inactive';
        $Subscribenewsletter->save();
        $inputs = $request->all();
        $mail = Mail::send('emails.subscribe', array('email'=>$inputs['s_email']), function($message) use ($request)
        {
            $message->from('info@samachar4media.com','samachar4media ');
            $message->to($request->s_email)->cc('aakashe4m.new@gmail.com')->subject('e4mSubscription - Activated: Advt Mailers');
        });
            try{
                    $url = 'https://api.elasticemail.com/v2/contact/add?publicAccountID=b1c4cf29-a153-4b17-bc0b-7f99409878de&email='.$request->s_email.'&listName=DNL_engaged_27may2016';
                    $urlfinal = 'https://api.elasticemail.com/v2/contact/add?publicAccountID=5c43cbab-a559-44b3-9b3e-040d049884e9&email='.$request->s_email.'&listName=e4m_engaged_list_final';
                    $dataarray = array($url,$urlfinal);
                    $this->multiRequest($dataarray);
                    }
                    catch(Exception $ex){
                    echo $ex->getMessage();
                }
               return 'Thankyou For subscription'; 
        
    }
        
    
}
    


      public function Subscriber_update(Request $request)
    {  
        Subscribenewsletter::where('email', $request->email)->update(array('statuss' => 'active'));
        return response()->json(['success'=>'done']); 
        
    }

    public function create_event(Request $request)
    {  
        return view('create_event');
        
    }


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



public function tags_list(Request $request,$name){
     $tagslist = DB::table('tags')->where('tag', 'LIKE', $name.'%')->orderby('tags_id','desc')->limit(100)->get();
        $html='';
        foreach ($tagslist as $product) {
             $html.='<a href="https://www.samachar4media.com/tags/'.str_slug($product->tag).'.html" class="btn tags">'.$product->tag.'</a>';
        }
        if ($request->ajax()) {
            return $html;
        }
}
   
   
}
