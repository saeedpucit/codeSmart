<?php
/**
 *
 * PROFramework Sidebars API
 * @since 1.0.0
 * @version 1.0.1
 *
 */
class NETBEEFramework_Sidebars_API extends NETBEEFramework_Abstract {
	public $options;
	public function __construct() {
		$this->register_default_sidebars();
		$this->register_footer_sidebars();
		$this->register_custom_sidebars();
	}
	/**
	 *
	 * Register Default Sidebars
	 * @since 1.0.0
	 * @version 1.0.0
	 *
	 */
	public function register_default_sidebars() {
		$defaults = array(
			'sidebar-1' => 'Primary Sidebar',
			'sidebar-2' => 'Secondary Sidebar'
		);
		foreach ( $defaults as $key => $name ) {
			register_sidebar( array(
				'id'            => $key,
				'name'          => $name,
				'description'   => 'Drag widgets for all of pages sidebar',
				'before_widget' => '<div class="netbee_widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title"><h4>',
				'after_title'   => '</h4></div>'
			) );
		}
	}
	/**
	 *
	 * Register Footer Sidebars
	 * @since 1.0.0
	 * @version 1.0.1
	 *
	 */
	public function register_footer_sidebars() {
		$mycoach_options = mycoach_get_theme_options();
		$sidebars = isset( $mycoach_options['footer-widgets'] ) ? $mycoach_options['footer-widgets'] : array();
		if ( $sidebars ) {
			switch ( $sidebars ) {
				case 5:
					$length = 6;
					break;
				case 6:
				case 7:
				case 8:
					$length = 3;
					break;
				case 9:
				case 10:
					$length = 4;
					break;
				default:
					$length = $sidebars;
					break;
			}
			for ( $i = 0; $i < $length; $i ++ ) {
				$num = ( $i + 1 );
				register_sidebar( array(
					'id'            => 'footer-' . $num,
					'name'          => 'Footer Widget ' . $num,
					'description'   => 'Appears in the footer section of the site',
					'before_widget' => '<div class="netbee_widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="widget-title"><h4>',
					'after_title'   => '</h4></div>'
				) );
			}
		}
	}
	/**
	 *
	 * Register Custom Sidebars
	 * @since 1.0.0
	 * @version 1.0.0
	 *
	 */
	public function register_custom_sidebars() {
		$mycoach_options = mycoach_get_theme_options();
		$get_custom_sidebars = isset( $mycoach_options['custom-sidebars'] ) ? $mycoach_options['custom-sidebars'] : array();
		if ( $get_custom_sidebars ) {
			foreach ( $get_custom_sidebars as $key => $sidebar_name ) {
				
				register_sidebar( array(
					'id'            => sanitize_title( $sidebar_name ),
					'name'          => $sidebar_name,
					'description'   => 'Drag widgets for all of pages sidebar',
					'before_widget' => '<div class="netbee_widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="widget-title"><h4>',
					'after_title'   => '</h4></div>'
				) );
			}
		}
	}
}
new NETBEEFramework_Sidebars_API();