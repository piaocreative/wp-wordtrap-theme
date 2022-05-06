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
          'format'     => esc_html__( 'Format', 'wordtrap' ),
          'comments'   => esc_html__( 'Comments', 'wordtrap' ),
          'tags'       => esc_html__( 'Tags', 'wordtrap' ),
        ),
        'default'      => array( 'date', 'author', 'cats', 'format', 'comments', 'tags' ),
      ),
    )
  )
);