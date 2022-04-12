<?php
/**
 * WooCommerce single products template functions and hooks
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Unhook the products result count and ordering
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );