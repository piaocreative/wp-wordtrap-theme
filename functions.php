<?php
/**
 * The theme functions and definitions
 * 
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

// Theem only works in WordPress 4.7 or later.
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

// Inculde WooCommerce functions if WooCommerce is activated
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// Theme setup and custom theme supports.
require get_template_directory() . '/inc/setup.php';

// Register widget area.
require get_template_directory() . '/inc/widgets.php';

// Enqueue scripts and styles.
require get_template_directory() . '/inc/enqueue.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Custom pagination for this theme.
require get_template_directory() . '/inc/pagination.php';

// Custom hooks.
require get_template_directory() . '/inc/hooks.php';

// Custom functions that act independently of the theme templates.
require get_template_directory() . '/inc/extras.php';

// Customizer additions.
require get_template_directory() . '/inc/customizer.php';

// Custom Comments file.
require get_template_directory() . '/inc/custom-comments.php';

// SVG Icons class.
require get_template_directory() . '/classes/class-wordtrap-svg-icons.php';

// Custom Comment Walker template.
require get_template_directory() . '/classes/class-wordtrap-walker-comment.php';

// Load custom WordPress nav walker.
require get_template_directory() . '/classes/class-wordtrap-wp-bootstrap-navwalker.php';

// SVG Icons related functions.
require get_template_directory() . '/inc/icon-functions.php';

// Load Editor functions.
require get_template_directory() . '/inc/editor.php';

// Load Block Editor functions.
require get_template_directory() . '/inc/block-editor.php';

// Load deprecated functions.
require get_template_directory() . '/inc/deprecated.php';