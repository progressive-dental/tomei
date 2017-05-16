<?php
/**
 * Road Runner functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package shaggy_reynolds
 */

#-----------------------------------------------------------------
# default theme constants & repeating variables - do not change!
#-----------------------------------------------------------------
define( 'THEME_NAME', 'Shaggy Rogers' );
define( 'THEME_VERSION', '1.0.0' );
define( 'THEME_WEB_ROOT', get_template_directory_uri() );
define( 'THEME_ROOT', get_template_directory() );
define( 'FRAMEWORK_ROOT', THEME_ROOT . '/framework' );
define( 'FRAMEWORK_WEB_ROOT', get_template_directory_uri() . '/framework' );
define( 'THEME_ASSETS', THEME_ROOT . '/assets' );
define( 'THEME_ASSETS_IMAGES', THEME_ASSETS . '/images' );
define( 'THEME_ASSETS_CSS', THEME_ASSETS . '/css' );
define( 'THEME_ASSETS_JS', THEME_ASSETS . '/js' );
define( 'THEME_ASSETS_FONTS', THEME_ASSETS . '/fonts' );
define( 'THEME_VC_ROOT', THEME_ROOT . '/vc_templates' );

require_once( THEME_ROOT . '/framework/functions.php' );
function _remove_script_version( $src ){
$parts = explode( '?ver', $src );
return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );