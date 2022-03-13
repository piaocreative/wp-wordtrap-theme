<?php
/**
 * The theme related post options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'        => esc_html__( 'Related', 'wordtrap' ),
    'id'           => 'wordtrap-post-related',
    'subsection'   => true,
    'fields'       => array(
      array(
        'id'       => 'post-related-image-size',
        'type'     => 'dimensions',
        'title'    => esc_html__( 'Image Size', 'wordtrap' ),
        'desc'     => esc_html__( 'Please regenerate all the thumbnails after save.', 'wordtrap' ),
        'default'  => array(
          'width'  => '450',
          'height' => '250',
        ),
      ),
      array(
        'id'       => 'post-related-view',
        'type'     => 'image_select',
        'title'    => esc_html__( 'View Type', 'wordtrap' ),
        'options'  => $post_related_view_options,
        'default'  => '1',
      ),
      array(
        'id'       => 'post-related-excerpt-length',
        'type'     => 'text',
        'title'    => esc_html__( 'Excerpt Length', 'wordtrap' ),
        'desc'     => esc_html__( 'The number of words', 'wordtrap' ),
        'validate' => array( 'numeric', 'not_empty' ),
        'default'  => '20',
      ),
      array(
        'id'       => 'post-related-excerpt-base',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Basis for Excerpt Length', 'wordtrap' ),
        'options'  => array(
          'words'      => esc_html__( 'Words', 'wordtrap' ),
          'characters' => esc_html__( 'Characters', 'wordtrap' ),
        ),
        'default'  => 'words',
      ),
      array(
        'id'       => 'post-related-thumb-bg',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Image Overlay', 'wordtrap' ),
        'options'  => array(
          ''          => esc_html__( 'Normal', 'wordtrap' ),
          'darken'    => esc_html__( 'Darken', 'wordtrap' ),
          'lighten'   => esc_html__( 'Lighten', 'wordtrap' ),          
        ),
        'default'  => '',
      ),
      array(
        'id'       => 'post-related-thumb-hover',
        'type'     => 'button_set',
        'title'    => esc_html__( 'Image Hover Effect', 'wordtrap' ),
        'options'  => array(
          ''          => esc_html__( 'None', 'wordtrap' ),
          'zoom'      => esc_html__( 'Zoom', 'wordtrap' ),          
        ),
        'default'  => '',
      ),      
    )
  )
);