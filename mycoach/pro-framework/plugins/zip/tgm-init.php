<?php
/**
 * TGM Init Class
 */
get_template_part( 'pro-framework/plugins/zip/class','tgm-plugin-activation' );
add_action( 'tgmpa_register', 'mycoach_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function mycoach_register_required_plugins() {
	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'     => esc_html__( 'WPBakery Visual Composer', 'mycoach' ),
			'slug'     => 'js_composer',
			'source'   => esc_url( 'http://mycoach.netbee.co/plugins/js_composer.zip' ),
			'required' => true,
		),
		array(
			'name'     => esc_html__( 'Ultimate Addons for Visual Composer', 'mycoach' ),
			'slug'     => 'Ultimate_VC_Addons',
			'source'   => esc_url( 'http://mycoach.netbee.co/plugins/ultimate.zip' ),
			'required' => true,
		),
		array(
			'name'     => esc_html__( 'Revolution Slider', 'mycoach' ),
			'slug'     => 'revslider',
			'source'   => esc_url( 'http://mycoach.netbee.co/plugins/revslider.zip' ),
			'required' => true,
		),
		array(
			'name'		=>	esc_html__('Netbee Core', 'mycoach'),
			'slug'		=> 'netbee-core',
			'source'	=> esc_url( 'http://mycoach.netbee.co/plugins/netbee-core.zip' ),
			'required'	=> true
		),

		array(
			'name'     => esc_html__( 'WooCommerce', 'mycoach' ),
			'slug'     => 'woocommerce',
			'required' => true,
		),

		// Breadcrumb NavXT
		array(
			'name'     => esc_html__( 'Breadcrumb NavXT', 'mycoach' ),
			'slug'     => 'breadcrumb-navxt',
			'required' => true,
		),

		// Regenerate Thumbnails
		array(
			'name'     => esc_html__( 'Regenerate Thumbnails', 'mycoach' ),
			'slug'     => 'regenerate-thumbnails',
			'required' => false,
		),
		// Contact Form 7
		array(
			'name'     => esc_html__( 'Contact Form 7', 'mycoach' ),
			'slug'     => 'contact-form-7',
			'required' => false,
		),

		// YITH Woocommerce Compare
		array(
			'name'     => esc_html__( 'YITH Woocommerce Compare', 'mycoach' ),
			'slug'     => 'yith-woocommerce-compare',
			'required' => false,
		),
		// YITH WooCommerce Wishlist
		array(
			'name'     => esc_html__( 'YITH WooCommerce Wishlist', 'mycoach' ),
			'slug'     => 'yith-woocommerce-wishlist',
			'required' => false,
		),
		// YITH WooCommerce Zoom Magnifier
		array(
			'name'     => esc_html__( 'YITH WooCommerce Zoom Magnifier', 'mycoach' ),
			'slug'     => 'yith-woocommerce-zoom-magnifier',
			'required' => false,
		),
		// WP User Avatar
		array(
			'name'     => esc_html__( 'WP User Avatar', 'mycoach' ),
			'slug'     => 'wp-user-avatar',
			'required' => false,
		),
	);
	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'default_path' => '',
		// Default absolute path to pre-packaged plugins.
		'menu'         => 'tgmpa-install-plugins',
		// Menu slug.
		'has_notices'  => true,
		// Show admin notices or not.
		'dismissable'  => true,
		// If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',
		// If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,
		// Automatically activate plugins after installation or not.
		'message'      => '',
		// Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'mycoach' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'mycoach' ),
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'mycoach' ),
			// %s = plugin name.
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'mycoach' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'mycoach'  ),
			// %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'mycoach'  ),
			// %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'mycoach'  ),
			// %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'mycoach'  ),
			// %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'mycoach'  ),
			// %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'mycoach'  ),
			// %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'mycoach'  ),
			// %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' , 'mycoach' ),
			// %1$s = plugin name(s).
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'mycoach'  ),
			'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'mycoach'  ),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'mycoach' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'mycoach' ),
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'mycoach' ),
			// %s = dashboard link.
			'nag_type'                        => 'updated'
			// Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'mycoach_register_required_plugins' );
