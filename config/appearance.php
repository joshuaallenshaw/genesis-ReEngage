<?php
/**
 * Genesis ReEngage appearance settings.
 *
 * @package Genesis ReEngage
 * @author  Joshua Allen Shaw
 * @license GPL-2.0-or-later
 * @link    https://github.com/joshuaallenshaw/genesis-ReEngage
 */

$genesis_reengage_default_values = [
	'link'                  => '#0073e5',
	'accent'                => '#0073e5',
	'header-width'          => 'content',
	'header-image-position' => 'center-center',
	'text'                  => '#333',
	'background'            => '#fff',
];

$genesis_reengage_link_color = get_theme_mod(
	'genesis_reengage_link_color',
	$genesis_reengage_default_values['link']
);

$genesis_reengage_accent_color = get_theme_mod(
	'genesis_reengage_accent_color',
	$genesis_reengage_default_values['accent']
);

// Hack.
// get_theme_mod was not returning header_textcolor.
$genesis_reengage_hdrtxtclr         = get_header_textcolor();
$genesis_reengage_header_text_color = ( $genesis_reengage_hdrtxtclr ) ? '#' . $hdrtxtclr : $genesis_reengage_default_values['text'];
/**
* $genesis_reengage_header_text_color = get_theme_mod(
*   'header_textcolor',
*   $genesis_reengage_default_values['text']
*);
 */
$genesis_reengage_background_color = get_theme_mod(
	'genesis_reengage_background_color',
	$genesis_reengage_default_values['background']
);

$genesis_reengage_header_width = get_theme_mod(
	'genesis_reengage_header_width',
	$genesis_reengage_default_values['header-width']
);

$genesis_reengage_header_position = get_theme_mod(
	'genesis_reengage_header_position',
	$genesis_reengage_default_values['header-image-position']
);

$genesis_reengage_link_color_contrast   = genesis_reengage_color_contrast( $genesis_reengage_link_color );
$genesis_reengage_link_color_brightness = genesis_reengage_color_brightness( $genesis_reengage_link_color, 35 );

return [
	'fonts-url'            => 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,700&display=swap',
	'content-width'        => 1062,
	'header-width'         => $genesis_reengage_header_width,
	'header-position'      => $genesis_reengage_header_position,
	'header-text-color'    => $genesis_reengage_header_text_color,
	'button-bg'            => $genesis_reengage_link_color,
	'button-color'         => $genesis_reengage_link_color_contrast,
	'button-outline-hover' => $genesis_reengage_link_color_brightness,
	'link-color'           => $genesis_reengage_link_color,
	'background-color'     => $genesis_reengage_background_color,
	'default-values'       => $genesis_reengage_default_values,
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
