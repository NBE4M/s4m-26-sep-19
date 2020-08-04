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
   
    <nav aria-label="breadcrumb" class="mob-mt-15">
      <small> 
        <ol class="breadcrumb bg-white text-warning p-0">
          <li class="breadcrumb-item"><a href="{{url('/')}}">होम</a></li>
          
          <li class="breadcrumb-item"><a href="{{url(Request::path())}}">{{ $section }}</a></li>
          
          <!-- <li class="breadcrumb-item active">News</li> -->
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
        <span style="background: black;padding: 2px 10px 0px 10px; color: white;border-radius: 10px 0px 0px 0px;">{{ $section  }} न्यूज़
        </span>
      </h1>

    
    @if(isset($sectionArticles))  
    <div class="row m-0">
      @foreach($sectionArticles as $key=>$sA)
      <div class="row m-0">
        <div class="col p-0 mb-2">
          <h2 class="story-page-hed2 mt-2 red-bdr-l border-dark" >
            <a href="{{$sA->url}}">{{$sA->title}}</a>
          </h2>
        </div>
        <div class="row m-0">
          <div class="col-lg-4 col-md-12 p-0">
            <a href="{{$sA->url}}">
              @if($sA->phototitle != null)
              <img class="img-fluid img-thumbnail" src="{{Config::get('constants.storagepath')}}{{$sA->photopath}}" alt="{{$sA->phototitle}}" title="{{$sA->phototitle}}" onerror="this.onerror=null;this.src='images/new-2.jpg';">
              @else
              <img class="img-fluid img-thumbnail" src="{{Config::get('constants.storagepath')}}{{$sA->photopath}}" alt="Samachar4media" title="Samachar4media" onerror="this.onerror=null;this.src='images/new-2.jpg';">
              @endif
            </a>
          </div>
          <div class="col-lg-8 col-md-12 mob-p-0 mob-pt-10">
            <h3 class="mb-2 section-text">{{$sA->summary}}
            </h3>
            <p class="date font-weight-bold text-muted mb-0 mt-0"> <i class="fas fa-user mr-1"></i> 
              <a href="{{url('author').'/'.str_replace(' ','-',preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $sA->authorname)).'-'.$sA->author_id}}">@if($sA->authorname != 'Samachar4media Bureau' || !isset($sA->authorname)){{$sA->authorname}}@else समाचार4मीडिया ब्यूरो ।।@endif </a> <i class="far fa-clock ml-2 mr-1"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $sA->pickdate)->diffForHumans()}} 
            </p>
            <p class="mt-3">
              <a class="common-share facebook" id="{{$sA->url}}" data-title="{{$sA->title}}">
                <i class="fab fa-facebook-f text-warning"></i>
              </a> 
              <a class="common-share twitter" id="{{$sA->url}}" data-title="{{$sA->title}}">
                <i class="fab fa-twitter text-warning ml-2"></i>
              </a> 
              <a class="common-share linkedin" id="{{$sA->url}}" data-title="{{$sA->title}}">
                <i class="fab fa-linkedin-in text-warning ml-2"></i>
              </a> 
              <a class="common-share whatsup" id="{{$sA->url}}" data-title="{{$sA->title}}">
                <i class="fab fa-whatsapp text-warning ml-2"></i>
              </a> 
              <a class="common-share mail" id="{{$sA->url}}" data-title="{{$sA->title}}">
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
              
    </div>
    @endif
    {!! PaginateRoute::renderHtml($sectionArticles) !!}        
  </div>
  <!--left-part-->
  @include('partials.rightsidebar')
</div><!--center-part-->



</div>
<!--middle-body-->
<!--main div end here-->
  
 <script type="application/ld+json">
   {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList", "itemListElement":
    [{ "@type": "ListItem", "position": "1",
    "item": { "@id": " {{url('/')}} ", "name": "Home" } }
    ,{ "@type": "ListItem", "position": "2",
    "item": { "@id": "{{url(Request::path())}}",
    "name": "{{ $section }}"
    } }] }
</script>

<script type="application/ld+json">
{
 "@context": "https://schema.org",
 "@type": "WebPage",
 "name": "{{ $section }}",
 "description": "{{$metadescription}}",
 "url" : "{{url(Request::path())}}",
 "publisher": {
     "@type": "Organization",
     "name": "Samachar4media",
     "url" : "{{url(Request::path())}}",
     "logo" : {
             "@type": "ImageObject",
         "contentUrl": "{{url('images/logo.png')}}"
     }
 }
}
</script>
@endsection           