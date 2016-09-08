<?php
$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
$mycoach_include_path = 'pro-framework/headers/';
?>
<nav id="mp-menu" class="mp-menu primary-menu">
	<div class="mp-level">
		<h2><i class="pro-in fa fa-globe"></i><?php esc_html_e( 'Menu', 'mycoach' ) ?></h2>
		<?php mycoach_main_menu() ?>
	</div>
</nav>