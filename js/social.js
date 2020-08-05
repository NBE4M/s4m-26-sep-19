$(document).ready(function() {
  var left = (screen.width - 570) / 2;
  var top = (screen.height - 570) / 2;
  var params = "menubar=no,toolbar=no,status=no,width=570,height=570,top=" + top + ",left=" + left;
  /*window.open(url,"NewWindow",params);*/

  $(".common-share.facebook").click(function(){    
  var pageUrl = this.id;
  var title = $(this).attr('data-title');
    url = "https://www.facebook.com/sharer.php?u=" + pageUrl+ "&utm_source=" + 'desktop'+ "&utm_medium=" + 'facebook'+ "&utm_campaign=" + 'facebook'+ "&utm_term=" + 'facebook'+ "&utm_content=" + 'facebook';
    window.open(url,"NewWindow",params);
  });
  $(".common-share.whatsup").on("click", function() {
    var pageUrl = this.id;
  var title = $(this).attr('data-title');
    url = "https://api.whatsapp.com/send?text=" + title + " "+ pageUrl+ "&utm_source=" + 'desktop'+ "&utm_medium=" + 'whatsapp'+ "&utm_campaign=" + 'whatsapp'+ "&utm_term=" + 'whatsapp'+ "&utm_content=" + 'whatsapp';
    window.open(url,"NewWindow",params);
  });

  $(".common-share.twitter").on("click", function() {
    var pageUrl = this.id;
  var title = $(this).attr('data-title');
  url = "https://twitter.com/intent/tweet?url=" + pageUrl + "&text=" + title+ "&via=" + 'samachar4media'+ "&utm_source=" + 'desktop'+ "&utm_medium=" + 'twitter'+ "&utm_campaign=" + 'twitter'+ "&utm_term=" + 'twitter'+ "&utm_content=" + 'twitter';
     window.open(url,"NewWindow",params);
  });

  $(".common-share.linkedin").on("click", function() {
    var pageUrl = this.id;
  var title = $(this).attr('data-title');
    url = "https://www.linkedin.com/shareArticle?mini=true&url=" + pageUrl+ "&utm_source=" + 'desktop'+ "&utm_medium=" + 'linkedin'+ "&utm_campaign=" + 'linkedin'+ "&utm_term=" + 'linkedin'+ "&utm_content=" + 'linkedin';
     window.open(url,"NewWindow",params);
  })
  $(".common-share.mail").on("click", function() {
      var pageUrl = this.id;
  var title = $(this).attr('data-title');
      var copy = 'Hi,%0A I thought you\'d like this:%0A'
                        +pageUrl+'%0A%0A%0A'+title;
    url = "mailto:?subject=" + title+ "&body="+ copy + "&utm_source=" + 'desktop'+ "&utm_medium=" + 'email'+ "&utm_campaign=" + 'email'+ "&utm_term=" + 'email'+ "&utm_content=" + 'email';
     window.open(url,"NewWindow",params);
  })
});


