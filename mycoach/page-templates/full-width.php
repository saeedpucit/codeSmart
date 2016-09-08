<?php
/**
 * Template Name: Full Width Page
 */
get_header(); ?>
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
get_footer();
