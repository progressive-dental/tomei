<?php
add_shortcode( 'pd_counter', 'pd_counter_func' );
add_action( 'vc_before_init', 'progressive_map_counter' );

function progressive_map_counter() {
  if (function_exists('vc_map')) {
    vc_map( array(
      'name' => __( 'Counter', 'progressive' ),
      'base' => 'pd_counter',
      'icon' => THEME_WEB_ROOT . '/assets/images/pd-logo.png',
      'description' => __( 'A counter module.', 'progressive' ),
      'category' => __( 'Content', 'progressive' ),
      'params' => array(
        array(
          'type' => 'textfield',
          'heading' => __( 'Count', 'progressive' ),
          'param_name' => 'count',
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Count Type', 'progressive' ),
          'param_name' => 'type',
          'value' => array(
            "Select type" => "",
            "Number" => "number",
            "Percent" => "percent"
          ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Circle One Class', 'progressive' ),
          'param_name' => 'circle_one_class',
          'description' => __( 'Class name for the first circle. Handles the color.'),
          'group' => __( 'Display Options', 'progressive' ),
          'value' => array(
            "Select type" => "",
            "Primary" => "primary",
            "Secondary" => "secondary",
            "Tertiary" => "tertiary",
            "Accent" => "accent",
            "Accent Dark" => "accent-dark",
            "Light" => "light",
            "Tint" => "tint",
            "Custom" => "custom",
          ),

        ),
        array(
          'type' => 'colorpicker',
          'heading' => __( 'Circle One Custom Color', 'progressive' ),
          'param_name' => 'circle_one_custom_color',
          'description' => __( 'Custom color for the first circle.'),
          'group' => __( 'Display Options', 'progressive' ),
          'dependency' => array(
            'element' => 'circle_one_class',
            'value' => array( 'custom' ),
          ),
        ),
        array(
          'type' => 'dropdown',
          'heading' => __( 'Circle Two Class', 'progressive' ),
          'param_name' => 'circle_two_class',
          'description' => __( 'Class name for the second circle. Handles the color.'),
          'group' => __( 'Display Options', 'progressive' ),
          'value' => array(
            "Select type" => "",
            "Primary" => "primary",
            "Secondary" => "secondary",
            "Tertiary" => "tertiary",
            "Accent" => "accent",
            "Accent Dark" => "accent-dark",
            "Light" => "light",
            "Tint" => "tint",
            "Custom" => "custom",
          ),

        ),
        array(
          'type' => 'colorpicker',
          'heading' => __( 'Circle Two Custom Color', 'progressive' ),
          'param_name' => 'circle_two_custom_color',
          'description' => __( 'Custom color for the second circle.'),
          'group' => __( 'Display Options', 'progressive' ),
          'dependency' => array(
            'element' => 'circle_two_class',
            'value' => array( 'custom' ),
          ),
        ),
      )
    ) );
  }
}

function pd_counter_func( $atts ) {
  extract(shortcode_atts(array(
      'type' => '',
      'count' => '',
      'circle_one_class' => '',
      'circle_two_class' => '',
      'circle_one_custom_color' => '',
      'circle_two_custom_color' => ''
  ), $atts ));

  ob_start(); ?>
    <div class="counter" data-percent="<?php echo $count; ?>">
      <div class="counter__inner"><span class="counter__count" data-from="0" data-to="<?php echo $count; ?>">0</span><?php echo ( $type == 'percent' ? '%' : '' ); ?></div>
    </div>
  <?php
  $output = ob_get_clean();
  return $output;
}