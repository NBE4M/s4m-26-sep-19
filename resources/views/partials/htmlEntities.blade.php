@extends('layouts/master')

@section('title', 'Edit Html Entities - S4MCMS')


@section('content')

<div class="panel">
    <div class="panel-content filler">
        <div class="panel-logo"></div>
        <div class="panel-header">
            <h1><small>Edit Html Entities</small></h1>
        </div>
   
        
       
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
            <a href="javascript:;">Edit Html Entities</a>
        </li>
    </ul>
</div>           <header>
               <i class="icon-big-notepad"></i>
               <h2><small>Edit Html Entities</small></h2>
              
           </header>
            {!! Form::open(array('url'=>'breaking-news/store','class'=> 'form-horizontal','id'=>'form1')) !!}
            {!! csrf_field() !!}
                
            <div class="container-fluid" id="notificationdiv"  @if((!Session::has('message')) && (!Session::has('error')) && (count($errors->all())==0) )style="display: none" @endif >

                <div class="form-legend" id="Notifications">Notifications</div>

                <!--Notifications begin-->
                <!-- <div class="control-group row-fluid">
                    <div class="span12 span-inset">
                        @if (count($errors) > 0)
                        <div class="alert alert-error alert-block">
                            <i class="icon-alert icon-alert-info"></i>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>This is Error Notification</strong>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            
                        </div>
                        @endif              
                    </div>
                </div> -->
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
                        
                        <!-- @if (Session::has('error'))
                        <div class="alert alert-error alert-block">
                            <i class="icon-alert icon-alert-info"></i>
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>This is Error Notification</strong>
                            <span>{{ Session::get('error') }}</span>
                        </div>
                        @endif -->
                    </div>
                </div>
                <!--Notifications end-->

            </div>
                
                <div class="container-fluid">
                        <div class="form-legend" id="new">Create A New Admin Profile</div>
                              <div class="control-group row-fluid">
                                                <div class="span3">
                                                    <label class="control-label" for="inputField">Label</label>
                                                </div>
                                                <div class="span9">
                                                    <div class="controls">
                                                        <select name="label" id="labelSelect">
                                                          <option value="1">BREAKING NEWS</option>
                                                          <option value="2">CUSTOM </option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="control-group row-fluid label-append">
                                                

                                            </div>
                                            <div class="control-group row-fluid">
                                                <div class="span3">
                                                    <label class="control-label" for="inputField">Title</label>
                                                </div>
                                                <div class="span9">
                                                    <div class="controls">
                                                        <textarea  name="news_title" rows="2" class="no-resize  title_range valid" ></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="control-group row-fluid">
                                                <div class="span3">
                                                    <label class="control-label" for="inputField">Url</label>
                                                </div>
                                                <div class="span9">
                                                    <div class="controls">
                                                        <input name="news_url" class="no-resize  title_range valid" style="width: 99%">
                                                    </div>
                                                </div>

                                            </div>
                                           <div class="control-group row-fluid">
                                                <div class="span3">
                                                    <label class="control-label" for="inputField">Status</label>
                                                </div>
                                                <div class="span9">
                                                <select name="status">
                                                  <option value="Active">Active</option>
                                                  <option value="Inactive">Inactive</option>
                                                  
                                                </select>
                                                </div>
                                           </div>     
                                            
                                            
                                            <!--Simple Select Box end-->
                                             
<!--                                               <div class="control-group row-fluid">
                                                    <div class="span3">
                                                        <label class="control-label">Channel</label>
                                                    </div>
                                                    <div class="span3">
                                                        <label class="radio">
                                                            <input type="checkbox" checked name="BW" class="uniformRadio" value="1">
                                                            BW Businessworld
                                                        </label>
                                                    </div>
                                                    <div class="span3">
                                                        <label class="radio">
                                                            <input type="checkbox" name="BWH" class="uniformRadio" value="2">
                                                            BW Hotelier
                                                        </label>
                                                    </div>
                                                </div>-->
                                            
                                            

                                            <div class="control-group row-fluid">
                                            <div class="span12 span-inset">
                                                <button class="btn btn-warning pull-right" type="submit" name="add" style="display:block;">Add</button>
                                            </div>
                                        </div>
                                  

                </div>

              <div class="container-fluid">


                       <!--Sortable Responsive Media Table begin-->
                       <div class="row-fluid">
                           <div class="span12">
                               <table class="table table-striped table-responsive" id="tableSortableResMed">
                                   <thead class="cf sorthead">
                                       <tr>
                                           <th>S.No.</th>
                                           <th>Label</th>
                                           <th>Title</th>
                                           <th>Url</th>
                                           <th>Status</th>
                                           <!-- <th>Channel Name</th> -->
                                           <!-- <th><input type="checkbox" class="uniformCheckbox" value="checkbox1">
                                                <label class="radio">
                                                            Select
                                                        </label>
                                           </th> -->
                                       </tr>
                                   </thead>
                                   <tbody>
                                    @if(isset($newsData))
                                       @foreach($newsData as $bN)
                                       <tr class="gradeX" id="rowCur{{$bN->news_id}}">
                                           <td style="width:20px;">{{$bN->news_id}}</td>
                                           <td>{{$bN->news_label}}</td>
                                           <td >{{$bN->news_title}}</td>                                   
                                           <td  class="center">
                                            <a href="{{$bN->news_url}}" target="_blank">{{$bN->news_url}}</a>
                                              </td>
                                            <td><a class="newsedit" data-title="{{$bN->news_title}}" data-status ="{{$bN->status}}" id="{{$bN->news_id}}" data-url="{{$bN->news_url}}" data-toggle="modal" data-target="#myModal">{{$bN->status}}</a></td>  
                                       </tr>
                                       @endforeach
                                    @endif                                          
                                   </tbody>
                               </table>

                           </div>
                           
                       </div>
                       <!--Sortable Responsive Media Table end-->
                       <div class="dataTables_paginate paging_bootstrap pagination">

                {!! $newsData->appends(Input::get())->render() !!}
            </div>
                        <!-- <div class="control-group row-fluid">
                                            <div class="span12 span-inset">
                                                <button class="btn btn-danger pull-right" onclick="deleteUser();" type="button" name="delete" style="display:block;">Delete</button> 
                                                <a href="cms-right-management.html">
                                                    <button class="btn btn-warning pull-right" type="submit" name="edit" style="display:block; margin-right:10px">Modify</button>
                                                </a>
                                            </div>

                                        </div> -->
                           
                        
           </div><!-- end container -->
           <!-- <script>
                       $(document).ready(function() {
                           $('#tableSortable, #tableSortableRes, #tableSortableResMed').dataTable( {
                               "sPaginationType": "bootstrap",
                               "aaSorting": [] ,
                              "aoColumnDefs": [ { "bSortable": false, "aTargets": [2] } ],
                               "fnInitComplete": function(){
                                   $(".dataTables_wrapper select").select2({
                                       dropdownCssClass: 'noSearch'
                                   });
                               }
                           });
                           //                            $("#simpleSelectBox").select2({
                           //                                dropdownCssClass: 'noSearch'
                           //                            }); 
                       });
                   </script> -->
                   
                
       {!! Form::close() !!}
   </div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Breaking News Edit</h4>
      </div>
      <form action="{{url('breaking/update')}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="news_id" id="newsid_update" value="">
        <div class="modal-body">
        <textarea  name="news_title" rows="2" class="no-resize  title_range valid title_update" ></textarea>
        <input type="text" name="news_url" id="news_url" value="">
        <select name="status" class="update_status">
                                                       
        </select>
        <button type="submit" style="float: right;">Update</button>
      </div>
      </form>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>
  $(document).ready(function(){
    $('.newsedit').click(function(){
      $('.update_status').empty();
      $id = $(this).attr('id');
      $status = $(this).attr('data-status');
      $title = $(this).attr('data-title');
      $url = $(this).attr('data-url');
      $('.title_update').text($title);
      $('#newsid_update').val($id);
      $('#news_url').val($url);
      $('.update_status').append('<option value="'+$status+'">'+$status+'</option><option value="Active">Active</option><option value="Inactive">Inactive</option>');
    })

  })
  $('#labelSelect').change(function(){
    var a = $(this).val();
    if (a == 2) {
      $('.label-append').append('<div class="span3"><label class="control-label" for="inputField">Add Custom Label</label></div><div class="span9"><div class="controls"><input name="news_label" class="no-resize title_range valid" required style="width:99%"></div></div>')
    }else{
      $('.label-append').empty();
      return false;
    }
    
  })
</script>
@stop