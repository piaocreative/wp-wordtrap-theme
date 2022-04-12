<?php
/**
 * The theme singular product options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'        => esc_html__( 'Singular', 'wordtrap' ),
    'id'           => 'wordtrap-woocommerce-singular',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'       => 'product-layout',
        'type'     => 'image_select',
        'title'    => esc_html__( 'Main Layout', 'wordtrap' ),
        'options'  => $main_layout_options,
        'default'  => 'left-sidebar',
      ),
      array(
        'id'       => 'product-left-sidebar',
        'type'     => 'select',
        'title'    => esc_html__( 'Left Sidebar', 'wordtrap' ),
        'required' => array( 'product-layout', 'equals', $main_layouts_with_left_sidebar ),
        'data'     => 'sidebars',
        'default'  => 'left-sidebar',
      ),
      array(
        'id'       => 'product-right-sidebar',
        'type'     => 'select',
        'title'    => esc_html__( 'Right Sidebar', 'wordtrap' ),
        'required' => array( 'product-layout', 'equals', $main_layouts_with_right_sidebar ),
        'data'     => 'sidebars',
        'default'  => 'right-sidebar',
      ),
      array(
        'id'       => 'product-view',
        'type'     => 'image_select',
        'title'    => esc_html__( 'View Type', 'wordtrap' ),
        'options'  => $product_view_options,
        'default'  => 'default'
      ),
      array(
        'id'       => 'product-share',
        'type'     => 'switch',
        'title'    => esc_html__( 'Social Share', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      // array(
      //   'id'       => 'product-navigation',
      //   'type'     => 'switch',
      //   'title'    => esc_html__( 'Prev / Next Navigation', 'wordtrap' ),
      //   'default'  => true,
      //   'on'       => esc_html__( 'Show', 'wordtrap' ),
      //   'off'      => esc_html__( 'Hide', 'wordtrap' ),
      // ),
      array(
        'id'       => 'product-related-start',
        'type'     => 'section',
        'title'    => esc_html__( 'Related Products', 'wordtrap' ),
        'indent'   => true,
      ),
      array(
        'id'       => 'product-related',
        'type'     => 'switch',
        'title'    => esc_html__( 'Related Products', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'product-related-count',
        'type'     => 'text',
        'required' => array( 'product-related', 'equals', true ),
        'title'    => esc_html__( 'Count', 'wordtrap' ),
        'validate' => array( 'numeric', 'not_empty' ),
        'default'  => '10',
      ),
      array(
        'id'       => 'product-related-columns',
        'type'     => 'slider',
        'required' => array( 'product-related', 'equals', true ),
        'title'    => esc_html__( 'Columns', 'wordtrap' ),
        'min'      => 2,
        'max'      => 6,
        'default'  => 4,
      ),
      array(
        'id'       => 'product-related-carousel',
        'type'     => 'switch',
        'title'    => esc_html__( 'Carousel', 'wordtrap' ),
        'required' => array( 'product-related', 'equals', true ),
        'default'  => true,
        'on'       => esc_html__( 'Enable', 'wordtrap' ),
        'off'      => esc_html__( 'Disable', 'wordtrap' ),
      ),
      array(
        'id'       => 'product-related-end',
        'type'     => 'section',
        'indent'   => false,
      ),
      array(
        'id'       => 'product-upsells-start',
        'type'     => 'section',
        'title'    => esc_html__( 'Up Sells', 'wordtrap' ),
        'indent'   => true,
      ),
      array(
        'id'       => 'product-upsells',
        'type'     => 'switch',
        'title'    => esc_html__( 'Up Sells', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'product-upsells-count',
        'type'     => 'text',
        'required' => array( 'product-upsells', 'equals', true ),
        'title'    => esc_html__( 'Count', 'wordtrap' ),
        'validate' => array( 'numeric', 'not_empty' ),
        'default'  => '10',
      ),
      array(
        'id'       => 'product-upsells-columns',
        'type'     => 'slider',
        'required' => array( 'product-upsells', 'equals', true ),
        'title'    => esc_html__( 'Columns', 'wordtrap' ),
        'min'      => 2,
        'max'      => 6,
        'default'  => 4,
      ),
      array(
        'id'       => 'product-upsells-carousel',
        'type'     => 'switch',
        'title'    => esc_html__( 'Carousel', 'wordtrap' ),
        'required' => array( 'product-upsells', 'equals', true ),
        'default'  => true,
        'on'       => esc_html__( 'Enable', 'wordtrap' ),
        'off'      => esc_html__( 'Disable', 'wordtrap' ),
      ),
      array(
        'id'       => 'product-upsells-end',
        'type'     => 'section',
        'indent'   => false,
      ),
    )
  )
);