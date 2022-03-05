<?php
/**
 * The theme javascript options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

defined( 'ABSPATH' ) || exit;

Redux::set_section(
	$opt_name,
	array(
		'title'          => esc_html__( 'Javascript Code', 'wordtrap' ),
		'id'             => 'wordtrap-global-javascript',
		'subsection'     => true,
		'fields'         => array(
			array(
				'id'         => 'js-code-head',
				'type'       => 'ace_editor',
				'title'      => esc_html__( 'JS Code before &lt;/head&gt;', 'wordtrap' ),
				'subtitle'   => esc_html__( 'Paste your custom JavaScript code here.', 'wordtrap' ),
				'mode'       => 'javascript',
				'default'    => '',
				'full_width' => true,
				'options'    => array(
					'height'   => 250,
					'minLines' => 15,
					'maxLines' => 25,
				),
			),
			array(
				'id'         => 'js-code',
				'type'       => 'ace_editor',
				'title'      => esc_html__( 'JS Code before &lt;/body&gt;', 'wordtrap' ),
				'subtitle'   => esc_html__( 'Paste your custom JavaScript code here.', 'wordtrap' ),
				'mode'       => 'javascript',
				'default'    => '',
				'full_width' => true,
				'options'    => array(
					'height'   => 250,
					'minLines' => 15,
					'maxLines' => 25,
				),
			),
    )
  )
);