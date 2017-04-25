$(window).on('mousewheel.initMouseScroll DOMMouseScroll.initMouseScroll', function (e) {

    var direction = 'down';
    if (e.originalEvent.wheelDelta > 0 || e.originalEvent.detail < 0) {
        direction = 'up';
    }
    next(direction);

    if (!enableAuto) {
        return false;
    }


});

//auto scroll to next scene when at edge
this.initMouseScroll = function () {
  var enableAuto = true;
  
  var next = function (direction) {
    var scrollbar = parseInt($(window).scrollTop(), 10);
    var windowHeight = parseInt($(window).height(), 10);
    //get the current active page

    if (direction === 'down' && enableAuto) {
      var pageInfo = app.core.calculateCurrentAnchorPosition({sceneClass: 'js-scroll-edge-next'});

      if (pageInfo.scene !== false) {

        var $page = $('.js-scroll-edge-next:eq(' + pageInfo.scene + ')');

        if ($page.length) {
          //check if we are at the bottom of the scenee
          var windowHeight = parseInt($(window).height());
          var eleTop = parseInt($page.offset().top, 10);

          if (scrollbar >= (eleTop - windowHeight - 160)) {
            enableAuto = false;
            app.main.triggerSmartScroll({direction: 'down', sceneClass: 'js-scroll-edge-next--anchor'});
            setTimeout(function () {
                enableAuto = true;
            }, 1000);
          }
        }

      }
    }

    if (direction === 'up' && enableAuto) {
      var pageInfo = app.core.calculateCurrentAnchorPosition({sceneClass: 'js-scroll-edge-next'});

      if (pageInfo.scene !== false) {
        var $page = $('.js-scroll-edge-next:eq(' + (pageInfo.scene - 1) + ')');
        if ($page.length) {
          //check if we are at the top of the scene;
          var eleTop = parseInt($page.offset().top, 10);

          if (scrollbar <= (eleTop + windowHeight)) {
            enableAuto = false;
            app.core.smoothScroll({
                direction: 'up',
                position: eleTop - windowHeight,
                time: 1000
            });
            setTimeout(function () {
                enableAuto = true;
            }, 500);
          }
        }

      }
    }
  };