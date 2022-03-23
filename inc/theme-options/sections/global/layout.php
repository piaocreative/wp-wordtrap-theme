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
      // array(
      //   'id'       => 'site-layout',
      //   'type'     => 'image_select',
      //   'title'    => esc_html__( 'Site Layout', 'wordtrap' ),
      //   'options'  => $site_layout_options,
      //   'default'  => 'full',
      // ),
      array(
        'id'       => 'banner-layout',
        'type'     => 'image_select',
        'title'    => esc_html__( 'Banner Layout', 'wordtrap' ),
        // 'required' => array( 'site-layout', 'equals', $site_layouts_without_boxed ),
        'options'  => $banner_layout_options,
        'default'  => 'wide',
      ),
      array(
        'id'       => 'breadcrumbs-layout',
        'type'     => 'image_select',
        'title'    => esc_html__( 'Breadcrumbs Layout', 'wordtrap' ),
        // 'required' => array( 'site-layout', 'equals', $site_layouts_without_boxed ),
        'options'  => $layout_options,
        'default'  => 'boxed',
      ),
      array(
        'id'       => 'layout',
        'type'     => 'image_select',
        'title'    => esc_html__( 'Main Layout', 'wordtrap' ),
        'options'  => $main_layout_options,
        'default'  => 'right-sidebar',
      ),
      // array(
      //   'id'       => 'content-layout',
      //   'type'     => 'image_select',
      //   'title'    => esc_html__( 'Content Layout', 'wordtrap' ),
      //   'required' => array( 'site-layout', 'equals', $site_layouts_without_boxed ),
      //   'options'  => $content_layout_options,
      //   'default'  => 'boxed',
      // ),
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
      array(
        'id'       => 'show-mobile-sidebar',
        'type'     => 'switch',
        'title'    => esc_html__( 'Show Sidebar in Navigation on Mobile', 'wordtrap' ),
        'desc'     => esc_html__( 'Show sidebar toggle button only which leads to the sidebar on the left side of the window.', 'wordtrap' ),
        'default'  => false,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'footer-layout',
        'type'     => 'image_select',
        'title'    => esc_html__( 'Footer Layout', 'wordtrap' ),
        // 'required' => array( 'site-layout', 'equals', $site_layouts_without_boxed ),
        'options'  => $layout_options,
        'default'  => 'boxed',
      ),      
    ),
  )
);
