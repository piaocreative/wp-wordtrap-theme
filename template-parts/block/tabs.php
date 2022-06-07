<?php
/**
 * Template for displaying tabs
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Default Attributes
$block_id = isset( $attributes['id'] ) ? 'wordtrap-' . $attributes['id'] : '';
$className = isset( $attributes['className'] ) ? $attributes['className'] : '';

/**
 * Content fields
 */
$tabs = get_field( 'tabs' );

// Classes
$classes = array( 'wordtrap-block', 'wordtrap-tabs', $className );
$tabs_classes = array();

/** 
 * Design Fields
 */
$style = get_field( 'style' );
$direction = get_field( 'direction' );
$tab_classes[] = 'nav-' . $style;
$position = get_field( 'position' );

if ( $direction === 'horizontal' ) {
  switch ( get_field( 'horizontal_alignment' ) ) {
    case 'fill': $tab_classes[] = 'nav-fill'; break;
    case 'justify': $tab_classes[] = 'nav-justified'; break;
    default: $tab_classes[] = 'justify-content-' . get_field( 'horizontal_alignment' );
  }
}

if ( $direction === 'vertical' ) {
  $classes[] = 'd-flex';
  $tab_classes[] = 'flex-column';
  $tab_classes[] = 'justify-content-' . get_field( 'vertical_alignment' );
}

if ( $position === 'after' && $style === 'tabs') {
  $tab_classes[] = 'nav-tabs-bottom';
}

$block_style = $title_style = $title_active_style = $content_style = '';

// Typography
$title_style = wordtrap_acf_typography_style( get_field( 'typography_title' ) );
$content_style = wordtrap_acf_typography_style( get_field( 'typography_content' ) );

// Colors
$title_active_background = get_field( 'title_active_background' );
if ( $title_active_background ) {
  $title_active_style .= 'background-color:' . $title_active_background . ';';
}
$title_active_color = get_field( 'title_active_color' );
if ( $title_active_color ) {
  $title_active_style .= 'color:' . $title_active_color . ';';
}

$title_background = get_field( 'title_background' );
if ( $title_background ) {
  $title_style .= 'background-color:' . $title_background . ';';
}
$title_color = get_field( 'title_color' );
if ( $title_color ) {
  $title_style .= 'color:' . $title_color . ';';
}

$content_background = get_field( 'content_background' );
if ( $content_background ) {
  $content_style .= 'background-color:' . $content_background . ';';
}
$content_color = get_field( 'content_color' );
if ( $content_color ) {
  $content_style .= 'color:' . $content_color . ';';
}

// Spacing
$margin = get_field( 'margin' );
if ( $margin[ 'top' ] != '' ) $block_style .= 'margin-top:' . esc_attr( $margin[ 'top' ] ) . 'px;';
if ( $margin[ 'right' ] != '' ) $block_style .= 'margin-right:' . esc_attr( $margin[ 'right' ] ) . 'px;';
if ( $margin[ 'bottom' ] != '' ) $block_style .= 'margin-bottom:' . esc_attr( $margin[ 'bottom' ] ) . 'px;';
if ( $margin[ 'left' ] != '' ) $block_style .= 'margin-left:' . esc_attr( $margin[ 'left' ] ) . 'px;';

$padding = get_field( 'padding' );
if ( $padding[ 'top' ] != '' ) $block_style .= 'padding-top:' . esc_attr( $padding[ 'top' ] ) . 'px;';
if ( $padding[ 'right' ] != '' ) $block_style .= 'padding-right:' . esc_attr( $padding[ 'right' ] ) . 'px;';
if ( $padding[ 'bottom' ] != '' ) $block_style .= 'padding-bottom:' . esc_attr( $padding[ 'bottom' ] ) . 'px;';
if ( $padding[ 'left' ] != '' ) $block_style .= 'padding-left:' . esc_attr( $padding[ 'left' ] ) . 'px;';

$title_margin = get_field( 'title_margin' );
if ( $title_margin[ 'top' ] != '' ) $title_style .= 'margin-top:' . esc_attr( $title_margin[ 'top' ] ) . 'px;';
if ( $title_margin[ 'right' ] != '' ) $title_style .= 'margin-right:' . esc_attr( $title_margin[ 'right' ] ) . 'px;';
if ( $title_margin[ 'bottom' ] != '' ) $title_style .= 'margin-bottom:' . esc_attr( $title_margin[ 'bottom' ] ) . 'px;';
if ( $title_margin[ 'left' ] != '' ) $title_style .= 'margin-left:' . esc_attr( $title_margin[ 'left' ] ) . 'px;';

$title_padding = get_field( 'title_padding' );
if ( $title_padding[ 'top' ] != '' ) $title_style .= 'padding-top:' . esc_attr( $title_padding[ 'top' ] ) . 'px;';
if ( $title_padding[ 'right' ] != '' ) $title_style .= 'padding-right:' . esc_attr( $title_padding[ 'right' ] ) . 'px;';
if ( $title_padding[ 'bottom' ] != '' ) $title_style .= 'padding-bottom:' . esc_attr( $title_padding[ 'bottom' ] ) . 'px;';
if ( $title_padding[ 'left' ] != '' ) $title_style .= 'padding-left:' . esc_attr( $title_padding[ 'left' ] ) . 'px;';

$content_margin = get_field( 'content_margin' );
if ( $content_margin[ 'top' ] != '' ) $content_style .= 'margin-top:' . esc_attr( $content_margin[ 'top' ] ) . 'px;';
if ( $content_margin[ 'right' ] != '' ) $content_style .= 'margin-right:' . esc_attr( $content_margin[ 'right' ] ) . 'px;';
if ( $content_margin[ 'bottom' ] != '' ) $content_style .= 'margin-bottom:' . esc_attr( $content_margin[ 'bottom' ] ) . 'px;';
if ( $content_margin[ 'left' ] != '' ) $content_style .= 'margin-left:' . esc_attr( $content_margin[ 'left' ] ) . 'px;';

$content_padding = get_field( 'content_padding' );
if ( $content_padding[ 'top' ] != '' ) $content_style .= 'padding-top:' . esc_attr( $content_padding[ 'top' ] ) . 'px;';
if ( $content_padding[ 'right' ] != '' ) $content_style .= 'padding-right:' . esc_attr( $content_padding[ 'right' ] ) . 'px;';
if ( $content_padding[ 'bottom' ] != '' ) $content_style .= 'padding-bottom:' . esc_attr( $content_padding[ 'bottom' ] ) . 'px;';
if ( $content_padding[ 'left' ] != '' ) $content_style .= 'padding-left:' . esc_attr( $content_padding[ 'left' ] ) . 'px;';

if ( $block_style || $title_style || $title_active_style || $content_style ) : 
?>
<style>
  <?php if ( $block_style ) : ?>
    #<?php echo $block_id ?> {
      <?php echo $block_style; ?>
    }
  <?php endif; ?>
  <?php if ( $title_style ) : ?>
    #<?php echo $block_id ?> .nav-link {
      <?php echo $title_style; ?>
    }
  <?php endif; ?>
  <?php if ( $title_active_style ) : ?>
    #<?php echo $block_id ?> .nav-link.active, 
    #<?php echo $block_id ?> .nav-item.show .nav-link {
      <?php echo $title_active_style; ?>
    }
  <?php endif; ?>
  <?php if ( $content_style ) : ?>
    #<?php echo $block_id ?> .tab-content {
      <?php echo $content_style; ?>
    }
  <?php endif; ?>
</style>
<?php endif; ?>

<div class="<?php echo esc_attr( implode( ' ', $classes ) ) ?>" id="<?php echo esc_attr( $block_id ) ?>">
  <?php if ( $position === 'after') : ?>
    <div class="tab-content">
    <?php 
    foreach ( $tabs as $index => $tab ) : 
      $tab_controlls = $block_id . '_' . ( $index + 1 );
      ?>
      <div class="tab-pane fade<?php echo $tab['active'] ? ' show active' : '' ?>" id="<?php echo esc_attr( $tab_controlls ) ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr( $tab_controlls ) ?>-tab">
        <?php echo wpautop( $tab['content'] ); ?>
      </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>

  <ul class="nav <?php echo esc_attr( implode( ' ', $tab_classes ) ) ?>" role="tablist">
    <?php 
    foreach ( $tabs as $index => $tab ) : 
      $tab_controlls = $block_id . '_' . ( $index + 1 );
      ?>
      <li class="nav-item" role="presentation">
        <a class="nav-link<?php echo $tab['active'] ? ' active' : '' ?>" id="<?php echo esc_attr( $tab_controlls ) ?>-tab" data-bs-toggle="tab" data-bs-target="#<?php echo esc_attr( $tab_controlls ) ?>" role="tab" aria-controls="<?php echo esc_attr( $tab_controlls ) ?>" aria-selected="true">
          <?php 
          if ( $tab['show_icon'] && $tab['icon_placement'] !== 'right' ) {
            echo $tab['icon'] . ' ';
          }

          echo $tab['title'];

          if ( $tab['show_icon'] && $tab['icon_placement'] === 'right' ) {
            echo ' ' . $tab['icon'];
          }
          ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>

  <?php if ( $position !== 'after') : ?>
    <div class="tab-content">
      <?php 
      foreach ( $tabs as $index => $tab ) : 
        $tab_controlls = $block_id . '_' . ( $index + 1 );
        ?>
        <div class="tab-pane fade<?php echo $tab['active'] ? ' show active' : '' ?>" id="<?php echo esc_attr( $tab_controlls ) ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr( $tab_controlls ) ?>-tab">
          <?php echo wpautop( $tab['content'] ); ?>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>