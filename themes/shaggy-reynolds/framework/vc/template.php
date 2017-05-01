<?php
add_shortcode( 'pd_card', 'pd_counters_func' );
add_action( 'vc_before_init', 'progressive_map_counters' );

function progressive_map_counters() {
  if (function_exists('vc_map')) {
    vc_map( array(
      'name' => __( 'Card', 'progressive' ),
      'base' => 'pd_card',
      'icon' => THEME_WEB_ROOT . '/assets/images/pd-logo.png',
      'description' => __( 'A card for progressive dental layouts.', 'progressive' ),
      'category' => __( 'Progressive', 'progressive' ),
      'params' => array(
        array(
          'type' => 'dropdown',
          'heading' => __( 'Card Media', 'progressive' ),
          'group' => __( 'Header Content', 'progressive' ),
          'param_name' => 'media',
          'description' => __( 'What type of media would you like to display in the card header?', 'progressive' ),
          'value' => array(
            "Select type" => "",
            "Image" => "image",
            "Video" => "video",
            "Before & After" => "comparison"
          ),
        ),
        array(
          'type' => 'attach_image',
          'heading' => __( 'Header Image', 'progressive' ),
          'param_name' => 'image',
          'description' => __( 'Image to display. Please crop to 16x9 before uploading'),
          'group' => __( 'Header Content', 'progressive' ),
          'dependency' => array(
            'element' => 'media',
            'value' => array( 'image' ),
          ),
        ),
      )
    ) );
  }
}

function pd_counters( $atts, $content = null ) {
  extract(shortcode_atts(array(
      'image' => '',
      'align' => '',
      'reverse' => ''
  ), $atts ));

  ob_start(); ?>

  <?php
  $output = ob_get_clean();
  return $output;
}