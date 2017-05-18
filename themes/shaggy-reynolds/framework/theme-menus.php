<?php
#-----------------------------------------------------------------
# register menu & navigation
#-----------------------------------------------------------------

add_action('init', 'register_menu');

if( !function_exists( 'register_menu' ) ) :
    
  function register_menu() {
    register_nav_menus( 
      array(
        'primary-menu' => __( 'Primary', 'progressive' ),
        'contact-menu' => __( 'Contact Menu', 'progressive' ),
        'footer-menu-1' => __( 'Footer Menu 1', 'progressive' ),
        'footer-menu-2' => __( 'Footer Menu 2', 'progressive' ),
        'footer-menu-3' => __( 'Footer Menu 3', 'progressive' ) 
      )
    );
  }
  
endif;