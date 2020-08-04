@extends('partials.app')
@section('content')

  <!--middle-body-->
  <div class="container mt-65 mb-4 mob-mt-75">
    
    <!--center-part--><div class="row mob-p-0 mob-m-0">
  
    <!--left-part--><div class="col-md-7 col-lg-9 dashed-bdr-r mob-bdr-0 mob-p-0 pl-md-0 pl-lg-3 rightSidebar" >
    <div class="theiaStickySidebar">
    
    <nav aria-label="breadcrumb">
 <small> <ol class="breadcrumb bg-white text-warning p-0">
    <li class="breadcrumb-item"><a href="{{url('/')}}">होम</a></li>
    <li class="breadcrumb-item"><a href="{{url('tags.html')}}">टैग्स</a></li>
    <!-- <li class="breadcrumb-item active">Data</li> -->
  </ol></small>
</nav>
    
    
    <div class="row m-0 tagspage">

<ul class="nav nav-pills mb-3 tags-d-block" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link page-link active" id="pills-home-tab" data-toggle="pill" href="#TRD" role="tab" aria-controls="pills-home" aria-selected="true">Trends</a>
  </li>
  <li class="nav-item">
    <a class="nav-link page-link" id="pills-home-tab" data-id="A" data-toggle="pill" href="#A" role="tab" aria-controls="pills-home" aria-selected="true">A</a>
  </li>
  <li class="nav-item">
    <a class="nav-link page-link" id="pills-profile-tab" data-id="B" data-toggle="pill" href="#B" role="tab" aria-controls="pills-profile" aria-selected="false">B</a>
  </li>
  <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="C" data-toggle="pill" href="#C" role="tab" aria-controls="pills-contact" aria-selected="false">C</a>
  </li>
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="D" data-toggle="pill" href="#D" role="tab" aria-controls="pills-contact" aria-selected="false">D</a>
  </li>
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="E" data-toggle="pill" href="#E" role="tab" aria-controls="pills-contact" aria-selected="false">E</a>
  </li>
        <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-id="F" data-toggle="pill" href="#F" role="tab" aria-controls="pills-contact" aria-selected="false">F</a>
  </li>
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="G" data-toggle="pill" href="#G" role="tab" aria-controls="pills-contact" aria-selected="false">G</a></li>
        
        <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-id="H" data-toggle="pill" href="#H" role="tab" aria-controls="pills-contact" aria-selected="false">H</a></li>
        
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="I" data-toggle="pill" href="#I" role="tab" aria-controls="pills-contact" aria-selected="false">G</a></li>
        
        
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="J" data-toggle="pill" href="#J" role="tab" aria-controls="pills-contact" aria-selected="false">J</a></li>
        
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="K" data-toggle="pill" href="#K" role="tab" aria-controls="pills-contact" aria-selected="false">K</a></li>
        
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="L" data-toggle="pill" href="#L" role="tab" aria-controls="pills-contact" aria-selected="false">L</a></li>
        
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="M" data-toggle="pill" href="#M" role="tab" aria-controls="pills-contact" aria-selected="false">M</a></li>
        
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="N" data-toggle="pill" href="#N" role="tab" aria-controls="pills-contact" aria-selected="false">N</a></li>
        
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="O" data-toggle="pill" href="#O" role="tab" aria-controls="pills-contact" aria-selected="false">O</a></li>
        
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="P" data-toggle="pill" href="#P" role="tab" aria-controls="pills-contact" aria-selected="false">P</a></li>
        
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="Q" data-toggle="pill" href="#Q" role="tab" aria-controls="pills-contact" aria-selected="false">Q</a></li>
        
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="R" data-toggle="pill" href="#R" role="tab" aria-controls="pills-contact" aria-selected="false">R</a></li>
        
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="S" data-toggle="pill" href="#S" role="tab" aria-controls="pills-contact" aria-selected="false">S</a></li>
        
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="T" data-toggle="pill" href="#T" role="tab" aria-controls="pills-contact" aria-selected="false">T</a></li>
        
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="U" data-toggle="pill" href="#U" role="tab" aria-controls="pills-contact" aria-selected="false">U</a></li>
        
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="V" data-toggle="pill" href="#V" role="tab" aria-controls="pills-contact" aria-selected="false">V</a></li>
        
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="W" data-toggle="pill" href="#W" role="tab" aria-controls="pills-contact" aria-selected="false">W</a></li>
        
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="X" data-toggle="pill" href="#X" role="tab" aria-controls="pills-contact" aria-selected="false">X</a></li>
        
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="Y" data-toggle="pill" href="#Y" role="tab" aria-controls="pills-contact" aria-selected="false">Y</a></li>
        
        <li class="nav-item">
    <a class="nav-link page-link" id="pills-contact-tab" data-id="Z" data-toggle="pill" href="#Z" role="tab" aria-controls="pills-contact" aria-selected="false">Z</a></li>
</ul>
<div class="tab-content p-0" id="pills-tabContent" style="width: 100%;">

  <div class="tab-pane fade show active" id="TRD" role="tabpanel" aria-labelledby="pills-home-tab"><h2 class="bg-warning text-center rounded "><span id="tagss">Trending Topics</span></h2>
    <div class="tab-pane fade show " id="resulthide">
    @foreach($tagshash as $tag)
      <a href="{{url('tags')}}/{{str_replace(' ','-',trim($tag->tag))}}" ><button type="button" class="btn tags-btn btn-sm">  {{$tag->tag}}</button>
      </a>
    @endforeach
    </div>
    <div class="tab-pane fade show " id="result">

 </div>
  </div>
 
</div>
    
    </div>
    
<hr class="mt-4 bdr">
    

    </div>
    
    </div><!--left-part-->
@include('partials.rightsidebar')
    </div><!--center-part-->
    

  
  </div>
  <!--middle-body-->
  
@endsection      