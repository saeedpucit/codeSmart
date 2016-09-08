<?php
/**
 *
 * The template for displaying Comments
 * The area of the page that contains comments and the comment form.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
/*
 * If the current post is protected by a password and the visitor has not yet entered the password we
 * will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="clearfix"></div>
<div id="comments" class="comments-area">
				<?php if ( have_comments() ) : ?>
							<div class="pro-fancy-separator title-left fancy-comments-title">
									<div class="pro-fancy-title"><?php printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'mycoach' ), number_format_i18n( get_comments_number() ), get_the_title() ); ?>
											<span class="separator-holder separator-right"></span>
									</div>
							</div>
							<ol class="comment-list">
									<?php wp_list_comments( array( 'callback' => 'mycoach_comment' ) ); ?>
							</ol><!-- .comment-list -->

						<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
								<nav class="comment-navigation">
										<div
												class="nav-previous"><?php previous_comments_link( '<i class="fa fa-angle-left"></i> ' . esc_html__( 'Older Comments', 'mycoach' ) ); ?>
										</div>
										<div
												class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'mycoach' ) . ' <i class="fa fa-angle-right"></i>' ); ?>
										</div>
										<div class="clear"></div>
								</nav><!-- #comment-nav-below -->
						<?php endif; // Check for comment navigation. ?>

						<?php if ( ! comments_open() ) : ?>
								<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'mycoach' ); ?></p>
						<?php endif; ?>
				<?php endif; // have_comments() ?>
		<?php echo mycoach_comment_form(); ?>
</div><!-- #comments -->
