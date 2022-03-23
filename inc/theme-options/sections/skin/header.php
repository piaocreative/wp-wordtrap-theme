<?php
/**
 * The theme header skin options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'        => esc_html__( 'Header', 'wordtrap' ),
    'id'           => 'wordtrap-skin-header',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'            => 'header-bg',
        'type'          => 'color',
        'title'         => esc_html__( 'Background', 'wordtrap' ),
        'validate'      => 'color',
        'transparent'   => false,
        'default'       => '#ffffff'
      ),
      array(
        'id'            => 'header-logo-margin',
        'type'          => 'spacing',
        'mode'          => 'margin',
        'units'         => 'rem',
        'title'         => esc_html__( 'Logo Margin', 'wordtrap' ),
        'default'       => array(
          'margin-top'    => '1',
          'margin-right'  => '3',
          'margin-bottom' => '1',
          'margin-left'   => '0',
          'units'         => 'rem',
        ),
      ),
      // array(
      //   'id'            => 'logo-widths-start',
      //   'type'          => 'section',
      //   'title'         => esc_html__( 'Logo Max Widths based on Breakpoints', 'wordtrap' ),
      //   'indent'        => true,
      // ),
      array(
        'id'            => 'logo-width',
        'type'          => 'dimensions',
        'title'         => esc_html__( 'Logo Max Width', 'wordtrap' ),
        'height'        => false,
        'default'       => array(
          'width'       => 260
        ),
      ),
      // array(
      //   'id'            => 'logo-width-xl',
      //   'type'          => 'dimensions',
      //   'title'         => esc_html__( 'Extra Large', 'wordtrap' ),
      //   'height'        => false,
      //   'default'       => array(
      //     'width'       => 230
      //   ),
      // ),
      // array(
      //   'id'            => 'logo-width-lg',
      //   'type'          => 'dimensions',
      //   'title'         => esc_html__( 'Large', 'wordtrap' ),
      //   'height'        => false,
      //   'default'       => array(
      //     'width'       => 200
      //   ),
      // ),
      // array(
      //   'id'            => 'logo-width-md',
      //   'type'          => 'dimensions',
      //   'title'         => esc_html__( 'Medium', 'wordtrap' ),
      //   'height'        => false,
      //   'default'       => array(
      //     'width'       => 170
      //   ),
      // ),
      // array(
      //   'id'            => 'logo-width-sm',
      //   'type'          => 'dimensions',
      //   'title'         => esc_html__( 'Small', 'wordtrap' ),
      //   'height'        => false,
      //   'default'       => array(
      //     'width'       => 140
      //   ),
      // ),
      // array(
      //   'id'            => 'logo-width-xs',
      //   'type'          => 'dimensions',
      //   'title'         => esc_html__( 'X-Small', 'wordtrap' ),
      //   'height'        => false,
      //   'default'       => array(
      //     'width'       => 110
      //   ),
      // ),
      // array(
      //   'id'            => 'logo-widths-end',
      //   'type'          => 'section',
      //   'indent'        => false,
      // ),
      array(
        'id'            => 'header-navbar-color',
        'type'          => 'button_set',
        'title'         => esc_html__( 'Menu Color', 'wordtrap' ),
        'options'       => array(
          'light'       => esc_html__( 'Light', 'wordtrap' ),
          'dark'        => esc_html__( 'Dark', 'wordtrap' ),
        ),
        'default'       => 'light',
      ),
    )
  )
);