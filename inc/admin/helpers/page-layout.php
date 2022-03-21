<?php
/**
 * Wordtrap admin page layout functions
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if ( ! function_exists( 'wordtrap_page_layout_save_conditions' ) ) {
  /**
   * Save page layout display conditions
   */
  function wordtrap_page_layout_save_conditions() {
    $layout_option = get_option( WORDTRAP_PAGE_LAYOUT, array() );
    $blocks = array_keys( $layout_option );
    $display_conditions = array();
    foreach ( $blocks as $block ) {
      $templates = $layout_option[ $block ];
      $display_conditions[ $block ] = array();
      
      if ( $block == 'left-sidebar' || $block == 'right-sidebar' ) {
        $display_conditions[ $block ][ 'top' ] = array();
        $display_conditions[ $block ][ 'bottom' ] = array();
      } else if ( $block == 'main' ) {
        $display_conditions[ $block ][ 'main-top' ] = array();
        $display_conditions[ $block ][ 'content-top' ] = array();
        $display_conditions[ $block ][ 'content-bottom' ] = array();
        $display_conditions[ $block ][ 'main-bottom' ] = array();
      }
      
      foreach ( $templates as $id ) {
        $template = get_post( $id );
        if ( $template->post_type != Wordtrap_Templates_Builder::POST_TYPE ) continue;
        $template_type = get_post_meta( (int) $id, Wordtrap_Templates_Builder::TEMPLATE_TYPE, true );
        if ( $template_type != $block ) continue;

        $conditions = array();
        $conditions[ WORDTRAP_CONDITIONS_ALL ] = get_post_meta( $id, WORDTRAP_CONDITIONS_ALL, true );
        $conditions[ WORDTRAP_CONDITIONS_SINGULAR ] = get_post_meta( $id, WORDTRAP_CONDITIONS_SINGULAR, true );
        $conditions[ WORDTRAP_CONDITIONS_ARCHIVE ] = get_post_meta( $id, WORDTRAP_CONDITIONS_ARCHIVE, true );
        if ( $conditions[ WORDTRAP_CONDITIONS_SINGULAR ] && $conditions[ WORDTRAP_CONDITIONS_ARCHIVE] ) {
          $conditions[ WORDTRAP_CONDITIONS_ALL ] = true;
        }
        if ( ! $conditions[ WORDTRAP_CONDITIONS_ALL] ) {
          if ( ! $conditions[ WORDTRAP_CONDITIONS_SINGULAR ] ) {
            $singular_conditions = get_post_meta( $id, WORDTRAP_SINGULAR_CONDITIONS, true );
            if ( ! $singular_conditions ) {
              $singular_conditions = array( 
                'checked' => array(),
                'selected' => array()
              );
            }
            $conditions[ WORDTRAP_SINGULAR_CONDITIONS ] = $singular_conditions;
          }
          if ( ! $conditions[ WORDTRAP_CONDITIONS_ARCHIVE ] ) {
            $archive_conditions = get_post_meta( $id, WORDTRAP_ARCHIVE_CONDITIONS, true );
            if ( ! $archive_conditions ) {
              $archive_conditions = array( 
                'checked' => array(),
                'selected' => array()
              );
            }
            $conditions[ WORDTRAP_ARCHIVE_CONDITIONS ] = $archive_conditions;
          }
        }

        if ( $block == 'left-sidebar' || $block == 'right-sidebar' || $block == 'main' ) {
          $position = get_post_meta( $id, WORDTRAP_DISPLAY_POSITIONS, true );
          if ( ! $position ) break;
          if ( is_array( $position ) ) {
            foreach ( $position as $pos ) {
              $display_conditions[ $block ][ $pos ][ $id ] = $conditions;
            }
          } else {
            $display_conditions[ $block ][ $position ][ $id ] = $conditions;
          }
        } else {
          $display_conditions[ $block ][ $id ] = $conditions;
        }
      }
    }
    update_option( WORDTRAP_DISPLAY_CONDITIONS, $display_conditions );
  }
}

if ( ! function_exists( 'wordtrap_layout_condition' ) ) {
  /**
   * Get display condition about current page
   * 
   * @return array { string class, string type }
   */
  function wordtrap_layout_condition() {
    global $wordtrap_layout_condition;

    if ( $wordtrap_layout_condition ) {
      return $wordtrap_layout_condition;
    }

    $type = '';
    $class = '';
    $id = '';

    if ( is_front_page() ) {       // Home page
      $class = 'singular';
      $type = 'home';
    } else if ( is_home() ) {      // Posts page
      $class = 'archive';
      $type = 'post';
    } else if ( is_404() ) {       // 404 page
      $class = 'singular';
      $type = '404';
    } else if ( is_page() ) {      // Normal page
      $class = 'singular';
      $type = 'page';
      $id = get_the_ID();
    } else if ( is_date() ) {      // Date archive
      $class = 'archive';
      $type = 'date';
    } else if ( is_search() ) {    // Search results
      $class = 'archive';
      $type = 'search';
    } else if ( is_author() ) {    // Author page
      $class = 'archive';
      $type = 'author';
    } else if ( is_singular() ) {  // Singular page
      $class = 'singular';
      $type = get_post_type();
      $id = get_the_ID();
    } else if ( is_archive() ) {   // Archive page
      $class = 'archive';
      $term = get_queried_object();
      if ( $term && isset( $term->taxonomy ) ) {  // Taxonomy page
        $type = $term->taxonomy;
        $id = $term->term_id;
      } else if ( is_post_type_archive() ) {      // Post type archive page
        global $wp_query;
        $type = $wp_query->query[ 'post_type' ];
      }
    }

    $wordtrap_layout_condition = array(
      'class' => $class,
      'type' => $type,
      'id' => $id
    );

    return $wordtrap_layout_condition;
  }
}

if ( ! function_exists( 'wordtrap_render_layout' ) ) {
  /**
   * Render template by template type
   */
  function wordtrap_render_layout( $template_type, $position = '' ) {
    $template = wordtrap_layout_template( $template_type, $position );
    if ( $template ) {
      $post = get_post( $template );
      echo do_shortcode( $post->post_content );
    }
  }
}

if ( ! function_exists( 'wordtrap_layout_template' ) ) {
  /**
   * Load template by template type
   * 
   * @params string @template_type    Template type.
   *         string @position         Display position.
   * 
   * @return int | false              Template id.
   */
  function wordtrap_layout_template( $template_type, $position = '') {
    global $wordtrap_display_conditions;

    if ( ! $wordtrap_display_conditions ) {
      $wordtrap_display_conditions = get_option( WORDTRAP_DISPLAY_CONDITIONS, array() );
    }

    if ( ! isset( $wordtrap_display_conditions[ $template_type ] ) ) {
      return;
    }

    $display_conditions = $wordtrap_display_conditions[ $template_type ];
    
    if ( $position ) {
      if ( ! isset( $display_conditions[ $position ] ) ) {
        return;
      }
      $display_conditions = $display_conditions[ $position ];
    }

    // get current condition
    $condition = wordtrap_layout_condition();

    foreach ( $display_conditions as $template_id => $template_conditions ) {
      if ( $template_conditions[ 'conditions-all' ] ) {
        return $template_id;
      }
      
      if ( $template_conditions[ 'conditions-' . $condition[ 'class' ] ] ) {
        return $template_id;
      }
      
      $sub_conditions = $template_conditions[ $condition[ 'class' ] . '-conditions' ];
      
      if ( in_array( $condition[ 'type' ], $sub_conditions[ 'checked' ] ) ) {
        return $template_id;
      }

      if ( isset( $sub_conditions[ 'selected' ][ $condition[ 'type' ] ] ) && in_array( $condition[ 'id' ], $sub_conditions[ 'selected' ][ $condition[ 'type' ] ] ) ) {
        return $template_id;
      }
    }
    
    return false;
  }
}