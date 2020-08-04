
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
    <li class="breadcrumb-item active" aria-current="page"> Creative-Showcase</li>
  </ol>
</nav>

<!--MAIN FIRST ROW START-->
<div class="col no-padding mt10">
<div class="row">




<!--MIDDLE TOP NEWS START here-->
<div class="col-md-12 col-lg-8 col-xs-12 col-sm-12" id="results">


<div class="row mt-2 no-gutters border-bottom-pnk">
<h5 class="flama text-uppercase mb-0"><kbd><i class="fas fa-play"></i> Watch</kbd> Creative-Showcase</h5>            
                 </div>  
                 
                 
                <div class="row no-gutters mt-4 video"> 
                
                <div class="col pt-3 pb-3 border">
                
                <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                {!! $ArrViewVideo[0]->video_code !!}
                <h4 class="flama-font mt-2">{{$ArrViewVideo[0]->video_title}}</h4>
                <p></p>
                </div>
                
                <div class="col-md-12 col-lg-12 col-sm-12 col-12">        
                <div class="col-md-6 col-lg-6 col-sm-6 col-12 float-left no-padding">
                
  <p class="small date font-weight-bold">exchange4media Group<br>
 @if(Carbon\Carbon::parse($ArrViewVideo[0]->created_at)->diffInWeeks() > 1)
                            {{(new DateTime($ArrViewVideo[0]->created_at))->format('d-F-Y')}} 
                            @else 
                            {{ Carbon\Carbon::parse($ArrViewVideo[0]->created_at)->diffForHumans()}}
                            @endif</p>
 </div>
 
 <div class="col-md-6 col-lg-6 col-sm-6 col-12 float-left no-padding">
 <ul class="list-inline sm no-padding">
          <li class="list-inline-item"><button type="button" class="btn btn-facebook social-share facebook"><i class="fab fa-facebook-f"></i> Share</button></li>
<li class="list-inline-item"><button type="button" class="btn btn-info social-share twitter"><i class="fab fa-twitter"></i> Tweet</button></li>
<li class="list-inline-item"><button type="button" class="btn btn-linkedin social-share linkedin"><i class="fab fa-linkedin-in"></i> Share</button></li>
<li class="list-inline-item"><button type="button" class="btn btn-success social-share whatsup"><i class="fab fa-whatsapp"></i> Share</button></li>
<li class="list-inline-item"><button type="button" class="btn btn-secondary social-share mail"><i class="fas fa-envelope"></i> Mail</button></li>
        </ul>
 </div>
                </div>
                </div>
                </div>
<div class="row mt-5">      
<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
<h5 class="panel-title flama text-uppercase tabm"><span class="txt-title">Creative-Showcase <span class="pnk">VIDEO</span></span></h5>
</div>
</div>


@foreach($ArrlistingVideos  as $Photos)
<div class="col-md-12 col-lg-12 media pt-3 pb-3 category border-bottom"> <a href="{{url('')}}/creative-showcase/{{str_slug($Photos->video_title)}}-{{$Photos->id}}.html" class="position-relative d-block"><img src="{{Config::get('constants.SiteCmsurl')}}{{Config::get('constants.awvideothumb')}}{{$Photos->video_thumb_name}}" class="img-fluid mr-3"><div class="vdthmb"><i class="fas fa-play"></i></div></a><div class="box media-body row no-gutters"><h6 class="flama-font pb-1 mb-0 lh-150"> <a href="{{url('')}}/creative-showcase/{{str_slug($Photos->video_title)}}-{{$Photos->id}}.html">{{$Photos->video_title}}</a></h6>
    <p class="date"><i class="fas fa-user"></i> <a href="#" >exchange4media Staff</a>   <a href="#" >   <i class="far fa-clock"></i> @if(Carbon\Carbon::parse($Photos->created_at)->diffInWeeks() > 1)
                            {{(new DateTime($Photos->created_at))->format('d-F-Y')}} 
                            @else 
                            {{ Carbon\Carbon::parse($Photos->created_at)->diffForHumans()}}
                            @endif</a></p>
                <div class="col-md-12 col-lg-12 float-left no-padding font25 mt-3"><ul class="social-list float-left"><li><i class="fas fa-share-square"></i></li><li><a href="https://www.facebook.com/sharer.php?u={{url('')}}/creative-showcase/{{str_slug($Photos->video_title)}}-{{$Photos->id}}.html&utm_source=desktop&utm_medium=facebook&utm_campaign=facebook&utm_term=facebook&utm_content=facebook"
target="_blank"><i class="fab fa-facebook-f"></i></a></li><li> <a href="https://twitter.com/intent/tweet?url={{url('')}}/creative-showcase/{{str_slug($Photos->video_title)}}-{{$Photos->id}}.html&text={{$Photos->video_title}}
&via=e4mtweets&utm_source=desktop&utm_medium=twitter&utm_campaign=twitter&utm_term=twitter&utm_content=twitter"
target="_blank"><i class="fab fa-twitter"></i></a></li><li> <a href="https://www.linkedin.com/shareArticle?mini=true
&url={{url('')}}/creative-showcase/{{str_slug($Photos->video_title)}}-{{$Photos->id}}.html
&title={{$Photos->video_title}}
&summary={{$Photos->video_title}}
&source=exchange4media.com&utm_source=desktop&utm_medium=linkedin&utm_campaign=linkedin&utm_term=linkedin&utm_content=linkedin"
target="_blank"><i class="fab fa-linkedin-in"></i></a></li><li> <a href="https://api.whatsapp.com/send?text={{$Photos->video_title}}{{url('')}}/creative-showcase/{{str_slug($Photos->video_title)}}-{{$Photos->id}}.html&utm_source=desktop&utm_medium=whatsapp&utm_campaign=whatsapp&utm_term=whatsapp&utm_content=whatsapp"
target="_blank"><i class="fab fa-whatsapp"></i></a></li><li> <a href="mailto:?subject={{$Photos->video_title}}- exchange4media&body=Hi,%0A
 I thought you'd like this:%0A%0A
{{url('')}}/creative-showcase/{{str_slug($Photos->video_title)}}-{{$Photos->id}}.html&utm_source=desktop&utm_medium=email&utm_campaign=email&utm_term=email&utm_content=email"
target="_blank"><i class="fas fa-envelope"></i></a></li></ul><span class="morebtn float-right"> <a href="{{url('')}}/creative-showcase/{{str_slug($Photos->video_title)}}-{{$Photos->id}}.html" class="btn btn-dark btn-sm"><i class="far fa-image"></i> View Video</a></span></div></div></div>@endforeach


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
