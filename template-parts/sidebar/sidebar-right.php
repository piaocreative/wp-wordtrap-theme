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

if ( ! $sidebar || ! is_active_sidebar( $sidebar ) ) {
  return;
}

// Sidebar classes
$sidebar_classes = array( 'widget-area', 'order-3', 'col-lg-3' );
if ( in_array( $layout, array( 'wide-both-sidebars', 'both-sidebars' ) ) ) {
  
} else {
  $sidebar_classes[] = 'col-md-4';
}
?>
<div id="right-sidebar" class="<?php echo esc_attr( implode( ' ', $sidebar_classes ) ) ?>">

  <?php dynamic_sidebar( $sidebar ); ?>

</div><!-- #right-sidebar -->

