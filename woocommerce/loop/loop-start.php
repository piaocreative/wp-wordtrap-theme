<?php
/**
 * Product Loop Start
 *
 * @package     Wordtrap
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

// View mode
$view_mode = wordtrap_get_view_mode();

$classes = array();
$classes[] = 'products-' . $view_mode;
$classes[] = 'products-view-' . esc_attr( wordtrap_options( 'products-view' ) );

if ( $view_mode === 'grid' ) {
  $classes[] = 'row';
  $classes[] = wordtrap_grid_view_classes();
}

?>
<div class="products <?php echo esc_attr( implode( ' ', $classes ) ) ?>">
