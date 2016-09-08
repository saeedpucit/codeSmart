<?php
$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
$mycoach_include_path = 'pro-framework/headers/';
$mycoach_transparent_header = $mycoach_options["transparent-header"];
?>
<header id="masthead" class="<?php if ( $mycoach_transparent_header ) {
	echo 'transparent-header';
} ?> site-header style-2 header-v3">
	<?php
	if ( $mycoach_options['show-top-header'] ) {
		get_template_part( $mycoach_include_path . '/top' );
	}; ?>
	<nav id="top-menu" class="navbar  hidden-mobile">
		<div class="container">
			<div class="header-top">
				<div class="primary-menu">
					<div class="menu-class navbar-nav center">
						<?php mycoach_main_menu() ?>
					</div>
				</div>
			</div>
		</div>
	</nav>
</header>
<!-- #masthead -->