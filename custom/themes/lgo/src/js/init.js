jQuery(document).ready(function($) {

    //Init WOW.js with animate.css
    new WOW().init();

    $('.js-accordion').accordion();

    // $('#search-trigger').click(
    //   function(event) {
    //     event.preventDefault();
    //     $('#s').focus();
    //   }
    // );

    // $('#search-trigger').on('focus', function(e){
    //   $('#s').focus();
    // });

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

    $(".slim-nav-transition").hover(
      function () {
        $( ".full-width-panel" ).addClass("full-width-panel--pushed");
        $( ".left-panel__navigation" ).addClass("on-hover");
      },
      function () {
        $( ".full-width-panel" ).removeClass("full-width-panel--pushed");
        $( ".left-panel__navigation" ).removeClass("on-hover");
      }
    );

    $(".slim-nav-transition-static").hover(
      function () {
        $( ".full-width-panel" ).addClass("full-width-panel--pushed");
        $( ".left-panel__navigation" ).addClass("on-hover");
      },
      function () {
        $( ".full-width-panel" ).removeClass("full-width-panel--pushed");
        $( ".left-panel__navigation" ).removeClass("on-hover");
      }
    );

    $('.slim-nav-label').keypress(function(e){
      if(e.which == 13){//Enter key pressed
        $( ".full-width-panel" ).addClass("full-width-panel--pushed");
        $( ".left-panel__navigation" ).addClass("on-hover");
      }
    });

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
      $( ".left-panel__navigation" ).toggleClass( "open-navigation" );
    });

    // SCROLL-BASED CODE
    var sections = $('.child-page')
      nav = $('.current-menu-item')
      nav_height = nav.outerHeight()
      leftBg = $('.left-compartment__bg');

    var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);

    $(window).scroll(function() {

      //Nav logo change color on scroll
      var scrollPos = $(window).scrollTop(),
          navbar = $('#nav-logo');
          topPanel = $('.top-page-panel');
          slimNav = $('.slim-nav-transition');
          sharePanel = $('.social-share');

      var banner = document.getElementById("scroll-header");
      var panel = document.getElementById("scroll-panel");

      // SHRINK LOGO
      if (scrollPos > (100)) {
          navbar.addClass('change-logo-size');
          slimNav.addClass('compress-slim-nav');
      } else {
          navbar.removeClass('change-logo-size');
          slimNav.removeClass('compress-slim-nav');
      }

      //SHOW SHARE PANEL
      if ( $( sharePanel.length >= 1 )) {
        if (scrollPos > (h*0.7)) {
          sharePanel.addClass('scrolling-share');
        } else {
          sharePanel.removeClass('scrolling-share');
        } 
      }
    }); //ends scroll events

    // Highlight Sharer
      // Grab Twitter UN
    var twitterUser = $( "#twitter-social-share" ).data( "twitterUser" );
    /* @author: Xavier Damman (@xdamman) - http://github.com/xdamman/selection-sharer - @license: MIT */!function(a){var b=function(b){var c=this;b=b||{},"string"==typeof b&&(b={elements:b}),this.sel=null,this.textSelection="",this.htmlSelection="",this.appId=a('meta[property="fb:app_id"]').attr("content")||a('meta[property="fb:app_id"]').attr("value"),this.url2share=a('meta[property="og:url"]').attr("content")||a('meta[property="og:url"]').attr("value")||window.location.href,this.getSelectionText=function(a){var b="",d="";if(a=a||window.getSelection(),a.rangeCount){for(var e=document.createElement("div"),f=0,g=a.rangeCount;g>f;++f)e.appendChild(a.getRangeAt(f).cloneContents());d=e.textContent,b=e.innerHTML}return c.textSelection=d,c.htmlSelection=b||d,d},this.selectionDirection=function(a){var b=a||window.getSelection(),c=document.createRange();if(!b.anchorNode)return 0;c.setStart(b.anchorNode,b.anchorOffset),c.setEnd(b.focusNode,b.focusOffset);var d=c.collapsed?"backward":"forward";return c.detach(),d},this.showPopunder=function(){c.popunder=c.popunder||document.getElementById("selectionSharerPopunder");var a=window.getSelection(),b=c.getSelectionText(a);if(a.isCollapsed||b.length<10||!b.match(/ /))return c.hidePopunder();if(c.popunder.classList.contains("fixed"))return c.popunder.style.bottom=0,c.popunder.style.bottom;var d=a.getRangeAt(0),e=d.endContainer.parentNode;if(c.popunder.classList.contains("show")){if(Math.ceil(c.popunder.getBoundingClientRect().top)==Math.ceil(e.getBoundingClientRect().bottom))return;return c.hidePopunder(c.showPopunder)}if(e.nextElementSibling)c.pushSiblings(e);else{c.placeholder||(c.placeholder=document.createElement("div"),c.placeholder.className="selectionSharerPlaceholder");var f=window.getComputedStyle(e).marginBottom;c.placeholder.style.height=f,c.placeholder.style.marginBottom=-2*parseInt(f,10)+"px",e.parentNode.insertBefore(c.placeholder)}var g=window.pageYOffset+e.getBoundingClientRect().bottom;c.popunder.style.top=Math.ceil(g)+"px",setTimeout(function(){c.placeholder&&c.placeholder.classList.add("show"),c.popunder.classList.add("show")},0)},this.pushSiblings=function(a){for(;a=a.nextElementSibling;)a.classList.add("selectionSharer"),a.classList.add("moveDown")},this.hidePopunder=function(a){if(a=a||function(){},"fixed"==c.popunder)return c.popunder.style.bottom="-50px",a();c.popunder.classList.remove("show"),c.placeholder&&c.placeholder.classList.remove("show");for(var b=document.getElementsByClassName("moveDown");el=b[0];)el.classList.remove("moveDown");setTimeout(function(){c.placeholder&&document.body.insertBefore(c.placeholder),a()},600)},this.show=function(a){setTimeout(function(){var b=window.getSelection(),d=c.getSelectionText(b);if(!b.isCollapsed&&d&&d.length>10&&d.match(/ /)){var e=b.getRangeAt(0),f=e.getBoundingClientRect().top-5,g=f+c.getPosition().y-c.$popover.height(),h=0;if(a)h=a.pageX;else{var i=b.anchorNode.parentNode;h+=i.offsetWidth/2;do h+=i.offsetLeft;while(i=i.offsetParent)}switch(c.selectionDirection(b)){case"forward":h-=c.$popover.width();break;case"backward":h+=c.$popover.width();break;default:return}c.$popover.removeClass("anim").css("top",g-10).css("left",h).show(),setTimeout(function(){c.$popover.addClass("anim").css("top",g)},0)}},10)},this.hide=function(a){c.$popover.hide()},this.smart_truncate=function(a,b){if(!a||!a.length)return a;var c=a.length>b,d=c?a.substr(0,b-1):a;return d=c?d.substr(0,d.lastIndexOf(" ")):d,c?d+"...":d},this.getRelatedTwitterAccounts=function(){var b=[],c=a('meta[name="twitter:creator"]').attr("content")||a('meta[name="twitter:creator"]').attr("value");c&&b.push(c);for(var d=document.getElementsByTagName("a"),e=0,f=d.length;f>e;e++)if(d[e].attributes.href&&"string"==typeof d[e].attributes.href.value){var g=d[e].attributes.href.value.match(/^https?:\/\/twitter\.com\/([a-z0-9_]{1,20})/i);g&&g.length>1&&-1==["widgets","intent"].indexOf(g[1])&&b.push(g[1])}return b.length>0?b.join(","):""},this.shareTwitter=function(a){a.preventDefault();var b="“"+c.smart_truncate(c.textSelection.trim(),114)+"”",d="http://twitter.com/intent/tweet?text="+encodeURIComponent(b)+"@"+twitterUser+"&related="+c.getRelatedTwitterAccounts()+"&url="+encodeURIComponent(c.url2share);c.viaTwitterAccount&&b.length<114-c.viaTwitterAccount.length&&(d+="&via="+c.viaTwitterAccount);var e=640,f=440,g=screen.width/2-e/2,h=screen.height/2-f/2-100;return window.open(d,"share_twitter","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width="+e+", height="+f+", top="+h+", left="+g),c.hide(),!1},this.shareFacebook=function(a){a.preventDefault();var b=c.htmlSelection.replace(/<p[^>]*>/gi,"\n").replace(/<\/p>|  /gi,"").trim(),d="https://www.facebook.com/dialog/feed?app_id="+c.appId+"&display=popup&caption="+encodeURIComponent(b)+"&link="+encodeURIComponent(c.url2share)+"&href="+encodeURIComponent(c.url2share)+"&redirect_uri="+encodeURIComponent(c.url2share),e=640,f=440,g=screen.width/2-e/2,h=screen.height/2-f/2-100;window.open(d,"share_facebook","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width="+e+", height="+f+", top="+h+", left="+g)},this.shareEmail=function(b){var d=c.textSelection.replace(/<p[^>]*>/gi,"\n").replace(/<\/p>|  /gi,"").trim(),e={};return e.subject=encodeURIComponent("Quote from "+document.title),e.body=encodeURIComponent("“"+d+"”")+"%0D%0A%0D%0AFrom: "+document.title+"%0D%0A"+window.location.href,a(this).attr("href","mailto:?subject="+e.subject+"&body="+e.body),c.hide(),!0},this.render=function(){var b='<div class="selectionSharer" id="selectionSharerPopover" style="position:absolute;">  <div id="selectionSharerPopover-inner">    <ul>      <li><a class="action tweet" href="" title="Share this selection on Twitter" target="_blank">Tweet</a></li>      <li><a class="action facebook" href="" title="Share this selection on Facebook" target="_blank">Facebook</a></li>      <li><a class="action email" href="" title="Share this selection by email" target="_blank"><svg width="20" height="20"><path stroke="%23FFF" stroke-width="6" d="m16,25h82v60H16zl37,37q4,3 8,0l37-37M16,85l30-30m22,0 30,30"/></svg></a></li>    </ul>  </div>  <div class="selectionSharerPopover-clip"><span class="selectionSharerPopover-arrow"></span></div></div>',d='<div id="selectionSharerPopunder" class="selectionSharer">  <div id="selectionSharerPopunder-inner">    <label>Share this selection</label>    <ul>      <li><a class="action tweet" href="" title="Share this selection on Twitter" target="_blank">Tweet</a></li>      <li><a class="action facebook" href="" title="Share this selection on Facebook" target="_blank">Facebook</a></li>      <li><a class="action email" href="" title="Share this selection by email" target="_blank"><svg width="20" height="20"><path stroke="%23FFF" stroke-width="6" d="m16,25h82v60H16zl37,37q4,3 8,0l37-37M16,85l30-30m22,0 30,30"/></svg></a></li>    </ul>  </div></div>';c.$popover=a(b),c.$popover.find("a.tweet").click(c.shareTwitter),c.$popover.find("a.facebook").click(c.shareFacebook),c.$popover.find("a.email").click(c.shareEmail),a("body").append(c.$popover),c.$popunder=a(d),c.$popunder.find("a.tweet").click(c.shareTwitter),c.$popunder.find("a.facebook").click(c.shareFacebook),c.$popunder.find("a.email").click(c.shareEmail),a("body").append(c.$popunder),c.appId&&c.url2share&&a(".selectionSharer a.facebook").css("display","inline-block")},this.setElements=function(b){"string"==typeof b&&(b=a(b)),c.$elements=b instanceof a?b:a(b),c.$elements.mouseup(c.show).mousedown(c.hide).addClass("selectionShareable"),c.$elements.bind("touchstart",function(a){c.isMobile=!0}),document.onselectionchange=c.selectionChanged},this.selectionChanged=function(a){c.isMobile&&(c.lastSelectionChanged&&clearTimeout(c.lastSelectionChanged),c.lastSelectionChanged=setTimeout(function(){c.showPopunder(a)},300))},this.getPosition=function(){var a=void 0!==window.pageXOffset,b="CSS1Compat"===(document.compatMode||""),c=a?window.pageXOffset:b?document.documentElement.scrollLeft:document.body.scrollLeft,d=a?window.pageYOffset:b?document.documentElement.scrollTop:document.body.scrollTop;return{x:c,y:d}},this.render(),b.elements&&this.setElements(b.elements)};a.fn.selectionSharer=function(){var a=new b;return a.setElements(this),this},"function"==typeof define?define(function(){return b.load=function(a,c,d,e){var f=new b;f.setElements("p"),d()},b}):window.SelectionSharer=b}(jQuery);

    $('.news-content__body p').selectionSharer();

    /*
     * jQuery WidowFix Plugin
     * http://matthewlein.com/widowfix/
     * Copyright (c) 2010 Matthew Lein
     * Version: 1.3.2 (7/23/2011)
     * Dual licensed under the MIT and GPL licenses
     * Requires: jQuery v1.4 or later
     */

    (function(a){jQuery.fn.widowFix=function(d){var c={letterLimit:null,prevLimit:null,linkFix:false,dashes:false};var b=a.extend(c,d);if(this.length){return this.each(function(){var i=a(this);var n;if(b.linkFix){var h=i.find("a:last");h.wrap("<var>");var e=a("var").html();n=h.contents()[0];h.contents().unwrap()}var f=a(this).html().split(" "),m=f.pop();if(f.length<=1){return}function k(){if(m===""){m=f.pop();k()}}k();if(b.dashes){var j=["-","–","—"];a.each(j,function(o,p){if(m.indexOf(p)>0){m='<span style="white-space:nowrap;">'+m+"</span>";return false}})}var l=f[f.length-1];if(b.linkFix){if(b.letterLimit!==null&&n.length>=b.letterLimit){i.find("var").each(function(){a(this).contents().replaceWith(e);a(this).contents().unwrap()});return}else{if(b.prevLimit!==null&&l.length>=b.prevLimit){i.find("var").each(function(){a(this).contents().replaceWith(e);a(this).contents().unwrap()});return}}}else{if(b.letterLimit!==null&&m.length>=b.letterLimit){return}else{if(b.prevLimit!==null&&l.length>=b.prevLimit){return}}}var g=f.join(" ")+"&nbsp;"+m;i.html(g);if(b.linkFix){i.find("var").each(function(){a(this).contents().replaceWith(e);a(this).contents().unwrap()})}})}}})(jQuery);

    $('h1').widowFix();
    $('h2').widowFix();

});