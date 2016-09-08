<?php
/**
 *
 * The template for displaying archive pages.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
get_header(); ?>
<div class="container cont-padding">
	<div class="row">
		<?php
		if ( have_posts() ) {
			?>
			<div class="col-md-9">
				<?php
				// loop posts
				while( have_posts() ) : the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<div class="post-thumbnail"><?php the_post_thumbnail(); ?></div>
							<h2 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>"
							                           rel="bookmark"><?php the_title(); ?></a></h2>
							<div class="entry-meta">
								<?php mycoach_posted_on(); ?>
							</div>
						</header>
						<!-- /entry-header -->
						<div class="post-excerpt entry-summary"><?php the_excerpt(); ?></div>
						<!-- /entry-summary -->
					</article><!-- /post-standard -->
					<?php
				endwhile;
				// pagination
				mycoach_paging_nav( array( 'nav' => 'archive' ) );
				?>
			</div>
			<?php mycoach_page_sidebar(); ?>
			<?php
		} else {
			// If no content, include the "No posts found" template.
			get_template_part( 'post-formats/content', 'none' );
		};
		?>
	</div>
</div>
<div class="clearfix"></div>
<?php get_footer(); ?>
