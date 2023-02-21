<?php
/**
 * Wordtrap admin template display conditions dialog
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$_post_types = get_post_types( array( 'show_in_nav_menus' => true ), 'objects' );
    $post_types  = array();
    foreach ( $_post_types as $post_type => $object ) {
      $post_types[ $post_type ] = $object->label;
    }

$post_types = wordtrap_post_types();
$singular_types = wordtrap_template_singular_types();
$archive_types  = wordtrap_template_archive_types();

// Get current conditions
$singular_conditions = get_post_meta( $post_id, WORDTRAP_SINGULAR_CONDITIONS, true );
if ( ! $singular_conditions ) {
  $singular_conditions = array( 
    'checked' => array(),
    'selected' => array()
  );
}
$archive_conditions = get_post_meta( $post_id, WORDTRAP_ARCHIVE_CONDITIONS, true );
if ( ! $archive_conditions ) {
  $archive_conditions = array( 
    'checked' => array(),
    'selected' => array()
  );
}
?>

<?php wp_nonce_field( 'wordtrap-template-conditions', '_wordtrap_template_dialog' ); ?>

<div id="singular-conditions-dialog" class="conditions-dialog hidden" title="<?php esc_attr_e( 'Singular Conditions', 'wordtrap' ) ?>">
  <div class="form-wrap">
    <form method="post" action="<?php echo esc_url( admin_url() ); ?>">
      
      <input type="hidden" name="action" value="wordtrap-singular-conditions">
      <input type="hidden" name="post_id" value="<?php echo esc_attr( $post_id ) ?>">
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
                  <td class="check-column">
                    <input type="checkbox" id="singular-<?php echo esc_attr( $type ) ?>-<?php echo esc_attr( $sub_type ) ?>" name="check[<?php echo esc_attr( $sub_type ) ?>]" value="1"<?php echo in_array( $sub_type, $singular_conditions[ 'checked' ] ) ? ' checked' : '' ?>/>
                  </td>
                  <?php 
                  $single = $sub_value[ 'single' ];
                  if ( $single ) : ?>
                    <td></td>
                  <?php else : ?>
                    <td>
                      <select name="select[<?php echo esc_attr( $sub_type ) ?>][]" class="select2" multiple data-type="<?php echo esc_attr( $type ) ?>" data-sub-type="<?php echo esc_attr( $sub_type ) ?>">
                        <?php 
                        if ( isset( $singular_conditions[ 'selected' ][ $sub_type ] ) ) : 
                          $ids = $singular_conditions[ 'selected' ][ $sub_type ];
                          foreach ( $ids as $id ) : 
                            if ( post_type_exists( $sub_type ) ) {
                              $post = get_post( $id );
                              $text = $post ? $post->post_title : '';
                            } else {
                              $taxonomy = get_term( $id );
                              $text = $taxonomy ? $taxonomy->name : '';
                            }
                            if ( ! $text ) continue;
                            ?>
                            <option value="<?php echo $id ?>" selected><?php echo $text ?></option>
                            <?php 
                          endforeach;
                        endif; ?>
                      </select>
                    </td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="2"><?php echo $value[ 'label' ] ?></td> 
                <td class="check-column">
                  <input type="checkbox" id="singular-<?php echo esc_attr( $type ) ?>" name="check[<?php echo esc_attr( $type ) ?>]" value="1"<?php echo in_array( $type, $singular_conditions[ 'checked' ] ) ? ' checked' : '' ?>/>
                </td>
                <?php 
                $single = $value[ 'single' ];
                if ( $single ) : ?>
                  <td></td>
                <?php else : ?>
                  <td>
                    <select name="select[<?php echo esc_attr( $type ) ?>][]" class="select2" multiple data-type="<?php echo esc_attr( $type ) ?>">
                    <?php 
                        if ( isset( $singular_conditions[ 'selected' ][ $type ] ) ) : 
                          $ids = $singular_conditions[ 'selected' ][ $type ];
                          foreach ( $ids as $id ) : 
                            if ( post_type_exists( $type ) ) {
                              $post = get_post( $id );
                              $text = $post ? $post->post_title : '';
                            } else {
                              $taxonomy = get_term( $id );
                              $text = $taxonomy ? $taxonomy->name : '';
                            }
                            if ( ! $text ) continue;
                            ?>
                            <option value="<?php echo $id ?>" selected><?php echo $text ?></option>
                            <?php 
                          endforeach;
                        endif; ?>
                    </select>
                  </td>
                <?php endif; ?>
              </tr>
            <?php endif; ?>
          <?php endforeach; ?>
        </tdboy>
      </table>
      <p class="submit">
        <span class="spinner"></span>
        <input type="submit" name="submit" class="button button-primary conditions-submit" value="<?php esc_attr_e( 'Save Conditions', 'wordtrap' ) ?>">
      </p>
    </form>
  </div>
</div>

<div id="archive-conditions-dialog" class="conditions-dialog hidden" title="<?php esc_attr_e( 'Archive Conditions', 'wordtrap' ) ?>">
  <div class="form-wrap">
    <form method="post" action="<?php echo esc_url( admin_url() ); ?>">

      <input type="hidden" name="action" value="wordtrap-archive-conditions">
      <input type="hidden" name="post_id" value="<?php echo esc_attr( $post_id ) ?>">
      <?php wp_nonce_field( 'wordtrap-archive-conditions' ); ?>
      
      <table class="wp-list-table widefat fixed striped">
        <tdboy>
          <?php foreach ( $archive_types as $type => $value ) : ?>
            <?php if ( isset( $value[ 'opt_group' ] ) && $value[ 'opt_group' ] ) : $sub_types = $value['values']; $first = false; ?>
              <?php foreach ( $sub_types as $sub_type => $sub_value ) : ?>
                <tr>
                  <?php if ( ! $first) : $first = true; ?>
                    <td rowspan="<?php echo sizeof( $sub_types ) ?>"><?php echo isset( $post_types[ $type ] ) ? esc_html( $post_types[ $type ] ) : '' ?></td>
                  <?php endif; ?>
                  <td><?php echo $sub_value[ 'label' ] ?></td>
                  <td class="check-column">
                    <input type="checkbox" id="archive-<?php echo esc_attr( $type ) ?>-<?php echo esc_attr( $sub_type ) ?>" name="check[<?php echo esc_attr( $sub_type ) ?>]" value="1"<?php echo in_array( $sub_type, $archive_conditions[ 'checked' ] ) ? ' checked' : '' ?>/>
                  </td>
                  <?php 
                  $single = $sub_value[ 'single' ];
                  if ( $single ) : ?>
                    <td></td>
                  <?php else : ?>
                    <td>
                      <select name="select[<?php echo esc_attr( $sub_type ) ?>][]" class="select2" multiple data-type="<?php echo esc_attr( $type ) ?>" data-sub-type="<?php echo esc_attr( $sub_type ) ?>">
                      <?php 
                        if ( isset( $archive_conditions[ 'selected' ][ $sub_type ] ) ) : 
                          $ids = $archive_conditions[ 'selected' ][ $sub_type ];
                          foreach ( $ids as $id ) : 
                            $taxonomy = get_term( $id );
                            if ( ! $taxonomy ) continue;
                            ?>
                            <option value="<?php echo $id ?>" selected><?php echo $taxonomy->name ?></option>
                            <?php 
                          endforeach;
                        endif; ?>
                      </select>
                    </td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="2"><?php echo $value[ 'label' ] ?></td> 
                <td class="check-column">
                  <input type="checkbox" id="archive-<?php echo esc_attr( $type ) ?>" name="check[<?php echo esc_attr( $type ) ?>]" value="1"<?php echo in_array( $type, $archive_conditions[ 'checked' ] ) ? ' checked' : '' ?>/>
                </td>
                <?php 
                $single = $value[ 'single' ];
                if ( $single ) : ?>
                  <td></td>
                <?php else : ?>
                  <td>
                    <select name="select[<?php echo esc_attr( $type ) ?>][]" class="select2" multiple data-type="<?php echo esc_attr( $type ) ?>">
                      <?php 
                        if ( isset( $archive_conditions[ 'selected' ][ $type ] ) ) : 
                          $ids = $archive_conditions[ 'selected' ][ $type ];
                          foreach ( $ids as $id ) : 
                            $taxonomy = get_term( $id );
                            if ( ! $taxonomy ) continue;
                            ?>
                            <option value="<?php echo $id ?>" selected><?php echo $taxonomy->name ?></option>
                            <?php 
                          endforeach;
                        endif; ?>
                      </select>
                    </select>
                  </td>
                <?php endif; ?>
              </tr>
            <?php endif; ?>
          <?php endforeach; ?>
        </tdboy>
      </table>
      <p class="submit">
        <span class="spinner"></span>
        <input type="submit" name="submit" class="button button-primary conditions-submit" value="<?php esc_attr_e( 'Save Conditions', 'wordtrap' ) ?>">
      </p>
    </form>
  </div>
</div>