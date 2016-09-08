<?php
/**
 *
 * Blog Layout "Masonry"
 *
 */
$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'isotope-item ' . mycoach_get_bootstrap( $mycoach_options['blog_column'] ) ); ?>>
		<div class="blog-masonry-border">
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
					break;
				case 'gallery':
					echo mycoach_post_gallery( get_the_content() );
					break;
				default:
					mycoach_post_thumbnail();
					break;
			}
			global $more;
			$more = 0;
			?>
		<div class="blog-masonry-content">
			<header class="entry-header">
				<?php if ( ! is_single() && $post_format != 'link' ) {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				} ?>
				<?php if ( $post_format == 'link' ) {
					echo wp_kses_post( $mycoach_title );
				} ?>
				<div class="entry-category"><?php mycoach_post_categories($post->ID); ?></div>
			</header>
			<!-- /entry-header -->
			<?php if ( has_excerpt() ) : ?>
				<div class="post-excerpt entry-summary">
			    	<?php 
			    		$mycoach_options = mycoach_get_theme_options(); 
			    		echo mycoach_sin_excerpt($mycoach_options['excerpt-length']); 
			    	?>
			    </div>	
		    <?php else : ?>
		    	<div class="entry-content"><?php the_content( esc_html__( 'Read More', 'mycoach' ) ); ?></div><!-- /entry-content -->
		    <?php endif; ?>
			<div class="entry-meta-footer">
				<?php mycoach_grid_type_meta(); ?>
			</div>
		</div>	
	</div>
</article>
<!-- /post-standard -->