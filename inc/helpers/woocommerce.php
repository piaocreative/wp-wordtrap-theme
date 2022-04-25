<?php
/**
 * Add WooCommerce support
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$dir = get_template_directory() . '/inc/helpers/woocommerce/';

// Theme setup and custom theme supports
require $dir . 'setup.php';

// Custom hooks
require $dir . 'hooks.php';

// Template functions and hooks
require $dir . 'template/single.php';
require $dir . 'template/archive.php';
require $dir . 'template/page.php';
