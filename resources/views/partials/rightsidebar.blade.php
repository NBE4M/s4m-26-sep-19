<!--right part-->
  <div class="col-md-5 col-lg-3 col-xs-6 pr-0 mob-p-0 mob-mt-30 rightSidebar">
    <div class="theiaStickySidebar">
      <!--top-news story page-->
      <div class="row mob-m-0">
       <div class="row pl-0 mb-3 ml-0 title-holder">
        <h5 class="mb-0 bdr-solid-l border-warning heading-bdr">
          <strong>
            <span class="bg-white pl-3 pr-3">बड़ी खबरें</span>
          </strong>
        </h5>
      </div>
      <div class="row m-0 p-0">
        @if(isset($rightsidemostRead))         
        <div class="col-md-12 p-0">
          <!--<i class="fa fa-arrow-up" id="nt-example1-prev"></i>-->
          <ul id="nt-example2" class="top-news-story">
            @foreach($rightsidemostRead as $mo)
            <li>
              <div class="card bg-dark text-white">
                 <img class="card-img img-fluid" src="{{Config::get('constants.storagepath')}}{{$mo->photopath}}" alt="{{$mo->phototitle}}" title="{{$mo->phototitle}}" onerror="this.onerror=null;this.src='{{url("images/brand-1.jpg")}}';">
                <div class="card-img-overlay d-flex">
                  <a href="{{url('/').'/'.$mo->category_ename.'-news.html'}}" class="align-self-end">
                    <span class="badge">{{$mo->category_hname}}</span>
                  </a>
                  <a href="{{$mo->url}}">
                    <h6 class="card-title mb-0">{{$mo->title}}</h6>
                  </a>
                </div>
              </div>
            </li>
            @endforeach 
          </ul>
          <!--<i class="fa fa-arrow-down" id="nt-example2-next"></i>-->                  
        </div>              

      </div>
    </div>
    <!--top-news story page-->       

    <hr class="bdr-solid p-0 mb-2">
    <!--whatsup-->
    <div class="row m-0">
      <div class="col-md-12 p-0 text-center">
        <p class="m-0text-center mb-0">
          <a href="https://wb.messengerpeople.com/?widget_hash=bac86292cde7a4444b6fbc935e586d7d&lang=en&wn=2&pre=1" target="_blank"><img src="{{url('images/whatsapp.png')}}" class="img-fluid whatsup"></a>
        </p>
      </div>
    </div>
    <!--whatsup-->
    <hr class="bdr-solid p-0 mb-2">
    <!--square banner add-->
    <div class="row">
      @if(isset($parents[1]))  
          @if($parents[1]->status==1)
          {!!$parents[1]->bscript!!}
          @else 
          @endif 
        @else
      @endif
      
    </div>
    <!--square banner add-->
    <hr class="bdr-solid p-0 mb-2"> 
    <!--2nd section news-->
    <div class="row mt-3 mob-m-0 mob-mt-15">
      <div class="col-md-12 p-0">
        <div class="row pl-0 mb-3 ml-0 title-holder">
          <h5 class="mb-0 bdr-solid-l border-warning heading-bdr">
            <strong>
              <span class="bg-white pl-2 pr-1">सबसे लोकप्रिय खबरें</span>
            </strong>
            
          </h5>
        </div>            
        <div class="row m-0">                
          <div class="row m-0">
            @for($z=0;$z < 1; $z++)
            <div class="col-md-12 bg-dark p-1 rounded"> 
              <a href="{{$mostRead[$z]->url}}">
                <img class="img-fluid" src="{{Config::get('constants.storagepath')}}{{$mostRead[$z]->photopath}}" alt="{{$mostRead[$z]->phototitle}}" title="{{$mostRead[$z]->phototitle}}" onerror="this.onerror=null;this.src='{{url("images/lok-news2.jpg")}}';">
              </a>
              <h5 class="mt-2 font-heading-1 text-white lh pl-1">
                <a href="{{$mostRead[$z]->url}}">{{$mostRead[$z]->title}}</a>
              </h5>
            </div>
            @endfor
          </div>
          @for($z=1;$z < 3; $z++)  
          <div class="col-md-12 p-0">
            <hr class="dashed-bdr-t">
          </div>
          <div class="row">
            
            <div class="col-6 col-sm-12 col-md-12 col-lg-5 pr-0">
              <a href="{{$mostRead[$z]->url}}">
                <img class="img-fluid img-thumbnail" src="{{Config::get('constants.storagepath')}}{{$mostRead[$z]->photopath}}" alt="{{$mostRead[$z]->phototitle}}" title="{{$mostRead[$z]->phototitle}}" onerror="this.onerror=null;this.src='{{url("images/lok-news.jpg")}}';">
              </a>
            </div>
            <div class="col-6 col-sm-12 col-md-12 col-lg-7 pr-0 pl-2">
              <h6 class="mb-0">
                <a href="{{$mostRead[$z]->url}}">
                  <strong>{{$mostRead[$z]->title}}</strong>
                </a>
              </h6>      
            </div>
              
          </div>
          @endfor    
        </div>         
      </div>
    </div><!--2nd section news-->
    @endif  
    <hr class="bdr-solid p-0 mb-2">        
    <!--square banner add-->
    <div class="row">
      @if(isset($parents[2]))  
          @if($parents[2]->status==1)
          {!!$parents[2]->bscript!!}
          @else 
          @endif 
        @else
      @endif
      
    </div>
    <!--square banner add-->        
    <hr class="bdr-solid">        
    <!--right-third-news-->
    <div class="row mob-m-0">
      <div class="col-md-12 bg-dark p-2 rounded">
        <div class="row pl-0 mb-3 ml-0 title-holder">
          <h5 class="mb-0 bdr-solid-l border-warning heading-bdr">
            <strong>
              <a href="{{url('industry-briefing-news.html')}}">
              <span class="bg-dark text-white pl-2 pr-1">इंडस्ट्री ब्रीफिंग
              </span>
              </a>
            </strong>
            <small>
              <a href="{{url('industry-briefing-news.html')}}" title="और देखें" class="float-right mt-1 pl-2 text-warning mob-seemore bg-dark">
                <strong>और पढ़ें</strong>
              </a>
            </small>
          </h5>
        </div>
        @if(isset($industryBriefing))
        <div class="row text-white">
         <div class="col-md-6 col-6"> 
          <a href="{{$industryBriefing[0]->url}}">
            <img class="img-fluid border rounded" src="{{Config::get('constants.storagepath')}}{{$industryBriefing[0]->photopath}}" alt="{{$industryBriefing[0]->phototitle}}" title="{{$industryBriefing[0]->phototitle}}" onerror="this.onerror=null;this.src='{{url("images/interview-1.jpg")}}';">
          </a>
          <h6 class="mt-1 font-heading-1">
            <a href="{{$industryBriefing[0]->url}}">{{$industryBriefing[0]->title}}</a>
          </h6>                  
        </div>
        <div class="col-md-6 col-6"> 
          <a href="{{$industryBriefing[1]->url}}">
            <img class="img-fluid border rounded" src="{{Config::get('constants.storagepath')}}{{$industryBriefing[1]->photopath}}" alt="{{$industryBriefing[1]->phototitle}}" title="{{$industryBriefing[1]->phototitle}}" onerror="this.onerror=null;this.src='{{url("images/telecop-story2.jpg")}}';">
          </a>
          <h6 class="mt-1 font-heading-1">
            <a href="{{$industryBriefing[1]->url}}">{{$industryBriefing[1]->title}}</a>
          </h6>                  
        </div>  
      </div>
      <div class="row text-white">
         <div class="col-md-6 col-6"> 
          <a href="{{$industryBriefing[2]->url}}">
            <img class="img-fluid border rounded" src="{{Config::get('constants.storagepath')}}{{$industryBriefing[2]->photopath}}" alt="{{$industryBriefing[2]->phototitle}}" title="{{$industryBriefing[2]->phototitle}}" onerror="this.onerror=null;this.src='{{url("images/interview-1.jpg")}}';">
          </a>
          <h6 class="mt-1 font-heading-1">
            <a href="{{$industryBriefing[2]->url}}">{{$industryBriefing[2]->title}}</a>
          </h6>                  
        </div>
        <div class="col-md-6 col-6"> 
          <a href="{{$industryBriefing[3]->url}}">
            <img class="img-fluid border rounded" src="{{Config::get('constants.storagepath')}}{{$industryBriefing[3]->photopath}}" alt="{{$industryBriefing[3]->phototitle}}" title="{{$industryBriefing[3]->phototitle}}" onerror="this.onerror=null;this.src='{{url("images/telecop-story2.jpg")}}';">
          </a>
          <h6 class="mt-1 font-heading-1">
            <a href="{{$industryBriefing[3]->url}}">{{$industryBriefing[3]->title}}</a>
          </h6>                  
        </div>  
      </div>
      @endif
  </div>
</div>
<!--right-third-news-->


<hr class="bdr-solid p-0 mb-2">


<!--सब्सक्राइब-->
    <form name="form1" method="post" class="text-center" id="subform" >
    {{csrf_field()}}
    <div class="row mt-4">
      <div class="col-md-12 text-white p-0 bg-dark rounded">

        <h4 class="text-white bg-warning p-1 pl-3 rounded-top" style="border-bottom: dotted #000000 2px;font-family: 'Rajdhani', sans-serif; font-weight: 700;">सब्सक्राइब</h4> 
        <h5 class="pl-3" style="line-height: 35px;">न्यूजलेटर पाने के लिए यहां सब्सक्राइब कीजिए</h5>
        <div id="semail_err"></div>
        <div class="form-group p-3 mb-0">
          <input type="email" name="email"  id="email" class="form-control "  aria-describedby="emailHelp" placeholder="Enter email" required="">
        </div>
        <p class="text-center">
          <input type="button" value="Subscribe" class="btn btn-warning btn-sm" onclick="right_subcribe_form()">
          
        </p>

      </div>
    </div>

  </form>
  <div class="modal fade" id="thankyouModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body">
          <p id="thx"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
<!--सब्सक्राइब-->
<hr class="bdr-solid p-0 mb-2">
<!--मुख्य खबरें-->
<div class="row media-form2 mt-3 bg-dark p-2 rounded mob-m-0">
 <div class="row pl-0 mb-3 ml-0 title-holder">
  <h5 class="mb-0 bdr-solid-l border-white heading-bdr2">
    <strong>
      <a href="{{url('social-media-news.html')}}">
      <span class="bg-dark text-warning pl-2 pr-1">सोशल मीडिया</span>
      </a>
    </strong>
    <small>
              <a href="{{url('social-media-news.html')}}" title="और देखें" class="float-right mt-1 pl-2 text-warning mob-seemore bg-dark">
                <strong>और पढ़ें</strong>
              </a>
            </small>    
  </h5>
</div>
@if(isset($socialM))
<ul class="scrollbar style-4 mt-0 pr-3 text-white story-mk">
  @foreach($socialM as $k=>$val)
  @php $k++ @endphp
  <li class="mt-0">
    <span class="big-number text-warning">{{$k}}</span>
    <a href="{{$val->url}}">{{$val->title}} </a>
    <small class="float-right date mt-2 text-light"> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $val->pickdate)->diffForHumans()}}</small>
  </li>
  @endforeach
</ul> 
@endif
</div>
<!--मुख्य खबरें-->
<hr class="bdr-solid p-0 mb-2">
<!--square banner add-->
<div class="row">
  @if(isset($parents[3]))  
          @if($parents[3]->status==1)
          {!!$parents[3]->bscript!!}
          @else 
          @endif 
        @else
      @endif
  
</div><!--square banner add-->

<hr class="bdr-solid p-0 mb-2">


<!--story video slider-->
<div class="row mt-3 bg-danger border-danger p-1 rounded mob-m-0">

  <div class="col-md-12 p-0">
    <div class="row pl-0 mb-2 mt-1 ml-0 title-holder">
      <h5 class="mb-0 bdr-solid-l border-white heading-bdr2">
        <strong>
          <a href="{{url('news/videos.html')}}">
          <span class="bg-danger text-white pl-2 pr-2">
            विडियो
          </span>
          </a>
        </strong>
        <small>
          <a href="{{url('news/videos.html')}}" title="और देखें" class="float-right mt-1 pl-2 text-dark mob-seemore bg-danger">
            <strong>और देखें</strong>
          </a>
        </small>
      </h5>
    </div>
    <div id="demo" class="carousel slide story-video-slider" data-ride="carousel">
    @if(isset($videos))
    @for($vid=0;$vid < 1; $vid++)
    <div class="carousel-inner">
      <div class="carousel-item active"> 
        <a href="{{url('video').'/'.str_slug($videos[$vid]->title).'-'.$videos[$vid]->yid}}">
          <img src="{{$videos[$vid]->img_thumb}}" alt="{{$videos[$vid]->title}}" title="{{$videos[$vid]->title}}" width="100%" height="100%" onerror="this.onerror=null;this.src='{{url("images/video-1.jpg")}}';" >
        </a>
        <div class="carousel-caption">
          <p>{{$videos[$vid]->title}}</p>
        </div>   
      </div>
      @endfor
      @for($vid=1;$vid < 5; $vid++)
      <div class="carousel-item"> 
        <a href="{{url('video').'/'.str_slug($videos[$vid]->title).'-'.$videos[$vid]->yid}}">
          <img src="{{$videos[$vid]->img_thumb}}" alt="{{$videos[$vid]->title}}" title="{{$videos[$vid]->title}}" width="100%" height="100%" onerror="this.onerror=null;this.src='images/video-2.jpg';" >
        </a>
        <div class="carousel-caption">
          <p>{{$videos[$vid]->title}}</p>
        </div>   
      </div>
      @endfor
    </div>
    @endif
  <a class="carousel-control-prev t-0" href="#demo" data-slide="prev">
    <i class="fas fa-angle-left"></i>
  </a>
  <a class="carousel-control-next t-0" href="#demo" data-slide="next">
    <i class="fas fa-angle-right"></i>
  </a>
</div>


</div>

</div>
<!--story video slider-->
<hr class="bdr-solid p-0 mb-2">
<!--2nd section news-->
@if(isset($vicharmanch))
<div class="row mt-3 mob-m-0">
  <div class="col-md-12 p-0">
   <div class="row pl-0 mb-3 ml-0 title-holder">
    <h5 class="mb-0 bdr-solid-l border-warning heading-bdr">
      <strong>
        <a href="{{url('vicharmanch-news.html')}}">
        <span class="bg-white text-dark pl-3 pr-3">
          विचार मंच
        </span>
        </a>
      </strong>
      <small>
        <a href="{{url('vicharmanch-news.html')}}" title="और देखें" class="float-right mt-1 pl-2 text-danger mob-seemore bg-white">
          <strong>और पढ़ें</strong>
        </a>
      </small>
    </h5>
  </div>
  <div class="row m-0">
    <div class="row m-0">
      <div class="col-md-12 p-0"> 
        <a href="{{$vicharmanch[0]->url}}">
          <img class="img-fluid" src="{{Config::get('constants.storagepath')}}{{$vicharmanch[0]->photopath}}" alt="{{$vicharmanch[0]->phototitle}}" title="{{$vicharmanch[0]->phototitle}}" onerror="this.onerror=null;this.src='{{url("images/vichar-story1.jpg")}}';">
        </a>
        <h5 class="mt-2 font-heading-1 lh pl-1">
          <strong>
            <a href="{{$vicharmanch[0]->url}}">
              {{$vicharmanch[0]->title}}
            </a>
          </strong>
        </h5>
      </div>
    </div>  

    <div class="col-md-12 p-0"><hr class="dashed-bdr-t"></div>

    <div class="row">
      <div class="col-6 col-sm-12 col-md-12 col-lg-5 pr-0">
        <a href="{{$vicharmanch[1]->url}}">
          <img class="img-fluid img-thumbnail" src="{{Config::get('constants.storagepath')}}{{$vicharmanch[1]->photopath}}" alt="{{$vicharmanch[1]->phototitle}}" title="{{$vicharmanch[1]->phototitle}}" onerror="this.onerror=null;this.src='{{url("images/vichar-story3.jpg")}}';">
        </a>
      </div>
      <div class="col-6 col-sm-12 col-md-12 col-lg-7 pr-0 pl-2">
      <h6 class="mb-0">
        <a href="{{$vicharmanch[1]->url}}">
          <strong>
            {{$vicharmanch[1]->title}}
          </strong>
        </a>
      </h6>      
      </div>      
    </div>

    <div class="col-md-12 p-0"><hr class="dashed-bdr-t"></div>

    <div class="row">
      <div class="col-6 col-sm-12 col-md-12 col-lg-5 pr-0">
        <a href="{{$vicharmanch[2]->url}}">
          <img class="img-fluid img-thumbnail" src="{{Config::get('constants.storagepath')}}{{$vicharmanch[2]->photopath}}" alt="{{$vicharmanch[2]->phototitle}}" title="{{$vicharmanch[2]->phototitle}}" onerror="this.onerror=null;this.src='{{url("images/vichar-story4.jpg")}}';">
        </a>
      </div>
      <div class="col-6 col-sm-12 col-md-12 col-lg-7 pr-0 pl-2">
        <h6 class="mb-0">
          <a href="{{$vicharmanch[2]->url}}">
            <strong>
             {{$vicharmanch[2]->title}}
            </strong>
          </a>
        </h6>      
      </div>      
    </div>
  </div>
</div>
</div>
@endif
<!--2nd section news-->


<hr class="bdr-solid p-0 mb-2 mob-mt-30">


<!--story gallery slider-->
<div class="row mt-3 bg-dark border-danger p-1 rounded mob-m-0 mob-mt-30">

  <div class="col-md-12 p-0">
    <div class="row pl-0 mb-2 mt-1 ml-0 title-holder">
      <h5 class="mb-0 bdr-solid-l border-white heading-bdr2">
        <strong>
          <a href="{{url('news/photos.html')}}">
          <span class="bg-dark text-warning pl-3 pr-3">फोटो गैलरी</span>
          </a>
        </strong>
        <small>
          <a href="{{url('news/photos.html')}}" title="और देखें" class="float-right mt-1 pl-2 text-warning mob-seemore bg-dark">
            <strong>और देखें </strong>
          </a>
        </small>
      </h5>
    </div>
      <div id="demo2" class="carousel slide story-video-slider" data-ride="carousel">

  <div class="carousel-inner">
    @if(isset($frontalbum))
    @for($fra=0;$fra < 1;$fra++)
    <div class="carousel-item active"> 
      <a href="{{url('photo').'/'.str_slug($frontalbum[$fra]->album_title).'-'.$frontalbum[$fra]->albumId}}">
        <img class="d-block w-100" src="{{Config::get('constants.storagepath')}}album/{{$frontalbum[$fra]->photopath}}" alt="{{$frontalbum[$fra]->phototitle}}" title="{{$frontalbum[$fra]->phototitle}}" onerror="this.onerror=null;this.src='{{url("images/gallery-5.jpg")}}';" width="100%" height="100%">
      </a>
      <div class="carousel-caption bg-dark">
        <p>{{$frontalbum[$fra]->title}}</p>
      </div>   
    </div>
    @endfor
    @for($fra=1;$fra < 5;$fra++)
    <div class="carousel-item">
      <a href="{{url('photo').'/'.str_slug($frontalbum[$fra]->album_title).'-'.$frontalbum[$fra]->albumId}}">
        <img class="d-block w-100" src="{{Config::get('constants.storagepath')}}album/{{$frontalbum[$fra]->photopath}}" alt="{{$frontalbum[$fra]->phototitle}}" title="{{$frontalbum[$fra]->phototitle}}" onerror="this.onerror=null;this.src='{{url("images/gallery-5.jpg")}}';" width="100%" height="100%">
      </a>
      <div class="carousel-caption bg-dark">
        <p>{{$frontalbum[$fra]->title}}</p>
      </div>   
    </div>
    @endfor
    @endif
  </div>


  <a class="carousel-control-prev t-0" href="#demo2" data-slide="prev">
    <i class="fas fa-angle-left"></i>
  </a>
  <a class="carousel-control-next t-0" href="#demo2" data-slide="next">
    <i class="fas fa-angle-right"></i>
  </a>
</div>


</div>

</div>
<!--story gallery slider-->
</div>

</div><!--right part-->


