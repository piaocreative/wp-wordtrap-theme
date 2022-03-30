<?php
/**
 * The right sidebar containing the main widget area
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Global Theme Options
global $wordtrap_options;

// Sidebar
$sidebar = isset( $wordtrap_options['post-right-sidebar'] ) ? $wordtrap_options['post-right-sidebar'] : '';

if ( $sidebar === '' || ! is_active_sidebar( $sidebar ) ) {
	return;
}
?>

<div class="col-md-3 widget-area" id="right-sidebar">

	<?php dynamic_sidebar( $sidebar ); ?>

</div><!-- #right-sidebar -->
