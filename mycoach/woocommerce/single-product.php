<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
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

get_header( 'shop' ); 

$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
$mycoach_layout = $mycoach_options["woo-single-layout"];
$mycoach_woo_single_sidebar = $mycoach_options["woo-single-sidebar"];
$mycoach_page_column = '6' ;

if ( $mycoach_layout == 'full' || $mycoach_layout == 'full-100' ) {
	$mycoach_page_column = '12';
} else if ( $mycoach_layout == 'left' || $mycoach_layout == 'right' ) {
	$mycoach_page_column = '9';
} else if ( $mycoach_layout == 'both' ) {
	$mycoach_page_column = '6';
}
$mycoach_container = $mycoach_layout == 'full-100' ? "container-fluid" : "container";
?>
	<div class="<?php echo esc_attr( $mycoach_container ); ?> cont-padding">

		<div class="row">

			<?php mycoach_page_sidebar( 'left', $mycoach_layout, $mycoach_woo_single_sidebar ); ?>

			<div class="col-md-<?php echo esc_attr( $mycoach_page_column ) ?>">

				<div class="page-content">

					<?php
					/**
					 * woocommerce_before_main_content hook
					 *
					 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
					 * @hooked woocommerce_breadcrumb - 20
					 */
					do_action( 'woocommerce_before_main_content' );
					?>
                    
					<?php while( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'single-product' ); ?>

					<?php endwhile; // end of the loop. ?>

					<?php
					/**
					 * woocommerce_after_main_content hook
					 *
					 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
					 */
					do_action( 'woocommerce_after_main_content' );
					?>
				</div>
				<!-- /page-content -->
			</div>
			<!-- /colmd -->
            
			<?php mycoach_page_sidebar( 'right', $mycoach_layout, $mycoach_woo_single_sidebar ); ?>
            
		</div>
        
	</div>

<?php get_footer( 'shop' ); ?>