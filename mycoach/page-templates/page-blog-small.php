<?php
/**
 *
 * Blog Layout "Alternative"
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="col-md-4">
			<div class="entry-meta">
				<?php
				$post_format = get_post_format();
				switch ( $post_format ) {
					case 'audio':
						mycoach_post_thumbnail();
						echo mycoach_post_media( get_the_content() );
						break;
					case 'video':
						echo mycoach_post_media( get_the_content() );
						break;
					case 'link':
						$mycoach_format = mycoach_post_format_link_helper( get_the_content(), get_the_title() );
						$mycoach_title = $mycoach_format['title'];
						// if has post thumbnail, add link for thumbnail
						if ( has_post_thumbnail() ) {
							$mycoach_link = mycoach_get_link_attributes( $mycoach_title );
							mycoach_post_thumbnail( $mycoach_link );
						}
						echo wp_kses_post( $mycoach_title );
						break;
					case 'gallery':
						echo mycoach_post_gallery( get_the_content() );
						break;
					default:
						mycoach_post_thumbnail();
						break;
				} ?>
			</div>
			</header>
		</div>
		<div class="col-md-8">
			<header class="entry-header">
				<?php
				if ( $post_format != 'link' ) {
					the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><h2 class="entry-title">', '</h2></a>' );
				}
				?>
				<div class="entry-category"><?php mycoach_post_categories($post->ID); ?></div>
			</header>
			<div class="post-excerpt entry-summary">
				<?php $mycoach_options = mycoach_get_theme_options(); echo mycoach_sin_excerpt($mycoach_options['excerpt-length']); ?>
			</div>
			<div class="entry-meta-footer bottom">
				<?php mycoach_medium_type_meta(); ?>
			</div>
		</div>
	</div>
</article>
<!-- /post-standard -->