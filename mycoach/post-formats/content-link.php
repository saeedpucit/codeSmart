<?php
/**
 *
 * The template for displaying posts in the Image post format
 * @since 1.0
 * @version 1.2.0
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$mycoach_format = mycoach_post_format_link_helper( get_the_content(), get_the_title() );
	$mycoach_title = $mycoach_format['title'];
	?>
	<div class="row">
		<div class="col-md-12">
			<?php // if has post thumbnail, add link for thumbnail
			if ( has_post_thumbnail() ) {
				$mycoach_link = mycoach_get_link_attributes( $mycoach_title );
				mycoach_post_thumbnail( $mycoach_link );
			} ?>
			<div class="col-md-12" style="padding-left:0px;padding-right:0px;">
				<?php mycoach_full_top_meta( $post ); ?>
			</div>
			<div class="border">
				<?php if ( ! is_single() ) : ?>
					<div class="post-excerpt entry-summary"><?php $mycoach_options = mycoach_get_theme_options(); echo mycoach_sin_excerpt($mycoach_options['excerpt-length']); ?></div><!-- /entry-summary -->
				<?php else : ?>
					<div
						class="post-excerpt entry-content"><?php echo get_the_content( esc_html__( 'Read More', 'mycoach' ) ); ?></div><!-- /entry-content -->
					<div class="entry-meta-footer">
						<?php mycoach_post_tags(); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php do_action( 'mycoach_post_format_content_after', $post ); ?>
</article><!-- /post-link -->