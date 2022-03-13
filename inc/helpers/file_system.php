<?php
/**
 * File sytem functions
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_check_file_write_permission' ) ) :
  /**
   * Check file write permission
   * 
   * @param string $file    The file path to check the write permission.
   */
  function wordtrap_check_file_write_permission( $file ) {
    if ( is_writable( dirname( $file ) ) == false ) {
      @chmod( dirname( $file ), 0755 );
    }
    if ( file_exists( $file ) ) {
      if ( is_writable( $file ) == false ) {
        @chmod( $file, 0755 );
      }
      @unlink( $file );
    }
  }
endif;