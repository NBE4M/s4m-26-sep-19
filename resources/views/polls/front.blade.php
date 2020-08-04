@extends('admin/master')

@section('content')

<div class="container-fluid">

	<div class="row">

		<div class="col-md-12 col-xs-12 text-right">

		</div>

	</div>

	<div class="row">

		 

		 
<div class="col-md-3 col-sm-3 col-xs-12">
<div class="row border1">
<div class="col-md-12 col-sm-12 col-xs-12 bgorange">
 
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
{!!Form::label('msg',Session::get('successpollmessage'),['class'=>'success'])!!}
<p class="txt4 bb"><strong>{{ $polls->title}} </strong></p>
</div> 
<form action="{{route('admin.polldesign.store')}}" method="post">
{{csrf_field()}}
<input type="hidden" name="poll_id" id="poll_id" value="{{$polls->id}}"/>
<div class="col-md-12 col-sm-12 col-xs-12">
@foreach($poll_answer as $key)
<p class="bb2"><input name="votes" value="{{ $key->id }}"  type="radio"> {{ $key->answer }}</p>
 
@endforeach
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
<input type="submit" name="vote" value="VOTE" class="pull-left mbtn">
<a href="{{url('admin/pollresult/'.$polls->id)}}" class="pull-right mbtn">View Results</a>
</div>
</form>
<div class="col-md-12 col-sm-12 col-xs-12">
<p class="text-center txt2"><a href="{{url('admin/pollresult/'.$polls->id)}}">Polls Archive</a></p>
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

					url:'/searchArticleBydate',

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