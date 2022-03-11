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
        'id'        => 'products-view-mode',
        'type'      => 'button_set',
        'title'     => esc_html__( 'View Mode', 'wordtrap' ),
        'options'   => $products_view_mode_options,
        'default'   => ''
      ),
      array(
        'id'       => 'products-pagination',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Pagination style', 'wordtrap' ),
        'default'  => '',
        'options'  => $pagination_options,
      ),
    )
  )
);