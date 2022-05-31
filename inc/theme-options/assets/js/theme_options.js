( function( $ ) {
  $().ready( function() {
    $( '#wordtrap_options-spacers .redux-multi-text li').each( function() {
      $(this).append('<span>rem</span>')
    } );
  });
} ) ( jQuery );
  