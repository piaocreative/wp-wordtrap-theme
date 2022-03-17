<?php
/**
 * The theme logo options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'        => esc_html__( 'Logo', 'wordtrap' ),
    'id'           => 'wordtrap-global-logo',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'       => 'logo',
        'type'     => 'media',
        'readonly' => false,
        'title'    => esc_html__( 'Logo', 'wordtrap' ),
        'default'  => array(
          'url'    => WORDTRAP_URI . '/images/logo/logo.png',
        ),
      ),
      array(
        'id'       => 'logo-retina',
        'type'     => 'media',
        'readonly' => false,
        'title'    => esc_html__( 'Retina Logo', 'wordtrap' ),
      ),
      // array(
      //   'id'       => 'logo-widths-start',
      //   'type'     => 'section',
      //   'title'    => esc_html__( 'Logo Max Widths based on Breakpoints', 'wordtrap' ),
      //   'indent'   => true,
      // ),
      array(
        'id'       => 'logo-width',
        'type'     => 'dimensions',
        'title'    => esc_html__( 'Logo Max Width', 'wordtrap' ),
        'height'   => false,
        'default'  => array(
          'width'  => 260
        ),
      ),
      // array(
      //   'id'       => 'logo-width-xl',
      //   'type'     => 'dimensions',
      //   'title'    => esc_html__( 'Extra Large', 'wordtrap' ),
      //   'height'   => false,
      //   'default'  => array(
      //     'width'  => 230
      //   ),
      // ),
      // array(
      //   'id'       => 'logo-width-lg',
      //   'type'     => 'dimensions',
      //   'title'    => esc_html__( 'Large', 'wordtrap' ),
      //   'height'   => false,
      //   'default'  => array(
      //     'width'  => 200
      //   ),
      // ),
      // array(
      //   'id'       => 'logo-width-md',
      //   'type'     => 'dimensions',
      //   'title'    => esc_html__( 'Medium', 'wordtrap' ),
      //   'height'   => false,
      //   'default'  => array(
      //     'width'  => 170
      //   ),
      // ),
      // array(
      //   'id'       => 'logo-width-sm',
      //   'type'     => 'dimensions',
      //   'title'    => esc_html__( 'Small', 'wordtrap' ),
      //   'height'   => false,
      //   'default'  => array(
      //     'width'  => 140
      //   ),
      // ),
      // array(
      //   'id'       => 'logo-width-xs',
      //   'type'     => 'dimensions',
      //   'title'    => esc_html__( 'X-Small', 'wordtrap' ),
      //   'height'   => false,
      //   'default'  => array(
      //     'width'  => 110
      //   ),
      // ),
      // array(
      //   'id'       => 'logo-widths-end',
      //   'type'     => 'section',
      //   'indent'   => false,
      // ),
    )
  )
);