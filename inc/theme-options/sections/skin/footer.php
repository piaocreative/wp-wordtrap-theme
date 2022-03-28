<?php
/**
 * The theme footer skin options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'        => esc_html__( 'Footer', 'wordtrap' ),
    'id'           => 'wordtrap-skin-footer',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'            => 'footer-bg',
        'type'          => 'color',
        'title'         => esc_html__( 'Background', 'wordtrap' ),
        'validate'      => 'color',
        'transparent'   => false,
        'default'       => '#252525'
      ),
      array(
        'id'            => 'footer-color',
        'type'          => 'color',
        'title'         => esc_html__( 'Text', 'wordtrap' ),
        'validate'      => 'color',
        'transparent'   => false,
        'default'       => '#686868'
      ),
      array(
        'id'            => 'footer-headings-color',
        'type'          => 'color',
        'title'         => esc_html__( 'Headings', 'wordtrap' ),
        'validate'      => 'color',
        'transparent'   => false,
        'default'       => '#ffffff'
      ),
      array(
        'id'            => 'footer-link-color',
        'type'          => 'color',
        'title'         => esc_html__( 'Link Regular', 'wordtrap' ),
        'validate'      => 'color',
        'transparent'   => false,
        'default'       => '#686868'
      ),
      array(
        'id'            => 'footer-link-hover-color',
        'type'          => 'color',
        'title'         => esc_html__( 'Link Hover', 'wordtrap' ),
        'validate'      => 'color',
        'transparent'   => false,
        'default'       => '#888888'
      ),
    )
  )
);