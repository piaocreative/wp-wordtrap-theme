<?php
/**
 * The theme singular post options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'        => esc_html__( 'Singular', 'wordtrap' ),
    'id'           => 'wordtrap-post-singular',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'       => 'post-layout',
        'type'     => 'image_select',
        'title'    => esc_html__( 'Main Layout', 'wordtrap' ),
        'options'  => $main_layout_options,
        'default'  => 'right-sidebar',
      ),
      array(
        'id'       => 'post-left-sidebar',
        'type'     => 'select',
        'title'    => esc_html__( 'Left Sidebar', 'wordtrap' ),
        'required' => array( 'post-layout', 'equals', $main_layouts_with_left_sidebar ),
        'data'     => 'sidebars',
        'default'  => 'left-sidebar',
      ),
      array(
        'id'       => 'post-right-sidebar',
        'type'     => 'select',
        'title'    => esc_html__( 'Right Sidebar', 'wordtrap' ),
        'required' => array( 'post-layout', 'equals', $main_layouts_with_right_sidebar ),
        'data'     => 'sidebars',
        'default'  => 'right-sidebar',
      ),
      array(
        'id'       => 'post-view',
        'type'     => 'image_select',
        'title'    => esc_html__( 'View Type', 'wordtrap' ),
        'options'  => $post_layout_options,
        'default'  => 'full',
      ),
      array(
        'id'       => 'post-featured-image',
        'type'     => 'switch',
        'title'    => esc_html__( 'Featured Image', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'post-title',
        'type'     => 'switch',
        'title'    => esc_html__( 'Title', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'post-share',
        'type'     => 'switch',
        'title'    => esc_html__( 'Social Share', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'post-nav',
        'type'     => 'switch',
        'title'    => esc_html__( 'Prev / Next Navigation', 'wordtrap' ),
        'default'  => false,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      // array(
      //   'id'       => 'post-author',
      //   'type'     => 'switch',
      //   'title'    => esc_html__( 'Author Info', 'wordtrap' ),
      //   'default'  => true,
      //   'on'       => esc_html__( 'Show', 'wordtrap' ),
      //   'off'      => esc_html__( 'Hide', 'wordtrap' ),
      // ),
      array(
        'id'       => 'post-comments',
        'type'     => 'switch',
        'title'    => esc_html__( 'Comments', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'post-related-start',
        'type'     => 'section',
        'title'    => esc_html__( 'Related Posts', 'wordtrap' ),
        'indent'   => true,
      ),
      array(
        'id'       => 'post-related',
        'type'     => 'switch',
        'title'    => esc_html__( 'Related Posts', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'post-related-orderby',
        'type'     => 'button_set',
        'required' => array( 'post-related', 'equals', true ),
        'title'    => esc_html__( 'Order by', 'wordtrap' ),
        'options'  => array(
          'none'          => esc_html__( 'None', 'wordtrap' ),
          'rand'          => esc_html__( 'Random', 'wordtrap' ),
          'date'          => esc_html__( 'Date', 'wordtrap' ),
          'ID'            => esc_html__( 'ID', 'wordtrap' ),
          'modified'      => esc_html__( 'Modified Date', 'wordtrap' ),
          'comment_count' => esc_html__( 'Comment Count', 'wordtrap' ),
        ),
        'default'  => 'rand',
      ),
      array(
        'id'       => 'post-related-view',
        'type'     => 'image_select',
        'title'    => esc_html__( 'View Type', 'wordtrap' ),
        'required' => array( 'post-related', 'equals', true ),
        'options'  => $posts_related_layout_options,
        'default'  => 'grid',
      ),
      array(
        'id'       => 'post-related-count',
        'type'     => 'text',
        'required' => array( 'post-related', 'equals', true ),
        'title'    => esc_html__( 'Count', 'wordtrap' ),
        'validate' => array( 'numeric', 'not_empty' ),
        'default'  => '6',
      ),
      array(
        'id'       => 'post-related-carousel',
        'type'     => 'switch',
        'title'    => esc_html__( 'Carousel', 'wordtrap' ),
        'required' => array( 'post-related', 'equals', true ),
        'default'  => false,
        'on'       => esc_html__( 'Enable', 'wordtrap' ),
        'off'      => esc_html__( 'Disable', 'wordtrap' ),
      ),
      array(
        'id'       => 'post-related-end',
        'type'     => 'section',
        'indent'   => false,
      ),
      array(
        'id'       => 'post-related-columns-start',
        'type'     => 'section',
        'title'    => esc_html__( 'Related Posts Columns', 'wordtrap' ),
        'required' => array( 'post-related', 'equals', true ),
        'indent'   => true,
      ),
      array(
        'id'       => 'post-related-columns-xxl',
        'type'     => 'slider',
        'required' => array( 'post-related', 'equals', true ),
        'title'    => esc_html__( 'Extra Extra Large', 'wordtrap' ),
        'default'  => 3,
        'min'      => 2,
        'max'      => 6,
      ),
      array(
        'id'       => 'post-related-columns-xl',
        'type'     => 'slider',
        'required' => array( 'post-related', 'equals', true ),
        'title'    => esc_html__( 'Extra Large', 'wordtrap' ),
        'default'  => 2,
        'min'      => 2,
        'max'      => 5,
      ),
      array(
        'id'       => 'post-related-columns-lg',
        'type'     => 'slider',
        'required' => array( 'post-related', 'equals', true ),
        'title'    => esc_html__( 'Large', 'wordtrap' ),
        'default'  => 2,
        'min'      => 1,
        'max'      => 4,
      ),
      array(
        'id'       => 'post-related-columns-md',
        'type'     => 'slider',
        'required' => array( 'post-related', 'equals', true ),
        'title'    => esc_html__( 'Medium', 'wordtrap' ),
        'default'  => 1,
        'min'      => 1,
        'max'      => 3,
      ),
      array(
        'id'       => 'post-related-columns-sm',
        'type'     => 'slider',
        'required' => array( 'post-related', 'equals', true ),
        'title'    => esc_html__( 'Small', 'wordtrap' ),
        'default'  => 1,
        'min'      => 1,
        'max'      => 2,
      ),
      array(
        'id'       => 'post-related-columns-end',
        'type'     => 'section',
        'required' => array( 'post-related', 'equals', true ),
        'indent'   => false,
      ),    
    )
  )
);