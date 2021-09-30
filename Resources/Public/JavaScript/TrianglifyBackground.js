define(['jquery', 'trianglify'], function ($, trianglify) {
  var TrianglifyBackground = {
    cellSizeMin: 30,
    cellSizeMax: 70,
    delay: 500,
    resizeTimer: 0,
  };

  TrianglifyBackground.init = function () {
    TrianglifyBackground.draw();
    TrianglifyBackground.resizeHandler();
  };

  TrianglifyBackground.resizeHandler = function () {
    $(window).on('resize', function () {
      clearTimeout(TrianglifyBackground.resizeTimer);
      TrianglifyBackground.resizeTimer = setTimeout(function () {
        TrianglifyBackground.resizeEvent()
      }, TrianglifyBackground.delay);
    });
  };
  TrianglifyBackground.resizeEvent = function () {
    $('#trianglify-background').remove();
    $(TrianglifyBackground.draw);
  };

  TrianglifyBackground.draw = function () {
    const pattern = trianglify({
      width: window.innerWidth,
      height: window.innerHeight,
      cellSize: TrianglifyBackground.randomInteger(TrianglifyBackground.cellSizeMin, TrianglifyBackground.cellSizeMax),
      colorFunction: trianglify.colorFunctions.shadows()
    })

    var svg = pattern.toSVG()
    svg.id = 'trianglify-background'
    document.body.prepend(svg)
  };

  TrianglifyBackground.randomInteger = function (min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
  }

  if ($('.typo3-login').length > 0) {
    $(TrianglifyBackground.init);
  }
});
