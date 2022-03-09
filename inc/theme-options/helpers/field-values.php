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

// Post archives layout options
if ( ! function_exists( 'wordtrap_posts_layout_options' ) ) {
  function wordtrap_posts_layout_options() {
    return array(
			'full'  => array(
				'title' => esc_html__( 'Full', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archives-full.svg',
			),
			'large'  => array(
				'title' => esc_html__( 'Large', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archives-large.svg',
			),
			'large-alt'  => array(
				'title' => esc_html__( 'Large Alt', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archives-large-alt.svg',
			),
			'medium'  => array(
				'title' => esc_html__( 'Medium', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archives-medium.svg',
			),
			'medium-alt'  => array(
				'title' => esc_html__( 'Medium Alt', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archives-medium-alt.svg',
			),
			'grid'  => array(
				'title' => esc_html__( 'Grid', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archives-grid.svg',
			),
			'masonry'  => array(
				'title' => esc_html__( 'Masonry', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archives-masonry.svg',
			),
			'timeline'  => array(
				'title' => esc_html__( 'Timeline', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archives-timeline.svg',
			),
			'woocommerce'  => array(
				'title' => esc_html__( 'Woocommerce', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archives-woocommerce.svg',
			),
			'modern'  => array(
				'title' => esc_html__( 'Modern', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archives-modern.svg',
			),
		);
  }
}

// Post singular layout options
if ( ! function_exists( 'wordtrap_post_layout_options' ) ) {
  function wordtrap_post_layout_options() {
    return array(
			'full'  => array(
				'title' => esc_html__( 'Full', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/singular-full.svg',
			),
			'full-alt'  => array(
				'title' => esc_html__( 'Full Alt', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/singular-full-alt.svg',
			),
			'large'  => array(
				'title' => esc_html__( 'Large', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/singular-large.svg',
			),
			'large-alt'  => array(
				'title' => esc_html__( 'Large Alt', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/singular-large-alt.svg',
			),
			'medium'  => array(
				'title' => esc_html__( 'Medium', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/singular-medium.svg',
			),
			'woocommerce'  => array(
				'title' => esc_html__( 'Woocommerce', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/singular-woocommerce.svg',
			),
			'modern'  => array(
				'title' => esc_html__( 'Modern', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/singular-modern.svg',
			),
		);
  }
}

// Related post view options
if ( ! function_exists( 'wordtrap_post_related_view_options' ) ) {
  function wordtrap_post_related_view_options() {
    return array(
			'1'  => array(
				'title' => esc_html__( 'Read More Link', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/related-1.svg',
			),
			'2'  => array(
				'title' => esc_html__( 'Post Meta', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/related-2.svg',
			),
			'3'  => array(
				'title' => esc_html__( 'Read More Button', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/related-3.svg',
			),
			'4'  => array(
				'title' => esc_html__( 'Side Image', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/related-4.svg',
			),
			'5'  => array(
				'title' => esc_html__( 'Categories', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/related-5.svg',
			),
			'6'  => array(
				'title' => esc_html__( 'Simple', 'wordtrap' ),
				'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/related-6.svg',
			),			
		);
  }
}