<?php
/**
 * The theme post archive options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'        => esc_html__( 'Archive', 'wordtrap' ),
    'id'           => 'wordtrap-post-archive',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'       => 'posts-layout',
        'type'     => 'image_select',
        'title'    => esc_html__( 'Main Layout', 'wordtrap' ),
        'options'  => $main_layout_options,
        'default'  => 'right-sidebar',
      ),
      array(
        'id'       => 'posts-left-sidebar',
        'type'     => 'select',
        'title'    => esc_html__( 'Left Sidebar', 'wordtrap' ),
        'required' => array( 'posts-layout', 'equals', $main_layouts_with_left_sidebar ),
        'data'     => 'sidebars',
        'default'  => 'left-sidebar',
      ),
      array(
        'id'       => 'posts-right-sidebar',
        'type'     => 'select',
        'title'    => esc_html__( 'Right Sidebar', 'wordtrap' ),
        'required' => array( 'posts-layout', 'equals', $main_layouts_with_right_sidebar ),
        'data'     => 'sidebars',
        'default'  => 'right-sidebar',
      ),
      array(
        'id'       => 'posts-sort',
        'type'     => 'switch',
        'title'    => esc_html__( 'Sort', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Enable', 'wordtrap' ),
        'off'      => esc_html__( 'Disable', 'wordtrap' ),
      ),
      array(
        'id'       => 'posts-show-count',
        'type'     => 'switch',
        'title'    => esc_html__( 'Show Posts per Page', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'posts-counts',
        'type'     => 'multi_text',
        'title'    => esc_html__( 'Posts per Page', 'wordtrap' ),
        'validate' => array( 'numeric', 'not_empty' ),
        'required' => array( 'posts-show-count', 'equals', true ),
        'default'  => ['12', '24', '36'],
      ),
      array(
        'id'       => 'posts-view-mode',
        'type'     => 'switch',
        'title'    => esc_html__( 'Show View Mode', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'posts-default-view-mode',
        'type'     => 'switch',
        'title'    => esc_html__( 'Default View Mode', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Grid', 'wordtrap' ),
        'off'      => esc_html__( 'List', 'wordtrap' ),
      ),
      array(
        'id'       => 'posts-grid-view',
        'type'     => 'image_select',
        'title'    => esc_html__( 'Grid View Type', 'wordtrap' ),
        'options'  => $posts_grid_layout_options,
        'default'  => 'grid',
      ),
      array(
        'id'       => 'posts-grid-columns-start',
        'type'     => 'section',
        'title'    => esc_html__( 'Grid View Columns', 'wordtrap' ),
        'required' => array( 'posts-grid-view', 'equals', array( 'grid', 'masonry' ) ),
        'indent'   => true,
      ),
      array(
        'id'       => 'posts-grid-columns-xxl',
        'type'     => 'slider',
        'title'    => esc_html__( 'Extra Extra Large', 'wordtrap' ),
        'required' => array( 'posts-grid-view', 'equals', array( 'grid', 'masonry' ) ),
        'default'   => 3,
        'min'       => 2,
        'max'       => 6,
      ),
      array(
        'id'       => 'posts-grid-columns-xl',
        'type'     => 'slider',
        'title'    => esc_html__( 'Extra Large', 'wordtrap' ),
        'required' => array( 'posts-grid-view', 'equals', array( 'grid', 'masonry' ) ),
        'default'   => 2,
        'min'       => 2,
        'max'       => 5,
      ),
      array(
        'id'       => 'posts-grid-columns-lg',
        'type'     => 'slider',
        'title'    => esc_html__( 'Large', 'wordtrap' ),
        'required' => array( 'posts-grid-view', 'equals', array( 'grid', 'masonry' ) ),
        'default'   => 2,
        'min'       => 1,
        'max'       => 4,
      ),
      array(
        'id'       => 'posts-grid-columns-md',
        'type'     => 'slider',
        'title'    => esc_html__( 'Medium', 'wordtrap' ),
        'required' => array( 'posts-grid-view', 'equals', array( 'grid', 'masonry' ) ),
        'default'   => 1,
        'min'       => 1,
        'max'       => 3,
      ),
      array(
        'id'       => 'posts-grid-columns-sm',
        'type'     => 'slider',
        'title'    => esc_html__( 'Small', 'wordtrap' ),
        'required' => array( 'posts-grid-view', 'equals', array( 'grid', 'masonry' ) ),
        'default'   => 1,
        'min'       => 1,
        'max'       => 2,
      ),
      array(
        'id'       => 'posts-grid-columns-end',
        'type'     => 'section',
        'required' => array( 'posts-grid-view', 'equals', array( 'grid', 'masonry' ) ),
        'indent'   => false,
      ),
      array(
        'id'       => 'posts-list-view',
        'type'     => 'image_select',
        'title'    => esc_html__( 'List View Type', 'wordtrap' ),
        'options'  => $posts_list_layout_options,
        'default'  => 'full',
      ),
      array(
        'id'       => 'posts-featured-image',
        'type'     => 'switch',
        'title'    => esc_html__( 'Featured Image', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'posts-format',
        'type'     => 'switch',
        'title'    => esc_html__( 'Post Format', 'wordtrap' ),
        'required' => array( 'posts-featured-image', 'equals', true ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'posts-title',
        'type'     => 'switch',
        'title'    => esc_html__( 'Title', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'posts-share',
        'type'     => 'switch',
        'title'    => esc_html__( 'Social Share', 'wordtrap' ),
        'default'  => false,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'posts-pagination',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Pagination', 'wordtrap' ),
        'options'  => $pagination_options,
        'default'  => '',
      ),      
    )
  )
);