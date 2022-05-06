<?php
/**
 * The theme product image options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'        => esc_html__( 'Image', 'wordtrap' ),
    'id'           => 'wordtrap-woocommerce-image',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'       => 'product-thumbs-start',
        'type'     => 'section',
        'title'    => esc_html__( 'Thumbnails', 'wordtrap' ),
        'indent'   => true,
      ),
      array(
        'id'       => 'product-thumbs',
        'type'     => 'switch',
        'title'    => esc_html__( 'Thumbnails', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'product-thumbs-count',
        'type'     => 'text',
        'required' => array( 'product-thumbs', 'equals', true ),
        'title'    => esc_html__( 'Count', 'wordtrap' ),
        'validate' => array( 'numeric', 'not_empty' ),
        'default'  => '4',
      ),
      array(
        'id'       => 'product-thumbs-end',
        'type'     => 'section',
        'indent'   => false,
      ),
      array(
        'id'       => 'product-zoom-start',
        'type'     => 'section',
        'title'    => esc_html__( 'Image Zoom', 'wordtrap' ),
        'indent'   => true,
      ),
      array(
        'id'       => 'product-image-popup',
        'type'     => 'switch',
        'title'    => esc_html__( 'Image Popup', 'wordtrap' ),
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'product-zoom',
        'type'     => 'switch',
        'title'    => esc_html__( 'Image Zoom', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'product-zoom-type',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Zoom Type', 'wordtrap' ),
        'required' => array( 'product-zoom', 'equals', true ),
        'options'  => array(
          'inner'  => esc_html__( 'Inner', 'wordtrap' ),
          'lens'   => esc_html__( 'Lens', 'wordtrap' ),
        ),
        'default'  => 'inner',
      ),
      array(
        'id'       => 'product-zoom-scroll',
        'type'     => 'switch',
        'required' => array( 'product-zoom-type', 'equals', array( 'lens' ) ),
        'title'    => esc_html__( 'Scroll Zoom', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'product-zoom-lens-size',
        'type'     => 'slider',
        'required' => array( 'product-zoom-type', 'equals', array( 'lens' ) ),
        'title'    => esc_html__( 'Lens Size', 'wordtrap' ),
        'default'  => 200,
        'min'      => 100,
        'max'      => 600,
        'step'     => 50
      ),
      array(
        'id'       => 'product-zoom-lens-shape',
        'type'     => 'button_set',
        'required' => array( 'product-zoom-type', 'equals', array( 'lens' ) ),
        'title'    => esc_html__( 'Lens Shape', 'wordtrap' ),
        'options'  => array(
          'round'  => esc_html__( 'Round', 'wordtrap' ),
          'square' => esc_html__( 'Square', 'wordtrap' ),
        ),
        'default'  => 'square',
      ),
      array(
        'id'       => 'product-zoom-contain-lens',
        'type'     => 'switch',
        'required' => array( 'product-zoom-type', 'equals', array( 'lens' ) ),
        'title'    => esc_html__( 'Contain Lens Zoom', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'product-zoom-lens-border',
        'type'     => 'slider',
        'required' => array( 'product-zoom-type', 'equals', array( 'lens' ) ),
        'title'    => esc_html__( 'Lens Border', 'wordtrap' ),
        'default'  => 1,
        'min'      => 1,
        'max'      => 10,
      ),
      array(
        'id'       => 'product-zoom-border',
        'type'     => 'slider',
        'required' => array( 'product-zoom-type', 'equals', array( 'lens' ) ),
        'title'    => esc_html__( 'Border Size', 'wordtrap' ),
        'default'  => 4,
        'min'      => 1,
        'max'      => 10,
      ),
      array(
        'id'       => 'product-zoom-border-color',
        'type'     => 'color',
        'required' => array( 'product-zoom-type', 'equals', array( 'lens' ) ),
        'title'    => esc_html__( 'Border Color', 'wordtrap' ),
        'default'  => '#888888',
      ),
      array(
        'id'       => 'product-zoom-end',
        'type'     => 'section',
        'indent'   => false,
      ),
    )
  )
);