<!doctype html>
<html>
<head>
  <meta charset="utf-8">
<title>समाचार4मीडिया- मीडिया की दुनिया की खबरें,  विज्ञापन जगत की खबरें | Media News, Advertising News, Media Industry Updates – Samachar4media</title>
  <meta name="title" content="समाचार4मीडिया- मीडिया की दुनिया की खबरें,  विज्ञापन जगत की खबरें | Media News, Advertising News, Media Industry Updates – Samachar4media">
<meta name="description" content="मीडिया, विज्ञापन और सोशल मीडिया की दुनिया की खबरों के लिए पढ़ें समाचार4मीडिया
 | Samachar4media has best and latest media news, advertising news, media industry updates for more information visit our website."/>
<meta name="keywords" content="Latest News of  Print Media, News Channels, Digital Media, Hindi Media, Hindi Journalists हिदी पत्रकारिता, पत्रकार, मीडिया, खबरें, मीडिया की दुनिया की खबरें,breaking newsletter, samachar4media breaking newsletter" />
  <title>Samachar4Media Breaking Newsletter </title>
  

</head>

<body style="background: #F4F4F4;">

  <!-- main -->
  <table align="center" width="560" border="0" cellpadding="0" cellspacing="0" style="padding: 10px;">
    <tbody>
      <tr>
        <td>


          <table width="560" border="0">
            <tbody>
              <!--header-->
              @if(isset($parents[5]))  
                  @if($parents[5]->status==1)
                  {!!$parents[5]->bscript!!}
                  @else 
                  @endif 
                @else
              @endif
              
              <!--header-->

              <!--blank-->
              <tr>
                <td width="560" height="5"></td>
              </tr>
              <!--blank-->

              <!-- date-->
              <tr>
                <td>
                  <table cellpadding="4" bgcolor="#ffffff" width="560" border="0" style="border-radius: 8px;">
                    <tbody>
                      <tr>
                        <td align="left" valign="middle" style="font-size: 25px;font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif';">
                          <strong>
                            <span style="color: #ee7e22; font-size: 25px;">ब्रेकिंग  </span> 
                            <span style="font-size: 25px;">न्यूज़ </span>
                          </strong>
                        </td>
                        <td align="right" valign="middle" style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0px; font-size: 18px;">
                          <strong>
                            <span style="font-size: 23px;color: #ee7e22;">{{date('D d')}}<sup>{{date('S')}}</sup>
                            </span>{{date('F Y')}}
                          </strong>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <!-- date-->

              <!--blank-->
              <tr>
                <td width="560" height="5"></td>
              </tr>
              <!--blank-->
              
              <!--top news-->
              <tr>
                <td valign="middle">
                  <table bgcolor="#ffffff" width="560" border="0" cellpadding="8" cellspacing="0" style="border-radius: 8px;">
                    <tbody>
                      <tr>
                        <td>
                          <a href="{{$ArrViewArticle->url}}" target="_blank">
                            <img src="{{Config::get('constants.awsbaseurl')}}{{ $ArrViewArticle->photopath }}" width="545" alt="{{$ArrViewArticle->phototitle}}" onerror="this.onerror=null;this.src='{{asset("images/top-story.jpg")}}';" style="border-radius: 8px;">
                          
                        </a>
                      </td>
                    </tr>

                    <tr>
                      <td align="center" valign="middle" style="line-height: 27px;font-size: 16px; color: #000000;">
                        <a href="#" style="color: #000000;font-size: 16px; text-decoration: none;"><strong>
                          {{Str::limit($ArrViewArticle->title , $limit = 90, $end = '...')}}
                        </strong>
                        </a>  
                      </td>
                    </tr>

                    <tr><td><hr style="border: dashed 0.5px #dadada; margin-top: 0px;" width="450"></td></tr>

                    <tr>
                      <td align="center">
                        <table align="center" cellpadding="10" width="480" border="0" bgcolor="#f9f9f9" style="font-size: 15px; line-height: 27px;border-left: solid #ee7e22;border-right: solid #ee7e22;">
                          <tbody>
                            <tr>
                              <td align="center" valign="middle">
                                {{Str::limit($ArrViewArticle->summary , $limit = 200, $end = '...')}}
                              </td>
                            </tr>
                          </tbody>
                        </table>

                      </td>
                    </tr>



                    <tr>
                      <td align="center">
                        <table align="center" width="260" border="0">
                          <tbody>
                            <tr>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="https://www.facebook.com/sharer.php?u={{$ArrViewArticle->url}}&utm_source=newsletter&utm_medium=facebook&utm_campaign=facebook&utm_term=facebook&utm_content=facebook" target="_blank" >
                                    <img src="{{url('images/fb.jpg')}}" width="25">
                                  </a>
                                </td>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="https://twitter.com/intent/tweet?url={{ $ArrViewArticle->url }}&text={{ preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $ArrViewArticle->title)}}
&via=samachar4media&utm_source=newsletter&utm_medium=twitter&utm_campaign=twitter&utm_term=twitter&utm_content=twitter"" target="_blank">
                                    <img src="{{url('images/tw.jpg')}}" width="25">
                                  </a>
                                </td>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="https://www.linkedin.com/shareArticle??mini=true
&url={{$ArrViewArticle->url}}
&title={{preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $ArrViewArticle->title)}}
&summary={{$ArrViewArticle->summary}} 
&source=samachar4media.com&utm_source=newsletter&utm_medium=linkedin&utm_campaign=linkedin&utm_term=linkedin&utm_content=linkedin"" target="_blank">
                                    <img src="{{url('images/link.jpg')}}" width="25">
                                  </a>
                                </td>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="https://api.whatsapp.com/send?text={{preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $ArrViewArticle->title)}}  {{$ArrViewArticle->url}}&utm_source=newsletter&utm_medium=whatsapp&utm_campaign=whatsapp&utm_term=whatsapp&utm_content=whatsapp" target="_blank">
                                    <img src="{{url('images/wtsup.jpg')}}" width="25">
                                  </a>
                                </td>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="mailto:?subject={{preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $ArrViewArticle->title)}}- samachar4media&body=Hi,%0A
 I thought you'd like this:%0A%0A
{{$ArrViewArticle->url}}&utm_source=desktop&utm_medium=email&utm_campaign=email&utm_term=email&utm_content=email" target="_blank">
                                    <img src="{{url('images/mail.jpg')}}" width="25">
                                  </a>
                                </td>
                              </tr>
                          </tbody>
                        </table>

                      </td>
                    </tr>



                  </tbody>
                </table>

              </td>
            </tr>
            <!--top news-->
            

            <!--blank-->
            <tr>
              <td width="560" height="5"></td>
            </tr>
            <!--blank-->
            @if(isset($parents[6]))  
                  @if($parents[6]->status==1)
                  {!!$parents[6]->bscript!!}
                  @else 
                  @endif 
                @else
              @endif
            <!--footer-->
            <!--blank-->
              <tr>
                <td width="560" height="5"></td>
              </tr>
              <!--blank-->
            <tr>
              <td>
                <table cellpadding="0" bgcolor="#ffffff" width="560" border="0" style="border-radius: 8px; padding-top: 10px;">
                  <tbody>
                    <tr>
                      <td align="center" valign="middle" style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; font-size: 14px;">
                        <strong>If you're having trouble viewing this email, please 
                          <a href="{{Config::get('constants.storagepath').'newsletter/breaking-post-'.date('d-m-Y').'.html'}}" style="color: #3796b5; text-decoration: none;">click here</a>.
                        </strong>
                      </td>
                    </tr>

                    <tr>
                      <td valign="middle">
                       <table align="center" border="0" cellpadding="5">
                        <tbody>
                          <tr>
                        <td align="center" valign="middle">
                          <p style="margin: 0px;font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; font-size: 14px;">
                            <strong>Follow Us:</strong>
                          </p>
                        </td>
                        <td align="center" valign="middle" style="line-height: 0px;">
                          <a href="https://www.facebook.com/Samachar4media/" target="_blank">
                            <img src="{{url('images/fb.jpg')}}" width="25" style="width: 25px;">
                          </a>
                        </td>
                        <td align="center" valign="middle" style="line-height: 0px;">
                          <a href="https://twitter.com/samachar4media?lang=en" target="_blank">
                            <img src="{{url('images/tw.jpg')}}" width="25" style="width: 25px;">
                          </a>
                        </td>
                        <td align="center" valign="middle" style="line-height: 0px;">
                          <a href="https://www.linkedin.com/company/samachar4media-com/" target="_blank">
                            <img src="{{url('images/link.jpg')}}" width="25" style="width: 25px;">
                          </a>
                        </td>
                        <td align="center" valign="middle" style="line-height: 0px;">
                          <a href="https://wb.messengerpeople.com/?widget_hash=bac86292cde7a4444b6fbc935e586d7d&lang=en&wn=2&pre=1" target="_blank">
                            <img src="{{url('images/wtsup.jpg')}}" width="25" style="width: 25px;">
                          </a>
                        </td>
                        <td align="center" valign="middle" style="line-height: 0px;">
                          <a href="https://www.youtube.com/channel/UCqMEhxJQQaFwLH4PUtXjQcw" target="_blank">
                            <img src="{{url('images/youtube.jpg')}}" width="25" style="width: 25px;">
                          </a>
                        </td>
                        <td valign="bottom">
                          <p style="margin: 0px;font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; font-size: 11px;">                            
                          </p>
                        </td>
                      </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>



                </tbody>
              </table>

            </td>
          </tr>
          <!--footer-->




          <tr>
            <td align="center" valign="middle">
             <table align="center" width="200" border="0" style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif';
             font-size: 11px;">
             <tbody>
              <tr>
                <td align="right"></td>
                <td width="110" align="center" valign="middle"><img src="{{url('images/s4m-logo.jpg')}}" width="110"></td>
                <td align="left" valign="middle"><strong>© {{date('Y')}}</strong></td>
              </tr>
            </tbody>
          </table>

        </td>
      </tr>


    </tbody>
  </table>




</td>
</tr>
</tbody>
</table>
<!-- main -->
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/social.js')}}"></script>

</body>
</html>
