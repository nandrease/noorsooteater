<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register Customizer controls.
 *
 * @return void
 */
function noorsooteater_customizer_register( $wp_customize ) {
	require get_template_directory() . '/includes/customizer/customizer-action-links.php';

	$wp_customize->add_section(
		'noorsooteater-options',
		[
			'title' => esc_html__( 'Header & Footer', 'noorsooteater' ),
			'capability' => 'edit_theme_options',
		]
	);

	$wp_customize->add_setting(
		'noorsooteater-header-footer',
		[
			'sanitize_callback' => false,
			'transport' => 'refresh',
		]
	);

	$wp_customize->add_control(
		new Noorsooteater\Includes\Customizer\NOORSOOTEATER_Customizer_Action_Links(
			$wp_customize,
			'noorsooteater-header-footer',
			[
				'section' => 'noorsooteater-options',
				'priority' => 20,
			]
		)
	);
}
add_action( 'customize_register', 'noorsooteater_customizer_register' );

/**
 * Enqueue Customizer CSS.
 *
 * @return void
 */
function noorsooteater_customizer_styles() {

	$min_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style(
		'noorsooteater-customizer',
		get_template_directory_uri() . '/customizer' . $min_suffix . '.css',
		[],
		NOORSOOTEATER_VERSION
	);
}
add_action( 'admin_enqueue_scripts', 'noorsooteater_customizer_styles' );
