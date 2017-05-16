<?php
add_shortcode( 'pd_block', 'pd_block_func' );
add_action( 'vc_before_init', 'progressive_map_block' );

function progressive_map_block() {
  if (!function_exists('vc_map')) {
    return;
  }

  vc_map( array(
    'name' => __( 'Block', 'progressive' ),
    'base' => 'pd_block',
    'icon' => THEME_WEB_ROOT . '/assets/images/pd-logo.png',
    'description' => __( 'Block for block list.', 'progressive' ),
    'as_parent' => array( 'only' => 'pd_block_list' ),
    'category' => __( 'Content', 'progressive' ),
    'params' => array(
      array(
        'type' => 'textfield',
        'heading' => __( 'Text', 'progressive' ),
        'param_name' => 'block_text',
        'admin_label' => true,
      ),
    )
  ) );

}

function pd_block_func( $atts, $content = null ) {
  extract(shortcode_atts(array(
      'block_text' => ''
  ), $atts ));

  ob_start(); ?>
    <li class="block-list__item"><span><?php echo $block_text; ?></span></li>
  <?php
  $output = ob_get_clean();
  return $output;
}