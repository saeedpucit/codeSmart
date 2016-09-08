<?php
/**
 *
 * Theme options css
 * @since 1.0.0
 * @version 1.0.0
 */

function modified_css( $options, $css ) {
  
	ob_start();
	$mycoach_options = mycoach_get_theme_options();
if ( $options['logo-background-dimensions']['height'] ) {
echo <<<CSS
	.header-top .logo a {
		line-height : {$options["logo-background-dimensions"]["height"]};
	}
CSS;
};
if ( $options['breadcrumbs-font-atributes-current']['color'] ) {
echo <<<CSS
	.page-header .breadcrumbs span a:hover {
		color:{$options['breadcrumbs-font-atributes-current']['color']};
	}
CSS;
}
if ( $options['top-header-size']['height'] ) {
echo <<<CSS
	#top-bar ul.nav > li > a, #top-bar ul > li > a i, .top-actual-menu span, span.text {
		line-height : {$options['top-header-size']['height']};
	}
CSS;
};
$bg_css = mycoach_redux_bg_css( $options['background-image-footer-area'] );
if ( $options['copyright-bg-color'] == 'transparent' ) {
echo <<<CSS
	footer .copyright-widgets-cont {
		{$bg_css}
	}
CSS;
	} else {
echo <<<CSS
	footer .widgets {
		{$bg_css}
	}
CSS;
}
if ( isset( $options['faq-accent-color'] ) && $options['faq-accent-color'] ) {
echo <<<CSS
	.pro-faq-filter a.active {
		color : {$options['faq-accent-color']};
		border-color:{$options['faq-accent-color']};
	}
	.pro-toggle-title .pro-in, .pro-faq-filter a:hover {
		color:{$options['faq-accent-color']};
	}
CSS;
};
if ( $options['loader-border'] ) {
echo <<<CSS
	.preloader-image .img-cont:before {
		border-top-color:{$options['loader-border']};
	}
CSS;
};
// border color for footer menu
$footer_menu_margin = ( 30 - $options['copyright-font-atributes']['font-size'] ) / 2;
$half_footer_widget_heading_border_height = $options['sidebar-widget-heading-border-height'] / 2;
echo <<<CSS
	.footer-menu ul.menu {
		line-height:{$options['copyright-font-atributes']['font-size']};
		margin:{$footer_menu_margin}px 0;
	}
	.footer-menu ul.menu li {
		border-color : {$options['copyright-font-atributes-a']['regular']};
	}
	.copyright .footer-menu a, .copyright .copyright-text a {
		color:{$options['copyright-font-atributes-a']['regular']}
	}
	.copyright .footer-menu a:hover, .copyright .copyright-text a:hover {
		color:{$options['copyright-font-atributes-a']['hover']}
	}
	.vc_separator h4 {
		font-size:{$options['h4-font-atributes']['font-size']} !important;
	}
	.page-pagination .current {
		border: {$options['pagination-color']};
		background-color: {$options['pagination-color']};
	}
	.ajax-load-more {
		background-color: {$options['pagination-color']};
	}
	.ajax-load-more:hover {
		background-color: {$options['pagination-color']};
	}
	.page-pagination a:hover {
		color: {$options['pagination-color']};
	}
	.one-page-menu #top-menu .container {
		background: {$options['header-bg-color']};
	}
	.style-2 .header-top,
	.style-2 .cart-info,
	.style-2 .logo,
	.style-2 .primary-menu .navbar-nav > li > a,
	.style-3 .header-top,
	.style-3 .cart-info,
	.style-3 .logo,
	.style-3 .primary-menu .navbar-nav > li > a,
	.logo-inline-menu a {
		line-height:{$options['header-size']['height']};
		height:{$options['header-size']['height']};
	}
	.cart-info .hover-helper.active .cart-items-container {
		margin-top:{$options['header-size']['height']};
	}
	#header-sticky .header-top, #header-sticky .cart-info, #header-sticky .logo, #header-sticky .primary-menu .navbar-nav > li > a, #header-sticky .logo-inline-menu a {
		line-height:{$options['sticky-header-size']['height']};
		height:{$options['sticky-header-size']['height']};
	}
	footer .widget-title h4 {
		border-bottom:{$options['footer-widget-heading-border-height']}px solid {$options['footer-widget-heading-border-color']};
	}

	.sidebar .widget-title h4:after {
		background-color:{$options['sidebar-widget-heading-border-color']};
		width:{$options['sidebar-widget-heading-border-width']}px;
		height:{$options['sidebar-widget-heading-border-height']}px;
		margin-bottom:-{$half_footer_widget_heading_border_height}px;
	}

CSS;
	if ( isset( $options['faq-accent-color'] ) && $options['faq-accent-color'] ) {
		echo <<<CSS
	.pro-faq-filter a.active {
		color : {$options['faq-accent-color']};
		border-color:{$options['faq-accent-color']};
	}
	.pro-toggle-title .pro-in, .pro-faq-filter a:hover {
		color:{$options['faq-accent-color']};
	}
CSS;
	};
	/* primary color */
	if ( $options['primary-color'] ) {
		echo <<<CSS
aside.sidebar .widget_nav_menu ul li.current-menu-item > a,
.netbee_widget ul li a:hover,
aside.sidebar .widget_nav_menu ul li a:hover,
.pro-tab .pro-tab-nav ul li.active a,
.pro-tab .pro-tab-nav ul li a:hover,
.woocommerce .quantity .minus:hover,
.woocommerce .quantity .plus:hover,
.woocommerce-page .quantity .minus:hover,
.woocommerce-page .quantity .plus:hover,
.woocommerce-page .woocommerce-ordering i,
.pro-accordion-title .pro-in,
.pro-faq-filter a.active,
.pro-faq-filter a:hover,
.portfolio-item-description .item-title a:hover,
.ajax-close:hover,
.pro-tab .pro-tab-nav ul li a:hover,
.pro-tab .pro-tab-nav ul li.active a,
.pro-icon-default,
.pro-icon-accent.pro-icon-outlined,
.footer-form input,
.footer-form textarea,
.entry-header-top .entry-comments-link a:hover,
.pro-faq-filter a.active,
.pro-toggle-title .pro-in,
.pro-faq-filter a:hover,
.woocommerce ins,
.woocommerce-page ins,
.comment-meta a:hover,
.entry-tags a:hover,
.entry-title a:hover,
.entry-meta a:hover,
.comment-meta a:hover,
.entry-tags a:hover,
.entry-title a:hover,
.entry-meta a:hover,
.entry-header-top a:hover,
.entry-meta-footer.bottom a:hover,
.comment-meta,
.comment-reply-link,
.menu-compact-btn-toggle.menu-open:hover,
.item-product-cart a:hover .product-details,
.total-cart-details .amount,
.accordion-menu li.open a:before,
.comment-meta a:hover,
.entry-tags a:hover,
.entry-title a:hover,
.entry-meta a:hover,
article h3 a:hover,
.entry-header-top a:hover,
.entry-meta-footer a:hover,
.entry-header-top .entry-date a:hover,
.form-col-1 input[type="submit"],
.post-excerpt p a:hover,
.form.mc4wp-form input[type="submit"],
.no-results h2 span,
.comment-meta,
.comment-reply-link,
.woocommerce ins,
.woocommerce-page ins,
#yith-wcwl-popup-message,
.widget_shopping_cart .buttons a.checkout,
.summary.entry-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a,
.summary.entry-summary .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a,
.summary.entry-summary .compare-button a.compare.added,
.product-wrapper .actions .add-to-cart a.button.added,
.product-wrapper .actions .add-to-links .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a,
.product-wrapper .actions .add-to-links .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a,
.product-wrapper .actions .add-to-links .compare-button a.compare.added,
.product-wrapper .actions .add-to-cart a.button.added,
.product-wrapper .actions .add-to-links .compare-button a.compare.added {
	color: {$options['primary-color']};
}
aside.sidebar .widget_nav_menu ul li.current-menu-item > a:after,
.pro-tab .pro-tab-nav ul li.active a:after,
.shopping-badge,
.testimonial-misc,
.ajax-pagination .pro-loader:after,
li.back,
li.back .left,
.pro-cta-bgcolor,
.pro-tab .pro-tab-nav ul li.active a:after,
.pro-pricing-column-accent .pro-pricing-price,
.pro-fancybox-accent.pro-fancybox-bgcolor,
.pro-icon-accent.pro-icon-bgcolor,
.pro-icon-accent.pro-icon-bordered,
.pro-label-primary,
.cart-items-container .btn-checkout a,
.pro-team-member figure .outline,
.widget_price_filter .ui-slider .ui-slider-range,
.product-wrapper .actions .add-to-cart a.button:hover,
.woocommerce .onsale,
.woocommerce-page .onsale,
.product-wrapper .actions .add-to-links .yith-wcwl-add-to-wishlist a:hover,
.product-wrapper .actions .add-to-links .yith-wcwl-add-to-wishlist a.add_to_wishlist:hover,
.product-wrapper .onsale .sale-bg,
.product-wrapper .actions .add-to-links .compare-button a.compare:hover,
.entry-tags-list a:hover,
.widget_tag_cloud a:hover,
a.categ-type,
.widget-title h4:after,
.form-col-1 input[type="submit"]:hover,
.form.mc4wp-form input[type="submit"]:hover,
.testimonial-misc,
.widget_tag_cloud a:hover,
.entry-tags-list a:hover,
.entry-tags-list a:hover,
.vc_col-sm-4 .wpcf7-form input[type="submit"],
.widget_shopping_cart .buttons a.checkout:hover,
.summary.entry-summary .yith-wcwl-add-to-wishlist a:hover,
.summary.entry-summary .yith-wcwl-add-to-wishlist a.add_to_wishlist:hover,
.summary.entry-summary .compare-button a.compare:hover,
.summary.entry-summary .yith-wcwl-add-to-wishlist a:hover,
.summary.entry-summary .yith-wcwl-add-to-wishlist a.add_to_wishlist:hover,
.summary.entry-summary .compare-button a.compare:hover,
.product-wrapper .onsale .sale-bg,
.product-wrapper .actions .add-to-cart a.button:hover,
.product-wrapper .actions .add-to-links .yith-wcwl-add-to-wishlist a:hover,
.product-wrapper .actions .add-to-links .yith-wcwl-add-to-wishlist a.add_to_wishlist:hover,
.product-wrapper .actions .add-to-links .compare-button a.compare:hover,
.product-wrapper .actions .add-to-cart a.button:hover,
.product-wrapper .actions .add-to-links .yith-wcwl-add-to-wishlist a:hover,
.product-wrapper .actions .add-to-links .yith-wcwl-add-to-wishlist a.add_to_wishlist:hover,
.product-wrapper .actions .add-to-links .compare-button a.compare:hover {
	background-color:  {$options['primary-color']};
}
.pro-team-member figure .outline, {
	background: {$options['primary-color']};
}
.testimonialSlider .rsBullet.rsNavSelected span,
.pro-cta-outlined,
.pro-cta-bgcolor,
.pro-faq-filter a.active,
.isotope-filter a:hover,
.isotope-filter a.active,
.ajax-close:hover,
blockquote,
.pro-fancybox-outlined,
.pro-icon-accent.pro-icon-outer,
.pro-icon-accent.pro-icon-outlined,
.search-box .form-holder input:focus,
.footer-form input[type="submit"],
.footer-form input:focus,
.footer-form textarea:focus,
.pro-faq-filter a.active,
.widget_price_filter .ui-slider .ui-slider-handle,
.form-col-1 input[type="submit"],
.form.mc4wp-form input[type="submit"],
.testimonialSlider .rsBullet.rsNavSelected span,
#yith-wcwl-popup-message,
.widget_shopping_cart .buttons a.checkout {
	border-color: {$options['primary-color']};
}
.pro-tabs-widget .tab-holder .tabs li.active a, .cart-items-container {
	border-top-color:{$options['primary-color']};
}
.woocommerce .price_slider_amount .button {
	background: transparent;
}
CSS;
	};
	/* buttons color */
	if ( $options['button-color-pick'] ) {
		echo <<<CSS
	.cart-items-container .btn-view a, .cart-items-container .btn-checkout a {
		color:{$options['button-color-pick']['regular']}
	}
	.cart-items-container .btn-view a:hover {
		color:{$options['button-color-pick']['hover']}
	}
	.cart-items-container .btn-checkout a, .pro-comment-btn, .pro-btn-flat-accent {
		background-color:{$options['button-color-pick']['regular']};
		color:#fff;
	}
	.cart-items-container .btn-checkout a:hover, .pro-comment-btn:hover, .pro-btn-flat-accent:hover {
		background-color:{$options['button-color-pick']['hover']};
		color:#fff;
	}
	.cart-items-container .btn-view a {
		border-color:{$options['button-color-pick']['regular']}
	}
	.cart-items-container .btn-view a:hover {
		border-color:{$options['button-color-pick']['hover']}
	}
	.woocommerce .pro-btn-flat-accent, .woocommerce-page .pro-btn-flat-accent, .woocommerce .button, .woocommerce-page .button, .form-submit #submit, .wpcf7-form input[type="submit"]  {
		background-color:{$options['button-color-pick']['regular']};
	}
	.woocommerce .pro-btn-outlined-accent, .price_slider_amount .button {
		border-color:{$options['button-color-pick']['hover']};
		color:{$options['button-color-pick']['hover']} !important;
	}
	.woocommerce .pro-btn-flat-accent:hover, .woocommerce-page .pro-btn-flat-accent:hover, .woocommerce .button:hover, .woocommerce-page .button:hover, .wpcf7-form input[type="submit"]:hover{
		background-color:{$options['button-color-pick']['hover']};
	}
	.woocommerce .pro-btn-outlined-accent:hover, .woocommerce .button:hover, .woocommerce-page .button:hover, .form-submit #submit:hover {
		background-color:{$options['button-color-pick']['hover']};
		color:white !important;
	}
CSS;
	}
	/* links color */
	if ( $options['link-color-pick'] ) {
		echo <<<CSS

	article h3 a:hover {
		color:{$options['link-color-pick']['hover']};
	}
CSS;
	}
	if ( $options['show-header-shadow'] ) {
		echo <<<CSS
	.site-header, #header-sticky {
		-webkit-box-shadow: rgba(0, 0, 0, 0.117647) 0px 1px 3px;
		box-shadow: rgba(0, 0, 0, 0.117647) 0px 1px 3px;
		-webkit-backface-visibility: hidden;
	}
CSS;
	};
	if ( ! $options['footer-widget-delimiter'] ) {
		echo <<<CSS
	footer .netbee_widget ul li {
		border-bottom:none;
	}
CSS;
	};
	if ( ! $options['sidebar-widget-delimiter'] ) {
		echo <<<CSS
	aside.sidebar .netbee_widget ul li {
		border-bottom:none;
	}
CSS;
	};
	if ( $options['container-width'] && $options['content-width'] ) {
		$padding = ( $options['container-width']['width'] - $options['content-width']['width'] ) / 2;
		echo <<<CSS
	@media (min-width: {$options['container-width']['width']}) {
		.container {
			padding-left:{$padding}px;
			padding-right:{$padding}px;
		}
	}
	@media (max-width: {$options['container-width']['width']}) {
		.container {
			padding-left:15px;
			padding-right:15px;
		}
	}
CSS;
	};
	if ( $mycoach_options['container-width'] ) {
		echo <<<CSS
	@media (min-width: {$options['container-width']['width']}) {
		.container {
			width:{$mycoach_options['container-width']['width']};
		}
		.boxed #page {
			width:{$mycoach_options['container-width']['width']};
		}
	}
	@media (max-width: {$options['container-width']['width']}) {
		.container {
			width:100%;
		}
	}
CSS;
	};
	if ( isset( $options['blog-read-more-color'] ) ) {
echo <<<CSS
			.post-excerpt .entry-more.pro-btn, .entry-summary .entry-more.pro-btn {
				border: 1px solid {$options['blog-read-more-color']['regular']};
				color: {$options['blog-read-more-color']['regular']};
			}
			.post-excerpt .entry-more.pro-btn:hover, .entry-summary .entry-more.pro-btn:hover {
  				background-color: {$options['blog-read-more-color']['hover']};
  				border: 1px solid {$options['blog-read-more-color']['hover']};
  				color: #fff;
			}
CSS;
};

	$output = ob_get_clean();
	$css .= $output;
	return mycoach_css_compress( $css );
}
/**
 *
 * Page CSS
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function page_modified_css() {
// page title stretch
	$mycoach_options = mycoach_get_theme_options();
	$options = $mycoach_options;
	ob_start();
	if ( $options['select-sticky-menu-font-family'] ) {
echo <<<CSS
		#header-sticky .primary-menu .navbar-nav > li > a {
			color: {$mycoach_options['select-sticky-menu-font-family']['color']};
			font-family: {$mycoach_options['select-sticky-menu-font-family']['font-family']};
			font-weight: {$mycoach_options['select-sticky-menu-font-family']['font-weight']};
			text-transform: {$mycoach_options['select-sticky-menu-font-family']['text-transform']};
			font-size: {$mycoach_options['select-sticky-menu-font-family']['font-size']};
			line-height: {$mycoach_options['select-sticky-menu-font-family']['line-height']};
		}
CSS;
	}




	if ( ! $options['background-image-page-title']['media'] ) {
		echo <<<CSS
	.page-header {
		background-image:none;
	}
CSS;
	};
	if ( $options['full-width-header'] ) {
		echo <<<CSS
	#top-menu .container, #top-bar .container{
		width:100%;
	}
CSS;
	};
	if ( $options['add-page-title-shadow'] ) {
		echo <<<CSS
	.page-header .background-image:after {
		content: "";
		position: absolute;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
	background: -moz-linear-gradient(top,  rgba(0,0,0,0) 0%, rgba(0,0,0,0.6) 100%); /* FF3.6-15 */
	background: -webkit-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.6) 100%); /* Chrome10-25,Safari5.1-6 */
	background: linear-gradient(to bottom,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.6) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
	}
CSS;
	};
	if ( $options['footer-background-parallax'] ) {
		echo <<<CSS
	.widgets {
		background-attachment: fixed;
	}
CSS;
	} else {
		echo <<<CSS
	.widgets {
		background-attachment: scroll;
	}
CSS;
	}
// footer stretch
	if ( $options['container-background-stretch'] ) {
		echo <<<CSS
	#content-wrapper > .container {
		background-size:cover;
	}
CSS;
	} else {
		echo <<<CSS
	#content-wrapper > .container {
		background-size:inherit;
	}
CSS;
	}
	if ( ! isset($options['container-background']['background-image']) && isset($options['container-background']['background-color']) ) {
		echo <<<CSS
	#content-wrapper {
		background-image:none;
	}
CSS;
	} else {
		echo <<<CSS
	#content-wrapper > .container {
		background-size:inherit;
	}
CSS;
	}
	if ( $options['show-page-title-color-overlay'] && $options['page-title-color-overlay-opacity'] ) {
		$opacity = $options['page-title-color-overlay-opacity'] / 100;
		echo <<<CSS
	.page-header .overlay {
		opacity:{$opacity};
	}

CSS;
	}
	if ( $options['show-page-title-color-overlay'] && $options['page-title-color-overlay'] ) {
		echo <<<CSS
	.page-header .overlay {
		background:{$options['page-title-color-overlay']};
	}

CSS;
}
if ( $options['content-offset-page'] && $options['transparent-header'] ) {
	if ( $options['slide-template'] != 'no-slider' ) {
echo <<<CSS
		.mobile-menu-cont {
			margin-bottom: {$options['content-offset-page']['height']};
		}
		.pro-slider {
			margin-top: -{$options['content-offset-page']['height']};
	}
CSS;
	}
	if ( $options['slide-template'] == 'no-slider' ) {
echo <<<CSS
		#content-wrapper {
			margin-top:-{$options['content-offset-page']['height']};
		}
CSS;
	}
} elseif ( $options['content-offset'] && $options['transparent-header'] ) {
	if ( $options['slide-template'] != 'no-slider' ) {
echo <<<CSS
		.mobile-menu-cont {
			margin-bottom: {$options['content-offset']['height']};
		}
		.pro-slider {
			margin-top: -{$options['content-offset']['height']};
	}
CSS;
	}
	if ( $options['slide-template'] == 'no-slider' ) {
echo <<<CSS
		#content-wrapper {
			margin-top:-{$options['content-offset']['height']};
		}
CSS;
	}
}
echo <<<CSS
	.page-header .title-wrapper {
		text-align:{$options['page-title-bar-align']};
	}

	.pro-breadcrumb {
		{$options['breadcrumbs-align']}: 15px;
	}
CSS;
	if ( $options['logo-image-height']['height'] && $options['logo-image-height']['height'] != "px" ) {
		echo <<<CSS
	 .header-top .logo , .header-top .logo a, .header-top .logo a img{
		height: {$options['logo-image-height']['height']};
		line-height: {$options['header-size']['height']}px;
	}
	.header-top .logo a img, .header-top .logo a {
		width: auto;
	}
<!-- -->
CSS;
	}
	if ( isset($options['select-menu-font-family-page']['color']) ) {
		echo <<<CSS
	.sb-icon-search, a.shopping-cart {
		color: {$mycoach_options['select-menu-font-family-page']['color']};
	}
CSS;
	} else {
		echo <<<CSS
	#header-sticky {
		background-color: {$mycoach_options['select-menu-font-family']['color']};
	}
CSS;
	}
	if ( isset($options['sticky-header-bg-color-page']['color']) ) {
			echo <<<CSS
	#header-sticky {
		background-color: {$mycoach_options['sticky-header-bg-color-page']['color']};
	}
CSS;
	} elseif ( isset($mycoach_options['sticky-header-bg-color']['rgba']) ) {
		echo <<<CSS
	#header-sticky {
		background-color: {$mycoach_options['sticky-header-bg-color']['rgba']};
	}
CSS;
	}
	$output = ob_get_clean();
	$css = $output;
	return mycoach_css_compress( $css );
}
