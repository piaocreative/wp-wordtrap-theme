<?php
/**
 * Template for displaying button
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Default Attributes
$align = isset( $attributes['align'] ) ? $attributes['align'] : '';
$block_id = isset( $attributes['id'] ) ? 'wordtrap-' . $attributes['id'] : '';
$className = isset( $attributes['className'] ) ? $attributes['className'] : '';

/**
 * Content fields
 */
$title = get_field( 'title' );
$link = get_field( 'link' );
$style = get_field( 'style' );
$outline = get_field( 'outline' );
$size = get_field( 'size' );
$active = get_field( 'active' );
$disabled = get_field( 'disabled' );
$display = get_field( 'display' );

// Link
$link_title = isset( $link['title'] ) ? $link['title'] : '';
$link_url = isset( $link['url'] ) ? $link['url'] : '';
$link_target = isset( $link['target'] ) ? $link['target'] : '';

// Classes
$classes = array( 'wordtrap-block', 'wordtrap-button', $className );
$sub_classes = array( 'btn' );
if ( $style != '-' ) $sub_classes[] = 'btn-' . ( $outline ? 'outline-' : '') . $style;
if ( $size != '-' ) $sub_classes[] = 'btn-' . $size;
if ( $active ) $sub_classes[] = 'active';

switch ( $align ) {
  case 'left': $classes[] = 'float-start'; break;
  case 'center': $classes[] = 'text-center'; break;
  case 'right': $classes[] = 'float-end'; break;
}

if ( $display == 'block' ) $classes[] = 'd-grid';

/**
 * Icon fields
 */
$show_icon = get_field( 'show_icon' );
$icon = get_field( 'icon' );
$icon_placement = get_field( 'icon_placement' );

/**
 * Design fields
 */
$style = $hover_style = '';

// Typography
$typography_title       = get_field( 'typography_title' );
$style .= wordtrap_acf_typography_style( $typography_title );

// Regular Colors
$color                  = get_field( 'color' );
$background_color       = get_field( 'background_color' );
$border_color           = get_field( 'border_color' );
if ( $color ) $style .= 'color:' . esc_attr( $color ) . ';';
if ( $background_color ) $style .= 'background-color:' . esc_attr( $background_color ) . ';';
if ( $border_color ) $style .= 'border-color:' . esc_attr( $border_color ) . ';';

// Hover Colors
$hover_color            = get_field( 'hover_color' );
$hover_background_color = get_field( 'hover_background_color' );
$hover_border_color     = get_field( 'hover_border_color' );
if ( $hover_color ) $hover_style .= 'color:' . esc_attr( $hover_color ) . ' !important;';
if ( $hover_background_color ) $hover_style .= 'background-color:' . esc_attr( $hover_background_color ) . ' !important;';
if ( $hover_border_color ) $hover_style .= 'border-color:' . esc_attr( $hover_border_color ) . ' !important;';

// Border
$border_width           = get_field( 'border_width' );
$border_radius          = get_field( 'border_radius' );
if ( $border_width != '' ) $style .= 'border-width:' . esc_attr( $border_width ) . 'px;';
if ( $border_radius[ 'top_left' ] != '' ) $style .= 'border-top-left-radius:' . esc_attr( $border_radius[ 'top_left' ] ) . 'px;';
if ( $border_radius[ 'top_right' ] != '' ) $style .= 'border-top-right-radius:' . esc_attr( $border_radius[ 'top_right' ] ) . 'px;';
if ( $border_radius[ 'bottom_left' ] != '' ) $style .= 'border-bottom-left-radius:' . esc_attr( $border_radius[ 'bottom_left' ] ) . 'px;';
if ( $border_radius[ 'bottom_right' ] != '' ) $style .= 'border-bottom-right-radius:' . esc_attr( $border_radius[ 'bottom_right' ] ) . 'px;';

// Margin
$margin = get_field( 'margin' );
if ( $margin[ 'top' ] != '' ) $style .= 'margin-top:' . esc_attr( $margin[ 'top' ] ) . 'px;';
if ( $margin[ 'right' ] != '' ) $style .= 'margin-right:' . esc_attr( $margin[ 'right' ] ) . 'px;';
if ( $margin[ 'bottom' ] != '' ) $style .= 'margin-bottom:' . esc_attr( $margin[ 'bottom' ] ) . 'px;';
if ( $margin[ 'left' ] != '' ) $style .= 'margin-left:' . esc_attr( $margin[ 'left' ] ) . 'px;';

// Padding
$padding = get_field( 'padding' );
if ( $padding[ 'top' ] != '' ) $style .= 'padding-top:' . esc_attr( $padding[ 'top' ] ) . 'px;';
if ( $padding[ 'right' ] != '' ) $style .= 'padding-right:' . esc_attr( $padding[ 'right' ] ) . 'px;';
if ( $padding[ 'bottom' ] != '' ) $style .= 'padding-bottom:' . esc_attr( $padding[ 'bottom' ] ) . 'px;';
if ( $padding[ 'left' ] != '' ) $style .= 'padding-left:' . esc_attr( $padding[ 'left' ] ) . 'px;';

if ( $style ) {
  $style = ' style="' . $style . '"';
}

if ( $hover_style ) :
  ?>
  <style>
    #<?php echo $block_id ?> .btn:hover,
    #<?php echo $block_id ?> .btn:focus {
      <?php echo $hover_style; ?>
    }
  </style>
  <?php   
endif;
?>

<div class="<?php echo esc_attr( implode( ' ', $classes ) ) ?>" id="<?php echo esc_attr( $block_id ) ?>">
  <?php if ( $link_url ) : 
    if ( $disabled ) $sub_classes[] = 'disabled';
    ?>
    <a <?php echo $link_target ? 'target="' . esc_attr( $link_target ) . '"' : '' ?>href="<?php echo esc_url( $link_url ) ?>" title="<?php echo esc_attr( $link_title ) ?>" class="<?php echo esc_attr( implode( ' ', $sub_classes ) ) ?>" role="button"<?php echo $disabled ? ' aria-disabled="true"' : '' ?><?php echo $style ? $style : '' ?>>
  <?php else : ?>
    <button type="button" class="<?php echo esc_attr( implode( ' ', $sub_classes ) ) ?>"<?php echo $disabled ? ' disabled' : '' ?><?php echo $style ? $style : '' ?>>
  <?php endif; ?>

  <?php 
  if ( $show_icon && $icon_placement !== 'right' ) {
    echo $icon . ' ';
  }

  echo $link_title;

  if ( $show_icon && $icon_placement === 'right' ) {
    echo ' ' . $icon;
  }
  ?>
  
  <?php if ( $link_url ) : ?>
    </a>
  <?php else : ?>
    </button>
  <?php endif; ?>  
</div>
