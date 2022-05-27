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

// ACF Fields
$link = get_field( 'link' );
$style = get_field( 'style' );
$outline = get_field( 'outline' );
$size = get_field( 'size' );
$active = get_field( 'active' );
$disabled = get_field( 'disabled' );
$display = get_field( 'display' );

// Block ID
$block_id = 'wordtrap-' . $attributes['id'];

// Button link
$link_title = ( isset( $link['title'] ) && $link['title'] ) ? $link['title'] : '';
$link_url = ( isset( $link['url'] ) && $link['url'] ) ? $link['url'] : '';
$link_target = ( isset( $link['target'] ) && $link['target'] ) ? $link['target'] : '';

// Button classes
$classes = array( 'wordtrap-block', 'wordtrap-button' );
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

?>
<div class="<?php echo esc_attr( implode( ' ', $classes ) ) ?>" id="<?php echo esc_attr( $block_id ) ?>">
  <?php if ( $link_url ) : 
    if ( $disabled ) $sub_classes[] = 'disabled';
    ?>
    <a <?php echo $link_target ? 'target="' . esc_attr( $link_target ) . '"' : '' ?>href="<?php echo esc_url( $link_url ) ?>" title="<?php echo esc_attr( $link_title ) ?>" class="<?php echo esc_attr( implode( ' ', $sub_classes ) ) ?>" role="button"<?php echo $disabled ? ' aria-disabled="true"' : '' ?>>
      <?php echo $link_title ?>
    </a>
  <?php else : ?>
    <button type="button" class="<?php echo esc_attr( implode( ' ', $sub_classes ) ) ?>"<?php echo $disabled ? ' disabled' : '' ?>>Button</button>
  <?php endif; ?>  
</div>