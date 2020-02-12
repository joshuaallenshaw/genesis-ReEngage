<?php
/**
 * Genesis ReEngage appearance settings.
 *
 * @package Genesis ReEngage
 * @author  Joshua Allen Shaw
 * @license GPL-2.0-or-later
 * @link    https://github.com/joshuaallenshaw/genesis-ReEngage
 */

$genesis_reengage_default_colors = [
	'link'   => '#0073e5',
	'accent' => '#0073e5',
];

$genesis_reengage_link_color = get_theme_mod(
	'genesis_reengage_link_color',
	$genesis_reengage_default_colors['link']
);

$genesis_reengage_accent_color = get_theme_mod(
	'genesis_reengage_accent_color',
	$genesis_reengage_default_colors['accent']
);

$genesis_reengage_header_width = get_theme_mod(	'genesis_reengage_header_width', 'Content' );

$genesis_reengage_link_color_contrast   = genesis_reengage_color_contrast( $genesis_reengage_link_color );
$genesis_reengage_link_color_brightness = genesis_reengage_color_brightness( $genesis_reengage_link_color, 35 );

return [
	'fonts-url'            => 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,700&display=swap',
	'content-width'        => 1062,
	'header-width'		   => $genesis_reengage_header_width,
	'button-bg'            => $genesis_reengage_link_color,
	'button-color'         => $genesis_reengage_link_color_contrast,
	'button-outline-hover' => $genesis_reengage_link_color_brightness,
	'link-color'           => $genesis_reengage_link_color,
	'default-colors'       => $genesis_reengage_default_colors,
	'editor-color-palette' => [
		[
			'name'  => __( 'Custom color', 'genesis-reengage' ), // Called “Link Color” in the Customizer options. Renamed because “Link Color” implies it can only be used for links.
			'slug'  => 'theme-primary',
			'color' => $genesis_reengage_link_color,
		],
		[
			'name'  => __( 'Accent color', 'genesis-reengage' ),
			'slug'  => 'theme-secondary',
			'color' => $genesis_reengage_accent_color,
		],
	],
	'editor-font-sizes'    => [
		[
			'name' => __( 'Small', 'genesis-reengage' ),
			'size' => 12,
			'slug' => 'small',
		],
		[
			'name' => __( 'Normal', 'genesis-reengage' ),
			'size' => 18,
			'slug' => 'normal',
		],
		[
			'name' => __( 'Large', 'genesis-reengage' ),
			'size' => 20,
			'slug' => 'large',
		],
		[
			'name' => __( 'Larger', 'genesis-reengage' ),
			'size' => 24,
			'slug' => 'larger',
		],
	],
];
