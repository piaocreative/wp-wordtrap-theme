<?php
/**
 * Theme options template functions
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_theme_options_header_template' ) ) {
  /**
   * Load header template for theme admin pages
   */
  function wordtrap_theme_options_header_template() {
    return get_template_directory() . '/inc/admin/templates/header.php';
  }
}
add_filter( 'redux/' . WORDTRAP_OPTIONS . '/panel/template/header.tpl.php', 'wordtrap_theme_options_header_template' );

if ( ! function_exists( 'wordtrap_options' ) ) {
  /**
   * Get the field value in the theme options
   */
  function wordtrap_options( $field, $sub_field = false ) {
    global $wordtrap_options;

    if ( ! isset( $wordtrap_options[ $field ] ) ) {
      return false;
    }

    if ( ! $sub_field ) {
      return $wordtrap_options[ $field ];
    }

    if ( ! isset( $wordtrap_options[ $field ][ $sub_field ] ) ) {
      return false;
    }

    return $wordtrap_options[ $field ][ $sub_field ];
  }
}
