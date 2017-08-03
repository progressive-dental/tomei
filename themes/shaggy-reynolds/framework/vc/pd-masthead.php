<?php
/**
 * Turn any Visual Composer element into a carousel element.
 *
 * @package Carousel Anything for VC
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly.

if ( ! class_exists( 'PD_Masthead' ) ) {

  /**
   * Sorry, but that doesn't include your kitchen sink.
   */
  class PD_Masthead {

    /**
     * Sets a unique identifier of each Masthead.
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
     * Creates the masthead element inside VC.
     *
     * @return  void
     * @since 1.0
     */
    public function create_masthead_shortcodes() {
      if ( ! function_exists( 'vc_map' ) ) {
        return; // Check if visual composer is active
      }

      // set default content added when applied to page
      $default_content = '[vc_row_inner][vc_column_inner][/vc_column_inner][/vc_row_inner]';
      if ( vc_is_frontend_editor() ) {
        $default_content = '';
      }

      // Loads fixes that makes masthead possible.
      masthead_row_fixes();

      vc_map( array(
        'name' => __( 'Page Masthead', 'progressive' ),
        'base' => 'pd_masthead',
        'icon' => FRAMEWORK_WEB_ROOT . '/assets/images/icons/masthead.svg',
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
            'description' => __( 'Text location for content inside masthead'),
            'admin_label' => true,
            'value' => array(
              'Select' => '',
              "Inner" => "inner",
              "Home" => "home",
            ),
          ),
          array(
            'type' => 'dropdown',
            'heading' => __( 'Text Location', 'progressive' ),
            'param_name' => 'text_location',
            'description' => __( 'Masthead page location on the site.'),
            'admin_label' => true,
            'value' => array(
              'Default' => '',
              'Left' => 'text-left',
              "Center" => "text-center",
              "Right" => "text-right",
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
            'heading' => __( 'Type', 'progressive' ),
            'param_name' => 'type',
            'admin_label' => true,
            'group' => 'Background',
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
            'group' => 'Background',
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
            'group' => 'Background',
            'admin_label' => true,
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
            'group' => 'Background',
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
            'group' => 'Background',
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
            'group' => 'Background',
            'dependency' => array(
              'element' => 'video_location',
              'value' => array( 'external' ),
            ),
          ),
          array(
            'type' => 'dropdown',
            'heading' => __( 'External video type.', 'progressive' ),
            'param_name' => 'video_type',
            'group' => 'Background',
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
            'group' => 'Background',
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
            'group' => 'Background',
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
            'heading' => __( 'Background Color', 'progressive' ),
            'param_name' => 'background_color',
            'admin_label' => true,
            'group' => 'Background',
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
            'group' => 'Background',
            'dependency' => array(
              'element' => 'background_color',
              'value' => array( 'custom' ),
            ),
          ),
          array(
            'type' => 'checkbox',
            'heading' => __( 'Enable Promo', 'progressive' ),
            'param_name' => 'enable_promo',
            'group' => 'Promo',
            'value' => array(
              "Yes" => "true"
            ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Promo Text', 'progressive' ),
            'param_name' => 'promo_text',
            'group' => 'Promo',
            'dependency' => array(
              'element' => 'enable_promo',
              'value' => array( 'true' ),
            ),
          ),
          array(
            'type' => 'textfield',
            'heading' => __( 'Promo Link Text', 'progressive' ),
            'param_name' => 'promo_link_text',
            'group' => 'Promo',
            'dependency' => array(
              'element' => 'enable_promo',
              'value' => array( 'true' ),
            ),
          ),
          array(
            'type' => 'vc_link',
            'heading' => __( 'Promo Link?', 'progressive' ),
            'param_name' => 'promo_link',
            'group' => 'Promo',
            'dependency' => array(
              'element' => 'enable_promo',
              'value' => array( 'true' ),
            ),
          )
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
    public function render_masthead_shortcodes( $atts, $content = null ) {
      global $progressive;
      extract(shortcode_atts(array(
        'location' => '',
        'background_image' => '',
        'background_image_location' => '',
        'type' => '',
        'poster_image' => '',
        'poster_image_mobile_video' => '',
        'youtube_id' => '',
        'vimeo_id' => '',
        'video_url' => '',
        'video_type' => '',
        'enable_overlay' => '',
        'video_location' => '',
        'text_location' => '',
        'enable_promo' => '',
        'promo_text' => '',
        'promo_link' => '',
        'promo_link_text' => ''
      ), $atts ));

      $inline_css = '';
      if( $background_image ) {
        $inline_css = 'style="background-image: url(' . wp_get_attachment_url( $background_image ) . '); background-position: ' . $background_image_location . ';"';
      }

      $overlay = ( $enable_overlay == 'yes' ? '  masthead--overlay' : '' );

      if( $poster_image && $type == 'video' && $video_location == 'youtube' ) {
        $inline_css = 'style="background-image: url(' . wp_get_attachment_url( $poster_image ) . ');"';
      }

      $ret = '';

      $ret .= '<section class="masthead' . $overlay . '">';

      if( $background_image ) {
        $ret .= '<div class="masthead__image" ' . ( $inline_css ? $inline_css : '' ) . '></div>';
      }


      if( $type == 'video' ) :
        $ret .= '
          <div class="section__video-wrap">
            <video poster="' . wp_get_attachment_url( $poster_image ) . '" preload="auto" loop="" autoplay="" muted="" data-src="' . $video_url . '" data-type="' . $video_type . '">
            </video>
          </div>
        ';
        $inline_css = 'style="background-image: url(' . wp_get_attachment_url( $poster_image ) . ');"';
        $ret .= '<div class="masthead__image  masthead__image--mobile-video ' . $overlay . '" ' . ( $inline_css ? $inline_css : '' ) . '></div>';
      endif;



      $ret .= '
        <div class="masthead__content">
          <div class="container">
          ';
            $ret .= do_shortcode( $content );
            $ret .= '
          </div>
        </div>';

        if( "true" == $enable_promo && $progressive['disable-promo'] != "1" ) {
          $promo_link = vc_build_link( $promo_link );
          $ret .= '<div class="masthead__banner"><a href="' . ( $enable_promo ? $promo_link['url'] : $progressive['promo-link'] ) . '" class="text-uppercase">' . ( $enable_promo ? $promo_text : $progressive['promo-text'] ) . " " . ( $enable_promo ? $promo_link_text : $progressive['promo-link-text'] ) . '</a></div>';
        }

      $ret .= '</section>';

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
