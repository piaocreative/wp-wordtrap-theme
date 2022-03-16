<?php
/**
 * Wordtrap admin select template type dialog
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<div id="template-type-dialog" class="hidden" title="<?php esc_attr_e( 'Add New Template', 'wordtrap' ) ?>">
  <div class="form-wrap">
    <form method="post" action="<?php echo esc_url( admin_url() ); ?>" class="validate">
    
      <input type="hidden" name="action" value="wordtrap-new-template">
      <?php wp_nonce_field( 'wordtrap-add-template' ); ?>

      <div class="form-field form-required template-type-wrap">
        <label for="template-type"><?php _e( 'Type', 'wordtrap' ); ?></label>
        <select id="template-type" name="template-type"  aria-required="true">
          <option value=""><?php esc_html_e( 'Select...', 'wordtrap' ); ?></option>
          <?php foreach ( $this->template_types as $type => $label ) : ?>
            <option value="<?php echo esc_attr( $type ); ?>" <?php selected( isset( $_GET[ self::TEMPLATE_TYPE ] ) && $type == $_GET[ self::TEMPLATE_TYPE ], true, true ); ?>>
              <?php echo esc_html( $label ); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-field form-required template-name-wrap">
        <label for="template-name"><?php _e( 'Name', 'wordtrap' ); ?></label>
        <input type="text" id="template-name" name="template-name" aria-required="true" />  
      </div>
      <p class="submit">
        <input type="submit" name="submit" id="template-type-submit" class="button button-primary" value="<?php esc_attr_e( 'Add Template', 'wordtrap' ) ?>">
      </p>
    </form>
  </div>
</div>