<?php
/**
 * Turn any Visual Composer element into a carousel element.
 *
 * @package Carousel Anything for VC
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly.
}
if ( ! class_exists( 'PdTList' ) ) {

  /**
   * Sorry, but that doesn't include your kitchen sink.
   */
  class PdTList {

    /**
     * Sets a unique identifier of each carousel.
     *
     * @var id
     */
    private static $id = 0;

    /**
     * Hook into WordPress.
     *
     * @return  void
     * @since 1.0
     */
    function __construct() {

      // Initializes VC shortcode.
      add_filter( 'init', array( $this, 'create_tl_shortcodes' ), 999 );

      // Render shortcode for the plugin.
      add_shortcode( 'pd_t_list', array( $this, 'render_tl_shortcodes' ) );
    }


    /**
     * Creates the carousel element inside VC.
     *
     * @return  void
     * @since 1.0
     */
    public function create_tl_shortcodes() {
      if ( ! function_exists( 'vc_map' ) ) {
        return;
      }

      // $default_content = '[vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner]';
      $default_content = '[pd_t_list_item][/pd_t_list_item][pd_t_list_item][/pd_t_list_item][pd_t_list_item][/pd_t_list_item]';
      // $default_content = '';
      if ( vc_is_frontend_editor() ) {
        $default_content = '';
      }

      // Loads fixes that makes Carousel Anything possible.
      t_list_row_fixes();

      vc_map( array(
        'name' => __( 'T List', 'progressive' ),
        'base' => 'pd_t_list',
        'icon' => THEME_WEB_ROOT . '/assets/images/pd-logo.png',
        'description' => __( 'A container for the T list.', 'progressive' ),
        'category' => __( 'Content', 'progressive' ),
        'as_parent' => array( 'only' => 'vc_row,vc_row_inner' ),
        'js_view' => 'VcColumnView',
        'content_element' => true,
        'is_container' => true,
        'container_not_allowed' => false,
        'show_settings_on_create' => false,
        'default_content' => $default_content,
      ) );
    }


    /**
     * Shortcode logic
     *
     * @param array  $atts - WordPress shortcode attributes, defined by Visual Composer.
     * @param string $content - Not needed in this plugin.
     * @return  string The rendered html
     * @since 1.0
     */
    public function render_tl_shortcodes( $atts, $content = null ) {

      if ( empty( $atts ) ) {
        $atts = array();
      }
      $ret = '';
      // Carousel html.
      $ret .= '<ul class="t-list">';
      $ret .= do_shortcode( $content ) . '</ul>';

      return $ret;
    }
  }
  new PdTList();
}


/**
 * Loads the fixes that makes Carousel Anything work.
 *
 * @return  void
 * @since 1.5
 */
function t_list_row_fixes() {

  $create_class = false;

  /**
   * We need to define this so that VC will show our nesting container correctly.
   */
  if ( class_exists( 'WPBakeryShortCodesContainer' ) && ! class_exists( 'WPBakeryShortCode_Pd_T_List' ) ) {
    $create_class = true;
  } else {
    // If we can't detech the classes it means that VC is embeded in a theme.
    global $composer_settings;

    // The class WPBakeryShortCodesContainer is defined in VC's shortcodes.php, include it so we can define our container.
    if ( ! empty( $composer_settings ) ) {
      if ( array_key_exists( 'COMPOSER_LIB', $composer_settings ) ) {
        $lib_dir = $composer_settings['COMPOSER_LIB'];
        if ( file_exists( $lib_dir . 'shortcodes.php' ) ) {
          require_once( $lib_dir . 'shortcodes.php' );
        }
      }
    }

    // We need to define this so that VC will show our nesting container correctly.
    if ( class_exists( 'WPBakeryShortCodesContainer' ) && ! class_exists( 'WPBakeryShortCode_Pd_T_List' ) ) {
      $create_class = true;
    }
  }

  if ( $create_class ) {

    /**
     * Defines a subclass of the shortcodes container, for modifed Visual Composer modules.
     *
     * @package carousel-anything
     * @class WPBakeryShortCode_Pd_Sponsors_list
     */
    class WPBakeryShortCode_Pd_T_List extends WPBakeryShortCodesContainer {
    }
  }
}
