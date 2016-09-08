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


	if( !class_exists('redux') ){
		$mycoach_page_right_sidebar = 'sidebar-1';
		$mycoach_page_left_sidebar 	= 'sidebar-1';
		$mycoach_page_layout 				= 'full';
	}else{
		$mycoach_page_right_sidebar = netbee_redux_post_meta( "netbee_options", get_the_ID(), "sidebar-right" );
		$mycoach_page_left_sidebar = netbee_redux_post_meta( "netbee_options", get_the_ID(), "sidebar-right" );
		$mycoach_page_layout = netbee_redux_post_meta( "netbee_options", get_the_ID(), "layout" );
	}

$mycoach_options['single-sidebar-right'] = isset($mycoach_options['single-sidebar-right']);
$mycoach_global_right_sidebar = isset($mycoach_options['single-sidebar-right']) ? $mycoach_options['single-sidebar-right'] : NULL;
$mycoach_global_left_sidebar = isset($mycoach_options['single-sidebar-left']) ? $mycoach_options['single-sidebar-left'] : NULL;
$mycoach_right_sidebar = $mycoach_page_right_sidebar ? $mycoach_page_right_sidebar : $mycoach_global_right_sidebar;
$mycoach_left_sidebar = $mycoach_page_left_sidebar ? $mycoach_page_left_sidebar : $mycoach_global_left_sidebar;
$mycoach_layout = $mycoach_page_layout ? $mycoach_page_layout : $mycoach_options['single-layout'];
if ( $mycoach_layout == 'full' || $mycoach_layout == 'full-100' ) {
	$mycoach_page_column = '12';
} else if ( $mycoach_layout == 'left' || $mycoach_layout == 'right' ) {
	$mycoach_page_column = '9';
} else if ( $mycoach_layout == 'both' ) {
	$mycoach_page_column = '6';
}
$mycoach_container = $mycoach_layout == 'full-100' ? "container-fluid" : "container";
?>
	<div class="<?php echo esc_attr( $mycoach_container ) ?> cont-padding blog-default single-post">
		<div class="row">
			<?php mycoach_page_sidebar( 'left', $mycoach_layout, $mycoach_left_sidebar ); ?>
			<div class="col-md-<?php echo esc_attr( $mycoach_page_column ); ?>">
				<div class="page-content">
					<?php
					if( !class_exists('redux') ){

						while( have_posts() ) : the_post();
							get_template_part( 'post-formats/content' );
							if ( 1 ) {
								mycoach_post_nav();
							}
							if ( 1 ):
								comments_template( '', true );
							endif;
						endwhile;
					}else{
						while( have_posts() ) : the_post();
							get_template_part( 'post-formats/content', get_post_format() );
							if ( $mycoach_options['blog_single_nav'] ) {
								mycoach_post_nav();
							}
							if ( comments_open() && $mycoach_options['blog_comments'] ):
								comments_template( '', true );
							endif;
						endwhile;
					}
					?>
				</div>
			</div>
			<?php mycoach_page_sidebar( 'right', $mycoach_layout, $mycoach_right_sidebar ); ?>
		</div>
	</div>
<?php
get_footer();
