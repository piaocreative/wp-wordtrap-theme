<?php
/**
 * The theme footer options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'            => esc_html__( 'Footer', 'wordtrap' ),
    'id'               => 'wordtrap-footer',
    'customizer_width' => '400px',
    'icon'             => 'dashicons-before dashicons-align-full-width el-rotate-180',
    'fields'           => array(
      array(
        'id'           => 'footer-layout',
        'type'         => 'image_select',
        'title'        => esc_html__( 'Footer Layout', 'wordtrap' ),
        'options'      => $layout_options,
        'default'      => 'wide',
      ),
      array(
        'id'           => 'footer-reveal',
        'type'         => 'switch',
        'title'        => esc_html__( 'Reveal Effect', 'wordtrap' ),
        'default'      => false,
        'on'           => esc_html__( 'Yes', 'wordtrap' ),
        'off'          => esc_html__( 'No', 'wordtrap' ),
      ),
    )
  )
);