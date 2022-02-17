<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

	<div class="col-md-4 widget-area" id="secondary">

		<?php dynamic_sidebar( 'sidebar-1' ); ?>

	</div><!-- #secondary -->
