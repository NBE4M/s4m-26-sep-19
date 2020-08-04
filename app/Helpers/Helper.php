<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
class Helper
{
 public static function rscUrl($string) {
        //Lower case everything
        $string = strtolower($string);
        //Make alphanumeric (removes all other characters)
        $string = str_slug($string, '-');
        return $string;
    }

public static function is_url_exist($url){
            $ch = curl_init($url);    
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if($code == 200){
               $status = true;
            }else{
              $status = false;
            }
            curl_close($ch);
           return $status;
        }

//public static function get_article($id) {
public static  function get_article($id, $columns = array('*')) {
        //echo $id;
       // die();
        $attrs = \DB::select('CALL article(?);',[$id]);
        // return single store
        return array($attrs[0]);
    }



    public static function stay(){

if (Cache::has('steyconnect')) {
$steyconnect= Cache::get('steyconnect');
}else{
$steyconnect = DB::table("tbl_stay_connected")->orderby('id','desc')->first();
Cache::put('steyconnect', $steyconnect, 1000);
};

return $steyconnect;
}


public static function trand(){

if (Cache::has('trending')) {
$trending= Cache::get('trending');
}else{
$trending = DB::table("trending_tags")->select('tags as tag')->orderby('hits','desc')->limit(6)->get();
Cache::put('trending', $trending, 1000);
};

return $trending;

    }

}