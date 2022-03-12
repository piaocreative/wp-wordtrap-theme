<?php
/**
 * Theme options template functions
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Change header template
if ( ! function_exists( 'wordtrap_theme_options_header_template' ) ) {
  function wordtrap_theme_options_header_template() {
    return get_template_directory() . '/inc/admin/pages/header.php';
  }
}
add_filter( 'redux/' . WORDTRAP_OPTIONS . '/panel/template/header.tpl.php', 'wordtrap_theme_options_header_template' );
