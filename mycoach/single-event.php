<?php
/**
 *
 * The Template for displaying all single posts.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
get_header();
$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
$mycoach_right_sidebar = $mycoach_options["sidebar-right"];
$mycoach_left_sidebar = $mycoach_options["sidebar-left"];
$mycoach_layout = $mycoach_options["layout"];
if ( $mycoach_layout == 'full' || $mycoach_layout == 'full-100' ) {
	$mycoach_page_column = '12';
} else if ( $mycoach_layout == 'left' || $mycoach_layout == 'right' ) {
	$mycoach_page_column = '9';
} else if ( $mycoach_layout == 'both' ) {
	$mycoach_page_column = '6';
}
$mycoach_container = $mycoach_layout == 'full-100' ? "container-fluid" : "container";
?>
	<div class="single-portofolio single-event">
		<!-- <div class="<?php echo esc_attr( $mycoach_container ) ?> cont-padding"> -->
		<div class="<?php echo esc_attr( $mycoach_container ) ?>">
			<div class="row">
				<?php mycoach_page_sidebar( 'left', $mycoach_layout, $mycoach_left_sidebar ); ?>
				<div class="col-md-<?php echo esc_attr( $mycoach_page_column ); ?>">
					<div class="page-content">
						<?php
						while( have_posts() ) : the_post();
						?>
							<div class="row">
								<div class="thumbnail-event">
									<?php mycoach_post_thumbnail(); ?>
									<div class="container">
											<div class="row">
												<div class="col-md-9">
													<div class="top-information-event">
														<p class="title-event"><?php the_title(); ?></p>
														<?php if ( rwmb_meta( 'mycoach_date_event' ) ) : ?>
													       	<p class="subtitle-event"><?php echo rwmb_meta( 'mycoach_subtitle_page_event' ); ?></p>
														<?php endif; ?>
														<ul>
															<li>
																<?php if ( rwmb_meta( 'mycoach_date_event' ) ) : ?>
													    			<div>
													       				<p><i class="fa fa-calendar-check-o" aria-hidden="true"></i><?php echo rwmb_meta( 'mycoach_date_event' ); ?></p>
													    			</div>
																<?php endif; ?>
															</li>
															<li>
																<?php if ( rwmb_meta( 'mycoach_start_time_event' ) ) : ?>
													    			<div class="time-event">
													       				<p><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo rwmb_meta( 'mycoach_start_time_event' ); ?> <span><?php echo rwmb_meta( 'mycoach_select_start_hour_event' ); ?> - </span><?php echo rwmb_meta( 'mycoach_finish_time_number_event' ); ?> <span><?php echo rwmb_meta( 'mycoach_finish_start_hour_event' ); ?></span></p>
													    			</div>
																<?php endif; ?>
																
															</li>
															<li>
																<?php if ( rwmb_meta( 'mycoach_price_event' ) ) : ?>
													    			<div class="price-button-event">
													       				<p class="price-event">
													       					<?php echo rwmb_meta( 'mycoach_currency_price_event' ); ?><?php echo rwmb_meta( 'mycoach_price_event' ); ?></p>
													       					<a href="<?php echo rwmb_meta( 'mycoach_url_ticket_event' );  ?>"><i class="fa fa-ticket" aria-hidden="true"></i> Buy</a>
													    			</div>
																<?php endif; ?>
															</li>
														</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="container">
									<div class="row">
										<div class="col-md-9">
											<div class="content-event">
												<?php the_content(); ?>
											</div>
										</div>
										<div class="col-md-3 sidebar-event">
											<div class="sidebar-section-event">
												<div class="location-event">
													<p class="title-location-event"> Location </p>
													<?php if ( rwmb_meta( 'mycoach_address_event' ) ) : ?>
														<p class="address-event"><?php echo rwmb_meta( 'mycoach_address_event' ); ?></p>
														    		
													<?php endif; ?>
												</div>
											</div>
											<?php 
													$args = array(
													    'type'         => 'map',
													    'width'        => '100%', // Map width, default is 640px. Can be '%' or 'px'
													    'height'       => '260px', // Map height, default is 480px. Can be '%' or 'px'
													    'zoom'         => 14,  // Map zoom, default is the value set in admin, and if it's omitted - 14
													    'marker'       => true, // Display marker? Default is 'true',
													    'marker_title' => '', // Marker title when hover
													    'info_window'  => '<h3>Info Window Title</h3>Info window content. HTML <strong>allowed</strong>', // Info window content, can be anything. HTML allowed.
													);
													echo rwmb_meta( 'map', $args ); // For current post
											?>
											<div class="sidebar-section-event">
												<div class="contact-event">
													<?php if ( rwmb_meta( 'mycoach_contact_number_event' ) ) : ?>
														<p class="content-number-event"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo rwmb_meta( 'mycoach_contact_number_event' ); ?></p>	
													<?php endif; ?>
													<?php if ( rwmb_meta( 'mycoach_contact_email_event' ) ) : ?>
														<p class="content-email-event"><i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo rwmb_meta( 'mycoach_contact_email_event' ); ?></p>	
													<?php endif; ?>
													<?php if ( rwmb_meta( 'mycoach_contact_website_event' ) ) : ?>
														<p class="contact-webiste-event"><i class="fa fa-globe" aria-hidden="true"></i> <?php echo rwmb_meta( 'mycoach_contact_website_event' ); ?></p>	
													<?php endif; ?>
												</div>
											</div>
											<div class="sidebar-section-event">
												<div class="details-event">
													<p class="title-details-event"> Details </p>
													<?php if ( rwmb_meta( 'mycoach_sign_ups_date_event' ) ) : ?>
														<p class="sign-ups-date-event"><strong>Sign ups:</strong> <?php echo rwmb_meta( 'mycoach_sign_ups_date_event' ); ?></p>   		
													<?php endif; ?>
													<?php if ( rwmb_meta( 'mycoach_limits_event' ) ) : ?>
														<p class="limits-event"><strong>Limits:</strong> <?php echo rwmb_meta( 'mycoach_limits_event' ); ?> participants</p>   		
													<?php endif; ?>
													<p class="event-categories">
														<strong>Event Categories: </strong>
														<?php
															$terms = get_terms( 'event-category' );
															foreach ( $terms as $term ) {
															 
															    // The $term is an object, so we don't need to specify the $taxonomy.
															    $term_link = get_term_link( $term );
															    
															    // If there was an error, continue to the next term.
															    if ( is_wp_error( $term_link ) ) {
															        continue;
															    }
															 
															    // We successfully got a link. Print it out.
															    echo '<a href="' . esc_url( $term_link ) . '">' . $term->name . '</a> ';
															}
														?>
													</p>
													<p class="event-tags">
														<strong>Event Tags:</strong> 
														<?php
															$terms = get_terms( 'event-tag' );
															foreach ( $terms as $term ) {
															 
															    // The $term is an object, so we don't need to specify the $taxonomy.
															    $term_link = get_term_link( $term );
															    
															    // If there was an error, continue to the next term.
															    if ( is_wp_error( $term_link ) ) {
															        continue;
															    }
															 
															    // We successfully got a link. Print it out.
															    echo '<a href="' . esc_url( $term_link ) . '">' . $term->name . '</a> ';
															}
														?>
													</p>
													<?php if ( rwmb_meta( 'mycoach_price_event' ) ) : ?>
														<p class="price-event"><strong>Price:</strong> <?php echo rwmb_meta( 'mycoach_price_event' ); ?><?php echo rwmb_meta( 'mycoach_currency_price_event' ); ?></p>   		
													<?php endif; ?>
													
													
												</div>
											</div>
											<div class="sidebar-section-event">
												<div class="event-qr-code">
													<img src="https://chart.googleapis.com/chart?chs=180x180&cht=qr&chl=<?php the_permalink(); ?>">
												</div>
											</div>
											<div class="sidebar-section-event">
												<div class="event-bottom-button-price">
													<?php if ( rwmb_meta( 'mycoach_price_event' ) ) : ?>
													    <div class="event-price">
													       	<p>
													       		<?php echo rwmb_meta( 'mycoach_currency_price_event' ); ?><?php echo rwmb_meta( 'mycoach_price_event' ); ?></p>
													       		
													    </div>
													    <div class="event-price-button">
													    	<a href="<?php echo rwmb_meta( 'mycoach_url_ticket_event' );  ?>"><i class="fa fa-ticket" aria-hidden="true"></i> Buy</a>
													    </div>
																<?php endif; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						<?php 
							
							
							
							do_action( 'mycoach_event_format_content_after', $post );
							mycoach_link_pages();
							if ( ( $mycoach_options['show-comments-event'] ) && ( comments_open() || '0' != get_comments_number() ) ) {
								comments_template( '', true );
							}
							do_action( 'mycoach_portfolio_item_end' );
						endwhile;
						?>
					</div>
				</div>
				<?php
				if ( $mycoach_options['event-show-previous-next-pagination'] ) {
					// prev and next posts
					$mycoach_prev = get_previous_post( true, null, 'event-category' );
					$mycoach_next = get_next_post( true, null, 'event-category' );
					?>
					<nav class="nav-portfolio">
						<?php if ( ! empty( $mycoach_prev ) ): ?>
							<a class="pro-prev" href="<?php echo esc_url(get_permalink( $mycoach_prev->ID )); ?>">
								<i class="fa fa-chevron-left"></i>
							<span class="pro-wrap">
								<span class="pro-title"><?php echo wp_kses_post( $mycoach_prev->post_title ); ?></span>
								<?php echo get_the_post_thumbnail( $mycoach_prev->ID, array( 80, 80 ) ); ?>
							</span>
							</a>
						<?php endif; ?>
						<?php if ( ! empty( $mycoach_next ) ): ?>
							<a class="pro-next" href="<?php echo esc_url(get_permalink( $mycoach_next->ID )); ?>">
								<i class="fa fa-chevron-right"></i>
			  <span class="pro-wrap">
				<span class="pro-title"><?php echo wp_kses_post( $mycoach_next->post_title ); ?></span>
				  <?php echo get_the_post_thumbnail( $mycoach_next->ID, array( 80, 80 ) ); ?>
			  </span>
							</a>
						<?php endif; ?>
					</nav>
				<?php }; ?>
				<?php mycoach_page_sidebar( 'right', $mycoach_layout, $mycoach_right_sidebar ); ?>
			</div>
		</div>
	</div>
<?php
get_footer();