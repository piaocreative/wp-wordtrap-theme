<?php
/**
 * Add WooCommerce support
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', 'wordtrap_woocommerce_support' );

if ( ! function_exists( 'wordtrap_woocommerce_support' ) ) {
  /**
   * Declares WooCommerce theme support
   */
  function wordtrap_woocommerce_support() {
    add_theme_support( 'woocommerce' );

    // Add Product Gallery support.
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-slider' );

    // Add Bootstrap classes to form fields.
    add_filter( 'woocommerce_form_field_args', 'wordtrap_wc_form_field_args', 10, 3 );
    add_filter( 'woocommerce_quantity_input_classes', 'wordtrap_quantity_input_classes' );
  }
}

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

// Unhook the content wrappers.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Unhook the get sidebar.
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Unhook the page title
add_filter( 'woocommerce_show_page_title', function() { return false; } );

// Unhook the breadcrumb
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

// Unhook the product sale flash
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

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

// Hook the product sale flash
add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 1 );

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

// Unhook the products result count and ordering
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

if ( ! function_exists( 'wordtrap_wc_form_field_args' ) ) {
  /**
   * Filter hook function monkey patching form classes
   * Author: Adriano Monecchi http://stackoverflow.com/a/36724593/307826
   *
   * @param string $args Form attributes.
   * @param string $key Not in use.
   * @param null   $value Not in use.
   *
   * @return mixed
   */
  function wordtrap_wc_form_field_args( $args, $key, $value = null ) {
    // Start field type switch case.
    switch ( $args['type'] ) {
      // Targets all select input type elements, except the country and state select input types.
      case 'select':
        /*
         * Add a class to the field's html element wrapper - woocommerce
         * input types (fields) are often wrapped within a <p></p> tag.
         */
        $args['class'][] = 'form-group mb-3';
        // Add a class to the form input itself.
        $args['input_class'][] = 'form-control';
        // Add custom data attributes to the form input itself.
        $args['custom_attributes'] = array(
          'data-plugin'      => 'select2',
          'data-allow-clear' => 'true',
          'aria-hidden'      => 'true',
        );
        break;

      /*
       * By default WooCommerce will populate a select with the country names - $args
       * defined for this specific input type targets only the country select element.
       */
      case 'country':
        $args['class'][] = 'form-group mb-3 single-country';
        break;

      /*
       * By default WooCommerce will populate a select with state names - $args defined
       * for this specific input type targets only the country select element.
       */
      case 'state':
        $args['class'][]           = 'form-group mb-3';
        $args['custom_attributes'] = array(
          'data-plugin'      => 'select2',
          'data-allow-clear' => 'true',
          'aria-hidden'      => 'true',
        );
        break;
      case 'textarea':
        $args['input_class'][] = 'form-control';
        break;
      case 'checkbox':
          $args['class'][] = 'form-group mb-3';
          // Wrap the label in <span> tag.
          $args['label'] = isset( $args['label'] ) ? '<span class="custom-control-label">' . $args['label'] . '<span>' : '';
          // Add a class to the form input's <label> tag.
          $args['label_class'][] = 'custom-control custom-checkbox';
          $args['input_class'][] = 'custom-control-input';
        break;
      case 'radio':
        $args['label_class'][] = 'custom-control custom-radio';
        $args['input_class'][] = 'custom-control-input';
        break;
      default:
        $args['class'][]       = 'form-group mb-3';
        $args['input_class'][] = 'form-control';
        break;
    } // End of switch ( $args ).
    return $args;
  }
}

if ( ! is_admin() && ! function_exists( 'wc_review_ratings_enabled' ) ) {
  /**
   * Check if reviews are enabled.
   *
   * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
   *
   * @return bool
   */
  function wc_reviews_enabled() {
    return 'yes' === get_option( 'woocommerce_enable_reviews' );
  }

  /**
   * Check if reviews ratings are enabled.
   *
   * Function introduced in WooCommerce 3.6.0., include it for backward compatibility.
   *
   * @return bool
   */
  function wc_review_ratings_enabled() {
    return wc_reviews_enabled() && 'yes' === get_option( 'woocommerce_enable_review_rating' );
  }
}

if ( ! function_exists( 'wordtrap_quantity_input_classes' ) ) {
  /**
   * Add Bootstrap class to quantity input field.
   *
   * @param array $classes Array of quantity input classes.
   * @return array
   */
  function wordtrap_quantity_input_classes( $classes ) {
    $classes[] = 'form-control';
    return $classes;
  }
}
