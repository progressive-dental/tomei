<?php
add_action( 'vc_before_init', 'parallax_init' );
add_filter( 'parallax_image_video_new' , 'parallax_shortcode', 10, 3);



function parallax_init() {
  $group_name = "Background";
  $group_effects = 'Effect';

  if( function_exists('vc_add_params')) {
    $section_atts = array(
      array(
        'type' => 'dropdown',
        'heading' => __( 'Text Location', 'progressive' ),
        'param_name' => 'text_location',
        'admin_label' => true,
        'edit_field_class' => 'vc_col-sm-6',
        'value' => array(
          'Default' => '',
          'Left' => 'text-left',
          "Center" => "text-center",
          "Right" => "text-right",
        ),
      ),
      array(
        "type" => "dropdown",
        "class" => "",
        "heading" => "Padding type",
        'admin_label' => true,
        "param_name" => "padding",
        'edit_field_class' => 'vc_col-sm-6',
        "value" => array(
          "Default" => "",
          "Small" => "section--small",
          "Large" => "section--large",
          "CTA" => "section--cta",
          "Small Padding Bottom" => "section--smallbot",
          "No Padding Bottom" => "section--nobot",
          "None" => "section--nopad",
        )
      ),
      array(
        "type" => "dropdown",
        "class" => "",
        "heading" => "Use section tag",
        "param_name" => "section_tag",
        "value" => array(
          "Yes" => "yes",
          "No" => "no",
        )
      ),
      array(
        "type" => "dropdown",
        "class" => "",
        "admin_label" => true,
        "heading" => __( "Background Style", "progressive" ),
        "param_name" => "bg_type",
        "value" => array(
          __( "Default", "progressive" ) => "no_bg",
          __( "Single Color", "progressive") => "bg_color",
          __( "Image / Parallax", "progressive" ) => "image",
          __( "Image / Parallax w/Pattern", "progressive" ) => "image_pattern",
          __( "Youtube Video", "progressive" ) => "youtube",
          __( "Hosted Video", "progressive" ) => "video",
          __( "Pattern BG", "progressive" ) => "pattern"
        ),
        "group" => $group_name,
      ),
      array(
        'type' => 'counter',
        'heading' => __( 'Background Opacity', 'progressive' ),
        'param_name' => 'opacity_counter',
        "group" => $group_name,
        "dependency" => array( "element" => "bg_type", "value" => array( "image_pattern" ) ),
      ),
      array(
        "type" => "dropdown",
        "class" => "",
        "group" => $group_name,
        "heading" => "Pattern BG Color",
        'admin_label' => true,
        "param_name" => "pattern_bg_color",
        "dependency" => array( "element" => "enable_pattern", "value" => array( "true" ) ),
        "value" => array(
          "Default" => "",
          "Primary" => "bg-primary",
          "Secondary" => "bg-secondary",
          "Tertiary" => "bg-tertiary",
          "Accent" => "bg-accent",
          "Light" => "bg-light",
          "Tint" => "bg-tint",
          "Custom" => "bg-custom"
        )
      ),
      array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __( "Pattern Custom Background Color", "progressive" ),
        "param_name" => "pattern_bg_value", 
        "dependency" => array( "element" => "pattern_bg_color", "value" => array( "custom" ) ),
        "group" => $group_name,
      ),
      array(
        "type" => "dropdown",
        "class" => "",
        "group" => $group_name,
        "heading" => "Background Class/Color",
        'admin_label' => true,
        "param_name" => "bg_class",
        "dependency" => array( "element" => "bg_type", "value" => array( "bg_color" ) ),
        "value" => array(
          "Default" => "",
          "Primary" => "bg-primary",
          "Secondary" => "bg-secondary",
          "Tertiary" => "bg-tertiary",
          "Accent" => "bg-accent",
          "Light" => "bg-light",
          "Tint" => "bg-tint",
          "Custom" => "bg-custom"
        )
      ),
      array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __( "Background Color", "progressive" ),
        "param_name" => "bg_color_value", 
        "dependency" => array( "element" => "bg_class", "value" => array( "custom" ) ),
        "group" => $group_name,
      ),
      array(
        "type" => "attach_image",
        "class" => "",
        "heading" => __( "Background Image", "progressive" ),
        "param_name" => "bg_image_new",
        "value" => "",
        "description" => __( "Upload or select background image from media gallery.", "progressive" ),
        "dependency" => array( "element" => "bg_type", "value" => array( "image", "image_pattern" ) ),
        "group" => $group_name,
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Background Image Location', 'progressive' ),
        'param_name' => 'background_image_location',
        'admin_label' => true,
        'description' => __( 'Background image location for masthead'),
        "group" => $group_name,
        "dependency" => array( "element" => "bg_type", "value" => array( "image", "image_pattern" ) ),
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
        "type" => "dropdown",
        "class" => "",
        "heading" => __( "Scroll Effect", "upb_parallax" ),
        "param_name" => "bg_img_attach",
        "value" => array(
            __( "Move with the content", "upb_parallax" ) => "scroll",
            __( "Fixed at its position", "upb_parallax" ) => "fixed",
          ),
        "description" => __( "Options to set whether a background image is fixed or scroll with the rest of the page.", "upb_parallax" ),
        "dependency" => array( "element" => "bg_type", "value" => array( "image", "image_pattern" ) ),
        "group" => $group_name,
      ),
      array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __( "Animation Direction", "upb_parallax" ),
        "param_name" => "animation_direction",
        "value" => array(
            __( "Left to Right", "upb_parallax" ) => "left-animation",
            __( "Right to Left", "upb_parallax" ) => "right-animation",
            __( "Top to Bottom", "upb_parallax" ) => "top-animation",
            __( "Bottom to Top", "upb_parallax" ) => "bottom-animation",

          ),
        "dependency" => array( "element" => "bg_type", "value" => array( "image", "image_pattern" ) ),
        "group" => $group_name,
      ),
      array(
        "type" => "textfield",
        "class" => "",
        "heading" => __( "Link to the video in MP4 Format", "upb_parallax" ),
        "param_name" => "video_url",
        "value" => "",
        "dependency" => Array( "element" => "bg_type", "value" => array( "video" ) ),
        "group" => $group_name,
      ),
      array(
        "type" => "textfield",
        "class" => "",
        "heading" => __( "Link to the video in WebM / Ogg Format", "upb_parallax" ),
        "param_name" => "video_url_2",
        "value" => "",
        "description" => __( "IE, Chrome & Safari <a href='http://www.w3schools.com/html/html5_video.asp' target='_blank'>support</a> MP4 format, while Firefox & Opera prefer WebM / Ogg formats. You can upload the video through <a href='".home_url()."/wp-admin/media-new.php' target='_blank'>WordPress Media Library</a>.", "upb_parallax" ),
        "dependency" => Array( "element" => "bg_type", "value" => array( "video" ) ),
        "group" => $group_name,
      ),
      array(
        "type" => "textfield",
        "class" => "",
        "heading" => __( "Enter YouTube URL of the Video", "upb_parallax" ),
        "param_name" => "u_video_url",
        "value" => "",
        "description" => __( "Enter YouTube url. Example - YouTube (https://www.youtube.com/watch?v=tSqJIIcxKZM) ", "upb_parallax" ),
        "dependency" => Array( "element" => "bg_type", "value" => array( "youtube" ) ),
        "group" => $group_name,
      ),
      array(
        "type" => "checkbox",
        "class" => "",
        "heading" => __( "Extra Options", "upb_parallax" ),
        "param_name" => "video_opts",
        "value" => array(
            __( "Loop","upb_parallax" ) => "loop",
            __( "Muted","upb_parallax" ) => "muted",
          ),
        "dependency" => Array( "element" => "bg_type", "value" => array( "video", "youtube" ) ),
        "group" => $group_name,
      ),
      array(
        "type" => "attach_image",
        "class" => "",
        "heading" => __( "Placeholder Image", "upb_parallax" ),
        "param_name" => "video_poster",
        "value" => "",
        "description" => __( "Placeholder image is displayed in case background videos are restricted (Ex - on iOS devices).", "upb_parallax" ),
        "dependency" => Array( "element" => "bg_type", "value" => array( "video", "youtube" ) ),
        "group" => $group_name,
      ),

      array(
        'type' => 'dropdown',
        'heading' => __('Enable Overlay', 'upb_parallax'),
        'param_name' => 'enable_overlay',
        'value' => array(
          'No' => 'no',
          'Yes' => 'yes'
        ),
        'edit_field_class' => 'uvc-divider last-uvc-divider vc_column vc_col-sm-12',
        'group' => $group_name,
      ),
      array(
        'type' => 'colorpicker',
        'heading' => __( 'Color', 'upb_parallax' ),
        'param_name' => 'overlay_color',
        'value' => '',
        'group' => $group_effects,
        'dependency' => Array( 'element' => 'enable_overlay', 'value' => array( 'enable_overlay_value' ) ),
        'description' => __( 'Select RGBA values or opacity will be set to 20% by default.', 'upb_parallax' )
      )
    );

    vc_add_params( 'vc_section', $section_atts ); 
  }
}


// if ( !function_exists( 'vc_theme_before_vc_row' ) ) {
//   function vc_theme_before_vc_section($atts, $content = null) {
//     return apply_filters( 'parallax_image_video_new', '', $atts, $content );
//   }
// }