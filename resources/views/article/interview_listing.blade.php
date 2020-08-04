@extends('partials.app')

@section('content')
<!--main div start here-->

<!--middle-body-->
<div class="container mt-65 mb-4 mob-mt-75">
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
<!--center-part-->
<div class="row mob-p-0 mob-m-0">
  <!--left-part-->
  <div class="col-md-7 col-lg-9 dashed-bdr-r mob-bdr-0 mob-p-0 pl-md-0 pl-lg-3">
    <nav aria-label="breadcrumb">
      <small> 
        <ol class="breadcrumb bg-white text-warning p-0">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
          @php $a = explode('.',Request::path()); @endphp
          @for($p=0;$p < 1 ; $p++)
          <li class="breadcrumb-item"><a href="{{Request::url()}}">{{ $a[$p] }}</a></li>
          @endfor
          <li class="breadcrumb-item active">News</li>
        </ol>
      </small>
    </nav>

    @if(isset($TagArticleList))  
    <div class="row m-0">
      @foreach($TagArticleList as $k=>$ala)
      <div class="row m-0">
        <div class="col p-0 mb-2">
          <h4 class="story-page-hed mt-2 red-bdr-l border-dark">
            <a href="{{$ala->url}}">{{$ala->title}}</a>
          </h4>
        </div>
        <div class="row m-0">
          <div class="col-lg-4 col-md-12 p-0">
            <a href="{{$ala->url}}">
              <img class="img-fluid img-thumbnail" src="{{Config::get('constants.storagepath')}}{{$ala->photopath}}" alt="{{$ala->phototitle}}" onerror="this.onerror=null;this.src='images/new-2.jpg';">
            </a>
          </div>
          <div class="col-lg-8 col-md-12 mob-p-0 mob-pt-10">
            <p class="mb-2">{{$ala->summary}}
            </p>
            <p class="date font-weight-bold text-muted mb-0 mt-0"> <i class="fas fa-user mr-1"></i> 
              <a href="#"> {{$ala->authorname}}</a> <i class="far fa-clock ml-2 mr-1"></i> <a href="#">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ala->pickdate)->diffForHumans()}} </a>
            </p>
            <p class="mt-3">
              <a class="common-share facebook" id="{{$ala->url}}" data-title="{{$ala->title}}">
                <i class="fab fa-facebook-f text-warning"></i>
              </a> 
              <a class="common-share twitter" id="{{$ala->url}}" data-title="{{$ala->title}}">
                <i class="fab fa-twitter text-warning ml-2"></i>
              </a> 
              <a class="common-share linkedin" id="{{$ala->url}}" data-title="{{$ala->title}}">
                <i class="fab fa-linkedin-in text-warning ml-2"></i>
              </a> 
              <a class="common-share whatsup" id="{{$ala->url}}" data-title="{{$ala->title}}">
                <i class="fab fa-whatsapp text-warning ml-2"></i>
              </a> 
              <a class="common-share mail" id="{{$ala->url}}" data-title="{{$ala->title}}">
                <i class="fas fa-envelope text-warning ml-2"></i>
              </a> 
            </p>
          </div>
        </div>
      </div>
      <div class="col p-0 mt-2 mb-2"><hr class="dashed-bdr-t mb-1"></div>
      @if($k == 2 || $k == 4)
      <div class="row mt-4 mb-4 m-0">
        <div class="col-md-12 text-center">
          <img src="{{url('images/top-banner-728x90-2.jpg')}}" class="img-fluid">
        </div>
      </div>
      @endif
      @endforeach             
      <div class="row mt-4 mb-4 m-0">
        <div class="col-md-12 text-center">
          <img src="{{url('images/top-banner-728x90-2.jpg')}}" class="img-fluid">
        </div>
      </div>

       
    </div>
    @endif 
    {!! PaginateRoute::renderHtml($TagArticleList) !!}       
  </div>
  
  <!--left-part-->
 @include('partials.rightsidebar')
</div><!--center-part-->



</div>
<!--middle-body-->
<!--main div end here-->

<!--  <script type="application/ld+json">
   {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList", "itemListElement":
    [{ "@type": "ListItem", "position": "1",
    "item": { "@id": " {{Request::url()}} ", "name": "Home" } }
    ,{ "@type": "ListItem", "position": "2",
    "item": { "@id": "{{Request::url()}}",
    "name": "{{Request::url()}}-news"
    } }] }
</script>

<script type="application/ld+json">
{
 "@context": "https://schema.org",
 "@type": "WebPage",
 "name": "{{Request::url()}}-news",
 "description": "{{Request::url()}}",
 "url" : "{{Request::url()}}",
 "publisher": {
     "@type": "Organization",
     "name": "Exchange4media",
     "url" : "Request::url()",
     "logo" : {
             "@type": "ImageObject",
         "contentUrl": "Request::url()"
     }
 }
}
</script> -->
@endsection           