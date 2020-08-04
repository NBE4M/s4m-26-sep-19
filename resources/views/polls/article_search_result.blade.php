@if(!empty($article_list))

		@if(count($article_list)>0)

					<div class="box-title text-center">

						&nbsp;

					</div>


<script>
		// $('#Sorttbody').sortable();


$().ready(function(){


var siteRoot ='http://cms.samachar4media.com';
	var tbl=$('#tbl').val();

	$('#sortable').sortable({
		
		 
        //console.log(result.json); 
		 //$('tbody').sortable({

		stop:function (event ,ui){

			console.log($(this).sortable("toArray"));

			var data=$(this).sortable("toArray");
			

				$.ajax({

				method: "POST",

				url : siteRoot+"/admin/sortitems",

				data:{"sortable":data,"table":tbl} ,

				datatype: "text",

				success : function(data){

				},

				error: function(data){

					alert('something went wrong');

				},

				beforeSend:function(xhr){

					xhr.setRequestHeader('X-CSRF-TOKEN', $('#X-CSRF-TOKEN').val());

				}



			});

		}

});

	$('tbody').disableSelection();	

});


</script>


					<div class="box-body">

							<table class="table table-hover dataTable" role="grid">

								<thead>

								<tr>

									<th>#</th>

									<th>Published On</th>

									<th>Image</th>

									<th>Title</th>

									<th>Category</th>

									<th>Published</th>

									<th>Status</th>

									<th>Action</th>

								</tr>
								</thead>
                                   <tbody id="sortable">
								@foreach($article_list as $key)

									<tr id="{{$key->id}}">

										<td><span class="glyphicon glyphicon-align-justify"></td>

										<td>{{$key->publish_date}}</td>

										<td><img src="http://cms.samachar4media.com/images_gallery/thumb_images/{{$key->image_thumb}}" height="40px" width="40px"  /></td>

										<td>{{$key->title}}</td>

										<td>{{$key->category}}</td>

										<td>

											@if($key->publish_status==1)

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

										<td><a href="http://cms.samachar4media.com/admin/EditArticle/{{$key->id}}/edit" >Edit</a></td>

									</tr>

								@endforeach

								</tbody>

							</table>

					</div>

					@if($article_list->hasMorePages() && $article_list->lastPage())

					<div class="box-header">

						<h3 class="box-title"></h3>

						<div class="box-tools">

			                <ul class="pagination pagination-sm no-margin pull-right">

			                  <li> {{ $article_list->links() }}</li>

			                </ul>

	             	    </div>

	             	</div>

	             	@endif

				@else

						<br/>

						<div class="box-title text-center">

							No Data Found!<hr/>

						</div>

				@endif



		@else

			<div class="box-title text-center">

					&nbsp;

			</div>

			<div class="box-title text-center">

					No Data Found!<hr/>

			</div>

			



@endif