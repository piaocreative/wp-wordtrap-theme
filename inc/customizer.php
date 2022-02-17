<?php
/**
 * Wordtrap Theme Customizer
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'wordtrap_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function wordtrap_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'wordtrap_customize_register' );

if ( ! function_exists( 'wordtrap_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function wordtrap_theme_customize_register( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section(
			'wordtrap_theme_layout_options',
			array(
				'title'       => __( 'Theme Layout Settings', 'wordtrap' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Container width and sidebar defaults', 'wordtrap' ),
				'priority'    => apply_filters( 'wordtrap_theme_layout_options_priority', 160 ),
			)
		);

		/**
		 * Select sanitization function
		 *
		 * @param string               $input   Slug to sanitize.
		 * @param WP_Customize_Setting $setting Setting instance.
		 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
		 */
		function wordtrap_theme_slug_sanitize_select( $input, $setting ) {

			// Ensure input is a slug (lowercase alphanumeric characters, dashes and underscores are allowed only).
			$input = sanitize_key( $input );

			// Get the list of possible select options.
			$choices = $setting->manager->get_control( $setting->id )->choices;

			// If the input is a valid key, return it; otherwise, return the default.
			return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

		}

		$wp_customize->add_setting(
			'wordtrap_bootstrap_version',
			array(
				'default'           => 'bootstrap4',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'wordtrap_bootstrap_version',
				array(
					'label'       => __( 'Bootstrap Version', 'wordtrap' ),
					'description' => __( 'Choose between Bootstrap 4 or Bootstrap 5', 'wordtrap' ),
					'section'     => 'wordtrap_theme_layout_options',
					'settings'    => 'wordtrap_bootstrap_version',
					'type'        => 'select',
					'choices'     => array(
						'bootstrap4' => __( 'Bootstrap 4', 'wordtrap' ),
						'bootstrap5' => __( 'Bootstrap 5', 'wordtrap' ),
					),
					'priority'    => apply_filters( 'wordtrap_bootstrap_version_priority', 10 ),
				)
			)
		);

		$wp_customize->add_setting(
			'wordtrap_site_info_override',
			array(
				'default'           => '',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'wp_kses_post',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'wordtrap_site_info_override',
				array(
					'label'       => __( 'Footer Site Info', 'wordtrap' ),
					'description' => __( 'Override Wordtrap\'s site info located at the footer of the page.', 'wordtrap' ),
					'section'     => 'wordtrap_theme_layout_options',
					'settings'    => 'wordtrap_site_info_override',
					'type'        => 'textarea',
					'priority'    => 20,
				)
			)
		);

	}
} // End of if function_exists( 'wordtrap_theme_customize_register' ).
add_action( 'customize_register', 'wordtrap_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'wordtrap_customize_preview_js' ) ) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function wordtrap_customize_preview_js() {
		wp_enqueue_script(
			'wordtrap_customizer',
			get_template_directory_uri() . '/js/customizer.js',
			array( 'customize-preview' ),
			'20130508',
			true
		);
	}
}
add_action( 'customize_preview_init', 'wordtrap_customize_preview_js' );

/**
 * Loads javascript for conditionally showing customizer controls.
 */
if ( ! function_exists( 'wordtrap_customize_controls_js' ) ) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function wordtrap_customize_controls_js() {
		wp_enqueue_script(
			'wordtrap_customizer',
			get_template_directory_uri() . '/js/customizer-controls.js',
			array( 'customize-preview' ),
			'20130508',
			true
		);
	}
}
add_action( 'customize_controls_enqueue_scripts', 'wordtrap_customize_controls_js' );



if ( ! function_exists( 'wordtrap_default_navbar_type' ) ) {
	/**
	 * Overrides the responsive navbar type for Bootstrap 4
	 *
	 * @param string $current_mod
	 * @return string
	 */
	function wordtrap_default_navbar_type( $current_mod ) {

		if ( 'bootstrap5' !== get_theme_mod( 'wordtrap_bootstrap_version' ) ) {
			$current_mod = 'collapse';
		}

		return $current_mod;
	}
}
add_filter( 'theme_mod_wordtrap_navbar_type', 'wordtrap_default_navbar_type', 20 );
