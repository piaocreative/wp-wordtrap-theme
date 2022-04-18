<?php
/**
 * The global template
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_social_share' ) ) {
  /**
   * Show social shares
   */
  function wordtrap_social_share() {
    if ( ! wordtrap_options( 'social-share' ) ) {
      return;
    }

    wordtrap_get_template_part( 'template-parts/share' );    
  }
}

if ( ! function_exists( 'wordtrap_get_view_mode' ) ) {
  /**
   * Get view mode
   *
   * @return string      grid | list
   */
  function wordtrap_get_view_mode() {
    $post_type = wordtrap_get_archive_post_type();

    if ( ! $post_type ) {
      return '';
    }

    $default_view_mode = wordtrap_options( $post_type . 's-default-view-mode') ? 'grid' : 'list';
    $view_mode = isset( $_GET['view'] ) ? sanitize_text_field( wp_unslash( $_GET['view'] ) ) : $default_view_mode;

    return apply_filters( 'wordtrap_get_view_mode', $view_mode );
  }
}

if ( ! function_exists( 'wordtrap_grid_view_classes' ) ) {
  /**
   * Get grid view classes
   */
  function wordtrap_grid_view_classes() {
    $post_type = wordtrap_get_archive_post_type();

    if ( ! $post_type ) {
      return '';
    }

    if ( $post_type !== 'product' ) {
      $grid_view = wordtrap_options( $post_type . 's-grid-view' );
      if ( ! ( $grid_view === 'grid' || $grid_view === 'masonry' ) ) {
        return '';
      }
    }    

    $classes = array();
    $classes[] = 'row';
    $classes[] = 'row-cols-sm-' . wordtrap_options( $post_type . 's-grid-columns-sm' );
    $classes[] = 'row-cols-md-' . wordtrap_options( $post_type . 's-grid-columns-md' );
    $classes[] = 'row-cols-lg-' . wordtrap_options( $post_type . 's-grid-columns-lg' );
    $classes[] = 'row-cols-xl-' . wordtrap_options( $post_type . 's-grid-columns-xl' );
    $classes[] = 'row-cols-xxl-' . wordtrap_options( $post_type . 's-grid-columns-xxl' );
    
    return apply_filters( 'wordtrap_grid_view_classes', implode( ' ', $classes ) );
  }
}