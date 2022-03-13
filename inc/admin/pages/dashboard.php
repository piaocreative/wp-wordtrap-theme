<?php
/**
 * Wordtrap admin dashboard page
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// get system status

global $wp_filesystem;
// Initialize the WordPress filesystem, no more using file_put_contents function
if ( empty( $wp_filesystem ) ) {
  require_once ABSPATH . '/wp-admin/includes/file.php';
  WP_Filesystem();
}

$data = array(
  'wp_uploads'     => wp_get_upload_dir(),
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
  <h2 class="screen-reader-text"><?php _e( 'Dashboard', 'wordtrap' ); ?></h2>
  <?php
    wordtrap_get_template_part(
      'inc/admin/pages/header',
      null,
      array(
        'active_item' => 'wordtrap',
        'title'       => __( 'Welcome to Wordtrap!', 'wordtrap' ),
        'subtitle'    => __( 'Wordtrap is now installed and ready to use! We hope you enjoy it!', 'wordtrap' ),
      )
    );
  ?>

  <main class="row">
    <div class="col-left">
      <h2><?php _e( 'Thank you, we hope you to enjoy using Wordtrap!', 'wordtrap' ) ?></h2>
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
              <span class="label"><?php _e( 'PHP memory_limit', 'wordtrap' ); ?> <em>(<?php echo size_format( $data['memory_limit'] ); ?>)</em></span>
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
            <li>
              <p class="mb-0">
                <i class="status-info dashicons dashicons-info"></i> 
                <em><?php _e( 'Do not worry if you are unable to update your server configuration due to hosting limit, you can use "Alternative Import" method in Demo Content import page.', 'wordtrap' ) ?></em>
              </p>
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
