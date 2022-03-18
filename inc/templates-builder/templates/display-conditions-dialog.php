<?php
/**
 * Wordtrap admin template display conditions dialog
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Get post ID
$post_id = intval( isset( $_REQUEST['post'] ) ? $_REQUEST['post'] : $_REQUEST['post_id'] );

// Get post types
$_post_types = get_post_types( array( 'show_in_nav_menus' => true ), 'objects' );
$post_types  = array();
foreach ( $_post_types as $post_type => $object ) {
  $post_types[ $post_type ] = $object->label;
}

// Get taxonomies
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

  $singular_types[ $post_type ] = array(
    'opt_group'  => true,
    'values'     => array(
      $post_type => array(
        'label'  => sprintf( __( '%s', 'wordtrap' ), $label ),
        'single' => false
      )
    ),
  );

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
    $singular_types[ $post_type ][ 'values' ][ $slug ] = array(
      'label'  => $object->label,
      'single' => false
    );
    $archive_types[ $post_type ][ 'values' ][ $slug ] = array(
      'label'  => $object->label,
      'single' => false
    );
  }
}

// Get current conditions
$singular_conditions = get_post_meta( $post_id, 'template_singular_conditions', true );
$archive_conditions = get_post_meta( $post_id, 'template_archive_conditions', true );
?>
<div id="singular-conditions-dialog" class="conditions-dialog hidden" title="<?php esc_attr_e( 'Singular Conditions', 'wordtrap' ) ?>">
  <div class="form-wrap">
    <form method="post" action="<?php echo esc_url( admin_url() ); ?>">
      
      <input type="hidden" name="action" value="wordtrap-singular-conditions">
      <?php wp_nonce_field( 'wordtrap-singular-conditions' ); ?>

      <table class="wp-list-table widefat fixed striped">
        <tdboy>
          <?php foreach ( $singular_types as $type => $value ) : ?>
            <?php if ( isset( $value[ 'opt_group' ] ) && $value[ 'opt_group' ] ) : $sub_types = $value['values']; $first = false; ?>
              <?php foreach ( $sub_types as $sub_type => $sub_value ) : ?>
                <tr>
                  <?php if ( ! $first) : $first = true; ?>
                    <td rowspan="<?php echo sizeof( $sub_types ) ?>"><?php echo isset( $post_types[ $type ] ) ? esc_html( $post_types[ $type ] ) : '' ?></td>
                  <?php endif; ?>
                  <td><?php echo $sub_value[ 'label' ] ?></td>
                  <?php 
                  $single = $sub_value[ 'single' ];
                  if ( $single ) : ?>
                    <td class="check-column">
                      <input id="singular-<?php echo esc_attr( $type ) ?>-<?php echo esc_attr( $sub_type ) ?>" type="checkbox"/>
                    </td>
                    <td></td>
                  <?php else : ?>
                    <td class="check-column">
                      <input id="singular-<?php echo esc_attr( $type ) ?>-<?php echo esc_attr( $sub_type ) ?>" type="checkbox"/>
                    </td>
                    <td>
                      <select class="select2" multiple data-type="<?php echo esc_attr( $type ) ?>" data-sub-type="<?php echo esc_attr( $sub_type ) ?>"></select>
                    </td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="2"><?php echo $value[ 'label' ] ?></td> 
                <?php 
                $single = $value[ 'single' ];
                if ( $single ) : ?>
                  <td class="check-column">
                    <input id="singular-<?php echo esc_attr( $type ) ?>" type="checkbox"/>
                  </td>
                  <td></td>
                <?php else : ?>
                  <td class="check-column">
                    <input id="singular-<?php echo esc_attr( $type ) ?>" type="checkbox"/>
                  </td>
                  <td>
                    <select class="select2" multiple data-type="<?php echo esc_attr( $type ) ?>"></select>
                  </td>
                <?php endif; ?>
              </tr>
            <?php endif; ?>
          <?php endforeach; ?>
        </tdboy>
      </table>
      <p class="submit">
        <input type="submit" name="submit" id="singular-conditions-submit" class="button button-primary" value="<?php esc_attr_e( 'Save Conditions', 'wordtrap' ) ?>">
      </p>
    </form>
  </div>
</div>

<div id="archive-conditions-dialog" class="conditions-dialog hidden" title="<?php esc_attr_e( 'Archive Conditions', 'wordtrap' ) ?>">
  <div class="form-wrap">
    <form method="post" action="<?php echo esc_url( admin_url() ); ?>">

      <input type="hidden" name="action" value="wordtrap-archive-conditions">
      <?php wp_nonce_field( 'wordtrap-archive-conditions' ); ?>

      <table class="wp-list-table widefat fixed striped">
        <thead>
          <tr>
            <td colspan="2"><?php esc_html_e( 'Type', 'wordtrap' ) ?></td>
            <td><?php esc_html_e( 'Condition', 'wordtrap' ) ?></td>
          </tr>
        </thead>
        <tdboy>
          <?php foreach ( $archive_types as $type => $value ) : ?>
            <?php if ( isset( $value[ 'opt_group' ] ) && $value[ 'opt_group' ] ) : $sub_types = $value['values']; $first = false; ?>
              <?php foreach ( $sub_types as $sub_type => $sub_value ) : ?>
                <tr>
                  <?php if ( ! $first) : $first = true; ?>
                    <td rowspan="<?php echo sizeof( $sub_types ) ?>"><?php echo isset( $post_types[ $type ] ) ? esc_html( $post_types[ $type ] ) : '' ?></td>
                  <?php endif; ?>
                  <td><?php echo $sub_value[ 'label' ] ?></td>
                  <td>
                    <?php 
                    $single = $sub_value[ 'single' ];
                    if ( $single ) : ?>
                      <input id="archive-<?php echo esc_attr( $type ) ?>-<?php echo esc_attr( $sub_type ) ?>" type="checkbox"/>
                    <?php else : ?>
                      <input id="archive-<?php echo esc_attr( $type ) ?>-<?php echo esc_attr( $sub_type ) ?>" type="checkbox"/>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="2"><?php echo $value[ 'label' ] ?></td> 
                <td>
                  <?php 
                  $single = $value[ 'single' ];
                  if ( $single ) : ?>
                    <input id="archive-<?php echo esc_attr( $type ) ?>" type="checkbox"/>
                  <?php else : ?>
                    <input id="archive-<?php echo esc_attr( $type ) ?>" type="checkbox"/>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endif; ?>
          <?php endforeach; ?>
        </tdboy>
      </table>
      <p class="submit">
        <input type="submit" name="submit" id="archive-conditions-submit" class="button button-primary" value="<?php esc_attr_e( 'Save Conditions', 'wordtrap' ) ?>">
      </p>
    </form>
  </div>
</div>