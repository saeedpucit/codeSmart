<?php
/**
 *
 * Set body class
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function theme_slug_setup() {
   			add_theme_support( 'title-tag' );
	}
	add_action( 'after_setup_theme', 'theme_slug_setup' );
}
if ( ! function_exists( 'mycoach_body_class_names' ) ) {
	function mycoach_body_class_names( $classes ) {
		$mycoach_options = mycoach_get_theme_options();
		$mycoach_boxed_layout = $mycoach_options['layout-type'] == 'boxed' ? 'boxed' : '';
		$mycoach_sticky_header = $mycoach_options['sticky-header'] ? 'sticky-header' : '';
		$mycoach_slider_effect = '';
		$mycoach_top_bar_tablets = $mycoach_options['hide-top-bar-tablets'] ? 'no-tablet-top-bar' : '';
		$mycoach_top_bar_mobiles = $mycoach_options['hide-top-bar-mobiles'] ? 'no-mobile-top-bar' : '';
		$classes[] = "$mycoach_boxed_layout $mycoach_sticky_header $mycoach_top_bar_tablets $mycoach_top_bar_mobiles";
		return $classes;
	}
	add_filter( 'body_class', 'mycoach_body_class_names' );
}
/**
 *
 * Get main menu
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'mycoach_main_menu' ) ) {
	function mycoach_main_menu( $onepage = false ) {
		$mycoach_options = mycoach_get_theme_options();
		if ( $mycoach_options['page_menu'] ) {
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( array( 'theme_location' => 'primary', 'mega' => true ) );
					} else {
							if ( has_nav_menu( 'one_page' ) ) {
									wp_nav_menu( array( 'theme_location' => 'one_page', 'mega' => true ) );
							}  else {
									wp_nav_menu( array( 'menu' => $mycoach_options['page_menu'], 'mega' => true ) );
							}
					}
					//wp_nav_menu( array( 'menu' => $mycoach_options['page_menu'], 'mega' => true ) );
		} else {
					if ( $onepage ) {
						if ( has_nav_menu( 'one_page' ) ) {
							wp_nav_menu( array( 'theme_location' => 'one_page', 'mega' => true ) );
						}
					} else {
						if ( has_nav_menu( 'primary' ) ) {

							wp_nav_menu( array( 'theme_location' => 'primary', 'mega' => true ) );
						}
					}
		}
	}
}
/**
 *
 * Get side menu start markup
 * @since 1.0.0
 * @version 1.0.0
 */
function mycoach_side_menu_start( $type ) {
	$from = ( $type == 'side-header-right' ) ? 'right' : 'left';
	echo '<div class="mp-pusher ' . $from . '" id="mp-pusher">';
	get_template_part( 'pro-framework/headers/side-header' );
	echo '<div class="scroller"><div class="inner-scroller">';
	get_template_part( 'pro-framework/headers/includes/side-menu-logo' );
}
/**
 *
 * Get side menu closing markup
 * @since 1.0.0
 * @version 1.0.0
 */
function mycoach_side_menu_end() {
	echo '</div></div></div>';
}
/**
 *
 * Get top menu
 * @since 1.0.0
 * @version 1.0.0
 */
function mycoach_top_menu() {
	$mycoach_menu_name = 'top_menu';
	if ( ( $mycoach_locations = get_nav_menu_locations() ) && isset( $mycoach_locations[ $mycoach_menu_name ] ) ) {
		$mycoach_menu = wp_get_nav_menu_object( $mycoach_locations[ $mycoach_menu_name ] );
		echo '<div class="right-navbar-nav">';
			wp_nav_menu( array( 'theme_location' => 'top_menu', 'container' => false, 'menu_class' => 'nav navbar-nav' ) );
		echo '</div>';
	};
}
/**
 *
 * Get search box
 * @since 1.0.0
 * @version 1.0.0
 */
function mycoach_search_box() {
	?>
	<div class="search-box">
		<a href="#" class="close-box fa fa-plus"></a>
		<div class="form-holder">
		<?php get_search_form(); ?>
		</div>
	</div>
	<?php
}
