<?php
/**
 * Theme template functions
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_post_metas' ) ) {
  /**
   * Show post metas
   */
  function wordtrap_post_metas() {
    // Post metas available
    $post_metas = wordtrap_options( 'post-metas' );

    if ( ! $post_metas ) {
      return;
    }

    if ( in_array( 'date', $post_metas ) ) {
      $time_string = '<time class="entry-date post-published post-updated" datetime="%1$s">%2$s</time>';
      if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date post-published" datetime="%1$s">%2$s</time><time class="post-updated" datetime="%3$s"> (%4$s) </time>';
      }

      // Time String
      $time_string = sprintf(
        $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
      );

      // Post Date
      $posted_on_date = apply_filters(
        'wordtrap_posted_on_date',
        sprintf(
          '<span class="post-date"><a href="%1$s" rel="bookmark">%2$s</a></span>',
          esc_url( get_permalink() ),
          apply_filters( 'wordtrap_posted_on_time', $time_string )
        )
      );

      echo $posted_on_date;
    }

    // Post Author
    if ( in_array( 'author', $post_metas ) ) {
      $posted_by_author = apply_filters(
        'wordtrap_posted_by_author',
        sprintf(
          '<span class="post-author"><a href="%1$s">%2$s</a></span>',
          esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
          esc_html( get_the_author() )
        )
      );

      echo $posted_by_author;
    }

    // Categories
    if ( in_array( 'cats', $post_metas ) ) {
      $cats = get_the_category_list( esc_html__( ', ', 'wordtrap' ) );
      if ( $cats ) {
        printf( '<span class="post-cats">' . esc_html__( '%s', 'wordtrap' ) . '</span>', $cats );
      }
    }

    // Post Format
    if ( in_array( 'format', $post_metas ) ) {
      $post_format = get_post_format();
    
      if ( $post_format ) {
        $icon = wordtrap_post_format_icon();
        $posted_on_format = apply_filters(
          'wordtrap_posted_on_format',
          sprintf(
            '<span class="post-format"><a href="%1$s">%2$s</a></span>',
            esc_url( get_post_format_link( $post_format ) ),
            $icon
          )
        );
  
        echo $posted_on_format;
      }
    }

    // Post Comments    
    if ( comments_open() && in_array( 'comments', $post_metas ) ) {
      echo '<span class="post-comments">';
      comments_popup_link( esc_html__( 'Leave a Comment', 'wordtrap' ), esc_html__( '1 Comment', 'wordtrap' ), esc_html__( '% Comments', 'wordtrap' ) );
      echo '</span>';
    }
  }
}

if ( ! function_exists( 'wordtrap_post_format_icon' ) ) {
  /**
   * Get post format icon
   */
  function wordtrap_post_format_icon() {
    $post_format = get_post_format();
    
    $icon = '';
    if ( $post_format ) {
      if ( $post_format === 'link' ) {
        $icon = '<i class="dashicons dashicons dashicons-admin-links"></i>';
      } else {
        $icon = '<i class="dashicons dashicons-format-' . esc_attr( $post_format ) . '"></i>';
      }
    }

    return $icon;
  }
}

if ( ! function_exists( 'wordtrap_entry_footer' ) ) {
  /**
   * Show post footer
   */
  function wordtrap_entry_footer() {
    if ( is_home() || is_date() || is_search() || is_author() || is_archive() ) {
      $share = wordtrap_options( 'posts-share' );
    } else {
      $share = wordtrap_options( 'post-share' );
    }

    if ( $share ) {
      wordtrap_social_share();
    }

    // Read more
    $view_mode = wordtrap_get_view_mode();
    if ( $view_mode === 'grid' ) {
      printf( '<div class="read-more"><a href="%s" rel="bookmark">' . esc_html__( 'Read More', 'wordtrap' ) . '<i class="fa fa-arrow-right"></i></a></div>', esc_url( get_permalink() ) );
    }

    // Post metas available
    $post_metas = wordtrap_options( 'post-metas' );    
    if ( ! $post_metas ) {
      return;
    }

    if ( in_array( 'tags', $post_metas ) ) {
      $tags = get_the_tag_list( esc_html__( ' ', 'wordtrap' ), ' ' );
      if ( $tags ) {
        printf( '<div class="post-tags">' . esc_html__( '%s', 'wordtrap' ) . '</div>', $tags );
      }
    }
  }
}

if ( ! function_exists( 'wordtrap_social_share' ) ) {
  /**
   * Show social shares
   */
  function wordtrap_social_share() {
    wordtrap_get_template_part( 'template-parts/share' );    
  }
}

if ( ! function_exists( 'wordtrap_post_nav' ) ) {
  /**
   * Display navigation to next/previous post when applicable.
   */
  function wordtrap_post_nav() {
    if ( ! wordtrap_options( 'post-nav' ) ) {
      return;
    }
    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
    $next = get_adjacent_post( false, '', false );
    if ( ! $next && ! $previous ) {
      return;
    }
    ?>
    <nav class="navigation post-navigation">
      <h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'wordtrap' ); ?></h2>
      <div class="d-flex nav-links justify-content-between">
        <?php
        if ( get_previous_post_link() ) {
          previous_post_link( '<span class="nav-previous">%link</span>', _x( '<i class="fa fa-angle-left"></i>&nbsp;%title', 'Previous', 'wordtrap' ) );
        }
        if ( get_next_post_link() ) {
          next_post_link( '<span class="nav-next">%link</span>', _x( '%title&nbsp;<i class="fa fa-angle-right"></i>', 'Next', 'wordtrap' ) );
        }
        ?>
      </div>
    </nav>
    <?php
  }
}

if ( ! function_exists( 'wordtrap_link_pages_args' ) ) {
  /**
   * Filters the arguments used in retrieving page links for paginated posts.
   */
  function wordtrap_link_pages_args( $args ) {
    $args[ 'before' ] = '<p class="post-nav-links"><span class="me-1">' . __( 'Pages:', 'wordtrap' ) . '</span>';
    $args[ 'after' ] = '</p>';
    $args[ 'nextpagelink' ] = __( 'Next&nbsp;<i class="fa fa-angle-right"></i>', 'wordtrap' );
    $args[ 'previouspagelink' ] = __( '<i class="fa fa-angle-left"></i>&nbsp;Back', 'wordtrap' );
    return $args;
  }
}

add_filter( 'wp_link_pages_args', 'wordtrap_link_pages_args' );

if ( ! function_exists( 'wordtrap_get_archive_post_type' ) ) {
  /**
   * Get post type of archive page
   *
   * @return string - The post type of the archive page.
   */
  function wordtrap_get_archive_post_type() {
    $post_type = '';
    
    // Posts page, Date archive, Search results, Author archive
    if ( is_home() || is_date() || is_search() || is_author() ) {
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

if ( ! function_exists( 'wordtrap_posts_filter_navigation' ) ) {
  /**
   * Show posts filter navigation
   *
   * @param string $nav_id - The ID of the filter navigation.
   */
  function wordtrap_posts_filter_navigation( $nav_id ) {

    $post_type = wordtrap_get_archive_post_type();

    if ( ! $post_type ) {
      return;
    }

    if ( $nav_id === 'posts-filter-above' && ! ( wordtrap_options( $post_type . 's-sort' ) || wordtrap_options( $post_type . 's-show-count' ) || wordtrap_options( $post_type . 's-view-mode' ) ) ) {
      return;
    }

    $posts_orderby_options = apply_filters(
      'wordtrap_posts_orderby',
      array(
        ''              => __( 'Default sorting', 'wordtrap' ),
        'relevance'     => __( 'Sort by popularity', 'wordtrap' ),
        'comment_count' => __( 'Sort by comment count', 'wordtrap' ),
        'date'          => __( 'Sort by latest', 'wordtrap' ),        
      )
    );

    $default_orderby = is_search() ? 'relevance' : '';
    $orderby = isset( $_GET['orderby'] ) ? sanitize_text_field( wp_unslash( $_GET['orderby'] ) ) : $default_orderby;

    $posts_counts = wordtrap_options( $post_type . 's-show-count' ) ? wordtrap_options( $post_type . 's-counts' ) : false;
    if ( ! is_array( $posts_counts ) ) {
      $posts_counts = array( get_option( 'posts_per_page' ) );
    }
    $default_count = $posts_counts[ 0 ];
    $posts_per_page = isset( $_GET['posts_per_page'] ) ? sanitize_text_field( wp_unslash( $_GET['posts_per_page'] ) ) : $default_count;

    $default_view_mode = wordtrap_options( $post_type . 's-default-view-mode') ? 'grid' : 'list';
    $view_mode = isset( $_GET['view'] ) ? sanitize_text_field( wp_unslash( $_GET['view'] ) ) : $default_view_mode;
    ?>
    <nav class="posts-filter-nav" id="<?php echo esc_attr( $nav_id ); ?>">

      <h3 class="screen-reader-text"><?php esc_html_e( 'Posts filter navigation', 'wordtrap' ); ?></h3>

      <form class="posts-filter" method="get">
        
        <input type="hidden" name="paged" value="1" />
        
        <div class="posts-filter-wrap">
          
          <?php 
          // Sort
          if ( $nav_id == 'posts-filter-above' && wordtrap_options( $post_type . 's-sort' ) ) : ?>
            <label>
              <?php _e( 'Sort by:', 'wordtrap') ?>
              <select name="orderby" class="orderby" aria-label="<?php esc_attr_e( 'Posts order', 'wordtrap' ); ?>">
              <?php foreach ( $posts_orderby_options as $id => $name ) : ?>
                <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
              <?php endforeach; ?>
              </select>
            </label>
          <?php endif; 
          if ( $nav_id == 'posts-filter-below' && wordtrap_options( $post_type . 's-sort' ) ) : ?>
            <input type="hidden" name="orderby" value="<?php echo esc_attr( $orderby ) ?>"/>
          <?php endif;
          
          if ( wordtrap_options( $post_type . 's-show-count' ) || wordtrap_options( $post_type . 's-view-mode' ) ) : ?>
            <div class="posts-view d-flex justify-content-center">

              <?php 
              // Count
              if ( wordtrap_options( $post_type . 's-show-count' ) ) : ?>
                <label>
                  <?php _e( 'Show:', 'wordtrap') ?>
                  <select name="posts_per_page" class="posts_per_page" aria-label="<?php esc_attr_e( 'Posts per page', 'wordtrap' ); ?>">
                  <?php foreach ( $posts_counts as $count ) : ?>
                    <option value="<?php echo esc_attr( $count ); ?>" <?php selected( $posts_per_page, $count ); ?>><?php echo esc_html( $count ); ?></option>
                  <?php endforeach; ?>
                  </select>
                </label>
              <?php endif; ?>

              <?php 
              // View Mode
              if ( $nav_id == 'posts-filter-above' && wordtrap_options( $post_type . 's-view-mode' ) ) : ?>
                <div class="posts-view-mode">
                  <label>
                    <input type="radio" name="view" value="grid" <?php checked( $view_mode, 'grid' ) ?>/>
                    <i class="fa fa-th"></i>
                  </label>
                  <label>
                    <input type="radio" name="view" value="list" <?php checked( $view_mode, 'list' ) ?>/>
                    <i class="fa fa-th-list"></i>
                  </label>
                </div>
              <?php endif; 
              if ( $nav_id == 'posts-filter-below' && wordtrap_options( $post_type . 's-view-mode' ) ) : ?>
                <input type="hidden" name="view" value="<?php echo esc_attr( $view_mode ) ?>"/>  
              <?php endif; ?>

            </div>
          <?php endif;
          
          if ( $nav_id == 'posts-filter-below' ) {
            // Previous/next page navigation.
            wordtrap_the_posts_navigation();
          }
          ?>

        </div>
      </form>
    </nav>
    <?php
  }
}

if ( ! function_exists( 'wordtrap_pre_get_posts' ) ) {
  /**
   * Fires after the query variable object is created, but before the actual query is run.
   *
   * @param WP_Query $query The WP_Query instance (passed by reference).
   */
  function wordtrap_pre_get_posts( $query ) {
    if ( ! $query->is_main_query() ) {
      return;
    }
  
    $post_type = wordtrap_get_archive_post_type();

    if ( ! $post_type ) {
      return;
    }
    
    $posts_counts = wordtrap_options( $post_type . 's-show-count' ) ? wordtrap_options( $post_type . 's-counts' ) : false;
    if ( ! is_array( $posts_counts ) ) {
      $posts_counts = array( get_option( 'posts_per_page' ) );
    }
    $default_count = $posts_counts[ 0 ];
    $posts_per_page = isset( $_GET['posts_per_page'] ) ? sanitize_text_field( wp_unslash( $_GET['posts_per_page'] ) ) : $default_count;
    $query->set( 'posts_per_page', $posts_per_page );
  
    return $query;
  }
}

add_action( 'pre_get_posts',  'wordtrap_pre_get_posts' );

if ( ! function_exists( 'wordtrap_get_view_mode' ) ) {
  /**
   * Get view mode
   *
   * @return string      grid | list
   */
  function wordtrap_get_view_mode() {
    $default_view_mode = wordtrap_options( 'posts-default-view-mode') ? 'grid' : 'list';
    $view_mode = isset( $_GET['view'] ) ? sanitize_text_field( wp_unslash( $_GET['view'] ) ) : $default_view_mode;

    return $view_mode;
  }
}

if ( ! function_exists( 'wordtrap_grid_view_classes' ) ) {
  /**
   * Get grid view classes
   */
  function wordtrap_grid_view_classes() {
    $grid_view = wordtrap_options( 'posts-grid-view' );
    if ( ! ( $grid_view === 'grid' || $grid_view === 'masonry' ) ) {
      return '';
    }

    $classes = array();
    $classes[] = 'row-cols-sm-' . wordtrap_options( 'posts-grid-columns-sm' );
    $classes[] = 'row-cols-md-' . wordtrap_options( 'posts-grid-columns-md' );
    $classes[] = 'row-cols-lg-' . wordtrap_options( 'posts-grid-columns-lg' );
    $classes[] = 'row-cols-xl-' . wordtrap_options( 'posts-grid-columns-xl' );
    $classes[] = 'row-cols-xxl-' . wordtrap_options( 'posts-grid-columns-xxl' );
    
    return implode( ' ', $classes );
  }
}

//row-cols-sm-2 row-cols-lg-3