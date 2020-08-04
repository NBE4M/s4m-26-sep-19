@extends('layouts/master')

@section('title', 'Add Menu - '.config('constants.sitename').'CMS')
@section('content')
<div class="panel">
    <div class="panel-content filler">
        <div class="panel-logo"></div>
        <div class="panel-header">
            <h1><small>Add Menu</small></h1>
        </div>		
        <div class="panel-search container-fluid">
        
        </div>

        <br><br>
        <div class="panel-header">
    <!--<h1><small>Page Navigation Shortcuts</small></h1>-->
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
                <a href="{{url('/')}}/dashboard">
                    <i class="icon-photon home"></i>
                </a>
            </li>
            <li class="current">
                <a href="javascript:;">Add Menu</a>
            </li>
        </ul>
    </div>           <header>
        <i class="icon-big-notepad"></i>
        <h2><small>Add Menu</small></h2>

    </header>
    <form class="form-horizontal" method="POST" id='categoryform' action="{{url('cms/menu')}}" onsubmit="return validateCategoryData();">
        {!! csrf_field() !!}
        <div class="container-fluid" @if((!Session::has('message')) && (!Session::has('error')))style="display: none" @endif >

             <div id="Notifications" class="form-legend">Notifications</div>

            <!--Notifications begin-->
            <div class="control-group row-fluid">
                <div class="span12 span-inset">
                    @if (Session::has('message'))
                    <div class="alert alert-success alert-block">
                        <i class="icon-alert icon-alert-info"></i>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>This is Success Notification</strong>
                        <span>{{ Session::get('message') }}</span>
                    </div>
                    @endif 

                </div>
            </div>
            <!--Notifications end-->
        </div>

        <div class="container-fluid">

            <div class="form-legend" id="tags">Add A New Menu</div>

            <div class="control-group row-fluid" id="Multiple_Select_Box_with_Filter_Search">


               
                 
                <div class="control-group row-fluid">
                    <div class="span3">
                        <div class="controls">
                           <select name="parent_id" id="parent_id">
                             <option value="0" selected="selected">None</option>
                            @foreach($parents as $submenu)
                       <option value="{{$submenu->id}}">{{$submenu->title}}</option>
                        @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="span3">
                        <div class="controls">
                            <input type="text" placeholder="menu name" name="title" id="category" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                    <div class="span3">
                        <div class="controls">
                            <input type="text" name="slug" placeholder="url" id="slug" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid Url.</span>
                        </div>
                    </div>
                    <div class="span3">
                        <div class="controls">
                            <input type="text" name="place" placeholder="place" id="place" class="required"><span for="add tags" generated="true" class="error" style="display: none;"></span>
                        </div>
                    </div>


                </div>
                <!-- <div class="control-group row-fluid">   
                    <div class="span3">
                        <label for="add tags" class="control-label">Banner Label</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                          
                            <input type="text" name="bannerLabel" placeholder="Define Label"  value="{{old('bannerLabel')}}" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="control-group row-fluid">   
                    <div class="span3">
                        <label for="add tags" class="control-label">Banner Breadcrumb</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                          
                            <input type="text" name="bannerBreadCrumb" placeholder="Define Breadcrumb"  value="{{old('bannerBreadCrumb')}}" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="control-group row-fluid">   
                    <div class="span3">
                        <label for="add tags" class="control-label">Meta Title</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                          
                            <input type="text" name="mtitle"  value="{{old('mtitle')}}" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="control-group row-fluid">   
                    <div class="span3">
                        <label for="add tags" class="control-label">Meta Description</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                          
                            <input type="text" name="mdesc" value="{{ old('mdesc')}}" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="control-group row-fluid">   
                    <div class="span3">
                        <label for="add tags" class="control-label">Meta Keyword</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                          
                            <input type="text" name="mkeyword"  value="{{old('mkeyword')}}" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                </div> -->

            </div>
            <div class="span12 span-inset">

                        <button style="display:block;" class="btn btn-info" type="submit">Save</button>
                        <img style="width:5%; display:none; " alt="loader" src="images/photon/preloader/76.gif">
                    </div>                       
        </div>



    </form>
</div> 
<script>
    $(document).ready(function () {

        $("#categoryform").validate({
            errorElement: "span",
            errorClass: "error",
            //$("#pageSubmit").onclick: true,
            onclick: true,
            invalidHandler: function (event, validator) {

                for (var i in validator.errorMap) { ///alert(i);

                    if ($('#' + i).hasClass('formattedelement')) {
                        $('#' + i).siblings('.formattedelement').addClass('error');
                    }

                }
            },
            rules: {
                "req": {
                    required: true
                },
                "category1": {
                    required: true
                }
            }
        });

    });
</script>
@stop