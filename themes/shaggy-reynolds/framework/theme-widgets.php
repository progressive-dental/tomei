<?php

add_action( 'widgets_init', 'shaggy_reynolds_widgets_init' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function shaggy_reynolds_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar 1', 'road-runner' ),
    'id'            => 'sidebar-1',
    'description'   => esc_html__( 'Add widgets here.', 'road-runner' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget__title">',
    'after_title'   => '</h3>',
    ) );

  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar 2', 'road-runner' ),
    'id'            => 'sidebar-2',
    'description'   => esc_html__( 'Add widgets here.', 'road-runner' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget__title">',
    'after_title'   => '</h3>',
    ) );

  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar 3', 'road-runner' ),
    'id'            => 'sidebar-3',
    'description'   => esc_html__( 'Add widgets here.', 'road-runner' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget__title">',
    'after_title'   => '</h3>',
    ) );

  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar 4', 'road-runner' ),
    'id'            => 'sidebar-4',
    'description'   => esc_html__( 'Add widgets here.', 'road-runner' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget__title">',
    'after_title'   => '</h3>',
    ) );

  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar 5', 'road-runner' ),
    'id'            => 'sidebar-5',
    'description'   => esc_html__( 'Add widgets here.', 'road-runner' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget__title">',
    'after_title'   => '</h3>',
    ) );

  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar 6', 'road-runner' ),
    'id'            => 'sidebar-6',
    'description'   => esc_html__( 'Add widgets here.', 'road-runner' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget__title">',
    'after_title'   => '</h3>',
    ) );

  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar 7', 'road-runner' ),
    'id'            => 'sidebar-1=7',
    'description'   => esc_html__( 'Add widgets here.', 'road-runner' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget__title">',
    'after_title'   => '</h3>',
    ) );

  register_sidebar( array(
    'name'          => esc_html__( 'Sidebar 8', 'road-runner' ),
    'id'            => 'sidebar-8',
    'description'   => esc_html__( 'Add widgets here.', 'road-runner' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget__title">',
    'after_title'   => '</h3>',
    ) );
}

// Creating the widget 
class headline_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
// Base ID of your widget
      'headline_widget', 

// Widget name will appear in UI
      __('Headline Widget', 'wpb_widget_domain'), 

// Widget description
      array( 'description' => __( 'Does headlines on pages', 'wpb_widget_domain' ), ) 
      );
  }

// Creating widget front-end
// This is where the action happens
  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );

    echo '<section class="widget  widget--large  section--pattern-bg">';
    echo '<div class="headline">';
    echo '<h2 class="widget__title widget__headline  headline__main  headline__underline  text-primary">' . $title . '</h2>';
    echo '</div>';

// This is where you run the code and display the output
    echo '</section>';
  }

// Widget Backend 
  public function form( $instance ) {
    if ( isset( $instance[ 'title' ] ) ) {
      $title = $instance[ 'title' ];
    }
    else {
      $title = __( 'New title', 'wpb_widget_domain' );
    }
// Widget admin form
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <?php 
  }
  
// Updating widget replacing old instances with new
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    return $instance;
  }
} // Class wpb_widget ends here

// Register and load the widget
function wpb_load_widget() {
  register_widget( 'headline_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );