<?php
add_shortcode( 'pd_media_object', 'pd_media_object_func' );
add_action( 'vc_before_init', 'progressive_map_media_object' );

function progressive_map_media_object() {
  if (function_exists('vc_map')) {
    vc_map( array(
      'name' => __( 'Media Object', 'progressive' ),
      'base' => 'pd_media_object',
      'icon' => THEME_WEB_ROOT . '/assets/images/pd-logo.png',
      'show_settings_on_create' => true,
      'category' => __( 'Content', 'progressive' ),
      'params' => array(
        array(
          "type" => "attach_image",
          "class" => "",
          "heading" => "Image",
          "param_name" => "image",
          'admin_label' => true,
        ),
        array(
          "type" => "textarea_html",
          "heading" => __( "Content", "progressive" ),
          "param_name" => "content",
          'admin_label' => true,
        ),
        array(
          "type" => "dropdown",
          "class" => "",
          "heading" => "Text alignment",
          'group' => __( 'Alignment', 'progressive' ),
          "param_name" => "align",
          'admin_label' => true,
          "value" => array(
            "Middle" => "",
            "Top" => "top",
            "Bottom" => "bottom"
          )
        ),
        array(
          "type" => "dropdown",
          "class" => "",
          "heading" => "Reverse",
          "param_name" => "reverse",
          'admin_label' => true,
          'group' => __( 'Alignment', 'progressive' ),
          "value" => array(
            "False" => "false",
            "True" => "true",
          )
        ),

      )
    ) );
  }
}

function pd_media_object_func( $atts, $content = null ) {
  extract(shortcode_atts(array(
      'image' => '',
      'align' => '',
      'reverse' => ''
  ), $atts ));

  global $progressive;

  ob_start(); ?>
  <div class="flag<?php echo ( $align != '' ? " flag--$align trans-block__flag" : '' ); ?><?php echo ( $reverse == true ? " flag--rev" : '' ); ?>">
    <?php if( !$reverse ) : ?>
    <div class="flag__image  flag__image--max">
      <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" data-src="<?php echo wp_get_attachment_url( $image ); ?>" alt="<?php echo get_the_title() . ' ' . $progressive['location'] ?>">
    </div>
    <div class="flag__body">
      <?php echo wpb_js_remove_wpautop($content, true); ?>
    </div>
  <?php else : ?>
    <div class="flag__body">
      <?php echo wpb_js_remove_wpautop($content, true); ?>
    </div>
    <div class="flag__image  flag__image--max">
      <img src="<?php echo wp_get_attachment_url( $image ); ?>" alt="">
    </div>
    <?php endif; ?>
  </div>
  <?php
  $output = ob_get_clean();
  return $output;
}
