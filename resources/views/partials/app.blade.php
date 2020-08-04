<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
      <meta charset="ISO-8859-1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
      <meta http-equiv="content-language" content="hi,en-IN" />         
      <!-- CSRF Token Start-->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link href="https://fonts.googleapis.com/css?family=Fira+Sans|PT+Sans" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <!-- CSRF Token End-->
      <!-- Meta details Start-->
      @if(isset($title) && !empty($title))
      <title>{{$title}} - Samachar4media</title>
      @else
      <title>मीडिया की दुनिया की खबरें,  विज्ञापन जगत की खबरें | Media News, Advertising News, Media Industry Updates – Samachar4media</title>
      @endif
      @if(isset($metadescription) && !empty($metadescription))
      <meta name="description" content="{{$metadescription}}" />
      @else
      <meta name="description" content="मीडिया, विज्ञापन और सोशल मीडिया की दुनिया की खबरों के लिए पढ़ें समाचार4मीडिया
       | Samachar4media has best and latest media news, advertising news, media industry updates for more information visit our website." />
      @endif 
      <meta property="fb:pages" content="349239931811206" />
      @if(isset($metatitle) && !empty($metatitle))
      <meta name="title" content="{{$metatitle}}"/>
      @else
      <meta name="title" content="Media News, Advertising News, Media Industry Updates – Samachar4media"/>
      @endif
      @if(isset($metadescription) && !empty($metadescription))
      <meta itemprop="description" name="description" content="{{$metadescription}}" />
      @else
      <meta itemprop="description" name="description" content="Samachar4media has best and latest media news, advertising news, media industry updates for more information visit our website." />
      @endif
      @if(isset($metatag) && !empty($metatag))
      <meta name="keywords" content="{{$metatag}}" />
      @else
      <meta name="keywords" content="Latest News of  Print Media, News Channels, Digital Media, Hindi Media, Hindi Journalists हिदी पत्रकारिता, पत्रकार, मीडिया, खबरें, मीडिया की दुनिया की खबरें" />
      @endif
      @if(isset($metatag) && !empty($metatag))
      <meta name="news_keywords" content="{{$metatag}}" />
      @else
      <meta name="news_keywords" content="Latest News of  Print Media, News Channels, Digital Media, Hindi Media, Hindi Journalists हिदी पत्रकारिता, पत्रकार, मीडिया, खबरें, मीडिया की दुनिया की खबरें" />
      @endif
      @if(isset($ogimage) && !empty($ogimage)) 
      <meta itemprop="thumbnailUrl" name="image_src" content="{{$ogimage}}"/>
      @else
      <meta itemprop="thumbnailUrl" content="https://www.samachar4media.com/images/logo.png"/>
      @endif
      @if(isset($metatitle) && !empty($metatitle))
      <meta property="og:title" content="{{$metatitle}} - Samachar4media"/>
      @else
      <meta property="og:title" content="Media News, Advertising News, Media Industry Updates – Samachar4media"/>
      @endif
      <meta property="og:type" content="article" />
      @if(isset($ogurl) && !empty($ogurl))
      @if(Request::route()->uri == '{section}/{title}-{id}.html' )
      <link rel="amphtml" href="{{$ogurl}}/amp"/>
      @endif
      <meta itemprop="url" property="og:url" content="{{$ogurl}}" />
      @else 
      <meta itemprop="url" property="og:url" content="{{url('')}}"/>
      @endif
      <meta property="og:site_name" content="{{url('')}}"/>
      @if(isset($metadescription) && !empty($metadescription))    
      <meta property="og:description" content="{{$metadescription}}"/>
      @else
      <meta property="og:description" content="Samachar4media has best and latest media news, advertising news, media industry updates for more information visit our website."/>
      @endif
      @if(isset($ogimage) && !empty($ogimage)) 
      <meta property="og:image"  itemprop="image"  content="{{$ogimage}}"/>
      @else
      <meta property="og:image" content="http://www.samachar4media.com/images/logo.png"/>
      @endif
      <meta property="og:image:width" content="870"/>
      <meta property="og:image:height" content="470"/>
      <!-- Twitter Metatags Start -->
      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:site" content="@samachar4media">
      <meta name="twitter:creator" content="@samachar4media">
      @if(isset($metatitle) && !empty($metatitle))
      <meta name="twitter:title" content="{{$metatitle}}">
      @else
      <meta name="twitter:title" content="{{'Media News, Advertising News, Media Industry Updates – Samachar4media'}}"/>
      @endif
      @if(isset($metadescription) && !empty($metadescription))
      <meta name="twitter:description" content="{{$metadescription}}">
      @else
      <meta name="twitter:description" content="Samachar4media has best and latest media news, advertising news, media industry updates for more information visit our website." />
      @endif
      @if(isset($ogimage) && !empty($ogimage)) 
      <meta name="twitter:image:src" content="{{$ogimage}}">
      @else
      <meta name="twitter:image:src" content="http://www.samachar4media.com/images/logo.png"/>
      @endif
      <!-- Twitter Metatags Ends -->
      <meta property="fb:app_id" content="287404455019045"/>
      <meta name="article:publisher" content="https://www.facebook.com/Samachar4media/"/>
      @if(isset($canonical) && !empty($canonical))
      <link rel="amphtml" href="{{$canonical}}"/>
      <link rel="canonical" href="{{ Request::url()}}" />
      @else
      <link rel="canonical" href="{{ Request::url()}}"/>
      @endif
      <meta property="og:locale" content="en_US"/>
      <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Rajdhani:300,400,500,600,700" rel="stylesheet">
      <link rel="stylesheet" href="{{asset('css/bootstrap-4.0.0.css') }}">
      <link rel="stylesheet" href="{{asset('css/mdb.min.css')}}">
      <!-- <link rel="stylesheet" href="{{asset('css/all.css')}}"> -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
      <link rel="stylesheet" href="{{asset('css/custom.css?v=2.0')}}">
      <link rel="stylesheet" href="{{asset('css/menu.css')}}">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
   <script src="{{url('FeedifySW.js')}}"></script>
      <!--Feedify Script Start-->
          <script  id="feedify_webscript" >
            var feedify = feedify || {};
            window.feedify_options={fedify_url:"https://feedify.net/"};
            (function (window, document){
              function addScript( script_url ){
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.src = script_url;
                document.getElementsByTagName('head')[0].appendChild(s);
              }
              addScript('https://tpcf.feedify.net/uploads/settings/f212bd4cd8e57c501325cfc0b8a15309.js?ts='+Math.random());
              addScript('https://cdn.feedify.net/getjs/feedbackembad.min.js');
            })(window, document);
            function permission() {
              Notification.requestPermission();
            }     
            </script>
    <link rel="manifest" href="{{url('manifest.json')}}"> 
      <!--Feedify Script End-->

      @if(\Request::is('/'))
      <script type="application/ld+json">
      {"@context": "https://schema.org","@type": "Organization","name": "Samachar4media",   "url": "{{url('')}}","logo": "http://www.samachar4media.com/images/logo.png",  "sameAs": [     "https://www.facebook.com/Samachar4media/","https://twitter.com/samachar4media"]}
    </script>
    <script type="application/ld+json">
      {"@context": "https://schema.org","@type": "WebSite",    "url": "{{url('')}}","potentialAction": {"@type": "SearchAction","target": "https://www.samachar4media.com/searcharticle?search_text={search_term_string}","query-input": "required name=search_term_string"}}
    </script>
    @endif

      <link rel="shortcut icon" type="image/png" href="{{url('favicon.ico')}}"/>
      <!-- <link href="https://www.samachar4media.com/manifest.json" rel="manifest"> -->
</head>
<body>
  @include('partials.header')
    @yield('content')
  @include('partials.footer')
</body>
</html>
