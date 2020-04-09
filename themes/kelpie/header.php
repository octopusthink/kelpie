<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Kelpie
 * @since 0.1.0
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

		<?php
		wp_body_open();
		?>

		<header id="site-header" class="site-header" role="banner">

			<div class="kelpie-menu-bar">

				<div class="site-branding">
					<?php
						// Site title or logo.
						kelpie_site_logo();

						// Site description.
						kelpie_site_description();
					?>
				</div><!-- .header-titles -->

				<button class="kelpie-toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal"  data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
					<span class="kelpie-toggle-inner">
						<span class="kelpie-toggle-icon">
							<?php kelpie_the_theme_svg( 'ellipsis' ); ?>
						</span>
						<span class="kelpie-toggle-text"><?php _e( 'Menu', 'kelpie' ); ?></span>
					</span>
				</button><!-- .nav-toggle -->

				<div class="header-navigation-wrapper">
					<?php if ( has_nav_menu( 'primary' ) ) : ?>
						<nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e( 'Horizontal', 'kelpie' ); ?>" role="navigation">
							<ul class="primary-menu reset-list-style">
								<?php if ( has_nav_menu( 'primary' ) ) :
									wp_nav_menu(
										array(
											'container'  => '',
											'items_wrap' => '%3$s',
											'theme_location' => 'primary',
										)
									);
								endif; ?>
							</ul>
						</nav><!-- .primary-menu-wrapper -->
					<?php endif; ?>
				</div><!-- .header-navigation-wrapper -->
			</div><!-- .kelpie-site-navigation-menu -->
		</header><!-- #masthead -->

		<?php
		// Output the menu modal.
		get_template_part( 'template-parts/modal-menu' );
