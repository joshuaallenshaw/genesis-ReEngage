<?php
/**
 * ReEngage genesis child theme.
 *
 * @package ReEngage
 * @author  Joshua Allen Shaw
 * @license GPL-2.0-or-later
 * @link    https://www.joshuaallenshaw.com/
 */

/**
 * Setup Child theme
 */
function genesis_reengage_setup() {

	// Cleanup tasks.
	include_once get_stylesheet_directory() . '/lib/cleanup.php';

	// Sets up the Theme.
	include_once get_stylesheet_directory() . '/lib/header.php';

	// Adds helper functions.
	include_once get_stylesheet_directory() . '/lib/helper-functions.php';

	// Adds image upload and color select to Customizer.
	include_once get_stylesheet_directory() . '/lib/customize.php';

	// Includes Customizer CSS.
	include_once get_stylesheet_directory() . '/lib/inline-css.php';

	// Adds WooCommerce support.
	include_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';
	include_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';
	include_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

	// Adds image sizes.
	add_image_size( 'sidebar-featured', 75, 75, true );
	add_image_size( 'genesis-singular-images', 702, 526, true );

	// Repositions the secondary navigation menu tp footer.
	remove_action( 'genesis_after_header', 'genesis_do_subnav' );
	add_action( 'genesis_footer', 'genesis_do_subnav', 10 );

	// Registers the responsive menus.
	if ( function_exists( 'genesis_register_responsive_menus' ) ) {
		genesis_register_responsive_menus( genesis_get_config( 'responsive-menus' ) );
	}

}
add_action( 'genesis_setup', 'genesis_reengage_setup', 15 );

/**
 * Set Simple Social Icon defaults.
 *
 * @since 1.0.0
 *
 * @param  array $defaults Social style defaults.
 * @return array Modified social style defaults.
 */
function genesis_reengage_social_default_styles( $defaults ) {
	$args = genesis_get_config( 'simple-social-icons-settings' );

	return wp_parse_args( $args, $defaults );

}
add_filter( 'simple_social_default_styles', 'genesis_reengage_social_default_styles' );

// Remove Edit link.
add_filter( 'genesis_edit_post_link', '__return_false' );

/**
 * Sets localization.
 */
function genesis_reengage_localization_setup() {
	load_child_theme_textdomain( genesis_get_theme_handle(), get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'genesis_reengage_localization_setup' );

/**
 * Adds Gutenberg opt-in features and styling.
 */
function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.

	include_once get_stylesheet_directory() . '/lib/gutenberg.php';
}
add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );

/**
 * Enqueues scripts and styles.
 */
function genesis_reengage_enqueue_scripts_styles() {
	// Move jQuery to footer.
	if ( ! is_admin() ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, genesis_get_theme_version(), true );
		wp_enqueue_script( 'jquery' );
	}

	$appearance = genesis_get_config( 'appearance' );

	wp_enqueue_style( genesis_get_theme_handle() . '-main', get_stylesheet_directory_uri() . '/lib/css/main.css', [], filemtime( get_stylesheet_directory() . '/lib/css/main.css' ) );
	wp_enqueue_style( genesis_get_theme_handle() . '-fonts', $appearance['fonts-url'], [], genesis_get_theme_version() );

	wp_enqueue_style( 'dashicons' );

	if ( genesis_is_amp() ) {
		wp_enqueue_style(
			genesis_get_theme_handle() . '-amp',
			get_stylesheet_directory_uri() . '/lib/css/amp.css',
			[ genesis_get_theme_handle() ],
			genesis_get_theme_version()
		);
	}
}
add_action( 'wp_enqueue_scripts', 'genesis_reengage_enqueue_scripts_styles' );

/**
 * Add desired theme supports. See config file at `config/theme-supports.php`.
 */
function genesis_reengage_theme_support() {
	$theme_supports = genesis_get_config( 'theme-supports' );

	foreach ( $theme_supports as $feature => $args ) {
		add_theme_support( $feature, $args );
	}
}
add_action( 'after_setup_theme', 'genesis_reengage_theme_support', 9 );


/**
 * Add desired post type supports.  See config file at `config/post-type-supports.php`.
 */
function genesis_reengage_post_type_support() {
	$post_type_supports = genesis_get_config( 'post-type-supports' );

	foreach ( $post_type_supports as $post_type => $args ) {
		add_post_type_support( $post_type, $args );
	}

}
add_action( 'after_setup_theme', 'genesis_reengage_post_type_support', 9 );

/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since  2.2.3
 * @param  array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function genesis_reengage_secondary_menu_args( $args ) {
	if ( 'secondary' === $args['theme_location'] ) {
		$args['depth'] = 1;
	}

	return $args;
}
add_filter( 'wp_nav_menu_args', 'genesis_reengage_secondary_menu_args' );

/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since  2.2.3
 * @param  int $size Original icon size.
 * @return int Modified icon size.
 */
function genesis_reengage_author_box_gravatar( $size ) {
	return 90;
}
add_filter( 'genesis_author_box_gravatar_size', 'genesis_reengage_author_box_gravatar' );

/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since  2.2.3
 * @param  array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function genesis_reengage_comments_gravatar( $args ) {
	$args['avatar_size'] = 60;
	return $args;
}
add_filter( 'genesis_comment_list_args', 'genesis_reengage_comments_gravatar' );
