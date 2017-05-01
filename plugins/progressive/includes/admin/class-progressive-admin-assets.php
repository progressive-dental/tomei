<?php
/**
 * Load assets.
 *
 * @author      Progressive
 * @category    Admin
 * @package     Progressive/Admin
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

if ( ! class_exists( 'Progressive_Admin_Assets' ) ) :

/**
 * Progressive_Admin_Assets Class
 */
class Progressive_Admin_Assets {

  /**
   * Hook in tabs.
   */
  public function __construct() {
    add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );
    add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
  }

  /**
   * Enqueue styles
   */
  public function admin_styles() {


    // Sitewide menu CSS
    wp_enqueue_style( 'progressive_admin_menu_styles', PROGRESSIVE_URL . '/assets/css/admin.css', array(), '1.0.0' );

  }


  /**
   * Enqueue scripts
   */
  public function admin_scripts() {

    //wp_enqueue_script( 'tracks-jquery-ui','//code.jquery.com/ui/1.11.4/jquery-ui.js', null, false );
    wp_enqueue_script( 'progressive_admin_menu_scripts', PROGRESSIVE_URL . '/assets/js/admin.js', null, false );


  }

}

endif;

return new Progressive_Admin_Assets();