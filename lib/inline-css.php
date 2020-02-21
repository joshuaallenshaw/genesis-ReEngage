<?php
/**
 * Genesis ReEngage.
 *
 * This file adds the required CSS to the front end to the Genesis ReEngage Theme.
 *
 * @package Genesis ReEngage
 * @author  Joshua Allen Shaw
 * @license GPL-2.0-or-later
 * @link    https://github.com/joshuaallenshaw/genesis-ReEngage
 */

add_action( 'wp_enqueue_scripts', 'genesis_reengage_css');
/**
 * Checks the settings for the link color, and accent color.
 * If any of these value are set the appropriate CSS is output.
 *
 * @since 2.2.3
 */
function genesis_reengage_css() {
	$appearance = genesis_get_config( 'appearance' );

	$color_link   		= get_theme_mod( 'genesis_reengage_link_color', $appearance['default-values']['link'] );
	$color_accent 		= get_theme_mod( 'genesis_reengage_accent_color', $appearance['default-values']['accent'] );
	$header_textcolor 	= $appearance['header-text-color'];
	$background_color 	= $appearance['background-color'];
	$logo         		= wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
	$header_image 		= get_header_image();

	if ( $logo ) {
		$logo_height           = absint( $logo[2] );
		$logo_max_width        = get_theme_mod( 'genesis_reengage_logo_width', 350 );
		$logo_width            = absint( $logo[1] );
		$logo_ratio            = $logo_width / max( $logo_height, 1 );
		$logo_effective_height = min( $logo_width, $logo_max_width ) / max( $logo_ratio, 1 );
		$logo_padding          = max( 0, ( 60 - $logo_effective_height ) / 2 );
	}

	$css = '';
	
	// Header Text Color.
	$css .= ( $header_textcolor ) ? sprintf(
		'.site-title a, .site-title a:hover, .site-title a:focus, .site-description, .nav-primary a {
			color: %s;
		} ',
		$header_textcolor
	) : '';
	
	// Link Color.
	$css .= ( $appearance['default-values']['link'] !== $color_link ) ? sprintf(
		'a, .entry-title a:focus, .entry-title a:hover, .genesis-nav-menu a:focus, .genesis-nav-menu a:hover,
		.genesis-nav-menu .current-menu-item > a, .genesis-nav-menu .sub-menu .current-menu-item > a:focus,
		.genesis-nav-menu .sub-menu .current-menu-item > a:hover, .menu-toggle:focus, .menu-toggle:hover,
		.sub-menu-toggle:focus, .sub-menu-toggle:hover {
			color: %s;
		} ',
		$color_link
	) : '';
	
	// Background Color.
	$css .= ( $background_color ) ? sprintf(
		'body, .site-header .wrap, .footer-widgets, .site-footer {
			background-color: %s;
		} ',
		$background_color
	 ) : '';
	// Accent Color.
	$css .= ( $appearance['default-values']['accent'] !== $color_accent ) ? sprintf(
		'button:focus, button:hover, input[type="button"]:focus, input[type="button"]:hover,
		input[type="reset"]:focus, input[type="reset"]:hover, input[type="submit"]:focus,
		input[type="submit"]:hover, input[type="reset"]:focus, input[type="reset"]:hover, 
		input[type="submit"]:focus, input[type="submit"]:hover,
		.site-container div.wpforms-container-full .wpforms-form input[type="submit"]:focus,
		.site-container div.wpforms-container-full .wpforms-form input[type="submit"]:hover,
		.site-container div.wpforms-container-full .wpforms-form button[type="submit"]:focus,
		.site-container div.wpforms-container-full .wpforms-form button[type="submit"]:hover,
		.button:focus, .button:hover {
			background-color: %1$s;
			color: %2$s;
		}

		@media only screen and (min-width: 760px) {
			.genesis-nav-menu > .menu-highlight > a:hover,
			.genesis-nav-menu > .menu-highlight > a:focus,
			.genesis-nav-menu > .menu-highlight.current-menu-item > a {
				background-color: %1$s;
				color: %2$s;
			}
		} ',
		$color_accent,
		genesis_reengage_color_contrast( $color_accent )
	) : '';

	// Custom Logo.
	$css .= ( has_custom_logo() && ( 200 <= $logo_effective_height ) ) ?
	'.site-header {
		position: static;
	} '
	: '';

	$css .= ( has_custom_logo() && ( 350 !== $logo_max_width ) ) ? sprintf(
		'.wp-custom-logo .site-container .title-area {
			max-width: %spx;
		} ',
		$logo_max_width
	) : '';

	// Place menu below logo and center logo once it gets big.
	$css .= ( has_custom_logo() && ( 600 <= $logo_max_width ) ) ?
	'
		.wp-custom-logo .title-area, .wp-custom-logo .menu-toggle, .wp-custom-logo .nav-primary {
			float: none;
		} .wp-custom-logo .title-area {
			margin: 0 auto;
			text-align: center;
		}

		@media only screen and (min-width: 760px) {
			.wp-custom-logo .nav-primary {
				text-align: center;
			}
			.wp-custom-logo .nav-primary .sub-menu {
				text-align: left;
			}
		} '
	: '';

	$css .= ( has_custom_logo() && $logo_padding && ( 1 < $logo_effective_height ) ) ? sprintf(
		'.wp-custom-logo .title-area {
			padding-top: %spx;
		} ',
		$logo_padding + 5
	) : '';
	
	// Custom Header.
	$css .= (has_custom_header()) ? sprintf( 
		'.header-image {
			background: url(%s) no-repeat; 
			background-position: %s;
		}
		', 
		$header_image, 
		str_replace( '-', ' ', $appearance['header-position'] )
	) : '';
	
	if ( $css ) {
		wp_add_inline_style( genesis_get_theme_handle() . '-main', $css );
	}

}
