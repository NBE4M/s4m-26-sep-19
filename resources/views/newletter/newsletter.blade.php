<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>समाचार4मीडिया- मीडिया की दुनिया की खबरें,  विज्ञापन जगत की खबरें | Media News, Advertising News, Media Industry Updates – Samachar4media</title>
  <meta name="title" content="समाचार4मीडिया- मीडिया की दुनिया की खबरें,  विज्ञापन जगत की खबरें | Media News, Advertising News, Media Industry Updates – Samachar4media">
<meta name="description" content="मीडिया, विज्ञापन और सोशल मीडिया की दुनिया की खबरों के लिए पढ़ें समाचार4मीडिया
 | Samachar4media has best and latest media news, advertising news, media industry updates for more information visit our website."/>
<meta name="keywords" content="Latest News of  Print Media, News Channels, Digital Media, Hindi Media, Hindi Journalists हिदी पत्रकारिता, पत्रकार, मीडिया, खबरें, मीडिया की दुनिया की खबरें,morning newsletter, samachar4media morning newsletter" />
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
              <tr>
                @if(isset($parents[0]))  
                  @if($parents[0]->status==1)
                  {!!$parents[0]->bscript!!}
                  @else 
                  @endif 
                @else
              @endif                
              </tr>
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
                        <td align="left" valign="middle" style="font-size: 16px;font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif';">
                          <strong>
                            <span style="color: #000000; font-size: 16px;">मीडिया, विज्ञापन व सोशल मीडिया की  </span> 
                            <span style="font-size: 16px;">प्रमुख खबरें</span>
                          </strong>
                        </td>
                        <td align="right" valign="middle" style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0px; font-size: 14px;">
                          <strong>
                            <span style="font-size: 18px;color: #ee7e22;">{{date('D d')}}<sup>{{date('S')}}</sup></span>{{date('F Y')}}
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
              @if(isset($ArrViewArticle))
              <!--top news-->
              <tr>
                <td valign="middle">
                  <table bgcolor="#ffffff" width="560" border="0" cellpadding="8" cellspacing="0" style="border-radius: 8px;">
                    <tbody>
                      <tr>
                        <td>
                          <a href="{{$ArrViewArticle[0]->url}}" target="_blank">
                            <img src="{{Config::get('constants.awsbaseurl')}}{{ $ArrViewArticle[0]->photopath }}" width="545" style="border-radius: 8px;" />
                          </a>
                        </td>
                      </tr>
                      <tr>
                        <td align="center" valign="middle" style="line-height: 27px;font-size: 16px; color: #000000;">
                          <a href="{{$ArrViewArticle[0]->url}}" style="color: #000000;font-size: 16px; text-decoration: none;">
                            <strong>
                              {{Illuminate\Support\Str::limit($ArrViewArticle[0]->title , $limit = 90, $end = '...')}}
                            </strong>
                          </a>  
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <hr style="border: dashed 0.5px #dadada; margin-top: 0px;" width="450">
                        </td>
                      </tr>
                      <tr>
                        <td align="center">
                          <table align="center" cellpadding="10" width="480" border="0" bgcolor="#f9f9f9" style="font-size: 15px; line-height: 27px;border-left: solid #ee7e22;border-right: solid #ee7e22;">
                            <tbody>
                              <tr>
                                <td align="center" valign="middle">
                                  {{Illuminate\Support\Str::limit($ArrViewArticle[0]->summary , $limit = 130, $end = '...')}}
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
                                  <a href="https://www.facebook.com/sharer.php?u={{$ArrViewArticle[0]->url}}&utm_source=newsletter&utm_medium=facebook&utm_campaign=facebook&utm_term=facebook&utm_content=facebook" target="_blank" >
                                    <img src="{{url('images/fb.jpg')}}" width="25">
                                  </a>
                                </td>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="https://twitter.com/intent/tweet?url={{ $ArrViewArticle[0]->url }}&text={{ preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $ArrViewArticle[0]->title)}}
&via=samachar4media&utm_source=newsletter&utm_medium=twitter&utm_campaign=twitter&utm_term=twitter&utm_content=twitter"" target="_blank">
                                    <img src="{{url('images/tw.jpg')}}" width="25">
                                  </a>
                                </td>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="https://www.linkedin.com/shareArticle??mini=true
&url={{$ArrViewArticle[0]->url}}
&title={{preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $ArrViewArticle[0]->title)}}
&summary={{$ArrViewArticle[0]->summary}} 
&source=samachar4media.com&utm_source=newsletter&utm_medium=linkedin&utm_campaign=linkedin&utm_term=linkedin&utm_content=linkedin"" target="_blank">
                                    <img src="{{url('images/link.jpg')}}" width="25">
                                  </a>
                                </td>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="https://api.whatsapp.com/send?text={{preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $ArrViewArticle[0]->title)}}  {{$ArrViewArticle[0]->url}}&utm_source=newsletter&utm_medium=whatsapp&utm_campaign=whatsapp&utm_term=whatsapp&utm_content=whatsapp" target="_blank">
                                    <img src="{{url('images/wtsup.jpg')}}" width="25">
                                  </a>
                                </td>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="mailto:?subject={{preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $ArrViewArticle[0]->title)}}- samachar4media&body=Hi,%0A
 I thought you'd like this:%0A%0A
{{$ArrViewArticle[0]->url}}&utm_source=desktop&utm_medium=email&utm_campaign=email&utm_term=email&utm_content=email" target="_blank">
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

              <!--add-->
              <tr>
                <td>
                  <table cellpadding="0" cellspacing="0" width="560" border="0" bgcolor="#ffffff" style="border-radius: 8px; padding: 10px;">
                    <tbody>
                      <tr>
                        <td width="210"><hr style="border: dashed 0.5px #ee7e22;"></td>
                        <td align="center" valign="middle" style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; font-size: 12px;"><strong>Advertisement</strong></td>
                        <td width="210"><hr style="border: dashed 0.5px #ee7e22;"></td>
                      </tr>
                      
                        @if(isset($parents[1]))  
                          @if($parents[1]->status==1)
                          {!!$parents[1]->bscript!!}
                          @else 
                          @endif 
                        @else
                        @endif 
                        
                      
                    </tbody>
                  </table>

                </td>
              </tr>
              <!--add-->
              <!--blank-->
              <tr>
                <td width="560" height="5"></td>
              </tr>
              <!--blank-->
              <!--2nd story row-->
              <tr>
                <td>
                  <table cellpadding="2" align="left" bgcolor="#ffffff" width="560" border="0" style="border-radius: 8px;">
                    <tbody>
                      <tr>
                        <!--story2-->
                        <td>
                          <table align="left" cellpadding="4" width="250" border="0">
                            <tbody>
                              <tr>
                                <td>
                                  <a href="{{$ArrViewArticle[1]->url}}" target="_blank">
                                    <img src="{{Config::get('constants.awsbaseurl')}}{{ $ArrViewArticle[1]->photopath }}" width="250" style="border-radius: 8px;" />                                    
                                  </a>
                                </td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" style="font-size: 16px; line-height: 24px; color: #000000;">
                                  <a href="{{$ArrViewArticle[1]->url}}" target="_blank" style="font-size: 16px; color: #000000; font-size: 16px; text-decoration: none;">
                                    <strong>
                                      {{Illuminate\Support\Str::limit($ArrViewArticle[1]->title , $limit = 90, $end = '...')}}
                                    </strong>
                                  </a>
                                </td>
                              </tr>
                              <tr>
                                <td>
                                  <table align="center" width="190" border="0">
                                    <tbody>
                                      <tr>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="https://www.facebook.com/sharer.php?u={{$ArrViewArticle[1]->url}}&utm_source=newsletter&utm_medium=facebook&utm_campaign=facebook&utm_term=facebook&utm_content=facebook" target="_blank" >
                                    <img src="{{url('images/fb.jpg')}}" width="25">
                                  </a>
                                </td>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="https://twitter.com/intent/tweet?url={{ $ArrViewArticle[1]->url }}&text={{preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $ArrViewArticle[1]->title)}}
&via=samachar4media&utm_source=newsletter&utm_medium=twitter&utm_campaign=twitter&utm_term=twitter&utm_content=twitter"" target="_blank">
                                    <img src="{{url('images/tw.jpg')}}" width="25">
                                  </a>
                                </td>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="https://www.linkedin.com/shareArticle??mini=true
&url={{$ArrViewArticle[1]->url}}
&title={{preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $ArrViewArticle[1]->title)}}
&summary={{$ArrViewArticle[1]->summary}} 
&source=samachar4media.com&utm_source=newsletter&utm_medium=linkedin&utm_campaign=linkedin&utm_term=linkedin&utm_content=linkedin"" target="_blank">
                                    <img src="{{url('images/link.jpg')}}" width="25">
                                  </a>
                                </td>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="https://api.whatsapp.com/send?text={{preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $ArrViewArticle[1]->title)}}  {{$ArrViewArticle[1]->url}}&utm_source=newsletter&utm_medium=whatsapp&utm_campaign=whatsapp&utm_term=whatsapp&utm_content=whatsapp" target="_blank">
                                    <img src="{{url('images/wtsup.jpg')}}" width="25">
                                  </a>
                                </td>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="mailto:?subject={{preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $ArrViewArticle[1]->title)}}- samachar4media&body=Hi,%0A
 I thought you'd like this:%0A%0A
{{$ArrViewArticle[1]->url}}&utm_source=desktop&utm_medium=email&utm_campaign=email&utm_term=email&utm_content=email" target="_blank">
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
                       
                        <!--story2-->

                        <!--border middle-->
                        <td>
                          <table align="center" cellpadding="0" cellspacing="0" width="1" height="220" border="0">
                            <tbody>

                              <tr>
                                <td valign="top" style="border: dashed 0.5px #ee7e22;">
                                </td>
                              </tr>
                            </tbody>
                          </table>

                        </td>
                        <!--border middle-->
                        <!--story2-->
                        <td>
                          <table align="right" cellpadding="4" width="250" border="0">
                            <tbody>
                              
                              <tr>
                                <td>
                                  <a href="{{$ArrViewArticle[2]->url}}" target="_blank">
                                    <img src="{{Config::get('constants.awsbaseurl')}}{{ $ArrViewArticle[2]->photopath }}" width="250" style="border-radius: 8px;">
                                  </a>
                                </td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" style="font-size: 16px; line-height: 24px; color: #000000;">
                                  <a href="{{$ArrViewArticle[2]->url}}" target="_blank" style="font-size: 16px; color: #000000; font-size: 16px; text-decoration: none;">
                                    <strong>
                                      {{Illuminate\Support\Str::limit($ArrViewArticle[2]->title , $limit = 90, $end = '...')}}
                                    </strong>
                                  </a>
                                </td>
                              </tr>

                              <tr>
                                <td>
                                  <table align="center" width="190" border="0">
                                    <tbody>
                                      <tr>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="https://www.facebook.com/sharer.php?u={{$ArrViewArticle[2]->url}}&utm_source=newsletter&utm_medium=facebook&utm_campaign=facebook&utm_term=facebook&utm_content=facebook" target="_blank" >
                                    <img src="{{url('images/fb.jpg')}}" width="25">
                                  </a>
                                </td>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="https://twitter.com/intent/tweet?url={{ $ArrViewArticle[2]->url }}&text={{preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $ArrViewArticle[2]->title)}}
&via=samachar4media&utm_source=newsletter&utm_medium=twitter&utm_campaign=twitter&utm_term=twitter&utm_content=twitter"" target="_blank">
                                    <img src="{{url('images/tw.jpg')}}" width="25">
                                  </a>
                                </td>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="https://www.linkedin.com/shareArticle??mini=true
&url={{$ArrViewArticle[2]->url}}
&title={{preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $ArrViewArticle[2]->title)}}
&summary={{$ArrViewArticle[2]->summary}} 
&source=samachar4media.com&utm_source=newsletter&utm_medium=linkedin&utm_campaign=linkedin&utm_term=linkedin&utm_content=linkedin"" target="_blank">
                                    <img src="{{url('images/link.jpg')}}" width="25">
                                  </a>
                                </td>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="https://api.whatsapp.com/send?text={{preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $ArrViewArticle[2]->title)}}  {{$ArrViewArticle[2]->url}}&utm_source=newsletter&utm_medium=whatsapp&utm_campaign=whatsapp&utm_term=whatsapp&utm_content=whatsapp" target="_blank">
                                    <img src="{{url('images/wtsup.jpg')}}" width="25">
                                  </a>
                                </td>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="mailto:?subject={{preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $ArrViewArticle[2]->title)}}- samachar4media&body=Hi,%0A
 I thought you'd like this:%0A%0A
{{$ArrViewArticle[2]->url}}&utm_source=desktop&utm_medium=email&utm_campaign=email&utm_term=email&utm_content=email" target="_blank">
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
                        <!--story2-->

                      </tr>
                    </tbody>
                  </table>

                </td>
              </tr>
              <!--2nd story row-->
              
              <!--blank-->
              <tr>
                <td width="560" height="5"></td>
              </tr>
              <!--blank-->

              <!--border image-->
              <tr>
                <td><img src="{{url('images/border-img.jpg')}}" width="560"></td>
              </tr>
              <!--border image-->

              <!--blank-->
              <tr>
                <td width="560" height="5"></td>
              </tr>
              <!--blank-->



              <!--add row-->
              <tr>
                <td>
                  <table cellpadding="2" align="left" bgcolor="#ffffff" width="560" border="0" style="border-radius: 8px;">
                    <tbody>
                      <tr>
                        <!--add1-->
                        <td>
                          <table align="left" cellpadding="0" width="250" border="0">
                            <tbody>

                              <tr>
                                <td width="75"><hr style="border: dashed 0.5px #ee7e22;" width="75"></td>
                                <td width="100" align="center" valign="middle" style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; font-size: 12px;"><strong>Advertisement</strong></td>
                                <td width="75"><hr style="border: dashed 0.5px #ee7e22;" width="75"></td>
                              </tr>
                              @if(isset($parents[2]))  
                                @if($parents[2]->status==1)
                                {!!$parents[2]->bscript!!}
                                @else 
                                @endif 
                              @else
                              @endif 
                              

                            </tbody>
                          </table>

                        </td>
                        <!--add1-->

                        <!--border middle-->
                        <td>
                          <table align="center" cellpadding="0" cellspacing="0" width="1" height="180" border="0">
                            <tbody>

                              <tr>
                                <td valign="top" style="border: dashed 0.5px #ee7e22;">
                                </td>
                              </tr>
                            </tbody>
                          </table>

                        </td>
                        <!--border middle-->
                        <!--add2-->
                        <td>
                          <table align="right" cellpadding="0" width="250" border="0">
                            <tbody>

                              <tr>
                                <td width="75"><hr style="border: dashed 0.5px #ee7e22;" width="75"></td>
                                <td width="100" align="center" valign="middle" style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; font-size: 12px;"><strong>Advertisement</strong></td>
                                <td width="75"><hr style="border: dashed 0.5px #ee7e22;" width="75"></td>
                              </tr>
                              @if(isset($parents[3]))  
                                @if($parents[3]->status==1)
                                {!!$parents[3]->bscript!!}
                                @else 
                                @endif 
                              @else
                              @endif
                              

                            </tbody>
                          </table>

                        </td>
                        <!--add2-->

                      </tr>
                    </tbody>
                  </table>

                </td>
              </tr>
              <!--add row-->


              <!--blank-->
              <tr>
                <td width="560" height="5"></td>
              </tr>
              <!--blank-->


              <!--border image-->
              <tr>
                <td><img src="{{url('images/border-img.jpg')}}" width="560"></td>
              </tr>
              <!--border image-->

      <!--blank-->
      <tr>
        <td width="560" height="5"></td>
      </tr>
      <!--blank-->
    
      <!--category story-->
      <tr>
        <td>
          <table cellpadding="10" bgcolor="#ffffff" align="center" width="560" border="0" style="border-radius: 8px;">
            <tbody>
              @for($ava=3;$ava < count($ArrViewArticle);$ava++)  
              <!--first-->
              <tr>
                <td vertical-align="top" style="line-height: 0">
                  <a href="{{$ArrViewArticle[$ava]->url}}" target="_blank">
                    <img src="{{Config::get('constants.awsbaseurl')}}{{ $ArrViewArticle[$ava]->photopath }}" width="250" style="border-radius: 8px;">
                  </a>
                </td>
                <td valign="top" style="padding-left: 10px;">
                  <h3 style="font-size: 16px; margin: 0px; line-height: 25px; color: #000000;">
                    <a href="{{$ArrViewArticle[$ava]->url}}" target="_blank" style="color:#000000; text-decoration: none; font-size: 16px;">
                      <strong>
                        {{Illuminate\Support\Str::limit($ArrViewArticle[$ava]->title , $limit = 90, $end = '...')}}
                      </strong>
                    </a>
                  </h3>
                  <p style="font-size: 14px; margin-top: 7px; line-height: 22px;">
                    {{Illuminate\Support\Str::limit($ArrViewArticle[$ava]->summary , $limit = 80, $end = '...')}}
                  </p>

                  <table align="left" width="190" border="0">
                    <tbody>
                      <tr>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="https://www.facebook.com/sharer.php?u={{$ArrViewArticle[$ava]->url}}&utm_source=newsletter&utm_medium=facebook&utm_campaign=facebook&utm_term=facebook&utm_content=facebook" target="_blank" >
                                    <img src="{{url('images/fb.jpg')}}" width="25">
                                  </a>
                                </td>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="https://twitter.com/intent/tweet?url={{ $ArrViewArticle[$ava]->url }}&text={{preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $ArrViewArticle[$ava]->title)}}
&via=samachar4media&utm_source=newsletter&utm_medium=twitter&utm_campaign=twitter&utm_term=twitter&utm_content=twitter"" target="_blank">
                                    <img src="{{url('images/tw.jpg')}}" width="25">
                                  </a>
                                </td>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="https://www.linkedin.com/shareArticle??mini=true
&url={{$ArrViewArticle[$ava]->url}}
&title={{preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $ArrViewArticle[$ava]->title)}}
&summary={{$ArrViewArticle[$ava]->summary}} 
&source=samachar4media.com&utm_source=newsletter&utm_medium=linkedin&utm_campaign=linkedin&utm_term=linkedin&utm_content=linkedin"" target="_blank">
                                    <img src="{{url('images/link.jpg')}}" width="25">
                                  </a>
                                </td>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="https://api.whatsapp.com/send?text={{preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $ArrViewArticle[$ava]->title)}}  {{$ArrViewArticle[$ava]->url}}&utm_source=newsletter&utm_medium=whatsapp&utm_campaign=whatsapp&utm_term=whatsapp&utm_content=whatsapp" target="_blank">
                                    <img src="{{url('images/wtsup.jpg')}}" width="25">
                                  </a>
                                </td>
                                <td align="center" valign="middle" style="line-height: 0">
                                  <a href="mailto:?subject={{preg_replace('/[^\p{L}\p{Z}\p{N}\p{M}]/u','', $ArrViewArticle[$ava]->title)}}- samachar4media&body=Hi,%0A
 I thought you'd like this:%0A%0A
{{$ArrViewArticle[$ava]->url}}&utm_source=desktop&utm_medium=email&utm_campaign=email&utm_term=email&utm_content=email" target="_blank">
                                    <img src="{{url('images/mail.jpg')}}" width="25">
                                  </a>
                                </td>
                              </tr>
                    </tbody>
                  </table> 

                </td>

              </tr>
              <!--first-->

              <!--line-->
              <tr><td colspan="2"><hr style="border: dashed 0.5px #dadada;" width="490"></td></tr>
              <!--line-->  
               @endfor
            </tbody>
          </table>

        </td>
      </tr>
      <!--category story-->
     
      <!--blank-->
      <tr>
        <td width="560" height="5"></td>
      </tr>
      <!--blank-->
      
      <!--add-->
      <tr>
        <td>
          <table cellpadding="0" cellspacing="0" width="560" border="0" bgcolor="#ffffff" style="border-radius: 8px; padding: 10px;">
            <tbody>
              <!-- <tr>
                <td width="210"><hr style="border: dashed 0.5px #ee7e22;"></td>
                <td align="center" valign="middle" style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; font-size: 12px;"><strong>Advertisement</strong></td>
                <td width="210"><hr style="border: dashed 0.5px #ee7e22;"></td>
              </tr> -->
              @if(isset($parents[4]))  
                                @if($parents[4]->status==1)
                                {!!$parents[4]->bscript!!}
                                @else 
                                @endif 
                              @else
                              @endif 
              


            </tbody>
          </table>

        </td>
      </tr>
      <!--add-->

  @endif   
      <!--blank-->
      <tr>
        <td width="560" height="5"></td>
      </tr>
      <!--blank-->
      
      <!--footer-->
      <tr>
        <td>
          <table cellpadding="0" bgcolor="#ffffff" width="560" border="0" style="border-radius: 8px; padding-top: 10px;">
            <tbody>
              <tr>
                <td align="center" valign="middle" style="font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; font-size: 14px;">
                  <strong>If you're having trouble viewing this email, please 
                    <a href="{{Config::get('constants.storagepath').'newsletter/morning-post-'.date('d-m-Y').'.html'}}" target="_blank" style="color: #3796b5; text-decoration: none;">click here
                    </a>.
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
