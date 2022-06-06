<?php
/**
 * Register block types
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$blocks = array( 'button', 'tabs' );

$dir = WORDTRAP_BLOCKS_PATH . 'types/';

foreach ( $blocks as $block ) {
  $file = $dir . $block . '.php';
  if ( file_exists( $file ) ) {
    require $file;
  }
}