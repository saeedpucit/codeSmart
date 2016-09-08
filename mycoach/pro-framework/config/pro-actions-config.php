<?php

/**

 *

 * After Theme Supports

 * @since 1.0.0

 * @version 1.0.0

 *

 */

if ( ! function_exists( 'mycoach_after_setup_theme' ) ) {

	function mycoach_after_setup_theme() {

		global $content_width;

		if ( ! isset( $content_width ) ) {

			$content_width = 1170;

		}

		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'post-formats', array(

			'aside',

			'image',

			'gallery',

			'video',

			'audio',

			'link',

			'quote',

			'status',

			'chat'

		) );

		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		add_theme_support( 'custom-header' );

		add_theme_support( 'custom-background' );

		add_theme_support( 'title-tag' );

		remove_theme_support( 'custom-header' );

		remove_theme_support( 'custom-background' );
	   
	    add_theme_support( 'woocommerce' );

		$custom_image_sizes = mycoach_get_images_custom_sizes();

		if ( ! empty( $custom_image_sizes ) ) {

			foreach ( $custom_image_sizes as $size ) {

				$crop = ( ! empty( $size['crop'] ) ) ? true : false;

				add_image_size( sanitize_title( $size['name'] ), $size['size']['width'], $size['size']['height'], $crop );

			}

		}

		/*

	 	* Enable support for custom logo.

	 	*/

		add_theme_support( 'custom-logo', array(

			'header-text' => array( 'site-title', 'site-description' ),

			'height'      => 55,

			'width'       => 240,

			'flex-width' => true,

		) );

		register_nav_menus( array(

			'primary'     => esc_html__( 'Primary Menu', 'mycoach' ),

			'top_menu'    => esc_html__( 'Top Menu', 'mycoach' ),

			'one_page'    => esc_html__( 'One Page Menu', 'mycoach' ),

			'footer_menu' => esc_html__( 'Footer Menu', 'mycoach' ),

		) );

		load_theme_textdomain( 'mycoach' , MYCOACH_THEME_DIR . '/languages' );

	}

	add_action( 'after_setup_theme', 'mycoach_after_setup_theme' );

}

if ( ! function_exists( 'mycoach_theme_add_editor_styles' ) ) {

	function mycoach_theme_add_editor_styles() {

	   

	    add_editor_style( 'custom-editor-style.css' );

	}

add_action( 'admin_init', 'mycoach_theme_add_editor_styles' );

}

/**

 *

 * Allow SVG in wordpress

 * @since 1.0.0

 * @version 1.1.0

 *

 */

if ( ! function_exists( 'mycoach_custom_upload_mimes' ) ) {

	function mycoach_custom_upload_mimes( $existing_mimes = array() ) {

		$existing_mimes['svg'] = 'mime/type';

		return $existing_mimes;

	}

	add_filter( 'upload_mimes', 'mycoach_custom_upload_mimes' );

}

/**

 *

 * Ajax Pagination

 * @since 1.0.0

 * @version 1.1.0

 *

 */

if ( ! function_exists( 'mycoach_ajax_pagination' ) ) {

	function mycoach_ajax_pagination() {

		$type       = ( ! empty( $_POST['post_type'] ) ) ? $_POST['post_type'] : 'post';

		$template   = ( ! empty( $_POST['template'] ) ) ? $_POST['template'] : 'default';

		$query_args = array(

			'paged'          => $_POST['paged'],

			'posts_per_page' => $_POST['posts_per_page'],

			'posts_per_page' => $_POST['posts_per_page'],

			'post_type'      => $type,

		);

		if ( isset($_POST['cat']) ) {

			$query_args['cat'] = $_POST['cat'];

		}

		query_posts( $query_args );

		while( have_posts() ) : the_post();

			if ( $type == 'post' ) {

				global $mycoach_blog_image_size, $mycoach_blog_column;

				$mycoach_blog_image_size = $_POST['size'];

				$mycoach_blog_column     = $_POST['columns'];

				if ( $template != 'default' ) {

					$template = ( $template == 'grid' ) ? 'masonry' : $template;

					get_template_part( 'page-templates/page-blog', $template );

				} else {

					if(get_post_format() != '') {

						get_template_part( 'post-formats/content', get_post_format() );

					}

					else

					{

						get_template_part( 'post-formats/content' );

					}					

				}

			}

		endwhile;

		wp_reset_query();

		die();

	}

	add_action( 'wp_ajax_ajax-pagination', 'mycoach_ajax_pagination' );

	add_action( 'wp_ajax_nopriv_ajax-pagination', 'mycoach_ajax_pagination' );

}

/**

 *

 * Comments for Portfolio Items

 * @since 1.0.0

 * @version 1.0.0

 *

 */

if ( ! function_exists( 'mycoach_portfolio_comment_form' ) ) {

	function mycoach_portfolio_comment_form() { }

	add_action( 'mycoach_portfolio_item_end', 'mycoach_portfolio_comment_form' );

}

/**

 *

 * Comments for Story Items

 * @since 1.0.0

 * @version 1.0.0

 *

 */

if ( ! function_exists( 'mycoach_story_comment_form' ) ) {

	function mycoach_story_comment_form() { }

	add_action( 'mycoach_story_item_end', 'mycoach_story_comment_form' );

}

/**

 *

 * Comments for Event Items

 * @since 1.0.0

 * @version 1.0.0

 *

 */

if ( ! function_exists( 'mycoach_event_comment_form' ) ) {

	function mycoach_event_comment_form() { }

	add_action( 'mycoach_event_item_end', 'mycoach_event_comment_form' );

}

if ( ! function_exists( 'mycoach_display_post_author' ) ) :

	function mycoach_display_post_author() {

		$user_url = get_the_author_meta( 'user_url' );

		$avatar   = get_avatar( get_the_author_meta( 'ID' ), 85 );

		?>

		<div class="pro-fancy-separator title-left fancy-author-title">

			<h5 class="pro-fancy-title"><?php esc_html_e( 'About the author', 'mycoach' ); ?><span

					class="separator-holder separator-right"></span></h5>

		</div>

		<div class="entry-author">

			<?php

			if ( $avatar ) {

				echo '<div class="wf-td entry-author-img">';

				if ( $user_url ) {

					printf( '<a href="%s" class="alignleft">%s</a>', esc_url( $user_url ), $avatar );

				} else {

					echo str_replace( "class='", "class='alignleft ", $avatar );

				}

				echo '</div>';

			}

			?>

			<div class="entry-author-info">

				<p class="h5-size"><?php the_author_meta( 'display_name' ); ?></p>

				<p class="text-normal"><?php the_author_meta( 'description' ); ?></p>

			</div>

		</div>

		<?php

	}

endif;

/**

 *

 * Post Format Content After

 * @since 1.0.0

 * @version 1.0.0

 *

 */

if ( ! function_exists( 'mycoach_post_format_content_after' ) ) {

	function mycoach_post_format_content_after( $post = null ) {

		$mycoach_options = mycoach_get_theme_options();

		mycoach_link_pages();

		if ( is_single() ) {

			?>

			<div class="entry-footer">

				<?php do_action( 'mycoach_single_content_after', $post ); ?>

				<?php

				if ( $mycoach_options['blog_author_info'] ) {

					mycoach_display_post_author();

				} ?>

				<?php if ( $mycoach_options['blog_recent_posts'] ) { ?>

					<?php

					$single_recents = mycoach_get_option( 'single_recents' );

					$single_title   = mycoach_get_option( 'single_recents_title' );

					$type           = ( ! empty( $single_recents ) ) ? $single_recents : 'random';

					$title          = ( ! empty( $single_title ) ) ? $single_title : ucfirst( $type ) . ' Posts';

					$operation      = true;

					$args           = array(

						'post_type'           => 'post',

						'ignore_sticky_posts' => 1,

						'posts_per_page'      => $mycoach_options['related_posts_number'],

					);

					switch ( $type ) {

						case 'commented':

							$args['orderby'] = 'comment_count';

							break;

						case 'random':

							$args['orderby'] = 'rand';

							break;

						case 'related':

							$tags = wp_get_post_tags( $post->ID );

							$ids  = array();

							if ( ! empty( $tags ) ) {

								foreach ( $tags as $term ) {

									$ids[] = $term->term_id;

								}

							} else {

								$operation = false;

							}

							$args['tag__in']      = $ids;

							$args['post__not_in'] = array( $post->ID );

							$args['orderby']      = 'rand';

							break;

						default:

							$args['orderby'] = 'date';

							break;

					}

					$q = new WP_Query( $args );

					$size = array( 60, 60 );

					if ( $q->have_posts() && $operation === true ) {

						echo '<div class="pro-fancy-separator title-left fancy-posts-title"><h5 class="pro-fancy-title">' . $title . '<span class="separator-holder separator-right"></span></h5></div>';

						echo '<section class="row round-images  related-posts">';

						while( $q->have_posts() ) : $q->the_post();

							setup_postdata( $post );

							echo '<div class="col-md-6"><div class="borders"><article class="post-format-standard"><div class="post-image"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';

							echo get_the_post_thumbnail( $q->ID, $size );

							echo '</a></div><div class="post-content"><h4><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_the_title() . '</a></h4> <time datetime="' . esc_attr( get_the_date( 'c' ) ) . '"> ' . esc_html( get_the_date() ) . '</time></div></article></div></div>';

						endwhile;

						echo '</section>';

					}

					wp_reset_postdata();

					?><!-- entry-recents -->

				<?php } ?>

			</div><!-- /entry-footer -->

			<?php

		}

	}

	add_action( 'mycoach_post_format_content_after', 'mycoach_post_format_content_after' );

}

/**

 *

 * Portofolio Format Content After

 * @since 1.0.0

 * @version 1.0.0

 *

 */

if ( ! function_exists( 'mycoach_portfolio_format_content_after' ) ) {

	function mycoach_portfolio_format_content_after( $post = null ) {

		$mycoach_options = mycoach_get_theme_options();

		if ( is_single() ) {

			?>

			<?php if ( $mycoach_options['portfolio_recent_posts'] ) { ?>

				<?php

				$single_recents = mycoach_get_option( 'portfolio_single_recents' );

				$single_title   = mycoach_get_option( 'portfolio_single_recents_title' );

				$type           = ( ! empty( $single_recents ) ) ? $single_recents : 'random';

				$title          = ( ! empty( $single_title ) ) ? $single_title : ucfirst( $type ) . ' Posts';

				$operation      = true;

				$args           = array(

					'post_type'           => 'portfolio',

					'ignore_sticky_posts' => 1,

					'posts_per_page'      => $mycoach_options['portfolio_related_posts_number'],

				);

				switch ( $type ) {

					case 'commented':

						$args['orderby'] = 'comment_count';

						break;

					case 'random':

						$args['orderby'] = 'rand';

						break;

					case 'related':

						$tags = wp_get_post_tags( $post->ID );

						$ids  = array();

						if ( ! empty( $tags ) ) {

							foreach ( $tags as $term ) {

								$ids[] = $term->term_id;

							}

						} else {

							$operation = false;

						}

						$args['tag__in']      = $ids;

						$args['post__not_in'] = array( $post->ID );

						$args['orderby']      = 'rand';

						break;

					default:

						$args['orderby'] = 'date';

						break;

				}

				$q = new WP_Query( $args );

				if ( $q->have_posts() && $operation === true ) {

					echo '<div class="related-posts"><h2 class="related-title">' . $title . '</h2><ul>';

					while( $q->have_posts() ) : $q->the_post();

						setup_postdata( $post );

						echo '<li><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_the_title() . '</a> <time datetime="' . esc_attr( get_the_date( 'c' ) ) . '">- ' . esc_html( get_the_date() ) . '</time></li>';

					endwhile;

					echo '</ul></div>';

				}

				wp_reset_postdata();

				?><!-- entry-recents -->

			<?php }

		}

	}

	add_action( 'mycoach_portfolio_format_content_after', 'mycoach_portfolio_format_content_after' );

}

/**

 *

 * Story Format Content After

 * @since 1.0.0

 * @version 1.0.0

 *

 */

if ( ! function_exists( 'mycoach_story_format_content_after' ) ) {

	function mycoach_story_format_content_after( $post = null ) {

		$mycoach_options = mycoach_get_theme_options();

		if ( is_single() ) {

			?>

			<?php if ( $mycoach_options['story_recent_posts'] ) { ?>

				<?php

				$single_recents = mycoach_get_option( 'story_single_recents' );

				$single_title   = mycoach_get_option( 'story_single_recents_title' );

				$type           = ( ! empty( $single_recents ) ) ? $single_recents : 'random';

				$title          = ( ! empty( $single_title ) ) ? $single_title : ucfirst( $type ) . ' Posts';

				$operation      = true;

				$args           = array(

					'post_type'           => 'story',

					'ignore_sticky_posts' => 1,

					'posts_per_page'      => $mycoach_options['story_related_posts_number'],

				);

				switch ( $type ) {

					case 'commented':

						$args['orderby'] = 'comment_count';

						break;

					case 'random':

						$args['orderby'] = 'rand';

						break;

					case 'related':

						$tags = wp_get_post_tags( $post->ID );

						$ids  = array();

						if ( ! empty( $tags ) ) {

							foreach ( $tags as $term ) {

								$ids[] = $term->term_id;

							}

						} else {

							$operation = false;

						}

						$args['tag__in']      = $ids;

						$args['post__not_in'] = array( $post->ID );

						$args['orderby']      = 'rand';

						break;

					default:

						$args['orderby'] = 'date';

						break;

				}

				$q = new WP_Query( $args );

				if ( $q->have_posts() && $operation === true ) {

					echo '<div class="related-posts"><h2 class="related-title">' . $title . '</h2><ul>';

					while( $q->have_posts() ) : $q->the_post();

						setup_postdata( $post );

						echo '<li><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_the_title() . '</a> <time datetime="' . esc_attr( get_the_date( 'c' ) ) . '">- ' . esc_html( get_the_date() ) . '</time></li>';

					endwhile;

					echo '</ul></div>';

				}

				wp_reset_postdata();

				?><!-- entry-recents -->

			<?php }

		}

	}

	add_action( 'mycoach_story_format_content_after', 'mycoach_story_format_content_after' );

}

/**

 *

 * Event Format Content After

 * @since 1.0.0

 * @version 1.0.0

 *

 */

if ( ! function_exists( 'mycoach_event_format_content_after' ) ) {

	function mycoach_event_format_content_after( $post = null ) {

		$mycoach_options = mycoach_get_theme_options();

		if ( is_single() ) {

			?>

			<?php if ( $mycoach_options['event_recent_posts'] ) { ?>

				<?php

				$single_recents = mycoach_get_option( 'event_single_recents' );

				$single_title   = mycoach_get_option( 'event_single_recents_title' );

				$type           = ( ! empty( $single_recents ) ) ? $single_recents : 'random';

				$title          = ( ! empty( $single_title ) ) ? $single_title : ucfirst( $type ) . ' Posts';

				$operation      = true;

				$args           = array(

					'post_type'           => 'event',

					'ignore_sticky_posts' => 1,

					'posts_per_page'      => $mycoach_options['event_related_posts_number'],

				);

				switch ( $type ) {

					case 'commented':

						$args['orderby'] = 'comment_count';

						break;

					case 'random':

						$args['orderby'] = 'rand';

						break;

					case 'related':

						$tags = wp_get_post_tags( $post->ID );

						$ids  = array();

						if ( ! empty( $tags ) ) {

							foreach ( $tags as $term ) {

								$ids[] = $term->term_id;

							}

						} else {

							$operation = false;

						}

						$args['tag__in']      = $ids;

						$args['post__not_in'] = array( $post->ID );

						$args['orderby']      = 'rand';

						break;

					default:

						$args['orderby'] = 'date';

						break;

				}

				$q = new WP_Query( $args );

				if ( $q->have_posts() && $operation === true ) {

					echo '<div class="related-posts"><h2 class="related-title">' . $title . '</h2><ul>';

					while( $q->have_posts() ) : $q->the_post();

						setup_postdata( $post );

						echo '<li><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_the_title() . '</a> <time datetime="' . esc_attr( get_the_date( 'c' ) ) . '">- ' . esc_html( get_the_date() ) . '</time></li>';

					endwhile;

					echo '</ul></div>';

				}

				wp_reset_postdata();

				?><!-- entry-recents -->

			<?php }

		}

	}

	add_action( 'mycoach_event_format_content_after', 'mycoach_event_format_content_after' );

}

/**

 *

 * Flush Rewrites for Custom Post Types

 * @since 1.0.0

 * @version 1.0.0

 *

 */

if ( ! function_exists( 'mycoach_flush_rewrites' ) ) {

	function mycoach_flush_rewrites() {

		if ( get_option( 'mycoach_rewrite_flush' ) === false ) {

			global $wp_rewrite;

			$wp_rewrite->flush_rules();

			update_option( 'mycoach_rewrite_flush', true );

		}

	}

	add_action( 'wp_loaded', 'mycoach_flush_rewrites' );

}

/**

 *

 * Flush Rewrites for Portfolio Slug

 * @since 1.0.0

 * @version 1.0.0

 *

 */

if ( ! function_exists( 'mycoach_flush_redux_save' ) ) {

	function mycoach_flush_redux_save( $options, $changed ) {

		$needs_rewrite = array(

			'portfolio-item-slug',

			'portfolio-category-slug',

			'portfolio-tag-slug',

			'story-item-slug',

			'story-category-slug',

			'story-tag-slug',

			'event-item-slug',

			'event-category-slug',

			'event-tag-slug',

		);

		//check to see if any changed option needs flushing the permalinks

		$flag = false;

		foreach ( $needs_rewrite as $option ) {

			if ( in_array( $option, array_keys( $changed ) ) ) {

				$flag = true;

			}

		}

		if ( $flag ) {

			delete_option( 'mycoach_rewrite_flush' );

		}

	}

	add_action( 'redux/options/' . MYCOACH_OPTION_NAME . '/saved', 'mycoach_flush_redux_save', 10, 2 );

}

/**

 *

 * Switch Theme Flush Rewrite

 * @since 2.1.0

 * @version 1.0.0

 *

 */

if ( ! function_exists( 'mycoach_switch_theme' ) ) {

	function mycoach_switch_theme() {

		delete_option( 'mycoach_rewrite_flush' );

	}

	add_action( 'switch_theme', 'mycoach_switch_theme', 10, 2 );

}

add_action( 'wp_head', 'mycoach_set_post_views' );

if ( ! function_exists( 'mycoach_set_post_views' ) ) {

	function mycoach_set_post_views() {

		global $post;

		if ( 'post' == get_post_type() && is_single() ) {

			$postID = $post->ID;

			if ( ! empty( $postID ) ) {

				$count_key = 'mycoach_post_views_count';

				$count     = get_post_meta( $postID, $count_key, true );

				if ( $count == '' ) {

					$count = 0;

					delete_post_meta( $postID, $count_key );

					add_post_meta( $postID, $count_key, '0' );

				} else {

					$count ++;

					update_post_meta( $postID, $count_key, $count );

				}

			}

		}

	}

}

if ( ! function_exists( 'mycoach_space_before_head' ) ) {

	function mycoach_space_before_head() {

		$mycoach_options = mycoach_get_theme_options();

		echo $mycoach_options['space-before-head'];

	}

	add_action( 'wp_head', 'mycoach_space_before_head' );

};

if ( ! function_exists( 'mycoach_space_before_body' ) ) {

	function mycoach_space_before_body() {

		$mycoach_options = mycoach_get_theme_options();

		echo $mycoach_options['space-before-body'];

	}

	add_action( 'wp_footer', 'mycoach_space_before_body' );

};

// Remove 'Redux Framework' sub menu under Tools

if ( ! function_exists( 'mycoach_remove_redux_menu' ) ) {

function mycoach_remove_redux_menu() {

    remove_submenu_page('tools.php','redux-about');

}

add_action( 'admin_menu', 'mycoach_remove_redux_menu',12 );

};

// Suppress certain WooCommerce admin notices

function mycoach_suppress_woocommerce_nags() {

	if ( class_exists( 'WC_Admin_Notices' ) ) {

		// Remove the "you have outdated template files" nag

		WC_Admin_Notices::remove_notice( 'template_files' );

		

		// Remove the "install pages" nag

		WC_Admin_Notices::remove_notice( 'install' );

	}

}

add_action( 'wp_loaded', 'mycoach_suppress_woocommerce_nags', 99 );

// Hide the "install the WooThemes Updater" nag

remove_action( 'admin_notices', 'woothemes_updater_notice' );

function mycoach_add_custom_style_to_main_style() {

	$mycoach_options = mycoach_get_theme_options();

	$custom_css = '.transparent-theme-form input[type="text"]:focus, .transparent-theme-form input[type="email"]:focus, .transparent-theme-form textarea:focus,.transparent-theme-form select:focus{border-color:' . $mycoach_options["primary-color"];

	wp_add_inline_style( 'pro-main-style', $custom_css );

}

add_action( 'wp_enqueue_scripts', 'mycoach_add_custom_style_to_main_style', 12 );

if ( ! function_exists( 'mycoach_custom_style_sticky_header' ) ) {

	function mycoach_custom_style_sticky_header() {

		$mycoach_options = mycoach_get_theme_options();

		$custom_style = '.open-search:hover { color: '.$mycoach_options['main-menu-list-item-hover'].'; }';

		$custom_style .= '.cart-info .shopping-cart:hover { color: '.$mycoach_options['main-menu-list-item-hover'].'; }';

		if($mycoach_options['sticky-header-full-width'] == true){

			$custom_style .= '#header-sticky.fixed .container { width: 100%;}';

		}

		mycoach_add_inline_style( $custom_style );

	}

}

