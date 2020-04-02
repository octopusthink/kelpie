<?php

/**
 * Set up a WP-Admin page for managing turning on and off theme features.
 */
function kelpie_add_options_page() {
	add_theme_page(
		'Theme Options',
		'Theme Options',
		'manage_options',
		'kelpie-options',
		'kelpie_options_page'
	);

	// Call register settings function
	add_action( 'admin_init', 'kelpie_options' );
}
add_action( 'admin_menu', 'kelpie_add_options_page' );


/**
 * Register settings for the WP-Admin page.
 */
function kelpie_options() {
	register_setting( 'kelpie-options', 'kelpie-align-wide', array( 'default' => 1 ) );
	register_setting( 'kelpie-options', 'kelpie-wp-block-styles', array( 'default' => 1 ) );
	register_setting( 'kelpie-options', 'kelpie-editor-color-palette', array( 'default' => 1 ) );
	register_setting( 'kelpie-options', 'kelpie-dark-mode' );
	register_setting( 'kelpie-options', 'kelpie-responsive-embeds', array( 'default' => 1 ) );
}


/**
 * Build the WP-Admin settings page.
 */
function kelpie_options_page() { ?>
	<div class="wrap">
	<h1><?php esc_html_e( 'Kelpie Starter Theme Options', 'kelpie' ); ?></h1>
	<form method="post" action="options.php">
		<?php settings_fields( 'kelpie-options' ); ?>
		<?php do_settings_sections( 'kelpie-options' ); ?>

			<table class="form-table">
				<tr valign="top">
					<td>
						<label>
							<input name="kelpie-align-wide" type="checkbox" value="1" <?php checked( '1', get_option( 'kelpie-align-wide' ) ); ?> />
							<?php esc_html_e( 'Enable wide and full alignments.', 'kelpie' ); ?>
							(<a href="https://developer.wordpress.org/block-editor/developers/themes/theme-support/#wide-alignment"><code>align-wide</code></a>)
						</label>
					</td>
				</tr>
				<tr valign="top">
					<td>
						<label>
							<input name="kelpie-editor-color-palette" type="checkbox" value="1" <?php checked( '1', get_option( 'kelpie-editor-color-palette' ) ); ?> />
							<?php esc_html_e( 'Enable a custom theme color palette.', 'kelpie' ); ?>
							(<a href="https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-color-palettes"><code>editor-color-palette</code></a>)
						</label>
					</td>
				</tr>
				<tr valign="top">
					<td>
						<label>
							<input name="kelpie-dark-mode" type="checkbox" value="1" <?php checked( '1', get_option( 'kelpie-dark-mode' ) ); ?> />
							<?php esc_html_e( 'Enable a dark theme style.', 'kelpie' ); ?>
							(<a href="https://developer.wordpress.org/block-editor/developers/themes/theme-support/#dark-backgrounds"><code>dark-editor-style</code></a>)
						</label>
					</td>
				</tr>
				<tr valign="top">
					<td>
						<label>
							<input name="kelpie-wp-block-styles" type="checkbox" value="1" <?php checked( '1', get_option( 'kelpie-wp-block-styles' ) ); ?> />
							<?php esc_html_e( 'Enable core block styles on the front end.', 'kelpie' ); ?>
							(<a href="https://developer.wordpress.org/block-editor/developers/themes/theme-support/#default-block-styles"><code>wp-block-styles</code></a>)
						</label>
					</td>
				</tr>
				<tr valign="top">
					<td>
						<label>
							<input name="kelpie-responsive-embeds" type="checkbox" value="1" <?php checked( '1', get_option( 'kelpie-responsive-embeds' ) ); ?> />
							<?php esc_html_e( 'Enable responsive embedded content.', 'kelpie' ); ?>
							(<a href="https://developer.wordpress.org/block-editor/developers/themes/theme-support/#responsive-embedded-content"><code>responsive-embeds</code></a>)
						</label>
					</td>
				</tr>
			</table>

		<?php submit_button(); ?>
	</form>
	</div>
	<?php
}


/**
 * Enable alignwide and alignfull support if the kelpie-align-wide setting is active.
 */
function kelpie_enable_align_wide() {

	if ( get_option( 'kelpie-align-wide', 1 ) == 1 ) {

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );
	}
}
add_action( 'after_setup_theme', 'kelpie_enable_align_wide' );


/**
 * Enable custom theme colors if the kelpie-editor-color-palette setting is active.
 */
function kelpie_enable_editor_color_palette() {
	if ( get_option( 'kelpie-editor-color-palette', 1 ) == 1 ) {

		// Add support for a custom color scheme.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Strong Blue', 'kelpie' ),
					'slug'  => 'strong-blue',
					'color' => '#0073aa',
				),
				array(
					'name'  => __( 'Lighter Blue', 'kelpie' ),
					'slug'  => 'lighter-blue',
					'color' => '#229fd8',
				),
				array(
					'name'  => __( 'Very Light Gray', 'kelpie' ),
					'slug'  => 'very-light-gray',
					'color' => '#eee',
				),
				array(
					'name'  => __( 'Very Dark Gray', 'kelpie' ),
					'slug'  => 'very-dark-gray',
					'color' => '#444',
				),
			)
		);
	}
}
add_action( 'after_setup_theme', 'kelpie_enable_editor_color_palette' );


/**
 * Enable dark mode if kelpie-dark-mode setting is active.
 */
function kelpie_enable_dark_mode() {
	if ( get_option( 'kelpie-dark-mode' ) == 1 ) {

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		add_editor_style( 'style-editor-dark.css' );

		// Add support for dark styles.
		add_theme_support( 'dark-editor-style' );
	}
}
add_action( 'after_setup_theme', 'kelpie_enable_dark_mode' );


/**
 * Enable dark mode on the front end if kelpie-dark-mode setting is active.
 */
function kelpie_enable_dark_mode_frontend_styles() {
	if ( get_option( 'kelpie-dark-mode' ) == 1 ) {
		wp_enqueue_style( 'kelpiedark-style', get_template_directory_uri() . '/css/dark-mode.css', array(), wp_get_theme()->get( 'Version' ) );
	}
}
add_action( 'wp_enqueue_scripts', 'kelpie_enable_dark_mode_frontend_styles' );

/**
 * Enable core block styles support if the kelpie-wp-block-styles setting is active.
 */
function kelpie_enable_wp_block_styles() {

	if ( get_option( 'kelpie-wp-block-styles', 1 ) == 1 ) {

		// Adding support for core block visual styles.
		add_theme_support( 'wp-block-styles' );
	}
}
add_action( 'after_setup_theme', 'kelpie_enable_wp_block_styles' );


/**
 * Enable responsive embedded content if the kelpie-responsive-embeds setting is active.
 */
function kelpie_enable_responsive_embeds() {

	if ( get_option( 'kelpie-responsive-embeds', 1 ) == 1 ) {

		// Adding support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
}
add_action( 'after_setup_theme', 'kelpie_enable_responsive_embeds' );
