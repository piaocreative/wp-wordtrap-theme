<?php
/**
 * The theme layout options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'        => esc_html__( 'Layout', 'wordtrap' ),
    'id'           => 'wordtrap-global-layout',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'       => 'loading-overlay',
        'type'     => 'switch',
        'title'    => esc_html__( 'Loading Overlay', 'wordtrap' ),
        'desc'     => esc_html__( 'Loading overlay is shown until whole page is loaded.', 'wordtrap' ),
        'default'  => false,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'page-header-layout',
        'type'     => 'image_select',
        'title'    => __( 'Page Title & Breadcrumbs', 'wordtrap' ),
        'options'  => $page_header_layout_options,
        'default'  => 'boxed',
      ),
      array(
        'id'       => 'layout',
        'type'     => 'image_select',
        'title'    => esc_html__( 'Main Layout', 'wordtrap' ),
        'options'  => $main_layout_options,
        'default'  => 'right-sidebar',
      ),
      array(
        'id'       => 'left-sidebar',
        'type'     => 'select',
        'title'    => esc_html__( 'Left Sidebar', 'wordtrap' ),
        'required' => array( 'layout', 'equals', $main_layouts_with_left_sidebar ),
        'data'     => 'sidebars',
        'default'  => 'left-sidebar',
      ),
      array(
        'id'       => 'right-sidebar',
        'type'     => 'select',
        'title'    => esc_html__( 'Right Sidebar', 'wordtrap' ),
        'required' => array( 'layout', 'equals', $main_layouts_with_right_sidebar ),
        'data'     => 'sidebars',
        'default'  => 'right-sidebar',
      ),
      array(
        'id'       => 'sticky-sidebar',
        'type'     => 'switch',
        'title'    => esc_html__( 'Sticky Sidebar', 'wordtrap' ),
        'default'  => false,
        'on'       => esc_html__( 'Enable', 'wordtrap' ),
        'off'      => esc_html__( 'Disable', 'wordtrap' ),
      ),
    ),
  )
);
