<?php
/**
 * The theme skin typography options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
	$opt_name,
	array(
		'title'        => esc_html__( 'Typography', 'wordtrap' ),
		'id'           => 'wordtrap-skin-typography',
		'subsection'   => true,
		'fields'       => array(
      array(
				'id'       => 'font-family-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Font Family', 'wordtrap' ),
				'indent'   => true,
			),
      array(
				'id'            => 'font-family-base',
				'type'          => 'typography',
				'title'         => esc_html__( 'Base', 'wordtrap' ),
				'font-weight'   => false,
        'font-style'    => false,
        'font-size'     => false,
        'subsets'       => false,
				'text-align'    => false,
				'color'         => false,
				'preview'       => true,
				'line-height'   => false,
				'default'       => array(
					'font-family' => 'system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans","Liberation Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"',
				),
				'output'        => array( 'p' ),
			),
      array(
				'id'            => 'font-family-code',
				'type'          => 'typography',
				'title'         => esc_html__( 'Code', 'wordtrap' ),
				'font-weight'   => false,
        'font-style'    => false,
        'font-size'     => false,
        'subsets'       => false,
				'text-align'    => false,
				'color'         => false,
				'preview'       => true,
				'line-height'   => false,
				'default'       => array(
					'font-family' => 'SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace',
				),
				'output'        => array( 'p' ),
			),
      array(
				'id'       => 'font-family-end',
				'type'     => 'section',
				'indent'   => false,
			),
      array(
				'id'       => 'font-size-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Font Size', 'wordtrap' ),
				'indent'   => true,
			),
      array(
				'id'            => 'font-size-base',
				'type'          => 'typography',
				'title'         => esc_html__( 'Base', 'wordtrap' ),
				'google'        => false,
				'font-weight'   => false,
        'font-style'    => false,
        'font-family'   => false,
        'subsets'       => false,
				'text-align'    => false,
				'color'         => false,
				'preview'       => true,
				'line-height'   => false,
        'units'         => 'rem',
				'default'       => array(
					'font-size'   => '1',
				),
				'output'        => array( 'p' ),
			),
      array(
				'id'            => 'font-size-sm',
				'type'          => 'typography',
				'title'         => esc_html__( 'Small', 'wordtrap' ),
				'google'        => false,
				'font-weight'   => false,
        'font-style'    => false,
        'font-family'   => false,
        'subsets'       => false,
				'text-align'    => false,
				'color'         => false,
				'preview'       => true,
				'line-height'   => false,
        'units'         => 'rem',
				'default'       => array(
					'font-size'   => '0.875',
				),
				'output'        => array( 'p' ),
			),
      array(
				'id'            => 'font-size-lg',
				'type'          => 'typography',
				'title'         => esc_html__( 'Large', 'wordtrap' ),
				'google'        => false,
				'font-weight'   => false,
        'font-style'    => false,
        'font-family'   => false,
        'subsets'       => false,
				'text-align'    => false,
				'color'         => false,
				'preview'       => true,
				'line-height'   => false,
        'units'         => 'rem',
				'default'       => array(
					'font-size'   => '1.25',
				),
				'output'        => array( 'p' ),
			),
      array(
				'id'            => 'h1-font-size',
				'type'          => 'typography',
				'title'         => esc_html__( 'H1', 'wordtrap' ),
				'google'        => false,
				'font-weight'   => false,
        'font-style'    => false,
        'font-family'   => false,
        'subsets'       => false,
				'text-align'    => false,
				'color'         => false,
				'preview'       => true,
				'line-height'   => false,
        'units'         => 'rem',
				'default'       => array(
					'font-size'   => '2.5',
				),
				'output'        => array( 'p' ),
			),
      array(
				'id'            => 'h2-font-size',
				'type'          => 'typography',
				'title'         => esc_html__( 'H2', 'wordtrap' ),
				'google'        => false,
				'font-weight'   => false,
        'font-style'    => false,
        'font-family'   => false,
        'subsets'       => false,
				'text-align'    => false,
				'color'         => false,
				'preview'       => true,
				'line-height'   => false,
        'units'         => 'rem',
				'default'       => array(
					'font-size'   => '2',
				),
				'output'        => array( 'p' ),
			),
      array(
				'id'            => 'h3-font-size',
				'type'          => 'typography',
				'title'         => esc_html__( 'H3', 'wordtrap' ),
				'google'        => false,
				'font-weight'   => false,
        'font-style'    => false,
        'font-family'   => false,
        'subsets'       => false,
				'text-align'    => false,
				'color'         => false,
				'preview'       => true,
				'line-height'   => false,
        'units'         => 'rem',
				'default'       => array(
					'font-size'   => '1.75',
				),
				'output'        => array( 'p' ),
			),
      array(
				'id'            => 'h4-font-size',
				'type'          => 'typography',
				'title'         => esc_html__( 'H4', 'wordtrap' ),
				'google'        => false,
				'font-weight'   => false,
        'font-style'    => false,
        'font-family'   => false,
        'subsets'       => false,
				'text-align'    => false,
				'color'         => false,
				'preview'       => true,
				'line-height'   => false,
        'units'         => 'rem',
				'default'       => array(
					'font-size'   => '1.5',
				),
				'output'        => array( 'p' ),
			),
      array(
				'id'            => 'h5-font-size',
				'type'          => 'typography',
				'title'         => esc_html__( 'H5', 'wordtrap' ),
				'google'        => false,
				'font-weight'   => false,
        'font-style'    => false,
        'font-family'   => false,
        'subsets'       => false,
				'text-align'    => false,
				'color'         => false,
				'preview'       => true,
				'line-height'   => false,
        'units'         => 'rem',
				'default'       => array(
					'font-size'   => '1.25',
				),
				'output'        => array( 'p' ),
			),
      array(
				'id'            => 'h6-font-size',
				'type'          => 'typography',
				'title'         => esc_html__( 'H6', 'wordtrap' ),
				'google'        => false,
				'font-weight'   => false,
        'font-style'    => false,
        'font-family'   => false,
        'subsets'       => false,
				'text-align'    => false,
				'color'         => false,
				'preview'       => true,
				'line-height'   => false,
        'units'         => 'rem',
				'default'       => array(
					'font-size'   => '1',
				),
				'output'        => array( 'p' ),
			),
      array(
				'id'       => 'font-size-end',
				'type'     => 'section',
				'indent'   => false,
			),
      array(
				'id'       => 'font-weight-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Font Weight', 'wordtrap' ),
				'indent'   => true,
			),
      array(
				'id'            => 'font-weight-lighter',
				'type'          => 'slider',
				'title'         => esc_html__( 'Lighter', 'wordtrap' ),
				'default'       => 100,
				'min'           => 100,
				'step'          => 100,
				'max'           => 900,
				'display_value' => 'text',
			),
      array(
				'id'            => 'font-weight-light',
				'type'          => 'slider',
				'title'         => esc_html__( 'Light', 'wordtrap' ),
				'default'       => 300,
				'min'           => 100,
				'step'          => 100,
				'max'           => 900,
				'display_value' => 'text',
			),
      array(
				'id'            => 'font-weight-normal',
				'type'          => 'slider',
				'title'         => esc_html__( 'Normal', 'wordtrap' ),
				'default'       => 400,
				'min'           => 100,
				'step'          => 100,
				'max'           => 900,
				'display_value' => 'text',
			),
      array(
				'id'            => 'font-weight-bold',
				'type'          => 'slider',
				'title'         => esc_html__( 'Bold', 'wordtrap' ),
				'default'       => 700,
				'min'           => 100,
				'step'          => 100,
				'max'           => 900,
				'display_value' => 'text',
			),
      array(
				'id'            => 'font-weight-bolder',
				'type'          => 'slider',
				'title'         => esc_html__( 'Bolder', 'wordtrap' ),
				'default'       => 900,
				'min'           => 100,
				'step'          => 100,
				'max'           => 900,
				'display_value' => 'text',
			),
      array(
				'id'       => 'font-weight-end',
				'type'     => 'section',
				'indent'   => false,
			),
      array(
				'id'       => 'line-height-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Line Height', 'wordtrap' ),
				'indent'   => true,
			),
      array(
				'id'            => 'line-height-base',
				'type'          => 'typography',
				'title'         => esc_html__( 'Base', 'wordtrap' ),
				'google'        => false,
				'font-weight'   => false,
        'font-style'    => false,
        'font-family'   => false,
        'subsets'       => false,
				'text-align'    => false,
				'color'         => false,
				'preview'       => true,
				'font-size'     => false,
        'units'         => 'em',
				'default'       => array(
					'line-height' => '1.5',
				),
				'output'        => array( 'p' ),
			),
      array(
				'id'            => 'line-height-sm',
				'type'          => 'typography',
				'title'         => esc_html__( 'Small', 'wordtrap' ),
				'google'        => false,
				'font-weight'   => false,
        'font-style'    => false,
        'font-family'   => false,
        'subsets'       => false,
				'text-align'    => false,
				'color'         => false,
				'preview'       => true,
				'font-size'     => false,
        'units'         => 'em',
				'default'       => array(
					'line-height' => '1.25',
				),
				'output'        => array( 'p' ),
			),
      array(
				'id'            => 'line-height-lg',
				'type'          => 'typography',
				'title'         => esc_html__( 'Large', 'wordtrap' ),
				'google'        => false,
				'font-weight'   => false,
        'font-style'    => false,
        'font-family'   => false,
        'subsets'       => false,
				'text-align'    => false,
				'color'         => false,
				'preview'       => true,
				'font-size'     => false,
        'units'         => 'em',
				'default'       => array(
					'line-height' => '2',
				),
				'output'        => array( 'p' ),
			),
      array(
				'id'       => 'line-height-end',
				'type'     => 'section',
				'indent'   => false,
			),
      array(
				'id'       => 'headings-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Headings', 'wordtrap' ),
				'indent'   => true,
			),
      array(
        'id'       => 'headings-margin-bottom',
        'type'     => 'dimensions',
        'title'    => esc_html__( 'Margin Bottom', 'wordtrap' ),
        'width'    => false,
        'units'    => 'rem',
        'default'  => array(
					'height' => 0.5
				),
      ),
      array(
				'id'            => 'headings-font-family',
				'type'          => 'typography',
				'title'         => esc_html__( 'Font Family', 'wordtrap' ),
				'font-weight'   => false,
        'font-style'    => false,
        'font-size'     => false,
        'subsets'       => false,
				'text-align'    => false,
				'color'         => false,
				'preview'       => true,
				'line-height'   => false,
				'default'       => array(
					'font-family' => '',
				),
				'output'        => array( 'p' ),
			),
			array(
				'id'            => 'headings-font-style',
				'type'          => 'button_set',
				'title'         => esc_html__( 'Font Style', 'wordtrap' ),
				'options'       => $font_style_options
			),
			array(
				'id'            => 'headings-font-weight',
				'type'          => 'slider',
				'title'         => esc_html__( 'Font Weight', 'wordtrap' ),
				'default'       => 500,
				'min'           => 100,
				'step'          => 100,
				'max'           => 900,
				'display_value' => 'text',
			),
			array(
				'id'            => 'headings-line-height',
				'type'          => 'typography',
				'title'         => esc_html__( 'Line Height', 'wordtrap' ),
				'google'        => false,
				'font-weight'   => false,
        'font-style'    => false,
        'font-family'   => false,
        'subsets'       => false,
				'text-align'    => false,
				'color'         => false,
				'preview'       => true,
				'font-size'     => false,
        'units'         => 'em',
				'default'       => array(
					'line-height' => '1.2',
				),
				'output'        => array( 'p' ),
			),
			array(
				'id'            => 'headings-color',
				'type'          => 'color',
				'title'         => esc_html__( 'Color', 'wordtrap' ),
				'validate'      => 'color',
				'transparent'   => false,
				'compiler'      => true,
			),
      array(
				'id'       => 'headings-end',
				'type'     => 'section',
				'indent'   => false,
			),
			array(
				'id'       => 'link-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Link', 'wordtrap' ),
				'indent'   => true,
			),
			array(
				'id'            => 'link',
				'type'          => 'typography',
				'title'         => esc_html__( 'Link', 'wordtrap' ),
				'google'        => false,
				'font-weight'   => false,
        'font-style'    => false,
        'font-family'   => false,
        'subsets'       => false,
				'text-align'    => false,
				'line-height'   => false,
				'text-decoration' => true,
				'color'         => true,
				'preview'       => true,
				'font-size'     => false,
				'default'       => array(
					'text-decoration' => 'underline',
				),
				'output'        => array( 'p' ),
			),
			array(
				'id'            => 'link-hover',
				'type'          => 'typography',
				'title'         => esc_html__( 'Link Hover', 'wordtrap' ),
				'google'        => false,
				'font-weight'   => false,
        'font-style'    => false,
        'font-family'   => false,
        'subsets'       => false,
				'text-align'    => false,
				'line-height'   => false,
				'text-decoration' => true,
				'color'         => true,
				'preview'       => true,
				'font-size'     => false,
				'output'        => array( 'p' ),
			),
			array(
				'id'       => 'link-end',
				'type'     => 'section',
				'indent'   => false,
			),
    )
  )
);