<?php
/**
 *
 * Get Registered Sidebars
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_wp_registered_sidebars' ) ) {
	function mycoach_wp_registered_sidebars() {
		global $wp_registered_sidebars;
		$widgets = array();
		if ( ! empty( $wp_registered_sidebars ) ) {
			foreach ( $wp_registered_sidebars as $key => $value ) {
				$widgets[ $key ] = $value['name'];
			}
		}
		return array_reverse( $widgets );
	}
	add_action( 'admin_init', 'mycoach_wp_registered_sidebars' );
}
/**
 *
 * Get Image Sizes
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_get_image_sizes' ) ) {
	function mycoach_get_image_sizes( $force = false, $flip = true ) {
		$current_image_sizes = get_intermediate_image_sizes();
		foreach ( $current_image_sizes as $image_size ) {
			$dimenssion = ( in_array( $image_size, array(
				'thumbnail',
				'medium',
				'large'
			) ) ) ? ' - (' . get_option( $image_size . '_size_w' ) . 'x' . get_option( $image_size . '_size_h' ) . ')' : '';
			$image_sizes[ $image_size ] = $image_size . $dimenssion;
		}
		if ( $force ) {
			$get_custom_image_sizes = mycoach_get_images_custom_sizes();
			if ( ! empty( $get_custom_image_sizes ) ) {
				foreach ( $get_custom_image_sizes as $custom_size ) {
					$name = sanitize_title( $custom_size['name'] );
					$custom_image_sizes[ $name ] = $name . ' - (' . $custom_size['size']['width'] . 'x' . $custom_size['size']['height'] . ')';
				}
				$image_sizes = array_filter( array_merge( $image_sizes, $custom_image_sizes ) );
			}
		}
		$image_sizes['full'] = 'full (orginal size)';
		$image_sizes = ( $flip ) ? array_flip( $image_sizes ) : $image_sizes;
		return apply_filters( 'mycoach_custom_image_sizes', $image_sizes );
	}
}
/**
 *
 * CSS for redux bg field
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_get_images_custom_sizes' ) ) {
	function mycoach_get_images_custom_sizes() {
		return array(
			array(
				'crop' => true,
				'name' => 'MyCoach Blog Large',
				'size' => array(
					'width'  => 1140,
					'height' => 400
				)
			),
			array(
				'crop' => true,
				'name' => 'MyCoach Blog Small',
				'size' => array(
					'width'  => 262,
					'height' => 230
				)
			),
			array(
				'crop' => true,
				'name' => 'MyCoach Tiny',
				'size' => array(
					'width'  => 60,
					'height' => 60
				)
			)
		);
	}
}
/**
 *
 * Get revsliders
 * @since 1.0.0
 * @version 1.0.0
 *
 */
 if ( ! function_exists( 'mycoach_get_revsliders' ) ) {
	function mycoach_get_revsliders() {
		
		$revsliders = array();
		if (  function_exists( 'rev_slider_shortcode' ) ) {
				
				$slider = new RevSlider();
				$get_sliders = $slider->getArrSlidersShort();
				
				
				
				if ( $get_sliders ) {
					$revsliders['no-slider'] = 'No slider';
					foreach ( $get_sliders as $slider ) {
						$revsliders[ $slider->alias ] = $slider->title;
					}
				}
			
		} else {
			$revsliders[0] = 'Revolution slider is not active';
		}
		return $revsliders;
	}
}