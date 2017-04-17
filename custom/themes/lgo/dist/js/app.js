(function() {
  var MutationObserver, Util, WeakMap, getComputedStyle, getComputedStyleRX,
    bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; },
    indexOf = [].indexOf || function(item) { for (var i = 0, l = this.length; i < l; i++) { if (i in this && this[i] === item) return i; } return -1; };

  Util = (function() {
    function Util() {}

    Util.prototype.extend = function(custom, defaults) {
      var key, value;
      for (key in defaults) {
        value = defaults[key];
        if (custom[key] == null) {
          custom[key] = value;
        }
      }
      return custom;
    };

    Util.prototype.isMobile = function(agent) {
      return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(agent);
    };

    Util.prototype.createEvent = function(event, bubble, cancel, detail) {
      var customEvent;
      if (bubble == null) {
        bubble = false;
      }
      if (cancel == null) {
        cancel = false;
      }
      if (detail == null) {
        detail = null;
      }
      if (document.createEvent != null) {
        customEvent = document.createEvent('CustomEvent');
        customEvent.initCustomEvent(event, bubble, cancel, detail);
      } else if (document.createEventObject != null) {
        customEvent = document.createEventObject();
        customEvent.eventType = event;
      } else {
        customEvent.eventName = event;
      }
      return customEvent;
    };

    Util.prototype.emitEvent = function(elem, event) {
      if (elem.dispatchEvent != null) {
        return elem.dispatchEvent(event);
      } else if (event in (elem != null)) {
        return elem[event]();
      } else if (("on" + event) in (elem != null)) {
        return elem["on" + event]();
      }
    };

    Util.prototype.addEvent = function(elem, event, fn) {
      if (elem.addEventListener != null) {
        return elem.addEventListener(event, fn, false);
      } else if (elem.attachEvent != null) {
        return elem.attachEvent("on" + event, fn);
      } else {
        return elem[event] = fn;
      }
    };

    Util.prototype.removeEvent = function(elem, event, fn) {
      if (elem.removeEventListener != null) {
        return elem.removeEventListener(event, fn, false);
      } else if (elem.detachEvent != null) {
        return elem.detachEvent("on" + event, fn);
      } else {
        return delete elem[event];
      }
    };

    Util.prototype.innerHeight = function() {
      if ('innerHeight' in window) {
        return window.innerHeight;
      } else {
        return document.documentElement.clientHeight;
      }
    };

    return Util;

  })();

  WeakMap = this.WeakMap || this.MozWeakMap || (WeakMap = (function() {
    function WeakMap() {
      this.keys = [];
      this.values = [];
    }

    WeakMap.prototype.get = function(key) {
      var i, item, j, len, ref;
      ref = this.keys;
      for (i = j = 0, len = ref.length; j < len; i = ++j) {
        item = ref[i];
        if (item === key) {
          return this.values[i];
        }
      }
    };

    WeakMap.prototype.set = function(key, value) {
      var i, item, j, len, ref;
      ref = this.keys;
      for (i = j = 0, len = ref.length; j < len; i = ++j) {
        item = ref[i];
        if (item === key) {
          this.values[i] = value;
          return;
        }
      }
      this.keys.push(key);
      return this.values.push(value);
    };

    return WeakMap;

  })());

  MutationObserver = this.MutationObserver || this.WebkitMutationObserver || this.MozMutationObserver || (MutationObserver = (function() {
    function MutationObserver() {
      if (typeof console !== "undefined" && console !== null) {
        console.warn('MutationObserver is not supported by your browser.');
      }
      if (typeof console !== "undefined" && console !== null) {
        console.warn('WOW.js cannot detect dom mutations, please call .sync() after loading new content.');
      }
    }

    MutationObserver.notSupported = true;

    MutationObserver.prototype.observe = function() {};

    return MutationObserver;

  })());

  getComputedStyle = this.getComputedStyle || function(el, pseudo) {
    this.getPropertyValue = function(prop) {
      var ref;
      if (prop === 'float') {
        prop = 'styleFloat';
      }
      if (getComputedStyleRX.test(prop)) {
        prop.replace(getComputedStyleRX, function(_, _char) {
          return _char.toUpperCase();
        });
      }
      return ((ref = el.currentStyle) != null ? ref[prop] : void 0) || null;
    };
    return this;
  };

  getComputedStyleRX = /(\-([a-z]){1})/g;

  this.WOW = (function() {
    WOW.prototype.defaults = {
      boxClass: 'wow',
      animateClass: 'animated',
      offset: 0,
      mobile: true,
      live: true,
      callback: null,
      scrollContainer: null
    };

    function WOW(options) {
      if (options == null) {
        options = {};
      }
      this.scrollCallback = bind(this.scrollCallback, this);
      this.scrollHandler = bind(this.scrollHandler, this);
      this.resetAnimation = bind(this.resetAnimation, this);
      this.start = bind(this.start, this);
      this.scrolled = true;
      this.config = this.util().extend(options, this.defaults);
      if (options.scrollContainer != null) {
        this.config.scrollContainer = document.querySelector(options.scrollContainer);
      }
      this.animationNameCache = new WeakMap();
      this.wowEvent = this.util().createEvent(this.config.boxClass);
    }

    WOW.prototype.init = function() {
      var ref;
      this.element = window.document.documentElement;
      if ((ref = document.readyState) === "interactive" || ref === "complete") {
        this.start();
      } else {
        this.util().addEvent(document, 'DOMContentLoaded', this.start);
      }
      return this.finished = [];
    };

    WOW.prototype.start = function() {
      var box, j, len, ref;
      this.stopped = false;
      this.boxes = (function() {
        var j, len, ref, results;
        ref = this.element.querySelectorAll("." + this.config.boxClass);
        results = [];
        for (j = 0, len = ref.length; j < len; j++) {
          box = ref[j];
          results.push(box);
        }
        return results;
      }).call(this);
      this.all = (function() {
        var j, len, ref, results;
        ref = this.boxes;
        results = [];
        for (j = 0, len = ref.length; j < len; j++) {
          box = ref[j];
          results.push(box);
        }
        return results;
      }).call(this);
      if (this.boxes.length) {
        if (this.disabled()) {
          this.resetStyle();
        } else {
          ref = this.boxes;
          for (j = 0, len = ref.length; j < len; j++) {
            box = ref[j];
            this.applyStyle(box, true);
          }
        }
      }
      if (!this.disabled()) {
        this.util().addEvent(this.config.scrollContainer || window, 'scroll', this.scrollHandler);
        this.util().addEvent(window, 'resize', this.scrollHandler);
        this.interval = setInterval(this.scrollCallback, 50);
      }
      if (this.config.live) {
        return new MutationObserver((function(_this) {
          return function(records) {
            var k, len1, node, record, results;
            results = [];
            for (k = 0, len1 = records.length; k < len1; k++) {
              record = records[k];
              results.push((function() {
                var l, len2, ref1, results1;
                ref1 = record.addedNodes || [];
                results1 = [];
                for (l = 0, len2 = ref1.length; l < len2; l++) {
                  node = ref1[l];
                  results1.push(this.doSync(node));
                }
                return results1;
              }).call(_this));
            }
            return results;
          };
        })(this)).observe(document.body, {
          childList: true,
          subtree: true
        });
      }
    };

    WOW.prototype.stop = function() {
      this.stopped = true;
      this.util().removeEvent(this.config.scrollContainer || window, 'scroll', this.scrollHandler);
      this.util().removeEvent(window, 'resize', this.scrollHandler);
      if (this.interval != null) {
        return clearInterval(this.interval);
      }
    };

    WOW.prototype.sync = function(element) {
      if (MutationObserver.notSupported) {
        return this.doSync(this.element);
      }
    };

    WOW.prototype.doSync = function(element) {
      var box, j, len, ref, results;
      if (element == null) {
        element = this.element;
      }
      if (element.nodeType !== 1) {
        return;
      }
      element = element.parentNode || element;
      ref = element.querySelectorAll("." + this.config.boxClass);
      results = [];
      for (j = 0, len = ref.length; j < len; j++) {
        box = ref[j];
        if (indexOf.call(this.all, box) < 0) {
          this.boxes.push(box);
          this.all.push(box);
          if (this.stopped || this.disabled()) {
            this.resetStyle();
          } else {
            this.applyStyle(box, true);
          }
          results.push(this.scrolled = true);
        } else {
          results.push(void 0);
        }
      }
      return results;
    };

    WOW.prototype.show = function(box) {
      this.applyStyle(box);
      box.className = box.className + " " + this.config.animateClass;
      if (this.config.callback != null) {
        this.config.callback(box);
      }
      this.util().emitEvent(box, this.wowEvent);
      this.util().addEvent(box, 'animationend', this.resetAnimation);
      this.util().addEvent(box, 'oanimationend', this.resetAnimation);
      this.util().addEvent(box, 'webkitAnimationEnd', this.resetAnimation);
      this.util().addEvent(box, 'MSAnimationEnd', this.resetAnimation);
      return box;
    };

    WOW.prototype.applyStyle = function(box, hidden) {
      var delay, duration, iteration;
      duration = box.getAttribute('data-wow-duration');
      delay = box.getAttribute('data-wow-delay');
      iteration = box.getAttribute('data-wow-iteration');
      return this.animate((function(_this) {
        return function() {
          return _this.customStyle(box, hidden, duration, delay, iteration);
        };
      })(this));
    };

    WOW.prototype.animate = (function() {
      if ('requestAnimationFrame' in window) {
        return function(callback) {
          return window.requestAnimationFrame(callback);
        };
      } else {
        return function(callback) {
          return callback();
        };
      }
    })();

    WOW.prototype.resetStyle = function() {
      var box, j, len, ref, results;
      ref = this.boxes;
      results = [];
      for (j = 0, len = ref.length; j < len; j++) {
        box = ref[j];
        results.push(box.style.visibility = 'visible');
      }
      return results;
    };

    WOW.prototype.resetAnimation = function(event) {
      var target;
      if (event.type.toLowerCase().indexOf('animationend') >= 0) {
        target = event.target || event.srcElement;
        return target.className = target.className.replace(this.config.animateClass, '').trim();
      }
    };

    WOW.prototype.customStyle = function(box, hidden, duration, delay, iteration) {
      if (hidden) {
        this.cacheAnimationName(box);
      }
      box.style.visibility = hidden ? 'hidden' : 'visible';
      if (duration) {
        this.vendorSet(box.style, {
          animationDuration: duration
        });
      }
      if (delay) {
        this.vendorSet(box.style, {
          animationDelay: delay
        });
      }
      if (iteration) {
        this.vendorSet(box.style, {
          animationIterationCount: iteration
        });
      }
      this.vendorSet(box.style, {
        animationName: hidden ? 'none' : this.cachedAnimationName(box)
      });
      return box;
    };

    WOW.prototype.vendors = ["moz", "webkit"];

    WOW.prototype.vendorSet = function(elem, properties) {
      var name, results, value, vendor;
      results = [];
      for (name in properties) {
        value = properties[name];
        elem["" + name] = value;
        results.push((function() {
          var j, len, ref, results1;
          ref = this.vendors;
          results1 = [];
          for (j = 0, len = ref.length; j < len; j++) {
            vendor = ref[j];
            results1.push(elem["" + vendor + (name.charAt(0).toUpperCase()) + (name.substr(1))] = value);
          }
          return results1;
        }).call(this));
      }
      return results;
    };

    WOW.prototype.vendorCSS = function(elem, property) {
      var j, len, ref, result, style, vendor;
      style = getComputedStyle(elem);
      result = style.getPropertyCSSValue(property);
      ref = this.vendors;
      for (j = 0, len = ref.length; j < len; j++) {
        vendor = ref[j];
        result = result || style.getPropertyCSSValue("-" + vendor + "-" + property);
      }
      return result;
    };

    WOW.prototype.animationName = function(box) {
      var animationName, error;
      try {
        animationName = this.vendorCSS(box, 'animation-name').cssText;
      } catch (error) {
        animationName = getComputedStyle(box).getPropertyValue('animation-name');
      }
      if (animationName === 'none') {
        return '';
      } else {
        return animationName;
      }
    };

    WOW.prototype.cacheAnimationName = function(box) {
      return this.animationNameCache.set(box, this.animationName(box));
    };

    WOW.prototype.cachedAnimationName = function(box) {
      return this.animationNameCache.get(box);
    };

    WOW.prototype.scrollHandler = function() {
      return this.scrolled = true;
    };

    WOW.prototype.scrollCallback = function() {
      var box;
      if (this.scrolled) {
        this.scrolled = false;
        this.boxes = (function() {
          var j, len, ref, results;
          ref = this.boxes;
          results = [];
          for (j = 0, len = ref.length; j < len; j++) {
            box = ref[j];
            if (!(box)) {
              continue;
            }
            if (this.isVisible(box)) {
              this.show(box);
              continue;
            }
            results.push(box);
          }
          return results;
        }).call(this);
        if (!(this.boxes.length || this.config.live)) {
          return this.stop();
        }
      }
    };

    WOW.prototype.offsetTop = function(element) {
      var top;
      while (element.offsetTop === void 0) {
        element = element.parentNode;
      }
      top = element.offsetTop;
      while (element = element.offsetParent) {
        top += element.offsetTop;
      }
      return top;
    };

    WOW.prototype.isVisible = function(box) {
      var bottom, offset, top, viewBottom, viewTop;
      offset = box.getAttribute('data-wow-offset') || this.config.offset;
      viewTop = (this.config.scrollContainer && this.config.scrollContainer.scrollTop) || window.pageYOffset;
      viewBottom = viewTop + Math.min(this.element.clientHeight, this.util().innerHeight()) - offset;
      top = this.offsetTop(box);
      bottom = top + box.clientHeight;
      return top <= viewBottom && bottom >= viewTop;
    };

    WOW.prototype.util = function() {
      return this._util != null ? this._util : this._util = new Util();
    };

    WOW.prototype.disabled = function() {
      return !this.config.mobile && this.util().isMobile(navigator.userAgent);
    };

    return WOW;

  })();

}).call(this);

/*
 * jQuery Accessible Accordion system, using ARIA
 * @version v2.2.  
 * Website: https://a11y.nicolas-hoffmann.net/accordion/
 * License MIT: https://github.com/nico3333fr/jquery-accessible-accordion-aria/blob/master/LICENSE
 */
(function(factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports !== 'undefined') {
        module.exports = factory(require('jquery'));
    } else {
        factory(jQuery);
    }
}(function ($) {
  'use strict';

  var defaultConfig = {
    headersSelector: '.js-accordion__header',
    panelsSelector: '.js-accordion__panel',
    buttonsSelector: 'button.js-accordion__header',
    button: $('<button></button>', {
      class: 'js-accordion__header',
      type: 'button'
    }),
    buttonSuffixId: '_tab',
    multiselectable: true,
    prefixClass: 'accordion',
    headerSuffixClass: '__title',
    buttonSuffixClass: '__header',
    panelSuffixClass: '__panel',
    direction: 'ltr'
  };

  var Accordion = function ($el, options) {
    this.options = $.extend({}, defaultConfig, options);

    this.$wrapper = $el;
    this.$panels = $(this.options.panelsSelector, this.$wrapper);

    this.initAttributes();
    this.initEvents();
  };

  Accordion.prototype.initAttributes = function () {
    this.$wrapper.attr({
      'role': 'tablist',
      'aria-multiselectable': this.options.multiselectable.toString()
    }).addClass(this.options.prefixClass);

    this.$panels.each($.proxy(function (index, el) {
      var $panel = $(el);
      var $header = $(this.options.headersSelector, $panel);
      var $button = this.options.button.clone().text($header.text());

      $header.attr('tabindex', '0').addClass(this.options.prefixClass + this.options.headerSuffixClass);
      $panel.before($button);

      var panelId = $panel.attr('id') || this.$wrapper.attr('id') + '-' + index;
      var buttonId = panelId + this.options.buttonSuffixId;

      $button.attr({
        'aria-controls': panelId,
        'aria-expanded': 'false',
        'role': 'tab',
        'id': buttonId,
        'tabindex': '-1',
        'aria-selected': 'false'
      }).addClass(this.options.prefixClass + this.options.buttonSuffixClass);

      $panel.attr({
        'aria-labelledby': buttonId,
        'role': 'tabpanel',
        'id': panelId,
        'aria-hidden': 'true'
      }).addClass(this.options.prefixClass + this.options.panelSuffixClass);

      // if opened by default
      if ($panel.attr('data-accordion-opened') === 'true') {
        $button.attr({
          'aria-expanded': 'true',
          'data-accordion-opened': null
        });

        $panel.attr({
          'aria-hidden': 'false'
        });
      }

      // init first one focusable
      if (index === 0) {
        $button.removeAttr('tabindex');
      }
    }, this));

    this.$buttons = $(this.options.buttonsSelector, this.$wrapper);
  };

  Accordion.prototype.initEvents = function () {
    this.$wrapper.on('focus', this.options.buttonsSelector, $.proxy(this.focusButtonEventHandler, this));

    this.$wrapper.on('click', this.options.buttonsSelector, $.proxy(this.clickButtonEventHandler, this));

    this.$wrapper.on('keydown', this.options.buttonsSelector, $.proxy(this.keydownButtonEventHandler, this));

    this.$wrapper.on('keydown', this.options.panelsSelector, $.proxy(this.keydownPanelEventHandler, this));
  };

  Accordion.prototype.focusButtonEventHandler = function (e) {
    var $button = $(e.target);

    $(this.options.buttonsSelector, this.$wrapper).attr({
      'tabindex': '-1',
      'aria-selected': 'false'
    });

    $button.attr({
      'aria-selected': 'true',
      'tabindex': null
    });
  };

  Accordion.prototype.clickButtonEventHandler = function (e) {
    var $button = $(e.target);
    var $panel = $('#' + $button.attr('aria-controls'));

    this.$buttons.attr('aria-selected', 'false');
    $button.attr('aria-selected', 'true');

    // opened or closed?
    if ($button.attr('aria-expanded') === 'false') { // closed
      $button.attr('aria-expanded', 'true');
      $panel.attr('aria-hidden', 'false');
    }
    else { // opened
      $button.attr('aria-expanded', 'false');
      $panel.attr('aria-hidden', 'true');
    }

    if (this.options.multiselectable === false) {
      this.$panels.not($panel).attr( 'aria-hidden', 'true');
      this.$buttons.not($button).attr('aria-expanded', 'false');
    }

    setTimeout(function () {
      $button.focus();
    }, 0);

    e.stopPropagation();
    e.preventDefault();
  };

  Accordion.prototype.keydownButtonEventHandler = function (e) {
    var $button = $(e.target);
    var $firstButton = this.$buttons.first();
    var $lastButton = this.$buttons.last();
    var $prevButton = $button.prevAll(this.options.buttonsSelector).first();
    var $nextButton = $button.nextAll(this.options.buttonsSelector).first();
    var $target = null;

    var k = this.options.direction === 'ltr' ? {
      prev: [38, 37], // up & left
      next: [40, 39], // down & right
      first: 36, // home
      last: 35 // end
    } : {
      prev: [38, 39], // up & left
      next: [40, 37], // down & right
      first: 36, // home
      last: 35 // end
    };

    var allKeyCode = [].concat(k.prev, k.next, k.first, k.last);

    if ($.inArray(e.keyCode, allKeyCode) >= 0 && !e.ctrlKey) {
      this.$buttons.attr({
        'tabindex': '-1',
        'aria-selected': 'false'
      });


      if (e.keyCode === 36) {
        $target = $firstButton;
      }
      // strike end in the tab => last tab
      else if (e.keyCode === 35) {
        $target = $lastButton;
      }
      // strike up or left in the tab => previous tab
      else if ($.inArray(e.keyCode, k.prev) >= 0) {
        // if we are on first one, activate last
        $target = $button.is($firstButton) ? $lastButton : $prevButton;
      }
      // strike down or right in the tab => next tab
      else if ($.inArray(e.keyCode, k.next) >= 0) {
        // if we are on last one, activate first
        $target = $button.is($lastButton) ? $firstButton : $nextButton;
      }

      if ($target !== null) {
        this.goToHeader($target);
      }

      e.preventDefault();
    }
  };

  Accordion.prototype.keydownPanelEventHandler = function (e) {
    var $panel = $(e.target).closest(this.options.panelsSelector);
    var $button = $('#' + $panel.attr('aria-labelledby'));
    var $firstButton = this.$wrapper.find(this.options.buttonsSelector).first();
    var $lastButton = this.$wrapper.find(this.options.buttonsSelector).last();
    var $prevButton = $button.prevAll(this.options.buttonsSelector).first();
    var $nextButton = $button.nextAll(this.options.buttonsSelector).first();
    var $target = null;

    // strike up + ctrl => go to header
    if ( e.keyCode === 38 && e.ctrlKey ) {
      $target = $button;
    }
    // strike pageup + ctrl => go to prev header
    else if ( e.keyCode === 33 && e.ctrlKey ) {
      $target = $button.is($firstButton) ? $lastButton : $prevButton;
    }
    // strike pagedown + ctrl => go to next header
    else if ( e.keyCode === 34 && e.ctrlKey ) {
      $target = $button.is($lastButton) ? $firstButton : $nextButton;
    }

    if ($target !== null) {
      this.goToHeader($target);
      e.preventDefault();
    }
  };

  Accordion.prototype.goToHeader = function ($target) {
    if ($target.length !== 1) {
      return;
    }

    $target.attr({
      'aria-selected': 'true',
      'tabindex': null
    });

    setTimeout(function () {
      $target.focus();
    }, 0);
  };


  var PLUGIN = 'accordion';

  $.fn[PLUGIN] = function (params) {
    var options = $.extend({}, $.fn[PLUGIN].defaults, params);


    return this.each(function () {
      var $el = $(this);

      var specificOptions = {
        multiselectable: $el.attr('data-accordion-multiselectable') === 'none' ? false : options.multiselectable,
        prefixClass: typeof($el.attr('data-accordion-prefix-classes')) !== 'undefined' ? $el.attr('data-accordion-prefix-classes') : options.prefixClass,
        direction: $el.closest('[dir="rtl"]').length > 0 ? 'rtl' : options.direction
      };
      specificOptions = $.extend({}, options, specificOptions);

      $el.data[PLUGIN] = new Accordion($el, specificOptions);
    });
  };

  $.fn[PLUGIN].defaults = defaultConfig;

}));

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
    // $('.scrollspy').scrollSpy({
    //     scrollOffset: 80
    // });
});

//Menu Highlight
jQuery(document).ready(function($){
    var sections = $('.child-page-content')
  , nav = $('#menu-item-66')
  , nav_height = nav.outerHeight();

$(window).on('scroll', function () {
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