<?php
/**
 * Member template
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_member_follow_links' ) ) {
  /**
   * Member follow links
   */
  function wordtrap_member_follow_links() {
    wordtrap_get_template_part( 'template-parts/member/follow' );
  }
}

