!function() {
  $("video").each(function() {
    var sourceFile = $(this).attr("data-src");
    var type = $(this).attr('data-type');
    var source = document.createElement('source');
    source.src = sourceFile;
    source.type = type;
    $(this).append( source );

  });

  $('.wpcf7').on('mailsent.wpcf7', function( event ) {
    if ( typeof ga === 'function' ) {
      if( localStorage.getItem( "fromAd" ) == '1' ) {
        // PPC user form fill goals
        ga('send', 'event', 'Form - PPC Contact Form', 'Submit', 'Home');
        ga('send', 'pageview', '/goals/PPC-Contact-Form');
      } else {
        var goal = $(this).find('[data-goal]').data('goal');
        ga('send', 'pageview', goal);
      }
    }
  });

  // $('h1,h2,h3,h4,h5,h6').widowFix({linkFix:true});

  $('.implant__note .plus-icon .plus').on('click',function(){
    if($(this).parents('.implant__note').hasClass('show-cont')) {
      $(this).parents('.implant__note').removeClass('show-cont')
    } else {
      console.log('here');
      $(this).parents('.implant__note').addClass('show-cont')
    }
  });
  $('.vc_row-o-equal-height > div').matchHeight();
  // accordion plugin
  $( '[data-plugin="collapse"]').accordion({
    heightStyle: "content",
    animate: 300
  });
  
  $(window).on('load', function() {
    $('.compare').twentytwenty();
  });

  var footLinkHeader = $('.site-foot__item--header .site-foot__link');
  footLinkHeader.each(function() {
    var linkText = $(this).text();
    $(this).parent().text(linkText);
    $(this).remove();
  });

  $('.fifty__play, .video-box__play, .testimonial__play, .video-play, .js-play-video').magnificPopup({
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false,
    disableOn: 0,
    iframe: {
      patterns: {
        youtube: {
          index: 'youtube.com',
          id: 'v=',
          src: '//www.youtube.com/embed/%id%?autoplay=1&rel=0&modestbranding=1&autohide=1&showinfo=0'
        }
      }
    }
  });

  $('.testimonial-slider').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,

  });
  var cardCarousel = $('.carousel');
  cardCarousel.each(function() {
    var carousel = $(this);
    var options = {
      infinite: true,
      speed: 300,
      dots: true,
      slidesToShow: carousel.attr('data-items'),
      slideToScroll: carousel.attr('data-items'),
      arrows: false,
      responsive: [
        {
          breakpoint: 600,
          settings: {
            slidesToShow: carousel.attr('data-items-tablet'),
            slideToScroll: carousel.attr('data-items-tablet')
          }
        },
        {
          breakpoint: 599,
          settings: {
            slidesToShow: carousel.attr('data-items-mobile'),
            slideToScroll: carousel.attr('data-items-mobile')
          }
        }
      ]
    }
    if(carousel.attr('data-autoplay') > 0) {
      options.autoplay = true;
      options.autoplaySpeed = carousel.attr('data-autoplay');
    }
    carousel.on('init', function(event, slick){
      carousel.find('.card__body').matchHeight();
      carousel.find('.compare').twentytwenty();
    });
    var locked = false;
    var isDragging = false;
    carousel.slick( options );
    carousel.on( 'mousedown', function() {
      if($('.compare:hover').length) {
        locked = true;
        carousel.slick( 'slickSetOption', "draggable", false, false);
        carousel.slick( 'slickSetOption', "swipe", false, false);
      } else {
        carousel.slick( 'slickSetOption', "draggable", true, false);
        carousel.slick( 'slickSetOption', "swipe", true, false);
        locked = false;
      }
    });


  });

  $.extend({
    replaceTag: function (currentElem, newTagObj, keepProps) {
      var $currentElem = $(currentElem);
      var i, $newTag = $(newTagObj).clone();
      if (keepProps) {//{{{
        newTag = $newTag[0];
        newTag.className = currentElem.className;
        $.extend(newTag.classList, currentElem.classList);
        $.extend(newTag.attributes, currentElem.attributes);
      }//}}}
      $currentElem.wrapAll($newTag);
      $currentElem.contents().unwrap();
      // return node; (Error spotted by Frank van Luijn)
      return this; // Suggested by ColeLawrence
    }
  });

  $.fn.extend({
    replaceTag: function (newTagObj, keepProps) {
      // "return" suggested by ColeLawrence
      return this.each(function() {
        jQuery.replaceTag(this, newTagObj, keepProps);
      });
    }
  });
  $('.page-head__nav > .site-nav').clone().appendTo('#menu');
  $('#menu .has-dropdown > .site-nav__link').replaceTag('<span>', false);
  $('#menu .has-dropdown .site-nav__dropdown').replaceWith(function() { return $(this).contents(); });
  var children = document.querySelector('#menu > .site-nav').getElementsByTagName('*');
  for( var i = 0; i < children.length; i++ ) {
    children[i].removeAttribute("class");
    children[i].removeAttribute("id");
  }
  $('#menu > .site-nav').attr('class', '');

  var mmenuPhone = $('#menu').data('call-tracking-number');

  $("#menu").mmenu({
    extensions  : [
      "fx-menu-slide",
      "border-offset",
      "fx-menu-zoom",
      "fx-panels-zoom"
    ],
    "offCanvas": {
      "position": "right"
    },
    "counters": true,
    "navbars": [
      {
        "position": "bottom",
        "content": [
          '<a class="icon  icon--phone" href="tel:+1-' + mmenuPhone + '" target="_blank"></a>'
        ]
      }
    ]
  });

  var API = $("#menu").data( "mmenu" );
  $('.site-nav__open').click(function() {
    if($("#menu").hasClass('mm-opened')) {
      API.close();
      $('.site-nav__open').removeClass('open');
    } else {
      API.open();
      $('.site-nav__open').addClass('open');
    }
  });

  $(".tabs__button-item a").on("click", function(e) {
    e.preventDefault();
    console.log('click');
    $(".tabs__content").removeClass("active");
    $(".tabs__button-item").removeClass("active");
    $(this).parent().addClass("active");
    $(".tabs__content-" + $(this).data("index")).addClass("active");
  });
  $('[data-plugin="scrollTo"]').on('click touch', function(e) {
    e.preventDefault();
    var target = $(this.hash);
    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
    if (target.length) {
      $('html, body').animate({
        scrollTop: target.offset().top
      }, 1000);
      return false;

    }
  });


  $('.product__images').slick({
    dots: false,
    infinite: true,
    speed: 500,
    arrows: false
  });

  WebFont.load({
    google: {
      families: [ 'Julius+Sans+One', 'Open+Sans:300,600' ]
    }
  });

  if( $('.counter').length ) {
    $('.counter').each(function() {
      var counter = $(this);
      var options = {
        scaleColor: false,
        trackColor: 'rgba(255,255,255,0.3)',
        barColor: counter.data('bar-color'),
        lineWidth: counter.data('bar-width'),
        lineCap: 'butt',
        size: 242
      };
      var waypoint = new Waypoint({
        element: counter[0],
        handler: function(direction) {
          $('.counter__count').countTo({ speed: counter.data('speed')});
          $('.counter').easyPieChart(options);
          this.destroy();
        },
        offset: '100%'
      });

    });

  }
}();
