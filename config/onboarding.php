<?php
/**
 * Genesis ReEngage.
 *
 * Onboarding config to load plugins and homepage content on theme activation.
 *
 * @package Genesis ReEngage
 * @author  Joshua Allen Shaw
 * @license GPL-2.0-or-later
 * @link    https://github.com/joshuaallenshaw/genesis-ReEngage
 */

$genesis_reengage_shared_content = genesis_get_config( 'onboarding-shared' );

return [
	'starter_packs' => [
		'default' => [
			'title'       => __( 'Color', 'genesis-reengage' ),
			'description' => __( 'A pack with a homepage designed with color images.', 'genesis-reengage' ),
			'thumbnail'   => get_stylesheet_directory_uri() . '/config/import/images/thumbnails/home-color.jpg',
			'demo_url'    => '',
			'config'      => [
				'dependencies'     => [
					'plugins' => $genesis_reengage_shared_content['plugins'],
				],
				'content'          => array_merge(
					[
						'homepage' => [
							'post_title'     => 'Homepage',
							'post_content'   => include dirname( __FILE__ ) . '/import/content/home-color.php',
							'post_type'      => 'page',
							'post_status'    => 'publish',
							'comment_status' => 'closed',
							'ping_status'    => 'closed',
							'meta_input'     => [
								'_genesis_layout'     => 'full-width-content',
								'_genesis_hide_title' => true,
								'_genesis_hide_breadcrumbs' => true,
								'_genesis_hide_singular_image' => true,
							],
						],
					],
					$genesis_reengage_shared_content['content']
				),
				'navigation_menus' => $genesis_reengage_shared_content['navigation_menus'],
				'widgets'          => $genesis_reengage_shared_content['widgets'],
			],
		],
	],
];
