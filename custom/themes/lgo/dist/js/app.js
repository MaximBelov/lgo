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
 * @version v2.3.0 
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
}(function($) {
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
        direction: 'ltr',
        accordionPrefixId: 'accordion'
    };

    var Accordion = function($el, options) {
        this.options = $.extend({}, defaultConfig, options);

        this.$wrapper = $el;
        this.$panels = $(this.options.panelsSelector, this.$wrapper);

        this.initAttributes();
        this.initEvents();
    };

    Accordion.prototype.initAttributes = function() {
        this.$wrapper.attr({
            'role': 'tablist',
            'aria-multiselectable': this.options.multiselectable.toString()
        }).addClass(this.options.prefixClass);

        // id generated if not present
        this.$wrapper.each($.proxy(function(index, el) {
            var $wrapper = $(el)

            // EDIT
            var randomNumber = Math.floor(Math.random() * 1000);

            if (!$wrapper.attr('id')) {
                $wrapper.attr('id', this.options.accordionPrefixId + '-' + randomNumber);
            }
        }, this));

        this.$panels.each($.proxy(function(index, el) {
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

    Accordion.prototype.initEvents = function() {
        this.$wrapper.on('focus', this.options.buttonsSelector, $.proxy(this.focusButtonEventHandler, this));

        this.$wrapper.on('click', this.options.buttonsSelector, $.proxy(this.clickButtonEventHandler, this));

        this.$wrapper.on('keydown', this.options.buttonsSelector, $.proxy(this.keydownButtonEventHandler, this));

        this.$wrapper.on('keydown', this.options.panelsSelector, $.proxy(this.keydownPanelEventHandler, this));
    };

    Accordion.prototype.focusButtonEventHandler = function(e) {
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

    Accordion.prototype.clickButtonEventHandler = function(e) {
        var $button = $(e.target);
        var $panel = $('#' + $button.attr('aria-controls'));

        this.$buttons.attr('aria-selected', 'false');
        $button.attr('aria-selected', 'true');

        // opened or closed?
        if ($button.attr('aria-expanded') === 'false') { // closed
            $button.attr('aria-expanded', 'true');
            $panel.attr('aria-hidden', 'false');
        } else { // opened
            $button.attr('aria-expanded', 'false');
            $panel.attr('aria-hidden', 'true');
        }

        if (this.options.multiselectable === false) {
            this.$panels.not($panel).attr('aria-hidden', 'true');
            this.$buttons.not($button).attr('aria-expanded', 'false');
        }

        setTimeout(function() {
            $button.focus();
        }, 0);

        e.stopPropagation();
        e.preventDefault();
    };

    Accordion.prototype.keydownButtonEventHandler = function(e) {
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

    Accordion.prototype.keydownPanelEventHandler = function(e) {
        var $panel = $(e.target).closest(this.options.panelsSelector);
        var $button = $('#' + $panel.attr('aria-labelledby'));
        var $firstButton = this.$wrapper.find(this.options.buttonsSelector).first();
        var $lastButton = this.$wrapper.find(this.options.buttonsSelector).last();
        var $prevButton = $button.prevAll(this.options.buttonsSelector).first();
        var $nextButton = $button.nextAll(this.options.buttonsSelector).first();
        var $target = null;

        // strike up + ctrl => go to header
        if (e.keyCode === 38 && e.ctrlKey) {
            $target = $button;
        }
        // strike pageup + ctrl => go to prev header
        else if (e.keyCode === 33 && e.ctrlKey) {
            $target = $button.is($firstButton) ? $lastButton : $prevButton;
        }
        // strike pagedown + ctrl => go to next header
        else if (e.keyCode === 34 && e.ctrlKey) {
            $target = $button.is($lastButton) ? $firstButton : $nextButton;
        }

        if ($target !== null) {
            this.goToHeader($target);
            e.preventDefault();
        }
    };

    Accordion.prototype.goToHeader = function($target) {
        if ($target.length !== 1) {
            return;
        }

        $target.attr({
            'aria-selected': 'true',
            'tabindex': null
        });

        setTimeout(function() {
            $target.focus();
        }, 0);
    };


    var PLUGIN = 'accordion';

    $.fn[PLUGIN] = function(params) {
        var options = $.extend({}, $.fn[PLUGIN].defaults, params);


        return this.each(function() {
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

/*!
 * Masonry PACKAGED v4.2.0
 * Cascading grid layout library
 * http://masonry.desandro.com
 * MIT License
 * by David DeSandro
 */

!function(t,e){"function"==typeof define&&define.amd?define("jquery-bridget/jquery-bridget",["jquery"],function(i){return e(t,i)}):"object"==typeof module&&module.exports?module.exports=e(t,require("jquery")):t.jQueryBridget=e(t,t.jQuery)}(window,function(t,e){"use strict";function i(i,r,a){function h(t,e,n){var o,r="$()."+i+'("'+e+'")';return t.each(function(t,h){var u=a.data(h,i);if(!u)return void s(i+" not initialized. Cannot call methods, i.e. "+r);var d=u[e];if(!d||"_"==e.charAt(0))return void s(r+" is not a valid method");var l=d.apply(u,n);o=void 0===o?l:o}),void 0!==o?o:t}function u(t,e){t.each(function(t,n){var o=a.data(n,i);o?(o.option(e),o._init()):(o=new r(n,e),a.data(n,i,o))})}a=a||e||t.jQuery,a&&(r.prototype.option||(r.prototype.option=function(t){a.isPlainObject(t)&&(this.options=a.extend(!0,this.options,t))}),a.fn[i]=function(t){if("string"==typeof t){var e=o.call(arguments,1);return h(this,t,e)}return u(this,t),this},n(a))}function n(t){!t||t&&t.bridget||(t.bridget=i)}var o=Array.prototype.slice,r=t.console,s="undefined"==typeof r?function(){}:function(t){r.error(t)};return n(e||t.jQuery),i}),function(t,e){"function"==typeof define&&define.amd?define("ev-emitter/ev-emitter",e):"object"==typeof module&&module.exports?module.exports=e():t.EvEmitter=e()}("undefined"!=typeof window?window:this,function(){function t(){}var e=t.prototype;return e.on=function(t,e){if(t&&e){var i=this._events=this._events||{},n=i[t]=i[t]||[];return-1==n.indexOf(e)&&n.push(e),this}},e.once=function(t,e){if(t&&e){this.on(t,e);var i=this._onceEvents=this._onceEvents||{},n=i[t]=i[t]||{};return n[e]=!0,this}},e.off=function(t,e){var i=this._events&&this._events[t];if(i&&i.length){var n=i.indexOf(e);return-1!=n&&i.splice(n,1),this}},e.emitEvent=function(t,e){var i=this._events&&this._events[t];if(i&&i.length){var n=0,o=i[n];e=e||[];for(var r=this._onceEvents&&this._onceEvents[t];o;){var s=r&&r[o];s&&(this.off(t,o),delete r[o]),o.apply(this,e),n+=s?0:1,o=i[n]}return this}},t}),function(t,e){"use strict";"function"==typeof define&&define.amd?define("get-size/get-size",[],function(){return e()}):"object"==typeof module&&module.exports?module.exports=e():t.getSize=e()}(window,function(){"use strict";function t(t){var e=parseFloat(t),i=-1==t.indexOf("%")&&!isNaN(e);return i&&e}function e(){}function i(){for(var t={width:0,height:0,innerWidth:0,innerHeight:0,outerWidth:0,outerHeight:0},e=0;u>e;e++){var i=h[e];t[i]=0}return t}function n(t){var e=getComputedStyle(t);return e||a("Style returned "+e+". Are you running this code in a hidden iframe on Firefox? See http://bit.ly/getsizebug1"),e}function o(){if(!d){d=!0;var e=document.createElement("div");e.style.width="200px",e.style.padding="1px 2px 3px 4px",e.style.borderStyle="solid",e.style.borderWidth="1px 2px 3px 4px",e.style.boxSizing="border-box";var i=document.body||document.documentElement;i.appendChild(e);var o=n(e);r.isBoxSizeOuter=s=200==t(o.width),i.removeChild(e)}}function r(e){if(o(),"string"==typeof e&&(e=document.querySelector(e)),e&&"object"==typeof e&&e.nodeType){var r=n(e);if("none"==r.display)return i();var a={};a.width=e.offsetWidth,a.height=e.offsetHeight;for(var d=a.isBorderBox="border-box"==r.boxSizing,l=0;u>l;l++){var c=h[l],f=r[c],m=parseFloat(f);a[c]=isNaN(m)?0:m}var p=a.paddingLeft+a.paddingRight,g=a.paddingTop+a.paddingBottom,y=a.marginLeft+a.marginRight,v=a.marginTop+a.marginBottom,_=a.borderLeftWidth+a.borderRightWidth,z=a.borderTopWidth+a.borderBottomWidth,E=d&&s,b=t(r.width);b!==!1&&(a.width=b+(E?0:p+_));var x=t(r.height);return x!==!1&&(a.height=x+(E?0:g+z)),a.innerWidth=a.width-(p+_),a.innerHeight=a.height-(g+z),a.outerWidth=a.width+y,a.outerHeight=a.height+v,a}}var s,a="undefined"==typeof console?e:function(t){console.error(t)},h=["paddingLeft","paddingRight","paddingTop","paddingBottom","marginLeft","marginRight","marginTop","marginBottom","borderLeftWidth","borderRightWidth","borderTopWidth","borderBottomWidth"],u=h.length,d=!1;return r}),function(t,e){"use strict";"function"==typeof define&&define.amd?define("desandro-matches-selector/matches-selector",e):"object"==typeof module&&module.exports?module.exports=e():t.matchesSelector=e()}(window,function(){"use strict";var t=function(){var t=window.Element.prototype;if(t.matches)return"matches";if(t.matchesSelector)return"matchesSelector";for(var e=["webkit","moz","ms","o"],i=0;i<e.length;i++){var n=e[i],o=n+"MatchesSelector";if(t[o])return o}}();return function(e,i){return e[t](i)}}),function(t,e){"function"==typeof define&&define.amd?define("fizzy-ui-utils/utils",["desandro-matches-selector/matches-selector"],function(i){return e(t,i)}):"object"==typeof module&&module.exports?module.exports=e(t,require("desandro-matches-selector")):t.fizzyUIUtils=e(t,t.matchesSelector)}(window,function(t,e){var i={};i.extend=function(t,e){for(var i in e)t[i]=e[i];return t},i.modulo=function(t,e){return(t%e+e)%e},i.makeArray=function(t){var e=[];if(Array.isArray(t))e=t;else if(t&&"object"==typeof t&&"number"==typeof t.length)for(var i=0;i<t.length;i++)e.push(t[i]);else e.push(t);return e},i.removeFrom=function(t,e){var i=t.indexOf(e);-1!=i&&t.splice(i,1)},i.getParent=function(t,i){for(;t!=document.body;)if(t=t.parentNode,e(t,i))return t},i.getQueryElement=function(t){return"string"==typeof t?document.querySelector(t):t},i.handleEvent=function(t){var e="on"+t.type;this[e]&&this[e](t)},i.filterFindElements=function(t,n){t=i.makeArray(t);var o=[];return t.forEach(function(t){if(t instanceof HTMLElement){if(!n)return void o.push(t);e(t,n)&&o.push(t);for(var i=t.querySelectorAll(n),r=0;r<i.length;r++)o.push(i[r])}}),o},i.debounceMethod=function(t,e,i){var n=t.prototype[e],o=e+"Timeout";t.prototype[e]=function(){var t=this[o];t&&clearTimeout(t);var e=arguments,r=this;this[o]=setTimeout(function(){n.apply(r,e),delete r[o]},i||100)}},i.docReady=function(t){var e=document.readyState;"complete"==e||"interactive"==e?setTimeout(t):document.addEventListener("DOMContentLoaded",t)},i.toDashed=function(t){return t.replace(/(.)([A-Z])/g,function(t,e,i){return e+"-"+i}).toLowerCase()};var n=t.console;return i.htmlInit=function(e,o){i.docReady(function(){var r=i.toDashed(o),s="data-"+r,a=document.querySelectorAll("["+s+"]"),h=document.querySelectorAll(".js-"+r),u=i.makeArray(a).concat(i.makeArray(h)),d=s+"-options",l=t.jQuery;u.forEach(function(t){var i,r=t.getAttribute(s)||t.getAttribute(d);try{i=r&&JSON.parse(r)}catch(a){return void(n&&n.error("Error parsing "+s+" on "+t.className+": "+a))}var h=new e(t,i);l&&l.data(t,o,h)})})},i}),function(t,e){"function"==typeof define&&define.amd?define("outlayer/item",["ev-emitter/ev-emitter","get-size/get-size"],e):"object"==typeof module&&module.exports?module.exports=e(require("ev-emitter"),require("get-size")):(t.Outlayer={},t.Outlayer.Item=e(t.EvEmitter,t.getSize))}(window,function(t,e){"use strict";function i(t){for(var e in t)return!1;return e=null,!0}function n(t,e){t&&(this.element=t,this.layout=e,this.position={x:0,y:0},this._create())}function o(t){return t.replace(/([A-Z])/g,function(t){return"-"+t.toLowerCase()})}var r=document.documentElement.style,s="string"==typeof r.transition?"transition":"WebkitTransition",a="string"==typeof r.transform?"transform":"WebkitTransform",h={WebkitTransition:"webkitTransitionEnd",transition:"transitionend"}[s],u={transform:a,transition:s,transitionDuration:s+"Duration",transitionProperty:s+"Property",transitionDelay:s+"Delay"},d=n.prototype=Object.create(t.prototype);d.constructor=n,d._create=function(){this._transn={ingProperties:{},clean:{},onEnd:{}},this.css({position:"absolute"})},d.handleEvent=function(t){var e="on"+t.type;this[e]&&this[e](t)},d.getSize=function(){this.size=e(this.element)},d.css=function(t){var e=this.element.style;for(var i in t){var n=u[i]||i;e[n]=t[i]}},d.getPosition=function(){var t=getComputedStyle(this.element),e=this.layout._getOption("originLeft"),i=this.layout._getOption("originTop"),n=t[e?"left":"right"],o=t[i?"top":"bottom"],r=this.layout.size,s=-1!=n.indexOf("%")?parseFloat(n)/100*r.width:parseInt(n,10),a=-1!=o.indexOf("%")?parseFloat(o)/100*r.height:parseInt(o,10);s=isNaN(s)?0:s,a=isNaN(a)?0:a,s-=e?r.paddingLeft:r.paddingRight,a-=i?r.paddingTop:r.paddingBottom,this.position.x=s,this.position.y=a},d.layoutPosition=function(){var t=this.layout.size,e={},i=this.layout._getOption("originLeft"),n=this.layout._getOption("originTop"),o=i?"paddingLeft":"paddingRight",r=i?"left":"right",s=i?"right":"left",a=this.position.x+t[o];e[r]=this.getXValue(a),e[s]="";var h=n?"paddingTop":"paddingBottom",u=n?"top":"bottom",d=n?"bottom":"top",l=this.position.y+t[h];e[u]=this.getYValue(l),e[d]="",this.css(e),this.emitEvent("layout",[this])},d.getXValue=function(t){var e=this.layout._getOption("horizontal");return this.layout.options.percentPosition&&!e?t/this.layout.size.width*100+"%":t+"px"},d.getYValue=function(t){var e=this.layout._getOption("horizontal");return this.layout.options.percentPosition&&e?t/this.layout.size.height*100+"%":t+"px"},d._transitionTo=function(t,e){this.getPosition();var i=this.position.x,n=this.position.y,o=parseInt(t,10),r=parseInt(e,10),s=o===this.position.x&&r===this.position.y;if(this.setPosition(t,e),s&&!this.isTransitioning)return void this.layoutPosition();var a=t-i,h=e-n,u={};u.transform=this.getTranslate(a,h),this.transition({to:u,onTransitionEnd:{transform:this.layoutPosition},isCleaning:!0})},d.getTranslate=function(t,e){var i=this.layout._getOption("originLeft"),n=this.layout._getOption("originTop");return t=i?t:-t,e=n?e:-e,"translate3d("+t+"px, "+e+"px, 0)"},d.goTo=function(t,e){this.setPosition(t,e),this.layoutPosition()},d.moveTo=d._transitionTo,d.setPosition=function(t,e){this.position.x=parseInt(t,10),this.position.y=parseInt(e,10)},d._nonTransition=function(t){this.css(t.to),t.isCleaning&&this._removeStyles(t.to);for(var e in t.onTransitionEnd)t.onTransitionEnd[e].call(this)},d.transition=function(t){if(!parseFloat(this.layout.options.transitionDuration))return void this._nonTransition(t);var e=this._transn;for(var i in t.onTransitionEnd)e.onEnd[i]=t.onTransitionEnd[i];for(i in t.to)e.ingProperties[i]=!0,t.isCleaning&&(e.clean[i]=!0);if(t.from){this.css(t.from);var n=this.element.offsetHeight;n=null}this.enableTransition(t.to),this.css(t.to),this.isTransitioning=!0};var l="opacity,"+o(a);d.enableTransition=function(){if(!this.isTransitioning){var t=this.layout.options.transitionDuration;t="number"==typeof t?t+"ms":t,this.css({transitionProperty:l,transitionDuration:t,transitionDelay:this.staggerDelay||0}),this.element.addEventListener(h,this,!1)}},d.onwebkitTransitionEnd=function(t){this.ontransitionend(t)},d.onotransitionend=function(t){this.ontransitionend(t)};var c={"-webkit-transform":"transform"};d.ontransitionend=function(t){if(t.target===this.element){var e=this._transn,n=c[t.propertyName]||t.propertyName;if(delete e.ingProperties[n],i(e.ingProperties)&&this.disableTransition(),n in e.clean&&(this.element.style[t.propertyName]="",delete e.clean[n]),n in e.onEnd){var o=e.onEnd[n];o.call(this),delete e.onEnd[n]}this.emitEvent("transitionEnd",[this])}},d.disableTransition=function(){this.removeTransitionStyles(),this.element.removeEventListener(h,this,!1),this.isTransitioning=!1},d._removeStyles=function(t){var e={};for(var i in t)e[i]="";this.css(e)};var f={transitionProperty:"",transitionDuration:"",transitionDelay:""};return d.removeTransitionStyles=function(){this.css(f)},d.stagger=function(t){t=isNaN(t)?0:t,this.staggerDelay=t+"ms"},d.removeElem=function(){this.element.parentNode.removeChild(this.element),this.css({display:""}),this.emitEvent("remove",[this])},d.remove=function(){return s&&parseFloat(this.layout.options.transitionDuration)?(this.once("transitionEnd",function(){this.removeElem()}),void this.hide()):void this.removeElem()},d.reveal=function(){delete this.isHidden,this.css({display:""});var t=this.layout.options,e={},i=this.getHideRevealTransitionEndProperty("visibleStyle");e[i]=this.onRevealTransitionEnd,this.transition({from:t.hiddenStyle,to:t.visibleStyle,isCleaning:!0,onTransitionEnd:e})},d.onRevealTransitionEnd=function(){this.isHidden||this.emitEvent("reveal")},d.getHideRevealTransitionEndProperty=function(t){var e=this.layout.options[t];if(e.opacity)return"opacity";for(var i in e)return i},d.hide=function(){this.isHidden=!0,this.css({display:""});var t=this.layout.options,e={},i=this.getHideRevealTransitionEndProperty("hiddenStyle");e[i]=this.onHideTransitionEnd,this.transition({from:t.visibleStyle,to:t.hiddenStyle,isCleaning:!0,onTransitionEnd:e})},d.onHideTransitionEnd=function(){this.isHidden&&(this.css({display:"none"}),this.emitEvent("hide"))},d.destroy=function(){this.css({position:"",left:"",right:"",top:"",bottom:"",transition:"",transform:""})},n}),function(t,e){"use strict";"function"==typeof define&&define.amd?define("outlayer/outlayer",["ev-emitter/ev-emitter","get-size/get-size","fizzy-ui-utils/utils","./item"],function(i,n,o,r){return e(t,i,n,o,r)}):"object"==typeof module&&module.exports?module.exports=e(t,require("ev-emitter"),require("get-size"),require("fizzy-ui-utils"),require("./item")):t.Outlayer=e(t,t.EvEmitter,t.getSize,t.fizzyUIUtils,t.Outlayer.Item)}(window,function(t,e,i,n,o){"use strict";function r(t,e){var i=n.getQueryElement(t);if(!i)return void(h&&h.error("Bad element for "+this.constructor.namespace+": "+(i||t)));this.element=i,u&&(this.$element=u(this.element)),this.options=n.extend({},this.constructor.defaults),this.option(e);var o=++l;this.element.outlayerGUID=o,c[o]=this,this._create();var r=this._getOption("initLayout");r&&this.layout()}function s(t){function e(){t.apply(this,arguments)}return e.prototype=Object.create(t.prototype),e.prototype.constructor=e,e}function a(t){if("number"==typeof t)return t;var e=t.match(/(^\d*\.?\d*)(\w*)/),i=e&&e[1],n=e&&e[2];if(!i.length)return 0;i=parseFloat(i);var o=m[n]||1;return i*o}var h=t.console,u=t.jQuery,d=function(){},l=0,c={};r.namespace="outlayer",r.Item=o,r.defaults={containerStyle:{position:"relative"},initLayout:!0,originLeft:!0,originTop:!0,resize:!0,resizeContainer:!0,transitionDuration:"0.4s",hiddenStyle:{opacity:0,transform:"scale(0.001)"},visibleStyle:{opacity:1,transform:"scale(1)"}};var f=r.prototype;n.extend(f,e.prototype),f.option=function(t){n.extend(this.options,t)},f._getOption=function(t){var e=this.constructor.compatOptions[t];return e&&void 0!==this.options[e]?this.options[e]:this.options[t]},r.compatOptions={initLayout:"isInitLayout",horizontal:"isHorizontal",layoutInstant:"isLayoutInstant",originLeft:"isOriginLeft",originTop:"isOriginTop",resize:"isResizeBound",resizeContainer:"isResizingContainer"},f._create=function(){this.reloadItems(),this.stamps=[],this.stamp(this.options.stamp),n.extend(this.element.style,this.options.containerStyle);var t=this._getOption("resize");t&&this.bindResize()},f.reloadItems=function(){this.items=this._itemize(this.element.children)},f._itemize=function(t){for(var e=this._filterFindItemElements(t),i=this.constructor.Item,n=[],o=0;o<e.length;o++){var r=e[o],s=new i(r,this);n.push(s)}return n},f._filterFindItemElements=function(t){return n.filterFindElements(t,this.options.itemSelector)},f.getItemElements=function(){return this.items.map(function(t){return t.element})},f.layout=function(){this._resetLayout(),this._manageStamps();var t=this._getOption("layoutInstant"),e=void 0!==t?t:!this._isLayoutInited;this.layoutItems(this.items,e),this._isLayoutInited=!0},f._init=f.layout,f._resetLayout=function(){this.getSize()},f.getSize=function(){this.size=i(this.element)},f._getMeasurement=function(t,e){var n,o=this.options[t];o?("string"==typeof o?n=this.element.querySelector(o):o instanceof HTMLElement&&(n=o),this[t]=n?i(n)[e]:o):this[t]=0},f.layoutItems=function(t,e){t=this._getItemsForLayout(t),this._layoutItems(t,e),this._postLayout()},f._getItemsForLayout=function(t){return t.filter(function(t){return!t.isIgnored})},f._layoutItems=function(t,e){if(this._emitCompleteOnItems("layout",t),t&&t.length){var i=[];t.forEach(function(t){var n=this._getItemLayoutPosition(t);n.item=t,n.isInstant=e||t.isLayoutInstant,i.push(n)},this),this._processLayoutQueue(i)}},f._getItemLayoutPosition=function(){return{x:0,y:0}},f._processLayoutQueue=function(t){this.updateStagger(),t.forEach(function(t,e){this._positionItem(t.item,t.x,t.y,t.isInstant,e)},this)},f.updateStagger=function(){var t=this.options.stagger;return null===t||void 0===t?void(this.stagger=0):(this.stagger=a(t),this.stagger)},f._positionItem=function(t,e,i,n,o){n?t.goTo(e,i):(t.stagger(o*this.stagger),t.moveTo(e,i))},f._postLayout=function(){this.resizeContainer()},f.resizeContainer=function(){var t=this._getOption("resizeContainer");if(t){var e=this._getContainerSize();e&&(this._setContainerMeasure(e.width,!0),this._setContainerMeasure(e.height,!1))}},f._getContainerSize=d,f._setContainerMeasure=function(t,e){if(void 0!==t){var i=this.size;i.isBorderBox&&(t+=e?i.paddingLeft+i.paddingRight+i.borderLeftWidth+i.borderRightWidth:i.paddingBottom+i.paddingTop+i.borderTopWidth+i.borderBottomWidth),t=Math.max(t,0),this.element.style[e?"width":"height"]=t+"px"}},f._emitCompleteOnItems=function(t,e){function i(){o.dispatchEvent(t+"Complete",null,[e])}function n(){s++,s==r&&i()}var o=this,r=e.length;if(!e||!r)return void i();var s=0;e.forEach(function(e){e.once(t,n)})},f.dispatchEvent=function(t,e,i){var n=e?[e].concat(i):i;if(this.emitEvent(t,n),u)if(this.$element=this.$element||u(this.element),e){var o=u.Event(e);o.type=t,this.$element.trigger(o,i)}else this.$element.trigger(t,i)},f.ignore=function(t){var e=this.getItem(t);e&&(e.isIgnored=!0)},f.unignore=function(t){var e=this.getItem(t);e&&delete e.isIgnored},f.stamp=function(t){t=this._find(t),t&&(this.stamps=this.stamps.concat(t),t.forEach(this.ignore,this))},f.unstamp=function(t){t=this._find(t),t&&t.forEach(function(t){n.removeFrom(this.stamps,t),this.unignore(t)},this)},f._find=function(t){return t?("string"==typeof t&&(t=this.element.querySelectorAll(t)),t=n.makeArray(t)):void 0},f._manageStamps=function(){this.stamps&&this.stamps.length&&(this._getBoundingRect(),this.stamps.forEach(this._manageStamp,this))},f._getBoundingRect=function(){var t=this.element.getBoundingClientRect(),e=this.size;this._boundingRect={left:t.left+e.paddingLeft+e.borderLeftWidth,top:t.top+e.paddingTop+e.borderTopWidth,right:t.right-(e.paddingRight+e.borderRightWidth),bottom:t.bottom-(e.paddingBottom+e.borderBottomWidth)}},f._manageStamp=d,f._getElementOffset=function(t){var e=t.getBoundingClientRect(),n=this._boundingRect,o=i(t),r={left:e.left-n.left-o.marginLeft,top:e.top-n.top-o.marginTop,right:n.right-e.right-o.marginRight,bottom:n.bottom-e.bottom-o.marginBottom};return r},f.handleEvent=n.handleEvent,f.bindResize=function(){t.addEventListener("resize",this),this.isResizeBound=!0},f.unbindResize=function(){t.removeEventListener("resize",this),this.isResizeBound=!1},f.onresize=function(){this.resize()},n.debounceMethod(r,"onresize",100),f.resize=function(){this.isResizeBound&&this.needsResizeLayout()&&this.layout()},f.needsResizeLayout=function(){var t=i(this.element),e=this.size&&t;return e&&t.innerWidth!==this.size.innerWidth},f.addItems=function(t){var e=this._itemize(t);return e.length&&(this.items=this.items.concat(e)),e},f.appended=function(t){var e=this.addItems(t);e.length&&(this.layoutItems(e,!0),this.reveal(e))},f.prepended=function(t){var e=this._itemize(t);if(e.length){var i=this.items.slice(0);this.items=e.concat(i),this._resetLayout(),this._manageStamps(),this.layoutItems(e,!0),this.reveal(e),this.layoutItems(i)}},f.reveal=function(t){if(this._emitCompleteOnItems("reveal",t),t&&t.length){var e=this.updateStagger();t.forEach(function(t,i){t.stagger(i*e),t.reveal()})}},f.hide=function(t){if(this._emitCompleteOnItems("hide",t),t&&t.length){var e=this.updateStagger();t.forEach(function(t,i){t.stagger(i*e),t.hide()})}},f.revealItemElements=function(t){var e=this.getItems(t);this.reveal(e)},f.hideItemElements=function(t){var e=this.getItems(t);this.hide(e)},f.getItem=function(t){for(var e=0;e<this.items.length;e++){var i=this.items[e];if(i.element==t)return i}},f.getItems=function(t){t=n.makeArray(t);var e=[];return t.forEach(function(t){var i=this.getItem(t);i&&e.push(i)},this),e},f.remove=function(t){var e=this.getItems(t);this._emitCompleteOnItems("remove",e),e&&e.length&&e.forEach(function(t){t.remove(),n.removeFrom(this.items,t)},this)},f.destroy=function(){var t=this.element.style;t.height="",t.position="",t.width="",this.items.forEach(function(t){t.destroy()}),this.unbindResize();var e=this.element.outlayerGUID;delete c[e],delete this.element.outlayerGUID,u&&u.removeData(this.element,this.constructor.namespace)},r.data=function(t){t=n.getQueryElement(t);var e=t&&t.outlayerGUID;return e&&c[e]},r.create=function(t,e){var i=s(r);return i.defaults=n.extend({},r.defaults),n.extend(i.defaults,e),i.compatOptions=n.extend({},r.compatOptions),i.namespace=t,i.data=r.data,i.Item=s(o),n.htmlInit(i,t),u&&u.bridget&&u.bridget(t,i),i};var m={ms:1,s:1e3};return r.Item=o,r}),function(t,e){"function"==typeof define&&define.amd?define(["outlayer/outlayer","get-size/get-size"],e):"object"==typeof module&&module.exports?module.exports=e(require("outlayer"),require("get-size")):t.Masonry=e(t.Outlayer,t.getSize)}(window,function(t,e){var i=t.create("masonry");i.compatOptions.fitWidth="isFitWidth";var n=i.prototype;return n._resetLayout=function(){this.getSize(),this._getMeasurement("columnWidth","outerWidth"),this._getMeasurement("gutter","outerWidth"),this.measureColumns(),this.colYs=[];for(var t=0;t<this.cols;t++)this.colYs.push(0);this.maxY=0,this.horizontalColIndex=0},n.measureColumns=function(){if(this.getContainerWidth(),!this.columnWidth){var t=this.items[0],i=t&&t.element;this.columnWidth=i&&e(i).outerWidth||this.containerWidth}var n=this.columnWidth+=this.gutter,o=this.containerWidth+this.gutter,r=o/n,s=n-o%n,a=s&&1>s?"round":"floor";r=Math[a](r),this.cols=Math.max(r,1)},n.getContainerWidth=function(){var t=this._getOption("fitWidth"),i=t?this.element.parentNode:this.element,n=e(i);this.containerWidth=n&&n.innerWidth},n._getItemLayoutPosition=function(t){t.getSize();var e=t.size.outerWidth%this.columnWidth,i=e&&1>e?"round":"ceil",n=Math[i](t.size.outerWidth/this.columnWidth);n=Math.min(n,this.cols);for(var o=this.options.horizontalOrder?"_getHorizontalColPosition":"_getTopColPosition",r=this[o](n,t),s={x:this.columnWidth*r.col,y:r.y},a=r.y+t.size.outerHeight,h=n+r.col,u=r.col;h>u;u++)this.colYs[u]=a;return s},n._getTopColPosition=function(t){var e=this._getTopColGroup(t),i=Math.min.apply(Math,e);return{col:e.indexOf(i),y:i}},n._getTopColGroup=function(t){if(2>t)return this.colYs;for(var e=[],i=this.cols+1-t,n=0;i>n;n++)e[n]=this._getColGroupY(n,t);return e},n._getColGroupY=function(t,e){if(2>e)return this.colYs[t];var i=this.colYs.slice(t,t+e);return Math.max.apply(Math,i)},n._getHorizontalColPosition=function(t,e){var i=this.horizontalColIndex%this.cols,n=t>1&&i+t>this.cols;i=n?0:i;var o=e.size.outerWidth&&e.size.outerHeight;return this.horizontalColIndex=o?i+t:this.horizontalColIndex,{col:i,y:this._getColGroupY(i,t)}},n._manageStamp=function(t){var i=e(t),n=this._getElementOffset(t),o=this._getOption("originLeft"),r=o?n.left:n.right,s=r+i.outerWidth,a=Math.floor(r/this.columnWidth);a=Math.max(0,a);var h=Math.floor(s/this.columnWidth);h-=s%this.columnWidth?0:1,h=Math.min(this.cols-1,h);for(var u=this._getOption("originTop"),d=(u?n.top:n.bottom)+i.outerHeight,l=a;h>=l;l++)this.colYs[l]=Math.max(d,this.colYs[l])},n._getContainerSize=function(){this.maxY=Math.max.apply(Math,this.colYs);var t={height:this.maxY};return this._getOption("fitWidth")&&(t.width=this._getContainerFitWidth()),t},n._getContainerFitWidth=function(){for(var t=0,e=this.cols;--e&&0===this.colYs[e];)t++;return(this.cols-t)*this.columnWidth-this.gutter},n.needsResizeLayout=function(){var t=this.containerWidth;return this.getContainerWidth(),t!=this.containerWidth},i});
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

    // $('.menu-after-dots').click(function(event){
    //   event.preventDefault();
    //   $(this).next('ul').toggleClass( "open-dropdown" );
    // });

    // $('.menu-after-dots').keypress(function(e){
    //   if(e.which == 13){//Enter key pressed
    //     $(this).next('ul').toggleClass( "open-dropdown" );
    //   }
    // });

    // $('.menu-item-has-children').hover(function(){
    //   $(this).children('ul').toggleClass( "open-dropdown" );
    // });

    $('.menu-item-has-children >a').focus(function(){
      $(this).next('ul').toggleClass( "open-dropdown" );
    });

    $('.menu-item-has-children >ul >li:last-child a').focusout(function(){
      $('.menu-item-has-children ul').removeClass( "open-dropdown" );
      console.log('heyyy');
    });

    $('#menu-item-790 >ul >li:nth-last-child(2) a').focusout(function(){
      $('.menu-item-has-children ul').removeClass( "open-dropdown" );
      // console.log('heyyy');
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
            // var theBG = $(this).attr('data-child-bg');
            // // console.log(theBG);
            // $('.left-compartment__bg').css({'backgroundImage': 'url('+theBG+')'});
          }
        });
      }

      //Nav logo change color on scroll
      var scrollPos = $(window).scrollTop(),
          navbar = $('#nav-logo');
          topPanel = $('.top-page-panel');
          slimNav = $('.slim-nav-transition');
          sharePanel = $('.social-share');

      var banner = document.getElementById("scroll-header");
      var panel = document.getElementById("scroll-panel");

      // SHRINK LOGO + NAV COMPRESS 
      if (scrollPos > (100)) {
          // navbar.addClass('change-logo-size');
          slimNav.addClass('compress-slim-nav');
      } else {
          // navbar.removeClass('change-logo-size');
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