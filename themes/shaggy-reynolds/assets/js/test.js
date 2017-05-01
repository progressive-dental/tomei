!function() {
  
  /*
   * Page Subhead overlap fix
   *
   * Centers and removes floats when elements overlap
   */
  var left = document.querySelector('.page-subhead__title'),
      right = document.querySelector('.page-subhead__right'),
      pageSubhead = document.querySelector('.page-subhead'),
      container = document.querySelector('.page-subhead .container'),
      lWidth = left.clientWidth,  // get width before setting overlap
      rWidth = right.clientWidth; // get width before setting overlap
  
  function overlapCheck() {
    var cWidth = container.offsetWidth;

    // check if width of elements is larger than its container
    // we add 30px of padding as well
    if( (lWidth + 30) + rWidth > cWidth) {
      if(!pageSubhead.classList.contains('overlapped')) {
        pageSubhead.classList += ' overlapped';
      }
    } else {
      if(pageSubhead.classList.contains('overlapped')) {
        pageSubhead.className = pageSubhead.className.replace(new RegExp('(?:^|\\s)'+ 'overlapped' + '(?:\\s|$)'), ' ');
      }
    }
  }

  // attach overlapCheck function to resize and load
  window.addEventListener("resize", overlapCheck);
  window.addEventListener("load", overlapCheck);

  // match height
  $('.box__body').matchHeight();
  //$('.compare').twentytwenty();

  function isElementInViewport (el) {

    //special bonus for those using jQuery
    if (typeof jQuery === "function" && el instanceof jQuery) {
        el = el[0];
    }

    var rect = el.getBoundingClientRect();

    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && /*or $(window).height() */
        rect.right <= (window.innerWidth || document.documentElement.clientWidth) /*or $(window).width() */
    );
}

  function submenuOverlapCheck() {
    $('.site-nav__sub-menu').each(function() {
      var children = $(this).children();
      var icons = $(this).find('.icon');
      if( children.length > icons.length) 
        icons.hide();

      if( !isElementInViewport( $(this) ) ) {
        $(this).css({
          left: 'initial',
          right: 0,
        });
      }

      // TODO: grab all children's width to resize dropdown
      //var maxWidth = Math.max.apply( null, children.map( function () {
        //return $( this ).outerWidth( true );
      //}).get() );
    });
  }

  window.addEventListener("resize", submenuOverlapCheck);
  window.addEventListener("load", submenuOverlapCheck);

  var mobileOpen = $('.site-nav__open');
  var mobileClose = $('.site-nav__item--close');
  var siteNav = $('.site-nav');
  var mobileActiveClass = 'site-nav--active';

  mobileOpen.on('click touch', function(e) {
    e.preventDefault();
    siteNav.addClass(mobileActiveClass);
  });

  mobileClose.on('click touch', function(e) {
    e.preventDefault();
    siteNav.removeClass(mobileActiveClass);
  });

  // Clone nav items to mobile and slide down navigations
  var navItems = $('.site-nav__item');
  navItems.each(function() {
    $('.site-nav--mobile').append($(this).clone());
  });

}();
