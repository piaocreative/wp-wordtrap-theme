/**
 * Wordtrap Page Layouts
 * @since 1.0.0.
 */
( function( $ ) {
  
  // Open layout options
  $( 'body' ).on( 'click', '.layout-box .block', function() {
    var $this = $( this ),
      $layout_box = $this.closest( '.layout-box' ),
      block = $this.data( 'block' ),
      $options = $( $( '#wordtrap-layout-' + block + '-options-html' ).html() );

    $options.appendTo( $layout_box.find( '.block-options' ) );
    $layout_box.find( '.block-options' ).data( 'block', block );
    $layout_box.addClass( 'open-options' );

    $options.find( '.template-blocks' ).each( function() {
      var $block = $( this );

      if ( $block.data( 'value' ) ) {
        $block.val( $block.data( 'value' ) );
      }
    } );
  } );

  // Close layout options
  $( 'body' ).on( 'click', '.layout-header .back', function( e ) {
    e.preventDefault();

    var $this = $( this ),
      $layout_box = $this.closest( '.layout-box' );

    if ( ! $layout_box.hasClass( 'open-options' ) ) {
      return;
    }
    
    var $block_options = $layout_box.find('.block-options')
      block = $block_options.data( 'block' );

    $block_options.find( '.builder-blocks' ).each( function() {
      var $block = $( this );
      $block.data( 'value', $block.val() );
    } );

    $( '#wordtrap-layout-' + block + '-options-html' ).html( $block_options.html() );
    $block_options.data( 'block', '' ).html( '' );
    $layout_box.closest( '.layout-box ').removeClass( 'open-options' );
  } );

} )( jQuery );