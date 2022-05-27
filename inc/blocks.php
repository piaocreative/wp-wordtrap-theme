<?php
/**
 * The theme blocks
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$blocks = array( 'button' );

$dir = get_template_directory() . '/inc/blocks/';

foreach ( $blocks as $block ) {
  $file = $dir . $block . '.php';
  if ( file_exists( $file ) ) {
    require $file;
  }
}