<?php
/**
 * The template for displaying the footer.
 *
 * Contains the body & html closing tags.
 *
 * @package Noorsooteater
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
	if ( noorsooteater_display_header_footer() ) {
		if ( did_action( 'elementor/loaded' ) && noorsooteater_header_footer_experiment_active() ) {
			get_template_part( 'template-parts/dynamic-footer' );
		} else {
			get_template_part( 'template-parts/footer' );
		}
	}
}
?>

<?php wp_footer(); ?>

</body>
</html>
