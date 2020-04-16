<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Kelpie
 * @since 0.1.0
 */

get_header(); ?>

	<main id="primary" class="site-main">

	<?php
	if ( have_posts() ) :

		if ( is_home() && ! is_front_page() ) :
			?>
			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>

			<?php
		endif;

		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'excerpt' );
		endwhile;

				the_posts_navigation(
					array(
						'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Newer posts', 'kelpie' ) . kelpie_get_theme_svg( 'arrow-right' ) . '</span> ',
						'prev_text' => '<span class="meta-nav" aria-hidden="true">' . kelpie_get_theme_svg( 'arrow-left' ) . esc_html__( 'Older posts', 'kelpie' ) . '</span> ',
					)
				);

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

	</main><!-- #primary -->

<?php
get_footer();
