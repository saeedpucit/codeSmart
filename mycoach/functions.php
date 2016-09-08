<?php
/*
 * Theme functions and definitions
 *
 * @package mycoach
 */
include_once( get_template_directory() . '/pro-framework/init.php');

function mycoach_remove_redux_framework_notification() {
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
    }
}
add_action('init', 'mycoach_remove_redux_framework_notification');


/* ======  Comments enable for single static page - it enable have_comments() function ====== */
add_filter( 'comments_open', 'mycoach_comments_open', 11, 2 );
function mycoach_comments_open( $open, $post_id ) {

	$post = get_post( $post_id );

	if ( 'page' == $post->post_type )
		$open = false;

	return $open;
}

/* ========= Remove logo control and menu panel from customizer ======== */
function mycoach_remove_customizer_logo( $wp_customize ){
	$wp_customize->remove_control('custom_logo');
}
add_action( 'customize_register', 'mycoach_remove_customizer_logo', 20 );
?>
