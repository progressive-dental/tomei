<?php
add_shortcode( 'pd_sponsor', 'pd_sponsor_func' );
add_action( 'vc_before_init', 'progressive_map_sponsor' );

function progressive_map_sponsor() {
  if (!function_exists('vc_map')) {
    return;
  }

  vc_map( array(
    'name' => __( 'Sponsor', 'progressive' ),
    'base' => 'pd_sponsor',
    'icon' => THEME_WEB_ROOT . '/assets/images/pd-logo.png',
    'description' => __( 'Sponsor for sponsor list.', 'progressive' ),
    'as_parent' => array( 'only' => 'pd_sponsors' ),
    'category' => __( 'Content', 'progressive' ),
    'params' => array(
      array(
        'type' => 'attach_image',
        'heading' => __( 'Sponsor Image', 'progressive' ),
        'param_name' => 'image',
        'description' => __( 'Image to display.'),
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Logo Size', 'progressive' ),
        'param_name' => 'size',
        'description' => __( 'Leave blank for default.', 'progressive' ),
        'value' => array(
          "Select type" => "medium",
          "Normal" => "normal",
          "Medium" => "medium"
        ),
      )
    )
  ) );

}

function pd_sponsor_func( $atts, $content = null ) {
  extract(shortcode_atts(array(
      'image' => '',
      'size' => ''
  ), $atts ));

  ob_start(); ?>
    <li class="sponsor-list__item">
      <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="<?php echo wp_get_attachment_url( $image ); ?>" class="sponsor-list__logo  sponsor-list__logo--<?php echo $size; ?>" alt="<?php echo get_post_meta( $image, '_wp_attachment_image_alt', true); ?>">
    </li>
  <?php
  $output = ob_get_clean();
  return $output;
}