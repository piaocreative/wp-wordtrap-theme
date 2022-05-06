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
    'icon'             => 'dashicons-before dashicons-align-full-width',
    'fields'           => array(
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
        'id'            => 'header-layout',
        'type'          => 'image_select',
        'title'         => esc_html__( 'Header Layout', 'wordtrap' ),
        'options'       => $layout_options,
        'default'       => 'full',
      ),
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
        'id'            => 'header-reveal',
        'type'          => 'switch',
        'title'         => esc_html__( 'Reveal Effect', 'wordtrap' ),
        'default'       => false,
        'on'            => esc_html__( 'Enable', 'wordtrap' ),
        'off'           => esc_html__( 'Disable', 'wordtrap' ),
      ),      
      array(
        'id'            => 'header-login-link',
        'type'          => 'text',
        'title'         => esc_html__( 'Login URL', 'wordtrap' ),
        'validate'      => array( 'url' ),
        'default'       => site_url( 'wp-login.php' ),
      ),
      array(
        'id'            => 'header-logout-link',
        'type'          => 'text',
        'title'         => esc_html__( 'Logout URL', 'wordtrap' ),
        'validate'      => array( 'url' ),
        'default'       => site_url( 'wp-login.php?action=logout' ),
      ),
      array(
        'id'            => 'sticky-header-start',
        'type'          => 'section',
        'title'         => esc_html__( 'Sticky Headers based on Breakpoints', 'wordtrap' ),
        'indent'        => true,
      ),
      array(
        'id'            => 'show-sticky-header',
        'type'          => 'switch',
        'title'         => esc_html__( 'Extra Extra Large', 'wordtrap' ),
        'default'       => true,
        'on'            => esc_html__( 'Show', 'wordtrap' ),
        'off'           => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'            => 'show-sticky-header-xl',
        'type'          => 'switch',
        'title'         => esc_html__( 'Extra Large', 'wordtrap' ),
        'default'       => true,
        'on'            => esc_html__( 'Show', 'wordtrap' ),
        'off'           => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'            => 'show-sticky-header-lg',
        'type'          => 'switch',
        'title'         => esc_html__( 'Large', 'wordtrap' ),
        'default'       => true,
        'on'            => esc_html__( 'Show', 'wordtrap' ),
        'off'           => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'            => 'show-sticky-header-md',
        'type'          => 'switch',
        'title'         => esc_html__( 'Medium', 'wordtrap' ),
        'default'       => true,
        'on'            => esc_html__( 'Show', 'wordtrap' ),
        'off'           => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'            => 'show-sticky-header-sm',
        'type'          => 'switch',
        'title'         => esc_html__( 'Small', 'wordtrap' ),
        'default'       => true,
        'on'            => esc_html__( 'Show', 'wordtrap' ),
        'off'           => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'            => 'show-sticky-header-xs',
        'type'          => 'switch',
        'title'         => esc_html__( 'Extra Small', 'wordtrap' ),
        'default'       => true,
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