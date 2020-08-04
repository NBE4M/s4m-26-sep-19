
 @if(Request::url() == 'http://www.exchange4media.com/' || Request::url() == 'http://www.exchange4media.com' || Request::url() == 'www.exchange4media.com')
    
 @elseif (\Request::is('spotlight/*'))
 

 @elseif (\Request::is('Spotlight_80.html'))


 @else
	

 @endif
		 

<header class="header">
        <div class="wrapper">
		
  <div style="position:relative; display:block;"> 
    <p class="topst"><a href="/all-feature-articles.html" style="color:#fff !important;">Top 
      Story</a> </p>
  </div>
            <div class="header-flex" style="text-align:center;">
            <div class="header-flex-box latest-news-top" style="padding: 1px 0 !important;">
                    <div class="items-wrapper w98">
                        @forelse(json_decode($ArrRecentImportaintNewsHeaderList) as  $ArrRecentImportaintNewsHeaderList)
                            <a href="@if ($ArrRecentImportaintNewsHeaderList->url !=''){{$ArrRecentImportaintNewsHeaderList->url}}@else /{!! Helper::rscUrl($ArrRecentImportaintNewsHeaderList->name)!!}/{!! Helper::rscUrl($ArrRecentImportaintNewsHeaderList->title) !!}_{{ $ArrRecentImportaintNewsHeaderList->article_id }}.html @endif" class="item">
                                <img src="{{Config::get('constants.AwsBaseurl')}}{{Config::get('constants.ARTICLE_IMAGE_THUMB_DIR')}}{{ $ArrRecentImportaintNewsHeaderList->photopath }}" alt="{{$ArrRecentImportaintNewsHeaderList->title}}" title="{{$ArrRecentImportaintNewsHeaderList->title}}"/>
                                <strong>{{$ArrRecentImportaintNewsHeaderList->title}}</strong>
                            </a>


                             <!--<a href=" {{action('Article\ArticleController@Article_landing_page', ['section' => 'test','title' =>'test articlfdf','id' => '3']) }}" class="item">
                                <img src="{{Config::get('constants.AwsBaseurl')}}{{Config::get('constants.ARTICLE_IMAGE_THUMB_DIR')}}{{ $ArrRecentImportaintNewsHeaderList->photopath }}" alt="{{$ArrRecentImportaintNewsHeaderList->title}}" />
                                <strong>{{$ArrRecentImportaintNewsHeaderList->title}}</strong>
                            </a>-->


                                
                         @empty
                            <a href="" class="item">
                                
                               
                            </a>
                         @endforelse
                        
                    </div>
                </div>
            </div>
            <div class="header-flex">
                <div class="header-flex-box">
                    <!-- <h1><a href="index.html"></a></h1> -->
                    <a href="/"><img src="http://www.exchange4media.com/images/e4m_logo.png" alt="e4m_logo.png" title="Indian Advertising Media & Marketing News &ndash; Exchange4media"/></a><!---->
                </div>
                <div class="header-flex-box banner" >
               
                
                @if(Request::url() == 'http://www.exchange4media.com' || Request::url() == 'http://www.exchange4media.com/home.html' || Request::url() == 'http://www.exchange4media.com/index.php' ||Request::url() == 'www.exchange4media.com')
					
                <p style="width:100%; margin:0; padding:0; font-size:8px; text-align:right;">Advertisement</p>
		<!-- Home Page Mast Head  -->
            <!-- Javascript tag  -->
<!-- begin ZEDO for channel:  Home , publisher: exchange4media , Ad Dimension: HP-MASTER-728*90 - 728 x 90 -->
<script language="JavaScript">
var zflag_nid="3702"; var zflag_cid="4"; var zflag_sid="2"; var zflag_width="728"; var zflag_height="90"; var zflag_sz="33"; 
</script>
<script language="JavaScript" src="http://xp2.zedo.com/jsc/xp2/fo.js"></script>
<!-- end ZEDO for channel:  Home , publisher: exchange4media , Ad Dimension: HP-MASTER-728*90 - 728 x 90 -->

    
                <!-- Javascript tag   -->
<!-- begin ZEDO for channel:  Home , publisher: exchange4media , Ad Dimension: HP-MASTER-728*90 - 728 x 90 -->

<!-- end ZEDO for channel:  Home , publisher: exchange4media , Ad Dimension: HP-MASTER-728*90 - 728 x 90 -->


 
 @elseif(Request::url() != 'http://www.exchange4media.com' || Request::url() != 'http://www.exchange4media.com/home.html' || Request::url() != 'http://www.exchange4media.com/index.php' ||Request::url() != 'www.exchange4media.com')
   <p style="width:100%; margin:0; padding:0; font-size:8px; text-align:right;">Advertisement</p>
<!-- Story Page Mast Head  -->
  <!-- Javascript tag  -->
<!-- begin ZEDO for channel:  ROS , publisher: exchange4media , Ad Dimension: HP-MASTER-728*90 - 728 x 90 -->
<!--<script language="JavaScript">
var zflag_nid="3702"; var zflag_cid="2"; var zflag_sid="2"; var zflag_width="728"; var zflag_height="90"; var zflag_sz="33"; 
</script>
<script language="JavaScript" src="http://xp2.zedo.com/jsc/xp2/fo.js"></script>-->
<!-- end ZEDO for channel:  ROS , publisher: exchange4media , Ad Dimension: HP-MASTER-728*90 - 728 x 90 -->


               @elseif(
        Request::url() == 'http://www.exchange4media.com/advertising_1.html' 
        OR Request::url() == 'http://www.exchange4media.com/marketing_3.html'  
        OR Request::url() == 'http://www.exchange4media.com/media-tv_6.html' 
        OR Request::url() == 'http://www.exchange4media.com/digital_4.html'
        OR Request::url() == 'http://www.exchange4media.com/out-of-home_26.html'
        OR Request::url() == 'http://www.exchange4media.com/media-radio_7.html'
        OR Request::url() == 'http://www.exchange4media.com/media-print_5.html'
        OR Request::url() == 'http://www.exchange4media.com/all-video.html'
        OR Request::url() == 'http://www.exchange4media.com/chillout_81.html'
        OR Request::url() == 'http://www.exchange4media.com/askthedoctor.html')
           
  <p style="width:100%; margin:0; padding:0; font-size:8px; text-align:right;">Advertisement</p>
<!-- Story Page Mast Head  -->
  <!-- Javascript tag  -->
<!-- begin ZEDO for channel:  ROS , publisher: exchange4media , Ad Dimension: HP-MASTER-728*90 - 728 x 90 -->
<script language="JavaScript">
var zflag_nid="3702"; var zflag_cid="2"; var zflag_sid="2"; var zflag_width="728"; var zflag_height="90"; var zflag_sz="33"; 
</script>
<script language="JavaScript" src="http://xp2.zedo.com/jsc/xp2/fo.js"></script>
<!-- end ZEDO for channel:  ROS , publisher: exchange4media , Ad Dimension: HP-MASTER-728*90 - 728 x 90 -->



                @endif
            </div>
            </div>
            <!-- <nav id="main-menu"> -->
            <nav id="main-menu" class="willfix main-menu-dark">
            <!-- BEGIN .wrapper -->
                <div class="wrapper">
                    <div class="right">
                        <div class="menu-icon">
                            <a href="#" style="color:#ce0000 !important;" id="search"><i class="fa fa-search"></i></a>
                            <script src='//www.google.com/jsapi' type='text/javascript'></script>




                            <div class="content content-search" id="searchbox">
                                <gcse:search></gcse:search>
                            </div>
                            
                             

                        </div>
                    </div>
                    <ul class="load-responsive" rel="Main Menu">
                        <!--<li class="ot-showmenu"><a href="#">Menu<span class="cmn-toggle-switch cmn-toggle-switch__htx active"><span>toggle menu</span></span></a></li>-->
                        <li><a href="/" style="border-bottom: 2px solid #45b29d;"><span>Home</span></a>

                        </li>
                        <li><a href="/advertising_1.html" style="border-bottom: 2px solid #efc94c;"><span>Advertising</span></a>

                        </li>
                        <li><a href="/marketing_3.html" style="border-bottom: 2px solid #589fc8;">Marketing</a></li>
                        <li><a href="#"><span>Media<span class="m-d-arrow"></span></span></a>
                            <ul>
                                <li><a href="/media-tv_6.html">Television</a></li>
                                <li><a href="/digital_4.html">Digital</a></li>
                                <li><a href="/out-of-home_26.html">Out of Home</a></li>
                                <li><a href="/media-radio_7.html">Radio</a></li>
                                <li><a href="/media-print_5.html">Print</a></li>
                            </ul>
                        </li>
                        <li><a href="/all-video.html" style="border-bottom: 2px solid #e27a3f;"><span>Video</span></a></li>
                      
                        <li><a href="#"><span>Events<span class="m-d-arrow"></span></span></a>
                           <ul>
                               <!--<li><a href="http://www.exchange4media.com/events/content-marketing-awards-icma-2017/index.aspx">ICMA 2017</a></li>
                               <li><a href="http://www.exchange4media.com/events/pitch-top-50-brands-2017/">PITCH TOP 50 BRANDS</a></li>
                               <li><a href="http://www.exchange4media.com/events/idma-2017/index.aspx">IDMA 2017</a></li>
                               <li><a href="http://www.exchange4media.com/events/golden-mikes-2017/">Golden Mikes 2017</a></li>
                               <li><a href="http://www.exchange4media.com/events/ooh-awards-2017/index.aspx">OOH 2017</a></li>-->
							   
							   
							<li><a href="http://www.exchange4media.com/eventcalender2017.html" target="_blank">EVENTS CALENDAR 2016-2017</a></li>
                            <li class="dropdown-header">UPCOMING EVENTS</li>
							<li><a href="http://events.exchange4media.com/ipoy/2017/" target="_blank">IPOY 2017</a></li>
							<li><a href="http://events.exchange4media.com/conclave-south-2017/" target="_blank">Conclave South 2017</a></li>
							<li><a href="http://events.exchange4media.com/events/conclave2017" target="_blank">Conclave Mumbai 2017</a></li>
							<li><a href="http://iprcca2017.exchange4media.com/" target="_blank">IPRCCA 2017</a></li>
							<li><a href="http://events.exchange4media.com/events/ima-2017/" target="_blank">IMA 2017</a></li>
							<li><a href="http://events.exchange4media.com/magzimise-awards-2017/index.aspx" target="_blank">Magzimise Awards 2017</a></li>
							
							
                										                          
                            
							
							
                           
                            
                            <li class="divider"></li>
                            <li class="dropdown-header">PAST EVENTS</li>
							
                             <li><a href="http://events.exchange4media.com/events/the-maddies-awards-2017/" target="_blank">e4m Mobile Awards - The Maddies 2017</a></li>
							<li><a href="http://events.exchange4media.com/events/media-ace-awards-2017/" target="_blank">Media Ace Awards 2017</a></li>
							 <li><a href="http://events.exchange4media.com/events/content-marketing-awards-icma-2017/index.aspx" target="_blank">ICMA 2017</a></li>
							<li><a href="http://events.exchange4media.com/events/pitch-top-50-brands-2017/" target="_blank">PITCH TOP 50 BRANDS</a></li>
							<li><a href="http://events.exchange4media.com/events/idma-2017/index.aspx" target="_blank">IDMA 2017</a></li>
							 <li><a href="http://events.exchange4media.com/events/golden-mikes-2017/" target="_blank">Golden Mikes 2017</a></li>
							<li><a href="http://events.exchange4media.com/events/ooh-awards-2017/index.aspx" target="_blank">OOH 2017</a></li>
							<li><a href="http://events.exchange4media.com/events/cmo-summit-2017/" target="_blank">CMO Summit 2017</a></li>
							 <li><a href="http://events.exchange4media.com/events/denstu-ageis-network-e4m-digital-report-2017" target="_blank">DAN e4m Digital Report</a></li>
							 <li><a href="http://events.exchange4media.com/enba-2016/" target="_blank">enba 2016</a></li>
							<li><a href="http://events.exchange4media.com/events/pitch-madison-advertising-report-2017/" target="_blank">PMAR 2017</a></li>
							<li><a href="http://events.exchange4media.com/primetimeawards/2016/index.aspx" target="_blank">Prime Time Awards 2016</a></li>
                            <li><a href="http://events.exchange4media.com/ipoy/2016/" target="_blank">IPOY 2016</a></li>
                            <li><a href="http://events.exchange4media.com/events/iprcca-2016/index.aspx" target="_blank">IPRCCA 2016</a></li>
                            <li><a href="http://events.exchange4media.com/events/ima-2016/" target="_blank">Indian Marketing Awards 2016</a></li>
                            <li><a href="http://events.exchange4media.com/conclave2016/mumbai/index.html" target="_blank">Conclave 2016</a></li>
                            <li><a href="http://events.exchange4media.com/magzimise-awards-2016/index.html" target="_blank">MAGZIMISE AWARDS 2016</a></li>
                            <li><a href="http://events.exchange4media.com/events/the-maddies-awards-2016/" target="_blank">Maddies Awards 2016 </a></li>
							<li><a href="http://events.exchange4media.com/impacttop50women/2017/" target="_blank">IMPACT TOP 50 WOMEN</a></li>
                            
                            <li><a href="http://www.exchange4media.com/allevents.html" target="_blank">More...</a></li>
                           </ul>
                       </li>
                        <li class="has-ot-mega-menu"><a href="" ><span>Snapshots<span class="m-d-arrow"></span></span></a>
                            <ul class="ot-mega-menu">
                                <li>
                                    <div class="menu-widgets">

                                        <!-- BEGIN .widget -->
                                        <div class="widget">
                                            <div class="title-block">
                                                <h6>Latest News</h6>
                                            </div>
                                            <div class="article-block without-images">
                                               @forelse(json_decode($ArrMenuSLatestNews) as  $ArrMenuSLatestNews) 
                                                <div class="item">
                                                    <div class="item-content">
                                                        <div class="clear-float"></div>
                                                        <h6><a href="@if ($ArrMenuSLatestNews->url !=''){{$ArrMenuSLatestNews->url}}@else /{!! Helper::rscUrl($ArrMenuSLatestNews->name)!!}/{!! Helper::rscUrl($ArrMenuSLatestNews->title) !!}_{{ $ArrMenuSLatestNews->article_id }}@endif">{{ $ArrMenuSLatestNews->title }}</a></h6>
                                                        <p>{{Str::limit($ArrMenuSLatestNews->summary, $limit = 100, $end = '...')}}</p>
                                                    </div>
                                                </div>
                                                @empty
                                                <div class="item">
                                                    <div class="item-content">
                                                        <div class="clear-float"></div>
                                                     </div>
                                                </div>    
                                                @endforelse  
                                               
                                            </div>
                                        <!-- END .widget -->
                                        </div>
                                        <div class="widget">
                                            <div class="title-block">
                                                <h6>Latest Video</h6>
                                            </div>
                                             
                                            <div class="ot-about-widget">
                                                @forelse(json_decode($ArrMenuSLatestVideo) as  $ArrMenuSLatestVideo)
                                                   <p><a href="/video/{!! Helper::rscUrl($ArrMenuSLatestVideo->video_title)!!}-{{ $ArrMenuSLatestVideo->id }}.html">
                                                        <img src="{{Config::get('constants.AwsBaseurl')}}{{Config::get('constants.VIDEO_THUMB_DIR')}}{{$ArrMenuSLatestVideo->video_thumb_name}}"/>
                                                    </a>
                                                </p>
                                                @empty
                                                   <p>
                                                </p>
                                                @endforelse  
                                                
                                            </div>
                                        </div>
                                        <div class="widget">
                                            <div class="title-block">
                                                <h6>Tag Cloud</h6>
                                            </div>
                                            <div class="tagcloud">
                                                @forelse(json_decode($ArrMenuSTag) as  $ArrMenuSTag)
                                                    <a href="/tags/{!! Helper::rscUrl($ArrMenuSTag->tag)!!}_{{ $ArrMenuSTag->tags_id }}.html">{{$ArrMenuSTag->tag}}</a>
                                                @empty
                                                    <a href=""></a>
                                                @endforelse  
                                                
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li><a href="/Spotlight_80.html" style="border-bottom: 2px solid #e27a3f;"><span>Spotlight</span></a></li>
                        <li><a href="/chillout_81.html" style="border-bottom: 2px solid #e27a3f;"><span>Chill Out</span></a></li>
                        <!--<li><a href="/Ask-The-Doctor_98.html" style="border-bottom: 2px solid #e27a3f;"><span>Ask the Doctor</span></a></li>-->
						<li><a href="http://exchange4media.com/ask-the-doctor/ask-the-doctor-with-sandeep-goyal-_86810.html" style="border-bottom: 2px solid #e27a3f;"><span>Ask the Doctor</span></a></li>
						 <li><a href="#"><span>Other<span class="m-d-arrow"></span></span></a>
                            <ul>
                                <li><a href="/all-interviews.html">Interviews</a></li>
                                <li><a href="/videos/creative-chowcase.html">Creative Showcase</a></li>
                                <li><a href="/all-interviews.html">Interviews</a></li>
                                <li><a href="/videos/creative-chowcase.html">Creative Showcase</a></li>
                                <li><a href="/guest-author.html">Guest Author</a></li>
                                <li><a href="/industry-briefing_35.html">Industry Briefing</a></li>
                                <li><a href="/all-pthotos.html">Photo Gallery</a></li>
                            </ul>
                        </li>
                        <!--<li><a href="/subscribenewsletter.html"  target="_blank" style="background:#F1BA2B;color:#000000; border-bottom: 2px solid #F1BA2B;"><span>Newsletter</span></a></li>-->
                    </ul>
                <!-- END .wrapper -->
                </div>
            </nav>
        <!-- END .wrapper -->
        </div>
    <!-- END .header -->
@if(isset($url) && !empty($url))
   <link rel="amphtml" href="{{$url}}" />
 @endif
    </header>
         

           