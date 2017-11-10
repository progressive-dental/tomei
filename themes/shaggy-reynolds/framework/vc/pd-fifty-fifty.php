<?php
add_shortcode( 'pd_fifty_fifty', 'pd_fifty_fifty_func' );
add_action( 'vc_before_init', 'progressive_map_fifty_fifty' );

function progressive_map_fifty_fifty() {
  if (function_exists('vc_map')) {
    vc_map( array(
      'name' => __( 'Fifty Fifty', 'progressive' ),
      'base' => 'pd_fifty_fifty',
      'icon' => THEME_WEB_ROOT . '/assets/images/pd-logo.png',
      'description' => __( 'A horizontal card for progressive dental layouts.', 'progressive' ),
      'category' => __( 'Content', 'progressive' ),
      'params' => array(
        array(
          'type' => 'dropdown',
          'heading' => __( 'Card Media', 'progressive' ),
          'group' => __( 'Media Content', 'progressive' ),
          'param_name' => 'media',
          'description' => __( 'What type of media would you like to display in the card header?', 'progressive' ),
          'value' => array(
            "Select type" => "",
            "Image" => "image",
            "Video" => "video",
          ),
        ),
        array(
          'type' => 'attach_image',
          'heading' => __( 'Header Image', 'progressive' ),
          'param_name' => 'image',
          'description' => __( 'Image to display. Please crop to 16x9 before uploading'),
          'group' => __( 'Media Content', 'progressive' ),
          'dependency' => array(
            'element' => 'media',
            'value' => array( 'image' ),
          ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Youtube Video ID', 'progressive' ),
          'param_name' => 'youtube_id',
          'description' => __( 'Youtube video ID. The content after v= in the URL: v=MKXK8xwYDIA'),
          'group' => __( 'Media Content', 'progressive' ),
          'dependency' => array(
            'element' => 'media',
            'value' => array( 'video' ),
          ),
        ),
        array(
          'type' => 'attach_image',
          'heading' => __( 'Video Poster', 'progressive' ),
          'group' => __( 'Media Content', 'progressive' ),
          'param_name' => 'video_poster',
          'description' => __( 'Still image to show under play button.', 'progressive' ),
          'dependency' => array(
            'element' => 'media',
            'value' => array( 'video' ),
          ),
        ),
        array(
          'type' => 'checkbox',
          'heading' => __( 'Reverse', 'progressive' ),
          'param_name' => 'reverse',
          'group' => 'Body Content',
          'value' => array(
            "Yes" => "true"
          ),
        ),
        array(
          "type" => "dropdown",
          "class" => "",
          "heading" => "Change strong tag color?",
          'group' => 'Colors',
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
            'type' => 'dropdown',
            'heading' => __( 'Text Location', 'progressive' ),
            'param_name' => 'text_location',
            'description' => __( 'Contact text location.'),
            'group' => __( 'Body Content', 'progressive' ),
            'admin_label' => true,
            'value' => array(
              'Default' => '',
              'Left' => 'text-left',
              "Center" => "text-center",
              "Right" => "text-right",
            ),
          ),
        array(
          'type' => 'textarea_html',
          'heading' => __( 'Content', 'progressive' ),
          'param_name' => 'content',
          'group' => __( 'Body Content', 'progressive' ),
          'description' => __( 'Content for the card body.', 'progressive' ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Text Color', 'js_composer' ),
          'param_name' => 'text_color',
          'group' => 'Colors',
          'value' => array(
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
          'type' => 'dropdown',
          'heading' => __( 'BG Color', 'js_composer' ),
          'param_name' => 'bg_color',
          'group' => 'Colors',
          'value' => array(
            "Select Color" => "",
            "Primary" => "bg-primary",
            "Secondary" => "bg-secondary",
            "Tertiary" => "bg-tertiary",
            "Light" => "bg-light",
            "Accent" => "bg-accent",
            "Hightlight" => "bg-highlight",
            "Custom 1" => "bg-custom-one",
            "Custom 2" => "bg-custom-two",
            "Custom 3" => "bg-custom-three"
          ),
        ),

      )
    ));
  }
}

function pd_fifty_fifty_func( $atts, $content = null ) {
  global $progressive;
  extract(shortcode_atts(array(
      'media' => '',
      'reverse' => '',
      'image' => '',
      'strong_tag_color' => '',
      'video_poster' => '',
      'youtube_id' => '',
      'image' => '',
      'bg_color' => '',
      'text_color' => '',
      'text_location' => ''

  ), $atts ));
  ob_start();

  $classes = array( 'fifty__content', $text_location, $bg_color, $text_color );
  $classes = implode( " ", array_filter( $classes ) );

  ?>

    <div class="fifty">
      <?php if( "true" == $reverse ) : ?>
        <div class="<?php echo $classes; ?>"  data-mh="fifty">
          <?php echo ( $content != null ? $content : '' ); ?>
        </div>
        <div class="fifty__object" data-mh="fifty">
          <?php
            $attachment = ( $media == "image" ? $image : $video_poster );
            $attachemnt_alt = get_post_meta( $attachment, '_wp_attachment_image_alt', true);
          ?>
          <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="<?php echo wp_get_attachment_url( $attachment ); ?>" alt="<?php echo ( !empty( $attachment_alt ) ? $attachment_alt : get_the_title() . ' ' . $progressive['location'] ); ?>">
          <?php if( $media == "video" ) : ?>
            <a href="https://www.youtube.com/watch?v=<?php echo $youtube_id; ?>" class="fifty__play"><i class="icon  icon--play"></i></a>
          <?php endif; ?>
        </div>
      <?php else : ?>
        <div class="fifty__object" data-mh="fifty">
           <?php
            $attachment = ( $media == "image" ? $image : $video_poster );
            $attachemnt_alt = get_post_meta( $attachment, '_wp_attachment_image_alt', true);
          ?>
          <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="<?php echo wp_get_attachment_url( $attachment ); ?>" alt="<?php echo ( !empty( $attachment_alt ) ? $attachment_alt : get_the_title() . ' ' . $progressive['location'] ); ?>">
          <?php if( $media == "video" ) : ?>
            <a href="https://www.youtube.com/watch?v=<?php echo $youtube_id; ?>" class="fifty__play"><i class="icon  icon--play"></i></a>
          <?php endif; ?>
        </div>
        <div class="<?php echo $classes; ?>"  data-mh="fifty">
          <?php echo ( $content != null ? $content : '' ); ?>
        </div>
      <?php endif; ?>
    </div>

  <?php
  $output = ob_get_clean();
  return $output;
}
