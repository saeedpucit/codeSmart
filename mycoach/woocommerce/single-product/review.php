<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
?>
<li itemprop="reviews" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?>
    id="li-comment-<?php comment_ID() ?>">
    
	<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">

		<div class="comment-meta">

			<?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>
            
				<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="pro-star-rating"
				     title="<?php echo sprintf( esc_html__( 'Rated %d out of 5', 'mycoach' ), $rating ) ?>">
					<?php
					for ( $i = 0; $i < $rating; $i ++ ) {
						echo '<i class="fa fa-star pro-star"></i>';
					}
					for ( $i = 0; $i < ( 5 - $rating ); $i ++ ) {
						echo '<i class="fa fa-star pro-star-o"></i>';
					}
					?>
				</div>
			<?php endif; ?>
			<time itemprop="datePublished"
			      datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( esc_html(__( '' , 'mycoach' ) ) ); ?></time>
			<?php
			if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' ) {
				if ( wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) ) {
					echo '<em class="verified">(' . esc_html__( 'verified owner', 'mycoach' ) . ')</em> ';
				}
			}
			?>
			<?php edit_comment_link( esc_html__( '(Edit)', 'mycoach' ), ' ' ); ?>
		</div>

		<div class="comment-author vcard">

			<?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '60' ), '', get_comment_author() ); ?>

			<?php printf( '<cite class="fn">%s</cite>', str_replace( 'href', 'target="_blank" href', get_comment_author_link() ) ); ?>

		</div>

		<?php if ( $comment->comment_approved == '0' ) : ?>

			<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'mycoach' ); ?></em>
			<br/>

		<?php endif ?>

		<div itemprop="description" class="comment-content"><?php comment_text(); ?></div>

	</article>