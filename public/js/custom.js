// JavaScript Document

/*menu js*/
	 jQuery(window).scroll(function(){
		var headerHeight = jQuery('#header').innerHeight();
		var resource = jQuery('.resources').height();
		var suggested = jQuery('.suggested').height();
		var totalHeight = headerHeight + resource + suggested + 360;
        var sticky = jQuery('.white');
        var sticky1 = jQuery('.followUs');
		scroll = jQuery(window).scrollTop();
        if (scroll >= 300){
            sticky.addClass('fixed');
            jQuery('#blog-section').css('padding-top', '91px');
        }else {
            sticky.removeClass('fixed');
			jQuery('#blog-section').css('padding-top', '19px');
        }
		
		if (scroll >= totalHeight){
			var widthS = jQuery('.suggested').width()+31;
            sticky1.addClass('fixed1');
            sticky1.css('width', widthS);
        }else {
            sticky1.removeClass('fixed1');
			sticky1.css('width', '100%');
        }
    });
	
    jQuery(document).ready(function(){
        bindFooterScroller();
		        jQuery(".year-data").click(function(){
            jQuery(this).parents('li').find('.blog-month').slideToggle();
            jQuery(this).find('.plus-icon').toggleClass('active');
            jQuery(this).parent().siblings().find('.plus-icon').removeClass('active');
            jQuery(this).parent().siblings().children().next().slideUp();
            return false;
        });
		
		jQuery('.burger-container').click(function(){
			jQuery(this).parent().parent().find('#menu').toggleClass('menu-opened');
		});
		 jQuery('.f-heading').on('click', function () {
			jQuery(this).parent().toggleClass('visible');
		});
		var catWidth = jQuery('.normal').width()-15;
		jQuery('.cat-dropdown').width(catWidth);
		jQuery('.cat-dropdown').css('font-size', '100%');
		if (jQuery(window).width() <= 1024){	
			var catWidth = jQuery('.normal').width()-15;
			jQuery('.cat-dropdown').width(catWidth);
			jQuery('.cat-dropdown').css('font-size', '75%');
		}	
		if (jQuery(window).width() <= 640){	
			var catWidth = jQuery('.normal').width()-15;
			jQuery('.cat-dropdown').width(catWidth);
			jQuery('.cat-dropdown').css('font-size', '100%');
		}	
    });
	
	jQuery(window).resize(function(){
		var catWidth = jQuery('.normal').width()-15;
		jQuery('.cat-dropdown').width(catWidth);
		jQuery('.cat-dropdown').css('font-size', '100%');
		if (jQuery(window).width() <= 1024){	
			var catWidth = jQuery('.normal').width()-15;
			jQuery('.cat-dropdown').width(catWidth);
			jQuery('.cat-dropdown').css('font-size', '75%');
		}	
		if (jQuery(window).width() <= 640){	
			var catWidth = jQuery('.normal').width()-15;
			jQuery('.cat-dropdown').width(catWidth);
			jQuery('.cat-dropdown').css('font-size', '100%');
		}	
	});
	
	$header = jQuery("#header"),
	$clone = $header.before($header.clone().addClass("clone"));	
	jQuery(window).scroll(function () {
		jQuery("#header").toggleClass("down", (jQuery(window).scrollTop() > 100));           
	})
	
    jQuery.fn.scrollStopped = function (callback) {
        var jQuerythis = jQuery(this), self = this;
        jQuerythis.scroll(function () {
            if (jQuerythis.data('scrollTimeout')) {
                clearTimeout(jQuerythis.data('scrollTimeout'));
            }
            jQuerythis.data('scrollTimeout', setTimeout(callback, 250, self));
        });
    };


    function bindFooterScroller() {
        jQuery(window).scroll(function () {
			var headerHeight = jQuery('#header').innerHeight();
			var sticky1 = jQuery('.followUs');
            var sticky = jQuery('.white')
            var footerElement = jQuery('#subscribe-blog');
            if (isScrolledIntoView(footerElement)) {
                sticky.hide();
				sticky1.hide();
				//jQuery('#blog-section').css('padding-top', '19px');
            }
            else {
				var headerHeight = jQuery('#header').innerHeight();
				var resource = jQuery('.resources').height();
				var suggested = jQuery('.suggested').height();
				var totalHeight = headerHeight + resource + suggested + 360;
				var sticky1 = jQuery('.followUs');
				sticky.show();
				sticky1.show();
				var sticky = jQuery('.white');
				var sticky1 = jQuery('.followUs');
				scroll = jQuery(window).scrollTop();
				if (scroll >= 300){
						jQuery('#blog-section').css('padding-top', '91px');
						jQuery('.controls').css('display','block');
					}else {
						//jQuery('#blog-section').css('padding-top', '19px');
						jQuery('.controls').css('display','none');
					}
					if (scroll >= totalHeight){
						var widthS = jQuery('.suggested').width()+31;
						sticky1.addClass('fixed1');
						sticky1.css('width', widthS);
					}else {
						sticky1.removeClass('fixed1');
						sticky1.css('width', '100%');
					}
            }
        })
    }

    function isScrolledIntoView(jQueryelem) {
        var docViewTop = jQuery(window).scrollTop() + jQuery(window).height();
        var elemTop = jQueryelem.offset().top;
        return (elemTop <= docViewTop);
    }
	
	function bindLoaderScroller() {
	jQuery(window).scroll(function () {
		var loaderElement = jQuery('#loader');
		if (isScrolledIntoView1(loaderElement)) {
			setTimeout(function(){
				jQuery(".left-content .border:eq(9), .left-content .border:eq(10), .left-content .border:eq(11), .left-content .border:eq(12), .left-content .border:eq(13), .left-content .border:eq(14), .left-content .border:eq(15), .left-content .border:eq(16),.left-content .border:eq(17), .more-post").fadeIn( "slow" ); jQuery('#loader').fadeOut("slow"); 
				jQuery('.left-content').isotope({
				  itemSelector: '.border'
				});
			}, 2000);
		}
	})
}

function isScrolledIntoView1(jQueryelem1) {
	var docViewTop = jQuery(window).scrollTop() + jQuery(window).height();
	var elemTop = jQueryelem1.offset().top;
	return (elemTop <= docViewTop);
}

jQuery(window).load(function(){
	var Wwidth = jQuery(window).width();
	if ((Wwidth <=767)) {
		var rsW = jQuery('.resources1 .banner-text').innerHeight();
		jQuery('.resources1 .overlay img').css('height', rsW);
	}else{
		jQuery('.resources1 .overlay img').css('height', 'auto');
	}
});

jQuery(window).resize(function(){
	var Wwidth = jQuery(window).width();
	if ((Wwidth <=767)) {
		var rsW = jQuery('.resources1 .banner-text').innerHeight();
		jQuery('.resources1 .overlay img').css('height', rsW);
	}else{
		jQuery('.resources1 .overlay img').css('height', 'auto');
	}
});
var bcrumb1;
jQuery(document).ready(function(){
	var all = [];
	var s = 0;
	jQuery('.breadcrumbs li').each(function () {
		  all[s++] = jQuery(this).text().trim();
		});    
	bcrumb1 = all.join('|');
});
/*menu js*/






