<?php
/**
 * Wordtrap admin page layout functions
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if ( ! function_exists( 'wordtrap_page_layout_save_conditions' ) ) {
  /**
   * Save page layout display conditions
   */
  function wordtrap_page_layout_save_conditions() {
    $layout_option = get_option( WORDTRAP_PAGE_LAYOUT, array() );
    $blocks = array_keys( $layout_option );
    $display_conditions = array();
    foreach ( $blocks as $block ) {
      $templates = $layout_option[ $block ];
      $display_conditions[ $block ] = array();
      
      if ( $block == 'left-sidebar' || $block == 'right-sidebar' ) {
        $display_conditions[ $block ][ 'top' ] = array();
        $display_conditions[ $block ][ 'bottom' ] = array();
      } else if ( $block == 'main' ) {
        $display_conditions[ $block ][ 'main-top' ] = array();
        $display_conditions[ $block ][ 'content-top' ] = array();
        $display_conditions[ $block ][ 'content-bottom' ] = array();
        $display_conditions[ $block ][ 'main-bottom' ] = array();
      }
      
      foreach ( $templates as $id ) {
        $template = get_post( $id );
        if ( $template->post_type != Wordtrap_Templates_Builder::POST_TYPE ) continue;
        $template_type = get_post_meta( (int) $id, Wordtrap_Templates_Builder::TEMPLATE_TYPE, true );
        if ( $template_type != $block ) continue;

        $conditions = array();
        $conditions[ WORDTRAP_CONDITIONS_ALL ] = get_post_meta( $id, WORDTRAP_CONDITIONS_ALL, true );
        $conditions[ WORDTRAP_CONDITIONS_SINGULAR ] = get_post_meta( $id, WORDTRAP_CONDITIONS_SINGULAR, true );
        $conditions[ WORDTRAP_CONDITIONS_ARCHIVE ] = get_post_meta( $id, WORDTRAP_CONDITIONS_ARCHIVE, true );
        if ( $conditions[ WORDTRAP_CONDITIONS_SINGULAR ] && $conditions[ WORDTRAP_CONDITIONS_ARCHIVE] ) {
          $conditions[ WORDTRAP_CONDITIONS_ALL ] = true;
        }
        if ( ! $conditions[ WORDTRAP_CONDITIONS_ALL] ) {
          if ( ! $conditions[ WORDTRAP_CONDITIONS_SINGULAR ] ) {
            $singular_conditions = get_post_meta( $id, WORDTRAP_SINGULAR_CONDITIONS, true );
            if ( ! $singular_conditions ) {
              $singular_conditions = array( 
                'checked' => array(),
                'selected' => array()
              );
            }
            $conditions[ WORDTRAP_SINGULAR_CONDITIONS ] = $singular_conditions;
          }
          if ( ! $conditions[ WORDTRAP_CONDITIONS_ARCHIVE ] ) {
            $archive_conditions = get_post_meta( $id, WORDTRAP_ARCHIVE_CONDITIONS, true );
            if ( ! $archive_conditions ) {
              $archive_conditions = array( 
                'checked' => array(),
                'selected' => array()
              );
            }
            $conditions[ WORDTRAP_ARCHIVE_CONDITIONS ] = $archive_conditions;
          }
        }

        if ( $block == 'left-sidebar' || $block == 'right-sidebar' || $block == 'main' ) {
          $position = get_post_meta( $id, WORDTRAP_DISPLAY_POSITIONS, true );
          if ( ! $position ) break;
          if ( is_array( $position ) ) {
            foreach ( $position as $pos ) {
              $display_conditions[ $block ][ $pos ][ $id ] = $conditions;
            }
          } else {
            $display_conditions[ $block ][ $position ][ $id ] = $conditions;
          }
        } else {
          $display_conditions[ $block ][ $id ] = $conditions;
        }
      }
    }
    update_option( WORDTRAP_DISPLAY_CONDITIONS, $display_conditions );
  }
}
