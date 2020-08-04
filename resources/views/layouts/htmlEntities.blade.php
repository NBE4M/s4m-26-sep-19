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
          </div>           
          <header>
               <i class="icon-big-notepad"></i>
               <h2><small>Edit Html Entities</small></h2>
              
           </header>
            
                
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
<aside  style="margin-left: 50px;">
            <!-- Content Header (Page header) -->
            <section >
                <!--section starts-->
                <h1>Uploads</h1>
                 
            </section>
            <!--section ends-->
            <section >
                <!--main content-->
                <div class="row">
                    <!--row starts-->
                    <div class="col-lg-12">
                        <!--lg-6 starts-->
                        <!--basic form starts-->
                        <div id="hidepanel1" class="panel panel-primary" style="position: relative;width: 98%;padding: 1%">
                                <div  class="panel-heading">
                                <h3 class="panel-title">
                                Upload Images
                                </h3>
                                </div>
                                <div class="panel-body">
                                <form files="true" class="dropzone" id="image-upload" action="{{url('/panel/dropzoneUploadFile')}}" method="post"  enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" name="user_id" class="form-control" value="{{Auth::user()->id}}">
                                </form>
                                </div>
                        </div>
                        <!--basic form 2 starts-->
                       

                                <div class="container" style="text-align: left;width: 99%" >
                                @if(isset($css))
                                @foreach($css as $k)
                                <div style=" display: inline-block; width: 14%; overflow: hidden; max-height: 150px; margin: 2px; background: #fff; border-radius: 6px; padding: 5px;">
                                <a class="lightbox">
                                    
                                  <div class="col-sm-1 img-thumbnail " > <p class="head">{{$k}}</p><span class="csss" id="{{$k}}"> {{file_get_contents(Config::get('constants.New_storagepath').'css/'.$k, true)}} </span> </div>
                               </a> 
                             </div>
                                @endforeach
                                @endif
                                <!-- @if(isset($js))
                                @foreach($js as $k)
                                <div style=" display: inline-block; width: 14%; overflow: hidden; max-height: 150px; margin: 2px; background: #fff; border-radius: 6px; padding: 5px;">
                                <a class="lightbox">
                                  <div class="col-sm-1 img-thumbnail " ><p class="head">{{$k}}</p><span class="jsss" id="{{$k}}">  {{file_get_contents(Config::get('constants.storagepath').'js/'.$k, true)}}</span> </div>
                               </a> 
                             </div>
                                @endforeach
                                @endif -->
                                </div>

 <!-- <div class="modal fade" id="enlargeImageModal" tabindex="-1" role="dialog" aria-labelledby="enlargeImageModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <img src="" class="enlargeImageModalSource" style="width: 100%;">
        </div>
      </div>
    </div>
</div> -->

                                </div>
                    <!--md-6 ends-->
                     
                </div>

                <!--main content ends--> </section>
            <!-- content --> </aside>

   </div>
   <div class="modal fade" id="enlargeImageModal1" tabindex="-1" role="dialog" aria-labelledby="enlargeImageModal1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form action="{{url('panel/css/update')}}" method="post" >
        <input type="hidden" name="entityName" id="eCssName">
        <div class="modal-header"><span class="csshead"></span>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <div  class="enlargeImageModalSource1" style="width: 100%;"></div>
        </div>
        <button type="submit" style="    font-size: 16px;
    text-align: center;
    margin: 10px 425px;
    background: blue;
    color: white;
    font-weight: 700;">Update</button>
        </form>
      </div>
    </div>
</div>
<div class="modal fade" id="enlargeImageModal2" tabindex="-1" role="dialog" aria-labelledby="enlargeImageModal2" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form action="{{url('panel/js/update')}}" method="post" >
        <input type="hidden" name="entityName" id="eName">    
        <div class="modal-header"><span class="jshead"></span>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <div  class="enlargeImageModalSource2" style="width: 100%;"></div>
        </div>
        <button type="submit" style="    font-size: 16px;
    text-align: center;
    margin: 10px 425px;
    background: blue;
    color: white;
    font-weight: 700;">Update</button>
        </form>
      </div>
    </div>
</div>
<link href="{{url('css/uploadimg.css')}}" rel="stylesheet">
                <script src="{{url('js/uploadimage.js')}}"></script>
                <script type="text/javascript">
                Dropzone.options.imageUpload = {
                maxFilesize  : 1,
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.css,.js"
                };
                </script>
                <script type="text/javascript">
                    $(function() {
        $('img').on('click', function() {
            $('.enlargeImageModalSource').attr('src', $(this).attr('src'));
            $('#enlargeImageModal').modal('show');
        });
});
                    $(function() {
        $('.csss').on('click', function() {
            var txt = $(this).text();
            $('.enlargeImageModalSource1').html("<textarea rows='23' cols='130' name='css'>"+txt+"</textarea>");
            $('.csshead').html($(this).attr('id'));
            $('#eCssName').val($(this).attr('id'));
            $('#enlargeImageModal1').modal('show');
        });
});
                    $(function() {
        $('.jsss').on('click', function() {
            var txt = $(this).text();
            $('.enlargeImageModalSource2').html("<textarea rows='23' cols='130' name='jva'>"+txt+"</textarea>");
            $('.jshead').html($(this).attr('id'));
            $('#eName').val($(this).attr('id'));
            $('#enlargeImageModal2').modal('show');
        });
});
                </script>
<style type="text/css">a.lightbox img {
height: 150px;
    border: 3px solid white;
    box-shadow: 0px 0px 8px rgba(0,0,0,.3);
    margin: 3px 14px 13px 1px;
}</style>

@stop