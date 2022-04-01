<?php
/**
 * The theme post general options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'        => esc_html__( 'General', 'wordtrap' ),
    'id'           => 'wordtrap-post-general',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'           => 'show-post-format',
        'type'         => 'switch',
        'title'        => esc_html__( 'Post Format', 'wordtrap' ),
        'default'      => false,
        'on'           => esc_html__( 'Show', 'wordtrap' ),
        'off'          => esc_html__( 'Hide', 'wordtrap' ),
      ),
      array(
        'id'           => 'sticky-post-label',
        'type'         => 'text',
        'title'        => esc_html__( 'Sticky Post Label', 'wordtrap' ),
        'default'      => '',
      ),
      array(
        'id'           => 'post-metas',
        'type'         => 'button_set',
        'title'        => esc_html__( 'Post Metas', 'wordtrap' ),
        'multi'        => true,
        'options'      => array(
          'date'       => esc_html__( 'Date', 'wordtrap' ),
          'author'     => esc_html__( 'Author', 'wordtrap' ),
          'cats'       => esc_html__( 'Categories', 'wordtrap' ),
          'tags'       => esc_html__( 'Tags', 'wordtrap' ),
          'comments'   => esc_html__( 'Comments', 'wordtrap' ),
        ),
        'default'      => array( 'date', 'author', 'cats', 'tags', 'comments' ),
      ),
      // array(
      //   'id'           => 'post-meta-position',
      //   'type'         => 'button_set',
      //   'title'        => esc_html__( 'Post Metas Position', 'wordtrap' ),
      //   'options'      => array(
      //     ''           => esc_html__( 'Normal', 'wordtrap' ),
      //     'after'      => esc_html__( 'After Content', 'wordtrap' ),
      //     'before'     => esc_html__( 'Before Content', 'wordtrap' ),
      //   ),
      //   'default'      => '',
      // ),
    )
  )
);