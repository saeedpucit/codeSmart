<?php
/**
 * Template Name: Full Width 100% Page
 */
get_header(); ?>
	<div class="container-fluid cont-padding">
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
	</div><!-- container-fluid-->
<?php
get_footer();
