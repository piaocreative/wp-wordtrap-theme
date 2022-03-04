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
		'id'           => 'wordtrap-icons',
		'subsection'   => true,
		'fields'       => array(
      array(
        'id'       => 'favicon',
        'type'     => 'media',
        'readonly' => false,
        'title'    => __( 'Favicon', 'wordtrap' ),
        'default'  => array(
          'url'    => WORDTRAP_URI . '/images/icons/favicon.png',
        ),
      ),
      array(
        'id'       => 'icon-iphone',
        'type'     => 'media',
        'readonly' => false,
        'title'    => __( 'Apple iPhone Icon', 'wordtrap' ),
        'desc'     => __( 'Icon for Apple iPhone (60px X 60px)', 'wordtrap' ),
        'default'  => array(
          'url'    => WORDTRAP_URI . '/images/icons/apple-touch-icon.png',
        ),
      ),
      array(
        'id'       => 'icon-iphone-retina',
        'type'     => 'media',
        'readonly' => false,
        'title'    => __( 'Apple iPhone Retina Icon', 'wordtrap' ),
        'desc'     => __( 'Icon for Apple iPhone Retina (120px X 120px)', 'wordtrap' ),
        'default'  => array(
          'url'    => WORDTRAP_URI . '/images/icons/apple-touch-icon_120x120.png',
        ),
      ),
      array(
        'id'       => 'icon-ipad',
        'type'     => 'media',
        'readonly' => false,
        'title'    => __( 'Apple iPad Icon', 'wordtrap' ),
        'desc'     => __( 'Icon for Apple iPad (76px X 76px)', 'wordtrap' ),
        'default'  => array(
          'url'    => WORDTRAP_URI . '/images/icons/apple-touch-icon_76x76.png',
        ),
      ),
      array(
        'id'       => 'icon-ipad-retina',
        'type'     => 'media',
        'readonly' => false,
        'title'    => __( 'Apple iPad Retina Icon', 'wordtrap' ),
        'desc'     => __( 'Icon for Apple iPad Retina (152px X 152px)', 'wordtrap' ),
        'default'  => array(
          'url'    => WORDTRAP_URI . '/images/icons/apple-touch-icon_152x152.png',
        ),
      ),
    )
  )
);