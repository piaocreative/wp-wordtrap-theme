<?php
/**
 * Theme options field's values
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Site layout options
if ( ! function_exists( 'wordtrap_site_layout_options' ) ) {
  function wordtrap_site_layout_options() {
    return array(
			'wide'  => array(
				'title' => esc_html__( 'Wide', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/site-layouts/wide.svg',
			),
			'full'  => array(
				'title' => esc_html__( 'Full', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/site-layouts/full.svg',
			),
			'boxed' => array(
				'title' => esc_html__( 'Boxed', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/site-layouts/boxed.svg',
			)
		);
  }
}

// Site layout values without boxed
if ( ! function_exists( 'wrodtrap_site_layouts_without_boxed' ) ) {
  function wrodtrap_site_layouts_without_boxed() {
    return array(
			'wide',
			'full'
		);
  }
}

// General layout options
if ( ! function_exists( 'wordtrap_layout_options' ) ) {
  function wordtrap_layout_options() {
    return array(
			'wide'  => array(
				'title' => esc_html__( 'Wide', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/layouts/wide.svg',
			),
			'full'  => array(
				'title' => esc_html__( 'Full', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/layouts/full.svg',
			),
			'boxed' => array(
				'title' => esc_html__( 'Boxed', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/layouts/boxed.svg',
			)
		);
  }
}

// Banner layout options
if ( ! function_exists( 'wordtrap_banner_layout_options' ) ) {
  function wordtrap_banner_layout_options() {
    return array(
			'wide'  => array(
				'title' => esc_html__( 'Wide', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/layouts/wide.svg',
			),
			'boxed' => array(
				'title' => esc_html__( 'Boxed', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/layouts/boxed.svg',
			)
		);
  }
}

// Main layout options
if ( ! function_exists( 'wordtrap_main_layout_options' ) ) {
  function wordtrap_main_layout_options() {
    return array(
			'wide'  => array(
				'title' => esc_html__( 'Wide Width', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/wide.svg',
			),
			'wide-left-sidebar'  => array(
				'title' => esc_html__( 'Wide Left Sidebar', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/wide-left-sidebar.svg',
			),
			'wide-right-sidebar' => array(
				'title' => esc_html__( 'Wide Right Sidebar', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/wide-right-sidebar.svg',
			),
			'wide-both-sidebars' => array(
				'title' => esc_html__( 'Wide Both Sidebars', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/wide-both-sidebars.svg',
			),
			'full'  => array(
				'title' => esc_html__( 'Full Width', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/full.svg',
			),
			'left-sidebar'  => array(
				'title' => esc_html__( 'Left Sidebar', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/left-sidebar.svg',
			),
			'right-sidebar' => array(
				'title' => esc_html__( 'Right Sidebar', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/right-sidebar.svg',
			),
			'both-sidebars' => array(
				'title' => esc_html__( 'Both Sidebars', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/both-sidebars.svg',
			),
		);
  }
}

// Main Layout values with sidebar
if ( ! function_exists( 'wordtrap_main_layouts_with_sidebar' ) ) :
	function wordtrap_main_layouts_with_sidebar() {
		return array(
			'wide-left-sidebar',
			'wide-right-sidebar',
			'wide-both-sidebars',
			'left-sidebar',
			'right-sidebar',
			'both-sidebars',
		);
	}
endif;

// Main Layout values with both sidebars
if ( ! function_exists( 'wordtrap_main_layouts_with_both_sidebars' ) ) :
	function wordtrap_main_layouts_with_both_sidebars() {
		return array(
			'wide-both-sidebars',
			'both-sidebars',
		);
	}
endif;

// Content layout options
if ( ! function_exists( 'wordtrap_content_layout_options' ) ) {
  function wordtrap_content_layout_options() {
    return array(
			'wide'  => array(
				'title' => esc_html__( 'Wide', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/layouts/wide.svg',
			),
			'boxed' => array(
				'title' => esc_html__( 'Boxed', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/layouts/boxed.svg',
			)
		);
  }
}

// Font style options
if ( ! function_exists( 'wordtrap_font_style_options' ) ) {
  function wordtrap_font_style_options() {
    return array(
			'normal'  => esc_html__( 'Normal', 'wordtrap' ),
			'italic'  => esc_html__( 'Italic', 'wordtrap' ),
			'oblique'  => esc_html__( 'Oblique', 'wordtrap' ),
		);
  }
}