<?php
/**
 * Template Name: Left Sidebar Page
 */
get_header();
$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
$mycoach_left_sidebar = $mycoach_options["sidebar-left"];
$mycoach_layout = 'left';
?>
	<div class="container cont-padding">
		<div class="row">
			<?php mycoach_page_sidebar( 'left', $mycoach_layout, $mycoach_left_sidebar ); ?>
			<div class="col-md-9">
				<?php
				// Start the Loop.
				if ( have_posts() ) : ?>
					<?php while( have_posts() ) : the_post(); ?>
						<?php
						the_content();
						?>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
			<!-- col-md-9 -->
		</div>
		<!-- row -->
	</div><!-- container-fluid-->
<?php
get_footer();
