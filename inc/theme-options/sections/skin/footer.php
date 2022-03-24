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
        'id'            => 'footer-navbar-color',
        'type'          => 'button_set',
        'title'         => esc_html__( 'Menu Color', 'wordtrap' ),
        'options'       => array(
          'light'       => esc_html__( 'Light', 'wordtrap' ),
          'dark'        => esc_html__( 'Dark', 'wordtrap' ),
        ),
        'default'       => 'dark',
      ),
    )
  )
);