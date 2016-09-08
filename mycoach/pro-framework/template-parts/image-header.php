<?php
$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
if ( ! is_404() && ! is_home() ) {

	if( !class_exists('redux') ) {
		$mycoach_page_bar = Array
            (
                'background-color'        => '#3ad071',
                'background-repeat'       => 'repeat',
                'background-size'         => 'cover',
                'background-attachment'   => '',
                'background-position'     => 'center center',
                'background-image'        => '',
                'media' => Array
                    (
                        'id'          => '',
                        'height'      => '',
                        'width'       => '',
                        'thumbnail'   => ''
                    )

            );
        $mycoach_page = '';
        ?>
          <div class="page-title-cont container-fluid" data-effect="parallax">
          <div class="row">
          <div class="page-header">
          <?php echo mycoach_background( $mycoach_page_bar, $mycoach_page ); ?>
          <div class="overlay"></div>
          <div class="container">
          <div class="row">
          <div class="col-xs-12 col-md-12 display-table">
          <div class="title-wrapper fadeIn">
          <?php if ( 1 ) { ?>
          <h2 class="netbee-install-warning">
          <?php  echo "Please install the Required Netbee-core plugin."; ?>
          </h2>

          <?php }; ?>
          <?php if ( $mycoach_options['custom-slogan-switch'] ) { ?>
          <span> <?php echo wp_kses_post( $mycoach_options['custom-slogan'] ); ?> </span>
          <?php }; ?>
          </div>
          <?php

          // @todo don`t initialize breadcrumbs if on mobile device
          if ( $mycoach_options['display-breadcrumbs'] ) { ?>
          <div class="pro-breadcrumb <?php if ( $mycoach_options['hide-breadcrumbs-mobile'] ) {
          echo 'hidden-mobile';
          } ?>">
          <div class="pro-inner">
          <?php
          if ( function_exists( 'bcn_display' ) ) {
            bcn_display();
          }
          ?>
          </div>
          </div>
          <?php }; ?>
          </div>
          </div>
          </div>
          </div>
          </div>
          </div>

		<?php
	}
		else{
	?>
	<div class="page-title-cont container-fluid" <?php if ( $mycoach_options['page-title-fading'] ) {
		echo 'data-effect="parallax"';
	} ?>>
		<div class="row">
			<div class="page-header">
				<?php echo mycoach_background( $mycoach_options['background-image-page-title'], $mycoach_options['page-title-parallax'] ); ?>
				<div class="overlay"></div>
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-md-12 display-table">
							<div class="title-wrapper fadeIn">
								<?php if ( $mycoach_options['page-title-switch'] ) { ?>
									<h1>
										<?php
										if ( $mycoach_options['custom-title-switch'] ) {
											echo wp_kses_post( $mycoach_options['custom-title'] );
										} else {
											if ( is_category() ) :
												single_cat_title();
											elseif ( is_tag() ) :
												single_tag_title();
											elseif ( is_author() ) :
												printf( esc_html__( 'Author: %s', 'mycoach' ), '<span class="vcard">' . get_the_author() . '</span>' );
											elseif ( is_day() ) :
												printf( esc_html__( 'Day: %s', 'mycoach' ), '<span>' . get_the_date() . '</span>' );
											elseif ( is_month() ) :
												printf( esc_html__( 'Month: %s', 'mycoach' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'mycoach' ) ) . '</span>' );
											elseif ( is_year() ) :
												printf( esc_html__( 'Year: %s', 'mycoach' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'mycoach' ) ) . '</span>' );
											elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
												esc_html_e( 'Asides', 'mycoach' );
											elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
												esc_html_e( 'Galleries', 'mycoach' );
											elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
												esc_html_e( 'Images', 'mycoach' );
											elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
												esc_html_e( 'Videos', 'mycoach' );
											elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
												esc_html_e( 'Quotes', 'mycoach' );
											elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
												esc_html_e( 'Links', 'mycoach' );
											elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
												esc_html_e( 'Statuses', 'mycoach' );
											elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
												esc_html_e( 'Audios', 'mycoach' );
											elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
												esc_html_e( 'Chats', 'mycoach' );
											elseif ( is_search() ) :
												printf( esc_html__( 'Search Results for: %s', 'mycoach' ), get_search_query() );
											elseif ( is_woocommerce_shop() ) :
												$mycoach_post_id = wc_get_page_id( 'shop' );
												echo get_the_title( $mycoach_post_id );
											elseif ( is_archive() ) :
												echo the_archive_title();
											else :
												the_title();
											endif;
										}; ?>
									</h1>
								<?php }; ?>
								<?php if ( $mycoach_options['custom-slogan-switch'] ) { ?>
									<span> <?php echo wp_kses_post( $mycoach_options['custom-slogan'] ); ?> </span>
								<?php }; ?>
							</div>
							<?php
							// @todo don`t initialize breadcrumbs if on mobile device
							if ( $mycoach_options['display-breadcrumbs'] ) { ?>
								<div class="pro-breadcrumb <?php if ( $mycoach_options['hide-breadcrumbs-mobile'] ) {
									echo 'hidden-mobile';
								} ?>">
									<div class="pro-inner">
										<?php
										if ( function_exists( 'bcn_display' ) ) {
											bcn_display();
										}
										?>
									</div>
								</div>
							<?php }; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
	}//end of else part
}; ?>
