/*
* Javascript for the posts filter navigation 
*
* @package Wordtrap
* @since wordtrap 1.0.0
*/

import wordtrap_init from './init.js';

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

// Posts Ajax Load
( function ( theme, $ ) {
  'use strict';

  theme = theme || {};

  var instanceName = '__posts_ajax_load';

  var PostsAjaxLoad = function ( $el, opts ) {
    return this.initialize( $el, opts );
  };

  PostsAjaxLoad.defaults = {
    
  };

  PostsAjaxLoad.prototype = {
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
      this.options = $.extend( true, {}, PostsAjaxLoad.defaults, opts );

      return this;
    },

    build: function () {
      var self = this,
        $el = this.$el;

      $el.find( 'a.page-link').on( 'click', function( e ) {
        e.preventDefault();
        var $this = $( this ),
          $main = $( '#main' );

        theme.addLoading( $el );
        theme.scrollToElement( $main );

        $.ajax( {
          url: $this.attr( 'href' ),
          complete: function ( data ) {
            var $response = $( data.responseText );
                          
            theme.removeLoading( $el );
            $main.html( $response.find( '#main' ).html() );
            wordtrap_init( $main );
          }
        } );
      } );
      return self;
    },
  };

  // expose to scope
  $.extend( theme, {
    PostsAjaxLoad: PostsAjaxLoad
  } );

  // jquery plugin
  $.fn.themePostsAjaxLoad = function ( opts ) {
    return this.map( function () {
      var $this = $( this );
      if ( $this.data( instanceName ) ) {
        return $this.data( instanceName );
      }
      
      return new theme.PostsAjaxLoad( $this, opts );
    } );
  }

} )( window.theme, jQuery );