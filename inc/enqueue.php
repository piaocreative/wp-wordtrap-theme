<?php
/**
 * Theme enqueue scripts
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_enqueue_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function wordtrap_enqueue_scripts() {
		// Get the theme data.
		$the_theme         = wp_get_theme();
		$theme_version     = $the_theme->get( 'Version' );
		$suffix            = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		// Grab asset urls.
		$upload_dir    = wp_upload_dir();
		$theme_styles  = "/wordtrap_styles/theme{$suffix}.css";
		$theme_scripts = "/js/theme{$suffix}.js";
		
		$css_version = $theme_version . '.' . filemtime( $upload_dir['basedir'] . $theme_styles );
		wp_enqueue_style( 'wordtrap-styles', $upload_dir['baseurl'] . $theme_styles, array(), $css_version );

		wp_enqueue_script( 'jquery' );

		$js_version = $theme_version . '.' . filemtime( get_template_directory() . $theme_scripts );
		wp_enqueue_script( 'wordtrap-scripts', get_template_directory_uri() . $theme_scripts, array(), $js_version, true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}

add_action( 'wp_enqueue_scripts', 'wordtrap_enqueue_scripts' );
