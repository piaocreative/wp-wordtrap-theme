<?php
/**
 * Block editor (gutenberg) specific functionality
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


if ( ! function_exists( 'wordtrap_generate_color_palette' ) ) {
	/**
	 * Checks for our JSON file of color values. If exists, creates a color palette array.
	 *
	 * @return array|bool
	 */
	function wordtrap_generate_color_palette() {
		$color_palette = array();

		ob_start();
    require get_theme_file_path( '/inc/helpers/editor/editor-color-palette.php' );
    $color_palette_json = ob_get_clean();

		if ( $color_palette_json ) {
			$color_palette_json = json_decode( $color_palette_json, true );
			foreach ( $color_palette_json as $key => $value ) {
				$key             = str_replace( array( '--bs-', '--' ), '', $key );
				$color_palette[] = array(
					'name'  => $key,
					'slug'  => $key,
					'color' => $value,
				);
			}
		}

		/**
		 * Filters the default bootstrap color palette so it can be overriden by child themes or plugins when we add theme support for editor-color-palette. This array can also be generated via gulp.
		 *
		 * @param array $color_palette An array of color options for the editor-color-palette setting.
		 */
		return apply_filters( 'wordtrap_theme_editor_color_palette', $color_palette );
	}
}
