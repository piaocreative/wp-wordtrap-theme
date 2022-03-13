<?php
/**
 * Wordtrap admin page layout page
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<div class="wrap wordtrap-wrap">
  <h2 class="screen-reader-text"><?php _e( 'Dashboard', 'wordtrap' ); ?></h2>
  <?php
    wordtrap_get_template_part(
      'inc/admin/pages/header',
      null,
      array(
        'active_item' => 'wordtrap-page-layout',
        'title'       => __( 'Page Layout', 'wordtrap' ),
        'subtitle'    => __( 'Create page layout and assign them to different pages with display condition.', 'wordtrap' ),
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
          <div class="block popup-builder layout-part" data-part="popup">
            <p><?php _e( 'Popup Builder for Any Page', 'wordtrap' ) ?></p>
          </div>
          <div class="top-block layout-part" data-part="top-block">
            <p><?php _e( 'Top', 'wordtrap' ) ?></p>
          </div>
          <div class="header layout-part" data-part="header">
            <p><?php _e( 'Header', 'wordtrap' ) ?></p>
          </div>
          <div class="banner-block layout-part" data-part="banner-block">
            <p><?php _e( 'Banner', 'wordtrap' ) ?></p>
          </div>
          <div class="content-top-block layout-part" data-part="content-top-block">
            <p><?php _e( 'Content Top', 'wordtrap' ) ?></p>
          </div>
          <div class="content-wrapper">
            <div class="content">
              <div class="block layout-part" data-part="content-inner-top-block">
                <p><?php _e( 'Content Inner top', 'wordtrap' ) ?></p>
              </div>
              <div class="block layout-part">
                <p><?php _e( 'Main Content', 'wordtrap' ) ?></p>
              </div>
              <div class="block layout-part" data-part="content-inner-bottom-block">
                <p><?php _e( 'Content Inner Bottom', 'wordtrap' ) ?></p>
              </div>
            </div>
            <div class="right-sidebar layout-part" data-part="right-sidebar">
              <p><?php _e( 'Sidebar', 'wordtrap' ) ?></p>
            </div>
          </div>
          <div class="content-bottom-block layout-part" data-part="content-bottom-block">
            <p><?php _e( 'Content Bottom', 'wordtrap' ) ?></p>
          </div>
          <div class="footer layout-part" data-part="footer">
            <p><?php _e( 'Footer', 'wordtrap' ) ?></p>
          </div>
          <div class="bottom-block layout-part" data-part="bottom-block">
            <p><?php _e( 'Bottom', 'wordtrap' ) ?></p>
          </div>
        </div>
        <div class="part-options">
        </div>
      </div>
    </div>
    
  </main>
</div>