<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

require dirname( __FILE__ ) . '/helpers/post.php';
require dirname( __FILE__ ) . '/helpers/file_system.php';
require dirname( __FILE__ ) . '/helpers/template.php';
