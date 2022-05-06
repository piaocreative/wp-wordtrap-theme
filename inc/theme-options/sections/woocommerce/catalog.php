<?php
/**
 * The theme product catalog mode options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'        => esc_html__( 'Catalog', 'wordtrap' ),
    'id'           => 'wordtrap-woocommerce-catalog',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'       => 'catalog-enable',
        'type'     => 'switch',
        'title'    => esc_html__( 'Catalog Mode', 'wordtrap' ),
        'default'  => false,
        'on'       => esc_html__( 'Enable', 'wordtrap' ),
        'off'      => esc_html__( 'Disable', 'wordtrap' ),
      ),
      array(
        'id'       => 'catalog-price',
        'type'     => 'switch',
        'title'    => esc_html__( 'Price', 'wordtrap' ),
        'default'  => false,
        'required' => array( 'catalog-enable', 'equals', true ),
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'catalog-cart',
        'type'     => 'switch',
        'title'    => esc_html__( 'Add to Cart', 'wordtrap' ),
        'default'  => false,
        'required' => array( 'catalog-enable', 'equals', true ),
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'catalog-readmore',
        'type'     => 'switch',
        'title'    => esc_html__( 'Read More', 'wordtrap' ),
        'default'  => false,
        'required' => array( 'catalog-cart', 'equals', false ),
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'catalog-readmore-target',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Read More Target', 'wordtrap' ),
        'required' => array( 'catalog-readmore', 'equals', true ),
        'options'  => array(
          ''       => esc_html__( 'Self', 'wordtrap' ),
          '_blank' => esc_html__( 'Blank', 'wordtrap' ),
        ),
        'default'  => '',
      ),
      array(
        'id'       => 'catalog-readmore-label',
        'type'     => 'text',
        'required' => array( 'catalog-readmore', 'equals', true ),
        'title'    => esc_html__( 'Read More Label', 'wordtrap' ),
        'default'  => '',
      ),
      array(
        'id'       => 'catalog-rating',
        'type'     => 'switch',
        'title'    => esc_html__( 'Rating', 'wordtrap' ),
        'default'  => false,
        'required' => array( 'catalog-enable', 'equals', true ),
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
    )
  )
);