/**
 * Wordtrap Page Layouts
 * @since 1.0.0.
 */
( function( $ ) {

  // initalise the dialog
  $( '#conditions-dialog' ).dialog({
    dialogClass: 'wp-dialog',
    autoOpen: false,
    draggable: false,
    width: 300,
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
        $( '#conditions-dialog' ).dialog( 'close' );
      } )
    },
    create: function () {
      // style fix for WordPress admin
      $( '.ui-dialog-titlebar-close' ).addClass( 'ui-button' );
    },
  } );
  
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
      if ( $block.attr( 'data-value' ) ) {
        $block.val( $block.attr( 'data-value' ) );
      }
    } );
    $layout_box.find( '.block-options' ).find( 'ul' ).sortable();
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

    $block_options.find( '.template-blocks' ).each( function() {
      var $block = $( this );
      $block.attr( 'data-value', $block.val() );
    } );

    $( '#wordtrap-layout-' + block + '-options-html' ).html( $block_options.html() );
    $block_options.data( 'block', '' ).html( '' );
    $layout_box.closest( '.layout-box ').removeClass( 'open-options' );
  } );

  // Add new layout
  $( 'body' ).on( 'click', '.add-new-layout', function( e ) {
    e.preventDefault();

    var $this = $( this ),
      $options = $this.closest( '.actions' ).prev().clone().removeClass( 'preset' ),
      $templates = $this.closest( '.block-options' ).find( '.layout-templates' ),
      $item = $( '<li></li>').appendTo( $templates );

    $options.appendTo( $item );
    $templates.sortable();
  } );

  // Edit template
  $( 'body' ).on( 'click', '.layout-action-open', function( e ) {
    e.preventDefault();

    var $parent = $( this ).closest( '.option' ),
      id = $parent.find( 'select' ).val();

    if( ! id ) {
      alert( wordtrap_page_layout.select_template );
      return;
    }
    $.ajax( {
      url: ajaxurl,
      type: 'POST',
      data: {
        'action': 'wordtrap_page_layout_open_template',
        'id': id,
        '_nonce': wordtrap_page_layout.nonce
      },
      success: function( response ) {
        try {
          if( response.link ) window.open( response.link );
        } catch( e ) {
          alert( wordtrap_page_layout.template_not_exist );
        }
      }
    } );
  } );

  // Delete template
  $( 'body' ).on( 'click', '.layout-action-remove', function( e ) {
    e.preventDefault();
    
    var $this = $( this )
      $ul = $this.closest( 'ul' ),
      $li = $this.closest( 'li' );

    $li.remove();
    $ul.sortable();
  } );

  // Show display conditions
  $( 'body' ).on( 'click', '.layout-action-condition', function( e ) {
    e.preventDefault();

    var $parent = $( this ).closest( '.option' ),
      id = $parent.find( 'select' ).val();

    if( ! id ) {
      alert( wordtrap_page_layout.select_template );
      return;
    }
    $.ajax( {
      url: ajaxurl,
      type: 'POST',
      data: {
        'action': 'wordtrap_page_layout_conditions',
        'id': id,
        '_nonce': wordtrap_page_layout.nonce
      },
      success: function( response ) {
        $( '#conditions-dialog .display-conditions' ).html( response );
        $( '#conditions-dialog' ).dialog( 'open' );
      }
    } );
  } );

  // Save changes
  $( 'body' ).on( 'click', '.save-layout', function( e ) {
    e.preventDefault();

    var $this = $( this ),
      $block_options = $this.closest( '.block-options' ),
      block = $block_options.data( 'block' ),
      $templates = $block_options.find( '.layout-templates .template-blocks' ),
      $spinner = $block_options.find( '.spinner');
      ids = [];

    $.each( $templates, function() {
      var template = $( this ).val();
      if ( template ) {
        ids.push( template );
      }
    });
    
    $spinner.addClass( 'is-active' );
    $this.attr( 'disabled', 'disabled' );
    $.ajax( {
      url: ajaxurl,
      type: 'POST',
      data: {
        'action': 'wordtrap_page_layout_save',
        'block': block,
        'ids': ids,
        '_nonce': wordtrap_page_layout.nonce
      },
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

} )( jQuery );