<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Kelpie
 * @since 0.1.0
 */

?>

<footer id="colophon" class="site-footer">

	<?php if ( has_nav_menu( 'social' ) ) : ?>
		<nav aria-label="<?php esc_attr_e( 'Social links', 'kelpie' ); ?>" class="footer-social-wrapper">
			<ul class="social-menu footer-social reset-list-style social-icons fill-children-current-color">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'social',
						'container'       => '',
						'container_class' => '',
						'items_wrap'      => '%3$s',
						'menu_id'         => '',
						'menu_class'      => '',
						'depth'           => 1,
						'link_before'     => '<span class="screen-reader-text">',
						'link_after'      => '</span>',
						'fallback_cb'     => '',
					)
				);
				?>
			</ul><!-- .footer-social -->
		</nav><!-- .footer-social-wrapper -->
	<?php endif; ?>

	<div class="site-info">
		<p class="footer-copyright">&copy;
			<?php
			echo esc_html(
				date_i18n(
				/* translators: Copyright date format, see https://secure.php.net/date */
					_x( 'Y', 'copyright date format', 'kelpie' )
				)
			);
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
		</p><!-- .footer-copyright -->

		<p class="powered-by-wordpress">
			<?php echo esc_html_e( 'Made with', 'kelpie' ); ?>
			<a href="<?php echo esc_url( __( 'https://wordpress.com/', 'kelpie' ) ); ?>" ><?php echo esc_html_e( 'WordPress', 'kelpie' ); ?></a>
			<?php echo esc_html_e( '&', 'kelpie' ); ?>
			<a href="<?php echo esc_url( __( 'https://github.com/octopusthink/kelpie', 'kelpie' ) ); ?>"><?php echo esc_html_e( 'Kelpie Starter Theme', 'kelpie' ); ?></a>
		</p><!-- .powered-by-wordpress -->
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
