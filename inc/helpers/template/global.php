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
    $classes[] = 'row-cols-sm-' . wordtrap_options( $post_type . 's-grid-columns-sm' );
    $classes[] = 'row-cols-md-' . wordtrap_options( $post_type . 's-grid-columns-md' );
    $classes[] = 'row-cols-lg-' . wordtrap_options( $post_type . 's-grid-columns-lg' );
    $classes[] = 'row-cols-xl-' . wordtrap_options( $post_type . 's-grid-columns-xl' );
    $classes[] = 'row-cols-xxl-' . wordtrap_options( $post_type . 's-grid-columns-xxl' );
    
    return implode( ' ', $classes );
  }
}