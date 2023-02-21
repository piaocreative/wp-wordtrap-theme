( function( $ ) {
  $().ready( function() {
    $( '#wordtrap_options-spacers .redux-multi-text li').each( function() {
      $(this).append('<span>rem</span>')
    } );

    $( '#redux-import-action input[type="submit"]' ).attr( 'disabled', 'disabled' );

    function checkImportButton() {
      if ( $( '#import-code-value' ).val() ) {
        $( '#redux-import-action input[type="submit"]' ).removeAttr( 'disabled' );
      } else {
        $( '#redux-import-action input[type="submit"]' ).attr( 'disabled', 'disabled' );
      };
    }

    $( '#import-code-value' ).on( 'change keyup',  checkImportButton );
    $( '#redux-import-upload-file' ).on( 'change', function() {
      setTimeout( checkImportButton, 300 );
    } );
  });
} ) ( jQuery );
  