<?php
/**
 * The theme cart page options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'        => esc_html__( 'Cart', 'wordtrap' ),
    'id'           => 'wordtrap-woocommerce-cart',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'       => 'product-crosssells-start',
        'type'     => 'section',
        'title'    => esc_html__( 'Cross Sells', 'wordtrap' ),
        'indent'   => true,
      ),
      array(
        'id'       => 'product-crosssells',
        'type'     => 'switch',
        'title'    => esc_html__( 'Cross Sells', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'product-crosssells-count',
        'type'     => 'text',
        'required' => array( 'product-crosssells', 'equals', true ),
        'title'    => esc_html__( 'Count', 'wordtrap' ),
        'validate' => array( 'numeric', 'not_empty' ),
        'default'  => '10',
      ),
      array(
        'id'       => 'product-crosssells-columns',
        'type'     => 'slider',
        'required' => array( 'product-crosssells', 'equals', true ),
        'title'    => esc_html__( 'Columns', 'wordtrap' ),
        'min'      => 2,
        'max'      => 6,
        'default'  => 4,
      ),
      array(
        'id'       => 'product-crosssells-carousel',
        'type'     => 'switch',
        'title'    => esc_html__( 'Carousel', 'wordtrap' ),
        'required' => array( 'product-crosssells', 'equals', true ),
        'default'  => true,
        'on'       => esc_html__( 'Enable', 'wordtrap' ),
        'off'      => esc_html__( 'Disable', 'wordtrap' ),
      ),
      array(
        'id'       => 'product-crosssells-end',
        'type'     => 'section',
        'indent'   => false,
      ),
    )
  )
);