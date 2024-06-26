<?php

/**
 * Wordtrap admin page layout page
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// Get system status

global $wp_filesystem;
// Initialize the WordPress filesystem, no more using file_put_contents function
if ( empty( $wp_filesystem ) ) {
  require_once ABSPATH . '/wp-admin/includes/file.php';
  WP_Filesystem();
}

$data = array(
  'wp_uploads'     => wp_get_upload_dir (),
  'memory_limit'   => wp_convert_hr_to_bytes( @ini_get( 'memory_limit' ) ),
  'time_limit'     => ini_get( 'max_execution_time' ),
  'max_input_vars' => ini_get( 'max_input_vars' ),
);

$status = array(
  'uploads'        => wp_is_writable( $data['wp_uploads']['basedir'] ),
  'fs'             => ( $wp_filesystem || WP_Filesystem() ) ? true : false,
  'zip'            => class_exists( 'ZipArchive' ),
  'suhosin'        => extension_loaded( 'suhosin' ),
  'memory_limit'   => $data['memory_limit'] >= 268435456,
  'time_limit'     => ( ( $data['time_limit'] >= 600 ) || ( 0 == $data['time_limit'] ) ) ? true : false,
  'max_input_vars' => $data['max_input_vars'] >= 2000,
);

?>
<div class="wrap wordtrap-wrap">
  <h2 class="screen-reader-text"><?php _e( 'Page Layout', 'wordtrap' ); ?></h2>
  <?php
  wordtrap_get_template_part(
    'inc/admin/templates/header',
    null,
    array(
      'active_item' => 'wordtrap',
      'title'       => __( 'Page Layout', 'wordtrap' ),
      'subtitle'    => __( 'Create page layout and assign them to different pages with display condition.', 'wordtrap' ),
    )
  );
  ?>
  <main class="row">
    <div class="col-left">
      <div class="page-layout">
        <div class="layout-box">
          <h3 class="layout-header">
            <a href="#" class="back"><i class="dashicons dashicons-arrow-left-alt"></i></a>
            <?php _e( 'Page Layout for Template Bulider', 'wordtrap' ) ?>
          </h3>
          <div class="layout wordtrap-layout">
            <div class="block" data-block="header">
              <p><?php _e( 'Header', 'wordtrap' ) ?></p>
            </div>
            <div class="main-wrap">
              <div class="block sidebar left-sidebar" data-block="left-sidebar">
                <p><?php _e( 'Left Sidebar', 'wordtrap' ) ?></p>
              </div>
              <div class="content-wrap">
                <div class="block" data-block="main">
                  <p><?php _e( 'Main', 'wordtrap' ) ?></p>
                </div>
              </div>
              <div class="block sidebar right-sidebar" data-block="right-sidebar">
                <p><?php _e( 'Right Sidebar', 'wordtrap' ) ?></p>
              </div>
            </div>
            <div class="block" data-block="footer">
              <p><?php _e( 'Footer', 'wordtrap' ) ?></p>
            </div>
          </div>
          <div class="block-options">
          </div>
        </div>
      </div>

      <?php
      // Load templates
      $template_types = array ( 
        'header', 
        'left-sidebar',
        'main',
        'right-sidebar', 
        'footer',
      );
      foreach ( $template_types as $template_type ) :
        if ( ! isset( $this->blocks[ $template_type ] ) ) {
          continue;
        }

        ob_start ();
        
        $this->add_block_heading( $template_type );
        $this->add_control_block( $template_type );

        $output = ob_get_clean();
        ?>
        <script type="text/template" id="wordtrap-layout-<?php echo esc_attr( $template_type ); ?>-options-html">
          <?php echo $output; ?>
        </script>
      <?php endforeach; ?>
      <div id="conditions-dialog" class="hidden" title="<?php esc_attr_e( 'Display Conditions', 'wordtrap' ) ?>">
        <div class="display-conditions"></div>
      </div>
    </div>
    <div class="col-right">
      <h3><?php _e( 'System Status', 'wordtrap' ); ?></h3>
      <div class="wordtrap-system-status">
        <ul class="system-status">
          <li>
            <?php if ( $status['uploads'] ) : ?>
              <i class="status-yes dashicons dashicons-yes"></i>
            <?php else : ?>
              <i class="status-no dashicons dashicons-no"></i>
            <?php endif; ?>
            <span class="label"><?php _e( 'Uploads folder writable', 'wordtrap' ); ?></span>
            <?php if ( ! $status['uploads'] ) : ?>
              <p class="status-error">
                <?php _e( 'Uploads folder must be writable. Please set write permission to your wp-content/uploads folder.', 'wordtrap' ) ?>
              </p>
            <?php endif; ?>
          </li>
          <li>
            <?php if ( $status['fs'] ) : ?>
              <i class="status-yes dashicons dashicons-yes"></i>
            <?php else : ?>
              <i class="status-no dashicons dashicons-no"></i>
            <?php endif; ?>
            <span class="label"><?php _e( 'WP File System', 'wordtrap' ); ?></span>
            <?php if ( ! $status['fs'] ) : ?>
              <p class="status-error">
                <?php _e( 'File System access is required for pre-built websites and plugins installation. Please contact your hosting provider.', 'wordtrap' ) ?>
              </p>
            <?php endif; ?>
          </li>

          <li>
            <?php if ( $status['zip'] ) : ?>
              <i class="status-yes dashicons dashicons-yes"></i>
            <?php else : ?>
              <i class="status-no dashicons dashicons-no"></i>
            <?php endif; ?>
            <span class="label"><?php _e( 'ZipArchive', 'wordtrap' ); ?></span>
            <?php if ( ! $status['zip'] ) : ?>
              <p class="status-error">
                <?php _e( 'ZipArchive is required for pre-built websites and plugins installation. Please contact your hosting provider.', 'wordtrap' ) ?>
              </p>
            <?php endif; ?>
          </li>

          <?php if ( $status['suhosin'] ) : ?>
            <li>
              <i class="status-info dashicons dashicons-info"></i>
              <span class="label"><?php _e( 'SUHOSIN Installed', 'wordtrap' ); ?></span>
              <p class="status-notice">
                <?php _e( 'Suhosin may need to be configured to increase its data submission limits.', 'wordtrap' ) ?>
              </p>
            </li>
          <?php else : ?>
            <li>
              <?php if ( $status['memory_limit'] ) : ?>
                <i class="status-yes dashicons dashicons-yes"></i>
              <?php else : ?>
                <?php if ( $data['memory_limit'] < 134217728 ) : ?>
                  <i class="status-no dashicons dashicons-bell"></i>
                <?php else : ?>
                  <i class="status-info dashicons dashicons-info"></i>
                <?php endif; ?>
              <?php endif; ?>
              <span class="label"><?php _e( 'PHP memory_limit', 'wordtrap' ); ?> <em> (<?php echo size_format( $data['memory_limit'] ); ?>)</em></span>
              <?php if ( ! $status['memory_limit'] ) : ?>
                <?php if ( $data['memory_limit'] < 134217728 ) : ?>
                  <p class="status-error">
                    <?php _e( 'Minimum <strong>128 MB</strong> is required, <strong>256 MB</strong> is recommended.', 'wordtrap' ) ?>
                  </p>
                <?php else : ?>
                  <p class="status-error">
                    <?php _e( 'Current memory limit is OK, however <strong>256 MB</strong> is recommended.', 'wordtrap' ) ?>
                  </p>
                <?php endif; ?>
              <?php endif; ?>
            </li>
            <li>
              <?php if ( $status['time_limit'] ) : ?>
                <i class="status-yes dashicons dashicons-yes"></i>
              <?php else : ?>
                <?php if ( $data['time_limit'] < 300 ) : ?>
                  <i class="status-no dashicons dashicons-bell"></i>
                <?php else : ?>
                  <i class="status-info dashicons dashicons-info"></i>
                <?php endif; ?>
              <?php endif; ?>
              <span class="label"><?php _e( 'PHP max_execution_time', 'wordtrap' ); ?> <em>(<?php echo esc_html( $data['time_limit'] ); ?>)</em></span>
              <?php if ( ! $status['time_limit'] ) : ?>
                <?php if ( $data['time_limit'] < 300 ) : ?>
                  <p class="status-error">
                    <?php _e( 'Minimum <strong>300</strong> is required, <strong>600</strong> is recommended.', 'wordtrap' ) ?>
                  </p>
                <?php else : ?>
                  <p class="status-error">
                    <?php _e( 'Current time limit is OK, however <strong>600</strong> is recommended.', 'wordtrap' ) ?>
                  </p>
                <?php endif; ?>
              <?php endif; ?>
            </li>
            <li>
              <?php if ( $status['max_input_vars'] ) : ?>
                <i class="status-yes dashicons dashicons-yes"></i>
              <?php else : ?>
                <i class="status-no dashicons dashicons-bell"></i>
              <?php endif; ?>
              <span class="label"><?php _e( 'PHP max_input_vars', 'wordtrap' ); ?> <em>(<?php echo esc_html( $data['max_input_vars'] ); ?>)</em></span>
              <?php if ( ! $status['max_input_vars'] ) : ?>
                <p class="status-error">
                  <?php _e( 'Minimum 2000 is required.', 'wordtrap' ) ?>
                </p>
              <?php endif; ?>
            </li>
            <li class="info">
              <i class="status-yes dashicons dashicons-editor-help"></i>
              <?php _e( 'php.ini values are shown above. Real values may vary, please check your limits using <a target="_blank" href="http://php.net/manual/en/function.phpinfo.php" rel="noopener noreferrer">php_info()</a>', 'wordtrap' ) ?>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </main>
</div>