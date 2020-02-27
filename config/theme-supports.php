<?php
/**
 * Theme supports.
 *
 * @package ReEngage
 * @author  Joshua Allen Shaw
 * @license GPL-2.0-or-later
 * @link    https://www.joshuaallenshaw.com/
 */

return [

	/*
	'genesis-custom-logo'             => [
		'height'      => 120,
		'width'       => 700,
		'flex-height' => true,
		'flex-width'  => true,
	],
	*/
	'html5'                           => [
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form',
		'script',
		'style',
	],
	'genesis-responsive-viewport'     => '',
	'genesis-structural-wraps'        => [
		'header',
		'menu-primary',
		'menu-secondary',
		'site-inner',
		'site-tagline',
		'footer-widgets',
		'footer',
	],

	'genesis-custom-header'           => '',
	'genesis-custom-background'       => [
		'default-color' => '#FFFFFF',

	],
	'genesis-accessibility'           => [
		'drop-down-menu',
		'headings',
		'search-form',
		'skip-links',
	],
	'genesis-lazy-load-images'        => '',
	'genesis-after-entry-widget-area' => '',
	'genesis-footer-widgets'          => 3,
	'genesis-menus'                   => [
		'primary'   => __( 'Header Menu', 'genesis-reengage' ),
		'secondary' => __( 'Footer Menu', 'genesis-reengage' ),
	],
];
