<?php
#-----------------------------------------------------------------
# register menu & navigation
#-----------------------------------------------------------------

add_action('init', 'register_menu');

if( !function_exists( 'register_menu' ) ) :
    
  function register_menu() {
    register_nav_menu( 'primary-menu', __( 'Primary', 'progressive' ) );
  }
  
endif;