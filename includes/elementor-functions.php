<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register Site Settings Controls.
 */

add_action( 'elementor/init', 'noorsooteater_settings_init' );

function noorsooteater_settings_init() {
	if ( ! noorsooteater_header_footer_experiment_active() ) {
		return;
	}

	require 'settings/settings-header.php';
	require 'settings/settings-footer.php';

	add_action( 'elementor/kit/register_tabs', function( \Elementor\Core\Kits\Documents\Kit $kit ) {
		if ( ! noorsooteater_display_header_footer() ) {
			return;
		}

		$kit->register_tab( 'noorsooteater-settings-header', Noorsooteater\Includes\Settings\Settings_Header::class );
		$kit->register_tab( 'noorsooteater-settings-footer', Noorsooteater\Includes\Settings\Settings_Footer::class );
	}, 1, 40 );
}

/**
 * Helper function to return a setting.
 *
 * Saves 2 lines to get kit, then get setting. Also caches the kit and setting.
 *
 * @param  string $setting_id
 * @return string|array same as the Elementor internal function does.
 */
function noorsooteater_get_setting( $setting_id ) {
	global $noorsooteater_settings;

	$return = '';

	if ( ! isset( $noorsooteater_settings['kit_settings'] ) ) {
		$kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit();
		$noorsooteater_settings['kit_settings'] = $kit->get_settings();
	}

	if ( isset( $noorsooteater_settings['kit_settings'][ $setting_id ] ) ) {
		$return = $noorsooteater_settings['kit_settings'][ $setting_id ];
	}

	return apply_filters( 'noorsooteater_' . $setting_id, $return );
}

/**
 * Helper function to show/hide elements
 *
 * This works with switches, if the setting ID that has been passed is toggled on, we'll return show, otherwise we'll return hide
 *
 * @param  string $setting_id
 * @return string|array same as the Elementor internal function does.
 */
function noorsooteater_show_or_hide( $setting_id ) {
	return ( 'yes' === noorsooteater_get_setting( $setting_id ) ? 'show' : 'hide' );
}

/**
 * Helper function to translate the header layout setting into a class name.
 *
 * @return string
 */
function noorsooteater_get_header_layout_class() {
	$layout_classes = [];

	$header_layout = noorsooteater_get_setting( 'noorsooteater_header_layout' );
	if ( 'inverted' === $header_layout ) {
		$layout_classes[] = 'header-inverted';
	} elseif ( 'stacked' === $header_layout ) {
		$layout_classes[] = 'header-stacked';
	}

	$header_width = noorsooteater_get_setting( 'noorsooteater_header_width' );
	if ( 'full-width' === $header_width ) {
		$layout_classes[] = 'header-full-width';
	}

	$header_menu_dropdown = noorsooteater_get_setting( 'noorsooteater_header_menu_dropdown' );
	if ( 'tablet' === $header_menu_dropdown ) {
		$layout_classes[] = 'menu-dropdown-tablet';
	} elseif ( 'mobile' === $header_menu_dropdown ) {
		$layout_classes[] = 'menu-dropdown-mobile';
	} elseif ( 'none' === $header_menu_dropdown ) {
		$layout_classes[] = 'menu-dropdown-none';
	}

	$noorsooteater_header_menu_layout = noorsooteater_get_setting( 'noorsooteater_header_menu_layout' );
	if ( 'dropdown' === $noorsooteater_header_menu_layout ) {
		$layout_classes[] = 'menu-layout-dropdown';
	}

	return implode( ' ', $layout_classes );
}

/**
 * Helper function to translate the footer layout setting into a class name.
 *
 * @return string
 */
function noorsooteater_get_footer_layout_class() {
	$footer_layout = noorsooteater_get_setting( 'noorsooteater_footer_layout' );

	$layout_classes = [];

	if ( 'inverted' === $footer_layout ) {
		$layout_classes[] = 'footer-inverted';
	} elseif ( 'stacked' === $footer_layout ) {
		$layout_classes[] = 'footer-stacked';
	}

	$footer_width = noorsooteater_get_setting( 'noorsooteater_footer_width' );

	if ( 'full-width' === $footer_width ) {
		$layout_classes[] = 'footer-full-width';
	}

	if ( noorsooteater_get_setting( 'noorsooteater_footer_copyright_display' ) && '' !== noorsooteater_get_setting( 'noorsooteater_footer_copyright_text' ) ) {
		$layout_classes[] = 'footer-has-copyright';
	}

	return implode( ' ', $layout_classes );
}

add_action( 'elementor/editor/after_enqueue_scripts', function() {
	if ( ! noorsooteater_header_footer_experiment_active() ) {
		return;
	}

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_script(
		'noorsooteater-theme-editor',
		get_template_directory_uri() . '/assets/js/noorsooteater-editor' . $suffix . '.js',
		[ 'jquery', 'elementor-editor' ],
		NOORSOOTEATER_VERSION,
		true
	);

	wp_enqueue_style(
		'noorsooteater-editor',
		get_template_directory_uri() . '/editor' . $suffix . '.css',
		[],
		NOORSOOTEATER_VERSION
	);
} );

add_action( 'wp_enqueue_scripts', function() {
	if ( ! noorsooteater_display_header_footer() ) {
		return;
	}

	if ( ! noorsooteater_header_footer_experiment_active() ) {
		return;
	}

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_script(
		'noorsooteater-theme-frontend',
		get_template_directory_uri() . '/assets/js/noorsooteater-frontend' . $suffix . '.js',
		[],
		NOORSOOTEATER_VERSION,
		true
	);

	\Elementor\Plugin::$instance->kits_manager->frontend_before_enqueue_styles();
} );


/**
 * Helper function to decide whether to output the header template.
 *
 * @return bool
 */
function noorsooteater_get_header_display() {
	$is_editor = isset( $_GET['elementor-preview'] );

	return (
		$is_editor
		|| noorsooteater_get_setting( 'noorsooteater_header_logo_display' )
		|| noorsooteater_get_setting( 'noorsooteater_header_tagline_display' )
		|| noorsooteater_get_setting( 'noorsooteater_header_menu_display' )
	);
}

/**
 * Helper function to decide whether to output the footer template.
 *
 * @return bool
 */
function noorsooteater_get_footer_display() {
	$is_editor = isset( $_GET['elementor-preview'] );

	return (
		$is_editor
		|| noorsooteater_get_setting( 'noorsooteater_footer_logo_display' )
		|| noorsooteater_get_setting( 'noorsooteater_footer_tagline_display' )
		|| noorsooteater_get_setting( 'noorsooteater_footer_menu_display' )
		|| noorsooteater_get_setting( 'noorsooteater_footer_copyright_display' )
	);
}

/**
 * Add Noorsooteater theme Header & Footer to Experiments.
 */
add_action( 'elementor/experiments/default-features-registered', function( \Elementor\Core\Experiments\Manager $experiments_manager ) {
	$experiments_manager->add_feature( [
		'name' => 'noorsooteater-theme-header-footer',
		'title' => esc_html__( 'Noorsooteater Theme Header & Footer', 'noorsooteater' ),
		'description' => sprintf(
			'%1$s <a href="%2$s" target="_blank">%3$s</a>',
			esc_html__( 'Customize and style the builtin Noorsooteater Theme’s cross-site header & footer from the Elementor "Site Settings" panel.', 'noorsooteater' ),
			'https://go.elementor.com/wp-dash-header-footer',
			esc_html__( 'Learn More', 'noorsooteater' )
		),
		'release_status' => $experiments_manager::RELEASE_STATUS_STABLE,
		'new_site' => [
			'minimum_installation_version' => '3.3.0',
			'default_active' => $experiments_manager::STATE_ACTIVE,
		],
	] );
} );

/**
 * Helper function to check if Header & Footer Experiment is Active/Inactive
 */
function noorsooteater_header_footer_experiment_active() {
	// If Elementor is not active, return false
	if ( ! did_action( 'elementor/loaded' ) ) {
		return false;
	}
	// Backwards compat.
	if ( ! method_exists( \Elementor\Plugin::$instance->experiments, 'is_feature_active' ) ) {
		return false;
	}

	return (bool) ( \Elementor\Plugin::$instance->experiments->is_feature_active( 'noorsooteater-theme-header-footer' ) );
}
