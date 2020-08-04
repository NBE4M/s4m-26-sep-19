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
    @if(isset($shareAlbum))
    <nav aria-label="breadcrumb">
      <small>
        <ol class="breadcrumb bg-white text-warning p-0">
          <li class="breadcrumb-item"><a href="{{url('/')}}">होम</a></li>
          <li class="breadcrumb-item"><a href="{{Request::url()}}">फोटो</a></li>
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
        <span style="background: black;padding: 2px 10px 0px 10px; color: white;border-radius: 10px 0px 0px 0px;">फोटो
        </span>
      </h1>
    <div class="row m-0">
      <div class="row m-0">
        @foreach($shareAlbum as $key=>$sam)
        <div class="row m-0">
          <div class="col-lg-4 col-md-12 p-0"> 
            <a href="{{url('news/photo').'/'.str_slug($sam->album_title).'-'.$sam->id}}">
              <img class="img-fluid img-thumbnail" src="{{Config::get('constants.storagepath')}}album/{{$sam->photopath}}" alt="{{$sam->phototitle}}" onerror="this.onerror=null;this.src='{{url("images/brand-1.jpg")}}';">
            </a>
          </div>        
          <div class="col-lg-8 col-md-12 mob-p-0 mob-pt-10">
            <h5 class="story-page-hed">
              <a href="{{url('news/photo').'/'.str_slug($sam->album_title).'-'.$sam->id}}">{{$sam->album_title}}</a>
            </h5>
            <p class="date font-weight-bold text-muted mb-0 mt-0"> 
              <i class="fas fa-user mr-1"></i> 
              <a href="{{url('author.html')}}"> समाचार4मीडिया ब्यूरो</a> 
              <i class="far fa-clock ml-2 mr-1"></i> 
              <a href="#">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$sam->albumDate)->diffForHumans()}}</a>
            </p>
            <p class="mt-3">
              <a class="common-share facebook" id="{{Config::get('constants.storagepath')}}album/{{$sam->photopath}}" data-title="{{$sam->album_title}}">
                <i class="fab fa-facebook-f text-warning"></i>
              </a> 
              <a class="common-share twitter" id="{{Config::get('constants.storagepath')}}album/{{$sam->photopath}}" data-title="{{$sam->album_title}}">
                <i class="fab fa-twitter text-warning ml-2"></i>
              </a> 
              <a class="common-share linkedin" id="{{Config::get('constants.storagepath')}}album/{{$sam->photopath}}" data-title="{{$sam->album_title}}">
                <i class="fab fa-linkedin-in text-warning ml-2"></i>
              </a> 
              <a class="common-share whatsup" id="{{Config::get('constants.storagepath')}}album/{{$sam->photopath}}" data-title="{{$sam->album_title}}">
                <i class="fab fa-whatsapp text-warning ml-2"></i>
              </a> 
              <a class="common-share mail" id="{{Config::get('constants.storagepath')}}album/{{$sam->photopath}}" data-title="{{$sam->album_title}}">
                <i class="fas fa-envelope text-warning ml-2"></i>
              </a>
              <a class="btn btn-dark btn-sm px-2 waves-effect export-to-snippet float-right mt-0" href="{{url('news/photo').'/'.str_slug($sam->album_title).'-'.$sam->id}}" >
                <i class="far fa-image m-1"></i> View Gallery
              </a> 
            </p>
          </div>
        </div>        
        <div class="col p-0 mt-2 mb-3">
          <hr class="dashed-bdr-t mb-1">
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
        @endforeach
      </div>
    </div>
    @endif
    {!! PaginateRoute::renderHtml($shareAlbum) !!}
  </div>
  
  <!--left-part-->
  @include('partials.rightsidebar')
</div>
<!--center-part-->
</div>
<!--middle-body-->
@endsection           