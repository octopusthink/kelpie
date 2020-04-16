<?php
/**
 * The template for displaying archive pages
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
		?>

		<header class="page-header kelpie-page-header">
			<?php
				the_archive_title( '<h1 class="page-title kelpie-page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header><!-- .page-header -->

		<?php
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
