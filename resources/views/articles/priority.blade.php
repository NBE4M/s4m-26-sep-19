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
                                <th><input type="checkbox" class="uniformCheckbox" value="checkbox1" id="selectall"></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($data as $d)
                            <tr class="gradeX"   id="item_<?php echo $d->id;?>">
                                <td>{{$d->story_key_id}}</td>
                                <td><a href="{{url('')}}/article/{{ $d->story_key_id }}">{{ $d->title }}</a>
                                </td>
                                  <td>{{ $d->story_type }}</td>
                                  <td>{{ $d->sequence }}</td>
                                <td class="center">
                                    <a href="{{url('')}}/article/{{ $d->story_key_id }}">{{ $d->created_at }}</a>
                
                                </td>
                                  <td class="center"> <input type="checkbox" class="uniformCheckbox" name="checkItem[]" value="{{ $d->story_key_id }}" ></td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <center><h4>Editor Choices News</h4></center>
                    <table class="table table-striped" id="tableSortable">
                        <thead>
                            <tr>
                                <th>Article ID</th>
                                <th>Title</th>
                                <th>Sequence</th>
                                <th>Date,Time</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articles as $article)
                            <tr class="gradeX"   id="item_<?php echo $article->article_id;?>">
                                <td>{{$article->article_id}}</td>
                                <td><a href="{{url('')}}/article/{{ $article->article_id }}">{{ $article->title }}</a>
                                </td>
                                <td>{{ $article->priority }}</td>
                                <td class="center"><a href="{{url('')}}/article/{{ $article->article_id }}">{{ $article->publish_date }}</a>
                                    <a href="{{url('')}}/article/{{ $article->article_id }}">{{ $article->publish_time }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--Sortable Non-responsive Table end-->

          
        </div><!-- end container -->


        <div class="control-group row-fluid">
            <div class="span12 span-inset">
                @if(in_array('13',Session::get('user_rights')))
                <button type="button" class="btn btn-danger" onclick="deleteArticle()">Dump</button><img src="images/photon/preloader/76.gif" alt="loader" style="width:5%; display:none;"/>
                @endif
            </div>
        </div>
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

          <!--  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var list = $( "#tableSortable tbody" ).sortable({
      appendTo: "parent",
      helper: "clone",
        update:function(event, ui) {
            event.preventDefault();
            $.ajax({
               type:'POST',
               url:'{{ url("/priority/sort")}}',
               data: $(this).sortable('serialize'),
            });
             $('#tableSortable tbody').append('<tr>' + text + '<td></td></tr>');
        list.sortable('refresh');
        }
    });
</script> -->
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
               url:'{{ url("/priority/sortf")}}',
               data: $(this).sortable('serialize'),
            });
            location.reload();
             // $('#tableSortablef tbody').append('<tr>' + text + '<td></td></tr>');

        // list.sortable('refresh');
        }
    });

          function deleteArticle() {
                    var ids = '';
                    var checkedVals = $('input[name="checkItem[]"]:checkbox:checked').map(function () {
                        //var row = 'rowCur' + this.value;
                        //("#" + row).hide();
                        return this.value;
                    }).get();
                    if (checkedVals.length > 0) {

                        var ids = checkedVals.join(",");

                        $.get("{{ url('/articlef/delete/')}}",
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
   
</script>

<style type="text/css">
    .radio input[type="radio"], .checkbox input[type="checkbox"] {
        opacity: 1 !important;
    }
</style>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@stop