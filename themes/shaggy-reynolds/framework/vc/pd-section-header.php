<?php

add_shortcode( 'pd_section_header', 'pd_section_header_func' );
add_action( 'vc_before_init', 'progressive_map_section_header' );

function progressive_map_section_header() {
  if (function_exists('vc_map')) {

    $icons = array( "None" => "none" );
    for($x = 1; $x <= 130; $x++) {
      $icons["Icon " . $x] = $x;
    }

    vc_map( array(
      'name' => __( 'Section Header', 'js_composer' ),
      'is_container' => true,
      'base' => 'pd_section_header',
      'icon' => THEME_WEB_ROOT . '/assets/images/pd-logo.png',
      'show_settings_on_create' => true,
      'category' => __( 'Content', 'progressive' ),
      'params' => array(
        array(
          "type" => "dropdown",
          "class" => "",
          "heading" => "Heading position",
          "param_name" => "heading_position",
          "group" => "Heading",
          "value" => array(
            "" => "",
            "Center" => "headline--center",
          )
        ),
        array(
          "type" => "textfield",
          "heading" => __( "Header Text", "progressive" ),
          "param_name" => "text",
          'admin_label' => true,
          "group" => "Heading",
        ),
        array(
          "type" => "dropdown",
          "class" => "",
          "heading" => "Tag",
          'admin_label' => true,
          "param_name" => "type",
          "group" => "Heading",
          "value" => array(
            "" => "",
            "H2" => "h2",
            "H1" => "h1",
            "H3" => "h3",
            "H4" => "h4",
            "H5" => "h5",
            "H6" => "h6"
          )
        ),
        array(
          "type" => "dropdown",
          "class" => "",
          "heading" => "Change heading color?",
          "param_name" => "heading_color",
          "group" => "Heading",
          "value" => array(
            "" => "",
            "Primary" => "text-primary",
            "Secondary" => "text-secondary",
            "Tertiary" => "text-tertiary",
            "Light" => "text-light",
            "Accent" => "text-accent",
            "Hightlight" => "text-highlight",
            "Custom 1" => "text-custom-one",
            "Custom 2" => "text-custom-two",
            "Custom 3" => "text-custom-three"
          ),
        ),
        array(
          "type" => "dropdown",
          "class" => "",
          "heading" => "Has sub headline copy?",
          "group" => "Sub Heading",
          'admin_label' => true,
          "param_name" => "enable_sub",
          "value" => array(
            "No" => "no",
            "Yes" => "yes"
          )
        ),
        array(
          'type' => 'dropdown',
          'heading' => 'Text align',
          'param_name' => 'align_text',
          'group' => 'Sub Heading',
          "value" => array(
            "Default" => "",
            "Center" => "text-center",
            "Left" => "text-left",
            "Right" => "text-right"
          )
        ),
        array(
          'type' => 'dropdown',
          'heading' => 'Font size?',
          'description' => __( 'Change font size from default.', 'js_composer' ),
          'param_name' => 'font_size',
          'group' => 'Sub Heading',
          "value" => array(
            "Default" => "",
            "Large" => "text-large",
          )
        ),
        array(
          "type" => "dropdown",
          "class" => "",
          "heading" => "Change strong tag color?",
          'group' => 'Sub Heading',
          "param_name" => "strong_tag_color",
          "value" => array(
            "Select Color" => "",
            "Primary" => "text-primary",
            "Secondary" => "text-secondary",
            "Tertiary" => "text-tertiary",
            "Light" => "text-light",
            "Accent" => "text-accent",
            "Hightlight" => "text-highlight",
            "Custom 1" => "text-custom-one",
            "Custom 2" => "text-custom-two",
            "Custom 3" => "text-custom-three"
          ),
        ),
        array(
          'type' => 'textarea_html',
          'heading' => __( 'Sub Headline Content', 'progressive' ),
          'param_name' => 'content',
          'group' => __( 'Sub Heading', 'progressive' ),
          'dependency' => array(
            'element' => 'enable_sub',
            'value' => array( 'yes' ),
          ),
        ),
        array(
          "type" => "textfield",
          "heading" => "Extra classes",
          "param_name" => "classes",
          "group" => "Heading",
          'admin_label' => true,
        ),
    
      )
    ) );

  }
}


function pd_section_header_func( $atts, $content = null ) {
  extract(shortcode_atts(array(
      'text' => '',
      'type' => '',
      "heading_color" => '',
      'classes' => '',
      'enable_sub' => '',
      'inner_content' => '',
      'heading_position' => '',
      'strong_tag_color' => '',
      'font_size' => '',
      'align_text' => ''
  ), $atts ));
  ob_start(); 

  $strong_pattern = "/(<strong)/";
  $strong_replace = '<strong class="' . $strong_tag_color . '"';

  $classes = array(
    'headline__main  headline__underline',
    $classes,
    $heading_color
  );

  $classes = implode( "  ", array_filter( $classes ) );
  ?>
  
  <div class="headline<?php echo ( !empty( $heading_position ) ? ' ' . $heading_position : '' ); ?>">
    <<?php echo $type; ?><?php echo ( !empty( $classes ) ? ' class="' . $classes . '"' : '' ); ?>><?php echo $text; ?></<?php echo $type; ?>>

    <?php if($enable_sub == "yes") : ?>
      <?php if( !empty( $font_size || !empty( $align_text ) ) ) {
        $classes = array(
          $font_size,
          $align_text
        );
        $classes = implode( "  ", array_filter( $classes ) );
        $pattern = "/(<p)/";
        $replace = '<p class="' . $classes . '"';

        if( !empty( $strong_tag_color ) ) {
          $strong_replace = '<strong class="' . $strong_tag_color . '"';
          echo preg_replace( $strong_pattern, $strong_replace, preg_replace( $pattern, $replace, wpb_js_remove_wpautop ( $content, true ) ) );
        } else {
          echo preg_replace( $pattern, $replace, wpb_js_remove_wpautop ( $content, true ) );
        }
      } else {
        if( !empty( $strong_tag_color ) ) {
          $strong_replace = '<strong class="' . $strong_tag_color . '"';
          echo preg_replace( $strong_pattern, $strong_replace, wpb_js_remove_wpautop( $content, true ) );
        } else {
          echo wpb_js_remove_wpautop( $content, true );
        }
      }

      ?>
    <?php endif; ?>
  </div>
  
   

  <?php
  $output = ob_get_clean();
  return $output;
}