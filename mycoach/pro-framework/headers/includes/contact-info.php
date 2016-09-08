<?php $mycoach_options = mycoach_get_theme_options(); // Check theme options for existence ?>
<div class="contact-info">
	<?php if ( $mycoach_options['telephone'] ) { ?>
		<ul class="nav navbar-nav">
			<li>
				<a href="<?php echo esc_url( 'tel:' . $mycoach_options['telephone'] ) ?>"><i
						class="fa fa-phone"></i>&nbsp; <?php echo wp_kses_post( $mycoach_options['telephone'] ); ?></a>
			</li>
		</ul>
	<?php }; ?>
	<?php if ( $mycoach_options['email'] ) { ?>
		<ul class="nav navbar-nav">
			<li>
				<a href="<?php echo esc_url( 'mailto:' . $mycoach_options['email'] ) ?>">
					<i class="fa fa-envelope-o"></i>&nbsp; <?php echo wp_kses_post( $mycoach_options['email'] ); ?>
				</a>
			</li>
		</ul>
	<?php }; ?>
</div>