<?php
add_shortcode( 'pd_masthead_tab', 'pd_masthead_tab_func' );
add_action( 'vc_before_init', 'progressive_map_masthead_tab' );

function progressive_map_masthead_tab() {
  if (!function_exists('vc_map')) {
    return;
  }

  vc_map( array(
    'name' => __( 'Masthead Tab', 'progressive' ),
    'base' => 'pd_masthead_tab',
    'icon' => THEME_WEB_ROOT . '/assets/images/pd-logo.png',
    'description' => __( 'Tab for the masthead tabs.', 'progressive' ),
    'as_parent' => array( 'only' => 'pd_masthead_tabs' ),
    'category' => __( 'Content', 'progressive' ),
    'params' => array(
      array(
        'type' => 'vc_link',
        'heading' => __( 'Tab Link', 'progressive' ),
        'param_name' => 'tab_link',
      ),
      array(
        'type' => 'checkbox',
        'heading' => __( 'Enable video popup?', 'progressive' ),
        'param_name' => 'enable_popup',
        'value' => array(
          "Yes" => "true"
        ),
      ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Tab Class', 'progressive' ),
        'param_name' => 'tab_class',
      ),
      array(
        'type' => 'textfield',
        'heading' => __( 'Link Class', 'progressive' ),
        'param_name' => 'link_class',
      ),
    )
  ) );

}

function pd_masthead_tab_func( $atts, $content = null ) {
  extract(shortcode_atts(array(
      'tab_link' => '',
      'tab_class' => '',
      'link_class' => '',
      'enable_popup' => ''
  ), $atts ));

  $link = vc_build_link( $tab_link );

  if( "true" == $enable_popup ) {
    $link_class = $link_class . "  js-play-video";
  }
  ob_start(); ?>
    <li class="masthead__tab-content"<?php echo ( !empty( $tab_class ) ? ' class="' . $tab_class . '"' : '' ); ?>>
      <a href="<?php echo $link['url']; ?>"<?php echo ( !empty( $link_class ) ? ' class="' . $link_class . '"' : '' ); ?>><?php echo $link['title']; ?></a>
    </li>
  <?php
  $output = ob_get_clean();
  return $output;
}