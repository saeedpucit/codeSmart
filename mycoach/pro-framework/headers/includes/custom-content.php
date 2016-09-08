<?php $mycoach_options = mycoach_get_theme_options(); // Check theme options for existence ?>
<span class="text">
	<?php echo wp_kses_post( $mycoach_options['top-header-custom-content'] ); ?>
</span> 