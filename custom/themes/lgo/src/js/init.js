jQuery(document).ready(function($) {

    //Init WOW.js with animate.css
    new WOW().init();

    $('.js-accordion').accordion();

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

    var topof = $('#skip-to-content').offset().top;
    var y = $(window).scrollTop(); 

    // element to detect scroll direction of
    var el = $(window),
      // initialize last scroll position
      lastY = el.scrollTop();

    $(window).scroll(function() {
      //Nav logo change color on scroll
      var scrollPos = $(window).scrollTop(),
          navbar = $('#nav-logo');
          topPanel = $('.top-page-panel');
          slimNav = $('.slim-nav-transition');

      var banner = document.getElementById("scroll-header");
      var panel = document.getElementById("scroll-panel");

      var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);

      // SMOOTH SCROLL UP OR DOWN
      // get current scroll position
      // var currY = el.scrollTop(),
      //     // determine current scroll direction
      //     scrollDirection = (currY > lastY) ? 'down' : ((currY === lastY) ? 'none' : 'up');
      // // do something here…
      // console.log(scrollDirection + ' ' + scrollPos);
      // if ( (scrollPos >= 50 && scrollPos <= 55) && scrollDirection == 'down' ) {
      //   $('html, body').animate({ scrollTop: $(window).height()}, 1000);
      // } else if ( scrollPos >= h+50 && scrollDirection == 'up' ) {
      //   $('html, body').animate({ scrollTop: 0}, 1000);
      // } else {
      //   // nothing
      // }

      // lastY = currY;

      // SHRINK LOGO
      if (scrollPos > (h-100)) {
          navbar.addClass('change-logo-size');
          slimNav.addClass('compress-slim-nav');
      } else {
          navbar.removeClass('change-logo-size');
          slimNav.removeClass('compress-slim-nav');
      }        

    });

    // SCROLL EVENTS FOR RIGHT COMPARTMENT
    if( $('.parent-page-layout').length ) {

      $('.scroll-panel').scroll(function() {

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
          var top = $(this).offset().top - parentH - 99 - (h/2)
            bottom = top + $(this).outerHeight()
            // childH = $(this).height();

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