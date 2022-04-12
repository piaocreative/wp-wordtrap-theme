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

// Include constants used in theme
require get_template_directory() . '/inc/constants.php';

// Include redux framework
if ( !class_exists( 'ReduxFramework' ) ) {
  require get_template_directory() . '/inc/redux-core/framework.php';
}

// Include templates builder
require get_template_directory() . '/inc/templates-builder/templates-builder.php';

// Include admin pages
require get_template_directory() . '/inc/admin/admin.php';

// Include theme options
require get_template_directory() . '/inc/theme-options/options.php';

// Include theme styles compiler
require get_template_directory() . '/inc/compiler/compiler.php';

// Include helpers
require get_template_directory() . '/inc/helpers.php';

// Load custom WordPress nav walker.
require get_template_directory() . '/classes/class-wordtrap-wp-bootstrap-navwalker.php';
