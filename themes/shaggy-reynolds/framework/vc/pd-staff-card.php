<?php
add_shortcode( 'pd_staff_card', 'pd_staff_card_func' );
add_action( 'vc_before_init', 'progressive_map_staff_card' );

function progressive_map_staff_card() {
  if (function_exists('vc_map')) {
    vc_map( array(
      'name' => __( 'Staff Card', 'progressive' ),
      'base' => 'pd_staff_card',
      'icon' => THEME_WEB_ROOT . '/assets/images/pd-logo.png',
      'description' => __( 'A card for progressive dental staff bios.', 'progressive' ),
      'category' => __( 'Content', 'progressive' ),
      'params' => array(
        array(
          'type' => 'attach_image',
          'heading' => __( 'Header Image', 'progressive' ),
          'param_name' => 'image',
          'description' => __( 'Image to display. Please crop to 16x9 before uploading'),
          'group' => __( 'Header Content', 'progressive' ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Headline Tag for Name', 'progressive' ),
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
        ),

        array(
          'type' => 'textfield',
          'heading' => __( 'Staff Member Name', 'progressive' ),
          'param_name' => 'staff_member_name',
          'description' => __( 'Name of the doctor or staff memeber.', 'progressive' ),
          'group' => __( 'Body Content', 'progressive' ),
          'dependency' => array(
            'element' => 'headline_tag',
            'not_empty' => true
          ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Header Location', 'js_composer' ),
          'param_name' => 'header_location',
          'group' => __( 'Body Content', 'progressive' ),
          'description' => __( 'Select where to place the header.', 'js_composer' ),
          'value' => array(
            'Select' => '',
            'Header ( Default )' => 'header',
            'Body' => 'body',
          ),
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
        array(
          'type' => 'dropdown',
          'heading' => __( 'Enable button?', 'js_composer' ),
          'param_name' => 'enable_button',
          'group' => __( 'Button', 'progressive' ),
          'description' => __( 'Enable button for this card.', 'js_composer' ),
          'std' => 'no',
          'value' => array(
            'No' => 'no',
            'Yes' => 'yes',
          ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Button Location', 'js_composer' ),
          'param_name' => 'button_location',
          'group' => __( 'Button', 'progressive' ),
          'description' => __( 'Where to place the button.', 'js_composer' ),
          'value' => array(
            'Select' => '',
            'Footer ( Default )' => 'footer',
            'Body' => 'body',
          ),
          'dependency' => array(
            'element' => 'enable_button',
            'value' => array( "yes" )
          ),
        ),
        array(
          'type' => 'vc_link',
          'heading' => __( 'Button Link', 'progressive' ),
          'param_name' => 'button_link',
          'group' => __( 'Button', 'progressive' ),
          'description' => __( 'Button link for staff card', 'progressive' ),
          'dependency' => array(
            'element' => 'enable_button',
            'value' => array( "yes" )
          ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Button Text', 'progressive' ),
          'param_name' => 'button_text',
          'group' => __( 'Button', 'progressive' ),
          'description' => __( 'Button text for staff card', 'progressive' ),
          'dependency' => array(
            'element' => 'enable_button',
            'value' => array( "yes" )
          ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Color', 'js_composer' ),
          'description' => __( 'Select button display color.', 'js_composer' ),
          'param_name' => 'button_color',
          'group' => __( 'Button', 'progressive' ),
          'value' => array(
            __( 'Select', 'js_composer' ) => '',
            __( 'Primary', 'js_composer' ) => 'btn--primary',
            __( 'Secondary', 'js_composer' ) => 'btn--secondary',
            __( 'Tertiary', 'js_composer' ) => 'btn--tertiary',
            __( 'Accent', 'js_composer' ) => 'btn--accent',
            __( 'Accent Dark', 'js_composer' ) => 'btn--accent-dark',
            __( 'Light', 'js_composer' ) => 'btn--light',
            __( 'Tint', 'js_composer' ) => 'btn--tint',
            __( 'Default', 'js_composer' ) => 'btn--default',
          ),
          'dependency' => array(
            'element' => 'enable_button',
            'value' => array( "yes" )
          ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Size', 'js_composer' ),
          'param_name' => 'button_size',
          'group' => __( 'Button', 'progressive' ),
          'description' => __( 'Select button display size.', 'js_composer' ),
          // compatible with btn2, default md, but need to be converted from btn1 to btn2
          'std' => 'normal',
          'value' => array(
            'Small' => 'btn--small',
            'Normal' => 'normal',
            'Large' => 'btn--large',
            'Full' => 'btn--full',
          ),
          'dependency' => array(
            'element' => 'enable_button',
            'value' => array( "yes" )
          ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Ghost', 'js_composer' ),
          'param_name' => 'button_ghost',
          'group' => __( 'Button', 'progressive' ),
          'description' => __( 'Select to ghost the button.', 'js_composer' ),
          // compatible with btn2, default md, but need to be converted from btn1 to btn2
          'std' => '',
          'value' => array(
            'No' => '',
            'Yes' => 'btn--ghost',
          ),
          'dependency' => array(
            'element' => 'enable_button',
            'value' => array( "yes" )
          ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Corners', 'js_composer' ),
          'param_name' => 'button_corners',
          'group' => __( 'Button', 'progressive' ),
          'description' => __( 'Select to the button corner type.', 'js_composer' ),
          // compatible with btn2, default md, but need to be converted from btn1 to btn2
          'std' => 'btn--rounded',
          'value' => array(
            'Round' => 'btn--rounded',
            'Square' => 'btn--mini-rounded',
          ),
          'dependency' => array(
            'element' => 'enable_button',
            'value' => array( "yes" )
          ),
        ),
      ),
    ));
  }
}

function pd_staff_card_func( $atts, $content = null ) {
  extract(shortcode_atts(array(
      'enable_headline' => '',
      'headline_tag' => '',
      'staff_member_name' => '',
      'media' => '',
      'enable_button' => '',
      'button_color' => '',
      'button_ghost' => '',
      'button_size' => '',
      'button_corners' => '',
      'button_link' => '',
      'button_text' => '',
      'button_location' => '',
      'header_location' => ''
  ), $atts ));

  if( $enable_button == "yes" ) {
    $button_classes = $button_color;
    $button_classes .= ( $button_size != "normal" && $button_size != '' ? '  ' . $button_size : '' );
    $button_classes .= ( $button_ghost != "" && $button_ghost != '' ? '  ' . $button_ghost : '' );
    $button_classes .= ( $button_corners != "btn--rounded" && $button_corners != '' ? '  ' . $button_corners : '' );

    $link = vc_build_link( $button_link );
  }

  ob_start() ?>

    <div class="box">
      <?php if( $headline_tag != '' && $header_location == "header" ) : ?>
      <div class="box__header">
        <<?php echo $headline_tag; ?> class="box__title  u-h2"><?php echo $staff_member_name; ?></<?php echo $headline_tag; ?>>
      </div>
      <?php endif; ?>
      <div class="box__object o-crop  o-crop--3:2">
        <img src="<?php echo wp_get_attachment_url( $atts['image'] ); ?>" class="o-crop__content" alt="<?php echo get_post_meta( $atts['image'], '_wp_attachment_image_alt', true); ?>">
      </div>
      <?php if( $content ) : ?>
      <div class="box__body">
        <?php if( $headline_tag != '' && $header_location == "body" ) : ?>
          <<?php echo $headline_tag; ?> class=""><?php echo $staff_member_name; ?></<?php echo $headline_tag; ?>>
        <?php endif; ?>
        <?php echo wpautop( $content ); ?>
        <?php if( $enable_button == "yes" && $button_location == "body" ) : ?>
          <a href="<?php echo $link['url']; ?>" class="btn--link"><?php echo $button_text; ?></a>
        <?php endif; ?>
      </div>
      <?php endif; ?>
      <?php if( $enable_button == "yes" && $button_location == "footer" ) : ?>
      <div class="box__footer">
        <a href="<?php echo $link['url']; ?>" class="btn  <?php echo $button_classes; ?>"><?php echo $button_text; ?></a>
      </div>
    <?php endif; ?>
    </div>
  
  <?php
  $output = ob_get_clean();
  return $output;
}

