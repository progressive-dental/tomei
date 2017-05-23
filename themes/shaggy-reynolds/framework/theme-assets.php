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

  wp_enqueue_script( 'jquery', THEME_WEB_ROOT . '/assets/js/site.min.js', array(), '', true );

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

  wp_deregister_script( 'wpb_composer_front_js' );
  wp_dequeue_script( 'wpb_composer_front_js' );

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

function dvk_dequeue_scripts() {

    $load_scripts = false;

    if( is_singular() ) {
      $post = get_post();

      if( has_shortcode($post->post_content, 'contact-form-7') ) {
          $load_scripts = true;
      }

    }

    if( ! $load_scripts ) {
        wp_dequeue_script( 'contact-form-7' );
        wp_dequeue_style( 'contact-form-7' );
    }

}

add_action( 'wp_enqueue_scripts', 'dvk_dequeue_scripts', 99 );
