<?php
add_shortcode( 'pd_testimonial', 'pd_testimonial_func' );
add_action( 'vc_before_init', 'progressive_map_testimonial' );

function progressive_map_testimonial() {
  if (function_exists('vc_map')) {
    vc_map( array(
      'name' => __( 'Testimonial', 'progressive' ),
      'base' => 'pd_testimonial',
      'icon' => THEME_WEB_ROOT . '/assets/images/pd-logo.png',
      'description' => __( 'A textimonial box for progressive dental layouts.', 'progressive' ),
      'category' => __( 'Content', 'progressive' ),
      'params' => array(
        array(
          'type' => 'textfield',
          'heading' => __( 'Name', 'progressive' ),
          'param_name' => 'name'
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Procedure', 'progressive' ),
          'param_name' => 'procedure'
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Youtube ID', 'progressive' ),
          'param_name' => 'youtube_id'
        ),
        array(
          'type' => 'attach_image',
          'heading' => __( 'Quote Image', 'progressive' ),
          'param_name' => 'image',
          
        ),
      )
    ) );
  }
}

function pd_testimonial_func( $atts, $content = null ) {
  extract(shortcode_atts(array(
      'image' => '',
      'name' => '',
      'procedure' => '',
      'youtube_id' => ''
  ), $atts ));

  ob_start(); ?>
    <div class="testimonial">
      <div class="testimonial__content">
        <a class="testimonial__play" href="https://www.youtube.com/watch?v=<?php echo $youtube_id; ?>"><i class="icon  icon--play"></i></a>
        <div class="testimonial__name"><?php echo $name; ?></div>
        <div class="testimonial__proceedure"><?php echo $procedure; ?></div>
         
      </div>
      <div class="testimonial__image">
        <img src="<?php echo wp_get_attachment_url( $image ); ?>" alt="<?php echo get_post_meta( $image, '_wp_attachment_image_alt', true); ?>">
      </div>
    </div>
    
  <?php
  $output = ob_get_clean();
  return $output;
}