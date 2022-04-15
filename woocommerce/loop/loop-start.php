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

$wrap_classes = array();
$wrap_classes[] = 'products-' . $view_mode;

if ( $view_mode === 'grid' ) {
  $wrap_classes[] = 'row';
  $wrap_classes[] = wordtrap_grid_view_classes();
}

?>
<div class="products <?php echo esc_attr( implode( ' ', $wrap_classes ) ) ?>">
