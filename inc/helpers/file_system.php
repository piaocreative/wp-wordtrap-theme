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
  function wordtrap_check_file_write_permission( $filename ) {
    if ( is_writable( dirname( $filename ) ) == false ) {
      @chmod( dirname( $filename ), 0755 );
    }
    if ( file_exists( $filename ) ) {
      if ( is_writable( $filename ) == false ) {
        @chmod( $filename, 0755 );
      }
      @unlink( $filename );
    }
  }
endif;