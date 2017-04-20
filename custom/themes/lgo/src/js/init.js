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
    $(window).scroll(function() {
      //Nav logo change color on scroll
      var scrollPos = $(window).scrollTop(),
          navbar = $('#nav-logo');

      var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
      console.log(h);

      if (scrollPos > (h-100)) {
          navbar.addClass('change-logo-size');
      } else {
          navbar.removeClass('change-logo-size');
      }

      // Active nav items
        var sections = $('.child-page-content')
      , nav = $('#main-menu-ww')
      , nav_height = nav.outerHeight();

      var cur_pos = $(this).scrollTop();
      sections.each(function() {
      var top = $(this).offset().top - nav_height,
          bottom = top + $(this).outerHeight();
  
      if (cur_pos >= top && cur_pos <= bottom) {
          nav.find('a').removeClass('menu-item-active');
          sections.removeClass('menu-item-active');
    
          $(this).addClass('menu-item-active');
          nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('menu-item-active');
          }
      });

    });
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