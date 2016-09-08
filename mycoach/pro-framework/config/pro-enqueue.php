<?php
/**
 *
 * Admin Enqueue
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function mycoach_admin_scripts() {
	wp_enqueue_media();
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style( 'wp-jquery-ui-dialog' );
	wp_enqueue_style( 'pro-chosen', MYCOACH_FRAMEWORK_ASSETS . '/css/chosen.css', array(), '3.0.3', 'all' );
	wp_enqueue_style( 'pro-framework', MYCOACH_FRAMEWORK_ASSETS . '/css/pro-framework.css', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'pro-alert', MYCOACH_FRAMEWORK_ASSETS . '/css/pro-alert.css', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'font-awesome', MYCOACH_THEME_URI . '/css/vendor/font-awesome.css' );
	wp_enqueue_style( 'icomoon', MYCOACH_THEME_URI . '/css/vendor/icomoon.css' );
	wp_enqueue_script( 'pro-chosen', MYCOACH_FRAMEWORK_ASSETS . '/js/chosen.jquery.min.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'pro-framework', MYCOACH_FRAMEWORK_ASSETS . '/js/pro-framework.js' , array( 'jquery' ), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'mycoach_admin_scripts' );
/**
 * Enqueue styles
 * @since 1.0.0
 * @version 1.0.0
 */
function mycoach_styles() {
	$mycoach_options = mycoach_get_theme_options();
	wp_enqueue_style( 'bootstrap', MYCOACH_THEME_URI . '/css/vendor/bootstrap.css' );
	wp_enqueue_style( 'pro-main-style', MYCOACH_THEME_URI . '/style.css' );
	wp_enqueue_style( 'pro-framework', MYCOACH_FRAMEWORK_ASSETS . '/css/pro-framework.css', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'font-awesome', MYCOACH_THEME_URI . '/css/vendor/font-awesome.css' );
	wp_enqueue_style( 'icomoon', MYCOACH_THEME_URI . '/css/vendor/icomoon.css' );
	wp_enqueue_style( 'pro-responsive', MYCOACH_THEME_URI . '/css/responsive.css' );
	wp_enqueue_style( 'pro-menu' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_style( 'pro-dynamic', get_template_directory_uri() . '/css/dynamic.css' );
	wp_add_inline_style( 'pro-dynamic', page_modified_css() );
	wp_add_inline_style( 'pro-dynamic', mycoach_custom_css() );
	if ( is_child_theme() ) {
		wp_enqueue_style( 'pro-pro', get_stylesheet_uri() );
	}
}
add_action( 'wp_enqueue_scripts', 'mycoach_styles');
/**
 * Enqueue scripts
 */
function mycoach_scripts() {
	if( !class_exists('redux') ){

		if ( ! is_admin() ) {
        $dev = false;
        wp_enqueue_script( 'modernizr', MYCOACH_THEME_URI . '/js/vendor/modernizr.custom.js', array(), '1.0.0' );
        wp_enqueue_script( 'pro-menu', MYCOACH_THEME_URI . '/js/menu.js', array( 'jquery' ), '1.0.0', true );
        if ( $dev ) {
        } else {
        wp_enqueue_script( 'pro-plugins-min', MYCOACH_THEME_URI . '/js/jquery.plugins.min.js', array( 'jquery' ), '1.0.0', true );
        }
        // Enqueue
        wp_enqueue_script( 'bootstrap', MYCOACH_THEME_URI . '/js/vendor/bootstrap.min.js', array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script( 'modernizr' );
        // Enqueue
        wp_enqueue_script( 'addthis', '//s7.addthis.com/js/300/addthis_widget.js#pubid=' . '#asyncload', array( 'jquery' ), '1.0.0', false );

        wp_enqueue_script( 'pro-script', MYCOACH_THEME_URI . '/js/jquery.script.js', array( 'jquery' ), '1.0.0', true );
        wp_localize_script( 'pro-script', 'mycoach_ajax', array(
        'ajaxurl'      => admin_url( 'admin-ajax.php' ),
        'sticky'       => 1,
        'compactMenu'  => is_compact_menu(),
        'footerEffect' => '',
        'showFooter'   => 1
        ) );
      };

	}else{
			$mycoach_options = mycoach_get_theme_options();
			if ( ! is_admin() ) {
				$dev = false;
				wp_enqueue_script( 'modernizr', MYCOACH_THEME_URI . '/js/vendor/modernizr.custom.js', array(), '1.0.0' );
				wp_enqueue_script( 'pro-menu', MYCOACH_THEME_URI . '/js/menu.js', array( 'jquery' ), '1.0.0', true );
				if ( $dev ) {
				} else {
					wp_enqueue_script( 'pro-plugins-min', MYCOACH_THEME_URI . '/js/jquery.plugins.min.js', array( 'jquery' ), '1.0.0', true );
				}
				// Enqueue
				wp_enqueue_script( 'bootstrap', MYCOACH_THEME_URI . '/js/vendor/bootstrap.min.js', array( 'jquery' ), '1.0.0', true );
				wp_enqueue_script( 'modernizr' );
				// Enqueue
				if ( $mycoach_options['enable-share'] && $mycoach_options['addthis-id'] ) {
					wp_enqueue_script( 'addthis', '//s7.addthis.com/js/300/addthis_widget.js#pubid=' . esc_attr( $mycoach_options['addthis-id'] ) . '#asyncload', array( 'jquery' ), '1.0.0', false );
				};
				wp_enqueue_script( 'pro-script', MYCOACH_THEME_URI . '/js/jquery.script.js', array( 'jquery' ), '1.0.0', true );
				wp_localize_script( 'pro-script', 'mycoach_ajax', array(
					'ajaxurl'      => admin_url( 'admin-ajax.php' ),
					'sticky'       => $mycoach_options['sticky-header'],
					'compactMenu'  => is_compact_menu(),
					'footerEffect' => (bool) $mycoach_options['footer-fixed-effect'],
					'showFooter'   => (bool) $mycoach_options['show-footer']
				) );
			};

		} //end else of not redux exist
}
add_action( 'wp_enqueue_scripts', 'mycoach_scripts' );
/**
 *
 * Enqueue Inline Styles
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_enqueue_inline_styles' ) ) {
	function mycoach_enqueue_inline_styles() {
		global $mycoach_inline_styles;
		if ( ! empty( $mycoach_inline_styles ) ) {
			echo '<style id="custom-shortcode-css" type="text/css">' . mycoach_css_compress( join( '', $mycoach_inline_styles ) ) . '</style>';
		}
	}
	add_action( 'wp_footer', 'mycoach_enqueue_inline_styles',21 );
}
/**
 *
 * Deque styles
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function mycoach_deque_styles() {
	if ( wp_style_is( 'select2-css', $list = 'enqueued' ) ) {
		wp_dequeue_style( 'woocomposer-select2' ); // remove select2 from Ultimate_VC_Addons
	}
}
add_action( 'admin_enqueue_scripts', 'mycoach_deque_styles' );
/**
 *
 * Deque scripts
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function mycoach_dequeue_script() {
	if ( wp_script_is( 'select2-js', $list = 'enqueued' ) ) {
		wp_dequeue_script( 'woocomposer-select2-js' ); // remove select2 from Ultimate_VC_Addons
	}
}
add_action( 'wp_enqueue_scripts', 'mycoach_dequeue_script', 100 );
/**
 *
 * Custom css
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_custom_css' ) ) {
	function mycoach_custom_css() {
		$mycoach_options = mycoach_get_theme_options();
		$output = '';
		$output .= mycoach_css_compress( $mycoach_options['pure-css-code'] );
		return $output;
	}
}
