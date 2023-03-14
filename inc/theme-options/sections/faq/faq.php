<?php
/**
 * The theme faq options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'            => esc_html__( 'FAQ', 'wordtrap' ),
    'id'               => 'wordtrap-faq',
    'customizer_width' => '400px',
    'icon'             => 'dashicons-before dashicons-editor-help',
    'fields'           => array(
      array(
        'id'          => 'enable-faq',
        'type'        => 'switch',
        'title'       => esc_html__( 'Enable FAQ', 'wordtrap' ),
        'default'     => true,
        'on'          => esc_html__( 'Yes', 'wordtrap' ),
        'off'         => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'          => 'faq-slug-name',
        'type'        => 'text',
        'title'       => esc_html__( 'Slug Name', 'wordtrap' ),
        'placeholder' => 'faq',
      ),
      array(
        'id'          => 'faq-name',
        'type'        => 'text',
        'title'       => esc_html__( 'Name', 'wordtrap' ),
        'placeholder' => esc_html__( 'FAQs', 'wordtrap' ),
      ),
      array(
        'id'          => 'faq-singular-name',
        'type'        => 'text',
        'title'       => esc_html__( 'Singular Name', 'wordtrap' ),
        'placeholder' => esc_html__( 'FAQ', 'wordtrap' ),
      ),
      array(
        'id'          => 'faq-cat-slug-name',
        'type'        => 'text',
        'title'       => esc_html__( 'Category Slug Name', 'wordtrap' ),
        'placeholder' => 'faq_category',
      ),
      array(
        'id'          => 'faq-cat-name',
        'type'        => 'text',
        'title'       => esc_html__( 'Category Name', 'wordtrap' ),
        'placeholder' => 'FAQ Category',
      ),
      array(
        'id'          => 'faq-cats-name',
        'type'        => 'text',
        'title'       => esc_html__( 'Categories Name', 'wordtrap' ),
        'placeholder' => 'FAQ Categories',
      ),
      array(
        'id'          => 'faqs-page',
        'type'        => 'select',
        'data'        => 'page',
        'title'       => esc_html__( 'FAQs Page', 'wordtrap' ),
      ),
      array(
        'id'          => 'faqs-layout',
        'type'        => 'image_select',
        'title'       => esc_html__( 'Main Layout', 'wordtrap' ),
        'options'     => $main_layout_options,
        'default'     => 'without-sidebars',
      ),
      array(
        'id'          => 'faqs-left-sidebar',
        'type'        => 'select',
        'title'       => esc_html__( 'Left Sidebar', 'wordtrap' ),
        'required'    => array( 'faqs-layout', 'equals', $main_layouts_with_left_sidebar ),
        'data'        => 'sidebars',
        'default'     => 'left-sidebar',
      ),
      array(
        'id'          => 'faqs-right-sidebar',
        'type'        => 'select',
        'title'       => esc_html__( 'Right Sidebar', 'wordtrap' ),
        'required'    => array( 'faqs-layout', 'equals', $main_layouts_with_right_sidebar ),
        'data'        => 'sidebars',
        'default'     => 'right-sidebar',
      ),
      array(
        'id'          => 'faqs-cat-orderby',
        'type'        => 'button_set',
        'title'       => esc_html__( 'Categories Order By', 'wordtrap' ),
        'options'     => $cats_orderby_options,
        'default'     => 'name',
      ),
      array(
        'id'          => 'faqs-cat-order',
        'type'        => 'button_set',
        'title'       => esc_html__( 'Categories Order', 'wordtrap' ),
        'options'     => $cats_order_options,
        'default'     => 'asc',
      ),
      array(
        'id'          => 'faqs-orderby',
        'type'        => 'button_set',
        'title'       => esc_html__( 'FAQs Order By', 'wordtrap' ),
        'options'     => $singular_orderby_options,
        'default'     => '',
      ),
      array(
        'id'          => 'faqs-order',
        'type'        => 'button_set',
        'title'       => esc_html__( 'FAQs Order', 'wordtrap' ),
        'options'     => $singular_order_options,
        'default'     => 'desc',
      ),
    )
  )
);