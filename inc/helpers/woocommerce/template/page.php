<?php
/**
 * WooCommerce page template functions and hooks
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Hook before cart
add_action( 'woocommerce_before_cart', 'wordtrap_before_cart', 100 );
if ( ! function_exists( 'wordtrap_before_cart' ) ) {
  /**
   * Wrap start of cart page
   */
  function wordtrap_before_cart() {
    ?>
    <div class="cart-page">
    <?php    
  }
}

// Hook after cart
add_action( 'woocommerce_after_cart', 'wordtrap_after_cart', 1 );
if ( ! function_exists( 'wordtrap_after_cart' ) ) {
  /**
   * Wrap end of cart page
   */
  function wordtrap_after_cart() {
    ?>
    </div><!-- .cart-page -->
    <?php    
  }
}

// Unhook cross sell display
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

// Hook cross sell display
add_action( 'woocommerce_after_cart', 'wordtrap_cross_sell_display' );
if ( ! function_exists( 'wordtrap_cross_sell_display' ) ) {
  /**
   * Show cross sell
   */
  function wordtrap_cross_sell_display() {
    if ( wordtrap_options( 'product-cross-sells' ) ) {
      woocommerce_cross_sell_display( wordtrap_options( 'product-cross-sells-count' ) );
    }
  }
}

