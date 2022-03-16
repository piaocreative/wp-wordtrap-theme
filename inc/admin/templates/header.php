<?php
/**
 * Wordtrap admin header template
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// declare variables in theme options page
global $pagenow;
if ( ( $pagenow == 'themes.php' || $pagenow == 'admin.php' ) && isset( $_GET['page'] ) && $_GET['page'] === WORDTRAP_OPTIONS ) {
  $active_item = 'wordtrap-options';
  $title = esc_html__( 'Theme Options', 'wordtrap' );
  $subtitle = esc_html__( 'Theme Options panel enables you full control over your website design and settings.', 'wordtrap' );
}
?>
<div class="wordtrap-admin-nav">
<?php
  $items = array(
    'wordtrap'              => array( 'admin.php?page=wordtrap', __( 'Page Layout', 'wordtrap' ) ),
    'wordtrap-customize'    => array( 'customize.php', __( 'Customize', 'wordtrap' ) ),
    'wordtrap-options'      => array( 'themes.php?page=wordtrap_options', __( 'Theme Options', 'wordtrap' ) ),
    'wordtrap-builder'      => array( 'edit.php?post_type=' . Wordtrap_Templates_Builder::POST_TYPE, __( 'Templates Builder', 'wordtrap' ) ),
  );
  
  foreach ( $items as $key => $item ) {
    if ( isset( $active_item ) && $active_item == $key ) {
      printf( 
        '<span class="active">%s</span>', 
        esc_html( $item[1] ) 
      );
    } else {
      printf( 
        '<a href="%s">%s</a>', 
        esc_url( admin_url( $item[0] ) ), 
        esc_html( $item[1] ) 
      );
    }
  }
  ?>
</div>
<div class="wordtrap-admin-header">
  <div class="header-left">
    <h1><?php echo esc_html( $title ); ?></h1>
    <h6><?php echo esc_html( $subtitle ); ?></h6>
  </div>
  <div class="header-right">
    <span class="name"><?php echo WORDTRAP_NAME ?></span>
    <span class="version"><?php printf( __( 'version %s', 'wordtrap' ), WORDTRAP_VERSION ); ?></span>
  </div>
</div>
