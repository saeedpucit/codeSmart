<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); 

$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
$shop_id = wc_get_page_id( 'shop' );
$mycoach_layout = $mycoach_options["woo-shop-layout"];
$mycoach_woo_sidebar = $mycoach_options["woo-sidebar"];
$mycoach_page_column = '12';

if ( $mycoach_layout == 'full' || $mycoach_layout == 'full-100' ) {
	$mycoach_page_column = '12';
} else if ( $mycoach_layout == 'left' || $mycoach_layout == 'right' ) {
	$mycoach_page_column = '9';
} else if ( $mycoach_layout == 'both' ) {
	$mycoach_page_column = '6';
}

$mycoach_container = $mycoach_layout == 'full-100' ? "container-fluid" : "container";
?>

<?php do_action( 'woocommerce_before_main_content' ); ?>

	<div class="woocommerce-top">

		<div class="<?php echo esc_attr( $mycoach_container ); ?>">

			<div class="row">

				<div class="col-md-12">

					<?php
					if ( have_posts() ) {

						do_action( 'woocommerce_before_shop_loop' );

					}; ?>

				</div>

			</div>

		</div>

	</div>

	<div class="<?php echo esc_attr( $mycoach_container ); ?> cont-padding">

		<div class="row">

			<?php mycoach_page_sidebar( 'left', $mycoach_layout, $mycoach_woo_sidebar ); ?>

			<div class="col-md-<?php echo esc_attr( $mycoach_page_column ) ?>">

				<div class="page-content">

					<?php do_action( 'woocommerce_archive_description' ); ?>

					<?php if ( have_posts() ) : ?>

						<?php woocommerce_product_loop_start(); ?>

						<?php woocommerce_product_subcategories(); ?>

						<?php while( have_posts() ) : the_post(); ?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php endwhile; // end of the loop. ?>

						<?php woocommerce_product_loop_end(); ?>
                        
						<?php do_action( 'woocommerce_after_shop_loop' ); ?>
                        
					<?php elseif ( ! woocommerce_product_subcategories( array(
						'before' => woocommerce_product_loop_start( false ),
						'after'  => woocommerce_product_loop_end( false )
					) )
					) : ?>

						<?php wc_get_template( 'loop/no-products-found.php' ); ?>

					<?php endif; ?>

				</div>
                
			</div>

			<?php mycoach_page_sidebar( 'right', $mycoach_layout, $mycoach_woo_sidebar ); ?>
		
        </div>
        
	</div>

<?php do_action( 'woocommerce_after_main_content' ); ?>

<?php get_footer( 'shop' ); ?>