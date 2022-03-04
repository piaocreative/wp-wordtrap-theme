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
		'id'           => 'wordtrap-layout',
		'subsection'   => true,
		'fields'       => array(
			array(
				'id'       => 'loading-overlay',
				'type'     => 'switch',
				'title'    => esc_html__( 'Loading Overlay', 'wordtrap' ),
        'desc'     => __( 'Loading overlay is shown until whole page is loaded.', 'wordtrap' ),
				'default'  => false,
        'on'       => __( 'Show', 'wordtrap' ),
        'off'      => __( 'Hide', 'wordtrap' ),
			),
			array(
        'id'       => 'site-layout',
        'type'     => 'image_select',
        'title'    => __( 'Site Layout', 'wordtrap' ),
        'options'  => $site_layout_options,
        'default'  => 'full',
      ),
      array(
        'id'       => 'header-layout',
        'type'     => 'image_select',
        'title'    => __( 'Header Layout', 'wordtrap' ),
        'required' => array( 'site-layout', 'equals', $site_layouts_without_boxed ),
        'options'  => $layout_options,
        'default'  => 'full',
      ),
      array(
        'id'       => 'banner-layout',
        'type'     => 'image_select',
        'title'    => __( 'Banner Layout', 'wordtrap' ),
        'required' => array( 'site-layout', 'equals', $site_layouts_without_boxed ),
        'options'  => $banner_layout_options,
        'default'  => 'wide',
      ),
      array(
        'id'       => 'breadcrumbs-layout',
        'type'     => 'image_select',
        'title'    => __( 'Breadcrumbs Layout', 'wordtrap' ),
        'required' => array( 'site-layout', 'equals', $site_layouts_without_boxed ),
        'options'  => $layout_options,
        'default'  => 'full',
      ),
      array(
        'id'       => 'layout',
        'type'     => 'image_select',
        'title'    => __( 'Main Layout', 'wordtrap' ),
        'options'  => $main_layout_options,
        'default'  => 'right-sidebar',
      ),
      array(
        'id'       => 'content-layout',
        'type'     => 'image_select',
        'title'    => __( 'Content Layout', 'wordtrap' ),
        'required' => array( 'site-layout', 'equals', $site_layouts_without_boxed ),
        'options'  => $content_layout_options,
        'default'  => 'wide',
      ),
      array(
        'id'       => 'sidebar',
        'type'     => 'select',
        'title'    => __( 'Primary Sidebar', 'wordtrap' ),
        'required' => array( 'layout', 'equals', $main_layouts_with_sidebar ),
        'data'     => 'sidebars',
        'default'  => 'primary-sidebar',
      ),
      array(
        'id'       => 'sidebar2',
        'type'     => 'select',
        'title'    => __( 'Secondary Sidebar', 'wordtrap' ),
        'required' => array( 'layout', 'equals', $main_layouts_with_both_sidebars ),
        'data'     => 'sidebars',
        'default'  => 'secondary-sidebar',
      ),
      array(
        'id'       => 'sticky-sidebar',
        'type'     => 'switch',
        'title'    => __( 'Sticky Sidebar', 'wordtrap' ),
        'default'  => false,
        'on'       => __( 'Enable', 'wordtrap' ),
        'off'      => __( 'Disable', 'wordtrap' ),
      ),
      array(
        'id'       => 'show-mobile-sidebar',
        'type'     => 'switch',
        'title'    => __( 'Show Sidebar in Navigation on Mobile', 'wordtrap' ),
        'desc'     => __( 'Show sidebar toggle button only which leads to the sidebar on the left side of the window.', 'wordtrap' ),
        'default'  => false,
        'on'       => __( 'Yes', 'wordtrap' ),
        'off'      => __( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'footer-layout',
        'type'     => 'image_select',
        'title'    => __( 'Footer Layout', 'wordtrap' ),
        'required' => array( 'site-layout', 'equals', $site_layouts_without_boxed ),
        'options'  => $layout_options,
        'default'  => 'full',
      ),      
		),
	)
);
