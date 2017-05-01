!function() {


  // match height plugin
  $('.box__header--quote').matchHeight();
  $('.box__body').matchHeight();
  $('.card__body').matchHeight();

  // Twentytwenty plugin
  $('.compare').twentytwenty();

  // mobile menu
  // custom mobile accordion - open
  $('.has-dropdown > .site-nav__link').on('click touch', function(e) {
    e.preventDefault();

    $('.site-nav__sub-menu--open').removeClass('site-nav__sub-menu--open'); // close open submenus
    $(this).parent().find('.site-nav__sub-menu').toggleClass('site-nav__sub-menu--open'); // open new submenu
  });

  // close mobile menu
  $('.site-nav__open, .site-nav__link--close').on('click touch', function(e) {
    e.preventDefault();

    $('.site-nav__sub-menu--open').removeClass('site-nav__sub-menu--open'); // close submenu on close
    $('.site-nav').toggleClass('site-nav--open'); // close mobile menu
  });

  // accordion plugin
  $( '[data-plugin="collapse"]').accordion({
    heightStyle: "content",
    animate: 300
  });

  // owl carousel plugin
  var cardCarousel = $('.carousel');
  cardCarousel.each(function() {
    var carousel = $(this);
    carousel.on(
      'initalize.owl.carousel initialized.owl.carousel ' +
      'resize.owl.carousel resized.owl.carousel', function(e) {
        carousel.find('.card__body').matchHeight();
        $('.compare').twentytwenty();
      }
    );
    var options = {
      slideSpeed: 300,
      loop:false,
      rewind: true,
      margin:10,
      responsiveClass:true,
      responsive:{
        0:{ items: carousel.attr('data-items-mobile') }, 600:{ items: carousel.attr('data-items-tablet') }, 1000:{ items: carousel.attr('data-items') }
      }
    }
    if(carousel.attr('data-autoplay') > 0) {
      options.autoplay = true;
      options.autoplayTimeout = carousel.attr('data-autoplay');
    }
    carousel.owlCarousel(options);



    var stage = $('.owl-stage', this),
        transform,
        width,
        locked = false;
    carousel.on("mousedown.owl.core touchstart.owl.core", function(e) {
      if($('.compare:hover').length) {
        locked = true;
        $('#carousel-styles').remove();
        var matrix = stage.css('transform'),
            width = stage.css('width');
        if(!stage.hasClass('no-transform')) {
          var values = matrix.split('(')[1];
              values = values.split(')')[0];
              values = values.split(',');
          var x = Math.floor(values[4]);
          transform = 'translate3d(' + x + 'px, 0px, 0px)';
          $('head').append('<style id="carousel-styles">.owl-stage { transform: ' + transform + ' !important; width: ' + width + ' !important;}</style>');

        }

      }
      }).on('mouseup.owl.core touchend.owl.core', function() {
        if(locked) {
          stage.stop();
        width = width = stage.css('width');
          setTimeout(function() {
            stage.css('cssText', 'transform: ' + transform + '; width: ' + width + ';');
            $('#carousel-styles').remove();
          }, 500);
          locked = false;
        }

      });

      // Custom Navigation Events
            carousel.parent().find(".carousel__next").on('click',function(){
              //console.log($(this).closest)
                carousel.trigger('next.owl.carousel');
            })
            carousel.parent().find(".carousel__prev").on('click',function(){
                carousel.trigger('prev.owl.carousel');
            });
  });





  var videoEmbed = $('.video__content');
  videoEmbed.on({
    mouseenter: function () {
      videoEmbed.attr("controls","controls");
    },
    mouseleave: function () {
      videoEmbed.attr("controls");
    }
});

  window.addEventListener('load', function(){
    $('.site-nav__sub-menu--open').removeClass('site-nav__sub-menu--open');
    $('.site-nav').removeClass('site-nav--open');
  });
             $('.implant__note .plus-icon .plus').on('click',function(){
      if($(this).parents('.implant__note').hasClass('show-cont')) {
        $(this).parents('.implant__note').removeClass('show-cont')
      } else {
        console.log('here');
        $(this).parents('.implant__note').addClass('show-cont')
      }
    });





        $('.js-popup-video').magnificPopup({
          disableOn: 700,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,

          fixedContentPos: false
        });


    $('.popform, .citation, .citation a').click(function () {
        var poplink = $(this).attr('href');

        newwindow=window.open(poplink,'name','height=800,width=1024');
        if (window.focus) {newwindow.focus()}
        return false;
    })



    $(window).on('load', function() {
      plyr.setup(document.querySelectorAll('.js-player'), { volume: 8});
    })
  }();

  /**!
 * easyPieChart
 * Lightweight plugin to render simple, animated and retina optimized pie charts
 *
 * @license Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 * @author Robert Fleischmann <rendro87@gmail.com> (http://robert-fleischmann.de)
 * @version 2.0.1
 **/
!function(){var a=function(a,b){var c=document.createElement("canvas");"undefined"!=typeof G_vmlCanvasManager&&G_vmlCanvasManager.initElement(c);var d=c.getContext("2d");if(c.width=c.height=b.size,a.appendChild(c),window.devicePixelRatio>1){var e=window.devicePixelRatio;c.style.width=c.style.height=[b.size,"px"].join(""),c.width=c.height=b.size*e,d.scale(e,e)}d.translate(b.size/2,b.size/2),d.rotate((-0.5+b.rotate/180)*Math.PI);var f=(b.size-b.lineWidth)/2;b.scaleColor&&b.scaleLength&&(f-=b.scaleLength+2);var g=function(a,b,c){c=Math.min(Math.max(0,c||1),1),d.beginPath(),d.arc(0,0,f,0,2*Math.PI*c,!1),d.strokeStyle=a,d.lineWidth=b,d.stroke()},h=function(){var a,c,e=24;d.lineWidth=1,d.fillStyle=b.scaleColor,d.save();for(var e=24;e>=0;--e)0===e%6?(c=b.scaleLength,a=0):(c=.6*b.scaleLength,a=b.scaleLength-c),d.fillRect(-b.size/2+a,0,c,1),d.rotate(Math.PI/12);d.restore()};Date.now=Date.now||function(){return+new Date};var i=function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||function(a){window.setTimeout(a,1e3/60)}}();this.clear=function(){d.clearRect(b.size/-2,b.size/-2,b.size,b.size)},this.draw=function(a){this.clear(),b.scaleColor&&h(),b.trackColor&&g(b.trackColor,b.lineWidth),d.lineCap=b.lineCap;var c;c="function"==typeof b.barColor?b.barColor(a):b.barColor,a>0&&g(c,b.lineWidth,a/100)}.bind(this),this.animate=function(a,c){var d=Date.now();b.onStart(a,c);var e=function(){var f=Math.min(Date.now()-d,b.animate),g=b.easing(this,f,a,c-a,b.animate);this.draw(g),b.onStep(a,c,g),f>=b.animate?b.onStop(a,c):i(e)}.bind(this);i(e)}.bind(this)},b=function(b,c){var d,e={barColor:"#ef1e25",trackColor:"#f9f9f9",scaleColor:"#dfe0e0",scaleLength:5,lineCap:"round",lineWidth:3,size:110,rotate:0,animate:1e3,renderer:a,easing:function(a,b,c,d,e){return(b/=e/2)<1?d/2*b*b+c:-d/2*(--b*(b-2)-1)+c},onStart:function(){},onStep:function(){},onStop:function(){}},f={},g=0,h=function(){this.el=b,this.options=f;for(var a in e)e.hasOwnProperty(a)&&(f[a]=c&&"undefined"!=typeof c[a]?c[a]:e[a],"function"==typeof f[a]&&(f[a]=f[a].bind(this)));f.easing="string"==typeof f.easing&&"undefined"!=typeof jQuery&&jQuery.isFunction(jQuery.easing[f.easing])?jQuery.easing[f.easing]:e.easing,d=new f.renderer(b,f),d.draw(g),b.dataset&&b.dataset.percent&&this.update(parseInt(b.dataset.percent,10))}.bind(this);this.update=function(a){return a=parseInt(a,10),f.animate?d.animate(g,a):d.draw(a),g=a,this}.bind(this),h()};window.EasyPieChart=b}();

var options = {
  scaleColor: false,
  trackColor: 'rgba(255,255,255,0.3)',
  barColor: '#E7F7F5',
  lineWidth: 6,
  lineCap: 'butt',
  size: 158
};

if( $('.counter').length ) {
  var waypoint = new Waypoint({
  element: document.querySelector('.counter'),
    handler: function(direction) {
      $('.counter__count').countTo({ speed: 500});
      var charts = [];
      [].forEach.call(document.querySelectorAll('.counter'),  function(el) {
        charts.push(new EasyPieChart(el, options));
      });
      this.destroy();
    },
    offset: '100%'
  });
}
