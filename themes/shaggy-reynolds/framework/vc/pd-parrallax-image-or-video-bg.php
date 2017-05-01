<?php
add_action( 'vc_before_init', 'parallax_init' );
add_filter( 'parallax_image_video_new' , 'parallax_shortcode', 10, 3);



function parallax_init() {
  $group_name = "Background";
  $group_effects = 'Effect';

  if( function_exists('vc_add_params')) {
    $section_atts = array(
      array(
        "type" => "dropdown",
        "class" => "",
        "group" => $group_name,
        "heading" => "Padding type",
        'admin_label' => true,
        "param_name" => "padding",
        "value" => array(
          "Default" => "",
          "Small" => "section--small",
          "Large" => "section--large",
          "CTA" => "section--cta",
          "None" => "section--nopad",
        )
      ),
      array(
        "type" => "dropdown",
        "class" => "",
        "group" => $group_name,
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
          __( "Youtube Video", "progressive" ) => "youtube",
          __( "Hosted Video", "progressive" ) => "video",
        ),
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
          "Primary" => "primary-bg",
          "Secondary" => "secondary-bg",
          "Tertiary" => "tertiary-bg",
          "Accent" => "accent-bg",
          "Light" => "light-bg",
          "Tint" => "tint-bg",
          "Custom" => "custom"
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
        "type" => "dropdown",
        "class" => "",
        "heading" => __( "Parallax Style","progressive" ),
        "param_name" => "parallax_style",
        "value" => array(
          __( "Simple Background Image", "progressive" ) => "vcpb-default",
          __( "Auto Moving Background", "progressive" ) => "vcpb-animated",
          __( "Vertical Parallax On Scroll", "progressive" ) => "vcpb-vz-jquery",
          __( "Horizontal Parallax On Scroll", "progressive" ) => "vcpb-hz-jquery",
        ),
        "description" => __( "Select the kind of style you like for the background.", "progressive" ),
        "dependency" => array( "element" => "bg_type", "value" => array( "image" ) ),
        "group" => $group_name,
      ),
      array(
        "type" => "attach_image",
        "class" => "",
        "heading" => __( "Background Image", "progressive" ),
        "param_name" => "bg_image_new",
        "value" => "",
        "description" => __( "Upload or select background image from media gallery.", "progressive" ),
        "dependency" => array( "element" => "parallax_style", "value" => array( "vcpb-default", "vcpb-animated", "vcpb-vz-jquery", "vcpb-hz-jquery" ) ),
        "group" => $group_name,
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
        "dependency" => Array( "element" => "parallax_style", "value" => array( "vcpb-default", "vcpb-animated", "vcpb-hz-jquery", "vcpb-vz-jquery" ) ),
        "group" => $group_name,
      ),
      // array(
      //   "type" => "number",
      //   "class" => "",
      //   "heading" => __( "Parallax Speed", "upb_parallax" ),
      //   "param_name" => "parallax_sense",
      //   "value" =>"30",
      //   "min"=>"1",
      //   "max"=>"100",
      //   "description" => __( "Control speed of parallax. Enter value between 1 to 100", "upb_parallax" ),
      //   "dependency" => Array( "element" => "parallax_style", "value" => array( "vcpb-vz-jquery", "vcpb-animated", "vcpb-hz-jquery", "vcpb-vs-jquery", "vcpb-hs-jquery", "vcpb-fs-jquery", "vcpb-mlvp-jquery" ) ),
      //   "group" => $group_name,
      // ),
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
        "dependency" => Array( "element" => "parallax_style", "value" => array( "vcpb-animated" ) ),
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
      // array(
      //   "type" => "ult_switch",
      //   "class" => "",
      //   "heading" => __( "Play video only when in viewport", "upb_parallax" ),
      //   "param_name" => "viewport_vdo",
      //   "value" => "",
      //   "options" => array(
      //       "viewport_play" => array(
      //         "label" => "",
      //         "on" => "Yes",
      //         "off" => "No",
      //       )
      //     ),
      //   "description" => __( "Video will be played only when user is on the particular screen position. Once user scroll away, the video will pause.", "upb_parallax" ),
      //   "dependency" => Array( "element" => "bg_type", "value" => array( "video", "youtube" ) ),
      //   "group" => $group_name,
      // ),
      // array(
      //   "type" => "ult_switch",
      //   "class" => "",
      //   "heading" => __("Activate on Mobile", "upb_parallax"),
      //   "param_name" => "disable_on_mobile_img_parallax",
      //   //"admin_label" => true,
      //   "value" => "",
      //   "options" => array(
      //       "disable_on_mobile_img_parallax_value" => array(
      //         "label" => "",
      //         "on" => "Yes",
      //         "off" => "No",
      //       )
      //     ),
      //   "group" => $group_name,
      //   "dependency" => Array("element" => "parallax_style","value" => array("vcpb-animated","vcpb-vz-jquery","vcpb-hz-jquery","vcpb-fs-jquery","vcpb-mlvp-jquery")),
      // ),
      // array(
      //   "type" => "ult_switch",
      //   "class" => "",
      //   "heading" => __( "Easy Parallax", "upb_parallax" ),
      //   "param_name" => "parallax_content",
      //   //"admin_label" => true,
      //   "value" => "",
      //   "options" => array(
      //       "parallax_content_value" => array(
      //         "label" => "",
      //         "on" => "Yes",
      //         "off" => "No",
      //       )
      //     ),
      //   "group" => $group_effects,
      //   'edit_field_class' => 'uvc-divider last-uvc-divider vc_column vc_col-sm-12',
      //   "description" => __( "If enabled, the elements inside row - will move slowly as user scrolls.", "upb_parallax" )
      // ),
      // array(
      //   "type" => "textfield",
      //   "class" => "",
      //   "heading" => __( "Parallax Speed", "upb_parallax" ),
      //   "param_name" => "parallax_content_sense",
      //   //"admin_label" => true,
      //   "value" => "30",
      //   "group" => $group_effects,
      //   "description" => __( "Enter value between 0 to 100", "upb_parallax" ),
      //   "dependency" => Array( "element" => "parallax_content", "value" => array( "parallax_content_value" ) )
      // ), 
      // array(
      //   "type" => "ult_switch",
      //   "class" => "",
      //   "heading" => __( "Fade Effect on Scroll", "upb_parallax" ),
      //   "param_name" => "fadeout_row",
      //   //"admin_label" => true,
      //   "value" => "",
      //   "options" => array(
      //       "fadeout_row_value" => array(
      //         "label" => "",
      //         "on" => "Yes",
      //         "off" => "No",
      //       )
      //     ),
      //   "group" => $group_effects,
      //   'edit_field_class' => 'uvc-divider last-uvc-divider vc_column vc_col-sm-12',
      //   "description" => __( "If enabled, the the content inside row will fade out slowly as user scrolls down.", "upb_parallax" )
      // ),
      // array(
      //   "type" => "number",
      //   "class" => "",
      //   "heading" => __( "Viewport Position", "upb_parallax" ),
      //   "param_name" => "fadeout_start_effect",
      //   "suffix" => "%",
      //   //"admin_label" => true,
      //   "value" => "30",
      //   "group" => $group_effects,
      //   "description" => __( "The area of screen from top where fade out effect will take effect once the row is completely inside that area.", "upb_parallax" ),
      //   "dependency" => Array( "element" => "fadeout_row", "value" => array( "fadeout_row_value") )
      // ),
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