<?php
/**
 * Wordtrap admin templates type tabs template
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<div id="wordtrap-template-tabs" class="nav-tab-wrapper">
  <a class="nav-tab<?php echo esc_attr( $active_class ); ?>" href="<?php echo esc_url( $baseurl ); ?>"><?php esc_html_e( 'All', 'wordtrap' ); ?></a>
  <?php
  foreach ( $this->template_types as $type => $label ) {
    $active_class = '';
    if ( $current_type === $type ) {
      $active_class = ' nav-tab-active';
    }
    $template_url = add_query_arg( self::TEMPLATE_TYPE, $type, $baseurl );
    echo '<a class="nav-tab' . $active_class . '" href="' . esc_url( $template_url ) . '">' . esc_html( $label ) . '</a>';
  }
  ?>
</div>