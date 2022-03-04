<?php
/**
 * The theme logo options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
	$opt_name,
	array(
		'title'        => esc_html__( 'Logo', 'wordtrap' ),
		'id'           => 'wordtrap-logo',
		'subsection'   => true,
		'fields'       => array(
      array(
        'id'       => 'logo',
        'type'     => 'media',
        'readonly' => false,
        'title'    => __( 'Logo', 'wordtrap' ),
        'default'  => array(
          'url'    => WORDTRAP_URI . '/images/logo/logo.png',
        ),
      ),
      array(
        'id'       => 'logo-retina',
        'type'     => 'media',
        'readonly' => false,
        'title'    => __( 'Retina Logo', 'wordtrap' ),
      ),
      array(
        'id'       => 'logo-width',
        'type'     => 'dimensions',
        'title'    => __( 'Logo Max Width', 'wordtrap' ),
        'height'   => false,
        'default'  => array(
					'width'  => 170
				),
      ),
      array(
        'id'       => 'logo-width-wide',
        'type'     => 'dimensions',
        'title'    => __( 'Logo Max Width on Wide Screen', 'wordtrap' ),
        'height'   => false,
        'default'  => array(
					'width'  => 250
				),
      ),
      array(
        'id'       => 'logo-width-tablet',
        'type'     => 'dimensions',
        'title'    => __( 'Logo Max Width on Tablet', 'wordtrap' ),
        'height'   => false,
        'default'  => array(
					'width'  => 110
				),
      ),
      array(
        'id'       => 'logo-width-mobile',
        'type'     => 'dimensions',
        'title'    => __( 'Logo Max Width on Mobile', 'wordtrap' ),
        'height'   => false,
        'default'  => array(
					'width'  => 110
				),
      ),
      array(
        'id'       => 'logo-width-sticky',
        'type'     => 'dimensions',
        'title'    => __( 'Logo Max Width in Sticky Header', 'wordtrap' ),
        'height'   => false,
        'default'  => array(
					'width'  => 110
				),
      ),
    )
  )
);