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
          "type" => "textfield",
          "heading" => __( "Header Text", "progressive" ),
          "param_name" => "text",
          'admin_label' => true,
        ),
        array(
          "type" => "dropdown",
          "class" => "",
          "heading" => "Tag",
          'admin_label' => true,
          "param_name" => "type",
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
          "heading" => "Icon",
          "param_name" => "icon",
          "value" => $icons
        ),
        array(
          "type" => "dropdown",
          "class" => "",
          "heading" => "Has sub headline copy?",
          'admin_label' => true,
          "param_name" => "enable_sub",
          "value" => array(
            "No" => "no",
            "Yes" => "yes"
          )
        ),
        array(
          "type" => "textfield",
          "heading" => "Sub Headline Content",
          "param_name" => "inner_content",
          'admin_label' => true,
          'dependency' => array(
            'element' => 'enable_sub',
            'value' => array( 'yes' ),
          ),
        ),
        array(
          "type" => "textfield",
          "heading" => "Extra classes",
          "param_name" => "classes",
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
      "icon" => '',
      'classes' => '',
      'enable_sub' => '',
      'inner_content' => ''
  ), $atts ));
  ob_start(); ?>
  
  <div class="headline">
    <?php if($icon) : ?>
    <i class="section__icon  icon  icon--<?php echo $icon; ?>"></i>
    <?php endif; ?>
    <<?php echo $type; ?> class="headline__main<?php if($classes != '') : echo ' ' . $classes; endif; ?>"><?php echo $text; ?></<?php echo $type; ?>>
    <?php if($enable_sub == "yes") : ?>
    <p class="headline__sub"><?php echo $inner_content; ?></p>
  <?php endif; ?>
  </div>
  
   

  <?php
  $output = ob_get_clean();
  return $output;
}