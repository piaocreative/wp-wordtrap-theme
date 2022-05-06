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
        'id'       => 'products-sort',
        'type'     => 'switch',
        'title'    => esc_html__( 'Sort', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Enable', 'wordtrap' ),
        'off'      => esc_html__( 'Disable', 'wordtrap' ),
      ),
      array(
        'id'       => 'products-show-count',
        'type'     => 'switch',
        'title'    => esc_html__( 'Show Products per Page', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'products-counts',
        'type'     => 'multi_text',
        'title'    => esc_html__( 'Products per Page', 'wordtrap' ),
        'required' => array( 'products-show-count', 'equals', true ),
        'validate' => array( 'numeric', 'not_empty' ),
        'default'  => ['12', '24', '36'],
      ),
      array(
        'id'       => 'products-view-mode',
        'type'     => 'switch',
        'title'    => esc_html__( 'Show View Mode', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'products-default-view-mode',
        'type'     => 'switch',
        'title'    => esc_html__( 'Default View Mode', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Grid', 'wordtrap' ),
        'off'      => esc_html__( 'List', 'wordtrap' ),
      ),
      array(
        'id'       => 'products-pagination',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Pagination style', 'wordtrap' ),
        'default'  => '',
        'options'  => $pagination_options,
      ),
      array(
        'id'       => 'products-grid-columns-start',
        'type'     => 'section',
        'title'    => esc_html__( 'Grive View Columns', 'wordtrap' ),
        'indent'   => true,
      ),
      array(
        'id'       => 'products-grid-columns-xxl',
        'type'     => 'slider',
        'title'    => esc_html__( 'Extra Extra Large', 'wordtrap' ),
        'default'   => 3,
        'min'       => 2,
        'max'       => 6,
      ),
      array(
        'id'       => 'products-grid-columns-xl',
        'type'     => 'slider',
        'title'    => esc_html__( 'Extra Large', 'wordtrap' ),
        'default'   => 2,
        'min'       => 2,
        'max'       => 5,
      ),
      array(
        'id'       => 'products-grid-columns-lg',
        'type'     => 'slider',
        'title'    => esc_html__( 'Large', 'wordtrap' ),
        'default'   => 2,
        'min'       => 1,
        'max'       => 4,
      ),
      array(
        'id'       => 'products-grid-columns-md',
        'type'     => 'slider',
        'title'    => esc_html__( 'Medium', 'wordtrap' ),
        'default'   => 1,
        'min'       => 1,
        'max'       => 3,
      ),
      array(
        'id'       => 'products-grid-columns-sm',
        'type'     => 'slider',
        'title'    => esc_html__( 'Small', 'wordtrap' ),
        'default'   => 1,
        'min'       => 1,
        'max'       => 2,
      ),
      array(
        'id'       => 'products-grid-columns-end',
        'type'     => 'section',
        'indent'   => false,
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
        'id'       => 'products-categories',
        'type'     => 'switch',
        'title'    => esc_html__( 'Categories', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'products-add-to-cart',
        'type'     => 'switch',
        'title'    => esc_html__( 'Add to Cart', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),      
      array(
        'id'       => 'products-cart-notify',
        'type'     => 'image_select',
        'title'    => esc_html__( 'Cart Notification', 'wordtrap' ),
        'options'  => $products_cart_notify_options,
        'default'  => 'default'
      ),
      array(
        'id'       => 'products-item-end',
        'type'     => 'section',
        'indent'   => false,
      ),
    )
  )
);