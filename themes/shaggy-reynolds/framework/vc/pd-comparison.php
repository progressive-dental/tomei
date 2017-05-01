<?php
add_shortcode( 'pd_comparison', 'pd_comparison_func' );
add_action( 'vc_before_init', 'progressive_map_comparison' );

function progressive_map_comparison() {
  if (function_exists('vc_map')) {
    vc_map( array(
      'name' => __( 'Before & After', 'progressive' ),
      'base' => 'pd_comparison',
      'icon' => THEME_WEB_ROOT . '/assets/images/pd-logo.png',
      'description' => __( 'A before and after box.', 'progressive' ),
      'category' => __( 'Content', 'progressive' ),
      'params' => array(
        array(
          'type' => 'attach_image',
          'heading' => __( 'Before Image', 'progressive' ),
          'param_name' => 'image_before',
          'description' => __( 'Image for before. Please crop to 16x9 before uploading'),
          'group' => __( 'Header Content', 'progressive' ),
        ),
        array(
          'type' => 'attach_image',
          'heading' => __( 'After Image', 'progressive' ),
          'param_name' => 'image_after',
          'description' => __( 'Image for after. Please crop to 16x9 before uploading'),
          'group' => __( 'Header Content', 'progressive' ),
        ),
      )
    ));
  }
}

function pd_comparison_func( $atts, $content = null ) {
  extract(shortcode_atts(array(
      'before_image' => '',
      'after_image' => ''
  ), $atts ));

  return get_card_header( 'comparison', $atts );
}