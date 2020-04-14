<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Kelpie
 * @since 0.1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header kelpie-page-header">

		<div class="kelpie-post-taxonomies">
			<?php if ( has_category() ) : ?>
				<div class="entry-categories">
					<span class="screen-reader-text"><?php _e( 'Categories', 'kelpie' ); ?></span>
					<?php the_category( ' ' ); ?>
				</div><!-- .entry-categories -->
			<?php endif; ?>

			<?php if ( has_tag() ) : ?>
				<span class="screen-reader-text"><?php _e( 'Tags', 'kelpie' ); ?></span>
				<ul class="entry-tags">
					<?php the_tags( '<li class="entry-tag">#', '</li><li class="entry-tag">#', '</li>' ); ?>
				</ul><!-- .entry-tags -->
			<?php endif; ?>
		</div><!-- .kelpie-post-taxonomies -->

		<?php the_title( '<h1 class="entry-title kelpie-page-title">', '</h1>' ); ?>

		<div class="kelpie-post-meta">
			<?php kelpie_the_post_meta( get_the_ID(), 'single-top' ); ?>
		</div>

	</header><!-- .entry-header -->

	<div class="entry-content kelpie-page-content">
		<?php
			the_content(
				sprintf(
					wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'kelpie' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'kelpie' ),
					'after'  => '</div>',
				)
			);
			?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php kelpie_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
