<?php
/**
 * The theme member singular options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
	$opt_name,
	array(
		'title'        => esc_html__( 'Singular', 'wordtrap' ),
		'id'           => 'wordtrap-member-singular',
		'subsection'   => true,
		'fields'       => array(
      array(
        'id'       => 'member-backto',
        'type'     => 'switch',
        'title'    => esc_html__( 'Back to Members', 'wordtrap' ),
        'default'  => false,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'member-layout',
        'type'     => 'image_select',
        'title'    => esc_html__( 'Main Layout', 'wordtrap' ),
        'options'  => $main_layout_options,
        'default'  => 'full',
      ),
      array(
        'id'       => 'member-left-sidebar',
        'type'     => 'select',
        'title'    => esc_html__( 'Left Sidebar', 'wordtrap' ),
        'required' => array( 'member-layout', 'equals', $main_layouts_with_left_sidebar ),
        'data'     => 'sidebars',
        'default'  => 'left-sidebar',
      ),
      array(
        'id'       => 'member-right-sidebar',
        'type'     => 'select',
        'title'    => esc_html__( 'Right Sidebar', 'wordtrap' ),
        'required' => array( 'member-layout', 'equals', $main_layouts_with_right_sidebar ),
        'data'     => 'sidebars',
        'default'  => 'right-sidebar',
      ),
      array(
        'id'       => 'member-socials',
        'type'     => 'switch',
        'title'    => esc_html__( 'Social Links', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'member-socials-position',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Social Links Position', 'wordtrap' ),
        'options'  => array(
          'before'      => esc_html__( 'Before Overview', 'wordtrap' ),
          ''            => esc_html__( 'After Overview', 'wordtrap' ),
          'below_thumb' => esc_html__( 'Below Member Image', 'wordtrap' ),
        ),
        'default'  => '',
      ),
      array(
				'id'       => 'member-related-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Related Members', 'wordtrap' ),
				'indent'   => true,
			),
      array(
        'id'       => 'member-related',
        'type'     => 'switch',
        'title'    => esc_html__( 'Related Members', 'wordtrap' ),
        'default'  => false,
        'on'       => esc_html__( 'Show', 'wordtrap' ),
        'off'      => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'       => 'member-related-count',
        'type'     => 'text',
        'required' => array( 'member-related', 'equals', true ),
        'title'    => esc_html__( 'Count', 'wordtrap' ),
        'default'  => '10',
      ),
      array(
        'id'       => 'member-related-orderby',
        'type'     => 'button_set',
        'required' => array( 'member-related', 'equals', true ),
        'title'    => esc_html__( 'Order by', 'wordtrap' ),
        'options'  => array(
          'none'     => esc_html__( 'None', 'wordtrap' ),
          'rand'     => esc_html__( 'Random', 'wordtrap' ),
          'date'     => esc_html__( 'Date', 'wordtrap' ),
          'ID'       => esc_html__( 'ID', 'wordtrap' ),
          'modified' => esc_html__( 'Modified Date', 'wordtrap' ),
        ),
        'default'  => 'rand',
      ),
      array(
        'id'       => 'member-related-columns',
        'type'     => 'slider',
        'required' => array( 'member-related', 'equals', true ),
        'title'    => esc_html__( 'Columns', 'wordtrap' ),
        'default'  => 4,
        'min'      => 2,
        'max'      => 6,
      ),
      array(
        'id'       => 'member-related-carousel',
        'type'     => 'switch',
        'title'    => esc_html__( 'Carousel', 'wordtrap' ),
        'required' => array( 'post-related', 'equals', true ),
        'default'  => true,
        'on'       => esc_html__( 'Enable', 'wordtrap' ),
        'off'      => esc_html__( 'Disable', 'wordtrap' ),
      ),
      array(
				'id'       => 'member-related-end',
				'type'     => 'section',
				'indent'   => false,
			),
    )
  )
);