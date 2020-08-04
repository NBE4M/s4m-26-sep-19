<?php

define("SITE_URL", "https://uat.site.samachar4media.com/");

$key = md5(date('dmY') . 'samachar4media');
$url1=SITE_URL.'/rss/category/3?key=' . $key.'<br>';
$url2= SITE_URL.'/rss/category/4?key=' . $key.'<br>';
$url3= SITE_URL.'/rss/category/5?key=' . $key.'<br>';
// $url4= SITE_URL.'/rss/category/6?key=' . $key.'<br>';
$url5= SITE_URL.'/rss/category/7?key=' . $key.'<br>';
$url6= SITE_URL.'/rss/category/8?key=' . $key.'<br>';
$url7= SITE_URL.'/rss/category/10?key=' . $key.'<br>';
$url8= SITE_URL.'/rss/category/11?key=' . $key.'<br>';
$url9= SITE_URL.'/rss/category/13?key=' . $key.'<br>';
$url10= SITE_URL.'/rss/category/20?key=' . $key.'<br>';
$url11= SITE_URL.'/rss/category/64?key=' . $key.'<br>';
$url12= SITE_URL.'/rss/category/66?key=' . $key.'<br>';
$url13= SITE_URL.'/rss/category/72?key=' . $key.'<br>';
$url14= SITE_URL.'/rss/years/2019?key=' . $key.'<br>';
$url15= SITE_URL.'/rss/months/4?key=' . $key.'<br>';
$url16= SITE_URL.'/rss/facebookinstantarticlesnew?key=' . $key.'<br>';
$url17= SITE_URL.'/rss/facebookinstantarticles?key=' . $key.'<br>';
$url18= SITE_URL.'rss/google-news-sitemap?key=' . $key.'<br>';
$url19= SITE_URL.'rss/category-news-sitemap?key=' . $key.'<br>';
$url=SITE_URL.'/rss/latestfullstory?key=' . $key; 
$data = array($url,$url1,$url2,$url3,$url5,$url6,$url7,$url8,$url9,$url10,$url13,$url14,$url15,$url16,$url17,$url18,$url18);
$r = multiRequest($data);
echo '<pre>';
print_r($r);

function multiRequest($data, $options = array()) {
 
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



/*$url='http://developer.site.exchange4media.com/rss/latestfullstory?key=' . $key; 
$ch = curl_init();
$timeout = 5;
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
$data = curl_exec($ch);
curl_close($ch);
return $data;*/
?>