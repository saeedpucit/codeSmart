<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author        PRO
 * @version     1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
global $woocommerce;
?>
<?php do_action( 'woocommerce_before_mini_cart' ); ?>
	<ul class="cart_list cart-items-container">
		<?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>
			<li class="header"><span><?php echo sizeof( $woocommerce->cart->get_cart() );
					esc_html_e( ' items', 'mycoach' ); ?></span><?php esc_html_e( ' in the shopping cart', 'mycoach' ); ?> </li>
			<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :
				$_product      = $cart_item['data'];
				$quantity = $cart_item['quantity'];
				// Only display if allowed
				if ( ! apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $_product->exists() || $cart_item['quantity'] == 0 ) {
					continue;
				}
				// Get price
				$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
				$product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );
				?>
				<li class="item-product-cart">
					<a href="<?php echo esc_url(get_permalink( $cart_item['product_id'] )); ?>">
						<div class="thumb-product"><?php echo $_product->get_image(); ?></div>
						<div class="product-details">
							<?php echo apply_filters( 'woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>
							<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<p class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</p>', $cart_item, $cart_item_key ); ?>
						</div>
					</a>
					<?php echo sprintf( '<a href="javascript:void(0);" rel="' . $cart_item_key . '" class="ajax-remove-item remove remove-product" title="%s"><i class="fa fa-times"></i></a>', esc_html__( 'Remove this item', 'mycoach' ) ); ?>
				</li>
			<?php endforeach; ?>
			<li class="total-cart-details">
				<span><?php esc_html_e( 'TOTAL', 'mycoach' ) ?></span>
				<span class="pull-right"><?php echo $woocommerce->cart->get_cart_subtotal(); ?></span>
			</li>
			<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
			<li class="buttons">
				<a class="btn btn-view"
				   href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><?php esc_html_e( 'View Cart', 'mycoach' ); ?></a>
				<a class="btn btn-checkout"
				   href="<?php echo $woocommerce->cart->get_checkout_url(); ?>"><?php esc_html_e( 'Checkout', 'mycoach' ); ?></a>
			</li>
		<?php else : ?>
			<li class="header"><?php esc_html_e( 'No products in the cart.', 'mycoach' ); ?></li>
		<?php endif; ?>
	</ul><!-- end product list -->
<?php do_action( 'woocommerce_after_mini_cart' ); ?>
