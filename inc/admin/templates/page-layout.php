<?php
/**
 * Wordtrap admin page layout page
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<div class="wrap wordtrap-wrap">
  <h2 class="screen-reader-text"><?php _e('Dashboard', 'wordtrap'); ?></h2>
  <?php
  wordtrap_get_template_part(
    'inc/admin/pages/header',
    null,
    array(
      'active_item' => 'wordtrap-page-layout',
      'title'       => __('Page Layout', 'wordtrap'),
      'subtitle'    => __('Create page layout and assign them to different pages with display condition.', 'wordtrap'),
    )
  );
  ?>
  <main>
    <div class="page-layout">
      <div class="layout-box">
        <h3 class="layout-header">
          <a href="#" class="back"><i class="fas fa-arrow-left"></i></a>
          Page Layout for Template Bulider
        </h3>
        <div class="layout wordtrap-layout">
          <div class="popup layout-part" data-part="popup">
            <p><?php _e('Popup', 'wordtrap') ?></p>
          </div>
          <div class="layout-part" data-part="top-block">
            <p><?php _e('Top', 'wordtrap') ?></p>
          </div>
          <div class="layout-part" data-part="header">
            <p><?php _e('Header', 'wordtrap') ?></p>
          </div>
          <div class="layout-part" data-part="banner-block">
            <p><?php _e('Banner', 'wordtrap') ?></p>
          </div>
          <div class="layout-part" data-part="main-top-block">
            <p><?php _e('Main Top', 'wordtrap') ?></p>
          </div>
          <div class="content-wrapper">
            <div class="left-sidebar layout-part" data-part="left-sidebar">
              <p><?php _e('Left Sidebar', 'wordtrap') ?></p>
            </div>
            <div class="content">
              <div class="block layout-part" data-part="main-inner-top-block">
                <p><?php _e('Main Inner Top', 'wordtrap') ?></p>
              </div>
              <div class="block layout-part">
                <p><?php _e('Main', 'wordtrap') ?></p>
              </div>
              <div class="block layout-part" data-part="main-inner-bottom-block">
                <p><?php _e('Main Inner Bottom', 'wordtrap') ?></p>
              </div>
            </div>
            <div class="right-sidebar layout-part" data-part="right-sidebar">
              <p><?php _e('Right Sidebar', 'wordtrap') ?></p>
            </div>
          </div>
          <div class="layout-part" data-part="main-bottom-block">
            <p><?php _e('Main Bottom', 'wordtrap') ?></p>
          </div>
          <div class="layout-part" data-part="footer">
            <p><?php _e('Footer', 'wordtrap') ?></p>
          </div>
          <div class="layout-part" data-part="bottom-block">
            <p><?php _e('Bottom', 'wordtrap') ?></p>
          </div>
        </div>
        <div class="part-options">
        </div>
      </div>
    </div>

    <?php
    $parts = array( 
      'popup', 
      'top-block', 
      'header', 
      'banner-block', 
      'main-top-block', 
      'left-sidebar',
      'main-inner-top-block', 
      'main-inner-bottom-block', 
      'right-sidebar', 
      'main-bottom-block', 
      'footer',
      'bottom-block'
    );
    foreach ( $parts as &$part ) :
      ob_start();
      $backup_part = $part;
      if ( in_array( $part, array( 'top-block', 'banner-block', 'main-top-block', 'main-inner-top-block', 'main-inner-bottom-block', 'main-bottom-block', 'bottom-block' ) ) ) {
        $part = 'block';
      }
      $this->add_control( 'note', $this->options[$part]['note'] );
      if ( ! in_array( $part, array( 'left-sidebar', 'right-sidebar') ) ) :
        foreach ( $this->template_list[$part] as $page_id => $page_title ) {
          $conditions = get_post_meta( $page_id, '_porto_builder_conditions', true );
          $block_pos = get_post_meta( $page_id, '_porto_block_pos', true );
          if ( !empty( $conditions ) 
            && ( ( $part == 'block' && !empty( $block_pos ) && 'block_' . $backup_part == $block_pos ) || ( 'block' != $part ) ) ) {
            $this->add_control( 'builder-blocks', $this->options[$part]['builder-blocks'], $page_id );
          }
        }
        $this->add_control( 'builder-blocks', $this->options[$part]['builder-blocks'], 'preset' );
        ?>
        <div class="add-new-layout">
          <a href="#">Add New Layout Condition</a>
        </div>
        <?php
      endif;
      $output = ob_get_clean();
      ?>
      <script type="text/template" id="porto-layout-<?php echo esc_attr( $backup_part ); ?>-options-html">
        <?php echo porto_filter_output( $output ); ?>
      </script>
    <?php endforeach; ?>
  </main>
</div>