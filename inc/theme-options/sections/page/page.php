<?php
/**
 * The theme page options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'Page', 'wordtrap' ),
		'id'               => 'wordtrap-page',
		'customizer_width' => '400px',
		'icon'             => 'el el-website el-rotate-180',
		'fields'           => array(
      array(
				'id'            => 'page-comment',
				'type'          => 'switch',
        'title'         => esc_html__( 'Show Comments', 'wordtrap' ),
        'default'       => false,
        'on'            => esc_html__( 'Yes', 'wordtrap' ),
        'off'           => esc_html__( 'No', 'wordtrap' ),
			),
      array(
				'id'            => 'page-share',
				'type'          => 'switch',
        'title'         => esc_html__( 'Show Social Shares', 'wordtrap' ),
        'default'       => false,
        'on'            => esc_html__( 'Yes', 'wordtrap' ),
        'off'           => esc_html__( 'No', 'wordtrap' ),
			),
    )
  )
);