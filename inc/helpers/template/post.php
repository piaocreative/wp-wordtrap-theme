<?php
/**
 * Post template
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

    ob_start();

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

    $html = ob_get_clean();

    if ( $html ) : 
      ?>
      <div class="entry-meta">
        
        <?php echo $html ?>
      
      </div><!-- .entry-meta -->
      <?php 
    endif; 
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
    $is_archive = false;
    if ( is_search() ) {
      $share = false;
    } else if ( is_home() || is_date() || is_author() || is_archive() ) {
      $share = wordtrap_options( 'posts-share' );
      $is_archive = true;
    } else {
      if ( 'post' === get_post_type() ) {
        $share = wordtrap_options( 'post-share' );
      } else if ( 'page' === get_post_type() ) {
        $share = wordtrap_options( 'page-share' );
      } else {
        $share = false;
      }
    }

    ob_start();

    if ( $share ) {
      wordtrap_social_share();
    }

    // Read more
    $view_mode = wordtrap_get_view_mode();
    if ( $view_mode === 'grid' && $is_archive ) {
      printf( '<div class="read-more"><a href="%s" rel="bookmark">' . esc_html__( 'Read More', 'wordtrap' ) . '<i class="fa fa-arrow-right"></i></a></div>', esc_url( get_permalink() ) );
    }

    // Post metas available
    $post_metas = wordtrap_options( 'post-metas' );    
    if ( $post_metas && in_array( 'tags', $post_metas ) ) {
      $tags = get_the_tag_list( esc_html__( ' ', 'wordtrap' ), ' ' );
      if ( $tags ) {
        printf( '<div class="post-tags">' . esc_html__( '%s', 'wordtrap' ) . '</div>', $tags );
      }
    }

    $html = ob_get_clean();

    if ( $html ) : ?>
      <footer class="entry-footer">

        <?php echo $html ?>

      </footer><!-- .entry-footer -->
    <?php
    endif;
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

if ( ! function_exists( 'wordtrap_posts_filter_navigation' ) ) {
  /**
   * Show posts filter navigation
   *
   * @param string $nav_id - The ID of the filter navigation.
   */
  function wordtrap_posts_filter_navigation( $nav_id, $category_slug = '', $categories = array() ) {

    $post_type = wordtrap_get_archive_post_type();

    if ( ! $post_type ) {
      return;
    }

    $show_sort = wordtrap_options( $post_type . 's-sort' );
    $show_count = wordtrap_options( $post_type . 's-show-count' );
    $show_view_mode = wordtrap_options( $post_type . 's-view-mode' );

    if ( $nav_id === 'posts-filter-above' && ! ( $show_sort || $show_count || $show_view_mode || ! empty( $categories ) ) ) {
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

    $posts_counts = $show_count ? wordtrap_options( $post_type . 's-counts' ) : false;
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
          if ( $show_count || $show_view_mode ) : ?>
            <div class="posts-view d-flex justify-content-center">

              <?php 
              // Count
              if ( $show_count ) : ?>
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
              if ( $nav_id == 'posts-filter-above' && $show_view_mode ) : ?>
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
              if ( $nav_id == 'posts-filter-below' && $show_view_mode ) : ?>
                <input type="hidden" name="view" value="<?php echo esc_attr( $view_mode ) ?>"/>  
              <?php endif; ?>

            </div>
          <?php endif;

          // Sort
          if ( $nav_id == 'posts-filter-above' && $show_sort ) : ?>
            <label class="posts-sort">
              <?php _e( 'Sort by:', 'wordtrap') ?>
              <select name="orderby" class="orderby" aria-label="<?php esc_attr_e( 'Posts order', 'wordtrap' ); ?>">
              <?php foreach ( $posts_orderby_options as $id => $name ) : ?>
                <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
              <?php endforeach; ?>
              </select>
            </label>
          <?php endif; 
          if ( $nav_id == 'posts-filter-below' && $show_sort ) : ?>
            <input type="hidden" name="orderby" value="<?php echo esc_attr( $orderby ) ?>"/>
          <?php endif;

          if ( ! empty( $categories ) ) : 
            ?>
            <ul class="categories-filter nav">
              <li class="nav-item"><a data-filter="*" class="nav-link active" href="#"><?php esc_html_e( 'Show All', 'wordtrap' ); ?></a></li>
              <?php foreach ( $categories as $category ) : ?>
                <li class="nav-item"><a data-filter="<?php echo $category_slug ?>-<?php echo esc_attr( $category->slug ); ?>" class="nav-link" href="#"><?php echo esc_html( $category->name ); ?></a></li>
              <?php endforeach; ?>
            </ul>
            <?php
          endif;
          
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

if ( ! function_exists( 'wordtrap_edit_post_link' ) ) {
  /**
   * Displays the edit post link for post.
   */
  function wordtrap_edit_post_link() {
    edit_post_link(
      sprintf(
        /* translators: %s: Name of current post */
        esc_html__( 'Edit %s', 'wordtrap' ),
        the_title( '<span class="screen-reader-text">"', '"</span>', false )
      ),
      '<span class="wordtrap-edit-link">',
      '</span>'
    );
  }
}

if ( ! function_exists( 'wordtrap_get_related_posts' ) ) {
  /**
   * Get related posts
   * 
   * @param    $post_id     Post ID to get related posts
   *           $args        WP_Query argments
   * 
   * @return   WP_Query     WP_Query object
   */
  function wordtrap_get_related_posts( $post_id = null, $args = '' ) {

    if ( ! $post_id ) {
      $post_id = get_the_ID();
    }

    $args = wp_parse_args(
      $args,
      array(
        'showposts'           => wordtrap_options( 'post-related-count' ),
        'post__not_in'        => array( $post_id ),
        'ignore_sticky_posts' => 0,
        'category__in'        => wp_get_post_categories( $post_id ),
        'orderby'             => wordtrap_options( 'post-related-orderby' ),
      )
    );

    $query = new WP_Query( $args );

    return $query;
  }
}