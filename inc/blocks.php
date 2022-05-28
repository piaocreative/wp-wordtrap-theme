<?php
/**
 * The theme blocks
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

define( 'WORDTRAP_BLOCK_URI', get_template_directory_uri() . '/inc/blocks' );
define( 'WORDTRAP_BLOCK_PATH', get_template_directory() . '/inc/blocks' . '/' );

// Include helpers
require WORDTRAP_BLOCK_PATH . 'helpers.php';

// Engueue styles and scripts
require WORDTRAP_BLOCK_PATH . 'enqueue.php';

// Register fields
add_action( 'acf/include_field_types', 'wordtrap_include_acf_fields' );

if ( ! function_exists( 'wordtrap_include_acf_fields' ) ) {
  /**
   * Include extra acf fields
   */
  function wordtrap_include_acf_fields() {
    include_once WORDTRAP_BLOCK_PATH . 'fields/class-wordtrap-acf-field-margin.php';
    include_once WORDTRAP_BLOCK_PATH . 'fields/class-wordtrap-acf-field-padding.php';
  }
}

// Register block types
$blocks = array( 'button' );

$dir = WORDTRAP_BLOCK_PATH . 'types/';

foreach ( $blocks as $block ) {
  $file = $dir . $block . '.php';
  if ( file_exists( $file ) ) {
    require $file;
  }
}