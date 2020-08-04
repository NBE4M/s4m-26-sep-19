
<!-- BEGIN .footer -->
<footer class="footer">

    <!-- BEGIN .wrapper -->
    <div class="wrapper">

        <div class="footer-menu">
            <a href="#top" class="right">Back to top <i class="fa fa-chevron-up"></i></a>


            <a target="_blank" href="#" class="right" style="border-right: 1px solid #ccc; line-height: 98%; padding-bottom: 12.9px !important;"> <i class="fa fa-rss" style=" font-size: 18px; padding-left: 0px;"></i></a>

            <a  target="_blank" href="https://www.facebook.com/exchange4media" class="right" style="border-right: 1px solid #ccc; line-height: 98%; padding-bottom: 12.9px !important;"> <i class="fa fa-facebook" style=" font-size: 18px; padding-left: 0px;"></i></a>

            <a target="_blank" href="https://twitter.com/e4mtweets" class="right" style="border-right: 1px solid #ccc; line-height: 98%; padding-bottom: 12.9px !important;"> <i class="fa fa-twitter" style=" font-size: 18px; padding-left: 0px;"></i></a>

            <a target="_blank"  href="http://www.linkedin.com/groups/exchange4media-Official-3987161?home=&gid=3987161&trk=anet_ug_hm" class="right" style="border-right: 1px solid #ccc; border-left: 1px solid #ccc; line-height: 98%; padding-bottom: 12.9px !important;"> <i class="fa fa-linkedin" style=" font-size: 18px; padding-left: 0px;"></i></a>





            <ul>
                <li><a href="/advertising_1.html" style="border-bottom: 2px solid #43b3bd;">Advertising</a></li>
                <li><a href="/marketing_3.html" style="border-bottom: 2px solid #9e005d;">Marketing</a></li>
                <li><a href="/media.html" style="border-bottom: 2px solid #575cc0;">Media</a></li>
                <li><a href="/all-video.html" style="border-bottom: 2px solid #007236;">Video</a></li>
                <li><a href="#" style="border-bottom: 2px solid #aba000;">Events</a></li>
            </ul>
        </div>

        <!-- BEGIN .footer-widgets -->
        <div class="footer-widgets">

            <div class="footer-widget-wrapper">

                <!-- BEGIN .footer-widget-left -->
                <div class="footer-widget-left">

                    <div class="widget">
                        <div class="title-block">
                            <h6>ABOUT e4m</h6>
                        </div>
                        <div class="ot-about-widget">
                            <p>exchange4media was set up in year 2000 with the aim of publishing niche, relevant and quality publications for the marketing, advertising and media professionals.</p>

                            <ul class="list-group">
                                <li><i class="fa fa-location-arrow fa-fw"></i>ADSERT WEB SOLUTIONS PVT. LTD. B-20, SECTOR 57 NOIDA (U.P)</li>
                                <li><i class="fa fa-phone fa-fw"></i>(0120) 4007700</li>
                                <li><i class="fa fa-envelope fa-fw"></i>deep@exchange4media.com</li>
                            </ul>
                            <br/>
                            <br/>

                        </div>
                    </div>

                    <!-- END .footer-widget-left -->
                </div>

                <!-- BEGIN .footer-widget-middle -->
                <div class="footer-widget-middle">

                    <!-- BEGIN .widget -->
                    <div class="widget">
                        <div class="title-block">
                            <h6>Latest News</h6>
                        </div>
                        <div class="article-block">

                            @forelse(json_decode($ArrRecentNewsFooter) as  $ArrRecentNewsFooter)
                            <div class="item">
                                <div class="item-header">
                                    <a href="@if ($ArrRecentNewsFooter->url !=''){{$ArrRecentNewsFooter->url}}@else /{!! Helper::rscUrl($ArrRecentNewsFooter->name)!!}/{!! Helper::rscUrl($ArrRecentNewsFooter->title) !!}_{{ $ArrRecentNewsFooter->article_id }}.html @endif" class="image-hover"><img src="{{Config::get('constants.AwsBaseurl')}}{{Config::get('constants.ARTICLE_IMAGE_THUMB_DIR')}}{{ $ArrRecentNewsFooter->photopath }}" alt="{{ $ArrRecentNewsFooter->title }}" /></a>

                                </div>
                                <div class="item-content">
                                    <span class="article-meta">

                                        <a href="/article/{{$ArrRecentNewsFooter->publish_date}}.html" class="meta-date"><i class="fa fa-clock-o">{{(new DateTime($ArrRecentNewsFooter->publish_date))->format('d-F-Y')}}</i></a>

                                    </span>
                                    <h6><a href="@if ($ArrRecentNewsFooter->url !=''){{$ArrRecentNewsFooter->url}}@else /{!! Helper::rscUrl($ArrRecentNewsFooter->name)!!}/{!! Helper::rscUrl($ArrRecentNewsFooter->title) !!}_{{ $ArrRecentNewsFooter->article_id }}.html @endif">{{ $ArrRecentNewsFooter->title }}</a></h6>

                                </div>
                            </div>
                            @empty
                            <div class="item">
                                <div class="item-header">
                                </div>
                                <div class="item-content">
                                </div>
                            </div>
                            @endforelse 

                            <a href="/all-articles.html" class="item-button">Load more ...</a>
                        </div>
                        <!-- END .widget -->
                    </div>

                    <!-- END .footer-widget-middle -->
                </div>

                <!-- BEGIN .footer-widget-right -->
                <div class="footer-widget-right">

                    <!-- BEGIN .widget -->
                    <div class="widget">
                        <div class="title-block">
                            <h6>Industry Briefing</h6>
                        </div>
                        <div class="article-block without-images">
                            @forelse(json_decode($ArrRecentFooterPanelCategoryAricles) as  $ArrRecentFooterPanelCategoryAricles)

                            <div class="item">
                                <div class="item-content">	
                                    <span class="article-meta left">
                                        <a href="/article/{{$ArrRecentFooterPanelCategoryAricles->publish_date}}.html" class="meta-date"><i class="fa fa-clock-o"></i>{{(new DateTime($ArrRecentFooterPanelCategoryAricles->publish_date))->format('d-F-Y')}}</a>
                                    </span>
                                    <div class="clear-float"></div>
                                    <h6><a href="@if ($ArrRecentFooterPanelCategoryAricles->url !=''){{$ArrRecentFooterPanelCategoryAricles->url}}@else /{!! Helper::rscUrl($ArrRecentFooterPanelCategoryAricles->name)!!}/{!! Helper::rscUrl($ArrRecentFooterPanelCategoryAricles->title) !!}_{{ $ArrRecentFooterPanelCategoryAricles->article_id }}.html @endif">{{ $ArrRecentFooterPanelCategoryAricles->title }}</a></h6>
                                    <p>{{Str::limit($ArrRecentFooterPanelCategoryAricles->summary, $limit = 100, $end = '...')}}</p>
                                </div>
                            </div>
                            @empty
                            <div class="item">
                                <div class="item-content">
                                </div>
                            </div>
                            @endforelse 
                        </div>
                        <!-- END .widget -->
                    </div>


                    <!-- END .footer-widget-right -->
                </div>

                <!-- BEGIN .footer-widget-right -->
                <div class="footer-widget-right">

                    <div class="widget">
                        <div class="title-block">
                            <h6>Company Directory</h6>
                        </div>
                        <div class="w-category-block">
                            <ul>
                                @forelse(json_decode($ArrRecentCompanyTopicsList) as  $ArrRecentCompanyTopicsList)
                                <li><a href="/topic/{!! Helper::rscUrl($ArrRecentCompanyTopicsList->topic)!!}_{{$ArrRecentCompanyTopicsList->id}}.html">{{$ArrRecentCompanyTopicsList->topic}}</a></li>
                                @empty   
                                <li><a href="#"></a></li>
                                @endforelse 

                            </ul>
                        </div>
                    </div>

                    <div class="widget">
                        <div class="title-block">
                            <h6>People Directory</h6>
                        </div>
                        <div class="w-category-block">
                            <ul>
                                @forelse(json_decode($ArrRecentPeopleTopicsList) as  $ArrRecentPeopleTopicsList)
                                <li><a href="/topic/{!! Helper::rscUrl($ArrRecentPeopleTopicsList->topic)!!}_{{$ArrRecentPeopleTopicsList->id}}.html">{{$ArrRecentPeopleTopicsList->topic}}</a></li>
                                @empty   
                                <li><a href="#"></a></li>
                                @endforelse 
                            </ul>
                        </div>
                    </div>

                    <!-- END .footer-widget-right -->
                </div>

            </div>

            <!-- END .footer-widgets -->
        </div>

        <!-- END .wrapper -->
    </div>

    <!-- BEGIN .footer-copy -->
    <div class="footer-copy">

        <!-- BEGIN .wrapper -->
        <div class="wrapper">

            <ul>
                <li><a href="/sitemap.html">Site map</a></li>
                <li><a href="/contact-us.html">Contact</a></li>
                <li><a href="/subscribenewsletter.html">Newsletter sign up</a></li>

                <li><a href="/contact-us.html">Advertise With Us</a></li>
            </ul>

            <p>THE MATERIAL ON THIS SITE MAY NOT BE REPRODUCED, DISTRIBUTED, TRANSMITTED, CACHED OR OTHERWISE USED,<br>EXCEPT WITH THE PRIOR WRITTEN PERMISSION OF  DIGITAL.</p>

            <!-- END .wrapper -->
        </div>

        <!-- END .footer-copy -->
    </div>

    <!-- END .footer -->
</footer>

<div  class ="loadmor">
    <div  style=" display:block; width:100%;  position:fixed; bottom:0; left:0; text-align:center; z-index:9999999;">

        @if(Request::url() == 'http://front.news.exchange4media.com/Spotlight_80.html')



        <!-- Javascript tag  -->
        <!-- begin ZEDO for channel:  Spotlight_80 , publisher: exchange4media , Ad Dimension: Stay On - 1 x 1 -->
        <script language="JavaScript">
            var zflag_nid = "3702";
            var zflag_cid = "8";
            var zflag_sid = "2";
            var zflag_width = "1";
            var zflag_height = "1";
            var zflag_sz = "21";
        </script>
        <script language="JavaScript" src="http://xp2.zedo.com/jsc/xp2/fo.js"></script>
        <!-- end ZEDO for channel:  Spotlight_80 , publisher: exchange4media , Ad Dimension: Stay On - 1 x 1 -->

        @elseif(\Request::is('spotlight/*'))

        <!-- Javascript tag  -->
        <!-- begin ZEDO for channel:  spotlight , publisher: exchange4media , Ad Dimension: Stay On - 1 x 1 -->
        <script language="JavaScript">
            var zflag_nid = "3702";
            var zflag_cid = "7";
            var zflag_sid = "2";
            var zflag_width = "1";
            var zflag_height = "1";
            var zflag_sz = "21";
        </script>
        <script language="JavaScript" src="http://xp2.zedo.com/jsc/xp2/fo.js"></script>
        <!-- end ZEDO for channel:  spotlight , publisher: exchange4media , Ad Dimension: Stay On - 1 x 1 -->

        @elseif(Request::url() != 'http://front.news.exchange4media.com' 
        AND Request::url() != 'http://front.news.exchange4media.com/advertising_1.html' 
        AND Request::url() != 'http://front.news.exchange4media.com/marketing_3.html'  
        AND Request::url() != 'http://front.news.exchange4media.com/media-tv_6.html' 
        AND Request::url() != 'http://front.news.exchange4media.com/digital_4.html'
        AND Request::url() != 'http://front.news.exchange4media.com/out-of-home_26.html'
        AND Request::url() != 'http://front.news.exchange4media.com/media-radio_7.html'
        AND Request::url() != 'http://front.news.exchange4media.com/media-print_5.html'
        AND Request::url() != 'http://front.news.exchange4media.com/all-video.html'
        AND Request::url() != 'http://front.news.exchange4media.com/chillout_81.html'
        AND Request::url() != 'http://front.news.exchange4media.com/askthedoctor.html')
        <!-- this is for only story page-->


        <!-- Javascript tag  -->
        <!-- begin ZEDO for channel:  ROS , publisher: exchange4media , Ad Dimension: Story Page Stay on 970 * 90 - 970 x 90 -->
        <script language="JavaScript">
            var zflag_nid = "3702";
            var zflag_cid = "2";
            var zflag_sid = "2";
            var zflag_width = "970";
            var zflag_height = "90";
            var zflag_sz = "86";
        </script>
        <script language="JavaScript" src="http://xp2.zedo.com/jsc/xp2/fo.js"></script>
        <!-- end ZEDO for channel:  ROS , publisher: exchange4media , Ad Dimension: Story Page Stay on 970 * 90 - 970 x 90 -->




        @elseif(Request::url() == 'http://front.news.exchange4media.com')



        <!-- Javascript tag  -->
        <!-- begin ZEDO for channel:  Home , publisher: exchange4media , Ad Dimension: Stay On Home Page 970 * 90 - 970 x 90 -->
        <script language="JavaScript">
            var zflag_nid = "3702";
            var zflag_cid = "4";
            var zflag_sid = "2";
            var zflag_width = "970";
            var zflag_height = "90";
            var zflag_sz = "87";
        </script>
        <script language="JavaScript" src="http://xp2.zedo.com/jsc/xp2/fo.js"></script>
        <!-- end ZEDO for channel:  Home , publisher: exchange4media , Ad Dimension: Stay On Home Page 970 * 90 - 970 x 90 -->





        @endif


    </div>
</div>	
<!-- END .boxed -->

<!-- END .boxed -->
</div>
<!-- Javascript tag: -->
<!-- begin ZEDO for channel: Run of Network , publisher: default , Ad Dimension: Site Blocker - 1 x 1 -->
<script language="JavaScript">
            var zflag_nid = "3702"; var zflag_cid = "0";
            var zflag_sid = "0";
            var zflag_width = "1";
            var zflag_height = "1";
            var zflag_sz = "18";
</script>
<script language="JavaScript" src="http://xp2.zedo.com/jsc/xp2/fo.js"></script>
<!-- end ZEDO for channel: Run of Network , publisher: default , Ad Dimension: Site Blocker - 1 x 1 -->
<!--<div id="bannerdiv" style=" display:block;width:100%; height:100%; background:rgba(0,0,0,0.7); position:fixed; top:0; left:0; text-align:center; z-index:9999999;">
    <div style="width:400px; height:auto; margin-top:15%; margin-left:40%; background:#fff;">
        <h6 style="width:100%; margin:0; padding:0; background:#ADADAD; height:20px;"><p id="skip" style="float:right; cursor:pointer;">Skip this... </p></h6>
        <a href="#" target="_blank"><img src="http://www.bwnlimg.com/images/wp-content/uploads/2017/02/e4mDphotos/300x250-starad2.jpg" alt="" style="width:400px;"/></a>
    </div>    
                        
</div>-->
<!-- Scripts -->



