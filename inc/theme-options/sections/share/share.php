<?php
/**
 * The theme social share options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'Social Share', 'wordtrap' ),
		'id'               => 'wordtrap-share',
		'customizer_width' => '400px',
		'icon'             => 'dashicons-before dashicons-share',
		'fields'           => array(
      array(
        'id'       => 'social-share',
        'type'     => 'switch',
        'title'    => esc_html__( 'Social Share', 'wordtrap' ),
        'default'  => true,
        'on'       => esc_html__( 'Enable', 'wordtrap' ),
        'off'      => esc_html__( 'Disable', 'wordtrap' ),
      ),
      array(
        'id'       => 'share-nofollow',
        'type'     => 'switch',
        'title'    => esc_html__( 'No Follow Share', 'wordtrap' ),
        'required' => array( 'social-share', 'equals', true ),
        'default'  => true,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'share-facebook',
        'type'     => 'switch',
        'title'    => esc_html__( 'Facebook', 'wordtrap' ),
        'required' => array( 'social-share', 'equals', true ),
        'default'  => true,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'share-twitter',
        'type'     => 'switch',
        'title'    => esc_html__( 'Twitter', 'wordtrap' ),
        'required' => array( 'social-share', 'equals', true ),
        'default'  => true,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'share-linkedin',
        'type'     => 'switch',
        'title'    => esc_html__( 'LinkedIn', 'wordtrap' ),
        'required' => array( 'social-share', 'equals', true ),
        'default'  => true,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'share-googleplus',
        'type'     => 'switch',
        'title'    => esc_html__( 'Google +', 'wordtrap' ),
        'required' => array( 'social-share', 'equals', true ),
        'default'  => true,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'share-pinterest',
        'type'     => 'switch',
        'title'    => esc_html__( 'Pinterest', 'wordtrap' ),
        'required' => array( 'social-share', 'equals', true ),
        'default'  => false,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'share-email',
        'type'     => 'switch',
        'title'    => esc_html__( 'Email', 'wordtrap' ),
        'required' => array( 'social-share', 'equals', true ),
        'default'  => true,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'share-vk',
        'type'     => 'switch',
        'title'    => esc_html__( 'VK', 'wordtrap' ),
        'required' => array( 'social-share', 'equals', true ),
        'default'  => false,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'share-xing',
        'type'     => 'switch',
        'title'    => esc_html__( 'Xing', 'wordtrap' ),
        'required' => array( 'social-share', 'equals', true ),
        'default'  => false,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'share-tumblr',
        'type'     => 'switch',
        'title'    => esc_html__( 'Tumblr', 'wordtrap' ),
        'required' => array( 'social-share', 'equals', true ),
        'default'  => false,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'share-reddit',
        'type'     => 'switch',
        'title'    => esc_html__( 'Reddit', 'wordtrap' ),
        'required' => array( 'social-share', 'equals', true ),
        'default'  => false,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
      array(
        'id'       => 'share-whatsapp',
        'type'     => 'switch',
        'title'    => esc_html__( 'WhatsApp', 'wordtrap' ),
        'required' => array( 'social-share', 'equals', true ),
        'default'  => false,
        'on'       => esc_html__( 'Yes', 'wordtrap' ),
        'off'      => esc_html__( 'No', 'wordtrap' ),
      ),
    )
  )
);