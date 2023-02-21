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
    'wordtrap-options'      => array( 'admin.php?page=wordtrap_options', __( 'Theme Options', 'wordtrap' ) ),
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
    <div class="logo">
      <svg id="Wordtrap" data-name="Wordtrap" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 436.41 436.41"><defs><style>.cls-1{fill:#3d98f4;}</style></defs><path class="cls-1" d="M982.36,271.12A218.3,218.3,0,0,0,742.88,510.37c10.08,102.2,92.75,184.87,195,195a218.31,218.31,0,0,0,239.25-239.49C1166.92,363.8,1084.4,281.28,982.36,271.12Zm-51.72,251-27.87,98.51a15.76,15.76,0,0,1-15.17,11.47H870.32a15.77,15.77,0,0,1-15.27-11.87L801.51,410l-6.18-24.19-4.16-16.25h37.55l2.9,12.85.5,1.89,2.77,12.85,2.9,12.85L879,592.65,929.88,410h.76Zm46.61,110H943.49v-235H848.12a22.65,22.65,0,0,1,22.1-27.59h208.45a35.67,35.67,0,0,1-34.75,27.59H977.25Zm72.65,0h-17a15.75,15.75,0,0,1-15.16-11.47L990.1,523V410l51,181.92L1082.58,410l3-12.85,2.9-12.85.5-1.89,2.77-12.85h37L1118.48,410l-53.3,210.22A15.76,15.76,0,0,1,1049.9,632.08Z" transform="translate(-741.79 -270)"/></svg>
    </div>  
    <div class="header-text">
      <h1><?php echo esc_html( $title ); ?></h1>
      <h6><?php echo esc_html( $subtitle ); ?></h6>
    </div>
  </div>
  <div class="header-right">
    <span class="name"><?php echo WORDTRAP_NAME ?></span>
    <span class="version"><?php printf( __( 'version %s', 'wordtrap' ), WORDTRAP_VERSION ); ?></span>
  </div>
</div>
