@extends('layouts/master')

@section('title', 'Report - E4MCMS')


@section('content')

    <div class="panel" style="left: 33px;width: 365px;">
        <div class="panel-content filler">
            <div class="panel-logo"></div>
            <div class="panel-header">
                <h1><small></small></h1>
            </div>
            
            <div class="panel-search container-fluid">
               
            </div>



           
            <br><br>
            <div class="panel-header">
        
            </div>
           
            <div class="sidebarMenuHolder">
                <div class="JStree">
                    <div class="Jstree_shadow_top"></div>
                    <div id="jstree"></div>
                    <div class="Jstree_shadow_bottom"></div>
                </div>
            </div>    </div>
        <div class="panel-slider">
            <div class="panel-slider-center">
                <div class="panel-slider-arrow"></div>
            </div>
        </div>
    </div>
    <div class="main-content">
        <div class="breadcrumb-container">
            <ul class="xbreadcrumbs">
                <li>
                    <a href="/dashboard">
                        <i class="icon-photon home"></i>
                    </a>
                </li>
             
            </ul>

        </div>           <header>
            <i class="icon-big-notepad"></i>
            <h2><small>Report</small></h2>
        </header>
         <div class="span3">
                <div class="controls">
                    <select name="authortypeselect" id="authortypeselect" class="form-control">
                        <option value="">Please Select</option>
                        @foreach($postAs as $postas1)
                        <option value="{{ $postas1->author_type_id }}">{{ $postas1->label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
             <div class="span3">
                <div class="controls">
                    <select name="authortype" id="simpleSelectAuthor" class="form-control">
                        <option selected value="">Please Select</option>
                    </select>
                </div>
            </div>
            <div class="span3">
                <div class="controls">
                  <input id="startDate" name="startDate" placeholder="Start Date" type="date" class="form-control startDate" />
                </div>
            </div>
            <div class="span3">
              Total News-<span id="count">0</span>
            </div>
            <div class="span3">
             <button class="btn btn-success btnExport">Export to excel</button>
            </div>
             <div class="span3">
                <div class="controls">
                    <input id="endDate" name="endDate" type="date" placeholder="End Date" class="form-control" />
                </div>
            </div>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12 dvData" style="    overflow-y: scroll;
    height: 500px;">
                        <table class="table table-striped" id="tableSortable">
                            <thead>
                            <tr>
                                <th>Article ID</th>
                                <th>Title</th>
                                <th>Created By</th>
                                <th>Date,Time</th>
                                <th>Urls</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--Sortable Non-responsive Table end-->
                <div class="dataTables_paginate paging_bootstrap pagination">

                  
                </div>
            </div><!-- end container -->
    </div>

<script type="text/javascript">
 $("#simpleSelectAuthor").live("change", function() {
$value=$("#simpleSelectAuthor").val(),
$type='',
$.ajax({
type : 'GET',
url : '{{URL::to('reporteditorsearch')}}',
data:{'search':$value,'type':$type},
success:function(data){
    var count = $('tbody').html(data).find('tr').length;
    $('#count').text(count);
$('tbody').html(data);
}
});

})
</script>

<script type="text/javascript">

$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

</script>
<script type="text/javascript">
$("#authortypeselect").live("change", function() {
$value=$("#authortypeselect").val(),
$type='user_type',
$.ajax({
type : 'GET',
url : '{{URL::to('reporteditorsearch')}}',
data:{'search':$value,'type':$type},
success:function(data){
$("#simpleSelectAuthor").find("option:not(:first)").remove();
$('#simpleSelectAuthor').append(data);
}
});

})
</script>
<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

<script type="text/javascript">
   $("#endDate").live("change", function() {
$value=$("#simpleSelectAuthor").val(),
$type='',
$sdate = $("#startDate").val();
$enddate = $("#endDate").val();
$.ajax({
type : 'GET',
url : '{{URL::to('reporteditorsearch')}}',
data:{'search':$value,'type':$type,'sdate':$sdate,'enddate':$enddate},
success:function(data){
     var count = $('tbody').html(data).find('tr').length;
    $('#count').text(count);
$('tbody').html(data);
}
});

})
</script>
 <script type="text/javascript">
     $(".btnExport").click(function (e) {
      
       window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('.dvData').html()));
       e.preventDefault();
   });
   </script>
@stop