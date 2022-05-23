<?php
/**
 * Editor color palette
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

global $wordtrap_options;
$g = $wordtrap_options;
?>{
  "--bs-primary": "<?php echo $g['primary'] ? $g['primary'] : '#3d98f4' ?>",
  "--bs-secondary": "<?php echo $g['secondary'] ? $g['secondary'] : '#6c757d' ?>",
  "--bs-success": "<?php echo $g['success'] ? $g['success'] : '#28a745' ?>",
  "--bs-info": "<?php echo $g['info'] ? $g['info'] : '#17a2b8' ?>",
  "--bs-warning": "<?php echo $g['warning'] ? $g['warning'] : '#ffc107' ?>",
  "--bs-danger": "<?php echo $g['danger'] ? $g['danger'] : '#dc3545' ?>",
  "--bs-light": "<?php echo $g['light'] ? $g['light'] : '#f8f9fa' ?>",
  "--bs-dark": "<?php echo $g['dark'] ? $g['dark'] : '#212529' ?>",
  "--bs-blue": "#0d6efd",
  "--bs-indigo": "#6610f2",
  "--bs-purple": "#5533ff",
  "--bs-pink": "#d63384",
  "--bs-red": "#dc3545",
  "--bs-orange": "#fd7e14",
  "--bs-yellow": "#ffc107",
  "--bs-green": "#198754",
  "--bs-teal": "#20c997",
  "--bs-cyan": "#0dcaf0",
  "--bs-white": "#fff",
  "--bs-gray": "#6c757d",
  "--bs-gray-dark": "#343a40"
}