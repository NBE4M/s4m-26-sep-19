<?php

namespace App\Http\Controllers\Rss;

use Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Storage;
use Helper;
use File;

class RssController extends Controller {
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
    private $key;
    private $requested_key;
    
    public function __construct(){

       $this->key=md5(date("dmY").'samachar4media');
       if(!isset($_GET['key'])){
           echo "Not authorized to access."; exit;  
       }
    }
    
    public function individualRss($id) {
        $this->requested_key=$_GET['key']; 
        if($this->key!=$this->requested_key){
        echo "Not authorized to access."; exit;            
        }
        $xml = new \DOMDocument('1.0','utf-8');
        $xml->formatOutput = true;
        //DB::enableQueryLog();
        $article=Article::where('article_id', '=', $id)->first();
        $xml_rss = $xml->createElement("rss");
        $attribute_rss_atom = $xml->createAttribute('xmlns:atom');
        $attribute_rss_atom->value = 'https://www.w3.org/2005/Atom';
        $attribute_rss_version = $xml->createAttribute('version');
        $attribute_rss_version->value = '2.0';
        $xml_rss->appendChild($attribute_rss_atom);
        $xml_rss->appendChild($attribute_rss_version);
        //Channel element
        $xml_rss_channel = $xml->createElement("channel");       
        // Adding title under channel
        $xml_rss_channel->appendChild( $xml->createElement('title','www.samachar4media.com (Fullstory)')); 
        // Adding description under channel
        $xml_rss_channel->appendChild($xml->createElement('description','Media News, Advertising News, Media Industry Updates – Samachar4media')); 
        //Adding language under channel
        $xml_rss_channel->appendChild($xml->createElement('language','hi'));
        // Adding copyright under channel
        $xml_rss_channel->appendChild($xml->createElement('copyright','Copyright @ 2008 samachar4media Media Private Limited. All rights reserved'));
        $xml_rss_channel_atom=$xml->createElement('atom:link');
        $attribute_rss_channel_atom_href= $xml->createAttribute('href');
        $attribute_rss_channel_atom_href->value = config('constants.awsbaseurl').'rss/'.$id.'.xml';
        $attribute_rss_channel_atom_rel= $xml->createAttribute('rel');
        $attribute_rss_channel_atom_rel->value = 'self';
        $attribute_rss_channel_atom_type= $xml->createAttribute('type');
        $attribute_rss_channel_atom_type->value = 'application/rss+xml';
        $xml_rss_channel_atom->appendChild($attribute_rss_channel_atom_href);
        $xml_rss_channel_atom->appendChild($attribute_rss_channel_atom_rel);
        $xml_rss_channel_atom->appendChild($attribute_rss_channel_atom_type);
        $xml_rss_channel->appendChild($xml_rss_channel_atom);
        // Creating item element
        $xml_rss_channel_item=$xml->createElement('item');
        // Item title
        $xml_rss_channel_item->appendChild($xml->createElement('title',htmlspecialchars($article['title'],ENT_XML1, 'UTF-8')));
        /* $xml_rss_channel_item->appendChild($xml->createElement('link',$id));*/
         $author=($article['author_type']==1)?'S4M Online Bureau':$article['authorname'];
         $xml_rss_channel_item->appendChild($xml->createElement('author',$author));
         $xml_rss_channel_item->appendChild($xml->createElement('pubDate',date('d/m/Y',strtotime($article['publish_date']))));
         $xml_rss_channel_item->appendChild($xml->createElement('description',htmlspecialchars($article['description'],ENT_XML1, 'UTF-8')));
         $image=trim($article->photopath)?config('constants.awsbaseurl').trim($article->photopath):'';
         $xml_rss_channel_item->appendChild($xml->createElement('storyimages',$image));
         $xml_rss_channel_item->appendChild($xml->createElement('guid',$id));
        //Adding  item under channel
        $xml_rss_channel->appendChild($xml_rss_channel_item);
        $xml_rss->appendChild($xml_rss_channel);
        $xml->appendChild($xml_rss);
        $xml->save($_SERVER['DOCUMENT_ROOT']."/cms/cms_uploadfile/fullstory/" . $id . ".xml");
         Storage::disk('rss')->put($id . ".xml",
        file_get_contents(public_path()."/cms/cms_uploadfile/fullstory/" . $id . ".xml"),
        \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
        );
    }

    public function latestFullStoryRss() {
        $this->requested_key=$_GET['key']; 
        if($this->key!=$this->requested_key){
        echo "Not authorized to access."; exit;            
        }
        $xml = new \DOMDocument('1.0', 'utf-8');
        $xml->formatOutput = true;
        $xml_urlset = $xml->createElement("rss");
        $attribute_urlset_xmlns = $xml->createAttribute('version');
        $attribute_urlset_xmlns->value = '2.0';
        $xml_urlset->appendChild($attribute_urlset_xmlns);
        $xml_urlset_channel = $xml->createElement("channel");
         $xml_urlset_channel->appendChild( $xml->createElement('title','www.samachar4media.com (Fullstory)')); 
         $xml_urlset_channel->appendChild( $xml->createElement('link','https://www.samachar4media.com')); 
        // Adding description under channel
        $xml_urlset_channel->appendChild($xml->createElement('description','News Marketing India advertising Indian brands tv media newspapers')); 
        //Adding language under channel
        $xml_urlset_channel->appendChild($xml->createElement('language','hi'));
       /* $articles=  DB::select("select ar.*,cat.category_id,cat.name,concat(ar.publish_date,ar.publish_time) as published from (SELECT * FROM `article` limit 25) ar inner join article_category ar_cat on ar.article_id=ar_cat.article_id inner join category cat on ar_cat.category_id=cat.category_id group by ar.article_id order by published desc");*/
     
     $articles=  DB::select("select article_id,photopath,title,description,publish_date,category_id,url,category_name,concat(publish_date,' ',publish_time) as published from `article` group by article_id order by `publish_date` desc limit 50");
     
         foreach($articles as $article){
           $pubDate = gmdate(DATE_RFC822 , strtotime($article->publish_date));
            $xml_urlset_url=$xml->createElement('item');
            $xml_urlset_url->appendChild($xml->createElement('title',htmlspecialchars($article->title,ENT_XML1, 'UTF-8')));
             $xml_urlset_url->appendChild($xml->createElement('link','<![CDATA['.$article->url.']]>'));
              $xml_urlset_url->appendChild($xml->createElement('description',htmlspecialchars($article->description,ENT_XML1, 'UTF-8')));
             $xml_urlset_url->appendChild($xml->createElement('pubDate',$pubDate));
            $xml_urlset_channel->appendChild($xml_urlset_url);
         }
         //dd($articles);
        $xml_urlset->appendChild($xml_urlset_channel);
        $xml->appendChild($xml_urlset);
        $xml->save(public_path()."/cms/cms_uploadfile/latest-news-with-full-story.xml");
        Storage::disk('rss')->put('latest-news-with-full-story.xml',
        file_get_contents(public_path()."/cms/cms_uploadfile/latest-news-with-full-story.xml"),
        \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
        );

    }


    /*for fb*/
     public function facebookinstantarticles() {
      $requested_key = md5(date("dmY").'samachar4media');
       
        if($this->key!=$requested_key){
        echo "Not authorized to access."; exit;            
        }

        $xml = new \DOMDocument('1.0', 'utf-8');
        $xml->formatOutput = true;
        $xml_urlset = $xml->createElement("rss");
        $attribute_urlset_xmlns1 = $xml->createAttribute('version');
        $attribute_urlset_xmlns1->value = '2.0';
        $attribute_urlset_xmlns = $xml->createAttribute('xmlns:content');
        $attribute_urlset_xmlns->value = 'https://purl.org/rss/1.0/modules/content/';
         $xml_urlset->appendChild($attribute_urlset_xmlns1);
        $xml_urlset->appendChild($attribute_urlset_xmlns);
     $articles=  DB::select("select article_id,photopath,title,description,publish_date,category_id,category_name,concat(publish_date,' ',publish_time) as published from `article` group by article_id order by `publish_date` desc limit 100");
         foreach($articles as $article){
             $pubDate = gmdate(DATE_RFC822 , strtotime($article->publish_date));
          $urlnew = url(Helper::rscUrl($article->category_name).'/'.Helper::rscUrl($article->title).'_'.$article->article_id.'.html');
                $xml_urlset_url_html = $xml->createElement('html');
                $attribute_urlset_at1 = $xml->createAttribute('lang');
                $attribute_urlset_at1->value = 'hi';
                $attribute_urlset_at2 = $xml->createAttribute('prefix');
                $attribute_urlset_at2->value = "op: https://media.facebook.com/op#";
                $xml_urlset_url_html->appendChild($attribute_urlset_at1);
                $xml_urlset_url_html->appendChild($attribute_urlset_at2);
                $xml_urlset_url_head = $xml->createElement('head',' <link rel="canonical" href="https://www.samachar4media.com">
                    <meta charset="utf-8">
                <link rel="canonical" href="' . $urlnew . '">
                <meta property="op:markup_version" content="v1.0">');
                $xml_urlset_url_html->appendChild($xml_urlset_url_head);
                $xml_urlset_url_body = $xml->createElement('body');
                $xml_urlset_url_html->appendChild($xml_urlset_url_body);
                $xml_urlset_url_article = $xml->createElement('article','<p>'.htmlspecialchars($article->description,ENT_XML1, 'UTF-8').'</p>');
                $xml_urlset_url_body->appendChild($xml_urlset_url_article);
                $xml_urlset_url_header = $xml->createElement('header','<h1>'.htmlspecialchars($article->title).'</h1>
                <h2>'.htmlspecialchars($article->title).'</h2>');
                $xml_urlset_url_article->appendChild($xml_urlset_url_header);
                $image=trim($article->photopath)?Config::get('constants.awsbaseurl').str_slug($article->photopath):'';
                $xml_urlset_url_hfigure = $xml->createElement('figure','<img src="'.$image.'" />');
                $xml_urlset_url_header->appendChild($xml_urlset_url_hfigure);
                $xml_urlset_url_figcaption = $xml->createElement('figcaption','This image is amazing');
                $xml_urlset_url_hfigure->appendChild($xml_urlset_url_figcaption);
                $xml_urlset_url_time1 = $xml->createElement('time');
                $attribute_urlset_timeat1 = $xml->createAttribute('class');
                $attribute_urlset_timeat1->value = 'op-published';
                $xml_urlset_url_time1->appendChild($attribute_urlset_timeat1);
                $attribute_urlset_timeat2 = $xml->createAttribute('datetime');
                $attribute_urlset_timeat2->value = $pubDate;
                $xml_urlset_url_time1->appendChild($attribute_urlset_timeat2);
                $xml_urlset_url_header->appendChild($xml_urlset_url_time1);
                $xml_urlset_url_time2 = $xml->createElement('time');
                $attribute_urlset_time2at1 = $xml->createAttribute('class');
                $attribute_urlset_time2at1->value = 'op-modified';
                $xml_urlset_url_time2->appendChild($attribute_urlset_timeat1);
                $attribute_urlset_time2at2 = $xml->createAttribute('datetime');
                $attribute_urlset_time2at2->value = $pubDate;
                $xml_urlset_url_time2->appendChild($attribute_urlset_timeat2);
                $xml_urlset_url_header->appendChild($xml_urlset_url_time2);
                $xml_urlset_url_address = $xml->createElement('address','<a rel="facebook" href="https://samachar4media.com/author/samachar4media-news-service-49.html">(samachar4media News Service</a>
         content@samachar4media.com');
                $xml_urlset_url_header->appendChild($xml_urlset_url_address);
                $xml_urlset_url_afigure = $xml->createElement('figure','<img src="'.$image.'" />');
                $xml_urlset_url_article->appendChild($xml_urlset_url_afigure);
                $xml_urlset_url_footer = $xml->createElement('footer');
                $xml_urlset_url_article->appendChild($xml_urlset_url_footer);
                $xml_urlset->appendChild($xml_urlset_url_html);

         }
         //dd($articles);
          
            $xml->appendChild($xml_urlset);
            $xml->save(public_path()."/facebookinstantarticles.rss");
            Storage::disk('rss')->put('facebookinstantarticles.rss',
            file_get_contents(public_path()."/facebookinstantarticles.rss"),
            \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
            );
            $file = file_get_contents('facebookinstantarticles.rss');
            $new = html_entity_decode($file);
            $myfile = fopen("facebookinstantarticles.rss", "w") or die("Unable to open file!");
            fwrite($myfile, $new);
            fclose($myfile);

    }
    /*for fb*/


      /*for fb*/
     public function facebookinstantarticlesnew() {
       $requested_key = md5(date("dmY").'samachar4media');
        
        if($this->key!=$requested_key){
        echo "Not authorized to access."; exit;            
        }
          $d = date( 'Y-m-d H:i:s T', time() );
          $mysqldate = gmdate(DATE_RSS , strtotime($d));
        $xml = new \DOMDocument('1.0', 'utf-8');
        $xml->formatOutput = true;
        $xml_urlset = $xml->createElement("rss");
        $attribute_urlset_xmlns1 = $xml->createAttribute('version');
        $attribute_urlset_xmlns1->value = '2.0';
        $attribute_urlset_xmlns = $xml->createAttribute('xmlns:content');
        $attribute_urlset_xmlns->value = 'https://purl.org/rss/1.0/modules/content/';
         $xml_urlset->appendChild($attribute_urlset_xmlns1);
        $xml_urlset->appendChild($attribute_urlset_xmlns);
          $xml_urlset_channel=$xml->createElement('channel');
            $xml_urlset_channel->appendChild($xml->createElement('title','samachar4media'));
            $xml_urlset_channel->appendChild($xml->createElement('link','https://www.samachar4media.com'));
            $xml_urlset_channel->appendChild($xml->createElement('description','At samachar4media, read the latest news and updates on advertising agencies, marketing, print, radio, digital, television, media, events and happenings in India.'));
            $xml_urlset_channel->appendChild($xml->createElement('language','hi'));
            $xml_urlset_channel->appendChild($xml->createElement('lastBuildDate',$mysqldate));

       /* $articles=  DB::select("select ar.*,cat.category_id,cat.name,concat(ar.publish_date,ar.publish_time) as published from (SELECT * FROM `article` limit 25) ar inner join article_category ar_cat on ar.article_id=ar_cat.article_id inner join category cat on ar_cat.category_id=cat.category_id group by ar.article_id order by published desc");*/
     
     $articles=  DB::select("select article_id,photopath,title,description,summary,publish_date,category_id,category_name,concat(publish_date,' ',publish_time) as published from `article` group by article_id order by `publish_date` desc limit 11");
         foreach($articles as $article){
          $pubDate = gmdate(DATE_RFC822 , strtotime($article->publish_date));
          $urlnew = url(Helper::rscUrl($article->category_name).'/'.Helper::rscUrl($article->title).'_'.$article->article_id.'.html');
                  $xml_urlset_url_item=$xml->createElement('item');
                  $xml_urlset_url_item->appendChild($xml->createElement('title',htmlspecialchars($article->title,ENT_XML1, 'UTF-8')));
                  $xml_urlset_url_item->appendChild($xml->createElement('link',url(Helper::rscUrl($article->category_name).'/'.Helper::rscUrl($article->title).'-'.$article->article_id.'.html')));
                  $xml_urlset_url_item->appendChild($xml->createElement('guid',url(Helper::rscUrl($article->category_name).'/'.Helper::rscUrl($article->title).'-'.$article->article_id.'.html')));
                  $xml_urlset_url_item->appendChild($xml->createElement('pubDate',htmlspecialchars($pubDate,ENT_XML1, 'UTF-8')));
                  $xml_urlset_url_item->appendChild($xml->createElement('author','content@samachar4media.com (samachar4media News Service)'));
                  $xml_urlset_url_item->appendChild($xml->createElement('description',htmlspecialchars($article->summary,ENT_XML1, 'UTF-8')));
                   $image=trim($article->photopath)?Config::get('constants.awsbaseurl').trim($article->photopath):'';
                   
                  $xml_urlset_url_content = $xml->createElement('content:encoded');
                   $xml_urlset_url_html = $xml->createElement('html');
                   $attribute_urlset_at1 = $xml->createAttribute('lang');
                   $attribute_urlset_at1->value = 'hi';
                   $attribute_urlset_at2 = $xml->createAttribute('prefix');
                   $attribute_urlset_at2->value = "op: http://media.facebook.com/op#";
                   $xml_urlset_url_html->appendChild($attribute_urlset_at1);
                 $xml_urlset_url_html->appendChild($attribute_urlset_at2);
                   $xml_urlset_url_content->appendChild($xml_urlset_url_html);
                   $xml_urlset_url_header = $xml->createElement('header','<time class="op-published" datetime="'.$pubDate.'">'.htmlspecialchars($pubDate,ENT_XML1, 'UTF-8').'</time>');
                    $xml_urlset_url_head = $xml->createElement('head','<link rel="canonical" href="' . $urlnew . '">
                    <meta property="op:markup_version" content="v1.0">
                    <meta charset="utf-8">
                    <meta property="op:markup_version" content="v1.0">');
                    $xml_urlset_url_html->appendChild($xml_urlset_url_head);
                    $xml_urlset_url_body = $xml->createElement('body');
                    $xml_urlset_url_html->appendChild($xml_urlset_url_body);
                    $xml_urlset_url_article = $xml->createElement('article');
                    $xml_urlset_url_article->appendChild($xml_urlset_url_header);
                    $xml_urlset_url_article->appendChild($xml->createElement('figure','<image><img src="' . $image . '" alt="Smiley face" height="470" width="870"></image>'));
                    $xml_urlset_url_article->appendChild($xml->createElement('p',htmlspecialchars($article->description,ENT_XML1, 'UTF-8')));
                    $xml_urlset_url_body->appendChild($xml_urlset_url_article);
                    $xml_urlset_url_article->appendChild($xml->createElement('footer','<aside>@2018</aside>'));
                     $xml_urlset_url_item->appendChild($xml_urlset_url_content);
                    $xml_urlset_channel->appendChild($xml_urlset_url_item);
                    $xml_urlset->appendChild($xml_urlset_channel);
         }
         //dd($xml_urlset);
          
                    $xml->appendChild($xml_urlset);
                    $xml->save(public_path()."/facebookinstantarticlesnew.rss");
                    $file = file_get_contents('facebookinstantarticlesnew.rss');
                    $new = html_entity_decode($file);
                    $myfile = fopen("facebookinstantarticlesnew.rss", "w") or die("Unable to open file!");
                    fwrite($myfile, $new);
                    fclose($myfile);
          
    }
    /*for fb*/


     /*Neetesh rss*/
       public function latestFullStoryRssagain() {
        $this->requested_key=$_GET['key']; 
        if($this->key!=$this->requested_key){
        echo "Not authorized to access."; exit;            
        }
        $xml = new \DOMDocument('1.0', 'utf-8');
        $xml->formatOutput = true;

        $xml_urlset = $xml->createElement("urlset");
        $attribute_urlset_xmlns = $xml->createAttribute('xmlns');
        $attribute_urlset_xmlns->value = 'http://www.sitemaps.org/schemas/sitemap/0.9';
        $attribute_uirlset_xmlns_image = $xml->createAttribute('xmlns:image');
        $attribute_uirlset_xmlns_image->value = 'http://www.google.com/schemas/sitemap-image/1.1';
        $attribute_uirlset_xmlns_news = $xml->createAttribute('xmlns:news');
        $attribute_uirlset_xmlns_news->value = 'http://www.google.com/schemas/sitemap-news/0.9';
        $xml_urlset->appendChild($attribute_urlset_xmlns);
        $xml_urlset->appendChild($attribute_uirlset_xmlns_image);
        $xml_urlset->appendChild($attribute_uirlset_xmlns_news);

       /* $articles=  DB::select("select ar.*,cat.category_id,cat.name,concat(ar.publish_date,ar.publish_time) as published from (SELECT * FROM `article` limit 25) ar inner join article_category ar_cat on ar.article_id=ar_cat.article_id inner join category cat on ar_cat.category_id=cat.category_id group by ar.article_id order by published desc");*/
       
       $articles=  DB::select("select article_id,photopath,title,description,publish_date,url,category_id,category_name,concat(publish_date,' ',publish_time) as published from `article` group by article_id order by `publish_date` desc limit 10");
       
         foreach($articles as $article){
            $xml_urlset_url=$xml->createElement('url');
             
            $xml_urlset_url->appendChild($xml->createElement('loc',htmlspecialchars($article->url)));
            $xml_urlset_url_news=$xml->createElement('title',htmlspecialchars($article->title,ENT_XML1, 'UTF-8'));
            $xml_urlset_url->appendChild($xml_urlset_url_news);
            $xml_urlset->appendChild($xml_urlset_url);
         }
         //dd($articles);
          
         $xml->appendChild($xml_urlset);
         $xml->save(public_path()."/cms/cms_uploadfile/latestnewswithfullstorynew.xml");
          Storage::disk('rss')->put('latestnewswithfullstorynew.xml',
        file_get_contents(public_path()."/cms/cms_uploadfile/latestnewswithfullstorynew.xml"),
        \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
        );
         
         
    }
   /*Neetesh rss*/


   /*Neetesh rss new*/
       public function latestFullStoryRssnew() {
        $this->requested_key=$_GET['key']; 
        if($this->key!=$this->requested_key){
        echo "Not authorized to access."; exit;            
        }
        $xml = new \DOMDocument('1.0', 'utf-8');
        $xml->formatOutput = true;

        $xml_urlset = $xml->createElement("channel");
        $attribute_urlset_xmlns = $xml->createAttribute('xmlns');
        $attribute_urlset_xmlns->value = 'http://www.sitemaps.org/schemas/sitemap/0.9';
        $attribute_uirlset_xmlns_image = $xml->createAttribute('xmlns:image');
        $attribute_uirlset_xmlns_image->value = 'http://www.google.com/schemas/sitemap-image/1.1';
        $attribute_uirlset_xmlns_news = $xml->createAttribute('xmlns:news');
        $attribute_uirlset_xmlns_news->value = 'http://www.google.com/schemas/sitemap-news/0.9';
         $xml_urlset_url_link= $xml->createElement('link',htmlspecialchars('samachar4media.com',ENT_XML1, 'UTF-8'));
          $xml_urlset_url_category=$xml->createElement('category',htmlspecialchars('India',ENT_XML1, 'UTF-8'));
          $xml_urlset_url_language=$xml->createElement('language',htmlspecialchars('hi',ENT_XML1, 'UTF-8'));
          $xml_urlset->appendChild($attribute_urlset_xmlns);
          $xml_urlset->appendChild($attribute_uirlset_xmlns_image);
          $xml_urlset->appendChild($attribute_uirlset_xmlns_news);
          $xml_urlset->appendChild($xml_urlset_url_link);
          $xml_urlset->appendChild($xml_urlset_url_category);
          $xml_urlset->appendChild($xml_urlset_url_language);

       /* $articles=  DB::select("select ar.*,cat.category_id,cat.name,concat(ar.publish_date,ar.publish_time) as published from (SELECT * FROM `article` limit 25) ar inner join article_category ar_cat on ar.article_id=ar_cat.article_id inner join category cat on ar_cat.category_id=cat.category_id group by ar.article_id order by published desc");*/
       
       $articles=  DB::select("select article_id,photopath,title,description,publish_date,category_id,category_name,concat(publish_date,' ',publish_time) as published from `article` group by article_id order by `publish_date` desc limit 10");
       
         foreach($articles as $article){
          $xml_urlset_url=$xml->createElement('item');
          $xml_urlset_url_Articleid=$xml->createElement('Articleid',htmlspecialchars($article->article_id,ENT_XML1, 'UTF-8'));
          $xml_urlset_url_title=$xml->createElement('title',htmlspecialchars($article->title,ENT_XML1, 'UTF-8'));
          $xml_urlset_url_description=$xml->createElement('description',htmlspecialchars($article->description,ENT_XML1, 'UTF-8'));

          $imagelarge=trim($article->photopath)?Config::get('constants.awsbaseurl').trim($article->photopath):'';
           $imagelargeextra='http://cms.samachar4media.com/files/article/article_extra_large_image/'.trim($article->photopath);
           $imagethumb=trim($article->photopath)?Config::get('constants.awsbaseurl').Config::get('constants.ARTICLE_IMAGE_THUMB_DIR').trim($article->photopath):'';
          $xml_urlset_url_thumbimage=$xml->createElement('thumbimage',htmlspecialchars( $imagethumb,ENT_XML1, 'UTF-8'));
          $xml_urlset_url_fullimage=$xml->createElement('fullimage',htmlspecialchars($imagelargeextra,ENT_XML1, 'UTF-8'));
          $xml_urlset_url_largeimage=$xml->createElement('largeimage',htmlspecialchars($imagelarge,ENT_XML1, 'UTF-8'));
          $xml_urlset_url_pubDate=$xml->createElement('pubDate',htmlspecialchars($article->publish_date,ENT_XML1, 'UTF-8'));
          $xml_urlset_url_authorname=$xml->createElement('authorname',htmlspecialchars($article->authorname,ENT_XML1, 'UTF-8'));
         
          $xml_urlset_url_link = $xml->createElement('link',url(Helper::rscUrl($article->category_name).'/'.Helper::rscUrl($article->title).'-'.$article->article_id.'.html'));
          $xml_urlset_url_updatedDate=$xml->createElement('updatedDate',htmlspecialchars($article->publish_date,ENT_XML1, 'UTF-8'));
             
           
          
            $xml_urlset_url->appendChild($xml_urlset_url_Articleid);
            $xml_urlset_url->appendChild($xml_urlset_url_title);
            $xml_urlset_url->appendChild($xml_urlset_url_description);
            $xml_urlset_url->appendChild($xml_urlset_url_thumbimage);
            $xml_urlset_url->appendChild($xml_urlset_url_fullimage);
            $xml_urlset_url->appendChild($xml_urlset_url_largeimage);
            $xml_urlset_url->appendChild($xml_urlset_url_pubDate);
            $xml_urlset_url->appendChild($xml_urlset_url_authorname);
            $xml_urlset_url->appendChild($xml_urlset_url_link);
            $xml_urlset_url->appendChild($xml_urlset_url_updatedDate);
            $xml_urlset->appendChild($xml_urlset_url);
         }
         //dd($articles);
          
         $xml->appendChild($xml_urlset);
         $xml->save(public_path()."/cms/cms_uploadfile/todayxml.xml");
          Storage::disk('rss')->put('todayxml.xml',
        file_get_contents(public_path()."/cms/cms_uploadfile/todayxml.xml"),
        \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
        );
    }
   /*Neetesh rss new*/

    public function categoryLatestRss($id) {
       $requested_key = md5(date("dmY").'samachar4media');
        
        if($this->key!=$requested_key){
        echo "Not authorized to access."; exit;            
        }
        $xml = new \DOMDocument('1.0', 'utf-8');
        $xml->formatOutput = true;

        $xml_urlset = $xml->createElement("urlset");
        $attribute_urlset_xmlns = $xml->createAttribute('xmlns');
        $attribute_urlset_xmlns->value = 'http://www.sitemaps.org/schemas/sitemap/0.9';
        $attribute_uirlset_xmlns_image = $xml->createAttribute('xmlns:image');
        $attribute_uirlset_xmlns_image->value = 'http://www.google.com/schemas/sitemap-image/1.1';
        $attribute_uirlset_xmlns_news = $xml->createAttribute('xmlns:news');
        $attribute_uirlset_xmlns_news->value = 'http://www.google.com/schemas/sitemap-news/0.9';
        $xml_urlset->appendChild($attribute_urlset_xmlns);
        $xml_urlset->appendChild($attribute_uirlset_xmlns_image);
        $xml_urlset->appendChild($attribute_uirlset_xmlns_news);
        $filename=$id;
        $articles=  DB::select("select article_id,photopath,title,description,publish_date,category_id,url,category_name,concat(publish_date,' ',publish_time) as published from `article` where category_id=$id group by article_id order by published desc limit 25");
         foreach($articles as $article){
            $xml_urlset_url=$xml->createElement('url');
             
            $xml_urlset_url->appendChild($xml->createElement('loc',htmlspecialchars($article->url)));
            $xml_urlset_url_news=$xml->createElement('news:news');
            $xml_urlset_url_news_publication=$xml->createElement('news:publication');
            $xml_urlset_url_news_publication->appendChild($xml->createElement('news:name','samachar4media'));
            $xml_urlset_url_news_publication->appendChild($xml->createElement('news:language','hi'));
            
            $xml_urlset_url_news->appendChild($xml->createElement('news:genres','PressRelease'));
            $xml_urlset_url_news->appendChild($xml->createElement('news:publication_date',date('d/m/Y',strtotime($article->publish_date))));
            $xml_urlset_url_news->appendChild($xml->createElement('news:title',htmlspecialchars($article->title,ENT_XML1, 'UTF-8')));
            $xml_urlset_url_news->appendChild($xml->createElement('news:description',htmlspecialchars($article->description,ENT_XML1, 'UTF-8')));
            
            $categoryKeyword=DB::select("select mkeyword from category where category_id=".$id."");
            
            $xml_urlset_url_news->appendChild($xml->createElement('news:keywords',$categoryKeyword[0]->mkeyword));
            
            $xml_urlset_url_news->appendChild($xml_urlset_url_news_publication);                 
            
            $xml_urlset_url->appendChild($xml_urlset_url_news);
            
            $image=trim($article->photopath)?Config::get('constants.awsbaseurl').trim($article->photopath):'';
            $xml_urlset_url_image=$xml->createElement('image:image');
            $xml_urlset_url_image->appendChild($xml->createElement('image:loc',htmlspecialchars($image)));
            $xml_urlset_url->appendChild($xml_urlset_url_image);
            
            $xml_urlset->appendChild($xml_urlset_url);
            if($filename==$id)
                $filename=Helper::rscUrl($article->category_name);
         }
         //dd($articles);
          
         $xml->appendChild($xml_urlset);
         $xml->save(public_path()."/cms/cms_uploadfile/".$filename.".xml");
         Storage::disk('rss')->put($filename.'.xml',
        file_get_contents(public_path()."/cms/cms_uploadfile/".$filename.".xml"),
        \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
        );
        
    }

   

    public function perYearRss($year) {
         $requested_key = md5(date("dmY").'samachar4media');
        
        if($this->key!=$requested_key){
        echo "Not authorized to access."; exit;            
        }
        $xml = new \DOMDocument('1.0', 'utf-8');
        $xml->formatOutput = true;
        $xml_urlset = $xml->createElement("urlset");
        $attribute_urlset_xmlns = $xml->createAttribute('xmlns');
        $attribute_urlset_xmlns->value = 'http://www.sitemaps.org/schemas/sitemap/0.9';
        $attribute_uirlset_xmlns_image = $xml->createAttribute('xmlns:image');
        $attribute_uirlset_xmlns_image->value = 'http://www.google.com/schemas/sitemap-image/1.1';
        $attribute_uirlset_xmlns_news = $xml->createAttribute('xmlns:news');
        $attribute_uirlset_xmlns_news->value = 'http://www.google.com/schemas/sitemap-news/0.9';
        $xml_urlset->appendChild($attribute_urlset_xmlns);
        $xml_urlset->appendChild($attribute_uirlset_xmlns_image);
        $xml_urlset->appendChild($attribute_uirlset_xmlns_news);
         $filename=$year;
        $articles=  DB::select("select article_id,photopath,title,description,publish_date,category_id,url,category_name,concat(publish_date,' ',publish_time) as published from `article` where publish_date like '$year%' group by article_id order by published desc limit 25");
         foreach($articles as $article){
            $xml_urlset_url=$xml->createElement('url');
             
            $xml_urlset_url->appendChild($xml->createElement('loc',htmlspecialchars($article->url)));
            $xml_urlset_url_news=$xml->createElement('news:news');
            $xml_urlset_url_news_publication=$xml->createElement('news:publication');
            $xml_urlset_url_news_publication->appendChild($xml->createElement('news:name','samachar4media'));
            $xml_urlset_url_news_publication->appendChild($xml->createElement('news:language','en'));
            
            $xml_urlset_url_news->appendChild($xml->createElement('news:genres','PressRelease'));
            $xml_urlset_url_news->appendChild($xml->createElement('news:publication_date',date('d/m/Y',strtotime($article->publish_date))));
            $xml_urlset_url_news->appendChild($xml->createElement('news:title',htmlspecialchars($article->title,ENT_XML1, 'UTF-8')));
            $xml_urlset_url_news->appendChild($xml->createElement('news:description',htmlspecialchars($article->description,ENT_XML1, 'UTF-8')));
          /*  
            $tags=DB::select("select group_concat(tags.tag) as tags from (select tags_id from article_tags where article_id=$article->article_id) a_tag join tags on a_tag.tags_id=tags.tags_id");*/
            
            $xml_urlset_url_news->appendChild($xml->createElement('news:keywords','advertising news, marketing, ooh, television, digital, print, radio, media'));
            
            $xml_urlset_url_news->appendChild($xml_urlset_url_news_publication);                 
            
            $xml_urlset_url->appendChild($xml_urlset_url_news);
            
            $image=trim($article->photopath)?Config::get('constants.awsbaseurl').trim($article->photopath):'';
            $xml_urlset_url_image=$xml->createElement('image:image');
            $xml_urlset_url_image->appendChild($xml->createElement('image:loc',htmlspecialchars($image)));
            
            $xml_urlset_url->appendChild($xml_urlset_url_image);
            
            $xml_urlset->appendChild($xml_urlset_url);
            /*if($filename==$year){
                $filename=Helper::rscUrl($article->category_name);
            }*/
         //dd($articles);
          }
         $xml->appendChild($xml_urlset);
         $xml->save(public_path()."/cms/cms_uploadfile/sitemap_".$filename.".xml");
        Storage::disk('rss')->put('sitemap_'.$filename.'.xml',
        file_get_contents(public_path()."/cms/cms_uploadfile/sitemap_".$filename.".xml"),
        \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
        );
        
}




        public function permonthRss($month) {
         $requested_key = md5(date("dmY").'samachar4media');
       
        if($this->key!=$requested_key){
        echo "Not authorized to access."; exit;            
        }
         $a = date('Y-m-01',strtotime(date('Y-m-d')));
         $b  = date('Y-m-t',strtotime(date('Y-m-d')));

        $xml = new \DOMDocument('1.0', 'utf-8');
        $xml->formatOutput = true;
        $xml_urlset = $xml->createElement("urlset");
        $attribute_urlset_xmlns = $xml->createAttribute('xmlns');
        $attribute_urlset_xmlns->value = 'http://www.sitemaps.org/schemas/sitemap/0.9';
        $attribute_uirlset_xmlns_image = $xml->createAttribute('xmlns:image');
        $attribute_uirlset_xmlns_image->value = 'http://www.google.com/schemas/sitemap-image/1.1';
        $attribute_uirlset_xmlns_news = $xml->createAttribute('xmlns:news');
        $attribute_uirlset_xmlns_news->value = 'http://www.google.com/schemas/sitemap-news/0.9';
        $xml_urlset->appendChild($attribute_urlset_xmlns);
        $xml_urlset->appendChild($attribute_uirlset_xmlns_image);
        $xml_urlset->appendChild($attribute_uirlset_xmlns_news);
        $month=date('M_Y');
        $articles=  DB::select("select article_id,photopath,title,description,publish_date,category_id,category_name,url,concat(publish_date,' ',publish_time) as published from `article`   WHERE publish_date BETWEEN '" . $a . "' AND  '" . $b . "' order by article_id desc");

         foreach($articles as $article){
            $xml_urlset_url=$xml->createElement('url');
            $pubDate = gmdate(DATE_RFC822 , strtotime($article->publish_date));
            $xml_urlset_url->appendChild($xml->createElement('loc',htmlspecialchars($article->url)));
            $xml_urlset_url_news=$xml->createElement('news:news');
            $xml_urlset_url_news_publication=$xml->createElement('news:publication');
            $xml_urlset_url_news_publication->appendChild($xml->createElement('news:name','samachar4media'));
            $xml_urlset_url_news_publication->appendChild($xml->createElement('news:language','en'));
            
            $xml_urlset_url_news->appendChild($xml->createElement('news:genres','PressRelease'));
            $xml_urlset_url_news->appendChild($xml->createElement('news:publication_date',$article->published));
            $xml_urlset_url_news->appendChild($xml->createElement('news:title',htmlspecialchars($article->title,ENT_XML1, 'UTF-8')));
            $xml_urlset_url_news->appendChild($xml->createElement('news:description',htmlspecialchars($article->description,ENT_XML1, 'UTF-8')));
             $xml_urlset_url_news->appendChild($xml->createElement('news:Publish_Date',$article->published));
            
            $tags=DB::select("select group_concat(tags.tag) as tags from (select tags_id from article_tags where article_id=$article->article_id) a_tag join tags on a_tag.tags_id=tags.tags_id");
            
            $xml_urlset_url_news->appendChild($xml->createElement('news:keywords',htmlspecialchars($tags[0]->tags,ENT_XML1, 'UTF-8')));
            
            $xml_urlset_url_news->appendChild($xml_urlset_url_news_publication);                 
            
            $xml_urlset_url->appendChild($xml_urlset_url_news);
            
            $image=trim($article->photopath)?Config::get('constants.awsbaseurl').trim($article->photopath):'';
            $xml_urlset_url_image=$xml->createElement('image:image');
            $xml_urlset_url_image->appendChild($xml->createElement('image:loc',htmlspecialchars($image)));
            
            $xml_urlset_url->appendChild($xml_urlset_url_image);
            
            $xml_urlset->appendChild($xml_urlset_url);
            /*if($filename==$year){
                $filename=Helper::rscUrl($article->category_name);
            }*/
         //dd($articles);
          }
         $xml->appendChild($xml_urlset);
         $xml->save(public_path()."/cms/cms_uploadfile/sitemap_".$month.".xml");
         Storage::disk('rss')->put('sitemap_'.$month.'.xml',
        file_get_contents(public_path()."/cms/cms_uploadfile/sitemap_".$month.".xml"),
        \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
        );
        
    }
    
    
 /*alldate sitemap*/
     public function alldatesite() {
            $directory = base_path().'/public/cms/cms_uploadfile/datewise';
            $files = collect(File::allFiles($directory))->sortByDesc(function ($file) {
            return $file->getMTime();
        });
             $xml = new \DOMDocument('1.0', 'utf-8');
                $xml->formatOutput = true;
                $xml_urlset = $xml->createElement("sitemapindex");
                $attribute_urlset_xmlns = $xml->createAttribute('xmlns');
                $attribute_urlset_xmlns->value = 'http://www.sitemaps.org/schemas/sitemap/0.9';
                $xml_urlset->appendChild($attribute_urlset_xmlns);
            foreach ($files as $value) {
                $datam = date(DATE_ATOM , filemtime($directory.'/'.pathinfo($value,PATHINFO_BASENAME)));
                /*echo $datam = date(DATE_ATOM, mktime(0, 0, 0, 7, 1, 2000));die*/
                //$pubDate = gmdate(DATE_RFC822 , strtotime($article->published));
                $xml_urlset_url=$xml->createElement('sitemap');
                $xml_urlset_url->appendChild($xml->createElement('loc','https://storage.googleapis.com/media-news/rss/'.pathinfo($value,PATHINFO_BASENAME)));
                $xml_urlset_url_image=$xml->createElement('lastmod' , $datam);
                $xml_urlset_url->appendChild($xml_urlset_url_image);
                $xml_urlset->appendChild($xml_urlset_url);
            }
                $xml->appendChild($xml_urlset);
                $xml->save(public_path()."/allsitemap.xml");
                Storage::disk('rss')->put('allsitemap.xml',
                file_get_contents(public_path()."/allsitemap.xml"),
                \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
                );
                
            
        }
    /*date site map*/
        /*happening sitemap*/
     public function happening() {

         $requested_key = md5(date("dmY").'samachar4media');
        
        if($this->key!=$requested_key){
        echo "Not authorized to access."; exit;            
        }
        $xml = new \DOMDocument('1.0', 'utf-8');
        $xml->formatOutput = true;
        $xml_urlset = $xml->createElement("urlset");
        $attribute_urlset_xmlns = $xml->createAttribute('xmlns');
        $attribute_urlset_xmlns->value = 'http://www.sitemaps.org/schemas/sitemap/0.9';
        $attribute_uirlset_xmlns_image = $xml->createAttribute('xmlns:image');
        $attribute_uirlset_xmlns_image->value = 'http://www.google.com/schemas/sitemap-image/1.1';
        $attribute_uirlset_xmlns_news = $xml->createAttribute('xmlns:news');
        $attribute_uirlset_xmlns_news->value = 'http://www.google.com/schemas/sitemap-news/0.9';
        $xml_urlset->appendChild($attribute_urlset_xmlns);
         $xml_urlset->appendChild($attribute_uirlset_xmlns_news);
        $xml_urlset->appendChild($attribute_uirlset_xmlns_image);
       $articles= DB::select("select ar.*,ar_cat.photo_id,ar_cat.photopath from album ar inner join photos ar_cat on ar.id=ar_cat.owner_id  where ar_cat.owned_by = 'album' and ar.valid = '1' group by ar.id order by ar.updated_at desc LIMIT 10");
         foreach($articles as $article){
            $xml_urlset_url=$xml->createElement('url');
            $xml_urlset_url->appendChild($xml->createElement('title',htmlspecialchars($article->title)));
            $xml_urlset_url_image=$xml->createElement('img','https://storage.googleapis.com/media-news/'.$article->photopath);
            $xml_urlset_url_src=$xml->createElement('src' , 'https://www.samachar4media.com/photogallery/'.str_slug(htmlspecialchars($article->title), '-').'-'.$article->id.'.html');
            $xml_urlset_url->appendChild($xml_urlset_url_src);
            $xml_urlset_url->appendChild($xml_urlset_url_image);
            $xml_urlset->appendChild($xml_urlset_url);

    }
    
         $xml->appendChild($xml_urlset); 
$xml->save(public_path()."/cms/cms_uploadfile/happening/happening.xml"); 
Storage::disk('rss')->put('happening.xml',
file_get_contents(public_path()."/cms/cms_uploadfile/happening/happening.xml"),
\Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
);         
    
}
    /*happening map*/


    /*date sitemap*/
     public function sitemap_date($pdate) {

         $requested_key = md5(date("dmY").'samachar4media');
        
        if($this->key!=$requested_key){
        echo "Not authorized to access."; exit;            
        }
         date_default_timezone_set('Asia/Kolkata');
        $xml = new \DOMDocument('1.0', 'utf-8');
        $xml->formatOutput = true;
        $xml_urlset = $xml->createElement("urlset");
        $attribute_urlset_xmlns = $xml->createAttribute('xmlns');
        $attribute_urlset_xmlns->value = 'http://www.sitemaps.org/schemas/sitemap/0.9';
        $attribute_uirlset_xmlns_image = $xml->createAttribute('xmlns:image');
        $attribute_uirlset_xmlns_image->value = 'http://www.google.com/schemas/sitemap-image/1.1';
        $attribute_uirlset_xmlns_news = $xml->createAttribute('xmlns:news');
        $attribute_uirlset_xmlns_news->value = 'http://www.google.com/schemas/sitemap-news/0.9';
        $xml_urlset->appendChild($attribute_urlset_xmlns);
         $xml_urlset->appendChild($attribute_uirlset_xmlns_news);
        $xml_urlset->appendChild($attribute_uirlset_xmlns_image);
        $cdate = $pdate;
        
        $articles=  DB::select("select article_id,photopath,title,description,publish_date,url,category_id,category_name,concat(publish_date,' ',publish_time) as published from `article` where publish_date = '$cdate' group by article_id order by published desc");

         foreach($articles as $article){
            $xml_urlset_url=$xml->createElement('url');
             $pubDate = date(DATE_ATOM , strtotime($article->published));
            $xml_urlset_url->appendChild($xml->createElement('loc','<![CDATA['.$article->url.']]>'));
            $xml_urlset_url_image=$xml->createElement('lastmod' , '<![CDATA['.$pubDate.']]>');
            $xml_urlset_url->appendChild($xml_urlset_url_image);
            $xml_urlset->appendChild($xml_urlset_url);
           
        
    } $xml->appendChild($xml_urlset);
            $xml->save(public_path()."/cms/cms_uploadfile/datewise/sitemap-".$cdate.".xml");
            Storage::disk('rss')->put('sitemap-'.$cdate.'.xml',
            file_get_contents(public_path()."/cms/cms_uploadfile/datewise/sitemap-".$cdate.".xml"),
            \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
            );}
    /*date site map*/

    /*google sitemap*/
     public function google_news_sitemap() {
         $requested_key = md5(date("dmY").'samachar4media');
       
        if($this->key!=$requested_key){
        echo "Not authorized to access."; exit;            
        }
        $xml = new \DOMDocument('1.0', 'utf-8');
        $xml->formatOutput = true;
        $xml_urlset = $xml->createElement("urlset");
        $attribute_urlset_xmlns = $xml->createAttribute('xmlns');
        $attribute_urlset_xmlns->value = 'http://www.sitemaps.org/schemas/sitemap/0.9';
        $attribute_uirlset_xmlns_image = $xml->createAttribute('xmlns:image');
        $attribute_uirlset_xmlns_image->value = 'http://www.google.com/schemas/sitemap-image/1.1';
        $attribute_uirlset_xmlns_news = $xml->createAttribute('xmlns:news');
        $attribute_uirlset_xmlns_news->value = 'http://www.google.com/schemas/sitemap-news/0.9';
        $xml_urlset->appendChild($attribute_urlset_xmlns);
         $xml_urlset->appendChild($attribute_uirlset_xmlns_news);
        $xml_urlset->appendChild($attribute_uirlset_xmlns_image);
       
        $articles=  DB::select("SELECT article_id,photopath,title,description,publish_date,url,category_id,category_name,CONCAT(publish_date,' ',publish_time) AS published,tags FROM `article` WHERE publish_date >= ( CURDATE() - INTERVAL 2 DAY ) ORDER BY published DESC");
        
         foreach($articles as $article){
            $xml_urlset_url=$xml->createElement('url');
               $pubDate = date(DATE_ATOM  , strtotime($article->published));
            $xml_urlset_url->appendChild($xml->createElement('loc', htmlspecialchars($article->url)));
            $xml_urlset_url_news=$xml->createElement('news:news');
            $xml_urlset_url_news_publication=$xml->createElement('news:publication');
            $xml_urlset_url_news_publication->appendChild($xml->createElement('news:name','samachar4media'));
            $xml_urlset_url_news_publication->appendChild($xml->createElement('news:language','hi'));
            
          
            $xml_urlset_url_news->appendChild($xml->createElement('news:publication_date', $pubDate));
            $xml_urlset_url_news->appendChild($xml_urlset_url_news_publication);      
            $xml_urlset_url_news->appendChild($xml->createElement('news:title','<![CDATA['.htmlspecialchars($article->title,ENT_XML1, 'UTF-8'). ']]>'));
            /*$xml_urlset_url_news->appendChild($xml->createElement('news:description',htmlspecialchars($article->description,ENT_XML1, 'UTF-8')));*/
          /*  
            $tags=DB::select("select group_concat(tags.tag) as tags from (select tags_id from article_tags where article_id=$article->article_id) a_tag join tags on a_tag.tags_id=tags.tags_id");*/
            
            $xml_urlset_url_news->appendChild($xml->createElement('news:keywords',htmlspecialchars($article->tags,ENT_XML1, 'UTF-8')));
            $xml_urlset_url->appendChild($xml_urlset_url_news);
            
            $image=trim($article->photopath)?Config::get('constants.awsbaseurl').trim($article->photopath):'';
            $xml_urlset_url_image=$xml->createElement('image:image');
            $xml_urlset_url_image->appendChild($xml->createElement('image:loc',htmlspecialchars($image)));
            
            $xml_urlset_url->appendChild($xml_urlset_url_image);
            
            $xml_urlset->appendChild($xml_urlset_url);
            /*if($filename==$year){
                $filename=Helper::rscUrl($article->category_name);
            }*/
         //dd($articles);
          
         $xml->appendChild($xml_urlset);
         $xml->save(public_path()."/google-news-sitemap.xml");
    }

    Storage::disk('rss')->put('google-news-sitemap.xml',
        file_get_contents(public_path()."/google-news-sitemap.xml"),
        \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
        );
}
    /*google site map*/


      /*category sitemap*/
     public function category_news_sitemap() {
         $requested_key = md5(date("dmY").'samachar4media');
       
        if($this->key!=$requested_key){
        echo "Not authorized to access."; exit;            
        }
        $xml = new \DOMDocument('1.0', 'utf-8');
        $xml->formatOutput = true;
        $xml_urlset = $xml->createElement("urlset");
        $attribute_urlset_xmlns = $xml->createAttribute('xmlns');
        $attribute_urlset_xmlns->value = 'http://www.sitemaps.org/schemas/sitemap/0.9';
        $attribute_uirlset_xmlns_image = $xml->createAttribute('xmlns:image');
        $attribute_uirlset_xmlns_image->value = 'http://www.google.com/schemas/sitemap-image/1.1';
        $attribute_uirlset_xmlns_news = $xml->createAttribute('xmlns:news');
        $attribute_uirlset_xmlns_news->value = 'http://www.google.com/schemas/sitemap-news/0.9';
        $xml_urlset->appendChild($attribute_urlset_xmlns);
         $xml_urlset->appendChild($attribute_uirlset_xmlns_news);
        $xml_urlset->appendChild($attribute_uirlset_xmlns_image);
       
        $articles=  DB::select("select e_name from `category` where valid = 1 and category_id in (3,4,5,6,7,8,10,11,13,20,64,66,72)  order by category_id desc");
         foreach($articles as $article){
            $xml_urlset_url=$xml->createElement('url');
            $xml_urlset_url->appendChild($xml->createElement('loc',url(Helper::rscUrl($article->e_name).'-news.html')));
            $xml_urlset->appendChild($xml_urlset_url);        
    }  
         $xml->appendChild($xml_urlset);
         $xml->save(public_path()."/category-sitemap.xml");
         Storage::disk('rss')->put('category-sitemap.xml',
        file_get_contents(public_path()."/category-sitemap.xml"),
        \Illuminate\Contracts\Filesystem\Filesystem::VISIBILITY_PUBLIC
        );}
    /*category site map*/

}
