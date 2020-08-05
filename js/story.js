
    $(function () {
   var currentHash = window.location.pathname;
    $(document).scroll(function () {
        $('.views').each(function () {
            var top = window.pageYOffset;
            var distance = top - $(this).offset().top;
            var hash = $(this).attr('href');
            var title = $(this).next('input').val() + '-Samachar4media';
            var desc = $(this).prev('input').val();
            var imgc = $(this).siblings('.imgc').val();
            if (distance < 120 && distance > -120 && currentHash != hash) {
               window.history.replaceState({"html":hash,"pageTitle":hash},"", hash);
               var url = window.location.href;
               var ampurl = window.location.protocol + "/" + window.location.host + window.location.pathname+"/amp";
                $("meta[name=title]").attr("content", title);
                $("meta[property='og\\:title']").attr("content", title);
                $("meta[name=description]").attr("content", desc);
                $("meta[property='og\\:description']").attr("content", desc);
                $("meta[name=image_src]").attr("content", imgc);
                $("meta[property='og\\:image']").attr("content", imgc);
                $("meta[property='og\\:url']").attr("content", url);
                $("meta[name='twitter\\:title']").attr("content", title);
                $("meta[name='twitter\\:description']").attr("content", desc);
                $("meta[name='twitter\\:image:src']").attr("content", imgc);
                $('link[rel="canonical"]').attr('href', url);
                $('link[rel="amphtml"]').attr('href', ampurl);
                $(document).attr("title", title);
                $("#rightside").load(" #rightside > *");                
            }
           
        });

 
    });
});

// global vars used by disqus
// var currentHash = window.location.href;
// var disqus_shortname = 'samachar4media';
// var disqus_identifier; // made of post id &nbsp; guid
// var disqus_url; // post permalink

function loadDisqus(source,url) {
    if (window.DISQUS) {
        $('#disqus_thread').appendTo(source.parent()); // append the HTML to the control parent

        // if Disqus exists, call it's reset method with new parameters
        DISQUS.reset({
            reload: true,
            config: function() {
                this.page.identifier = url;
                this.page.url = url;
            }
        });
    } else {
        //insert a wrapper in HTML after the relevant "show comments" link
        $('<div id="disqus_thread"></div>').insertAfter(source);
        disqus_identifier = url; // set the identifier argument
        disqus_url = url; // set the permalink argument

        // append the Disqus embed script to HTML
        var dsq = document.createElement('script');
        dsq.type = 'text/javascript';
        dsq.async = true;
        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
        $('head').append(dsq);
    }
};



// var currentHash = window.location.href;
// var disqus_config = function () {
// this.page.url = currentHash;  // Replace PAGE_URL with your page's canonical URL variable
// this.page.identifier = currentHash; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
// };
// (function() { // DON'T EDIT BELOW THIS LINE
// var d = document, s = d.createElement('script');
// s.src = 'https://samachar4media-com.disqus.com/embed.js';
// s.setAttribute('data-timestamp', +new Date());
// (d.head || d.body).appendChild(s);
// })();

// var disqus_config = function () {
// this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
// this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
// };

(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://samachar4media-com.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();

$("#mrn").click(function(){
  $("#mrnLetter").show('slow');
  $("#eveLetter").hide('slow');
  
});
$("#eve").click(function(){
  $("#mrnLetter").hide('slow');
  $("#eveLetter").show('slow');
  
});

  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-37285268-1');
      $(function () {
   var currentHash = window.location.pathname;
    $(document).scroll(function () {
        $('.views').each(function () {
             var hash = $(this).attr('href');
            var top = window.pageYOffset;
            var distance = top - $(this).offset().top;
            if (distance < 120 && distance > -120 && currentHash != hash) {
               var url = window.location.pathname;
            gtag('config', 'UA-37285268-1', {
            'page_path': url
            });
            }
        });
    });
});

