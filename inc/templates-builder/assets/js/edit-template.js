/**
 * Wordtrap admin edit template
 * @since 1.0.0
 */
jQuery( function( $ ) {

  // fix redux required argments
  $( '.redux-main select, .redux-main radio, .redux-main input[type=checkbox], .redux-main input[type=hidden]' ).each( function() {
    $.redux.check_dependencies( this );
  } );
} );