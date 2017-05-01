<?php

/* ----------------------------------------------------- */
/* Include Theme Setup
/* ----------------------------------------------------- */

require_once ( FRAMEWORK_ROOT . '/theme-setup.php');

/* ----------------------------------------------------- */
/* Include Theme Assets
/* ----------------------------------------------------- */

require_once ( FRAMEWORK_ROOT . '/theme-assets.php');

/* ----------------------------------------------------- */
/* Include Theme Menus
/* ----------------------------------------------------- */

require_once ( FRAMEWORK_ROOT . '/theme-menus.php');

/* ----------------------------------------------------- */
/* Include Theme Widgets
/* ----------------------------------------------------- */

require_once ( FRAMEWORK_ROOT . '/theme-widgets.php');

/* ----------------------------------------------------- */ 
/* Include Theme Assets
/* ----------------------------------------------------- */

require_once ( FRAMEWORK_ROOT . '/theme-visual-composer-support.php');

/* ----------------------------------------------------- */
/* Include Theme Nav Walker
/* ----------------------------------------------------- */

require_once ( FRAMEWORK_ROOT . '/theme-walker.php');

/* ----------------------------------------------------- */
/* Include Theme Menu Edit Classes
/* ----------------------------------------------------- */

require_once ( FRAMEWORK_ROOT . '/lib/class-menu-item-custom-fields.php');
require_once ( FRAMEWORK_ROOT . '/lib/class-menu-item-custom-fields-example.php');

/* ----------------------------------------------------- */
/* Include Theme Options Framework */
/* ----------------------------------------------------- */

if ( !function_exists( 'optionsframework_init' ) ) {
  require_once ( FRAMEWORK_ROOT . '/admin/admin-init.php');
}