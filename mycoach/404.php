<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package pro
 */
get_header();
// Check theme options for existence
$mycoach_options = mycoach_get_theme_options();
?>
<div class="container cont-padding">
	<div class="row">
		<div class="col-md-12">
			<article id="post-404" class="post-not-found pro-error-404">
				<div class="entry-content text-center">
					<?php
					if ( isset($mycoach_options['page-404-image']['url']) && $mycoach_options['page-404-image']['url'] ) {
						?>
						<div class="pro-404-image">
							<img src="<?php echo esc_url( $mycoach_options['page-404-image']['url'] ); ?>" alt="<?php echo esc_html__( '404', 'mycoach' ); ?>">
						</div>
						<?php
					} else {
						?>
						<h1 class="pro-404"><?php echo wp_kses_post( $mycoach_options['page-404-title'] ); ?></h1>
						<?php
					}
					?>
					<h2 class="pro-not-found"><?php echo wp_kses_post( $mycoach_options['page-404-error-text'] ); ?></h2>
					<hr/>
					<p><?php echo wp_kses_post( $mycoach_options['page-404-sub-text'] ); ?></p>
					<?php get_search_form(); ?>
					<hr/>
					<a href="javascript:history.go(-1)"
					   class="<?php echo mycoach_get_button_class(); ?>"><?php esc_html_e( 'Return Back', 'mycoach' ); ?>
					</a>
				</div>
				<!-- /entry-content -->
			</article>
			<!-- /article -->
		</div>
	</div>
</div>
<?php get_footer(); ?>
