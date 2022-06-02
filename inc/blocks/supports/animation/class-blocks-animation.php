<?php
/**
 * Class for Animation logic.
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

class Class_Wordtrap_Blocks_Animation {

  /**
	 * Constructor
	 */
	public function __construct() {
	  if ( ! defined( 'WORDTRAP_BLOCKS_ANIMATION_URL' ) ) {
      define( 'WORDTRAP_BLOCKS_ANIMATION_URL', WORDTRAP_BLOCKS_URI . '/supports/animation' );
      define( 'WORDTRAP_BLOCKS_ANIMATION_PATH', WORDTRAP_BLOCKS_PATH . '/supports/animation' );
    }

    add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_editor_assets' ) );
    add_action( 'enqueue_block_assets', array( $this, 'enqueue_block_frontend_assets' ) );
  }

  /**
   * Load Gutenberg editor assets.
   */
  public function enqueue_editor_assets() {
    $asset_file = include WORDTRAP_BLOCKS_ANIMATION_PATH . '/build/index.asset.php';

		wp_enqueue_script(
			'wordtrap-blocks-animation',
			WORDTRAP_BLOCKS_ANIMATION_URL . '/build/index.js',
			$asset_file['dependencies'],
			$asset_file['version'],
			true
		);

		wp_set_script_translations( 'wordtrap-blocks-animation', 'wordtrap' );
  }

  /**
   * Load Gutenberg assets.
   *
   * @since 1.0.0
   * @access  public
   */
  public function enqueue_block_frontend_assets() {
    global $post;

    if ( is_singular() && strpos( get_the_content( null, false, $post ), '<!-- wp:' ) === false ) {
      return;
    }

    $asset_file = include WORDTRAP_BLOCKS_ANIMATION_PATH . '/build/frontend.asset.php';

    wp_enqueue_style(
      'animate-css',
      WORDTRAP_BLOCKS_ANIMATION_URL . '/animate.min.css',
      array(),
      $asset_file['version']
    );

    wp_enqueue_style(
      'wordtrap-blocks-animation',
      WORDTRAP_BLOCKS_ANIMATION_URL . '/build/index.css',
      array(),
      $asset_file['version']
    );

    if ( is_admin() ) {
      return;
    }

    wp_enqueue_script(
      'wordtrap-animation',
      WORDTRAP_BLOCKS_ANIMATION_URL . '/build/frontend.js',
      $asset_file['dependencies'],
      $asset_file['version'],
      true
    );

    wp_script_add_data( 'wordtrap-animation', 'async', true );
  }
}

// Initialize the class
new Class_Wordtrap_Blocks_Animation;
