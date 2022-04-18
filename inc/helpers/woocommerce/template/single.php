<?php
/**
 * WooCommerce single product template functions and hooks
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Filter primary classes
add_filter( 'wordtrap_filter_primary_wrap_classes', 'wordtrap_primary_classes_for_single_product', 10 );
add_filter( 'wordtrap_filter_primary_inner_classes', 'wordtrap_primary_classes_for_single_product', 10 );

if ( ! function_exists( 'wordtrap_primary_classes_for_single_product' ) ) {
  /**
   * Remove container classes in primary classes
   */
  function wordtrap_primary_classes_for_single_product( $classes ) {
    if ( is_product() && ! post_password_required() ) {
      $main_layout = wordtrap_main_layout();
      $layout = $main_layout[ 'layout' ];
      if ( in_array( $layout, array( 'wide', 'full' ) ) ) {
        $classes = array_filter( $classes, static function( $element ) {
          return ! in_array( $element, array( 'container', 'container-fluid' ) );
        } );
      }
    }

    return $classes;
  }
}

// Wrap the product summary
add_action( 'woocommerce_before_single_product_summary', 'wordtrap_single_product_summary_wrapper_start', 1 );
add_action( 'woocommerce_after_single_product_summary', 'wordtrap_single_product_summary_wrapper_end', 1 );

if ( ! function_exists( 'wordtrap_single_product_summary_wrapper_start' ) ) {
  /**
   * Display the start of the product summary
   */
  function wordtrap_single_product_summary_wrapper_start() {
    $main_layout = wordtrap_main_layout();
    $layout = $main_layout[ 'layout' ];
    if ( $layout === 'wide' ) {
      echo '<div class="product-summary-wrapper wide-width"><div class="container-fluid">';
    } else if ( $layout === 'full' ) {
      echo '<div class="product-summary-wrapper wide-width"><div class="container">';
    } else {
      echo '<div class="product-summary-wrapper">';
    }    
  }
}

if ( ! function_exists( 'wordtrap_single_product_summary_wrapper_end' ) ) {
  /**
   * Display the end of the product summary
   */
  function wordtrap_single_product_summary_wrapper_end() {
    $main_layout = wordtrap_main_layout();
    $layout = $main_layout[ 'layout' ];
    if ( $layout === 'wide' || $layout === 'full' ) {
      echo '</div></div>';
    } else {
      echo '</div>';
    }
    echo '<!-- .product-summary-wrapper -->';
  }
}

// The product sale flash
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 1 );

// Wrap the product area beside summary
add_action( 'woocommerce_after_single_product_summary', 'wordtrap_single_product_area_wrapper_start', 1 );
add_action( 'woocommerce_after_single_product_summary', 'wordtrap_single_product_area_wrapper_end', 101 );

if ( ! function_exists( 'wordtrap_single_product_area_wrapper_start' ) ) {
  /**
   * Display the start of the product area beside summary
   */
  function wordtrap_single_product_area_wrapper_start() {
    $main_layout = wordtrap_main_layout();
    $layout = $main_layout[ 'layout' ];
    echo '<div class="product-after-summary">';
    if ( $layout === 'wide' ) {
      echo '<div class="container-fluid">';
    } else if ( $layout === 'full' ) {
      echo '<div class="container">';
    }    
  }
}

if ( ! function_exists( 'wordtrap_single_product_area_wrapper_end' ) ) {
  /**
   * Display the end of the product area beside summary
   */
  function wordtrap_single_product_area_wrapper_end() {
    $main_layout = wordtrap_main_layout();
    $layout = $main_layout[ 'layout' ];
    if ( $layout === 'wide' || $layout === 'full' ) {
      echo '</div>';
    }
    echo '</div>';
    echo '<!-- .product-after-summary -->';
  }
}

// Hook after single product summary
add_action( 'woocommerce_after_single_product_summary', 'wordtrap_after_single_product_summary', 1 );
if ( ! function_exists( 'wordtrap_after_single_product_summary' ) ) {
  /**
   * Hide related products or upsells
   */
  function wordtrap_after_single_product_summary() {
    if ( ! wordtrap_options( 'product-upsells' ) ) {
      remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
    }
    if ( ! wordtrap_options( 'product-related' ) ) {
      remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    }
  }
}

// Filter upsells count
add_filter( 'woocommerce_upsell_display_args', 'wordtrap_upsells_count', 10 );
if ( ! function_exists( 'wordtrap_upsells_count' ) ) {
  /**
   * Configure upsells count
   */
  function wordtrap_upsells_count( $args ) {
    $args[ 'posts_per_page' ] = wordtrap_options( 'product-upsells-count' );
    return $args;
  }
}

// Filter related product count
add_filter( 'woocommerce_output_related_products_args', 'wordtrap_related_products_count', 10 );
if ( ! function_exists( 'wordtrap_related_products_count' ) ) {
  /**
   * Configure related products count
   */
  function wordtrap_related_products_count( $args ) {
    $args[ 'posts_per_page' ] = wordtrap_options( 'product-related-count' );
    return $args;
  }
}