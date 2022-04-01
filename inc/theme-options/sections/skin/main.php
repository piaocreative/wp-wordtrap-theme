<?php
/**
 * The theme main content skin options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'        => esc_html__( 'Main', 'wordtrap' ),
    'id'           => 'wordtrap-skin-main',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'            => 'main-bg',
        'type'          => 'color',
        'title'         => esc_html__( 'Background', 'wordtrap' ),
        'validate'      => 'color',
        'transparent'   => false,
        'default'       => '#f5f5f5'
      ),

      array(
        'id'            => 'section-bg',
        'type'          => 'color',
        'title'         => esc_html__( 'Section Background', 'wordtrap' ),
        'validate'      => 'color',
        'transparent'   => false,
        'default'       => '#ffffff'
      ),      
    )
  )
);