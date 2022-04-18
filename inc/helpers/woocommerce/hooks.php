<?php
/**
 * Woocommerce custom hooks
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Unhook the content wrappers.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Unhook the get sidebar.
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Unhook the page title
add_filter( 'woocommerce_show_page_title', function() { return false; } );

// Unhook the breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

// Hook the product social share
add_action( 'woocommerce_share', 'wordtrap_woocommerce_share', 10 );

if ( ! function_exists( 'wordtrap_woocommerce_share' ) ) {
  /**
   * Display the social shares for the product
   */
  function wordtrap_woocommerce_share() {
    if ( wordtrap_options( 'product-share' ) ) {
      wordtrap_social_share();
    }
  }
}

// Add minus, plus buttons in quantity input
add_action( 'woocommerce_before_quantity_input_field', 'wordtrap_woocommerce_before_quantity_input_field', 10 );
add_action( 'woocommerce_after_quantity_input_field', 'wordtrap_woocommerce_after_quantity_input_field', 10 );

if ( ! function_exists( 'wordtrap_woocommerce_before_quantity_input_field' ) ) {
  /**
   * Start wrap and add minus button
   */
  function wordtrap_woocommerce_before_quantity_input_field() {
    ?>
    <div class="input-group">
      <button class="btn minus" type="button"><?php _e( '-', 'wordtrap' ) ?></button>
    <?php
  }
}

if ( ! function_exists( 'wordtrap_woocommerce_after_quantity_input_field' ) ) {
  /**
   * Add plus button and end wrap
   */
  function wordtrap_woocommerce_after_quantity_input_field() {
    ?>
      <button class="btn plus" type="button"><?php _e( '+', 'wordtrap' ) ?></button>
    </div>      
    <?php
  }
}