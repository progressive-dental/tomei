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
          'heading' => __( 'External video URL.', 'progressive' ),
          'param_name' => 'video_url',
          'admin_label' => true,
          'dependency' => array(
            'element' => 'video_location',
            'value' => array( 'external' ),
          ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'External video type.', 'progressive' ),
          'param_name' => 'video_type',
          'admin_label' => true,
          'value' => array(
            'Select' => '',
            'MP4' => 'video/mp4',
            'WEBM' => 'video/webm',
            'OGV' => 'video/ogg'
          ),
          'dependency' => array(
            'element' => 'video_location',
            'value' => array( 'external', 'media_library' ),
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
            'value' => array( 'external', 'media_library' ),
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
      'youtube_id' => '',
      'vimeo_id' => ''
  ), $atts ));
  switch( $media ) {
    case 'image':
      $html = '<img src="' . wp_get_attachment_url($image) . '" alt="' . wp_get_attachment_caption( $image ) . '">';
      break;
    case 'video':
        if( $video_location == "external" ) {
          $html = '
            <div class="video" style="max-width: 100%; height: auto;">
              <video class="video__content" autoplay muted>
                <source src="' . $video_url . '" type="' . $video_type . '">
              </video>
            </div>
          ';
        } elseif( $video_location == "youtube" ) {
          $html = '
            <div class="js-player" data-type="youtube" data-video-id="' . $youtube_id . '" data-plyr=\'\'></div>
          ';
        } elseif( $video_location == "vimeo" ) {
          $html = '
            <div class="video  video--youtube">
              <iframe src="https://player.vimeo.com/video/' . $vimeo_id . '?rel=0&amp;showinfo=0&amp;autoplay=1&amp;background=1" frameborder="0" allowfullscreen></iframe>
            </div>
          ';
        }
      break;
  }

  ob_start(); ?>
  <?php echo $html; ?>
  <?php
  $output = ob_get_clean();
  return $output;
}
