 <div>
   @yield('sidebar')
   <div class="nav-fixed-left" style="visibility: hidden">
    <ul class="nav nav-side-menu">
        <li class="shadow-layer"></li>
        <li>
            <a href="{!! url('cms/dashboard'); !!}" >
                <i class="icon-photon home"></i>
                <span class="nav-selection">Dashboard</span>
            </a>
        </li>

        @if(count(array_diff(array('2','8','11','15','16','17','13','12','19','30','32','33','77'), Session::get('user_rights'))) != count(array('2','8','11','15','16','17','13','12','19','30','32','33','77')))
        <li>
            <a href="javascript:;" class="sub-nav-container">
                <i class="icon-photon document_alt_stroke"></i>
                <span class="nav-selection">Articles</span>
                <i class="icon-menu-arrow"></i>                </a>
                <div class="sub-nav">
                    <ul class="nav">
                        @if(in_array('11',Session::get('user_rights')))
                        <li>
                            <a href="{!! url('breaking/article'); !!}">Breaking Articles</a>
                        </li>
                        @endif
                        @if(in_array('2',Session::get('user_rights')))
                        <li>
                            <a href="{!! url('/article/create'); !!}">Create New Articles</a>
                        </li>
                        @endif
                        @if(in_array('11',Session::get('user_rights')))
                        <li>
                            <a href="{!! url('/article/list/new'); !!}">New Articles</a>
                        </li>
                        @endif
                        @if(in_array('15',Session::get('user_rights')))
                        <li>
                            <a href="{!! url('/article/list/scheduled'); !!}">Scheduled Articles</a>
                        </li>
                        @endif
                        @if(in_array('16',Session::get('user_rights')))
                        <li>
                            <a href="{!! url('/article/list/published'); !!}">Published Article</a>
                        </li>
                        @endif
                        @if(in_array('16',Session::get('user_rights')))
                        <li>
                            <a href="{!! url('/article/list/missedarticles'); !!}">Missed Article</a>
                        </li>
                        @endif


                        @if(in_array('16',Session::get('user_rights')))
                        <li>
                            <a href="{!! url('/article/list/lockedarticles'); !!}">Locked Article</a>
                        </li>
                        @endif
                        <li>
                            <a href="{!! url('/article/list/drafts'); !!}">My Drafts</a>
                        </li>
                        @if(in_array('17',Session::get('user_rights')))
                        <li>
                            <a href="{!! url('/article/list/deleted'); !!}">Deleted Articles</a>
                        </li>
                        @endif
                        @if(in_array('17',Session::get('user_rights')))
                        <li>
                            <a href="{!! url('/article/list/priority'); !!}">Priority News</a>
                        </li>
                        <li>
                            <a href="{!! url('/article/list/custom'); !!}">Custom Section</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif
            @if(count(array_diff(array('20','21','34'), Session::get('user_rights'))) != count(array('20','21','34')))
            <li>
                <a href="javascript:;" class="sub-nav-container">
                    <i class="icon-photon comment_alt2_stroke"></i>
                    <span class="nav-selection">Tips &amp; Quotes</span>
                    <i class="icon-menu-arrow"></i>                </a>
                    <div class="sub-nav">
                        <ul class="nav">
                            @if(in_array('20',Session::get('user_rights')))
                            <li>
                                <a href="{!! url('/tips'); !!}">Tips</a>
                            </li>
                            @endif
                            @if(in_array('21',Session::get('user_rights')))
                            <li>
                                <a href="{!! url('/tip-tags'); !!}">Tags</a>
                            </li>
                            @endif
                            @if(in_array('34',Session::get('user_rights')))
                            <li>
                                <a href="{!! url('/quotes'); !!}">Quotes</a>
                            </li>
                            @endif
                        }

<!--                        <li>
                            <a href="#">Reports</a>
                        </li>

                        <li>
                            <a href="#">Help</a>
                        </li>-->

                    </ul>
                </div>
            </li>
            @endif
            @if(count(array_diff(array('79','80','81'), Session::get('user_rights'))) != count(array('79','80','81')))
            <li>
                <a href="javascript:;" class="sub-nav-container">
                    <i class="icon-photon mic"></i>
                    <span class="nav-selection">Debate</span>
                    <i class="icon-menu-arrow"></i>                </a>
                    <div class="sub-nav">
                        <ul class="nav">
                            @if(in_array('79',Session::get('user_rights')))
                            <li>
                                <a href="{{url('/debate/published')}}">Published Debate</a>
                            </li>
                            @endif
                            @if(in_array('80',Session::get('user_rights')))
                            <li>
                                <a href="#">Deleted Debate</a>
                            </li>
                            @endif
                            @if(in_array('81',Session::get('user_rights')))
                            <li>
                                <a href="{{url('/debate/create')}}">Create New Debates</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif
                @if(count(array_diff(array('9','44','45'), Session::get('user_rights'))) != count(array('9','44','45')))
                <li>
                    <a href="javascript:;" class="sub-nav-container">
                        <i class="icon-photon pen"></i>
                        <span class="nav-selection">Authors Profile
                        </span>
                        <i class="icon-menu-arrow"></i> </a>
                        <div class="sub-nav">
                            <ul class="nav">
                               @if(in_array('44',Session::get('user_rights')))
                               <li>
                                <a href="{{url('/guestauthor/add-edit-gustauthor')}}">Add/Edit Guest Author</a>
                            </li>
                            @endif
                            @if(in_array('45',Session::get('user_rights')))
                            <li>
                                <a href="{{url('/bwreporters/add-edit-bw-reporters')}}">Add/Edit Reporters</a>
                            </li>
                            @endif
<!--                        <li>
                            <a href="#">Help</a>
                        </li>-->
                    </ul>
                </div>
            </li>
            @endif


            @if(count(array_diff(array('23','24','25'), Session::get('user_rights'))) != count(array('23','24','25')))
            <li>
                <a href="javascript:;" class="sub-nav-container">
                    <i class="icon-photon steering_wheel"></i>
                    <span class="nav-selection">Quick Bytes</span>
                    <i class="icon-menu-arrow"></i>                </a>
                    <div class="sub-nav">
                        <ul class="nav">
                           @if(in_array('23',Session::get('user_rights')))
                           <li>
                            <a href="{{url('/quickbyte/create')}}">Create New Quick Byte</a>
                        </li>
                        @endif
                        @if(in_array('24',Session::get('user_rights')))
                        <li>
                            <a href="{{url('/quickbyte/list/published')}}">Published Quick Bytes</a>
                        </li>
                        @endif
                        @if(in_array('25',Session::get('user_rights')))
                        <li>
                            <a href="{{url('/quickbyte/list/deleted')}}">Deleted Quick Bytes</a>
                        </li>
                        @endif
<!--                         <li>
                             <a href="#">Reports</a>
                         </li>
                         <li>
                             <a href="#">Help</a>
                         </li>-->
                     </ul>
                 </div>
             </li>
             @endif
             @if(count(array_diff(array('27','28','29'), Session::get('user_rights'))) != count(array('27','28','29')))
             <li>
                <a href="javascript:;" class="sub-nav-container">
                    <i class="icon-photon document_stroke"></i>
                    <span class="nav-selection">Sponsored Post</span>
                    <i class="icon-menu-arrow"></i>     </a>
                    <div class="sub-nav">
                        <ul class="nav">
                            @if(in_array('27',Session::get('user_rights')))
                            <li>
                                <a href="{{url('/sposts/create')}}">Create New Sponsored Post</a>
                            </li>
                            @endif
                            @if(in_array('28',Session::get('user_rights')))
                            <li>
                                <a href="{{url('/sposts/list/published')}}">Published Sponsored Posts</a>
                            </li>
                            @endif
                            @if(in_array('29',Session::get('user_rights')))
                            <li>
                                <a href="{{url('/sposts/list/deleted')}}">Deleted Sponsored Posts</a>
                            </li>
                            @endif
<!--                        <li>
                            <a href="#">Reports</a>
                        </li>
                        <li>
                            <a href="#">Help</a>
                        </li>-->
                    </ul>
                </div>
            </li>
            @endif
            @if(count(array_diff(array('57','58','59'), Session::get('user_rights'))) != count(array('57','58','59')))
            <li>
                <a href="javascript:;" class="sub-nav-container">
                    <i class="icon-photon new_window"></i>
                    <span class="nav-selection">Photos</span>
                    <i class="icon-menu-arrow"></i>                </a>
                    <div class="sub-nav">
                        <ul class="nav">
                           @if(in_array('59',Session::get('user_rights')))
                           <li>
                            <a href="{{url('cms/album/create')}}">Upload New Album</a>
                        </li>
                        @endif
                        @if(in_array('57',Session::get('user_rights')))
                        <li>
                            <a href="{{url('album/list/published')}}">Published Album</a>
                        </li>
                        @endif
                        @if(in_array('58',Session::get('user_rights')))
                        <li>
                            <a href="{{url('album/list/deleted')}}">Deleted Photos</a>
                        </li>
                        @endif
<!--                         <li>
                            <a href="#">Reports</a>
                        </li>

                        <li>
                            <a href="#">Help</a>
                        </li>-->
                    </ul>
                </div>
            </li>
            @endif


            @if(count(array_diff(array('57','58','59'), Session::get('user_rights'))) != count(array('57','58','59')))
            <li>
                <a href="javascript:;" class="sub-nav-container">
                    <i class="icon-photon new_window"></i>
                    <span class="nav-selection">Videos</span>
                    <i class="icon-menu-arrow"></i>                </a>
                    <div class="sub-nav">
                        <ul class="nav">
                           @if(in_array('59',Session::get('user_rights')))
                           <li>
                            <a href="{{url('live/Data/all')}}">Upload New video</a>
                        </li>
                        <!-- <li>
                            <a href="{{url('/video/create')}}">Upload New Creative Showcase video</a>
                        </li> -->
                        @endif
                        @if(in_array('57',Session::get('user_rights')))
                        <!-- <li>
                            <a href="{{url('livedata1')}}">Published video</a>
                        </li>
                        <li>
                            <a href="{{url('/video/list')}}">Published Creative Showcase video</a>
                        </li> -->
                        @endif


                    </ul>
                </div>
            </li>
            <li>
                <a href="javascript:;" class="sub-nav-container">
                    <i class="icon-photon play"></i>
                    <span class="nav-selection">Polls</span>
                    <i class="icon-menu-arrow"></i>                </a>
                <div class="sub-nav">
                    <ul class="nav">
                        <li class="active"><a href="{{  url('admin/polls') }}"><i class="fa fa-file-poll"></i> <span>Polls</span></a>
                        </li>
                        <!-- <li class="active"><a href=""><i class="fa fa-file-poll"></i> <span>vote for Polls</span></a>
                        </li> -->
                        
                    </ul>
                </div>    
            </li>
            <li>
                <a href="javascript:;" class="sub-nav-container">
                    <i class="icon-photon play"></i>
                    <span class="nav-selection">Mail Config</span>
                    <i class="icon-menu-arrow"></i>                </a>
                <div class="sub-nav">
                    <ul class="nav">
                        <li class="active"><a href="{{  url('mail/config') }}"><i class="fa fa-file-poll"></i> <span>Mail Config</span></a>
                        </li>
                        <!-- <li class="active"><a href=""><i class="fa fa-file-poll"></i> <span>vote for Polls</span></a>
                        </li> -->
                        
                    </ul>
                </div>    
            </li>
            @endif

            @if(count(array_diff(array('68','69','70','75','85'), Session::get('user_rights'))) != count(array('68','69','70','75','85')))
            <li>
                <a href="javascript:;" class="sub-nav-container">
                    <i class="icon-photon cog"></i>
                    <span class="nav-selection">Site Management</span>
                    <i class="icon-menu-arrow"></i>                </a>
                    <div class="sub-nav">
                        <ul class="nav">
                            @if(in_array('75',Session::get('user_rights')))
                            <li>
                                <a href="{{url('cms/category/')}}">Category Master</a>
                            </li>
                            @endif
                            @if(in_array('75',Session::get('user_rights')))
                            <li>
                                <a href="{{url('cms/menu/')}}">Menu Master</a>
                            </li>
                            @endif
                            @if(in_array('75',Session::get('user_rights')))
                            <li>
                                <a href="{{url('cms/manageAds')}}">Banner Master</a>
                            </li>
                            @endif
                            @if(in_array('75',Session::get('user_rights')))
                            <!-- <li>
                                <a href="{{url('/mailer/')}}">Mailer Master</a>
                            </li> -->
                            @endif
                            @if(in_array('68',Session::get('user_rights')))
                            <!-- <li>
                                <a href="{{url('location-master.html')}}">Location Master</a>
                            </li> -->
                            @endif
                            @if(in_array('70',Session::get('user_rights')))
                            <!-- <li>
                                <a href="#">Tags Master</a>
                            </li> -->
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(count(array_diff(array('82','83','84','95'), Session::get('user_rights'))) != count(array('82','83','84','95')))
                <li>
                    <a href="javascript:;" class="sub-nav-container">
                        <i class="icon-photon mail"></i>
                        <span class="nav-selection">Newsletter</span>
                        <i class="icon-menu-arrow"></i>                </a>
                        <div class="sub-nav">
                            <ul class="nav">
                                @if(in_array('95',Session::get('user_rights')))
                                <li>
                                    <a href="{{url('newsletter/subscriber')}}">Subscriber</a>
                                </li>
                                @endif
                                @if(in_array('83',Session::get('user_rights')))
                                <li>
                                    <a href="{{url('cms/newsletter')}}">Create Newsletter</a>
                                </li>
                                @endif

                                @if(in_array('83',Session::get('user_rights')))
                                <!-- <li>
                                    <a href="{{url('newsletterh/create')}}">Create Html Newsletter</a>
                                </li> -->
                                @endif

                                @if(in_array('83',Session::get('user_rights')))
                                <li>
                                    <a href="{{url('')}}/newsletter/morningnewsletter.html" target="_blank">Preview Morning Newsletter</a>
                                </li>
                                @endif

                                @if(in_array('83',Session::get('user_rights')))
                                <!-- <li>
                                    <a href="{{url('')}}/newsletter/afternoonnewsletter.html" target="_blank">Preview Afternoon Newsletter</a>
                                </li> -->
                                @endif

                                @if(in_array('83',Session::get('user_rights')))
                                <li>
                                    <a href="{{url('')}}/newsletter/eveningnewsletter.html" target="_blank">Preview Evening Newsletter</a>
                                </li>
                                @endif


                                @if(in_array('83',Session::get('user_rights')))
                                <li>
                                    <a href="{{url('')}}/newsletter/breakingnewsletter.html" target="_blank">Preview Breaking </a>
                                </li>
                                @endif


                                @if(in_array('83',Session::get('user_rights')))
                                <!-- <li>
                                    <a href="{{url('')}}//newsletter/newsupdatenewsletter.html" target="_blank">Preview News Update </a>
                                </li> -->
                                @endif

                            </ul>
                        </div>
                    </li>
                    @endif

                    @if(count(array_diff(array('72','73'), Session::get('user_rights'))) != count(array('72','73')))
                    <li>
                        <a href="javascript:;" class="sub-nav-container">
                            <i class="icon-photon cog"></i>
                            <span class="nav-selection">Rights Management</span>
                            <i class="icon-menu-arrow"></i>                </a>
                            <div class="sub-nav">
                                <ul class="nav">
                                    @if(in_array('72',Session::get('user_rights')))
                                    <li>
                                        <a href="{{url('cms/rights')}}">CMS Rights</a>
                                    </li>

                                    @endif
                                    @if(in_array('73',Session::get('user_rights')))
                                    <li>
                                        <a href="{{url('roles/manage')}}">Manage Roles</a>
                                    </li>

                                    <li>
                                        <a href="{{url('roles/add')}}">Add Roles</a>
                                    </li>
                                    @endif
                                    <li>
                                        <a href="{{url('edit/htmlEntities')}}">Html Entity</a>
                                    </li>
                                <!-- <li>
                                    <a href="#">Help</a>
                                </li> -->
                    </ul>
                </div>
            </li>
            @endif

            @if(count(array_diff(array('87','88','89','90','91','92','93'), Session::get('user_rights'))) != count(array('87','88','89','90','91','92','93')))
            <li>
                <a href="javascript:;" class="sub-nav-container">
                    <i class="icon-photon book"></i>
                    <span class="nav-selection">Subscription</span>
                    <i class="icon-menu-arrow"></i>                </a>
                    <div class="sub-nav">
                        <ul class="nav">
                            @if(in_array('87',Session::get('user_rights')))
                            <li>
                                <a href="{{url('/subscription/packages')}}">Manage Package</a>
                            </li>
                            @endif
                            @if(in_array('88',Session::get('user_rights')))
                            <li>
                                <a href="{{url('/subscription/discounts')}}">Manage Discount</a>
                            </li>
                            @endif
                            @if(in_array('93',Session::get('user_rights')))
                            <li>
                                <a href="{{url('/subscription/freebies')}}">Manage Freebies</a>
                            </li>
                            @endif
                            @if(in_array('89',Session::get('user_rights')))
                            <li>
                                <a href="{{url('/subscribers')}}">Subscriber</a>
                            </li>
                            <li>
                                <a href="{{url('/subscribers/deleted')}}">Deleted Subscriber</a>
                            </li>
                            @endif
                            @if(in_array('90',Session::get('user_rights')))
                            <li>
                                <a href="{{url('/subscriptions/active')}}">Active Orders</a>
                            </li>
                            @endif
                            @if(in_array('91',Session::get('user_rights')))
                            <li>
                                <a href="{{url('/subscriptions/expiring')}}">Expiring Soon</a>
                            </li>
                            @endif
                            @if(in_array('92',Session::get('user_rights')))
                            <li>
                                <a href="{{url('/subscriptions/expired')}}">Expired Orders</a>
                            </li>
                            @endif

                            @if(in_array('94',Session::get('user_rights')))
                            <li>
                                <a href="{{url('/subscriptions/pending')}}">Pending Orders</a>
                            </li>
                            @endif


                        </ul>
                    </div>
                </li>
                @endif
                @if(count(array_diff(array('82','83','84','95'), Session::get('user_rights'))) != count(array('82','83','84','95')))
         <!--     <li>
                <a href="{{url('/cronscript/cronjobnew.php')}}" >
                    <i class="icon-photon document_alt_stroke"></i>
                    <span class="nav-selection">Generate Cron</span>
                                    </a>
            </li>
              <li>
                <a href="https://exchange4media.com/generatehtm.html" >
                    <i class="icon-photon document_alt_stroke"></i>
                    <span class="nav-selection">Create Website Html</span>
                                    </a>
                                </li> -->
                                <li>
                                    <a href="{{url('cms/reporteditor')}}" >
                                        <i class="icon-photon document_alt_stroke"></i>
                                        <span class="nav-selection">View Reports</span>
                                    </a>
                                </li>
                                @endif
                                <li>
                                    <a href="{{url('cms/logActivity')}}" >
                                        <i class="icon-photon document_alt_stroke"></i>
                                        <span class="nav-selection">View Log Activity</span>
                                    </a>
                                </li>
                                 <li>
                                    <a href="{{url('article/upload/files')}}" >
                                        <i class="icon-photon document_alt_stroke"></i>
                                        <span class="nav-selection">Upload PDF/Video</span>
                                    </a>
                                 </li>
                                <li class="navdown" style="position: absolute;
                                bottom: 31px;
                                left: 0;
                                right: 0;
                                width: 100%;">
                                <a href="#">
                                    <i class="fa fa-user" aria-hidden="true" style="position: relative;
                                    float: left;
                                    vertical-align: middle;
                                    color: #d1d7df;
                                    height: 28px;
                                    line-height: 28px;
                                    text-align: center;
                                    width: 38px;
                                    margin: 0;
                                    background-image: none;
                                    z-index: 5;
                                    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.7);"></i><span class="nav-selection">{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}</span>
                                </a>
                            </li>
                            <li class="nav-logout">
                                <a href="{{url('/auth/logout')}}">
                                    <i class="icon-photon key_stroke"></i><span class="nav-selection">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
