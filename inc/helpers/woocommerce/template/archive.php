<?php
/**
 * WooCommerce single products template functions and hooks
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Wrap the products
add_action( 'woocommerce_before_main_content', 'wordtrap_wrap_start_products', 1 );
add_action( 'woocommerce_before_after_content', 'wordtrap_wrap_end_products', 1 );

if ( ! function_exists( 'wordtrap_wrap_start_products' ) ) {
  /**
   * Display the start of the products
   */
  function wordtrap_wrap_start_products() {
    $pagination = wordtrap_options( 'products-pagination' );
    if ( $pagination ) : ?>
      <div class="posts-pagination-container posts-pagination-<?php echo esc_attr( $pagination ) ?>">
    <?php 
    endif;
  }
}

if ( ! function_exists( 'wordtrap_wrap_end_products' ) ) {
  /**
   * Display the end of the products
   */
  function wordtrap_wrap_end_products() {
    $pagination = wordtrap_options( 'products-pagination' );
    if ( $pagination ) : ?>
      </div><!-- .posts-pagination-container -->
    <?php 
    endif;
  }
}

// Unhook the products result count and ordering
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

// Add a class for the rating in the product title
add_filter( 'woocommerce_product_loop_title_classes', 'wordtrap_add_product_rating_title_class', 10 );
if ( ! function_exists( 'wordtrap_add_product_rating_title_class' ) ) {
  /**
   * Add a class for the rating
   */
  function wordtrap_add_product_rating_title_class( $classes ) {
    global $product;

    if ( wc_review_ratings_enabled() && wc_get_rating_html( $product->get_average_rating() ) ) {
      $classes .= ' with-rating';
    }
    return $classes;
  }
}
