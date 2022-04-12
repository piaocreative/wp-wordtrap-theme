<?php
/**
 * Single Product Sale Flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/sale-flash.php.
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

global $post, $product;

$labels = wordtrap_options( 'product-labels' );

if ( empty( $labels ) ) {
  return;
}

$show_hot = $product->is_featured() && in_array( 'hot', $labels );

$new_period = empty( wordtrap_options( 'product-new-days' ) ) ? 7 : (int) wordtrap_options( 'product-new-days' );
$show_new = strtotime( $product->get_date_created() ) > strtotime( '-' . $new_period . ' day' ) && in_array( 'new', $labels );

$show_sale = $product->is_on_sale() && in_array( 'sale', $labels );

if ( ! ( $show_hot || $show_new || $show_sale ) ) {
  return;
}

?>

<div class="product-labels">

  <?php 

  // display hot label
  if ( $show_hot ) {
    echo '<span class="onhot">' 
      . ( wordtrap_options( 'product-hot' ) ? esc_html( wordtrap_options( 'product-hot' ) ) : esc_html__( 'Hot', 'wordtrap' ) ) 
      . '</span>';
  }

  // display new label
  if ( $show_new ) {
    echo '<span class="onnew">' 
      . ( wordtrap_options( 'product-new-label' ) ? esc_html( wordtrap_options( 'product-new' ) ) : esc_html__( 'New', 'wordtrap' ) ) 
      . '</span>';
  }

  // display sale label
  if ( $show_sale ) {
    $percent = 0;
    $regular_price = floatval( $product->get_regular_price() );
    if ( $regular_price ) {
      $percent = round( ( ( $product->get_sale_price() - $regular_price ) / $regular_price ) * 100 );
    }
    echo apply_filters( 
      'woocommerce_sale_flash', 
      '<span class="onsale">' 
        . ( ( wordtrap_options( 'product-sale-percent' ) && $percent ) ? $percent . esc_html__( '%', 'wordtrap' ) : ( wordtrap_options( 'product-sale' ) ? esc_html( wordtrap_options( 'product-sale' ) ) : esc_html__( 'Sale', 'wordtrap' ) ) ) 
        .  '</span>', 
      $post, 
      $product 
    );
  }
  
  ?>

</div>
