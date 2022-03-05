<?php
/**
 * The theme options
 * 
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux' ) ) {
	return;
}

// Get directory and theme options name
$dir = dirname( __FILE__ ) . DIRECTORY_SEPARATOR;
$opt_name = WORDTRAP_OPTIONS;

// Include helpers
require_once $dir . 'helpers/enqueue.php';
require_once $dir . 'helpers/field-values.php';

/*
 * ---> BEGIN ARGUMENTS
 */
$args = array(
	// This is where your data is stored in the database and also becomes your global variable name.
	'opt_name'                  => $opt_name,

	// Name that appears at the top of your panel.
	'display_name'              => WORDTRAP_NAME,

	// Version that appears at the top of your panel.
	'display_version'           => WORDTRAP_VERSION,

	// Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only).
	'menu_type'                 => 'submenu',

	// Show the sections below the admin menu item or not.
	'allow_sub_menu'            => true,

	// The text to appear in the admin menu.
	'menu_title'                => esc_html__( 'Theme Options', 'wordtrap' ),

	// The text to appear on the page title.
	'page_title'                => esc_html__( 'Theme Options', 'wordtrap' ),

	// Disable to create your own Google fonts loader.
	'disable_google_fonts_link' => false,

	// Show the panel pages on the admin bar.
	'admin_bar'                 => true,

	// Icon for the admin bar menu.
	'admin_bar_icon'            => 'dashicons-portfolio',

	// Priority for the admin bar menu.
	'admin_bar_priority'        => 50,

	// Sets a different name for your global variable other than the opt_name.
	'global_variable'           => $opt_name,

	// Show the time the page took to load, etc. (forced on while on localhost or when WP_DEBUG is enabled).
	'dev_mode'                  => false,

	// Enable basic customizer support.
	'customizer'                => true,

	// Allow the panel to open expanded.
	'open_expanded'             => false,

	// Disable the save warning when a user changes a field.
	'disable_save_warn'         => false,

	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_priority'             => null,

	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters.
	'page_parent'               => 'themes.php',

	// Permissions needed to access the options panel.
	'page_permissions'          => 'manage_options',

	// Specify a custom URL to an icon.
	'menu_icon'                 => '',

	// Force your panel to always open to a specific tab (by id).
	'last_tab'                  => '',

	// Icon displayed in the admin panel next to your menu_title.
	'page_icon'                 => 'icon-themes',

	// Page slug used to denote the panel, will be based off page title, then menu title, then opt_name if not provided.
	'page_slug'                 => $opt_name,

	// On load save the defaults to DB before user clicks save.
	'save_defaults'             => true,

	// Display the default value next to each field when not set to the default value.
	'default_show'              => false,

	// What to print by the field's title if the value shown is default.
	'default_mark'              => '*',

	// Shows the Import/Export panel when not used as a field.
	'show_import_export'        => true,

	// The time transients will expire when the 'database' arg is set.
	'transient_time'            => 60 * MINUTE_IN_SECONDS,

	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output.
	'output'                    => false,

	// Allows dynamic CSS to be generated for customizer and google fonts,
	// but stops the dynamic CSS from going to the page head.
	'output_tag'                => false,

	// Disable the footer credit of Redux. Please leave if you can help it.
	'footer_credit'             => __( 'Wordtrap Theme Options', 'wordtrap' ),

	// If you prefer not to use the CDN for ACE Editor.
	// You may download the Redux Vendor Support plugin to run locally or embed it in your code.
	'use_cdn'                   => true,

	// Set the theme of the option panel.  Use 'wp' to use a more modern style, default is classic.
	'admin_theme'               => 'wp',

	// Enable or disable flyout menus when hovering over a menu with submenus.
	'flyout_submenus'           => true,

	// Mode to display fonts (auto|block|swap|fallback|optional)
	// See: https://developer.mozilla.org/en-US/docs/Web/CSS/@font-face/font-display.
	'font_display'              => 'swap',

	// HINTS.
	'hints'                     => array(
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'red',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	),

	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'database'                  => '',
	'network_admin'             => true,
	'search'                    => true,
);

Redux::set_args( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */

/*
 * ---> START VARIABLES
 */

$site_layout_options        		 = wordtrap_site_layout_options();
$site_layouts_without_boxed      = wrodtrap_site_layouts_without_boxed();
$layout_options                  = wordtrap_layout_options();
$banner_layout_options           = wordtrap_banner_layout_options();
$content_layout_options          = wordtrap_content_layout_options();
$main_layout_options          	 = wordtrap_main_layout_options();
$main_layouts_with_sidebar       = wordtrap_main_layouts_with_sidebar();
$main_layouts_with_both_sidebars = wordtrap_main_layouts_with_both_sidebars();
$font_style_options          	   = wordtrap_font_style_options();

/*
 * ---> END VARIABLES
 */

// -> START Global Fields
Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'Global', 'wordtrap' ),
		'id'               => 'wordtrap-global',
		'customizer_width' => '400px',
		'icon'             => 'el el-adjust-alt',
	)
);

require_once $dir . 'sections/global/layout.php';
require_once $dir . 'sections/global/logo.php';
require_once $dir . 'sections/global/icons.php';
require_once $dir . 'sections/global/css.php';
require_once $dir . 'sections/global/javascript.php';
// -> END Global Fields

// -> START Skin Fields
Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'Skin', 'wordtrap' ),
		'id'               => 'wordtrap-skin',
		'customizer_width' => '400px',
		'icon'             => 'el el-broom',
	)
);
require_once $dir . 'sections/skin/colors.php';
require_once $dir . 'sections/skin/layout.php';
require_once $dir . 'sections/skin/typography.php';
// -> END Skin Fields