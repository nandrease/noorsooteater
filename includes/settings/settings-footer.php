<?php

namespace Noorsooteater\Includes\Settings;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Tab_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Settings_Footer extends Tab_Base {

	public function get_id() {
		return 'noorsooteater-settings-footer';
	}

	public function get_title() {
		return esc_html__( 'Noorsooteater Theme Footer', 'noorsooteater' );
	}

	public function get_icon() {
		return 'eicon-footer';
	}

	public function get_help_url() {
		return '';
	}

	public function get_group() {
		return 'theme-style';
	}

	protected function register_tab_controls() {

		$this->start_controls_section(
			'noorsooteater_footer_section',
			[
				'tab' => 'noorsooteater-settings-footer',
				'label' => esc_html__( 'Footer', 'noorsooteater' ),
			]
		);

		$this->add_control(
			'noorsooteater_footer_logo_display',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => esc_html__( 'Site Logo', 'noorsooteater' ),
				'default' => 'yes',
				'label_on' => esc_html__( 'Show', 'noorsooteater' ),
				'label_off' => esc_html__( 'Hide', 'noorsooteater' ),
				'selector' => '.site-footer .site-branding',
			]
		);

		$this->add_control(
			'noorsooteater_footer_tagline_display',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => esc_html__( 'Tagline', 'noorsooteater' ),
				'default' => 'yes',
				'label_on' => esc_html__( 'Show', 'noorsooteater' ),
				'label_off' => esc_html__( 'Hide', 'noorsooteater' ),
				'selector' => '.site-footer .site-description',
			]
		);

		$this->add_control(
			'noorsooteater_footer_menu_display',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => esc_html__( 'Menu', 'noorsooteater' ),
				'default' => 'yes',
				'label_on' => esc_html__( 'Show', 'noorsooteater' ),
				'label_off' => esc_html__( 'Hide', 'noorsooteater' ),
				'selector' => '.site-footer .site-navigation',
			]
		);

		$this->add_control(
			'noorsooteater_footer_copyright_display',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => esc_html__( 'Copyright', 'noorsooteater' ),
				'default' => 'yes',
				'label_on' => esc_html__( 'Show', 'noorsooteater' ),
				'label_off' => esc_html__( 'Hide', 'noorsooteater' ),
				'selector' => '.site-footer .copyright',
			]
		);

		$this->add_control(
			'noorsooteater_footer_disable_note',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => sprintf(
					/* translators: %s: Link that opens the theme settings page. */
					__( 'Note: Hiding all the elements, only hides them visually. To disable them completely go to <a href="%s">Theme Settings</a> .', 'noorsooteater' ),
					admin_url( 'themes.php?page=noorsooteater-theme-settings' )
				),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'condition' => [
					'noorsooteater_footer_logo_display' => '',
					'noorsooteater_footer_tagline_display' => '',
					'noorsooteater_footer_menu_display' => '',
					'noorsooteater_footer_copyright_display' => '',
				],
			]
		);

		$this->add_control(
			'noorsooteater_footer_layout',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__( 'Layout', 'noorsooteater' ),
				'options' => [
					'default' => esc_html__( 'Default', 'noorsooteater' ),
					'inverted' => esc_html__( 'Inverted', 'noorsooteater' ),
					'stacked' => esc_html__( 'Centered', 'noorsooteater' ),
				],
				'selector' => '.site-footer',
				'default' => 'default',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'noorsooteater_footer_width',
			[
				'type' => Controls_Manager::SELECT,
				'label' => esc_html__( 'Width', 'noorsooteater' ),
				'options' => [
					'boxed' => esc_html__( 'Boxed', 'noorsooteater' ),
					'full-width' => esc_html__( 'Full Width', 'noorsooteater' ),
				],
				'selector' => '.site-footer',
				'default' => 'boxed',
			]
		);

		$this->add_responsive_control(
			'noorsooteater_footer_custom_width',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__( 'Content Width', 'noorsooteater' ),
				'size_units' => [ '%', 'px', 'em', 'rem', 'vw', 'custom' ],
				'range' => [
					'px' => [
						'max' => 2000,
					],
					'em' => [
						'max' => 100,
					],
					'rem' => [
						'max' => 100,
					],
				],
				'condition' => [
					'noorsooteater_footer_width' => 'boxed',
				],
				'selectors' => [
					'.site-footer .footer-inner' => 'width: {{SIZE}}{{UNIT}}; max-width: 100%;',
				],
			]
		);

		$this->add_responsive_control(
			'noorsooteater_footer_gap',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__( 'Gap', 'noorsooteater' ),
				'size_units' => [ '%', 'px', 'em ', 'rem', 'vw', 'custom' ],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'max' => 5,
					],
					'rem' => [
						'max' => 5,
					],
				],
				'selectors' => [
					'.site-footer' => 'padding-inline-end: {{SIZE}}{{UNIT}}; padding-inline-start: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'noorsooteater_footer_layout!' => 'stacked',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'noorsooteater_footer_background',
				'label' => esc_html__( 'Background', 'noorsooteater' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '.site-footer',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'noorsooteater_footer_logo_section',
			[
				'tab' => 'noorsooteater-settings-footer',
				'label' => esc_html__( 'Site Logo', 'noorsooteater' ),
				'condition' => [
					'noorsooteater_footer_logo_display!' => '',
				],
			]
		);

		$this->add_control(
			'noorsooteater_footer_logo_type',
			[
				'label' => esc_html__( 'Type', 'noorsooteater' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'logo',
				'options' => [
					'logo' => esc_html__( 'Logo', 'noorsooteater' ),
					'title' => esc_html__( 'Title', 'noorsooteater' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'noorsooteater_footer_logo_width',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__( 'Logo Width', 'noorsooteater' ),
				'description' => sprintf(
					/* translators: %s: Link that opens Elementor's "Site Identity" panel. */
					__( 'Go to <a href="%s">Site Identity</a> to manage your site\'s logo', 'noorsooteater' ),
					"javascript:\$e.route('panel/global/settings-site-identity')"
				),
				'size_units' => [ '%', 'px', 'em', 'rem', 'vw', 'custom' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'em' => [
						'max' => 100,
					],
					'rem' => [
						'max' => 100,
					],
				],
				'condition' => [
					'noorsooteater_footer_logo_display' => 'yes',
					'noorsooteater_footer_logo_type' => 'logo',
				],
				'selectors' => [
					'.site-footer .site-branding .site-logo img' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'noorsooteater_footer_title_color',
			[
				'label' => esc_html__( 'Text Color', 'noorsooteater' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'noorsooteater_footer_logo_display' => 'yes',
					'noorsooteater_footer_logo_type' => 'title',
				],
				'selectors' => [
					'.site-footer h4.site-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'noorsooteater_footer_title_typography',
				'label' => esc_html__( 'Typography', 'noorsooteater' ),
				'condition' => [
					'noorsooteater_footer_logo_display' => 'yes',
					'noorsooteater_footer_logo_type' => 'title',
				],
				'selector' => '.site-footer h4.site-title',

			]
		);

		$this->add_control(
			'noorsooteater_footer_title_link',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => sprintf(
					/* translators: %s: Link that opens Elementor's "Site Identity" panel. */
					__( 'Go to <a href="%s">Site Identity</a> to manage your site\'s title', 'noorsooteater' ),
					"javascript:\$e.route('panel/global/settings-site-identity')"
				),
				'content_classes' => 'elementor-control-field-description',
				'condition' => [
					'noorsooteater_footer_logo_display' => 'yes',
					'noorsooteater_footer_logo_type' => 'title',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'noorsooteater_footer_tagline',
			[
				'tab' => 'noorsooteater-settings-footer',
				'label' => esc_html__( 'Tagline', 'noorsooteater' ),
				'condition' => [
					'noorsooteater_footer_tagline_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'noorsooteater_footer_tagline_color',
			[
				'label' => esc_html__( 'Text Color', 'noorsooteater' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'noorsooteater_footer_tagline_display' => 'yes',
				],
				'selectors' => [
					'.site-footer .site-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'noorsooteater_footer_tagline_typography',
				'label' => esc_html__( 'Typography', 'noorsooteater' ),
				'condition' => [
					'noorsooteater_footer_tagline_display' => 'yes',
				],
				'selector' => '.site-footer .site-description',
			]
		);

		$this->add_control(
			'noorsooteater_footer_tagline_link',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => sprintf(
					/* translators: %s: Link that opens Elementor's "Site Identity" panel. */
					__( 'Go to <a href="%s">Site Identity</a> to manage your site\'s tagline', 'noorsooteater' ),
					"javascript:\$e.route('panel/global/settings-site-identity')"
				),
				'content_classes' => 'elementor-control-field-description',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'noorsooteater_footer_menu_tab',
			[
				'tab' => 'noorsooteater-settings-footer',
				'label' => esc_html__( 'Menu', 'noorsooteater' ),
				'condition' => [
					'noorsooteater_footer_menu_display' => 'yes',
				],
			]
		);

		$available_menus = wp_get_nav_menus();

		$menus = [ '0' => esc_html__( '— Select a Menu —', 'noorsooteater' ) ];
		foreach ( $available_menus as $available_menu ) {
			$menus[ $available_menu->term_id ] = $available_menu->name;
		}

		if ( 1 === count( $menus ) ) {
			$this->add_control(
				'noorsooteater_footer_menu_notice',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => '<strong>' . esc_html__( 'There are no menus in your site.', 'noorsooteater' ) . '</strong><br>' . sprintf( __( 'Go to <a href="%s" target="_blank">Menus screen</a> to create one.', 'noorsooteater' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' => 'after',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		} else {
			$this->add_control(
				'noorsooteater_footer_menu',
				[
					'label' => esc_html__( 'Menu', 'noorsooteater' ),
					'type' => Controls_Manager::SELECT,
					'options' => $menus,
					'default' => array_keys( $menus )[0],
					'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'noorsooteater' ), admin_url( 'nav-menus.php' ) ),
				]
			);

			$this->add_control(
				'noorsooteater_footer_menu_warning',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => esc_html__( 'Changes will be reflected in the preview only after the page reloads.', 'noorsooteater' ),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);

			$this->add_control(
				'noorsooteater_footer_menu_color',
				[
					'label' => esc_html__( 'Color', 'noorsooteater' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'footer .footer-inner .site-navigation a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'noorsooteater_footer_menu_typography',
					'label' => esc_html__( 'Typography', 'noorsooteater' ),
					'selector' => 'footer .footer-inner .site-navigation a',
				]
			);
		}

		$this->end_controls_section();

		$this->start_controls_section(
			'noorsooteater_footer_copyright_section',
			[
				'tab' => 'noorsooteater-settings-footer',
				'label' => esc_html__( 'Copyright', 'noorsooteater' ),
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'noorsooteater_footer_copyright_display',
							'operator' => '=',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$this->add_control(
			'noorsooteater_footer_copyright_text',
			[
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'All rights reserved', 'noorsooteater' ),
			]
		);

		$this->add_control(
			'noorsooteater_footer_copyright_color',
			[
				'label' => esc_html__( 'Text Color', 'noorsooteater' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'noorsooteater_footer_copyright_display' => 'yes',
				],
				'selectors' => [
					'.site-footer .copyright p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'noorsooteater_footer_copyright_typography',
				'label' => esc_html__( 'Typography', 'noorsooteater' ),
				'condition' => [
					'noorsooteater_footer_copyright_display' => 'yes',
				],
				'selector' => '.site-footer .copyright p',
			]
		);

		$this->end_controls_section();
	}

	public function on_save( $data ) {
		// Save chosen footer menu to the WP settings.
		if ( isset( $data['settings']['noorsooteater_footer_menu'] ) ) {
			$menu_id = $data['settings']['noorsooteater_footer_menu'];
			$locations = get_theme_mod( 'nav_menu_locations' );
			$locations['menu-2'] = (int) $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}

	public function get_additional_tab_content() {
		$content_template = '
			<div class="noorsooteater elementor-nerd-box">
				<img src="%1$s" class="elementor-nerd-box-icon" alt="%2$s">
				<p class="elementor-nerd-box-title">%3$s</p>
				<p class="elementor-nerd-box-message">%4$s</p>
				<a class="elementor-nerd-box-link elementor-button" target="_blank" href="%5$s">%6$s</a>
			</div>';

		if ( ! defined( 'ELEMENTOR_PRO_VERSION' ) ) {
			return sprintf(
				$content_template,
				get_template_directory_uri() . '/assets/images/go-pro.svg',
				esc_attr__( 'Get Elementor Pro', 'noorsooteater' ),
				esc_html__( 'Create a custom footer with multiple options', 'noorsooteater' ),
				esc_html__( 'Upgrade to Elementor Pro and enjoy free design and many more features', 'noorsooteater' ),
				'https://go.elementor.com/noorsooteater-theme-footer/',
				esc_html__( 'Upgrade', 'noorsooteater' )
			);
		} else {
			return sprintf(
				$content_template,
				get_template_directory_uri() . '/assets/images/go-pro.svg',
				esc_attr__( 'Elementor Pro', 'noorsooteater' ),
				esc_html__( 'Create a custom footer with the Theme Builder', 'noorsooteater' ),
				esc_html__( 'With the Theme Builder you can jump directly into each part of your site', 'noorsooteater' ),
				get_admin_url( null, 'admin.php?page=elementor-app#/site-editor/templates/footer' ),
				esc_html__( 'Create Footer', 'noorsooteater' )
			);
		}
	}
}
