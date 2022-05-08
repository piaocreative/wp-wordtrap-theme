<?php
/**
 * The global template
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_back_to_link' ) ) {
  /**
   * Get back to link
   */
  function wordtrap_back_to_link() {
    
    $title = __( 'Back to home', 'wordtrap' );
    $link = home_url( '/' );

    if ( is_singular() ) {
      $post_type = get_post_type();
      $post_type_object = get_post_type_object( $post_type );

      if ( is_object( $post_type_object ) ) {        
        if ( 'product' == $post_type ) {
          $link = apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) );
          $title = apply_filters( 'woocommerce_return_to_shop_text', __( 'Return to shop', 'wordtrap' ) );
        } elseif ( class_exists( 'bbPress' ) && 'topic' == $post_type ) {
          $link = get_post_type_archive_link( $post_type );
          $title = sprintf( __( 'Back to %s', 'wordtrap' ), strtolower( bbp_get_topic_archive_title() ) );
        } else {
          $archive_title = '';
          $page_id = 0;
          switch ( $post_type ) {
            case 'post':
              if ( get_option( 'show_on_front' ) == 'page' ) {
                $page_id = (int) ( get_option( 'page_for_posts', true ) );
              }
              break;
            case 'member':
              $page_id = (int) wordtrap_options( 'members-page' );
              break;
            case 'faq':
              $page_id = (int) wordtrap_options( 'faqs-page' );
              break;
          }
        
          if ( $page_id && ( $post = get_post( $page_id ) ) ) {
            $archive_title = $post->post_title;
          } else {
            if ( isset( $post_type_object->label ) && '' !== $post_type_object->label ) {
              $archive_title = $post_type_object->label;
            } elseif ( isset( $post_type_object->labels->menu_name ) && '' !== $post_type_object->labels->menu_name ) {
              $archive_title = $post_type_object->labels->menu_name;
            } else {
              $archive_title = $post_type_object->name;
            }
          }
          
          if ( get_post_type_archive_link( $post_type ) ) {
            $link = get_post_type_archive_link( $post_type );
            $title = sprintf( __( 'Back to %s', 'wordtrap' ), strtolower( $archive_title ) );
          }          
        }
      }
    }
    
    return apply_filters( 'wordtrap_back_to_link', array(
      'link' => $link,
      'title' => $title
    ) );
  }
}

if ( ! function_exists( 'wordtrap_page_title' ) ) {
  /**
   * Get page title
   */
  function wordtrap_page_title() {
    global $wp_query;

    $title = '';

    $post = isset( $GLOBALS['post'] ) ? $GLOBALS['post'] : null;

    if ( ! is_front_page() ) {

    } elseif ( is_home() ) {
      $title = __( 'Blog', 'wordtrap' );
    }

    if ( is_singular() ) {
      $title = get_the_title();
    } else {
      if ( is_post_type_archive() ) {
        if ( is_search() ) {
          $title = sprintf( __( 'Search Results - %s', 'wordtrap' ), esc_html( get_search_query() ) );
        } else {
          $post_type = $wp_query->query_vars['post_type'];
          $post_type_object = get_post_type_object( $post_type );
          
          if ( is_object( $post_type_object ) ) {        
            if ( 'product' == $post_type ) {
              $post_type_object = get_post_type_object( $post_type );
              if ( is_object( $post_type_object ) && class_exists( 'WooCommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) ) {
                $shop_page_id   = wc_get_page_id( 'shop' );
                $shop_page_name = $shop_page_id ? get_the_title( $shop_page_id ) : '';
            
                if ( ! $shop_page_name ) {
                  $shop_page_name = $post_type_object->labels->name;
                }
                $title = $shop_page_name;
              }
            } elseif ( class_exists( 'bbPress' ) && 'topic' == $post_type ) {
              $title = bbp_get_topic_archive_title();
            } else {
              $page_id = 0;
              switch ( $post_type ) {
                case 'post':
                  if ( get_option( 'show_on_front' ) == 'page' ) {
                    $page_id = (int) ( get_option( 'page_for_posts', true ) );
                  }
                  break;
                case 'member':
                  $page_id = (int) wordtrap_options( 'members-page' );
                  break;
                case 'faq':
                  $page_id = (int) wordtrap_options( 'faqs-page' );
                  break;
              }
            
              if ( $page_id && ( $post = get_post( $page_id ) ) ) {
                $title = $post->post_title;
              } else {
                if ( isset( $post_type_object->label ) && '' !== $post_type_object->label ) {
                  $title = $post_type_object->label;
                } elseif ( isset( $post_type_object->labels->menu_name ) && '' !== $post_type_object->labels->menu_name ) {
                  $title = $post_type_object->labels->menu_name;
                } else {
                  $title = $post_type_object->name;
                }
              }
            }
          }
        }
      } elseif ( is_tax() || is_tag() || is_category() ) {
        $term  = $wp_query->get_queried_object();
        $term_name = $term->name;

        if ( is_tag() ) {
          $title = sprintf( esc_html__( 'Tag - %s', 'wordtrap' ), $term_name );
        } elseif ( is_tax( 'product_tag' ) ) {
          $title = sprintf( esc_html__( 'Product Tag - %s', 'wordtrap' ), $term_name );
        } else {
          $title = $term_name;
        }
      } elseif ( is_date() ) {
        if ( is_year() ) {
          $title = sprintf( __( 'Yearly Archives - %s', 'wordtrap' ), get_the_date( _x( 'Y', 'yearly archives date format', 'wordtrap' ) ) );
        } elseif ( is_month() ) {
          $title = sprintf( __( 'Monthly Archives - %s', 'wordtrap' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'wordtrap' ) ) );
        } elseif ( is_day() ) {
          $title = sprintf( __( 'Daily Archives - %s', 'wordtrap' ), get_the_date() );
        }
      } elseif ( is_author() ) {
        $title = sprintf( __( 'Author - %s', 'wordtrap' ), $wp_query->get_queried_object()->display_name );
      } elseif ( is_search() ) {
        $title = sprintf( __( 'Search Results - %s', 'wordtrap' ), esc_html( get_search_query() ) );
      } elseif ( is_404() ) {
        $title = __( '404 - Page Not Found', 'wordtrap' );
      } elseif ( class_exists( 'bbPress' ) && is_bbpress() ) {
        if ( bbp_is_search() ) {
          $title = sprintf( __( 'Search Results - %s', 'wordtrap' ), esc_html( get_query_var( 'bbp_search' ) ) );
        } elseif ( bbp_is_single_user() ) {
          $title = wp_get_current_user()->user_nicename;
        } else {
          $title = get_the_title( $post->ID );
        }
      } else {
        if ( is_home() && ! is_front_page() ) {
          if ( get_option( 'show_on_front' ) == 'page' ) {
            $title = get_the_title( get_option( 'page_for_posts', true ) );
          } else {
            $title = __( 'Blog', 'wordtrap' );
          }
        }
      }
    }
    
    return apply_filters( 'wordtrap_page_title', $title );
  }
}

if ( ! function_exists( 'wordtrap_social_share' ) ) {
  /**
   * Show social shares
   */
  function wordtrap_social_share() {
    if ( ! wordtrap_options( 'social-share' ) ) {
      return;
    }

    wordtrap_get_template_part( 'template-parts/share' );
  }
}

if ( ! function_exists( 'wordtrap_get_view_mode' ) ) {
  /**
   * Get view mode
   *
   * @return string      grid | list
   */
  function wordtrap_get_view_mode() {
    $post_type = wordtrap_get_archive_post_type();

    if ( ! $post_type ) {
      return '';
    }

    $default_view_mode = wordtrap_options( $post_type . 's-default-view-mode') ? 'grid' : 'list';
    $view_mode = isset( $_GET['view'] ) ? sanitize_text_field( wp_unslash( $_GET['view'] ) ) : $default_view_mode;

    return apply_filters( 'wordtrap_get_view_mode', $view_mode );
  }
}

if ( ! function_exists( 'wordtrap_grid_view_classes' ) ) {
  /**
   * Get grid view classes
   */
  function wordtrap_grid_view_classes() {
    $post_type = wordtrap_get_archive_post_type();

    if ( ! $post_type ) {
      return '';
    }

    if ( $post_type === 'post' ) {
      $grid_view = wordtrap_options( $post_type . 's-grid-view' );
      if ( ! ( $grid_view === 'grid' || $grid_view === 'masonry' ) ) {
        return '';
      }
    }    

    $classes = array();
    $classes[] = 'row';
    $classes[] = 'row-cols-sm-' . wordtrap_options( $post_type . 's-grid-columns-sm' );
    $classes[] = 'row-cols-md-' . wordtrap_options( $post_type . 's-grid-columns-md' );
    $classes[] = 'row-cols-lg-' . wordtrap_options( $post_type . 's-grid-columns-lg' );
    $classes[] = 'row-cols-xl-' . wordtrap_options( $post_type . 's-grid-columns-xl' );
    $classes[] = 'row-cols-xxl-' . wordtrap_options( $post_type . 's-grid-columns-xxl' );
    
    return apply_filters( 'wordtrap_grid_view_classes', implode( ' ', $classes ) );
  }
}

if ( ! function_exists( 'wordtrap_trim_excerpt' ) ) {
  /**
   * Trim excerpt
   */
  function wordtrap_trim_excerpt( $text = '', $excerpt_length = 55 ) {
    $raw_excerpt = $text;
    $text = apply_filters( 'the_content', $text );
    $text = str_replace( ']]>', ']]&gt;', $text );

    $excerpt_length = (int) _x( $excerpt_length, 'excerpt_length' );
    $excerpt_length = (int) apply_filters( 'excerpt_length', $excerpt_length );

    $excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
    $text         = wp_trim_words( $text, $excerpt_length, $excerpt_more );
  
    return apply_filters( 'wordtrap_trim_excerpt', $text, $raw_excerpt );
  }
}

if ( ! function_exists( 'wordtrap_post_nav' ) ) {
  /**
   * Display navigation to next/previous post when applicable.
   */
  function wordtrap_post_nav() {
    $post_type = get_post_type();
    if ( ! wordtrap_options( $post_type . '-nav' ) ) {
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
      <div class="d-flex nav-links justify-content-between<?php echo get_previous_post_link() ? '' : ' flex-row-reverse' ?>">
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
