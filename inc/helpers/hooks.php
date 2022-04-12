<?php
/**
 * Custom hooks
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_site_info' ) ) {
	/**
	 * Add site info hook to WP hook library.
	 */
	function wordtrap_site_info() {
		do_action( 'wordtrap_site_info' );
	}
}

add_action( 'wordtrap_site_info', 'wordtrap_add_site_info' );

if ( ! function_exists( 'wordtrap_add_site_info' ) ) {
	/**
	 * Add site info content.
	 */
	function wordtrap_add_site_info() {
		$the_theme = wp_get_theme();

		$site_info = sprintf(
			'<a href="%1$s">%2$s</a><span class="sep"> | </span>%3$s(%4$s)',
			esc_url( __( 'https://wordpress.org/', 'wordtrap' ) ),
			sprintf(
				/* translators: WordPress */
				esc_html__( 'Proudly powered by %s', 'wordtrap' ),
				'WordPress'
			),
			sprintf( // WPCS: XSS ok.
				/* translators: 1: Theme name, 2: Theme author */
				esc_html__( 'Theme: %1$s by %2$s.', 'wordtrap' ),
				$the_theme->get( 'Name' ),
				'<a href="' . esc_url( __( 'https://wordtrap.com', 'wordtrap' ) ) . '">wordtrap.com</a>'
			),
			sprintf( // WPCS: XSS ok.
				/* translators: Theme version */
				esc_html__( 'Version: %1$s', 'wordtrap' ),
				$the_theme->get( 'Version' )
			)
		);

		// Check if customizer site info has value.
		if ( get_theme_mod( 'wordtrap_site_info_override' ) ) {
			$site_info = get_theme_mod( 'wordtrap_site_info_override' );
		}

		echo apply_filters( 'wordtrap_site_info_content', $site_info ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
}

if ( ! function_exists( 'wordtrap_pre_get_posts' ) ) {
  /**
   * Fires after the query variable object is created, but before the actual query is run.
   *
   * @param WP_Query $query The WP_Query instance (passed by reference).
   */
  function wordtrap_pre_get_posts( $query ) {
    if ( ! $query->is_main_query() || is_search() ) {
      return;
    }
  
    $post_type = wordtrap_get_archive_post_type();

    if ( ! $post_type ) {
      return;
    }
    
    $posts_counts = wordtrap_options( $post_type . 's-show-count' ) ? wordtrap_options( $post_type . 's-counts' ) : false;
    if ( ! is_array( $posts_counts ) ) {
      $posts_counts = array( get_option( 'posts_per_page' ) );
    }
    $default_count = $posts_counts[ 0 ];
    $posts_per_page = isset( $_GET['posts_per_page'] ) ? sanitize_text_field( wp_unslash( $_GET['posts_per_page'] ) ) : $default_count;
    $query->set( 'posts_per_page', $posts_per_page );
  
    return $query;
  }
}

add_action( 'pre_get_posts',  'wordtrap_pre_get_posts' );

