<?php
/**
 * Post functions
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_generate_post_formats' ) ) {
	/**
	 * Generate the Post Formats
	 *
	 * @return array
	 */
	function wordtrap_generate_post_formats() {
		return array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		);
	}
}
