<?php
/**
 * Content Types
 * 
 * A custom content types class to loading the faqs and the members.
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/* Check if Class Exists. */
if ( ! class_exists( 'Wordtrap_Post_Types' ) ) {
  /**
   * Wordtrap_Post_Types class.
   */
  class Wordtrap_Post_Types {

    /**
     * Construct
     */
    function __construct() {
    
      // Register content types
      add_action( 'init', array( $this, 'registerFaq' ) );
      add_action( 'init', array( $this, 'registerMember' ) );
    
      add_action(
        'admin_init',
        function() {
          if ( current_user_can( 'manage_options' ) && get_transient( 'wordtrap_flush_rewrite_rules', false ) ) {
            flush_rewrite_rules();
            delete_transient( 'wordtrap_flush_rewrite_rules' );
          }
        }
      );
    }

    /**
     * Register Faq Post Type
     */
    public function registerFaq() {
      if ( ! wordtrap_options( 'enable-faq' ) ) {
        return;
      }

      $slug_name       = wordtrap_options( 'faq-slug-name' ) ? esc_attr( wordtrap_options( 'faq-slug-name' ) ) : 'faq';
      $name            = wordtrap_options( 'faq-name' ) ? wordtrap_options( 'faq-name' ) : __( 'FAQs', 'wordtrap' );
      $singular_name   = wordtrap_options( 'faq-singular-name' ) ? wordtrap_options( 'faq-singular-name' ) : __( 'FAQ', 'wordtrap' );
      $cat_slug_name   = wordtrap_options( 'faq-cat-slug-name' ) ? esc_attr( wordtrap_options( 'faq-cat-slug-name' ) ) : 'faq_category';
      $cat_name        = wordtrap_options( 'faq-cat-name' ) ? wordtrap_options( 'faq-cat-name' ) : __( 'FAQ Category', 'wordtrap' );
      $cats_name       = wordtrap_options( 'faq-cats-name' ) ? wordtrap_options( 'faq-cats-name' ) : __( 'FAQ Categories', 'wordtrap' );      
      $archive_page_id = wordtrap_options( 'faqs-page' ) ? wordtrap_options( 'faqs-page' ) : 0;
      $has_archive     = true;
      if ( $archive_page_id && get_post( $archive_page_id ) ) {
        $has_archive = get_page_uri( $archive_page_id );
      }

      register_post_type(
        'faq',
        array(
          'labels'              => $this->getPostTypeLabels( $singular_name, $name ),
          'exclude_from_search' => false,
          'has_archive'         => $has_archive,
          'public'              => true,
          'rewrite'             => array( 'slug' => $slug_name ),
          'supports'            => array( 'title', 'editor' ),
          'can_export'          => true,
          'show_in_nav_menus'   => true,
          'show_in_rest'        => true,
        )
      );

      register_taxonomy(
        'faq_category',
        'faq',
        array(
          'hierarchical'        => true,
          'show_in_nav_menus'   => true,
          'labels'              => $this->getTaxonomyLabels( $cat_name, $cats_name ),
          'query_var'           => true,
          'rewrite'             => array( 'slug' => $cat_slug_name ),
          'show_in_rest'        => true,
        )
      );
    }

    /**
     * Register Member Post Type
     */
    public function registerMember() {
      if ( ! wordtrap_options( 'enable-member' ) ) {
        return;
      }
    }

    /**
     * Get labels for the post type
     */
    function getPostTypeLabels( $singular_name, $name, $title = false ) {
      if ( ! $title ) {
        $title = $name;
      }
  
      return array(
        'name'               => $title,
        'singular_name'      => $singular_name,
        'add_new'            => __( 'Add New', 'wordtrap' ),
        'add_new_item'       => sprintf( __( 'Add New %s', 'wordtrap' ), $singular_name ),
        'edit_item'          => sprintf( __( 'Edit %s', 'wordtrap' ), $singular_name ),
        'new_item'           => sprintf( __( 'New %s', 'wordtrap' ), $singular_name ),
        'view_item'          => sprintf( __( 'View %s', 'wordtrap' ), $singular_name ),
        'search_items'       => sprintf( __( 'Search %s', 'wordtrap' ), $name ),
        'not_found'          => sprintf( __( 'No %s found', 'wordtrap' ), $name ),
        'not_found_in_trash' => sprintf( __( 'No %s found in Trash', 'wordtrap' ), $name ),
        'parent_item_colon'  => '',
      );
    }

    /**
     * Get labels for the taxonomy
     */
    function getTaxonomyLabels( $singular_name, $name ) {
      return array(
        'name'               => $name,
        'singular_name'      => $singular_name,
        'search_items'       => sprintf( __( 'Search %s', 'wordtrap' ), $name ),
        'all_items'          => sprintf( __( 'All %s', 'wordtrap' ), $name ),
        'parent_item'        => sprintf( __( 'Parent %s', 'wordtrap' ), $singular_name ),
        'parent_item_colon'  => sprintf( __( 'Parent %s:', 'wordtrap' ), $singular_name ),
        'edit_item'          => sprintf( __( 'Edit %s', 'wordtrap' ), $singular_name ),
        'update_item'        => sprintf( __( 'Update %s', 'wordtrap' ), $singular_name ),
        'add_new_item'       => sprintf( __( 'Add New %s', 'wordtrap' ), $singular_name ),
        'new_item_name'      => sprintf( __( 'New %s Name', 'wordtrap' ), $singular_name ),
        'menu_name'          => $name,
      );
    }
  }
}

new Wordtrap_Post_Types();