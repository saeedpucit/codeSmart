<?php
$mycoach_options = mycoach_get_theme_options(); // Check theme options for existence
if ( $mycoach_options['language-switch'] ) {
	$out = '';
	if ( is_wpml_activated() ) {
		global $sitepress;
		$sitepress_settings = $sitepress->get_settings();
		$icl_get_languages = icl_get_languages();
		if ( ! empty( $icl_get_languages ) ) {
			$out .= '<ul class="wpml-switch nav navbar-nav ' . $mycoach_options['language-switch-position'] . '">';
			// current language
			$out .= '<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">';
			foreach ( $icl_get_languages as $id => $current_lang ) {
				if ( $current_lang['active'] ) {
					$out .= '<img src="' . $current_lang['country_flag_url'] . '" alt="' . $current_lang['language_code'] . '" />';
					$out .= ( ( $sitepress_settings['icl_lso_native_lang'] ) ? $current_lang['native_name'] : $current_lang['translated_name'] );					
				}
			}
			$out .= '</a>';
			// list languages
			$out .= '<ul class="dropdown-menu" role="menu">';
			foreach ( $icl_get_languages as $id => $language ) {
				if ( ! $language['active'] ) {
					$name = ( ! $language['active'] && $language['translated_name'] != $language['native_name'] ) ? ' (' . $language['translated_name'] . ')' : '';
					$out .= '<li>';
					$out .= '<a href="' . $language['url'] . '">';
					$out .= ( $sitepress_settings['icl_lso_flags'] ) ? '<img src="' . $language['country_flag_url'] . '" alt="' . $language['language_code'] . '" />' : '';
					$out .= ( $sitepress_settings['icl_lso_native_lang'] && $sitepress_settings['icl_lso_display_lang'] ) ? $language['native_name'] . $name : '';
					$out .= ( ! $sitepress_settings['icl_lso_native_lang'] && $sitepress_settings['icl_lso_display_lang'] ) ? $language['translated_name'] : '';
					$out .= ( $sitepress_settings['icl_lso_native_lang'] && ! $sitepress_settings['icl_lso_display_lang'] ) ? $language['native_name'] : '';
					$out .= '</a>';
					$out .= '</li>';
				}
			}
			$out .= '</ul></li></ul>';
		}
	} else {
		$out .= '<span class="text">';
		$out .= 'WPML is not activated';
		$out .= '</span>';
	}
	echo wp_kses_post( $out );
}
?>