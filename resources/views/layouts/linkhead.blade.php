
<!-- BEGIN head -->
<head>
    <meta charset="utf-8">
    <meta charset="ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">	
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(isset($metatitel) && !empty($metatitel))
    <title>{{$metatitel}}</title>
  
    @else
    <title>{{ config('app.name', 'Indian Advertising Media & Marketing News &ndash; Exchange4media') }}</title>
    @endif
    @if(isset($metadescription) && !empty($metadescription))
    <meta name="description" content="{{$metadescription}}" />
    @else
    <meta name="description" content="At Exchange4media, read the latest news and updates on advertising agencies, marketing, print, radio, digital, television, media, events and happenings in India." />
    @endif

     @if(isset($metatag) && !empty($metatag))
     <meta name="keywords" content="{{$metatag}}" />
    @else
    <meta name="keywords" content="advertising news, marketing, ooh, television, digital, print, radio, media" />
    @endif

   
    @if(isset($canonical) && !empty($canonical))
    <link rel="canonical" href="{{$canonical}}"/>
    @else
    <link rel="canonical" href="http://www.exchange4media.com"/>
    @endif
    
    <meta property="og:site_name" content="exchange4media.com">
    @if(isset($ogtitel) && !empty($ogtitel))
    <meta property="og:title" content="{{$ogtitel}}"/>
    @else
    <meta property="og:title" content="Indian Advertising Media & Marketing News ? Exchange4media"/>
    @endif
    @if(isset($ogdescription) && !empty($ogdescription))    
    <meta property="og:description" content="{{$ogdescription}}"/>
    @else
    <meta property="og:description" content="At Exchange4media, read the latest news and updates on advertising agencies, marketing, print, radio, digital, television, media, events and happenings in India."/>
    @endif


    @if(isset($ogimage) && !empty($ogimage)) 
    <meta property="og:image"  itemprop="image"  content="{{$ogimage}}"/>
    @else
    <meta property="og:image" content="http://www.exchange4media.com/images/e4m-logo.png"/>
    @endif
    @if(isset($ogurl) && !empty($ogurl))
    <meta property="og:url" content="{{$ogurl}}" />
    @else 
    <meta property="og:url" content="http://www.exchange4media.com/"/>
    @endif
    <meta property="og:type" content="website" />
    <meta property="og:image:secure_url" content="http://www.exchange4media.com/images/e4m-logo.png"/>
    <meta property="og:image:type" content="image/jpeg"/>
    <meta property="og:image:width" content="263"/>
    <meta property="og:image:height" content="81"/>

    <meta property="og:locale" content="en"/>
     @if(isset($metatitel) && !empty($metatitel))
     <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:creator" content="@e4mtweets">
    <meta name="twitter:site" content="@e4mtweets">
    <meta name="twitter:title" content="{{$metatitel}}">
    <meta name="twitter:description" content="{{$metadescription}}">
    <meta name="twitter:image:src" content="{{$ogimage}}">
    <meta name="twitter:image:width" content="280">
    <meta name="twitter:image:height" content="150">
    <meta name="twitter:url" content="{{$ogurl}}">
 @endif

<link rel="alternate" media="handheld" href="http://www.exchange4media.com"/>
    <link rel="alternate" media="only screen and (max-width:640px)" href="http://www.exchange4media.com"/>
    <meta name="google-site-verification" content="aaVUJLjjvOmM7CIJYgqlmhlMPcxNmjAidCf0V1RE2to" />
    <meta name="msvalidate.01" content="9F80B7AD4E181FB0C01AE0C95C25B5F2" />
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="noodp" />
    <meta name="yahooseeker" content="index, follow" />
    <meta name="msnbot" content="index, follow" />
    <meta name="allow-search" content="yes" />
    <meta name="revisit-after" content="daily" />

    
    <!-- Favicon 
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />-->
    <!-- Stylesheets -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/reset.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/main-stylesheet.css') }}" />
    <!-- For white edition style -->
    <!-- <link type="text/css" rel="stylesheet" href="{{ asset('css/white-edition.css') }}" /> -->
    <link type="text/css" rel="stylesheet" href="{{ asset('resources/css/lightbox.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/shortcodes.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/custom-fonts.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/custom-colors.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/responsive.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/animate.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('css/dat-menu.css') }}" />
    <!--[if lte IE 8]>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/ie-ancient.css') }}" />
    <![endif]-->
    <!-- Demo Only -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/demo-settings.css') }}" />
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
        ]) !!}
        ;
    </script>
    <!-- END head -->
    <!-- share this-code start -->
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({publisher: "8585f6dc-2040-42b2-a782-3064b57ccbe9", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
    <!-- share this-code End -->

    <script>

        (function () {

            var customSearchOptions = {};

            var orderByOptions = {};

            orderByOptions['keys'] = [{label: 'Relevance', key: ''}, {label: 'Date', key: 'Date'}];

            customSearchOptions['enableOrderBy'] = true;

            customSearchOptions['orderByOptions'] = orderByOptions;

            customSearchOptions['overlayResults'] = true;

            var cx = '003027122107833020209:uotuksy_wyg';

            var gcse = document.createElement('script');

            gcse.type = 'text/javascript';



            gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                    '//cse.google.com/cse.js?cx=' + cx;

            var s = document.getElementsByTagName('script')[0];

            s.parentNode.insertBefore(gcse, s);

        })();

    </script>
    <script type="text/javascript">


        var _gaq = _gaq || [];


        _gaq.push(['_setAccount', 'UA-12770313-1']);


        _gaq.push(['_trackPageview']);


        (function () {


            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;


            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';


            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);


        })();
    </script> 

    
</head>



