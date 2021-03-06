<?php
if ( !class_exists( 'redux' ) ) {
	$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
  $mycoach_include_path = 'pro-framework/headers/';
  $mycoach_transparent_header = $mycoach_options["transparent-header"];
  ?>
  <header id="masthead" class="<?php if ( $mycoach_transparent_header ) {
  echo 'transparent-header';
  } ?> site-header style-2 header-v1">
  <?php
  if ( $mycoach_options['show-top-header'] ) {
  get_template_part( $mycoach_include_path . '/top' );
  }; ?>
  <nav id="top-menu" class="navbar hidden-mobile">
  <div class="container">
  <div class="header-top">
  <div class="pull-left">
    <?php get_template_part( $mycoach_include_path . '/includes/logo' ) ?>
  </div>

  <div class="pull-right v-align">
    <?php get_template_part( $mycoach_include_path . '/includes/cart' );
		?>
  </div>

  <div class="pull-right v-align">
  <?php get_template_part( $mycoach_include_path . '/includes/search' ) ?>
  </div>

  <div class="pull-right">
  <div class="primary-menu">
  <div class="menu-class navbar-left">
  <?php mycoach_main_menu() ?>
  </div>
  </div>
  </div>

  </div>
  </div>
  </nav>
  </header>

<?php
}else{
		$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
		$mycoach_include_path = 'pro-framework/headers/';
		$mycoach_transparent_header = $mycoach_options["transparent-header"];
		?>
		<header id="masthead" class="<?php if ( $mycoach_transparent_header ) {
			echo 'transparent-header';
		} ?> site-header style-2 header-v1">
			<?php
			if ( $mycoach_options['show-top-header'] ) {
				get_template_part( $mycoach_include_path . '/top' );
			};

			if ( !class_exists('redux') ) {
				get_template_part( $mycoach_include_path . '/top' );
			}; 

			?>

			<nav id="top-menu" class="navbar hidden-mobile">
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
							?>
						</div>
						<?php if ( $mycoach_options['show-search-icon'] ) { ?>
							<div class="pull-right v-align">
								<?php get_template_part( $mycoach_include_path . '/includes/search' ) ?>
							</div>
						<?php }; ?>
						<div class="pull-right">
							<div class="primary-menu">
								<div class="menu-class navbar-left">
									<?php mycoach_main_menu() ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</nav>
		</header>
		<!-- #masthead -->
	<?php
} // end of else part
	?>
