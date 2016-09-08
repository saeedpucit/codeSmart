<span class="text">
	<?php 
		if ( is_front_page() && is_home() ) : ?>
			<span class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</span>
		<?php else : ?>
			<span class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</span>
		<?php endif;
		$description = get_bloginfo( 'description', 'display' );
		if ( $description || is_customize_preview() ) : ?>
			<span class="site-description">&nbsp; <?php echo $description; ?></span>
		<?php endif; ?>
</span> 