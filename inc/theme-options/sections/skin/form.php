<?php
/**
 * The form skin options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'        => esc_html__( 'Form', 'wordtrap' ),
    'id'           => 'wordtrap-skin-form',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'            => 'input-bg',
        'type'          => 'color',
        'title'         => esc_html__( 'Input Background', 'wordtrap' ),
        'validate'      => 'color',
        'transparent'   => false,
        'default'       => '#f5f5f5'
      ),

      array(
        'id'            => 'input-border-color',
        'type'          => 'color',
        'title'         => esc_html__( 'Input Border Color', 'wordtrap' ),
        'validate'      => 'color',
        'transparent'   => false,
        'default'       => '#f5f5f5'
      ),
    )
  )
);