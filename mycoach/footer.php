<?php
/** * The template for displaying the footer.
 * * Contains the closing of the #content div and all content after
 * * @package pro
 */
?>
<?php
$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
?>
</div>
<!-- #content -->
<footer>
	<?php if ( $mycoach_options['show-footer-form'] ) { ?>
		<div class="top-footer footer-form">
			<?php echo mycoach_background( $mycoach_options['background-image-form-area'], $mycoach_options['footer-form-background-parallax'] ); ?>
			<div class="container">
				<?php if ( $mycoach_options['show-footer-form'] ) { ?>
					<div class="row">
						<?php echo wp_kses_post( $mycoach_options['before-footer-form'] ); ?>
						<?php if ( $mycoach_options['footer-form-shortcode'] ) {
							echo do_shortcode( $mycoach_options['footer-form-shortcode'] );
						}; ?>
					</div>
				<?php }; ?>
				<?php if ( $mycoach_options['show-footer-contact-details'] ) {
					echo netbee_footer_contact_details();
				} ?>
			</div>
		</div>
	<?php }; ?>
	<div class="copyright-widgets-cont">
		<?php if ( $mycoach_options['show-footer'] ) {
			echo mycoach_footer_widgets();
		}; ?>

		<?php if ( !class_exists('redux') ) {
			echo mycoach_footer_widgets();
		}; ?>

		<?php if ( $mycoach_options['copyright-bar'] ) { ?>
			<div class="bott-footer copyright">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-md-5">
							<p class="copyright-text"><?php echo wp_kses_post( $mycoach_options['copyright-text'] ) ?></p>
						</div>
						<div class="col-xs-12 col-md-7">
							<?php if ( $mycoach_options['enable-to-top-script'] ) { ?>
								<div class="arrow-to-top"><b class="fa-angle-up"></b></div>
							<?php }; ?>
							<?php
							$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
							$mycoach_include_path = 'pro-framework/headers';
							$cont_right   = $mycoach_options['footer-right-content'];
							switch ( $cont_right ) {
								case "contact-info":
									get_template_part( $mycoach_include_path . '/includes/contact-info' );
									break;
								case "social-icons":
									get_template_part( $mycoach_include_path . '/includes/socials-footer' );
									break;
								case "navigation":
									get_template_part( 'pro-framework/template-parts/footer-menu' );
									break;
								case "custom-content":
									echo wp_kses_post( $mycoach_options['copyright-custom-content'] );
									break;
								default:
									//leave-empty
							} ?>
						</div>
					</div>
				</div>
			</div>
		<?php }; ?>
		<?php if ( !class_exists('redux') ) { ?>
							<div class="bott-footer copyright">
									<div class="container">
											<div class="row">
													<div class="col-xs-12 col-md-5">
															<p class="copyright-text"><?php echo esc_html__('Copyright 2016 MyCoach. Theme designed by Netbee', 'mycoach'); ?></p>
													</div>
													<div class="col-xs-12 col-md-7">
															<div class="arrow-to-top"><b class="fa-angle-up"></b></div>
															<?php get_template_part( 'pro-framework/headers/includes/socials-footer' ); ?>
													</div>
											</div>
									</div>
							</div>
			<?php }; ?>


	</div>
</footer>
<!-- #page -->
</div>
<?php
	mycoach_custom_style_sticky_header();
	wp_footer();
?>
</body>
</html>
