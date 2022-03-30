<?php
/**
 * The left sidebar containing the main widget area
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Sidebar
$sidebar = wordtrap_options( 'post-left-sidebar' );

if ( ! $sidebar || ! is_active_sidebar( $sidebar ) ) {
	return;
}
?>

<div class="col-md-3 widget-area" id="left-sidebar">

	<?php dynamic_sidebar( $sidebar ); ?>

</div><!-- #left-sidebar -->
