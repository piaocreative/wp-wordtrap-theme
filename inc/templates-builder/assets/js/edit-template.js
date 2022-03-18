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
      $select.removeAttr( 'name' );
      $select.hide();
      $select.next().hide();
    } else {
      $select.attr( 'name', $select.data( 'name' ) );
      $select.show();
      $select.next().show();
    }
  } );

  // initialize select2
  $( '.conditions-dialog .select2' ).select2();

  // save conditions
  $( '.conditions-submit' ).on( 'click', function( e ) {
    e.preventDefault();

    var $this = $( this ),
      $form = $this.closest( 'form' ),
      $spinner = $this.prev(),
      data = $form.serializeArray();

    $spinner.addClass( 'is-active' );
    $this.attr( 'disabled', 'disabled' );
    $.ajax( {
      type: "POST",
      url: ajaxurl,
      data: data,
      success: function( response ) {
        $spinner.removeClass( 'is-active' );
        $this.removeAttr( 'disabled' );  
      },
      error: function( XMLHttpRequest, textStatus, errorThrown ) {
        $spinner.removeClass( 'is-active' );
        $this.removeAttr( 'disabled' );
      }
    } );
  } );
} );

// initialize select2
function init_select2() {
  ( function( $ ) {
    'use strict';

    $( '.conditions-dialog .select2' ).each( function() {
      var $this = $( this ),
      $parent = $this.closest( 'td' ),
      $checkbox = $parent.prev().find( 'input[type="checkbox"]' );

      $this.show();
      $this.select2( {
        ajax: {
          url: ajaxurl,
          dataType: 'json',
          delay: 250,
          data: function( params ) {
            return {
              q: params.term,
              type: $this.data( 'type' ),
              sub_type: $this.data( 'sub-type' ),
              action: 'wordtrap_template_search_query',
              nonce: $( '#_wordtrap_template_dialog' ).val()
            };
          },
          processResults: function( data ) {
            var options = [];
            if ( data ) {
              $.each( data, function( index, item ) {
                options.push( { id: item.id, text: item.value } );
              } );
            }
            return {
              results: options
            };
          },
          cache: true
        },
        minimumInputLength: 3
      } );

      if ( $checkbox.length && $checkbox.get( 0 ).checked ) {
        $this.hide();
        $this.next().hide();
      }
    } );
  } )( jQuery );
}

// singular display conditions
function singular_conditions_setting() {
  ( function( $ ) {
    'use strict';
   
    $( '#singular-conditions-dialog' ).dialog( 'open' );
    init_select2();
  } )( jQuery );
};

// archive display conditions
function archive_conditions_setting() {
  ( function( $ ) {
    'use strict';

    $( '#archive-conditions-dialog' ).dialog( 'open' );
    init_select2();
  } )( jQuery );
};