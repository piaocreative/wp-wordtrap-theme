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
<?php if ( in_array( $layout, array( 'wide-left-sidebar', 'wide-both-sidebars', 'left-sidebar', 'both-sidebars' ) ) ) : ?>
  <?php get_template_part( 'template-parts/sidebar/sidebar', 'left' ); ?>
<?php endif; ?>
            
<?php if ( in_array( $layout, array( 'wide-right-sidebar', 'wide-both-sidebars', 'right-sidebar', 'both-sidebars' ) ) ) : ?>
  <?php get_template_part( 'template-parts/sidebar/sidebar', 'right' ); ?>
<?php endif; ?>
