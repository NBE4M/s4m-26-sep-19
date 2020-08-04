<?php
namespace App\Http\Controllers\LetterController;
use Config;
use App\Http\Controllers\Common\CommonController;
use Illuminate\Http\Request;
use App\Models\Article;
#use App\Models\Author;
#use App\Models\TagListingWithArticle;
use App\Models\Articleauthor;
use Illuminate\Support\Facades\App;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
//use DB;
use Helper;
use Illuminate\Support\Facades\session;
class HomePageGenerateController extends CommonController
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
/*public function index()
{
}
public function morningnewsletternew1()
{
return view('admin.newsletterh.morningnewsletternew1');
}

public function mainform()
{
return view('admin.newsletterh.mainform');
}*/
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
            public function create(Request $request)
            {
            //$fname  = date('dmY');
           
            $fh = fopen($_SERVER['DOCUMENT_ROOT'] . "../home.html","w");
            // create a new cURL resource
            $ch = curl_init();
             $source = Config::get('constants.SiteBaseurl');
              $url = $source.'/index.php';
             //echo  $url;die;
              //die();
            //$url = "http://exchange4media.com/index.php";
            //$url = "http://www.exchange4media.com/jsonfile/homepage.json";
            if(!function_exists('curl_init')){
            return 'Sorry cURL is not installed!';
            }
            // create a new cURL resource
            $ch = curl_init();
            // set URL and other appropriate options
            // grab URL and pass it to the browser
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            curl_setopt ($ch, CURLOPT_HTTPPROXYTUNNEL, TRUE);
            curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt ($ch, CURLOPT_URL, $url);
            curl_setopt ($ch, CURLOPT_TIMEOUT, 120);
            curl_setopt ($ch, CURLOPT_FILE, $fh);
            // close cURL resource, and free up system resources
            curl_exec ($ch);
            curl_close ($ch);
            fclose($fh);
            //Session::flash('message', "You have created Successfully Newsletter");
            return view('newsletterh.create');
            }


             public function createagain(Request $request)
            {

                 // echo "string";die();
            //$fname  = date('dmY');
           
            $fh = fopen($_SERVER['DOCUMENT_ROOT'] . "/home.html","w");
            // create a new cURL resource
            $ch = curl_init();
            $source = Config::get('constants.SiteBaseurl');
             $url = $source.'/index.php';
             // echo $url;
              //die();
         //   $url = "http://exchange4media.com/index.php";
            if(!function_exists('curl_init')){
            return 'Sorry cURL is not installed!';
            }
            // create a new cURL resource
            $ch = curl_init();
            // set URL and other appropriate options
            // grab URL and pass it to the browser
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            curl_setopt ($ch, CURLOPT_HTTPPROXYTUNNEL, TRUE);
            curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt ($ch, CURLOPT_URL, $url);
            curl_setopt ($ch, CURLOPT_TIMEOUT, 120);
            curl_setopt ($ch, CURLOPT_FILE, $fh);
            // close cURL resource, and free up system resources
            curl_exec ($ch);
            curl_close ($ch);
            fclose($fh);
            //Session::flash('message', "You have created Successfully Newsletter");
            return view('newsletterh.newsletter_article_add')->with('message', "You have created Successfully Newsletter");
            //return view('newsletterh.create');
            }
}
