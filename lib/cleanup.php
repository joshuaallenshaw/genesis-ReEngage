<?php
/**
 * Genesis ReEngage Theme.
 * 
 * Cleanup wordpress and genesis.
 *
 * @package ReEngage
 * @author  Joshua Allen Shaw
 * @since   1.0.0
 * @license GPL-2.0+
 **/

// Removes header right widget area.
unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Remove site layouts with two sidebars.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );


// Remove Genesis Favicon (use site icon instead).
remove_action( 'wp_head', 'genesis_load_favicon' );


/**
 * Dont Update the Theme
 *
 * If there is a theme in the repo with the same name, this prevents WP from prompting an update.
 *
 * @since  1.0.0
 * @author Bill Erickson
 * @link   http://www.billerickson.net/excluding-theme-from-updates
 * @param  array  $r Existing request arguments.
 * @param  string $url Request URL.
 * @return array Amended request arguments.
 */
function genesis_reengage_dont_update_theme( $r, $url ) {
	if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) ) {
		return $r; // Not a theme update request. Bail immediately.
	}
	$themes = json_decode( $r['body']['themes'] );
	$child  = get_option( 'stylesheet' );
	unset( $themes->themes->$child );
	$r['body']['themes'] = json_encode( $themes );
	return $r;
}
add_filter( 'http_request_args', 'genesis_reengage_dont_update_theme', 5, 2 );

/**
 * Dequeue jQuery Migrate
 *
 * @param array &$scripts Existing scripts
 */
function genesis_reengage_dequeue_jquery_migrate( &$scripts ) {
	if ( ! is_admin() ) {
		$scripts->remove( 'jquery' );
		$scripts->add( 'jquery', false, [ 'jquery-core' ], '1.10.2' );
	}
}
add_filter( 'wp_default_scripts', 'genesis_reengage_dequeue_jquery_migrate' );

/**
 * Archive Title, remove prefix
 *
 * @param string $title Existing archive title.
 * @return string $title truncated title.
 */
function genesis_reengage_archive_title_remove_prefix( $title ) {
	$title_pieces = explode( ': ', $title );
	if ( count( $title_pieces ) > 1 ) {
		unset( $title_pieces[0] );
		$title = join( ': ', $title_pieces );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'genesis_reengage_archive_title_remove_prefix' );

/**
 * Remove old tempates.
 *
 * @param array $page_templates Page Templates.
 * @return array Page Templates.
 */
function genesis_reengage_remove_genesis_templates( $page_templates ) {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}
add_filter( 'theme_page_templates', 'genesis_reengage_remove_genesis_templates' );

/**
 * Remove avatars from comment list
 *
 * @param string $avatar avatar
 * @return string $avatar empty avatar
 */
function genesis_reengage_remove_avatars_from_comments( $avatar ) {
	global $in_comment_loop;
	return $in_comment_loop ? '' : $avatar;
}
// add_filter( 'get_avatar', 'genesis_reengage_remove_avatars_from_comments' );
