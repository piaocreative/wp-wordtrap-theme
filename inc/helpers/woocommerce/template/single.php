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

// The product sale flash
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 1 );

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

// Product thumbnails columns
add_filter( 'woocommerce_product_thumbnails_columns', 'wordtrap_product_thumbnails_columns', 10 );
if ( ! function_exists( 'wordtrap_product_thumbnails_columns' ) ) {
  /**
   * Configure product thumbnails columns
   */
  function wordtrap_product_thumbnails_columns( $columns ) {
    return wordtrap_options( 'product-thumbnails-columns' );
  }
}

/**
 * Product View: Extended
 */
// Filter single product flexslider enabled
add_filter( 'woocommerce_single_product_flexslider_enabled', 'wordtrap_single_product_flexslider_disable' );
if ( ! function_exists( 'wordtrap_single_product_flexslider_disable' ) ) {
  /**
   * Disable flexslider
   */
  function wordtrap_single_product_flexslider_disable( $enabled ) {
    if ( in_array( wordtrap_options( 'product-view'), array( 'extended' ) ) ) {
      return false;
    }

    return $enabled;
  }
}

// Filter gallery image size
add_filter( 'woocommerce_gallery_image_size', 'wordtrap_gallery_image_size' );
if ( ! function_exists( 'wordtrap_gallery_image_size' ) ) {
  /**
   * Return full image size
   */
  function wordtrap_gallery_image_size( $image_size ) {
    if ( in_array( wordtrap_options( 'product-view'), array( 'extended' ) ) ) {
      return 'woocommerce_single';
    }

    return $image_size;
  }
}