<?php
/**
 * The theme footer options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'Footer', 'wordtrap' ),
		'id'               => 'wordtrap-footer',
		'customizer_width' => '400px',
		'icon'             => 'el el-website el-rotate-180',
		'fields'           => array(
      array(
        'id'           => 'footer-reveal',
        'type'         => 'switch',
        'title'        => esc_html__( 'Show Reveal Effect', 'wordtrap' ),
        'default'      => false,
        'on'           => esc_html__( 'Yes', 'wordtrap' ),
        'off'          => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'           => 'footer-ribbon-text',
        'type'         => 'text',
        'title'        => esc_html__( 'Ribbon Text', 'wordtrap' ),
        'default'      => '',
      ),
      array(
        'id'           => 'footer-ribbon-url',
        'type'         => 'text',
        'title'        => esc_html__( 'Ribbon URL', 'wordtrap' ),
        'validate'     => 'url',
        'default'      => '',
      ),
    )
  )
);