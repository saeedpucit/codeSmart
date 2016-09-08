<?php
/**
 *
 * Page Loop
 *
 */
$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
$mycoach_blog_layout = 'default';
$mycoach_blog_class = 'default blog-layout-' . $mycoach_blog_layout;
$mycoach_right_sidebar = $mycoach_options["sidebar-right"];
$mycoach_left_sidebar = $mycoach_options["sidebar-left"];
if ( is_archive() ) {
	$mycoach_layout = $mycoach_options['layout-archive-pages'];
} else {
	$mycoach_layout = $mycoach_options["layout"];
}
if ( $mycoach_layout == 'full' || $mycoach_layout == 'full-100' ) {
	$mycoach_page_column = '12';
} else if ( $mycoach_layout == 'left' || $mycoach_layout == 'right' ) {
	$mycoach_page_column = '9';
} else if ( $mycoach_layout == 'both' ) {
	$mycoach_page_column = '6';
}
$mycoach_container = $mycoach_layout == 'full-100' ? "container-fluid" : "container";
?>
<div
	class="<?php echo esc_attr( $mycoach_container ); ?> cont-padding page-layout-<?php echo esc_attr( $mycoach_blog_layout ); ?> blog-<?php echo esc_attr( $mycoach_blog_class ); ?>">
	<div class="row">
		<?php mycoach_page_sidebar( 'left', $mycoach_layout, $mycoach_left_sidebar ); ?>
		<div class="col-md-<?php echo esc_attr( $mycoach_page_column ); ?>">
			<div class="page-content">
				<?php
				// default posts loop
				while( have_posts() ) : the_post();
					// check blog type
					if ( $mycoach_blog_layout == 'default' ) {
						get_template_part( 'post-formats/content', get_post_format() );
					} else {
						get_template_part( 'page-templates/page-blog', $mycoach_blog_layout );
					}
				endwhile;
				// paginatio
				mycoach_paging_nav();
				?>
			</div>
			<!-- page-content -->
		</div>
		<?php mycoach_page_sidebar( 'right', $mycoach_layout, $mycoach_right_sidebar ); ?>
	</div>
</div>