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
        'id'       => 'post-backto-blog',
        'type'     => 'switch',
        'title'    => esc_html__( 'Back to Blog', 'wordtrap' ),
        'default'  => false,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'post-layout',
        'type'     => 'image_select',
        'title'    => esc_html__( 'Main Layout', 'wordtrap' ),
        'options'  => $main_layout_options,
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
        'id'       => 'post-slideshow',
        'type'     => 'switch',
        'title'    => esc_html__( 'Slideshow', 'wordtrap' ),
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
        'id'       => 'post-shares',
        'type'     => 'switch',
        'title'    => esc_html__( 'Social Shares', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'post-author',
        'type'     => 'switch',
        'title'    => esc_html__( 'Author Info', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
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
        'id'       => 'post-related-count',
        'type'     => 'text',
        'required' => array( 'post-related', 'equals', true ),
        'title'    => esc_html__( 'Count', 'wordtrap' ),
        'validate' => array( 'numeric', 'not_empty' ),
        'default'  => '10',
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
        'id'       => 'post-related-cols',
        'type'     => 'button_set',
        'required' => array( 'post-related', 'equals', true ),
        'title'    => esc_html__( 'Columns', 'wordtrap' ),
        'options'  => array(
          '4'      => '4',
          '3'      => '3',
          '2'      => '2',
          '1'      => '1',
        ),
        'default'  => '3',
      ),
      array(
        'id'       => 'post-related-carouse',
        'type'     => 'switch',
        'title'    => esc_html__( 'Carousel', 'wordtrap' ),
        'required' => array( 'post-related', 'equals', true ),
        'default'  => true,
        'on'       => esc_html__( 'Enable', 'wordtrap' ),
        'off'      => esc_html__( 'Disable', 'wordtrap' ),
      ),
      array(
				'id'       => 'post-related-end',
				'type'     => 'section',
				'indent'   => false,
			),
    )
  )
);