@extends('layouts/master')

@section('title', 'Add category - '.config('constants.sitename').'CMS')
@section('content')
<div class="panel">
    <div class="panel-content filler">
        <div class="panel-logo"></div>
        <div class="panel-header">
            <h1><small>Add Category</small></h1>
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
                <a href="{{url('')}}/dashboard">
                    <i class="icon-photon home"></i>
                </a>
            </li>
            <li class="current">
                <a href="javascript:;">Add Category</a>
            </li>
        </ul>
    </div>           <header>
        <i class="icon-big-notepad"></i>
        <h2><small>Add Category</small></h2>

    </header>
    <form class="form-horizontal"method="POST" id='categoryform' action="{{url('')}}/category" onsubmit="return validateCategoryData();">
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
        @if($parentId>0)
        <input type="hidden" value="{{$parentId}}" id="parent_category" name="parent_category">
        @endif 
        <div class="container-fluid">

            <div class="form-legend" id="tags">Add A New Category</div>
            <!--Topics begin-->

            <!--Topics end-->

            <!--Select Box with Filter Search begin-->

            <div class="control-group row-fluid" id="Multiple_Select_Box_with_Filter_Search">


                <script>
                    $().ready(function () {
                        $("#selectBoxFilter").select2();
                    });
                </script>
                 @if($parentId>0) 
                 <div class="control-group row-fluid">
                     <div class="span3">
                         <label for="add tags" class="control-label">Parent</label>
                     </div>
                     <div class="span9">
                         <div class="controls">
                             <h2> <small> 
                                     @foreach($parents as $parent)
                                     >> <a href="/category?id={{$parent->category_id}}">{{$parent->name}}</a>
                                     @endforeach

                                 </small>
                             </h2>
                         </div>
                     </div>


                 </div>
                @endif
                <div class="control-group">
                    <div class="row-fluid">
                    <div class="span3">
                        <label for="add tags" class="control-label">Add Category Hindi Name</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                            <input type="hidden" name="parent_id" id="parent_id" value="{{$parentId}}"/>
                            <input type="text" name="name"id="category" class="required">
                            <span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span3">
                        <label for="add tags" class="control-label">Add Category English Name</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                            <input type="text" name="e_name"id="category" class="required">
                            <span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span3">
                        <label for="add tags" class="control-label">Meta Title</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                            <input type="text" name="mtitle"id="category" class="required">
                            <span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span3">
                        <label for="add tags" class="control-label">Meta Description</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                            <input type="text" name="mdesc"id="category" class="required">
                            <span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span3">
                        <label for="add tags" class="control-label">Meta Keyword</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                            <input type="text" name="mkeyword"id="category" class="required">
                            <span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span3">
                        <label for="add tags" class="control-label">Banner Label</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                            <input type="text" name="bannerLabel" id="category" >
                            <span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span3">
                        <label for="add tags" class="control-label">Banner Breadcrumb</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                            <input type="text" name="bannerBreadCrumb" id="category" >
                            <span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span3">
                        <label for="add tags" class="control-label">Home-Page Apperence</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                            <input type="checkbox" name="is_homepage" value="1" class="required"/> Yes
                            <input type="checkbox" name="is_homepage" value="0" class="required"/> No
                        </div>
                    </div>
                    
                </div>    
                    <div class="span12 span-inset">

                        <button style="display:block;" class="btn btn-info" type="submit">Save</button>
                        <img style="width:5%; display:none; " alt="loader" src="images/photon/preloader/76.gif"></div>

                </div>
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
    $('input[type="checkbox"]').on('change', function() {
   $(this).siblings('input[type="checkbox"]').prop('checked', false);
});

    /* function validateCategoryData(){
     var valid = 1;
     $('.author_error').remove();
     $('#new input').removeClass('error');
     $('#new textarea').removeClass('error');
     if ($('select[name=channel]').val().trim() == 0){
     valid = 0;
     $('select[name=channel]').addClass('error');
     $('select[name=channel]').after(errorMessage('Please enter channel'));
     }
     if ($('input[name=add_mastercategory]').val().trim() == 0){
     valid = 0;
     $('input[name=add_mastercategory]').addClass('error');
     $('input[name=add_mastercategory]').after(errorMessage('Please enter name'));
     }
     
     
     //alert(valid);
     if (valid == 0)
     return false;
     else
     return true;
     }
     function errorMessage($msg){
     return '<span class="error author_error">' + $msg + '</span>';
     } */
</script>
@stop