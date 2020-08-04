@extends('layouts.admin')
@section('content')

 
<style type="text/css">
  @import url(http://fonts.googleapis.com/css?family=Roboto);

/****** LOGIN MODAL ******/
.loginmodal-container {
  padding: 30px;
  max-width: 350px;
  width: 100% !important;
  background-color: #F7F7F7;
  margin: 0 auto;
  border-radius: 2px;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  overflow: hidden;
  font-family: roboto;
}

.loginmodal-container h1 {
  text-align: center;
  font-size: 1.8em;
  font-family: roboto;
}

.loginmodal-container input[type=submit] {
  width: 100%;
  display: block;
  margin-bottom: 10px;
  position: relative;
}

.loginmodal-container input[type=text], input[type=password] {
  height: 44px;
  font-size: 16px;
  width: 100%;
  margin-bottom: 10px;
  -webkit-appearance: none;
  background: #fff;
  border: 1px solid #d9d9d9;
  border-top: 1px solid #c0c0c0;
  /* border-radius: 2px; */
  padding: 0 8px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}

.loginmodal-container input[type=text]:hover, input[type=password]:hover {
  border: 1px solid #b9b9b9;
  border-top: 1px solid #a0a0a0;
  -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
}

.loginmodal {
  text-align: center;
  font-size: 14px;
  font-family: 'Arial', sans-serif;
  font-weight: 700;
  height: 36px;
  padding: 0 8px;
/* border-radius: 3px; */
/* -webkit-user-select: none;
  user-select: none; */
}

.loginmodal-submit {
  /* border: 1px solid #3079ed; */
  border: 0px;
  color: #fff;
  text-shadow: 0 1px rgba(0,0,0,0.1); 
  background-color: #4d90fe;
  padding: 17px 0px;
  font-family: roboto;
  font-size: 14px;
  /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#4787ed)); */
}

.loginmodal-submit:hover {
  /* border: 1px solid #2f5bb7; */
  border: 0px;
  text-shadow: 0 1px rgba(0,0,0,0.3);
  background-color: #357ae8;
  /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#357ae8)); */
}

.loginmodal-container a {
  text-decoration: none;
  color: #666;
  font-weight: 400;
  text-align: center;
  display: inline-block;
  opacity: 0.6;
  transition: opacity ease 0.5s;
} 

.login-help{
  font-size: 12px;
}

  button, td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    font-size: 12px !important;
}
</style>
 <aside class="right-side">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <!--section starts-->
               <h1>ENV CONFIGURATION</h1>
                @if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
@endif
            </section>
            <!--section ends-->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet box primary">
                            <div class="portlet-title">
                                <div class="caption">                                  
                                    
                                       
                                   
<button class="btn btn-warning" data-toggle="modal" data-target="#login-modal" >Database Setting</button>
<button class="btn btn-success" data-toggle="modal" data-target="#login-modal1">ERROR Setting</button>
<button class="btn btn-info" data-toggle="modal" data-target="#login-modal2">SMTP Setting</button>
<button class="btn btn-success" data-toggle="modal" data-target="#login-modal3">EMAIL Setting</button>
<button class="btn btn-warning" data-toggle="modal" data-target="#login-modal5">PAYMENT Setting</button>
<button class="btn btn-warning" data-toggle="modal" data-target="#login-modal6">Neft PAYMENT Setting</button>


                                </div>
                            </div>

                            <div class="portlet-body">
                                <table id="customers">
                                  <tr>
                                    <th>Serial No.</th>
                                    <th>Entity</th>
                                    <th>Parameters</th>
                                    
                                  </tr>
                            
                                  @foreach($exp as $key=>$env)
                                  <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $env[0] }}</td>
                                    @if(isset($env[1]))
                                    <td>{{ $env[1] }}</td>
                                    @endif
                                  </tr>
                                  @endforeach
                                </table>
                            </div>
                        </div>
                        <!-- END SAMPLE TABLE PORTLET-->
                    </div>
                       
                </div>
            </section>
            <!-- content -->
        </aside>
                





        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
        <div class="loginmodal-container">
          <h1>DATABASE SETTING</h1><br>
          <form action="{{'setting'}}" method="post">
              {{ csrf_field() }} 
          <span class="db">DATABASE NAME</span>
          <input type="text" required name="DB_DATABASE" placeholder="DB_DATABASE" value="{{env('DB_DATABASE')}}">
          <span class="db">USERNAME</span>
          <input type="text" required name="DB_USERNAME" placeholder="DB_USERNAME" value="{{env('DB_USERNAME')}}">
          <span class="db">HOST</span>
          <input type="text" required name="DB_HOST" placeholder="DB_HOST" value="{{env('DB_HOST')}}">
          <span class="db">PASSWORD</span>
          <input type="text" required name="DB_PASSWORD" placeholder="DB_PASSWORD" value="{{env('DB_PASSWORD')}}">
          <span class="db">PORT</span>
          <input type="text" required name="DB_PORT" placeholder="DB_PORT" value="{{env('DB_PORT')}}">
          <input type="submit" name="login" class="login loginmodal-submit" value="Add" >
          </form>
        </div>
      </div>
      </div>


      <div class="modal fade" id="login-modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
        <div class="loginmodal-container">
          <h1>SMTP SETTING</h1><br>
          <form action="{{'smtp'}}" method="post">
              {{ csrf_field() }}
          <input type="text" required name="MAIL_DRIVER" placeholder="MAIL_DRIVER" value="{{env('MAIL_DRIVER')}}">
          <input type="text" required name="MAIL_HOST" placeholder="MAIL_HOST" value="{{env('MAIL_HOST')}}">
          <input type="text" required name="MAIL_PORT" placeholder="MAIL_PORT" value="{{env('MAIL_PORT')}}">
          <input type="text" required name="MAIL_USERNAME" placeholder="MAIL_USERNAME" value="{{env('MAIL_USERNAME')}}">
          <input type="text" required name="MAIL_PASSWORD" placeholder="MAIL_PASSWORD" value="{{env('MAIL_PASSWORD')}}">
          <input type="text" required name="MAIL_ENCRYPTION" placeholder="MAIL_ENCRYPTION" value="{{env('MAIL_ENCRYPTION')}}">
          <input type="submit" name="login" class="login loginmodal-submit" value="Add">
          </form>
        </div>
      </div>
      </div>


      <div class="modal fade" id="login-modal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
        <div class="loginmodal-container">
          <h1>EMAIL SETTING</h1><br>
          <span>please Note:This will replace Your old email so please add with old email, if you put more than one email, Please add with comm(,) </span>
          <form action="{{'emailset'}}" method="post">
              {{ csrf_field() }}
          <input type="text" required name="RCC_EMAILS" placeholder="Register CC_EMAILS" value="{{env('RCC_EMAILS')}}">
          <input type="text" required name="PCC_EMAILS" placeholder="Payment CC_EMAILS" value="{{env('PCC_EMAILS')}}">
          <input type="text" required name="DCC_EMAILS" placeholder="Delegate CC_EMAILS" value="{{env('DCC_EMAILS')}}">
          <input type="text" required name="REQCC_EMAILS" placeholder="Request Invoice CC_EMAILS" value="{{env('REQCC_EMAILS')}}">
          <input type="submit" name="login" class="login loginmodal-submit" value="Add">
          </form>
        </div>
      </div>
      </div>


      <div class="modal fade" id="login-modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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

      <div class="modal fade" id="login-modal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
        <div class="loginmodal-container">
          <h1>Payment Setting</h1><br>
           <span>please Note: date formate should be "yy-mm-dd" </span>
          <form action="{{'payment/setting'}}" method="post">
              {{ csrf_field() }}
              <span class="db">PAYMENT COMPANY NAME</span>
         <select name="PAYMENT_ACCEPTANCE_COMPANY" class="form-control" required="">
          <option value="">Select any one</option>
           <option value="UAT">UAT</option>
            <option value="ADSERT">ADSERT</option>
            <option value="MEDIASET">MEDIASET</option>
         </select>
         <br>
         <span class="db">Normal Payment Amount</span>
          <input type="text" required name="AMOUNT" placeholder="Normal AMOUNT" value="{{env('AMOUNT')}}">
          <span class="db">Early Bird Payment Amount</span>
           <input type="text" required name="EARLYBIRD_AMOUNT" placeholder="EARLYBIRD AMOUNT" value="{{env('EARLYBIRD_AMOUNT')}}">
           <span class="db">Extended Payment Amount</span>
           <input type="text" required name="EXTENDED_AMOUNT" placeholder="EXTENDED AMOUNT" value="{{env('EXTENDED_AMOUNT')}}">
           <span class="db">Early Bird Payment Date</span>
           <input type="text" required name="EARLYBIRD_DATE" placeholder="yyyy-mm-dd only" value="{{env('EARLYBIRD_DATE')}}">
           <span class="db">Extended Payment Date</span>
           <input type="text" required name="EXTENDED_DATE" placeholder="yyyy-mm-dd only" value="{{env('EXTENDED_DATE')}}">
           <span class="db">ENTRY Closing Date</span>
           <input type="text" required name="ENTRY_CLOSE_DATE" placeholder="yyyy-mm-dd only" value="{{env('ENTRY_CLOSE_DATE')}}">
           
           <input type="submit" name="login" class="login loginmodal-submit" value="Add">
          </form>
        </div>
      </div>
      </div>

      <div class="modal fade" id="login-modal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
        <div class="loginmodal-container" style="padding: 15px;max-width: 650px;">
          <h1>PAYMENT SETTING</h1><br>
          <form action="{{'neftpaymentset'}}" method="post">
              {{ csrf_field() }}
            <label>HDFC NEFY DETAILS</label>
            <textarea name="NEFT1" class="editor1" id="editor1">{{Config::get('constants.NEFT1')}}</textarea>
              <label>STANDARD CHARTED NEFY DETAILS</label>
              <textarea  id="neft2" class="editor1" name="NEFT2">{{Config::get('constants.NEFT2')}}</textarea>
         <input type="submit" name="login" class="login loginmodal-submit" value="Add">
          </form>
        </div>
      </div>
      </div>
<script type="text/javascript">
  $(function() {
$('.editor1').each(function(){
    CKEDITOR.replace( $(this).attr('id'));
});
});
</script>    
@endsection
