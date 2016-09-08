<?php
/**
 *
 * Template Name: Blank - No Header, No Footer
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php $mycoach_options = mycoach_get_theme_options(); // Check theme options for existence ?>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php mycoach_rev_slider( 'above', $mycoach_options['slider-position'], $mycoach_options['slide-template'] ); ?>
	<div id="content" class="site-content">
		<?php
		if ( $mycoach_options['page-title-bar'] ) {
			get_template_part( 'pro-framework/template-parts/image-header' );
		}
		?>
		<div class="container cont-padding">
			<?php
			while( have_posts() ) : the_post();
				the_content();
			endwhile;
			?>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
