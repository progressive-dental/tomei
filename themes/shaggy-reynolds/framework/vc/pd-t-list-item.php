<?php
add_shortcode( 'pd_t_list_item', 'pd_t_list_item_func' );
add_action( 'vc_before_init', 'progressive_map_t_list_item' );

function progressive_map_t_list_item() {
  if (!function_exists('vc_map')) {
    return;
  }

  vc_map( array(
    'name' => __( 'T List Item', 'progressive' ),
    'base' => 'pd_t_list_item',
    'icon' => THEME_WEB_ROOT . '/assets/images/pd-logo.png',
    'description' => __( 'Item for the T list.', 'progressive' ),
    'as_parent' => array( 'only' => 'pd_t_list' ),
    'category' => __( 'Content', 'progressive' ),
    'params' => array(
      array(
        "type" => "textfield",
        "heading" => __( "Header Text", "progressive" ),
        "param_name" => "text",
        'admin_label' => true,
        "group" => "Heading",
      ),
      array(
        "type" => "dropdown",
        "class" => "",
        "heading" => "Tag",
        'admin_label' => true,
        "param_name" => "type",
        "group" => "Heading",
        "value" => array(
          "" => "",
          "H2" => "h2",
          "H1" => "h1",
          "H3" => "h3",
          "H4" => "h4",
          "H5" => "h5",
          "H6" => "h6"
        )
      ),
      array(
        "type" => "dropdown",
        "class" => "",
        "heading" => "Change heading color?",
        "param_name" => "heading_color",
        "group" => "Heading",
        "value" => array(
          "" => "",
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
        "type" => "textfield",
        "heading" => "Extra classes",
        "param_name" => "classes",
        "group" => "Heading",
        'admin_label' => true,
      ),
      array(
        "type" => "dropdown",
        "class" => "",
        "heading" => "Change strong tag color?",
        'group' => 'Content',
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
        'type' => 'textarea_html',
        'heading' => __( 'Sub Headline Content', 'progressive' ),
        'param_name' => 'content',
        'group' => __( 'Content', 'progressive' ),
      ),
    )
  ) );

}

function pd_t_list_item_func( $atts, $content = null ) {
  extract(shortcode_atts(array(
      'classes' => '',
      'heading_color' => '',
      'type' => '',
      'strong_tag_color' => '',
      'text' => ''
  ), $atts ));

  $classes = array(
    't-list__title',
    $classes,
    $heading_color
  );


  $classes = implode( "  ", array_filter( $classes ) );

  $pClasses = array(
    't-list__content'
  );
  $pClasses = implode( "  ", array_filter( $pClasses ) );
  $pattern = "/(<p)/";
  $replace = '<p class="' . $pClasses . '"';
  $strong_pattern = "/(<strong)/";

  ob_start(); ?>
    <li class="t-list__item">
      <div class="pull-left">
        <<?php echo $type; ?><?php echo ( !empty( $classes ) ? ' class="' . $classes . '"' : '' ); ?>><?php echo $text; ?></<?php echo $type; ?>>
        <?php
        if( !empty( $strong_tag_color ) ) {
          $strong_replace = '<strong class="' . $strong_tag_color . '"';
          echo preg_replace( $strong_pattern, $strong_replace, preg_replace( $pattern, $replace, wpb_js_remove_wpautop ( $content, true ) ) );
        } else {
          echo preg_replace( $pattern, $replace, wpb_js_remove_wpautop ( $content, true ) );
        } ?>
      </div>
    </li>
  <?php
  $output = ob_get_clean();
  return $output;
}
