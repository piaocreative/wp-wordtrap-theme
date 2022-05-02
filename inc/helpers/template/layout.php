<?php
/**
 * The layout template
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_get_template_part' ) ) {
  /**
   * Load a template part into a template
   *
   * @params string   $slug   The slug name for the generic template.
   *         string   $name   The name of the specialised template.
   *         array    $args   Additional arguments passed to the template.
   */
  function wordtrap_get_template_part( $slug, $name = null, $args = array() ) {
    if ( empty( $args ) ) {
      return get_template_part( $slug, $name );
    }

    if ( is_array( $args ) ) {
      extract( $args );
    }

    $templates = array();
    $name      = (string) $name;

    if ( '' !== $name ) {
      $templates[] = "{$slug}-{$name}.php";
    }

    $templates[] = "{$slug}.php";
    $template    = locate_template( $templates );
    $template    = apply_filters( 'wordtrap_get_template_part', $template, $slug, $name );

    if ( $template ) {
      include $template;
    }
  }
}

if ( ! function_exists( 'wordtrap_get_archive_post_type' ) ) {
  /**
   * Get post type of archive page
   *
   * @return string - The post type of the archive page.
   */
  function wordtrap_get_archive_post_type() {
    $post_type = '';
    
    // Posts page, Date archive, Author archive
    if ( is_home() || is_date() || is_author() ) {
      $post_type = 'post';
    } else if ( is_archive() ) {
      $post_type = '';
      $term = get_queried_object();
      // Taxonomy page
      if ( $term && isset( $term->taxonomy ) ) {
        global $wp_taxonomies;
        $taxonomy = $term->taxonomy;
        if ( isset( $wp_taxonomies[ $taxonomy ] ) ) {
          $post_type = $wp_taxonomies[ $taxonomy ]->object_type[0];
        }
      }
      // Post type archive page
      else if ( is_post_type_archive() ) {
        global $wp_query;
        $post_type = $wp_query->query[ 'post_type' ];
      }
    }

    return $post_type;
  }
}

if ( ! function_exists( 'wordtrap_layout_condition' ) ) {
  /**
   * Get display condition about current page
   * 
   * @return array { string class, string type, int id }
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

if ( ! function_exists( 'wordtrap_render_template' ) ) {
  /**
   * Render builder template
   */
  function wordtrap_render_template( $template ) {
    if ( ! $template ) {
      return;
    }

    $post = get_post( $template );
    echo do_shortcode( $post->post_content );
  }
}

if ( ! function_exists( 'wordtrap_layout_template' ) ) {
  /**
   * Get builder template by template type
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
      return false;
    }

    $display_conditions = $wordtrap_display_conditions[ $template_type ];
    
    if ( $position ) {
      if ( ! isset( $display_conditions[ $position ] ) ) {
        return false;
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

if ( ! function_exists( 'wordtrap_main_layout' ) ) {
  /**
   * Get the main layout of current page
   *
   * @return string   The layout type.
   */
  function wordtrap_main_layout() {
    global $wordtrap_main_layout;

    if ( $wordtrap_main_layout ) {
      return $wordtrap_main_layout;
    }

    $layout = wordtrap_options( 'layout' );
    $left_sidebar = wordtrap_options( 'left-sidebar' );
    $right_sidebar = wordtrap_options( 'right-sidebar' );

    // Home, Normal page
    if ( is_front_page() || is_page() ) {
      if ( class_exists( 'woocommerce' ) && ( is_cart() || is_checkout() || is_account_page() ) ) {
        $left_sidebar = $right_sidebar = '';
      }
    } 
    // 404
    else if ( is_404() ) {
      $layout = 'full';
    }
    // Search results
    else if ( is_search() ) {
      $post_type = ( isset( $_GET['post_type'] ) && $_GET['post_type'] ) ? sanitize_text_field( $_GET['post_type'] ) : null;
      if ( in_array( $post_type, array( 'product', 'faq', 'member' ) ) ) {
        $layout = wordtrap_options( $post_type . 's-layout' );
        $left_sidebar = wordtrap_options( $post_type . 's-left-sidebar' );
        $right_sidebar = wordtrap_options( $post_type . 's-right-sidebar' );
      } else {
        $layout = wordtrap_options( 'posts-layout' );
        $left_sidebar = wordtrap_options( 'posts-left-sidebar' );
        $right_sidebar = wordtrap_options( 'posts-right-sidebar' );
      }
    }
    // Posts page, Date archive, Search results, Author archive
    else if ( is_home() || is_date() || is_author() ) {
      $layout = wordtrap_options( 'posts-layout' );
      $left_sidebar = wordtrap_options( 'posts-left-sidebar' );
      $right_sidebar = wordtrap_options( 'posts-right-sidebar' );
    }
    // Singular page
    else if ( is_singular() ) {
      $post_type = get_post_type();
      if ( in_array( $post_type, array( 'post', 'product', 'member' ) ) ) {
        $layout = wordtrap_options( $post_type . '-layout' );
        $left_sidebar = wordtrap_options( $post_type . '-left-sidebar' );
        $right_sidebar = wordtrap_options( $post_type . '-right-sidebar' );
      } else {
        $left_sidebar = $right_sidebar = '';
      }
    } 
    // Archive page
    else if ( is_archive() ) {
      $post_type = '';
      $term = get_queried_object();
      // Taxonomy page
      if ( $term && isset( $term->taxonomy ) ) {
        global $wp_taxonomies;
        $taxonomy = $term->taxonomy;
        if ( isset( $wp_taxonomies[ $taxonomy ] ) ) {
          $post_type = $wp_taxonomies[ $taxonomy ]->object_type[0];
        }
      }
      // Post type archive page
      else if ( is_post_type_archive() ) {
        global $wp_query;
        $post_type = $wp_query->query[ 'post_type' ];
      }

      if ( $post_type && in_array( $post_type, array( 'post', 'product', 'member', 'faq' ) ) ) {
        $layout = wordtrap_options( $post_type . 's-layout' );
        $left_sidebar = wordtrap_options( $post_type . 's-left-sidebar' );
        $right_sidebar = wordtrap_options( $post_type . 's-right-sidebar' );
      }
    }

    // Check sidebars
    $left_sidebar_top = wordtrap_layout_template( 'left-sidebar', 'top' );
    $left_sidebar_bottom = wordtrap_layout_template( 'left-sidebar', 'bottom' );
    $right_sidebar_top = wordtrap_layout_template( 'right-sidebar', 'top' );
    $right_sidebar_bottom = wordtrap_layout_template( 'right-sidebar', 'bottom' );

    $active_left_sidebar = $left_sidebar_top || $left_sidebar_bottom || is_active_sidebar( $left_sidebar );
    $active_right_sidebar = $right_sidebar_top || $right_sidebar_bottom || is_active_sidebar( $right_sidebar );

    if ( $layout === 'wide-left-sidebar' && ! $active_left_sidebar ) {
      $layout = 'wide';
    }
    if ( $layout === 'left-sidebar' && ! $active_left_sidebar ) {
      $layout = 'full';
    }
    if ( $layout === 'wide-right-sidebar' && ! $active_right_sidebar ) {
      $layout = 'wide';
    }
    if ( $layout === 'right-sidebar' && ! $active_right_sidebar ) {
      $layout = 'full';
    }
    if ( $layout === 'wide-both-sidebars' ) {
      if ( ! $active_left_sidebar && ! $active_right_sidebar ) {
        $layout = 'wide';
      } else if ( ! $active_left_sidebar ) {
        $layout = 'wide-right-sidebar';
      } else if ( ! $active_right_sidebar ) {
        $layout = 'wide-left-sidebar';
      }
    }
    if ( $layout === 'both-sidebars' ) {
      if ( ! $active_left_sidebar && ! $active_right_sidebar ) {
        $layout = 'full';
      } else if ( ! $active_left_sidebar ) {
        $layout = 'right-sidebar';
      } else if ( ! $active_right_sidebar ) {
        $layout = 'left-sidebar';
      }
    }

    $wordtrap_main_layout = array(
      'layout' => $layout,
      'left-sidebar' => $left_sidebar,
      'right-sidebar' => $right_sidebar
    );

    return apply_filters( 'wordtrap_main_layout', $wordtrap_main_layout );
  }
}