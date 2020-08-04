<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Samachar4media Preview Story</title>
<style type="text/css">
.ReadMsgBody { width: 100%; background-color: #ffffff;}
.ExternalClass { width: 100%; background-color: #ffffff;}
body {width: 100%; background-color: #ffffff; margin: 0; padding: 0; -webkit-font-smoothing: antialiased; font-family:Arial, Helvetica, sans-serif; }
*{ padding:0px; margin:0px;}
table { border-collapse: collapse; }
@media only screen and (max-width: 640px) {
.deviceWidth { width: 440px!important; padding: 0;}
.center {text-align: center!important;}
}
@media only screen and (max-width: 479px) {
.deviceWidth { width: 280px!important; padding: 0;}
.center {text-align: center!important;}
}
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="font-family: Arial, Helvetica, sans-serif">
<table width="870" border="0" cellpadding="0" cellspacing="0" align="center" style="border:dashed 2px #353458; border-radius:20px; display:block; padding:15px; margin-top:20px; margin-left:auto; margin-right:auto;">
  <tr>
    <td width="100%" align="center" valign="top" bgcolor="#ffffff"><!-- One Column -->
      
      <table width="870"  class="deviceWidth" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#ffffff" style="margin:0 auto;">
        <tr>
          <td valign="top" style="padding:0; height:139px;" align="center" bgcolor="#ffffff"><img  class="deviceWidth" src="{{url('images/logo.png')}}" alt="thank you header" border="0" height="139" /></td>
        </tr>
        
      </table>

      <div style="height:15px;margin:0 auto;">&nbsp;</div>

      <table width="870" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" bgcolor="#ffffff" style="margin:0 auto;">
        <tr>
          <td>
          <table align="left" width="100%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
              <tr>
                <td style="font-size: 12px; color: #444444; font-weight: normal; text-align: left; line-height: 18px; vertical-align: top; padding:0px 8px 10px 8px"><table>
                    <tr>
                      <td valign="middle" style="padding:0 10px 5px 0; text-decoration: none; font-size: 16px; color: #444444; text-decoration:none; font-weight: bold; font-family:Arial, sans-serif;"><a href="#" style="color:#444444; text-decoration:none;">{{$article->title }}</a></td>
                    </tr>
                  </table>
                  
                  </td>
              </tr>
            </table>
          <table align="right" width="100%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth" style="margin-bottom:15px;">
              <tr>
                <td valign="top" align="center" class="center"><a href="{{$article->url }}"><img src="{{Config::get('constants.SiteCmsurl')}}{{$article->photopath }}" alt="" width="870"></a></td>
                
              </tr>

              <tr>
                <td style="mso-table-lspace:0;mso-table-rspace:0; margin:0; font-size:13px; line-height:20px;">
                  
                    <br/>
                  
                  
                </td>
              </tr>
              
            </table>
            
            </td>
        </tr>
        <tr>
          <td bgcolor="#353458"><div style="height:6px">&nbsp;</div></td>
        </tr>
      </table>

      <div style="height:15px;margin:0 auto;">&nbsp;</div>

      <table width="870" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" style="margin:0 auto;">
      	<tr>
        	<td style="font-size:20px; font-weight:bold;">Story</td>
        </tr>
        <tr>
    			<td style="padding:10px 0; font-size: 13px; line-height: 22px;">
             {!!$article->description!!}
    			</td>
        </tr>
      </table>
      </td>
  </tr>
</table>



</body>
</html>
