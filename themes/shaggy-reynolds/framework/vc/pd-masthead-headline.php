<?php
add_shortcode( 'pd_masthead_headline', 'pd_masthead_headline_func' );
add_action( 'vc_before_init', 'progressive_map_masthead_headline' );

function progressive_map_masthead_headline() {
  if (!function_exists('vc_map')) {
    return;
  }

  $icons = array( "None" => "none" );
  for($x = 1; $x <= 130; $x++) {
    $icons["Icon " . $x] = $x;
  }

  vc_map( array(
    'name' => __( 'Masthead Headline', 'progressive' ),
    'base' => 'pd_masthead_headline',
    'icon' => THEME_WEB_ROOT . '/assets/images/pd-logo.png',
    'description' => __( 'Headline for the masthead', 'progressive' ),
    'as_parent' => array( 'only' => 'pd_masthead' ),
    'category' => __( 'Content', 'progressive' ),
    'params' => array(
      array(
        'type' => 'textfield',
        'heading' => __( 'Text', 'progressive' ),
        'param_name' => 'text',
        'admin_label' => true,
        'description' => __( 'Image to display.'),
      ),
      array(
        "type" => "dropdown",
        "class" => "",
        "heading" => "Icon",
        "param_name" => "icon",
        "value" => $icons
      ),
      array(
        "type" => "dropdown",
        "class" => "",
        "heading" => "Tag",
        'admin_label' => true,
        "param_name" => "tag",
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
      
    )
  ) );

}

function pd_masthead_headline_func( $atts ) {
  extract(shortcode_atts(array(
      'text' => '',
      'icon' => '',
      'tag' => ''
  ), $atts ));

  $ret = '';
  if( $icon != "none" )
    $ret .= '<i class="masthead__icon  icon  icon--' . $icon . '"></i>';
      
  $ret .= '<' . $tag . ' class="masthead__title u-h1">' . $text . '</' . $tag . '>';

  return $ret;
}