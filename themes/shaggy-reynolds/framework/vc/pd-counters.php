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
          'type' => 'textfield',
          'heading' => __( 'Counter Text', 'progressive' ),
          'param_name' => 'counter_text',
          'description' => __( 'Description of counter.'),
        ),
        array(
          "type" => "dropdown",
          "class" => "",
          "heading" => "Change Text color",
          "param_name" => "counter_text_color",
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
            'type' => 'dropdown',
            'heading' => __( 'Text Location', 'progressive' ),
            'param_name' => 'counter_text_location',
            'value' => array(
              'Default' => '',
              'Left' => 'text-left',
              "Center" => "text-center",
              "Right" => "text-right",
            ),
          ),

        array(
          'type' => 'colorpicker',
          'heading' => __( 'Circle bar color', 'progressive' ),
          'param_name' => 'bar_color',
          'description' => __( 'Color when the circle animates.'),
          'group' => __( 'Display Options', 'progressive' ),
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Circle bar width', 'progressive' ),
          'param_name' => 'bar_width',
          'description' => __( 'Width of the animatied circle.'),
          'group' => __( 'Display Options', 'progressive' )
        ),
        array(
          'type' => 'textfield',
          'heading' => __( 'Counter Speed', 'progressive' ),
          'param_name' => 'counter_speed',
          'description' => __( 'Speed of javascript countTo plugin. ( Text )'),
          'group' => __( 'Display Options', 'progressive' )
        ),
        
      )
    ) );
  }
}

function pd_counter_func( $atts ) {
  extract(shortcode_atts(array(
      'type' => '',
      'count' => '',
      'bar_color' => '',
      'bar_width' => '',
      'counter_speed' => '',
      'counter_text' => '',
      'counter_text_color' => '',
      'counter_text_location' => ''
  ), $atts ));

  $classes = array( 'counter__title', $counter_text_color, $counter_text_location );
  $classes = implode( "  ", array_filter( $classes ) );

  ob_start(); ?>
    <div class="counter" data-percent="<?php echo $count; ?>" data-bar-color="<?php echo $bar_color; ?>" data-bar-width="<?php echo $bar_width; ?>" data-speed="<?php echo $counter_speed; ?>" >
      <div class="counter__content  text-primary">
        <span class="counter__count" data-from="0" data-to="<?php echo $count; ?>">0</span><?php echo ( $type == 'percent' ? '%' : '' ); ?>
      </div>
    </div>
    <h3 class="<?php echo $classes; ?>"><?php echo $counter_text; ?></h3>
  <?php
  $output = ob_get_clean();
  return $output;
}