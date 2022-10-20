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
$classes[] = 'products-view-details-' . wc_get_loop_prop( 'view-details', wordtrap_options( 'products-view-details' ) );
$classes[] = 'products-subcategory-pos-' . wc_get_loop_prop( 'subcategory-position', wordtrap_options( 'products-subcategory-position' ) );
$classes[] = 'products-subcategory-details-' . wc_get_loop_prop( 'subcategory-details', wordtrap_options( 'products-subcategory-details' ) );
$classes[] = 'products-subcategory-align-' . wc_get_loop_prop( 'subcategory-align', wordtrap_options( 'products-subcategory-align' ) );

$classes[] = wc_get_loop_prop( 'view-classes', $view_mode === 'grid' ? wordtrap_grid_view_classes() : '' );

$options = wc_get_loop_prop( 'view-options', '' )

?>
<div class="products <?php echo esc_attr( implode( ' ', $classes ) ) ?>" data-options="<?php echo esc_attr( $options ); ?>">
