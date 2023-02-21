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
    'id'           => 'wordtrap-global-logo',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'       => 'logo',
        'type'     => 'media',
        'readonly' => false,
        'title'    => esc_html__( 'Logo', 'wordtrap' ),
        'default'  => array(
          'url'    => WORDTRAP_URI . '/images/logo/logo.png',
        ),
      ),
      array(
        'id'       => 'logo-retina',
        'type'     => 'media',
        'readonly' => false,
        'title'    => esc_html__( 'Retina Logo', 'wordtrap' ),
      ),
    )
  )
);