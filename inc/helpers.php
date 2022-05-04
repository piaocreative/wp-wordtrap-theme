<?php
/**
 * The theme helpers
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$dir = get_template_directory() . '/inc/helpers/';

// Theme setup and custom theme supports
require $dir . 'setup.php';

// Register widget area
require $dir . 'widgets.php';

// Enqueue scripts and styles
require $dir . 'enqueue.php';

// Custom hooks
require $dir . 'hooks.php';

// Customizer additions
require $dir . 'customizer.php';

// File system functions
require $dir . 'file-system.php';

// Template functions and hooks
require $dir . 'template/global.php';
require $dir . 'template/layout.php';
require $dir . 'template/header.php';
require $dir . 'template/post.php';
require $dir . 'template/member.php';
require $dir . 'template/pagination.php';
require $dir . 'template/comments.php';

// Editor functions.
require $dir . 'editor/editor.php';
require $dir . 'editor/block-editor.php';

// Inculde WooCommerce functions if WooCommerce is activated
if ( class_exists( 'WooCommerce' ) ) {
  require $dir . 'woocommerce.php';
}
