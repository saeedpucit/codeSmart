<div class="logo">
	<?php
	if( !class_exists('redux') ){
?>
		<a href="<?php echo esc_url( home_url( '/' ) ) ?> ">
			<img src="<?php echo get_template_directory_uri() . '/images/logo.png'?>" class="normal"/>
		</a>

	<?php
	}else{
			$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
			$mycoach_page_logo = $mycoach_page_retina_logo = false;
			$mycoach_page_logo = $mycoach_options["logo-upload"];
			$mycoach_page_retina_logo = $mycoach_options["logo-upload-retina"];

			if ( empty($mycoach_page_logo['url']) ) {
				if(has_custom_logo())
				{
					mycoach_the_custom_logo();
				}
				else
				{

				}
			} else {
				mycoach_output_logo( $mycoach_page_logo, $mycoach_page_retina_logo );
			}
	}
	?>
</div>
