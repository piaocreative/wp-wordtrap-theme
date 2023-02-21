<?php
/**
 * The theme skin color options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'        => esc_html__( 'Colors', 'wordtrap' ),
    'id'           => 'wordtrap-skin-colors',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'       => 'theme-colors-start',
        'type'     => 'section',
        'title'    => esc_html__( 'Theme Colors', 'wordtrap' ),
        'indent'   => true,
      ),
      array(
        'id'       => 'primary',
        'type'     => 'color',
        'title'    => esc_html__( 'Primary', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#3d98f4'
      ),
      array(
        'id'       => 'secondary',
        'type'     => 'color',
        'title'    => esc_html__( 'Secondary', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#6c757d'
      ),
      array(
        'id'       => 'success',
        'type'     => 'color',
        'title'    => esc_html__( 'Success', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#28a745'
      ),
      array(
        'id'       => 'info',
        'type'     => 'color',
        'title'    => esc_html__( 'Info', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#17a2b8'
      ),
      array(
        'id'       => 'warning',
        'type'     => 'color',
        'title'    => esc_html__( 'Warning', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#ffc107'
      ),
      array(
        'id'       => 'danger',
        'type'     => 'color',
        'title'    => esc_html__( 'Danger', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#dc3545'
      ),
      array(
        'id'       => 'light',
        'type'     => 'color',
        'title'    => esc_html__( 'Light', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#f8f9fa'
      ),
      array(
        'id'       => 'dark',
        'type'     => 'color',
        'title'    => esc_html__( 'Dark', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#212529'
      ),
      array(
        'id'       => 'theme-colors-end',
        'type'     => 'section',
        'indent'   => false,
      ),
      array(
        'id'       => 'grays-start',
        'type'     => 'section',
        'title'    => esc_html__( 'Grays', 'wordtrap' ),
        'indent'   => true,
      ),
      array(
        'id'       => 'white',
        'type'     => 'color',
        'title'    => esc_html__( 'White', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#ffffff'
      ),
      array(
        'id'       => 'gray-100',
        'type'     => 'color',
        'title'    => esc_html__( 'Gray 100', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#f8f9fa'
      ),
      array(
        'id'       => 'gray-200',
        'type'     => 'color',
        'title'    => esc_html__( 'Gray 200', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#e9ecef'
      ),
      array(
        'id'       => 'gray-300',
        'type'     => 'color',
        'title'    => esc_html__( 'Gray 300', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#dee2e6'
      ),
      array(
        'id'       => 'gray-400',
        'type'     => 'color',
        'title'    => esc_html__( 'Gray 400', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#ced4da'
      ),
      array(
        'id'       => 'gray-500',
        'type'     => 'color',
        'title'    => esc_html__( 'Gray 500', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#adb5bd'
      ),
      array(
        'id'       => 'gray-600',
        'type'     => 'color',
        'title'    => esc_html__( 'Gray 600', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#6c757d'
      ),
      array(
        'id'       => 'gray-700',
        'type'     => 'color',
        'title'    => esc_html__( 'Gray 700', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#495057'
      ),
      array(
        'id'       => 'gray-800',
        'type'     => 'color',
        'title'    => esc_html__( 'Gray 800', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#343a40'
      ),
      array(
        'id'       => 'gray-900',
        'type'     => 'color',
        'title'    => esc_html__( 'Gray 900', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#212529'
      ),
      array(
        'id'       => 'black',
        'type'     => 'color',
        'title'    => esc_html__( 'Black', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#000000'
      ),
      array(
        'id'       => 'grays-end',
        'type'     => 'section',
        'indent'   => false,
      ),
    )
  )
);