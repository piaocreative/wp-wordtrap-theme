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
        'id'       => 'posts-view',
        'type'     => 'image_select',
        'title'    => esc_html__( 'View Type', 'wordtrap' ),
        'options'  => $posts_layout_options,
        'default'  => 'full',
      ),
      array(
        'id'       => 'posts-style',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Post Style', 'wordtrap' ),
        'required' => array( 'posts-view', 'equals', array( 'grid', 'timeline', 'masonry' ) ),
        'options'  => array(
          ''           => esc_html__( 'Normal', 'wordtrap' ),
          'date'       => esc_html__( 'Date on Image', 'wordtrap' ),
          'author'     => esc_html__( 'Author Picture', 'wordtrap' ),
          'related'    => esc_html__( 'Post Carousel Style', 'wordtrap' ),
          'hover_info' => esc_html__( 'Hover Info', 'wordtrap' ),
          'no_margin'  => esc_html__( 'No Margin & Hover Info', 'wordtrap' ),
          'padding'    => esc_html__( 'With Borders', 'wordtrap' ),
        ),
        'default'  => '',
      ),
      array(
        'id'       => 'posts-columns',
        'type'     => 'slider',
        'title'    => esc_html__( 'Columns', 'wordtrap' ),
        'required' => array( 'posts-view', 'equals', array( 'grid', 'masonry' ) ),
        'default'   => 3,
        'min'       => 1,
        'max'       => 6,
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
        'id'       => 'posts-count',
        'type'     => 'multi_text',
        'title'    => esc_html__( 'Posts per Page', 'wordtrap' ),
        'validate' => array( 'numeric', 'not_empty' ),
        'default'  => ['12', '24', '36'],
      ),
      array(
        'id'       => 'posts-pagination',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Pagination', 'wordtrap' ),
        'options'  => $pagination_options,
        'default'  => '',
      ),
      array(
        'id'       => 'posts-shares',
        'type'     => 'switch',
        'title'    => esc_html__( 'Social Shares', 'wordtrap' ),
        'required' => array( 'posts-view', 'equals', array( 'grid', 'timeline', 'masonry', 'large-alt' ) ),
        'default'  => false,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'posts-excerpt',
        'type'     => 'switch',
        'title'    => esc_html__( 'Excerpt', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'posts-excerpt-length',
        'type'     => 'text',
        'required' => array( 'posts-excerpt', 'equals', true ),
        'title'    => esc_html__( 'Excerpt Length', 'wordtrap' ),
        'validate' => array( 'numeric', 'not_empty' ),
        'default'  => '50',
      ),
      array(
        'id'       => 'posts-excerpt-base',
        'type'     => 'button_set',
        'required' => array( 'posts-excerpt', 'equals', true ),
        'title'    => esc_html__( 'Basis for Excerpt Length', 'wordtrap' ),
        'options'  => array(
          'words'      => esc_html__( 'Words', 'wordtrap' ),
          'characters' => esc_html__( 'Characters', 'wordtrap' ),
        ),
        'default'  => 'words',
      ),
      array(
        'id'       => 'posts-excerpt-type',
        'type'     => 'button_set',
        'required' => array( 'posts-excerpt', 'equals', true ),
        'title'    => esc_html__( 'Excerpt Type', 'wordtrap' ),
        'options'  => array(
          'text'   => esc_html__( 'Text', 'wordtrap' ),
          'html'   => esc_html__( 'HTML', 'wordtrap' ),
        ),
        'default'  => 'text',
      ),
    )
  )
);