<?php
/**
 * Load wordtrap admin
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$dir = dirname( __FILE__ );

// Load functions
require $dir . '/helpers/enqueue.php';
require $dir . '/helpers/toolbar.php';
require $dir . '/helpers/page-layout.php';

// Load classes
require $dir . '/classes/page-layout.php';

