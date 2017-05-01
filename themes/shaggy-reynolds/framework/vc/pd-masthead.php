<?php
/**
 * Turn any Visual Composer element into a carousel element.
 *
 * @package Carousel Anything for VC
 */

if ( ! defined( 'ABSPATH' ) ) { exit; // Exit if accessed directly.
}
if ( ! class_exists( 'PD_Masthead' ) ) {

  /**
   * Sorry, but that doesn't include your kitchen sink.
   */
  class PD_Masthead {

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
      add_filter( 'init', array( $this, 'create_masthead_shortcodes' ), 999 );

      // Render shortcode for the plugin.
      add_shortcode( 'pd_masthead', array( $this, 'render_masthead_shortcodes' ) );
    }


    /**
     * Creates the carousel element inside VC.
     *
     * @return  void
     * @since 1.0
     */
    public function create_masthead_shortcodes() {
      if ( ! function_exists( 'vc_map' ) ) {
        return;
      }

      // $default_content = '[vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner]';
      $default_content = '[vc_row_inner][vc_column_inner][/vc_column_inner][/vc_row_inner]';
      // $default_content = '';
      if ( vc_is_frontend_editor() ) {
        $default_content = '';
      }

      // Loads fixes that makes Carousel Anything possible.
      masthead_row_fixes();

      vc_map( array(
        'name' => __( 'Page Masthead', 'progressive' ),
        'base' => 'pd_masthead',
        'icon' => THEME_WEB_ROOT . '/assets/images/pd-logo.png',
        'description' => __( 'A masthead for pages.', 'progressive' ),
        'category' => __( 'Content', 'progressive' ),
        'js_view' => 'VcColumnView',
        'content_element' => true,
        'is_container' => true,
        'container_not_allowed' => false,
        'show_settings_on_create' => false,
        'default_content' => $default_content,
        'as_parent' => array(
          'only' => 'vc_row',
        ),
        'as_child' => array(
          'only' => '', // Only root
        ),
        'params' => array(
          array(
            'type' => 'dropdown',
            'heading' => __( 'Location', 'progressive' ),
            'param_name' => 'location',
            'description' => __( 'Masthead page location on the site.'),
            'admin_label' => true,
            'value' => array(
              'Select' => '',
              "Inner" => "inner",
              "Home" => "home"
            ),
          ),
          array(
            'type' => 'dropdown',
            'heading' => __( 'Type', 'progressive' ),
            'param_name' => 'type',
            'description' => __( 'Masthead background type.'),
            'admin_label' => true,
            'std' => 'image',
            'value' => array(
              "Image" => "image",
              "Color" => "color",
              "Video" => "video"
            ),
          ),
          array(
            'type' => 'dropdown',
            'heading' => __( 'Video Location', 'progressive' ),
            'param_name' => 'video_location',
            'admin_label' => true,
            'description' => __( 'Location of the video: youtube, vimeo, external url.'),
            'value' => array(
              'Select' => '',
              'Youtube' => 'youtube',
              'Vimeo' => 'vimeo',
              'External' => 'external'
            ),
            'dependency' => array(
              'element' => 'type',
              'value' => array( 'video' ),
            ),
          ),
          array(
            'type' => 'attach_image',
            'heading' => __( 'Poster Image', 'progressive' ),
            'param_name' => 'poster_image',
            'admin_label' => true,
            'description' => __( 'Poster image for masthead video' ),
            'dependency' => array(
              'element' => 'type',
              'value' => array( 'video' ),
            ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Youtube Video ID', 'progressive' ),
            'param_name' => 'youtube_id',
            'admin_label' => true,
            'description' => __( 'Youtube video ID. The content after v= in the URL: v=MKXK8xwYDIA'),
            'dependency' => array(
              'element' => 'video_location',
              'value' => array( 'youtube' ),
            ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Vimeo Video ID', 'progressive' ),
            'param_name' => 'vimeo_id',
            'admin_label' => true,
            'description' => __( 'Vimeo video ID'),
            'dependency' => array(
              'element' => 'video_location',
              'value' => array( 'vimeo' ),
            ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'External video URL.', 'progressive' ),
            'param_name' => 'video_url',
            'admin_label' => true,
            'dependency' => array(
              'element' => 'video_location',
              'value' => array( 'external' ),
            ),
          ),
          array(
            'type' => 'dropdown',
            'heading' => __( 'External video type.', 'progressive' ),
            'param_name' => 'video_type',
            'value' => array(
              'Select' => '',
              'MP4' => 'video/mp4',
              'WEBM' => 'video/webm',
              'OGV' => 'video/ogg'
            ),
            'dependency' => array(
              'element' => 'video_location',
              'value' => array( 'external', 'media_library' ),
            ),
          ),
          array(
            'type' => 'attach_image',
            'heading' => __( 'Background Image', 'progressive' ),
            'param_name' => 'background_image',
            'admin_label' => true,
            'description' => __( 'Background image for masthead'),
            'dependency' => array(
              'element' => 'type',
              'value' => array( 'image' ),
            ),
          ),
          array(
            'type' => 'dropdown',
            'heading' => __( 'Background Image Location', 'progressive' ),
            'param_name' => 'background_image_location',
            'admin_label' => true,
            'description' => __( 'Background image location for masthead'),
            'dependency' => array(
              'element' => 'type',
              'value' => array( 'image' ),
            ),
            'value' => array(
              "Select" => '',
              "Left Top" => "",
              "Left Center" => "left center",
              "Left Bottom" => "left bottom",
              "Right Top" => "right top",
              "Right Center" => "right center",
              "Right Bottom" => "right bottom",
              "Center Top" => "center top",
              "Center Center" => "center center",
              "Center Bottom" => "center bottom"
            ),
          ),
          array(
            'type' => 'dropdown',
            'heading' => __('Enable Overlay', 'upb_parallax'),
            'param_name' => 'enable_overlay',
            'admin_label' => true,
            'value' => array(
              'No' => 'no',
              'Yes' => 'yes'
            ),
            'edit_field_class' => 'uvc-divider last-uvc-divider vc_column vc_col-sm-12',
          ),
          array(
            'type' => 'dropdown',
            'heading' => __( 'Background Color', 'progressive' ),
            'param_name' => 'background_color',
            'admin_label' => true,
            'description' => __( 'Background color for masthead'),
            'dependency' => array(
              'element' => 'type',
              'value' => array( 'color' ),
            ),
            'value' => array(
              'Select' => '',
              "Primary" => "primary",
              "Secondary" => "secondary",
              "Tertiary" => "tertiary",
              "Accent" => "accent",
              "Accent Dark" => "accent-dark",
              "Light" => "light",
              "Tint" => "tint",
              "Custom" => "custom",
            ),
          ),
          array(
          'type' => 'colorpicker',
          'heading' => __( 'Custom Background Color', 'progressive' ),
          'param_name' => 'background_color_custom',
          'description' => __( 'Custom color for the masthead background.'),
          'dependency' => array(
            'element' => 'background_color',
            'value' => array( 'custom' ),
          ),
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
     <section class="masthead  masthead--inner  masthead--implants">
      <div class="masthead__container">
        <div class="container">
          <i class="masthead__icon  icon  icon--37"></i>
          <h1 class="masthead__title">Teeth in a Day</h1>
          <a href="/contact-us" class="btn  btn--primary  btn--rounded">schedule an appointment</a>
        </div>
      </div>
    </section>
    <!--<div class="container">
              <div class="row">
                <div class="col-md-6  col-sm-10">
                  <h1 class="masthead__title">Committed to Excellence in Periodontics and Dental Implants</h1>
                  <a href="" class="btn  btn--primary  btn--rounded">Schedule an Appointment</a>
                  <a href="" class="btn  btn--primary  btn--ghost  btn--rounded">Watch Video</a>
                </div>
              </div>
            </div>-->
     */
    public function render_masthead_shortcodes( $atts, $content = null ) {

      extract(shortcode_atts(array(
        'location' => '',
        'background_image' => '',
        'background_image_location' => '',
        'type' => '',
        'poster_image' => '',
        'youtube_id' => '',
        'vimeo_id' => '',
        'video_url' => '',
        'video_type' => '',
        'enable_overlay' => '',
        'video_location' => ''
      ), $atts ));

      if( $background_image )
        $inline_css = 'style="background-image: url(' . wp_get_attachment_url( $background_image ) . '); background-position: ' . $background_image_location . ';"';

      $overlay = ( $enable_overlay == 'yes' ? '  masthead--overlay' : '' );

      if( $poster_image && $type == 'video' && $video_location == 'youtube' )
        $inline_css = 'style="background-image: url(' . wp_get_attachment_url( $poster_image ) . ');"';

      $ret = '';
      $ret .= '
        <section class="masthead  masthead--' . $location . $overlay . '" ' . ( $inline_css ? $inline_css : '' ) . '>';
      if( $type == 'video' ) :

        $ret .= '

      <div class="section__video-wrap">
          <video poster="' . wp_get_attachment_url( $poster_image ) . '" preload="auto" loop="" autoplay="" muted="">
              <source src="' . $video_url . '" type="video/mp4">
            </video>
            </div>
      ';
      endif;

        $ret .= '
          <div class="masthead__container">
            <div class="container">
            ';
              $ret .= do_shortcode( $content );
              $ret .= '
            </div>
          </div>
        </section>
      ';
      return $ret;
    }
  }
  new PD_Masthead();
}


/**
 * Loads the fixes that makes Carousel Anything work.
 *
 * @return  void
 * @since 1.5
 */
function masthead_row_fixes() {

  $create_class = false;

  /**
   * We need to define this so that VC will show our nesting container correctly.
   */
  if ( class_exists( 'WPBakeryShortCodesContainer' ) && ! class_exists( 'WPBakeryShortCode_Pd_Masthead' ) ) {
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
    if ( class_exists( 'WPBakeryShortCodesContainer' ) && ! class_exists( 'WPBakeryShortCode_Pd_Masthead' ) ) {
      $create_class = true;
    }
  }

  if ( $create_class ) {

    /**
     * Defines a subclass of the shortcodes container, for modifed Visual Composer modules.
     *
     * @package carousel-anything
     * @class WPBakeryShortCode_Pd_Masthead
     */
    class WPBakeryShortCode_Pd_Masthead extends WPBakeryShortCodesContainer {
    }
  }
}
