  var $window = jQuery(window);
  var windowHeight = $window.height();
 var windowWidth = $window.width();
  $window.resize(function () {
    windowHeight = $window.height();
  windowWidth = $window.width();
  });

 $.fn.progressive_video_bg = function() {
  $(this).each(function() {
   var selector = $(this);
   selector.prepend('<div class="section__video-wrapper"></div>');
   var vdo = selector.data('vdo');
   if(selector.data('type') == "hosted") {
    selector.find('.section__video-wrapper').prepend('<video class="section__video-bg" autoplay loop></video>');
    $('<source/>', {
     type: 'video/mp4',
     src: vdo
    }).appendTo(selector.find('.section__video-bg'));
   }
  });
 }
  $.fn.vparallax = function(xpos, speedFactor, outerHeight) {
   var $this = $(this);
   var getHeight, firstTop;
   var paddingTop = 0;
   var isMobile;


   getHeight = function(el) {
    return el.height();
   }

   function isMobile() {
    isMobile = false;
    $.Android = (navigator.userAgent.match(/Android/i));
    $.iPhone = ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)));
    $.iPad = ((navigator.userAgent.match(/iPad/i)));
    $.iOs4 = (/OS [1-4]_[0-9_]+ like Mac OS X/i.test(navigator.userAgent));

    if ($.iPhone || $.iPad || $.Android) {
     isMobile = true;
    }
    return isMobile
   }

   function update() {

    var pos = $window.scrollTop();
    $this.each(function() {
     firstTop = $(this).offset().top;
     var $element = $(this);
     var top = $element.offset().top;
     var height = getHeight($element);
     var width = $element.width();
     var scrollPos = window.pageYOffset;
     // check if above or below viewport
     if(top + height < pos || top > pos + windowHeight ) {
      return;
     }
     var f = Math.round((firstTop - pos) * speedFactor);
     f=-f;

     var disable = false;
    $.Android = (navigator.userAgent.match(/Android/i));
    $.iPhone = ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)));
    $.iPad = ((navigator.userAgent.match(/iPad/i)));
    $.iOs4 = (/OS [1-4]_[0-9_]+ like Mac OS X/i.test(navigator.userAgent));

    if ($.iPhone || $.iPad || $.Android) {
     disable = true;
    }

     if(disable == false) {
      if($(this).data('type') == "hosted" || $(this).data('type') == "youtube") {
       var scrollPos = window.pageYOffset;
       var videoPosition = parseInt(top);
       var videoOffset = videoPosition - scrollPos;
       var yPos = parseInt( height - windowHeight );
       var xPos = -parseInt((width - windowWidth ) / 2);
       yPos = -(videoOffset / 1.5 + yPos );
       var transformStyle = "translate3d(" + xPos + "px, " + yPos + "px, 0)";
       $(this).find('.section__video-bg').css({
        'transform': "translate3d(" + xPos + "px, " + yPos + "px, 0)"
       });
      } else {

       $(this).css('backgroundPosition', xpos + " " + f + "px");
      }
     }
    });
   }
   $window.bind('scroll', update).resize(update);
   update();
  };

 $('.section__background--video').each(function() {
  $(this).progressive_video_bg();
 });
 $('.section__background--parallax').each(function() {
  var disable = false;
  $.Android = (navigator.userAgent.match(/Android/i));
    $.iPhone = ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)));
    $.iPad = ((navigator.userAgent.match(/iPad/i)));
    $.iOs4 = (/OS [1-4]_[0-9_]+ like Mac OS X/i.test(navigator.userAgent));

    if ($.iPhone || $.iPad || $.Android) {
     disable = true;
    }


  if( disable == false ) {
   $(this).vparallax("40%", 30/100);
  }
 });

 function resize() {
  $('.section__background--parallax').each(function() {
    var selector = $(this);
    //var resize_selector = ancenstor.find('.section__background--video');
    var imageSrc = selector.attr('data-image');
    selector.css({
     'background-repeat': 'repeat',
     'background-size': 'cover',
     'background-attachment': 'scroll',
     'background-image': 'url('+imageSrc+')'
    });

    var wh, w,h,ancestor,al,bl;
    ancestor = selector.parent();
    wh = $(window).height();
    h = ancestor.outerHeight();
    w = ancestor.outerWidth();
    selector.css({
     'min-width': w + 'px',
     'width': w + 'px',
     'left': 0
    });
  });

 }

 resize();
 $(window).on('load', function() {
  resize();
 });

 $(window).on('resize', function() {
  resize();
 });
