<?php
/**
 * The theme woocommerce archive options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'        => esc_html__( 'Archive', 'wordtrap' ),
    'id'           => 'wordtrap-woocommerce-archive',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'       => 'products-layout',
        'type'     => 'image_select',
        'title'    => esc_html__( 'Main Layout', 'wordtrap' ),
        'options'  => $main_layout_options,
        'default'  => 'left-sidebar',
      ),
      array(
        'id'       => 'products-left-sidebar',
        'type'     => 'select',
        'title'    => esc_html__( 'Left Sidebar', 'wordtrap' ),
        'required' => array( 'products-layout', 'equals', $main_layouts_with_left_sidebar ),
        'data'     => 'sidebars',
        'default'  => 'left-sidebar',
      ),
      array(
        'id'       => 'products-right-sidebar',
        'type'     => 'select',
        'title'    => esc_html__( 'Right Sidebar', 'wordtrap' ),
        'required' => array( 'products-layout', 'equals', $main_layouts_with_right_sidebar ),
        'data'     => 'sidebars',
        'default'  => 'right-sidebar',
      ),
      array(
        'id'       => 'products-count',
        'type'     => 'multi_text',
        'title'    => esc_html__( 'Products per Page', 'wordtrap' ),
        'validate' => array( 'numeric', 'not_empty' ),
        'default'  => ['12', '24', '36'],
      ),
      array(
        'id'       => 'products-view-mode',
        'type'     => 'button_set',
        'title'    => esc_html__( 'View Mode', 'wordtrap' ),
        'options'  => $products_view_mode_options,
        'default'  => ''
      ),
      array(
        'id'       => 'products-columns',
        'type'     => 'slider',
        'title'    => esc_html__( 'Grid Columns', 'wordtrap' ),
        'default'  => 3,
        'min'      => 2,
        'max'      => 8,
      ),
      array(
        'id'       => 'products-pagination',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Pagination style', 'wordtrap' ),
        'default'  => '',
        'options'  => $pagination_options,
      ),
      array(
        'id'       => 'products-item-start',
        'type'     => 'section',
        'title'    => esc_html__( 'Product', 'wordtrap' ),
        'indent'   => true,
      ),
      array(
        'id'       => 'products-view',
        'type'     => 'image_select',
        'title'    => esc_html__( 'View Type', 'wordtrap' ),
        'options'  => $products_view_options,
        'default'  => 'default'
      ),
      array(
        'id'       => 'products-cart-notify',
        'type'     => 'image_select',
        'title'    => esc_html__( 'Cart Notification', 'wordtrap' ),
        'options'  => $products_cart_notify_options,
        'default'  => '1'
      ),
      array(
        'id'       => 'products-variation',
        'type'     => 'switch',
        'title'    => esc_html__( 'Variation', 'wordtrap' ),
        'default'  => false,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'product-categories',
        'type'     => 'switch',
        'title'    => esc_html__( 'Categories', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'products-rating',
        'type'     => 'switch',
        'title'    => esc_html__( 'Rating', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'products-price',
        'type'     => 'switch',
        'title'    => esc_html__( 'Price', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'products-description',
        'type'     => 'switch',
        'title'    => esc_html__( 'Description', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'products-wishlist',
        'type'     => 'switch',
        'title'    => esc_html__( 'Wishlist', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'products-quickview',
        'type'     => 'switch',
        'title'    => esc_html__( 'Quick View', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'products-quickview-label',
        'type'     => 'text',
        'required' => array( 'products-quickview', 'equals', true ),
        'title'    => esc_html__( 'Quick View Label', 'wordtrap' ),
        'default'  => '',
      ),
      array(
        'id'       => 'products-compare',
        'type'     => 'switch',
        'title'    => esc_html__( 'Compare', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'products-item-end',
        'type'     => 'section',
        'indent'   => false,
      ),
    )
  )
);