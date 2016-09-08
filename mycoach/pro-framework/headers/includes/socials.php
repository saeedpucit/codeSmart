<?php $mycoach_options = mycoach_get_theme_options(); // Check theme options for existence ?>
<ul class="nav navbar-nav social-btns">
	<?php
	$mycoach_socials = array(
		'facebook',
		'flickr',
		'rss',
		'twitter',
		'vimeo',
		'youtube',
		'instagram',
		'pinterest',
		'tumblr',
		'google-plus',
		'dribbble',
		'digg',
		'linkedin',
		'skype',
		'deviantart',
		'yahoo',
		'reddit',
		'paypal',
		'dropbox',
		'envelope-o'
	);
	foreach ( $mycoach_socials as $mycoach_social ) {
		if ( isset( $mycoach_options[ 'fa-' . $mycoach_social ] ) && $mycoach_options[ 'fa-' . $mycoach_social ] ) {
			?>
			<li>
				<a href="<?php echo esc_url( $mycoach_options[ 'fa-' . $mycoach_social ] ) ?>"
				   <?php if ( $mycoach_options['open-social-icons-window'] ){ ?>target="_blank" <?php }; ?>>
					<i class="fa fa-<?php echo esc_attr( $mycoach_social ) ?>"></i>
				</a>
			</li>
			<?php
		}
	};
	?>
</ul>