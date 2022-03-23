<?php
/**
 * The theme body skin options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'        => esc_html__( 'Body', 'wordtrap' ),
    'id'           => 'wordtrap-skin-body',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'       => 'body-color',
        'type'     => 'color',
        'title'    => esc_html__( 'Text', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#393939'
      ),
      array(
        'id'       => 'body-bg',
        'type'     => 'color',
        'title'    => esc_html__( 'Background', 'wordtrap' ),
        'validate' => 'color',
        'transparent' => false,
        'default'  => '#f5f5f5'
      ),
    )
  )
);