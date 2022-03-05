<?php
/**
 * Theme options enqueue scripts
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_theme_options_scripts' ) ) {
	/**
	 * Load theme options's JavaScript and CSS sources.
	 */
  function wordtrap_theme_options_scripts() {
    global $pagenow;
    if ( is_customize_preview() || ( $pagenow == 'themes.php' && isset( $_GET['page'] ) && $_GET['page'] === WORDTRAP_OPTIONS ) ) {
      wp_enqueue_style( 'wordtrap_theme_options', WORDTRAP_OPTIONS_URI . '/assets/css/theme_options.css', false, WORDTRAP_VERSION, 'all' );
    }
  }
}

add_action( 'admin_enqueue_scripts', 'wordtrap_theme_options_scripts', 1000 );