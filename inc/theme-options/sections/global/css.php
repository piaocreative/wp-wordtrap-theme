<?php
/**
 * The theme css options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
  $opt_name,
  array(
    'title'          => esc_html__( 'Custom CSS', 'wordtrap' ),
    'id'             => 'wordtrap-global-css',
    'subsection'     => true,
    'fields'         => array(
      array(
        'id'         => 'css-code',
        'type'       => 'ace_editor',
        'title'      => esc_html__( 'CSS Code', 'wordtrap' ),
        'subtitle'   => esc_html__( 'Paste your custom CSS code here.', 'wordtrap' ),
        'mode'       => 'css',
        'default'    => '',
        'full_width' => true,
        'theme'      => 'chrome',
        'options'    => array(
          'height'   => 450,
          'minLines' => 40,
          'maxLines' => 50,
        ),
      ),
    )
  )
);