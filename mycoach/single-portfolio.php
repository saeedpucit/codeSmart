<?php
/**
 *
 * The Template for displaying all single posts.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
get_header();
$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
$mycoach_right_sidebar = $mycoach_options["sidebar-right"];
$mycoach_left_sidebar = $mycoach_options["sidebar-left"];
$mycoach_layout = $mycoach_options["layout"];
if ( $mycoach_layout == 'full' || $mycoach_layout == 'full-100' ) {
	$mycoach_page_column = '12';
} else if ( $mycoach_layout == 'left' || $mycoach_layout == 'right' ) {
	$mycoach_page_column = '9';
} else if ( $mycoach_layout == 'both' ) {
	$mycoach_page_column = '6';
}
$mycoach_container = $mycoach_layout == 'full-100' ? "container-fluid" : "container";
?>
	<div class="single-portofolio">
		<div class="<?php echo esc_attr( $mycoach_container ) ?> cont-padding">
			<div class="row">
				<?php mycoach_page_sidebar( 'left', $mycoach_layout, $mycoach_left_sidebar ); ?>
				<div class="col-md-<?php echo esc_attr( $mycoach_page_column ); ?>">
					<div class="page-content">
						<?php
						while( have_posts() ) : the_post();
							the_content();
							do_action( 'mycoach_portfolio_format_content_after', $post );
							mycoach_link_pages();
							if ( ( $mycoach_options['show-comments-portofolio'] ) && ( comments_open() || '0' != get_comments_number() ) ) {
								comments_template( '', true );
							}
							do_action( 'mycoach_portfolio_item_end' );
						endwhile;
						?>
					</div>
				</div>
				<?php
				if ( $mycoach_options['show-previous-next-pagination'] ) {
					// prev and next posts
					$mycoach_prev = get_previous_post( true, null, 'portfolio-category' );
					$mycoach_next = get_next_post( true, null, 'portfolio-category' );
					?>
					<nav class="nav-portfolio">
						<?php if ( ! empty( $mycoach_prev ) ): ?>
							<a class="pro-prev" href="<?php echo esc_url(get_permalink( $mycoach_prev->ID )); ?>">
								<i class="fa fa-chevron-left"></i>
							<span class="pro-wrap">
								<span class="pro-title"><?php echo wp_kses_post( $mycoach_prev->post_title ); ?></span>
								<?php echo get_the_post_thumbnail( $mycoach_prev->ID, array( 80, 80 ) ); ?>
							</span>
							</a>
						<?php endif; ?>
						<?php if ( ! empty( $mycoach_next ) ): ?>
							<a class="pro-next" href="<?php echo esc_url(get_permalink( $mycoach_next->ID )); ?>">
								<i class="fa fa-chevron-right"></i>
			  <span class="pro-wrap">
				<span class="pro-title"><?php echo wp_kses_post( $mycoach_next->post_title ); ?></span>
				  <?php echo get_the_post_thumbnail( $mycoach_next->ID, array( 80, 80 ) ); ?>
			  </span>
							</a>
						<?php endif; ?>
					</nav>
				<?php }; ?>
				<?php mycoach_page_sidebar( 'right', $mycoach_layout, $mycoach_right_sidebar ); ?>
			</div>
		</div>
	</div>
<?php
get_footer();