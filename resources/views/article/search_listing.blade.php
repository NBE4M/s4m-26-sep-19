@extends('partials.app')

@section('content')
<!--main div start here-->
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
          <li class="breadcrumb-item"><a href="{{url('')}}">होम</a></li>
          @php $a = explode('/',Request::path()); @endphp
          @if($a[0] == 'search')
          <li class="breadcrumb-item">सर्च</li>
          @else
          <li class="breadcrumb-item">टैग</li>
          @endif
          <li class="breadcrumb-item">{!! $result !!}</li>          
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
    @if(isset($searchArticles))  
    <div class="row m-0">
      @foreach($searchArticles as $key=>$aS)
      <div class="row m-0">
        <div class="col p-0 mb-2">
          <h4 class="story-page-hed mt-2 red-bdr-l border-dark">
            <a href="{{$aS->url}}">{{$aS->title}}</a>
          </h4>
        </div>
        <div class="row m-0">
          <div class="col-lg-4 col-md-12 p-0">
            <a href="{{$aS->url}}">
              <img class="img-fluid img-thumbnail" src="{{Config::get('constants.storagepath')}}{{$aS->photopath}}" alt="{{$aS->phototitle}}" onerror="this.onerror=null;this.src='images/new-2.jpg';">
            </a>
          </div>
          <div class="col-lg-8 col-md-12 mob-p-0 mob-pt-10">
            <p class="mb-2">{{$aS->summary}}
            </p>
            <p class="date font-weight-bold text-muted mb-0 mt-0"> <i class="fas fa-user mr-1"></i> 
              <a href="{{url('author').'/'.str_replace(' ','-',preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $aS->authorname)).'-'.$aS->author_id}}"> @if($aS->authorname != 'Samachar4media Bureau' || !isset($aS->authorname) ){{$aS->authorname}}@else समाचार4मीडिया ब्यूरो ।।@endif</a> <i class="far fa-clock ml-2 mr-1"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $aS->pickdate)->diffForHumans()}} 
            </p>
            <p class="mt-3">
              <a class="common-share facebook" id="{{$aS->url}}" data-title="{{$aS->title}}">
                <i class="fab fa-facebook-f text-warning"></i>
              </a> 
              <a class="common-share twitter" id="{{$aS->url}}" data-title="{{$aS->title}}">
                <i class="fab fa-twitter text-warning ml-2"></i>
              </a> 
              <a class="common-share linkedin" id="{{$aS->url}}" data-title="{{$aS->title}}">
                <i class="fab fa-linkedin-in text-warning ml-2"></i>
              </a> 
              <a class="common-share whatsup" id="{{$aS->url}}" data-title="{{$aS->title}}">
                <i class="fab fa-whatsapp text-warning ml-2"></i>
              </a> 
              <a class="common-share mail" id="{{$aS->url}}" data-title="{{$aS->title}}">
                <i class="fas fa-envelope text-warning ml-2"></i>
              </a> 
            </p>
          </div>
        </div>
      </div>
      <div class="col p-0 mt-2 mb-2"><hr class="dashed-bdr-t mb-1"></div>
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
     
      <!-- <div class="row mt-4 mb-4 m-0">
        <div class="col-md-12 text-center">
          <img src="{{url('images/top-banner-728x90-2.jpg')}}" class="img-fluid">
        </div>
      </div> -->
        
    </div>
    {!! PaginateRoute::renderHtml($searchArticles) !!}
    @endif

  </div>
  <!--left-part-->

  @include('partials.rightsidebar')
</div><!--center-part-->



</div>
<!--middle-body-->


@endsection           