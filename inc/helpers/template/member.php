<?php
/**
 * Member template
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_member_follow_links' ) ) {
  /**
   * Member follow links
   */
  function wordtrap_member_follow_links() {
    wordtrap_get_template_part( 'template-parts/member/follow' );
  }
}

// Filter primary classes
add_filter( 'wordtrap_filter_primary_wrap_classes', 'wordtrap_primary_classes_for_single_member' );
add_filter( 'wordtrap_filter_primary_inner_classes', 'wordtrap_primary_classes_for_single_member' );

if ( ! function_exists( 'wordtrap_primary_classes_for_single_member' ) ) {
  /**
   * Remove container classes in primary classes
   */
  function wordtrap_primary_classes_for_single_member( $classes ) {
    if ( is_singular() && get_post_type() === 'member') {
      $main_layout = wordtrap_main_layout();
      $layout = $main_layout[ 'layout' ];
      if ( in_array( $layout, array( 'wide', 'full' ) ) ) {
        $classes = array_filter( $classes, static function( $element ) {
          return ! in_array( $element, array( 'container', 'container-fluid' ) );
        } );
      }
    }

    return $classes;
  }
}