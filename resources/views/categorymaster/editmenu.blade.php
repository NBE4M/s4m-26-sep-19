@extends('layouts/master')

@section('title', 'Create Menu - S4MCMS')


@section('content')
<style> .none { display:none; } </style>
<div class="panel">
    <div class="panel-content filler">
        <div class="panel-logo"></div>
        <div class="panel-header">
            <h1><small>Edit Menu</small></h1>
        </div>

        <div class="panel-header">
        <!--<h1><small>Page Navigation Shortcuts</small></h1>-->
        </div>
        <div class="sidebarMenuHolder">
            <div class="JStree">
                <div class="Jstree_shadow_top"></div>
                <div id="jstree"></div>
                <div class="Jstree_shadow_bottom"></div>
            </div>
        </div>
    </div>
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
                <a href="#">Menu</a>
                <ul class="breadcrumb-sub-nav">
                    <li>
                        <a href="#">Edit Menu</a>
                    </li>
                    
                </ul>
            </li>
           
        </ul>
    </div>            <header>
        <i class="icon-big-notepad"></i>
        <h2><small>Edit Menu</small></h2>
    </header>
    
   <form method="post" action="{{url('cms/menu').'/'.$menue->id}}" class="form-horizontal" id="fileupload">
   {{method_field('PUT')}}
   {{csrf_field()}}
    <div class="container-fluid" id="notificationdiv"  @if((!Session::has('message')) && (!Session::has('error')))style="display: none" @endif >

         <div class="form-legend" id="Notifications">Notifications</div>

        <!--Notifications begin-->
        <div class="control-group row-fluid" >
            <div class="span12 span-inset">
                @if (Session::has('message'))
                <div class="alert alert-success alert-block" style="">
                    <i class="icon-alert icon-alert-info"></i>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>This is Success Notification</strong>
                    <span>{{ Session::get('message') }}</span>
                </div>
                @endif

                @if (Session::has('error'))
                <div class="alert alert-error alert-block">
                    <i class="icon-alert icon-alert-info"></i>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>This is Error Notification</strong>
                    <span>{{ Session::get('error') }}</span>
                </div>
                @endif
            </div>
        </div>
        <!--Notifications end-->

    </div>


    <div class="container-fluid">
        <div class="form-legend" id="Article-Details">Menu Detail

        </div>
        <!--Text Area - No Resize begin-->
        <div  class="control-group row-fluid">
              <div class="span3">
                <input type="hidden" name="menu_id" value="{{$menue->id}}"/>
                        <div class="controls">
                           <select name="parent_id" id="parent_id">
                             <option value="0" selected="selected">None</option>
                            @foreach($parents as $submenu)
                            <option value="{{ $submenu->id }}" {{ $submenu->id == $menue->parent_id ? 'selected="selected"' : '' }}>{{ $submenu->title }}</option> 
                           
                            @endforeach
                              
                           </select>
                        </div>
                    </div>
                    <div class="span3">
                        <div class="controls">
                            <input type="text" placeholder="menu name" value="{{$menue->title}}" name="title" id="category" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                   
                    <div class="span3">
                        <div class="controls">
                            <input type="text" name="slug" placeholder="url" value="{{$menue->slug}}" id="slug" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid Url.</span>
                        </div>
                    </div>
                    <div class="span3">
                        <div class="controls">
                            <input type="text" name="place" placeholder="Place" value="{{$menue->link}}" id="place" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid Url.</span>
                        </div>
                    </div>

        </div>
        <!--Text Area - No Resize end-->
        <div class="control-group row-fluid">   
                    <div class="span3">
                        <label for="add tags" class="control-label">Meta Title</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                          
                            <input type="text" name="mtitle"  value="{{$menue->mtitle}}" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                </div>
                <div class="control-group row-fluid">   
                    <div class="span3">
                        <label for="add tags" class="control-label">Meta Description</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                          
                            <input type="text" name="mdesc" value="{{$menue->mdesc}}" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                </div>
                <div class="control-group row-fluid">   
                    <div class="span3">
                        <label for="add tags" class="control-label">Meta Keyword</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                          
                            <input type="text" name="mkeyword"  value="{{$menue->mkeyword}}" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                </div>

    </div><!-- end container1 -->
   
 
    <div class="container-fluid">
        <div class="control-group row-fluid" id="submitsection">
            <div class="span12 span-inset">
                <button type="submit" name="status" value="P" id="publishSubmit" class="btn btn-success">Save</button><img src="{{ asset('images/photon/preloader/76.gif')}}" alt="loader" style="width:5%; display:none;"/>
            </div>
        </div>
    </div>
    <!--	end container-->
   </form>
</div>
<script>
    $(document).ready(function(){
         $("#fileupload").validate({
            errorElement: "span",
            errorClass: "error",
            rules: {
                title:"required"
            }
       });
    });
</script>  
@stop