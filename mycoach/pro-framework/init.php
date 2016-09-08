<?php
#-----------------------------------------------------------------#
# Default theme constants
#-----------------------------------------------------------------#
defined( 'MYCOACH_THEME_DIR' ) or define( 'MYCOACH_THEME_DIR', get_template_directory() );
defined( 'MYCOACH_THEME_URI' ) or define( 'MYCOACH_THEME_URI', get_template_directory_uri() );
defined( 'MYCOACH_FRAMEWORK_DIR' ) or define( 'MYCOACH_FRAMEWORK_DIR', MYCOACH_THEME_DIR . '/pro-framework' );
defined( 'MYCOACH_FRAMEWORK_URI' ) or define( 'MYCOACH_FRAMEWORK_URI', MYCOACH_THEME_URI . '/pro-framework' );
defined( 'MYCOACH_FRAMEWORK_ASSETS' ) or define( 'MYCOACH_FRAMEWORK_ASSETS', MYCOACH_THEME_URI . '/pro-framework/assets' );
defined( 'MYCOACH_FRAMEWORK_INCLUDE_DIR' ) or define( 'MYCOACH_FRAMEWORK_INCLUDE_DIR', MYCOACH_THEME_DIR . '/pro-framework/includes' );
defined( 'MYCOACH_FRAMEWORK_INCLUDE_URI' ) or define( 'MYCOACH_FRAMEWORK_INCLUDE_URI', MYCOACH_THEME_URI . '/pro-framework/includes' );
defined( 'MYCOACH_FRAMEWORK_PLUGIN_DIR' ) or define( 'MYCOACH_FRAMEWORK_PLUGIN_DIR', MYCOACH_THEME_DIR . '/pro-framework/plugins' );
defined( 'MYCOACH_FRAMEWORK_PLUGIN_URI' ) or define( 'MYCOACH_FRAMEWORK_PLUGIN_URI', MYCOACH_THEME_URI . '/pro-framework/plugins' );
defined( 'MYCOACH_FRAMEWORK_HEADERS_DIR' ) or define( 'MYCOACH_FRAMEWORK_HEADERS_DIR', MYCOACH_THEME_DIR . '/pro-framework/headers' );
defined( 'MYCOACH_FRAMEWORK_HEADERS_URI' ) or define( 'MYCOACH_FRAMEWORK_HEADERS_URI', MYCOACH_THEME_URI . '/pro-framework/headers' );
defined( 'MYCOACH_OPTION_NAME' ) or define( 'MYCOACH_OPTION_NAME', 'netbee_options' );

//include( MYCOACH_FRAMEWORK_DIR. '/netbee-core/init.php' );

if (  function_exists( 'netbee_core_plugin_url' ) ) {
		Redux::init( MYCOACH_OPTION_NAME );
}

include( MYCOACH_FRAMEWORK_DIR. '/config/pro-helper-functions.php' );
include( MYCOACH_FRAMEWORK_DIR. '/config/pro-redux-helpers.php' );
include( MYCOACH_FRAMEWORK_DIR. '/classes/pro-framework-abstract.class.php' );
include( MYCOACH_FRAMEWORK_DIR. '/classes/pro-framework-mega-menu-api.php' );
include( MYCOACH_FRAMEWORK_DIR. '/classes/pro-framework-post-types-api.php' );
include( MYCOACH_FRAMEWORK_DIR. '/classes/pro-framework-sidebars-api.php' );
if ( file_exists( MYCOACH_FRAMEWORK_PLUGIN_DIR . '/zip/tgm-init.php' ) ) {
	include( MYCOACH_FRAMEWORK_PLUGIN_DIR. '/zip/tgm-init.php' );
}
// is admin init
function mycoach_is_admin_init() {
	include( MYCOACH_FRAMEWORK_DIR. '/classes/pro-framework-shortcodes-api.php' );
	include( MYCOACH_FRAMEWORK_DIR. '/classes/pro-framework-actions-api.php' );
	include( MYCOACH_FRAMEWORK_DIR. '/config/pro-shortcode-config.php' );
}
add_action( 'admin_init', 'mycoach_is_admin_init' );
// functions
include( MYCOACH_FRAMEWORK_DIR. '/config/pro-includes-config.php' );
include( MYCOACH_FRAMEWORK_DIR. '/config/pro-enqueue.php' );
include( MYCOACH_FRAMEWORK_DIR. '/config/pro-filters-config.php' );
include( MYCOACH_FRAMEWORK_DIR. '/config/pro-actions-config.php' );
include( MYCOACH_FRAMEWORK_DIR. '/config/pro-template-functions.php' );
include( MYCOACH_FRAMEWORK_DIR. '/config/pro-front-end-functions.php' );
include( MYCOACH_FRAMEWORK_DIR. '/config/pro-post-formats-helper.php' );
include( MYCOACH_FRAMEWORK_DIR. '/config/pro-customize.php' );
?>
