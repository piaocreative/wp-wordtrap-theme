<?php
/**
 * The theme skin layout options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
	$opt_name,
	array(
		'title'        => esc_html__( 'Layout', 'wordtrap' ),
		'id'           => 'wordtrap-skin-layout',
		'subsection'   => true,
		'fields'       => array(
      array(
				'id'       => 'grid-breakpoints-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Breakpoints', 'wordtrap' ),
				'indent'   => true,
			),
      array(
        'id'       => 'grid-breakpoints-sm',
        'type'     => 'dimensions',
        'title'    => esc_html__( 'Small', 'wordtrap' ),
        'height'   => false,
        'default'  => array(
					'width'  => 576
				),
      ),
      array(
        'id'       => 'grid-breakpoints-md',
        'type'     => 'dimensions',
        'title'    => esc_html__( 'Medium', 'wordtrap' ),
        'height'   => false,
        'default'  => array(
					'width'  => 768
				),
      ),
      array(
        'id'       => 'grid-breakpoints-lg',
        'type'     => 'dimensions',
        'title'    => esc_html__( 'Large', 'wordtrap' ),
        'height'   => false,
        'default'  => array(
					'width'  => 992
				),
      ),
      array(
        'id'       => 'grid-breakpoints-xl',
        'type'     => 'dimensions',
        'title'    => esc_html__( 'Extra Large', 'wordtrap' ),
        'height'   => false,
        'default'  => array(
					'width'  => 1200
				),
      ),
      array(
        'id'       => 'grid-breakpoints-xxl',
        'type'     => 'dimensions',
        'title'    => esc_html__( 'Extra Extra Large', 'wordtrap' ),
        'height'   => false,
        'default'  => array(
					'width'  => 1400
				),
      ),
      array(
				'id'       => 'grid-breakpoints-end',
				'type'     => 'section',
				'indent'   => false,
			),
      array(
				'id'       => 'container-max-widths-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Container Max Width', 'wordtrap' ),
				'indent'   => true,
			),
      array(
        'id'       => 'container-max-widths-sm',
        'type'     => 'dimensions',
        'title'    => esc_html__( 'Small', 'wordtrap' ),
        'height'   => false,
        'default'  => array(
					'width'  => 540
				),
      ),
      array(
        'id'       => 'container-max-widths-md',
        'type'     => 'dimensions',
        'title'    => esc_html__( 'Medium', 'wordtrap' ),
        'height'   => false,
        'default'  => array(
					'width'  => 720
				),
      ),
      array(
        'id'       => 'container-max-widths-lg',
        'type'     => 'dimensions',
        'title'    => esc_html__( 'Large', 'wordtrap' ),
        'height'   => false,
        'default'  => array(
					'width'  => 960
				),
      ),
      array(
        'id'       => 'container-max-widths-xl',
        'type'     => 'dimensions',
        'title'    => esc_html__( 'Extra Large', 'wordtrap' ),
        'height'   => false,
        'default'  => array(
					'width'  => 1140
				),
      ),
      array(
        'id'       => 'container-max-widths-xxl',
        'type'     => 'dimensions',
        'title'    => esc_html__( 'Extra Extra Large', 'wordtrap' ),
        'height'   => false,
        'default'  => array(
					'width'  => 1320
				),
      ),
      array(
				'id'       => 'container-max-widths-end',
				'type'     => 'section',
				'indent'   => false,
			),
      array(
				'id'       => 'grid-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Grid', 'wordtrap' ),
				'indent'   => true,
			),
      array(
				'id'       => 'grid-columns',
				'type'     => 'text',
				'title'    => esc_html__( 'Grid Columns', 'wordtrap' ),
				'validate' => array( 'numeric', 'not_empty' ),
				'default'  => '12',
			),
      array(
        'id'       => 'grid-gutter-width',
        'type'     => 'dimensions',
        'units'    => 'rem',
        'title'    => esc_html__( 'Grid Gutter Width', 'wordtrap' ),
        'height'   => false,
        'default'  => array(
					'width'  => '1.5'
				),
      ),
      array(
				'id'       => 'grid-end',
				'type'     => 'section',
				'indent'   => false,
			),
      array(
				'id'       => 'spacers-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Spacers', 'wordtrap' ),
				'indent'   => true,
			),
      array(
				'id'       => 'spacer',
				'type'     => 'dimensions',
        'units'    => 'rem',
        'title'    => esc_html__( 'Basic Spacer', 'wordtrap' ),
        'height'   => false,
        'default'  => array(
					'width'  => '1'
				),
			),
      array(
        'id'       => 'spacers',
        'type'     => 'multi_text',
        'title'    => esc_html__( 'Spacer Maps', 'wordtrap' ),
        'validate' => array( 'numeric', 'not_empty' ),
        'default'  => ['0', '0.2', '0.5', '1', '1.5', '3'],
      ),
      array(
				'id'       => 'spacers-end',
				'type'     => 'section',
				'indent'   => false,
			),
    )
  )
);