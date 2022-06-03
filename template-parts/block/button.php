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
$align = $attributes['align'];
$block_id = 'wordtrap-' . $attributes['id'];
$className = $attributes['className'];

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

// Button link
$link_title = isset( $link['title'] ) ? $link['title'] : '';
$link_url = isset( $link['url'] ) ? $link['url'] : '';
$link_target = isset( $link['target'] ) ? $link['target'] : '';

// Button classes
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

// Button styles
$customize = get_field( 'customize' );
if ( $customize ) { 
  $button = get_field( 'button' );
  $typography_title = $button[ 'typography_title' ];
  $color = $button[ 'color' ];
  $background_color = $button[ 'background_color' ];
  $border_color = $button[ 'border_color' ];
  $hover_color = $button[ 'hover_color' ];
  $hover_background_color = $button[ 'hover_background_color' ];
  $hover_border_color = $button[ 'hover_border_color' ];
  $border_width = $button[ 'border_width' ];
  $border_radius = $button['border_radius'];
  $margin = get_field( 'margin' );
  $padding = get_field( 'padding' );

  $style .= wordtrap_acf_typography_style( $typography_title );
  if ( $color ) $style .= 'color:' . esc_attr( $color ) . ';';
  if ( $background_color ) $style .= 'background-color:' . esc_attr( $background_color ) . ';';
  if ( $border_color ) $style .= 'border-color:' . esc_attr( $border_color ) . ';';
  if ( $border_width != '' ) $style .= 'border-width:' . esc_attr( $border_width ) . 'px;';
  if ( $border_radius[ 'top_left' ] != '' ) $style .= 'border-top-left-radius:' . esc_attr( $border_radius[ 'top_left' ] ) . 'px;';
  if ( $border_radius[ 'top_right' ] != '' ) $style .= 'border-top-right-radius:' . esc_attr( $border_radius[ 'top_right' ] ) . 'px;';
  if ( $border_radius[ 'bottom_left' ] != '' ) $style .= 'border-bottom-left-radius:' . esc_attr( $border_radius[ 'bottom_left' ] ) . 'px;';
  if ( $border_radius[ 'bottom_right' ] != '' ) $style .= 'border-bottom-right-radius:' . esc_attr( $border_radius[ 'bottom_right' ] ) . 'px;';

  if ( $hover_color ) $hover_style .= 'color:' . esc_attr( $hover_color ) . ' !important;';
  if ( $hover_background_color ) $hover_style .= 'background-color:' . esc_attr( $hover_background_color ) . ' !important;';
  if ( $hover_border_color ) $hover_style .= 'border-color:' . esc_attr( $hover_border_color ) . ' !important;';
}

// Margin
if ( $margin[ 'margin_top' ] != '' ) $style .= 'margin-top:' . esc_attr( $margin[ 'margin_top' ] ) . 'px;';
if ( $margin[ 'margin_right' ] != '' ) $style .= 'margin-right:' . esc_attr( $margin[ 'margin_right' ] ) . 'px;';
if ( $margin[ 'margin_bottom' ] != '' ) $style .= 'margin-bottom:' . esc_attr( $margin[ 'margin_bottom' ] ) . 'px;';
if ( $margin[ 'margin_left' ] != '' ) $style .= 'margin-left:' . esc_attr( $margin[ 'margin_left' ] ) . 'px;';

// Padding
if ( $padding[ 'padding_top' ] != '' ) $style .= 'padding-top:' . esc_attr( $padding[ 'padding_top' ] ) . 'px;';
if ( $padding[ 'padding_right' ] != '' ) $style .= 'padding-right:' . esc_attr( $padding[ 'padding_right' ] ) . 'px;';
if ( $padding[ 'padding_bottom' ] != '' ) $style .= 'padding-bottom:' . esc_attr( $padding[ 'padding_bottom' ] ) . 'px;';
if ( $padding[ 'padding_left' ] != '' ) $style .= 'padding-left:' . esc_attr( $padding[ 'padding_left' ] ) . 'px;';

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
  if ( $show_icon && $icon_placement != 'right' ) {
    echo $icon . ' ';
  }

  echo $link_title;

  if ( $show_icon && $icon_placement == 'right' ) {
    echo ' ' . $icon;
  }
  ?>
  
  <?php if ( $link_url ) : ?>
    </a>
  <?php else : ?>
    </button>
  <?php endif; ?>  
</div>
