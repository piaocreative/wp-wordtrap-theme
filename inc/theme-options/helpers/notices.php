<?php
/**
 * Notices related to theme options
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_theme_options_notices' ) ) {
  /**
   * Show write permission notification for upload folder
   */
  function wordtrap_theme_options_notices() {
    global $pagenow;
    if ( $pagenow == 'themes.php' && isset( $_GET['page'] ) && $_GET['page'] === WORDTRAP_OPTIONS ) {
      $upload_dir = wp_upload_dir();
      if ( ! wp_is_writable( $upload_dir['basedir'] ) ) {
        add_settings_error( 'wordtrap_theme_options', 'wordtrap_theme_options', __( 'Uploads folder is not writable. Please set write permission to your wp-content/uploads folder.', 'wordtrap' ), 'error' );
        settings_errors( 'wordtrap_theme_options' );
      }
    }
  }
}
add_action( 'admin_notices', 'wordtrap_theme_options_notices' );