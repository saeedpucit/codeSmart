<?php
$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence 
$mycoach_include_path = 'pro-framework/headers';
?>
<nav id="top-bar" class="navbar navbar-default">
	<div class="container">
		<div class="pull-left">
			<?php
			//language switch
			if ( $mycoach_options['language-switch'] && $mycoach_options['language-switch-position'] == 'left' ) {
				get_template_part( $mycoach_include_path . '/includes/language-switch' );
			};
			$mycoach_cont_left = $mycoach_options['top-header-left-cont'];
			switch ( $mycoach_cont_left ) {
				case "site-title-and-tagline":
					get_template_part( $mycoach_include_path . '/includes/site-title-and-tagline' );
					break;
				case "contact-info":
					get_template_part( $mycoach_include_path . '/includes/contact-info' );
					break;
				case "social-icons":
					get_template_part( $mycoach_include_path . '/includes/socials' );
					break;
				case "navigation":
					get_template_part( $mycoach_include_path . '/includes/top-menu' );
					break;
				case "custom-content":
					get_template_part( $mycoach_include_path . '/includes/custom-content' );
					break;
			}
			?>
		</div>
		<div class="pull-right">
			<?php
			$mycoach_cont_right = $mycoach_options['top-header-right-cont'];
			switch ( $mycoach_cont_right ) {
				case "site-title-and-tagline":
					get_template_part( $mycoach_include_path . '/includes/site-title-and-tagline' );
					break;
				case "contact-info":
					get_template_part( $mycoach_include_path . '/includes/contact-info' );
					break;
				case "social-icons":
					get_template_part( $mycoach_include_path . '/includes/socials' );
					break;
				case "navigation":
					get_template_part( $mycoach_include_path . '/includes/top-menu' );
					break;
				case "custom-content":
					echo wp_kses_post( $mycoach_options['top-header-custom-content'] );
					break;
			}
			//language switch
			if ( $mycoach_options['language-switch'] && $mycoach_options['language-switch-position'] == 'right' ) {
				get_template_part( $mycoach_include_path . '/includes/language-switch' );
			};
			?>
		</div>
	</div>
	<!-- /.container-fluid -->
</nav>
