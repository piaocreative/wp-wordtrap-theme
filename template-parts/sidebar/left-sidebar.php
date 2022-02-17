<?php
/**
 * The left sidebar containing the main widget area
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'left-sidebar' ) ) {
	return;
}
?>

	<div class="col-md-3 widget-area" id="left-sidebar">

		<?php dynamic_sidebar( 'left-sidebar' ); ?>

	</div><!-- #left-sidebar -->
