
@extends('partials.app')
@section('content')
<!--main div start here-->
<main role="main">
<div class="container bw">
   <div class="leftgate"> @if(isset($parents[7])) @if($parents[7]->status==1){!!$parents[7]->bscript!!}@else @endif @endif</div>
    <div class="rightgate">@if(isset($parents[6]))  @if($parents[6]->status==1){!!$parents[6]->bscript!!}@else @endif @endif</div>
<div class="col no-padding p10 text-center">
@if(isset($parents[4])) @if($parents[4]->status==1){!!$parents[4]->bscript!!}@else @endif @endif
</div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Creative-Showcase</li>
  </ol>
</nav>

<!--MAIN FIRST ROW START-->
<div class="col no-padding mt10">
<div class="row">
<!--MIDDLE TOP NEWS START here-->
<div class="col-md-12 col-lg-8 col-xs-12 col-sm-12">

<div class="row mt-2 no-gutters border-bottom-pnk">
<h5 class="flama text-uppercase mb-0"><kbd><i class="fas fa-play"></i>Creative-Showcase</kbd>   Gallery</h5>            
                 </div>       
                     
  <div class="row mt-2 mb-3 video" id="results">
    @foreach($ArrlistingVideos  as $video)
   <div class="col-md-6 col-lg-6 col-sm-6 col-12 mt-4"><a href="{{url('')}}/creative-showcase/{{str_slug($video->video_title)}}-{{$video->id}}.html">
        <div class="col-lg-12 col-12 no-padding">
        <img src="{{Config::get('constants.SiteCmsurl')}}{{Config::get('constants.awvideothumb')}}{{$video->video_thumb_name}}" class="img-fluid"><div class="vdthmb"><i class="fas fa-play"></i></div></div>

        <h6 class="flama-font mt-2"> {{$video->video_title}}</h6><p class="small date  font-weight-bold">exchange4media Group<br>@if(Carbon\Carbon::parse($video->created_at)->diffInWeeks() > 1)
                            {{(new DateTime($video->created_at))->format('d-F-Y')}} 
                            @else 
                            {{ Carbon\Carbon::parse($video->created_at)->diffForHumans()}}
                            @endif</p></a></div>@endforeach


       

  </div>

   {!! $ArrlistingVideos->render()!!}
</div>
<!--MIDDLE TOP NEWS END here-->

<!--RIGHT SIDE EDITOR'S PICK START here-->
@include('partials.rightsidebar')
<!--RIGHT SIDE EDITOR'S PICK END here-->
</div>
</div>
<!--MAIN FIRST ROW END-->
</div>
</main>
<!--main div end here-->


@endsection           
