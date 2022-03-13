<?php
/**
 * Post functions
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_generate_post_formats' ) ) {
  /**
   * Load the post formats
   *
   * @return array   The post formats supported by theme.
   */
  function wordtrap_generate_post_formats() {
    return array(
      'aside',
      'image',
      'video',
      'quote',
      'link',
    );
  }
}
