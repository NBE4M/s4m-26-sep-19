// $.ajaxSetup({ headers: { 'csrftoken' : 'QK1LbTS65W2hkRoXezyWAxyRVl1GTp4npliKYAKU' } });
//    $(document).ready(function() {
//     src = window.location.href+'autoComplete';
//      $(".search_text").autocomplete({
//         source: function(request, response) {
//             $.ajax({
//                 url: src,
//                 dataType: "json",
//                 data: {
//                     term : request.term
//                 },
//                 success: function(data) {
//                     response(data);
                   
//                 }
//             });
//         },
//         minLength: 3,
       
//     });
// });
$(document).ready(function() {
    src = window.location.origin+'/news/autoComplete';
     $(".search_text").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: src,
                dataType: "json",
                data: {
                    term : request.term
                },
                success: function(data) {
                    response(data);
                   
                }
            });
        },
        minLength: 3,
        autoFill: true,
select: function (event, ui) {
    var label = ui.item.label;
    var value = ui.item.value;
    var statelookup = value.replace(/ /g, '-')
   window.location=window.location.origin+"/search"+'/'+statelookup;
}

       
    });
});

  function imgError(image) {
    
    image.onerror = "";
    image.src = "https://storage.googleapis.com/news-photos/default-story.jpg";
    return true;
}
 

//     $(function(){
//         $(".btn-search").click(function(){
//         $(".error").hide();
//         var hasError = false;
//         var searchVal = $(".search_text").val();
//           alert(searchVal);
//         if(searchVal != '') {
//           window.location=window.location.origin+"/search"+'/'+searchVal;
           
//         }else{
//            $("#bgsbox").after('<span class="error">Please enter a search term.</span>');
//             hasError = true;
//         }
//         if(hasError == true) {return false;}
//     });
// });

    //newsTicker js home-->

            var nt_example1 = $('#nt-example1').newsTicker({
                row_height: 80,
                max_rows: 3,
                duration: 4000,
                prevButton: $('#nt-example1-prev'),
                nextButton: $('#nt-example1-next')
            });

 //newsTicker js home-->
  
//newsTicker js story-->

            var nt_example2 = $('#nt-example2').newsTicker({
                row_height: 180,
                max_rows: 3,
                duration: 4000,
                prevButton: $('#nt-example2-prev'),
                nextButton: $('#nt-example2-next')
            });

  //newsTicker js story-->
  
//home page video section js-->
  
  $(".video-thumb").click(function() {
          $('.video-thumb > img').removeClass("active");
          $(this).children('img').addClass("active");
          $('.video-iframe img').attr('src', ($(this).children('img').attr('src')));
          $('.video-iframe a').attr('href', ($(this).children('img').attr('data-url')));
        });

//home page video section js-->
  
  //story left fix js-->
 
    $('.leftSidebar, .content, .rightSidebar')
        .theiaStickySidebar({
            additionalMarginTop: 30
        });
   
///story left fix js-->
// Return Top Js
// ===== Scroll to Top ==== //
$(window).scroll(function() {
    if ($(this).scrollTop() >= 600) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});
// Return Top Js

// Tags Ajax
  $(document).ready(function() {
    $('.page-link').click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var id =($(this).attr("data-id"));
      
        $.ajax({
             type:"POST",
             url:"/tags/list/"+id,
             success : function(results) {
                
                  $("#resulthide").hide();
                  $("#tagss").text(id);
                  $("#result").empty();
                  $("#result").append(results);
             }
        }); 
    });
    
}); 
// Tags Ajax 

//  Subscriber Ajax

  function front_subcribe_form() {
     function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
    if(document.getElementById("email").value=="") 
    {
    document.getElementById("semail_err").style.display = "inline";
    document.getElementById("semail_err").innerHTML="कृपया ईमेल-एड्रेस डाले ";
    return false;
    }
    else if (!validateEmail(document.getElementById("email").value)) {

    document.getElementById("semail_err").style.display = "inline";
    document.getElementById("semail_err").innerHTML="कृपया सही ईमेल-एड्रेस डाले ";       
      }
    else{

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      var email = $('#email').val();
      
      var token = $('meta[name="csrf-token"]').attr('content');     
    $.ajax({
        type : 'POST',
        url : window.location.origin+"/newsletter_subscribe",
        data : {'_token':token,'email':email},
        cache: false,
        
        success: function(data) {
          document.getElementById("semail_err").style.display = "none";
          document.getElementById("thx").innerHTML="Thank you, an activation email has been sent to your Email. Please check your email to complete the sign-up process.";
              $("#thankyouModal").modal('show');
          setTimeout(function() {
              window.location.reload(true);
            }, 1500);

            },
            error: function(data) {
              document.getElementById("semail_err").style.display = "none";
              document.getElementById("thx").innerHTML="This Email id is already Exist.";
              $("#thankyouModal").modal('show');
                setTimeout(function() {
              window.location.reload(true);
            }, 1500);             
            },


    })

  }
} 
//  Subscriber Ajax end
//  Subscriber Ajax

  function right_subcribe_form() {
     function validateEmail(email) {
      
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
    if(document.getElementById("email").value=="") 
    {
    document.getElementById("semail_err").style.display = "inline";
    document.getElementById("semail_err").innerHTML="कृपया ईमेल-एड्रेस डाले ";
    return false;
    }
    else if (!validateEmail(document.getElementById("email").value)) {

    document.getElementById("semail_err").style.display = "inline";
    document.getElementById("semail_err").innerHTML="कृपया सही ईमेल-एड्रेस डाले ";       
      }
    else{

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      var email = $('#email').val();
      
      var token = $('meta[name="csrf-token"]').attr('content');     
    $.ajax({
        type : 'POST',
        url : window.location.origin+"/newsletter_subscribe",
        data : {'_token':token,'email':email},
        cache: false,
        
        success: function(data) {
          document.getElementById("semail_err").style.display = "none";
          document.getElementById("thx").innerHTML="Thank you, an activation email has been sent to your Email. Please check your email to complete the sign-up process.";
              $("#thankyouModal").modal('show');
          setTimeout(function() {
              window.location.reload(true);
            }, 1500);

            },
            error: function(data) {
              document.getElementById("semail_err").style.display = "none";
              document.getElementById("thx").innerHTML="This Email id is already Exist.";
              $("#thankyouModal").modal('show');
                setTimeout(function() {
              window.location.reload(true);
            }, 1500);             
            },


    })

  }
} 
//  Subscriber Ajax end
//  Subscriber Ajax

  function inner_story_subcribe_form() {
      
     function validateEmail(inner_email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(inner_email);
}
    if(document.getElementById("inner_email").value=="") 
    {
    document.getElementById("inner_semail_err").style.display = "inline";
    document.getElementById("inner_semail_err").innerHTML="कृपया ईमेल-एड्रेस डाले ";
    return false;
    }
    else if (!validateEmail(document.getElementById("inner_email").value)) {

    document.getElementById("inner_semail_err").style.display = "inline";
    document.getElementById("inner_semail_err").innerHTML="कृपया सही ईमेल-एड्रेस डाले ";       
      }
    else{

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      var email = $('#inner_email').val();
      
      var token = $('meta[name="csrf-token"]').attr('content');     
    $.ajax({
        type : 'POST',
        url : window.location.origin+"/newsletter_subscribe",
        data : {'_token':token,'email':email},
        cache: false,
        
        success: function(data) {
          document.getElementById("inner_semail_err").style.display = "none";
          document.getElementById("thx").innerHTML="Thank you, an activation email has been sent to your Email. Please check your email to complete the sign-up process.";
              $("#thankyouModal").modal('show');
          setTimeout(function() {
              window.location.reload(true);
            }, 1500);

            },
            error: function(data) {
              document.getElementById("inner_semail_err").style.display = "none";
              document.getElementById("thx").innerHTML="This Email id is already Exist.";
              $("#thankyouModal").modal('show');
                setTimeout(function() {
              window.location.reload(true);
            }, 1500);             
            },


    })

  }
} 
//  Subscriber Ajax end
//  Subscriber Ajax

  function subscribe_page_form() {
     function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
    if(document.getElementById("subscribe_page_email").value=="") 
    {
    document.getElementById("subscribe_page_semail_err").style.display = "inline";
    document.getElementById("subscribe_page_semail_err").innerHTML="कृपया ईमेल-एड्रेस डाले ";
    return false;
    }
    else if (!validateEmail(document.getElementById("subscribe_page_email").value)) {

    document.getElementById("subscribe_page_semail_err").style.display = "inline";
    document.getElementById("subscribe_page_semail_err").innerHTML="कृपया सही ईमेल-एड्रेस डाले ";       
      }
    else{

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      var email = $('#inner_email').val();
      
      var token = $('meta[name="csrf-token"]').attr('content');     
    $.ajax({
        type : 'POST',
        url : window.location.origin+"/newsletter_subscribe",
        data : {'_token':token,'email':email},
        cache: false,
        
        success: function(data) {
          document.getElementById("subscribe_page_semail_err").style.display = "none";
          document.getElementById("thx").innerHTML="Thank you, an activation email has been sent to your Email. Please check your email to complete the sign-up process.";
              $("#thankyouModal").modal('show');
          setTimeout(function() {
              window.location.reload(true);
            }, 1500);

            },
            error: function(data) {
              document.getElementById("subscribe_page_semail_err").style.display = "none";
              document.getElementById("thx").innerHTML="This Email id is already Exist.";
              $("#thankyouModal").modal('show');
                setTimeout(function() {
              window.location.reload(true);
            }, 1500);             
            },


    })

  }
} 
//  Subscriber Ajax end
function dateWiseNewsletter() {
  $('.seeMore').hide();
  $('.datepickerhideshow').show();
  $( function() {
    $( "#datepicker" ).datepicker({ maxDate: "0",dateFormat:"dd-mm-yy" });
  });
}
$('.dateurl').click(function(){
  var pickdate = $('#datepicker').val();
  window.location=window.location.origin+"/newsletter"+'/'+pickdate+'/archive.html';
}) 

// Tags Ajax
    function pollsubmit(){
      // alert(window.location.origin+"/img/thanku.jpg"); return false;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });      
        $.ajax({
             type:"POST",
             url:window.location.origin+'/polldesign',
             data : $('#poll_form').serialize(),
             success : function(results) {                
                  // $(".modal-body").hide();
                  // $('.modal-footer').hide();
                  $('#ans_validation').html('Thanks for voting !');
                  // $("#result").empty();
                  // $("#result").append(results);
             },
             error: function (jqXHR, status,data) {
              var msg = '';
              if (jqXHR.status === 0) {
                  msg = 'Not connect. Please Verify Network.';
              } else if (jqXHR.status == 404) {
                  msg = 'Requested page not found. [404]';
              } else if (jqXHR.status == 500) {
                  msg = 'Internal Server Error [500].';
              } else if (jqXHR.status === 401) {
                  msg = 'Please select at-least one option.';
              } else if (jqXHR.status === 402) {
                  msg = 'You have already voted.';
              } else if (exception === 'timeout') {
                  msg = 'Time out error.';
              } else if (exception === 'abort') {
                  msg = 'Ajax request aborted.';
              } else {
                  msg = 'Uncaught Error.\n' + jqXHR.responseText;
              }
              $('#ans_validation').html(msg);
          },
        }); 
    }

// Tags Ajax 
 