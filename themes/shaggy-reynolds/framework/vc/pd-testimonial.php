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
          'type' => 'textarea_html',
          'heading' => __( 'Quote', 'progressive' ),
          'param_name' => 'content'
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Youtube ID', 'progressive' ),
          'param_name' => 'youtube_id'
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Quote type', 'progressive' ),
          'param_name' => 'media',
          'description' => __( 'What type of media would you like to display in quote box?', 'progressive' ),
          'value' => array(
            "Select type" => "",
            "Image" => "image",
            "Video" => "video"          
          ),
        ),
        array(
          'type' => 'attach_image',
          'heading' => __( 'Quote Image', 'progressive' ),
          'param_name' => 'image',
          'description' => __( 'Image to display. Please crop to 3x2 before uploading'),
          'dependency' => array(
            'element' => 'media',
            'value' => array( 'image' ),
          ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Quote BG', 'progressive' ),
          'param_name' => 'quote_bg',
          'description' => __( 'Class name for the quote background. Handles the color.'),
          'group' => __( 'Display Options', 'progressive' ),
          'value' => array(
            "Select type" => "",
            "Primary" => "primary-bg",
            "Secondary" => "secondary-bg",
            "Tertiary" => "tertiary-bg",
            "Accent" => "accent-bg",
            "Accent Dark" => "accent-dark-bg",
            "Light" => "light-bg",
            "Tint" => "tint-bg",
          ),

        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Container BG', 'progressive' ),
          'param_name' => 'container_bg',
          'description' => __( 'Class name for the container background. Handles the color.'),
          'group' => __( 'Display Options', 'progressive' ),
          'value' => array(
            "Select type" => "",
            "Primary" => "primary-bg",
            "Secondary" => "secondary-bg",
            "Tertiary" => "tertiary-bg",
            "Accent" => "accent-bg",
            "Accent Dark" => "accent-dark-bg",
            "Light" => "light-bg",
            "Tint" => "tint-bg",
          ),

        ),
      )
    ) );
  }
}

function pd_testimonial_func( $atts, $content = null ) {
  extract(shortcode_atts(array(
      'image' => '',
      'media' => '',
      'quote_bg' => '',
      'quote_bg_custom_color' => '',
      'container_bg' => '',
      'container_bg_custom_color' => '',
      'youtube_id' => ''
  ), $atts ));

  ob_start(); ?>

    <div class="box">
      <div class="box__header  box__header--quote<?php echo ( $quote_bg != '' ? '  ' . $quote_bg : '' ); ?>">
        <blockquote><?php echo $content; ?></blockquote>
      </div>
      <div class="box__object   o-crop  o-crop--3:2  <?php echo ( $container_bg != '' ? '  ' . $container_bg : '' ); ?>">
        <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="<?php echo wp_get_attachment_url( $image ); ?>" class="o-crop__content" alt="<?php echo get_post_meta( $image, '_wp_attachment_image_alt', true); ?>">
        <div class="box__play">
          <a href="http://youtube.com/watch?v=<?php echo $youtube_id; ?>" class="js-popup-video"><div class="circle  circle--accent"><i class="icon  icon--play-triangle"></i></div></a>
        </div>
      </div>
    </div>
  <?php
  $output = ob_get_clean();
  return $output;
}