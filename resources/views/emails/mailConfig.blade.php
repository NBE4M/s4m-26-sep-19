@extends('layouts/master')

@section('title', 'Mail Config - S4MCMS')

@section('content')
<style>
  .mail-edit input{margin-top: 6px;}
  .mail-edit h1{font-size:18px;  font-weight: bold; margin-top: 0px;}
  .mail-edit span{font-weight: bold;}
</style>
   
      <div class="modal fade" id="login-modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;padding: 20px">
        <div class="modal-dialog">
        <div class="loginmodal-container mail-edit">
          <h1>SMTP SETTING</h1>
          <form action="{{'smtp'}}" method="post">
              {{ csrf_field() }}
          <span class="db">MAIL_DRIVER</span>
          <input type="text" required name="MAIL_DRIVER" placeholder="MAIL_DRIVER" value="{{env('MAIL_DRIVER')}}">
          <span class="db">MAIL_HOST</span>
          <input type="text" required name="MAIL_HOST" placeholder="MAIL_HOST" value="{{env('MAIL_HOST')}}">
          <span class="db">MAIL_PORT</span>
          <input type="text" required name="MAIL_PORT" placeholder="MAIL_PORT" value="{{env('MAIL_PORT')}}">
          <span class="db">MAIL_USERNAME</span>
          <input type="text" required name="MAIL_USERNAME" placeholder="MAIL_USERNAME" value="{{env('MAIL_USERNAME')}}">
          <span class="db">MAIL_PASSWORD</span>
          <input type="text" required name="MAIL_PASSWORD" placeholder="MAIL_PASSWORD" value="{{env('MAIL_PASSWORD')}}">
          <span class="db">MAIL_ENCRYPTION</span>
          <input type="text" required name="MAIL_ENCRYPTION" placeholder="MAIL_ENCRYPTION" value="{{env('MAIL_ENCRYPTION')}}">
          <input type="submit" name="login" class="login loginmodal-submit" value="Add">
          </form>
        </div>
      </div>
      </div>


      <div class="modal fade" id="login-modal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;padding: 20px">
        <div class="modal-dialog">
        <div class="loginmodal-container mail-edit">
          <h1>EMAIL SETTING</h1><br>
          <span>please Note:This will replace Your old email so please add with old email, if you put more than one email, Please add with comm(,) </span>
          
          <form action="{{url('mail/config/update')}}" method="post">
              {{ csrf_field() }}
          @foreach($exp as $key=>$env)
          <span class="db">{{ $env[0] }}</span>
          <input type="text" required name="{{ $env[0] }}" placeholder="{{ $env[0] }}" value="{{ $env[1] }}">
          @endforeach
          
          <input type="submit" name="login" class="login loginmodal-submit" value="Add">
          </form>
          
        </div>
      </div>
      </div>


      <div class="modal fade" id="login-modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;padding: 20px">
        <div class="modal-dialog">
        <div class="loginmodal-container">
          <h1>Set Env APP_DEBUG</h1><br>
          <form action="{{'debug'}}" method="post">
              {{ csrf_field() }}
         <select name="envset" class="form-control">
           <option>true</option>
            <option>false</option>
         </select>
           <input type="submit" name="login" class="login loginmodal-submit" value="Add">
          </form>
        </div>
      </div>
      </div>


      
<div class="panel">
    <div class="panel-content filler">
        <div class="panel-logo"></div>
        <div class="panel-header">
            <h1><small>Mail Master</small></h1>
        </div>
        <div class="panel-search container-fluid">

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
            <a href="javascript:;">Mail Master</a>
        </li>
    </ul>
</div>           <header>
               <i class="icon-big-notepad"></i>
               <h2><small>Mail Master</small></h2>
              
           </header>
       
          <div class= 'form-horizontal'>    
            <div class="container-fluid" id="notificationdiv"  @if((!Session::has('message')) && (!Session::has('error')) && (count($errors->all())==0) )style="display: none" @endif >

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
            <div class="container-fluid text-center" >
						
<button class="btn btn-success" data-toggle="modal" data-target="#login-modal1">ERROR Setting</button>
<button class="btn btn-info" data-toggle="modal" data-target="#login-modal2">SMTP Setting</button>
<button class="btn btn-success" data-toggle="modal" data-target="#login-modal3">EMAIL Setting</button>

                                  

                </div>

                
                
              <div class="container-fluid">


                       <!--Sortable Responsive Media Table begin-->
                       <div class="row-fluid">
                           <div class="span12">
                               <table class="table table-striped table-responsive" id="tableSortableResMed">
                                   <thead class="cf sorthead">
                                       <tr>
                                           <th>S.No.</th>
                                           <th>Name</th>
                                           <th>Email-ID</th>
                                           <!-- <th>Channel Name</th> -->
                                           <th><!--<input type="checkbox" class="uniformCheckbox" value="checkbox1">-->
                                           		<label class="radio">
                                                            Select
                                                        </label>
                                           </th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                                                             
                                   </tbody>
                               </table>

                           </div>
                           
                       </div>
                       <!--Sortable Responsive Media Table end-->
                       
                        <div class="control-group row-fluid">
                                            <div class="span12 span-inset">
                                                <button class="btn btn-danger pull-right" onclick="deleteUser();" type="button" name="delete" style="display:block;">Delete</button> 
                                                <!--<a href="cms-right-management.html">
                                                	<button class="btn btn-warning pull-right" type="submit" name="edit" style="display:block; margin-right:10px">Modify</button>
                                                </a>-->
                                            </div>
                                        </div>
                           

           </div><!-- end container -->
				   
				
       </div> 

@stop