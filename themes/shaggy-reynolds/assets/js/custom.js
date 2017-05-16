/*
* jquery-match-height 0.7.2 by @liabru
* http://brm.io/jquery-match-height/
* License MIT
*/
!function(t){"use strict";"function"==typeof define&&define.amd?define(["jquery"],t):"undefined"!=typeof module&&module.exports?module.exports=t(require("jquery")):t(jQuery)}(function(t){var e=-1,o=-1,n=function(t){return parseFloat(t)||0},a=function(e){var o=1,a=t(e),i=null,r=[];return a.each(function(){var e=t(this),a=e.offset().top-n(e.css("margin-top")),s=r.length>0?r[r.length-1]:null;null===s?r.push(e):Math.floor(Math.abs(i-a))<=o?r[r.length-1]=s.add(e):r.push(e),i=a}),r},i=function(e){var o={
byRow:!0,property:"height",target:null,remove:!1};return"object"==typeof e?t.extend(o,e):("boolean"==typeof e?o.byRow=e:"remove"===e&&(o.remove=!0),o)},r=t.fn.matchHeight=function(e){var o=i(e);if(o.remove){var n=this;return this.css(o.property,""),t.each(r._groups,function(t,e){e.elements=e.elements.not(n)}),this}return this.length<=1&&!o.target?this:(r._groups.push({elements:this,options:o}),r._apply(this,o),this)};r.version="0.7.2",r._groups=[],r._throttle=80,r._maintainScroll=!1,r._beforeUpdate=null,
r._afterUpdate=null,r._rows=a,r._parse=n,r._parseOptions=i,r._apply=function(e,o){var s=i(o),h=t(e),l=[h],c=t(window).scrollTop(),p=t("html").outerHeight(!0),u=h.parents().filter(":hidden");return u.each(function(){var e=t(this);e.data("style-cache",e.attr("style"))}),u.css("display","block"),s.byRow&&!s.target&&(h.each(function(){var e=t(this),o=e.css("display");"inline-block"!==o&&"flex"!==o&&"inline-flex"!==o&&(o="block"),e.data("style-cache",e.attr("style")),e.css({display:o,"padding-top":"0",
"padding-bottom":"0","margin-top":"0","margin-bottom":"0","border-top-width":"0","border-bottom-width":"0",height:"100px",overflow:"hidden"})}),l=a(h),h.each(function(){var e=t(this);e.attr("style",e.data("style-cache")||"")})),t.each(l,function(e,o){var a=t(o),i=0;if(s.target)i=s.target.outerHeight(!1);else{if(s.byRow&&a.length<=1)return void a.css(s.property,"");a.each(function(){var e=t(this),o=e.attr("style"),n=e.css("display");"inline-block"!==n&&"flex"!==n&&"inline-flex"!==n&&(n="block");var a={
display:n};a[s.property]="",e.css(a),e.outerHeight(!1)>i&&(i=e.outerHeight(!1)),o?e.attr("style",o):e.css("display","")})}a.each(function(){var e=t(this),o=0;s.target&&e.is(s.target)||("border-box"!==e.css("box-sizing")&&(o+=n(e.css("border-top-width"))+n(e.css("border-bottom-width")),o+=n(e.css("padding-top"))+n(e.css("padding-bottom"))),e.css(s.property,i-o+"px"))})}),u.each(function(){var e=t(this);e.attr("style",e.data("style-cache")||null)}),r._maintainScroll&&t(window).scrollTop(c/p*t("html").outerHeight(!0)),
this},r._applyDataApi=function(){var e={};t("[data-match-height], [data-mh]").each(function(){var o=t(this),n=o.attr("data-mh")||o.attr("data-match-height");n in e?e[n]=e[n].add(o):e[n]=o}),t.each(e,function(){this.matchHeight(!0)})};var s=function(e){r._beforeUpdate&&r._beforeUpdate(e,r._groups),t.each(r._groups,function(){r._apply(this.elements,this.options)}),r._afterUpdate&&r._afterUpdate(e,r._groups)};r._update=function(n,a){if(a&&"resize"===a.type){var i=t(window).width();if(i===e)return;e=i;
}n?o===-1&&(o=setTimeout(function(){s(a),o=-1},r._throttle)):s(a)},t(r._applyDataApi);var h=t.fn.on?"on":"bind";t(window)[h]("load",function(t){r._update(!1,t)}),t(window)[h]("resize orientationchange",function(t){r._update(!0,t)})});
!function() {
  
  $('.implant__note .plus-icon .plus').on('click',function(){
      if($(this).parents('.implant__note').hasClass('show-cont')) {
        $(this).parents('.implant__note').removeClass('show-cont')
      } else {
        console.log('here');
        $(this).parents('.implant__note').addClass('show-cont')
      }
    });

  // accordion plugin
  $( '[data-plugin="collapse"]').accordion({
    heightStyle: "content",
    animate: 300
  });

  $('.compare').twentytwenty();

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
    fixedContentPos: false
  });

  $('.testimonial-slider').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    
  });

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
          "<a class='icon  icon--phone' href='tel:5619129993'></a>",
          "<a class='icon  icon--youtube' href='https://www.youtube.com/channel/UCm8PIzOxeOcK-TH6zhPMfyQ'></a>",
          "<a class='icon  icon--facebook' href='https://www.facebook.com/South-Florida-Center-for-Periodontics-Implant-Dentistry-503424793170616/'></a>"
        ]
      }
    ]
  });

  var API = $("#menu").data( "mmenu" );
  $('.menu-button').click(function() {
    if($("#menu").hasClass('mm-opened')) {
      API.close();
    } else {
      API.open();
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
      families: [ 'Lato:300,400,700,900' ]
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
    element: counter,
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