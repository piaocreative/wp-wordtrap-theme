<?php
/**
 * The theme woocommerce general options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'        => esc_html__( 'General', 'wordtrap' ),
    'id'           => 'wordtrap-woocommerce-general',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'         => 'woo-login-popup',
        'type'       => 'switch',
        'title'      => esc_html__( 'Login Lightbox', 'wordtrap' ),
        'default'    => false,
        'on'         => esc_html__( 'Enable', 'wordtrap' ),
        'off'        => esc_html__( 'Disable', 'wordtrap' ),
      ),
      array(
        'id'         => 'woo-checkout-wizards',
        'type'       => 'switch',
        'title'      => esc_html__( 'Checkout Wizards', 'wordtrap' ),
        'default'    => true,
        'on'         => esc_html__( 'Show', 'wordtrap' ),
        'off'        => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'         => 'woo-widget-ratings',
        'type'       => 'switch',
        'title'      => esc_html__( 'Ratings in Widget', 'wordtrap' ),
        'default'    => true,
        'on'         => esc_html__( 'Show', 'wordtrap' ),
        'off'        => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'         => 'product-labels',
        'type'       => 'button_set',
        'title'      => esc_html__( 'Product Labels', 'wordtrap' ),
        'multi'      => true,
        'default'    => array( 'hot', 'sale' ),
        'options'    => array(
          'hot'      => esc_html__( 'Hot', 'wordtrap' ),
          'sale'     => esc_html__( 'Sale', 'wordtrap' ),
          'new'      => esc_html__( 'New', 'wordtrap' ),
        ),
      ),
      array(
        'id'         => 'product-hot',
        'type'       => 'text',
        'required'   => array( 'product-labels', 'contains', 'hot' ),
        'title'      => esc_html__( 'Hot Label', 'wordtrap' ),
        'desc'       => esc_html__( 'This will be displayed in the featured product.', 'wordtrap' ),
        'default'    => '',
      ),
      array(
        'id'         => 'product-sale',
        'type'       => 'text',
        'required'   => array( 'product-labels', 'contains', 'sale' ),
        'title'      => esc_html__( 'Sale Label', 'wordtrap' ),
        'desc'       => esc_html__( 'This will be displayed in the product on sale.', 'wordtrap' ),
        'default'    => '',
      ),
      array(
        'id'         => 'product-sale-percent',
        'type'       => 'switch',
        'required'   => array( 'product-labels', 'contains', 'sale' ),
        'title'      => esc_html__( 'Saved Sale Percentage', 'wordtrap' ),
        'default'    => true,
        'on'         => esc_html__( 'Show', 'wordtrap' ),
        'off'        => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'         => 'product-new',
        'type'       => 'text',
        'required'   => array( 'product-labels', 'contains', 'new' ),
        'title'      => esc_html__( 'New Label', 'wordtrap' ),
        'default'    => '',
      ),
      array(
        'id'         => 'product-new-days',
        'type'       => 'slider',
        'title'      => esc_html__( 'New Product Period (days)', 'wordtrap' ),
        'required'   => array( 'product-labels', 'contains', 'new' ),
        'default'    => 7,
        'min'        => 1,
        'max'        => 100,
      ),
    )
  )
);