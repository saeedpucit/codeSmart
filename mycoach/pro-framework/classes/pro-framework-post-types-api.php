<?php
/**
 *
 * PROFramework Post Types API
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class PROFramework_Post_Types_API extends NETBEEFramework_Abstract {
	public function __construct() {
		$this->mycoach_add_action( 'init', 'register_portfolio', 0 );
		$this->mycoach_add_filter( 'manage_edit-portfolio_columns', 'edit_thumbnail_columns' );
		$this->mycoach_add_filter( 'manage_posts_custom_column', 'manage_thumbnail_columns' );
	}
	/**
	 *
	 * Portfolio Thumbnail Title
	 * @since 1.0.0
	 * @version 1.0.0
	 *
	 */
	public function edit_thumbnail_columns( $cols ) {
		$cols['pro-thumbnail'] = 'Thumb';
		return $cols;
	}
	/**
	 *
	 * Portfolio Thumbnail Column
	 * @since 1.0.0
	 * @version 1.0.0
	 *
	 */
	public function manage_thumbnail_columns( $cols ) {
		global $post;
		if ( $cols == 'pro-thumbnail' ) {
			echo '<a href="' . get_edit_post_link( $post->ID ) . '">' . get_the_post_thumbnail( $post->ID, array(
					35,
					35
				) ) . '</a>';
		}
		return $cols;
	}
}
