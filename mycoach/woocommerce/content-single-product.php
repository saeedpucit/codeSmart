<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php
/**
 * woocommerce_before_single_product hook
 *
 * @hooked wc_print_notices - 10
 */
 
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}

$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
?>
<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>"
     id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="container-fluid">

		<div class="row">

			<div class="col-md-5">

				<?php
				/**
				 * woocommerce_before_single_product_summary hook
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );

				
				?>
			</div>

			<div class="col-md-7">

				<div class="summary entry-summary">
					<?php
					woocommerce_template_single_title();

					woocommerce_template_single_price();

					woocommerce_template_single_rating();

					woocommerce_template_single_excerpt();

					woocommerce_template_single_add_to_cart();

					if ( $mycoach_options['woo-wishlist'] && shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ) {
						echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
					}

					if ( $mycoach_options['woo-compare'] && shortcode_exists( 'yith_compare_button' ) ) {
						echo do_shortcode( '[yith_compare_button]' );
					}

					woocommerce_template_single_meta();

					if ( $mycoach_options['enable-share'] && $mycoach_options['addthis-html'] ) {

						echo '<div class="clearfix"></div>';

						echo wp_kses_post( $mycoach_options['addthis-html'] );

					}
					?>
				</div>
				<!-- .summary -->
			</div>
			<!-- /col-md-7 -->
		</div>
		<!-- /row -->
		<div class="row">
        
			<div class="col-md-12">

				<?php
				/**
				 * woocommerce_after_single_product_summary hook
				 *
				 * @hooked woocommerce_output_product_data_tabs - 10
				 * @hooked woocommerce_output_related_products - 20
				 */								 
				do_action( 'woocommerce_after_single_product_summary' );

				?>
				<meta itemprop="url" content="<?php the_permalink(); ?>"/>

			</div>
		</div>
		<!-- /row -->
	</div>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>