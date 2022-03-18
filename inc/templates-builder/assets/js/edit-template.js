/**
 * Wordtrap admin edit template
 * @since 1.0.0
 */

jQuery( function( $ ) {
  // fix redux required argments
  $( '.redux-main select, .redux-main radio, .redux-main input[type=checkbox], .redux-main input[type=hidden]' ).each( function() {
    $.redux.check_dependencies( this );
  } );

  // initalise the dialog
  $( '.conditions-dialog' ).dialog({
    dialogClass: 'wp-dialog',
    autoOpen: false,
    draggable: false,
    width: '75%',
    minWidth: 300,
    modal: true,
    resizable: false,
    closeOnEscape: true,
    position: {
      my: "center",
      at: "center",
      of: window
    },
    open: function () {
      // close dialog by clicking the overlay behind it
      $( '.ui-widget-overlay' ).on( 'click', function() {
        $( '.conditions-dialog' ).dialog( 'close' );
      } )
    },
    create: function () {
      // style fix for WordPress admin
      $( '.ui-dialog-titlebar-close' ).addClass( 'ui-button' );
    },
  } );

  // initialize select2
  $( '.conditions-dialog .select2' ).select2();

  // checkbox event
  $( '.conditions-dialog input[type="checkbox"]' ).on( 'change', function() {
    var $this = $( this ),
      $parent = $this.closest( 'td' ),
      $next = $parent.next(),
      checked = $this.get( 0 ).checked;

    if ( ! $next.length ) {
      return;
    }

    var $select = $next.find( 'select' );
    if ( ! $select.length ) {
      return;
    }

    if ( checked ) {
      $select.data( 'name', $select.attr( 'name' ) );
      $select.hide();
      $select.next().hide();
    } else {
      $select.attr( 'name', $select.data( 'name' ) );
      $select.show();
      $select.next().show();
    }
  } );
} );

// singular display conditions
function singular_conditions_setting() {
  ( function( $ ) {
    'use strict';

    // open dialog
    $( '#singular-conditions-dialog' ).dialog( 'open' );
    $( '#singular-conditions-dialog .select2' ).select2();
  } )( jQuery );
};

// archive display conditions
function archive_conditions_setting() {
  ( function( $ ) {
    'use strict';

    // open dialog
    $( '#archive-conditions-dialog' ).dialog( 'open' );
  } )( jQuery );
};