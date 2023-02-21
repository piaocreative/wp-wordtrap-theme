<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Main layout
$main_layout = wordtrap_main_layout();
$layout = $main_layout[ 'layout' ];
?>
<?php if ( in_array( $layout, array( 'full-right-sidebar', 'full-both-sidebars', 'right-sidebar', 'both-sidebars' ) ) ) : ?>
  <?php get_template_part( 'template-parts/sidebar/sidebar', 'right' ); ?>
<?php endif; ?>
