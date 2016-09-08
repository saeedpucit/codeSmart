<?php

//

// Ajax WooCommerce - Add Card - Add Contents

// ------------------------------------------------------------------------------

if ( ! function_exists( 'mycoach_woocommerce_add_to_cart_ajax' ) ) {

	function mycoach_woocommerce_add_to_cart_ajax( $fragments ) {

		global $woocommerce;

		ob_start();

		get_template_part( 'pro-framework/plugins/woocommerce/woocommerce-ajax-cart' );

		$mini_cart = ob_get_clean();

		$fragments['.cart-items-container'] = $mini_cart;

		$fragments['.shopping-badge'] = '<span class="badge animated bounceIn shopping-badge ">' . $woocommerce->cart->cart_contents_count . '</span>';

		return $fragments;

	}

	add_filter( 'add_to_cart_fragments', 'mycoach_woocommerce_add_to_cart_ajax' );

}

// remove from cart

if ( ! function_exists( 'mycoach_woocommerce_top_bar_ajax' ) ) {

	function woocommerce_ajax_remove_from_cart() {

		global $woocommerce;

		$woocommerce->cart->set_quantity( $_POST['remove_item'], 0 );

		$wc_ajax = new WC_AJAX();

		$wc_ajax->get_refreshed_fragments();

		die();

	}

	add_action( 'wp_ajax_woocommerce_remove_from_cart', 'woocommerce_ajax_remove_from_cart', 1000 );

	add_action( 'wp_ajax_nopriv_woocommerce_remove_from_cart', 'woocommerce_ajax_remove_from_cart', 1000 );

}

//

// Add WooCommerce Support

// ------------------------------------------------------------------------------

if ( ! function_exists( 'mycoach_woocommerce_support' ) ) {

	function mycoach_woocommerce_support() {

		add_theme_support( 'woocommerce' );

	}

	add_action( 'after_setup_theme', 'mycoach_woocommerce_support' );

}

//

// Remove WooCommerce Main Style

// ------------------------------------------------------------------------------

if(defined('WOOCOMMERCE_VERSION')){

	if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {

		add_filter( 'woocommerce_enqueue_styles', '__return_false' );

	} else {

		define( 'WOOCOMMERCE_USE_CSS', false );

	}

}

//

// Add WooCommerce Main Style

// ------------------------------------------------------------------------------

if ( ! function_exists( 'mycoach_woocommerce_style' ) ) {

	function mycoach_woocommerce_style() {

		wp_enqueue_style( 'pro-woocommerce', MYCOACH_THEME_URI . '/css/vendor/woocommerce.css', array(), null );

	}

	add_action( 'wp_enqueue_scripts', 'mycoach_woocommerce_style' );

}

//

// Set in-stock / out-stock Alert Class

// ------------------------------------------------------------------------------

if ( ! function_exists( 'mycoach_woocommerce_get_availability' ) ) {

	function mycoach_woocommerce_get_availability( $availability, $this ) {

		$class = $availability['class'];

		switch ( $class ) {

			case 'out-of-stock':

				$availability['class'] = $class . ' pro-alert pro-alert-danger';

				break;

			default:

				$availability['class'] = $class . ' pro-alert pro-alert-info';

				break;

		}

		return $availability;

	}

	add_filter( 'woocommerce_get_availability', 'mycoach_woocommerce_get_availability', 1, 2 );

}

//

// Remove WooCommerce BreadCrumbs

// ------------------------------------------------------------------------------

if ( ! function_exists( 'mycoach_remove_wc_breadcrumbs' ) ) {

	function mycoach_remove_wc_breadcrumbs() {

		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

	}

	add_action( 'init', 'mycoach_remove_wc_breadcrumbs' );

}

//

// Remove Shop Sidebar

// ------------------------------------------------------------------------------

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

//

// Register Shop Sidebar

// ------------------------------------------------------------------------------

add_action( 'widgets_init', 'mycoach_register_shop_sidebar' );

function mycoach_register_shop_sidebar() {

	register_sidebar( array(

		'name'          => 'Shop Sidebar',

		'id'            => 'shop-sidebar',

		'description'   => 'Drag widgets for all of shop sidebar',

		'before_widget' => '<section class="netbee_widget %2$s">',

		'after_widget'  => '</section>',

		'before_title'  => '<div class="widget-title"><h4>',

		'after_title'   => '</h4></div>'

	) );

}

//

// Remove Lightbox Styles and Scripts

// ------------------------------------------------------------------------------

if ( ! function_exists( 'mycoach_woocommerce_remove_scripts' ) ) {

	function mycoach_woocommerce_remove_scripts() {

		wp_dequeue_script( 'prettyPhoto' );

		wp_dequeue_script( 'prettyPhoto-init' );

	}

	add_action( 'wp_print_scripts', 'mycoach_woocommerce_remove_scripts' );

}

if ( ! function_exists( 'mycoach_woocommerce_remove_styles' ) ) {

	function mycoach_woocommerce_remove_styles() {

		wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

	}

	add_action( 'wp_print_styles', 'mycoach_woocommerce_remove_styles' );

}

//

// Loop Columns

// ------------------------------------------------------------------------------

if ( ! function_exists( 'mycoach_loop_shop_columns' ) ) {

	function mycoach_loop_shop_columns() {

		$columns = mycoach_get_option( 'woo-loop-columns', 4 );

		return $columns;

	}

	add_filter( 'loop_shop_columns', 'mycoach_loop_shop_columns' );

}

//

// Related Columns

// ------------------------------------------------------------------------------

if ( ! function_exists( 'mycoach_woocommerce_output_related_products_args' ) ) {

	function mycoach_woocommerce_output_related_products_args( $args ) {

		$columns = mycoach_get_option( 'woo-related-columns', 4 );

		$args = array(

			'posts_per_page' => $columns,

			'columns'        => $columns,

			'orderby'        => 'rand'

		);

		return $args;

	}

	add_filter( 'woocommerce_output_related_products_args', 'mycoach_woocommerce_output_related_products_args' );

}

//

// Up-Sells ( You may also like ) Columns

// ------------------------------------------------------------------------------

if ( ! function_exists( 'mycoach_woocommerce_after_single_product_summary' ) ) {

	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

	function mycoach_woocommerce_after_single_product_summary() {

		$columns = mycoach_get_option( 'woo-upsells-columns', 4 );

		woocommerce_upsell_display( $columns, $columns );

	}

	add_action( 'woocommerce_after_single_product_summary', 'mycoach_woocommerce_after_single_product_summary', 15 );

}

//

// Cross-Sells ( You may also like ) Columns : Cart Page

// ------------------------------------------------------------------------------

if ( ! function_exists( 'mycoach_woocommerce_cross_sells_columns' ) ) {

	function mycoach_woocommerce_cross_sells_columns() {

		$columns = mycoach_get_option( 'woo-upsells-columns', 4 );

		return $columns;

	}

	add_filter( 'woocommerce_cross_sells_total', 'mycoach_woocommerce_cross_sells_columns' );

	add_filter( 'woocommerce_cross_sells_columns', 'mycoach_woocommerce_cross_sells_columns' );

}

//

// Product Thumbnail Hover Effect

// ------------------------------------------------------------------------------

if ( ! function_exists( 'mycoach_woocommerce_before_shop_loop_item_title' ) ) {

	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

	function mycoach_woocommerce_before_shop_loop_item_title() {

		echo mycoach_woocommerce_get_product_thumbnail();

	}

	add_action( 'woocommerce_before_shop_loop_item_title', 'mycoach_woocommerce_before_shop_loop_item_title', 10 );

}

if ( ! function_exists( 'mycoach_woocommerce_get_product_thumbnail' ) ) {

	function mycoach_woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0 ) {

		global $post, $product, $woocommerce;

		$attachment_ids = $product->get_gallery_attachment_ids();

		$output = '';

		if ( has_post_thumbnail() ) {

			$output .= get_the_post_thumbnail( $post->ID, $size );

			if ( ! empty( $attachment_ids ) ) {

				$secondary_image_id = $attachment_ids['0'];

				$output .= wp_get_attachment_image( $secondary_image_id, $size );

			}

		} elseif ( wc_placeholder_img_src() ) {

			$output .= wc_placeholder_img( $size );

		}

		return $output;

	}

}

//

// Order Again

// ------------------------------------------------------------------------------

if ( ! function_exists( 'mycoach_woocommerce_order_again_button' ) ) {

	remove_action( 'woocommerce_order_details_after_order_table', 'woocommerce_order_again_button' );

	function mycoach_woocommerce_order_again_button( $order ) {

		if ( ! $order || $order->status != 'completed' ) {

			return;

		}

		?>

		<p class="order-again">

			<a href="<?php echo wp_nonce_url( add_query_arg( 'order_again', $order->id ), 'woocommerce-order_again' ); ?>"

			   class="button <?php echo mycoach_get_button_class( array( 'size' => 'xxs' ) ); ?>"><i

					class="fa fa-refresh"></i> <?php esc_html_e( 'Order Again', 'mycoach' ); ?></a>

		</p>

		<?php

	}

	add_action( 'woocommerce_order_details_after_order_table', 'mycoach_woocommerce_order_again_button' );

}

//

// Search Form

// ------------------------------------------------------------------------------

if ( ! function_exists( 'mycoach_get_product_search_form' ) ) {

	function mycoach_get_product_search_form() {

		$form = '<div class="pro-search-form">

      <form action="' . esc_url( home_url( '/' ) ) . '" method="get">

        <input type="text" value="' . get_search_query() . '" name="s" class="pro-search" placeholder="' . esc_html__( 'Search for products', 'mycoach' ) . '" />

        <button type="submit" class="fa fa-search"></button>

        <input type="hidden" name="post_type" value="product" />

      </form>

    </div>';

		return $form;

	}

	add_filter( 'get_product_search_form', 'mycoach_get_product_search_form' );

}

if ( ! function_exists( 'woocommerce_header_add_to_cart_fragment' ) ) {

	function woocommerce_header_add_to_cart_fragment( $fragments ) {

		global $woocommerce;

		ob_start();

		?>

		<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="shopping-cart"

		   title="<?php esc_html_e( 'View your shopping cart', 'mycoach' ); ?>">

			<i class="fa fa-shopping-cart"></i>

			<span class="badge border green animated bounceIn" id="shopping-badge">

				<?php echo $woocommerce->cart->cart_contents_count; ?>

			</span>

		</a>

		<span class="price-result">

			<?php echo $woocommerce->cart->get_cart_total(); ?>

		</span>

		<?php

		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;

	}

	add_filter( 'add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

}

if ( ! function_exists( 'mycoach_loop_shop_per_page' ) ) {

	function mycoach_loop_shop_per_page() {

		$mycoach_options = mycoach_get_theme_options();

		return $mycoach_options['woo-products-per-page'];

	}

	add_filter( 'loop_shop_per_page', 'mycoach_loop_shop_per_page', 20 );

}

/**

 *

 * Disable woocommerce reviews

 * @since 1.0.0

 * @version 1.0.0

 *

 */

if ( ! function_exists( 'mycoach_remove_reviews_tab' ) ) {

	function mycoach_remove_reviews_tab( $tabs ) {

		$mycoach_options = mycoach_get_theme_options();

		if ( ! $mycoach_options['woo-product-reviews'] ) {

			unset( $tabs['reviews'] );

		}

		return $tabs;

	}

	add_filter( 'woocommerce_product_tabs', 'mycoach_remove_reviews_tab' );

}