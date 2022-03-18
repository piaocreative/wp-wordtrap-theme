<?php

/**
 * @package     Redux Framework
 * @subpackage  JS Button
 * @author      Kevin Provance (kprovance)
 * @version     1.0.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Don't duplicate me!
if ( ! class_exists( 'ReduxFramework_js_button', false ) ) {

	/**
	 * Main ReduxFramework_js_button class
	 *
	 * @since       1.0.0
	 */
	class ReduxFramework_js_button {

		/**
		 * Class Constructor. Defines the args for the extions class
		 *
		 * @since       1.0.0
		 * @access      public
		 *
		 * @param       array $field Field sections.
		 * @param       array $value Values.
		 * @param       array $parent Parent object.
		 *
		 * @return      void
		 */
		public function __construct( $field = array(), $value = '', $parent ) {

			// Set required variables
			$this->parent = $parent;
			$this->field  = $field;
			$this->value  = $value;

			// Set extension dir & url
			if ( empty( $this->extension_dir ) ) {
				$this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
				$this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
			}
		}

		/**
		 * Field Render Function.
		 *
		 * Takes the vars and outputs the HTML for the field in the settings
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function render() {
			// Button render.
			if ( isset( $this->field['buttons'] ) && is_array( $this->field['buttons'] ) ) {
				$field_id = $this->field['id'];
				$dev_mode = $this->parent->args['dev_mode'];
				$dev_tag  = '';

				// Set dev_mode data, if active.
				if ( true == $dev_mode ) {
					$dev_tag = ' data-dev-mode="' . $this->parent->args['dev_mode'] . '"
                            data-version="' . ReduxFramework_extension_js_button::$version . '"';
				}

				// primary container
				echo <<<HTML
<div class="redux-js-button-container {$this->field['class']}" id="{$field_id}_container" data-id="{$field_id}" {$dev_tag} style="display: inline-flex;">
HTML;

				foreach ( $this->field['buttons'] as $idx => $arr ) {
					$button_text  = $arr['text'];
					$button_class = $arr['class'];
					$button_func  = $arr['function'];

					echo <<<HTML
<input id="{$field_id}_input_{$idx}" class="hide-if-no-js button redux-js-button {$button_class}" type="button" data-function="{$button_func}" value="{$button_text}">&nbsp;&nbsp;
HTML;
				}

				// Close container
				echo '</div>';
			}

		}

		/**
		 * Enqueue Function.
		 *
		 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
		 *
		 * @since       1.0.0
		 * @access      public
		 * @return      void
		 */
		public function enqueue() {
			static $enqueued = false;

			//Don't enqueue more than once
			if ( $enqueued ) {
				return;
			}
			$enqueued = true;
			// Make sure script data exists first
			if ( isset( $this->field['script'] ) && ! empty( $this->field['script'] ) ) {

				// URI location of script to enqueue
				$script_url = isset( $this->field['script']['url'] ) ? $this->field['script']['url'] : '';

				// Get deps, if any
				$script_dep = isset( $this->field['script']['dep'] ) ? $this->field['script']['dep'] : array();

				// Get ver, if any
				$script_ver = isset( $this->field['script']['ver'] ) ? $this->field['script']['ver'] : time();

				// Script location in HTML
				$script_footer = isset( $this->field['script']['in_footer'] ) ? $this->field['script']['in_footer'] : true;

				// If a script exists, enqueue it.
				if ( $script_url != '' ) {
					wp_enqueue_script(
						'redux-js-button-' . $this->field['id'] . '-js',
						$script_url,
						$script_dep,
						$script_ver,
						$script_footer
					);
				}

				if ( isset( $this->field['enqueue_ajax'] ) && $this->field['enqueue_ajax'] ) {
					wp_localize_script(
						'redux-js-button-' . $this->field['id'] . '-js',
						'redux_ajax_script',
						array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) )
					);
				}
			}

			// Set up min files for dev_mode = false.
			$min = Redux_Functions::isMin();

			// Field dependent JS
			wp_enqueue_script(
				'redux-field-js-button-js',
				apply_filters( "redux/js_button/{$this->parent->args['opt_name']}/enqueue/redux-field-js-button-js", $this->extension_url . 'field_js_button' . $min . '.js' ),
				array( 'jquery', 'redux-js' ),
				ReduxFramework_extension_js_button::$version,
				true
			);
		}
	}
}