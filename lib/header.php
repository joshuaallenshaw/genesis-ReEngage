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
 * @param $defaults, genesis default header settings.
 * @return $defaults, theme defautl header settings.
 */
function set_genesis_custom_header_defaults( $defaults ) {
	// TODO Need to better set these
	return [
	 'flex-width'            => true,
	 'height'                => 380,
	 'header_image'          => '%s/images/header.jpg',
	 'header_callback'       => 'genesis_reengage_header_style_callback'
	];

}
add_filter( 'genesis_custom_header_defaults','set_genesis_custom_header_defaults');

/**
 * Add div to house custom header image.
*/
function genesis_reengage_add_header_div() {
	if ( get_header_image() ) {
		echo '<div class=\'custom-header\' id=\'hdr-img\'></div>';
	}
}
add_action('genesis_after_header', 'genesis_reengage_add_header_div');
// This works, but the image alignment still needs work... and possibly the post background.


/**
 * Configure custom header
 */
function genesis_reengage_header_style_callback() {

	$header_image = get_header_image();
	if ( empty( $header_image ) ) {
		return;
	}

	$header_selector = '.custom-header';

	printf( '<style type="text/css">%s {background: url(%s) no-repeat; }</style>', $header_selector, $header_image );
}

//TODO Try moving background image with custom header support 'header selector'
//TODO Will need to use cusomter-header instead of genesis-custom-hearer with a custom callback function to make it work.
//TODO Sticky Setting is applied to entire header
