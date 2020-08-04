@extends('layouts/master')

@section('title', 'Add Mailer - '.config('constants.sitename').'CMS')
@section('content')
<div class="panel">
    <div class="panel-content filler">
        <div class="panel-logo"></div>
        <div class="panel-header">
            <h1><small>Add Mailer</small></h1>
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
                <a href="javascript:;">Add Mailer</a>
            </li>
        </ul>
    </div>          <header>
        <i class="icon-big-notepad"></i>
        <h2><small><a href="{{url('')}}/mailer?channel={{$currentChannelId}}">Mailer Master</a></small></h2>
        <h2> <small> 
         @foreach($parents as $parent)
         >> <a href="{{url('')}}/mailer?id={{$parent->Mailer_id}}">{{$parent->name}}</a>
            @endforeach
             
            </small>
            </h2>
    </header>
    <form class="form-horizontal"method="POST" id='Mailerform' action="{{url('')}}/mailer" onsubmit="return validateMailerData();">
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
        <input type="hidden" value="{{$parentId}}" id="parent_Mailer" name="parent_Mailer">
        @endif 
        <div class="container-fluid">

            <div class="form-legend" id="tags">Add A New Mailer</div>
            <!--Topics begin-->

            <!--Topics end-->

            <!--Select Box with Filter Search begin-->

            <!--Select Box with Filter Search begin-->
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

                                    window.location = '{{url("mailer/add-master-Mailer")}}' + '?channel=' + $(this).attr("value").trim();
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
                                     >> <a href="/mailer?id={{$parent->Mailer_id}}">{{$parent->name}}</a>
                                     @endforeach

                                 </small>
                             </h2>
                         </div>
                     </div>


                 </div>
                @endif
                <div class="control-group row-fluid">
                    <div class="span3">
                        <label for="add tags" class="control-label">Subject</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                            <input type="text" name="subject" id="subject" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                    

                </div>
                <div class="control-group row-fluid">
                    <div class="span3">
                        <label for="add tags" class="control-label">Url</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                            <input type="text" name="url" id="url" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                    

                </div>
                <div class="control-group row-fluid">
                    <div class="span3">
                        <label for="add tags" class="control-label">Date</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                          
                            <input type="date" name="cdate" id="cdate" required class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                    

                </div>
                <div class="control-group row-fluid">
                    <div class="span3">
                        <label for="add tags" class="control-label">Sales Person</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                           
                            <input type="text" name="salesp_name" required id="salesp_name" class="required"><span for="add tags" generated="true" class="error" style="display: none;">Please enter a valid text.</span>
                        </div>
                    </div>
                    

                </div>
                <div class="control-group row-fluid">
                    <div class="span3">
                        <label for="add tags" class="control-label">Type</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                          
                           <select class="form-control" required name="type" style="width: 100%;">
                            <option value="">Select one</option>
                                <option value="client">Client</option>
                                <option value="e4m_events">e4m-events</option>
                                <option value="e4m_morning_post">e4m-morning post</option>
                                <option value="e4m-afternoon-post">e4m-afternoon-post</option>
                                <option value="e4m-evening-post">e4m-evening-post</option>
                                <option value="e4m-breaking-news">e4m-breaking-news</option>
                                <option value="e4m-news-update">e4m-news-update</option>
                                <option value="rp-mailer">rp-mailer</option>
                                <option value="rp-newsletter">rp-newsletter</option>
                                <option value="s4m-mailer">s4m-mailer</option>
                                <option value="s4m-newsletter">s4m-newsletter</option>
                                <option value="bw-mailer">bw-mailer</option>
                                <option value="special-request-mailer">special-request-mailer</option>

                        </select>
                        </div>
                    </div>
                    

                </div>
                <div class="control-group row-fluid">
                    <div class="span3">
                        <label for="add tags" class="control-label">Employee Name</label>
                    </div>
                    <div class="span9">
                        <div class="controls">
                            
                           <select class="form-control" required name="emp_name" style="width: 100%;">
                            <option value="">select one</option>
                                <option value="neeraj">Neeraj</option>
                                <option value="khushboo">Khushboo</option>
                                <option value="ram">Ram</option>
                                <option value="owasi">Owasi</option>
                                <option value="hansraj">Hansraj</option>
                        </select>
                        </div>
                    </div>
                    

                </div>
                <div class="span12 span-inset">

                        <button style="display:block;" class="btn btn-info" type="submit">Save</button>
                        <img style="width:5%; display:none; " alt="loader" src="images/photon/preloader/76.gif"></div>
            </div>                       
        </div>



    </form>
</div> 
<script>
    $(document).ready(function () {

        $("#Mailerform").validate({
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
                "Mailer1": {
                    required: true
                }
            }
        });

    });
</script>
@stop