<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Kelpie
 * @since 0.1.0
 */

 /**
 * Post Meta
 */
/**
 * Get and Output Post Meta.
 * If it's a single post, output the post meta values specified in the Customizer settings.
 *
 * @param int    $post_id The ID of the post for which the post meta should be output.
 * @param string $location Which post meta location to output – single or preview.
 */
function kelpie_the_post_meta( $post_id = null, $location = 'single-top' ) {
	echo kelpie_get_post_meta( $post_id, $location ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in kelpie_get_post_meta().
}

/**
 * Get the post meta.
 *
 * @param int    $post_id The ID of the post.
 * @param string $location The location where the meta is shown.
 */
function kelpie_get_post_meta( $post_id = null, $location = 'single-top' ) {

	// Require post ID.
	if ( ! $post_id ) {
		return;
	}

	/**
	 * Filters post types array
	 *
	 * This filter can be used to hide post meta information of post, page or custom post type registerd by child themes or plugins
	 *
	 * @since 1.0.0
	 *
	 * @param array Array of post types
	 */
	$disallowed_post_types = apply_filters( 'kelpie_disallowed_post_types_for_meta_output', array( 'page' ) );
	// Check whether the post type is allowed to output post meta.
	if ( in_array( get_post_type( $post_id ), $disallowed_post_types, true ) ) {
		return;
	}

	$post_meta_wrapper_classes = '';
	$post_meta_classes         = '';

	// Get the post meta settings for the location specified.
	if ( 'single-top' === $location ) {
		/**
		* Filters post meta info visibility
		*
		* Use this filter to hide post meta information like Author, Post date, Comments, Is sticky status
		*
		* @since 1.0.0
		*
		* @param array $args {
		*  @type string 'author'
		*  @type string 'post-date'
		*  @type string 'comments'
		*  @type string 'sticky'
		* }
		*/
		$post_meta = apply_filters(
			'kelpie_post_meta_location_single_top',
			array(
				'author',
				'post-date',
				'comments',
				'sticky',
			)
		);

		$post_meta_wrapper_classes = ' post-meta-single post-meta-single-top';

	} elseif ( 'single-bottom' === $location ) {

		/**
		* Filters post tags visibility
		*
		* Use this filter to hide post tags
		*
		* @since 1.0.0
		*
		* @param array $args {
		*   @type string 'tags'
		* }
		*/
		$post_meta = apply_filters(
			'kelpie_post_meta_location_single_bottom',
			array(
				'tags',
			)
		);

		$post_meta_wrapper_classes = ' post-meta-single post-meta-single-bottom';

	}

	// If the post meta setting has the value 'empty', it's explicitly empty and the default post meta shouldn't be output.
	if ( $post_meta && ! in_array( 'empty', $post_meta, true ) ) {

		// Make sure we don't output an empty container.
		$has_meta = false;

		global $post;
		$the_post = get_post( $post_id );
		setup_postdata( $the_post );

		ob_start();

		?>

		<div class="kelpie-post-meta-wrapper<?php echo esc_attr( $post_meta_wrapper_classes ); ?>">

			<ul class="kelpie-post-meta<?php echo esc_attr( $post_meta_classes ); ?>">

				<?php

				/**
				 * Fires before post meta html display.
				 *
				 * Allow output of additional post meta info to be added by child themes and plugins.
				 *
				 * @since 1.0.0
				 * @since Twenty Twenty 1.1 Added the `$post_meta` and `$location` parameters.
				 *
				 * @param int    $post_id   Post ID.
				 * @param array  $post_meta An array of post meta information.
				 * @param string $location  The location where the meta is shown.
				 *                          Accepts 'single-top' or 'single-bottom'.
				 */
				do_action( 'kelpie_start_of_post_meta_list', $post_id, $post_meta, $location );

				// Author.
				if ( in_array( 'author', $post_meta, true ) ) {

					$has_meta = true;
					?>
					<li class="post-author meta-wrapper">
						<span class="meta-icon">
							<span class="screen-reader-text"><?php _e( 'Post author', 'kelpie' ); ?></span>
							<?php kelpie_the_theme_svg( 'user' ); ?>
						</span>
						<span class="meta-text">
							<?php
							printf(
								/* translators: %s: Author name */
								__( 'By %s', 'kelpie' ),
								'<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author_meta( 'display_name' ) ) . '</a>'
							);
							?>
						</span>
					</li>
					<?php

				}

				// Post date.
				if ( in_array( 'post-date', $post_meta, true ) ) {

					$has_meta = true;
					?>
					<li class="post-date meta-wrapper">
						<span class="meta-icon">
							<span class="screen-reader-text"><?php _e( 'Post date', 'kelpie' ); ?></span>
							<?php kelpie_the_theme_svg( 'calendar' ); ?>
						</span>
						<span class="meta-text">
							<a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a>
						</span>
					</li>
					<?php

				}

				// Categories.
				if ( in_array( 'categories', $post_meta, true ) && has_category() ) {

					$has_meta = true;
					?>
					<li class="post-categories meta-wrapper">
						<span class="meta-icon">
							<span class="screen-reader-text"><?php _e( 'Categories', 'kelpie' ); ?></span>
							<?php kelpie_the_theme_svg( 'folder' ); ?>
						</span>
						<span class="meta-text">
							<?php _ex( 'In', 'A string that is output before one or more categories', 'kelpie' ); ?> <?php the_category( ', ' ); ?>
						</span>
					</li>
					<?php

				}

				// Tags.
				if ( in_array( 'tags', $post_meta, true ) && has_tag() ) {

					$has_meta = true;
					?>
					<li class="post-tags meta-wrapper">
						<span class="meta-icon">
							<span class="screen-reader-text"><?php _e( 'Tags', 'kelpie' ); ?></span>
							<?php kelpie_the_theme_svg( 'tag' ); ?>
						</span>
						<span class="meta-text">
							<?php the_tags( '', ', ', '' ); ?>
						</span>
					</li>
					<?php

				}

				// Comments link.
				if ( in_array( 'comments', $post_meta, true ) && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {

					$has_meta = true;
					?>
					<li class="post-comment-link meta-wrapper">
						<span class="meta-icon">
							<?php kelpie_the_theme_svg( 'comment' ); ?>
						</span>
						<span class="meta-text">
							<?php comments_popup_link(); ?>
						</span>
					</li>
					<?php

				}

				// Sticky.
				if ( in_array( 'sticky', $post_meta, true ) && is_sticky() ) {

					$has_meta = true;
					?>
					<li class="post-sticky meta-wrapper">
						<span class="meta-icon">
							<?php kelpie_the_theme_svg( 'bookmark' ); ?>
						</span>
						<span class="meta-text">
							<?php _e( 'Sticky post', 'kelpie' ); ?>
						</span>
					</li>
					<?php

				}

				/**
				 * Fires after post meta html display.
				 *
				 * Allow output of additional post meta info to be added by child themes and plugins.
				 *
				 * @since 1.0.0
				 * @since Twenty Twenty 1.1 Added the `$post_meta` and `$location` parameters.
				 *
				 * @param int    $post_id   Post ID.
				 * @param array  $post_meta An array of post meta information.
				 * @param string $location  The location where the meta is shown.
				 *                          Accepts 'single-top' or 'single-bottom'.
				 */
				do_action( 'kelpie_end_of_post_meta_list', $post_id, $post_meta, $location );

				?>

			</ul><!-- .post-meta -->

		</div><!-- .post-meta-wrapper -->

		<?php

		wp_reset_postdata();

		$meta_output = ob_get_clean();

		// If there is meta to output, return it.
		if ( $has_meta && $meta_output ) {

			return $meta_output;

		}
		}

		}

if ( ! function_exists( 'kelpie_entry_footer' ) ) :
	/**
	 * Prints HTML with an edit post link.
	 */
	function kelpie_entry_footer() {
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'kelpie' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/**
 * Filters the edit post link to add an icon and use the post meta structure.
 *
 * @param string $link    Anchor tag for the edit link.
 * @param int    $post_id Post ID.
 * @param string $text    Anchor text.
 */
function kelpie_edit_post_link( $link, $post_id, $text ) {
	if ( is_admin() ) {
		return $link;
	}

	$edit_url = get_edit_post_link( $post_id );

	if ( ! $edit_url ) {
		return;
	}

	$text = sprintf(
		wp_kses(
			/* translators: %s: Post title. Only visible to screen readers. */
			__( 'Edit <span class="screen-reader-text">%s</span>', 'kelpie' ),
			array(
				'span' => array(
					'class' => array(),
				),
			)
		),
		get_the_title( $post_id )
	);

	return '<div class="kelpie-edit-link">
		<span class="meta-icon">' . kelpie_get_theme_svg( 'edit' ) . '</span>
		<span class="meta-text"><a href="' . esc_url( $edit_url ) . '">' . $text . '</a></span>
		</div><!-- .post-meta-wrapper -->';
}

add_filter( 'edit_post_link', 'kelpie_edit_post_link', 10, 3 );

/**
 * Logo & Description
 */
/**
 * Displays the site logo, either text or image.
 *
 * @param array   $args Arguments for displaying the site logo either as an image or text.
 * @param boolean $echo Echo or return the HTML.
 *
 * @return string $html Compiled HTML based on our arguments.
 */
function kelpie_site_logo( $args = array(), $echo = true ) {
	$logo       = get_custom_logo();
	$site_title = get_bloginfo( 'name' );
	$contents   = '';
	$classname  = '';

	$defaults = array(
		'logo'        => '%1$s<span class="screen-reader-text">%2$s</span>',
		'logo_class'  => 'site-logo',
		'title'       => '<a href="%1$s">%2$s</a>',
		'title_class' => 'site-title',
		'home_wrap'   => '<h1 class="%1$s">%2$s</h1>',
		'single_wrap' => '<div class="%1$s faux-heading">%2$s</div>',
		'condition'   => ( is_front_page() || is_home() ) && ! is_page(),
	);

	$args = wp_parse_args( $args, $defaults );

	/**
	 * Filters the arguments for `kelpie_site_logo()`.
	 *
	 * @param array  $args     Parsed arguments.
	 * @param array  $defaults Function's default arguments.
	 */
	$args = apply_filters( 'kelpie_site_logo_args', $args, $defaults );

	if ( has_custom_logo() ) {
		$contents  = sprintf( $args['logo'], $logo, esc_html( $site_title ) );
		$classname = $args['logo_class'];
	} else {
		$contents  = sprintf( $args['title'], esc_url( get_home_url( null, '/' ) ), esc_html( $site_title ) );
		$classname = $args['title_class'];
	}

	$wrap = $args['condition'] ? 'home_wrap' : 'single_wrap';

	$html = sprintf( $args[ $wrap ], $classname, $contents );

	/**
	 * Filters the arguments for `kelpie_site_logo()`.
	 *
	 * @param string $html      Compiled html based on our arguments.
	 * @param array  $args      Parsed arguments.
	 * @param string $classname Class name based on current view, home or single.
	 * @param string $contents  HTML for site title or logo.
	 */
	$html = apply_filters( 'kelpie_site_logo', $html, $args, $classname, $contents );

	if ( ! $echo ) {
		return $html;
	}

	echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}

/**
 * Displays the site description.
 *
 * @param boolean $echo Echo or return the html.
 *
 * @return string $html The HTML to display.
 */
function kelpie_site_description( $echo = true ) {
	$description = get_bloginfo( 'description' );

	if ( ! $description ) {
		return;
	}

	$wrapper = '<div class="site-description">%s</div><!-- .site-description -->';

	$html = sprintf( $wrapper, esc_html( $description ) );

	/**
	 * Filters the html for the site description.
	 *
	 * @since 1.0.0
	 *
	 * @param string $html         The HTML to display.
	 * @param string $description  Site description via `bloginfo()`.
	 * @param string $wrapper      The format used in case you want to reuse it in a `sprintf()`.
	 */
	$html = apply_filters( 'kelpie_site_description', $html, $description, $wrapper );

	if ( ! $echo ) {
		return $html;
	}

	echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Display SVG icons in social links menu.
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function kelpie_nav_menu_social_icons( $item_output, $item, $depth, $args ) {
	// Change SVG icon inside social links menu if there is supported URL.
	if ( 'social' === $args->theme_location ) {
		$svg = kelpie_SVG_Icons::get_social_link_svg( $item->url );
		if ( empty( $svg ) ) {
			$svg = kelpie_get_theme_svg( 'link' );
		}
		$item_output = str_replace( $args->link_after, '</span>' . $svg, $item_output );
	}

	return $item_output;
}

add_filter( 'walker_nav_menu_start_el', 'kelpie_nav_menu_social_icons', 10, 4 );

