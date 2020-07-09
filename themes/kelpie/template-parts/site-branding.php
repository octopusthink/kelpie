<?php
/**
 * Displays the site branding (logo or title, plus a description)
 *
 * @package WordPress
 * @subpackage Kelpie
 * @since 1.0.0
 */

?>

<div class="site-branding">
	<?php
		// Site title or logo.
		kelpie_site_logo();

		// Site description.
		kelpie_site_description();
	?>
</div><!-- .site-branding -->
