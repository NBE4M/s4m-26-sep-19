@extends('partials.app')
@section('content')
<!--middle-body-->
<div class="container mt-65 mb-4 mob-mt-75">		
	<!--center-part-->
	<div class="row mob-p-0 mob-m-0">	
		<!--left-part-->
		<div class="col-md-7 col-lg-9 dashed-bdr-r mob-bdr-0 mob-p-0 pl-md-0 pl-lg-3">		
			<nav aria-label="breadcrumb">
				<small> 
					<ol class="breadcrumb bg-white text-warning p-0">
						<li class="breadcrumb-item">
							<a href="{{url('/')}}">होम</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{Request::url()}}">पोल्स</a>
						</li>
						<!-- <li class="breadcrumb-item active">
							Data
						</li> -->
					</ol>
				</small>
			</nav>	 
			<div class="row m-0">			
				<div class="col">	
					<div class="col-12 p-0 poll-archive pl-3 pr-3 pb-3 pt-2">
						@if($polls)
							
							<h4 class="story-page-hed mt-2 pb-2 border-bottom">
								{{ $polls[0]->question}}								
							</h4>
							
						@endif  
						@if($sum >  0 && isset($poll_answer))
							@foreach($poll_answer as $key)
							<?php $per = round((100/$sum)*$key->vote,2).'%';?>			
							<h6 class="mt-4">{{ $key->answer }} 
								<span class="float-right">{{ $per }}</span>
							</h6>
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width:{{ $per }};" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">

								</div>
							</div>				
							<!-- <h6 class="mt-4">इस कदम के बाद गुणवत्ता में निश्चित रूप से सुधार आएगा
								<span class="float-right">70.5%</span>
							</h6>				
							<div class="progress">
								<div class="progress-bar" role="progressbar" style="width: 70.5%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">

								</div>
							</div> -->
							@endforeach
							@else
								<p class="txt4 bb"><strong>There are no vote</strong></p>
							@endif
						</div>
					<!-- <div class="row m-0">
						<h4 class="story-page-hed mt-2 red-bdr-l border-dark">
							<a href="#">
								@if($polls)
									@foreach($polls as $poll)
										<div class="col-md-12 col-sm-12 col-xs-12">
										<p class="txt4 bb"><strong></strong></p>
									@endforeach
								@endif
							</a>
						</h4>
					</div> -->
				<hr>
				<h1 class="mb-0 top-news-hed">
					<strong>बाकी पोल्स <span class="text-warning">देखें</span>
					</strong></h1>				
				
				<hr>
								<div class="row m-0">
				@if(isset($paginatedItems))
					@foreach($paginatedItems as $k=>$poll)
						
						<div class="col-12 p-0 poll-archive pl-3 pr-3 pb-3 pt-2 mt-3">
							<h4 class="story-page-hed mt-2 pb-2 border-bottom">
								{{ $poll->question}}
							</h4>
							@php 
					        	$pollarch = array();
					            $pollAnswer = DB::table('poll_answer')->where('poll_id', $poll->id)->get();
					            $sumArch = DB::table('poll_answer')->where('poll_id', $poll->id)->sum('vote');       
					            
					            if(count($pollAnswer) > 0 ){
					                $pollarch[$poll->id]['question'] = $poll->question;
					                $pollarch[$poll->id]['sum'] = $sumArch;
					                $pollarch[$poll->id]['anss']  = array();
					                foreach($pollAnswer as $ans)
					                {
					                    $pollarch[$poll->id]['anss'][$ans->id]['answer'] = $ans->answer;
					                    $pollarch[$poll->id]['anss'][$ans->id]['vote'] = $ans->vote;
					                }
					                
					            }
					       
           					@endphp	

							
							@foreach($pollarch[$poll->id]['anss'] as $key)
							 
							 <?php   
							 if($pollarch[$poll->id]['sum'] >0 ){
							 $per = round((100/$pollarch[$poll->id]['sum'])*$key['vote'],2).'%';
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
							
						</div>
						
					@endforeach		
				@endif		
				
			</div>
			<div class="mt-4">{!! PaginateRoute::renderHtml($paginatedItems) !!}</div>
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