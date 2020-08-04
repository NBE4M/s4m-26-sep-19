<!DOCTYPE HTML>
<!-- BEGIN html -->
<html lang = "en">
    @include('layouts.linkhead')
    <body>




        <!-- BEGIN .boxed.active -->
        <!--<div class="boxed active" style="z-index:999999"> -->

        @if(Request::url() == 'http://www.exchange4media.com/' || Request::url() == 'http://www.exchange4media.com' || Request::url() == 'www.exchange4media.com' || Request::url() == 'http://www.exchange4media.com/home.html' || Request::url() == 'http://www.exchange4media.com/index.php' )
        <div class="boxed active" style="z-index:999999; margin-top:100px;">
            <style>
                .isfixed{ top:90px !important; z-index:99999 !important;}
            </style>    

            <style>
                #zzadcontent1508080713
                {
                    display: table !important; background:#fff !important; width: 100% !important; height: 90px !important; top:0 !important; text-decoration: none !important; position: fixed !important; z-index: 99999 !important;
                }
                #zzadclose1508143835
                {display:none !important;}
            </style>

            <!-- Javascript tag  -->
            <!-- begin ZEDO for channel:  Home , publisher: exchange4media , Ad Dimension: Stay On Home Page 970 * 90 - 970 x 90 -->
            <center>
                <!-- Javascript tag  -->
                <!-- begin ZEDO for channel: �Home , publisher: exchange4media , Ad Dimension: zeetv�Stay�Home�Page�1270�*�90 - 1270 x 90 -->
                <script language="JavaScript">
                    var zflag_nid = "3702";
                    var zflag_cid = "4";
                    var zflag_sid = "2";
                    var zflag_width = "1270";
                    var zflag_height = "90";
                    var zflag_sz = "79";
                </script>
                <script language="JavaScript" src="http://xp2.zedo.com/jsc/xp2/fo.js"></script>
                <!-- end ZEDO for channel: �Home , publisher: exchange4media , Ad Dimension: zeetv�Stay�Home�Page�1270�*�90 - 1270 x 90 -->
            </center>

            @elseif (\Request::is('Spotlight/*'))
            <div class="boxed active" style="z-index:999999">

                @elseif (\Request::is('spotlight/*'))
                <div class="boxed active" style="z-index:999999">

                    @elseif (\Request::is('Spotlight_80.html'))
                    <div class="boxed active" style="z-index:999999">

                        @else
                        <div class="boxed active" style="z-index:999999; margin-top:100px;">
                            <style>
                                .isfixed{ top:90px !important; z-index:99999 !important;}
                            </style>
                            <style>
                                #zzadcontent1508080713
                                {
                                    display: table !important; background:#fff !important; width: 100% !important; height: 90px !important; top:0 !important; text-decoration: none !important; position: fixed !important; z-index: 99999 !important;
                                }
                                #zzadclose1508143835
                                {display:none !important;}
                            </style>
                            <center>
                <!-- Javascript tag  -->
                <!-- begin ZEDO for channel: �Home , publisher: exchange4media , Ad Dimension: zeetv�Stay�Home�Page�1270�*�90 - 1270 x 90 -->
                <script language="JavaScript">
                    var zflag_nid = "3702";
                    var zflag_cid = "4";
                    var zflag_sid = "2";
                    var zflag_width = "1270";
                    var zflag_height = "90";
                    var zflag_sz = "79";
                </script>
                <script language="JavaScript" src="http://xp2.zedo.com/jsc/xp2/fo.js"></script>
                <!-- end ZEDO for channel: �Home , publisher: exchange4media , Ad Dimension: zeetv�Stay�Home�Page�1270�*�90 - 1270 x 90 -->
            </center>




                            @endif
                            @include('layouts.header')
                            <section class="content">     
                                <!-- BEGIN .wrapper -->
                                <div class="wrapper">			
                                    <!-- BEGIN .split-block -->
                                    <div class="split-block">
                                        <!-- BEGIN .main-content -->
                                        <div class="main-content ot-scrollnimate" data-animation="fadeInUpSmall">
                                            @yield('content')
                                            @include('layouts.leftsidebarcommanpart')
                                            <!-- END .main-content -->
                                        </div>
                                        <!-- BEGIN #middelsidebar -->
                                        <aside id="sidebar-small" class="ot-scrollnimate small-sidebar" data-animation="fadeInUpSmall">
                                            @include('layouts.midilsidebar')	
                                            <!-- END #middelsidebar -->
                                        </aside>
                                        <!-- BEGIN #rightsidebar -->
                                        <aside id="sidebar" class="ot-scrollnimate" data-animation="fadeInUpSmall">
                                            @include('layouts.rightsidebar')
                                            <!-- END #rightsidebar -->
                                        </aside>
                                        <!-- END .split-block -->
                                    </div>
                                    <!-- BEGIN .full-block -->
                                    <div class="full-block ot-scrollnimate" data-animation="fadeInUpSmall">
                                        @include('layouts.middelfooter')
                                        <!-- END .full-block -->
                                    </div>
                                    <!-- END .wrapper -->
                                </div>	
                                <!-- BEGIN .content -->
                            </section>

                            @include('layouts.footer')

                            <script type="text/javascript" src="{{ asset('js/jquery-latest.min.js')}}"></script>
                            <script type="text/javascript" src="{{ asset('js/elementQuery.min.js')}}"></script>
                            <script type="text/javascript" src="{{ asset('js/theme-scripts.js')}}"></script>
                            <script type="text/javascript" src="{{ asset('js/lightbox.js')}}"></script>
                            <script type="text/javascript" src="{{ asset('js/iscroll.js')}}"></script>
                            <script type="text/javascript" src="{{ asset('js/modernizr.custom.50878.js')}}"></script>
                            <script type="text/javascript" src="{{ asset('js/dat-menu.js')}}"></script>
                            <script type="text/javascript" src="{{ asset('js/SmoothScroll.min.js')}}"></script>
                            <script type="text/javascript" src="{{ asset('js/owl.carousel.min.js')}}"></script>
                            <script>
                    jQuery(document).ready(function () {
                        jQuery(".ot-slider").owlCarousel({
                            items: 1,
                            autoplay: true,
                            nav: true,
                            lazyload: false,
                            responsive: true,
                            dots: true,
                            margin: 15
                        });

                        jQuery(".big-pic-random .slider-items").owlCarousel({
                            items: 1,
                            autoplay: false,
                            nav: true,
                            lazyload: false,
                            dots: false,
                            margin: 15
                        });

                        jQuery(".related-articles-inherit").owlCarousel({
                            items: 4,
                            autoplay: false,
                            nav: true,
                            lazyload: false,
                            dots: true,
                            margin: 15,
                            responsive: {
                                0: {
                                    items: 1,
                                    nav: true
                                },
                                400: {
                                    items: 2,
                                    nav: false
                                },
                                700: {
                                    items: 4,
                                    nav: true,
                                    loop: false
                                }
                            }
                        });
                    });
                            </script>
                            <script>

                                jQuery(document).ready(function () {

                                    jQuery("#searchbox").hide();



                                    jQuery("#search").click(function () {

                                        jQuery("#searchbox").toggle();

                                    });



                                });

                            </script>
                            <script>
                                jQuery(document).ready(function () {
                                    jQuery("#skip").click(function () {

                                        jQuery("#bannerdiv").css('display', 'none');

                                    });
                                });
                            </script>	
                            <!-- Demo Only -->
                            <!--<script type="text/javascript" src="jscript/demo-settings.js"></script>-->

                            <!-- END body -->
                            <script src="/js/app.js"></script>
                            </body>
                            </html>         