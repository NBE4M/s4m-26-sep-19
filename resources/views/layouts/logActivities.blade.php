@extends('layouts/master')

@section('title', 'Log Activity - E4MCMS')


@section('content')

    <div class="panel" style="left: 33px;width: 365px;">
        <div class="panel-content filler">
            <div class="panel-logo"></div>
            <div class="panel-header">
                <h1><small>Log Activity</small></h1>
            </div>
            <div class="panel-search container-fluid">
                <form class="form-horizontal" method="get" action="">
                    @if(isset($_GET['keyword']))
                    <input id="panelSearch" required  placeholder="Search" value="{{$_GET['keyword'] or ''}}" type="text" name="keyword">
                    @endif
                    <button class="btn btn-search" type="submit"></button>
                    @if(isset($_GET['searchin']))
                        <a href="{{url("logActivity")}}"><button class="btn btn-default" type="button">Reset</button></a>
                    @endif

                    <label class="radio">
                        <input type="radio" @if(isset($_GET['searchin'])) @if($_GET['searchin']=='article_id') checked @endif @endif required name="searchin" class="uniformRadio" value="article_id">
                        Search by Article ID
                    </label>
                    <label class="radio">
                        <input type="radio" @if(isset($_GET['searchin'])) @if($_GET['searchin']=='name') checked @endif @endif required name="searchin" class="uniformRadio" value="name">
                        Search by Name
                    </label>

                </form>
            </div>



            <script>
                $().ready(function () {
                    $(".uniformRadio").uniform({
                        radioClass: 'uniformRadio'
                    });



                        $('.uniformRadio').find("option:selected").each(function () {

                            if ($(this).attr("value").trim().length != 0) {

                                window.location = '{{url("logActivity")}}' + $(this).attr("value").trim();
                            }

                            else if ($(this).attr("value") == "none") {

                                $("#quote_list").hide();

                            }

                        });





                });
            </script>
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
                                        "title": "Log Activity",
                                        "attr": {"href": "#Basic_Non-responsive_Table"}
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
                    <a href="/dashboard">
                        <i class="icon-photon home"></i>
                    </a>
                </li>
                <li class="current">
                    <a href="javascript:;">Log Activity</a>
                </li>

            </ul>

        </div>           <header>
            <i class="icon-big-notepad"></i>
            <h2><small>Log Activity</small></h2>
        </header>




        <form class="form-horizontal">

            <div class="container-fluid" id="notificationdiv"  @if((!Session::has('message')) && (!Session::has('error')))style="display: none" @endif >

                <div class="form-legend" id="Notifications">Notifications</div>

                <div class="control-group row-fluid">
                    <div class="span12 span-inset">
                        @if (Session::has('message'))
                            <div class="alert alert-success alert-block" style="">
                                <i class="icon-alert icon-alert-info"></i>
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>This is Success Notification</strong>
                                <span>{{ Session::get('message') }}</span>
                            </div>
                        @endif
                        <div class="alert alert-block" style="display:none">
                            <i class="icon-alert icon-alert-info"></i>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>This is Alert Notification</strong>
                            <span>No result found.</span>
                        </div>
                        @if (Session::has('error'))
                            <div class="alert alert-error alert-block">
                                <i class="icon-alert icon-alert-info"></i>
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>This is Error Notification</strong>
                                <span>{{ Session::get('error') }}</span>
                            </div>
                        @endif
                        <div class="alert alert-error alert-block"style="display:none">
                            <i class="icon-alert icon-alert-info"></i>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>This is Error Notification</strong>
                            <span>Please enter a valid email id.</span>
                        </div>

                    </div>
                </div>

            </div>

            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                        <table class="table table-striped" id="tableSortable">
                            <thead>
                            <tr>
                                  <th>Name</th>
                                <th>Activity Description</th>
                                 <th>Time Ago </th>
                                <th>Activity Date-Time </th>
                                <!-- <th>Activity Type</th> -->
                                <th>Activity Perform on Article</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!--                            <tr class="gradeX">
                                                        <td><a href="create-new-articles.html">234567890987654</a></td>
                                                        <td><a href="create-new-articles.html">English poetry is receiving lesser attention these days: Aju Mukhopadhyay English poetry is receiving lesser attention these days: Aju Mukhopadhyay</a>
                                                        </td>
                                                        <td><a href="create-new-articles.html">Brigadier CHITRANJAN SAWANT,VSM</a></td>
                                                        <td class="center"><a href="create-new-articles.html">11/03/2013</a>
                                                            <a href="create-new-articles.html">12:13 pm</a>
                                                        </td>
                                                        <td class="center"> <input type="checkbox" class="uniformCheckbox" value="checkbox1"></td>
                                                    </tr>-->

                            @foreach($log_activity as $log)

                                <tr class="gradeC" >
                                    <td>{{$log->name}}</td>
                                    <td>{{$log->description}}</td>
                                    <td>{{ Carbon\Carbon::parse($log->event_date)->diffForHumans()}}</td>
                                   <td>{{date('j M Y', strtotime($log->event_date))}}, {{date('h:i:s a', strtotime($log->event_time))}}</td>
                                   <!--  <td>{{$log->event_type}}</td> -->
                                   @if($log->article_id == 0)
                                    <td> </td>
                                    @else   
                                    <td>{{$log->article_id}}</td>
                                    @endif                             
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <!--Sortable Non-responsive Table end-->


                <script>
                    $(document).ready(function () {
                        $('#tableSortable, #tableSortableRes, #tableSortableResMed').dataTable({
                            bInfo: false,
                            bPaginate: false,
                            "aaSorting": [],
                            "aoColumnDefs": [{"bSortable": false, "aTargets": [4]}],
                            "fnInitComplete": function () {
                                $(".dataTables_wrapper select").select2({
                                    dropdownCssClass: 'noSearch'
                                });
                            }
                        });
                        //                            $("#simpleSelectBox").select2({
                        //                                dropdownCssClass: 'noSearch'
                        //                            });

                        $('#selectall').click(function () {
                            if ($(this).is(':checked')) {
                                $('input[name="checkItem[]"]').each(function () {
                                    $(this).attr('checked', 'checked');
                                });
                            } else {
                                $('input[name="checkItem[]"]').each(function () {
                                    $(this).removeAttr('checked');
                                });
                            }
                        });

                    });




                </script>
                <div class="dataTables_paginate paging_bootstrap pagination">

                    {!! $log_activity->appends(Input::get())->render() !!}
                </div>
            </div><!-- end container -->

        </form>
    </div>


@stop