<?php
/**
 * The right sidebar containing the main widget area
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Main layout
$main_layout = wordtrap_main_layout();
$layout = $main_layout[ 'layout' ];
$sidebar = $main_layout[ 'right-sidebar' ];

$sidebar_top = wordtrap_layout_template( 'right-sidebar', 'top' );
$sidebar_bottom = wordtrap_layout_template( 'right-sidebar', 'bottom' );

$active_sidebar = $sidebar_top || $sidebar_bottom || is_active_sidebar( $sidebar );

if ( ! $active_sidebar ) {
  return;
}

// Sidebar classes
$sidebar_classes = array( 'widget-area', 'order-3', 'col-lg-3' );
if ( in_array( $layout, array( 'wide-both-sidebars', 'both-sidebars' ) ) ) {
  
} else {
  $sidebar_classes[] = 'col-md-4';
}
if ( wordtrap_options( 'sticky-sidebar' ) ) {
  $sidebar_classes[] = 'sticky-sidebar';
}
?>
<div id="right-sidebar" class="<?php echo esc_attr( implode( ' ', $sidebar_classes ) ) ?>">

  <?php 

  /**
   * Render sidebar top template
   */
  wordtrap_render_template( $sidebar_top ); 

  /**
   * Render sidebar
   */
  if ( $sidebar && is_active_sidebar( $sidebar ) ) {
    dynamic_sidebar( $sidebar );
  }

  /**
   * Render sidebar bottom template
   */
  wordtrap_render_template( $sidebar_bottom ); 

  ?>

</div><!-- #right-sidebar -->

