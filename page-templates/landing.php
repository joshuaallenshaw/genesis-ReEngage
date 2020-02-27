<?php
/**
 * Genesis ReEngage.
 *
 * This file adds the landing page template to the Genesis ReEngage Theme.
 *
 * Template Name: Landing
 *
 * @package Genesis ReEngage
 * @author  Joshua Allen Shaw
 * @license GPL-2.0-or-later
 * @link    https://github.com/joshuaallenshaw/genesis-ReEngage
 */

/**
 * Adds landing page body class.
 *
 * @since 1.0.0
 *
 * @param  array $classes Original body classes.
 * @return array Modified body classes.
 */
function genesis_reengage_landing_body_class( $classes ) {
	$classes[] = 'landing-page';
	return $classes;

}
add_filter( 'body_class', 'genesis_reengage_landing_body_class' );

// Removes Skip Links.
remove_action( 'genesis_before_header', 'genesis_skip_links', 5 );

/**
 * Dequeues Skip Links Script.
 *
 * @since 1.0.0
 */
function genesis_reengage_dequeue_skip_links() {
	wp_dequeue_script( 'skip-links' );

}
add_action( 'wp_enqueue_scripts', 'genesis_reengage_dequeue_skip_links' );

// Removes site header elements.
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

// Removes navigation.
remove_theme_support( 'genesis-menus' );

// Removes site footer elements.
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Runs the Genesis loop.
genesis();
