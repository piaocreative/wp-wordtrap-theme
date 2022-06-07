<?php
/**
 * Register extra fields
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_action( 'acf/include_field_types', 'wordtrap_include_acf_fields' );

if ( ! function_exists( 'wordtrap_include_acf_fields' ) ) {
  /**
   * Include extra acf fields
   */
  function wordtrap_include_acf_fields() {
    include_once WORDTRAP_BLOCKS_PATH . 'fields/class-wordtrap-acf-field-margin.php';
    include_once WORDTRAP_BLOCKS_PATH . 'fields/class-wordtrap-acf-field-padding.php';
    include_once WORDTRAP_BLOCKS_PATH . 'fields/class-wordtrap-acf-field-border-radius.php';
  }
}

add_filter( 'acf/validate_field', 'wordtrap_acf_validate_typography_field' );

if ( ! function_exists( 'wordtrap_acf_validate_typography_field' ) ) {
  /**
   * Validate acf typography field
   */
  function wordtrap_acf_validate_typography_field( $field ) {
    if ( in_array( $field['name'], array( 'font_family', 'font_weight', 'font_style', 'font_variant', 'font_stretch', 'text_align', 'text_decoration', 'text_transform' ) ) ) {
      if ( isset( $field['choices'] ) ) {
        $field['choices'] = array_merge( array( 'default' => __( 'default', 'wordtrap' ) ), $field['choices'] );
      }
    }

    return $field;
  }
}

add_action( 'acf/render_field/type=Typography', 'wordtrap_acf_render_typography_field_before', 8 );
add_action( 'acf/render_field/type=Typography', 'wordtrap_acf_render_typography_field_after', 10 );

if ( ! function_exists( 'wordtrap_acf_render_typography_field_before' ) ) {
  /**
   * Hook before render typography field
   */
  function wordtrap_acf_render_typography_field_before() {
    ob_start();
  }
}

if ( ! function_exists( 'wordtrap_acf_render_typography_field_after' ) ) {
  /**
   * Hook after render typography field
   */
  function wordtrap_acf_render_typography_field_after() {
    $html = ob_get_clean();
    echo str_replace( 'data-placeholder="Select" data-allow_null="0">', 'data-placeholder="Select" data-allow_null="0"><option val="default">' . __( 'default', 'wordtrap' ), $html );
  }
}