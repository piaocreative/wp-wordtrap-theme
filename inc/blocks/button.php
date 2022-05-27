<?php
/**
 * The button block
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists('acf_register_block_type') ) {
  return;
}

acf_register_block_type( array(
  'name' => 'wordtrap-button',
  'title' => __( 'Button', 'wordtrap' ),
  'description' => '',
  'category' => __( 'Wordtrap Blocks', 'wordtrap' ),
  'keywords' => array(
    0 => __( 'Wordtrap', 'wordtrap' ),
    1 => __( 'Button', 'wordtrap' ),
  ),
  'post_types' => array(
  ),
  'mode' => 'preview',
  'align' => '',
  'align_content' => NULL,
  'render_template' => 'template-parts/block/button.php',
  'render_callback' => '',
  'enqueue_style' => '',
  'enqueue_script' => '',
  'enqueue_assets' => '',
  'icon' => '',
  'supports' => array(
    'align' => array( 'left', 'center', 'right' ),
    'mode' => true,
    'multiple' => true,
    'jsx' => false,
    'align_content' => false,
    'anchor' => false,
  ),
) );
