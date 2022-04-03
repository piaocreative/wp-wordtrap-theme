/*
* Javascript for whatsapp sharing 
*
* @package Wordtrap
* @since wordtrap 1.0.0
*/

// Whatsapp Sharing
( function ( theme, $ ) {
  'use strict';

  theme = theme || {};

  var instanceName = '__whatsapp_sharing';

  var WhatsAppSharing = function ( $el, opts ) {
    return this.initialize( $el, opts );
  };

  WhatsAppSharing.defaults = {
    
  };

  WhatsAppSharing.prototype = {
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
      this.options = $.extend( true, {}, WhatsAppSharing.defaults, opts );

      return this;
    },

    build: function () {
      var self = this;

      // WhatsApp Sharing
      if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test( navigator.userAgent ) ) {
        self.$el.find( '.share-whatsapp' ).show();
      }
      $( document ).ajaxComplete( function ( event, xhr, options ) {
        if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test( navigator.userAgent ) ) {
          self.$el.find( '.share-whatsapp' ).show();
        }
      } );

      return self;
    }
  };

  // expose to scope
  $.extend( theme, {
    WhatsAppSharing: WhatsAppSharing
  } );

  // jquery plugin
  $.fn.themeWhatsAppSharing = function ( opts ) {
    return this.map( function () {
      var $this = $( this );
      if ( $this.data( instanceName ) ) {
        return $this.data( instanceName );
      }
      
      return new theme.WhatsAppSharing( $this, opts );
    } );
  }

} )( window.theme, jQuery );