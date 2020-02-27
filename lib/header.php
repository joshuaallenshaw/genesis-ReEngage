<?php
/**
 * Genesis ReEngage.
 *
 * This file configures the header for the Genesis ReEngage Theme.
 *
 * @package Genesis ReEngage
 * @author  Joshua Allen Shaw
 * @license GPL-2.0-or-later
 * @link    https://github.com/joshuaallenshaw/genesis-ReEngage
 */

// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

/**
 *  Overrides the genesis custom header defaults.
 *
 * @since 1.0.0
 * @param array $defaults genesis default header settings.
 * @return array $defaults theme defautl header settings.
 */
function genesis_reengage_custom_header_defaults( $defaults ) {
	// TODO Need to better set these.
	return [
		'flex-width'      => true,
		'height'          => 380,
		'header_image'    => '%s/images/header.jpg',
		'header_callback' => 'genesis_reengage_header_style_callback',
	];

}
add_filter( 'genesis_custom_header_defaults', 'genesis_reengage_custom_header_defaults' );

/**
 * Add div to house custom header image.
 */
function genesis_reengage_add_header_div() {
	if ( get_header_image() ) {
		echo '<div class=\'header-image\' id=\'hdr-img\'></div>';
	}
}
add_action( 'genesis_after_header', 'genesis_reengage_add_header_div' );

/**
 * Configure custom header and colors.
 */
function genesis_reengage_header_style_callback() {
	// Does nothing but prevent the Genesis Style from applying.
}
