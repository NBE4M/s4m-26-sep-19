@extends('partials.app')

@section('content')
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
          
            @if($breaking->news_url == '#')
            
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
               <small> <ol class="breadcrumb bg-white text-warning p-0">
                <li class="breadcrumb-item"><a href="{{url('/')}}">होम</a></li>
                <li class="breadcrumb-item"><a href="{{url('news/author.html')}}">पत्रकार</a></li>
                <li class="breadcrumb-item active">{{$authorbio->hindiName}}</li>
            </ol></small>
            </nav>
            @if(isset($authorbio)) 
            <div class="row mt-4">
                <div class="col-lg-7">
                    <div class="row"> 
                        <div class="col-lg-4 dashed-bdr-r">
                        <img class="img-fluid img-thumbnail rounded-circle" src="{{Config::get('constants.storagepath')}}album/{{$authorbio->photo}}" width="100%" alt="{{$authorbio->name}}" onerror="this.onerror=null;this.src='{{asset("images/s4m-staff.png")}}';">
                        
                    </div>
                    <div class="col-lg-8">
                        <h6 class="text-muted mb-1 mt-3 text-warning">
                            <strong>@if($authorbio->name != 'Samachar4media Bureau' || !isset($authorbio->name)){{$authorbio->name}}@else समाचार4मीडिया ब्यूरो ।।@endif</strong>
                        </h6>
                        <p><small>
                            @if(isset($authorbio->bio))
                            <i class="fas fa-user mr-1"></i> {{$authorbio->bio}}<br>
                            @else
                            <i class="fas fa-user mr-1"></i> समाचार4मीडिया ब्यूरो<br>
                            @endif
                            @if(isset($authorbio->email)  )
                            <i class="fas fa-envelope mr-1"></i> <a href="mailto:{{$authorbio->email}}" class="text-info"> {{$authorbio->email}}</a><br>
                            @endif
                            @if($authorbio->twitter !== "")
                            <i class="fab fa-twitter mr-1"></i> <a href="{{$authorbio->twitter}}" class="text-info">{{$authorbio->twitter}}</a> <br>
                            @endif
                            @if(isset($authorbio->facebook))
                            <i class="fab fa-facebook-f mr-1"></i> <a href="{{$authorbio->facebook}}" class="text-info"> {{$authorbio->facebook}}</a>
                            @endif
                        </small>

                        </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-5">
                    <p class="quotation2">{{$authorbio->bio}}</p>
                </div>

            </div>
            @endif
            <hr class="p-0 mb-4 mt-4 border-warning dashed-bdr-t">

            <div class="row m-0">
                @if($ArrlistingArticles)
                @foreach($ArrlistingArticles as $ala)
                <div class="row m-0">
                    <div class="col p-0 mb-2">
                        <h4 class="story-page-hed mt-2 red-bdr-l border-dark">
                            <a href="{{$ala->url}}">{{$ala->title}}</a>
                        </h4>
                    </div>
                    <div class="row m-0">
                        <div class="col-lg-4 col-md-12 p-0"> 
                            <a href="{{$ala->url}}">
                                <img class="img-fluid img-thumbnail" src="{{Config::get('constants.storagepath')}}{{$ala->photopath}}" width="100%" alt="{{$ala->phototitle}}" title="{{$ala->phototitle}}" onerror="this.onerror=null;this.src='{{asset("images/new-2.jpg")}}';">
                            </a>
                        </div>

                        <div class="col-lg-8 col-md-12 mob-p-0 mob-pt-10">
                            <p class="mb-2">{{$ala->summary}}</p>
                            <p class="date font-weight-bold text-muted mb-0 mt-0"> 
                                <i class="fas fa-user mr-1"></i> 
                                <a href="{{url('author').'/'.str_replace(' ','-',$ala->authorname).'-'.$ala->author_id}}">@if($ala->authorname != 'Samachar4media Bureau' || !isset($ala->authorname)){{$ala->authorname}}@else समाचार4मीडिया ब्यूरो ।।@endif</a> 
                                <i class="far fa-clock ml-2 mr-1"></i> 
                                {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ala->pickdate)->diffForHumans()}}  
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
                @endforeach
                @endif
                <div class="col p-0 mt-2 mb-2">
                    <hr class="dashed-bdr-t mb-1">
                </div>

                @if(isset($parents[4]))  
                  @if($parents[4]->status==1)
                  {!!$parents[4]->bscript!!}
                  @else 
                  @endif 
                @else
              @endif

    </div>
    {!! PaginateRoute::renderHtml($ArrlistingArticles) !!}
</div>
<!--left-part-->
@include('partials.rightsidebar')
</div>
<!--center-part-->    
</div>
<!--middle-body-->
@endsection           