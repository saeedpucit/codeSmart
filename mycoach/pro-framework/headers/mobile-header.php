<?php
$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
$mycoach_include_path = 'pro-framework/headers';
?>
<nav class="navbar mobile-menu-cont hidden-desktop">
	<div class="mobile-header-top">
		<div class="pull-left">
			<?php get_template_part( $mycoach_include_path . '/includes/logo' ) ?>
		</div>
		<div class="pull-right compact-triggers-container"><a href="javascript:void(0)"
		                                                      class="menu-compact-btn-toggle menu-open"
		                                                      id="accordion-menu-toggle-open"><i class="fa fa-bars"></i></a>
			<a href="javascript:void(0)" class="menu-compact-btn-toggle menu-close" id="accordion-menu-toggle-close"><i
					class="fa fa-times"></i></a></div>
		<div class="clearfix"></div>
		<div class="primary-menu">
			<div id="mobile-menu"
			     class="navbar-left <?php echo ( $mycoach_options['mobile-menu-slide-outs'] ) ? "already-slidedown" : "" ?> accordion-menu">
				<?php wp_nav_menu( array( 'theme_location'   => 'primary',
				                          'mobile'           => true,
				                          'container'        => false,
				                          'parent_clickable' => $mycoach_options['mobile-parents-clickable'],
				                          'walker'           => new Mobile_Walker_Nav_Menu()
				) ); ?>
				<div class="clearfix"></div>
				<?php get_template_part( $mycoach_include_path . '/includes/search-mobile' ) ?>
			</div>
		</div>
	</div>
</nav>
