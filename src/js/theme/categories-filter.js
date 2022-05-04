/*
* Javascript for the categories filter
*
* @package Wordtrap
* @since wordtrap 1.0.0
*/

// Categories Filter
( function ( theme, $ ) {
  'use strict';

  theme = theme || {};

  var instanceName = '__categories_filter';

  var CategoriesFilter = function ( $el, opts ) {
    return this.initialize( $el, opts );
  };

  CategoriesFilter.defaults = {
    
  };

  CategoriesFilter.prototype = {
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
      this.options = $.extend( true, {}, CategoriesFilter.defaults, opts );

      return this;
    },

    build: function () {
      var self = this,
        $el = self.$el;

      $el.on( 'click', 'a', function( e ) {
        e.preventDefault();

        var $this = $( this ),
          filter = $this.data( 'filter' ),
          $wrap = $el.parents( '.categories-filter-wrap' ),
          $items = $wrap.find( '.categories-filter-items');

        $el.find( 'a' ).removeClass( 'active' );
        $this.addClass( 'active' );
        
        if ( $items.hasClass( 'posts-view-masonry' ) ) {
          if ( filter === '*' ) {
            $items.find( 'article' ).parent().show();
          } else {
            $items.find( 'article' ).parent().hide();
            $items.find( 'article.' + filter ).parent().show();
          }
          $items.masonry( 'layout' );
        } else {
          if ( filter === '*' ) {
            $items.find( 'article' ).stop().slideDown( 400, function () {
              $( this ).attr( 'style', '' ).show();
            } );
          } else {
            $items.find( 'article' ).stop().slideUp( 400, function () {
              $( this ).attr( 'style', '' ).hide();
            } );
            $items.find( 'article.' + filter ).stop().slideDown( 400, function () {
              $( this ).attr( 'style', '' ).show();
            } );
          }
        }        

        return false;        
      });

      return self;
    },
  };

  // expose to scope
  $.extend( theme, {
    CategoriesFilter: CategoriesFilter
  } );

  // jquery plugin
  $.fn.themeCategoriesFilter = function ( opts ) {
    return this.map( function () {
      var $this = $( this );
      if ( $this.data( instanceName ) ) {
        return $this.data( instanceName );
      }
      
      return new theme.CategoriesFilter( $this, opts );
    } );
  }

} )( window.theme, jQuery );
