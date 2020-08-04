@extends('layouts/master')

@section('title', 'Manage Mailer - '.config('constants.sitename').'CMS')
@section('content')
<div class="panel">
    <div class="panel-content filler">
        <div class="panel-logo"></div>
        <div class="panel-header">
            <h1><small>Mailer Master</small></h1>
        </div>		
        <div class="panel-search container-fluid">
             <form class="form-horizontal" method="get" action="">
                 <input type="hidden" name="channel" value="{{$currentChannelId}}"/>
                    @if($parentId!='0')
                        <input type="hidden" name="id" value="{{$parentId}}"/>
                    @endif
                    <input id="panelSearch" required  placeholder="Search" value="{{$_GET['keyword'] or ''}}" type="text" name="keyword">
                    <button class="btn btn-search" type="submit"></button>
                     @if(isset($_GET['keyword'])) 
                     
                        <a href="{{url("mailer?channel=").$currentChannelId}}@if($parentId!='0')&id={{$parentId}}@endif"><button class="btn btn-default" type="button">Reset</button></a>
                       
                    @endif

             </form>
        </div>

        <br><br>
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
                                    "title": "Add A New Mailer",
                                    "attr": {"href": "#tags"}
                                }
                            },
                            {
                                "data": {
                                    "title": "Existing Mailer",
                                    "attr": {"href": "#tableSortable_wrapper"}
                                }
                            },
                        ]
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
        <div style="height: 268px;" class="sidebarMenuHolder mCustomScrollbar _mCS_1"><div class="Jstree_shadow_top"></div><div style="position:relative; height:100%; overflow:hidden; max-width:100%;" id="mCSB_1" class="mCustomScrollBox"><div style="position:relative; top:0;" class="mCSB_container mCS_no_scrollbar"><div class="mCustomScrollBox" id="mCSB_1" style="position:relative; height:100%; overflow:hidden; max-width:100%;"><div class="mCSB_container mCS_no_scrollbar" style="position:relative; top:0;">
                            <div class="JStree">

                                <div class="jstree jstree-0 jstree-focused jstree-default" id="jstree"><ul><li class="jstree-leaf"><ins class="jstree-icon">&nbsp;</ins><a href="#currently-displayed" class=""><ins class="jstree-icon">&nbsp;</ins>Currently Displayed</a></li><li class="jstree-leaf"><ins class="jstree-icon">&nbsp;</ins><a href="#tableSortableResMed" class=""><ins class="jstree-icon">&nbsp;</ins>Logo Management</a></li><li class="jstree-last jstree-leaf"><ins class="jstree-icon">&nbsp;</ins><a href="#new-logo" class=""><ins class="jstree-icon">&nbsp;</ins>New Logo</a></li></ul></div>

                            </div>
                        </div><div class="mCSB_scrollTools" style="position: absolute; display: none;"><a class="mCSB_buttonUp" style="display:block; position:relative;"></a><div class="mCSB_draggerContainer" style="position:relative;"><div class="mCSB_dragger" style="position: absolute; top: 0px;"><div class="mCSB_dragger_bar" style="position:relative;"></div></div><div class="mCSB_draggerRail"></div></div><a class="mCSB_buttonDown" style="display:block; position:relative;"></a></div></div></div><div style="position: absolute; display: none;" class="mCSB_scrollTools"><a style="display:block; position:relative;" class="mCSB_buttonUp"></a><div style="position:relative;" class="mCSB_draggerContainer"><div style="position: absolute; top: 0px;" class="mCSB_dragger"><div style="position:relative;" class="mCSB_dragger_bar"></div></div><div class="mCSB_draggerRail"></div></div><a style="display:block; position:relative;" class="mCSB_buttonDown"></a></div></div><div class="Jstree_shadow_bottom"></div></div>    </div>
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
                <a href="dashboard.html">
                    <i class="icon-photon home"></i>
                </a>
            </li>
            <li class="current">
                <a href="javascript:;">Mailer Master</a>
            </li>
        </ul>
    </div>           <header>
        <i class="icon-big-notepad"></i>
        <h2><small><a href="{{url('')}}/mailer?channel={{$currentChannelId}}">Mailer Master</a></small></h2>
        <h2> <small> 
         @foreach($parents as $parent)
         >> <a href="{{url('')}}/mailer?id={{$parent->mailer_id}}">{{$parent->name}}</a>
            @endforeach
             
            </small>
            </h2>
    </header>
    
    <div style="margin-bottom:20px;margin-right:20px;text-align:right;">
        @if($parentId==0)
        <a href="{{url('')}}/mailer/create?channel={{$currentChannelId}}">
            <button class="btn btn-default" id="draftSubmit" value="S" name="status" type="submit">Create New Mailer</button>
        @else
             <a href="{{url('')}}/mailer/create?id={{$parentId}}">
            <button class="btn btn-default" id="draftSubmit" value="S" name="status" type="submit">Create Sub Mailer</button>
        @endif    
        </a>
    </div>
    
    <form class="form-horizontal"method="POST" action="{{url('')}}/mailer/add" onsubmit="return validateMailerData();">
        {!! csrf_field() !!}
        <div class="container-fluid" @if((!Session::has('message')) && (!Session::has('error')))style="display: none" @endif>

            <div id="Notifications" class="form-legend" >Notifications</div>

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
       
        <div class="container-fluid"  @if($parentId!='0') style="display: none;" @endif>

            <div class="form-legend" id="Channel">Channel</div>

            <!--Select Box with Filter Search begin-->
            <div  class="control-group row-fluid" >
                <div class="span3">
                    <label class="control-label" for="selectBoxFilter">Channel</label>
                </div>
                <div class="span9">
                    <div class="controls">
                        <select name="channel" id="selectBoxFilter20">
                            @foreach($channels as $channel)
                       <option @if($channel->channel_id==$currentChannelId) selected="selected" @endif value="1{{ $channel->channel_id }}">{{ $channel->channel }}</option>
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

                                window.location = '{{url("mailer")}}' + '?channel=' + $(this).attr("value").trim();
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
        </div>

        

        <div class="container-fluid">
            <div class="form-legend" id="tags3">Existing Mailer</div>
            <div class="row-fluid">
                <div class="span12">
                    <table class="table table-striped" id="tableSortable">
                        <thead>
                            <tr>
                                <th>#</th>
                                 <th>Subject</th>
                                  <th>Link</th>
                                <th>Sales Person</th>
                                <th>Type</th>
                                <th>Added By</th>
                                <th>Added On</th>
                                <th><input type="checkbox" class="uniformCheckbox" value="checkbox1" id="selectall"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $a)
                            <tr id="rowCur{{$a->mailer_id}}">
                                 <td>#</td>
                                <td>{{$a->subject}}</td>
                                 <td><a href="{{$a->link}}" target="_blank"> {{$a->link}}</a></td>
                                <td>{{$a->sales_person_name}}</td>
                                <td>{{$a->type}}</td>
                                <td>{{$a->create_by}}</td>
                                <td>{{$a->create_date}}</td>
                                <td>
                                    <input type="checkbox" class="uniformCheckbox" value="{{$a->mailer_id}}" name="checkItem[]">
                                </td>
                                
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
            </div>
            <!--Sortable Non-responsive Table end-->


            <script>
            $(document).ready(function () {
                $('#tableSortable').dataTable({
                    "sPaginationType": "bootstrap",
                    "fnInitComplete": function () {
                        $(".dataTables_wrapper select").select2({
                            dropdownCssClass: 'noSearch'
                        });
                    }
                });
                //                            $("#simpleSelectBox").select2({
                //                                dropdownCssClass: 'noSearch'
                //                            }); 
                
                
                 $('#selectall').click(function(){
                            if($(this).is(':checked')) {
                                $('input[name="checkItem[]"]').each(function(){
                                    $(this).attr('checked','checked');
                                });
                            }else{
                                 $('input[name="checkItem[]"]').each(function(){
                                    $(this).removeAttr('checked');
                                });
                            }
                         });
            });
            
             function deletemailer() {
                       var ids = '';
                        var checkedVals = $('input[name="checkItem[]"]:checkbox:checked').map(function () {
                            var row = 'rowCur' + this.value;
                           
                            return this.value;
                        }).get();
                        
                       // alert(2);
                        var ids = checkedVals.join(",");
                        //alert(ids);return false;
                        $.ajax({
                                type: 'post',
                                url: "{{ url('mailer')}}/"+ids,    
                                data: {"id":ids,_token: "{{ csrf_token() }}",_method:"DELETE"},
                        success:function (data) {
                            $.each(checkedVals, function (i, e) {
                                var row = 'rowCur' + e;
                                $("#" + row).remove();
                            });
                            $('#notificationdiv').show();
                            $('#notificationdiv .control-group .span12.span-inset').html('<div class="alert alert-success alert-block">\n\
                                <i class="icon-alert icon-alert-info"></i><button type="button" class="close" data-dismiss="alert">\n\
                                &times;</button><strong>This is Success Notification</strong>\n\
                                <span></span>Selected records dumped.</div>');
                           
                            }
                        });
                    }
                    
        </script>

        </div>
      <div class="control-group row-fluid">
            <div class="span12 span-inset">
                <button type="button" onclick="deletemailer()" class="btn btn-danger">Dump</button><img src="images/photon/preloader/76.gif" alt="loader" style="width:5%; display:none;"/>							

            </div></div>
    </form>
</div> 

@stop