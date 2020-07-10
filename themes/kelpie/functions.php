<?php
/**
 * kelpie functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Kelpie
 * @since 0.1.0
 */

if ( ! function_exists( 'kelpie_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function kelpie_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on kelpie, use a find and replace
		 * to change 'kelpie' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'kelpie', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'kelpie' ),
				'social'  => esc_html__( 'Social', 'kelpie' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'assets/css/style-editor.css' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'kelpie' ),
					'shortName' => __( 'S', 'kelpie' ),
					'size'      => 15,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'kelpie' ),
					'shortName' => __( 'M', 'kelpie' ),
					'size'      => 18,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'kelpie' ),
					'shortName' => __( 'L', 'kelpie' ),
					'size'      => 21,
					'slug'      => 'large',
				),
			)
		);

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary White', 'kelpie' ),
					'slug'  => 'primary-white',
					'color' => '#fcebf4',
				),
				array(
					'name'  => __( 'Primary Light', 'kelpie' ),
					'slug'  => 'primary-light',
					'color' => '#f19dca',
				),
				array(
					'name'  => __( 'Primary', 'kelpie' ),
					'slug'  => 'primary-default',
					'color' => '#e33592',
				),
				array(
					'name'  => __( 'Primary Dark', 'kelpie' ),
					'slug'  => 'primary-dark',
					'color' => '#b32973',
				),
				array(
					'name'  => __( 'Primary Black', 'kelpie' ),
					'slug'  => 'primary-black',
					'color' => '#6a1844',
				),
				array(
					'name'  => __( 'Secondary White', 'kelpie' ),
					'slug'  => 'secondary-white',
					'color' => '#e2f5f6',
				),
				array(
					'name'  => __( 'Secondary Light', 'kelpie' ),
					'slug'  => 'secondary-light',
					'color' => '#76d0d6',
				),
				array(
					'name'  => __( 'Secondary', 'kelpie' ),
					'slug'  => 'secondary-default',
					'color' => '#00a8b4',
				),
				array(
					'name'  => __( 'Secondary Dark', 'kelpie' ),
					'slug'  => 'secondary-dark',
					'color' => '#00858e',
				),
				array(
					'name'  => __( 'Secondary Black', 'kelpie' ),
					'slug'  => 'secondary-black',
					'color' => '#004f54',
				),
				array(
					'name'  => __( 'Black', 'kelpie' ),
					'slug'  => 'black',
					'color' => '#181b1c',
				),
				array(
					'name'  => __( 'White', 'kelpie' ),
					'slug'  => 'white',
					'color' => '#FFFFFF',
				),
			)
		);

		// Disable custom colours and font sizes to increase consistency.
		add_theme_support( 'disable-custom-font-sizes' );
		add_theme_support( 'disable-custom-colors' );

		// Add support for Global Styles.
		add_theme_support(
			'jetpack-global-styles',
			[
				'enable_theme_default' => true,
			]
		);
	}
endif;
add_action( 'after_setup_theme', 'kelpie_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kelpie_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kelpie_content_width', 640 );
}
add_action( 'after_setup_theme', 'kelpie_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function kelpie_scripts() {

	// Get theme version from the theme's style.css.
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'kelpie-style', get_stylesheet_uri(), array(), $theme_version );

	//wp_enqueue_style( 'kelpie-fonts', '[URL]', array(), '1.0' );

	if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
		wp_enqueue_script( 'webpackdev-livereload', '//localhost:35729/livereload.js', array(), $theme_version, false );
	}

	// Register our editor JS.
	$block_js_path = get_stylesheet_directory_uri() . '/assets/js/editor.js';
	wp_register_script(
		'kelpie-editor',
		$block_js_path,
		array(
			'wp-blocks',
			'wp-compose',
			'wp-data',
			'wp-i18n',
		),
		wp_get_theme()->get( 'Version' ),
		false
	);
	// To use this script, include it as an editor script when registering your
	// block in PHP:
	// register_block_type(
	// 	'your-theme/block-name',
	// 	array(
	// 		'editor_script'   => 'kelpie-editor',
	// 	)
	// );

	// Register our frontend JS.
	$frontend_js_path = get_stylesheet_directory_uri() . '/assets/js/frontend.js';
	wp_enqueue_script(
		'kelpie-frontend',
		$frontend_js_path,
		array( 'wp-element' ),
		wp_get_theme()->get( 'Version' ),
		false
	);

	wp_enqueue_script( 'kelpie-js', get_template_directory_uri() . '/js/index.js', array(), $theme_version, false );
	wp_script_add_data( 'kelpie-js', 'async', true );

	wp_enqueue_script( 'kelpie-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kelpie_scripts' );

/**
 * Enqueue assets for the block editor.
 */
function kelpie_editor_scripts_styles() {
	// Enqueue web fonts
	//wp_enqueue_style( 'kelpie-fonts', '[URL]', array(), '1.0' );
}
add_action( 'enqueue_block_editor_assets', 'kelpie_editor_scripts_styles' );

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function kelpie_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#primary">' . esc_html__( 'Skip to content', 'kelpie' ) . '</a>';
}

add_action( 'wp_body_open', 'kelpie_skip_link', 5 );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * SVG icons.
 */
require get_template_directory() . '/classes/class-kelpie-svg-icons.php';
require get_template_directory() . '/inc/svg-icons.php';

/**
 * Custom page walker, courtesy of Twenty Twenty.
 */
require get_template_directory() . '/classes/class-kelpie-walker-page.php';

/**
 * Custom comment walker, courtesy of Twenty Twenty.
 */
require get_template_directory() . '/classes/class-kelpie-walker-comment.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
