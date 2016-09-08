<?php
add_action( 'wp_enqueue_scripts', 'mycoach_theme_enqueue_styles' );
function mycoach_theme_enqueue_styles() {
	$parent_style = 'mycoach-parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/css/style.css' );
    wp_enqueue_style( 'mycoach-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );

}