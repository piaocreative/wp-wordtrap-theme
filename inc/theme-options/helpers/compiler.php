<?php
/**
 * Compile theme styles
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_compile_with_changed_values' ) ) {
  /**
   * Compile theme styles with changed values
   *
   * @params array $changed_values   Changed values when saving theme options
   */
  function wordtrap_compile_with_changed_values( $changed_values ) {
    $changed_fields = array_keys( $changed_values );
    $skin_fields = wordtrap_skin_fields();
    $post_type_fields = wordtrap_post_type_fields();
    $compile = false;
    $flush_rewrite = false;
    
    foreach ( $changed_fields as $field ) {
      if ( in_array( $field, $skin_fields ) ) {
        $compile = true;
      }

      if ( in_array( $field, $post_type_fields ) ) {
        $flush_rewrite = true;
      }
    }
  
    if ( $compile ) {
      do_action( 'wordtrap_compile_styles' );
    }

    if ( $flush_rewrite ) {
      set_transient( 'wordtrap_flush_rewrite_rules', true, 300 );
    }
  }  
}

if ( ! function_exists( 'wordtrap_skin_fields' ) ) {
  /**
   * Get all fields related to style
   *
   * @params array    All skin fields
   */
  function wordtrap_skin_fields() {
    return array(
      // bootstrap variables
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
      'link', 'link-hover',

      // templates variables
      'header-bg', 'header-logo-margin',
      'main-bg', 'section-bg',
      'footer-bg', 'footer-color', 'footer-headings-color', 'footer-link-color', 'footer-link-hover-color',
    );
  }
}

if ( ! function_exists( 'wordtrap_post_type_fields' ) ) {
  /**
   * Get all fields related to post type
   *
   * @params array    All post type fields
   */
  function wordtrap_post_type_fields() {
    return array(
      'faq-slug-name', 'faq-cat-slug-name', 'faqs-page',
      'member-slug-name', 'member-cat-slug-name', 'members-page',
    );
  }
}

if ( ! function_exists( 'wordtrap_compile_after_compile_options' ) ) {
  /**
   * Compile after compiler field processing
   *
   * @params array   $options         Theme options.
   *         string  $css             CSS that get sent to the compiler hook.
   *         array   $changed_values  Changed values when compiling theme options.
   */
  function wordtrap_compile_after_compile_options( $options, $css, $changed_values ) {
    wordtrap_compile_with_changed_values( $changed_values );
  }
}
add_action( 'redux/options/' . WORDTRAP_OPTIONS . '/compiler', 'wordtrap_compile_after_compile_options', 10, 3 );

if ( ! function_exists( 'wordtrap_customizer_theme_styles' ) ) {
  /**
   * Enqueue customizer theme styles
   */
  function wordtrap_customizer_theme_styles() {
    do_action( 'wordtrap_compile_styles', true );
  }
}
add_action( 'redux/customizer/live_preview', 'wordtrap_customizer_theme_styles' );