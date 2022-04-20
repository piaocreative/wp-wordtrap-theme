/*
* Javascript for the quantity input 
*
* @package Wordtrap
* @since wordtrap 1.0.0
*/

// Quantity input
( function ( theme, $ ) {
  'use strict';

  theme = theme || {};

  var instanceName = '__quantity';

  var QuantityInput = function ( $el, opts ) {
    return this.initialize( $el, opts );
  };

  QuantityInput.defaults = {
    min: 0,
    step: 1
  };

  QuantityInput.prototype = {
    initialize: function ( $el, opts ) {
      if ( $el.data( instanceName ) ) {
        return this;
      }

      this.$el = $el;

      this
        .setData()
        .setOptions( opts )
        .build();

      return this;
    },

    setData: function () {
      this.$el.data( instanceName, this );

      return this;
    },

    setOptions: function ( opts ) {
      var $el = this.$el,
        $input = $el.find( '[type="number"]' ),
        input_options = {};

      if ( $input.attr('min') ) input_options.min = $input.attr('min');
      if ( $input.attr('max') ) input_options.max = $input.attr('max');
      if ( $input.attr('step') ) input_options.step = $input.attr('step');

      this.options = $.extend( true, {}, QuantityInput.defaults, input_options, opts );

      return this;
    },

    build: function () {
      var self = this,
        $el = self.$el,
        $input = $el.find( '[type="number"]');

      if ( ! $input.length ) return;

      $el.find( '.minus' ).on( 'click', function() {
        var changed = ( $input.val() ? parseFloat( $input.val() ) : 0 ) - parseFloat( self.options.step );
        
        if ( typeof self.options.min != 'undefined' && changed < self.options.min ) {
          return;
        }

        $input.val( changed );
      } );

      $el.find( '.plus' ).on( 'click', function() {
        var changed = ( $input.val() ? parseFloat( $input.val() ) : 0 ) + parseFloat( self.options.step );
        
        if ( typeof self.options.max != 'undefined' && changed > self.options.max ) {
          return;
        }

        $input.val( changed );
      } );     

      return this;
    }
  };

  // expose to scope
  $.extend( theme, {
    QuantityInput: QuantityInput
  } );

  // jquery plugin
  $.fn.themeQuantityInput = function ( opts ) {
    return this.map( function () {
      var $this = $( this );
      
      if ( $this.data( instanceName ) ) {
        return $this.data( instanceName );
      } else {
        return new theme.QuantityInput( $this, opts );
      }
    } );
  }

} )( window.theme, jQuery );
