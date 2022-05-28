<?php
/**
 * The helpers for the blocks
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_acf_typography_style' ) ) :
  /**
   * Output the typography style 
   */
  function wordtrap_acf_typography_style( $field, $output = true ) {
    if ( ! function_exists( 'get_typography_field' ) ) {
      if ( $output ) {
        return '';
      }
      return;
    }

    $styles = array();
    
    $value = get_typography_field( $field, 'font_size' );
    if ( $value ) {
      $styles[] = 'font-size: ' . $value . 'px !important;';
    }

    $value = get_typography_field( $field, 'line_height' );
    if ( $value ) {
      $styles[] = 'line_height: ' . $value . 'px !important;';
    }

    $properties = array( 'font_family', 'font_weight', 'font_style', 'font_variant', 'font_stretch', 'letter_spacing', 'text_align', 'text_color', 'text_decoration', 'text_transform' );
    foreach ( $properties as $property ) {
      $value = get_typography_field( $field, $property );
      if ( $value ) {
        $styles[] = ( $property == 'text_color' ? 'color' : str_replace( '_', '-', $property ) ) . ': ' . $value . ' !important;';
      } 
    }

    $style = implode( " ", $styles );
    if ( ! $output ) {
      return $style;
    }

    echo $style;
  }
endif;

