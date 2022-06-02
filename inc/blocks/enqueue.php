<?php
/**
 * Enqueue styles and scripts for the blocks
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( is_admin() ) {
  // enqueue styles and scripts
  add_action( 'admin_enqueue_scripts', 'wordtrap_blocks_enqueue_scripts' );
}

if ( ! function_exists( 'wordtrap_blocks_enqueue_scripts' ) ) :
  function wordtrap_blocks_enqueue_scripts() {
    $screen = get_current_screen();

    if ( $screen && $screen->base == 'post' ) {
      wp_enqueue_style( 'wordtrap-admin-edit-block', WORDTRAP_BLOCKS_URI . '/assets/css/edit.css', false, WORDTRAP_VERSION );
      wp_enqueue_script( 'wordtrap-admin-edit-block', WORDTRAP_BLOCKS_URI . '/assets/js/edit.js', array( 'jquery' ), WORDTRAP_VERSION, true );
    }
  }
endif;