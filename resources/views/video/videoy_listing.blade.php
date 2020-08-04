@extends('partials.app')
@section('content')
<!--middle-body-->
<div class="container mt-65 mb-4 mob-mt-75">
    <!--center-part-->
    <!--Breaking News-->
  @if(isset($breaking))
  <div class="row m-lg-0">
    <div class="breaking_news">
      <div class="label ripple">{{strtoupper($breaking->news_label)}}</div>
      <div class="news_title">
        <marquee>
        <strong>
          
            @if($breaking->news_url == '#' || $breaking->news_url == '' || $breaking->news_url == null)
            
              {{$breaking->news_title}}
            
            @else
            <a href="{{$breaking->news_url}}" target="_blank">
              {{$breaking->news_title}}
            </a>
            @endif
          
        </strong>
      </marquee>
      </div>
    </div>  
  </div>
  @endif
  <!--Breaking News-->
    <div class="row mob-p-0 mob-m-0">
        <!--left-part-->
        <div class="col-md-7 col-lg-9 dashed-bdr-r mob-bdr-0 mob-p-0 pl-md-0 pl-lg-3">
            @if(isset($ArrViewVideo))
            <nav aria-label="breadcrumb">
                <small> 
                    <ol class="breadcrumb bg-white text-warning p-0">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">होम</a></li>
                        <li class="breadcrumb-item"><a href="{{url('news/videos').'.html'}}">वीडियो </a></li>
                        @foreach($ArrViewVideo as $fav)
                        <li class="breadcrumb-item active">{{$fav->title}}</li>
                        @endforeach
                    </ol>
                </small>
            </nav>
            @if(isset($parents[4]))  
          @if($parents[4]->status==1)
          {!!$parents[4]->bscript!!}
          @else 
          @endif 
        @else
      @endif
            <div class="row m-0">
                <div class="row m-0">
                    <!--video-->
                    
                    @foreach($ArrViewVideo as $avv)
                    <div class="col-md-12">
                        <div class="row">
                            <iframe width="100%" height="400" src="https://www.youtube.com/embed/{{$avv->vid}}?autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen="" class="videoframe">
                            </iframe>
                        </div>
                        <div class="row mt-2">
                            <h3 class="story-page-hed">
                                <strong>{{$avv->title}}</strong>
                            </h3>
                        </div>                       
                        <div class="row mt-3">
                            <div class="col-md-5 mob-text-center pl-0 mob-p-0">
                                <h6>
                                    <strong>समाचार4मीडिया ब्यूरो</strong>
                                    <br>
                                    <small class="text-muted"><i class="far fa-clock mr-1"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$avv->created_at)->diffForHumans()}}</small>
                                </h6>
                            </div>                        
                            <div class="col-md-7 share-buttons text-right pr-0 mob-p-0">    
                                <!--Facebook-->
                                <button type="button" class="btn btn-fb pl-2 pr-2 pt-1 pb-1 mr-0 ml-0 common-share facebook" id="{{url('news/video').'/'.str_replace(' ','-',$avv->title).'-'.$avv->yid}}" data-title="{{$avv->title}}"><i class="fab fa-facebook-f pr-1"></i> Share</button>
                                <!--Twitter-->
                                <button type="button" class="btn btn-tw pl-2 pr-2 pt-1 pb-1 mr-0 btn-info  common-share twitter" id="{{url('news/video').'/'.str_replace(' ','-',$avv->title).'-'.$avv->yid}}" data-title="{{$avv->title}}"><i class="fab fa-twitter pr-1"></i> Share</button>
                                <!--linkedin-->
                                <button type="button" class="btn btn-li pl-2 pr-2 pt-1 pb-1 mr-0  common-share linkedin" id="{{url('news/video').'/'.str_replace(' ','-',$avv->title).'-'.$avv->yid}}" data-title="{{$avv->title}}"><i class="fab fa-linkedin-in pr-1"></i> Share</button>
                                <!--whatsup-->
                                <button type="button" class="btn btn-slack pl-2 pr-2 pt-1 pb-1 mr-0  common-share whatsup" id="{{url('news/video').'/'.str_replace(' ','-',$avv->title).'-'.$avv->yid}}" data-title="{{$avv->title}}"><i class="fab fa-whatsapp pr-1"></i> Share</button>
                                <!--mail-->
                                <button type="button" class="btn btn-email pl-2 pr-2 pt-1 pb-1 mr-0  common-share mail" id="{{url('news/video').'/'.str_replace(' ','-',$avv->title).'-'.$avv->yid}}" data-title="{{$avv->title}}"><i class="fas fa-envelope pr-1"></i> Share</button>
                                <!--Github-->
                            </div>
                        </div>                        
                    </div>
                    @endforeach
                    @endif
                    <!--video-->
                    @if(isset($ArrlistingVideos))
                    @foreach($ArrlistingVideos as $alv)
                    <div class="col-12 mt-3 p-0">
                        <hr class="dashed-bdr-t mb-1">
                    </div> 
                               
                    <div class="row m-0 mt-4">
                        <div class="col-lg-4 col-md-12 p-0"> 
                            <span class="video-icon mb-2"><i class="fas fa-play-circle text-danger fa-2x"></i></span>
                            <a href="{{url('news/video').'/'.str_replace(' ','-',$alv->title).'-'.$alv->yid}}">
                                <img class="img-fluid img-thumbnail" src="{{$alv->img_thumb}}" alt="{{$alv->title}}" onerror="this.onerror=null;this.src='{{url("images/video-2.jpg")}}';">
                            </a>
                        </div>                
                        <div class="col-lg-8 col-md-12 mob-p-0 mob-pt-10">
                            <h5 class="story-page-hed">
                                <a href="{{url('news/video').'/'.str_replace(' ','-',$alv->title).'-'.$alv->yid}}">{{$alv->title}}</a>
                            </h5>                        
                            <p class="date font-weight-bold text-muted mb-0 mt-0"> 
                                <i class="fas fa-user mr-1"></i> 
                                <a href="#">समाचार4मीडिया ब्यूरो</a> 
                                <i class="far fa-clock ml-2 mr-1"></i> 
                                <a href="#">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$alv->created_at)->diffForHumans()}} </a>
                            </p>
                            <p class="mt-3">
                                <a class="common-share facebook" id="{{url('news/video').'/'.str_replace(' ','-',$alv->title).'-'.$alv->yid}}" data-title="{{$alv->title}}">
                                  <i class="fab fa-facebook-f text-warning"></i>
                                </a> 
                                <a class="common-share twitter" id="{{url('news/video').'/'.str_replace(' ','-',$alv->title).'-'.$alv->yid}}" data-title="{{$alv->title}}">
                                  <i class="fab fa-twitter text-warning ml-2"></i>
                                </a> 
                                <a class="common-share linkedin" id="{{url('news/video').'/'.str_replace(' ','-',$alv->title).'-'.$alv->yid}}" data-title="{{$alv->title}}">
                                  <i class="fab fa-linkedin-in text-warning ml-2"></i>
                                </a> 
                                <a class="common-share whatsup" id="{{url('news/video').'/'.str_replace(' ','-',$alv->title).'-'.$alv->yid}}" data-title="{{$alv->title}}">
                                  <i class="fab fa-whatsapp text-warning ml-2"></i>
                                </a> 
                                <a class="common-share mail" id="{{url('news/video').'/'.str_replace(' ','-',$alv->title).'-'.$alv->yid}}" data-title="{{$alv->title}}">
                                  <i class="fas fa-envelope text-warning ml-2"></i>
                                </a>
                                <a class="btn btn-dark btn-sm px-2 waves-effect export-to-snippet float-right mt-0" href="{{url('news/video').'/'.str_replace(' ','-',$alv->title).'-'.$alv->yid}}">
                                  <i class="fas fa-video m-1 text-warning"></i> View Video
                                </a>
                            </p>                
                        </div>
                    </div>
                    @if(isset($parents[5]))  
          @if($parents[5]->status==1)
          {!!$parents[5]->bscript!!}
          @else 
          @endif 
        @else
      @endif

                    @endforeach
                    @endif                
                </div>            
            </div>
        </div>
        <!--left-part-->   
        @include('partials.rightsidebar')
    </div>
    <!--center-part-->
</div>
<!--middle-body-->
@endsection           
