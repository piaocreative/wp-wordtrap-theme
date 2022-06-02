<?php
/**
 * nimation supports for the blocks
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( function_exists( 'register_block_type' ) ) {
  if ( ! class_exists( 'Class_Wordtrap_Blocks_Animation', false ) ) {
    require_once dirname( __FILE__ ) . '/class-blocks-animation.php';
  }  
}