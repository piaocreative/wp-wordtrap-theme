/*
* Javascript for the posts filter navigation 
*
* @package Wordtrap
* @since wordtrap 1.0.0
*/

// Posts Filter
( function ( theme, $ ) {
  'use strict';

  theme = theme || {};

  var instanceName = '__posts_filter';

  var PostsFilter = function ( $el, opts ) {
    return this.initialize( $el, opts );
  };

  PostsFilter.defaults = {
    
  };

  PostsFilter.prototype = {
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
      this.options = $.extend( true, {}, PostsFilter.defaults, opts );

      return this;
    },

    build: function () {
      var self = this;

      self.$el.find( 'select, input').on( 'change', function() {
        self.$el.find( 'form' ).submit();
      } );

      return self;
    },
  };

  // expose to scope
  $.extend( theme, {
    PostsFilter: PostsFilter
  } );

  // jquery plugin
  $.fn.themePostsFilter = function ( opts ) {
    return this.map( function () {
      var $this = $( this );
      if ( $this.data( instanceName ) ) {
        return $this.data( instanceName );
      }
      
      return new theme.PostsFilter( $this, opts );
    } );
  }

} )( window.theme, jQuery );