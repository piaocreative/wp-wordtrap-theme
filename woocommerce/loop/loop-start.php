<?php
/**
 * Product Loop Start
 *
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

// View mode
$view_mode = wc_get_loop_prop( 'view-mode', wordtrap_get_view_mode() );

$classes = array();
$classes[] = 'products-' . $view_mode;
$classes[] = 'products-view-' . wc_get_loop_prop( 'view', wordtrap_options( 'products-view' ) );

$classes[] = wc_get_loop_prop( 'view-classes', $view_mode === 'grid' ? wordtrap_grid_view_classes() : '' );

$options = wc_get_loop_prop( 'view-options', '' )

?>
<div class="products <?php echo esc_attr( implode( ' ', $classes ) ) ?>" data-options="<?php echo esc_attr( $options ); ?>">
