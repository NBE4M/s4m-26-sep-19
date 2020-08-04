@extends('layouts/master')

@section('title', 'Create New Banner - E4MCMS')


@section('content')
<?php
//print_r($p1);exit;
?>
<div class="panel">
    <div class="panel-content filler">
        <div class="panel-logo"></div>
        <div class="panel-header">
            <h1><small>Create New Banner</small></h1>

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
                                    "title": "Banner Feature",
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
                <a href="#">Banner &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                <ul class="breadcrumb-sub-nav">
                    <li>
                        <a href="<?php echo url('manageAds/create') ?>">Create New Banner</a>
                    </li>
                    <li>
                        <a href="<?php echo url('manageAds/list/deleted') ?>">Published Banner</a>
                    </li>
                    <li>
                        <a href="<?php echo url('manageAds/list/deleted') ?>">Deleted Banner</a>
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
                <a href="javascript:;">Create New Banner</a>
            </li>
        </ul>
    </div>            <header>
        <i class="icon-big-notepad"></i>
        <h2><small>New Banner</small></h2>
    </header>
    <!--            <form class="form-horizontal" id="fileupload" action="" method="POST" enctype="multipart/form-data">-->
   <form method="post" action="{{url('cms/manageAds').'/'.$parentsedit[0]->bid}}" class="form-horizontal" id="fileupload">
   {{method_field('PUT')}}
   {{csrf_field()}}
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
    <div class="container-fluid">

        <div class="form-legend" id="Channel">Channel</div>

        <!--Select Box with Filter Search begin-->
        <div  class="control-group row-fluid">
            <div class="span3">
                <label class="control-label" for="selectBoxFilter">Banner Position/Status</label>
            </div>
            
            <div class="span4">
                <div class="controls">
                    <select name="bstatus"  id="bstatus" class="formattedelement">
                        @if($parentsedit[0]->status==1)
                       <option value="1" selected>Active</option>
                       <option value="0">Inactive</option>
                       @else
                       <option value="0" selected>Inactive</option>
                       <option value="1">Active</option>
                       @endif
                    </select>
                </div>
            </div>

             <div class="span4">
                <div class="controls">
                    <select name="channel1"  id="channel1" class="formattedelement">
                      <option value="{{$parentsedit[0]->forpage}}">{{strtoupper($parentsedit[0]->forpage)}}</option>
                      <option value="story">STORY PAGE</option>
                      <option value="section">SECTION PAGE</option>
                      <option value="newsletter">NEWSLETTER</option>
                      <option value="pr">PR</option>
                    </select>
                </div>
            </div>
             <div id="Text_Area_Resizable" class="control-group row-fluid">
             <div class="span3">
                <label class="control-label">Banner Position</label>
            </div>
             <div class="span9">
                <div class="controls">
                    <select name="channel"  id="channel" class="formattedelement">
                       <option value="{{$parentsedit[0]->bposition}}">{{$parentsedit[0]->bposition}}</option>
                    </select>
                </div>
            </div>
</div>
        <script>
            $().ready(function () {
                $("#channel").select2();
            });
        </script>
        <script>
            $().ready(function () {
                $("#channel1").select2();
            });
        </script>
           <script>
            $().ready(function () {
                $("#bstatus").select2();
            });
        </script>

           
           
        </div>
            <div id="Text_Area_Resizable" class="control-group row-fluid">
            <div class="span3">
                <label class="control-label">Banner Script</label>
            </div>
            <div class="span9">
                <div class="controls">
                    <textarea  rows="4" class="" id="bscript" name="bscript">{{$parentsedit[0]->bscript}}</textarea>
                </div>
            </div>
        </div>
             <div id="Text_Area_Resizable" class="control-group row-fluid">
            <div class="span3">
                <label class="control-label">Device</label>
            </div>
            <div class="span9">
               

               <label class="checkbox" style="float: left;">
                    <input type="checkbox" name="mobile" value="1" class="uniformCheckbox2" @if($parentsedit[0]->mobile == 1) checked @endif>
                           Mobile
                </label>
                 <label class="checkbox" >
                    <input type="checkbox" name="desktop" value="1" class="uniformCheckbox2" @if($parentsedit[0]->desktop == 1) checked @endif>
                          Desktop
                            <script>
                            $().ready(function(){
                    $(".uniformCheckbox2").uniform();
                    });</script>
                </label>
               
            </div>
        </div>
        <!--Select Box with Filter Search end-->                    
    </div>
    <div class="container-fluid">
        
        <div class="control-group row-fluid">
            <div class="span12 span-inset">
                <button value="P" name="status" type="submit" class="btn btn-warning">Submit</button><img src="images/photon/preloader/76.gif" alt="loader" style="width:5%; display:none;"/>  


            </div>
        </div>
    </div>



    {!! Form::close() !!}

    <style type="text/css">
  .checkbox {
    min-height: 30px;
    line-height: 30px;
    padding-left: 10px;
    float: left;
        margin-top: 0px !important;}
        
</style>
@stop

