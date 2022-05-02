<?php
/**
 * The theme member general options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'        => esc_html__( 'General', 'wordtrap' ),
    'id'           => 'wordtrap-member-general',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'          => 'enable-member',
        'type'        => 'switch',
        'title'       => esc_html__( 'Member', 'wordtrap' ),
        'default'     => true,
        'on'          => esc_html__( 'Enable', 'wordtrap' ),
        'off'         => esc_html__( 'Disable', 'wordtrap' ),
      ),
      array(
        'id'          => 'member-slug-name',
        'type'        => 'text',
        'title'       => esc_html__( 'Slug Name', 'wordtrap' ),
        'placeholder' => 'member',
      ),
      array(
        'id'          => 'member-name',
        'type'        => 'text',
        'title'       => esc_html__( 'Name', 'wordtrap' ),
        'placeholder' => esc_html__( 'Members', 'wordtrap' ),
      ),
      array(
        'id'          => 'member-singular-name',
        'type'        => 'text',
        'title'       => esc_html__( 'Singular Name', 'wordtrap' ),
        'placeholder' => esc_html__( 'Member', 'wordtrap' ),
      ),
      array(
        'id'          => 'member-cat-slug-name',
        'type'        => 'text',
        'title'       => esc_html__( 'Category Slug Name', 'wordtrap' ),
        'placeholder' => 'member_cat',
      ),
      array(
        'id'          => 'member-cat-name',
        'type'        => 'text',
        'title'       => esc_html__( 'Category Name', 'wordtrap' ),
        'placeholder' => 'Member Category',
      ),
      array(
        'id'          => 'member-cats-name',
        'type'        => 'text',
        'title'       => esc_html__( 'Categories Name', 'wordtrap' ),
        'placeholder' => 'Member Categories',
      ),
      array(
        'id'          => 'members-page',
        'type'        => 'select',
        'data'        => 'page',
        'title'       => esc_html__( 'Members Page', 'wordtrap' ),
      ),      
    )
  )
);