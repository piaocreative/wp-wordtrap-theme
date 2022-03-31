<?php
/**
 * The left sidebar containing the main widget area
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Main layout
$main_layout = wordtrap_main_layout();
$layout = $main_layout[ 'layout' ];
$sidebar = $main_layout[ 'left-sidebar' ];

if ( ! $sidebar || ! is_active_sidebar( $sidebar ) ) {
  return;
}

// Sidebar classes
$sidebar_classes = array( 'widget-area', 'order-3', 'col-lg-3' );
if ( in_array( $layout, array( 'wide-both-sidebars', 'both-sidebars' ) ) ) {
  $sidebar_classes[] = 'order-lg-1';
} else {
  $sidebar_classes[] = 'order-md-1';
  $sidebar_classes[] = 'col-md-4';  
}
?>
<div id="left-sidebar" class="<?php echo esc_attr( implode( ' ', $sidebar_classes ) ) ?>">

  <?php dynamic_sidebar( $sidebar ); ?>

</div><!-- #left-sidebar -->
