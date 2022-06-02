<?php
/**
 * Register extra fields
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'acf/include_field_types', 'wordtrap_include_acf_fields' );

if ( ! function_exists( 'wordtrap_include_acf_fields' ) ) {
  /**
   * Include extra acf fields
   */
  function wordtrap_include_acf_fields() {
    include_once WORDTRAP_BLOCKS_PATH . 'fields/class-wordtrap-acf-field-margin.php';
    include_once WORDTRAP_BLOCKS_PATH . 'fields/class-wordtrap-acf-field-padding.php';
  }
}
