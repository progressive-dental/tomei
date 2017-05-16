<?php

add_action( 'after_setup_theme', 'shaggy_reynolds_setup' );
add_action( 'after_setup_theme', 'shaggy_reynolds_content_width', 0 );
add_action('after_setup_theme', 'remove_admin_bar');
add_filter( 'upload_mimes', 'shaggy_reynolds_mime_types', 10, 1 );

if ( ! function_exists( 'shaggy_reynolds_setup' ) ) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function shaggy_reynolds_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on road runner, use a find and replace
     * to change 'road-runner' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'road-runner', THEME_ROOT . '/languages' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    ) );


    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );
  }
endif;

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function shaggy_reynolds_content_width() {
  $GLOBALS['content_width'] = apply_filters( 'shaggy_reynolds_content_width', 1200 );
}

/**
 * Disable admin bar
 */
function remove_admin_bar() {
  show_admin_bar(false);
}

/**
 * Allow support for SVG via media uploader.
 */
function shaggy_reynolds_mime_types( $mime_types ) {
  $mime_types[ 'svg' ] = 'image/svg+xml';
  $mime_types[ 'svgz' ] = 'image/svg+xml';

  return $mime_types;
}

function my_filter_function_name( $content ) {
  // Remove row and column before
  $return = str_replace( '[vc_row][vc_column][pd_masthead', '[pd_masthead', $content );

  // Remove row and column after
  $return = str_replace( '[/pd_masthead][/vc_column][/vc_row]', '[/pd_masthead]', $return );

  return $return;
}

add_filter( 'content_save_pre', 'my_filter_function_name', 10, 1 );

function atg_menu_classes($classes, $item, $args) {
  if( $args->theme_location == 'footer-menu-1' || $args->theme_location == 'footer-menu-2' || $args->theme_location == 'footer-menu-3' ) {
    $classes[] = 'site-foot__item';
  }
  return $classes;
}
add_filter('nav_menu_css_class','atg_menu_classes',1,3);

add_filter( 'nav_menu_link_attributes', 'wpse156165_menu_add_class', 10, 3 );

function wpse156165_menu_add_class( $atts, $item, $args ) {
  if( $args->theme_location == 'footer-menu-1' || $args->theme_location == 'footer-menu-2' || $args->theme_location == 'footer-menu-3' ) {
    $class = 'site-foot__link';
    $atts['class'] = $class;
  }
  return $atts;
}
