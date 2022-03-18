<?php

/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     Redux Framework
 * @subpackage  JS Button
 * @subpackage  Wordpress
 * @author      Kevin Provance (kprovance)
 * @version     1.0.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Don't duplicate me!
if ( ! class_exists( 'ReduxFramework_extension_js_button', false ) ) {

	/**
	 * Main ReduxFramework_extension_multi_media extension class
	 *
	 * @since       1.0.0
	 */
	class ReduxFramework_extension_js_button extends Redux_Extension_Abstract {

		public static $version = '1.0.3';

		// Protected vars

		/**
		 * Class Constructor. Defines the args for the extions class
		 *
		 * @param object $parent Parent settings.
		 *
		 * @return      void
		 * @since       1.0.0
		 * @access      public
		 *
		 */
		public function __construct( $parent, $file = '' ) {
			parent::__construct( $parent, $file );

			$this->add_field( 'js_button' );
		}
	}
}
