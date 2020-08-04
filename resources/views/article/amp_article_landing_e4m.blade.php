<!doctype html>
<html ⚡>
<head>
<meta charset="utf-8">
<script async src="https://cdn.ampproject.org/v0.js"></script>
<script async custom-element="amp-auto-ads"
        src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js">
</script>
<script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
<script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
<script async custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"></script>
<script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>
<script async custom-element="amp-image-lightbox" src="https://cdn.ampproject.org/v0/amp-image-lightbox-0.1.js"></script>
<script async custom-element="amp-list" src="https://cdn.ampproject.org/v0/amp-list-0.1.js"></script>
 <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
   <script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
   <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
   <script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i">
<link href="https://fonts.googleapis.com/css?family=Fira+Sans|PT+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
 @if(isset($metatitel) && !empty($metatitel))
        <title>{{$metatitel}}</title>
        @else
        <title>{{ config('app.name', 'Indian Advertising Media & Marketing News &ndash; Samachar4media') }}</title>
        @endif 
        @if(isset($metatitel) && !empty($metatitel))
        <meta name="title" content="{{$metatitel}}"/>
        @else
        <meta name="title" content="{{ config('app.name', 'Indian Advertising Media & Marketing News &ndash; Samachar4media') }}"/>
        @endif
        @if(isset($metadescription) && !empty($metadescription))
        <meta itemprop="description" name="description" content="{{$metadescription}}" />
        @else
        <meta itemprop="description" name="description" content="At Samachar4media, read the latest news and updates on advertising agencies, marketing, print, radio, digital, television, media, events and happenings in India." />
        @endif
        @if(isset($ArrViewArticle->tags) && !empty($ArrViewArticle->tags))
      <meta name="news_keywords" content="{{$ArrViewArticle->tags}}" />
        <meta name="keywords" content="{{$ArrViewArticle->tags}}" />
        @else
        <meta name="keywords" content="advertising news, marketing, ooh, television, digital, print, radio, media" />
        @endif
        @if(isset($ogimagenew) && !empty($ogimagenew)) 
        <meta itemprop="thumbnailUrl" name="image_src" content="{{$ogimagenew}}"/>
        @else
        <meta itemprop="thumbnailUrl" content="https://www.samachar4media.com/images/logo.png"/>
        @endif
        @if(isset($ogtitel) && !empty($ogtitel))
        <meta property="og:title" content="{{$ogtitel}}"/>
        @else
        <meta property="og:title" content="Indian Advertising Media & Marketing News ? Samachar4media"/>
        @endif
        <meta property="og:type" content="article" />
        @if(isset($ogurl) && !empty($ogurl))
        <meta itemprop="url" property="og:url" content="{{Request::url()}}" />
        @else 
        <meta  itemprop="url" property="og:url" content="https://www.samachar4media.com/"/>
        @endif
        <meta property="og:site_name" content="Indian Advertising Media &amp; Marketing News &ndash; Samachar4media"/>
        @if(isset($ogdescription) && !empty($ogdescription))    
        <meta property="og:description" content="{{$ogdescription}}"/>
        @else
        <meta property="og:description" content="At Samachar4media, read the latest news and updates on advertising agencies, marketing, print, radio, digital, television, media, events and happenings in India."/>
        @endif
        @if(isset($ogimage) && !empty($ogimage)) 
        <meta property="og:image"  itemprop="image"  content="{{$ogimage}}"/>
        @else
        <meta property="og:image" content="https://www.Samachar4media.com/images/logo.png"/>
        @endif
        <meta property="og:image:width" content="367"/>
        <meta property="og:image:height" content="232"/>
        @if(isset($metatitel) && !empty($metatitel))
        <meta name="twitter:title" content="{{$metatitel}}">
        @else
        <meta name="twitter:title" content="{{ config('app.name', 'Indian Advertising Media & Marketing News &ndash; Samachar4media') }}"/>
        @endif
        @if(isset($metadescription) && !empty($metadescription))
        <meta name="twitter:description" content="{{$metadescription}}">
        @else
        <meta name="twitter:description" content="At Samachar4media, read the latest news and updates on advertising agencies, marketing, print, radio, digital, television, media, events and happenings in India." />
        @endif
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@s4mtweets">
        <meta name="twitter:creator" content="@s4mtweets">
        @if(isset($ogimage) && !empty($ogimage)) 
        <meta name="twitter:image:src" content="{{$ogimage}}">
        @else
        <meta name="twitter:image:src" content="https://www.samachar4media.com/images/logo.png"/>
        @endif
        <meta property="fb:app_id" content="349239931811206"/>
        <meta name="article:publisher" content="https://www.facebook.com/samachar4media/"/>
        @if(isset($url) && !empty($url))
        <link rel="canonical" href="{{$url}}" />
        @else
        <link rel="canonical" href="https://www.samachar4media.com"/>
        @endif
        <meta property="og:locale" content="en_US"/>
        <!-- Meta Tags -->
        <meta name="description" content="{{$ArrViewArticle->summary}}" />
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no,minimal-ui">
        <link rel=”stylesheet”>

<script type="application/ld+json">
   {
     "@context": "https://schema.org",
     "@type": "ImageObject",
     "name": "{{$ArrViewArticle->title}}",
     "author": "{{$ArrViewArticle->authorname}}",
     "datePublished": "{{$ArrViewArticle->publish_date}}"
   }
   </script>
<script type="application/ld+json">
       [{
         "@context": "https://schema.org",
         "mainEntityOfPage":"{{Request::url()}}",
         "@type": "NewsArticle",
         "url": "{{Request::url()}}", "articleBody":"  {!!strip_tags($ArrViewArticle->description)!!}",
         "articleSection":"{{$ArrViewArticle->name}}",
         "headline": "{{$ArrViewArticle->title}}",
         "description":"{!!strip_tags($ArrViewArticle->summary)!!}",
         "author": "{{$ArrViewArticle->authorname}}",
         "datePublished": "{{$ArrViewArticle->publish_date}}",
         "dateModified": "{{$ArrViewArticle->publish_date}}",
         "image":{
               "@context": "https://schema.org",
               "@type": "ImageObject",
               "width": "100px",
               "height": "100px",
               "url":"{{Config::get('constants.SiteCmsurl')}}{{$ArrViewArticle->photopath}}"
             },
         "publisher":{
               "@context": "https://schema.org",
               "@type": "Organization",
               "name": "Samachar4media",
               "logo": {
                       "@context": "https://schema.org",
                       "@type": "ImageObject",
                       "width": "100px",
                       "height": "100px",
                     "url": "https://samachar4media.com/images/logo.png"
                   },
               "url":"{{url('/')}}"
             }
       }]
   </script>

   <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "{{$ArrViewArticle->title}}",
  "description": "{{$ArrViewArticle->summary}}",
  "url" : "{{Request::url()}}",
  "publisher": {
      "@type": "Organization",
      "name": "Samachar4media",
      "url" : "{{url('/')}}",
      "logo" : {
              "@type": "ImageObject",
          "contentUrl": "https://samachar4media.com/images/logo.png"
      }
  }
}
</script>
<script type="application/ld+json">
  {
   "@context": "https://schema.org",
   "@type": "BreadcrumbList", "itemListElement":
   [{ "@type": "ListItem", "position": "1",
   "item": { "@id": " https://www.Samachar4media.com/ ", "name": "Home" } }
   ,{ "@type": "ListItem", "position": "2",
   "item": { "@id": "{{url('')}}/{{str_slug($ArrViewArticle->category_name)}}-news.html",
   "name": "{{$ArrViewArticle->category_name}}-News"
   } }] }
</script>
<style amp-custom>

@font-face {
   font-family: 'flamabold';
    src: url('https://www.Samachar4media.com/fonts/flama_bold-webfont.woff2') format('woff2'),
         url('https://www.Samachar4media.com/fonts/flama_bold-webfont.woff') format('woff');
    font-weight: normal;
    font-style: normal;
  }




body{font-family: 'Fira Sans', sans-serif; font-size:13px; background-color:#ececec;}

/*Color Schemes and Colors*/

html[amp] .amp-page-body, html[⚡] .amp-page-body, html[amp] .art-wrapper, html[⚡] .art-wrapper, html[amp] #article, html[⚡] #article, html[amp] .article-content, html[⚡] .article-content, html[amp] .article-wrap, html[⚡] .article-wrap, html[amp] .caas, html[⚡] .caas, html[amp] #cnbc-body, html[⚡] #cnbc-body, html[amp] .container, html[⚡] .container, html[amp] #container, html[⚡] #container, html[amp] .content-well-v2, html[⚡] .content-well-v2, html[amp] .model-article, html[⚡] .model-article, html[amp] .reuters-amp, html[⚡] .reuters-amp, html[amp] .story-container, html[⚡] .story-container, html[amp] amp-img, html[⚡] amp-img {
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.raleway{ font-family: 'flamabold';}
.list-overflow {
    width: 160px;
    margin-left: auto;
  }

  #amp-list-placeholder div[role=list] {
    margin: 1rem;
  }

  .products {
      display: block;
      height: 100px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
      background: #fff;
      border-radius: 2px;
      margin-bottom: 15px;
      position: relative;
    }

  .products amp-img {
      float: left;
      margin-right: 16px;
  }

  #amp-list-placeholder ul.results {
      list-style: none;
      overflow: auto;
      margin-left: 1rem;
      padding: 0;
    }

  #amp-list-placeholder ul.results li {
         height: 100px;
         background: #fff;
         border-radius: 2px;
         margin-bottom: 15px;
         position: relative;
         box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
  }

  #amp-list-placeholder div[placeholder] ul.results li {
      background:
        linear-gradient(90deg, rgba(211, 211, 211, 0) 0, rgba(211, 211, 211, 0.8) 50%, rgba(211, 211, 211, 0) 100%),
        linear-gradient(#cccccc 100%, transparent 0),
        linear-gradient(#cccccc 100%, transparent 0),
        linear-gradient(#cccccc 100%, transparent 0),
        linear-gradient(#cccccc 100%, transparent 0);
      background-size:
        200px 100px,
        150px 100px,
        100px 10px,
        100px 10px,
        100px 10px;
      background-position:
        -150% 0,
        0 0,
        166px 4px,
        166px 29px,
        166px 53px;
      background-repeat: no-repeat;
      -webkit-animation: loading 1.5s infinite;
      animation: loading 1.5s infinite;
    }

    @-webkit-keyframes loading {
      to {
        background-position: 350% 0, 0 0,
        166px 4px,
        166px 29px,
        166px 53px;
      }
    }

     @keyframes  loading {
       to {
         background-position: 350% 0, 0 0,
         166px 4px,
         166px 29px,
         166px 53px;
       }
     }
.container{ max-width:600px; display:table; width:100%; margin:auto;}
.bg-teal-light{ background-color: #1abc9c; color:#FFFFFF}
.bg-teal-dark{  background-color: #16a085; color:#FFFFFF}
.border-teal-light{ border:solid 1px #1abc9c;}
.border-teal-dark{  border:solid 1px #16a085;}
.color-teal-light{ color: #1abc9c;}
.color-teal-dark{  color: #16a085;}
.bg-green-light{background-color: #2ecc71; color:#FFFFFF}
.bg-green-dark{background-color: #2abb67; color:#FFFFFF}
.border-green-light{border:solid 1px #2ecc71;}
.border-green-dark{ border:solid 1px #2abb67;}
.color-green-light{color: #2ecc71;}
.color-green-dark{color: #2abb67;}
.bg-blue-light{background-color: #3498db; color:#FFFFFF}
.bg-blue-dark{background-color: #2980b9; color:#FFFFFF;}
.border-blue-light{border:solid 1px #3498db;}
.border-blue-dark{ border:solid 1px #2980b9;}
.color-blue-light{color: #3498db;}
.color-blue-dark{color: #2980b9;}
.bg-magenta-light{background-color: #9b59b6; color:#FFFFFF}
.bg-magenta-dark{background-color: #8e44ad; color:#FFFFFF}
.border-magenta-light{border:solid 1px #9b59b6;}
.border-magenta-dark{ border:solid 1px #8e44ad;}
.color-magenta-light{color: #9b59b6;}
.color-magenta-dark{color: #8e44ad;}
.bg-night-light{background-color: #34495e; color:#FFFFFF}
.bg-night-dark{background-color: #2c3e50; color:#FFFFFF}
.border-night-light{border:solid 1px #34495e;}
.border-night-dark{ border:solid 1px #2c3e50;}
.color-night-light{color: #34495e;}
.color-night-dark{color: #2c3e50;}
.bg-yellow-light{background-color: #E67E22; color:#FFFFFF}
.bg-yellow-dark{background-color: #e86f2a; color:#FFFFFF}
.border-yellow-light{border:solid 1px #E67E22;}
.border-yellow-dark{ border:solid 1px #F27935;}
.color-yellow-light{color: #f1c40f;}
.color-yellow-dark{color: #f39c12;}
.bg-orange-light{background-color: #F9690E; color:#FFFFFF}
.bg-orange-dark{background-color: #D35400; color:#FFFFFF}
.border-orange-light{border:solid 1px #F9690E;}
.border-orange-dark{ border:solid 1px #D35400;}
.color-orange-light{color: #e67e22;}
.color-orange-dark{color: #d35400;}
.bg-red-light{background-color: #e74c3c; color:#FFFFFF}
.bg-red-dark{background-color: #c0392b; color:#FFFFFF}
.border-red-light{border:solid 1px #e74c3c;}
.border-red-dark{ border:solid 1px #c0392b;}
.color-red-light{color: #e74c3c;}
.color-red-dark{color: #c0392b;}
.bg-pink-light{background-color: #fa6a8e ; color:#FFFFFF}
.bg-pink-dark{background-color: #FB3365 ; color:#FFFFFF}
.border-pink-light{border:solid 1px #fa6a8e ;}
.border-pink-dark{ border:solid 1px #FB3365 ;}
.color-pink-light{color: #fa6a8e;}
.color-pink-dark{color: #FB3365;}
.bg-gray-light{background-color: #bdc3c7; color:#FFFFFF}
.bg-gray-dark{background-color: #95a5a6; color:#FFFFFF}
.border-gray-light{border:solid 1px #bdc3c7;}
.border-gray-dark{ border:solid 1px #95a5a6;}
.color-gray-light{color: #bdc3c7;}
.color-gray-dark{color: #95a5a6;}
.bg-white{background-color:#FFFFFF;}
.color-white{color:#FFFFFF;}
.border-white{border:solid 1px #FFFFFF;}
.bg-black{background-color:#000000;}
.color-black{color:#000000;}
.border-black{border:solid 1px #000000;}
.color-heading{color:#676767;}

/*Social Icons*/
.facebook-bg{background-color:#3b5998; color:#FFFFFF;}
.linkedin-bg{background-color:#0077B5; color:#FFFFFF;}
.twitter-bg{background-color:#4099ff; color:#FFFFFF;}
.google-plus-bg{ background-color:#d34836; color:#FFFFFF;}
.whatsapp-bg{ background-color:#34AF23; color:#FFFFFF;}
.pinterest-bg{ background-color:#C92228; color:#FFFFFF;}
.sms-bg{ background-color:#27ae60; color:#FFFFFF;}
.mail-bg{ background-color:#3498db; color:#FFFFFF;}
.dribbble-bg{ background-color:#EA4C89; color:#FFFFFF;}
.tumblr-bg{ background-color:#2C3D52; color:#FFFFFF;}
.reddit-bg{ background-color:#336699; color:#FFFFFF;}
.youtube-bg{ background-color:#D12827; color:#FFFFFF;}
.phone-bg{ background-color:#27ae60; color:#FFFFFF;}
.skype-bg{ background-color:#12A5F4; color:#FFFFFF;}
.facebook-color{    color:#3b5998;}
.linkedin-color{    color:#0077B5;}
.twitter-color{     color:#4099ff;}
.google-color{      color:#d34836;}
.whatsapp-color{    color:#34AF23;}
.pinterest-color{   color:#C92228;}
.sms-color{         color:#27ae60;}
.mail-color{        color:#3498db;}
.dribbble-color{    color:#EA4C89;}
.tumblr-color{      color:#2C3D52;}
.reddit-color{      color:#336699;}
.youtube-color{     color:#D12827;}
.phone-color{       color:#27ae60;}
.skype-color{       color:#12A5F4;}

/*Background Images*/
.bg-1{background-image:url(images/pictures/1.jpg)}
.bg-2{background-image:url(images/pictures/2.jpg)}
.bg-3{background-image:url(images/pictures/3.jpg)}
.bg-4{background-image:url(images/pictures/4.jpg)}
.bg-5{background-image:url(images/pictures/5.jpg)}
.bg-6{background-image:url(images/pictures/6.jpg)}
.bg-7{background-image:url(images/pictures/7.jpg)}
.bg-8{background-image:url(images/pictures/8.jpg)}
.bg-9{background-image:url(images/pictures/9.jpg)}
.bg-body{background-image:url(images/pictures_vertical/bg2.jpg)}
.bg-body-1{background-image:url(images/pictures_vertical/bg1.jpg)}
.bg-body-2{background-image:url(images/pictures_vertical/bg0.jpg)}
.overlay{background-color:rgba(0,0,0,0.8); position:absolute; top:0px; right:0px; bottom:0px; left:0px;}

/*Font Settings*/
h1{ font-size:24px; line-height:34px; font-weight:600;}
h2{ font-size:21px; line-height:32px; font-weight:600;}
h3{ font-size:18px; line-height:30px; font-weight:600;}
h4{ font-size:17px; line-height:28px; font-weight:600;}
h5{ font-size:16px; line-height:26px; font-weight:600;}
h6{ font-size:15px; line-height:22px; font-weight:800;}
.ultrathin{font-weight:200;}
.thin{font-weight:300;}
.thiner{font-weight:400;}
.boder{font-weight:600;}
.bold{font-weight:700;}
.ultrabold{font-weight:900;}
.capitalize{text-transform: capitalize;}
.italic{font-style: italic;}
.small-text{font-size:12px; display:block;}
.center-text{text-align:center; display:block;}
.right-text{text-align:right;}
.uppercase{text-transform: uppercase;}
.boxed-text{width:90%; margin:0px auto 30px auto;}
.round-image{border-radius:500px;}
p a{display:inline;}

/*Content Settings*/
.content{padding:0px 20px 0px 20px; margin-bottom:30px; display:block;}
.container{margin-bottom:30px}
.negative-top{margin-top:-25px;}
.full-bottom{margin-bottom:25px}
.no-bottom{margin-bottom:0px}
.full-top{margin-top:25px}
.half-bottom{margin-bottom:15px}
.half-top{margin-top:15px}
.quarter-bottom{margin-bottom:10px}
.hidden{display:none}
.left-column{width:45%; margin-right:5%; float:left}
.right-column{width:45%; margin-left:5%; float:left}
.one-third-left{float:left; width:29%;  margin-right:1%}
.one-third-center{float:left; width:29%; margin-left:5%; margin-right:5%}
.one-third-right{float:left; width:29%; margin-left:1%}
.clear{clear:both}
.large-icon{font-size:24px;}
.huge-icon{font-size:32px;}

* {
  margin: 0;
  padding: 0;
  border: 0;
  font-size: 100%;
  vertical-align: baseline;
  outline: none;
  font-size-adjust: none;
  -webkit-text-size-adjust: none;
  -moz-text-size-adjust: none;
  -ms-text-size-adjust: none;
  -webkit-tap-highlight-color: rgba(0,0,0,0);
    -webkit-font-smoothing: antialiased;
    -webkit-transform: translate3d(1,1,1);
    transform:translate3d(1,1,1);    
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

div, a, p, img, blockquote, form, fieldset, textarea, input, label, iframe, code, pre {
  display: block;
  position:relative;
}

p{
  line-height:26px; 
  font-weight:400; 
  color:#666666; 
  font-size:17px; 
  margin-bottom:10px;
      word-break: break-word;
}

a{text-decoration:none; color:#3498db;} 

/*Lists*/
.icon-list{list-style:none; font-size:14px; line-height:28px; color:#666666;}
.icon-list i{width:30px;}

.center-icon{
  width:80px;
  height:80px;
  border-radius:80px;
  border:solid 1px rgba(0,0,0,0.5);
  text-align:center;
  line-height:80px;
  font-size:24px;
  margin:0px auto 30px auto;
  display:block;
}

.decoration, .decoration-no-bottom{
  height:1px; 
  background-color:rgba(0,0,0,0.1);
}

.deco{height:1px; margin-bottom:30px;}

.deco-box .deco{
  width:10%;
  float:left;
  height:5px;
}

.decoration{margin-bottom:30px;}
.decoration-margins{margin:0px 20px 30px 20px}

/*Sidebar Design*/

#sidebar{
  width:270px;
  background-color:#212121;
}

.sidebar-header{
  width:auto; padding:5px;
}
.mt40{ margin-top:40px;}
.sidebar-logo{ 
  width:auto; 
}

.sidebar-logo em{
  display:block;
  padding-left:30px;
  padding-top:60px;
  position:relative;
  color:rgba(255,255,255,0.7);
  font-style: normal;
  font-size:11px;
}

#sidebar *{
  user-select: none;
}

#sidebar .menu{
  list-style:none;
  padding:0px;
  margin:0px;
  display:inline-block;
      width: 100%;
}

#sidebar .menu li{
  height:33px;
  line-height:33px;
  padding-left:10px;
  transition:all 250ms ease;
      display: inherit;
    width: 100%;
}

#sidebar .menu li a{
  color:#e6e6e6; 
  font-size:14px; 
  font-weight:500;
  padding-left:40px;
}

#sidebar .menu li .fa-angle-right {
  color:#5d5d5d; 
  font-size:15px; 
  padding-right:20px;
  position:absolute;
  left:15px;
  height:33px;
  width:20px;
  text-align: center;
  line-height:33px;
}
.dropdown .fa-sort-desc{    display: inline;
    position: absolute;
    top: 10px;
    margin-left: 10px;
    color: #ccc;}
.close-sidebar{    color: #fff;
    background: #d20620;
    width: 30px;
    height: 30px;
    text-align: center;
    position: absolute;
    right: -1px;
    line-height: 30px;
    font-weight: bold;    z-index: 9999;}

#sidebar .menu li:hover{background-color:#d40b4e; transition:all 250ms ease;}


#sidebar .submenu h4{
  background-color:#FFFFFF;
  border:none;
  color:#2e2e2e; 
  font-size:14px; 
  font-weight:500;
  padding-left:68px;
  height:55px;
  line-height:55px;
}


#sidebar .submenu h4 i{
  color:#5d5d5d; 
  position:absolute;
  height:55px;
  width:68px;
  line-height:55px;
  left:0px;
  text-align:center;
  font-size:15px;
}

.submenu a{
  height:50px;
  line-height:50px;
  font-size:13px;
  padding-left:70px;
  color:#666666;
}

.submenu a:last-child{margin-bottom:5px;}

.submenu a i{
  position:Absolute;
  height:50px;
  width:68px;
  text-align:center;
  line-height:52px;
  font-size:12px;
  left:0px;
}

.sidebar-copyright{
  font-size:11px;
  color:#888888;
  margin-top:-5px;
  padding-left:20px;
  padding-bottom:20px;
  display:block;
  line-height:24px;
  font-style: normal;
}

#sidebar .submenu h4.selected{background-color:#eeeeee;}
.selected{background-color:#eeeeee;}
.sidebar-deco{background-color:rgba(0,0,0,0.1); height:1px; margin:10px 0px 20px 0px; display:block;}

/*Page Content*/

::-webkit-scrollbar { width: 0; }


/*input[id="toggle-menu"]*/
input[data-submenu-items]{
   position: absolute;
   top: -9999px;
   left: -9999px;
   /* For mobile, it's typically better to position checkbox on top of clickable
      area and turn opacity to 0 instead. */
}

.page-content{
  z-index:999;
  margin-top:55px;
  margin-bottom:20px;
  margin-left:10px;
  margin-right:10px;
}

.page-content-before{margin-top:-55px;}
.page-content-full{margin-bottom:20px;}

.material-effect{
  box-shadow: 0 2px 5px 1px rgba(0,0,0,0.1);
}

.material-box{
  background-color:#FFFFFF;
  box-shadow: 0 2px 5px 1px rgba(0,0,0,0.1);
  margin-bottom:30px;
  padding:20px;
}

.material-news{
  padding:20px 0px 0px 0px;
}

.material-box-full{
  background-color:#FFFFFF;
  box-shadow: 0 2px 5px 1px rgba(0,0,0,0.1);
  margin-bottom:30px;
  padding:30px 0px 15px 0px;
}

.half-material-box-left{
  width:47%;
  float:left;
  background-color:#FFFFFF;
  box-shadow: 0 2px 5px 1px rgba(0,0,0,0.1);
  margin-bottom:30px;
  padding:30px 15px 15px 15px;
  box-sizing:border-box;
}

.half-material-box-right{
  width:47%;
  margin-left:6%;
  float:left;
  background-color:#FFFFFF;
  box-shadow: 0 2px 5px 1px rgba(0,0,0,0.1);
  margin-bottom:30px;
  padding:30px 20px 15px 20px;
  box-sizing:border-box;
}

.under-material{
  background-color:#FFFFFF;
  margin-bottom:30px;
  padding:0px 20px;
  margin-top:-50px;
  box-shadow: 0 2px 5px 1px rgba(0,0,0,0.1);
  border-top:solid 1px rgba(0,0,0,0.07);
}

.under-material-link{
  float:right;
  font-weight:700;
  text-transform:uppercase;
  height:50px;
  line-height:50px;
  padding-left:15px;
}

.under-material-icon{
  width:43px;
  height:50px;
  line-height:50px;
  float:right;
  font-size:13px;
}

.under-material-icon[type="facebook"],
.under-material-icon[type="twitter"],
.under-material-icon[type="gplus"]{background-image:none; background-color:transparent;}

.under-material-icon[type="facebook"]:before {content: "\f09a"; color:#3b5998;}
.under-material-icon[type="twitter"]:before {content: "\f099"; color:#4099FF;}
.under-material-icon[type="gplus"]:before { content: "\f0d5"; color:#D34836;}

.under-material-icon[type="facebook"]:before,
.under-material-icon[type="twitter"]:before,
.under-material-icon[type="gplus"]:before{
  text-align:center;
  line-height:43px;
  width:43px;
  display:inline-block;
    font-family: 'FontAwesome';
}



.body-bg{
  background-image:url(images/pictures_vertical/bg3.jpg);
  background-size:cover;
  position:fixed;
  top:0px;
  left:0px;
  right:0px;
  bottom:0px;
  z-index:5;
}

/*Header*/
header{
  position:fixed;
  height:60px;
  z-index:9999;
  transition:all 250ms ease;
  left:0px;
  right:0px;
  top:0px;
  box-shadow: 0 2px 5px 1px rgba(0,0,0,0.1);
  background-color:#FFFFFF;
}

.header-clear{height:60px; display:block;}

.header-icon-1, .header-icon-2{
  position:absolute;
  line-height:60px; 
  text-align:center; 
  width:60px;
  display:block;
  font-size:25px;
  background-color:transparent;
  color:#ffffff;
}

.header-icon-2{right:0px; top:0px;}
.header-icon-1{right:0px; top:0px; cursor:pointer;}

.header-logo{ 
      margin: 5px 12px 0; 
  width:200px;
  height:60px;
  display:block;text-align:center;
}

/*Footer*/
.footer{padding-top:20px; background:#000000; color:#ffffff;}
.footer p{ text-align:left; font-size:14px; color:#ffffff;}
.footer ul{ text-align:center; list-style:none; margin:0;}
.footer-logo{
  background-image:url(images/logo.png);
  background-repeat: no-repeat;
  background-size:120px 20px;
  width:120px;
  height:20px;
  display:block;
  margin:12px auto 15px auto;
}
.blu{background: #342f59; color: #eee; padding:15px 20px; text-align:center;}

.footer p:last-child{margin-bottom:0px; margin-top:-15px;}

.footer-socials a{
  /*width:40px;
  height:40px;
  line-height:40px;*/
  margin-left:7px;
  margin-right:7px;
  text-align:center; display:inline-block;
  font-size:14px; color:#ffffff;
}

.footer-socials{
  /*width:100%;*/text-align:center;
  margin:0px auto 30px auto;
  padding:0 20px;
}
.ftext{ margin:15px 0 10px 0;     border-bottom: 2px solid #e92159;}
.ftext2{margin:15px 0 10px 0;     border-bottom: 2px solid #e92159;}

/*Call To Action Bar*/

.call-to-action-box a{
  width:50%;
  float:left;
  height:40px;
  line-height:40px;
  text-align:center;
  font-weight:700;
  text-transform:uppercase;
  margin-bottom:30px;
}

.news-slider .caption{
  background-color:rgba(0,0,0,0.8);
}

.caption{
  position:absolute;
  bottom:0px;
  left:0px;
  right:0px;
  padding:20px;
  background-color:rgba(0,0,0,0.5);
}

.caption h4{
  font-size:14px;
  color:#FFFFFF;
  line-height:20px;
  margin-top:12px;
}

.caption h3{
  color:#FFFFFF; 
  font-size:16px;line-height:normal;text-align:center;
}

.caption p{
  font-size:12px;
  color:rgba(255,255,255,0.5);
}

/*Staff Slider*/


.staff-slider{
  margin:0 auto;
  display:block;
}

.staff-slider .inner-slide{
  width:240px;
  display:block;
  margin:0 auto;
}

.staff-slider .slide{
  margin-left:10px;
  margin-right:10px;
}

.staff-slider amp-img img{
  transform:scale(0.9, 0.9);
}

.staff-slider h2{
  padding-top:20px;
  display:block;
  margin-bottom:-10px;
}

.staff-slider .amp-carousel-button{
  margin-top:50px;
}

/*Quote Slider*/

.quote-slider p{
  font-size:22px;
  font-weight:200;
  max-width:260px;
  margin:0 auto;
  text-align:center;
  line-height:42px;
  font-style:italic
}

.quote-slider em i{
  font-size:18px;
}

.quote-slider em{
  display:block;
  width:100px;
  margin:30px auto 30px auto;
  color:#f1c40f;
}

.quote-slider a{
  font-size:15px;
  font-weight:700;
  display:block;
  text-align:center;
}

.quote-slider .amp-carousel-button{
  top:100%;
  margin-top:-30px;
}

.social-icons{
  width:150px;
  margin:0 auto;
}

.social-round a{border-radius:50px;}

.social-icons-small{
  width:95px;
  margin:0 auto;
}

.social-icons a{
  line-height:35px;
  width:35px;
  height:35px;
  margin-left:10px;
  margin-right:5px;
  float:left;
  font-size:12px;
  text-align:center;
}

.social-icons-small a{
  line-height:35px;
  width:35px;
  height:35px;
  margin-left:5px;
  margin-right:5px;
  float:left;
  text-align:center;
  display:inline-block;
}


/*Large Link*/

.large-link{
  font-size:12px;
  height:50px;
  line-height:50px;
  color:#000000;
  border-bottom:solid 1px rgba(0,0,0,0.1);
}


.large-link .fa-angle-right{
  position:absolute;
  right:0px;
  height:50px;
  line-height:50px;
  text-align:center;
}

.large-link i:last-child{margin-right:10px; width:20px; text-align:center;}

/*Heading Block*/

.heading-box{padding:35px 20px 10px 20px; margin-bottom:30px;}
.heading-box h3{margin-bottom:-5px; position:relative; z-index:10;}
.heading-box p{position:relative; z-index:10;}
.page-title{margin-bottom:-60px;}


.heading-block{
  padding:30px 20px;
  margin-bottom:30px;
}

.heading-block h4{
  font-size:20px;
  position:relative;
  z-index:10;
  color:#FFFFFF;
}

.heading-block p{
  position:relative;
  z-index:10;
  color:rgba(255,255,255,0.5);
  margin-bottom:0px;
}

.heading-block a{
  z-index:10;
  width:100px;
  height:10px;
  line-height:10px;
  color:#FFFFFF;
  text-align:center;
  font-size:12px;
  margin:20px auto 0px auto;
  border:solid 1px rgba(255,255,255,0.5);
  border-radius:5px;
    display:block;
  text-transform: uppercase;
  font-weight:800;
}

.icon-heading h4{
  padding-left:90px;
  font-size:15px;
}

.icon-heading p{
  line-height:24px;
  padding-left:90px;
}

.icon-heading i{
  border-radius:10px;
  position:absolute;
  width:70px;
  height:70px;
  line-height:70px;
  margin-top:5px;
  text-align:center;
  font-size:24px;
}

.quote-style h4, .quote-style h5{
  font-weight:300;
  margin-left:25px;
  margin-right:25px;
  text-align:center;
  line-height:40px;
}

.rating{
  width:80px;
  margin:20px auto 20px auto;
  display:block; 
}


/*Half Columns*/

.half-column-left{
  width:45%;
  float:left;
}

.half-column-right{
  width:45%;
  float:left;
}

.center-column-icon{
  font-size:28px;
  text-align:center;
  display:block;
}

/*Gallery*/

.gallery-thumb{
  width:31%;
  float:left;
  margin-bottom:3%;
}
.gallery-thumb p{margin-bottom:10px; line-height:20px; padding-top:5px; text-align:center; font-size:13px;}
.gallery-round .gallery-thumb{border-radius:100px}
.gallery-wide .gallery-thumb-wide{margin-bottom:5px;}
.gallery-wide h4{
  position:absolute;
  background-color:rgba(0,0,0,0.8);

  color:#FFFFFF;
  z-index:99;
  height:50px;
  line-height:50px;
  margin-top:-55px;
  width:100%;
  padding-left:20px;
  font-weight:300;
  font-size:14px;
  pointer-events:none;
}


.gallery-thumb:nth-child(3n-1){
  margin-left:3%;
  margin-right:3%;
}

/*Splash Page*/
.splash-content .splash-logo{
  background-image:url(images/amp-logo.png);
  background-size:80px 80px;
  width:80px;
  height:80px;
  margin:-30px auto 20px auto;
}

.splash-content{
  position:fixed;
  width:240px;
  height:350px;
  left:50%;
  top:50%;
  margin-top:-140px;
  margin-left:-120px;
}

.splash-button{
  width:130px;
  margin:0 auto;
  text-align:center;
  height:40px;
  line-height:40px;
  font-size:12px;
}

/*Landing Content*/

.landing-logo{
  background-image:url(images/logo_light.png);
  background-size:130px 35px;
  margin:0 auto;
  height:35px;
  width:130px;
  margin-top:20px;
}

.landing-content{
  width:300px;
  margin:40px auto 30px auto;
}

.landing-content a{
  width:70px;
  height:70px;
  float:left;
  margin:0px 15px 60px 15px;
  border-radius:70px;
  line-height:70px;
  font-size:21px;
  text-align:center;
}

.landing-content a em{
  position:absolute;
  font-size:14px;
  width:70px;
  text-align:center;
  bottom:-60px;
  left:0px;
  right:0px;
  font-style:normal;
}

/*Accordion Styles*/
.accordion h4{
  background-color:transparent;
  border:none;
}

.accordion h4{
  font-size:16px;
  line-height:40px;
}

.accordion h4 i{
  height:40px;
  line-height:40px;
  position:absolute;
  right:0px;
  font-size:12px;
}

.nested-accordion h4{
  font-size:14px;
}

section[expanded] .fa-plus{ transform:rotate(45deg);}
section[expanded] .fa-angle-down{ transform:rotate(180deg);}
section[expanded] .fa-chevron-down{ transform:rotate(180deg);}

/*Fonts*/
.demo-icons a{
  color:#FFFFFF; 
  width:20%;
  height:50px;
  float:left;
}
.demo-icons a i{
  color:#1f1f1f; 
  font-size:21px;
  width:50px;
  height:50px; 
  float:left; 
  text-align:center; 
  overflow:hidden;
}

/*User Notifications*/
.user-notification{
  text-align:left;
  padding-top:5px;
  padding-left:10px;
  padding-right:10px;
  background-color:#27ae60;
  height:50px;
  color:#FFFFFF;
  font-size:12px;
  line-height:24px;
  width:70%;
  float:left;
}

.user-notification button{
  background-color:#27ae60;
  color:#FFFFFF;
  height:55px;
  position:fixed;
  right:0px;
  bottom:0px;
  width:25%;
}

/*Inputs*/

.text-input{
  height:45px;
  line-height:45px;
  text-indent: 10px;
  border:solid 1px rgba(0,0,0,0.1);
  display:block;
  width:100%;
  font-size:12px;
}

.input-icon-field{
  height:45px;
  line-height:45px;
  text-indent: 50px;
  border:solid 1px rgba(0,0,0,0.1);
  display:block;
  width:100%;
  font-size:12px;
}

.input-icon i{
  position:absolute;
  z-index:9;
  height:45px;
  line-height:45px;
  text-align:center;
  width:45px;
  color:#666666;
}

.select-style {
    border: 1px solid rgba(0,0,0,0.1);
    width: 100%;
  height:45px;
  display:block;
    border-radius: 3px;
    overflow: hidden;
    background: #FFFFFF url("data:image/png;base64,R0lGODlhDwAUAIABAAAAAP///yH5BAEAAAEALAAAAAAPABQAAAIXjI+py+0Po5wH2HsXzmw//lHiSJZmUAAAOw==") no-repeat 95% 50%;
}

.select-style select {
  font-size:12px;
  line-height:35px;
    padding: 5px 15px;
    width: 100%;
    border: none;
    box-shadow: none;
    background-color:rgba(255,255,255,0);
    background-image: none;
    -webkit-appearance: none;
}

.select-style select:focus {
    outline: none;
}



/*Dropcaps*/

.dropcaps-1:first-letter{
    float:left;
    font-size:57px;
  padding:14px 15px 0px 0px;
    font-weight:800;
    color:#1f1f1f;
}

.dropcaps-2:first-letter{
    font-family: 'Times New Roman', sans-serif;
    float:left;
    font-size:42px;
  padding:15px 15px 0px 0px;
    font-weight:800;
    color:#1f1f1f;
}

.dropcaps-3:first-letter{
    background-color:#1f1f1f;
  padding:10px 15px 10px 15px;
  margin:5px 12px 0px 0px;
    float:left;
    font-size:24px;
    font-weight:800;
    color:#FFFFFF;
}

.dropcaps-4:first-letter{
    font-family: 'Times New Roman', sans-serif;
    font-weight:800;
    background-color:#1f1f1f;
  padding:8px 17px 8px 17px;
  margin:5px 12px 0px 0px;
    float:left;
    font-size:20px;
    font-weight:400;
    color:#FFFFFF;
}

/*Highlights*/
.highlight{margin-bottom:10px;}
.highlight span{padding:3px 5px 3px 5px; margin-right:2px;}
ol ul{  padding-left:5px;}
ol, ul{line-height:24px; margin-left:20px;}
.icon-list{list-style:none; margin-left:0px; padding-left:0px;}
.icon-list i{font-size:10px;}
.icon-list ul{list-style:none; padding-left:10px;}
.icon-list ul ul{padding-left:10px;}

/*Blockquotes*/
.blockquote-1{border-left:solid 3px #1f1f1f; padding:10px 0px 10px 20px;}
.blockquote-1 a{text-align:right; margin-top:-20px;  font-size:12px;}
.blockquote-2 .blockquote-image{position:absolute; border-radius:50px;}
.blockquote-2 h5{padding-left:60px;}
.blockquote-2 .first-icon{padding-left:60px;}
.blockquote-2 a{text-align:right; margin-top:-20px; font-size:12px;}
.blockquote-3 .blockquote-image{width:150px; border-radius:150px; margin:0 auto; display:block;}
.blockquote-3 h5{margin:10px 0px 10px 0px;}
.blockquote-3 .ratings{width:100px; margin:10px auto 10px auto;}
.blockquote-3 .ratings i{font-size:18px;}
.blockquote-4 i{font-size:24px; position:absolute; margin-top:10px;}
.blockquote-4 p{padding-left:50px;}

/*Buttons*/
.button{
  display:inline-block;
  padding:13px 20px;
  margin:0px 0px 10px 0px;
  font-size:12px;
  transition:all 250ms ease;
}

.button-3d{
  display:inline-block;
  padding:12px 20px;
  margin:0px 0px 10px 0px;
  font-size:12px;
  transition:all 250ms ease;
  border-right:none;
  border-left:none;
  border-top:none;
  border-width:4px;
}

.button-round{border-radius:30px;}
.button-full{display: block; text-align: center;}
.button-center{width:130px; margin-left:auto; margin-right:auto; display:block; text-align:center;}
.button:hover{opacity:0.9; transition:all 250ms ease;}

.icon-square, .icon-round{
  width:40px;
  height:40px;
  line-height:40px;
  text-align:center;
  display:inline-block;
  margin-left:6px;
  margin-right:6px;
  margin-bottom:10px;
  font-size:14px;
}
.icon-square:hover, .icon-round:hover{opacity:0.9;}
.icon-round{border-radius:45px;}

/*Page 404*/
.page-404 h1{font-size:60px; line-height:70px; margin-top:70px;}
.page-404 a{margin-bottom:100px;}
.page-soon h1{font-size:60px; line-height:70px; margin-top:70px;}
.page-soon h6{font-size:24px;}
.page-soon .social-icons{margin-bottom:100px;}

/*Profile Page*/

.profile-gradient{
    background: -moz-linear-gradient(top,rgba(255,255,255,0) 0%,rgba(255,255,255,0.95) 75%,rgba(255,255,255,1) 100%);
    background: -webkit-linear-gradient(top,rgba(255,255,255,0) 0%,rgba(255,255,255,0.95) 75%,rgba(255,255,255,1) 100%);
    background: linear-gradient(to bottom,rgba(255,255,255,0) 0%,rgba(255,255,255,0.95) 75%,rgba(255,255,255,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00ffffff',endColorstr='#ffffff',GradientType=0);
    height: 250px;
    margin-top: -235px;
}

.profile-overlay .profile-header{margin-top:-80px}
.profile-header h1{font-size:30px;}
.profile-header h6{letter-spacing:2px; opacity:0.5;}
.profile-header h5{font-size:12px;}
.profile-header i{margin-right:10px;}
.profile-header p{font-size:18px;}
.profile-followers a{float:left; width:33%; color:#1f1f1f; font-size:18px;}
.profile-followers em{display:block; font-style:normal; font-size:12px;}
.profile-thumb{margin-top:-50px; width:100px; margin-left:auto; margin-right:auto; display:block; border-radius:100px; border-radius:100px; border:solid 3px #FFFFFF;}

/*Timeline 1*/

.timeline-1{overflow:hidden; padding:0px }

.timeline-1 .timeline-deco{
  position:absolute;
  top:0px;
  left:50%;
  width:1px;
  bottom:0px;
  background-color:rgba(0,0,0,0.15);
}

.timeline-1 .timeline-icon{
  width:60px;
  height:60px;
  border-radius:60px;
  line-height:60px;
  text-align:center;
  font-size:18px;
  background-color:#FFFFFF;
  box-shadow: 0 2px 5px 1px rgba(0,0,0,0.1);
  margin:0px auto 30px auto;
}

.timeline-1 .container{background-color:#FFFFFF; padding:30px 20px 20px 20px; box-shadow: 0 2px 5px 1px rgba(0,0,0,0.1);}
.timeline-2{overflow:hidden; padding:50px 20px 0px 20px; margin-top:-25px; margin-bottom:50px;}

.timeline-2 .timeline-deco{
  top:0px;
  position:absolute;
  left:50px;
  width:1px;
  bottom:0px;
  background-color:rgba(0,0,0,0.15);
}

.timeline-2 .timeline-icon{
  width:40px;
  height:40px;
  border-radius:40px;
  line-height:40px;
  text-align:center;
  font-size:18px;
  background-color:#FFFFFF;
  border:solid 1px rgba(0,0,0,0.2);
  margin-left:10px;
}

.timeline-2 .container{
  background-color:#FFFFFF; 
  margin-left:70px;
  margin-top:-60px;
  padding:10px;
  box-shadow: 0 2px 5px 1px rgba(0,0,0,0.1);
}


/*News Slider*/

.news-slider .amp-carousel-button{display:none;}
.news-slider{margin-bottom:10px;}

/*News Thumbs*/

.news-thumbs .news-item{
  min-height:125px;
  color:#1f1f1f;
}

.news-thumbs .news-item .responsive-img{
  width:95px;
  position:absolute;
  margin-top:5px;
}

.news-thumbs .news-item h5{
  margin-left:110px;
  font-size:15px;
}

.news-thumbs .news-item p{
  margin-left:110px;
  line-height:27px;
  margin-bottom:0px;
  font-size:13px;
}

/*News Strip*/
.checkbox{ display:flex; margin: 10px 15px 10px 0; float: left;}
.checkbox input{ margin-right:10px;}
.d-block{ /*margin-top:10px;*/ display:block;}
.news-strip{
  background-color:#000000;
  padding:20px 0px 20px 0px;
  margin-bottom:30px;
}

.news-strip h5{
  font-weight:800;
  color:#FFFFFF;
  padding:0px 20px 20px 20px;
}

/*News Cateogry*/

.news-category p{
  display:inline-block;
  padding:5px 25px 0px 25px;
  font-size:13px;
  margin:0px;
}

.news-category div{
  height:5px;
  width:100%;
}

/*News Block*/

.news-blocks .news-item{
  min-height:125px;
  color:#1f1f1f;
}

.news-blocks .news-item h5{
  font-size:18px;
  padding:15px 0px 5px 0px;
}

/*News full*/

.news-full .news-item{margin-top:1px;}

.news-full .news-item h6{
  position:absolute;
  background-color:rgba(0,0,0,0.8);
  bottom:0px;
  width:100%;
  color:#FFFFFF;
  padding:10px 10px 10px 10px;
}

.news-full .titles{
  position:absolute;
  background-color:#FFFFFF;
  width:250px;
  height:65px;
  margin-top:-65px;
}

.news-full h5{
  font-size:13px;
  padding:10px 20px 0px 20px;
  color:#000000;
}
.news-full em a{display:inline;}
.news-full em{font-size:10px; padding-left:20px; display:block;}
.news-full p{padding:10px 20px 0px 20px;}
.news-full .read-more{
  padding-right:20px;
  text-align:right;
  font-size:12px;
  padding-bottom:30px;
}

/*News Posts*/

.news-post-info{
  font-style:normal;
  font-size:12px;
  padding:5px 0px 15px 0px;
  display:block;
}

.news-post-info a{
  display:inline;
  
}

/*Contact Page*/

.contactField{
  font-family:'Roboto', sans-serif;
  height:40px;
  line-height:40px;
  line-height:100%;
  width:100%;
  display:block;
  border:solid 1px rgba(0,0,0,0.1);
  text-indent:10px;
  font-size:13px;
  transition:all 250ms ease;
  margin-bottom:20px;
}

.contactField:focus{
  border:solid 1px rgb(39, 174, 96);
  transition:all 250ms ease;
}

.contactTextarea{
  font-family:'Roboto', sans-serif;
  padding-top:10px;
  min-height:80px;
  line-height:40px;
  line-height:100%;
  width:100%;
  display:block;
  border:solid 1px rgba(0,0,0,0.1);
  text-indent:10px;
  font-size:13px;
  transition:all 250ms ease;
  margin-bottom:30px;
}

.contactTextarea:focus{
  transition:all 250ms ease;
  border:solid 1px rgb(39, 174, 96);
}

.field-title{
  font-size:13px; 
  margin-bottom:5px;
}

.field-title span{
  font-size:10px;
  color:#cacaca;
  position:absolute;
  right:0px;
  margin-top:2px;
}

.buttonWrap{
  width:100%;
  display:block;
  text-align:center;
  margin-bottom:0px;
    appearance:none;
    -webkit-appearance:none;
}

.contact-icon{
  color:#666666;
  line-height:30px;
}

.contact-icon i{
  color:#1f1f1f;
  width:30px;
}


/*Cover Pages*/

.cover-clear{height:40px;}

.cover-1{
  padding:90px 40px 0px 40px;
}

.cover-1 h1{
  font-size:30px;
  color:#FFFFFF;
}

.cover-1 h6{
  font-size:16px;
  color:#FFFFFF;
  padding:10px 0px 30px 0px;
  font-weight:300;
}

.cover-1 p{
  font-size:15px;
  font-weight:300;
  color:#a7a7a7;
  line-height:35px;
  margin-bottom:50px;
}

.cover-1 .button{
  border:solid 1px rgba(255,255,255,0.2);
  color:#FFFFFF;
  margin-right:10px;
}

.cover-2{padding-top:0px;}

.cover-2 h1{
  color:#FFFFFF;
  font-size:30px;
  font-weight:300;
  text-align:center;
  padding-top:30px;
}

.cover-2 h6{
  color:#c1c1c1;
  font-style: italic;
  font-size:13px;
  font-weight:300;
  text-align:center;
  padding:0px 0px 20px 0px;
}

.cover-2 p{
  font-size:15px;
  text-align:center;
  line-height:36px;
  color:#c1c1c1;
  padding:30px 35px 40px 35px;
  font-weight:300;
}

.cover-3{
  padding:20px 20px 20px 20px;
  background-color:#FFFFFF;
  margin:40px;
  border-radius:7px;
}

.cover-3 amp-img{
  margin:0 auto;
  display:block;
}

.cover-3 h1{
  font-size:24px;
  text-align:center;
  padding:20px 0px 0px 0px;
}

.cover-3 em{
  font-size:12px;
  display:block;
  text-align:center;
  margin-bottom:20px;
}

.cover-3 p{
  text-align:center;
  font-size:16px;
  font-weight:300;
  padding:0px 5px 0px 5px;
}

.cover-3 .socials{
  transform:scale(0.8, 0.8);
  width:210px;
  margin:0 auto;
}

.cover-3 .socials a{
  margin-left:4px;
  margin-right:4px;
}

.cover-4 h1{
  color:#FFFFFF;
  text-align:center;
  font-weight:300;
  font-size:36px;
  margin:10px 0px 10px 0px;
}

.cover-4 em{
  color:#FFFFFF;
  text-align:center;
  font-style:normal;
  display: block;
  font-size:12px;
  text-transform: uppercase;
  letter-spacing:1px;
  font-weight:300;
}

.cover-4 strong{
  color:#969696;
  text-transform:uppercase;
  font-weight:800;
  font-size:12px;
  text-align:center;
  display:block;
  margin:20px 0px 30px 0px;
}
.cover-4 strong i{
  padding-right:10px
}

.cover-4 p{
  padding:40px 30px 40px 30px;
  color:#FFFFFF;
  line-height:36px;
  text-align:center;
  font-weight:300;
  font-size:16px;
}

.cover-4 a{
  font-size:13px;
  width:170px;
  margin:0 auto;
}

.cover-5 h1{
  color:#FFFFFF;
  font-size:40px;
  font-weight:300;
  text-align:center;
  padding-top:70px;
}

.cover-5 em{
  display:block;
  text-align:center;
  color:#FFFFFF;
  font-size:12px;
  margin-top:10px;
  font-style: normal;
}

.cover-5 p{
  padding:20px 30px 20px 30px;
  color:#a7a7a7;
  font-weight:300;
  text-align:center;
  font-size:16px;
  line-height:40px;
}

.cover-socials a{
  width:35px;
  height:35px;
  border-radius:35px;
  float:left;
  text-align:center;
  line-height:35px;
  font-size:12px;
  margin:0px 5px 0px 5px;
}

.cover-socials{
  width:230px;
  margin:40px auto 30px auto;
}
.header-light{ background:#000000;}
.sub-menu{ display:none; list-style:none; margin:0;}
#sidebar .menu .sub-menu li{ padding-left:0;}
.dropdown .sub-menu .fa-angle-right{    margin-left: 0;}
#sidebar .menu .sub-menu li a{padding-left: 30px;}
.menu li:hover > .sub-menu{ display:block;}
.sm{ display:flex; margin:15px 0; text-align:center;font-size: 44px;}
.sm-search{display:flex; margin: 0; text-align:center;font-size: 25px; margin: 0 11px;
}
.follow a{ display:inline-block; font-size:15px; color:#fff; height:25px; width:25px; border-radius:100%; border:1px solid #fff; margin:0 5px; line-height:27px;}
.pnk{ color:#c12450;}
.caption h5{ color:#fff; line-height:22px;}
.caption{ padding:10px;}
.tag {
    background: #dd3355;
    background: -moz-linear-gradient(-45deg, rgba(255,255,255,0) 8%, #dd3355 8%, hsl(348,71%,41%) 92%, rgba(255,255,255,0) 92%);
    background: -webkit-linear-gradient(-45deg, rgba(255,255,255,0) 8%,#dd3355 8%,hsl(348,71%,41%) 92%,rgba(255,255,255,0) 92%);
    background: linear-gradient(135deg, rgba(255,255,255,0) 8%,#dd3355 8%,hsl(348,71%,41%) 92%,rgba(255,255,255,0) 92%);
    color: #fff;
    padding: 8px 8px;
    display: inline-block;
}
.tags {
    font-weight: 600;
    color: #000;
    line-height: 1em;
    padding: 7px 10px;
    margin: 1px 1px;
    font-size: 13px;
    position: relative;
    display: inline-block;
    background: rgba(150,150,150,0.1) none repeat scroll 0 0;
    background: -moz-linear-gradient(-45deg, rgba(255,255,255,0) 8%,rgba(150,150,150,0.1) 8%, rgba(150,150,150,0.1) 92%, rgba(255,255,255,0) 92%);
    background: -webkit-linear-gradient(-45deg, rgba(255,255,255,0) 8%,rgba(150,150,150,0.1) 8%,rgba(150,150,150,0.1) 92%,rgba(255,255,255,0) 92%);
    background: linear-gradient(135deg, rgba(255,255,255,0) 8%,rgba(150,150,150,0.1) 8%,rgba(150,150,150,0.1) 92%,rgba(255,255,255,0) 92%);
    text-transform: normal;
    border-radius: 0px;
    border: 1px solid #ccc;
    vertical-align: top;
}
.fullwide{ display:flex; margin-top:25px;}
.fleft{ float:left;}
.authorimg img{ border-radius:100%;}

.media{text-align: left;
    display: table;
    width: 100%;}
.quotation::before {
    font-family: "FontAwesome";
    font-weight: 900;
    content: "\f10d";
    font-size: 20px;
    position: relative;
    margin-right: 10px;
}
.quotation:after {
    font-family: "FontAwesome";
    font-weight: 900;
    content: "\f10e";
    font-size: 20px;
    position: absolute;
    margin-left: 15px;
    margin-top: 5px;
}
.adv{ text-align:center; margin-top:20px;}
 .amp-next-page-default-separator {
    border-bottom: 2px solid red;
  }
  .mt20{ margin-top:20px;}
  .amplist h5{ font-size:15px; line-height:20px; margin-bottom:5px; margin-top:5px;}
  .amplist{ margin:20px 0; display:block; border-bottom: 1px solid #dedede;}
  .authorimg{ width:100px; height:100px; margin:auto;}
  .fullwide{ display:flex;}
  .author{margin-left: 10px;
    text-align: left;
    /* word-break: break-all; */
    display: table-cell;
    vertical-align: top;
    padding: 0 4%;
    width: 55%;}
  .media-body2 a{ color:#000; font-weight:bold;}
  
form.amp-form-submit-success [submit-success],
form.amp-form-submit-error [submit-error]{
  margin-top: 16px;
}
form.amp-form-submit-success [submit-success] {
  color: green;
}
form.amp-form-submit-error [submit-error] {
  color: red;
}
form.amp-form-submit-success.hide-inputs > input {
  display: none;
}
.ampstart-input{       -ms-flex-preferred-size: 0;
    flex-basis: 0;
    -ms-flex-positive: 1;
    flex-grow: 1;
    max-width: 100%;}
  .col-auto {
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    width: auto;
    max-width: none;
}
.p2{ display:flex;}
.tbox{ width:100%; border:1px solid #ccc; padding:5px; border-radius:6px 0 0 6px; font-size:16px;}
.tbox2{ width:97%; border:1px solid #ccc; padding:1.5%; border-radius:4px; font-size:16px;}
.sub-btn{         background: #d40b4e;
    color: #fff;
    padding: 8px;}
  .fright{ float:right;}
  
  .search-btn{         background: #d40b4e;
    color: #fff;
    padding: 9px; font-family: FontAwesome;}
.subscribe{     display: block;
    padding: 10px;
    background: #131313;
    border-radius: 4px;}
.yl{color:#ffca00;}
.pb30{ padding-bottom:30px;}
.amp-social-share-facebook,
.amp-social-share-twitter,
.amp-social-share-linkedin,
.amp-social-share-whatsapp,
.amp-social-share-email{ border-radius:4px; margin-right:10px;}
.amp-social-share-email {
    background-color: #808080;
}
.fa-facebook-square{color:#3b5998; margin-right:10px;}
.fa-twitter-square{ color:#1da1f2; margin-right:10px;}
.fa-linkedin-square{ color:#0077b5; margin-right:10px;}
.fa-youtube-play{color:#ff0100; margin-right:10px;}

#sidebar .menu .dropdown {
    color: #e6e6e6;
    font-size: 14px;
    font-weight: 500;
    padding-left: 50px; position:relative;
}
#sidebar .menu li .sub-menu .fa-angle-right{ left:0;}
.dropdown .fa-angle-right{ margin-left:10px;}
.shortlogo{ float:left; display:block; padding:5px 10px 10px;}
.iframe-embed{ display:block; width:100%; margin:15px 0 20px 0; }
.sm-search .fa-share-alt-square{ color:#eee;}
.author p{ font-size:14px;}
.date{ font-size:13px;}
.shareit{    margin-left: 0;
    position: relative;
    background: #d12d4d;
    border: none;
    padding: 5px; font-size:14px; font-weight:bold; margin-right:12px; color:#fff;}
  .right-arow:after {
    content: '';
    display: block;
    position: absolute;
    right: -14px;
    top: 50%;
    margin-top: -7px;
    border-top: 7px solid transparent;
    border-right: 7px solid transparent;
    border-bottom: 7px solid transparent;
    border-left: 7px solid #d12d4d;
}
.follo a{ font-size:25px;}
.rightside{ float:right;}
.rightside .sub-btn{ padding:1px 10px; font-size:14px;}
.relativeimg {
       display: table-cell;
    width: 37%;
}
.media-body2{ line-height:18px;}
.relativeimg img{ border:1px solid #ccc;}
.authormedia{ display:flex;}
.authordetails{    margin-left: 10px;
    text-align: left;
    word-break: break-all;}
  .authordetails p{ font-size:14px; word-break:normal;}
  .f14{ font-size:14px; word-break:break-all;width: 100%; }
  .f14 a{ color:#666666;}
  .flama{ font-weight:bold;}
  
  
  amp-social-share.custom-style {
      background-color: #008080;
      background-image: url('https://raw.githubusercontent.com/google/material-design-icons/master/social/1x_web/ic_share_white_48dp.png');
      background-repeat: no-repeat;
      background-position: center;
      background-size: contain;
    }

    amp-social-share.rounded {
      border-radius: 50%;
      background-size: 60%;
    }
  .fullwide.mt10{ margin-top:10px;}

 amp-img > div[fallback] {
    display: flex;
    align-items: center;
    justify-content: center;
    background:url('https://storage.googleapis.com/media-news/default-story.jpg') no-repeat;
    background-size: 100%;
    border: solid 1px #ccc;
  }
</style>
<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none} 

</style></noscript>
</head>
<body>  
  <amp-auto-ads type="adsense"
              data-ad-client="ca-pub-5224870874807163">
</amp-auto-ads>
<amp-analytics type="googleanalytics">
<script type="application/json">
{
  "vars": {
    "account": "UA-37285268-1"
  },
  "triggers": {
    "trackPageview": {
      "on": "visible",
      "request": "pageview"
    }
  }
}
</script>
</amp-analytics>
<header class="header-light">
        <button on="tap:sidebar.toggle" class="ampstart-btn caps m2 header-icon-1"><i class="fa fa-navicon"></i></button>
        <a href="{{url('')}}" class="header-logo"><amp-img src="https://www.samachar4media.com/img/logo.png" width="190" height="50"></amp-img></a>
            </header>
        
    <amp-sidebar id="sidebar" layout="nodisplay" side="right">
    <div class="shortlogo">
    <amp-img src="{{url('')}}/img/e4mshortlogo.png" width="53" height="30"></amp-img>
    </div>
    
    <div role="button" aria-label="close sidebar" on="tap:sidebar.toggle" tabindex="0" class="close-sidebar">✕</div>
        <div class="sidebar-header">
        
        <div class="subscribe mt40">
 <form action="/searcharticle"  method="GET"
  class="p2"
  target="_top">
  
  <div class="ampstart-input inline-block relative mb3">
    <input type="search"
      placeholder=""
      name="email"
      class="tbox">
  </div>
  <div class="col-auto"><input type="submit"
    value="&#xf002"
    class="search-btn caps">
    </div>
</form>
 </div>
        </div>
        
          <ul class="menu">
          @foreach($menus as $item)
         
          <li class="dropdown"><i class="fa fa-angle-right" aria-hidden="true"></i> <a class="dropdown-item" href="@if(strpos($item->slug,'https') !== false){{$item->slug}} @else{{url('')}}/{{$item->slug}}@endif">{{Str::upper($item->title)}}</a>
            @if($item->children->count() > 0)<i class="fa fa-sort-desc" aria-hidden="true"></i>@endif
          <ul class="sub-menu">
          @foreach($item->children as $submenu)
         <li><a class="dropdown-item" href="@if(strpos($submenu->slug,'https') !== false){{$submenu->slug}} @else{{url('')}}/{{$submenu->slug}}@endif">{{Str::upper($submenu->title)}}</a></li>
          @endforeach
          </ul>
          </li>
        
          @endforeach
          </ul>
         
        <!--  <div class="subscribe mt20">
         <h5 class="yl">Signup Now!</h5>
         <form method="GET"
          class="p2"
          action="{{url('subscribenewsletter-info')}}"
          target="_top">
          
          <div class="ampstart-input inline-block relative mb3">
            <input type="search"
              placeholder="Email id"
              name="email"
              class="tbox">
          </div>
          <div class="col-auto"><input type="submit"
            value="OK"
            class="sub-btn caps">
            </div>
        </form>
         </div> -->
<div class="sm-search follow mt20"> 
       <span class="shareit right-arow">Follow on</span>
        
        
        
          
    <a href="https://www.facebook.com/Samachar4media"><i class="fa fa-facebook" aria-hidden="true"></i></a>
    <a href="https://twitter.com/s4mtweets"><i class="fa fa-twitter" aria-hidden="true"></i></i></a>
  <a href="https://in.linkedin.com/company/Samachar4media"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
 <a href="#"> <i class="fa fa-youtube" aria-hidden="true"></i></a>
  </div>
        
        
        
    </amp-sidebar>
        
       <div class="container"> 

    <div class="page-content">
           
        <section>

                <div class="content material-box">
              <p class="date d-block mt-2">
              <a href="{{url('/')}}">Home</a> / <a href="{{url('')}}/{{str_slug($ArrViewArticle->category_name)}}-news.html">{{$ArrViewArticle->category_name}}-News</a>
             </p>
              
            <h1 class=" ultrabold quarter-bottom raleway">   {{  $ArrViewArticle->title }}</h1>
            <!--<p><strong>MN+, the destinations for Hollywood movies has associated with Kamal Haasan&rsquo;s Vishwaroop 2 for Season 3 of Pathbreakers. Starting August 06, &lsquo;Pathbreakers&rsquo;, a compilation of critically acclaimed and genre-defining cinema that broke stereotypes and pioneered change,</strong></p>
-->
<p class="date d-block mt-2"><i class="fa fa-user" aria-hidden="true"></i> {{$ArrViewArticle->authorname}} <i class="fa fa-clock-o" aria-hidden="true"></i>   @if(Carbon\Carbon::parse($ArrViewArticle->publish_date && $ArrViewArticle->publish_date ? $ArrViewArticle->publish_date .' '. $ArrViewArticle->publish_time : '---')->diffInWeeks() > 1)
                    {{(new DateTime($ArrViewArticle->publish_date && $ArrViewArticle->publish_date ? $ArrViewArticle->publish_date .' '. $ArrViewArticle->publish_time : '---'))->format('d-F-Y')}} 
                    @else 
                    {{ Carbon\Carbon::parse($ArrViewArticle->publish_date && $ArrViewArticle->publish_date ? $ArrViewArticle->publish_date .' '. $ArrViewArticle->publish_time : '---')->diffForHumans()}}
                    @endif</p>

<amp-img src="{{Config::get('constants.awsbaseurl')}}{{ $ArrViewArticle->photopath }}" alt="{{ $ArrViewArticle->phototitle }}" layout="responsive" width="800" height="432"><div fallback></div></amp-img>

<div class="sm"> 
 <span class="shareit right-arow">Share It</span>
  <amp-social-share class="rounded" type="facebook"
    data-param-app_id="254325784911610" width="30" height="30"></amp-social-share>
    <amp-social-share class="rounded" type="twitter" width="30" height="30" ></amp-social-share>
  <amp-social-share class="rounded" type="linkedin" width="30" height="30" data-param-text="Hello world"></amp-social-share>
  <amp-social-share class="rounded" type="whatsapp" width="30" height="30"></amp-social-share>
  <amp-social-share class="rounded" type="email" width="30" height="30"></amp-social-share></div>

<p>{!!  $contentnew !!}</p>

 @if($photogallery!='null')  
<h4 class="uppercase ultrabold quarter-bottom raleway"><span class="pnk"><i class="fa fa-play" aria-hidden="true"></i></span> Story <span class="pnk">Gallery</span></h4>
<div class="sliders full-bottom">
			<amp-carousel class="slider" width="700" height="450" layout="responsive" type="slides" controls autoplay loop delay="3000">
			@foreach($photogallery as $key => $photo)
			<div>
			<amp-img class="responsive-img" src="{{Config::get('constants.SiteCmsurl')}}{{Config::get('constants.ALBUM_IMAGE_DIR')}}{{ $photo->photopath }}" layout="fill"></amp-img>
			<div class="caption">
			<h5>{{$photo->title}}</h5>
			</div>
			</div>
			@endforeach
			</amp-carousel>
		</div>


 @endif       
        
       <div class="sm"> 
        <span class="shareit right-arow">Share It</span>
  <amp-social-share class="rounded" type="facebook"
    data-param-app_id="254325784911610" width="30" height="30"></amp-social-share>
    <amp-social-share class="rounded" type="twitter" width="30" height="30" ></amp-social-share>
  <amp-social-share class="rounded" type="linkedin" width="30" height="30" data-param-text="Hello world"></amp-social-share>
  <amp-social-share class="rounded" type="whatsapp" width="30" height="30"></amp-social-share>
  <amp-social-share class="rounded" type="email" width="30" height="30"></amp-social-share>
</div> 

        <!--tags start-->
        @if(isset($ArrTageListing) && !empty($ArrTageListing))
                                <span class="tag text-uppercase flama">Tags    <i class="fa fa-tags" aria-hidden="true"></i></span>
                                @foreach(explode(',', $ArrTageListing) as $tag) 
                                <a href="{{url('')}}/tags/{{str_slug($tag)}}.html" class="btn tags">{{ $tag }}</a> 
                                @endforeach
                                @endif
<div class="fullwide">
<div class="authorimg d-block center-text">
<a href="#">
<amp-img src="{{Config::get('constants.awsbaseurl')}}{{Config::get('constants.awauthordir')}}{{$ArrViewArticle->photo}}" alt="" layout="responsive" width="50" height="50"></amp-img>
</a>
</div>
</div>
<div class="fullwide center-text">
<p class="media-body f14"> 
<span class="flama mt-0 f20"><a href="#">{{$ArrViewArticle->name}}</a></span>
<span class="story-author d-block mt-1"><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:{{$ArrViewArticle->email}}">{{$ArrViewArticle->email}}</a></span>
<span class="story-author d-block mt-1"><i class="fa fa-twitter" aria-hidden="true"></i> <a href="#">{{$ArrViewArticle->twitter}}</a></span>
</p>
</div>
 <div class="list">
<h4 class="uppercase ultrabold quarter-bottom mt20 raleway"><span class="pnk"><i class="fa fa-play" aria-hidden="true"></i></span> Related <span class="pnk">Story</span></h4>

 @foreach($ArrRecentNewslist as $index => $articlesrelate)


<div class="amplist">
<div class="media">
  <div class="relativeimg">
   <a href="{{ url('')}}/amp/{!! Helper::rscUrl($articlesrelate->category_name) !!}-news/{!! Helper::rscUrl($articlesrelate->title) !!}-{{ $articlesrelate->article_id }}.html">
  <amp-img src="{{Config::get('constants.SiteCmsurl')}}{{$articlesrelate->photopath }}" alt="{{$articlesrelate->phototitle }}" layout="responsive" width="800" height="432"></amp-img>
  </a>
  </div>
  <div class="author">
  <p class="media-body2 mb-0 small2 lh-125"> 
  <span class="flama mt-0 f20"><a href="{{ url('')}}/amp/{!! Helper::rscUrl($articlesrelate->category_name) !!}-news/{!! Helper::rscUrl($articlesrelate->title) !!}-{{ $articlesrelate->article_id }}.html">{{$articlesrelate->title}}</a> <span class="date d-block mt-2"><i class="fa fa-clock-o" aria-hidden="true"></i>  @if(Carbon\Carbon::parse($articlesrelate->publish_date && $articlesrelate->publish_date ? $articlesrelate->publish_date .' '. $articlesrelate->publish_time : '---')->diffInWeeks() > 1)
                    {{(new DateTime($articlesrelate->publish_date && $articlesrelate->publish_date ? $articlesrelate->publish_date .' '. $articlesrelate->publish_time : '---'))->format('d-F-Y')}} 
                    @else 
                    {{ Carbon\Carbon::parse($articlesrelate->publish_date && $articlesrelate->publish_date ? $articlesrelate->publish_date .' '. $articlesrelate->publish_time : '---')->diffForHumans()}}
                    @endif</span></span><br>
  </p>
</div>
  </div>
</div>

@endforeach

</div>

<div class="list">
<h4 class="uppercase ultrabold quarter-bottom mt20 raleway"><span class="pnk"><i class="fa fa-play" aria-hidden="true"></i></span> Top <span class="pnk">News</span></h4>
@foreach($ArrRecentFeatureNewsList->take(5) as $ArrRecentFeatureNewsList)
<div class="amplist">
<div class="media">
  <div class="relativeimg">
   <a href="{{ url('')}}/amp/{!! Helper::rscUrl($ArrRecentFeatureNewsList->category_name) !!}-news/{!! Helper::rscUrl($ArrRecentFeatureNewsList->title) !!}-{{ $ArrRecentFeatureNewsList->article_id }}.html">
  <amp-img src="{{Config::get('constants.SiteCmsurl')}}{{$ArrRecentFeatureNewsList->photopath }}" alt="{{$ArrRecentFeatureNewsList->phototitle }}" layout="responsive" width="800" height="432"></amp-img>
  </a>
  </div>
  <div class="author">
  <p class="media-body2 mb-0 small2 lh-125"> 
  <span class="flama mt-0 f20"><a href="{{ url('')}}/amp/{!! Helper::rscUrl($ArrRecentFeatureNewsList->category_name) !!}-news/{!! Helper::rscUrl($ArrRecentFeatureNewsList->title) !!}-{{ $ArrRecentFeatureNewsList->article_id }}.html">{{$ArrRecentFeatureNewsList->title}}</a><span class="date d-block mt-2"><i class="fa fa-clock-o" aria-hidden="true"></i> @if(Carbon\Carbon::parse($ArrRecentFeatureNewsList->updated_at)->diffInWeeks() > 1)
                            {{(new DateTime($ArrRecentFeatureNewsList->publish_date))->format('d-F-Y')}} 
                            @else 
                            {{ Carbon\Carbon::parse($ArrRecentFeatureNewsList->publish_date)->diffForHumans()}}
                            @endif</span></span><br>
  </p>
</div>
  </div>
</div>


@endforeach
</div>

<div class="list">
<h4 class="uppercase ultrabold quarter-bottom mt20 raleway"><span class="pnk"><i class="fa fa-play" aria-hidden="true"></i></span> EDITOR'S  <span class="pnk">PICK</span></h4>
@if(isset($ArrRecentImportaintNewsHeaderList)) 
@foreach($ArrRecentImportaintNewsHeaderList->take(5) as $ArrRecentImportaintNewsHeaderList)
<div class="amplist">
<div class="media">
  <div class="relativeimg">
   <a href="{{ url('')}}/amp/{!! Helper::rscUrl($ArrRecentImportaintNewsHeaderList->category_name) !!}-news/{!! Helper::rscUrl($ArrRecentImportaintNewsHeaderList->title) !!}-{{ $ArrRecentImportaintNewsHeaderList->article_id }}.html">
  <amp-img src="{{Config::get('constants.SiteCmsurl')}}{{$ArrRecentImportaintNewsHeaderList->photopath }}" alt="{{$ArrRecentImportaintNewsHeaderList->phototitle }}" layout="responsive" width="800" height="432"></amp-img>
  </a>
  </div>
  <div class="author">
  <p class="media-body2 mb-0 small2 lh-125"> 
  <span class="flama mt-0 f20"><a href="{{ url('')}}/amp/{!! Helper::rscUrl($ArrRecentImportaintNewsHeaderList->category_name) !!}-news/{!! Helper::rscUrl($ArrRecentImportaintNewsHeaderList->title) !!}-{{ $ArrRecentImportaintNewsHeaderList->article_id }}.html">{{$ArrRecentImportaintNewsHeaderList->title}}</a> <span class="date d-block mt-2"><i class="fa fa-clock-o" aria-hidden="true"></i>  @if(Carbon\Carbon::parse($ArrRecentImportaintNewsHeaderList->publish_date && $ArrRecentImportaintNewsHeaderList->publish_date ? $ArrRecentImportaintNewsHeaderList->publish_date .' '. $ArrRecentImportaintNewsHeaderList->publish_time : '---')->diffInWeeks() > 1)
                    {{(new DateTime($ArrRecentImportaintNewsHeaderList->publish_date && $ArrRecentImportaintNewsHeaderList->publish_date ? $ArrRecentImportaintNewsHeaderList->publish_date .' '. $ArrRecentImportaintNewsHeaderList->publish_time : '---'))->format('d-F-Y')}} 
                    @else 
                    {{ Carbon\Carbon::parse($ArrRecentImportaintNewsHeaderList->publish_date && $ArrRecentImportaintNewsHeaderList->publish_date ? $ArrRecentImportaintNewsHeaderList->publish_date .' '. $ArrRecentImportaintNewsHeaderList->publish_time : '---')->diffForHumans()}}
                    @endif</span></span><br>
  </p>
</div>
  </div>
</div>

@endforeach
@endif
</div>


<div class="list">
<h4 class="uppercase ultrabold quarter-bottom mt20 raleway"><span class="pnk"><i class="fa fa-play" aria-hidden="true"></i></span> Latest  <span class="pnk">News</span></h4>
@if(isset($ArrRecentNewsMiddelbarList))  
@foreach($ArrRecentNewsMiddelbarList->take(5) as $ArrRecentNewsMiddelbarList)
<div class="amplist">
<div class="media">
  <div class="relativeimg">
   <a href="{{ url('')}}/amp/{!! Helper::rscUrl($ArrRecentNewsMiddelbarList->category_name) !!}-news/{!! Helper::rscUrl($ArrRecentNewsMiddelbarList->title) !!}-{{ $ArrRecentNewsMiddelbarList->article_id }}.html">
  <amp-img src="{{Config::get('constants.SiteCmsurl')}}{{$ArrRecentNewsMiddelbarList->photopath }}" alt="{{$ArrRecentImportaintNewsHeaderList->phototitle }}" layout="responsive" width="800" height="432"></amp-img>
  </a>
  </div>
  <div class="author">
  <p class="media-body2 mb-0 small2 lh-125"> 
  <span class="flama mt-0 f20"><a href="{{ url('')}}/amp/{!! Helper::rscUrl($ArrRecentNewsMiddelbarList->category_name) !!}-news/{!! Helper::rscUrl($ArrRecentNewsMiddelbarList->title) !!}-{{ $ArrRecentNewsMiddelbarList->article_id }}.html">{{$ArrRecentNewsMiddelbarList->title}}</a>
    <span class="date d-block mt-2"><i class="fa fa-clock-o" aria-hidden="true"></i>  @if(Carbon\Carbon::parse($ArrRecentNewsMiddelbarList->publish_date && $ArrRecentNewsMiddelbarList->publish_date ? $ArrRecentNewsMiddelbarList->publish_date .' '. $ArrRecentNewsMiddelbarList->publish_time : '---')->diffInWeeks() > 1)
                    {{(new DateTime($ArrRecentNewsMiddelbarList->publish_date && $ArrRecentNewsMiddelbarList->publish_date ? $ArrRecentNewsMiddelbarList->publish_date .' '. $ArrRecentNewsMiddelbarList->publish_time : '---'))->format('d-F-Y')}} 
                    @else 
                    {{ Carbon\Carbon::parse($ArrRecentNewsMiddelbarList->publish_date && $ArrRecentNewsMiddelbarList->publish_date ? $ArrRecentNewsMiddelbarList->publish_date .' '. $ArrRecentNewsMiddelbarList->publish_time : '---')->diffForHumans()}}
                    @endif</span></span><br>
  </p>
</div>
  </div>
</div>
@endforeach
@endif
</div>



<div class="list">
<h4 class="uppercase ultrabold quarter-bottom mt20 raleway"><span class="pnk"><i class="fa fa-play" aria-hidden="true"></i></span> MOST <span class="pnk">READ</span></h4>
@if(isset($arrmostread)) 
@foreach($arrmostread as $arrmostread)
<div class="amplist">
<div class="media">
  <div class="relativeimg">
   <a href="{{ url('')}}/amp/{!! Helper::rscUrl($arrmostread->category_name) !!}-news/{!! Helper::rscUrl($arrmostread->title) !!}-{{ $arrmostread->article_id }}.html">
  <amp-img src="{{Config::get('constants.awsbaseurl')}}{{ $arrmostread->article['photopath'] }}" alt="{{$arrmostread->phototitle }}" layout="responsive" width="800" height="432"></amp-img>
  </a>
  </div>
  <div class="author">
  <p class="media-body2 mb-0 small2 lh-125"> 
  <span class="flama mt-0 f20"><a href="{{ url('')}}/amp/{!! Helper::rscUrl($arrmostread->category_name) !!}-news/{!! Helper::rscUrl($arrmostread->title) !!}-{{ $arrmostread->article_id }}.html"> {{ $arrmostread->title }}</a> <span class="date d-block mt-2"><i class="fa fa-clock-o" aria-hidden="true"></i>  @if(Carbon\Carbon::parse($arrmostread->publish_date && $arrmostread->publish_date ? $arrmostread->publish_date .' '. $arrmostread->publish_time : '---')->diffInWeeks() > 1)
                    {{(new DateTime($arrmostread->publish_date && $arrmostread->publish_date ? $arrmostread->publish_date .' '. $arrmostread->publish_time : '---'))->format('d-F-Y')}} 
                    @else 
                    {{ Carbon\Carbon::parse($arrmostread->publish_date && $arrmostread->publish_date ? $arrmostread->publish_date .' '. $arrmostread->publish_time : '---')->diffForHumans()}}
                    @endif</span></span><br>
  </p>
</div>
  </div>
</div>
@endforeach
@endif
</div>


<div class="list">
<h4 class="uppercase ultrabold quarter-bottom mt20 raleway"><span class="pnk"><i class="fa fa-play" aria-hidden="true"></i></span> S4M <span class="pnk">Video</span> <span class="rightside"><a href="{{url('')}}/videos.html" class="sub-btn">View More</a></span></h4>

<div class="video">
  @if(isset($ArrMenuSLatestVideo))
   @foreach($ArrMenuSLatestVideo->take(1) as $ArrMenuSLatestVideo)
            <amp-iframe width="500" title="Netflix House of Cards branding: The Stack"
                          height="300"
                          layout="responsive"
                          sandbox="allow-scripts allow-same-origin allow-popups"
                          allowfullscreen
                          frameborder="0"
                          src="https://www.youtube.com/embed/{{$ArrMenuSLatestVideo->vid}}">
  </amp-iframe>
     @endforeach 
     @endif      
    </div>
        
</div>

 
    </div>

         
                            
       <div class="footer">                   
      <div class="footer-socials">
              
              <div class="col-lg-3 col-12 col-sm-6">
<h5 class="ftext">ABOUT S4M</h5>
<p class="f15">Samachar4media was set up in year 2000 with the aim of publishing niche, relevant and quality publications for the marketing, advertising and media professionals.</p>
<p class="f13"><i class="fa fa-map-marker" aria-hidden="true"></i> ADSERT WEB SOLUTIONS PVT. LTD. B-20, SECTOR 57 NOIDA (U.P)</p>
<p class="f13"><i class="fa fa-phone" aria-hidden="true"></i> (0120) 4007700</p>
<p class="f13"><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:contact@Samachar4media.com">Connect With Us !</a></p>
</div>

<div class="col-lg-4 col-12 col-sm-6 pl-5 pr-5">
<h5 class="ftext">USEFULL LINK</h5>
<div class="row">
<div class="col-lg-6 col-12 col-sm-6">
<ul class="list-unstyled f15">
@foreach($menus->take(6) as $item)
@if($item->link=='FOOTER1')
<li><a href="{{url('')}}/{{$item->slug}}">{{Str::upper($item->title)}}</a></li>
@endif
@endforeach
</ul>
</div>


<div class="col-lg-6 col-12 col-sm-6">
<ul class="list-unstyled f15">
@foreach($menus as $item)
@foreach($item->children as $submenu)
@if($item->id=='4')
<li><a href="{{url('')}}/{{$submenu->slug}}">{{Str::upper($submenu->title)}}</a></li>
@endif
@endforeach
@endforeach
</ul>
</div>
</div>
</div>

<div class="col-lg-2 col-12 col-sm-6">
<h5 class="ftext">OTHER LINK</h5>
<ul class="list-unstyled f15">
<li><a href="{{url('')}}/sitemap.html">Sitemap</a></li>
<li><a href="{{url('')}}/privacy-policy.html">Privacy Policy</a></li>
<li><a href="{{url('')}}/term-condition.html">Term & Condition</a></li>
<li><a href="{{url('')}}/gdpr-compliance.html">GDPR Compliance</a></li>
<li><a href="{{url('')}}/cookie-policy.html">Cookie Policy</a></li>
<li><a href="{{url('')}}/contact-us.html">Contact us</a></li>
          </ul>
</div>


<div class="col-lg-3 col-12 col-sm-6">
<h5 class="ftext">CONNECT WITH US</h5>
 <div class="follo">
  <a href="https://www.facebook.com/Samachar4media"><i class="fa fa-facebook" aria-hidden="true"></i></a>
    <a href="https://twitter.com/s4mtweets"><i class="fa fa-twitter" aria-hidden="true"></i></i></a>
  <a href="https://in.linkedin.com/company/Samachar4media"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
 <a href="#"> <i class="fa fa-youtube" aria-hidden="true"></i></a>
 </div>
<!--           <h5 class="ftext2">Sign up Now </h5>
 <form method="GET"
  class="p2"
  action="/subscribenewsletter-info"
  target="_top">
  
  <div class="ampstart-input inline-block relative mb3">
    <input type="search"
      placeholder="Email id"
      name="s_email"
      class="tbox">
  </div>
  <div class="col-auto"><input type="submit"
    value="OK"
    class="sub-btn caps">
    </div>
</form> -->
</div>
                                  
                                        
        <div class="clear"></div>
      </div>
      
     <div class="footer-copyright text-center py-3 blu small">The material on this site may not be reproduced, distributed, transmitted, cached or otherwise used, except with the prior written permission of digital.<br>
    Copyright © <?php echo date("Y"); ?> Adsert Web Solutions Pvt Ltd
    </div>
    </div>
      </section>
            
           
            
            
  </div>

  </div>
    
</body>
</html>