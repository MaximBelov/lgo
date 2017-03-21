(function($){
  $(function(){

    $('.button-collapse').sideNav();
    $('.parallax').parallax();

  }); // end of document ready

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

    $('.has-sub').click(function(){
      if ($('body').hasClass('no-scroll')) {
          $(this).children('ul').slideToggle();
          $(this).children('i').toggleClass('fa-chevron-down fa-chevron-up');
      }
    });

    $('.has-sub').keypress(function(e){
        if(e.which == 13){//Enter key pressed
            if ($('body').hasClass('no-scroll')) {
                $(this).children('ul').slideToggle();
                $(this).children('i').toggleClass('fa-chevron-down fa-chevron-up');
            }
        }
    });


})(jQuery); // end of jQuery name space

//Init WOW.js with animate.css
new WOW().init();

//Nav bar change color on scroll
jQuery(document).ready(function($) {
    $(window).scroll(function() {
        var scrollPos = $(window).scrollTop(),
            navbar = $('nav');

        if (scrollPos > 50) {
            navbar.addClass('change-color');
        } else {
            navbar.removeClass('change-color');
        }
    });
});

//Logo change color on scroll
jQuery(document).ready(function($) {
    $(window).scroll(function() {
        var scrollPos = $(window).scrollTop(),
            logo = $('.brand-logo');

        if (scrollPos > 50) {
            logo.addClass('change-size');
        } else {
            logo.removeClass('change-size');
        }
    });
});

//ScrollSpy
jQuery(document).ready(function($){
    $('.scrollspy').scrollSpy({
        scrollOffset: 80
    });
});

//Menu Highlight
jQuery(document).ready(function($){
    var sections = $('section')
  , nav = $('.menu')
  , nav_height = nav.outerHeight();

$(window).on('scroll', function () {
    var cur_pos = $(this).scrollTop();
    sections.each(function() {
        var top = $(this).offset().top - nav_height,
            bottom = top + $(this).outerHeight();
    
        if (cur_pos >= top && cur_pos <= bottom) {
            nav.find('a').removeClass('active');
            sections.removeClass('active');
      
            $(this).addClass('active');
            nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('active');
            }
        });
    });
});