<?php
/**
 * The theme page options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'            => esc_html__( 'Page', 'wordtrap' ),
    'id'               => 'wordtrap-page',
    'customizer_width' => '400px',
    'icon'             => 'dashicons-before dashicons-admin-page',
    'fields'           => array(
      array(
        'id'            => 'page-comment',
        'type'          => 'switch',
        'title'         => esc_html__( 'Comments', 'wordtrap' ),
        'default'       => false,
        'on'            => esc_html__( 'Show', 'wordtrap' ),
        'off'           => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'            => 'page-share',
        'type'          => 'switch',
        'title'         => esc_html__( 'Social Share', 'wordtrap' ),
        'default'       => true,
        'on'            => esc_html__( 'Show', 'wordtrap' ),
        'off'           => esc_html__( 'Hide', 'wordtrap' ),
      ),
    )
  )
);