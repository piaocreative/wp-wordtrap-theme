/**
 * Wordtrap admin template type dialog
 * @since 1.0.0
 */
jQuery( function( $ ) {
  
  // initalise the dialog
  $( '#template-type-dialog' ).dialog({
    dialogClass: 'wp-dialog',
    autoOpen: false,
    draggable: false,
    width: 'auto',
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
      $( '.ui-widget-overlay' ).bind( 'click', function() {
        $( '#template-type-dialog' ).dialog( 'close' );
      } )
    },
    create: function () {
      // style fix for WordPress admin
      $( '.ui-dialog-titlebar-close' ).addClass( 'ui-button' );
    },
  } );

  // bind a button or a link to open the dialog
  $( 'a[href*="post-new.php?post_type=wordtrap_template"]' ).click( function( e ) {
    e.preventDefault();
    $( '#template-type-dialog' ).dialog( 'open' );
  } );

  // submit form
  $( '#template-type-submit' ).on( 'click', function(){
		var form = $(this).parents('form');

		if ( ! validateForm( form ) )
			return false;

		
  });
});  