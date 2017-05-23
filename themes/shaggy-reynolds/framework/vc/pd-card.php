<?php
add_shortcode( 'pd_card', 'pd_card_func' );
add_action( 'vc_before_init', 'progressive_map_card' );

function progressive_map_card() {
  if (function_exists('vc_map')) {
    vc_map( array(
      'name' => __( 'Card', 'progressive' ),
      'base' => 'pd_card',
      'icon' => THEME_WEB_ROOT . '/assets/images/pd-logo.png',
      'description' => __( 'A card for progressive dental layouts.', 'progressive' ),
      'category' => __( 'Content', 'progressive' ),
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
            'value' => array( 'image', 'video' ),
          ),
        ),
        array(
          'type' => 'attach_image',
          'heading' => __( 'Before Image', 'progressive' ),
          'param_name' => 'image_before',
          'description' => __( 'Image for before. Please crop to 16x9 before uploading'),
          'group' => __( 'Header Content', 'progressive' ),
          'dependency' => array(
            'element' => 'media',
            'value' => array( 'comparison' ),
          ),
        ),
        array(
          'type' => 'attach_image',
          'heading' => __( 'After Image', 'progressive' ),
          'param_name' => 'image_after',
          'description' => __( 'Image for after. Please crop to 16x9 before uploading'),
          'group' => __( 'Header Content', 'progressive' ),
          'dependency' => array(
            'element' => 'media',
            'value' => array( 'comparison' ),
          ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Video Location', 'progressive' ),
          'param_name' => 'video_location',
          'description' => __( 'Location of the video: youtube, media library, external url.'),
          'group' => __( 'Header Content', 'progressive' ),
          'value' => array(
            'Select' => '',
            'Youtube' => 'youtube',
            'Media Library' => 'media_library',
          ),
          'dependency' => array(
            'element' => 'media',
            'value' => array( 'video' ),
          ),
        ),
        array(
          'type' => 'attach_image',
          'heading' => __( 'Attach Video', 'progressive' ),
          'param_name' => 'video_attachment',
          'description' => __( 'Video file from media library.'),
          'group' => __( 'Header Content', 'progressive' ),
          'dependency' => array(
            'element' => 'video_location',
            'value' => array( 'media_library' ),
          ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Youtube Video ID', 'progressive' ),
          'param_name' => 'youtube_id',
          'description' => __( 'Youtube video ID. The content after v= in the URL: v=MKXK8xwYDIA'),
          'group' => __( 'Header Content', 'progressive' ),
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
          'group' => __( 'Header Content', 'progressive' ),
          'dependency' => array(
            'element' => 'video_location',
            'value' => array( 'youtube' ),
          ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Enable Headline?', 'progressive' ),
          'param_name' => 'enable_headline',
          'description' => __( 'Add a headline to the card.', 'progressive' ),
          'group' => __( 'Body Content', 'progressive' ),
          'value' => array(
            'Select' => '',
            'Yes' => 'yes',
            'No' => 'no'
          ),
          
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Headline Tag', 'progressive' ),
          'param_name' => 'headline_tag',
          'description' => __( 'What tag would you like to use. h1,h2,h3,h4,h5,h6,p', 'progressive' ),
          'group' => __( 'Body Content', 'progressive' ),
          'value' => array(
            "Select" => "",
            "H3 (Default)" => "h3",
            "H1" => "h1",
            "H2" => "h2",
            "H4" => "h4",
            "H5" => "h5",
            "H6" => "h6",
            "P" => "p",
            "Span" => "span"
          ),
          'dependency' => array(
            'element' => 'enable_headline',
            'value' => array( 'yes' ),
          ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Headline', 'progressive' ),
          'param_name' => 'headline',
          'description' => __( 'Headline text for the card.', 'progressive' ),
          'group' => __( 'Body Content', 'progressive' ),
          'dependency' => array(
            'element' => 'headline_tag',
            'not_empty' => true
          ),
        ),
        array(
          'type' => 'textarea_html',
          'heading' => __( 'Content', 'progressive' ),
          'param_name' => 'content',
          'group' => __( 'Body Content', 'progressive' ),
          'description' => __( 'Content for the card body.', 'progressive' ),
        ),
      )
    ));
  }
}

function pd_card_func( $atts, $content = null ) {
  extract(shortcode_atts(array(
      'enable_headline' => '',
      'headline_tag' => '',
      'headline' => '',
      'media' => '',
      'youtube_id' => '',
      'vimeo_id' => ''
  ), $atts ));
  ob_start() ?>
  
    <div class="card">
      <div class="card__header  card__header--16:9">
        <?php echo get_card_header( $media, $atts ); ?>
      </div>
      <div class="card__body">
        <?php if( $enable_headline == "yes" && $headline_tag != '' ) : ?><<?php echo $headline_tag; ?> class="card__title"><?php echo $headline; ?></<?php echo $headline_tag; ?>><?php endif; ?>
        <?php echo ( $content != null ? $content : '' ); ?>
      </div>
    </div>

  <?php
  $output = ob_get_clean();
  return $output;
}

function get_card_header( $type, $atts ) {
  $output = '';
  switch ( $type ) {
    case 'comparison':
      $output = '
        <div class="compare  card__object">
          <img src="' . wp_get_attachment_url( $atts['image_before'] ) . '" alt="Before">
          <img src="' . wp_get_attachment_url( $atts['image_after'] ) . '" alt="After">
        </div>
      ';
      break;
    case 'video':
      $output = '<img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="' . wp_get_attachment_url( $atts['image'] ) . '" alt="' . ( !empty( $attachment_alt ) ? $attachment_alt : get_the_title() . ' ' . $progressive['location'] ) . '" class="card__object">';
      switch ( $atts['video_location'] ) {
        case 'youtube':
          $output .= '<a href="https://www.youtube.com/watch?v=' . $atts['youtube_id'] . '" class="card__play  js-play-video"><i class="icon  icon--play"></i></a>';
          break;
        case 'vimeo':
          $output .= '<a href="https://vimeo.com/' . $atts['vimeo_id'] . '" class="card__play  js-play-video"><i class="icon  icon--play"></i></a>';

          break;
      }
      break;
    case 'image':
      $output = '<img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="' . wp_get_attachment_url( $atts['image'] ) . '" class="card__object">';
      break;
  }
  return $output;
}