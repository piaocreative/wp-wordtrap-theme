/*
 * Javascript for the toggle
 *
 * @package Wordtrap
 * @since wordtrap 1.0.0
 */

// Toggle
(function (theme, $) {
  "use strict";

  theme = theme || {};

  var instanceName = "__toggle";

  var Toggle = function ($el, opts) {
    return this.initialize($el, opts);
  };

  Toggle.defaults = {
    toggle: ".wordtrap-toggle",
    popup: ".wordtrap-dropdown-popup",
  };

  Toggle.prototype = {
    initialize: function ($el, opts) {
      if ($el.data(instanceName)) {
        return this;
      }

      this.$el = $el;

      this.setData().setOptions(opts).build().events();

      return this;
    },

    setData: function () {
      this.$el.data(instanceName, this);

      return this;
    },

    setOptions: function (opts) {
      this.options = $.extend(true, {}, Toggle.defaults, opts);

      return this;
    },

    build: function () {
      var self = this;

      self.$toggle = self.$el.find(self.options.toggle);
      self.$popup = self.$el.find(self.options.popup);

      return self;
    },

    events: function () {
      var self = this;

      self.$el.on("click", function (e) {
        e.stopPropagation();
      });

      self.$toggle.on("click", function (e) {
        var $this = $(this);
        $this.toggleClass("opened");
        self.$popup.toggle();
        if ($this.hasClass("opened")) {
          self.$popup.find('input[type="text"]').focus();
        }
        e.stopPropagation();
      });

      $("html, body").on("click", function () {
        self.hidePopup();
      });

      if (!("ontouchstart" in document)) {
        $(window).on("resize", function () {
          self.hidePopup();
        });
      }

      return self;
    },

    hidePopup: function () {
      this.$popup.removeAttr("style");
      this.$toggle.removeClass("opened");
    },
  };

  // expose to scope
  $.extend(theme, {
    Toggle: Toggle,
  });

  // jquery plugin
  $.fn.themeToggle = function (opts) {
    return this.map(function () {
      var $this = $(this);
      if ($this.data(instanceName)) {
        return $this.data(instanceName);
      }

      return new theme.Toggle($this, opts);
    });
  };
})(window.theme, jQuery);
