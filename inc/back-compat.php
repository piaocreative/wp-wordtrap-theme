<?php
/**
 * Wordtrap back compat functionality
 *
 * Prevents Wordtrap from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Prevent switching to the theme on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since wordtrap 1.0.0
 */
function wordtrap_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'wordtrap_upgrade_notice' );
}
add_action( 'after_switch_theme', 'wordtrap_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Wordtrap on WordPress versions prior to 4.7.
 *
 * @since wordtrap 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function wordtrap_upgrade_notice() {
	printf(
		'<div class="error"><p>%s</p></div>',
		sprintf(
			/* translators: %s: WordPress version. */
			__( 'Wordtrap requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'wordtrap' ),
			$GLOBALS['wp_version']
		)
	);
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since wordtrap 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function wordtrap_customize() {
	wp_die(
		sprintf(
			/* translators: %s: WordPress version. */
			__( 'Wordtrap requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'wordtrap' ),
			$GLOBALS['wp_version']
		),
		'',
		array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'wordtrap_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since wordtrap 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function wordtrap_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die(
			sprintf(
				/* translators: %s: WordPress version. */
				__( 'Wordtrap requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'wordtrap' ),
				$GLOBALS['wp_version']
			)
		);
	}
}
add_action( 'template_redirect', 'wordtrap_preview' );
