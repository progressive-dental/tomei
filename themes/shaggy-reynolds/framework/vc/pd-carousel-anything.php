<?php
/**
 * Turn any Visual Composer element into a carousel element.
 *
 * @package Carousel Anything for VC
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly.
}
if ( ! class_exists( 'GambitCarouselAnything' ) ) {

  /**
   * Sorry, but that doesn't include your kitchen sink.
   */
  class GambitCarouselAnything {

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
      add_filter( 'init', array( $this, 'create_ca_shortcodes' ), 999 );

      // Render shortcode for the plugin.
      add_shortcode( 'carousel_anything', array( $this, 'render_ca_shortcodes' ) );

    }


    /**
     * Creates the carousel element inside VC.
     *
     * @return  void
     * @since 1.0
     */
    public function create_ca_shortcodes() {
      if ( ! function_exists( 'vc_map' ) ) {
        return;
      }

      // $default_content = '[vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner]';
      $default_content = '[pd_card][/pd_card][pd_card][/pd_card][pd_card][/pd_card]';
      // $default_content = '';
      if ( vc_is_frontend_editor() ) {
        $default_content = '';
      }

      // Loads fixes that makes Carousel Anything possible.
      ca_row_fixes();
      vc_map( array(
        'name' => __( 'Card Carousel', 'progressive' ),
        'base' => 'carousel_anything',
        'icon' => plugins_url( 'carousel-anything/images/vc-icon.png', 'progressive' ),
        'description' => __( 'A modern and responsive content carousel system.', 'progressive' ),
        'category' => __( 'Content', 'js_composer' ),
        'as_parent' => array( 'only' => 'vc_row,vc_row_inner,pd_card,pd_testimonial,pd_staff_card,pd_media' ),
        'js_view' => 'VcColumnView',
        'content_element' => true,
        'is_container' => true,
        'container_not_allowed' => false,
        'default_content' => $default_content,
        'params' => array(
          array(
            'type' => 'textfield',
            'heading' => __( 'Items to display on screen', 'progressive' ),
            'param_name' => 'items',
            'value' => '3',
            'group' => __( 'General Options', 'progressive' ),
            'description' => __( 'Maximum items to display at a time.', 'progressive' ),
          ),
          /**
           * Removed due to tablet issues.
          array(
            'type' => 'textfield',
            'heading' => __( 'Items to display on small desktops', 'progressive' ),
            'param_name' => 'items_desktop_small',
            'value' => '2',
            'group' => __( 'General Options', 'progressive' ),
            'description' => __( 'Maximum items to display at a time for smaller screened desktops.', 'progressive' ),
          ),
           */
          array(
            'type' => 'textfield',
            'heading' => __( 'Items to display on tablets', 'progressive' ),
            'param_name' => 'items_tablet',
            'value' => '2',
            'group' => __( 'General Options', 'progressive' ),
            'description' => __( 'Maximum items to display at a time for tablet devices.', 'progressive' ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Items to display on mobile phones', 'progressive' ),
            'param_name' => 'items_mobile',
            'value' => '1',
            'group' => __( 'General Options', 'progressive' ),
            'description' => __( 'Maximum items to display at a time for mobile devices.', 'progressive' ),
          ),
          array(
            'type' => 'dropdown',
            'heading' => __( 'Navigation Thumbnails', 'progressive' ),
            'param_name' => 'thumbnails',
            'value' => array(
              __( 'Circle', 'progressive' ) => 'circle',
              __( 'Square', 'progressive' ) => 'square',
              __( 'Arrows', 'progressive' ) => 'arrows',
              __( 'None', 'progressive' ) => 'none',
            ),
            'description' => __( 'Select whether to display thumbnails below your carousel for navigation.<br>Selecting Arrows will display navigation arrows at each side.', 'progressive' ),
            'group' => __( 'Thumbnails', 'progressive' ),
          ),
          array(
            'type' => 'colorpicker',
            'heading' => __( 'Thumbnail Default Color', 'progressive' ),
            'param_name' => 'thumbnail_color',
            'value' => '#c3cbc8',
            'description' => __( 'The color of the non-active thumbnail. Not applicable to Arrows type of navigation.', 'progressive' ),
            'dependency' => array(
              'element' => 'thumbnails',
              'value' => array( 'circle', 'square' ),
            ),
            'group' => __( 'Thumbnails', 'progressive' ),
          ),
          array(
            'type' => 'colorpicker',
            'heading' => __( 'Thumbnail Active Color', 'progressive' ),
            'param_name' => 'thumbnail_active_color',
            'value' => '#869791',
            'description' => __( 'The color of the active / current thumbnail. Not applicable to Arrows type of navigation.', 'progressive' ),
            'dependency' => array(
              'element' => 'thumbnails',
              'value' => array( 'circle', 'square' ),
            ),
            'group' => __( 'Thumbnails', 'progressive' ),
          ),
          array(
            'type' => 'checkbox',
            'heading' => '',
            'param_name' => 'thumbnail_numbers',
            'value' => array( __( 'Check to display page numbers inside the thumbnails. Not applicable to Arrows type of navigation.', 'progressive' ) => 'true' ),
            'description' => '',
            'dependency' => array(
              'element' => 'thumbnails',
              'value' => array( 'circle', 'square' ),
            ),
            'group' => __( 'Thumbnails', 'progressive' ),
          ),
          array(
            'type' => 'colorpicker',
            'heading' => __( 'Thumbnail Default Page Number Color', 'progressive' ),
            'param_name' => 'thumbnail_number_color',
            'value' => '#ffffff',
            'description' => __( 'The color of the page numbers inside non-active thumbnails', 'progressive' ),
            'dependency' => array(
              'element' => 'thumbnail_numbers',
              'value' => array( 'true' ),
            ),
            'group' => __( 'Thumbnails', 'progressive' ),
          ),
          array(
            'type' => 'colorpicker',
            'heading' => __( 'Thumbnail Active Page Number Color', 'progressive' ),
            'param_name' => 'thumbnail_number_active_color',
            'value' => '#ffffff',
            'description' => __( 'The color of the page numbers inside active / current thumbnails', 'progressive' ),
            'dependency' => array(
              'element' => 'thumbnail_numbers',
              'value' => array( 'true' ),
            ),
            'group' => __( 'Thumbnails', 'progressive' ),
          ),
          
          array(
            'type' => 'textfield',
            'heading' => __( 'Starting Position', 'progressive' ),
            'param_name' => 'start',
            'value' => '',
            'description' => __( 'Enter the starting position of the carousel, by slide number. Leave blank to disable this function. (eg. To start the carousel at the 4th slide, enter "4" as value.)', 'progressive' ),
            'group' => __( 'Advanced', 'progressive' ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Autoplay', 'progressive' ),
            'param_name' => 'autoplay',
            'value' => '5000',
            'description' => __( 'Enter an amount in milliseconds for the carousel to move. Leave blank to disable autoplay', 'progressive' ),
            'group' => __( 'Advanced', 'progressive' ),
          ),
          array(
            'type' => 'checkbox',
            'heading' => '',
            'param_name' => 'stop_on_hover',
            'value' => array( __( 'Pause the carousel when the mouse is hovered onto it.', 'progressive' ) => 'true' ),
            'description' => '',
            'dependency' => array(
              'element' => 'autoplay',
              'not_empty' => true,
            ),
            'group' => __( 'Advanced', 'progressive' ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Scroll Speed', 'progressive' ),
            'param_name' => 'speed_scroll',
            'value' => '800',
            'description' => __( 'The speed the carousel scrolls in milliseconds', 'progressive' ),
            'group' => __( 'Advanced', 'progressive' ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Rewind Speed', 'progressive' ),
            'param_name' => 'speed_rewind',
            'value' => '1000',
            'description' => __( 'The speed the carousel scrolls back to the beginning after it reaches the end in milliseconds', 'progressive' ),
            'group' => __( 'Advanced', 'progressive' ),
          ),
          array(
            'type' => 'checkbox',
            'heading' => '',
            'param_name' => 'touchdrag',
            'value' => array( __( 'Check this box to disable touch dragging of the carousel. (Normally enabled by default)', 'progressive' ) => 'true' ),
            'description' => '',
            'group' => __( 'Advanced', 'progressive' ),
          ),
          array(
            'type' => 'dropdown',
            'heading' => __( 'Keyboard Navigation', 'progressive' ),
            'param_name' => 'keyboard',
            'value' => array(
              __( 'Disabled', 'progressive' ) => 'false',
              __( 'Cursor keys', 'progressive' ) => 'cursor',
              __( 'A and D keys', 'progressive' ) => 'fps',
            ),
            'description' => __( 'Select whether to enable carousel manipulation through cursor keys. Enabling this on a page with multiple carousels may give unpredictable results! Use it on a page with a single Carousel Anything element, or when there are no other scripts binding cursor or other keys present that may conflict.', 'progressive' ),
            'group' => __( 'Advanced', 'progressive' ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Custom Class', 'progressive' ),
            'param_name' => 'class',
            'value' => '',
            'description' => __( 'Add a custom class name for the carousel here.', 'progressive' ),
            'group' => __( 'Advanced', 'progressive' ),
          ),
        ),
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
    public function render_ca_shortcodes( $atts, $content = null ) {
      $defaults = array(
        'start' => '1',
        'items' => '3',
        // 'items_desktop_small' => '2',
        'items_tablet' => '2',
        'items_mobile' => '1',
        'autoplay' => '5000',
        'stop_on_hover' => false,
        'scroll_per_page' => false,
        'speed_scroll' => '800',
        'speed_rewind' => '1000',
        'thumbnails' => 'circle',
        'thumbnail_color' => '#c3cbc8',
        'thumbnail_active_color' => '#869791',
        'thumbnail_numbers' => false,
        'thumbnail_number_color' => '#ffffff',
        'thumbnail_number_active_color' => '#ffffff',
        'arrows_color' => '#c3cbc8',
        'arrows_active_color' => '#869791',
        'arrows_inactive_color' => '#ffffff',
        'arrows_size' => '20px',
        'touchdrag' => 'false',
        'keyboard' => 'false',
        'class' => '',
      );
      if ( empty( $atts ) ) {
        $atts = array();
      }
      $atts = array_merge( $defaults, $atts );

      self::$id++;
      $id = 'carousel-anything-' . esc_attr( self::$id );

      $ret = '';

      // Thumbnail styles.
      $styles = '';
      $carousel_class = '';
      $navigation_buttons = false;

      if ( ! empty( $atts['class'] ) ) {
        $carousel_class .= ' ' . esc_attr( $atts['class'] );
      }

      if ( $navigation_buttons ) {
        wp_enqueue_style( 'dashicons' );
      }

      // Enable filters for the shortcode content, if it exists.
      $content = apply_filters( 'gambit_ca_output', $content );

      $columns = substr_count( $content, '[vc_row]' );

      $slide_number = ( $atts['start'] > 0 ? $atts['start'] - 1 : $atts['start'] );

      $rtl = is_rtl() ? 'true' : 'false';

      // Carousel html.
      $ret .= '<div id="' . esc_attr( $id ) . '" class="carousel  owl-carousel  ' . $carousel_class . '" data-items="' . esc_attr( $atts['items'] ) . '"  data-totalitems="' . esc_attr( $columns ) . '" data-scroll_per_page="' . esc_attr( $atts['scroll_per_page'] ) . '" data-autoplay="' . esc_attr( empty( $atts['autoplay'] ) || '0' == $atts['autoplay'] ? 'false' : $atts['autoplay'] ) . '" data-items-tablet="' . esc_attr( $atts['items_tablet'] ) . '" data-items-mobile="' . esc_attr( $atts['items_mobile'] ) . '" data-stop-on-hover="' . esc_attr( $atts['stop_on_hover'] ) . '" data-speed-scroll="' . esc_attr( $atts['speed_scroll'] ) . '" data-speed-rewind="' . esc_attr( $atts['speed_rewind'] ) . '" data-thumbnails="' . esc_attr( $atts['thumbnails'] ) . '" data-thumbnail-numbers="' . esc_attr( $atts['thumbnail_numbers'] ) . '" data-navigation="' . esc_attr( $navigation_buttons ? 'true' : 'false' ) . '" data-touchdrag="' . esc_attr( $atts['touchdrag'] ) . '" data-keyboard="' . esc_attr( $atts['keyboard'] ) . '" data-rtl="' . $rtl . '" data-start="' . esc_attr( $slide_number ) . '">';
      $ret .= do_shortcode( $content ) . '</div>';
      $ret .= '
        <div class="carousel__navigation">
          <a class="carousel__prev"><i class="icon  icon--arrow-left"></i></a>
          <a class="carousel__next"><i class="icon  icon--arrow-right"></i></a>
        </div>
      ';

      return $ret;
    }
  }
  new GambitCarouselAnything();
}


/**
 * Loads the fixes that makes Carousel Anything work.
 *
 * @return  void
 * @since 1.5
 */
function ca_row_fixes() {

  $create_class = false;

  /**
   * We need to define this so that VC will show our nesting container correctly.
   */
  if ( class_exists( 'WPBakeryShortCodesContainer' ) && ! class_exists( 'WPBakeryShortCode_Carousel_Anything' ) ) {
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
    if ( class_exists( 'WPBakeryShortCodesContainer' ) && ! class_exists( 'WPBakeryShortCode_Carousel_Anything' ) ) {
      $create_class = true;
    }
  }

  if ( $create_class ) {

    /**
     * Defines a subclass of the shortcodes container, for modifed Visual Composer modules.
     *
     * @package carousel-anything
     * @class WPBakeryShortCode_Carousel_Anything
     */
    class WPBakeryShortCode_Carousel_Anything extends WPBakeryShortCodesContainer {
    }
  }
}
