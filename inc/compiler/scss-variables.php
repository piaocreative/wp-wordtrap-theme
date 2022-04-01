<?php
/**
 * Load scss variables
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

global $wordtrap_options;
$g = $wordtrap_options;
?>
//--------------- Colors ---------------//

// Body Colors
<?php if ( $g['body-bg'] ) : ?>
$body-bg:                     <?php echo $g['body-bg'] ?>;
<?php endif ?>
<?php if ( $g['body-color'] ) : ?>
$body-color:                  <?php echo $g['body-color'] ?>;
<?php endif ?>

// Theme Colors
<?php if ( $g['primary'] ) : ?>
$primary:                     <?php echo $g['primary'] ?>;
<?php endif ?>
<?php if ( $g['secondary'] ) : ?>
$secondary:                   <?php echo $g['secondary'] ?>;
<?php endif ?>
<?php if ( $g['success'] ) : ?>
$success:                     <?php echo $g['success'] ?>;
<?php endif ?>
<?php if ( $g['info'] ) : ?>
$info:                        <?php echo $g['info'] ?>;
<?php endif ?>
<?php if ( $g['warning'] ) : ?>
$warning:                     <?php echo $g['warning'] ?>;
<?php endif ?>
<?php if ( $g['danger'] ) : ?>
$danger:                      <?php echo $g['danger'] ?>;
<?php endif ?>
<?php if ( $g['light'] ) : ?>
$light:                       <?php echo $g['light'] ?>;
<?php endif ?>
<?php if ( $g['dark'] ) : ?>
$dark:                        <?php echo $g['dark'] ?>;
<?php endif ?>
$min-contrast-ratio:          3.5;

// Grays
<?php if ( $g['white'] ) : ?>
$white:                       <?php echo $g['white'] ?>;
<?php endif ?>
<?php if ( $g['gray-100'] ) : ?>
$gray-100:                    <?php echo $g['gray-100'] ?>;
<?php endif ?>
<?php if ( $g['gray-200'] ) : ?>
$gray-200:                    <?php echo $g['gray-200'] ?>;
<?php endif ?>
<?php if ( $g['gray-300'] ) : ?>
$gray-300:                    <?php echo $g['gray-300'] ?>;
<?php endif ?>
<?php if ( $g['gray-400'] ) : ?>
$gray-400:                    <?php echo $g['gray-400'] ?>;
<?php endif ?>
<?php if ( $g['gray-500'] ) : ?>
$gray-500:                    <?php echo $g['gray-500'] ?>;
<?php endif ?>
<?php if ( $g['gray-600'] ) : ?>
$gray-600:                    <?php echo $g['gray-600'] ?>;
<?php endif ?>
<?php if ( $g['gray-700'] ) : ?>
$gray-700:                    <?php echo $g['gray-700'] ?>;
<?php endif ?>
<?php if ( $g['gray-800'] ) : ?>
$gray-800:                    <?php echo $g['gray-800'] ?>;
<?php endif ?>
<?php if ( $g['gray-900'] ) : ?>
$gray-900:                    <?php echo $g['gray-900'] ?>;
<?php endif ?>
<?php if ( $g['black'] ) : ?>
$black:                       <?php echo $g['black'] ?>;
<?php endif ?>

//--------------- Layout ---------------//

// Grid Breakpoints
$grid-breakpoints: (
  xs: 0,
  sm: <?php echo intval( $g['grid-breakpoints-sm']['width'] ) ? intval( $g['grid-breakpoints-sm']['width'] ) : 576 ?>px,
  md: <?php echo intval( $g['grid-breakpoints-md']['width'] ) ? intval( $g['grid-breakpoints-md']['width'] ) : 768 ?>px,
  lg: <?php echo intval( $g['grid-breakpoints-lg']['width'] ) ? intval( $g['grid-breakpoints-lg']['width'] ) : 992 ?>px,
  xl: <?php echo intval( $g['grid-breakpoints-xl']['width'] ) ? intval( $g['grid-breakpoints-xl']['width'] ) : 1200 ?>px,
  xxl: <?php echo intval( $g['grid-breakpoints-xxl']['width'] ) ? intval( $g['grid-breakpoints-xxl']['width'] ) : 1400 ?>px,
);

// Container Max Widths
$container-max-widths: (
  sm: <?php echo intval( $g['container-max-widths-sm']['width'] ) ? intval( $g['container-max-widths-sm']['width'] ) : 540 ?>px,
  md: <?php echo intval( $g['container-max-widths-md']['width'] ) ? intval( $g['container-max-widths-md']['width'] ) : 720 ?>px,
  lg: <?php echo intval( $g['container-max-widths-lg']['width'] ) ? intval( $g['container-max-widths-lg']['width'] ) : 960 ?>px,
  xl: <?php echo intval( $g['container-max-widths-xl']['width'] ) ? intval( $g['container-max-widths-xl']['width'] ) : 1140 ?>px,
  xxl: <?php echo intval( $g['container-max-widths-xxl']['width'] ) ? intval( $g['container-max-widths-xxl']['width'] ) : 1320 ?>px,
);

// Grid
<?php if ( $g['grid-columns'] ) : ?>
$grid-columns:                <?php echo intval( $g['grid-columns'] ) ?>;
<?php endif ?>
<?php if ( $g['grid-gutter-width']['width'] ) : ?>
$grid-gutter-width:           <?php echo floatval( $g['grid-gutter-width']['width'] ) ?>rem;
<?php endif ?>

// Spacers
<?php if ( $g['spacer']['width'] ) : ?>
$spacer:                      <?php echo floatval( $g['spacer']['width'] ) ?>rem;
<?php endif ?>
$spacers: (
<?php for ( $i = 0; $i < count( $g['spacers'] ); $i++ ) : ?>
  <?php echo $i ?>: $spacer * <?php echo floatval( $g['spacers'][$i] ) ?>,
<?php endfor ?>
);

//--------------- Typography ---------------//

// Font Families
<?php if ( $g['font-family-base']['font-family'] ) : ?>
$font-family-base:            <?php echo $g['font-family-base']['font-family'] ?>;
<?php endif ?>
<?php if ( $g['font-family-code']['font-family'] ) : ?>
$font-family-code:            <?php echo $g['font-family-code']['font-family'] ?>;
<?php endif ?>

// Font Sizes
<?php if ( $g['font-size-base']['font-size'] ) : ?>
$font-size-base:              <?php echo floatval( $g['font-size-base']['font-size'] ) ?>rem;
<?php endif ?>
<?php if ( $g['font-size-sm']['font-size'] ) : ?>
$font-size-sm:                <?php echo floatval( $g['font-size-sm']['font-size'] ) ?>rem;
<?php endif ?>
<?php if ( $g['font-size-lg']['font-size'] ) : ?>
$font-size-lg:                <?php echo floatval( $g['font-size-lg']['font-size'] ) ?>rem;
<?php endif ?>

<?php if ( $g['h1-font-size']['font-size'] ) : ?>
$h1-font-size:                <?php echo floatval( $g['h1-font-size']['font-size'] ) ?>rem;
<?php endif ?>
<?php if ( $g['h2-font-size']['font-size'] ) : ?>
$h2-font-size:                <?php echo floatval( $g['h2-font-size']['font-size'] ) ?>rem;
<?php endif ?>
<?php if ( $g['h3-font-size']['font-size'] ) : ?>
$h3-font-size:                <?php echo floatval( $g['h3-font-size']['font-size'] ) ?>rem;
<?php endif ?>
<?php if ( $g['h4-font-size']['font-size'] ) : ?>
$h4-font-size:                <?php echo floatval( $g['h4-font-size']['font-size'] ) ?>rem;
<?php endif ?>
<?php if ( $g['h5-font-size']['font-size'] ) : ?>
$h5-font-size:                <?php echo floatval( $g['h5-font-size']['font-size'] ) ?>rem;
<?php endif ?>
<?php if ( $g['h6-font-size']['font-size'] ) : ?>
$h6-font-size:                <?php echo floatval( $g['h6-font-size']['font-size'] ) ?>rem;
<?php endif ?>

// Font Weights
$font-weight-lighter:         <?php echo intval( $g['font-weight-lighter'] ) ?>;
$font-weight-light:           <?php echo intval( $g['font-weight-light'] ) ?>;
$font-weight-normal:          <?php echo intval( $g['font-weight-normal'] ) ?>;
$font-weight-bold:            <?php echo intval( $g['font-weight-bold'] ) ?>;
$font-weight-bolder:          <?php echo intval( $g['font-weight-bolder'] ) ?>;

// Line Heights
$line-height-base:            <?php echo floatval( $g['line-height-base']['line-height'] ) ?>;
$line-height-sm:              <?php echo floatval( $g['line-height-sm']['line-height'] ) ?>;
$line-height-lg:              <?php echo floatval( $g['line-height-lg']['line-height'] ) ?>;

// Headings
$headings-margin-bottom:      <?php echo floatval( $g['headings-margin-bottom']['height'] ) ?>rem;
<?php if ( $g['headings-font-family']['font-family'] ) : ?>
$headings-font-family:        <?php echo $g['headings-font-family']['font-family'] ?>;
<?php endif ?>
<?php if ( isset( $g['headings-font-style'] ) && $g['headings-font-style'] ) : ?>
$headings-font-style:         <?php echo $g['headings-font-style'] ?>;
<?php endif ?>
$headings-font-weight:        <?php echo intval( $g['headings-font-weight'] ) ?>;
$headings-line-height:        <?php echo floatval( $g['headings-line-height']['line-height'] ) ?>;
<?php if ( $g['headings-color'] ) : ?>
$headings-color:              <?php echo $g['headings-color'] ?>;;
<?php endif ?>

// Links
<?php if ( isset( $g['link']['color'] ) && $g['link']['color'] ) : ?>
$link-color:                  <?php echo $g['link']['color'] ?>;
<?php endif ?>
<?php if ( isset( $g['link']['text-decoration'] ) && $g['link']['text-decoration'] ) : ?>
$link-decoration:             <?php echo $g['link']['text-decoration'] ?>;
<?php endif ?>
<?php if ( isset( $g['link-hover']['color'] ) && $g['link-hover']['color'] ) : ?>
$link-hover-color:            <?php echo $g['link-hover']['color'] ?>;
<?php endif ?>
<?php if ( isset( $g['link-hover']['text-decoration'] ) && $g['link-hover']['text-decoration'] ) : ?>
$link-hover-decoration:       <?php echo $g['link-hover']['text-decoration'] ?>;
<?php endif ?>

// Header
<?php if ( $g['header-bg'] ) : ?>
$header-bg:                   <?php echo $g['header-bg'] ?>;
<?php endif ?>
$header-logo-margin:          <?php echo floatval( $g['header-logo-margin']['margin-top'] ) ?>rem <?php echo floatval( $g['header-logo-margin']['margin-right'] ) ?>rem <?php echo floatval( $g['header-logo-margin']['margin-bottom'] ) ?>rem <?php echo floatval( $g['header-logo-margin']['margin-left'] ) ?>rem;

// Main
<?php if ( $g['main-bg'] ) : ?>
$main-bg:                     <?php echo $g['main-bg'] ?>;
<?php endif ?>
<?php if ( $g['section-bg'] ) : ?>
$section-bg:                  <?php echo $g['section-bg'] ?>;
<?php endif ?>

// Footer
<?php if ( $g['footer-bg'] ) : ?>
$footer-bg:                   <?php echo $g['footer-bg'] ?>;
<?php endif ?>
<?php if ( $g['footer-color'] ) : ?>
$footer-color:                <?php echo $g['footer-color'] ?>;
<?php endif ?>
<?php if ( $g['footer-headings-color'] ) : ?>
$footer-headings-color:       <?php echo $g['footer-headings-color'] ?>;
<?php endif ?>
<?php if ( $g['footer-link-color'] ) : ?>
$footer-link-color:           <?php echo $g['footer-link-color'] ?>;
<?php endif ?>
<?php if ( $g['footer-link-hover-color'] ) : ?>
$footer-link-hover-color:     <?php echo $g['footer-link-hover-color'] ?>;
<?php endif ?>