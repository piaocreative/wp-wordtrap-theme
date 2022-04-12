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