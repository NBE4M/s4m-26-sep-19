@extends('layouts/master')

@section('title', 'Top Articles - S4MCMS')

@section('content')

<div class="panel">
    <div class="panel-content filler">
        <div class="panel-logo"></div>
       
        <div class="panel-search container-fluid">
           
        </div>

        <br><br><br><br><br><br>
        <div class="panel-header">
            <!--<h1><small>Page Navigation Shortcuts</small></h1>-->
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
                <a href="javascript:;">Editor Choice/Featured Articles</a>
            </li>
        </ul>
    </div>           <header>
        <i class="icon-big-notepad"></i>
        <h2><small>Top/Featured Articles</small></h2>
    </header>
    <div class="form-horizontal">

       
    </div>
    <form class="form-horizontal">
        <div class="container-fluid">

            <!--Sortable Non-responsive Table begin-->
            <div class="row-fluid">
                <div class="span12">
                     <center><h4>Featured News</h4></center>
                         <table class="table table-striped" id="tableSortablef">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Story Type</th>
                                <th>Sequnce</th>
                                <th>Date,Time</th>
                                <th><input type="checkbox" class="uniformCheckbox" value="checkbox1" id="selectallDel"></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($data1 as $d)
                            <tr class="gradeX"   id="item_<?php echo $d->id;?>">
                                <td>{{$d->story_key_id}}</td>
                                <td><a href="{{url('')}}/article/{{ $d->story_key_id }}">{{ $d->title }}</a>
                                </td>
                                  <td>{{ $d->story_type }}</td>
                                  <td>{{ $d->sequence }}</td>
                                <td class="center">
                                    <a href="{{url('')}}/article/{{ $d->story_key_id }}">{{ $d->created_at }}</a>
                
                                </td>
                                 <td class="center"> <input type="checkbox" class="uniformCheckbox" name="checkItemDel[]" value="{{ $d->story_key_id }}" ></td>  

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="control-group row-fluid">
            <div class="span12 span-inset">
                @if(in_array('13',Session::get('user_rights')))
                <button type="button" class="btn btn-danger" onclick="deleteArticle()">Dump</button><img src="images/photon/preloader/76.gif" alt="loader" style="width:5%; display:none;"/>
                @endif
            </div>
        </div>
                    <hr>
                    <hr style="border: 1px solid #d0d0d0">
                    <center><h4>Editor Choices News</h4></center>
                                        <div class="form-horizontal" style="border: 1px solid #d0d0d0">
             {!! Form::open(array('url'=>'newsletter/assign','class'=> 'form-horizontal','id'=>'validation_form', 'files' => true,'onsubmit'=>'return createNewsletter()')) !!}
    {!! csrf_field() !!}
           

              <div class="" style="margin-bottom:10px !important;">


            <div class="form-legend" id="tags3">Add Article in Custom Section</div> 

            <div class="row-fluid">
                
                <div class="span12">

                    <div class="controls pull-right">
                        <select name="daysfilter" id="daysfilter" >
                            <option value="1" @if($margin==1) selected="selected" @endif >24 Hours</option>
                            <option value="2" @if($margin==2) selected="selected" @endif >2 Days</option>
                            <option value="3" @if($margin==3) selected="selected" @endif >3 Days</option>
                            <option value="5" @if($margin==5) selected="selected" @endif >5 Days</option>
                            <option value="7" @if($margin==7) selected="selected" @endif >7 Days</option>
                            <option value="15" @if($margin==15) selected="selected" @endif >15 Days</option>
                            <option value="30" @if($margin==30) selected="selected" @endif >1 Month</option>
                        </select>
                    </div>
                    <script>
                        $().ready(function () {
                            $("#daysfilter").select2();
                            $("#daysfilter").change(function(){
                                 window.location = '{{url("/newsletter/manage/")}}' + '?margin=' + $(this).attr("value").trim();
                            });
                        });
                    </script>
                    <div class="pull-left" style="width: 40%">
                        <input type="text" name="idSearch" id="idSearch" style="width: 50%; float: left;">
                        <input type="button" value="search" id="btnsearch" style="margin:17px 0px 0px 11px;">
                    </div>
<table class="table table-striped" id="tableSortable2">
                        <thead>
                            <tr>
                                <th>Article ID</th>
                                <th>Title</th>
                                <th>Sequence</th>
                                <th>Date,Time</th>
                                <th><input type="checkbox" class="uniformCheckbox" value="checkbox1" id="selectall"></th>
                            </tr>
                        </thead>
                        <tbody id="searchidtable">
                            @foreach($articles as $article)
                            <tr class="gradeX"   id="item_<?php echo $article->article_id;?>">
                                <td>{{$article->article_id}}</td>
                                <td><a href="{{url('')}}/article/{{ $article->article_id }}">{{ $article->title }}</a>
                                </td>
                                <td>{{ $article->priority }}</td>
                                <td class="center"><a href="{{url('')}}/article/{{ $article->article_id }}">{{ $article->publish_date }}</a>
                                    <a href="{{url('')}}/article/{{ $article->article_id }}">{{ $article->publish_time }}</a>
                                </td>
                                <td class="center"> <input type="checkbox" class="uniformCheckbox" name="checkItem[]" value="{{ $article->article_id }}" ></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
            <!--Sortable Non-responsive Table end-->


<!--             <script>
                $(document).ready(function () {
                    $('#tableSortable2, #tableSortableRes, #tableSortableResMed').dataTable({
                        "sPaginationType": "bootstrap",
                        "iDisplayLength": 50,
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
            </script> -->
        </div><!-- end container -->   
</div>
         {!! Form::close() !!}

                    

                </div>

            </div>
            <!--Sortable Non-responsive Table end-->
<div class="dataTables_paginate paging_bootstrap pagination">

                {!! $articles->appends(Input::get())->render() !!}
            </div>
          <div class="span12 span-inset">
            <button type="button" class="btn btn-info" id="addArticle">Add Articles</button>
        
    </div>
        </div><!-- end container -->
         
    </form>

</div>
 <script>
                $(document).ready(function () {
                    $('#tableSortable2, #tableSortableRes, #tableSortableResMed').dataTable({
                        "sPaginationType": "bootstrap",
                        "iDisplayLength": 50,
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

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#addArticle').click(function(){
        var checkedVals = $('input[name="checkItem[]"]:checkbox:checked').map(function () {
                        return this.value;
                    }).get();
        if (checkedVals.length > 0) {

                        var ids = checkedVals.join(",");
                        $.post("{{ url('/custom/article/')}}",
                                {option: ids},

                        function (response,data) {
                            if (data.trim() == 'success') {
                                $.each(response, function (i, e) {
                                    alert(e);
                                    
                                });
                                
                                
                            
                                
                            } else {
                                alert(data);
                            }

                            location.reload();
                        }
                        );

                    } else {
                        alert('Please select at least one record.');
                    }

    })
    
</script>
 <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     var list  = $( "#tableSortablef tbody" ).sortable({
         appendTo: "parent",
      helper: "clone",
        update:function(event, ui) {
            event.preventDefault();
            $.ajax({
               type:'POST',
               url:'{{ url("/priority/sortC")}}',
               data: $(this).sortable('serialize'),
            });
            location.reload();
             // $('#tableSortablef tbody').append('<tr>' + text + '<td></td></tr>');

        // list.sortable('refresh');
        }
    });

          function deleteArticle() {
                    var ids = '';
                    var checkedVals = $('input[name="checkItemDel[]"]:checkbox:checked').map(function () {
                        //var row = 'rowCur' + this.value;
                        //("#" + row).hide();
                        return this.value;
                    }).get();
                    if (checkedVals.length > 0) {

                        var ids = checkedVals.join(",");

                        $.get("{{ url('/articlecustom/delete/')}}",
                                {option: ids},
                        function (data) {
                            if (data.trim() == 'success') {
                                $.each(checkedVals, function (i, e) {
                                    location.reload();
                                    var row = 'rowCur' + e;
                                    $("#" + row).remove();
                                });
                                location.reload();
                                $('#notificationdiv').show();
                                $('#notificationdiv .control-group .span12.span-inset').html('<div class="alert alert-success alert-block">\n\
                            <i class="icon-alert icon-alert-info"></i><button type="button" class="close" data-dismiss="alert">\n\
                            &times;</button><strong>This is Success Notification</strong>\n\
                            <span></span>Selected records dumped.</div>');
                                
                            } else {
                                alert(data);
                            }

                            //alert(1);
                        });

                    } else {
                        alert('Please select at least one record.');
                    }

                }

      $('#btnsearch').click(function(){
    var id = $('#idSearch').val();
    $.ajax({
      type: 'POST',
      url: '{{url("newsletter/searchidresult/")}}/'+id,
      // data: dataString,
      // beforeSend: function() {
      //       $("#testmessage").hide();
      //       $("#testwait").show();
      //       $("#errorsubject").hide();
      //      },
      success: function(data) {
            $.each(data, function() {
                var html = '<tr class="gradeX"><td>'+data.article_id+'</td><td>'+data.title+'</td><td class="center">0</td><td>'+data.publish_date+'</td><td class="center"><input type="checkbox" class="uniformCheckbox" name="checkItem[]" value="'+data.article_id+'"></td></tr>'
                $('#searchidtable').empty();
            $('#searchidtable').append(html);
        });
      }
    });
  });            
   
</script>

<style type="text/css">
    .radio input[type="radio"], .checkbox input[type="checkbox"] {
        opacity: 1 !important;
    }
</style>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@stop