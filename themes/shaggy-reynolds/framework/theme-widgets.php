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