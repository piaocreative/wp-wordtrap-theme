<?php
/**
 * Add theme options menu in toolbar
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_theme_options_toolbar_menu' ) ) {
  /**
   * Add theme options menu in toolbar
   */
  function wordtrap_theme_options_toolbar_menu() {
    wordtrap_add_toolbar_node( 
      __( 'Theme Options', 'wordtrap' ), 
      'wordtrap', 
      admin_url( 'admin.php?page=wordtrap_options' ) ,
      'wordtrap-options'
    );
  }
}

if ( current_user_can( 'edit_theme_options' ) ) {
  if ( is_super_admin() && is_admin_bar_showing() ) {
    add_action( 'wp_before_admin_bar_render', 'wordtrap_theme_options_toolbar_menu' );
  }
}
