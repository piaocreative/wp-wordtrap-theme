<?php
/**
 * Theme basic setup
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
        $args['input_class'][] = 'form-select';
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
        $args['class'][] = 'form-group mb-3';
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