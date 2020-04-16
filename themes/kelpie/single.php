<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Kelpie
 * @since 0.1.0
 */

get_header(); ?>

	<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', 'single' );

		the_post_navigation(
			array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next', 'kelpie' ) . kelpie_get_theme_svg( 'arrow-right' ) . '</span> ' .
					'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'kelpie' ) . '</span>' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . kelpie_get_theme_svg( 'arrow-left' ) . esc_html__( 'Previous', 'kelpie' ) . '</span> ' .
					'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'kelpie' ) . '</span>' .
					'<span class="post-title">%title</span>',
			)
		);

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>

	</main><!-- #primary -->

<?php
get_footer();
