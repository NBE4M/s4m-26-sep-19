@extends('layouts/master')

@section('title', 'Published Video - E4MCMS')

@section('content')
<?php //echo count($qbytes);exit; ?> 
<div class="panel">
    <div class="panel-content filler">
        <div class="panel-logo"></div>
        <div class="panel-header">
            <h1><small>Published Video</small></h1>
        </div>
        <div class="panel-search container-fluid" style="height: 100px">
           
        </div>



      
        <br><br>
        <div class="panel-header">
            <h1><small>Page Navigation Shortcuts</small></h1>
        </div>
        <script type="text/javascript">
            $(function () {
                $("#jstree").jstree({
                    "json_data": {
                        "data": [
                            {
                                "data": {
                                    "title": "Published Video",
                                    "attr": {"href": "#tableSortableResMed_wrapper"}
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
                <a href="dashboard.html">
                    <i class="icon-photon home"></i>
                </a>
            </li>
            <li class="current">
                <a href="javascript:;">Published Video</a>
            </li>
        </ul>
    </div>           <header>
        <i class="icon-big-notepad"></i>
        <h2><small>Published Video</small></h2>

    </header>
    
    <div class="form-horizontal">

        <div class="container-fluid">

            <div class="form-legend" id="Channel">Channel</div>

            <!--Select Box with Filter Search begin-->
            <div  class="control-group row-fluid">
                <div class="span3">
                    <label class="control-label" for="channel_sel">Channel</label>
                </div>
                <div class="span9">
                    <div class="controls">
                       

                    </div>
                </div>
                <script>
                    $().ready(function () {
                        $("#channel_sel").select2();
                        
                        $("#channel_sel").change(function () {
                    $(this).find("option:selected").each(function () {

                        if ($(this).attr("value").trim().length != 0) {

                            window.location = '{{url("video/list")}}' + '?channel=' + $(this).attr("value").trim();
                        }

                        else if ($(this).attr("value") == "none") {

                            $("#quote_list").hide();

                        }

                    });

                });
                
                        
                    });</script>
            </div>

            <!--Select Box with Filter Search end-->
        </div>
    </div>
    
    <form class="form-horizontal">
        <div class="container-fluid " id="notificationdiv"  @if((!Session::has('message')) && (!Session::has('error')))style="display: none" @endif >

             <div class="form-legend" id="Notifications" >Notifications</div>

            <!--Notifications begin-->
            <div class="control-group row-fluid" >
                <div class="span12 span-inset">
                    @if(Session::has('message'))
                    <div class="alert alert-success alert-block">
                        <i class="icon-alert icon-alert-info"></i>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>This is Success Notification</strong>
                        <span>{{ Session::get('message') }}</span>
                    </div>
                    @endif
                    @if(Session::has('error'))
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


            <!--Sortable Responsive Media Table begin-->
            <div class="row-fluid">
                <div class="span12">
                    <table class="table table-striped table-responsive" id="tableSortableResMed">
                        <thead class="cf sorthead">
                            <tr>
                                 <th>Video Id</th>
                                 <th>Thumb Image</th>
                                <th>Video</th>
                               
                                <th>Title</th>  
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($video as $qb)
                            
                            <tr class="gradeX" id="rowCur{{$qb->yid}}">
                                <td>{{$qb->yid}}</td>
                                <td><img src="{{$qb->img_thumb}}"></td>
                               <td> <iframe width="280" height="150" src="https://www.youtube.com/embed/{{$qb->vid}}" frameborder="0" allowfullscreen></iframe></td>
                                <td>{{$qb->title}}</td>
                                <td class="center"><input type="checkbox" name="checkItem[]" class="uniformCheckbox" value="{{$qb->vid}}"></td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <!--Sortable Responsive Media Table end-->
          <div class="dataTables_paginate paging_bootstrap pagination">
                    
                {!! $video->appends(Input::get())->render() !!}
                </div>
        </div><!-- end container -->
        <script>
            $(document).ready(function () {
                $('#tableSortable, #tableSortableRes, #tableSortableResMed').dataTable({
                    bInfo: false,
                     bPaginate:false,
                     "aaSorting": [] ,
                     "aoColumnDefs": [ { "bSortable": false, "aTargets": [4] } ],

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
            function deleteVideo() {
                        
                            var title = $("input[name='checkItem[]']:checked").closest("tr").find("td:eq(3)").text();
                            var vid = $("input[name='checkItem[]']:checked").closest("td").siblings(":first").text()
                            var thumb = $("input[name='checkItem[]']:checked").closest('tr').find("img").attr("src");
                             var ids = '';
                            var checkedVals = $('input[name="checkItem[]"]:checkbox:checked').map(function () {
                            var row = 'rowCur' + this.value;
                            $("#" + row).hide();
                            return this.value;
                        }).get();
                        var ids = checkedVals.join(",");
                        //alert(ids);return false;
                        $.get("{{ url('/video/delete/')}}",
                                {option: ids,title: title,thumb: thumb,vid: vid},
                        function (data) {
                            $.each(checkedVals, function (i, e) {
                                var row = 'rowCur' + e;
                                $("#" + row).hide();
                            });
                            $('#notificationdiv').show();
                            $('#notificationdiv .control-group .span12.span-inset').html('<div class="alert alert-success alert-block">\n\
                                <i class="icon-alert icon-alert-info"></i><button type="button" class="close" data-dismiss="alert">\n\
                                &times;</button><strong>This is Success Notification</strong>\n\
                                <span></span>Selected records Assigned For Feature.</div>');
                           
                            //alert(1);
                        });
               }
        </script>
        
        <div class="control-group row-fluid">
            <div class="span12 span-inset">
                 @if(in_array('65',Session::get('user_rights')))
                <button type="button" onclick="deleteVideo();" class="btn btn-danger">Featured</button><img src="images/photon/preloader/76.gif" alt="loader" style="width:5%; display:none;"/>
                 @endif
            </div></div>
    </form>
</div>
@stop