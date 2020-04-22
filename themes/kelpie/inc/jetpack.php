<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package WordPress
 * @subpackage Kelpie
 * @since 0.1.0
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function kelpie_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support(
		'infinite-scroll',
		array(
			'container' => 'main',
			'render'    => 'kelpie_infinite_scroll_render',
			'footer'    => 'page',
		)
	);

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	add_theme_support(
		'jetpack-content-options',
		array(
			'post-details' => array(
				'stylesheet' => 'kelpie-style',
				'date'       => '.posted-on',
				'categories' => '.cat-links',
				'tags'       => '.tags-links',
				'author'     => '.byline',
				'comment'    => '.comments-link',
			),
		)
	);
}
add_action( 'after_setup_theme', 'kelpie_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function kelpie_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}


/**
 * Remove CSS styles used by Jetpack.
 * This requires a bunch of different calls because Jetpack hates me.
 */
add_filter( 'jetpack_sharing_counts', '__return_false', 99 );
add_filter( 'jetpack_implode_frontend_css', '__return_false', 99 );

function kelpie_remove_sharedaddy_css() {
	remove_action( 'wp_head', 'sharing_add_header', 1 );
}
add_action( 'template_redirect', 'kelpie_remove_sharedaddy_css' );

function kelpie_nix_jetpack_css() {
	wp_deregister_style( 'grunion.css' ); // Grunion contact form
}
add_action( 'wp_print_styles', 'kelpie_nix_jetpack_css' );
