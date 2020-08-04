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
      <nav aria-label="breadcrumb">
        <small> 
          <ol class="breadcrumb bg-white text-warning p-0">
            <li class="breadcrumb-item"><a href="{{url('/')}}">होम</a></li>
            <li class="breadcrumb-item"><a href="{{url('news/videos').'.html'}}">वीडियो</a></li>
            <!-- <li class="breadcrumb-item active">Data</li> -->
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
      <h1 style="font-size: 24px; margin-bottom: 19px;border-bottom: solid;">
        <span style="background: black;padding: 2px 10px 0px 10px; color: white;border-radius: 10px 0px 0px 0px;">वीडियो
        </span>
      </h1>
      <div class="row m-0">
        
        <div class="row m-0">
          @if(isset($galleryVideo))
        @foreach($galleryVideo as $key=>$glv)
          <div class="row m-0">
            <div class="col-lg-4 col-md-12 p-0"> 
              <span class="video-icon mb-2"><i class="fas fa-play-circle text-danger fa-2x"></i></span>
              <a href="{{url('news/video').'/'.str_replace(' ','-',preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $glv->title)).'-'.$glv->yid}}">
                <img class="img-fluid img-thumbnail" src="{{$glv->img_thumb}}" alt="{{$glv->title}}" onerror="this.onerror=null;this.src='images/video-2.jpg';">
              </a>
            </div>        
            <div class="col-lg-8 col-md-12 mob-p-0 mob-pt-10">
              <h5 class="story-page-hed">
                <a href="{{url('news/video').'/'.str_replace(' ','-',preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $glv->title)).'-'.$glv->yid}}">{{$glv->title}}</a>
              </h5>            
              <p class="date font-weight-bold text-muted mb-0 mt-0"> 
                <i class="fas fa-user mr-1"></i> 
                <a href=""> समाचार4मीडिया ब्यूरो</a> 
                <i class="far fa-clock ml-2 mr-1"></i> 
                <a>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $glv->updated_at)->diffForHumans()}} </a>
              </p>
              <p class="mt-3">
                <a class="common-share facebook" id="{{url('news/video').'/'.str_replace(' ','-',preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $glv->title)).'-'.$glv->yid}}" data-title="{{$glv->title}}">
                  <i class="fab fa-facebook-f text-warning"></i>
                </a> 
                <a class="common-share twitter" id="{{url('news/video').'/'.str_replace(' ','-',preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $glv->title)).'-'.$glv->yid}}" data-title="{{$glv->title}}">
                  <i class="fab fa-twitter text-warning ml-2"></i>
                </a> 
                <a class="common-share linkedin" id="{{url('news/video').'/'.str_replace(' ','-',preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $glv->title)).'-'.$glv->yid}}" data-title="{{$glv->title}}">
                  <i class="fab fa-linkedin-in text-warning ml-2"></i>
                </a> 
                <a class="common-share whatsup" id="{{url('news/video').'/'.str_replace(' ','-',preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $glv->title)).'-'.$glv->yid}}" data-title="{{$glv->title}}">
                  <i class="fab fa-whatsapp text-warning ml-2"></i>
                </a> 
                <a class="common-share mail" id="{{url('news/video').'/'.str_replace(' ','-',preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $glv->title)).'-'.$glv->yid}}" data-title="{{$glv->title}}">
                  <i class="fas fa-envelope text-warning ml-2"></i>
                </a>
                <a class="btn btn-dark btn-sm px-2 waves-effect export-to-snippet float-right mt-0" href="{{url('news/video').'/'.str_replace(' ','-',preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $glv->title)).'-'.$glv->yid}}">
                  <i class="fas fa-video m-1 text-warning"></i> View Video
                </a>
              </p>
            </div>
          </div>
          @if($key == 2 || $key == 6 || $key == 10 || $key == 14 || $key ==  18)
        @if(isset($parents[5]))  
          @if($parents[5]->status==1)
          {!!$parents[5]->bscript!!}
          @else 
          @endif 
        @else
      @endif
      @endif
          <div class="col-12 p-0 mt-2 mb-3">
            <hr class="dashed-bdr-t mb-1">
          </div>
          
      @endforeach
        @endif
        </div>
        
      </div>
      
      {!! PaginateRoute::renderHtml($galleryVideo) !!}
    </div>
    <!--left-part-->
  @include('partials.rightsidebar')
  </div>
  <!--center-part-->
</div>
<!--middle-body-->
@endsection           