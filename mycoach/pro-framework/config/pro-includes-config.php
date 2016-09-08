<?php

/**

 *

 * Load all of shortcode from folder

 * @since 1.0.0

 * @version 1.1.0

 *

 */

//

// Require plugin.php to use is_plugin_active() below

// ----------------------------------------------------------------------------------------------------


//

// Custom Style Adapted

// ----------------------------------------------------------------------------------------------------

get_template_part( 'pro-framework/includes/custom-style');

//

// woocommerce integration

// ----------------------------------------------------------------------------------------------------
if (  class_exists( 'WooCommerce' ) ) {
	get_template_part( 'pro-framework/plugins/woocommerce/woocommerce-config');
}
//

// Theme Check Themeforest API KEY

// ----------------------------------------------------------------------------------------------------

$mycoach_username = mycoach_get_option( 'themeforest-username' );

$mycoach_apikey = mycoach_get_option( 'themeforest-api-key' );

if ( ! empty( $mycoach_username ) && ! empty( $mycoach_apikey ) ) {

	get_template_part( 'pro-framework/plugins/pro-theme-updater/pro-theme-updater');

}