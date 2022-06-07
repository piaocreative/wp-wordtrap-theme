<?php
/**
 * The helpers for the blocks
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_acf_property_value' ) ) :
  /**
   * Get property value in array
   */
  function wordtrap_acf_property_value( $arr, $property ) {
    if( is_array( $arr ) && array_key_exists( $property, $arr ) )
      return esc_attr( $arr[ $property ] );

    return '';
  }
endif;

if ( ! function_exists( 'wordtrap_acf_typography_style' ) ) :
  /**
   * Output the typography style 
   */
  function wordtrap_acf_typography_style( $arr, $output = false ) {
    $styles = array();

    $value = wordtrap_acf_property_value( $arr, 'font_size' );
    if ( $value ) {
      $styles[] = 'font-size:' . $value . 'px;';
    }

    $value = wordtrap_acf_property_value( $arr, 'line_height' );
    if ( $value ) {
      $styles[] = 'line_height:' . $value . 'px;';
    }

    $properties = array( 'font_family', 'font_weight', 'font_style', 'font_variant', 'font_stretch', 'text_align', 'text_decoration', 'text_transform' );
    foreach ( $properties as $property ) {
      $value = wordtrap_acf_property_value( $arr, $property );
      if ( $value && $value !== 'default' ) {
        $styles[] = ( $property == 'text_color' ? 'color' : str_replace( '_', '-', $property ) ) . ':' . $value . ';';
      } 
    }

    $properties = array( 'letter_spacing', 'text_color' );
    foreach ( $properties as $property ) {
      $value = wordtrap_acf_property_value( $arr, $property );
      if ( $value ) {
        $styles[] = ( $property == 'text_color' ? 'color' : str_replace( '_', '-', $property ) ) . ':' . $value . ';';
      } 
    }

    $style = implode( "", $styles );
    if ( ! $output ) {
      return $style;
    }

    echo $style;
  }
endif;

