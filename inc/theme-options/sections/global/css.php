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
		'id'             => 'wordtrap-css',
		'subsection'     => true,
		'fields'         => array(
      array(
				'id'         => 'css-code',
				'type'       => 'ace_editor',
				'title'      => __( 'CSS Code', 'wordtrap' ),
				'subtitle'   => __( 'Paste your custom CSS code here.', 'wordtrap' ),
				'mode'       => 'css',
				'default'    => '',
        'full_width' => true,
				'options'    => array(
					'height'   => 450,
					'minLines' => 40,
					'maxLines' => 50,
				),
			),
    )
  )
);