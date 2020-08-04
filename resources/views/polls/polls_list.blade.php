@extends('layouts/master')

@section('title', 'Poll list - S4MCMS')

@section('content')
 
<div class="panel">
    <div class="panel-content filler">
        <div class="panel-logo"></div>
        <div class="panel-header">
            <h1><small>Poll list</small></h1>
        </div>
        



        <script>
            $().ready(function () {
                $(".uniformRadio").uniform({
                    radioClass: 'uniformRadio'
                });

            });
        </script>
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
                                    "title": "Poll list",
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
                <a href="javascript:;">Poll list</a>
            </li>
        </ul>
    </div>           <header>
        <i class="icon-big-notepad"></i>
        <h2><small>Poll list</small></h2>

    </header>
<div class="container-fluid" style="margin-bottom: 10px">
  <div class="row-fluid">

        <div class="col-md-12 col-xs-12 text-right">

            <a class="btn btn-primary btn-md btn-flat" id='addarticle' href="{{url('admin/polls/create')}}">Add Poll</a>

                    

        </div>

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
                                <th>#</th>

                                    <th>Published On</th>

                                    <th>Title</th>

                                    <th>Question</th>

                                    <th>Published</th>

                                    <th>Status</th>

                                    <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($polls as $key)

                                    <tr id="{{$key->id}}">

                                        <td><span class="glyphicon glyphicon-align-justify"></td>

                                        <td>{{$key->created_at}}</td>

                                         

                                        <td>{{$key->title}}</td>

                                        <td>{{$key->question}}</td>

                                        <td>

                                            @if($key->status == 1)  
                                        <a href="{{url('admin/polls/'.$key->id.'/unpublish')}}" class="btn btn-primary btn-flat btn-xs bg-green">UnPublished </a>                                    

                                            @else
                                            <a href="{{url('admin/polls/'.$key->id.'/publish')}}" class="btn btn-primary btn-flat btn-xs bg-orange"> Published   </a>
                                             
                                            @endif
                                        
                                        </td>

                                        <td id="status">

                                        @if(($key->status)==1)
                                             

                                                <span class="greencls" id="{{$key->id}}"  value='{{$key->status}}' onClick="UpdateStatus(this)">Active</span>

                                        @else

                                                <span class="redcls" id="{{$key->id}}" value='{{$key->status}}' onClick="UpdateStatus(this)">Inactive</span>

                                        @endif

                                        <input type="hidden" value="{{$key->id}}"/>

                                        </td>

                                        <td><a href="{{url('admin/polls/'.$key->id.'/edit')}}"  >Edit</a>
                                          <a href="{{url('admin/polls/'.$key->id.'/delete')}}"  > Delete   </a>
                                        
                                        </td>

                                    </tr>

                                @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <!--Sortable Responsive Media Table end-->
            
        </div><!-- end container -->
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

        
    </form>
</div>
@stop