<?php
/**
 * Wordtrap templates builder functions
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if ( ! function_exists( 'wordtrap_post_types' ) ) {
  /**
   * Get post types
   */
  function wordtrap_post_types() {
    $_post_types = get_post_types( array( 'show_in_nav_menus' => true ), 'objects' );
    $post_types  = array();
    foreach ( $_post_types as $post_type => $object ) {
      $post_types[ $post_type ] = $object->label;
    }

    return $post_types;
  }
}

if ( ! function_exists( 'wordtrap_template_singular_types' ) ) {
  /**
   * Get template singular types
   */
  function wordtrap_template_singular_types() {
    $post_types = wordtrap_post_types();

    $singular_types = array(
      'page'        => array(
        'label'     => __( 'Pages', 'wordtrap' ),
        'single'    => false,
        'opt_group' => false,
      ),
      '404'         => array(
        'label'     => __( '404 Page', 'wordtrap' ),
        'single'    => true,
        'opt_group' => false,
      )
    );

    foreach ( $post_types as $post_type => $label ) {
      $post_type_taxonomies = get_object_taxonomies( $post_type, 'objects' );
      $post_type_taxonomies = wp_filter_object_list(
        $post_type_taxonomies,
        array(
          'public'            => true,
          'show_in_nav_menus' => true,
        )
      );
      if ( empty( $post_type_taxonomies ) ) {
        continue;
      }

      $singular_types[ $post_type ] = array(
        'opt_group'  => true,
        'values'     => array(
          $post_type => array(
            'label'  => sprintf( __( '%s', 'wordtrap' ), $label ),
            'single' => false
          )
        ),
      );

      foreach ( $post_type_taxonomies as $slug => $object ) {
        $singular_types[ $post_type ][ 'values' ][ $slug ] = array(
          'label'  => $object->label,
          'single' => false
        );
      }
    }

    return $singular_types;
  }
}

if ( ! function_exists( 'wordtrap_template_archive_types' ) ) {
  /**
   * Get template archive types
   */
  function wordtrap_template_archive_types() {
    $post_types = wordtrap_post_types();

    $archive_types  = array(
      'date'        => array(
        'label'     => __( 'Date', 'wordtrap' ),
        'single'    => true,
        'opt_group' => false,
      ),
      'author'      => array(
        'label'     => __( 'Author', 'wordtrap' ),
        'single'    => true,
        'opt_group' => false,
      ),
      'search'      => array(
        'label'     => __( 'Search Results', 'wordtrap' ),
        'single'    => true,
        'opt_group' => false,
      ),
    );

    foreach ( $post_types as $post_type => $label ) {
      $post_type_taxonomies = get_object_taxonomies( $post_type, 'objects' );
      $post_type_taxonomies = wp_filter_object_list(
        $post_type_taxonomies,
        array(
          'public'            => true,
          'show_in_nav_menus' => true,
        )
      );
      if ( empty( $post_type_taxonomies ) ) {
        continue;
      }

      $archive_types[ $post_type ] = array(
        'opt_group'  => true,
        'values'     => array(
          $post_type => array(
            'label'  => sprintf( __( '%s', 'wordtrap' ), $label ),
            'single' => true
          )
        ),
      );

      foreach ( $post_type_taxonomies as $slug => $object ) {
        $archive_types[ $post_type ][ 'values' ][ $slug ] = array(
          'label'  => $object->label,
          'single' => false
        );
      }
    }

    return $archive_types;
  }
}

if ( ! function_exists( 'wordtrap_template_conditions_html' ) ) {
  /**
   * Get template conditions html
   * 
   * @params string | integer $id    Template id.
   */
  function wordtrap_template_conditions_html( $id ) {
    ob_start();
    $show_all = get_post_meta( $id, WORDTRAP_CONDITIONS_ALL, true );
    $show_singular = get_post_meta( $id, WORDTRAP_CONDITIONS_SINGULAR, true );
    $show_archive = get_post_meta( $id, WORDTRAP_CONDITIONS_ARCHIVE, true );
    if ( $show_all || ( $show_singular && $show_archive ) ) {
      echo '<strong>' . esc_html__( 'Always', 'wordtrap') . '</strong>';
    } else {
      $output = false;
      if ( $show_singular ) {
        $output = true;
        echo '<strong>' . esc_html__( 'All Singulars', 'wordtrap' ) . '</strong>';
      } else {
        $singular_conditions = get_post_meta( $id, WORDTRAP_SINGULAR_CONDITIONS, true );
        if ( ! $singular_conditions ) {
          $singular_conditions = array( 
            'checked' => array(),
            'selected' => array()
          );
        }
        $conditions = array();
        $singular_types = wordtrap_template_singular_types();
        foreach ( $singular_types as $type => $value ) {
          if ( isset( $value[ 'opt_group' ] ) && $value[ 'opt_group' ] ) {
            $sub_types = $value['values'];
            foreach ( $sub_types as $sub_type => $sub_value ) {
              if ( in_array( $sub_type, $singular_conditions[ 'checked' ] ) ) {
                $conditions[] = ( ! $sub_value[ 'single' ] ? esc_html__( 'All', 'wordtrap' ) . ' ' : '' ) . $sub_value[ 'label' ];
              } else if ( ! $sub_value[ 'single' ] ) {
                if ( isset( $singular_conditions[ 'selected' ][ $sub_type ] ) ) { 
                  $ids = $singular_conditions[ 'selected' ][ $sub_type ];
                  $titles = array();
                  foreach ( $ids as $id ) { 
                    if ( post_type_exists( $sub_type ) ) {
                      $post = get_post( $id );
                      if ( $post ) {
                        $titles[] = $post->post_title;
                      }
                    } else {
                      $taxonomy = get_term( $id );
                      if ( $taxonomy ) {
                        $titles[] = $taxonomy->name;
                      }
                    }
                  }
                  if ( ! empty( $titles)) {
                    $conditions[] = $sub_value[ 'label' ] . '(' . implode( ', ', $titles) . ')';
                  }                    
                }
              }
            }
          } else {
            if ( in_array( $type, $singular_conditions[ 'checked' ] ) ) {
              $conditions[] = ( ! $value[ 'single' ] ? esc_html__( 'All', 'wordtrap' ) . ' ' : '' ) . $value[ 'label' ];
            } else if ( ! $value[ 'single' ] ) {
              if ( isset( $singular_conditions[ 'selected' ][ $type ] ) ) { 
                $ids = $singular_conditions[ 'selected' ][ $type ];
                $titles = array();
                foreach ( $ids as $id ) { 
                  if ( post_type_exists( $type ) ) {
                    $post = get_post( $id );
                    if ( $post ) {
                      $titles[] = $post->post_title;
                    }
                  } else {
                    $taxonomy = get_term( $id );
                    if ( $taxonomy ) {
                      $titles[] = $taxonomy->name;
                    }
                  }
                }
                if ( ! empty( $titles)) {
                  $conditions[] = $value[ 'label' ] . '(' . implode( ', ', $titles) . ')';
                }
              }
            }
          }
        }
        if ( ! empty( $conditions ) ) {
          $output = true;
          echo '<strong>' . esc_html__( 'Singulars', 'wordtrap' ) . '</strong>: ' . implode( ', ', $conditions );
        }
      }
      if ( $show_archive ) {
        if ( $output ) {
          echo '<br>';
        }
        echo '<strong>' . esc_html__( 'All Archives', 'wordtrap' ) . '</strong><br>';
      } else {
        $archive_conditions = get_post_meta( $id, WORDTRAP_ARCHIVE_CONDITIONS, true );
        if ( ! $archive_conditions ) {
          $archive_conditions = array( 
            'checked' => array(),
            'selected' => array()
          );
        }
        $conditions = array();
        $archive_types = wordtrap_template_archive_types();
        foreach ( $archive_types as $type => $value ) {
          if ( isset( $value[ 'opt_group' ] ) && $value[ 'opt_group' ] ) {
            $sub_types = $value['values'];
            foreach ( $sub_types as $sub_type => $sub_value ) {
              if ( in_array( $sub_type, $archive_conditions[ 'checked' ] ) ) {
                $conditions[] = ( ! $sub_value[ 'single' ] ? esc_html__( 'All', 'wordtrap' ) . ' ' : '' ) . $sub_value[ 'label' ];
              } else if ( ! $sub_value[ 'single' ] ) {
                if ( isset( $archive_conditions[ 'selected' ][ $sub_type ] ) ) { 
                  $ids = $archive_conditions[ 'selected' ][ $sub_type ];
                  $titles = array();
                  foreach ( $ids as $id ) { 
                    $taxonomy = get_term( $id );
                    if ( $taxonomy ) {
                      $titles[] = $taxonomy->name;
                    }
                  }
                  if ( ! empty( $titles)) {
                    $conditions[] = $sub_value[ 'label' ] . '(' . implode( ', ', $titles) . ')';
                  }                    
                }
              }
            }
          } else {
            if ( in_array( $type, $archive_conditions[ 'checked' ] ) ) {
              $conditions[] = ( ! $value[ 'single' ] ? esc_html__( 'All', 'wordtrap' ) . ' ' : '' ) . $value[ 'label' ];
            } else if ( ! $value[ 'single' ] ) {
              if ( isset( $archive_conditions[ 'selected' ][ $type ] ) ) { 
                $ids = $archive_conditions[ 'selected' ][ $type ];
                $titles = array();
                foreach ( $ids as $id ) { 
                  $taxonomy = get_term( $id );
                  if ( $taxonomy ) {
                    $titles[] = $taxonomy->name;
                  }
                }
                if ( ! empty( $titles)) {
                  $conditions[] = $value[ 'label' ] . '(' . implode( ', ', $titles) . ')';
                }
              }
            }
          }
        }
        if ( ! empty( $conditions ) ) {
          if ( $output ) {
            echo '<br>';
          }
          echo '<strong>' . esc_html__( 'Archives', 'wordtrap' ) . '</strong>: ' . implode( ', ', $conditions );
        }
      }
    }

    return ob_get_clean();
  }
}