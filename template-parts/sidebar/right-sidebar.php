<?php
/**
 * The right sidebar containing the main widget area
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'right-sidebar' ) ) {
	return;
}
?>

<div class="col-md-3 widget-area" id="right-sidebar">

	<?php dynamic_sidebar( 'right-sidebar' ); ?>

</div><!-- #right-sidebar -->
