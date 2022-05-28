( function( $ ) {
  $().ready( function() {
    $( document ).on( 'input', '.wordtrap_acf-checkbox-true-false', function() {
      const $this = $( this ),
        value = $this.val();

      value === '0' ? $this.val( '1' ) : $this.val( '0' );
      
      const field = $this.parents( '.wordtrap_acf_cs_field_root' ).find( '.wordtrap_acf_cs_field_main' );
      value !== '1' ? field.show() : field.hide(); 
    } );
    
    $( document ).on( 'click', '.wordtrap_acf_cs_field_root .acf-true-false', function() {
      $( this ).parents( '.wordtrap_acf_cs_field_root' ).find( '.wordtrap_acf-checkbox-true-false' )[0].click();    
    } );
  });
} ) ( jQuery );
  