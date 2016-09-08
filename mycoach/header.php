<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package pro
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<?php $mycoach_options = mycoach_get_theme_options(); // Check theme options for existence ?>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if( !class_exists('redux') ){ ?>
				<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<?php } ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php wp_head(); ?>
	</head>
<body <?php body_class(); ?>>
<?php
	if ( $mycoach_options['loader'] ) {
		echo mycoach_loader();
	}
?>
<div id="page" class="hfeed site">
<?php mycoach_search_box(); ?>
<?php mycoach_rev_slider( 'above', $mycoach_options['slider-position'], $mycoach_options['slide-template'] ); ?>
<?php mycoach_header(); ?>
<?php mycoach_rev_slider( 'below', $mycoach_options['slider-position'], $mycoach_options['slide-template'] ); ?>
	<div id="content-wrapper" class="site-content">
<?php mycoach_title_bar(); ?>
