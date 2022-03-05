<?php
/**
 * Compile theme styles
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Compile theme styles
if ( ! function_exists( 'wordtrap_compile_styles' ) ) {
  function wordtrap_compile_styles() {
    
  }
}
add_action( 'wordtrap_compile_styles', 'wordtrap_compile_styles', 10 );

// Compile theme styles with changed values
if ( ! function_exists( 'wordtrap_compile_with_changed_values' ) ) {
  function wordtrap_compile_with_changed_values( $changed_values ) {
    $changed_fields = array_keys( $changed_values );
    $skin_fields = wordtrap_skin_fields();
    $compile = false;
    
    foreach ( $changed_fields as $field ) {
      if ( in_array( $field, $skin_fields ) ) {
        $compile = true;
      }
    }
  
    if ( $compile ) {
      do_action( 'wordtrap_compile_styles' );
    }  
  }  
}

// Get all fields related to styles
if ( ! function_exists( 'wordtrap_skin_fields' ) ) {
  function wordtrap_skin_fields() {
    return array(
      'css-code',
      'body-color', 'body-bg', 
      'primary', 'secondary', 'success', 'info', 'warning', 'danger', 'light', 'dark', 
      'white', 'gray-100', 'gray-200', 'gray-300', 'gray-400', 'gray-500', 'gray-600', 'gray-700', 'gray-800', 'gray-900', 'black',
      'grid-breakpoints-sm', 'grid-breakpoints-md', 'grid-breakpoints-lg', 'grid-breakpoints-xl', 'grid-breakpoints-xxl', 
      'container-max-widths-sm', 'container-max-widths-md', 'container-max-widths-lg', 'container-max-widths-xl', 'container-max-widths-xxl', 
      'grid-columns', 'grid-gutter-width', 
      'spacer', 'spacers', 
      'font-family-base', 'font-family-code', 
      'font-size-base', 'font-size-sm', 'font-size-lg', 'h1-font-size', 'h2-font-size', 'h3-font-size', 'h4-font-size', 'h5-font-size', 'h6-font-size', 
      'font-weight-lighter', 'font-weight-light', 'font-weight-normal', 'font-weight-bold', 'font-weight-bolder', 
      'line-height-base', 'line-height-sm', 'line-height-lg', 
      'headings-margin-bottom', 'headings-font-family', 'headings-font-weight', 'headings-line-height', 'headings-color', 
      'link', 'link-hover'
    );
  }
}

// Compile after process compiler fields
if ( ! function_exists( 'wordtrap_compile_after_compile_options' ) ) {
  function wordtrap_compile_after_compile_options( $options, $css, $changed_values ) {
    wordtrap_compile_with_changed_values( $changed_values );
  }
}
add_action( 'redux/options/' . WORDTRAP_OPTIONS . '/compiler', 'wordtrap_compile_after_compile_options', 10, 3 );
