<?php
/**
 *
 * Template Name: One-Page Template
 *
 */
get_header();
?>
	<div class="container cont-padding">
		<div class="row">
			<div class="col-md-12">
				<?php
				if ( have_posts() ) : ?>
					<?php while( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
			<!-- col-md-12 -->
		</div>
		<!-- row -->
	</div><!-- container-->
<?php
//
// Fixed Navigation
// -------------------------------------------------------------------------------------------
$mycoach_location = apply_filters( 'mycoach_one_page_location', 'one_page' );
if ( ( $mycoach_locations = get_nav_menu_locations() ) && isset( $mycoach_locations[ $mycoach_location ] ) ) {
	$mycoach_menu_object = wp_get_nav_menu_object( $mycoach_locations[ $mycoach_location ] );
	if ( is_object( $mycoach_menu_object ) ) {
		$mycoach_menu_items = wp_get_nav_menu_items( $mycoach_menu_object->term_id );
		$mycoach_nav_list = '<nav id="pro-fixed-nav">';
		$mycoach_nav_list .= '<ul>';
		if ( ! empty( $mycoach_menu_items ) ) {
			foreach ( $mycoach_menu_items as $mycoach_menu_item ) {
				$mycoach_nav_list .= '<li><a href="' . $mycoach_menu_item->url . '" data-toggle="tooltip" data-original-title="' . $mycoach_menu_item->title . '" data-placement="left"></a></li>';
			}
		}
		$mycoach_nav_list .= '</ul>';
		$mycoach_nav_list .= '</nav><!-- /pro-fixed-nav -->';
		echo wp_kses_post( $mycoach_nav_list );
	}
}
?>
<?php get_footer(); ?>