<?php

namespace App\Http\Controllers\LetterController;
use Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
#use App\Models\Author;
#use App\Models\TagListingWithArticle;
use App\Models\Articleauthor;
use Illuminate\Support\Facades\App;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Subscribenewsletter;
use Validator;
use Helper;

class LetterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Newsletter Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles requesting users for the application and
    | redirecting them to your newsletter landing screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /*morning post*/
    public function Morning_N_Page_New4(Request $request)
    {
      // $parents = DB::select( DB::raw("SELECT bscript,status FROM banner order by bid asc"));

        $countarticle = DB::table('article')
        ->JOIN('master_newsletter_articles', 'article.article_id', '=', 'master_newsletter_articles.article_id')
        ->select('article.*','master_newsletter_articles.master_newsletter_id')
                   // ->select('article.*','master_newsletter_articles.master_newsletter_id')
        ->where('master_newsletter_id', 1)->where('is_deleted', 0)->orderBy('master_newsletter_articles.sequence','DESC')->count();

        $ArrViewArticle = DB::table('article')
        ->JOIN('master_newsletter_articles', 'article.article_id', '=', 'master_newsletter_articles.article_id')
        ->select('article.*','master_newsletter_articles.master_newsletter_id')
                   // ->select('article.*','master_newsletter_articles.master_newsletter_id')
        ->where('master_newsletter_id', 1)->where('is_deleted', 0)->orderBy('master_newsletter_articles.sequence','ASC')->take($countarticle)->get();

        $ArrRecentArticleGuestColumn = DB::table('article')
        ->JOIN('master_newsletter_articles', 'article.article_id', '=', 'master_newsletter_articles.article_id')
        
        ->select('article.*','master_newsletter_articles.master_newsletter_id')
        ->where('master_newsletter_id', 1)->where('is_deleted', 0)->orderBy('master_newsletter_articles.sequence','ASC')
        ->skip($countarticle-3)->take(3)->get();

        // $ArrRecentCategoryAricle = DB::table('article')
        //             ->select('*')->where('category_id', '=', '35')->orderBy('publish_date','DESC')->orderBy('publish_time','ASC')->take(3)->get();
                    // dd($ArrRecentCategoryAricle);
        $ArrRecentCategoryAriclenew = DB::table('article')

        ->select('*')->where('category_id', '=', '35')->orderBy('publish_date','DESC')->orderBy('publish_time','ASC')->take(3)->get();   
         //echo '<pre>';print_r($ArrRecentCategoryAricle);echo '</pre>'; exit;
        // $ArrRecentShowcaseVideo = Video::where('video_type', '=', 2)->take(3)->get(); 
        $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
      if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='newsletter' order by bid asc"));  
        }else{ 
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='newsletter' order by bid asc"));  
        }              

        return view('newletter.newsletter', compact('ArrViewArticle',
            // 'ArrRecentShowcaseVideo',
            'ArrRecentCategoryAriclenew',
            'ArrRecentCategoryAricle',
            'ArrRecentArticleGuestColumn',
            'ArrSideViewArticle',
            'parents'
        ));
    }
    
    public function Afternoon_Post_page(Request $request)
    {
      //  DB::enableQueryLog();
     $ArrViewArticle = DB::table('article')
     ->JOIN('master_newsletter_articles', 'article.article_id', '=', 'master_newsletter_articles.article_id')


     ->select('article.*','master_newsletter_articles.master_newsletter_id')
     ->where('master_newsletter_id', 3)->where('is_deleted', 0)->orderBy('master_newsletter_articles.sequence','ASC')->get();     
      //   dd(DB::getQueryLog());
     return view('newletter.afternoon_post', compact('ArrViewArticle'));
 } 



 public function Evening_Post_page(Request $request)
 {


    $countarticle = DB::table('article')
        ->JOIN('master_newsletter_articles', 'article.article_id', '=', 'master_newsletter_articles.article_id')
        ->select('article.*','master_newsletter_articles.master_newsletter_id')
                   // ->select('article.*','master_newsletter_articles.master_newsletter_id')
        ->where('master_newsletter_id', 3)->where('is_deleted', 0)->orderBy('master_newsletter_articles.sequence','DESC')->count();

        $ArrViewArticle = DB::table('article')
        ->JOIN('master_newsletter_articles', 'article.article_id', '=', 'master_newsletter_articles.article_id')
        ->select('article.*','master_newsletter_articles.master_newsletter_id')
                   // ->select('article.*','master_newsletter_articles.master_newsletter_id')
        ->where('master_newsletter_id', 3)->where('is_deleted', 0)->orderBy('master_newsletter_articles.sequence','ASC')->take($countarticle)->get();

        $ArrRecentArticleGuestColumn = DB::table('article')
        ->JOIN('master_newsletter_articles', 'article.article_id', '=', 'master_newsletter_articles.article_id')
        
        ->select('article.*','master_newsletter_articles.master_newsletter_id')
        ->where('master_newsletter_id', 3)->where('is_deleted', 0)->orderBy('master_newsletter_articles.sequence','ASC')
        ->skip($countarticle-3)->take(3)->get();

        // $ArrRecentCategoryAricle = DB::table('article')
        //             ->select('*')->where('category_id', '=', '35')->orderBy('publish_date','DESC')->orderBy('publish_time','ASC')->take(3)->get();
                    // dd($ArrRecentCategoryAricle);
        $ArrRecentCategoryAriclenew = DB::table('article')

        ->select('*')->where('category_id', '=', '35')->orderBy('publish_date','DESC')->orderBy('publish_time','ASC')->take(3)->get();   
         //echo '<pre>';print_r($ArrRecentCategoryAricle);echo '</pre>'; exit;
        // $ArrRecentShowcaseVideo = Video::where('video_type', '=', 2)->take(3)->get(); 
        $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
      if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='newsletter' order by bid asc"));  
        }else{ 
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='newsletter' order by bid asc"));  
        }              

        return view('newletter.evening_post', compact('ArrViewArticle',
            // 'ArrRecentShowcaseVideo',
            'ArrRecentCategoryAriclenew',
            'ArrRecentCategoryAricle',
            'ArrRecentArticleGuestColumn',
            'ArrSideViewArticle',
            'parents'
        ));
} 



public function Breaking_News_page(Request $request)
{


   $ArrViewArticle = DB::table('article')
   ->JOIN('master_newsletter_articles', 'article.article_id', '=', 'master_newsletter_articles.article_id')

   ->select('article.*','master_newsletter_articles.master_newsletter_id')
                    //->select('article.*','master_newsletter_articles.master_newsletter_id')
   ->where('master_newsletter_id', 2)->where('is_deleted', 0)->orderBy('master_newsletter_articles.sequence','ASC')->first();
      $useragent = isset($_SERVER['HTTP_USER_AGENT'])
        ? strtolower($_SERVER['HTTP_USER_AGENT'])
        : '';
      if(preg_match('/(ipad)/i',$useragent)||preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
        $parents = DB::select( DB::raw("SELECT * FROM banner where mobile=1 AND forpage='newsletter' order by bid asc"));  
        }else{ 
        $parents = DB::select( DB::raw("SELECT * FROM banner where desktop=1 AND forpage='newsletter' order by bid asc"));  
        }     

   return view('newletter.breaking_news', compact('ArrViewArticle','parents'));
} 




public function News_Update_page(Request $request)
{

    $ArrViewArticle = DB::table('article')
    ->JOIN('master_newsletter_articles', 'article.article_id', '=', 'master_newsletter_articles.article_id')


    ->select('article.*','master_newsletter_articles.master_newsletter_id')
                    //->select('article.*','master_newsletter_articles.master_newsletter_id')
    ->where('master_newsletter_id', 2)->where('is_deleted', 0)->orderBy('master_newsletter_articles.sequence','ASC')->get();  

    return view('newletter.news_update', compact('ArrViewArticle'));
}

public function sub_newsletter(Request $request)
{
  $validator = Validator::make($request->all(), [
    'email' => 'required|unique:subscribe_newsletter|max:255',
]);
  
  $sub  = new Subscribenewsletter();
  $sub->email = $request->email;
  $sub->save();
  $emails = [$request->email,'aakash.e4mnew@gmail.com'];

  try{
    $url = 'https://api.elasticemail.com/v2/contact/add?publicAccountID=89525eb1-7c86-4eea-99e2-369a14de4bbd';
    $post = array(
        'email' => $request->email,
        'listName' => 's4m-database-10-aug'
    );
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $post,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => false,
        CURLOPT_SSL_VERIFYPEER => false
    ));

    $result=curl_exec ($ch);
    curl_close ($ch);
                // echo $result; 
    Mail::send('emails.welcome', ['email'=>$request->email], function($message) use ($emails)
    {    
        $message->to($emails)->subject('S4MSubscription - Activated: Advt Mailers');    
    });
    return  $request->email;
}
catch(Exception $ex){
    echo $ex->getMessage();
}



} 
}
