<?php
$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
$mycoach_class = $mycoach_options['top-header-right-cont'] == "navigation" ? 'right' : 'left';
?>
<div class="top-actual-menu <?php echo esc_attr( $mycoach_class ) ?>">
	<?php mycoach_top_menu() ?>
</div>