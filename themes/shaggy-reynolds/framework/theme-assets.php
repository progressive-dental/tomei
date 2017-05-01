<?php

add_action( 'wp_enqueue_scripts', 'road_runner_scripts', 99 );
add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );

/**
 * Enqueue scripts and styles.
 */
function road_runner_scripts() {

  wp_enqueue_style( 'road-runner-style', THEME_WEB_ROOT . '/assets/css/site.min.css' );


  wp_deregister_script( 'jquery' );
  wp_dequeue_script( 'jquery' );
  wp_dequeue_script( 'jquery-migrate' );
  wp_dequeue_script( 'jquery-migrate' );


  wp_enqueue_script( 'road-runner-custom', THEME_WEB_ROOT . '/assets/js/site.min.js', array(), '', false );

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
