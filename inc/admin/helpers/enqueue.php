<?php
/**
 * Wordtrap admin enqueue styles and scripts
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if ( ! function_exists( 'wordtrap_admin_enqueue_scripts' ) ) {
  /**
   * Load admin styles.
   */
  function wordtrap_admin_enqueue_scripts() {
    if ( current_user_can( 'edit_theme_options' ) ) {
      wp_enqueue_style( 'wordtrap-icon', WORDTRAP_ADMIN_URI . '/assets/css/icon.css', false, WORDTRAP_VERSION );
      
      global $pagenow;
      if ( ( $pagenow == 'themes.php' || $pagenow == 'admin.php' ) 
        && isset( $_GET['page'] ) && 
        ( $_GET['page'] === WORDTRAP_OPTIONS || $_GET['page'] == 'wordtrap' ) ) {
        wp_enqueue_style( 'wordtrap-admin', WORDTRAP_ADMIN_URI . '/assets/css/admin.css', false, WORDTRAP_VERSION );
        wp_enqueue_script( 'wordtrap-admin', WORDTRAP_ADMIN_URI . '/assets/js/admin.js', array( 'jquery' ), WORDTRAP_VERSION, true );
      }      
    }
  }
}
add_action( 'admin_enqueue_scripts', 'wordtrap_admin_enqueue_scripts' );

if ( ! function_exists( 'wordtrap_toolbar_icon_enqueue_scripts' ) ) {
  /**
   * Load admin styles.
   */
  function wordtrap_toolbar_icon_enqueue_scripts() {
    if ( is_admin_bar_showing() ) {
      wp_enqueue_style( 'wordtrap-icon', WORDTRAP_ADMIN_URI . '/assets/css/icon.css', false, WORDTRAP_VERSION );
    }
  }
}
add_action( 'wp_enqueue_scripts', 'wordtrap_toolbar_icon_enqueue_scripts' );
