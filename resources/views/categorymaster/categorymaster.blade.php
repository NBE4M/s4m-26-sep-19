@extends('layouts/master')

@section('title', 'Manage category - '.config('constants.sitename').'CMS')
@section('content')
<div class="panel">
    <div class="panel-content filler">
        <div class="panel-logo"></div>
        <div class="panel-header">
            <h1><small>Category Master</small></h1>
        </div>		
        <div class="panel-search container-fluid">
             <form class="form-horizontal" method="get" action="">
                
                    @if($parentId!='0')
                        <input type="hidden" name="id" value="{{$parentId}}"/>
                    @endif
                    
                    <input id="panelSearch" required  placeholder="Search" value="{{ isset($_GET['keyword']) ? $_GET['keyword']:'' }}" type="text" name="keyword">
                    
                    <button class="btn btn-search" type="submit"></button>
                     @if(isset($_GET['keyword'])) 
                     
                        <a href="{{url("category?channel=").$currentChannelId}}@if($parentId!='0')&id={{$parentId}}@endif"><button class="btn btn-default" type="button">Reset</button></a>
                       
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
                                    "title": "Add A New Category",
                                    "attr": {"href": "#tags"}
                                }
                            },
                            {
                                "data": {
                                    "title": "Existing Category",
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
                <a href="javascript:;">Category Master</a>
            </li>
        </ul>
    </div>           <header>
        <i class="icon-big-notepad"></i>
        <h2><small><a href="{{url('cms/category')}}">Category Master</a></small></h2>
        <h2> <small> 
         @foreach($parents as $parent)
         >> <a href="{{url('cms/category')}}?id={{$parent->category_id}}">{{$parent->name}}</a>
            @endforeach
             
            </small>
            </h2>
    </header>
    
    <div style="margin-bottom:20px;margin-right:20px;text-align:right;">
        @if($parentId==0)
        <a href="{{url('cms/category/create')}}">
            <button class="btn btn-default" id="draftSubmit" value="S" name="status" type="submit">Create New Category</button>
        @else
             <a href="{{url('cms/category/create')}}?id={{$parentId}}">
            <button class="btn btn-default" id="draftSubmit" value="S" name="status" type="submit">Create Sub Category</button>
        @endif    
        </a>
    </div>
    
    <form class="form-horizontal"method="POST" action="{{url('')}}/category/add" onsubmit="return validateCategoryData();">
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

        <div class="container-fluid">
            <div class="form-legend" id="tags3">Existing Category</div>
            <div class="row-fluid">
                <div class="span12">
                    <table class="table table-striped" id="tableSortable">
                        <thead>
                            <tr>
                                <th>Category ID</th>
                                <th>Category Hindi</th>
                                <th>Category English</th>
                                <th>Added By</th>
                                <th>Added On</th>
                                <th><input type="checkbox" class="uniformCheckbox" value="checkbox1" id="selectall"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $a)
                            <tr id="rowCur{{$a->category_id}}">
                                
                                <td>{{$a->category_id}}</td>
                                <td><a href="{{url('cms/category')}}/{{$a->category_id}}">{{$a->name}}</a{></td>
                                <td>{{$a->e_name}}</td>
                                <td>{{$a->userssname}}</td>
                                <td>{{$a->created_at}}</td>
                                <td>
                                    <input type="checkbox" class="uniformCheckbox" value="{{$a->category_id}}" name="checkItem[]">
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
            
             function deleteAuthor() {
                        var ids = '';
                        var checkedVals = $('input[name="checkItem[]"]:checkbox:checked').map(function () {
                            var row = 'rowCur' + this.value;
                           
                            return this.value;
                        }).get();
                        
                       // alert(2);
                        var ids = checkedVals.join(",");
                        //alert(ids);return false;
                        $.get("{{ url('/mastercategory/delete')}}",
                                {option: ids},
                        function (data) {
                            $.each(checkedVals, function (i, e) {
                                var row = 'rowCur' + e;
                                $("#" + row).remove();
                            });
                            $('#notificationdiv').show();
                            $('#notificationdiv .control-group .span12.span-inset').html('<div class="alert alert-success alert-block">\n\
                                <i class="icon-alert icon-alert-info"></i><button type="button" class="close" data-dismiss="alert">\n\
                                &times;</button><strong>This is Success Notification</strong>\n\
                                <span></span>Selected records dumped.</div>');
                           
                            //alert(1);
                        });
                    }
                    
        </script>

        </div>
      <div class="control-group row-fluid">
            <div class="span12 span-inset">
                <button type="button" onclick="deleteAuthor()" class="btn btn-danger">Dump</button><img src="images/photon/preloader/76.gif" alt="loader" style="width:5%; display:none;"/>							

            </div></div>
    </form>
</div> 
<script>
    function validateCategoryData(){
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
        }
 </script>
@stop