<?php
/**
 *
 * Post formats filters in the_content
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_content_filter' ) ) {
	function mycoach_content_filter( $content ) {
		$post_format = get_post_format();
		if ( $post_format ) {
			$content = apply_filters( 'pro-post-format-' . $post_format, $content );
		}
		return $content;
	}
	add_filter( 'the_content', 'mycoach_content_filter', 2 );
}
/**
 *
 * Post format "Link"
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_post_format_link' ) ) {
	function mycoach_post_format_link( $content ) {
		$parse_content = mycoach_post_format_link_helper( $content );
		return $parse_content['content'];
	}
	add_filter( 'pro-post-format-link', 'mycoach_post_format_link' );
}
/**
 *
 * Post format "Video and Audio"
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_post_format_media' ) ) {
	function mycoach_post_format_media( $content ) {
		$media = mycoach_get_first_url_from_string( $content );
		if ( ! empty( $media ) ) {
			$content = str_replace( $media, '', $content );
		} else {
			$pattern = mycoach_get_shortcode_regex( mycoach_tagregexp() );
			preg_match( '/' . $pattern . '/s', $content, $media );
			if ( ! empty( $media[2] ) ) {
				$content = str_replace( $media[0], '', $content );
			}
		}
		return $content;
	}
	add_filter( 'pro-post-format-video', 'mycoach_post_format_media' );
	add_filter( 'pro-post-format-audio', 'mycoach_post_format_media' );
}
/**
 *
 * Post format "Gallery"
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_post_format_gallery' ) ) {
	function mycoach_post_format_gallery( $content ) {
		$pattern = mycoach_get_shortcode_regex( 'gallery' );
		preg_match( '/' . $pattern . '/s', $content, $media );
		if ( ! empty( $media[2] ) ) {
			$content = str_replace( $media[0], '', $content );
		}
		return $content;
	}
	add_filter( 'pro-post-format-gallery', 'mycoach_post_format_gallery' );
}
/**
 *
 * Post format "Chat"
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_post_format_chat' ) ) {
	function mycoach_post_format_chat( $content ) {
		$output = '<ul class="pro-chat">';
		$rows = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );
		$i = 0;
		foreach ( $rows as $row ) {
			if ( strpos( $row, ':' ) ) {
				$row_split = explode( ':', trim( $row ), 2 );
				$author = strip_tags( trim( $row_split[0] ) );
				$text = trim( $row_split[1] );
				$output .= '<li class="pro-chat-row pro-chat-row-' . ( $i % 2 ? 'odd' : 'even' ) . '">';
				$output .= '<div class="pro-chat-author ' . sanitize_html_class( strtolower( "chat-author-{$author}" ) ) . ' vcard"><span class="fa fa-comment"></span> <cite class="fn">' . $author . '</cite>' . ':' . '</div>';
				$output .= '<div class="pro-chat-text">' . $text . '</div>';
				$output .= '</li>';
				$i ++;
			} else {
				$output .= $row;
			}
		}
		$output .= '</ul>';
		return $output;
	}
	add_filter( 'pro-post-format-chat', 'mycoach_post_format_chat' );
}
/**
 *
 * The content more link modification
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if ( ! function_exists( 'mycoach_content_more_link' ) ) {
	function mycoach_content_more_link( $link ) {
		$offset = strpos( $link, '#more-' );
		if ( $offset ) {
			$end = strpos( $link, '"', $offset );
		}
		if ( $end ) {
			$link = substr_replace( $link, '', $offset, ( $end - $offset ) );
		}
		$link = '<span class="clear"></span>' . str_replace( 'more-link', 'entry-more ' . mycoach_get_button_class( array( 'size' => 'xxs' ) ), $link );
		return $link;
	}
	add_filter( 'the_content_more_link', 'mycoach_content_more_link' );
}
/**
 *
 * Blog Excerpt Read More
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_excerpt_read_more_link' ) ) {
	function mycoach_excerpt_read_more_link( $text ) {
		return ( is_search() ) ? $text : $text . '<a href="' . esc_url(get_permalink( get_the_ID() )) . '" class="entry-more pro-btn pro-btn-rounded pro-btn-xxs pro-btn-flat-accent">' . esc_html__( 'Read More', 'mycoach' ) . '<span class="screen-reader-text"> '.esc_html__( 'about', 'mycoach' ).' '. get_the_title() .'</span></a>';
	}
	add_filter( 'the_excerpt', 'mycoach_excerpt_read_more_link' );
}
/**
 *
 * Blog Excerpt Length
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_excerpt_length' ) ) {
	function mycoach_excerpt_length( $length ) {
		$mycoach_options = mycoach_get_theme_options();
		if ( $mycoach_options['excerpt-length'] ) {
			return $mycoach_options['excerpt-length'];
		} else {
			return $length;
		}
	}
	add_filter( 'excerpt_length', 'mycoach_excerpt_length', 999 );
}
/**
 *
 * Disable default wordpress gallery styles
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_use_default_gallery_style' ) ) {
	function mycoach_use_default_gallery_style() {
		return false;
	}
	add_filter( 'use_default_gallery_style', 'mycoach_use_default_gallery_style' );
}
/**
 *
 * Retrieve protected post password form content.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_the_password_form' ) ) {
	function mycoach_the_password_form( $output ) {
		$output = str_replace( 'type="submit"', 'type="submit" class="pro-password-btn ' . mycoach_get_button_class( array( 'size' => 'sm' ) ) . '"', $output );
		return $output;
	}
	add_filter( 'the_password_form', 'mycoach_the_password_form' );
}
/**
 *
 * Custom Image Sizes
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'mycoach_image_size_names_choose' ) ) {
	function mycoach_image_size_names_choose( $image_sizes ) {
		$custom_image_sizes = mycoach_get_images_custom_sizes();
		if ( ! empty( $custom_image_sizes ) ) {
			$custom_sizes = array();
			foreach ( $custom_image_sizes as $image_size ) {
				$name                  = sanitize_title( $image_size['name'] );
				$custom_sizes[ $name ] = $image_size['name'];
			}
			return array_merge( $image_sizes, $custom_sizes );
		}
		return $image_sizes;
	}
	add_filter( 'image_size_names_choose', 'mycoach_image_size_names_choose' );
}
if ( ! function_exists( 'mycoach_add_async_forscript' ) ) {
	function mycoach_add_async_forscript( $url ) {
		if ( strpos( $url, '#asyncload' ) === false ) {
			return $url;
		} else if ( is_admin() ) {
			return str_replace( '#asyncload', '', $url );
		} else {
			return str_replace( '#asyncload', '', $url ) . "' async='async";
		}
	}
	add_filter( 'clean_url', 'mycoach_add_async_forscript', 11, 1 );
if ( ! function_exists( 'mycoach_sin_excerpt' ) ) {
	function mycoach_sin_excerpt($limit)
	{
		$excerpt = explode(' ', get_the_excerpt(), $limit+1);
		if (count($excerpt) >= $limit) {
			array_pop($excerpt);
			$excerpt = implode(" ", $excerpt);
			$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
			$excerpt = '<p>' . $excerpt . ' ...</p>';
		} else {
			$excerpt = implode(" ", $excerpt);
			$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
			$excerpt = '<p>' . $excerpt . '</p>';
		}
		$excerpt .= '<a href="' . esc_url(get_permalink(get_the_ID())) . '" class="entry-more pro-btn pro-btn-rounded pro-btn-xxs pro-btn-flat-accent">' . esc_html__('Read More', 'mycoach' ) . '<span class="screen-reader-text"> ' . esc_html__('about', 'mycoach' ) . ' ' . get_the_title() . '</span></a>';
		return $excerpt;
	}
}
}