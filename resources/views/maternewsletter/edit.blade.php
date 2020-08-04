@extends('layouts/master')

@section('title', 'Edit Newsletter- S4M')

@section('content')

<div class="panel">
    <div class="panel-content filler">
        <div class="panel-logo"></div>
        <div class="panel-header">
            <h1><small>Edit Newsletter</small></h1>
        </div>

        <div class="panel-header">
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
                <a href="dashboard.html">
                    <i class="icon-photon home"></i>
                </a>
            </li>
            <li class="current">
                <a href="javascript:;">Edit Newsletter</a>
            </li>
        </ul>
    </div>           <header>
        <i class="icon-big-notepad"></i>
        <h2><small>Edit Newsletter</small></h2>

    </header>
    <div class="container-fluid">
    @if (Session::has('msg'))
                <div class="alert alert-success alert-block" style="">
                    <i class="icon-alert icon-alert-info"></i>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <span>{{ Session::get('msg') }}</span>
                </div>
                @endif
   <form method="post" id="upload_form" action="{{url('newsletterh/uploadimg')}}" accept="image/png" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
     <table class="table">
      <tr>
       <td width="40%" align="right"><label>Select File for Upload</label></td>
       <td width="40"><input type="file" name="select_file" id="select_file" /></td>
       <td width="30%" align="left"><input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload"></td>
      </tr>
     </table>
    </div>
   </form>
   <br />
   <span id="uploaded_image"></span>
  </div>
    {!! Form::open(array('url'=>'newsletter/update','class'=> 'form-horizontal','id'=>'validation_form', 'files' => true,'onsubmit'=>'return addmagazineissuefunction()')) !!}
    {!! csrf_field() !!}
      <div class="container-fluid" id="notificationdiv"  @if((!Session::has('message')) && (!Session::has('error')))style="display: none" @endif >

         <div class="form-legend" id="Notifications">Notifications</div>

        <!--Notifications begin-->
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

                @if (Session::has('error'))
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

            <div class="control-group row-fluid">
                <div class="span3">
                    <label class="control-label">Title </label>
                </div>
                <div class="span9">
                    <div class="controls">
                        <input type="hidden" name="newsletterId" value="{{$newsletter->id}}" id="newsletterId"/>
                        <input type="text" name="title" id="title" value="{{$newsletter->title}}">
                    </div>
                </div>
            </div>
            <div class="span12 span-inset">
                <button type="submit" name="status" value="Create" id="publishSubmit" class="btn btn-success">Update</button>
                @if($newsletter->status=='1')
                <button type="submit" name="deactivate" value="deactivate" id="deactivate" class="btn btn-danger">Deactivate</button>
                @else
                <button type="submit" name="activate" value="activate" id="activate" class="btn btn-danger">Activate</button>
                @endif
            </div> 

            <!--Select Box with Filter Search end-->                    
        </div>
 
        {!! Form::close() !!}
        <div class="form-horizontal">
             {!! Form::open(array('url'=>'newsletter/assign','class'=> 'form-horizontal','id'=>'validation_form', 'files' => true,'onsubmit'=>'return createNewsletter()')) !!}
    {!! csrf_field() !!}
            <input type="hidden" name="newsletterId" value="{{$newsletter->id}}" id="newsletterId1"/>

              <div class="container-fluid" style="margin-bottom:0 !important;">


            <div class="form-legend" id="tags3">Add in Newsletter</div> 

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
                                 window.location = '{{url("/newsletter/manage/".$newsletter->id)}}' + '?margin=' + $(this).attr("value").trim();
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
                                <th>Date of Publish</th>
                                <th>Author</th>
                                <th><input type="checkbox" class="uniformCheckbox" id="selectall" value="checkbox1"></th>
                            </tr>
                        </thead>
                        <tbody id="searchidtable">
                             @foreach($latestArticles as $article)
                            <tr class="gradeX">
                                <td>{{$article->article_id}}</a></td>
                                <td>{{$article->title}} </td>
                                <td class="center">{{$article->publish_date}}</td>
                                <td> {{$article->name}}</td>
                                <td class="center"> <input type="checkbox" class="uniformCheckbox" name="checkItem[]" value="{{$article->article_id}}"></td>
                            </tr>
                             @endforeach    
                            
                        </tbody>
                    </table>
                </div>
                
            </div>
            <!--Sortable Non-responsive Table end-->


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
        </div><!-- end container -->   

              <div class="container-fluid">

            <!--Sortable Non-responsive Table begin-->
            <div class="row-fluid">
                <div class="control-group row-fluid">
                    <div class="span12 span-inset text-right">
                        <!--  <button type="button" class="btn btn-warning">Preview Newsletter</button><img src="images/photon/preloader/76.gif" alt="loader" style="width:5%; display:none;"> -->                          
                        <button type="submit" class="btn btn-success" >Create Newsletter</button>
                    </div>
                </div>
            </div>
            </div>    

         {!! Form::close() !!}


             <div class="container-fluid">
            <div class="form-legend" id="tags3">Existing Newsletter</div>
            <div class="row-fluid">
                <div class="span12">
                    <table class="table table-striped" id="tableSortable">
                        <thead>
                            <tr>
                                <th>Article ID</th>
                                <th>Title</th>
                                <th>Date Of Publish</th>
                                <th>Author</th>
                                <th><input type="checkbox" class="uniformCheckbox" value="checkbox1" id="selectallN"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assignedArticles as $article)
                            <tr class="gradeX" id="item_<?php echo $article->asigned_id;?>">
                                <td>{{$article->article_id}}</a></td>
                                <td>{{$article->title}} </td>
                                <td class="center">{{$article->publish_date}}</td>
                                <td> {{$article->name}}</td>
                                <td class="center"> 
                                 <input type="checkbox" class="uniformCheckbox" name="checkItemN[]" value="{{ $article->asigned_id}}">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
             <div class="container-fluid">

            <!--Sortable Non-responsive Table begin-->
            @if($assignedArticles)
            <div class="row-fluid">
                <div class="control-group row-fluid">
                    <div class="span12 span-inset text-right">
            <a class="urlbind" href="" target="_blank"><button type="button" class="btn btn-warning">Preview Newsletter</button></a>                            
                        <button type="submit" class="btn btn-info" id="testmail" onclick="div_modalForm();">Send Test Mail</button>

                        <button type="submit" class="btn btn-success" id="livemail" onclick="div_modalForm2();">Send Live Mail</button>
                    </div>
                </div>
            </div>
            @endif
            </div>    

            <!--Sortable Non-responsive Table end-->


            <script>
                $(document).ready(function () {
                    $('#tableSortable, #tableSortableRes, #tableSortableResMed').dataTable({
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
                      $('#selectallN').click(function () {
                        if ($(this).is(':checked')) {
                            $('input[name="checkItemN[]"]').each(function () {
                                $(this).attr('checked', 'checked');
                            });
                        } else {
                            $('input[name="checkItemN[]"]').each(function () {
                                $(this).removeAttr('checked');
                            });
                        }
                    });
                });
                
                function createNewsletter() {
                    var ids = '';
                    
                    var checkedVals = $('input[name="checkItem[]"]:checkbox:checked').map(function () {
                        
                        return this.value;
                    }).get();
                    if (checkedVals.length > 0) {
                       return true;
                    } else {
                        alert('Please select at least one record.');
                        return false;
                    }
                }
                
                function deleteArticle() {
                        var ids = '';
                        var checkedVals = $('input[name="checkItemN[]"]:checkbox:checked').map(function () {
                           return this.value;
                        }).get();
                        if (checkedVals.length > 0) {
                            var ids = checkedVals.join(",");
                        }
                  
                        $.get("{{ url('/newsletter/delete')}}",
                                {option: ids},
                        function (data) {
                            if (data == 'success') {
                                location.reload();
                                    // $('#notificationdiv').show();
                                    // location.reload();
                            } else {
                                alert(data);
                            }
                            //alert(1);
                        });
                    
                }
                
            </script>
            
<script>
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  $("#tableSortable tbody").sortable({
      appendTo: "parent",
      helper: "clone",
      update: function (event, ui) {
        //alert($(this).html());
        var data = $(this).sortable('serialize');
        //alert(data);    
        // POST to server using $.post or $.ajax
                $.ajax({
                    data: data,
                    type: 'POST',
                        url: '{{ url("/newsletter/sort/".$newsletter->id)}}'
                });
        
    }
  }).disableSelection();

</script>


        </div>
         <div class="control-group row-fluid">
            <div class="span12 span-inset">
                @if(in_array('83',Session::get('user_rights')))
                <button type="button" class="btn btn-danger" onclick="deleteArticle()">Dump</button>
                @endif
            </div>
        </div>
        </div>
     
</div>
<!-- Modal -->
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" >
                    <span class="closeBtn" aria-hidden="true">&times;</span>
                    <span class="sr-only ">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Test Mailer</h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                     <div class="alert alert-danger" id="testwait" style="display: none;">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        Please Wait..........
                        </div>
                        <div class="alert alert-success fade in" id="testmessage" style="display: none;">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Success!</strong><span id="success_msg_after_send"></span> 
                        </div>
                 <form name="form" method="POST"  role="form" action="#" accept-charset="utf-8">
                    <input type="hidden" readonly class="form-control" value="" name="posttype" id="posttype" />
                    <input type="hidden" readonly class="form-control url" value="" name="url" id="url" />
                    <input type="hidden" readonly class="form-control" value="" name="desc" id="desc" />
                    <input  @if($newsletter->id=='8')type="text"@elsetype="hidden"@endif  class="form-control fromname" value="" name="fromname" id="fromname" />
                       <input type="hidden" readonly class="form-control" value="{{ Auth::user()->id }}" name="tuid" id="tuid" />
                  
                     <div class="form-group">
                        <label for="inputName">Mailer Type</label>
                        <input type="text" readonly class="form-control" style="margin-top: -8px" value="" name="typem" id="typem"/>
                    </div>
                    <div class="form-group" style="margin-top: -15px">
                        <label for="inputName">Subject</label>
                        <input type="text" class="form-control" name="subject" maxlength="115" required style="margin-top: -2px" id="subject" placeholder="Enter your Subject"/>
                        <span id="errorsubject" style="display: none;color: rgb(227, 80, 40);
    /* margin-top: 5px; */
    /* background: #c51244 !important; */
    padding: 10px !important;
    border-radius: 0 !important;
    position: relative;
    /* display: inline-block !important; */
    box-shadow: 1px 1px 1px #aaaaaa;">Please Enter Subject Line</span>
                    </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button"  class="btn btn-default closeBtn" data-dismiss="modal">Close</button>
                <button type="button" id="testmailsend" class="btn btn-success submitBtn">SUBMIT</button>
            </div>
             </form>
        </div>
    </div>
</div>
<!-- Modal -->
  <div class="modal fade" id="published_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color: #e35028">Alert</h4>
        </div>
        <div class="modal-body">
          <p id="already_newsletter"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- Modal -->
<script>
    $('.closeBtn').click(function(){
        location.reload();
    })
</script>
<script type="text/javascript">
    $(document).ready(function() {
  $("#testmailsend").on('click', function(e) {
    e.preventDefault();
    var postval = $("#posttype").val();
    var uid = $("#tuid").val();
    var subject = $("#subject").val();
    var desc = $("#desc").val();
    var url = $("#url").val();
    var fromname = $("#fromname").val();
    var csrf = "{{ csrf_token() }}";
    var sendval = $("#typem").val();
    if (subject=='') {
        $("#errorsubject").show();
         $("#subject").focus();
        return false;
    }
    $('.submitBtn').attr("disabled", true);
    var dataString = 'typem='+ typem + '&subject=' + encodeURIComponent(subject) + '&postval=' + postval + '&desc=' + desc +'&url=' + url +'&fromname=' + fromname +'&sendval=' + sendval +'&uid=' + uid + '&_token=' +csrf;
    
    $.ajax({
      type: 'POST',
      url: '/newsletter/sendmailer',
      data: dataString,
      beforeSend: function() {
              $("#testmessage").hide();
              $("#testwait").show();
               $("#errorsubject").hide();
           },
      success: function() {
         $("#testmessage").show();
              $("#testwait").hide();
              $("#subject").val('');
       /* $("#testmailsend").trigger("reset")
        $('#testmessage').fadeTo( "slow", 10 ).fadeTo(10000, 0);*/
      }
    });
  });
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
                var html = '<tr class="gradeX"><td>'+data.article_id+'</a></td><td>'+data.title+'</td><td class="center">'+data.publish_date+'</td><td>'+data.name+'</td><td class="center"><input type="checkbox" class="uniformCheckbox" name="checkItem[]" value="'+data.article_id+'"></td></tr>'
                $('#searchidtable').empty();
            $('#searchidtable').append(html);
        });
      }
    });
  });
});
</script>
<script type="text/javascript">

 $(document).ready(function() {
  $("#testmail").on('click', function() {
     var url = $(location).attr('href');
     var fn = url.split('/').reverse()[0];
     var dataString = 'id='+ fn;
       $.ajax({
    url: '{{Config::get('constants.Sitecrmurl')}}newsletterh/create',
    data: dataString,
    type: "GET", // not POST, laravel won't allow it
    success: function(data){
  if (fn=='1') {
    $('#desc').val('Morning Post test Newsletter has been sent');
  }
   if (fn=='2') {
    $('#desc').val('Breakingnews test Newsletter has been sent');
  }
  //  if (fn=='3') {
  //   $('#desc').val('Afternoon Post test Newsletter has been sent');
  // }
   if (fn=='3') {
    $('#desc').val('Evening Post test Newsletter has been sent');
  }
  //  if (fn=='5') {
  //   $('#desc').val('Breakingnews test Newsletter has been sent');
  // }
   if (fn=='4') {
    $('#desc').val('Custom test Newsletter has been sent');
  }
    $('#posttype').val(fn);
    $('#typem').val('testmail');
    $('#myModalLabel').text('Test Mailer')
    $('#success_msg_after_send').text('Test Mailer has been sent.');
        $('#modalForm').modal('toggle');
        $('#modalForm').modal('show');
      },
      error: function (jqXHR, status,data) {

              var msg = '';
              if (jqXHR.status === 0) {
                  msg = 'Not connect. Please Verify Network.';
              } else if (jqXHR.status == 407) {
                  msg = 'Requested page not found. [404]';
              } else if (jqXHR.status == 500) {
                  msg = 'Internal Server Error [500].';
              } else if (jqXHR.status === 408) {
                  msg = 'Please select atleast one answer !';
              } else if (exception === 'timeout') {
                  msg = 'Time out error.';
              } else if (exception === 'abort') {
                  msg = 'Ajax request aborted.';
              } else {
                  msg = 'Uncaught Error.\n' + jqXHR.responseText;
              }
              $('#already_newsletter').html(msg);
          },
  });

  });
});
</script>
<script type="text/javascript">
  $(document).ready(function() {
  $("#livemail").on('click', function() {
    var url = $(location).attr('href');
    var fn = url.split('/').reverse()[0];
    var dataString = 'id='+ fn;
    $.ajax({
    url: '{{Config::get('constants.Sitecrmurl')}}newsletterh/create',
    data: dataString,
    type: "GET", // not POST, laravel won't allow it
    success: function(data){
  if (fn=='1') {
    $('#desc').val('Morning Post Final Newsletter has been sent');
  }
   if (fn=='2') {
    $('#desc').val('Breaking news Final Newsletter has been sent');
  }
  if (fn=='3') {
    $('#desc').val('Evening Post test Newsletter has been sent');
  }
  //  if (fn=='4') {
  //   $('#desc').val('Evening Post Final Newsletter has been sent');
  // }
  //  if (fn=='5') {
  //   $('#desc').val('Breakingnews Final Newsletter has been sent');
  // }
  if (fn=='8') {
    $('#desc').val('custom news Final Newsletter has been sent');
  }
    $('#posttype').val(fn);
    $('#typem').val('livemail');
    $('#myModalLabel').text('Live Mailer');
    $('#success_msg_after_send').text('Live Mailer has been sent.');
        $('#modalForm').modal('toggle');
        $('#modalForm').modal('show');
    }
  });
});
  });
</script>

<script type="text/javascript">
    $(window).load(function() {
        var url = $(location).attr('href');
        var fn = url.split('/').reverse()[0];
        if (fn=='1') {
            var newurl = '{{Config::get('constants.SiteBaseurl')}}newsletter/morningnewsletter.html';
            $('a.urlbind').attr('href', newurl);
            $('.url').val(newurl);
            $('.fromname').val('samachar4media Morning Post');
        }
        if (fn=='2') {
            var newurl = '{{Config::get('constants.SiteBaseurl')}}newsletter/breakingnewsletter.html';
            $('a.urlbind').attr('href', newurl);
            $('.url').val(newurl);
            $('.fromname').val('samachar4media Breaking News ');
        }
        // if (fn=='3') {
        //     var newurl = '{{Config::get('constants.SiteBaseurl')}}newsletter/afternoonnewsletter.html';
        //     $('a.urlbind').attr('href', newurl);
        //     $('.url').val(newurl);
        //    /* $('.fromname').val('samachar4media Afternoon Post');*/
        //     $('.fromname').val('samachar4media Afternoon Post ');
            
        // }
        if (fn=='3') {
            var newurl = '{{Config::get('constants.SiteBaseurl')}}newsletter/eveningnewsletter.html';
            $('a.urlbind').attr('href', newurl);
            $('.url').val(newurl);
            $('.fromname').val('samachar4media Evening Post');
        }
        // if (fn=='5') {
        //     var newurl = '{{Config::get('constants.SiteBaseurl')}}newsletter/breakingnewsletter.html';
        //     $('a.urlbind').attr('href', newurl);
        //     $('.url').val(newurl);
        //     $('.fromname').val('samachar4media Breaking News');
        // }

          if (fn=='8') {
            var newurl = '{{Config::get('constants.SiteBaseurl')}}newsletter/customnewsletter.html';
            $('a.urlbind').attr('href', newurl);
            $('.url').val(newurl);
            $('.fromname').val('samachar4media custom News');
        }

    });
</script>


@stop
