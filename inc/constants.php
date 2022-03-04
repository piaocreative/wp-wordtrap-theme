<?php
/**
 * The theme definitions
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

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