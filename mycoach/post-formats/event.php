<?php
/**
 *
 * The default template for displaying content
 * @since 1.0
 * @version 1.2.0
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="article-event">
		<?php mycoach_post_thumbnail(); ?>
		<div class="event-information">
			<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>
			<ul>
				<?php
          $mycoach_date_event         = rwmb_meta( 'mycoach_date_event' );
          $mycoach_start_time_event   = rwmb_meta( 'mycoach_start_time_event' );
          $mycoach_price_event        = rwmb_meta( 'mycoach_price_event' );
        ?>
				<li>
					<?php if ( !empty( $mycoach_date_event ) ) : ?>
		    			<div>
		       				<p><i class="fa fa-calendar-check-o" aria-hidden="true"></i><?php echo esc_html( $mycoach_date_event ); ?></p>
		    			</div>
					<?php endif; ?>
				</li>
				<li>
					<?php if ( !empty( $mycoach_start_time_event ) ) :
									$mycoach_select_start_hour_event    = rwmb_meta( 'mycoach_select_start_hour_event' );
                  $mycoach_finish_time_number_event   = rwmb_meta( 'mycoach_finish_time_number_event' );
                  $mycoach_finish_start_hour_event    = rwmb_meta( 'mycoach_finish_start_hour_event' );
                ?>
		    			<div class="time-event">
		       				<p><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo esc_html( $mycoach_start_time_event ); ?> <span><?php echo esc_html( $mycoach_select_start_hour_event ); ?> - </span><?php echo esc_html( $mycoach_finish_time_number_event ); ?> <span><?php echo esc_html( $mycoach_finish_start_hour_event ); ?></span></p>
		    			</div>
					<?php endif; ?>

				</li>
				<li>
					<?php if ( !empty( $mycoach_price_event ) ) :
										$mycoach_currency_price_event   = rwmb_meta( 'mycoach_currency_price_event' );
                		?>
		    			<div>
		       				<p><span class="price-event"><?php echo esc_html( $mycoach_currency_price_event ); ?> <?php echo esc_html( $mycoach_price_event ); ?></span></p>
		    			</div>
					<?php endif; ?>
				</li>
			</ul>
		</div>
	</div>
	<?php do_action( 'mycoach_post_format_content_after', $post ); ?>
</article>
<!-- /post-standard -->
