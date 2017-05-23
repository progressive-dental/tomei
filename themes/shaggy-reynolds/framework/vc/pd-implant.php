<?php
add_shortcode( 'pd_implant', 'pd_implant_func' );
add_action( 'vc_before_init', 'progressive_map_implant' );

function progressive_map_implant() {
  if (function_exists('vc_map')) {
    vc_map( array(
      'name' => __( 'Implant Diagram', 'progressive' ),
      'base' => 'pd_implant',
      'icon' => THEME_WEB_ROOT . '/assets/images/pd-logo.png',
      'show_settings_on_create' => true,
      'category' => __( 'Content', 'progressive' ),
      'params' => array()
    ) );
  }
}

function pd_implant_func( $atts, $content = null ) {
  extract(shortcode_atts(array(
      'content' => ''
  ), $atts ));

  $html = '
    <div class="implant">
        <img src="' . get_template_directory_uri() . '/assets/images/implant.png">

        <div class="implant__note  implant__note--crown  wow fadeInRight">
          <div class="implant__indicator">
            <div class="plus-icon">
              <span class="plus">+</span>
            </div>
          </div>
          <div class="implant__note-name">
            crown
          </div>
        </div>

        <div class="implant__note  implant__note--abutment  wow fadeInLeft">
          <div class="implant__indicator">
            <div class="plus-icon">
              <span class="plus">+</span>
            </div>
          </div>
          <div class="implant__note-name">
            abutment
          </div>
        </div>

        <div class="implant__note  implant__note--post  wow fadeInUp">
          <div class="implant__indicator">
            <div class="plus-icon">
              <span class="plus">+</span>
            </div>
          </div>
          <div class="implant__note-name">
            ceramic<br>threaded
          </div>
        </div>
      </div>
  ';

  ob_start(); ?>
  <?php echo $html; ?>
  <?php
  $output = ob_get_clean();
  return $output;
}
