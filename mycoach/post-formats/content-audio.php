<?php
/**
 *
 * The template for displaying posts in the Audio post format
 * @since 1.0
 * @version 1.2.0
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col-md-12">
			<?php mycoach_post_thumbnail(); ?>
			<?php echo mycoach_post_media( get_the_content() ); ?>
			<div class="col-md-12" style="padding-left:0px;padding-right:0px;">
				<?php mycoach_full_top_meta( $post ); ?>
			</div>
			<div class="border">
				<?php if ( ! is_single() ) : ?>
					<div class="post-excerpt entry-summary"><?php $mycoach_options = mycoach_get_theme_options(); echo mycoach_sin_excerpt($mycoach_options['excerpt-length']); ?></div><!-- /entry-summary -->
				<?php else : ?>
					<div
						class="post-excerpt entry-content"><?php the_content( esc_html__( 'Read More', 'mycoach' ) ); ?></div><!-- /entry-content -->
					<?php mycoach_post_tags(); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php do_action( 'mycoach_post_format_content_after', $post ); ?>
</article>
<!-- /post-audio -->