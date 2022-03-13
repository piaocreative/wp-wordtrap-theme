<?php
/**
 * Template functions
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_get_template_part' ) ) {
  /**
   * Load a template part into a template
   *
   * @params string   $slug   The slug name for the generic template.
   *         string   $name   The name of the specialised template.
   *         array    $args   Additional arguments passed to the template.
   */
  function wordtrap_get_template_part( $slug, $name = null, $args = array() ) {
    if ( empty( $args ) ) {
      return get_template_part( $slug, $name );
    }

    if ( is_array( $args ) ) {
      extract( $args );
    }

    $templates = array();
    $name      = (string) $name;

    if ( '' !== $name ) {
      $templates[] = "{$slug}-{$name}.php";
    }

    $templates[] = "{$slug}.php";
    $template    = locate_template( $templates );
    $template    = apply_filters( 'wordtrap_get_template_part', $template, $slug, $name );

    if ( $template ) {
      include $template;
    }
  }
}