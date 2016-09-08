<?php
/**
 *
 * Get first "url" from post content or string
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_get_first_url_from_string' ) ) {
	function mycoach_get_first_url_from_string( $string ) {
		$pattern = "/^\b(?:(?:https?|ftp):\/\/)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
		preg_match( $pattern, $string, $link );
		return ( ! empty( $link[0] ) ) ? $link[0] : false;
	}
}
/**
 *
 * Custom Regular Expression
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_get_shortcode_regex' ) ) {
	function mycoach_get_shortcode_regex( $tagregexp = '' ) {
		// WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
		// Also, see shortcode_unautop() and shortcode.js.
		return
			'\\['                                // Opening bracket
			. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
			. "($tagregexp)"                     // 2: Shortcode name
			. '(?![\\w-])'                       // Not followed by word character or hyphen
			. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
			. '[^\\]\\/]*'                   // Not a closing bracket or forward slash
			. '(?:'
			. '\\/(?!\\])'               // A forward slash not followed by a closing bracket
			. '[^\\]\\/]*'               // Not a closing bracket or forward slash
			. ')*?'
			. ')'
			. '(?:'
			. '(\\/)'                        // 4: Self closing tag ...
			. '\\]'                          // ... and closing bracket
			. '|'
			. '\\]'                          // Closing bracket
			. '(?:'
			. '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
			. '[^\\[]*+'             // Not an opening bracket
			. '(?:'
			. '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
			. '[^\\[]*+'         // Not an opening bracket
			. ')*+'
			. ')'
			. '\\[\\/\\2\\]'             // Closing shortcode tag
			. ')?'
			. ')'
			. '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
	}
}
/**
 *
 * Tag Regular Expression
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_tagregexp' ) ) {
	function mycoach_tagregexp() {
		return apply_filters( 'mycoach_custom_tagregexp', 'video|audio|playlist|video-playlist|embed|mycoach_media' );
	}
}
/**
 *
 * Parse url and content for post format: link
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_post_format_link_helper' ) ) {
	function mycoach_post_format_link_helper( $content = null, $title = null, $post = null ) {
		if ( ! $content ) {
			$post = get_post( $post );
			$title = $post->post_title;
			$content = $post->post_content;
		}
		$link = mycoach_get_first_url_from_string( $content );
		if ( ! empty( $link ) ) {
			$title = '<a href="' . esc_url( $link ) . '" rel="bookmark">' . $title . '</a>';
			$content = str_replace( $link, '', $content );
		} else {
			$pattern = '/^\<a[^>](.*?)>(.*?)<\/a>/i';
			preg_match( $pattern, $content, $link );
			if ( ! empty( $link[0] ) && ! empty( $link[2] ) ) {
				$title = $link[0];
				$content = str_replace( $link[0], '', $content );
			} elseif ( ! empty( $link[0] ) && ! empty( $link[1] ) ) {
				$atts = shortcode_parse_atts( $link[1] );
				$target = ( ! empty( $atts['target'] ) ) ? $atts['target'] : '_self';
				$title = ( ! empty( $atts['title'] ) ) ? $atts['title'] : $title;
				$title = '<a href="' . esc_url( $atts['href'] ) . '" rel="bookmark" target="' . $target . '">' . $title . '</a>';
				$content = str_replace( $link[0], '', $content );
			} else {
				$title = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $title . '</a>';
			}
		}
		$out['title'] = '<h2 class="entry-title">' . $title . '</h2>';
		$out['content'] = $content;
		return $out;
	}
}
/**
 *
 * POST FORMAT: LINK HELPER
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_get_link_attributes' ) ) {
	function mycoach_get_link_attributes( $string ) {
		preg_match( '/<a href="(.*?)">/i', $string, $atts );
		return ( ! empty( $atts[1] ) ) ? $atts[1] : '';
	}
}
/**
 *
 * POST FORMAT: VIDEO & AUDIO
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_post_media' ) ) {
	function mycoach_post_media( $content ) {
		$is_video = ( get_post_format() == 'video' ) ? true : false;
		$media = mycoach_get_first_url_from_string( $content );
		if ( ! empty( $media ) ) {
			global $wp_embed;
			$content = do_shortcode( $wp_embed->run_shortcode( '[embed]' . $media . '[/embed]' ) );
		} else {
			$pattern = mycoach_get_shortcode_regex( mycoach_tagregexp() );
			preg_match( '/' . $pattern . '/s', $content, $media );
			if ( ! empty( $media[2] ) ) {
				if ( $media[2] == 'embed' ) {
					global $wp_embed;
					$content = do_shortcode( $wp_embed->run_shortcode( $media[0] ) );
				} else {
					$content = do_shortcode( $media[0] );
				}
			}
		}
		if ( ! empty( $media ) ) {
			$output = '<div class="entry-media">';
			$output .= ( $is_video ) ? '<div class="pro-fluid"><div class="pro-fluid-inner">' : '';
			$output .= $content;
			$output .= ( $is_video ) ? '</div></div>' : '';
			$output .= '</div>';
			return $output;
		}
		return false;
	}
}
/**
 *
 * POST FORMAT: GALLERY
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_post_gallery' ) ) {
	function mycoach_post_gallery( $content ) {
		$mycoach_options = mycoach_get_theme_options();
		$pattern = mycoach_get_shortcode_regex( 'gallery' );
		preg_match( '/' . $pattern . '/s', $content, $media );
		if ( ! empty( $media[2] ) && $mycoach_options['blog_featured_image'] ) {
			return '<div class="entry-gallery">' . do_shortcode( $media[0] ) . '<hr class="pro-clear" /></div>';
		}
		return false;
	}
}
/**
 *
 * Tabs Widget
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function mycoach_string_limit_words( $string, $word_limit ) {
	$words = explode( ' ', $string, ( $word_limit + 1 ) );
	if ( count( $words ) > $word_limit ) {
		array_pop( $words );
	}
	return implode( ' ', $words );
}
