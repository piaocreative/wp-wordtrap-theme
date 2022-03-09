<?php
/**
 * The theme header options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'Header', 'wordtrap' ),
		'id'               => 'wordtrap-header',
		'customizer_width' => '400px',
		'icon'             => 'el el-website',
		'fields'           => array(
      array(
				'id'            => 'header-position',
				'type'          => 'button_set',
				'title'         => esc_html__( 'Position', 'wordtrap' ),
				'options'       => array(
          ''            => esc_html__( 'Normal', 'wordtrap' ),
          'fixed'       => esc_html__( 'Fixed', 'wordtrap' ),
          'hide'        => esc_html__( 'Hide', 'wordtrap' )
        ),
        'default'       => '',
			),
      array(
				'id'            => 'show-header-top',
				'type'          => 'switch',
        'title'         => esc_html__( 'Show Header Top', 'wordtrap' ),
        'default'       => false,
        'on'            => esc_html__( 'Yes', 'wordtrap' ),
        'off'           => esc_html__( 'No', 'wordtrap' ),
			),
      array(
				'id'            => 'header-type',
				'type'          => 'button_set',
				'title'         => esc_html__( 'Type', 'wordtrap' ),
				'options'       => array(
          ''            => esc_html__( 'Normal', 'wordtrap' ),
          'left-side'   => esc_html__( 'Left Side', 'wordtrap' ),
          'right-side'  => esc_html__( 'Right Side', 'wordtrap' ),
        ),
        'default'       => '',
			),
			array(
				'id'            => 'sticky-header-start',
				'type'          => 'section',
				'title'         => esc_html__( 'Sticky Header', 'wordtrap' ),
				'indent'        => true,
			),
			array(
				'id'            => 'show-sticky-header',
				'type'          => 'switch',
        'title'         => esc_html__( 'Show Sticky Header', 'wordtrap' ),
        'default'       => true,
        'on'            => esc_html__( 'Yes', 'wordtrap' ),
        'off'           => esc_html__( 'No', 'wordtrap' ),
			),
      array(
				'id'            => 'show-sticky-header-xl',
				'type'          => 'switch',
        'title'         => esc_html__( 'Extra Large Screen', 'wordtrap' ),
        'default'       => true,
        'required'      => array( 'show-sticky-header', 'equals', true ),
        'on'            => esc_html__( 'Show', 'wordtrap' ),
        'off'           => esc_html__( 'Hide', 'wordtrap' ),
			),
      array(
				'id'            => 'show-sticky-header-lg',
				'type'          => 'switch',
        'title'         => esc_html__( 'Large Screen', 'wordtrap' ),
        'default'       => true,
        'required'      => array( 'show-sticky-header', 'equals', true ),
        'on'            => esc_html__( 'Show', 'wordtrap' ),
        'off'           => esc_html__( 'Hide', 'wordtrap' ),
			),
      array(
				'id'            => 'show-sticky-header-md',
				'type'          => 'switch',
        'title'         => esc_html__( 'Medium Screen', 'wordtrap' ),
        'default'       => true,
        'required'      => array( 'show-sticky-header', 'equals', true ),
        'on'            => esc_html__( 'Show', 'wordtrap' ),
        'off'           => esc_html__( 'Hide', 'wordtrap' ),
			),
      array(
				'id'            => 'show-sticky-header-sm',
				'type'          => 'switch',
        'title'         => esc_html__( 'Small Screen', 'wordtrap' ),
        'default'       => true,
        'required'      => array( 'show-sticky-header', 'equals', true ),
        'on'            => esc_html__( 'Show', 'wordtrap' ),
        'off'           => esc_html__( 'Hide', 'wordtrap' ),
			),
			array(
				'id'            => 'sticky-header-end',
				'type'          => 'section',
				'indent'        => false,
			),
    )
  )
);