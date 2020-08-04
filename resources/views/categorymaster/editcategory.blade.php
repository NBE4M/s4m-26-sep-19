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
   
        <form method="post" action="{{url('cms/category').'/'.$category->category_id}}" class="form-horizontal" id="fileupload">
   {{method_field('PUT')}}
   {{csrf_field()}}
       
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

            <div class="form-legend" id="tags">Update Category</div>
            <div  class="control-group row-fluid">
                <div class="span3">
                    <label class="control-label" for="selectBoxFilter">Channel</label>
                </div>
                <div class="span9">
                    <div class="controls">
                        <select name="channel" id="selectBoxFilter20"  @if($parentId>0) disabled @endif;>
                            @foreach($channels as $channel)
                            <option @if($channel->channel_id==$currentChannelId) selected="selected" @endif value="{{ $channel->channel_id }}">{{ $channel->channel }}</option>
                            @endforeach
                   
                        </select>
                    </div>
                </div>
                <script>
                    $().ready(function () {
                        $("#selectBoxFilter20").select2();
                        $("#selectBoxFilter20").change(function () {
                            $(this).find("option:selected").each(function () {

                                if ($(this).attr("value").trim().length != 0) {

                                    window.location = '{{url("category/add-master-category")}}' + '?channel=' + $(this).attr("value").trim();
                                }

                                else if ($(this).attr("value") == "none") {

                                    $("#quote_list").hide();
                                }

                            });
                        });
                    });
                </script>
            </div>

            <!--Select Box with Filter Search end-->	

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
                                      <a href="/category?id={{$parent->category_id}}">{{$parent->name}}</a>
                                     @endforeach

                                 </small>
                             </h2>
                         </div>
                     </div>


                 </div>
                @endif
                <div class="control-group row-fluid">
                    <div class="span3">
                        <label for="add tags" class="control-label"> Hindi Name</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                            <input type="hidden" name="parent_id" id="parent_id" value="{{$parentId}}"/>
                            <input type="hidden" name="cat_id" id="cat_id" value="{{$category->category_id}}"/>
                            <input type="text" name="name" id="category" value="{{$category->name}}" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                </div>    
                <div class="control-group row-fluid">
                    <div class="span3">
                        <label for="add tags" class="control-label"> English Name</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                            
                            <input type="text" name="e_name" id="category" value="{{$category->e_name}}" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                </div>
                <div class="control-group row-fluid">
                    <div class="span3">
                        <label for="add tags" class="control-label">Meta Title</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                            
                            <input type="text" name="mtitle" id="category" value="{{$category->mtitle}}" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                </div>
                <div class="control-group row-fluid">    
                    <div class="span3">
                        <label for="add tags" class="control-label">Meta Description</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                           
                            <input type="text" name="mdesc" id="category" value="{{$category->mdesc}}" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                </div> 
                <div class="control-group row-fluid">   
                    <div class="span3">
                        <label for="add tags" class="control-label">Meta Keyword</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                          
                            <input type="text" name="mkeyword" id="category" value="{{$category->mkeyword}}" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                </div>
                <div class="control-group row-fluid">    
                    <div class="span3">
                        <label for="add tags" class="control-label">Status</label>
                    </div>
                    <div class="span9">
                        <select name="valid">
                          <option value="1">1</option>
                          <option value="0">0</option>
                          
                        </select>
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