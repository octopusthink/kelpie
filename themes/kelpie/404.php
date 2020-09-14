<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Kelpie
 * @since 0.1.0
 */

get_header(); ?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header kelpie-page-header">
				<span class="kelpie-archive-type">404 Error</span>
				<h1 class="page-title kelpie-page-title"><?php esc_html_e( 'Page not found', 'kelpie' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content kelpie-page-content">
				<p><?php esc_html_e( 'Sorry! We couldn’t find the content you’re looking for. You can search or browse the site below.', 'kelpie' ); ?></p>
			</div>

			<div class="kelpie-404-widgets kelpie-page-content">
				<?php
					get_search_form();
				?>
			</div><!-- .kelpie-404-widgets -->
		</section><!-- .error-404 -->

	</main><!-- #primary -->

<?php
get_footer();
