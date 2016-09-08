<?php
/**
 *
 * Search form.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
?>
<div class="pro-search-form">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		<input type="text" placeholder="<?php esc_html_e( 'Search', 'mycoach' ); ?>" name="s" class="pro-search"/>
		<button type="submit" class="fa fa-search"></button>
	</form>
</div>