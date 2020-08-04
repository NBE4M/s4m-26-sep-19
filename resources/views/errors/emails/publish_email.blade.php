 <!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Thank You Mailer</title>
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
<table width="550" border="0" cellpadding="0" cellspacing="0" align="center" style="border:dashed 2px #353458; border-radius:20px; display:block; padding:15px; margin-top:20px; margin-left:auto; margin-right:auto;">
  <tr>
    <td width="100%" align="center" valign="top" bgcolor="#ffffff"><!-- One Column -->
      
      <table width="550"  class="deviceWidth" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#ffffff" style="margin:0 auto;">
        <tr>
          <td valign="top" style="padding:0; height:139px;" align="center" bgcolor="#ffffff"><img  class="deviceWidth" src="{{url('img/thanks/header3.png')}}" alt="thank you header" border="0" height="139" /></td>
        </tr>
        <tr>
          <td style="padding:10px;" bgcolor="#e1f5fb" align="left">
              <p style="font-weight:bold; color:#353458; font-size:16px; margin-bottom:5px;">Dear All,</p>
                <p style="font-size:14px; line-height:18px; font-weight:bold; color:#404040;">{{$name}} has published a story. Below is the link:</p>
            </td>
        </tr>
        
      </table>
      <div style="height:15px;margin:0 auto;">&nbsp;</div>
      <table width="550" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" bgcolor="#ffffff" style="margin:0 auto;">
        <tr>
          <td>
          <table align="left" width="58%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
              <tr>
                <td style="font-size: 12px; color: #444444; font-weight: normal; text-align: left; line-height: 18px; vertical-align: top; padding:0px 8px 10px 8px"><table>
                    <tr>
                      <td valign="middle" style="padding:0 10px 5px 0; text-decoration: none; font-size: 16px; color: #444444; text-decoration:none; font-weight: bold; font-family:Arial, sans-serif;"><a href="{{$url}}" style="color:#444444; text-decoration:none;">{{$title}}</a></td>
                    </tr>
                  </table>
                  <p style="mso-table-lspace:0;mso-table-rspace:0; margin:0"> {{$summary}}
                    <br/>
                  
                  <table width="120" align="right">
                    <tr>
                      <td bgcolor="#409ea8" style="padding:5px 0;background-color:#ffffff; border:1px solid #a7a7a7; background-repeat:repeat-x" align="center"><a href="{{$url}}"
                                                        style="
                                                        color:#000000;
                                                        font-size:13px;
                                                        font-weight:bold;
                                                        text-align:center;
                                                        text-decoration:none;
                                                        font-family:Arial, sans-serif;
                                                        -webkit-text-size-adjust:none; color:#3F51B5;"> Read Full Story </a></td>
                    </tr>
                  </table>
                  </p></td>
              </tr>
            </table>
          <table align="right" width="40%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth" style="margin-bottom:15px;">
              <tr>
                <td valign="top" align="center" class="center"><a href="{{$url}}"><img src="{{Config::get('constants.SiteCmsurl')}}{{ $photopath }}" alt="" width="220"></a></td>
                
              </tr>
              <tr>
                <td align="center" style="padding-top:5px;">
                  <table border="0" align="center" cellspacing="0" cellpadding="0">
                            <tbody><tr>
                              <td align="center"><table border="0" cellspacing="0" cellpadding="0">
                                  <tbody><tr>
                                    <td align="right" valign="top"><a href="#" target="_blank"> <img src="{{url('img/thanks/fb-icon.png')}}" height="20" alt="Facebook" border="0" style="display:block; max-width: 20px"> </a></td>
                                    <td width="5"></td>
                                    <td align="right" valign="top" class="social"><a href="#" target="_blank"> <img src="{{url('img/thanks/twitter-icon.png')}}" height="20" alt="Twitter" border="0" style="display:block; max-width: 20px"> </a></td>
                                    <td width="5"></td>
                                    <td align="right" valign="top" class="social"><a href="#" target="_blank"> <img src="{{url('img/thanks/linkedin-icon.png')}}" height="20" alt="Linkedin" border="0" style="display:block; max-width: 20px"> </a></td>
                                    <td width="5"></td>
                                    <td align="right" valign="top" class="social"><a href="#" target="_blank"> <img src="{{url('img/thanks/whatsapp.png')}}" height="20" alt="Youtube" border="0" style="display:block; max-width: 20px"> </a></td>
                                  </tr>
                                </tbody></table></td>
                            </tr>
                          </tbody></table>
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
      <table width="550" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" style="margin:0 auto;">
        <tr>
          <td style="font-size:20px; font-weight:bold;">Our Upcoming Events:</td>
        </tr>
        <tr>
      <td style="padding:10px 0">
            <table align="left" width="48%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth" style="margin-bottom:15px;">
              <tr>
                <td valign="top" align="left" class="center"><a href="#"><img width="267" src="https://storage.googleapis.com/news-photo/events-banner/event-banner-1.gif" alt="" border="0" style="border-radius: 4px; width: 267px; display: block;" class="deviceWidth" /></a></td>
              </tr>
              <tr>
                <td valign="top" align="center" style="font-size:15px; padding-top:5px; font-weight:bold; color:#444444;"><a href="#" style="text-decoration:none; color:#3F51B5;"></a></td>
              </tr>
            </table>
            <table align="right" width="48%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth" style="margin-bottom:15px;">
              <tr>
                <td valign="top" align="right" class="center"><a href="#"><img width="267" src="https://storage.googleapis.com/news-photo/events-banner/event-banner-2.gif" alt="" border="0" style="border-radius: 4px; width: 267px; display: block;" class="deviceWidth" /></a></td>
              </tr>
              <tr>
                <td valign="top" align="center" style="font-size:15px; padding-top:5px; font-weight:bold; color:#444444;"><a href="#" style="text-decoration:none; color:#3F51B5;"></a></td>
              </tr>
            </table>
            <table align="left" width="48%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
              <tr>
                <td valign="top" align="left" class="center"><a href="#"><img width="267" src="https://storage.googleapis.com/news-photo/events-banner/event-banner-3.gif" alt="" border="0" style="border-radius: 4px; width: 267px; display: block;" class="deviceWidth" /></a></td>
              </tr>
              <tr>
                <td valign="top" align="center" style="font-size:15px; padding-top:5px; font-weight:bold; color:#444444;"><a href="#" style="text-decoration:none; color:#3F51B5;"></a></td>
              </tr>
            </table>
            <table align="right" width="48%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
              <tr>
                <td valign="top" align="right" class="center"><a href="#"><img width="267" src="https://storage.googleapis.com/news-photo/events-banner/event-banner-4.gif" alt="" border="0" style="border-radius: 4px; width: 267px; display: block;" class="deviceWidth" /></a></td>
              </tr>
              <tr>
                <td valign="top" align="center" style="font-size:15px; padding-top:5px; font-weight:bold; color:#444444;"><a href="#" style="text-decoration:none; color:#3F51B5;"></a></td>
              </tr>
            </table>
      </td>
        </tr>
      </table>
      </td>
  </tr>
</table>

<table width="550" border="0" cellpadding="0" cellspacing="0" align="center" style="margin-bottom:20px; margin-left:auto; margin-right:auto;">
  <tr> 
          <!-- SOCIAL -->
          <td align="right" width="300" style="padding:10px;"><table border="0" cellspacing="0" cellpadding="0">
              <tbody><tr>
                <td align="left" valign="middle" class="social"> Follow Us: </td>
                
                <td align="right" valign="top" class="social" style=""><a href="https://www.facebook.com/exchange4media" target="_blank"> <img src="{{url('img/thanks/fb-icon-color.png')}}" height="24" width="24" alt="Facebook" border="0" style="display:block; max-width: 24px"> </a></td>
                <td width="5"></td>
                <td align="right" valign="top" class="social"><a href="https://twitter.com/e4mtweets" target="_blank"> <img src="{{url('img/thanks/twitter-icon-color.png')}}" height="24" width="24" alt="Twitter" border="0" style="display:block; max-width: 24px"> </a></td>
                <td width="5"></td>
                <td align="right" valign="top" class="social"><a href="https://in.linkedin.com/company/exchange4media" target="_blank"> <img src="{{url('img/thanks/linkedin-icon-color.png')}}" height="24" width="24" alt="Linkedin" border="0" style="display:block; max-width: 24px"> </a></td>
                <td width="5"></td>
                <td align="right" valign="top" class="social"><a href="#" target="_blank"> <img src="{{url('img/thanks/youtube-icon-color.png')}}" height="24" width="24" alt="Youtube" border="0" style="display:block; max-width: 24px"> </a></td>
              </tr>
            </tbody></table></td>
          <!-- END SOCIAL --> 
        </tr>
</table>

</body>
</html>
