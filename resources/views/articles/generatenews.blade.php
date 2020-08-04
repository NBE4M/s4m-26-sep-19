@extends('admin/master')
@section('content')
<div class="container-fluid">
	<div class="row">
     @if (Session::has('message'))
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="margin-top: 200px;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>{{ Session::get('message') }}</p>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div>
   
@endif
	</div>
		
   
 <script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>
         
         <!-- x-editable (bootstrap version) -->
        <link href="{{URL::asset('plugins/bootstrap-editable/bootstrap-editable.css')}}" rel="stylesheet"/>
        <script src="{{URL::asset('plugins/bootstrap-editable/bootstrap-editable.min.js')}}"></script>
        <!--<script src="{{URL::asset('js/admin/manage_newsletter_module.js')}}" type="text/javascript"></script>--> 
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
@endsection