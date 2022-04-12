<?php
/**
 * The global template
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_social_share' ) ) {
  /**
   * Show social shares
   */
  function wordtrap_social_share() {
    if ( ! wordtrap_options( 'social-share' ) ) {
      return;
    }
    wordtrap_get_template_part( 'template-parts/share' );    
  }
}

