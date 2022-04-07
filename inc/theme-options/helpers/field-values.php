<?php
/**
 * Theme options field's values
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wordtrap_site_layout_options' ) ) {
  /**
   * Site layout options
   */
  function wordtrap_site_layout_options() {
    return array(
      'wide'  => array(
        'title' => esc_html__( 'Wide', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/site-layouts/wide.svg',
      ),
      'full'  => array(
        'title' => esc_html__( 'Full', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/site-layouts/full.svg',
      ),
      'boxed' => array(
        'title' => esc_html__( 'Boxed', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/site-layouts/boxed.svg',
      )
    );
  }
}

if ( ! function_exists( 'wrodtrap_site_layouts_without_boxed' ) ) {
  /**
   * Site layout values without boxed
   */
  function wrodtrap_site_layouts_without_boxed() {
    return array(
      'wide',
      'full'
    );
  }
}

if ( ! function_exists( 'wordtrap_layout_options' ) ) {
  /**
   * General layout options
   */
  function wordtrap_layout_options() {
    return array(
      'wide'  => array(
        'title' => esc_html__( 'Wide', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/layouts/wide.svg',
      ),
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

if ( ! function_exists( 'wordtrap_banner_layout_options' ) ) {
  /**
   * Banner layout options
   */
  function wordtrap_banner_layout_options() {
    return array(
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

if ( ! function_exists( 'wordtrap_main_layout_options' ) ) {
  /**
   * Main layout options
   */
  function wordtrap_main_layout_options() {
    return array(
      'wide'  => array(
        'title' => esc_html__( 'Wide Width', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/wide.svg',
      ),
      'wide-left-sidebar'  => array(
        'title' => esc_html__( 'Wide Left Sidebar', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/wide-left-sidebar.svg',
      ),
      'wide-right-sidebar' => array(
        'title' => esc_html__( 'Wide Right Sidebar', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/wide-right-sidebar.svg',
      ),
      'wide-both-sidebars' => array(
        'title' => esc_html__( 'Wide Both Sidebars', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/wide-both-sidebars.svg',
      ),
      'full'  => array(
        'title' => esc_html__( 'Full Width', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/full.svg',
      ),
      'left-sidebar'  => array(
        'title' => esc_html__( 'Left Sidebar', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/left-sidebar.svg',
      ),
      'right-sidebar' => array(
        'title' => esc_html__( 'Right Sidebar', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/main-layouts/right-sidebar.svg',
      ),
      'both-sidebars' => array(
        'title' => esc_html__( 'Both Sidebars', 'wordtrap' ),
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
      'wide-left-sidebar',
      'wide-both-sidebars',
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
      'wide-right-sidebar',
      'wide-both-sidebars',
      'right-sidebar',
      'both-sidebars',
    );
  }
endif;

if ( ! function_exists( 'wordtrap_content_layout_options' ) ) {
  /**
   * Content layout options
   */
  function wordtrap_content_layout_options() {
    return array(
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
      // 'woocommerce'  => array(
      //   'title' => esc_html__( 'Woocommerce', 'wordtrap' ),
      //   'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archive-woocommerce.svg',
      // ),
      // 'modern'  => array(
      //   'title' => esc_html__( 'Modern', 'wordtrap' ),
      //   'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archive-modern.svg',
      // ),
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
      // 'large-alt'  => array(
      //   'title' => esc_html__( 'Large Alt', 'wordtrap' ),
      //   'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archive-large-alt.svg',
      // ),
      'medium'  => array(
        'title' => esc_html__( 'Medium', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archive-medium.svg',
      ),
      // 'medium-alt'  => array(
      //   'title' => esc_html__( 'Medium Alt', 'wordtrap' ),
      //   'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/archive-medium-alt.svg',
      // ),      
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
      // 'full-alt'  => array(
      //   'title' => esc_html__( 'Full Alt', 'wordtrap' ),
      //   'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/singular-full-alt.svg',
      // ),
      'large'  => array(
        'title' => esc_html__( 'Large', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/singular-large.svg',
      ),
      // 'large-alt'  => array(
      //   'title' => esc_html__( 'Large Alt', 'wordtrap' ),
      //   'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/singular-large-alt.svg',
      // ),
      'medium'  => array(
        'title' => esc_html__( 'Medium', 'wordtrap' ),
        'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/singular-medium.svg',
      ),
      // 'woocommerce'  => array(
      //   'title' => esc_html__( 'Woocommerce', 'wordtrap' ),
      //   'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/singular-woocommerce.svg',
      // ),
      // 'modern'  => array(
      //   'title' => esc_html__( 'Modern', 'wordtrap' ),
      //   'img'   => WORDTRAP_OPTIONS_URI . '/presets/post-layouts/singular-modern.svg',
      // ),
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
      'ID'      => esc_html__( 'ID', 'wordtrap' ),
      'name'    => esc_html__( 'Name', 'wordtrap' ),
      'slug'    => esc_html__( 'Slug Name', 'wordtrap' ),
      'count'   => esc_html__( 'Count', 'wordtrap' ),
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

if ( ! function_exists( 'wordtrap_products_view_mode_options' ) ) {
  /**
   * Product archive view mode options
   */
  function wordtrap_products_view_mode_options() {
    return array(
      ''        => esc_html__( 'Normal', 'wordtrap' ),
      'grid'    => esc_html__( 'Grid', 'wordtrap' ),
      'list'    => esc_html__( 'List', 'wordtrap' ),
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
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/archive-view-default.jpg',
      ),
      'onhover'  => array(
        'title'  => esc_html__( 'Default - Show Links on Hover', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/archive-view-default.jpg',
      ),
      'outimage-aq-onimage'  => array(
        'title'  => esc_html__( 'Add to Cart, Quick View On Image', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/archive-view-outimage-aq-onimage.jpg',
      ),
      'outimage-aq-onimage2' => array(
        'title'  => esc_html__( 'Add to Cart, Quick View On Image with Padding', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/archive-view-outimage-aq-onimage2.jpg',
      ),
      'awq-onimage' => array(
        'title'  => esc_html__( 'Link On Image', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/archive-view-awq-onimage.jpg',
      ),
      'outimage' => array(
        'title'  => esc_html__( 'Out of Image', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/archive-view-outimage.jpg',
      ),
      'onimage'  => array(
        'title'  => esc_html__( 'On Image', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/archive-view-onimage.jpg',
      ),
      'onimage2' => array(
        'title'  => esc_html__( 'On Image with Overlay 1', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/archive-view-onimage2.jpg',
      ),
      'onimage3' => array(
        'title'  => esc_html__( 'On Image with Overlay 2', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/archive-view-onimage3.jpg',
      ),
      'quantity' => array(
        'title'  => esc_html__( 'Show Quantity Input', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/archive-view-quantity-input.jpg',
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
      '1'  => array(
        'title'  => esc_html__( 'Type 1', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/addcart-1.jpg',
      ),
      '2'  => array(
        'title'  => esc_html__( 'Type 2', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/addcart-2.jpg',
      ),
      '3'  => array(
        'title'  => esc_html__( 'Type 3', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/addcart-3.jpg',
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
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/singular-default.jpg',
      ),
      'extended' => array(
        'title'  => esc_html__( 'Extended', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/singular-extended.jpg',
      ),
      'full-width' => array(
        'title'  => esc_html__( 'Full Width', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/singular-full-width.jpg',
      ),
      'grid'     => array(
        'title'  => esc_html__( 'Grid Images', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/singular-grid.jpg',
      ),
      'sticky-info' => array(
        'title'  => esc_html__( 'Sticky Info', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/singular-sticky-info.jpg',
      ),
      'sticky-both-info' => array(
        'title'  => esc_html__( 'Sticky Left & Right Info', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/singular-sticky-info-both.jpg',
      ),
      'transparent' => array(
        'title'  => esc_html__( 'Transparent Images', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/singular-transparent.jpg',
      ),
      'centered-vertical-zoom' => array(
        'title'  => esc_html__( 'Centered Vertical Zoom', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/singular-centered-vertical-zoom.jpg',
      ),
      'left-sidebar' => array(
        'title'  => esc_html__( 'Left Sidebar', 'wordtrap' ),
        'img'    => WORDTRAP_OPTIONS_URI . '/presets/product-layouts/singular-left-sidebar.jpg',
      ),
    );
  }
}