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
        'id'       => 'product-cross-sells-start',
        'type'     => 'section',
        'title'    => esc_html__( 'Cross-sells', 'wordtrap' ),
        'indent'   => true,
      ),
      array(
        'id'       => 'product-cross-sells',
        'type'     => 'switch',
        'title'    => esc_html__( 'Cross-sells', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'product-cross-sells-count',
        'type'     => 'text',
        'required' => array( 'product-cross-sells', 'equals', true ),
        'title'    => esc_html__( 'Count', 'wordtrap' ),
        'validate' => array( 'numeric', 'not_empty' ),
        'default'  => '6',
      ),
      array(
        'id'       => 'product-cross-sells-carousel',
        'type'     => 'switch',
        'title'    => esc_html__( 'Carousel', 'wordtrap' ),
        'required' => array( 'product-cross-sells', 'equals', true ),
        'default'  => true,
        'on'       => esc_html__( 'Enable', 'wordtrap' ),
        'off'      => esc_html__( 'Disable', 'wordtrap' ),
      ),
      array(
        'id'       => 'product-cross-sells-end',
        'type'     => 'section',
        'indent'   => false,
      ),
      array(
        'id'       => 'product-cross-sells-columns-start',
        'type'     => 'section',
        'title'    => esc_html__( 'Cross-sells Columns', 'wordtrap' ),
        'required' => array( 'product-cross-sells', 'equals', true ),
        'indent'   => true,
      ),
      array(
        'id'       => 'product-cross-sells-columns-xxl',
        'type'     => 'slider',
        'required' => array( 'product-cross-sells', 'equals', true ),
        'title'    => esc_html__( 'Extra Extra Large', 'wordtrap' ),
        'default'  => 3,
        'min'      => 2,
        'max'      => 6,
      ),
      array(
        'id'       => 'product-cross-sells-columns-xl',
        'type'     => 'slider',
        'required' => array( 'product-cross-sells', 'equals', true ),
        'title'    => esc_html__( 'Extra Large', 'wordtrap' ),
        'default'  => 2,
        'min'      => 2,
        'max'      => 5,
      ),
      array(
        'id'       => 'product-cross-sells-columns-lg',
        'type'     => 'slider',
        'required' => array( 'product-cross-sells', 'equals', true ),
        'title'    => esc_html__( 'Large', 'wordtrap' ),
        'default'  => 2,
        'min'      => 1,
        'max'      => 4,
      ),
      array(
        'id'       => 'product-cross-sells-columns-md',
        'type'     => 'slider',
        'required' => array( 'product-cross-sells', 'equals', true ),
        'title'    => esc_html__( 'Medium', 'wordtrap' ),
        'default'  => 1,
        'min'      => 1,
        'max'      => 3,
      ),
      array(
        'id'       => 'product-cross-sells-columns-sm',
        'type'     => 'slider',
        'required' => array( 'product-cross-sells', 'equals', true ),
        'title'    => esc_html__( 'Small', 'wordtrap' ),
        'default'  => 1,
        'min'      => 1,
        'max'      => 2,
      ),
      array(
        'id'       => 'product-cross-sells-columns-end',
        'type'     => 'section',
        'required' => array( 'product-cross-sells', 'equals', true ),
        'indent'   => false,
      ),
    )
  )
);