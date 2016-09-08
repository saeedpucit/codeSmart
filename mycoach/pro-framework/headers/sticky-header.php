<?php
$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
$mycoach_include_path = 'pro-framework/headers/';
?>
<div id="header-sticky" class="sticky-header style-2 header-v1 hidden-mobile">
	<nav class="navbar">
		<div class="container">
			<div class="header-top">
				<div class="pull-left">
						<?php get_template_part( $mycoach_include_path . '/includes/logo' ) ?>
				</div>
				<div class="pull-right v-align">
					<?php
					if ( class_exists( 'Woocommerce' ) && $mycoach_options['show-woocommerce-cart'] ) {
						get_template_part( $mycoach_include_path . '/includes/cart' );
					};

					if ( !class_exists( 'redux' ) ) {
						get_template_part( $mycoach_include_path . '/includes/cart' );
					};
					?>
				</div>
				<?php if ( $mycoach_options['show-search-icon'] ) { ?>
					<div class="pull-right v-align">
						<?php get_template_part( $mycoach_include_path . '/includes/search' ) ?>
					</div>
				<?php }; ?>

				<?php if ( !class_exists( 'redux' ) ) { ?>
					<div class="pull-right v-align">
						<?php get_template_part( $mycoach_include_path . '/includes/search' ) ?>
					</div>
				<?php }; ?>
				<div class="pull-right">
					<div class="primary-menu">
						<div class="menu-class navbar-nav navbar-left">
							<?php mycoach_main_menu() ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>
</div>
