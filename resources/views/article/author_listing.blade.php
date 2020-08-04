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
    <div class="col-md-7 col-lg-9 dashed-bdr-r mob-bdr-0 mob-p-0 pl-md-0 pl-lg-3 rightSidebar">    
      <div class="theiaStickySidebar">    
             
        <nav aria-label="breadcrumb">
         <small> <ol class="breadcrumb bg-white text-warning p-0">
          <li class="breadcrumb-item"><a href="{{url('/')}}">होम</a></li>
          @php $a = explode('/',Request::path()); @endphp
                        @for($p=0;$p < 1 ; $p++)
                        <li class="breadcrumb-item"><a href="{{Request::url()}}">पत्रकार</a></li>
                        @endfor
          <!-- <li class="breadcrumb-item active">Data</li> -->
        </ol></small>
      </nav>


      <div class="row m-0 author-bg">

        <div class="col-lg-12 text-center p-0">
          @if($ArrAuthorListing)
            @foreach($ArrAuthorListing as $authList)
              <div class="author-person"> 
                <a href="{{url('author/'.str_replace(' ','-',$authList->name).'-'.$authList->author_id)}}">
                  <img src="{{Config::get('constants.storagepath')}}album/{{$authList->photo}}" width="100%" alt="{{$authList->name}}" onerror="this.onerror=null;this.src='{{asset("images/default_profile_photo.png")}}';">
                </a>
                <h6 class="mt-2">
                  <a href="{{url('author/'.str_slug($authList->name).'-'.$authList->author_id)}}">{{$authList->hindiName}}</a>
                </h6>
              </div>
            @endforeach  
          @endif
        </div>

        {!! PaginateRoute::renderHtml($ArrAuthorListing) !!}



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