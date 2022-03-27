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
        // 'required'     => array( 'site-layout', 'equals', $site_layouts_without_boxed ),
        'options'      => $layout_options,
        'default'      => 'full',
      ),
      array(
        'id'           => 'footer-reveal',
        'type'         => 'switch',
        'title'        => esc_html__( 'Reveal Effect', 'wordtrap' ),
        'default'      => false,
        'on'           => esc_html__( 'Enable', 'wordtrap' ),
        'off'          => esc_html__( 'Disable', 'wordtrap' ),
      ),
      // array(
      //   'id'           => 'footer-ribbon-text',
      //   'type'         => 'text',
      //   'title'        => esc_html__( 'Ribbon Text', 'wordtrap' ),
      //   'default'      => '',
      // ),
      // array(
      //   'id'           => 'footer-ribbon-url',
      //   'type'         => 'text',
      //   'title'        => esc_html__( 'Ribbon URL', 'wordtrap' ),
      //   'validate'     => 'url',
      //   'default'      => '',
      // ),
    )
  )
);