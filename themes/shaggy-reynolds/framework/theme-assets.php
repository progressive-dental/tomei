<?php

add_action( 'wp_enqueue_scripts', 'shaggy_reynolds_scripts', 99 );
//add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );

/**
 * Enqueue scripts and styles.
 */
function shaggy_reynolds_scripts() {
  global $progressive;

  wp_enqueue_style( 'shaggy-reynolds-mmenu', THEME_WEB_ROOT . '/assets/css/jquery.mmenu.min.css' );
  wp_enqueue_style( 'shaggy-reynolds-style', THEME_WEB_ROOT . '/assets/css/site.css' );
  wp_enqueue_style( 'shaggy-reynolds-magnific', THEME_WEB_ROOT . '/assets/css/magnific.min.css' );


  wp_deregister_script( 'jquery' );
  wp_dequeue_script( 'jquery' );
  wp_dequeue_script( 'jquery-migrate' );
  wp_dequeue_script( 'jquery-migrate' );

  wp_enqueue_script( 'jquery', THEME_WEB_ROOT . '/assets/js/vendor.min.js', array(), '', true );
  wp_enqueue_script( 'shaggy-reynolds-webfont', THEME_WEB_ROOT . '/assets/js/webfont.min.js', array(), '', true );
  wp_enqueue_script( 'shaggy-reynolds-slick', THEME_WEB_ROOT . '/assets/js/slick.min.js', array(), '', true );
  wp_enqueue_script( 'shaggy-reynolds-magnific', THEME_WEB_ROOT . '/assets/js/magnific.min.js', array(), '', true );
  wp_enqueue_script( 'shaggy-reynolds-mmenu', THEME_WEB_ROOT . '/assets/js/jquery.mmenu.min.js', array(), '', true );
  wp_enqueue_script( 'shaggy-reynolds-pic-chart', THEME_WEB_ROOT . '/assets/js/easyPieChart.min.js', array(), '', true );
  wp_enqueue_script( 'shaggy-reynolds-countTo', THEME_WEB_ROOT . '/assets/js/countTo.js', array(), '', true );
  wp_enqueue_script( 'shaggy-reynolds-waypoints', THEME_WEB_ROOT . '/assets/js/waypoints.js', array(), '', true );
  wp_enqueue_script( 'shaggy-reynolds-parallax', THEME_WEB_ROOT . '/assets/js/parallax.js', array(), '', true );
  wp_enqueue_script( 'shaggy-reynolds-twentytwenty', THEME_WEB_ROOT . '/assets/js/jquery.twentytwenty.js', array(), '', true );
  wp_enqueue_script( 'shaggy-reynolds-event-move', THEME_WEB_ROOT . '/assets/js/jquery.event.move.js', array(), '', true );
  wp_enqueue_script( 'shaggy-reynolds-accordion', THEME_WEB_ROOT . '/assets/js/jquery.accordion.min.js', array(), '', true );
  wp_enqueue_script( 'shaggy-reynolds-custom', THEME_WEB_ROOT . '/assets/js/custom.js', array(), '', true );

  if( $progressive['enable-ppc'] == 1 ) {
    wp_enqueue_script( 'shaggy-reynolds-ppc', THEME_WEB_ROOT . '/assets/js/web-ppc-call.js', array(), '', true );
  }

  // deregister and dequeue plugin styles and scripts
  wp_deregister_style( 'gcp-owl-carousel-css' );
  wp_dequeue_style( 'gcp-owl-carousel-css' );

  wp_deregister_style( 'carousel-anything-owl' );
  wp_dequeue_style( 'carousel-anything-owl' );

  wp_deregister_script( 'carousel-anything-owl' );
  wp_dequeue_script( 'carousel-anything-owl' );

  wp_deregister_script( 'carousel-anything' );
  wp_dequeue_script( 'carousel-anything' );

  wp_deregister_style( 'carousel-anything-single-post' );
  wp_dequeue_style( 'carousel-anything-single-post' );

  wp_deregister_style( 'js_composer_front' );
  wp_dequeue_style( 'js_composer_front' );

  wp_deregister_script( 'js_composer_front' );
  wp_dequeue_script( 'js_composer_front' );

  wp_deregister_script( 'waypoints' );
  wp_dequeue_script( 'waypoints' );

  wp_deregister_style( 'contact-form-7' );
  wp_dequeue_style( 'contact-form-7' );
}

/**
 * Defer loading of scripts
 *
 * This delays the execution of the script until the HTML parser has finished.
 */
function defer_parsing_of_js ( $url ) {
  if ( is_admin() ) {
    return $url;
  }

  if ( FALSE === strpos( $url, '.js' ) ) return $url;

  return "$url' defer onload='";

}
