<?php
/**
 * The acf padding field
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// check if class already exists
if ( ! class_exists( 'Wordtrap_ACF_Field_Padding' ) ) :

class Wordtrap_ACF_Field_Padding extends acf_field {
  /**
   * Construct
   */
  function __construct() {
    $this->name = 'wordtrap_padding';
    $this->label = __( 'Padding', 'wordtrap' );
    $this->category = 'basic';
    $this->defaults = array(
      'padding_enable' => 0
    );
    $this->l10n = array(
      'error' => __( 'Error! Please enter a higher value', 'wordtrap' ),
    );
    
    parent::__construct();
  }
  
  /**
   * Create extra settings
   * 
   * @param $field (array) the $field being edited
   * 
   * @return n/a
   */
  function render_field_settings( $field ) {
    acf_render_field_setting( $field, array(
      'label'        => __( 'Enable Field','wordtrap' ),
      'instructions' => __( 'Default','wordtrap' ),
      'type'         => 'true_false',
      'name'         => 'padding_enable',
      'layout'       => 'horizontal',
      'ui'           => 0
    ) );

    acf_render_field_setting( $field, array(
      'label'        => __( 'Padding Top', 'wordtrap' ),
      'instructions' => __( 'Default', 'wordtrap' ),
      'type'         => 'number',
      'name'         => 'padding_top',
      'prepend'      => 'px',
    ) );
    
    acf_render_field_setting( $field, array(
      'label'        => __( 'Padding Right', 'wordtrap' ),
      'instructions' => __( 'Default', 'wordtrap' ),
      'type'         => 'number',
      'name'         => 'padding_right',
      'prepend'      => 'px',
    ) );

    acf_render_field_setting( $field, array(
      'label'        => __( 'Padding Bottom', 'wordtrap' ),
      'instructions' => __( 'Default', 'wordtrap' ),
      'type'         => 'number',
      'name'         => 'padding_bottom',
      'prepend'      => 'px',
    ) );

    acf_render_field_setting( $field, array(
      'label'        => __( 'Padding Left', 'wordtrap' ),
      'instructions' => __( 'Default', 'wordtrap' ),
      'type'         => 'number',
      'name'         => 'padding_left',
      'prepend'      => 'px',
    ) );
  }
  
  /**
   * Create the HTML interface for your field
   *
   * @param $field (array) the $field being rendered
   * 
   * @return n/a
   */  
  function render_field( $field ) {
    $field = array_merge($this->defaults, $field);

    if ( empty($field['value']) ) {
      $field['value']['padding_enable'] = $field['padding_enable'];
      $field['value']['padding_top'] = $field['padding_top'];
      $field['value']['padding_bottom'] = $field['padding_bottom'];
      $field['value']['padding_left'] = $field['padding_left'];
      $field['value']['padding_right'] = $field['padding_right'];
    }
    ?>
    <div class="acf_padding_root wordtrap_acf_cs_field_root">
      <div class="acf-input">
        <div class="acf-true-false">
          <input type="checkbox" 
          name="<?php echo $field['name'] . 'padding_enable' ?>" 
          value="<?php echo $field['value']['padding_enable']; ?>"
          id="wordtrap_acf_eye_padding_<?php echo $field['name']; ?>" 
          class="wordtrap_acf-checkbox-true-false"
          <?php 
            if ($field['value']['padding_enable'] === 1) {
              echo 'checked';
            }
          ?>
          >
          <label for="wordtrap_acf_eye_padding_<?php echo $field['name']; ?>"><svg class="wordtrap_acf_eye_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. --><path d="M373.1 24.97C401.2-3.147 446.8-3.147 474.9 24.97L487 37.09C515.1 65.21 515.1 110.8 487 138.9L289.8 336.2C281.1 344.8 270.4 351.1 258.6 354.5L158.6 383.1C150.2 385.5 141.2 383.1 135 376.1C128.9 370.8 126.5 361.8 128.9 353.4L157.5 253.4C160.9 241.6 167.2 230.9 175.8 222.2L373.1 24.97zM440.1 58.91C431.6 49.54 416.4 49.54 407 58.91L377.9 88L424 134.1L453.1 104.1C462.5 95.6 462.5 80.4 453.1 71.03L440.1 58.91zM203.7 266.6L186.9 325.1L245.4 308.3C249.4 307.2 252.9 305.1 255.8 302.2L390.1 168L344 121.9L209.8 256.2C206.9 259.1 204.8 262.6 203.7 266.6zM200 64C213.3 64 224 74.75 224 88C224 101.3 213.3 112 200 112H88C65.91 112 48 129.9 48 152V424C48 446.1 65.91 464 88 464H360C382.1 464 400 446.1 400 424V312C400 298.7 410.7 288 424 288C437.3 288 448 298.7 448 312V424C448 472.6 408.6 512 360 512H88C39.4 512 0 472.6 0 424V152C0 103.4 39.4 64 88 64H200z"/></svg></label>
        </div>
      </div>
      <?php 
      $wordtrap_acf_padding_display = $field['value']['padding_enable'] === 1 ? 'block' : 'none';
      ?>
      <div class="wordtrap_acf_padding_main wordtrap_acf_cs_field_main" style="display: <?php echo $wordtrap_acf_padding_display; ?>">
        <div class="wordtrap_acf-padding">
          <div class="acf-field acf-field-range">
            <div class="acf-label">
              <label><?php _e( 'Top', 'wordtrap' ) ?></label>
            </div>
            <div class="acf-input">
              <div class="acf-range-wrap">
                <input 
                type="number" 
                id="test"
                name="<?php echo $field['name'] . 'padding_top' ?>"
                value="<?php echo esc_attr($field['value']['padding_top']) ?>" 
                step="1" style="width: 3.9em;"
                >
                <div class="acf-append">px</div>
              </div>
            </div>
          </div>

          <div class="acf-field acf-field-range">
            <div class="acf-label">
              <label><?php _e( 'Right', 'wordtrap' ) ?></label>
            </div>
            <div class="acf-input">
              <div class="acf-range-wrap">
                <input 
                type="number" 
                id="test"
                name="<?php echo $field['name'] . 'padding_right' ?>"
                value="<?php echo esc_attr($field['value']['padding_right']) ?>" 
                step="1" style="width: 3.9em;"
                >
                <div class="acf-append">px</div>
              </div>
            </div>
          </div>

          <div class="acf-field acf-field-range">
            <div class="acf-label">
              <label><?php _e( 'Bottom', 'wordtrap' ) ?></label>
            </div>
            <div class="acf-input">
              <div class="acf-range-wrap">
                <input 
                type="number" 
                id="test"
                name="<?php echo $field['name'] . 'padding_bottom' ?>"
                value="<?php echo esc_attr($field['value']['padding_bottom']) ?>" 
                step="1" style="width: 3.9em;"
                >
                <div class="acf-append">px</div>
              </div>
            </div>
          </div>

          <div class="acf-field acf-field-range">
            <div class="acf-label">
              <label><?php _e( 'Left', 'wordtrap' ) ?></label>
            </div>
            <div class="acf-input">
              <div class="acf-range-wrap">
                <input 
                type="number" 
                id="test"
                name="<?php echo $field['name'] . 'padding_left' ?>"
                value="<?php echo esc_attr($field['value']['padding_left']) ?>" 
                step="1" style="width: 3.9em;"
                >
                <div class="acf-append">px</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
  }
  
  /**
   * This filter is applied to the $value after it is loaded from the db
   * 
   * @param $value (mixed) the value found in the database
   * @param $post_id (mixed) the $post_id from which the value was loaded
   * @param $field (array) the field array holding all the field options
   * 
   * @return $value
   */
  function load_value( $value, $post_id, $field ) {
    return $value;
  }
  
  /**
   * This filter is applied to the $value before it is saved in the db
   * 
   * @param $value (mixed) the value found in the database
   * @param $post_id (mixed) the $post_id from which the value was loaded
   * @param $field (array) the field array holding all the field options
   * 
   * @return $value
   */
  function update_value( $value, $post_id, $field ) {
    return $value;
  }
  
  /**
   * This filter is appied to the $value after it is loaded from the db and before it is returned to the template
   *
   * @param $value (mixed) the value which was loaded from the database
   * @param $post_id (mixed) the $post_id from which the value was loaded
   * @param $field (array) the field array holding all the field options
   *
   * @return $value (mixed) the modified value
   */
  function format_value( $value, $post_id, $field ) {
    if( empty($value) ) {
      return $value;
    }

    return $value;
  }
  
  /**
   * This filter is applied to the $field after it is loaded from the database
   *
   * @param $field (array) the field array holding all the field options
   * 
   * @return $field
   */
  function load_field( $field ) {
    return $field;
  } 
  
  /**
   * This filter is applied to the $field before it is saved to the database
   * 
   * @param $field (array) the field array holding all the field options
   * 
   * @return $field
   */
  function update_field( $field ) {
    return $field;
  }
}

endif;

// initialize
new Wordtrap_ACF_Field_Padding();
