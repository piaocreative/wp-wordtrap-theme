<?php
/**
 * The theme definitions
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Get theme details
$theme = wp_get_theme();
if ( is_child_theme() ) {
	$theme = wp_get_theme( $theme->template );
}

// Theme name
define( 'WORDTRAP_NAME', $theme->get( 'Name' ) );

// Theme version
define( 'WORDTRAP_VERSION', $theme->get( 'Version' ) );

// Theme URI
define( 'WORDTRAP_URI', get_template_directory_uri() );

// Theme options definitions
define( 'WORDTRAP_OPTIONS', 'wordtrap_options' );
define( 'WORDTRAP_OPTIONS_URI', get_template_directory_uri() . '/inc/theme-options' );

// Theme admin definitions
define( 'WORDTRAP_ADMIN_URI', get_template_directory_uri() . '/inc/admin' );

// Theme page layout definitions
define( 'WORDTRAP_PAGE_LAYOUT', 'wordtrap_page_layout' );
define( 'WORDTRAP_DISPLAY_CONDITIONS', 'wordtrap_display_conditions' );

// Theme templates builder definitions
define( 'WORDTRAP_TEMPLATES_BUILDER_URI', get_template_directory_uri() . '/inc/templates-builder' );
define( 'WORDTRAP_METABOX_OPTION', 'wordtrap_template' );
define( 'WORDTRAP_CONDITIONS_ALL', 'conditions-all' );
define( 'WORDTRAP_CONDITIONS_SINGULAR', 'conditions-singular' );
define( 'WORDTRAP_CONDITIONS_ARCHIVE', 'conditions-archive' );
define( 'WORDTRAP_SINGULAR_CONDITIONS', 'singular-conditions' );
define( 'WORDTRAP_ARCHIVE_CONDITIONS', 'archive-conditions' );
define( 'WORDTRAP_DISPLAY_POSITIONS', 'display-positions' );