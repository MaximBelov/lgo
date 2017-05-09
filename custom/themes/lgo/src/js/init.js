jQuery(document).ready(function($) {

    //Init WOW.js with animate.css
    new WOW().init();

    $('.js-accordion').accordion();

    // Smooth Scroll
    $('a[href*="#"]')
      // Remove links that don't actually link to anything
      .not('[href="#"]')
      .not('[href="#0"]')
      .click(function(event) {
        // On-page links
        if (
          location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
          && 
          location.hostname == this.hostname
        ) {
          // Figure out element to scroll to
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
          // Does a scroll target exist?
          if (target.length) {
            // Only prevent default if animation is actually gonna happen
            event.preventDefault();
            $('html, body').animate({
              scrollTop: target.offset().top
            }, 500, function() {
              // Callback after animation
              // Must change focus!
              var $target = $(target);
              $target.focus();
              if ($target.is(":focus")) { // Checking if the target was focused
                return false;
              } else {
                $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                $target.focus(); // Set focus again
              };
            });
          }
        }
      });

    // SLIDER

    if ( $('.slideshow-container').length ) {
      var slideIndex = 1;
      showSlides(slideIndex);

      function plusSlides(n) {
        showSlides(slideIndex += n);
      }

      $('.prev-s').click(function(){
        plusSlides(-1);
      });

      $('.next-s').click(function(){
        plusSlides(1);
      });

      function currentSlide(n) {
        showSlides(slideIndex = n);
      }

      function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {slideIndex = 1} 
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none"; 
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active-dot", "");
        }
        slides[slideIndex-1].style.display = "block"; 
        dots[slideIndex-1].className += " active-dot";
      }
    }

    // BANNER-BASED CODE

    // LAYOUT-BASED CODE 

    // $('.masonry-grid').masonry({
    //   // options
    //   itemSelector: '.grid-item',
    //   columnWidth: 130,
    //   horizontalOrder: true
    // });

    $(".slim-nav-transition").hover(
      function () {
        $( ".full-width-panel" ).addClass("full-width-panel--pushed");
      },
      function () {
        $( ".full-width-panel" ).removeClass("full-width-panel--pushed");
      }
    );

    $(".slim-nav-transition-static").hover(
      function () {
        $( ".full-width-panel" ).addClass("full-width-panel--pushed");
      },
      function () {
        $( ".full-width-panel" ).removeClass("full-width-panel--pushed");
      }
    );

    // SINGLE LG PAGE
    $(".slim-nav-transition-static").hover(
      function () {
        $( ".single-push-panel" ).addClass("single-push-panel--pushed");
      },
      function () {
        $( ".single-push-panel" ).removeClass("single-push-panel--pushed");
      }
    );

    // MENU-BASED CODE

    // if($('li.current_page_item.menu-item-has-children')) {
    //   $('li.current_page_item').
    //   console.log('hey');
    // } else {

    // }

    $('.menu-after-dots').click(function(){
      $(this).next('ul').toggleClass( "open-dropdown" );
    });

    $('.menu-item-has-children').hover(function(){
      $(this).children('ul').toggleClass( "open-dropdown" );
    });

    $('.menu-after-dots').keypress(function(e){
      if(e.which == 13){//Enter key pressed
        $(this).next('ul').toggleClass( "open-dropdown" );
      }
    });

    // Activate Mobile Nav via click/enter
      $('.nav-trigger').click(function(){
          $( ".navbar-fixed" ).toggleClass( "nav-menu-open" );
          $( "body" ).toggleClass( "no-scroll" );
          $(this).toggleClass('open');
      });

      // $('.nav-trigger').keypress(function(e){
      //   if(e.which == 13){//Enter key pressed
      //       $( ".navbar-fixed" ).toggleClass( "nav-menu-open" );
      //       $( "body" ).toggleClass( "no-scroll" );
      //       $(this).toggleClass('open');
      //   }
      // });

      // $('.menu-after-dots').click(function(){
      //   if ($('body').hasClass('no-scroll')) {
      //         $('#menu-main-menu >li ul').removeClass('active-menu-screen');
      //         $(this).next('ul').toggleClass('active-menu-screen');
      //   }
      // });

      // $('.menu-after-dots').keypress(function(e){
      //     if(e.which == 13){//Enter key pressed
      //         if ($('body').hasClass('no-scroll')) {
      //             $(this).next('ul').slideToggle();
      //         }
      //     }
      // });

    // SCROLL-BASED CODE
    var sections = $('.child-page')
      nav = $('.current-menu-item')
      nav_height = nav.outerHeight()
      leftBg = $('.left-compartment__bg');

    var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);

    $(window).scroll(function() {

      // Change NAV active item CSS on scroll
      if( $('.parent-page-layout').length ) {
        var cur_pos = $(this).scrollTop();
        sections.each(function() {
          var top = $(this).offset().top - 200,
            bottom = top + $(this).outerHeight() - (h/2);

          if (cur_pos >= top && cur_pos <= bottom) {
            // console.log($(this).attr('id'));
            nav.find('a').removeClass('menu-item-active');
            sections.removeClass('menu-item-active');

            $(this).addClass('menu-item-active');
            nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('menu-item-active');
            var theBG = $(this).attr('data-child-bg');
            // console.log(theBG);
            $('.left-compartment__bg').css({'backgroundImage': 'url('+theBG+')'});
          }
        });
      }

      //Nav logo change color on scroll
      var scrollPos = $(window).scrollTop(),
          navbar = $('#nav-logo');
          topPanel = $('.top-page-panel');
          slimNav = $('.slim-nav-transition');

      var banner = document.getElementById("scroll-header");
      var panel = document.getElementById("scroll-panel");

      // SHRINK LOGO
      if (scrollPos > (h-100)) {
          navbar.addClass('change-logo-size');
          slimNav.addClass('compress-slim-nav');
      } else {
          navbar.removeClass('change-logo-size');
          slimNav.removeClass('compress-slim-nav');
      } 

    });

});