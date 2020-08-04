@extends('admin/master')

@section('content')

<div class="container-fluid">

	<div class="row">

		<div class="col-md-12 col-xs-12 text-right">

		</div>

	</div>

	<div class="row">

		 <?php //echo '<pre>';print_r($_SERVER);echo '</pre>';?>

		 
<div class="col-md-3 col-sm-3 col-xs-12">
<div class="row border1">
<div class="col-md-12 col-sm-12 col-xs-12 bgorange">
 
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
<p class="txt4 bb"><strong>{{ $polls[0]->title}}</strong></p>
</div> 
 
 
<div class="col-md-12 col-sm-12 col-xs-12">
@foreach($poll_answer as $key)
<?php $per = round((100/$total_poll_answer)*$key->vote,2).'%';?>
<p class="bb2">  {{ $key->answer }} {{ $per }} 
 

<div class="yop-poll-results-bar-4_yp58be4cc826558" style="background: #555;display: block;height: 15px;">
<div><div style="width:{{ $per }}; height:15px; background-color:#d1ddff; border-style:solid; border-width:2px; border-color:#0cbff9; " id="yop-poll-result-bar-div-14" class="yop-poll-result-bar-div-4_yp58be4cc826558"></div></div>
</div>
</p>
 
@endforeach
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
 
<a href="{{url('admin/pollresult/'.$polls[0]->id)}}" class="pull-right mbtn">View All Poll Results</a>
</div>
</form>
<div class="col-md-12 col-sm-12 col-xs-12">
<p class="text-center txt2"><a href="{{url('admin/pollresult/'.$polls[0]->id)}}">Polls Archive</a></p>
</div>
</div>
</div>
  

		<div class="col-md-12 col-xs-12 text-right">

					<?php /* ?>{!!Form::button('Review Homepage',['class'=>'btn btn-primary btn-flat'])!!} <?php */ ?>

					<!--<button class="btn btn-primary btn-md btn-flat" id='addarticle' onclick="window.location='/admin/article/create'">Add Article</button>-->


                

					

		</div>

	</div>

	<input type="hidden" value="{{ csrf_token() }}"" id="X-CSRF-TOKEN"/>

<?php /* ?>	<input type="hidden" value={{$tbl}} id="tbl"/><?php */?>
	<input type="hidden" value=""  id="tbl"/>
	<input value="ArticleCategorySort" id="sorttable" type="hidden">
<?php //echo count($polls).'----------<pre>';print_r($polls);echo '</pre>'; exit;?>
	<div class="row padTop10px">

		<div class="col-md-12 col-xs-12">
<?php /*?>
			<div class="box" id='article_box'>

				@if(count($polls)>0)

					<div class="box-title text-center">

						&nbsp;

					</div>

					<div class="box-body">

							<table class="table table-hover dataTable" role="grid">

								<thead>

								<tr>

									<th>#</th>

									<th>Published On</th>

									 

									<th>Title</th>

									<th>Question</th>

									<th>Published</th>

									<th>Status</th>

									<th>Action</th>

								</tr>

								</thead>

								<tbody id="sortbody">

								@foreach($polls as $key)

									<tr id="{{$key->id}}">

										<td><span class="glyphicon glyphicon-align-justify"></td>

										<td>{{$key->created_at}}</td>

										 

										<td>{{$key->title}}</td>

										<td>{{$key->question}}</td>

										<td>

											@if($key->status==1)

											{!!Form::button('Unpublish',['class'=>'btn btn-primary btn-flat btn-xs bg-green','data-id'=>$key->id,'data-cval'=>'published','onclick'=>'changPublishState(this);'])!!}

											@else

											{!!Form::button('Publish',['class'=>'btn btn-primary btn-flat btn-xs bg-orange','data-id'=>$key->id,'data-cval'=>'unpublished','onclick'=>'changPublishState(this);'])!!}

											@endif

										</td>

										<td id="status">

										@if(($key->status)==1)

												<span class="greencls" id="{{$key->id}}"  value='{{$key->status}}' onClick="UpdateStatus(this)">Active</span>

										@else

												<span class="redcls" id="{{$key->id}}" value='{{$key->status}}' onClick="UpdateStatus(this)">Inactive</span>

										@endif

										<input type="hidden" value="{{$key->id}}"/>

										</td>

										<td><a href="http://localhost/s4mcms/public/admin/polls/{{$key->id}}/edit" >Edit</a></td>

									</tr>

								@endforeach

								</tbody>

							</table>

					</div>

				 

				@else

						<br/>

						<div class="box-title text-center">

							No Data Found!<hr/>

						</div>

				@endif <?php */ ?>

		</div>

	</div>

	
	
	
	


	<script type="text/javascript">

		$('document').ready(function(){

		   
			$('#searchDate').datepicker({format: 'M d, yyyy'}).on('select',function(e){

					

				$.ajax({

					type:'POST',

					url:'/admin/searchArticleBydate',

					data:{'search_Date':$('#searchDate').val()},

					datatype:'text',

					success: function(data){

						$('#article_box').empty().html(data);

					},

					error:function(err){



					},

					beforeSend:function(xhr){

						xhr.setRequestHeader('X-CSRF-TOKEN',$('#X-CSRF-TOKEN').val());

					}

				});



			});





			$('#search_Category').on('change',function(e){
			var siteRoot ='http://cms.samachar4media.com';
					

				$.ajax({

					type:'POST',

					url:'/admin/searchArticleByCategory',

					data:{'searchCategory':$('#search_Category').val(),'search_Date':$('#searchDate').val()},

					datatype:'text',

					success: function(data){

						$('#article_box').empty().html(data);

					},

					error:function(err){



					},

					beforeSend:function(xhr){

						xhr.setRequestHeader('X-CSRF-TOKEN',$('#X-CSRF-TOKEN').val());

					}

				});



			});



		});



	</script>

@endsection