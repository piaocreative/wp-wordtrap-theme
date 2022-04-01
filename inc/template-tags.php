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

    if ( in_array( 'cats', $post_metas ) ) {
      $cats = get_the_category_list( esc_html__( ', ', 'wordtrap' ) );
      if ( $cats ) {
        printf( '<span class="post-cats">' . esc_html__( '%s', 'wordtrap' ) . '</span>', $cats );
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

if ( ! function_exists( 'wordtrap_entry_footer' ) ) {
  /**
   * Show post footer
   */
  function wordtrap_entry_footer() {
    // Post metas available
    $post_metas = wordtrap_options( 'post-metas' );

    if ( wordtrap_options( 'post-share' ) ) {
      wordtrap_social_share();
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
    <nav class="navigation post-navigation justify-content-between">
      <h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'wordtrap' ); ?></h2>
      <div class="d-flex nav-links">
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