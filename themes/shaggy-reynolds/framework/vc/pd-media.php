<?php
add_shortcode( 'pd_media', 'pd_media_func' );
add_action( 'vc_before_init', 'progressive_map_media' );

function progressive_map_media() {
  if (function_exists('vc_map')) {
    vc_map( array(
      'name' => __( 'Insert Video, Image or Comparison', 'progressive' ),
      'base' => 'pd_media',
      'icon' => THEME_WEB_ROOT . '/assets/images/pd-logo.png',
      'show_settings_on_create' => true,
      'category' => __( 'Content', 'progressive' ),
      'params' => array(
        array(
          'type' => 'dropdown',
          'heading' => __( 'Media', 'progressive' ),
          'param_name' => 'media',
          'description' => __( 'What type of media would you like to display?', 'progressive' ),
          'admin_label' => true,
          'value' => array(
            "Select type" => "",
            "Image" => "image",
            "Video" => "video",
            "Before & After" => "comparison"
          ),
        ),
        array(
          'type' => 'attach_image',
          'heading' => __( 'Image', 'progressive' ),
          'param_name' => 'image',
          'description' => __( 'Image to display.'),
          'admin_label' => true,
          'dependency' => array(
            'element' => 'media',
            'value' => array( 'image' ),
          ),
        ),
        array(
          'type' => 'attach_image',
          'heading' => __( 'Before Image', 'progressive' ),
          'param_name' => 'image_before',
          'description' => __( 'Image for before. Please make sure images are the same size.'),
          'dependency' => array(
            'element' => 'media',
            'value' => array( 'comparison' ),
          ),
        ),
        array(
          'type' => 'attach_image',
          'heading' => __( 'After Image', 'progressive' ),
          'param_name' => 'image_after',
          'description' => __( 'Image for after. Please make sure images are the same size.'),
          'dependency' => array(
            'element' => 'media',
            'value' => array( 'comparison' ),
          ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Video Location', 'progressive' ),
          'param_name' => 'video_location',
          'description' => __( 'Location of the video: youtube, vimeo, external url.'),
          'admin_label' => true,
          'value' => array(
            'Select' => '',
            'Youtube' => 'youtube',
            'Vimeo' => 'vimeo',
            'External' => 'external'
          ),
          'dependency' => array(
            'element' => 'media',
            'value' => array( 'video' ),
          ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Youtube Video ID', 'progressive' ),
          'param_name' => 'youtube_id',
          'description' => __( 'Youtube video ID. The content after v= in the URL: v=MKXK8xwYDIA'),
          'admin_label' => true,
          'dependency' => array(
            'element' => 'video_location',
            'value' => array( 'youtube' ),
          ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Vimeo Video ID', 'progressive' ),
          'param_name' => 'vimeo_id',
          'description' => __( 'Vimeo video ID'),
          'admin_label' => true,
          'dependency' => array(
            'element' => 'video_location',
            'value' => array( 'vimeo' ),
          ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Video caption', 'progressive' ),
          'param_name' => 'video_caption',
          'admin_label' => true,
          'dependency' => array(
            'element' => 'video_location',
            'value' => array( 'youtube', 'vimeo' ),
          ),
        ),

        array(
          "type" => "dropdown",
          "class" => "",
          "heading" => "Caption font color",
          'group' => 'Colors',
          "param_name" => "caption_font_color",
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
          'dependency' => array(
            'element' => 'video_location',
            'value' => array( 'youtube', 'vimeo' ),
          ),
        ),
        array(
          'type' => 'attach_image',
          'heading' => __( 'Video Poster', 'progressive' ),
          'param_name' => 'video_poster',
          'admin_label' => true,
          'description' => __( 'Still image to show while the video is loading.', 'progressive' ),
          'dependency' => array(
            'element' => 'video_location',
            'value' => array( 'youtube', 'vimeo' ),
          ),
        ),
        
      )
    ) );
  }
}

function pd_media_func( $atts, $content = null ) {
  extract(shortcode_atts(array(
      'media' => '',
      'image' => '',
      'video_location' => '',
      'video_url' => '',
      'video_type' => '',
      'video_poster' => '',
      'video_caption' => '',
      'youtube_id' => '',
      'vimeo_id' => '',
      'image_before' => '',
      'image_after' => '',
      'caption_font_color' => ''
  ), $atts ));

  global $progressive;

  switch( $media ) {
    case 'image':
      $attachemnt_alt = get_post_meta( $image, '_wp_attachment_image_alt', true);
      $html = '
        <div class="outline-image">
          <img src="' . wp_get_attachment_url($image) . '" alt="' . ( !empty( $attachment_alt ) ? $attachment_alt : get_the_title() . ' ' . $progressive['location'] ) . '">
        </div>
      ';
      break;
    case 'video':
      $attachemnt_alt = get_post_meta( $video_poster, '_wp_attachment_image_alt', true);
        $html = '
          <div class="video-box">
            <div class="video-box__thumbnail">
              <img src="' . wp_get_attachment_url($video_poster) . '" alt="' . ( !empty( $attachment_alt ) ? $attachment_alt : get_the_title() . ' ' . $progressive['location'] ) . '" data-mh="videobox">
              <a href="https://www.youtube.com/watch?v=' . $youtube_id . '" class="video-box__play"><i class="icon  icon--play"></i></a>
            </div>
            <div class="video-box__caption  ' . ( !empty( $caption_font_color ) ? $caption_font_color : '' ) . '" data-mh="videobox">
              <span class="video-box__copy">' . $video_caption . '</span></div>
          </div>
        ';
      break;
    case 'comparison':
      $html = '
        <div class="compare">
          <img src="' . wp_get_attachment_url($image_before) . '">
          <img src="' . wp_get_attachment_url($image_after) . '">
        </div>
      ';
      break;
  }

  ob_start(); ?>
  <?php echo $html; ?>
  <?php
  $output = ob_get_clean();
  return $output;
}
