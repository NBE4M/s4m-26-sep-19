
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Exchange4Media Morning Post</title>
<style type="text/css">
body {font-family: 'Open Sans', Helvetica, Arial, sans-serif!important; background: #f2f2f2;}
.story a{ text-decoration:none !important; color:#000000 !important;}
@media only screen and (max-width: 767px) and (-webkit-min-device-pixel-ratio: 3) {
*[class].full {width: 100% !important;}
p {padding: 0px; margin: 0px;}
.ripplelink img {
	width: 100% !important;
}
.story {
	height: auto !important;
}
body {
	font-size: 16px !important;
}
.story a {
	font-size: 24px !important;
	line-height: 21px !important;
	display: inline-block;
}
.social img {
	width: 34px !important;
	height: 22px !important;
	max-width: 22px !important;
	height: auto !important;
}
.button {
	font-size: 16px !important;
}
.full {
	width: 100% !important;
}
.full img {
	max-width: 100% !important;
}
.fst {
	font-size: 14px !important;
}
.w500 {
	width: 420px !important;
}
.pdt10 {
	padding-top: 10px;
}
.wt100 {
	width: 100% !important;
}
.description {
	font-size: 20px !important;
	line-height: 26px !important;
	padding: 5px 0px 15px;
}
}
@media only screen and (min-device-width: 320px) and (max-device-width: 767px) {
body {
	font-size: 16px !important;
}
.story a {
	font-size: 20px !important;
	line-height: 20px !important;
	padding: 5px;
	display: inline-block;
}
.social img {
	width: 22px !important;
	height: 22px !important;
	max-width: 22px !important;
}
.button {
	font-size: 16px !important;
}
.full {
	width: 100% !important;
}
.fst {
	font-size: 18px !important;
}
}
 @media only screen and (min-device-width : 768px) and (max-device-width : 1024px) {
body {
	font-size: 16px !important;
}
.story a {
	font-size: 17px !important;
	line-height: 21px !important;
	display: inline-block;
}
.social img {
	width: 28px !important;
	height: 28px !important;
	max-width: 28px !important;
}
.description {
	font-size: 14px !important;
}
.button {
	font-size: 13px !important;
}
.fst {
	font-size: 18px !important;
}
}
</style>
</head>

<body style="margin:0; padding:0; background-color: #f2f2f2;">
<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="#eeeeee">
  <tr>
    <td valign="top" align="center" style="padding-top: 18px;">
    <!--=======container table start=========-->
      <table width="600" cellpadding="0" class="full" cellspacing="0" border="0" align="center" style="width:600px;">
        <!--row start-->
        <tr>
          <td colspan="2"><img src="https://www.exchange4media.com/images/newsletter/morningpostbanner.png" width="600" alt="Logo" border="0" style="max-width: 100%; display:block; "> </td>
        </tr>
        <!--row end--> 
        
        <!--blank row start-->
        <tr>
          <td height="10px" colspan="2">&nbsp;</td>
        </tr>
        <!--blank row end--> 
        
        <!--row start-->
        <tr>
          <!--<td colspan="2"><a href="https://www.facebook.com/Starplus/?ref=br_rs" target="_blank"><img src="https://www.exchange4media.com/images/starplus16april18.jpg" alt="Dsoprt" class="resp" width="600" height="70" border="0"></a></td>-->
		  <td colspan="2">@if($parents[22]->status==1){!!$parents[22]->bscript!!}@else @endif</td>
        </tr>
        <!--row end--> 
        
        <!--blank row start-->
      <!--   <tr>
          <td height="10px" colspan="2">&nbsp</td>
        </tr> -->
        <!--blank row end--> 
        
        <!--row start-->
      <!--   <tr>
          <td colspan="2"><a href="https://www.facebook.com/Starplus/" target="_blank"><img src="https://www.exchange4media.com/images/starplus12march18.jpg" alt="STAR PLUS" class="resp" width="600" height="51" border="0"></a></td>
        </tr> -->
        <!--row end--> 
        
        <!--row start-->
        <tr>
          <td width="280" align="left" valign="middle" style="color: #212121; background:#ffffff; font-size: 20px; font-weight:bold; padding:0px!important;"><img src="https://www.exchange4media.com/images/newsletter/latest-news.jpg" alt="" width="228"></td>
          <td width="306" align="center" valign="middle" class="fst" style="color: #000000; background:#ffffff; font-size: 18px; padding:0px;"><?php echo date("F j, Y, g:i a T"); ?></td>
        </tr>
        <!--row end--> 
        
        <!--blank row start-->
        <tr>
          <td height="10px" colspan="2"></td>
        </tr>
        <!--blank row end--> 
        
        <!--row start-->
        @foreach($ArrViewArticle as $key => $ArrlistingArticle) 
        @if($key==0) 
        <tr>
          <td colspan="2" valign="top" style="background:#ffffff; padding:15px;"><table border="0" align="left" cellpadding="0" width="280" class="full" cellspacing="0" style=" width:280px;">
              <tbody>
                <tr>
<td class="ripplelink" bgcolor="#ffffff" align="left">
<a href="{{$ArrlistingArticle->url}}" 
target="_blank"><img src="{{Config::get('constants.awsbaseurl')}}{{ $ArrlistingArticle->photopath }}" width="280" style="display: block; border: 0px; width:280px; max-width:100%;" class="full" /></a>
</td>
                </tr>
              </tbody>
            </table>
            <table border="0" align="right" cellpadding="0" width="280" class="full" cellspacing="0" style=" width:280px;">
              <tr>
                <td bgcolor="#ffffff" align="left" valign="top" class="story pdt10" colspan="2" style="height:124px;">
                <a href="{{$ArrlistingArticle->url}}" target="_blank" style="color:#000000; text-decoration:none; color:#000000; font-size: 16px; line-height: 20px; font-weight:bold;"> {{Str::limit($ArrlistingArticle->title , $limit = 90, $end = '...')}}</a>
                  <p class="description" style="font-size:13px; font-weight:normal; line-height:18px; margin:5px 0px; color:#585858;">{{Str::limit($ArrlistingArticle->summary , $limit = 130, $end = '...')}}</p></td>
              </tr>
              <tr>
                <td align="left"><table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="right" valign="top" class="social"><a href="https://www.facebook.com/sharer.php?u={{$ArrlistingArticle->url}}&utm_source=newsletter&utm_medium=facebook&utm_campaign=facebook&utm_term=facebook&utm_content=facebook"
target="_blank"> <img src="https://www.exchange4media.com/images/newsletter/fb-icon.png"
height="24" alt="Facebook" border="0" style="display:block; max-width: 24px"> </a></td>
                      <td width="5"></td>
<td align="right" valign="top" class="social"><a href="https://twitter.com/intent/tweet?url={{ $ArrlistingArticle->url }}&utm_source=newsletter&utm_medium=twitter&utm_campaign=twitter&utm_term=twitter&utm_content=twitter"
target="_blank"> <img src="https://www.exchange4media.com/images/newsletter/twitter-icon.png"
height="24" alt="Twitter" border="0" style="display:block; max-width: 24px"> </a></td>
                      <td width="5"></td>
<td align="right" valign="top" class="social"><a href="https://www.linkedin.com/shareArticle??mini=true
&url={{$ArrlistingArticle->url}}
&title={{$ArrlistingArticle->title}}
&summary={{$ArrlistingArticle->summary}} 
&source=exchange4media.com&utm_source=newsletter&utm_medium=linkedin&utm_campaign=linkedin&utm_term=linkedin&utm_content=linkedin"
target="_blank"> <img src="https://www.exchange4media.com/images/newsletter/linkedin-icon.png"
height="24" alt="Linkedin" border="0" style="display:block; max-width: 24px"> </a></td>
                      <td width="5"></td>
                      <td align="right" valign="top" class="social"><a href="https://api.whatsapp.com/send?text={{$ArrlistingArticle->title}}  {{$ArrlistingArticle->url}}&utm_source=newsletter&utm_medium=whatsapp&utm_campaign=whatsapp&utm_term=whatsapp&utm_content=whatsapp"
target="_blank"> <img src="https://www.exchange4media.com/images/newsletter/whatsapp.png" height="24" alt="Youtube" border="0" style="display:block; max-width: 24px"> </a></td>
 <td width="5"></td>
                      <td align="right" valign="top" class="social"><a href="mailto:?subject={{$ArrlistingArticle->title}}- exchange4media&body=Hi,%0A
 I thought you'd like this:%0A%0A
{{$ArrlistingArticle->url}}&utm_source=desktop&utm_medium=email&utm_campaign=email&utm_term=email&utm_content=email"
target="_blank"> <img src="https://www.exchange4media.com/images/newsletter/email.png" height="24" alt="Youtube" border="0" style="display:block; max-width: 24px"> </a></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        @endif
       
         @if($key!=0) 
          @if($key==2) 
          @if($parents[23]->status==1)
          <tr>
         <td colspan="2">{!!$parents[23]->bscript!!}</td>
        </tr>
        <tr>
          <td height="15px" colspan="2">&nbsp;</td>
        </tr> 
         @endif
          @endif
		  @if($key==4) 
          <!-- <tr>
      <td colspan="2"><a href="http://bit.ly/2o2iceF" target="_blank">
          <img src="https://www.exchange4media.com/images/abp22aug18.jpg" alt="Anandabazar Patrika" class="resp" width="600" height="60" border="0"></a></td>
        </tr>
        <tr>
          <td height="15px" colspan="2">&nbsp;</td>
        </tr>  -->
         @endif
        <tr>
          <td colspan="2" valign="top" style="background:#ffffff; padding:15px;"><table border="0" align="left" cellpadding="0" width="170" class="full" cellspacing="0" style=" width:170px;">
              <tbody>
                <tr>
                  <td class="ripplelink" bgcolor="#ffffff" align="left"><a href="{{$ArrlistingArticle->url}}" target="_blank"><img src="{{Config::get('constants.awsbaseurl')}}{{ $ArrlistingArticle->photopath }}" width="170" style="display: block; border: 0px; width:170px; max-width:100%;" class="full wt100" /></a></td>
                </tr>
              </tbody>
            </table>
            <table border="0" align="right" cellpadding="0" width="390" cellspacing="0" class="wt100" style=" width:390px;">
              <tr>
                <td bgcolor="#ffffff" align="left" valign="top" class="story pdt10" colspan="2" style="height:65px; ">
                <a href="{{$ArrlistingArticle->url}}" target="_blank" style="color:#000000; text-decoration:none; color:#000000; font-size: 16px; line-height: 20px; font-weight:bold;">{{Str::limit($ArrlistingArticle->title , $limit = 90, $end = '...')}}</a>
                  <p class="description" style="font-size:13px; font-weight:normal; line-height:18px; margin:5px 0px; color:#585858;">{{Str::limit($ArrlistingArticle->summary , $limit = 130, $end = '...')}}</p></td>
              </tr>
              <tr>
                <td align="left"><table border="0" cellspacing="0" cellpadding="0">
            <tr>
                      <td align="right" valign="top" class="social"><a href="https://www.facebook.com/sharer.php?u={{$ArrlistingArticle->url}}"
target="_blank"> <img src="https://www.exchange4media.com/images/newsletter/fb-icon.png"
height="24" alt="Facebook" border="0" style="display:block; max-width: 24px"> </a></td>
                      <td width="5"></td>
                      <td align="right" valign="top" class="social"><a href="https://twitter.com/intent/tweet?url={{Config::get('constants.SiteBaseurl')}}{{ $ArrlistingArticle->url }}"
target="_blank"> <img src="https://www.exchange4media.com/images/newsletter/twitter-icon.png"
height="24" alt="Twitter" border="0" style="display:block; max-width: 24px"> </a></td>
                      <td width="5"></td>
                      <td align="right" valign="top" class="social"><a href="https://www.linkedin.com/shareArticle??mini=true
&url={{$ArrlistingArticle->url}}
&title={{$ArrlistingArticle->title}}
&summary={{$ArrlistingArticle->summary}} 
&source=exchange4media.com"
target="_blank"> <img src="https://www.exchange4media.com/images/newsletter/linkedin-icon.png"
height="24" alt="Linkedin" border="0" style="display:block; max-width: 24px"> </a></td>
                      <td width="5"></td>
                      <td align="right" valign="top" class="social"><a href="https://api.whatsapp.com/send?text={{$ArrlistingArticle->title}}{{$ArrlistingArticle->url}}"
target="_blank"> <img src="https://www.exchange4media.com/images/newsletter/whatsapp.png" height="24" alt="Youtube" border="0" style="display:block; max-width: 24px"> </a></td>
<td width="5"></td>
                      <td align="right" valign="top" class="social"><a href="mailto:?subject={{$ArrlistingArticle->title}}- exchange4media&body=Hi,%0A
 I thought you'd like this:%0A%0A
{{$ArrlistingArticle->url}}&utm_source=desktop&utm_medium=email&utm_campaign=email&utm_term=email&utm_content=email"
target="_blank"> <img src="https://www.exchange4media.com/images/newsletter/email.png" height="24" alt="Youtube" border="0" style="display:block; max-width: 24px"> </a></td>
                    </tr>
                  </table></td>
                 <!--  @if($key==6) 
                                  <td align="right"><img src="http://design.exchange4media.com/e4mdesigner/dummy/newsletter/images/scoop.png"></td>
                                  @endif  -->
              </tr>
            </table></td>
        </tr>
        @endif
         <tr>
          <td height="15px" colspan="2">&nbsp;</td>
        </tr>
        @endforeach
        
        <!--blank row start-->
        
        <!--blank row end--> 
        
        <!--OTHER HEADLINES START--> 
       <!--  <tr>
      <td colspan="2"><a href="http://bit.ly/2o2iceF" target="_blank">
          <img src="https://www.exchange4media.com/images/abp22aug18.jpg" alt="Anandabazar Patrika" class="resp" width="600" height="60" border="0"></a></td>
        </tr>
		 <tr>
          <td height="15px" colspan="2">&nbsp;</td>
        </tr> -->
        <!--row start-->
        <tr>
          <td align="center" bgcolor="#027e89" valign="middle" colspan="2" style="color:#ffffff; font-size: 17px; font-weight:bold; padding:2px 0px;">OTHER HEADLINES </td>
        </tr>
        <!--row end--> 
        
        <!--row start-->
        <tr>
          <td colspan="3"><table width="100%" class="wt100">
              <tr>
              	@foreach($ArrRecentArticleGuestColumn->take(3) as $key => $ArrRecentArticleGuestColumns) 
                <td valign="top" style="background:#ffffff; padding:10px;" width="178" align="left"><table border="0" align="left" cellpadding="0" width="178" class="full" cellspacing="0" style=" width:178px;">
                    <tbody>
                      <tr>
                        <td width="178" align="left" bgcolor="#ffffff" class="ripplelink"><a href="{{$ArrRecentArticleGuestColumns->url}}" target="_blank"><img src="{{Config::get('constants.awsbaseurl')}}{{ $ArrRecentArticleGuestColumns->photopath }}" width="178" style="border-radius: 3px 3px 0px 0px; display: block; border: 0px; width:178px; max-width:100%;" /></a></td>
                      </tr>
                      <tr>
                        <td bgcolor="#ffffff" align="left" valign="top" class="story pdt10" style="padding-top:10px; padding-bottom:5px;">
                <a href="{{$ArrRecentArticleGuestColumns->url}}" target="_blank" style="color:#000000; text-decoration:none;"><strong>{{Str::limit($ArrRecentArticleGuestColumns->title , $limit = 90, $end = '...')}}</strong></a>
                  <p class="description" style="font-size:13px; font-weight:normal; line-height:18px; margin:5px 0px; color:#585858;">{{Str::limit($ArrRecentArticleGuestColumns->summary , $limit = 130, $end = '...')}}</p></td>
                      </tr>
                      <tr>
                        <td><table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                    <td align="right" valign="top" class="social"><a href="https://www.facebook.com/sharer.php?u={{$ArrRecentArticleGuestColumns->url}}"
target="_blank"> <img src="https://www.exchange4media.com/images/newsletter/fb-icon.png" height="20" alt="Facebook" border="0" style="display:block; max-width: 20px"> </a></td>
                                    <td width="5"></td>
                                    <td align="right" valign="top" class="social"><a href="https://twitter.com/intent/tweet?url={{Config::get('constants.SiteBaseurl')}}{{ $ArrRecentArticleGuestColumns->url }}"
target="_blank"><img src="https://www.exchange4media.com/images/newsletter/twitter-icon.png" height="20" alt="Twitter" border="0" style="display:block; max-width: 20px"> </a></td>
                                    <td width="5"></td>
                                    <td align="right" valign="top" class="social"><a href="https://www.linkedin.com/shareArticle??mini=true
&url={{$ArrRecentArticleGuestColumns->url}}
&title={{$ArrRecentArticleGuestColumns->title}}
&summary={{$ArrRecentArticleGuestColumns->summary}} 
&source=exchange4media.com"
target="_blank"> <img src="https://www.exchange4media.com/images/newsletter/linkedin-icon.png" height="20" alt="Linkedin" border="0" style="display:block; max-width: 20px"> </a></td>
                                    <td width="5"></td>
                                    <td align="right" valign="top" class="social"><a href="https://api.whatsapp.com/send?text={{$ArrRecentArticleGuestColumns->title}}{{$ArrRecentArticleGuestColumns->url}}"
target="_blank"> <img src="https://www.exchange4media.com/images/newsletter/whatsapp.png" height="20" alt="Youtube" border="0" style="display:block; max-width: 20px"> </a></td>
                                    <td width="5"></td>
									<td align="right" valign="top" class="social"><a href="mailto:?subject={{$ArrRecentArticleGuestColumns->title}}- exchange4media&body=Hi,%0A
									I thought you'd like this:%0A%0A
									{{$ArrRecentArticleGuestColumns->url}}&utm_source=desktop&utm_medium=email&utm_campaign=email&utm_term=email&utm_content=email"
									target="_blank"><img src="https://www.exchange4media.com/images/newsletter/email.png" height="20" alt="Youtube" border="0" style="display:block; max-width: 20px"> </a></td>

                                  </tr>
                          </table></td>
                      </tr>
                    </tbody>
                  </table></td>
                  @endforeach
              </tr>
            </table></td>
        </tr>
        
        <!--row end--> 
        
        <!--blank row start-->
        <tr>
          <td height="15px" colspan="2">&nbsp;</td>
        </tr>
        <!--blank row end--> 
        
        <!--OTHER HEADLINES END--> 
        
        <tr>
          <td valign="top" align="center" colspan="2" class="full" style="background:#ffffff; padding:15px;"><table border="0" align="left" cellpadding="0" width="280" class="full" cellspacing="0" style=" width:280px;">
              <tbody>
                <tr>
                  <td align="left" style="font-size:11px; padding-left:10px;">Advertising</td>
                </tr>
                <tr>
                  <td class="ripplelink" bgcolor="#ffffff" align="left">@if($parents[24]->status==1){!!$parents[24]->bscript!!}@else @endif</td>
                </tr>
              </tbody>
            </table>
            <table border="0" align="right" cellpadding="0" width="280" class="full" cellspacing="0" style=" width:280px;">
              <tbody>
                <tr>
                  <td align="left" style="font-size:11px; padding-left:10px;">Advertising</td>
                </tr>
                <tr>
                  <td class="ripplelink" bgcolor="#ffffff" align="right">@if($parents[25]->status==1){!!$parents[25]->bscript!!}@else @endif</td>
                </tr>
              </tbody>
            </table></td>
        </tr>
        <!--end row-->
        
             
        
        <!--blank row start-->
        <tr>
          <td height="15px" colspan="2">&nbsp;</td>
        </tr>
        <!--blank row end-->
        
        
          <td bgcolor="#ffffff" colspan="2" style="padding:10px;"><p style="padding:10px; border:1px solid #cccccc; color:#5a5a5a; line-height:22px; margin:0;"> If you're having trouble viewing this email, please <a href={{Config::get('constants.SiteCmsurl')}}newsletter/morning-post-<?php echo date('d-m-Y')?>.html style="color:#0066b4;">click 
              here</a></p></td>
          <!--=========================FOOTER START================-->
        <tr> 
          <!-- SOCIAL -->
          <td align="left" width="300" class="w500" style="padding:10px;"><table border="0" cellspacing="0" cellpadding="0">
             <tr>
                <td align="left" valign="middle" class="social"> Follow Us: </td>
                <td width="5"></td>
                <td align="right" valign="top" class="social" style=""><a href="https://www.facebook.com/exchange4media"
target="_blank"> <img src="https://www.exchange4media.com/images/fb-icon-color.png"
height="24" alt="Facebook" border="0" style="display:block; max-width: 24px"> </a></td>
                <td width="5"></td>
                <td align="right" valign="top" class="social"><a href="https://twitter.com/e4mtweets"
target="_blank"> <img src="https://www.exchange4media.com/images/twitter-icon-color.png"
height="24" alt="Twitter" border="0" style="display:block; max-width: 24px"> </a></td>
                <td width="5"></td>
                <td align="right" valign="top" class="social"><a href="http://www.linkedin.com/groups/exchange4media-Official-3987161?home=&gid=3987161&trk=anet_ug_hm"
target="_blank"> <img src="https://www.exchange4media.com/images/linkedin-icon-color.png"
height="24" alt="Linkedin" border="0" style="display:block; max-width: 24px"> </a></td>
                <td width="5"></td>
                <td align="right" valign="top" class="social"><a href="https://www.youtube.com/user/exchange4media"
target="_blank"> <img src="https://www.exchange4media.com/images/youtube-icon-color.png"
height="24" alt="Youtube" border="0" style="display:block; max-width: 24px"> </a></td>
              </tr>
            </table></td>
          <td align="right" valign="top" width="150" style="color: #212121!important; font-size: 16px; 
line-height: 24px; padding:10px;">&copy; <?php echo date('Y'); ?> </td>
          <!-- END SOCIAL --> 
        </tr>

        <!--=========================FOOTER END================-->
        
      </table>
      
      </td>
  </tr>
</table>
</body>
</html>