(function($){

  $('.js-accordion').accordion();

  // Materialize modal triggers
  $('.modal-trigger-general').click(function() {
    var address = $(this).attr("data-modalnum");
    $(address).openModal();
  });

  // Activate Mobile Nav via click/enter
    $('.nav-trigger').click(function(){
        $( ".navbar-fixed" ).toggleClass( "nav-menu-open" );
        $( "body" ).toggleClass( "no-scroll" );
        $(this).toggleClass('open');
    });

    $('.nav-trigger').keypress(function(e){
      if(e.which == 13){//Enter key pressed
          $( ".navbar-fixed" ).toggleClass( "nav-menu-open" );
          $( "body" ).toggleClass( "no-scroll" );
          $(this).toggleClass('open');
      }
    });

    $('.menu-after-dots').click(function(){
      if ($('body').hasClass('no-scroll')) {
            $('#menu-main-menu >li ul').removeClass('active-menu-screen');
            $(this).next('ul').toggleClass('active-menu-screen');
      }
    });

    $('.menu-after-dots').keypress(function(e){
        if(e.which == 13){//Enter key pressed
            if ($('body').hasClass('no-scroll')) {
                $(this).next('ul').slideToggle();
            }
        }
    });


})(jQuery); // end of jQuery name space

//Init WOW.js with animate.css
new WOW().init();


jQuery(document).ready(function($) {

    function scrollTo(element, to, duration) {
        if (duration <= 0) return;
        var difference = to - element.scrollTop;
        var perTick = difference / duration * 10;

        setTimeout(function() {
            element.scrollTop = element.scrollTop + perTick;
            if (element.scrollTop === to) return;
            scrollTo(element, to, duration - 10);
        }, 10);
    }

    $(window).scroll(function() {
      //Nav logo change color on scroll
      var scrollPos = $(window).scrollTop(),
          navbar = $('#nav-logo');
          topPanel = $('.top-page-panel');
          slimNav = $('.slim-nav-transition');

      var banner = document.getElementById("scroll-header");
      var panel = document.getElementById("scroll-panel");

      var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
      // console.log(scrollPos);

      if (scrollPos > (h-100)) {
          navbar.addClass('change-logo-size');
          slimNav.addClass('compress-slim-nav');
      } else {
          navbar.removeClass('change-logo-size');
          slimNav.removeClass('compress-slim-nav');
      }        

    });

    if( $('.parent-page-layout').length ) {

      $('#scroll-panel').scroll(function() {

       // Active nav items
      var sections = $('.child-page')
        nav = $('#main-menu-ww')
        nav_height = nav.outerHeight();

      var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);

      var cur_pos = $(this).scrollTop();

      var parentH = $('.right-compartment').offset().top;
      
      // console.log( parentH );
      // console.log('-----');

        sections.each(function() {
          var top = $(this).offset().top - parentH - 99 
            bottom = top + $(this).outerHeight()
            childH = $(this).height();

          var theID = $(this).attr('id');
          // console.log(theID + ' ' + cur_pos + ' ' + top + ' ' + bottom );

          if (cur_pos >= top && cur_pos <= bottom) {
            // console.log(theID);
             nav.find('a').removeClass('menu-item-active');
             sections.removeClass('menu-item-active');
             // console.log('blurp');
         
             $(this).addClass('menu-item-active');
             nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('menu-item-active');
          }
        }); //ends for each

      }); //ends check for scrolling of #scroll-panel
    } //ends check for Parent template

});

// jQuery(document).ready(function($){
//   var stickySidebar = $('.page__bg__fixed').offset().top;

//   $(window).scroll(function() {  
//       if ($(window).scrollTop() > stickySidebar) {
//           $('.page__bg__fixed').addClass('affix');
//           // console.log('booo')
//       }
//       else {
//           $('.page__bg__fixed').removeClass('affix');
//           // console.log('YESSS')
//       }  
//   });
// });