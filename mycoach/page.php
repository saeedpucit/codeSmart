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
	<div class="<?php echo esc_attr( $mycoach_container ) ?> cont-padding">
		<div class="row">

			<?php mycoach_page_sidebar( 'left', $mycoach_layout, $mycoach_left_sidebar ); ?>
			<div class="col-md-<?php echo esc_attr( $mycoach_page_column ) ?>">
				<div class="page-content">
					<?php
					// Start the Loop.
					while( have_posts() ) : the_post();
						mycoach_page_featured_image();
						the_content();
						do_action( 'mycoach_page_end' );
					endwhile;
					?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
					?>
				</div>
			</div>

			<?php mycoach_page_sidebar( 'right', $mycoach_layout, $mycoach_right_sidebar ); ?>
		</div>
	</div>
<?php
get_footer();
