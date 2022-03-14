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
require $dir . '/helpers/general.php';

// Load classes
require $dir . '/classes/page-layout.php';

