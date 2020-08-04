 @extends('partials.app')
@section('content')
<style>
	body{background: #ffffff !important;}
</style>
	<!--middle-body-->
	<div class="container mt-65 mb-4 mob-mt-75">


		
		<!--center-part--><div class="row mob-p-0 mob-m-0">
	
		<!--left-part--><div class="col-md-7 col-lg-9 dashed-bdr-r mob-bdr-0 mob-p-0 pl-md-0 pl-lg-3 rightSidebar" >
		<div class="theiaStickySidebar">
		
		<nav aria-label="breadcrumb">
 <small> <ol class="breadcrumb bg-white text-warning p-0">
    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
     @php $a = explode('/',Request::path()); @endphp
    <li class="breadcrumb-item">{{$a[0]}}</li>
    <li class="breadcrumb-item">{{$a[1]}}</li>
  </ol></small>
</nav>
		
		
<div class="row col-md-12 pt-3 ml-0 mr-0 mb-2">
	<div class="col-md-6 text-left mob-text-center"><button id="mrn" class="btn btn-danger rounded btn-md">Morning Newsletter</button></div>
	<div class="col-md-6 text-right mob-text-center"><button id="eve" class="btn btn-danger rounded btn-md">Evening Newsletter</button></div>
</div>	

	
		
<div class="row">
	<div class="col-md-11 m-auto pt-3 replaceNewsletter" style="background: #f7f7f5;">
		
		@if($html != '' || $html != null || $htmlEve != '' || $htmlEve != null)
			<div id="mrnLetter">
				{!! $html !!}
			</div>

			<div id="eveLetter" >
				{!! $htmlEve !!}
			</div>		
		@else
		<center><h2>न्यूज़ लेटर अभी तक नहीं बना है  </h2></center>
		@endif
		<div class="row ml-0 mr-0 mt-3 border-warning bdr-solid-b" style="font-family: 'Russo One', sans-serif;">
		  <h5>Previous Newsletter</h5>
		  </div>
		  <div class="row ml-0 mr-0 bg-white p-2 align-items-center mb-4">
		  	@foreach($pervious as $t)
		  <a class="btn btn-dark btn-md waves-effect waves-light p-2 rounded" href="{{url('newsletter').'/'.date($t->published_date).'/archive.html'}}">
			 <i class="far fa-calendar mr-1"></i>
          <span class="d-none d-lg-inline-block mr-1">{{date($t->published_date)}}</span>          
        </a>
        @endforeach
        <a class="p-2 rounded text-danger seeMore" onclick="dateWiseNewsletter()">			 
          <small><strong>See More...</strong></small>
        </a>
        <p class="datepickerhideshow" style="display: none">Date: <input type="text" id="datepicker">
        <button href="#" class="dateurl">Show
        </button> 
        </p>          
        <!-- <a class="btn btn-dark btn-md waves-effect waves-light p-2 rounded" href="{{url('newsletter').'/'.date('d-m-Y',strtotime('-2 days')).'/archive.html'}}">
			 <i class="far fa-calendar mr-1"></i>
          <span class="d-none d-lg-inline-block mr-1">{{date('d-M-Y',strtotime("-2 days"))}}</span>          
        </a>  <a class="btn btn-dark btn-md waves-effect waves-light p-2 rounded" href="{{url('newsletter').'/'.date('d-m-Y',strtotime('-3 days')).'/archive.html'}}">
			 <i class="far fa-calendar mr-1"></i>
          <span class="d-none d-lg-inline-block mr-1">{{date('d-M-Y',strtotime("-3 days"))}}</span>          
        </a>  <a class="btn btn-dark btn-md waves-effect waves-light p-2 rounded" href="{{url('newsletter').'/'.date('d-m-Y',strtotime('-4 days')).'/archive.html'}}">
			 <i class="far fa-calendar mr-1"></i>
          <span class="d-none d-lg-inline-block mr-1">{{date('d-M-Y',strtotime("-4 days"))}}</span>          
        </a>  <a class="btn btn-dark btn-md waves-effect waves-light p-2 rounded" href="{{url('newsletter').'/'.date('d-m-Y',strtotime('-5 days')).'/archive.html'}}">
			 <i class="far fa-calendar mr-1"></i>
          <span class="d-none d-lg-inline-block mr-1">{{date('d-M-Y',strtotime("-5 days"))}}</span>          
        </a>  <a class="btn btn-dark btn-md waves-effect waves-light p-2 rounded" href="{{url('newsletter').'/'.date('d-m-Y',strtotime('-6 days')).'/archive.html'}}">
			 <i class="far fa-calendar mr-1"></i>
          <span class="d-none d-lg-inline-block mr-1">{{date('d-M-Y',strtotime("-6 days"))}}</span>          
        </a>  <a class="btn btn-dark btn-md waves-effect waves-light p-2 rounded" href="{{url('newsletter').'/'.date('d-m-Y',strtotime('-7 days')).'/archive.html'}}">
			 <i class="far fa-calendar mr-1"></i>
          <span class="d-none d-lg-inline-block mr-1">{{date('d-M-Y',strtotime("-7 days"))}}</span>          
        </a> <a class="btn btn-dark btn-md waves-effect waves-light p-2 rounded" href="{{url('newsletter').'/'.date('d-m-Y',strtotime('-8 days')).'/archive.html'}}">
			 <i class="far fa-calendar mr-1"></i>
          <span class="d-none d-lg-inline-block mr-1">{{date('d-M-Y',strtotime("-8 days"))}}</span>          
        </a>  <a class="btn btn-dark btn-md waves-effect waves-light p-2 rounded" href="{{url('newsletter').'/'.date('d-m-Y',strtotime('-9 days')).'/archive.html'}}">
			 <i class="far fa-calendar mr-1"></i>
          <span class="d-none d-lg-inline-block mr-1">{{date('d-M-Y',strtotime("-9 days"))}}</span>          
        </a>  <a class="btn btn-dark btn-md waves-effect waves-light p-2 rounded" href="{{url('newsletter').'/'.date('d-m-Y',strtotime('-10 days')).'/archive.html'}}">
			 <i class="far fa-calendar mr-1"></i>
          <span class="d-none d-lg-inline-block mr-1">{{date('d-M-Y',strtotime("-10 days"))}}</span>          
        </a> <a class="p-2 rounded text-danger" href="#">
			 
          <small><strong>See More...</strong></small>    
        </a>  -->
		  </div>
	</div>
</div>
		
		</div>
		
		</div><!--left-part-->
		
@include('partials.rightsidebar')
		
	
		</div><!--center-part-->
		

	
	</div>
	<!--middle-body-->

@endsection 