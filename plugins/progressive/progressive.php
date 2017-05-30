<?php
/*
 * Plugin Name: Progressive Dental
 * Version: 1.0.0
 * Plugin URI: http://progressivedental.com
 * Description: Adds core theme functionality for all progressive dental templates.
 * Author: Progressive Dental Team
 * Author URI: http://progressivedental.com
 * Text Domain: progressive
 *
 * @package WordPress
 * @author Progressive Dental
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

require_once( 'includes/class-progressive.php' );

define( 'PROGRESSIVE_PLUGIN_PATH', DIRNAME( __FILE__ ) );
define( 'PROGRESSIVE_URL', trailingslashit( plugins_url( '', __FILE__ ) ) );
define( 'PROGRESSIVE_VIEWS_DIR', plugin_dir_path(__FILE__) . 'includes/admin/views/' );

/**
 * Retruns the main instance of Progressive to prevent the need to use globals.
 *
 * @since 1.0.0
 * @return object Progressive
 */
function Progressive() {
  return Progressive::instance( __FILE__, '1.0.0' );
}

Progressive();