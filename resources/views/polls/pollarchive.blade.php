@extends('partials.app')
@section('content')
<!--middle-body-->
<div class="container mt-65 mb-4 mob-mt-75">
	<!--center-part-->
	<div class="row mob-p-0 mob-m-0">
		<!--left-part-->
		<div class="col-md-7 col-lg-9 dashed-bdr-r mob-bdr-0 mob-p-0 pl-md-0 pl-lg-3">		
			<nav aria-label="breadcrumb">
				<small> <ol class="breadcrumb bg-white text-warning p-0">
					<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
					<li class="breadcrumb-item"><a href="#">Library</a></li>
					<li class="breadcrumb-item active">Data</li>
				</ol></small>
			</nav>
			<div class="row m-0">
				@if(isset($polls))
					@foreach($polls as $k=>$poll)
						
						<div class="col-12 p-0 poll-archive pl-3 pr-3 pb-3 pt-2 mt-3">
							<h4 class="story-page-hed mt-2 pb-2 border-bottom">
								{{ $poll['question']}}
							</h4>
							@if(count($poll['anss']) > 0)
							@foreach($poll['anss'] as $key)
							 
							 <?php   
							 if($poll['sum'] >0 ){
							 $per = round((100/$poll['sum'])*$key['vote'],2).'%';
							 }else{
								 $per = '0%';
							 }
							 ?>
							<h6 class="mt-4">{{ $key['answer'] }}
								<span class="float-right">{{ $per }}</span>
							</h6>
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width:{{ $per }};" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">

								</div>
							</div>
							@endforeach
							@endif				
							<!-- <h6 class="mt-4">इस कदम के बाद गुणवत्ता में निश्चित रूप से सुधार आएगा
								<span class="float-right">70.5%</span>
							</h6>				
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: 70.5%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">

								</div>
							</div> -->
						</div>
						
					@endforeach		
				@endif		
				<!-- <div class="col-12 p-0 poll-archive pl-3 pr-3 pb-3 pt-2 mt-4">

					<h4 class="story-page-hed mt-2 pb-2 border-bottom"><a href="#">गुलाब कोठारी ने बताया, क्यों मीडिया लोकतंत्र का चौथा स्तंभ नहीं है...</a></h4>

					<h6 class="mt-4">इस कदम के बाद गुणवत्ता में निश्चित रूप से सुधार आएगा<span class="float-right">89.4%</span></h6>

					<div class="progress">
						<div class="progress-bar" role="progressbar" style="width: 89.4%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
					</div>

					<h6 class="mt-4">इस कदम के बाद गुणवत्ता में निश्चित रूप से सुधार आएगा<span class="float-right">60%</span></h6>

					<div class="progress">
						<div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
					</div>

				</div> -->
			</div>
			<div class="mt-4">{{ $polls->links() }}</div>
		</div>
		<!--left-part-->
		@include('partials.rightsidebar')
	</div><!--center-part-->	
</div>
<!--middle-body-->
@endsection 