<?php
/**
 * The theme blocks
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

define( 'WORDTRAP_BLOCKS_URI', get_template_directory_uri() . '/inc/blocks' );
define( 'WORDTRAP_BLOCKS_PATH', get_template_directory() . '/inc/blocks' . '/' );

// Include supports
require WORDTRAP_BLOCKS_PATH . 'supports.php';

// Include helpers
require WORDTRAP_BLOCKS_PATH . 'helpers.php';

// Engueue styles and scripts
require WORDTRAP_BLOCKS_PATH . 'enqueue.php';

// Include fields
require WORDTRAP_BLOCKS_PATH . 'fields.php';

// Include types
require WORDTRAP_BLOCKS_PATH . 'types.php';
