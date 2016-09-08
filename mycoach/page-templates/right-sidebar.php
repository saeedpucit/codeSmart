<?php
/**
 * Template Name: Right Sidebar Page
 */
get_header(); ?>
<?php
$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
$mycoach_right_sidebar = $mycoach_options["sidebar-right"];
$mycoach_layout = 'right';
?>
	<div class="container cont-padding">
		<div class="row">
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
			<?php mycoach_page_sidebar( 'right', $mycoach_layout, $mycoach_right_sidebar ); ?>
		</div>
		<!-- row -->
	</div><!-- container-fluid-->
<?php
get_footer();
