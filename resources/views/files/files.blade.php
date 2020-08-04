@extends('layouts/master')

@section('title', 'Create New Files - S4M')


@section('content')

<div class="panel">
    <div class="panel-content filler">
        <div class="panel-logo"></div>
        <div class="panel-header">
            <h1><small>Create New Files</small></h1>

        </div>

        <div class="panel-header">
 <!--<h1><small>Page Navigation Shortcuts</small></h1>-->
        </div>

        <script type="text/javascript">
            $(function () {
                $("#jstree").jstree({
                    "json_data": {
                        "data": [
                            {
                                "data": {
                                    "title": "Channel",
                                    "attr": {"href": "#Channel"}
                                }
                         },
                            {
                                "data": {
                                    "title": "Files Feature",
                                    "attr": {"href": "#al-feature"}
                                }
                            },
                            {
                                "data": {
                                    "title": "Tags",
                                    "attr": {"href": "#tags"}
                                }
                            }, ]
                    },
                    "plugins": ["themes", "json_data", "ui"]
                })
                        .bind("click.jstree", function (event) {
                            var node = $(event.target).closest("li");
                            document.location.href = node.find('a').attr("href");
                            return false;
                        })
                        .delegate("a", "click", function (event, data) {
                            event.preventDefault();
                        });
            });
        </script>
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
            <li>
                <a href="#">Files &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                <ul class="breadcrumb-sub-nav">
                    <li>
                        <a href="<?php echo url('manageAds/create') ?>">Create New Files</a>
                    </li>
                    <li>
                        <a href="<?php echo url('manageAds/list/deleted') ?>">Published Files</a>
                    </li>
                    <li>
                        <a href="<?php echo url('manageAds/list/deleted') ?>">Deleted Files</a>
                    </li>

                    <li>
                        <a href="#">Reports</a>
                    </li>
                    <li>
                        <a href="#">Help</a>
                    </li>
                </ul>
            </li>
            <li class="current">
                <a href="javascript:;">Create New Files</a>
            </li>
        </ul>
    </div>            <header>
        <i class="icon-big-notepad"></i>
        <h2><small>New Files</small></h2>
    </header>
        <div class="container-fluid"  style="display:none">
        <div class="form-legend" id="Notifications">Notifications</div>
        <!--Notifications begin-->
        <div class="control-group row-fluid" >
            <div class="span12 span-inset">
                <div class="alert alert-success alert-block">
                    <i class="icon-alert icon-alert-info"></i>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>This is Success Notification</strong>
                    <span>Your data has been successfully modified.</span>
                </div>
                <div class="alert alert-block">
                    <i class="icon-alert icon-alert-info"></i>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>This is Alert Notification</strong>
                    <span>No result found.</span>
                </div>
                <div class="alert alert-error alert-block">
                    <i class="icon-alert icon-alert-info"></i>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>This is Error Notification</strong>
                    <span>Please select a valid search criteria.</span>
                </div>

            </div>
        </div>
        <!--Notifications end-->
    </div>
     
   

    <div class="container-fluid" >
      
     <div class="span4" style="border: 1px solid #ccc;
    margin-bottom: 15px;">
      <form method="post" action="{{url('article/upload/files')}}" class="form-horizontal" id="upload_form" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-legend" id="Channel">Upload PDF files</div>


        <div  class="control-group row-fluid">
            <div class="span3">
                <label class="control-label" for="selectBoxFilter">Files Caption</label>
            </div>
           
             <div class="span9">
                <div class="controls">
                  <input type="text" name="fileName" required="">
                </div>
            </div>
          
            
        </div>
        
        <div id="Text_Area_Resizable" class="control-group row-fluid">
            <div class="span3">
                <label class="control-label">Files Script</label>
            </div>
            <div class="span9">
                <div class="controls">
                    <input type="file" name="pdffiles" id="pdffiles" required="">
                    <p id="error1" style="display:none; color:#FF0000;">
                    Invalid Image Format! Image Format Must Be PDF.
                    </p>
                    <p id="error2" style="display:none; color:#FF0000;">
                    Maximum File Size Limit is 5MB.
                    </p>
                </div>
            </div>
        </div>
        <div class="span6 span-inset">
                <input value="Upload"  type="submit" class="btn btn-warning pdfupload"><img src="images/photon/preloader/76.gif" alt="loader" style="width:5%; display:none;"/>  

        </div>
        </form>
    </div>
    <div class="span4" style="border: 1px solid #ccc;
    margin-bottom: 15px;">
      <form method="post" action="{{url('article/upload/video/files')}}" class="form-horizontal" id="upload_form1" enctype="multipart/form-data">
          {{csrf_field()}}
        <div class="form-legend" id="Channel">Upload Video files</div>


        <div  class="control-group row-fluid">
            <div class="span3">
                <label class="control-label" for="selectBoxFilter">Files Caption</label>
            </div>
           
             <div class="span9">
                <div class="controls">
                  <input type="text" name="videoName" required="">
                </div>
            </div>                      
        </div>
        
        <div id="Text_Area_Resizable" class="control-group row-fluid">
            <div class="span3">
                <label class="control-label">Files Script</label>
            </div>
            <div class="span9">
                <div class="controls">
                    <input type="file" name="videofiles" id="videofiles" required="">
                    <p id="error11" style="display:none; color:#FF0000;">
                    Invalid Video Format! Video Format Must Be mp4,flv,avi,wmv,mpeg.
                    </p>
                    <p id="error21" style="display:none; color:#FF0000;">
                    Maximum File Size Limit is 5MB.
                    </p>
                </div>
            </div>
        </div>
        <div class="span6 span-inset">
          <input value="Upload"  type="submit" class="btn btn-warning videoupload"><img src="images/photon/preloader/76.gif" alt="loader" style="width:5%; display:none;"/>  
        </div>
        <!--Select Box with Filter Search end--> 
        </form>                   
    </div>
        <!--Select Box with Filter Search end-->                            
    </div>

        <div class="container-fluid">
            <div class="form-legend" id="tags3">Existing Files</div>
            <div class="row-fluid">
                <div class="span12 table-responsive">
                    <table class="table table-striped" id="tableSortable">
                        <thead>
                            <tr>
                                <th>ID</th>
                               
                                <th>Caption</th>
                                <th>Name</th>
                                <th>Extension</th>
                                <th>Create At</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                          @isset($uploadfiles)
                          @foreach($uploadfiles as $a)
                            <tr id="item">
                                <td style="width: 5%">{{$a->file_id}}</td>
                               
                                 <td style="width: 15%">{{$a->file_caption}}</td>
                                  <td style="width: 50%"><textarea type="text" style="width: 95%;margin:-5px 0; ">{{Config::get('constants.storagepath')}}{{$a->file_name}}</textarea></td>
                                  <td style="width: 5%">{{$a->file_exe}}</td>
                                  <td style="width: 15%">{{$a->created_at}}</td>
                                  <td style="width: 10%"><a href="{{url('article/delete/files')}}/{{$a->file_name}}/{{$a->file_id}}" >
                                    
                                    Remove</a></td>
                            </tr>
                          @endforeach  
                          @endisset 
                        </tbody>
                    </table>
                </div>
            </div>
            <!--Sortable Non-responsive Table end-->
            <div class="dataTables_paginate paging_bootstrap pagination">

            	{{$uploadfiles->links()}}
               
            </div>
        </div>
        <style type="text/css">
  .checkbox {
    min-height: 30px;
    line-height: 30px;
    padding-left: 10px;
    float: left;
        margin-top: 0px !important;}

        #zzadcontent1537513712{
display: none;
        }
        #zzadcontent1537515451{
          display: none;
        }
</style>
<script type="text/javascript">
    $('.pdfupload').prop("disabled", true);
    var a=0;
    //binds to onchange event of your input field
    $('#pdffiles').bind('change', function() {
    if ($('.pdfupload').attr('disabled',false)){
        $('.pdfupload').attr('disabled',true);
        }
    var ext = $('#pdffiles').val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['pdf']) == -1){
        $('#error1').slideDown("slow");
        $('#error2').slideUp("slow");
        a=0;
        }else{
        var picsize = (this.files[0].size);
        if (picsize > 5000000){
        $('#error2').slideDown("slow");
        a=0;
        }else{
        a=1;
        $('#error2').slideUp("slow");
        }
        $('#error1').slideUp("slow");
        if (a==1){
            $('.pdfupload').attr('disabled',false);
            }
    }
    });
$('.videoupload').prop("disabled", true);
    var b=0;
    //binds to onchange event of your input field
    $('#videofiles').bind('change', function() {
    if ($('.videofiles').attr('disabled',false)){
        $('.videofiles').attr('disabled',true);
        }
    var ext = $('#videofiles').val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['mp4','flv','avi','wmv','mpeg']) == -1){
        $('#error11').slideDown("slow");
        $('#error21').slideUp("slow");
        b=0;
        }else{
        var picsize = (this.files[0].size);
        if (picsize > 5000000){
        $('#error21').slideDown("slow");
        b=0;
        }else{
        b=1;
        $('#error21').slideUp("slow");
        }
        $('#error11').slideUp("slow");
        if (b==1){
            $('.videoupload').attr('disabled',false);
            }
    }
    });
  function removePdfFile() {
        var fileName = $('input[name="pfiles"]').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:"{{url('article/pdf/files/remove')}}/"+fileName,
            type:"post",
            success:function(data){
                $('.afterFileUpload').show();
                $('.afterDel').empty();
                $("#pdfFile"). prop("checked", false);
            },
            error:function (){

            }

        })

    }  
  

</script>
@stop

