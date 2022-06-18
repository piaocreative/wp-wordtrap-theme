<?php
/**
 * Theme options field's values
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_layout_options' ) ) {
  /**
   * General layout options
   */
  function wordtrap_layout_options() {
    return array(
      'full'  => array(
        'title' => esc_html__( 'Full', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/layouts/full.svg',
      ),
      'wide'  => array(
        'title' => esc_html__( 'Wide', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/layouts/wide.svg',
      ),
      'boxed' => array(
        'title' => esc_html__( 'Boxed', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/layouts/boxed.svg',
      )
    );
  }
}

if ( ! function_exists( 'wordtrap_page_header_layout_options' ) ) {
  /**
   * Page header layout options
   */
  function wordtrap_page_header_layout_options() {
    return array(
      'full'  => array(
        'title' => esc_html__( 'Full', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/layouts/full.svg',
      ),
      'boxed' => array(
        'title' => esc_html__( 'Boxed', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/layouts/boxed.svg',
      )
    );
  }
}

if ( ! function_exists( 'wordtrap_main_layout_options' ) ) {
  /**
   * Main layout options
   */
  function wordtrap_main_layout_options() {
    return array(
      'full-without-sidebars'  => array(
        'title' => esc_html__( 'Full Width', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/full-without-sidebars.svg',
      ),
      'full-left-sidebar'  => array(
        'title' => esc_html__( 'Full Left Sidebar', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/full-left-sidebar.svg',
      ),
      'full-right-sidebar' => array(
        'title' => esc_html__( 'Full Right Sidebar', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/full-right-sidebar.svg',
      ),
      'full-both-sidebars' => array(
        'title' => esc_html__( 'Full Both Sidebars', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/full-both-sidebars.svg',
      ),
      'without-sidebars'  => array(
        'title' => esc_html__( 'Boxed Width', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/without-sidebars.svg',
      ),
      'left-sidebar'  => array(
        'title' => esc_html__( 'Boxed Left Sidebar', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/left-sidebar.svg',
      ),
      'right-sidebar' => array(
        'title' => esc_html__( 'Boxed Right Sidebar', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/right-sidebar.svg',
      ),
      'both-sidebars' => array(
        'title' => esc_html__( 'Boxed Both Sidebars', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/both-sidebars.svg',
      ),
    );
  }
}

if ( ! function_exists( 'wordtrap_main_layouts_with_left_sidebar' ) ) :
  /**
   * Main Layout values with left sidebar
   */
  function wordtrap_main_layouts_with_left_sidebar() {
    return array(
      'full-left-sidebar',
      'full-both-sidebars',
      'left-sidebar',
      'both-sidebars',
    );
  }
endif;

if ( ! function_exists( 'wordtrap_main_layouts_with_right_sidebar' ) ) :
  /**
   * Main Layout values with right sidebar
   */
  function wordtrap_main_layouts_with_right_sidebar() {
    return array(
      'full-right-sidebar',
      'full-both-sidebars',
      'right-sidebar',
      'both-sidebars',
    );
  }
endif;

if ( ! function_exists( 'wordtrap_font_style_options' ) ) {
  /**
   * Font style options
   */
  function wordtrap_font_style_options() {
    return array(
      'normal'  => esc_html__( 'Normal', 'wordtrap' ),
      'italic'  => esc_html__( 'Italic', 'wordtrap' ),
      'oblique'  => esc_html__( 'Oblique', 'wordtrap' ),
    );
  }
}

if ( ! function_exists( 'wordtrap_posts_grid_layout_options' ) ) {
  /**
   * Post archive layout options in the grid mode
   */
  function wordtrap_posts_grid_layout_options() {
    return array(
      'grid'  => array(
        'title' => esc_html__( 'Grid', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archive-grid.svg',
      ),
      'masonry'  => array(
        'title' => esc_html__( 'Masonry', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archive-masonry.svg',
      ),
      'timeline'  => array(
        'title' => esc_html__( 'Timeline', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archive-timeline.svg',
      ),
    );
  }
}

if ( ! function_exists( 'wordtrap_posts_related_layout_options' ) ) {
  /**
   * Related posts layout options
   */
  function wordtrap_posts_related_layout_options() {
    return array(
      'grid'  => array(
        'title' => esc_html__( 'Grid', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archive-grid.svg',
      ),
      'masonry'  => array(
        'title' => esc_html__( 'Masonry', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archive-masonry.svg',
      ),
    );
  }
}

if ( ! function_exists( 'wordtrap_posts_list_layout_options' ) ) {
  /**
   * Post archive layout options in the list mode
   */
  function wordtrap_posts_list_layout_options() {
    return array(
      'full'  => array(
        'title' => esc_html__( 'Full', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archive-full.svg',
      ),
      'large'  => array(
        'title' => esc_html__( 'Large', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archive-large.svg',
      ),
      'medium'  => array(
        'title' => esc_html__( 'Medium', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archive-medium.svg',
      ),
    );
  }
}

if ( ! function_exists( 'wordtrap_post_layout_options' ) ) {
  /**
   * Post singular layout options
   */
  function wordtrap_post_layout_options() {
    return array(
      'full'  => array(
        'title' => esc_html__( 'Full', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/singular-full.svg',
      ),
      'large'  => array(
        'title' => esc_html__( 'Large', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/singular-large.svg',
      ),
      'medium'  => array(
        'title' => esc_html__( 'Medium', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/singular-medium.svg',
      ),      
    );
  }
}

if ( ! function_exists( 'wordtrap_pagination_options' ) ) {
  /**
   * Pagination options
   */
  function wordtrap_pagination_options() {
    return array(
      ''          => esc_html__( 'Normal', 'wordtrap' ),
      'ajax'      => esc_html__( 'Ajax Load', 'wordtrap' ),
      // 'load-more' => esc_html__( 'Load More', 'wordtrap' ),
      // 'infinite'  => esc_html__( 'Infinite Scroll', 'wordtrap' ),
    );
  }
}

if ( ! function_exists( 'wordtrap_post_related_view_options' ) ) {
  /**
   * Related post view options
   */
  function wordtrap_post_related_view_options() {
    return array(
      '1'  => array(
        'title' => esc_html__( 'Read More Link', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/related-1.svg',
      ),
      '2'  => array(
        'title' => esc_html__( 'Post Meta', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/related-2.svg',
      ),
      '3'  => array(
        'title' => esc_html__( 'Read More Button', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/related-3.svg',
      ),
      '4'  => array(
        'title' => esc_html__( 'Side Image', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/related-4.svg',
      ),
      '5'  => array(
        'title' => esc_html__( 'Categories', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/related-5.svg',
      ),
      '6'  => array(
        'title' => esc_html__( 'Read More Link', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/related-6.svg',
      ),
    );
  }
}

if ( ! function_exists( 'wordtrap_cats_orderby_options' ) ) {
  /**
   * Categories orderby options
   */
  function wordtrap_cats_orderby_options() {
    return array(
      'ID'      => esc_html__( 'ID', 'wordtrap' ),
      'name'    => esc_html__( 'Name', 'wordtrap' ),
      'slug'    => esc_html__( 'Slug Name', 'wordtrap' ),
      'count'   => esc_html__( 'Count', 'wordtrap' ),
    );
  }
}

if ( ! function_exists( 'wordtrap_cats_order_options' ) ) {
  /**
   * Categories order options
   */
  function wordtrap_cats_order_options() {
    return array(
      'asc'     => esc_html__( 'Asc', 'wordtrap' ),
      'desc'    => esc_html__( 'Desc', 'wordtrap' ),
    );
  }
}

if ( ! function_exists( 'wordtrap_cats_filter_position_options' ) ) {
  /**
   * Categories filter position options
   */
  function wordtrap_cats_filter_position_options() {
    return array(
      'content'     => esc_html__( 'Content', 'wordtrap' ),
      'breadcrumbs' => esc_html__( 'Breadcrumbs', 'wordtrap' ),
      'sidebar'     => esc_html__( 'Sidebar', 'wordtrap' ),
      'hide'        => esc_html__( 'Hide', 'wordtrap' ),
    );
  }
}

if ( ! function_exists( 'wordtrap_members_view_options' ) ) {
  /**
   * Members view options
   */
  function wordtrap_members_view_options() {
    return array(
      '1'  => array(
        'title' => esc_html__( 'Type 1', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/member-layouts/archive-view-1.svg',
      ),
      '2'  => array(
        'title' => esc_html__( 'Type 2', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/member-layouts/archive-view-2.svg',
      ),
      '3'  => array(
        'title' => esc_html__( 'Type 3', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/member-layouts/archive-view-3.svg',
      ),
    );
  }
}

if ( ! function_exists( 'wordtrap_singular_orderby_options' ) ) {
  /**
   * Singular orderby options
   */
  function wordtrap_singular_orderby_options() {
    return array(
      ''        => esc_html__( 'None', 'wordtrap' ),
      'name'    => esc_html__( 'Name', 'wordtrap' ),
      'date'    => esc_html__( 'Date', 'wordtrap' ),
      'ID'      => esc_html__( 'ID', 'wordtrap' ),
      'rand'    => esc_html__( 'Random', 'wordtrap' ),
    );
  }
}

if ( ! function_exists( 'wordtrap_singular_order_options' ) ) {
  /**
   * Singular order options
   */
  function wordtrap_singular_order_options() {
    return array(
      'asc'     => esc_html__( 'Asc', 'wordtrap' ),
      'desc'    => esc_html__( 'Desc', 'wordtrap' ),
    );
  }
}

if ( ! function_exists( 'wordtrap_products_view_options' ) ) {
  /**
   * Products view options
   */
  function wordtrap_products_view_options() {
    return array(
      'default'  => array(
        'title'  => esc_html__( 'Default', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/archive-view-default.svg',
      ),
      'cart-onimage-top'  => array(
        'title'  => esc_html__( 'Cart on Image\'s Top', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/archive-view-cart-onimage-top.svg',
      ),
      'cart-onimage-bottom' => array(
        'title'  => esc_html__( 'Cart on Images\'s Bottom', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/archive-view-cart-onimage-bottom.svg',
      ),
      'cart-align-left' => array(
        'title'  => esc_html__( 'Cart Align Left', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/archive-view-cart-align-left.svg',
      ),
      'onimage'  => array(
        'title'  => esc_html__( 'On Image', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/archive-view-onimage.svg',
      ),
      'onimage-with-overlay' => array(
        'title'  => esc_html__( 'On Image with Overlay', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/archive-view-onimage-with-overlay.svg',
      ),
      'centered-onimage-with-overlay' => array(
        'title'  => esc_html__( 'Centered on Image with Overlay', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/archive-view-centered-onimage-with-overlay.svg',
      ),
      'quantity-input' => array(
        'title'  => esc_html__( 'Show Quantity Input', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/archive-view-quantity-input.svg',
      ),
    );
  }
}

if ( ! function_exists( 'wordtrap_cart_notify_options' ) ) {
  /**
   * Products cart notify options
   */
  function wordtrap_cart_notify_options() {
    return array(
      'default'  => array(
        'title'  => esc_html__( 'Default', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/addcart-default.svg',
      ),
      'modal'  => array(
        'title'  => esc_html__( 'Modal', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/addcart-modal.svg',
      ),
      'toast'  => array(
        'title'  => esc_html__( 'Toast', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/addcart-toast.svg',
      ),
    );
  }
}

if ( ! function_exists( 'wordtrap_product_view_options' ) ) {
  /**
   * Product view options
   */
  function wordtrap_product_view_options() {
    return array(
      'default'  => array(
        'title'  => esc_html__( 'Default', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/singular-default.svg',
      ),
      'extended' => array(
        'title'  => esc_html__( 'Extended', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/singular-extended.svg',
      ),
      'full-width' => array(
        'title'  => esc_html__( 'Full Width', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/singular-full-width.svg',
      ),
      'grid'     => array(
        'title'  => esc_html__( 'Grid Images', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/singular-grid.svg',
      ),
      'sticky-info' => array(
        'title'  => esc_html__( 'Sticky Info', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/singular-sticky-info.svg',
      ),
      'sticky-both-info' => array(
        'title'  => esc_html__( 'Sticky Left & Right Info', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/singular-sticky-info-both.svg',
      ),
      'transparent' => array(
        'title'  => esc_html__( 'Transparent Images', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/singular-transparent.svg',
      ),
      'centered-vertical-zoom' => array(
        'title'  => esc_html__( 'Centered Vertical Zoom', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/singular-centered-vertical-zoom.svg',
      ),
    );
  }
}