<?php
	$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
?>
<div class="footer-menu mini-nav">
	<?php
		if ( has_nav_menu( 'footer_menu' ) ) {
		    // User has assigned menu to this location;
		    // output it
		    wp_nav_menu( array(
		        'theme_location' 	=> 'footer_menu',
				'depth'						=>	1,
		        'container' 			=> false
		    ) );
		} else {
			echo "<p class='copyright-text'>".esc_html__( "Go to Theme Options &#62; Footer &#62; Copyright Bar and set option Footer Right Content", 'mycoach' )."</p>";
		}
		?>

	<div class="menu-select"><span class="customSelect1"><span class="customSelectInner">Menu Bottom</span></span></div>
</div>
