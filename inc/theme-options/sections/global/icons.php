<?php
/**
 * The theme icon options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
	$opt_name,
	array(
		'title'        => esc_html__( 'Icons', 'wordtrap' ),
		'id'           => 'wordtrap-global-icons',
		'subsection'   => true,
		'fields'       => array(
      array(
        'id'       => 'favicon',
        'type'     => 'media',
        'readonly' => false,
        'title'    => esc_html__( 'Favicon', 'wordtrap' ),
        'default'  => array(
          'url'    => WORDTRAP_URI . '/images/icons/favicon.png',
        ),
      ),
      array(
				'id'       => 'icons-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Apple Icons', 'wordtrap' ),
				'indent'   => true,
			),
      array(
        'id'       => 'icon-iphone',
        'type'     => 'media',
        'readonly' => false,
        'title'    => esc_html__( 'iPhone', 'wordtrap' ),
        'desc'     => esc_html__( 'Icon for Apple iPhone (60px X 60px)', 'wordtrap' ),
        'default'  => array(
          'url'    => WORDTRAP_URI . '/images/icons/apple-touch-icon.png',
        ),
      ),
      array(
        'id'       => 'icon-iphone-retina',
        'type'     => 'media',
        'readonly' => false,
        'title'    => esc_html__( 'iPhone Retina', 'wordtrap' ),
        'desc'     => esc_html__( 'Icon for Apple iPhone Retina (120px X 120px)', 'wordtrap' ),
        'default'  => array(
          'url'    => WORDTRAP_URI . '/images/icons/apple-touch-icon_120x120.png',
        ),
      ),
      array(
        'id'       => 'icon-ipad',
        'type'     => 'media',
        'readonly' => false,
        'title'    => esc_html__( 'iPad', 'wordtrap' ),
        'desc'     => esc_html__( 'Icon for Apple iPad (76px X 76px)', 'wordtrap' ),
        'default'  => array(
          'url'    => WORDTRAP_URI . '/images/icons/apple-touch-icon_76x76.png',
        ),
      ),
      array(
        'id'       => 'icon-ipad-retina',
        'type'     => 'media',
        'readonly' => false,
        'title'    => esc_html__( 'iPad Retina', 'wordtrap' ),
        'desc'     => esc_html__( 'Icon for Apple iPad Retina (152px X 152px)', 'wordtrap' ),
        'default'  => array(
          'url'    => WORDTRAP_URI . '/images/icons/apple-touch-icon_152x152.png',
        ),
      ),
      array(
				'id'       => 'icons-end',
				'type'     => 'section',
				'indent'   => false,
			),
    )
  )
);