<?php
/**
 * The theme member archive options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'        => esc_html__( 'Archive', 'wordtrap' ),
    'id'           => 'wordtrap-member-archive',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'       => 'members-layout',
        'type'     => 'image_select',
        'title'    => esc_html__( 'Main Layout', 'wordtrap' ),
        'options'  => $main_layout_options,
        'default'  => 'without-sidebars',
      ),
      array(
        'id'       => 'members-left-sidebar',
        'type'     => 'select',
        'title'    => esc_html__( 'Left Sidebar', 'wordtrap' ),
        'required' => array( 'members-layout', 'equals', $main_layouts_with_left_sidebar ),
        'data'     => 'sidebars',
        'default'  => 'left-sidebar',
      ),
      array(
        'id'       => 'members-right-sidebar',
        'type'     => 'select',
        'title'    => esc_html__( 'Right Sidebar', 'wordtrap' ),
        'required' => array( 'members-layout', 'equals', $main_layouts_with_right_sidebar ),
        'data'     => 'sidebars',
        'default'  => 'right-sidebar',
      ),
      array(
        'id'       => 'members-cat-orderby',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Categories Order By', 'wordtrap' ),
        'options'  => $cats_orderby_options,
        'default'  => 'name',
      ),
      array(
        'id'       => 'members-cat-order',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Categories Order', 'wordtrap' ),
        'options'  => $cats_order_options,
        'default'  => 'asc',
      ),
      array(
        'id'       => 'members-view',
        'type'     => 'image_select',
        'title'    => esc_html__( 'View Type', 'wordtrap' ),
        'default'  => '1',
        'options'  => $members_view_options
      ),
      array(
        'id'       => 'members-readmore',
        'type'     => 'switch',
        'title'    => esc_html__( 'Read More Link', 'wordtrap' ),
        'default'  => false,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'members-readmore-label',
        'type'     => 'text',
        'title'    => esc_html__( 'Read More Label', 'wordtrap' ),
        'required' => array( 'members-readmore', 'equals', true ),
        'placeholder' => esc_html__( 'View More...', 'wordtrap' ),
      ),
      array(
        'id'       => 'members-overview',
        'type'     => 'switch',
        'title'    => esc_html__( 'Overview', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'members-excerpt',
        'type'     => 'switch',
        'title'    => esc_html__( 'Overview Excerpt', 'wordtrap' ),
        'required' => array( 'members-overview', 'equals', true ),
        'default'  => true,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'members-excerpt-length',
        'type'     => 'text',
        'required' => array( 'members-excerpt', 'equals', true ),
        'title'    => esc_html__( 'Excerpt Length', 'wordtrap' ),
        'desc'     => esc_html__( 'The number of words', 'wordtrap' ),
        'default'  => '15',
      ),
      array(
        'id'       => 'members-socials',
        'type'     => 'switch',
        'title'    => esc_html__( 'Social Links', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'members-show-count',
        'type'     => 'switch',
        'title'    => esc_html__( 'Show Members per Page', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'members-counts',
        'type'     => 'multi_text',
        'title'    => esc_html__( 'Members per Page', 'wordtrap' ),
        'validate' => array( 'numeric', 'not_empty' ),
        'required' => array( 'members-show-count', 'equals', true ),
        'default'  => ['12', '24', '36'],
      ),
      array(
        'id'       => 'members-view-mode',
        'type'     => 'switch',
        'title'    => esc_html__( 'Show View Mode', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'members-default-view-mode',
        'type'     => 'switch',
        'title'    => esc_html__( 'Default View Mode', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Grid', 'wordtrap' ),
        'off'      => esc_html__( 'List', 'wordtrap' ),
      ),
      array(
        'id'       => 'members-default-view-mode',
        'type'     => 'switch',
        'title'    => esc_html__( 'Default View Mode', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Grid', 'wordtrap' ),
        'off'      => esc_html__( 'List', 'wordtrap' ),
      ),
      array(
        'id'       => 'members-grid-columns-start',
        'type'     => 'section',
        'title'    => esc_html__( 'Grive View Columns', 'wordtrap' ),
        'indent'   => true,
      ),
      array(
        'id'       => 'members-grid-columns-xxl',
        'type'     => 'slider',
        'title'    => esc_html__( 'Extra Extra Large', 'wordtrap' ),
        'default'   => 4,
        'min'       => 2,
        'max'       => 6,
      ),
      array(
        'id'       => 'members-grid-columns-xl',
        'type'     => 'slider',
        'title'    => esc_html__( 'Extra Large', 'wordtrap' ),
        'default'   => 3,
        'min'       => 2,
        'max'       => 5,
      ),
      array(
        'id'       => 'members-grid-columns-lg',
        'type'     => 'slider',
        'title'    => esc_html__( 'Large', 'wordtrap' ),
        'default'   => 3,
        'min'       => 1,
        'max'       => 4,
      ),
      array(
        'id'       => 'members-grid-columns-md',
        'type'     => 'slider',
        'title'    => esc_html__( 'Medium', 'wordtrap' ),
        'default'   => 2,
        'min'       => 1,
        'max'       => 3,
      ),
      array(
        'id'       => 'members-grid-columns-sm',
        'type'     => 'slider',
        'title'    => esc_html__( 'Small', 'wordtrap' ),
        'default'   => 1,
        'min'       => 1,
        'max'       => 2,
      ),
      array(
        'id'       => 'members-grid-columns-end',
        'type'     => 'section',
        'indent'   => false,
      ),
      array(
        'id'       => 'members-pagination',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Pagination', 'wordtrap' ),
        'options'  => $pagination_options,
        'default'  => '',
      ),      
    )
  )
);