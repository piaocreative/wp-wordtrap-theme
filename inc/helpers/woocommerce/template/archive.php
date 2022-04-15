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

// Unhook product link
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

// Hook the product loop item title
add_action( 'woocommerce_shop_loop_item_title', 'wordtrap_shop_loop_item_categories', 1 );
if ( ! function_exists( 'wordtrap_shop_loop_item_categories' ) ) {
  /**
   * Add categories in list mode
   */
  function wordtrap_shop_loop_item_categories() {
    global $product;

    // View mode
    $view_mode = wordtrap_get_view_mode();

    if ( $view_mode === 'list' && wordtrap_options( 'products-categories' ) ) {
      echo '<span class="category-list">' . wc_get_product_category_list( $product->get_id(), ', ', '' ) . '</span>';
    }
  }
}

add_action( 'woocommerce_shop_loop_item_title', 'wordtrap_shop_loop_item_description_after_title', 20 );
if ( ! function_exists( 'wordtrap_shop_loop_item_description_after_title' ) ) {
  /**
   * Add description in list mode
   */
  function wordtrap_shop_loop_item_description_after_title() {
    global $product;

    // View mode
    $view_mode = wordtrap_get_view_mode();

    if ( $view_mode === 'list' ) {
      woocommerce_template_single_excerpt();
    }
  }
}

add_action( 'woocommerce_shop_loop_item_title', 'wordtrap_shop_loop_item_rating_after_title', 30 );
if ( ! function_exists( 'wordtrap_shop_loop_item_rating_after_title' ) ) {
  /**
   * Add rating in list mode
   */
  function wordtrap_shop_loop_item_rating_after_title() {
    global $product;

    // View mode
    $view_mode = wordtrap_get_view_mode();

    if ( $view_mode === 'list' && wordtrap_options( 'products-rating' ) ) {
      woocommerce_template_loop_rating();
      remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
    }
  }
}

// Hook product link
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 1 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 100 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 1 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 11 );

// Add a class for the rating in the product title
add_filter( 'woocommerce_product_loop_title_classes', 'wordtrap_add_product_rating_title_class', 10 );
if ( ! function_exists( 'wordtrap_add_product_rating_title_class' ) ) {
  /**
   * Add a class for the rating
   */
  function wordtrap_add_product_rating_title_class( $classes ) {
    global $product;

    // View mode
    $view_mode = wordtrap_get_view_mode();

    if ( $view_mode === 'grid' && wordtrap_options( 'products-rating' ) && wc_review_ratings_enabled() && wc_get_rating_html( $product->get_average_rating() ) ) {
      $classes .= ' with-rating';
    }
    return $classes;
  }
}

// Hook after shop loop item title
add_action( 'woocommerce_after_shop_loop_item_title', 'wordtrap_after_shop_loop_item_title', 1 );
if ( ! function_exists( 'wordtrap_after_shop_loop_item_title' ) ) {
  /**
   * Show or hide a rating, price, add to cart, etc
   */
  function wordtrap_after_shop_loop_item_title() {
    if ( ! wordtrap_options( 'products-rating' ) ) {
      remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
    }

    if ( ! wordtrap_options( 'products-price' ) ) {
      remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
    }

    if ( ! wordtrap_options( 'products-add-to-cart' ) ) {
      remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    }
  }
}

// Hook after shop loop item title
add_action( 'woocommerce_after_shop_loop_item_title', 'wordtrap_after_shop_loop_item', 5 );
if ( ! function_exists( 'wordtrap_after_shop_loop_item' ) ) {
  /**
   * Add categories
   */
  function wordtrap_after_shop_loop_item() {
    global $product;

    // View mode
    $view_mode = wordtrap_get_view_mode();

    if ( $view_mode === 'grid' && wordtrap_options( 'products-categories' ) ) {
      echo '<span class="category-list">' . wc_get_product_category_list( $product->get_id(), ', ', '' ) . '</span>';
    }
  }
}