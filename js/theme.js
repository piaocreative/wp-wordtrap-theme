/*!
      * Wordtrap v1.0.0 ()
      * Copyright 2022-2022 
      * Licensed under GPL (http://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)
    */
(function (global, factory) {
	typeof exports === 'object' && typeof module !== 'undefined' ? factory(exports) :
	typeof define === 'function' && define.amd ? define(['exports'], factory) :
	(global = typeof globalThis !== 'undefined' ? globalThis : global || self, factory(global.wordtrap = {}));
})(this, (function (exports) { 'use strict';

	var commonjsGlobal = typeof globalThis !== 'undefined' ? globalThis : typeof window !== 'undefined' ? window : typeof global !== 'undefined' ? global : typeof self !== 'undefined' ? self : {};

	function getDefaultExportFromCjs (x) {
		return x && x.__esModule && Object.prototype.hasOwnProperty.call(x, 'default') ? x['default'] : x;
	}

	function getAugmentedNamespace(n) {
		if (n.__esModule) return n;
		var a = Object.defineProperty({}, '__esModule', {value: true});
		Object.keys(n).forEach(function (k) {
			var d = Object.getOwnPropertyDescriptor(n, k);
			Object.defineProperty(a, k, d.get ? d : {
				enumerable: true,
				get: function () {
					return n[k];
				}
			});
		});
		return a;
	}

	var alert$1 = {exports: {}};

	var eventHandler = {exports: {}};

	/*!
	  * Bootstrap event-handler.js v5.1.3 (https://getbootstrap.com/)
	  * Copyright 2011-2021 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
	  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	  */

	(function (module, exports) {
	(function (global, factory) {
	  module.exports = factory() ;
	})(commonjsGlobal, (function () {
	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/index.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */

	  const getjQuery = () => {
	    const {
	      jQuery
	    } = window;

	    if (jQuery && !document.body.hasAttribute('data-bs-no-jquery')) {
	      return jQuery;
	    }

	    return null;
	  };

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): dom/event-handler.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  /**
	   * ------------------------------------------------------------------------
	   * Constants
	   * ------------------------------------------------------------------------
	   */

	  const namespaceRegex = /[^.]*(?=\..*)\.|.*/;
	  const stripNameRegex = /\..*/;
	  const stripUidRegex = /::\d+$/;
	  const eventRegistry = {}; // Events storage

	  let uidEvent = 1;
	  const customEvents = {
	    mouseenter: 'mouseover',
	    mouseleave: 'mouseout'
	  };
	  const customEventsRegex = /^(mouseenter|mouseleave)/i;
	  const nativeEvents = new Set(['click', 'dblclick', 'mouseup', 'mousedown', 'contextmenu', 'mousewheel', 'DOMMouseScroll', 'mouseover', 'mouseout', 'mousemove', 'selectstart', 'selectend', 'keydown', 'keypress', 'keyup', 'orientationchange', 'touchstart', 'touchmove', 'touchend', 'touchcancel', 'pointerdown', 'pointermove', 'pointerup', 'pointerleave', 'pointercancel', 'gesturestart', 'gesturechange', 'gestureend', 'focus', 'blur', 'change', 'reset', 'select', 'submit', 'focusin', 'focusout', 'load', 'unload', 'beforeunload', 'resize', 'move', 'DOMContentLoaded', 'readystatechange', 'error', 'abort', 'scroll']);
	  /**
	   * ------------------------------------------------------------------------
	   * Private methods
	   * ------------------------------------------------------------------------
	   */

	  function getUidEvent(element, uid) {
	    return uid && `${uid}::${uidEvent++}` || element.uidEvent || uidEvent++;
	  }

	  function getEvent(element) {
	    const uid = getUidEvent(element);
	    element.uidEvent = uid;
	    eventRegistry[uid] = eventRegistry[uid] || {};
	    return eventRegistry[uid];
	  }

	  function bootstrapHandler(element, fn) {
	    return function handler(event) {
	      event.delegateTarget = element;

	      if (handler.oneOff) {
	        EventHandler.off(element, event.type, fn);
	      }

	      return fn.apply(element, [event]);
	    };
	  }

	  function bootstrapDelegationHandler(element, selector, fn) {
	    return function handler(event) {
	      const domElements = element.querySelectorAll(selector);

	      for (let {
	        target
	      } = event; target && target !== this; target = target.parentNode) {
	        for (let i = domElements.length; i--;) {
	          if (domElements[i] === target) {
	            event.delegateTarget = target;

	            if (handler.oneOff) {
	              EventHandler.off(element, event.type, selector, fn);
	            }

	            return fn.apply(target, [event]);
	          }
	        }
	      } // To please ESLint


	      return null;
	    };
	  }

	  function findHandler(events, handler, delegationSelector = null) {
	    const uidEventList = Object.keys(events);

	    for (let i = 0, len = uidEventList.length; i < len; i++) {
	      const event = events[uidEventList[i]];

	      if (event.originalHandler === handler && event.delegationSelector === delegationSelector) {
	        return event;
	      }
	    }

	    return null;
	  }

	  function normalizeParams(originalTypeEvent, handler, delegationFn) {
	    const delegation = typeof handler === 'string';
	    const originalHandler = delegation ? delegationFn : handler;
	    let typeEvent = getTypeEvent(originalTypeEvent);
	    const isNative = nativeEvents.has(typeEvent);

	    if (!isNative) {
	      typeEvent = originalTypeEvent;
	    }

	    return [delegation, originalHandler, typeEvent];
	  }

	  function addHandler(element, originalTypeEvent, handler, delegationFn, oneOff) {
	    if (typeof originalTypeEvent !== 'string' || !element) {
	      return;
	    }

	    if (!handler) {
	      handler = delegationFn;
	      delegationFn = null;
	    } // in case of mouseenter or mouseleave wrap the handler within a function that checks for its DOM position
	    // this prevents the handler from being dispatched the same way as mouseover or mouseout does


	    if (customEventsRegex.test(originalTypeEvent)) {
	      const wrapFn = fn => {
	        return function (event) {
	          if (!event.relatedTarget || event.relatedTarget !== event.delegateTarget && !event.delegateTarget.contains(event.relatedTarget)) {
	            return fn.call(this, event);
	          }
	        };
	      };

	      if (delegationFn) {
	        delegationFn = wrapFn(delegationFn);
	      } else {
	        handler = wrapFn(handler);
	      }
	    }

	    const [delegation, originalHandler, typeEvent] = normalizeParams(originalTypeEvent, handler, delegationFn);
	    const events = getEvent(element);
	    const handlers = events[typeEvent] || (events[typeEvent] = {});
	    const previousFn = findHandler(handlers, originalHandler, delegation ? handler : null);

	    if (previousFn) {
	      previousFn.oneOff = previousFn.oneOff && oneOff;
	      return;
	    }

	    const uid = getUidEvent(originalHandler, originalTypeEvent.replace(namespaceRegex, ''));
	    const fn = delegation ? bootstrapDelegationHandler(element, handler, delegationFn) : bootstrapHandler(element, handler);
	    fn.delegationSelector = delegation ? handler : null;
	    fn.originalHandler = originalHandler;
	    fn.oneOff = oneOff;
	    fn.uidEvent = uid;
	    handlers[uid] = fn;
	    element.addEventListener(typeEvent, fn, delegation);
	  }

	  function removeHandler(element, events, typeEvent, handler, delegationSelector) {
	    const fn = findHandler(events[typeEvent], handler, delegationSelector);

	    if (!fn) {
	      return;
	    }

	    element.removeEventListener(typeEvent, fn, Boolean(delegationSelector));
	    delete events[typeEvent][fn.uidEvent];
	  }

	  function removeNamespacedHandlers(element, events, typeEvent, namespace) {
	    const storeElementEvent = events[typeEvent] || {};
	    Object.keys(storeElementEvent).forEach(handlerKey => {
	      if (handlerKey.includes(namespace)) {
	        const event = storeElementEvent[handlerKey];
	        removeHandler(element, events, typeEvent, event.originalHandler, event.delegationSelector);
	      }
	    });
	  }

	  function getTypeEvent(event) {
	    // allow to get the native events from namespaced events ('click.bs.button' --> 'click')
	    event = event.replace(stripNameRegex, '');
	    return customEvents[event] || event;
	  }

	  const EventHandler = {
	    on(element, event, handler, delegationFn) {
	      addHandler(element, event, handler, delegationFn, false);
	    },

	    one(element, event, handler, delegationFn) {
	      addHandler(element, event, handler, delegationFn, true);
	    },

	    off(element, originalTypeEvent, handler, delegationFn) {
	      if (typeof originalTypeEvent !== 'string' || !element) {
	        return;
	      }

	      const [delegation, originalHandler, typeEvent] = normalizeParams(originalTypeEvent, handler, delegationFn);
	      const inNamespace = typeEvent !== originalTypeEvent;
	      const events = getEvent(element);
	      const isNamespace = originalTypeEvent.startsWith('.');

	      if (typeof originalHandler !== 'undefined') {
	        // Simplest case: handler is passed, remove that listener ONLY.
	        if (!events || !events[typeEvent]) {
	          return;
	        }

	        removeHandler(element, events, typeEvent, originalHandler, delegation ? handler : null);
	        return;
	      }

	      if (isNamespace) {
	        Object.keys(events).forEach(elementEvent => {
	          removeNamespacedHandlers(element, events, elementEvent, originalTypeEvent.slice(1));
	        });
	      }

	      const storeElementEvent = events[typeEvent] || {};
	      Object.keys(storeElementEvent).forEach(keyHandlers => {
	        const handlerKey = keyHandlers.replace(stripUidRegex, '');

	        if (!inNamespace || originalTypeEvent.includes(handlerKey)) {
	          const event = storeElementEvent[keyHandlers];
	          removeHandler(element, events, typeEvent, event.originalHandler, event.delegationSelector);
	        }
	      });
	    },

	    trigger(element, event, args) {
	      if (typeof event !== 'string' || !element) {
	        return null;
	      }

	      const $ = getjQuery();
	      const typeEvent = getTypeEvent(event);
	      const inNamespace = event !== typeEvent;
	      const isNative = nativeEvents.has(typeEvent);
	      let jQueryEvent;
	      let bubbles = true;
	      let nativeDispatch = true;
	      let defaultPrevented = false;
	      let evt = null;

	      if (inNamespace && $) {
	        jQueryEvent = $.Event(event, args);
	        $(element).trigger(jQueryEvent);
	        bubbles = !jQueryEvent.isPropagationStopped();
	        nativeDispatch = !jQueryEvent.isImmediatePropagationStopped();
	        defaultPrevented = jQueryEvent.isDefaultPrevented();
	      }

	      if (isNative) {
	        evt = document.createEvent('HTMLEvents');
	        evt.initEvent(typeEvent, bubbles, true);
	      } else {
	        evt = new CustomEvent(event, {
	          bubbles,
	          cancelable: true
	        });
	      } // merge custom information in our event


	      if (typeof args !== 'undefined') {
	        Object.keys(args).forEach(key => {
	          Object.defineProperty(evt, key, {
	            get() {
	              return args[key];
	            }

	          });
	        });
	      }

	      if (defaultPrevented) {
	        evt.preventDefault();
	      }

	      if (nativeDispatch) {
	        element.dispatchEvent(evt);
	      }

	      if (evt.defaultPrevented && typeof jQueryEvent !== 'undefined') {
	        jQueryEvent.preventDefault();
	      }

	      return evt;
	    }

	  };

	  return EventHandler;

	}));

	}(eventHandler));

	var baseComponent = {exports: {}};

	var data = {exports: {}};

	/*!
	  * Bootstrap data.js v5.1.3 (https://getbootstrap.com/)
	  * Copyright 2011-2021 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
	  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	  */

	(function (module, exports) {
	(function (global, factory) {
	  module.exports = factory() ;
	})(commonjsGlobal, (function () {
	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): dom/data.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */

	  /**
	   * ------------------------------------------------------------------------
	   * Constants
	   * ------------------------------------------------------------------------
	   */
	  const elementMap = new Map();
	  const data = {
	    set(element, key, instance) {
	      if (!elementMap.has(element)) {
	        elementMap.set(element, new Map());
	      }

	      const instanceMap = elementMap.get(element); // make it clear we only want one instance per element
	      // can be removed later when multiple key/instances are fine to be used

	      if (!instanceMap.has(key) && instanceMap.size !== 0) {
	        // eslint-disable-next-line no-console
	        console.error(`Bootstrap doesn't allow more than one instance per element. Bound instance: ${Array.from(instanceMap.keys())[0]}.`);
	        return;
	      }

	      instanceMap.set(key, instance);
	    },

	    get(element, key) {
	      if (elementMap.has(element)) {
	        return elementMap.get(element).get(key) || null;
	      }

	      return null;
	    },

	    remove(element, key) {
	      if (!elementMap.has(element)) {
	        return;
	      }

	      const instanceMap = elementMap.get(element);
	      instanceMap.delete(key); // free up element references if there are no instances left for an element

	      if (instanceMap.size === 0) {
	        elementMap.delete(element);
	      }
	    }

	  };

	  return data;

	}));

	}(data));

	/*!
	  * Bootstrap base-component.js v5.1.3 (https://getbootstrap.com/)
	  * Copyright 2011-2021 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
	  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	  */

	(function (module, exports) {
	(function (global, factory) {
	  module.exports = factory(data.exports, eventHandler.exports) ;
	})(commonjsGlobal, (function (Data, EventHandler) {
	  const _interopDefaultLegacy = e => e && typeof e === 'object' && 'default' in e ? e : { default: e };

	  const Data__default = /*#__PURE__*/_interopDefaultLegacy(Data);
	  const EventHandler__default = /*#__PURE__*/_interopDefaultLegacy(EventHandler);

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/index.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  const MILLISECONDS_MULTIPLIER = 1000;
	  const TRANSITION_END = 'transitionend'; // Shoutout AngusCroll (https://goo.gl/pxwQGp)

	  const getTransitionDurationFromElement = element => {
	    if (!element) {
	      return 0;
	    } // Get transition-duration of the element


	    let {
	      transitionDuration,
	      transitionDelay
	    } = window.getComputedStyle(element);
	    const floatTransitionDuration = Number.parseFloat(transitionDuration);
	    const floatTransitionDelay = Number.parseFloat(transitionDelay); // Return 0 if element or transition duration is not found

	    if (!floatTransitionDuration && !floatTransitionDelay) {
	      return 0;
	    } // If multiple durations are defined, take the first


	    transitionDuration = transitionDuration.split(',')[0];
	    transitionDelay = transitionDelay.split(',')[0];
	    return (Number.parseFloat(transitionDuration) + Number.parseFloat(transitionDelay)) * MILLISECONDS_MULTIPLIER;
	  };

	  const triggerTransitionEnd = element => {
	    element.dispatchEvent(new Event(TRANSITION_END));
	  };

	  const isElement = obj => {
	    if (!obj || typeof obj !== 'object') {
	      return false;
	    }

	    if (typeof obj.jquery !== 'undefined') {
	      obj = obj[0];
	    }

	    return typeof obj.nodeType !== 'undefined';
	  };

	  const getElement = obj => {
	    if (isElement(obj)) {
	      // it's a jQuery object or a node element
	      return obj.jquery ? obj[0] : obj;
	    }

	    if (typeof obj === 'string' && obj.length > 0) {
	      return document.querySelector(obj);
	    }

	    return null;
	  };

	  const execute = callback => {
	    if (typeof callback === 'function') {
	      callback();
	    }
	  };

	  const executeAfterTransition = (callback, transitionElement, waitForTransition = true) => {
	    if (!waitForTransition) {
	      execute(callback);
	      return;
	    }

	    const durationPadding = 5;
	    const emulatedDuration = getTransitionDurationFromElement(transitionElement) + durationPadding;
	    let called = false;

	    const handler = ({
	      target
	    }) => {
	      if (target !== transitionElement) {
	        return;
	      }

	      called = true;
	      transitionElement.removeEventListener(TRANSITION_END, handler);
	      execute(callback);
	    };

	    transitionElement.addEventListener(TRANSITION_END, handler);
	    setTimeout(() => {
	      if (!called) {
	        triggerTransitionEnd(transitionElement);
	      }
	    }, emulatedDuration);
	  };

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): base-component.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  /**
	   * ------------------------------------------------------------------------
	   * Constants
	   * ------------------------------------------------------------------------
	   */

	  const VERSION = '5.1.3';

	  class BaseComponent {
	    constructor(element) {
	      element = getElement(element);

	      if (!element) {
	        return;
	      }

	      this._element = element;
	      Data__default.default.set(this._element, this.constructor.DATA_KEY, this);
	    }

	    dispose() {
	      Data__default.default.remove(this._element, this.constructor.DATA_KEY);
	      EventHandler__default.default.off(this._element, this.constructor.EVENT_KEY);
	      Object.getOwnPropertyNames(this).forEach(propertyName => {
	        this[propertyName] = null;
	      });
	    }

	    _queueCallback(callback, element, isAnimated = true) {
	      executeAfterTransition(callback, element, isAnimated);
	    }
	    /** Static */


	    static getInstance(element) {
	      return Data__default.default.get(getElement(element), this.DATA_KEY);
	    }

	    static getOrCreateInstance(element, config = {}) {
	      return this.getInstance(element) || new this(element, typeof config === 'object' ? config : null);
	    }

	    static get VERSION() {
	      return VERSION;
	    }

	    static get NAME() {
	      throw new Error('You have to implement the static method "NAME", for each component!');
	    }

	    static get DATA_KEY() {
	      return `bs.${this.NAME}`;
	    }

	    static get EVENT_KEY() {
	      return `.${this.DATA_KEY}`;
	    }

	  }

	  return BaseComponent;

	}));

	}(baseComponent));

	/*!
	  * Bootstrap alert.js v5.1.3 (https://getbootstrap.com/)
	  * Copyright 2011-2021 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
	  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	  */

	(function (module, exports) {
	(function (global, factory) {
	  module.exports = factory(eventHandler.exports, baseComponent.exports) ;
	})(commonjsGlobal, (function (EventHandler, BaseComponent) {
	  const _interopDefaultLegacy = e => e && typeof e === 'object' && 'default' in e ? e : { default: e };

	  const EventHandler__default = /*#__PURE__*/_interopDefaultLegacy(EventHandler);
	  const BaseComponent__default = /*#__PURE__*/_interopDefaultLegacy(BaseComponent);

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/index.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */

	  const getSelector = element => {
	    let selector = element.getAttribute('data-bs-target');

	    if (!selector || selector === '#') {
	      let hrefAttr = element.getAttribute('href'); // The only valid content that could double as a selector are IDs or classes,
	      // so everything starting with `#` or `.`. If a "real" URL is used as the selector,
	      // `document.querySelector` will rightfully complain it is invalid.
	      // See https://github.com/twbs/bootstrap/issues/32273

	      if (!hrefAttr || !hrefAttr.includes('#') && !hrefAttr.startsWith('.')) {
	        return null;
	      } // Just in case some CMS puts out a full URL with the anchor appended


	      if (hrefAttr.includes('#') && !hrefAttr.startsWith('#')) {
	        hrefAttr = `#${hrefAttr.split('#')[1]}`;
	      }

	      selector = hrefAttr && hrefAttr !== '#' ? hrefAttr.trim() : null;
	    }

	    return selector;
	  };

	  const getElementFromSelector = element => {
	    const selector = getSelector(element);
	    return selector ? document.querySelector(selector) : null;
	  };

	  const isDisabled = element => {
	    if (!element || element.nodeType !== Node.ELEMENT_NODE) {
	      return true;
	    }

	    if (element.classList.contains('disabled')) {
	      return true;
	    }

	    if (typeof element.disabled !== 'undefined') {
	      return element.disabled;
	    }

	    return element.hasAttribute('disabled') && element.getAttribute('disabled') !== 'false';
	  };

	  const getjQuery = () => {
	    const {
	      jQuery
	    } = window;

	    if (jQuery && !document.body.hasAttribute('data-bs-no-jquery')) {
	      return jQuery;
	    }

	    return null;
	  };

	  const DOMContentLoadedCallbacks = [];

	  const onDOMContentLoaded = callback => {
	    if (document.readyState === 'loading') {
	      // add listener on the first call when the document is in loading state
	      if (!DOMContentLoadedCallbacks.length) {
	        document.addEventListener('DOMContentLoaded', () => {
	          DOMContentLoadedCallbacks.forEach(callback => callback());
	        });
	      }

	      DOMContentLoadedCallbacks.push(callback);
	    } else {
	      callback();
	    }
	  };

	  const defineJQueryPlugin = plugin => {
	    onDOMContentLoaded(() => {
	      const $ = getjQuery();
	      /* istanbul ignore if */

	      if ($) {
	        const name = plugin.NAME;
	        const JQUERY_NO_CONFLICT = $.fn[name];
	        $.fn[name] = plugin.jQueryInterface;
	        $.fn[name].Constructor = plugin;

	        $.fn[name].noConflict = () => {
	          $.fn[name] = JQUERY_NO_CONFLICT;
	          return plugin.jQueryInterface;
	        };
	      }
	    });
	  };

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/component-functions.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */

	  const enableDismissTrigger = (component, method = 'hide') => {
	    const clickEvent = `click.dismiss${component.EVENT_KEY}`;
	    const name = component.NAME;
	    EventHandler__default.default.on(document, clickEvent, `[data-bs-dismiss="${name}"]`, function (event) {
	      if (['A', 'AREA'].includes(this.tagName)) {
	        event.preventDefault();
	      }

	      if (isDisabled(this)) {
	        return;
	      }

	      const target = getElementFromSelector(this) || this.closest(`.${name}`);
	      const instance = component.getOrCreateInstance(target); // Method argument is left, for Alert and only, as it doesn't implement the 'hide' method

	      instance[method]();
	    });
	  };

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): alert.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  /**
	   * ------------------------------------------------------------------------
	   * Constants
	   * ------------------------------------------------------------------------
	   */

	  const NAME = 'alert';
	  const DATA_KEY = 'bs.alert';
	  const EVENT_KEY = `.${DATA_KEY}`;
	  const EVENT_CLOSE = `close${EVENT_KEY}`;
	  const EVENT_CLOSED = `closed${EVENT_KEY}`;
	  const CLASS_NAME_FADE = 'fade';
	  const CLASS_NAME_SHOW = 'show';
	  /**
	   * ------------------------------------------------------------------------
	   * Class Definition
	   * ------------------------------------------------------------------------
	   */

	  class Alert extends BaseComponent__default.default {
	    // Getters
	    static get NAME() {
	      return NAME;
	    } // Public


	    close() {
	      const closeEvent = EventHandler__default.default.trigger(this._element, EVENT_CLOSE);

	      if (closeEvent.defaultPrevented) {
	        return;
	      }

	      this._element.classList.remove(CLASS_NAME_SHOW);

	      const isAnimated = this._element.classList.contains(CLASS_NAME_FADE);

	      this._queueCallback(() => this._destroyElement(), this._element, isAnimated);
	    } // Private


	    _destroyElement() {
	      this._element.remove();

	      EventHandler__default.default.trigger(this._element, EVENT_CLOSED);
	      this.dispose();
	    } // Static


	    static jQueryInterface(config) {
	      return this.each(function () {
	        const data = Alert.getOrCreateInstance(this);

	        if (typeof config !== 'string') {
	          return;
	        }

	        if (data[config] === undefined || config.startsWith('_') || config === 'constructor') {
	          throw new TypeError(`No method named "${config}"`);
	        }

	        data[config](this);
	      });
	    }

	  }
	  /**
	   * ------------------------------------------------------------------------
	   * Data Api implementation
	   * ------------------------------------------------------------------------
	   */


	  enableDismissTrigger(Alert, 'close');
	  /**
	   * ------------------------------------------------------------------------
	   * jQuery
	   * ------------------------------------------------------------------------
	   * add .Alert to jQuery only if jQuery is present
	   */

	  defineJQueryPlugin(Alert);

	  return Alert;

	}));

	}(alert$1));

	var alert = alert$1.exports;

	var button$1 = {exports: {}};

	/*!
	  * Bootstrap button.js v5.1.3 (https://getbootstrap.com/)
	  * Copyright 2011-2021 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
	  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	  */

	(function (module, exports) {
	(function (global, factory) {
	  module.exports = factory(eventHandler.exports, baseComponent.exports) ;
	})(commonjsGlobal, (function (EventHandler, BaseComponent) {
	  const _interopDefaultLegacy = e => e && typeof e === 'object' && 'default' in e ? e : { default: e };

	  const EventHandler__default = /*#__PURE__*/_interopDefaultLegacy(EventHandler);
	  const BaseComponent__default = /*#__PURE__*/_interopDefaultLegacy(BaseComponent);

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/index.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */

	  const getjQuery = () => {
	    const {
	      jQuery
	    } = window;

	    if (jQuery && !document.body.hasAttribute('data-bs-no-jquery')) {
	      return jQuery;
	    }

	    return null;
	  };

	  const DOMContentLoadedCallbacks = [];

	  const onDOMContentLoaded = callback => {
	    if (document.readyState === 'loading') {
	      // add listener on the first call when the document is in loading state
	      if (!DOMContentLoadedCallbacks.length) {
	        document.addEventListener('DOMContentLoaded', () => {
	          DOMContentLoadedCallbacks.forEach(callback => callback());
	        });
	      }

	      DOMContentLoadedCallbacks.push(callback);
	    } else {
	      callback();
	    }
	  };

	  const defineJQueryPlugin = plugin => {
	    onDOMContentLoaded(() => {
	      const $ = getjQuery();
	      /* istanbul ignore if */

	      if ($) {
	        const name = plugin.NAME;
	        const JQUERY_NO_CONFLICT = $.fn[name];
	        $.fn[name] = plugin.jQueryInterface;
	        $.fn[name].Constructor = plugin;

	        $.fn[name].noConflict = () => {
	          $.fn[name] = JQUERY_NO_CONFLICT;
	          return plugin.jQueryInterface;
	        };
	      }
	    });
	  };

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): button.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  /**
	   * ------------------------------------------------------------------------
	   * Constants
	   * ------------------------------------------------------------------------
	   */

	  const NAME = 'button';
	  const DATA_KEY = 'bs.button';
	  const EVENT_KEY = `.${DATA_KEY}`;
	  const DATA_API_KEY = '.data-api';
	  const CLASS_NAME_ACTIVE = 'active';
	  const SELECTOR_DATA_TOGGLE = '[data-bs-toggle="button"]';
	  const EVENT_CLICK_DATA_API = `click${EVENT_KEY}${DATA_API_KEY}`;
	  /**
	   * ------------------------------------------------------------------------
	   * Class Definition
	   * ------------------------------------------------------------------------
	   */

	  class Button extends BaseComponent__default.default {
	    // Getters
	    static get NAME() {
	      return NAME;
	    } // Public


	    toggle() {
	      // Toggle class and sync the `aria-pressed` attribute with the return value of the `.toggle()` method
	      this._element.setAttribute('aria-pressed', this._element.classList.toggle(CLASS_NAME_ACTIVE));
	    } // Static


	    static jQueryInterface(config) {
	      return this.each(function () {
	        const data = Button.getOrCreateInstance(this);

	        if (config === 'toggle') {
	          data[config]();
	        }
	      });
	    }

	  }
	  /**
	   * ------------------------------------------------------------------------
	   * Data Api implementation
	   * ------------------------------------------------------------------------
	   */


	  EventHandler__default.default.on(document, EVENT_CLICK_DATA_API, SELECTOR_DATA_TOGGLE, event => {
	    event.preventDefault();
	    const button = event.target.closest(SELECTOR_DATA_TOGGLE);
	    const data = Button.getOrCreateInstance(button);
	    data.toggle();
	  });
	  /**
	   * ------------------------------------------------------------------------
	   * jQuery
	   * ------------------------------------------------------------------------
	   * add .Button to jQuery only if jQuery is present
	   */

	  defineJQueryPlugin(Button);

	  return Button;

	}));

	}(button$1));

	var button = button$1.exports;

	var carousel$1 = {exports: {}};

	var manipulator = {exports: {}};

	/*!
	  * Bootstrap manipulator.js v5.1.3 (https://getbootstrap.com/)
	  * Copyright 2011-2021 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
	  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	  */

	(function (module, exports) {
	(function (global, factory) {
	  module.exports = factory() ;
	})(commonjsGlobal, (function () {
	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): dom/manipulator.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  function normalizeData(val) {
	    if (val === 'true') {
	      return true;
	    }

	    if (val === 'false') {
	      return false;
	    }

	    if (val === Number(val).toString()) {
	      return Number(val);
	    }

	    if (val === '' || val === 'null') {
	      return null;
	    }

	    return val;
	  }

	  function normalizeDataKey(key) {
	    return key.replace(/[A-Z]/g, chr => `-${chr.toLowerCase()}`);
	  }

	  const Manipulator = {
	    setDataAttribute(element, key, value) {
	      element.setAttribute(`data-bs-${normalizeDataKey(key)}`, value);
	    },

	    removeDataAttribute(element, key) {
	      element.removeAttribute(`data-bs-${normalizeDataKey(key)}`);
	    },

	    getDataAttributes(element) {
	      if (!element) {
	        return {};
	      }

	      const attributes = {};
	      Object.keys(element.dataset).filter(key => key.startsWith('bs')).forEach(key => {
	        let pureKey = key.replace(/^bs/, '');
	        pureKey = pureKey.charAt(0).toLowerCase() + pureKey.slice(1, pureKey.length);
	        attributes[pureKey] = normalizeData(element.dataset[key]);
	      });
	      return attributes;
	    },

	    getDataAttribute(element, key) {
	      return normalizeData(element.getAttribute(`data-bs-${normalizeDataKey(key)}`));
	    },

	    offset(element) {
	      const rect = element.getBoundingClientRect();
	      return {
	        top: rect.top + window.pageYOffset,
	        left: rect.left + window.pageXOffset
	      };
	    },

	    position(element) {
	      return {
	        top: element.offsetTop,
	        left: element.offsetLeft
	      };
	    }

	  };

	  return Manipulator;

	}));

	}(manipulator));

	var selectorEngine = {exports: {}};

	/*!
	  * Bootstrap selector-engine.js v5.1.3 (https://getbootstrap.com/)
	  * Copyright 2011-2021 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
	  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	  */

	(function (module, exports) {
	(function (global, factory) {
	  module.exports = factory() ;
	})(commonjsGlobal, (function () {
	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/index.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */

	  const isElement = obj => {
	    if (!obj || typeof obj !== 'object') {
	      return false;
	    }

	    if (typeof obj.jquery !== 'undefined') {
	      obj = obj[0];
	    }

	    return typeof obj.nodeType !== 'undefined';
	  };

	  const isVisible = element => {
	    if (!isElement(element) || element.getClientRects().length === 0) {
	      return false;
	    }

	    return getComputedStyle(element).getPropertyValue('visibility') === 'visible';
	  };

	  const isDisabled = element => {
	    if (!element || element.nodeType !== Node.ELEMENT_NODE) {
	      return true;
	    }

	    if (element.classList.contains('disabled')) {
	      return true;
	    }

	    if (typeof element.disabled !== 'undefined') {
	      return element.disabled;
	    }

	    return element.hasAttribute('disabled') && element.getAttribute('disabled') !== 'false';
	  };

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): dom/selector-engine.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  const NODE_TEXT = 3;
	  const SelectorEngine = {
	    find(selector, element = document.documentElement) {
	      return [].concat(...Element.prototype.querySelectorAll.call(element, selector));
	    },

	    findOne(selector, element = document.documentElement) {
	      return Element.prototype.querySelector.call(element, selector);
	    },

	    children(element, selector) {
	      return [].concat(...element.children).filter(child => child.matches(selector));
	    },

	    parents(element, selector) {
	      const parents = [];
	      let ancestor = element.parentNode;

	      while (ancestor && ancestor.nodeType === Node.ELEMENT_NODE && ancestor.nodeType !== NODE_TEXT) {
	        if (ancestor.matches(selector)) {
	          parents.push(ancestor);
	        }

	        ancestor = ancestor.parentNode;
	      }

	      return parents;
	    },

	    prev(element, selector) {
	      let previous = element.previousElementSibling;

	      while (previous) {
	        if (previous.matches(selector)) {
	          return [previous];
	        }

	        previous = previous.previousElementSibling;
	      }

	      return [];
	    },

	    next(element, selector) {
	      let next = element.nextElementSibling;

	      while (next) {
	        if (next.matches(selector)) {
	          return [next];
	        }

	        next = next.nextElementSibling;
	      }

	      return [];
	    },

	    focusableChildren(element) {
	      const focusables = ['a', 'button', 'input', 'textarea', 'select', 'details', '[tabindex]', '[contenteditable="true"]'].map(selector => `${selector}:not([tabindex^="-"])`).join(', ');
	      return this.find(focusables, element).filter(el => !isDisabled(el) && isVisible(el));
	    }

	  };

	  return SelectorEngine;

	}));

	}(selectorEngine));

	/*!
	  * Bootstrap carousel.js v5.1.3 (https://getbootstrap.com/)
	  * Copyright 2011-2021 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
	  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	  */

	(function (module, exports) {
	(function (global, factory) {
	  module.exports = factory(eventHandler.exports, manipulator.exports, selectorEngine.exports, baseComponent.exports) ;
	})(commonjsGlobal, (function (EventHandler, Manipulator, SelectorEngine, BaseComponent) {
	  const _interopDefaultLegacy = e => e && typeof e === 'object' && 'default' in e ? e : { default: e };

	  const EventHandler__default = /*#__PURE__*/_interopDefaultLegacy(EventHandler);
	  const Manipulator__default = /*#__PURE__*/_interopDefaultLegacy(Manipulator);
	  const SelectorEngine__default = /*#__PURE__*/_interopDefaultLegacy(SelectorEngine);
	  const BaseComponent__default = /*#__PURE__*/_interopDefaultLegacy(BaseComponent);

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/index.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  const TRANSITION_END = 'transitionend'; // Shoutout AngusCroll (https://goo.gl/pxwQGp)

	  const toType = obj => {
	    if (obj === null || obj === undefined) {
	      return `${obj}`;
	    }

	    return {}.toString.call(obj).match(/\s([a-z]+)/i)[1].toLowerCase();
	  };

	  const getSelector = element => {
	    let selector = element.getAttribute('data-bs-target');

	    if (!selector || selector === '#') {
	      let hrefAttr = element.getAttribute('href'); // The only valid content that could double as a selector are IDs or classes,
	      // so everything starting with `#` or `.`. If a "real" URL is used as the selector,
	      // `document.querySelector` will rightfully complain it is invalid.
	      // See https://github.com/twbs/bootstrap/issues/32273

	      if (!hrefAttr || !hrefAttr.includes('#') && !hrefAttr.startsWith('.')) {
	        return null;
	      } // Just in case some CMS puts out a full URL with the anchor appended


	      if (hrefAttr.includes('#') && !hrefAttr.startsWith('#')) {
	        hrefAttr = `#${hrefAttr.split('#')[1]}`;
	      }

	      selector = hrefAttr && hrefAttr !== '#' ? hrefAttr.trim() : null;
	    }

	    return selector;
	  };

	  const getElementFromSelector = element => {
	    const selector = getSelector(element);
	    return selector ? document.querySelector(selector) : null;
	  };

	  const triggerTransitionEnd = element => {
	    element.dispatchEvent(new Event(TRANSITION_END));
	  };

	  const isElement = obj => {
	    if (!obj || typeof obj !== 'object') {
	      return false;
	    }

	    if (typeof obj.jquery !== 'undefined') {
	      obj = obj[0];
	    }

	    return typeof obj.nodeType !== 'undefined';
	  };

	  const typeCheckConfig = (componentName, config, configTypes) => {
	    Object.keys(configTypes).forEach(property => {
	      const expectedTypes = configTypes[property];
	      const value = config[property];
	      const valueType = value && isElement(value) ? 'element' : toType(value);

	      if (!new RegExp(expectedTypes).test(valueType)) {
	        throw new TypeError(`${componentName.toUpperCase()}: Option "${property}" provided type "${valueType}" but expected type "${expectedTypes}".`);
	      }
	    });
	  };

	  const isVisible = element => {
	    if (!isElement(element) || element.getClientRects().length === 0) {
	      return false;
	    }

	    return getComputedStyle(element).getPropertyValue('visibility') === 'visible';
	  };
	  /**
	   * Trick to restart an element's animation
	   *
	   * @param {HTMLElement} element
	   * @return void
	   *
	   * @see https://www.charistheo.io/blog/2021/02/restart-a-css-animation-with-javascript/#restarting-a-css-animation
	   */


	  const reflow = element => {
	    // eslint-disable-next-line no-unused-expressions
	    element.offsetHeight;
	  };

	  const getjQuery = () => {
	    const {
	      jQuery
	    } = window;

	    if (jQuery && !document.body.hasAttribute('data-bs-no-jquery')) {
	      return jQuery;
	    }

	    return null;
	  };

	  const DOMContentLoadedCallbacks = [];

	  const onDOMContentLoaded = callback => {
	    if (document.readyState === 'loading') {
	      // add listener on the first call when the document is in loading state
	      if (!DOMContentLoadedCallbacks.length) {
	        document.addEventListener('DOMContentLoaded', () => {
	          DOMContentLoadedCallbacks.forEach(callback => callback());
	        });
	      }

	      DOMContentLoadedCallbacks.push(callback);
	    } else {
	      callback();
	    }
	  };

	  const isRTL = () => document.documentElement.dir === 'rtl';

	  const defineJQueryPlugin = plugin => {
	    onDOMContentLoaded(() => {
	      const $ = getjQuery();
	      /* istanbul ignore if */

	      if ($) {
	        const name = plugin.NAME;
	        const JQUERY_NO_CONFLICT = $.fn[name];
	        $.fn[name] = plugin.jQueryInterface;
	        $.fn[name].Constructor = plugin;

	        $.fn[name].noConflict = () => {
	          $.fn[name] = JQUERY_NO_CONFLICT;
	          return plugin.jQueryInterface;
	        };
	      }
	    });
	  };
	  /**
	   * Return the previous/next element of a list.
	   *
	   * @param {array} list    The list of elements
	   * @param activeElement   The active element
	   * @param shouldGetNext   Choose to get next or previous element
	   * @param isCycleAllowed
	   * @return {Element|elem} The proper element
	   */


	  const getNextActiveElement = (list, activeElement, shouldGetNext, isCycleAllowed) => {
	    let index = list.indexOf(activeElement); // if the element does not exist in the list return an element depending on the direction and if cycle is allowed

	    if (index === -1) {
	      return list[!shouldGetNext && isCycleAllowed ? list.length - 1 : 0];
	    }

	    const listLength = list.length;
	    index += shouldGetNext ? 1 : -1;

	    if (isCycleAllowed) {
	      index = (index + listLength) % listLength;
	    }

	    return list[Math.max(0, Math.min(index, listLength - 1))];
	  };

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): carousel.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  /**
	   * ------------------------------------------------------------------------
	   * Constants
	   * ------------------------------------------------------------------------
	   */

	  const NAME = 'carousel';
	  const DATA_KEY = 'bs.carousel';
	  const EVENT_KEY = `.${DATA_KEY}`;
	  const DATA_API_KEY = '.data-api';
	  const ARROW_LEFT_KEY = 'ArrowLeft';
	  const ARROW_RIGHT_KEY = 'ArrowRight';
	  const TOUCHEVENT_COMPAT_WAIT = 500; // Time for mouse compat events to fire after touch

	  const SWIPE_THRESHOLD = 40;
	  const Default = {
	    interval: 5000,
	    keyboard: true,
	    slide: false,
	    pause: 'hover',
	    wrap: true,
	    touch: true
	  };
	  const DefaultType = {
	    interval: '(number|boolean)',
	    keyboard: 'boolean',
	    slide: '(boolean|string)',
	    pause: '(string|boolean)',
	    wrap: 'boolean',
	    touch: 'boolean'
	  };
	  const ORDER_NEXT = 'next';
	  const ORDER_PREV = 'prev';
	  const DIRECTION_LEFT = 'left';
	  const DIRECTION_RIGHT = 'right';
	  const KEY_TO_DIRECTION = {
	    [ARROW_LEFT_KEY]: DIRECTION_RIGHT,
	    [ARROW_RIGHT_KEY]: DIRECTION_LEFT
	  };
	  const EVENT_SLIDE = `slide${EVENT_KEY}`;
	  const EVENT_SLID = `slid${EVENT_KEY}`;
	  const EVENT_KEYDOWN = `keydown${EVENT_KEY}`;
	  const EVENT_MOUSEENTER = `mouseenter${EVENT_KEY}`;
	  const EVENT_MOUSELEAVE = `mouseleave${EVENT_KEY}`;
	  const EVENT_TOUCHSTART = `touchstart${EVENT_KEY}`;
	  const EVENT_TOUCHMOVE = `touchmove${EVENT_KEY}`;
	  const EVENT_TOUCHEND = `touchend${EVENT_KEY}`;
	  const EVENT_POINTERDOWN = `pointerdown${EVENT_KEY}`;
	  const EVENT_POINTERUP = `pointerup${EVENT_KEY}`;
	  const EVENT_DRAG_START = `dragstart${EVENT_KEY}`;
	  const EVENT_LOAD_DATA_API = `load${EVENT_KEY}${DATA_API_KEY}`;
	  const EVENT_CLICK_DATA_API = `click${EVENT_KEY}${DATA_API_KEY}`;
	  const CLASS_NAME_CAROUSEL = 'carousel';
	  const CLASS_NAME_ACTIVE = 'active';
	  const CLASS_NAME_SLIDE = 'slide';
	  const CLASS_NAME_END = 'carousel-item-end';
	  const CLASS_NAME_START = 'carousel-item-start';
	  const CLASS_NAME_NEXT = 'carousel-item-next';
	  const CLASS_NAME_PREV = 'carousel-item-prev';
	  const CLASS_NAME_POINTER_EVENT = 'pointer-event';
	  const SELECTOR_ACTIVE = '.active';
	  const SELECTOR_ACTIVE_ITEM = '.active.carousel-item';
	  const SELECTOR_ITEM = '.carousel-item';
	  const SELECTOR_ITEM_IMG = '.carousel-item img';
	  const SELECTOR_NEXT_PREV = '.carousel-item-next, .carousel-item-prev';
	  const SELECTOR_INDICATORS = '.carousel-indicators';
	  const SELECTOR_INDICATOR = '[data-bs-target]';
	  const SELECTOR_DATA_SLIDE = '[data-bs-slide], [data-bs-slide-to]';
	  const SELECTOR_DATA_RIDE = '[data-bs-ride="carousel"]';
	  const POINTER_TYPE_TOUCH = 'touch';
	  const POINTER_TYPE_PEN = 'pen';
	  /**
	   * ------------------------------------------------------------------------
	   * Class Definition
	   * ------------------------------------------------------------------------
	   */

	  class Carousel extends BaseComponent__default.default {
	    constructor(element, config) {
	      super(element);
	      this._items = null;
	      this._interval = null;
	      this._activeElement = null;
	      this._isPaused = false;
	      this._isSliding = false;
	      this.touchTimeout = null;
	      this.touchStartX = 0;
	      this.touchDeltaX = 0;
	      this._config = this._getConfig(config);
	      this._indicatorsElement = SelectorEngine__default.default.findOne(SELECTOR_INDICATORS, this._element);
	      this._touchSupported = 'ontouchstart' in document.documentElement || navigator.maxTouchPoints > 0;
	      this._pointerEvent = Boolean(window.PointerEvent);

	      this._addEventListeners();
	    } // Getters


	    static get Default() {
	      return Default;
	    }

	    static get NAME() {
	      return NAME;
	    } // Public


	    next() {
	      this._slide(ORDER_NEXT);
	    }

	    nextWhenVisible() {
	      // Don't call next when the page isn't visible
	      // or the carousel or its parent isn't visible
	      if (!document.hidden && isVisible(this._element)) {
	        this.next();
	      }
	    }

	    prev() {
	      this._slide(ORDER_PREV);
	    }

	    pause(event) {
	      if (!event) {
	        this._isPaused = true;
	      }

	      if (SelectorEngine__default.default.findOne(SELECTOR_NEXT_PREV, this._element)) {
	        triggerTransitionEnd(this._element);
	        this.cycle(true);
	      }

	      clearInterval(this._interval);
	      this._interval = null;
	    }

	    cycle(event) {
	      if (!event) {
	        this._isPaused = false;
	      }

	      if (this._interval) {
	        clearInterval(this._interval);
	        this._interval = null;
	      }

	      if (this._config && this._config.interval && !this._isPaused) {
	        this._updateInterval();

	        this._interval = setInterval((document.visibilityState ? this.nextWhenVisible : this.next).bind(this), this._config.interval);
	      }
	    }

	    to(index) {
	      this._activeElement = SelectorEngine__default.default.findOne(SELECTOR_ACTIVE_ITEM, this._element);

	      const activeIndex = this._getItemIndex(this._activeElement);

	      if (index > this._items.length - 1 || index < 0) {
	        return;
	      }

	      if (this._isSliding) {
	        EventHandler__default.default.one(this._element, EVENT_SLID, () => this.to(index));
	        return;
	      }

	      if (activeIndex === index) {
	        this.pause();
	        this.cycle();
	        return;
	      }

	      const order = index > activeIndex ? ORDER_NEXT : ORDER_PREV;

	      this._slide(order, this._items[index]);
	    } // Private


	    _getConfig(config) {
	      config = { ...Default,
	        ...Manipulator__default.default.getDataAttributes(this._element),
	        ...(typeof config === 'object' ? config : {})
	      };
	      typeCheckConfig(NAME, config, DefaultType);
	      return config;
	    }

	    _handleSwipe() {
	      const absDeltax = Math.abs(this.touchDeltaX);

	      if (absDeltax <= SWIPE_THRESHOLD) {
	        return;
	      }

	      const direction = absDeltax / this.touchDeltaX;
	      this.touchDeltaX = 0;

	      if (!direction) {
	        return;
	      }

	      this._slide(direction > 0 ? DIRECTION_RIGHT : DIRECTION_LEFT);
	    }

	    _addEventListeners() {
	      if (this._config.keyboard) {
	        EventHandler__default.default.on(this._element, EVENT_KEYDOWN, event => this._keydown(event));
	      }

	      if (this._config.pause === 'hover') {
	        EventHandler__default.default.on(this._element, EVENT_MOUSEENTER, event => this.pause(event));
	        EventHandler__default.default.on(this._element, EVENT_MOUSELEAVE, event => this.cycle(event));
	      }

	      if (this._config.touch && this._touchSupported) {
	        this._addTouchEventListeners();
	      }
	    }

	    _addTouchEventListeners() {
	      const hasPointerPenTouch = event => {
	        return this._pointerEvent && (event.pointerType === POINTER_TYPE_PEN || event.pointerType === POINTER_TYPE_TOUCH);
	      };

	      const start = event => {
	        if (hasPointerPenTouch(event)) {
	          this.touchStartX = event.clientX;
	        } else if (!this._pointerEvent) {
	          this.touchStartX = event.touches[0].clientX;
	        }
	      };

	      const move = event => {
	        // ensure swiping with one touch and not pinching
	        this.touchDeltaX = event.touches && event.touches.length > 1 ? 0 : event.touches[0].clientX - this.touchStartX;
	      };

	      const end = event => {
	        if (hasPointerPenTouch(event)) {
	          this.touchDeltaX = event.clientX - this.touchStartX;
	        }

	        this._handleSwipe();

	        if (this._config.pause === 'hover') {
	          // If it's a touch-enabled device, mouseenter/leave are fired as
	          // part of the mouse compatibility events on first tap - the carousel
	          // would stop cycling until user tapped out of it;
	          // here, we listen for touchend, explicitly pause the carousel
	          // (as if it's the second time we tap on it, mouseenter compat event
	          // is NOT fired) and after a timeout (to allow for mouse compatibility
	          // events to fire) we explicitly restart cycling
	          this.pause();

	          if (this.touchTimeout) {
	            clearTimeout(this.touchTimeout);
	          }

	          this.touchTimeout = setTimeout(event => this.cycle(event), TOUCHEVENT_COMPAT_WAIT + this._config.interval);
	        }
	      };

	      SelectorEngine__default.default.find(SELECTOR_ITEM_IMG, this._element).forEach(itemImg => {
	        EventHandler__default.default.on(itemImg, EVENT_DRAG_START, event => event.preventDefault());
	      });

	      if (this._pointerEvent) {
	        EventHandler__default.default.on(this._element, EVENT_POINTERDOWN, event => start(event));
	        EventHandler__default.default.on(this._element, EVENT_POINTERUP, event => end(event));

	        this._element.classList.add(CLASS_NAME_POINTER_EVENT);
	      } else {
	        EventHandler__default.default.on(this._element, EVENT_TOUCHSTART, event => start(event));
	        EventHandler__default.default.on(this._element, EVENT_TOUCHMOVE, event => move(event));
	        EventHandler__default.default.on(this._element, EVENT_TOUCHEND, event => end(event));
	      }
	    }

	    _keydown(event) {
	      if (/input|textarea/i.test(event.target.tagName)) {
	        return;
	      }

	      const direction = KEY_TO_DIRECTION[event.key];

	      if (direction) {
	        event.preventDefault();

	        this._slide(direction);
	      }
	    }

	    _getItemIndex(element) {
	      this._items = element && element.parentNode ? SelectorEngine__default.default.find(SELECTOR_ITEM, element.parentNode) : [];
	      return this._items.indexOf(element);
	    }

	    _getItemByOrder(order, activeElement) {
	      const isNext = order === ORDER_NEXT;
	      return getNextActiveElement(this._items, activeElement, isNext, this._config.wrap);
	    }

	    _triggerSlideEvent(relatedTarget, eventDirectionName) {
	      const targetIndex = this._getItemIndex(relatedTarget);

	      const fromIndex = this._getItemIndex(SelectorEngine__default.default.findOne(SELECTOR_ACTIVE_ITEM, this._element));

	      return EventHandler__default.default.trigger(this._element, EVENT_SLIDE, {
	        relatedTarget,
	        direction: eventDirectionName,
	        from: fromIndex,
	        to: targetIndex
	      });
	    }

	    _setActiveIndicatorElement(element) {
	      if (this._indicatorsElement) {
	        const activeIndicator = SelectorEngine__default.default.findOne(SELECTOR_ACTIVE, this._indicatorsElement);
	        activeIndicator.classList.remove(CLASS_NAME_ACTIVE);
	        activeIndicator.removeAttribute('aria-current');
	        const indicators = SelectorEngine__default.default.find(SELECTOR_INDICATOR, this._indicatorsElement);

	        for (let i = 0; i < indicators.length; i++) {
	          if (Number.parseInt(indicators[i].getAttribute('data-bs-slide-to'), 10) === this._getItemIndex(element)) {
	            indicators[i].classList.add(CLASS_NAME_ACTIVE);
	            indicators[i].setAttribute('aria-current', 'true');
	            break;
	          }
	        }
	      }
	    }

	    _updateInterval() {
	      const element = this._activeElement || SelectorEngine__default.default.findOne(SELECTOR_ACTIVE_ITEM, this._element);

	      if (!element) {
	        return;
	      }

	      const elementInterval = Number.parseInt(element.getAttribute('data-bs-interval'), 10);

	      if (elementInterval) {
	        this._config.defaultInterval = this._config.defaultInterval || this._config.interval;
	        this._config.interval = elementInterval;
	      } else {
	        this._config.interval = this._config.defaultInterval || this._config.interval;
	      }
	    }

	    _slide(directionOrOrder, element) {
	      const order = this._directionToOrder(directionOrOrder);

	      const activeElement = SelectorEngine__default.default.findOne(SELECTOR_ACTIVE_ITEM, this._element);

	      const activeElementIndex = this._getItemIndex(activeElement);

	      const nextElement = element || this._getItemByOrder(order, activeElement);

	      const nextElementIndex = this._getItemIndex(nextElement);

	      const isCycling = Boolean(this._interval);
	      const isNext = order === ORDER_NEXT;
	      const directionalClassName = isNext ? CLASS_NAME_START : CLASS_NAME_END;
	      const orderClassName = isNext ? CLASS_NAME_NEXT : CLASS_NAME_PREV;

	      const eventDirectionName = this._orderToDirection(order);

	      if (nextElement && nextElement.classList.contains(CLASS_NAME_ACTIVE)) {
	        this._isSliding = false;
	        return;
	      }

	      if (this._isSliding) {
	        return;
	      }

	      const slideEvent = this._triggerSlideEvent(nextElement, eventDirectionName);

	      if (slideEvent.defaultPrevented) {
	        return;
	      }

	      if (!activeElement || !nextElement) {
	        // Some weirdness is happening, so we bail
	        return;
	      }

	      this._isSliding = true;

	      if (isCycling) {
	        this.pause();
	      }

	      this._setActiveIndicatorElement(nextElement);

	      this._activeElement = nextElement;

	      const triggerSlidEvent = () => {
	        EventHandler__default.default.trigger(this._element, EVENT_SLID, {
	          relatedTarget: nextElement,
	          direction: eventDirectionName,
	          from: activeElementIndex,
	          to: nextElementIndex
	        });
	      };

	      if (this._element.classList.contains(CLASS_NAME_SLIDE)) {
	        nextElement.classList.add(orderClassName);
	        reflow(nextElement);
	        activeElement.classList.add(directionalClassName);
	        nextElement.classList.add(directionalClassName);

	        const completeCallBack = () => {
	          nextElement.classList.remove(directionalClassName, orderClassName);
	          nextElement.classList.add(CLASS_NAME_ACTIVE);
	          activeElement.classList.remove(CLASS_NAME_ACTIVE, orderClassName, directionalClassName);
	          this._isSliding = false;
	          setTimeout(triggerSlidEvent, 0);
	        };

	        this._queueCallback(completeCallBack, activeElement, true);
	      } else {
	        activeElement.classList.remove(CLASS_NAME_ACTIVE);
	        nextElement.classList.add(CLASS_NAME_ACTIVE);
	        this._isSliding = false;
	        triggerSlidEvent();
	      }

	      if (isCycling) {
	        this.cycle();
	      }
	    }

	    _directionToOrder(direction) {
	      if (![DIRECTION_RIGHT, DIRECTION_LEFT].includes(direction)) {
	        return direction;
	      }

	      if (isRTL()) {
	        return direction === DIRECTION_LEFT ? ORDER_PREV : ORDER_NEXT;
	      }

	      return direction === DIRECTION_LEFT ? ORDER_NEXT : ORDER_PREV;
	    }

	    _orderToDirection(order) {
	      if (![ORDER_NEXT, ORDER_PREV].includes(order)) {
	        return order;
	      }

	      if (isRTL()) {
	        return order === ORDER_PREV ? DIRECTION_LEFT : DIRECTION_RIGHT;
	      }

	      return order === ORDER_PREV ? DIRECTION_RIGHT : DIRECTION_LEFT;
	    } // Static


	    static carouselInterface(element, config) {
	      const data = Carousel.getOrCreateInstance(element, config);
	      let {
	        _config
	      } = data;

	      if (typeof config === 'object') {
	        _config = { ..._config,
	          ...config
	        };
	      }

	      const action = typeof config === 'string' ? config : _config.slide;

	      if (typeof config === 'number') {
	        data.to(config);
	      } else if (typeof action === 'string') {
	        if (typeof data[action] === 'undefined') {
	          throw new TypeError(`No method named "${action}"`);
	        }

	        data[action]();
	      } else if (_config.interval && _config.ride) {
	        data.pause();
	        data.cycle();
	      }
	    }

	    static jQueryInterface(config) {
	      return this.each(function () {
	        Carousel.carouselInterface(this, config);
	      });
	    }

	    static dataApiClickHandler(event) {
	      const target = getElementFromSelector(this);

	      if (!target || !target.classList.contains(CLASS_NAME_CAROUSEL)) {
	        return;
	      }

	      const config = { ...Manipulator__default.default.getDataAttributes(target),
	        ...Manipulator__default.default.getDataAttributes(this)
	      };
	      const slideIndex = this.getAttribute('data-bs-slide-to');

	      if (slideIndex) {
	        config.interval = false;
	      }

	      Carousel.carouselInterface(target, config);

	      if (slideIndex) {
	        Carousel.getInstance(target).to(slideIndex);
	      }

	      event.preventDefault();
	    }

	  }
	  /**
	   * ------------------------------------------------------------------------
	   * Data Api implementation
	   * ------------------------------------------------------------------------
	   */


	  EventHandler__default.default.on(document, EVENT_CLICK_DATA_API, SELECTOR_DATA_SLIDE, Carousel.dataApiClickHandler);
	  EventHandler__default.default.on(window, EVENT_LOAD_DATA_API, () => {
	    const carousels = SelectorEngine__default.default.find(SELECTOR_DATA_RIDE);

	    for (let i = 0, len = carousels.length; i < len; i++) {
	      Carousel.carouselInterface(carousels[i], Carousel.getInstance(carousels[i]));
	    }
	  });
	  /**
	   * ------------------------------------------------------------------------
	   * jQuery
	   * ------------------------------------------------------------------------
	   * add .Carousel to jQuery only if jQuery is present
	   */

	  defineJQueryPlugin(Carousel);

	  return Carousel;

	}));

	}(carousel$1));

	var carousel = carousel$1.exports;

	var collapse$1 = {exports: {}};

	/*!
	  * Bootstrap collapse.js v5.1.3 (https://getbootstrap.com/)
	  * Copyright 2011-2021 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
	  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	  */

	(function (module, exports) {
	(function (global, factory) {
	  module.exports = factory(data.exports, eventHandler.exports, manipulator.exports, selectorEngine.exports, baseComponent.exports) ;
	})(commonjsGlobal, (function (Data, EventHandler, Manipulator, SelectorEngine, BaseComponent) {
	  const _interopDefaultLegacy = e => e && typeof e === 'object' && 'default' in e ? e : { default: e };

	  const Data__default = /*#__PURE__*/_interopDefaultLegacy(Data);
	  const EventHandler__default = /*#__PURE__*/_interopDefaultLegacy(EventHandler);
	  const Manipulator__default = /*#__PURE__*/_interopDefaultLegacy(Manipulator);
	  const SelectorEngine__default = /*#__PURE__*/_interopDefaultLegacy(SelectorEngine);
	  const BaseComponent__default = /*#__PURE__*/_interopDefaultLegacy(BaseComponent);

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/index.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */

	  const toType = obj => {
	    if (obj === null || obj === undefined) {
	      return `${obj}`;
	    }

	    return {}.toString.call(obj).match(/\s([a-z]+)/i)[1].toLowerCase();
	  };

	  const getSelector = element => {
	    let selector = element.getAttribute('data-bs-target');

	    if (!selector || selector === '#') {
	      let hrefAttr = element.getAttribute('href'); // The only valid content that could double as a selector are IDs or classes,
	      // so everything starting with `#` or `.`. If a "real" URL is used as the selector,
	      // `document.querySelector` will rightfully complain it is invalid.
	      // See https://github.com/twbs/bootstrap/issues/32273

	      if (!hrefAttr || !hrefAttr.includes('#') && !hrefAttr.startsWith('.')) {
	        return null;
	      } // Just in case some CMS puts out a full URL with the anchor appended


	      if (hrefAttr.includes('#') && !hrefAttr.startsWith('#')) {
	        hrefAttr = `#${hrefAttr.split('#')[1]}`;
	      }

	      selector = hrefAttr && hrefAttr !== '#' ? hrefAttr.trim() : null;
	    }

	    return selector;
	  };

	  const getSelectorFromElement = element => {
	    const selector = getSelector(element);

	    if (selector) {
	      return document.querySelector(selector) ? selector : null;
	    }

	    return null;
	  };

	  const getElementFromSelector = element => {
	    const selector = getSelector(element);
	    return selector ? document.querySelector(selector) : null;
	  };

	  const isElement = obj => {
	    if (!obj || typeof obj !== 'object') {
	      return false;
	    }

	    if (typeof obj.jquery !== 'undefined') {
	      obj = obj[0];
	    }

	    return typeof obj.nodeType !== 'undefined';
	  };

	  const getElement = obj => {
	    if (isElement(obj)) {
	      // it's a jQuery object or a node element
	      return obj.jquery ? obj[0] : obj;
	    }

	    if (typeof obj === 'string' && obj.length > 0) {
	      return document.querySelector(obj);
	    }

	    return null;
	  };

	  const typeCheckConfig = (componentName, config, configTypes) => {
	    Object.keys(configTypes).forEach(property => {
	      const expectedTypes = configTypes[property];
	      const value = config[property];
	      const valueType = value && isElement(value) ? 'element' : toType(value);

	      if (!new RegExp(expectedTypes).test(valueType)) {
	        throw new TypeError(`${componentName.toUpperCase()}: Option "${property}" provided type "${valueType}" but expected type "${expectedTypes}".`);
	      }
	    });
	  };
	  /**
	   * Trick to restart an element's animation
	   *
	   * @param {HTMLElement} element
	   * @return void
	   *
	   * @see https://www.charistheo.io/blog/2021/02/restart-a-css-animation-with-javascript/#restarting-a-css-animation
	   */


	  const reflow = element => {
	    // eslint-disable-next-line no-unused-expressions
	    element.offsetHeight;
	  };

	  const getjQuery = () => {
	    const {
	      jQuery
	    } = window;

	    if (jQuery && !document.body.hasAttribute('data-bs-no-jquery')) {
	      return jQuery;
	    }

	    return null;
	  };

	  const DOMContentLoadedCallbacks = [];

	  const onDOMContentLoaded = callback => {
	    if (document.readyState === 'loading') {
	      // add listener on the first call when the document is in loading state
	      if (!DOMContentLoadedCallbacks.length) {
	        document.addEventListener('DOMContentLoaded', () => {
	          DOMContentLoadedCallbacks.forEach(callback => callback());
	        });
	      }

	      DOMContentLoadedCallbacks.push(callback);
	    } else {
	      callback();
	    }
	  };

	  const defineJQueryPlugin = plugin => {
	    onDOMContentLoaded(() => {
	      const $ = getjQuery();
	      /* istanbul ignore if */

	      if ($) {
	        const name = plugin.NAME;
	        const JQUERY_NO_CONFLICT = $.fn[name];
	        $.fn[name] = plugin.jQueryInterface;
	        $.fn[name].Constructor = plugin;

	        $.fn[name].noConflict = () => {
	          $.fn[name] = JQUERY_NO_CONFLICT;
	          return plugin.jQueryInterface;
	        };
	      }
	    });
	  };

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): collapse.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  /**
	   * ------------------------------------------------------------------------
	   * Constants
	   * ------------------------------------------------------------------------
	   */

	  const NAME = 'collapse';
	  const DATA_KEY = 'bs.collapse';
	  const EVENT_KEY = `.${DATA_KEY}`;
	  const DATA_API_KEY = '.data-api';
	  const Default = {
	    toggle: true,
	    parent: null
	  };
	  const DefaultType = {
	    toggle: 'boolean',
	    parent: '(null|element)'
	  };
	  const EVENT_SHOW = `show${EVENT_KEY}`;
	  const EVENT_SHOWN = `shown${EVENT_KEY}`;
	  const EVENT_HIDE = `hide${EVENT_KEY}`;
	  const EVENT_HIDDEN = `hidden${EVENT_KEY}`;
	  const EVENT_CLICK_DATA_API = `click${EVENT_KEY}${DATA_API_KEY}`;
	  const CLASS_NAME_SHOW = 'show';
	  const CLASS_NAME_COLLAPSE = 'collapse';
	  const CLASS_NAME_COLLAPSING = 'collapsing';
	  const CLASS_NAME_COLLAPSED = 'collapsed';
	  const CLASS_NAME_DEEPER_CHILDREN = `:scope .${CLASS_NAME_COLLAPSE} .${CLASS_NAME_COLLAPSE}`;
	  const CLASS_NAME_HORIZONTAL = 'collapse-horizontal';
	  const WIDTH = 'width';
	  const HEIGHT = 'height';
	  const SELECTOR_ACTIVES = '.collapse.show, .collapse.collapsing';
	  const SELECTOR_DATA_TOGGLE = '[data-bs-toggle="collapse"]';
	  /**
	   * ------------------------------------------------------------------------
	   * Class Definition
	   * ------------------------------------------------------------------------
	   */

	  class Collapse extends BaseComponent__default.default {
	    constructor(element, config) {
	      super(element);
	      this._isTransitioning = false;
	      this._config = this._getConfig(config);
	      this._triggerArray = [];
	      const toggleList = SelectorEngine__default.default.find(SELECTOR_DATA_TOGGLE);

	      for (let i = 0, len = toggleList.length; i < len; i++) {
	        const elem = toggleList[i];
	        const selector = getSelectorFromElement(elem);
	        const filterElement = SelectorEngine__default.default.find(selector).filter(foundElem => foundElem === this._element);

	        if (selector !== null && filterElement.length) {
	          this._selector = selector;

	          this._triggerArray.push(elem);
	        }
	      }

	      this._initializeChildren();

	      if (!this._config.parent) {
	        this._addAriaAndCollapsedClass(this._triggerArray, this._isShown());
	      }

	      if (this._config.toggle) {
	        this.toggle();
	      }
	    } // Getters


	    static get Default() {
	      return Default;
	    }

	    static get NAME() {
	      return NAME;
	    } // Public


	    toggle() {
	      if (this._isShown()) {
	        this.hide();
	      } else {
	        this.show();
	      }
	    }

	    show() {
	      if (this._isTransitioning || this._isShown()) {
	        return;
	      }

	      let actives = [];
	      let activesData;

	      if (this._config.parent) {
	        const children = SelectorEngine__default.default.find(CLASS_NAME_DEEPER_CHILDREN, this._config.parent);
	        actives = SelectorEngine__default.default.find(SELECTOR_ACTIVES, this._config.parent).filter(elem => !children.includes(elem)); // remove children if greater depth
	      }

	      const container = SelectorEngine__default.default.findOne(this._selector);

	      if (actives.length) {
	        const tempActiveData = actives.find(elem => container !== elem);
	        activesData = tempActiveData ? Collapse.getInstance(tempActiveData) : null;

	        if (activesData && activesData._isTransitioning) {
	          return;
	        }
	      }

	      const startEvent = EventHandler__default.default.trigger(this._element, EVENT_SHOW);

	      if (startEvent.defaultPrevented) {
	        return;
	      }

	      actives.forEach(elemActive => {
	        if (container !== elemActive) {
	          Collapse.getOrCreateInstance(elemActive, {
	            toggle: false
	          }).hide();
	        }

	        if (!activesData) {
	          Data__default.default.set(elemActive, DATA_KEY, null);
	        }
	      });

	      const dimension = this._getDimension();

	      this._element.classList.remove(CLASS_NAME_COLLAPSE);

	      this._element.classList.add(CLASS_NAME_COLLAPSING);

	      this._element.style[dimension] = 0;

	      this._addAriaAndCollapsedClass(this._triggerArray, true);

	      this._isTransitioning = true;

	      const complete = () => {
	        this._isTransitioning = false;

	        this._element.classList.remove(CLASS_NAME_COLLAPSING);

	        this._element.classList.add(CLASS_NAME_COLLAPSE, CLASS_NAME_SHOW);

	        this._element.style[dimension] = '';
	        EventHandler__default.default.trigger(this._element, EVENT_SHOWN);
	      };

	      const capitalizedDimension = dimension[0].toUpperCase() + dimension.slice(1);
	      const scrollSize = `scroll${capitalizedDimension}`;

	      this._queueCallback(complete, this._element, true);

	      this._element.style[dimension] = `${this._element[scrollSize]}px`;
	    }

	    hide() {
	      if (this._isTransitioning || !this._isShown()) {
	        return;
	      }

	      const startEvent = EventHandler__default.default.trigger(this._element, EVENT_HIDE);

	      if (startEvent.defaultPrevented) {
	        return;
	      }

	      const dimension = this._getDimension();

	      this._element.style[dimension] = `${this._element.getBoundingClientRect()[dimension]}px`;
	      reflow(this._element);

	      this._element.classList.add(CLASS_NAME_COLLAPSING);

	      this._element.classList.remove(CLASS_NAME_COLLAPSE, CLASS_NAME_SHOW);

	      const triggerArrayLength = this._triggerArray.length;

	      for (let i = 0; i < triggerArrayLength; i++) {
	        const trigger = this._triggerArray[i];
	        const elem = getElementFromSelector(trigger);

	        if (elem && !this._isShown(elem)) {
	          this._addAriaAndCollapsedClass([trigger], false);
	        }
	      }

	      this._isTransitioning = true;

	      const complete = () => {
	        this._isTransitioning = false;

	        this._element.classList.remove(CLASS_NAME_COLLAPSING);

	        this._element.classList.add(CLASS_NAME_COLLAPSE);

	        EventHandler__default.default.trigger(this._element, EVENT_HIDDEN);
	      };

	      this._element.style[dimension] = '';

	      this._queueCallback(complete, this._element, true);
	    }

	    _isShown(element = this._element) {
	      return element.classList.contains(CLASS_NAME_SHOW);
	    } // Private


	    _getConfig(config) {
	      config = { ...Default,
	        ...Manipulator__default.default.getDataAttributes(this._element),
	        ...config
	      };
	      config.toggle = Boolean(config.toggle); // Coerce string values

	      config.parent = getElement(config.parent);
	      typeCheckConfig(NAME, config, DefaultType);
	      return config;
	    }

	    _getDimension() {
	      return this._element.classList.contains(CLASS_NAME_HORIZONTAL) ? WIDTH : HEIGHT;
	    }

	    _initializeChildren() {
	      if (!this._config.parent) {
	        return;
	      }

	      const children = SelectorEngine__default.default.find(CLASS_NAME_DEEPER_CHILDREN, this._config.parent);
	      SelectorEngine__default.default.find(SELECTOR_DATA_TOGGLE, this._config.parent).filter(elem => !children.includes(elem)).forEach(element => {
	        const selected = getElementFromSelector(element);

	        if (selected) {
	          this._addAriaAndCollapsedClass([element], this._isShown(selected));
	        }
	      });
	    }

	    _addAriaAndCollapsedClass(triggerArray, isOpen) {
	      if (!triggerArray.length) {
	        return;
	      }

	      triggerArray.forEach(elem => {
	        if (isOpen) {
	          elem.classList.remove(CLASS_NAME_COLLAPSED);
	        } else {
	          elem.classList.add(CLASS_NAME_COLLAPSED);
	        }

	        elem.setAttribute('aria-expanded', isOpen);
	      });
	    } // Static


	    static jQueryInterface(config) {
	      return this.each(function () {
	        const _config = {};

	        if (typeof config === 'string' && /show|hide/.test(config)) {
	          _config.toggle = false;
	        }

	        const data = Collapse.getOrCreateInstance(this, _config);

	        if (typeof config === 'string') {
	          if (typeof data[config] === 'undefined') {
	            throw new TypeError(`No method named "${config}"`);
	          }

	          data[config]();
	        }
	      });
	    }

	  }
	  /**
	   * ------------------------------------------------------------------------
	   * Data Api implementation
	   * ------------------------------------------------------------------------
	   */


	  EventHandler__default.default.on(document, EVENT_CLICK_DATA_API, SELECTOR_DATA_TOGGLE, function (event) {
	    // preventDefault only for <a> elements (which change the URL) not inside the collapsible element
	    if (event.target.tagName === 'A' || event.delegateTarget && event.delegateTarget.tagName === 'A') {
	      event.preventDefault();
	    }

	    const selector = getSelectorFromElement(this);
	    const selectorElements = SelectorEngine__default.default.find(selector);
	    selectorElements.forEach(element => {
	      Collapse.getOrCreateInstance(element, {
	        toggle: false
	      }).toggle();
	    });
	  });
	  /**
	   * ------------------------------------------------------------------------
	   * jQuery
	   * ------------------------------------------------------------------------
	   * add .Collapse to jQuery only if jQuery is present
	   */

	  defineJQueryPlugin(Collapse);

	  return Collapse;

	}));

	}(collapse$1));

	var collapse = collapse$1.exports;

	var dropdown$1 = {exports: {}};

	var top = 'top';
	var bottom = 'bottom';
	var right = 'right';
	var left = 'left';
	var auto = 'auto';
	var basePlacements = [top, bottom, right, left];
	var start = 'start';
	var end = 'end';
	var clippingParents = 'clippingParents';
	var viewport = 'viewport';
	var popper = 'popper';
	var reference = 'reference';
	var variationPlacements = /*#__PURE__*/basePlacements.reduce(function (acc, placement) {
	  return acc.concat([placement + "-" + start, placement + "-" + end]);
	}, []);
	var placements = /*#__PURE__*/[].concat(basePlacements, [auto]).reduce(function (acc, placement) {
	  return acc.concat([placement, placement + "-" + start, placement + "-" + end]);
	}, []); // modifiers that need to read the DOM

	var beforeRead = 'beforeRead';
	var read = 'read';
	var afterRead = 'afterRead'; // pure-logic modifiers

	var beforeMain = 'beforeMain';
	var main = 'main';
	var afterMain = 'afterMain'; // modifier with the purpose to write to the DOM (or write into a framework state)

	var beforeWrite = 'beforeWrite';
	var write = 'write';
	var afterWrite = 'afterWrite';
	var modifierPhases = [beforeRead, read, afterRead, beforeMain, main, afterMain, beforeWrite, write, afterWrite];

	function getNodeName(element) {
	  return element ? (element.nodeName || '').toLowerCase() : null;
	}

	function getWindow(node) {
	  if (node == null) {
	    return window;
	  }

	  if (node.toString() !== '[object Window]') {
	    var ownerDocument = node.ownerDocument;
	    return ownerDocument ? ownerDocument.defaultView || window : window;
	  }

	  return node;
	}

	function isElement(node) {
	  var OwnElement = getWindow(node).Element;
	  return node instanceof OwnElement || node instanceof Element;
	}

	function isHTMLElement(node) {
	  var OwnElement = getWindow(node).HTMLElement;
	  return node instanceof OwnElement || node instanceof HTMLElement;
	}

	function isShadowRoot(node) {
	  // IE 11 has no ShadowRoot
	  if (typeof ShadowRoot === 'undefined') {
	    return false;
	  }

	  var OwnElement = getWindow(node).ShadowRoot;
	  return node instanceof OwnElement || node instanceof ShadowRoot;
	}

	// and applies them to the HTMLElements such as popper and arrow

	function applyStyles(_ref) {
	  var state = _ref.state;
	  Object.keys(state.elements).forEach(function (name) {
	    var style = state.styles[name] || {};
	    var attributes = state.attributes[name] || {};
	    var element = state.elements[name]; // arrow is optional + virtual elements

	    if (!isHTMLElement(element) || !getNodeName(element)) {
	      return;
	    } // Flow doesn't support to extend this property, but it's the most
	    // effective way to apply styles to an HTMLElement
	    // $FlowFixMe[cannot-write]


	    Object.assign(element.style, style);
	    Object.keys(attributes).forEach(function (name) {
	      var value = attributes[name];

	      if (value === false) {
	        element.removeAttribute(name);
	      } else {
	        element.setAttribute(name, value === true ? '' : value);
	      }
	    });
	  });
	}

	function effect$2(_ref2) {
	  var state = _ref2.state;
	  var initialStyles = {
	    popper: {
	      position: state.options.strategy,
	      left: '0',
	      top: '0',
	      margin: '0'
	    },
	    arrow: {
	      position: 'absolute'
	    },
	    reference: {}
	  };
	  Object.assign(state.elements.popper.style, initialStyles.popper);
	  state.styles = initialStyles;

	  if (state.elements.arrow) {
	    Object.assign(state.elements.arrow.style, initialStyles.arrow);
	  }

	  return function () {
	    Object.keys(state.elements).forEach(function (name) {
	      var element = state.elements[name];
	      var attributes = state.attributes[name] || {};
	      var styleProperties = Object.keys(state.styles.hasOwnProperty(name) ? state.styles[name] : initialStyles[name]); // Set all values to an empty string to unset them

	      var style = styleProperties.reduce(function (style, property) {
	        style[property] = '';
	        return style;
	      }, {}); // arrow is optional + virtual elements

	      if (!isHTMLElement(element) || !getNodeName(element)) {
	        return;
	      }

	      Object.assign(element.style, style);
	      Object.keys(attributes).forEach(function (attribute) {
	        element.removeAttribute(attribute);
	      });
	    });
	  };
	} // eslint-disable-next-line import/no-unused-modules


	var applyStyles$1 = {
	  name: 'applyStyles',
	  enabled: true,
	  phase: 'write',
	  fn: applyStyles,
	  effect: effect$2,
	  requires: ['computeStyles']
	};

	function getBasePlacement(placement) {
	  return placement.split('-')[0];
	}

	var max = Math.max;
	var min = Math.min;
	var round = Math.round;

	function getBoundingClientRect(element, includeScale) {
	  if (includeScale === void 0) {
	    includeScale = false;
	  }

	  var rect = element.getBoundingClientRect();
	  var scaleX = 1;
	  var scaleY = 1;

	  if (isHTMLElement(element) && includeScale) {
	    var offsetHeight = element.offsetHeight;
	    var offsetWidth = element.offsetWidth; // Do not attempt to divide by 0, otherwise we get `Infinity` as scale
	    // Fallback to 1 in case both values are `0`

	    if (offsetWidth > 0) {
	      scaleX = round(rect.width) / offsetWidth || 1;
	    }

	    if (offsetHeight > 0) {
	      scaleY = round(rect.height) / offsetHeight || 1;
	    }
	  }

	  return {
	    width: rect.width / scaleX,
	    height: rect.height / scaleY,
	    top: rect.top / scaleY,
	    right: rect.right / scaleX,
	    bottom: rect.bottom / scaleY,
	    left: rect.left / scaleX,
	    x: rect.left / scaleX,
	    y: rect.top / scaleY
	  };
	}

	// means it doesn't take into account transforms.

	function getLayoutRect(element) {
	  var clientRect = getBoundingClientRect(element); // Use the clientRect sizes if it's not been transformed.
	  // Fixes https://github.com/popperjs/popper-core/issues/1223

	  var width = element.offsetWidth;
	  var height = element.offsetHeight;

	  if (Math.abs(clientRect.width - width) <= 1) {
	    width = clientRect.width;
	  }

	  if (Math.abs(clientRect.height - height) <= 1) {
	    height = clientRect.height;
	  }

	  return {
	    x: element.offsetLeft,
	    y: element.offsetTop,
	    width: width,
	    height: height
	  };
	}

	function contains(parent, child) {
	  var rootNode = child.getRootNode && child.getRootNode(); // First, attempt with faster native method

	  if (parent.contains(child)) {
	    return true;
	  } // then fallback to custom implementation with Shadow DOM support
	  else if (rootNode && isShadowRoot(rootNode)) {
	      var next = child;

	      do {
	        if (next && parent.isSameNode(next)) {
	          return true;
	        } // $FlowFixMe[prop-missing]: need a better way to handle this...


	        next = next.parentNode || next.host;
	      } while (next);
	    } // Give up, the result is false


	  return false;
	}

	function getComputedStyle$1(element) {
	  return getWindow(element).getComputedStyle(element);
	}

	function isTableElement(element) {
	  return ['table', 'td', 'th'].indexOf(getNodeName(element)) >= 0;
	}

	function getDocumentElement(element) {
	  // $FlowFixMe[incompatible-return]: assume body is always available
	  return ((isElement(element) ? element.ownerDocument : // $FlowFixMe[prop-missing]
	  element.document) || window.document).documentElement;
	}

	function getParentNode(element) {
	  if (getNodeName(element) === 'html') {
	    return element;
	  }

	  return (// this is a quicker (but less type safe) way to save quite some bytes from the bundle
	    // $FlowFixMe[incompatible-return]
	    // $FlowFixMe[prop-missing]
	    element.assignedSlot || // step into the shadow DOM of the parent of a slotted node
	    element.parentNode || ( // DOM Element detected
	    isShadowRoot(element) ? element.host : null) || // ShadowRoot detected
	    // $FlowFixMe[incompatible-call]: HTMLElement is a Node
	    getDocumentElement(element) // fallback

	  );
	}

	function getTrueOffsetParent(element) {
	  if (!isHTMLElement(element) || // https://github.com/popperjs/popper-core/issues/837
	  getComputedStyle$1(element).position === 'fixed') {
	    return null;
	  }

	  return element.offsetParent;
	} // `.offsetParent` reports `null` for fixed elements, while absolute elements
	// return the containing block


	function getContainingBlock(element) {
	  var isFirefox = navigator.userAgent.toLowerCase().indexOf('firefox') !== -1;
	  var isIE = navigator.userAgent.indexOf('Trident') !== -1;

	  if (isIE && isHTMLElement(element)) {
	    // In IE 9, 10 and 11 fixed elements containing block is always established by the viewport
	    var elementCss = getComputedStyle$1(element);

	    if (elementCss.position === 'fixed') {
	      return null;
	    }
	  }

	  var currentNode = getParentNode(element);

	  while (isHTMLElement(currentNode) && ['html', 'body'].indexOf(getNodeName(currentNode)) < 0) {
	    var css = getComputedStyle$1(currentNode); // This is non-exhaustive but covers the most common CSS properties that
	    // create a containing block.
	    // https://developer.mozilla.org/en-US/docs/Web/CSS/Containing_block#identifying_the_containing_block

	    if (css.transform !== 'none' || css.perspective !== 'none' || css.contain === 'paint' || ['transform', 'perspective'].indexOf(css.willChange) !== -1 || isFirefox && css.willChange === 'filter' || isFirefox && css.filter && css.filter !== 'none') {
	      return currentNode;
	    } else {
	      currentNode = currentNode.parentNode;
	    }
	  }

	  return null;
	} // Gets the closest ancestor positioned element. Handles some edge cases,
	// such as table ancestors and cross browser bugs.


	function getOffsetParent(element) {
	  var window = getWindow(element);
	  var offsetParent = getTrueOffsetParent(element);

	  while (offsetParent && isTableElement(offsetParent) && getComputedStyle$1(offsetParent).position === 'static') {
	    offsetParent = getTrueOffsetParent(offsetParent);
	  }

	  if (offsetParent && (getNodeName(offsetParent) === 'html' || getNodeName(offsetParent) === 'body' && getComputedStyle$1(offsetParent).position === 'static')) {
	    return window;
	  }

	  return offsetParent || getContainingBlock(element) || window;
	}

	function getMainAxisFromPlacement(placement) {
	  return ['top', 'bottom'].indexOf(placement) >= 0 ? 'x' : 'y';
	}

	function within(min$1, value, max$1) {
	  return max(min$1, min(value, max$1));
	}
	function withinMaxClamp(min, value, max) {
	  var v = within(min, value, max);
	  return v > max ? max : v;
	}

	function getFreshSideObject() {
	  return {
	    top: 0,
	    right: 0,
	    bottom: 0,
	    left: 0
	  };
	}

	function mergePaddingObject(paddingObject) {
	  return Object.assign({}, getFreshSideObject(), paddingObject);
	}

	function expandToHashMap(value, keys) {
	  return keys.reduce(function (hashMap, key) {
	    hashMap[key] = value;
	    return hashMap;
	  }, {});
	}

	var toPaddingObject = function toPaddingObject(padding, state) {
	  padding = typeof padding === 'function' ? padding(Object.assign({}, state.rects, {
	    placement: state.placement
	  })) : padding;
	  return mergePaddingObject(typeof padding !== 'number' ? padding : expandToHashMap(padding, basePlacements));
	};

	function arrow(_ref) {
	  var _state$modifiersData$;

	  var state = _ref.state,
	      name = _ref.name,
	      options = _ref.options;
	  var arrowElement = state.elements.arrow;
	  var popperOffsets = state.modifiersData.popperOffsets;
	  var basePlacement = getBasePlacement(state.placement);
	  var axis = getMainAxisFromPlacement(basePlacement);
	  var isVertical = [left, right].indexOf(basePlacement) >= 0;
	  var len = isVertical ? 'height' : 'width';

	  if (!arrowElement || !popperOffsets) {
	    return;
	  }

	  var paddingObject = toPaddingObject(options.padding, state);
	  var arrowRect = getLayoutRect(arrowElement);
	  var minProp = axis === 'y' ? top : left;
	  var maxProp = axis === 'y' ? bottom : right;
	  var endDiff = state.rects.reference[len] + state.rects.reference[axis] - popperOffsets[axis] - state.rects.popper[len];
	  var startDiff = popperOffsets[axis] - state.rects.reference[axis];
	  var arrowOffsetParent = getOffsetParent(arrowElement);
	  var clientSize = arrowOffsetParent ? axis === 'y' ? arrowOffsetParent.clientHeight || 0 : arrowOffsetParent.clientWidth || 0 : 0;
	  var centerToReference = endDiff / 2 - startDiff / 2; // Make sure the arrow doesn't overflow the popper if the center point is
	  // outside of the popper bounds

	  var min = paddingObject[minProp];
	  var max = clientSize - arrowRect[len] - paddingObject[maxProp];
	  var center = clientSize / 2 - arrowRect[len] / 2 + centerToReference;
	  var offset = within(min, center, max); // Prevents breaking syntax highlighting...

	  var axisProp = axis;
	  state.modifiersData[name] = (_state$modifiersData$ = {}, _state$modifiersData$[axisProp] = offset, _state$modifiersData$.centerOffset = offset - center, _state$modifiersData$);
	}

	function effect$1(_ref2) {
	  var state = _ref2.state,
	      options = _ref2.options;
	  var _options$element = options.element,
	      arrowElement = _options$element === void 0 ? '[data-popper-arrow]' : _options$element;

	  if (arrowElement == null) {
	    return;
	  } // CSS selector


	  if (typeof arrowElement === 'string') {
	    arrowElement = state.elements.popper.querySelector(arrowElement);

	    if (!arrowElement) {
	      return;
	    }
	  }

	  if (!contains(state.elements.popper, arrowElement)) {

	    return;
	  }

	  state.elements.arrow = arrowElement;
	} // eslint-disable-next-line import/no-unused-modules


	var arrow$1 = {
	  name: 'arrow',
	  enabled: true,
	  phase: 'main',
	  fn: arrow,
	  effect: effect$1,
	  requires: ['popperOffsets'],
	  requiresIfExists: ['preventOverflow']
	};

	function getVariation(placement) {
	  return placement.split('-')[1];
	}

	var unsetSides = {
	  top: 'auto',
	  right: 'auto',
	  bottom: 'auto',
	  left: 'auto'
	}; // Round the offsets to the nearest suitable subpixel based on the DPR.
	// Zooming can change the DPR, but it seems to report a value that will
	// cleanly divide the values into the appropriate subpixels.

	function roundOffsetsByDPR(_ref) {
	  var x = _ref.x,
	      y = _ref.y;
	  var win = window;
	  var dpr = win.devicePixelRatio || 1;
	  return {
	    x: round(x * dpr) / dpr || 0,
	    y: round(y * dpr) / dpr || 0
	  };
	}

	function mapToStyles(_ref2) {
	  var _Object$assign2;

	  var popper = _ref2.popper,
	      popperRect = _ref2.popperRect,
	      placement = _ref2.placement,
	      variation = _ref2.variation,
	      offsets = _ref2.offsets,
	      position = _ref2.position,
	      gpuAcceleration = _ref2.gpuAcceleration,
	      adaptive = _ref2.adaptive,
	      roundOffsets = _ref2.roundOffsets,
	      isFixed = _ref2.isFixed;
	  var _offsets$x = offsets.x,
	      x = _offsets$x === void 0 ? 0 : _offsets$x,
	      _offsets$y = offsets.y,
	      y = _offsets$y === void 0 ? 0 : _offsets$y;

	  var _ref3 = typeof roundOffsets === 'function' ? roundOffsets({
	    x: x,
	    y: y
	  }) : {
	    x: x,
	    y: y
	  };

	  x = _ref3.x;
	  y = _ref3.y;
	  var hasX = offsets.hasOwnProperty('x');
	  var hasY = offsets.hasOwnProperty('y');
	  var sideX = left;
	  var sideY = top;
	  var win = window;

	  if (adaptive) {
	    var offsetParent = getOffsetParent(popper);
	    var heightProp = 'clientHeight';
	    var widthProp = 'clientWidth';

	    if (offsetParent === getWindow(popper)) {
	      offsetParent = getDocumentElement(popper);

	      if (getComputedStyle$1(offsetParent).position !== 'static' && position === 'absolute') {
	        heightProp = 'scrollHeight';
	        widthProp = 'scrollWidth';
	      }
	    } // $FlowFixMe[incompatible-cast]: force type refinement, we compare offsetParent with window above, but Flow doesn't detect it


	    offsetParent = offsetParent;

	    if (placement === top || (placement === left || placement === right) && variation === end) {
	      sideY = bottom;
	      var offsetY = isFixed && win.visualViewport ? win.visualViewport.height : // $FlowFixMe[prop-missing]
	      offsetParent[heightProp];
	      y -= offsetY - popperRect.height;
	      y *= gpuAcceleration ? 1 : -1;
	    }

	    if (placement === left || (placement === top || placement === bottom) && variation === end) {
	      sideX = right;
	      var offsetX = isFixed && win.visualViewport ? win.visualViewport.width : // $FlowFixMe[prop-missing]
	      offsetParent[widthProp];
	      x -= offsetX - popperRect.width;
	      x *= gpuAcceleration ? 1 : -1;
	    }
	  }

	  var commonStyles = Object.assign({
	    position: position
	  }, adaptive && unsetSides);

	  var _ref4 = roundOffsets === true ? roundOffsetsByDPR({
	    x: x,
	    y: y
	  }) : {
	    x: x,
	    y: y
	  };

	  x = _ref4.x;
	  y = _ref4.y;

	  if (gpuAcceleration) {
	    var _Object$assign;

	    return Object.assign({}, commonStyles, (_Object$assign = {}, _Object$assign[sideY] = hasY ? '0' : '', _Object$assign[sideX] = hasX ? '0' : '', _Object$assign.transform = (win.devicePixelRatio || 1) <= 1 ? "translate(" + x + "px, " + y + "px)" : "translate3d(" + x + "px, " + y + "px, 0)", _Object$assign));
	  }

	  return Object.assign({}, commonStyles, (_Object$assign2 = {}, _Object$assign2[sideY] = hasY ? y + "px" : '', _Object$assign2[sideX] = hasX ? x + "px" : '', _Object$assign2.transform = '', _Object$assign2));
	}

	function computeStyles(_ref5) {
	  var state = _ref5.state,
	      options = _ref5.options;
	  var _options$gpuAccelerat = options.gpuAcceleration,
	      gpuAcceleration = _options$gpuAccelerat === void 0 ? true : _options$gpuAccelerat,
	      _options$adaptive = options.adaptive,
	      adaptive = _options$adaptive === void 0 ? true : _options$adaptive,
	      _options$roundOffsets = options.roundOffsets,
	      roundOffsets = _options$roundOffsets === void 0 ? true : _options$roundOffsets;

	  var commonStyles = {
	    placement: getBasePlacement(state.placement),
	    variation: getVariation(state.placement),
	    popper: state.elements.popper,
	    popperRect: state.rects.popper,
	    gpuAcceleration: gpuAcceleration,
	    isFixed: state.options.strategy === 'fixed'
	  };

	  if (state.modifiersData.popperOffsets != null) {
	    state.styles.popper = Object.assign({}, state.styles.popper, mapToStyles(Object.assign({}, commonStyles, {
	      offsets: state.modifiersData.popperOffsets,
	      position: state.options.strategy,
	      adaptive: adaptive,
	      roundOffsets: roundOffsets
	    })));
	  }

	  if (state.modifiersData.arrow != null) {
	    state.styles.arrow = Object.assign({}, state.styles.arrow, mapToStyles(Object.assign({}, commonStyles, {
	      offsets: state.modifiersData.arrow,
	      position: 'absolute',
	      adaptive: false,
	      roundOffsets: roundOffsets
	    })));
	  }

	  state.attributes.popper = Object.assign({}, state.attributes.popper, {
	    'data-popper-placement': state.placement
	  });
	} // eslint-disable-next-line import/no-unused-modules


	var computeStyles$1 = {
	  name: 'computeStyles',
	  enabled: true,
	  phase: 'beforeWrite',
	  fn: computeStyles,
	  data: {}
	};

	var passive = {
	  passive: true
	};

	function effect(_ref) {
	  var state = _ref.state,
	      instance = _ref.instance,
	      options = _ref.options;
	  var _options$scroll = options.scroll,
	      scroll = _options$scroll === void 0 ? true : _options$scroll,
	      _options$resize = options.resize,
	      resize = _options$resize === void 0 ? true : _options$resize;
	  var window = getWindow(state.elements.popper);
	  var scrollParents = [].concat(state.scrollParents.reference, state.scrollParents.popper);

	  if (scroll) {
	    scrollParents.forEach(function (scrollParent) {
	      scrollParent.addEventListener('scroll', instance.update, passive);
	    });
	  }

	  if (resize) {
	    window.addEventListener('resize', instance.update, passive);
	  }

	  return function () {
	    if (scroll) {
	      scrollParents.forEach(function (scrollParent) {
	        scrollParent.removeEventListener('scroll', instance.update, passive);
	      });
	    }

	    if (resize) {
	      window.removeEventListener('resize', instance.update, passive);
	    }
	  };
	} // eslint-disable-next-line import/no-unused-modules


	var eventListeners = {
	  name: 'eventListeners',
	  enabled: true,
	  phase: 'write',
	  fn: function fn() {},
	  effect: effect,
	  data: {}
	};

	var hash$1 = {
	  left: 'right',
	  right: 'left',
	  bottom: 'top',
	  top: 'bottom'
	};
	function getOppositePlacement(placement) {
	  return placement.replace(/left|right|bottom|top/g, function (matched) {
	    return hash$1[matched];
	  });
	}

	var hash = {
	  start: 'end',
	  end: 'start'
	};
	function getOppositeVariationPlacement(placement) {
	  return placement.replace(/start|end/g, function (matched) {
	    return hash[matched];
	  });
	}

	function getWindowScroll(node) {
	  var win = getWindow(node);
	  var scrollLeft = win.pageXOffset;
	  var scrollTop = win.pageYOffset;
	  return {
	    scrollLeft: scrollLeft,
	    scrollTop: scrollTop
	  };
	}

	function getWindowScrollBarX(element) {
	  // If <html> has a CSS width greater than the viewport, then this will be
	  // incorrect for RTL.
	  // Popper 1 is broken in this case and never had a bug report so let's assume
	  // it's not an issue. I don't think anyone ever specifies width on <html>
	  // anyway.
	  // Browsers where the left scrollbar doesn't cause an issue report `0` for
	  // this (e.g. Edge 2019, IE11, Safari)
	  return getBoundingClientRect(getDocumentElement(element)).left + getWindowScroll(element).scrollLeft;
	}

	function getViewportRect(element) {
	  var win = getWindow(element);
	  var html = getDocumentElement(element);
	  var visualViewport = win.visualViewport;
	  var width = html.clientWidth;
	  var height = html.clientHeight;
	  var x = 0;
	  var y = 0; // NB: This isn't supported on iOS <= 12. If the keyboard is open, the popper
	  // can be obscured underneath it.
	  // Also, `html.clientHeight` adds the bottom bar height in Safari iOS, even
	  // if it isn't open, so if this isn't available, the popper will be detected
	  // to overflow the bottom of the screen too early.

	  if (visualViewport) {
	    width = visualViewport.width;
	    height = visualViewport.height; // Uses Layout Viewport (like Chrome; Safari does not currently)
	    // In Chrome, it returns a value very close to 0 (+/-) but contains rounding
	    // errors due to floating point numbers, so we need to check precision.
	    // Safari returns a number <= 0, usually < -1 when pinch-zoomed
	    // Feature detection fails in mobile emulation mode in Chrome.
	    // Math.abs(win.innerWidth / visualViewport.scale - visualViewport.width) <
	    // 0.001
	    // Fallback here: "Not Safari" userAgent

	    if (!/^((?!chrome|android).)*safari/i.test(navigator.userAgent)) {
	      x = visualViewport.offsetLeft;
	      y = visualViewport.offsetTop;
	    }
	  }

	  return {
	    width: width,
	    height: height,
	    x: x + getWindowScrollBarX(element),
	    y: y
	  };
	}

	// of the `<html>` and `<body>` rect bounds if horizontally scrollable

	function getDocumentRect(element) {
	  var _element$ownerDocumen;

	  var html = getDocumentElement(element);
	  var winScroll = getWindowScroll(element);
	  var body = (_element$ownerDocumen = element.ownerDocument) == null ? void 0 : _element$ownerDocumen.body;
	  var width = max(html.scrollWidth, html.clientWidth, body ? body.scrollWidth : 0, body ? body.clientWidth : 0);
	  var height = max(html.scrollHeight, html.clientHeight, body ? body.scrollHeight : 0, body ? body.clientHeight : 0);
	  var x = -winScroll.scrollLeft + getWindowScrollBarX(element);
	  var y = -winScroll.scrollTop;

	  if (getComputedStyle$1(body || html).direction === 'rtl') {
	    x += max(html.clientWidth, body ? body.clientWidth : 0) - width;
	  }

	  return {
	    width: width,
	    height: height,
	    x: x,
	    y: y
	  };
	}

	function isScrollParent(element) {
	  // Firefox wants us to check `-x` and `-y` variations as well
	  var _getComputedStyle = getComputedStyle$1(element),
	      overflow = _getComputedStyle.overflow,
	      overflowX = _getComputedStyle.overflowX,
	      overflowY = _getComputedStyle.overflowY;

	  return /auto|scroll|overlay|hidden/.test(overflow + overflowY + overflowX);
	}

	function getScrollParent(node) {
	  if (['html', 'body', '#document'].indexOf(getNodeName(node)) >= 0) {
	    // $FlowFixMe[incompatible-return]: assume body is always available
	    return node.ownerDocument.body;
	  }

	  if (isHTMLElement(node) && isScrollParent(node)) {
	    return node;
	  }

	  return getScrollParent(getParentNode(node));
	}

	/*
	given a DOM element, return the list of all scroll parents, up the list of ancesors
	until we get to the top window object. This list is what we attach scroll listeners
	to, because if any of these parent elements scroll, we'll need to re-calculate the
	reference element's position.
	*/

	function listScrollParents(element, list) {
	  var _element$ownerDocumen;

	  if (list === void 0) {
	    list = [];
	  }

	  var scrollParent = getScrollParent(element);
	  var isBody = scrollParent === ((_element$ownerDocumen = element.ownerDocument) == null ? void 0 : _element$ownerDocumen.body);
	  var win = getWindow(scrollParent);
	  var target = isBody ? [win].concat(win.visualViewport || [], isScrollParent(scrollParent) ? scrollParent : []) : scrollParent;
	  var updatedList = list.concat(target);
	  return isBody ? updatedList : // $FlowFixMe[incompatible-call]: isBody tells us target will be an HTMLElement here
	  updatedList.concat(listScrollParents(getParentNode(target)));
	}

	function rectToClientRect(rect) {
	  return Object.assign({}, rect, {
	    left: rect.x,
	    top: rect.y,
	    right: rect.x + rect.width,
	    bottom: rect.y + rect.height
	  });
	}

	function getInnerBoundingClientRect(element) {
	  var rect = getBoundingClientRect(element);
	  rect.top = rect.top + element.clientTop;
	  rect.left = rect.left + element.clientLeft;
	  rect.bottom = rect.top + element.clientHeight;
	  rect.right = rect.left + element.clientWidth;
	  rect.width = element.clientWidth;
	  rect.height = element.clientHeight;
	  rect.x = rect.left;
	  rect.y = rect.top;
	  return rect;
	}

	function getClientRectFromMixedType(element, clippingParent) {
	  return clippingParent === viewport ? rectToClientRect(getViewportRect(element)) : isElement(clippingParent) ? getInnerBoundingClientRect(clippingParent) : rectToClientRect(getDocumentRect(getDocumentElement(element)));
	} // A "clipping parent" is an overflowable container with the characteristic of
	// clipping (or hiding) overflowing elements with a position different from
	// `initial`


	function getClippingParents(element) {
	  var clippingParents = listScrollParents(getParentNode(element));
	  var canEscapeClipping = ['absolute', 'fixed'].indexOf(getComputedStyle$1(element).position) >= 0;
	  var clipperElement = canEscapeClipping && isHTMLElement(element) ? getOffsetParent(element) : element;

	  if (!isElement(clipperElement)) {
	    return [];
	  } // $FlowFixMe[incompatible-return]: https://github.com/facebook/flow/issues/1414


	  return clippingParents.filter(function (clippingParent) {
	    return isElement(clippingParent) && contains(clippingParent, clipperElement) && getNodeName(clippingParent) !== 'body';
	  });
	} // Gets the maximum area that the element is visible in due to any number of
	// clipping parents


	function getClippingRect(element, boundary, rootBoundary) {
	  var mainClippingParents = boundary === 'clippingParents' ? getClippingParents(element) : [].concat(boundary);
	  var clippingParents = [].concat(mainClippingParents, [rootBoundary]);
	  var firstClippingParent = clippingParents[0];
	  var clippingRect = clippingParents.reduce(function (accRect, clippingParent) {
	    var rect = getClientRectFromMixedType(element, clippingParent);
	    accRect.top = max(rect.top, accRect.top);
	    accRect.right = min(rect.right, accRect.right);
	    accRect.bottom = min(rect.bottom, accRect.bottom);
	    accRect.left = max(rect.left, accRect.left);
	    return accRect;
	  }, getClientRectFromMixedType(element, firstClippingParent));
	  clippingRect.width = clippingRect.right - clippingRect.left;
	  clippingRect.height = clippingRect.bottom - clippingRect.top;
	  clippingRect.x = clippingRect.left;
	  clippingRect.y = clippingRect.top;
	  return clippingRect;
	}

	function computeOffsets(_ref) {
	  var reference = _ref.reference,
	      element = _ref.element,
	      placement = _ref.placement;
	  var basePlacement = placement ? getBasePlacement(placement) : null;
	  var variation = placement ? getVariation(placement) : null;
	  var commonX = reference.x + reference.width / 2 - element.width / 2;
	  var commonY = reference.y + reference.height / 2 - element.height / 2;
	  var offsets;

	  switch (basePlacement) {
	    case top:
	      offsets = {
	        x: commonX,
	        y: reference.y - element.height
	      };
	      break;

	    case bottom:
	      offsets = {
	        x: commonX,
	        y: reference.y + reference.height
	      };
	      break;

	    case right:
	      offsets = {
	        x: reference.x + reference.width,
	        y: commonY
	      };
	      break;

	    case left:
	      offsets = {
	        x: reference.x - element.width,
	        y: commonY
	      };
	      break;

	    default:
	      offsets = {
	        x: reference.x,
	        y: reference.y
	      };
	  }

	  var mainAxis = basePlacement ? getMainAxisFromPlacement(basePlacement) : null;

	  if (mainAxis != null) {
	    var len = mainAxis === 'y' ? 'height' : 'width';

	    switch (variation) {
	      case start:
	        offsets[mainAxis] = offsets[mainAxis] - (reference[len] / 2 - element[len] / 2);
	        break;

	      case end:
	        offsets[mainAxis] = offsets[mainAxis] + (reference[len] / 2 - element[len] / 2);
	        break;
	    }
	  }

	  return offsets;
	}

	function detectOverflow(state, options) {
	  if (options === void 0) {
	    options = {};
	  }

	  var _options = options,
	      _options$placement = _options.placement,
	      placement = _options$placement === void 0 ? state.placement : _options$placement,
	      _options$boundary = _options.boundary,
	      boundary = _options$boundary === void 0 ? clippingParents : _options$boundary,
	      _options$rootBoundary = _options.rootBoundary,
	      rootBoundary = _options$rootBoundary === void 0 ? viewport : _options$rootBoundary,
	      _options$elementConte = _options.elementContext,
	      elementContext = _options$elementConte === void 0 ? popper : _options$elementConte,
	      _options$altBoundary = _options.altBoundary,
	      altBoundary = _options$altBoundary === void 0 ? false : _options$altBoundary,
	      _options$padding = _options.padding,
	      padding = _options$padding === void 0 ? 0 : _options$padding;
	  var paddingObject = mergePaddingObject(typeof padding !== 'number' ? padding : expandToHashMap(padding, basePlacements));
	  var altContext = elementContext === popper ? reference : popper;
	  var popperRect = state.rects.popper;
	  var element = state.elements[altBoundary ? altContext : elementContext];
	  var clippingClientRect = getClippingRect(isElement(element) ? element : element.contextElement || getDocumentElement(state.elements.popper), boundary, rootBoundary);
	  var referenceClientRect = getBoundingClientRect(state.elements.reference);
	  var popperOffsets = computeOffsets({
	    reference: referenceClientRect,
	    element: popperRect,
	    strategy: 'absolute',
	    placement: placement
	  });
	  var popperClientRect = rectToClientRect(Object.assign({}, popperRect, popperOffsets));
	  var elementClientRect = elementContext === popper ? popperClientRect : referenceClientRect; // positive = overflowing the clipping rect
	  // 0 or negative = within the clipping rect

	  var overflowOffsets = {
	    top: clippingClientRect.top - elementClientRect.top + paddingObject.top,
	    bottom: elementClientRect.bottom - clippingClientRect.bottom + paddingObject.bottom,
	    left: clippingClientRect.left - elementClientRect.left + paddingObject.left,
	    right: elementClientRect.right - clippingClientRect.right + paddingObject.right
	  };
	  var offsetData = state.modifiersData.offset; // Offsets can be applied only to the popper element

	  if (elementContext === popper && offsetData) {
	    var offset = offsetData[placement];
	    Object.keys(overflowOffsets).forEach(function (key) {
	      var multiply = [right, bottom].indexOf(key) >= 0 ? 1 : -1;
	      var axis = [top, bottom].indexOf(key) >= 0 ? 'y' : 'x';
	      overflowOffsets[key] += offset[axis] * multiply;
	    });
	  }

	  return overflowOffsets;
	}

	function computeAutoPlacement(state, options) {
	  if (options === void 0) {
	    options = {};
	  }

	  var _options = options,
	      placement = _options.placement,
	      boundary = _options.boundary,
	      rootBoundary = _options.rootBoundary,
	      padding = _options.padding,
	      flipVariations = _options.flipVariations,
	      _options$allowedAutoP = _options.allowedAutoPlacements,
	      allowedAutoPlacements = _options$allowedAutoP === void 0 ? placements : _options$allowedAutoP;
	  var variation = getVariation(placement);
	  var placements$1 = variation ? flipVariations ? variationPlacements : variationPlacements.filter(function (placement) {
	    return getVariation(placement) === variation;
	  }) : basePlacements;
	  var allowedPlacements = placements$1.filter(function (placement) {
	    return allowedAutoPlacements.indexOf(placement) >= 0;
	  });

	  if (allowedPlacements.length === 0) {
	    allowedPlacements = placements$1;
	  } // $FlowFixMe[incompatible-type]: Flow seems to have problems with two array unions...


	  var overflows = allowedPlacements.reduce(function (acc, placement) {
	    acc[placement] = detectOverflow(state, {
	      placement: placement,
	      boundary: boundary,
	      rootBoundary: rootBoundary,
	      padding: padding
	    })[getBasePlacement(placement)];
	    return acc;
	  }, {});
	  return Object.keys(overflows).sort(function (a, b) {
	    return overflows[a] - overflows[b];
	  });
	}

	function getExpandedFallbackPlacements(placement) {
	  if (getBasePlacement(placement) === auto) {
	    return [];
	  }

	  var oppositePlacement = getOppositePlacement(placement);
	  return [getOppositeVariationPlacement(placement), oppositePlacement, getOppositeVariationPlacement(oppositePlacement)];
	}

	function flip(_ref) {
	  var state = _ref.state,
	      options = _ref.options,
	      name = _ref.name;

	  if (state.modifiersData[name]._skip) {
	    return;
	  }

	  var _options$mainAxis = options.mainAxis,
	      checkMainAxis = _options$mainAxis === void 0 ? true : _options$mainAxis,
	      _options$altAxis = options.altAxis,
	      checkAltAxis = _options$altAxis === void 0 ? true : _options$altAxis,
	      specifiedFallbackPlacements = options.fallbackPlacements,
	      padding = options.padding,
	      boundary = options.boundary,
	      rootBoundary = options.rootBoundary,
	      altBoundary = options.altBoundary,
	      _options$flipVariatio = options.flipVariations,
	      flipVariations = _options$flipVariatio === void 0 ? true : _options$flipVariatio,
	      allowedAutoPlacements = options.allowedAutoPlacements;
	  var preferredPlacement = state.options.placement;
	  var basePlacement = getBasePlacement(preferredPlacement);
	  var isBasePlacement = basePlacement === preferredPlacement;
	  var fallbackPlacements = specifiedFallbackPlacements || (isBasePlacement || !flipVariations ? [getOppositePlacement(preferredPlacement)] : getExpandedFallbackPlacements(preferredPlacement));
	  var placements = [preferredPlacement].concat(fallbackPlacements).reduce(function (acc, placement) {
	    return acc.concat(getBasePlacement(placement) === auto ? computeAutoPlacement(state, {
	      placement: placement,
	      boundary: boundary,
	      rootBoundary: rootBoundary,
	      padding: padding,
	      flipVariations: flipVariations,
	      allowedAutoPlacements: allowedAutoPlacements
	    }) : placement);
	  }, []);
	  var referenceRect = state.rects.reference;
	  var popperRect = state.rects.popper;
	  var checksMap = new Map();
	  var makeFallbackChecks = true;
	  var firstFittingPlacement = placements[0];

	  for (var i = 0; i < placements.length; i++) {
	    var placement = placements[i];

	    var _basePlacement = getBasePlacement(placement);

	    var isStartVariation = getVariation(placement) === start;
	    var isVertical = [top, bottom].indexOf(_basePlacement) >= 0;
	    var len = isVertical ? 'width' : 'height';
	    var overflow = detectOverflow(state, {
	      placement: placement,
	      boundary: boundary,
	      rootBoundary: rootBoundary,
	      altBoundary: altBoundary,
	      padding: padding
	    });
	    var mainVariationSide = isVertical ? isStartVariation ? right : left : isStartVariation ? bottom : top;

	    if (referenceRect[len] > popperRect[len]) {
	      mainVariationSide = getOppositePlacement(mainVariationSide);
	    }

	    var altVariationSide = getOppositePlacement(mainVariationSide);
	    var checks = [];

	    if (checkMainAxis) {
	      checks.push(overflow[_basePlacement] <= 0);
	    }

	    if (checkAltAxis) {
	      checks.push(overflow[mainVariationSide] <= 0, overflow[altVariationSide] <= 0);
	    }

	    if (checks.every(function (check) {
	      return check;
	    })) {
	      firstFittingPlacement = placement;
	      makeFallbackChecks = false;
	      break;
	    }

	    checksMap.set(placement, checks);
	  }

	  if (makeFallbackChecks) {
	    // `2` may be desired in some cases – research later
	    var numberOfChecks = flipVariations ? 3 : 1;

	    var _loop = function _loop(_i) {
	      var fittingPlacement = placements.find(function (placement) {
	        var checks = checksMap.get(placement);

	        if (checks) {
	          return checks.slice(0, _i).every(function (check) {
	            return check;
	          });
	        }
	      });

	      if (fittingPlacement) {
	        firstFittingPlacement = fittingPlacement;
	        return "break";
	      }
	    };

	    for (var _i = numberOfChecks; _i > 0; _i--) {
	      var _ret = _loop(_i);

	      if (_ret === "break") break;
	    }
	  }

	  if (state.placement !== firstFittingPlacement) {
	    state.modifiersData[name]._skip = true;
	    state.placement = firstFittingPlacement;
	    state.reset = true;
	  }
	} // eslint-disable-next-line import/no-unused-modules


	var flip$1 = {
	  name: 'flip',
	  enabled: true,
	  phase: 'main',
	  fn: flip,
	  requiresIfExists: ['offset'],
	  data: {
	    _skip: false
	  }
	};

	function getSideOffsets(overflow, rect, preventedOffsets) {
	  if (preventedOffsets === void 0) {
	    preventedOffsets = {
	      x: 0,
	      y: 0
	    };
	  }

	  return {
	    top: overflow.top - rect.height - preventedOffsets.y,
	    right: overflow.right - rect.width + preventedOffsets.x,
	    bottom: overflow.bottom - rect.height + preventedOffsets.y,
	    left: overflow.left - rect.width - preventedOffsets.x
	  };
	}

	function isAnySideFullyClipped(overflow) {
	  return [top, right, bottom, left].some(function (side) {
	    return overflow[side] >= 0;
	  });
	}

	function hide(_ref) {
	  var state = _ref.state,
	      name = _ref.name;
	  var referenceRect = state.rects.reference;
	  var popperRect = state.rects.popper;
	  var preventedOffsets = state.modifiersData.preventOverflow;
	  var referenceOverflow = detectOverflow(state, {
	    elementContext: 'reference'
	  });
	  var popperAltOverflow = detectOverflow(state, {
	    altBoundary: true
	  });
	  var referenceClippingOffsets = getSideOffsets(referenceOverflow, referenceRect);
	  var popperEscapeOffsets = getSideOffsets(popperAltOverflow, popperRect, preventedOffsets);
	  var isReferenceHidden = isAnySideFullyClipped(referenceClippingOffsets);
	  var hasPopperEscaped = isAnySideFullyClipped(popperEscapeOffsets);
	  state.modifiersData[name] = {
	    referenceClippingOffsets: referenceClippingOffsets,
	    popperEscapeOffsets: popperEscapeOffsets,
	    isReferenceHidden: isReferenceHidden,
	    hasPopperEscaped: hasPopperEscaped
	  };
	  state.attributes.popper = Object.assign({}, state.attributes.popper, {
	    'data-popper-reference-hidden': isReferenceHidden,
	    'data-popper-escaped': hasPopperEscaped
	  });
	} // eslint-disable-next-line import/no-unused-modules


	var hide$1 = {
	  name: 'hide',
	  enabled: true,
	  phase: 'main',
	  requiresIfExists: ['preventOverflow'],
	  fn: hide
	};

	function distanceAndSkiddingToXY(placement, rects, offset) {
	  var basePlacement = getBasePlacement(placement);
	  var invertDistance = [left, top].indexOf(basePlacement) >= 0 ? -1 : 1;

	  var _ref = typeof offset === 'function' ? offset(Object.assign({}, rects, {
	    placement: placement
	  })) : offset,
	      skidding = _ref[0],
	      distance = _ref[1];

	  skidding = skidding || 0;
	  distance = (distance || 0) * invertDistance;
	  return [left, right].indexOf(basePlacement) >= 0 ? {
	    x: distance,
	    y: skidding
	  } : {
	    x: skidding,
	    y: distance
	  };
	}

	function offset(_ref2) {
	  var state = _ref2.state,
	      options = _ref2.options,
	      name = _ref2.name;
	  var _options$offset = options.offset,
	      offset = _options$offset === void 0 ? [0, 0] : _options$offset;
	  var data = placements.reduce(function (acc, placement) {
	    acc[placement] = distanceAndSkiddingToXY(placement, state.rects, offset);
	    return acc;
	  }, {});
	  var _data$state$placement = data[state.placement],
	      x = _data$state$placement.x,
	      y = _data$state$placement.y;

	  if (state.modifiersData.popperOffsets != null) {
	    state.modifiersData.popperOffsets.x += x;
	    state.modifiersData.popperOffsets.y += y;
	  }

	  state.modifiersData[name] = data;
	} // eslint-disable-next-line import/no-unused-modules


	var offset$1 = {
	  name: 'offset',
	  enabled: true,
	  phase: 'main',
	  requires: ['popperOffsets'],
	  fn: offset
	};

	function popperOffsets(_ref) {
	  var state = _ref.state,
	      name = _ref.name;
	  // Offsets are the actual position the popper needs to have to be
	  // properly positioned near its reference element
	  // This is the most basic placement, and will be adjusted by
	  // the modifiers in the next step
	  state.modifiersData[name] = computeOffsets({
	    reference: state.rects.reference,
	    element: state.rects.popper,
	    strategy: 'absolute',
	    placement: state.placement
	  });
	} // eslint-disable-next-line import/no-unused-modules


	var popperOffsets$1 = {
	  name: 'popperOffsets',
	  enabled: true,
	  phase: 'read',
	  fn: popperOffsets,
	  data: {}
	};

	function getAltAxis(axis) {
	  return axis === 'x' ? 'y' : 'x';
	}

	function preventOverflow(_ref) {
	  var state = _ref.state,
	      options = _ref.options,
	      name = _ref.name;
	  var _options$mainAxis = options.mainAxis,
	      checkMainAxis = _options$mainAxis === void 0 ? true : _options$mainAxis,
	      _options$altAxis = options.altAxis,
	      checkAltAxis = _options$altAxis === void 0 ? false : _options$altAxis,
	      boundary = options.boundary,
	      rootBoundary = options.rootBoundary,
	      altBoundary = options.altBoundary,
	      padding = options.padding,
	      _options$tether = options.tether,
	      tether = _options$tether === void 0 ? true : _options$tether,
	      _options$tetherOffset = options.tetherOffset,
	      tetherOffset = _options$tetherOffset === void 0 ? 0 : _options$tetherOffset;
	  var overflow = detectOverflow(state, {
	    boundary: boundary,
	    rootBoundary: rootBoundary,
	    padding: padding,
	    altBoundary: altBoundary
	  });
	  var basePlacement = getBasePlacement(state.placement);
	  var variation = getVariation(state.placement);
	  var isBasePlacement = !variation;
	  var mainAxis = getMainAxisFromPlacement(basePlacement);
	  var altAxis = getAltAxis(mainAxis);
	  var popperOffsets = state.modifiersData.popperOffsets;
	  var referenceRect = state.rects.reference;
	  var popperRect = state.rects.popper;
	  var tetherOffsetValue = typeof tetherOffset === 'function' ? tetherOffset(Object.assign({}, state.rects, {
	    placement: state.placement
	  })) : tetherOffset;
	  var normalizedTetherOffsetValue = typeof tetherOffsetValue === 'number' ? {
	    mainAxis: tetherOffsetValue,
	    altAxis: tetherOffsetValue
	  } : Object.assign({
	    mainAxis: 0,
	    altAxis: 0
	  }, tetherOffsetValue);
	  var offsetModifierState = state.modifiersData.offset ? state.modifiersData.offset[state.placement] : null;
	  var data = {
	    x: 0,
	    y: 0
	  };

	  if (!popperOffsets) {
	    return;
	  }

	  if (checkMainAxis) {
	    var _offsetModifierState$;

	    var mainSide = mainAxis === 'y' ? top : left;
	    var altSide = mainAxis === 'y' ? bottom : right;
	    var len = mainAxis === 'y' ? 'height' : 'width';
	    var offset = popperOffsets[mainAxis];
	    var min$1 = offset + overflow[mainSide];
	    var max$1 = offset - overflow[altSide];
	    var additive = tether ? -popperRect[len] / 2 : 0;
	    var minLen = variation === start ? referenceRect[len] : popperRect[len];
	    var maxLen = variation === start ? -popperRect[len] : -referenceRect[len]; // We need to include the arrow in the calculation so the arrow doesn't go
	    // outside the reference bounds

	    var arrowElement = state.elements.arrow;
	    var arrowRect = tether && arrowElement ? getLayoutRect(arrowElement) : {
	      width: 0,
	      height: 0
	    };
	    var arrowPaddingObject = state.modifiersData['arrow#persistent'] ? state.modifiersData['arrow#persistent'].padding : getFreshSideObject();
	    var arrowPaddingMin = arrowPaddingObject[mainSide];
	    var arrowPaddingMax = arrowPaddingObject[altSide]; // If the reference length is smaller than the arrow length, we don't want
	    // to include its full size in the calculation. If the reference is small
	    // and near the edge of a boundary, the popper can overflow even if the
	    // reference is not overflowing as well (e.g. virtual elements with no
	    // width or height)

	    var arrowLen = within(0, referenceRect[len], arrowRect[len]);
	    var minOffset = isBasePlacement ? referenceRect[len] / 2 - additive - arrowLen - arrowPaddingMin - normalizedTetherOffsetValue.mainAxis : minLen - arrowLen - arrowPaddingMin - normalizedTetherOffsetValue.mainAxis;
	    var maxOffset = isBasePlacement ? -referenceRect[len] / 2 + additive + arrowLen + arrowPaddingMax + normalizedTetherOffsetValue.mainAxis : maxLen + arrowLen + arrowPaddingMax + normalizedTetherOffsetValue.mainAxis;
	    var arrowOffsetParent = state.elements.arrow && getOffsetParent(state.elements.arrow);
	    var clientOffset = arrowOffsetParent ? mainAxis === 'y' ? arrowOffsetParent.clientTop || 0 : arrowOffsetParent.clientLeft || 0 : 0;
	    var offsetModifierValue = (_offsetModifierState$ = offsetModifierState == null ? void 0 : offsetModifierState[mainAxis]) != null ? _offsetModifierState$ : 0;
	    var tetherMin = offset + minOffset - offsetModifierValue - clientOffset;
	    var tetherMax = offset + maxOffset - offsetModifierValue;
	    var preventedOffset = within(tether ? min(min$1, tetherMin) : min$1, offset, tether ? max(max$1, tetherMax) : max$1);
	    popperOffsets[mainAxis] = preventedOffset;
	    data[mainAxis] = preventedOffset - offset;
	  }

	  if (checkAltAxis) {
	    var _offsetModifierState$2;

	    var _mainSide = mainAxis === 'x' ? top : left;

	    var _altSide = mainAxis === 'x' ? bottom : right;

	    var _offset = popperOffsets[altAxis];

	    var _len = altAxis === 'y' ? 'height' : 'width';

	    var _min = _offset + overflow[_mainSide];

	    var _max = _offset - overflow[_altSide];

	    var isOriginSide = [top, left].indexOf(basePlacement) !== -1;

	    var _offsetModifierValue = (_offsetModifierState$2 = offsetModifierState == null ? void 0 : offsetModifierState[altAxis]) != null ? _offsetModifierState$2 : 0;

	    var _tetherMin = isOriginSide ? _min : _offset - referenceRect[_len] - popperRect[_len] - _offsetModifierValue + normalizedTetherOffsetValue.altAxis;

	    var _tetherMax = isOriginSide ? _offset + referenceRect[_len] + popperRect[_len] - _offsetModifierValue - normalizedTetherOffsetValue.altAxis : _max;

	    var _preventedOffset = tether && isOriginSide ? withinMaxClamp(_tetherMin, _offset, _tetherMax) : within(tether ? _tetherMin : _min, _offset, tether ? _tetherMax : _max);

	    popperOffsets[altAxis] = _preventedOffset;
	    data[altAxis] = _preventedOffset - _offset;
	  }

	  state.modifiersData[name] = data;
	} // eslint-disable-next-line import/no-unused-modules


	var preventOverflow$1 = {
	  name: 'preventOverflow',
	  enabled: true,
	  phase: 'main',
	  fn: preventOverflow,
	  requiresIfExists: ['offset']
	};

	function getHTMLElementScroll(element) {
	  return {
	    scrollLeft: element.scrollLeft,
	    scrollTop: element.scrollTop
	  };
	}

	function getNodeScroll(node) {
	  if (node === getWindow(node) || !isHTMLElement(node)) {
	    return getWindowScroll(node);
	  } else {
	    return getHTMLElementScroll(node);
	  }
	}

	function isElementScaled(element) {
	  var rect = element.getBoundingClientRect();
	  var scaleX = round(rect.width) / element.offsetWidth || 1;
	  var scaleY = round(rect.height) / element.offsetHeight || 1;
	  return scaleX !== 1 || scaleY !== 1;
	} // Returns the composite rect of an element relative to its offsetParent.
	// Composite means it takes into account transforms as well as layout.


	function getCompositeRect(elementOrVirtualElement, offsetParent, isFixed) {
	  if (isFixed === void 0) {
	    isFixed = false;
	  }

	  var isOffsetParentAnElement = isHTMLElement(offsetParent);
	  var offsetParentIsScaled = isHTMLElement(offsetParent) && isElementScaled(offsetParent);
	  var documentElement = getDocumentElement(offsetParent);
	  var rect = getBoundingClientRect(elementOrVirtualElement, offsetParentIsScaled);
	  var scroll = {
	    scrollLeft: 0,
	    scrollTop: 0
	  };
	  var offsets = {
	    x: 0,
	    y: 0
	  };

	  if (isOffsetParentAnElement || !isOffsetParentAnElement && !isFixed) {
	    if (getNodeName(offsetParent) !== 'body' || // https://github.com/popperjs/popper-core/issues/1078
	    isScrollParent(documentElement)) {
	      scroll = getNodeScroll(offsetParent);
	    }

	    if (isHTMLElement(offsetParent)) {
	      offsets = getBoundingClientRect(offsetParent, true);
	      offsets.x += offsetParent.clientLeft;
	      offsets.y += offsetParent.clientTop;
	    } else if (documentElement) {
	      offsets.x = getWindowScrollBarX(documentElement);
	    }
	  }

	  return {
	    x: rect.left + scroll.scrollLeft - offsets.x,
	    y: rect.top + scroll.scrollTop - offsets.y,
	    width: rect.width,
	    height: rect.height
	  };
	}

	function order(modifiers) {
	  var map = new Map();
	  var visited = new Set();
	  var result = [];
	  modifiers.forEach(function (modifier) {
	    map.set(modifier.name, modifier);
	  }); // On visiting object, check for its dependencies and visit them recursively

	  function sort(modifier) {
	    visited.add(modifier.name);
	    var requires = [].concat(modifier.requires || [], modifier.requiresIfExists || []);
	    requires.forEach(function (dep) {
	      if (!visited.has(dep)) {
	        var depModifier = map.get(dep);

	        if (depModifier) {
	          sort(depModifier);
	        }
	      }
	    });
	    result.push(modifier);
	  }

	  modifiers.forEach(function (modifier) {
	    if (!visited.has(modifier.name)) {
	      // check for visited object
	      sort(modifier);
	    }
	  });
	  return result;
	}

	function orderModifiers(modifiers) {
	  // order based on dependencies
	  var orderedModifiers = order(modifiers); // order based on phase

	  return modifierPhases.reduce(function (acc, phase) {
	    return acc.concat(orderedModifiers.filter(function (modifier) {
	      return modifier.phase === phase;
	    }));
	  }, []);
	}

	function debounce(fn) {
	  var pending;
	  return function () {
	    if (!pending) {
	      pending = new Promise(function (resolve) {
	        Promise.resolve().then(function () {
	          pending = undefined;
	          resolve(fn());
	        });
	      });
	    }

	    return pending;
	  };
	}

	function mergeByName(modifiers) {
	  var merged = modifiers.reduce(function (merged, current) {
	    var existing = merged[current.name];
	    merged[current.name] = existing ? Object.assign({}, existing, current, {
	      options: Object.assign({}, existing.options, current.options),
	      data: Object.assign({}, existing.data, current.data)
	    }) : current;
	    return merged;
	  }, {}); // IE11 does not support Object.values

	  return Object.keys(merged).map(function (key) {
	    return merged[key];
	  });
	}

	var DEFAULT_OPTIONS = {
	  placement: 'bottom',
	  modifiers: [],
	  strategy: 'absolute'
	};

	function areValidElements() {
	  for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
	    args[_key] = arguments[_key];
	  }

	  return !args.some(function (element) {
	    return !(element && typeof element.getBoundingClientRect === 'function');
	  });
	}

	function popperGenerator(generatorOptions) {
	  if (generatorOptions === void 0) {
	    generatorOptions = {};
	  }

	  var _generatorOptions = generatorOptions,
	      _generatorOptions$def = _generatorOptions.defaultModifiers,
	      defaultModifiers = _generatorOptions$def === void 0 ? [] : _generatorOptions$def,
	      _generatorOptions$def2 = _generatorOptions.defaultOptions,
	      defaultOptions = _generatorOptions$def2 === void 0 ? DEFAULT_OPTIONS : _generatorOptions$def2;
	  return function createPopper(reference, popper, options) {
	    if (options === void 0) {
	      options = defaultOptions;
	    }

	    var state = {
	      placement: 'bottom',
	      orderedModifiers: [],
	      options: Object.assign({}, DEFAULT_OPTIONS, defaultOptions),
	      modifiersData: {},
	      elements: {
	        reference: reference,
	        popper: popper
	      },
	      attributes: {},
	      styles: {}
	    };
	    var effectCleanupFns = [];
	    var isDestroyed = false;
	    var instance = {
	      state: state,
	      setOptions: function setOptions(setOptionsAction) {
	        var options = typeof setOptionsAction === 'function' ? setOptionsAction(state.options) : setOptionsAction;
	        cleanupModifierEffects();
	        state.options = Object.assign({}, defaultOptions, state.options, options);
	        state.scrollParents = {
	          reference: isElement(reference) ? listScrollParents(reference) : reference.contextElement ? listScrollParents(reference.contextElement) : [],
	          popper: listScrollParents(popper)
	        }; // Orders the modifiers based on their dependencies and `phase`
	        // properties

	        var orderedModifiers = orderModifiers(mergeByName([].concat(defaultModifiers, state.options.modifiers))); // Strip out disabled modifiers

	        state.orderedModifiers = orderedModifiers.filter(function (m) {
	          return m.enabled;
	        }); // Validate the provided modifiers so that the consumer will get warned

	        runModifierEffects();
	        return instance.update();
	      },
	      // Sync update – it will always be executed, even if not necessary. This
	      // is useful for low frequency updates where sync behavior simplifies the
	      // logic.
	      // For high frequency updates (e.g. `resize` and `scroll` events), always
	      // prefer the async Popper#update method
	      forceUpdate: function forceUpdate() {
	        if (isDestroyed) {
	          return;
	        }

	        var _state$elements = state.elements,
	            reference = _state$elements.reference,
	            popper = _state$elements.popper; // Don't proceed if `reference` or `popper` are not valid elements
	        // anymore

	        if (!areValidElements(reference, popper)) {

	          return;
	        } // Store the reference and popper rects to be read by modifiers


	        state.rects = {
	          reference: getCompositeRect(reference, getOffsetParent(popper), state.options.strategy === 'fixed'),
	          popper: getLayoutRect(popper)
	        }; // Modifiers have the ability to reset the current update cycle. The
	        // most common use case for this is the `flip` modifier changing the
	        // placement, which then needs to re-run all the modifiers, because the
	        // logic was previously ran for the previous placement and is therefore
	        // stale/incorrect

	        state.reset = false;
	        state.placement = state.options.placement; // On each update cycle, the `modifiersData` property for each modifier
	        // is filled with the initial data specified by the modifier. This means
	        // it doesn't persist and is fresh on each update.
	        // To ensure persistent data, use `${name}#persistent`

	        state.orderedModifiers.forEach(function (modifier) {
	          return state.modifiersData[modifier.name] = Object.assign({}, modifier.data);
	        });

	        for (var index = 0; index < state.orderedModifiers.length; index++) {

	          if (state.reset === true) {
	            state.reset = false;
	            index = -1;
	            continue;
	          }

	          var _state$orderedModifie = state.orderedModifiers[index],
	              fn = _state$orderedModifie.fn,
	              _state$orderedModifie2 = _state$orderedModifie.options,
	              _options = _state$orderedModifie2 === void 0 ? {} : _state$orderedModifie2,
	              name = _state$orderedModifie.name;

	          if (typeof fn === 'function') {
	            state = fn({
	              state: state,
	              options: _options,
	              name: name,
	              instance: instance
	            }) || state;
	          }
	        }
	      },
	      // Async and optimistically optimized update – it will not be executed if
	      // not necessary (debounced to run at most once-per-tick)
	      update: debounce(function () {
	        return new Promise(function (resolve) {
	          instance.forceUpdate();
	          resolve(state);
	        });
	      }),
	      destroy: function destroy() {
	        cleanupModifierEffects();
	        isDestroyed = true;
	      }
	    };

	    if (!areValidElements(reference, popper)) {

	      return instance;
	    }

	    instance.setOptions(options).then(function (state) {
	      if (!isDestroyed && options.onFirstUpdate) {
	        options.onFirstUpdate(state);
	      }
	    }); // Modifiers have the ability to execute arbitrary code before the first
	    // update cycle runs. They will be executed in the same order as the update
	    // cycle. This is useful when a modifier adds some persistent data that
	    // other modifiers need to use, but the modifier is run after the dependent
	    // one.

	    function runModifierEffects() {
	      state.orderedModifiers.forEach(function (_ref3) {
	        var name = _ref3.name,
	            _ref3$options = _ref3.options,
	            options = _ref3$options === void 0 ? {} : _ref3$options,
	            effect = _ref3.effect;

	        if (typeof effect === 'function') {
	          var cleanupFn = effect({
	            state: state,
	            name: name,
	            instance: instance,
	            options: options
	          });

	          var noopFn = function noopFn() {};

	          effectCleanupFns.push(cleanupFn || noopFn);
	        }
	      });
	    }

	    function cleanupModifierEffects() {
	      effectCleanupFns.forEach(function (fn) {
	        return fn();
	      });
	      effectCleanupFns = [];
	    }

	    return instance;
	  };
	}
	var createPopper$2 = /*#__PURE__*/popperGenerator(); // eslint-disable-next-line import/no-unused-modules

	var defaultModifiers$1 = [eventListeners, popperOffsets$1, computeStyles$1, applyStyles$1];
	var createPopper$1 = /*#__PURE__*/popperGenerator({
	  defaultModifiers: defaultModifiers$1
	}); // eslint-disable-next-line import/no-unused-modules

	var defaultModifiers = [eventListeners, popperOffsets$1, computeStyles$1, applyStyles$1, offset$1, flip$1, preventOverflow$1, arrow$1, hide$1];
	var createPopper = /*#__PURE__*/popperGenerator({
	  defaultModifiers: defaultModifiers
	}); // eslint-disable-next-line import/no-unused-modules

	var lib = /*#__PURE__*/Object.freeze({
		__proto__: null,
		popperGenerator: popperGenerator,
		detectOverflow: detectOverflow,
		createPopperBase: createPopper$2,
		createPopper: createPopper,
		createPopperLite: createPopper$1,
		top: top,
		bottom: bottom,
		right: right,
		left: left,
		auto: auto,
		basePlacements: basePlacements,
		start: start,
		end: end,
		clippingParents: clippingParents,
		viewport: viewport,
		popper: popper,
		reference: reference,
		variationPlacements: variationPlacements,
		placements: placements,
		beforeRead: beforeRead,
		read: read,
		afterRead: afterRead,
		beforeMain: beforeMain,
		main: main,
		afterMain: afterMain,
		beforeWrite: beforeWrite,
		write: write,
		afterWrite: afterWrite,
		modifierPhases: modifierPhases,
		applyStyles: applyStyles$1,
		arrow: arrow$1,
		computeStyles: computeStyles$1,
		eventListeners: eventListeners,
		flip: flip$1,
		hide: hide$1,
		offset: offset$1,
		popperOffsets: popperOffsets$1,
		preventOverflow: preventOverflow$1
	});

	var require$$0 = /*@__PURE__*/getAugmentedNamespace(lib);

	/*!
	  * Bootstrap dropdown.js v5.1.3 (https://getbootstrap.com/)
	  * Copyright 2011-2021 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
	  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	  */

	(function (module, exports) {
	(function (global, factory) {
	  module.exports = factory(require$$0, eventHandler.exports, manipulator.exports, selectorEngine.exports, baseComponent.exports) ;
	})(commonjsGlobal, (function (Popper, EventHandler, Manipulator, SelectorEngine, BaseComponent) {
	  const _interopDefaultLegacy = e => e && typeof e === 'object' && 'default' in e ? e : { default: e };

	  function _interopNamespace(e) {
	    if (e && e.__esModule) return e;
	    const n = Object.create(null);
	    if (e) {
	      for (const k in e) {
	        if (k !== 'default') {
	          const d = Object.getOwnPropertyDescriptor(e, k);
	          Object.defineProperty(n, k, d.get ? d : {
	            enumerable: true,
	            get: () => e[k]
	          });
	        }
	      }
	    }
	    n.default = e;
	    return Object.freeze(n);
	  }

	  const Popper__namespace = /*#__PURE__*/_interopNamespace(Popper);
	  const EventHandler__default = /*#__PURE__*/_interopDefaultLegacy(EventHandler);
	  const Manipulator__default = /*#__PURE__*/_interopDefaultLegacy(Manipulator);
	  const SelectorEngine__default = /*#__PURE__*/_interopDefaultLegacy(SelectorEngine);
	  const BaseComponent__default = /*#__PURE__*/_interopDefaultLegacy(BaseComponent);

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/index.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */

	  const toType = obj => {
	    if (obj === null || obj === undefined) {
	      return `${obj}`;
	    }

	    return {}.toString.call(obj).match(/\s([a-z]+)/i)[1].toLowerCase();
	  };

	  const getSelector = element => {
	    let selector = element.getAttribute('data-bs-target');

	    if (!selector || selector === '#') {
	      let hrefAttr = element.getAttribute('href'); // The only valid content that could double as a selector are IDs or classes,
	      // so everything starting with `#` or `.`. If a "real" URL is used as the selector,
	      // `document.querySelector` will rightfully complain it is invalid.
	      // See https://github.com/twbs/bootstrap/issues/32273

	      if (!hrefAttr || !hrefAttr.includes('#') && !hrefAttr.startsWith('.')) {
	        return null;
	      } // Just in case some CMS puts out a full URL with the anchor appended


	      if (hrefAttr.includes('#') && !hrefAttr.startsWith('#')) {
	        hrefAttr = `#${hrefAttr.split('#')[1]}`;
	      }

	      selector = hrefAttr && hrefAttr !== '#' ? hrefAttr.trim() : null;
	    }

	    return selector;
	  };

	  const getElementFromSelector = element => {
	    const selector = getSelector(element);
	    return selector ? document.querySelector(selector) : null;
	  };

	  const isElement = obj => {
	    if (!obj || typeof obj !== 'object') {
	      return false;
	    }

	    if (typeof obj.jquery !== 'undefined') {
	      obj = obj[0];
	    }

	    return typeof obj.nodeType !== 'undefined';
	  };

	  const getElement = obj => {
	    if (isElement(obj)) {
	      // it's a jQuery object or a node element
	      return obj.jquery ? obj[0] : obj;
	    }

	    if (typeof obj === 'string' && obj.length > 0) {
	      return document.querySelector(obj);
	    }

	    return null;
	  };

	  const typeCheckConfig = (componentName, config, configTypes) => {
	    Object.keys(configTypes).forEach(property => {
	      const expectedTypes = configTypes[property];
	      const value = config[property];
	      const valueType = value && isElement(value) ? 'element' : toType(value);

	      if (!new RegExp(expectedTypes).test(valueType)) {
	        throw new TypeError(`${componentName.toUpperCase()}: Option "${property}" provided type "${valueType}" but expected type "${expectedTypes}".`);
	      }
	    });
	  };

	  const isVisible = element => {
	    if (!isElement(element) || element.getClientRects().length === 0) {
	      return false;
	    }

	    return getComputedStyle(element).getPropertyValue('visibility') === 'visible';
	  };

	  const isDisabled = element => {
	    if (!element || element.nodeType !== Node.ELEMENT_NODE) {
	      return true;
	    }

	    if (element.classList.contains('disabled')) {
	      return true;
	    }

	    if (typeof element.disabled !== 'undefined') {
	      return element.disabled;
	    }

	    return element.hasAttribute('disabled') && element.getAttribute('disabled') !== 'false';
	  };

	  const noop = () => {};

	  const getjQuery = () => {
	    const {
	      jQuery
	    } = window;

	    if (jQuery && !document.body.hasAttribute('data-bs-no-jquery')) {
	      return jQuery;
	    }

	    return null;
	  };

	  const DOMContentLoadedCallbacks = [];

	  const onDOMContentLoaded = callback => {
	    if (document.readyState === 'loading') {
	      // add listener on the first call when the document is in loading state
	      if (!DOMContentLoadedCallbacks.length) {
	        document.addEventListener('DOMContentLoaded', () => {
	          DOMContentLoadedCallbacks.forEach(callback => callback());
	        });
	      }

	      DOMContentLoadedCallbacks.push(callback);
	    } else {
	      callback();
	    }
	  };

	  const isRTL = () => document.documentElement.dir === 'rtl';

	  const defineJQueryPlugin = plugin => {
	    onDOMContentLoaded(() => {
	      const $ = getjQuery();
	      /* istanbul ignore if */

	      if ($) {
	        const name = plugin.NAME;
	        const JQUERY_NO_CONFLICT = $.fn[name];
	        $.fn[name] = plugin.jQueryInterface;
	        $.fn[name].Constructor = plugin;

	        $.fn[name].noConflict = () => {
	          $.fn[name] = JQUERY_NO_CONFLICT;
	          return plugin.jQueryInterface;
	        };
	      }
	    });
	  };
	  /**
	   * Return the previous/next element of a list.
	   *
	   * @param {array} list    The list of elements
	   * @param activeElement   The active element
	   * @param shouldGetNext   Choose to get next or previous element
	   * @param isCycleAllowed
	   * @return {Element|elem} The proper element
	   */


	  const getNextActiveElement = (list, activeElement, shouldGetNext, isCycleAllowed) => {
	    let index = list.indexOf(activeElement); // if the element does not exist in the list return an element depending on the direction and if cycle is allowed

	    if (index === -1) {
	      return list[!shouldGetNext && isCycleAllowed ? list.length - 1 : 0];
	    }

	    const listLength = list.length;
	    index += shouldGetNext ? 1 : -1;

	    if (isCycleAllowed) {
	      index = (index + listLength) % listLength;
	    }

	    return list[Math.max(0, Math.min(index, listLength - 1))];
	  };

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): dropdown.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  /**
	   * ------------------------------------------------------------------------
	   * Constants
	   * ------------------------------------------------------------------------
	   */

	  const NAME = 'dropdown';
	  const DATA_KEY = 'bs.dropdown';
	  const EVENT_KEY = `.${DATA_KEY}`;
	  const DATA_API_KEY = '.data-api';
	  const ESCAPE_KEY = 'Escape';
	  const SPACE_KEY = 'Space';
	  const TAB_KEY = 'Tab';
	  const ARROW_UP_KEY = 'ArrowUp';
	  const ARROW_DOWN_KEY = 'ArrowDown';
	  const RIGHT_MOUSE_BUTTON = 2; // MouseEvent.button value for the secondary button, usually the right button

	  const REGEXP_KEYDOWN = new RegExp(`${ARROW_UP_KEY}|${ARROW_DOWN_KEY}|${ESCAPE_KEY}`);
	  const EVENT_HIDE = `hide${EVENT_KEY}`;
	  const EVENT_HIDDEN = `hidden${EVENT_KEY}`;
	  const EVENT_SHOW = `show${EVENT_KEY}`;
	  const EVENT_SHOWN = `shown${EVENT_KEY}`;
	  const EVENT_CLICK_DATA_API = `click${EVENT_KEY}${DATA_API_KEY}`;
	  const EVENT_KEYDOWN_DATA_API = `keydown${EVENT_KEY}${DATA_API_KEY}`;
	  const EVENT_KEYUP_DATA_API = `keyup${EVENT_KEY}${DATA_API_KEY}`;
	  const CLASS_NAME_SHOW = 'show';
	  const CLASS_NAME_DROPUP = 'dropup';
	  const CLASS_NAME_DROPEND = 'dropend';
	  const CLASS_NAME_DROPSTART = 'dropstart';
	  const CLASS_NAME_NAVBAR = 'navbar';
	  const SELECTOR_DATA_TOGGLE = '[data-bs-toggle="dropdown"]';
	  const SELECTOR_MENU = '.dropdown-menu';
	  const SELECTOR_NAVBAR_NAV = '.navbar-nav';
	  const SELECTOR_VISIBLE_ITEMS = '.dropdown-menu .dropdown-item:not(.disabled):not(:disabled)';
	  const PLACEMENT_TOP = isRTL() ? 'top-end' : 'top-start';
	  const PLACEMENT_TOPEND = isRTL() ? 'top-start' : 'top-end';
	  const PLACEMENT_BOTTOM = isRTL() ? 'bottom-end' : 'bottom-start';
	  const PLACEMENT_BOTTOMEND = isRTL() ? 'bottom-start' : 'bottom-end';
	  const PLACEMENT_RIGHT = isRTL() ? 'left-start' : 'right-start';
	  const PLACEMENT_LEFT = isRTL() ? 'right-start' : 'left-start';
	  const Default = {
	    offset: [0, 2],
	    boundary: 'clippingParents',
	    reference: 'toggle',
	    display: 'dynamic',
	    popperConfig: null,
	    autoClose: true
	  };
	  const DefaultType = {
	    offset: '(array|string|function)',
	    boundary: '(string|element)',
	    reference: '(string|element|object)',
	    display: 'string',
	    popperConfig: '(null|object|function)',
	    autoClose: '(boolean|string)'
	  };
	  /**
	   * ------------------------------------------------------------------------
	   * Class Definition
	   * ------------------------------------------------------------------------
	   */

	  class Dropdown extends BaseComponent__default.default {
	    constructor(element, config) {
	      super(element);
	      this._popper = null;
	      this._config = this._getConfig(config);
	      this._menu = this._getMenuElement();
	      this._inNavbar = this._detectNavbar();
	    } // Getters


	    static get Default() {
	      return Default;
	    }

	    static get DefaultType() {
	      return DefaultType;
	    }

	    static get NAME() {
	      return NAME;
	    } // Public


	    toggle() {
	      return this._isShown() ? this.hide() : this.show();
	    }

	    show() {
	      if (isDisabled(this._element) || this._isShown(this._menu)) {
	        return;
	      }

	      const relatedTarget = {
	        relatedTarget: this._element
	      };
	      const showEvent = EventHandler__default.default.trigger(this._element, EVENT_SHOW, relatedTarget);

	      if (showEvent.defaultPrevented) {
	        return;
	      }

	      const parent = Dropdown.getParentFromElement(this._element); // Totally disable Popper for Dropdowns in Navbar

	      if (this._inNavbar) {
	        Manipulator__default.default.setDataAttribute(this._menu, 'popper', 'none');
	      } else {
	        this._createPopper(parent);
	      } // If this is a touch-enabled device we add extra
	      // empty mouseover listeners to the body's immediate children;
	      // only needed because of broken event delegation on iOS
	      // https://www.quirksmode.org/blog/archives/2014/02/mouse_event_bub.html


	      if ('ontouchstart' in document.documentElement && !parent.closest(SELECTOR_NAVBAR_NAV)) {
	        [].concat(...document.body.children).forEach(elem => EventHandler__default.default.on(elem, 'mouseover', noop));
	      }

	      this._element.focus();

	      this._element.setAttribute('aria-expanded', true);

	      this._menu.classList.add(CLASS_NAME_SHOW);

	      this._element.classList.add(CLASS_NAME_SHOW);

	      EventHandler__default.default.trigger(this._element, EVENT_SHOWN, relatedTarget);
	    }

	    hide() {
	      if (isDisabled(this._element) || !this._isShown(this._menu)) {
	        return;
	      }

	      const relatedTarget = {
	        relatedTarget: this._element
	      };

	      this._completeHide(relatedTarget);
	    }

	    dispose() {
	      if (this._popper) {
	        this._popper.destroy();
	      }

	      super.dispose();
	    }

	    update() {
	      this._inNavbar = this._detectNavbar();

	      if (this._popper) {
	        this._popper.update();
	      }
	    } // Private


	    _completeHide(relatedTarget) {
	      const hideEvent = EventHandler__default.default.trigger(this._element, EVENT_HIDE, relatedTarget);

	      if (hideEvent.defaultPrevented) {
	        return;
	      } // If this is a touch-enabled device we remove the extra
	      // empty mouseover listeners we added for iOS support


	      if ('ontouchstart' in document.documentElement) {
	        [].concat(...document.body.children).forEach(elem => EventHandler__default.default.off(elem, 'mouseover', noop));
	      }

	      if (this._popper) {
	        this._popper.destroy();
	      }

	      this._menu.classList.remove(CLASS_NAME_SHOW);

	      this._element.classList.remove(CLASS_NAME_SHOW);

	      this._element.setAttribute('aria-expanded', 'false');

	      Manipulator__default.default.removeDataAttribute(this._menu, 'popper');
	      EventHandler__default.default.trigger(this._element, EVENT_HIDDEN, relatedTarget);
	    }

	    _getConfig(config) {
	      config = { ...this.constructor.Default,
	        ...Manipulator__default.default.getDataAttributes(this._element),
	        ...config
	      };
	      typeCheckConfig(NAME, config, this.constructor.DefaultType);

	      if (typeof config.reference === 'object' && !isElement(config.reference) && typeof config.reference.getBoundingClientRect !== 'function') {
	        // Popper virtual elements require a getBoundingClientRect method
	        throw new TypeError(`${NAME.toUpperCase()}: Option "reference" provided type "object" without a required "getBoundingClientRect" method.`);
	      }

	      return config;
	    }

	    _createPopper(parent) {
	      if (typeof Popper__namespace === 'undefined') {
	        throw new TypeError('Bootstrap\'s dropdowns require Popper (https://popper.js.org)');
	      }

	      let referenceElement = this._element;

	      if (this._config.reference === 'parent') {
	        referenceElement = parent;
	      } else if (isElement(this._config.reference)) {
	        referenceElement = getElement(this._config.reference);
	      } else if (typeof this._config.reference === 'object') {
	        referenceElement = this._config.reference;
	      }

	      const popperConfig = this._getPopperConfig();

	      const isDisplayStatic = popperConfig.modifiers.find(modifier => modifier.name === 'applyStyles' && modifier.enabled === false);
	      this._popper = Popper__namespace.createPopper(referenceElement, this._menu, popperConfig);

	      if (isDisplayStatic) {
	        Manipulator__default.default.setDataAttribute(this._menu, 'popper', 'static');
	      }
	    }

	    _isShown(element = this._element) {
	      return element.classList.contains(CLASS_NAME_SHOW);
	    }

	    _getMenuElement() {
	      return SelectorEngine__default.default.next(this._element, SELECTOR_MENU)[0];
	    }

	    _getPlacement() {
	      const parentDropdown = this._element.parentNode;

	      if (parentDropdown.classList.contains(CLASS_NAME_DROPEND)) {
	        return PLACEMENT_RIGHT;
	      }

	      if (parentDropdown.classList.contains(CLASS_NAME_DROPSTART)) {
	        return PLACEMENT_LEFT;
	      } // We need to trim the value because custom properties can also include spaces


	      const isEnd = getComputedStyle(this._menu).getPropertyValue('--bs-position').trim() === 'end';

	      if (parentDropdown.classList.contains(CLASS_NAME_DROPUP)) {
	        return isEnd ? PLACEMENT_TOPEND : PLACEMENT_TOP;
	      }

	      return isEnd ? PLACEMENT_BOTTOMEND : PLACEMENT_BOTTOM;
	    }

	    _detectNavbar() {
	      return this._element.closest(`.${CLASS_NAME_NAVBAR}`) !== null;
	    }

	    _getOffset() {
	      const {
	        offset
	      } = this._config;

	      if (typeof offset === 'string') {
	        return offset.split(',').map(val => Number.parseInt(val, 10));
	      }

	      if (typeof offset === 'function') {
	        return popperData => offset(popperData, this._element);
	      }

	      return offset;
	    }

	    _getPopperConfig() {
	      const defaultBsPopperConfig = {
	        placement: this._getPlacement(),
	        modifiers: [{
	          name: 'preventOverflow',
	          options: {
	            boundary: this._config.boundary
	          }
	        }, {
	          name: 'offset',
	          options: {
	            offset: this._getOffset()
	          }
	        }]
	      }; // Disable Popper if we have a static display

	      if (this._config.display === 'static') {
	        defaultBsPopperConfig.modifiers = [{
	          name: 'applyStyles',
	          enabled: false
	        }];
	      }

	      return { ...defaultBsPopperConfig,
	        ...(typeof this._config.popperConfig === 'function' ? this._config.popperConfig(defaultBsPopperConfig) : this._config.popperConfig)
	      };
	    }

	    _selectMenuItem({
	      key,
	      target
	    }) {
	      const items = SelectorEngine__default.default.find(SELECTOR_VISIBLE_ITEMS, this._menu).filter(isVisible);

	      if (!items.length) {
	        return;
	      } // if target isn't included in items (e.g. when expanding the dropdown)
	      // allow cycling to get the last item in case key equals ARROW_UP_KEY


	      getNextActiveElement(items, target, key === ARROW_DOWN_KEY, !items.includes(target)).focus();
	    } // Static


	    static jQueryInterface(config) {
	      return this.each(function () {
	        const data = Dropdown.getOrCreateInstance(this, config);

	        if (typeof config !== 'string') {
	          return;
	        }

	        if (typeof data[config] === 'undefined') {
	          throw new TypeError(`No method named "${config}"`);
	        }

	        data[config]();
	      });
	    }

	    static clearMenus(event) {
	      if (event && (event.button === RIGHT_MOUSE_BUTTON || event.type === 'keyup' && event.key !== TAB_KEY)) {
	        return;
	      }

	      const toggles = SelectorEngine__default.default.find(SELECTOR_DATA_TOGGLE);

	      for (let i = 0, len = toggles.length; i < len; i++) {
	        const context = Dropdown.getInstance(toggles[i]);

	        if (!context || context._config.autoClose === false) {
	          continue;
	        }

	        if (!context._isShown()) {
	          continue;
	        }

	        const relatedTarget = {
	          relatedTarget: context._element
	        };

	        if (event) {
	          const composedPath = event.composedPath();
	          const isMenuTarget = composedPath.includes(context._menu);

	          if (composedPath.includes(context._element) || context._config.autoClose === 'inside' && !isMenuTarget || context._config.autoClose === 'outside' && isMenuTarget) {
	            continue;
	          } // Tab navigation through the dropdown menu or events from contained inputs shouldn't close the menu


	          if (context._menu.contains(event.target) && (event.type === 'keyup' && event.key === TAB_KEY || /input|select|option|textarea|form/i.test(event.target.tagName))) {
	            continue;
	          }

	          if (event.type === 'click') {
	            relatedTarget.clickEvent = event;
	          }
	        }

	        context._completeHide(relatedTarget);
	      }
	    }

	    static getParentFromElement(element) {
	      return getElementFromSelector(element) || element.parentNode;
	    }

	    static dataApiKeydownHandler(event) {
	      // If not input/textarea:
	      //  - And not a key in REGEXP_KEYDOWN => not a dropdown command
	      // If input/textarea:
	      //  - If space key => not a dropdown command
	      //  - If key is other than escape
	      //    - If key is not up or down => not a dropdown command
	      //    - If trigger inside the menu => not a dropdown command
	      if (/input|textarea/i.test(event.target.tagName) ? event.key === SPACE_KEY || event.key !== ESCAPE_KEY && (event.key !== ARROW_DOWN_KEY && event.key !== ARROW_UP_KEY || event.target.closest(SELECTOR_MENU)) : !REGEXP_KEYDOWN.test(event.key)) {
	        return;
	      }

	      const isActive = this.classList.contains(CLASS_NAME_SHOW);

	      if (!isActive && event.key === ESCAPE_KEY) {
	        return;
	      }

	      event.preventDefault();
	      event.stopPropagation();

	      if (isDisabled(this)) {
	        return;
	      }

	      const getToggleButton = this.matches(SELECTOR_DATA_TOGGLE) ? this : SelectorEngine__default.default.prev(this, SELECTOR_DATA_TOGGLE)[0];
	      const instance = Dropdown.getOrCreateInstance(getToggleButton);

	      if (event.key === ESCAPE_KEY) {
	        instance.hide();
	        return;
	      }

	      if (event.key === ARROW_UP_KEY || event.key === ARROW_DOWN_KEY) {
	        if (!isActive) {
	          instance.show();
	        }

	        instance._selectMenuItem(event);

	        return;
	      }

	      if (!isActive || event.key === SPACE_KEY) {
	        Dropdown.clearMenus();
	      }
	    }

	  }
	  /**
	   * ------------------------------------------------------------------------
	   * Data Api implementation
	   * ------------------------------------------------------------------------
	   */


	  EventHandler__default.default.on(document, EVENT_KEYDOWN_DATA_API, SELECTOR_DATA_TOGGLE, Dropdown.dataApiKeydownHandler);
	  EventHandler__default.default.on(document, EVENT_KEYDOWN_DATA_API, SELECTOR_MENU, Dropdown.dataApiKeydownHandler);
	  EventHandler__default.default.on(document, EVENT_CLICK_DATA_API, Dropdown.clearMenus);
	  EventHandler__default.default.on(document, EVENT_KEYUP_DATA_API, Dropdown.clearMenus);
	  EventHandler__default.default.on(document, EVENT_CLICK_DATA_API, SELECTOR_DATA_TOGGLE, function (event) {
	    event.preventDefault();
	    Dropdown.getOrCreateInstance(this).toggle();
	  });
	  /**
	   * ------------------------------------------------------------------------
	   * jQuery
	   * ------------------------------------------------------------------------
	   * add .Dropdown to jQuery only if jQuery is present
	   */

	  defineJQueryPlugin(Dropdown);

	  return Dropdown;

	}));

	}(dropdown$1));

	var dropdown = /*@__PURE__*/getDefaultExportFromCjs(dropdown$1.exports);

	var modal = {exports: {}};

	/*!
	  * Bootstrap modal.js v5.1.3 (https://getbootstrap.com/)
	  * Copyright 2011-2021 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
	  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	  */

	(function (module, exports) {
	(function (global, factory) {
	  module.exports = factory(eventHandler.exports, manipulator.exports, selectorEngine.exports, baseComponent.exports) ;
	})(commonjsGlobal, (function (EventHandler, Manipulator, SelectorEngine, BaseComponent) {
	  const _interopDefaultLegacy = e => e && typeof e === 'object' && 'default' in e ? e : { default: e };

	  const EventHandler__default = /*#__PURE__*/_interopDefaultLegacy(EventHandler);
	  const Manipulator__default = /*#__PURE__*/_interopDefaultLegacy(Manipulator);
	  const SelectorEngine__default = /*#__PURE__*/_interopDefaultLegacy(SelectorEngine);
	  const BaseComponent__default = /*#__PURE__*/_interopDefaultLegacy(BaseComponent);

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/index.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  const MILLISECONDS_MULTIPLIER = 1000;
	  const TRANSITION_END = 'transitionend'; // Shoutout AngusCroll (https://goo.gl/pxwQGp)

	  const toType = obj => {
	    if (obj === null || obj === undefined) {
	      return `${obj}`;
	    }

	    return {}.toString.call(obj).match(/\s([a-z]+)/i)[1].toLowerCase();
	  };

	  const getSelector = element => {
	    let selector = element.getAttribute('data-bs-target');

	    if (!selector || selector === '#') {
	      let hrefAttr = element.getAttribute('href'); // The only valid content that could double as a selector are IDs or classes,
	      // so everything starting with `#` or `.`. If a "real" URL is used as the selector,
	      // `document.querySelector` will rightfully complain it is invalid.
	      // See https://github.com/twbs/bootstrap/issues/32273

	      if (!hrefAttr || !hrefAttr.includes('#') && !hrefAttr.startsWith('.')) {
	        return null;
	      } // Just in case some CMS puts out a full URL with the anchor appended


	      if (hrefAttr.includes('#') && !hrefAttr.startsWith('#')) {
	        hrefAttr = `#${hrefAttr.split('#')[1]}`;
	      }

	      selector = hrefAttr && hrefAttr !== '#' ? hrefAttr.trim() : null;
	    }

	    return selector;
	  };

	  const getElementFromSelector = element => {
	    const selector = getSelector(element);
	    return selector ? document.querySelector(selector) : null;
	  };

	  const getTransitionDurationFromElement = element => {
	    if (!element) {
	      return 0;
	    } // Get transition-duration of the element


	    let {
	      transitionDuration,
	      transitionDelay
	    } = window.getComputedStyle(element);
	    const floatTransitionDuration = Number.parseFloat(transitionDuration);
	    const floatTransitionDelay = Number.parseFloat(transitionDelay); // Return 0 if element or transition duration is not found

	    if (!floatTransitionDuration && !floatTransitionDelay) {
	      return 0;
	    } // If multiple durations are defined, take the first


	    transitionDuration = transitionDuration.split(',')[0];
	    transitionDelay = transitionDelay.split(',')[0];
	    return (Number.parseFloat(transitionDuration) + Number.parseFloat(transitionDelay)) * MILLISECONDS_MULTIPLIER;
	  };

	  const triggerTransitionEnd = element => {
	    element.dispatchEvent(new Event(TRANSITION_END));
	  };

	  const isElement = obj => {
	    if (!obj || typeof obj !== 'object') {
	      return false;
	    }

	    if (typeof obj.jquery !== 'undefined') {
	      obj = obj[0];
	    }

	    return typeof obj.nodeType !== 'undefined';
	  };

	  const getElement = obj => {
	    if (isElement(obj)) {
	      // it's a jQuery object or a node element
	      return obj.jquery ? obj[0] : obj;
	    }

	    if (typeof obj === 'string' && obj.length > 0) {
	      return document.querySelector(obj);
	    }

	    return null;
	  };

	  const typeCheckConfig = (componentName, config, configTypes) => {
	    Object.keys(configTypes).forEach(property => {
	      const expectedTypes = configTypes[property];
	      const value = config[property];
	      const valueType = value && isElement(value) ? 'element' : toType(value);

	      if (!new RegExp(expectedTypes).test(valueType)) {
	        throw new TypeError(`${componentName.toUpperCase()}: Option "${property}" provided type "${valueType}" but expected type "${expectedTypes}".`);
	      }
	    });
	  };

	  const isVisible = element => {
	    if (!isElement(element) || element.getClientRects().length === 0) {
	      return false;
	    }

	    return getComputedStyle(element).getPropertyValue('visibility') === 'visible';
	  };

	  const isDisabled = element => {
	    if (!element || element.nodeType !== Node.ELEMENT_NODE) {
	      return true;
	    }

	    if (element.classList.contains('disabled')) {
	      return true;
	    }

	    if (typeof element.disabled !== 'undefined') {
	      return element.disabled;
	    }

	    return element.hasAttribute('disabled') && element.getAttribute('disabled') !== 'false';
	  };
	  /**
	   * Trick to restart an element's animation
	   *
	   * @param {HTMLElement} element
	   * @return void
	   *
	   * @see https://www.charistheo.io/blog/2021/02/restart-a-css-animation-with-javascript/#restarting-a-css-animation
	   */


	  const reflow = element => {
	    // eslint-disable-next-line no-unused-expressions
	    element.offsetHeight;
	  };

	  const getjQuery = () => {
	    const {
	      jQuery
	    } = window;

	    if (jQuery && !document.body.hasAttribute('data-bs-no-jquery')) {
	      return jQuery;
	    }

	    return null;
	  };

	  const DOMContentLoadedCallbacks = [];

	  const onDOMContentLoaded = callback => {
	    if (document.readyState === 'loading') {
	      // add listener on the first call when the document is in loading state
	      if (!DOMContentLoadedCallbacks.length) {
	        document.addEventListener('DOMContentLoaded', () => {
	          DOMContentLoadedCallbacks.forEach(callback => callback());
	        });
	      }

	      DOMContentLoadedCallbacks.push(callback);
	    } else {
	      callback();
	    }
	  };

	  const isRTL = () => document.documentElement.dir === 'rtl';

	  const defineJQueryPlugin = plugin => {
	    onDOMContentLoaded(() => {
	      const $ = getjQuery();
	      /* istanbul ignore if */

	      if ($) {
	        const name = plugin.NAME;
	        const JQUERY_NO_CONFLICT = $.fn[name];
	        $.fn[name] = plugin.jQueryInterface;
	        $.fn[name].Constructor = plugin;

	        $.fn[name].noConflict = () => {
	          $.fn[name] = JQUERY_NO_CONFLICT;
	          return plugin.jQueryInterface;
	        };
	      }
	    });
	  };

	  const execute = callback => {
	    if (typeof callback === 'function') {
	      callback();
	    }
	  };

	  const executeAfterTransition = (callback, transitionElement, waitForTransition = true) => {
	    if (!waitForTransition) {
	      execute(callback);
	      return;
	    }

	    const durationPadding = 5;
	    const emulatedDuration = getTransitionDurationFromElement(transitionElement) + durationPadding;
	    let called = false;

	    const handler = ({
	      target
	    }) => {
	      if (target !== transitionElement) {
	        return;
	      }

	      called = true;
	      transitionElement.removeEventListener(TRANSITION_END, handler);
	      execute(callback);
	    };

	    transitionElement.addEventListener(TRANSITION_END, handler);
	    setTimeout(() => {
	      if (!called) {
	        triggerTransitionEnd(transitionElement);
	      }
	    }, emulatedDuration);
	  };

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/scrollBar.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  const SELECTOR_FIXED_CONTENT = '.fixed-top, .fixed-bottom, .is-fixed, .sticky-top';
	  const SELECTOR_STICKY_CONTENT = '.sticky-top';

	  class ScrollBarHelper {
	    constructor() {
	      this._element = document.body;
	    }

	    getWidth() {
	      // https://developer.mozilla.org/en-US/docs/Web/API/Window/innerWidth#usage_notes
	      const documentWidth = document.documentElement.clientWidth;
	      return Math.abs(window.innerWidth - documentWidth);
	    }

	    hide() {
	      const width = this.getWidth();

	      this._disableOverFlow(); // give padding to element to balance the hidden scrollbar width


	      this._setElementAttributes(this._element, 'paddingRight', calculatedValue => calculatedValue + width); // trick: We adjust positive paddingRight and negative marginRight to sticky-top elements to keep showing fullwidth


	      this._setElementAttributes(SELECTOR_FIXED_CONTENT, 'paddingRight', calculatedValue => calculatedValue + width);

	      this._setElementAttributes(SELECTOR_STICKY_CONTENT, 'marginRight', calculatedValue => calculatedValue - width);
	    }

	    _disableOverFlow() {
	      this._saveInitialAttribute(this._element, 'overflow');

	      this._element.style.overflow = 'hidden';
	    }

	    _setElementAttributes(selector, styleProp, callback) {
	      const scrollbarWidth = this.getWidth();

	      const manipulationCallBack = element => {
	        if (element !== this._element && window.innerWidth > element.clientWidth + scrollbarWidth) {
	          return;
	        }

	        this._saveInitialAttribute(element, styleProp);

	        const calculatedValue = window.getComputedStyle(element)[styleProp];
	        element.style[styleProp] = `${callback(Number.parseFloat(calculatedValue))}px`;
	      };

	      this._applyManipulationCallback(selector, manipulationCallBack);
	    }

	    reset() {
	      this._resetElementAttributes(this._element, 'overflow');

	      this._resetElementAttributes(this._element, 'paddingRight');

	      this._resetElementAttributes(SELECTOR_FIXED_CONTENT, 'paddingRight');

	      this._resetElementAttributes(SELECTOR_STICKY_CONTENT, 'marginRight');
	    }

	    _saveInitialAttribute(element, styleProp) {
	      const actualValue = element.style[styleProp];

	      if (actualValue) {
	        Manipulator__default.default.setDataAttribute(element, styleProp, actualValue);
	      }
	    }

	    _resetElementAttributes(selector, styleProp) {
	      const manipulationCallBack = element => {
	        const value = Manipulator__default.default.getDataAttribute(element, styleProp);

	        if (typeof value === 'undefined') {
	          element.style.removeProperty(styleProp);
	        } else {
	          Manipulator__default.default.removeDataAttribute(element, styleProp);
	          element.style[styleProp] = value;
	        }
	      };

	      this._applyManipulationCallback(selector, manipulationCallBack);
	    }

	    _applyManipulationCallback(selector, callBack) {
	      if (isElement(selector)) {
	        callBack(selector);
	      } else {
	        SelectorEngine__default.default.find(selector, this._element).forEach(callBack);
	      }
	    }

	    isOverflowing() {
	      return this.getWidth() > 0;
	    }

	  }

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/backdrop.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  const Default$2 = {
	    className: 'modal-backdrop',
	    isVisible: true,
	    // if false, we use the backdrop helper without adding any element to the dom
	    isAnimated: false,
	    rootElement: 'body',
	    // give the choice to place backdrop under different elements
	    clickCallback: null
	  };
	  const DefaultType$2 = {
	    className: 'string',
	    isVisible: 'boolean',
	    isAnimated: 'boolean',
	    rootElement: '(element|string)',
	    clickCallback: '(function|null)'
	  };
	  const NAME$2 = 'backdrop';
	  const CLASS_NAME_FADE$1 = 'fade';
	  const CLASS_NAME_SHOW$1 = 'show';
	  const EVENT_MOUSEDOWN = `mousedown.bs.${NAME$2}`;

	  class Backdrop {
	    constructor(config) {
	      this._config = this._getConfig(config);
	      this._isAppended = false;
	      this._element = null;
	    }

	    show(callback) {
	      if (!this._config.isVisible) {
	        execute(callback);
	        return;
	      }

	      this._append();

	      if (this._config.isAnimated) {
	        reflow(this._getElement());
	      }

	      this._getElement().classList.add(CLASS_NAME_SHOW$1);

	      this._emulateAnimation(() => {
	        execute(callback);
	      });
	    }

	    hide(callback) {
	      if (!this._config.isVisible) {
	        execute(callback);
	        return;
	      }

	      this._getElement().classList.remove(CLASS_NAME_SHOW$1);

	      this._emulateAnimation(() => {
	        this.dispose();
	        execute(callback);
	      });
	    } // Private


	    _getElement() {
	      if (!this._element) {
	        const backdrop = document.createElement('div');
	        backdrop.className = this._config.className;

	        if (this._config.isAnimated) {
	          backdrop.classList.add(CLASS_NAME_FADE$1);
	        }

	        this._element = backdrop;
	      }

	      return this._element;
	    }

	    _getConfig(config) {
	      config = { ...Default$2,
	        ...(typeof config === 'object' ? config : {})
	      }; // use getElement() with the default "body" to get a fresh Element on each instantiation

	      config.rootElement = getElement(config.rootElement);
	      typeCheckConfig(NAME$2, config, DefaultType$2);
	      return config;
	    }

	    _append() {
	      if (this._isAppended) {
	        return;
	      }

	      this._config.rootElement.append(this._getElement());

	      EventHandler__default.default.on(this._getElement(), EVENT_MOUSEDOWN, () => {
	        execute(this._config.clickCallback);
	      });
	      this._isAppended = true;
	    }

	    dispose() {
	      if (!this._isAppended) {
	        return;
	      }

	      EventHandler__default.default.off(this._element, EVENT_MOUSEDOWN);

	      this._element.remove();

	      this._isAppended = false;
	    }

	    _emulateAnimation(callback) {
	      executeAfterTransition(callback, this._getElement(), this._config.isAnimated);
	    }

	  }

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/focustrap.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  const Default$1 = {
	    trapElement: null,
	    // The element to trap focus inside of
	    autofocus: true
	  };
	  const DefaultType$1 = {
	    trapElement: 'element',
	    autofocus: 'boolean'
	  };
	  const NAME$1 = 'focustrap';
	  const DATA_KEY$1 = 'bs.focustrap';
	  const EVENT_KEY$1 = `.${DATA_KEY$1}`;
	  const EVENT_FOCUSIN = `focusin${EVENT_KEY$1}`;
	  const EVENT_KEYDOWN_TAB = `keydown.tab${EVENT_KEY$1}`;
	  const TAB_KEY = 'Tab';
	  const TAB_NAV_FORWARD = 'forward';
	  const TAB_NAV_BACKWARD = 'backward';

	  class FocusTrap {
	    constructor(config) {
	      this._config = this._getConfig(config);
	      this._isActive = false;
	      this._lastTabNavDirection = null;
	    }

	    activate() {
	      const {
	        trapElement,
	        autofocus
	      } = this._config;

	      if (this._isActive) {
	        return;
	      }

	      if (autofocus) {
	        trapElement.focus();
	      }

	      EventHandler__default.default.off(document, EVENT_KEY$1); // guard against infinite focus loop

	      EventHandler__default.default.on(document, EVENT_FOCUSIN, event => this._handleFocusin(event));
	      EventHandler__default.default.on(document, EVENT_KEYDOWN_TAB, event => this._handleKeydown(event));
	      this._isActive = true;
	    }

	    deactivate() {
	      if (!this._isActive) {
	        return;
	      }

	      this._isActive = false;
	      EventHandler__default.default.off(document, EVENT_KEY$1);
	    } // Private


	    _handleFocusin(event) {
	      const {
	        target
	      } = event;
	      const {
	        trapElement
	      } = this._config;

	      if (target === document || target === trapElement || trapElement.contains(target)) {
	        return;
	      }

	      const elements = SelectorEngine__default.default.focusableChildren(trapElement);

	      if (elements.length === 0) {
	        trapElement.focus();
	      } else if (this._lastTabNavDirection === TAB_NAV_BACKWARD) {
	        elements[elements.length - 1].focus();
	      } else {
	        elements[0].focus();
	      }
	    }

	    _handleKeydown(event) {
	      if (event.key !== TAB_KEY) {
	        return;
	      }

	      this._lastTabNavDirection = event.shiftKey ? TAB_NAV_BACKWARD : TAB_NAV_FORWARD;
	    }

	    _getConfig(config) {
	      config = { ...Default$1,
	        ...(typeof config === 'object' ? config : {})
	      };
	      typeCheckConfig(NAME$1, config, DefaultType$1);
	      return config;
	    }

	  }

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/component-functions.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */

	  const enableDismissTrigger = (component, method = 'hide') => {
	    const clickEvent = `click.dismiss${component.EVENT_KEY}`;
	    const name = component.NAME;
	    EventHandler__default.default.on(document, clickEvent, `[data-bs-dismiss="${name}"]`, function (event) {
	      if (['A', 'AREA'].includes(this.tagName)) {
	        event.preventDefault();
	      }

	      if (isDisabled(this)) {
	        return;
	      }

	      const target = getElementFromSelector(this) || this.closest(`.${name}`);
	      const instance = component.getOrCreateInstance(target); // Method argument is left, for Alert and only, as it doesn't implement the 'hide' method

	      instance[method]();
	    });
	  };

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): modal.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  /**
	   * ------------------------------------------------------------------------
	   * Constants
	   * ------------------------------------------------------------------------
	   */

	  const NAME = 'modal';
	  const DATA_KEY = 'bs.modal';
	  const EVENT_KEY = `.${DATA_KEY}`;
	  const DATA_API_KEY = '.data-api';
	  const ESCAPE_KEY = 'Escape';
	  const Default = {
	    backdrop: true,
	    keyboard: true,
	    focus: true
	  };
	  const DefaultType = {
	    backdrop: '(boolean|string)',
	    keyboard: 'boolean',
	    focus: 'boolean'
	  };
	  const EVENT_HIDE = `hide${EVENT_KEY}`;
	  const EVENT_HIDE_PREVENTED = `hidePrevented${EVENT_KEY}`;
	  const EVENT_HIDDEN = `hidden${EVENT_KEY}`;
	  const EVENT_SHOW = `show${EVENT_KEY}`;
	  const EVENT_SHOWN = `shown${EVENT_KEY}`;
	  const EVENT_RESIZE = `resize${EVENT_KEY}`;
	  const EVENT_CLICK_DISMISS = `click.dismiss${EVENT_KEY}`;
	  const EVENT_KEYDOWN_DISMISS = `keydown.dismiss${EVENT_KEY}`;
	  const EVENT_MOUSEUP_DISMISS = `mouseup.dismiss${EVENT_KEY}`;
	  const EVENT_MOUSEDOWN_DISMISS = `mousedown.dismiss${EVENT_KEY}`;
	  const EVENT_CLICK_DATA_API = `click${EVENT_KEY}${DATA_API_KEY}`;
	  const CLASS_NAME_OPEN = 'modal-open';
	  const CLASS_NAME_FADE = 'fade';
	  const CLASS_NAME_SHOW = 'show';
	  const CLASS_NAME_STATIC = 'modal-static';
	  const OPEN_SELECTOR = '.modal.show';
	  const SELECTOR_DIALOG = '.modal-dialog';
	  const SELECTOR_MODAL_BODY = '.modal-body';
	  const SELECTOR_DATA_TOGGLE = '[data-bs-toggle="modal"]';
	  /**
	   * ------------------------------------------------------------------------
	   * Class Definition
	   * ------------------------------------------------------------------------
	   */

	  class Modal extends BaseComponent__default.default {
	    constructor(element, config) {
	      super(element);
	      this._config = this._getConfig(config);
	      this._dialog = SelectorEngine__default.default.findOne(SELECTOR_DIALOG, this._element);
	      this._backdrop = this._initializeBackDrop();
	      this._focustrap = this._initializeFocusTrap();
	      this._isShown = false;
	      this._ignoreBackdropClick = false;
	      this._isTransitioning = false;
	      this._scrollBar = new ScrollBarHelper();
	    } // Getters


	    static get Default() {
	      return Default;
	    }

	    static get NAME() {
	      return NAME;
	    } // Public


	    toggle(relatedTarget) {
	      return this._isShown ? this.hide() : this.show(relatedTarget);
	    }

	    show(relatedTarget) {
	      if (this._isShown || this._isTransitioning) {
	        return;
	      }

	      const showEvent = EventHandler__default.default.trigger(this._element, EVENT_SHOW, {
	        relatedTarget
	      });

	      if (showEvent.defaultPrevented) {
	        return;
	      }

	      this._isShown = true;

	      if (this._isAnimated()) {
	        this._isTransitioning = true;
	      }

	      this._scrollBar.hide();

	      document.body.classList.add(CLASS_NAME_OPEN);

	      this._adjustDialog();

	      this._setEscapeEvent();

	      this._setResizeEvent();

	      EventHandler__default.default.on(this._dialog, EVENT_MOUSEDOWN_DISMISS, () => {
	        EventHandler__default.default.one(this._element, EVENT_MOUSEUP_DISMISS, event => {
	          if (event.target === this._element) {
	            this._ignoreBackdropClick = true;
	          }
	        });
	      });

	      this._showBackdrop(() => this._showElement(relatedTarget));
	    }

	    hide() {
	      if (!this._isShown || this._isTransitioning) {
	        return;
	      }

	      const hideEvent = EventHandler__default.default.trigger(this._element, EVENT_HIDE);

	      if (hideEvent.defaultPrevented) {
	        return;
	      }

	      this._isShown = false;

	      const isAnimated = this._isAnimated();

	      if (isAnimated) {
	        this._isTransitioning = true;
	      }

	      this._setEscapeEvent();

	      this._setResizeEvent();

	      this._focustrap.deactivate();

	      this._element.classList.remove(CLASS_NAME_SHOW);

	      EventHandler__default.default.off(this._element, EVENT_CLICK_DISMISS);
	      EventHandler__default.default.off(this._dialog, EVENT_MOUSEDOWN_DISMISS);

	      this._queueCallback(() => this._hideModal(), this._element, isAnimated);
	    }

	    dispose() {
	      [window, this._dialog].forEach(htmlElement => EventHandler__default.default.off(htmlElement, EVENT_KEY));

	      this._backdrop.dispose();

	      this._focustrap.deactivate();

	      super.dispose();
	    }

	    handleUpdate() {
	      this._adjustDialog();
	    } // Private


	    _initializeBackDrop() {
	      return new Backdrop({
	        isVisible: Boolean(this._config.backdrop),
	        // 'static' option will be translated to true, and booleans will keep their value
	        isAnimated: this._isAnimated()
	      });
	    }

	    _initializeFocusTrap() {
	      return new FocusTrap({
	        trapElement: this._element
	      });
	    }

	    _getConfig(config) {
	      config = { ...Default,
	        ...Manipulator__default.default.getDataAttributes(this._element),
	        ...(typeof config === 'object' ? config : {})
	      };
	      typeCheckConfig(NAME, config, DefaultType);
	      return config;
	    }

	    _showElement(relatedTarget) {
	      const isAnimated = this._isAnimated();

	      const modalBody = SelectorEngine__default.default.findOne(SELECTOR_MODAL_BODY, this._dialog);

	      if (!this._element.parentNode || this._element.parentNode.nodeType !== Node.ELEMENT_NODE) {
	        // Don't move modal's DOM position
	        document.body.append(this._element);
	      }

	      this._element.style.display = 'block';

	      this._element.removeAttribute('aria-hidden');

	      this._element.setAttribute('aria-modal', true);

	      this._element.setAttribute('role', 'dialog');

	      this._element.scrollTop = 0;

	      if (modalBody) {
	        modalBody.scrollTop = 0;
	      }

	      if (isAnimated) {
	        reflow(this._element);
	      }

	      this._element.classList.add(CLASS_NAME_SHOW);

	      const transitionComplete = () => {
	        if (this._config.focus) {
	          this._focustrap.activate();
	        }

	        this._isTransitioning = false;
	        EventHandler__default.default.trigger(this._element, EVENT_SHOWN, {
	          relatedTarget
	        });
	      };

	      this._queueCallback(transitionComplete, this._dialog, isAnimated);
	    }

	    _setEscapeEvent() {
	      if (this._isShown) {
	        EventHandler__default.default.on(this._element, EVENT_KEYDOWN_DISMISS, event => {
	          if (this._config.keyboard && event.key === ESCAPE_KEY) {
	            event.preventDefault();
	            this.hide();
	          } else if (!this._config.keyboard && event.key === ESCAPE_KEY) {
	            this._triggerBackdropTransition();
	          }
	        });
	      } else {
	        EventHandler__default.default.off(this._element, EVENT_KEYDOWN_DISMISS);
	      }
	    }

	    _setResizeEvent() {
	      if (this._isShown) {
	        EventHandler__default.default.on(window, EVENT_RESIZE, () => this._adjustDialog());
	      } else {
	        EventHandler__default.default.off(window, EVENT_RESIZE);
	      }
	    }

	    _hideModal() {
	      this._element.style.display = 'none';

	      this._element.setAttribute('aria-hidden', true);

	      this._element.removeAttribute('aria-modal');

	      this._element.removeAttribute('role');

	      this._isTransitioning = false;

	      this._backdrop.hide(() => {
	        document.body.classList.remove(CLASS_NAME_OPEN);

	        this._resetAdjustments();

	        this._scrollBar.reset();

	        EventHandler__default.default.trigger(this._element, EVENT_HIDDEN);
	      });
	    }

	    _showBackdrop(callback) {
	      EventHandler__default.default.on(this._element, EVENT_CLICK_DISMISS, event => {
	        if (this._ignoreBackdropClick) {
	          this._ignoreBackdropClick = false;
	          return;
	        }

	        if (event.target !== event.currentTarget) {
	          return;
	        }

	        if (this._config.backdrop === true) {
	          this.hide();
	        } else if (this._config.backdrop === 'static') {
	          this._triggerBackdropTransition();
	        }
	      });

	      this._backdrop.show(callback);
	    }

	    _isAnimated() {
	      return this._element.classList.contains(CLASS_NAME_FADE);
	    }

	    _triggerBackdropTransition() {
	      const hideEvent = EventHandler__default.default.trigger(this._element, EVENT_HIDE_PREVENTED);

	      if (hideEvent.defaultPrevented) {
	        return;
	      }

	      const {
	        classList,
	        scrollHeight,
	        style
	      } = this._element;
	      const isModalOverflowing = scrollHeight > document.documentElement.clientHeight; // return if the following background transition hasn't yet completed

	      if (!isModalOverflowing && style.overflowY === 'hidden' || classList.contains(CLASS_NAME_STATIC)) {
	        return;
	      }

	      if (!isModalOverflowing) {
	        style.overflowY = 'hidden';
	      }

	      classList.add(CLASS_NAME_STATIC);

	      this._queueCallback(() => {
	        classList.remove(CLASS_NAME_STATIC);

	        if (!isModalOverflowing) {
	          this._queueCallback(() => {
	            style.overflowY = '';
	          }, this._dialog);
	        }
	      }, this._dialog);

	      this._element.focus();
	    } // ----------------------------------------------------------------------
	    // the following methods are used to handle overflowing modals
	    // ----------------------------------------------------------------------


	    _adjustDialog() {
	      const isModalOverflowing = this._element.scrollHeight > document.documentElement.clientHeight;

	      const scrollbarWidth = this._scrollBar.getWidth();

	      const isBodyOverflowing = scrollbarWidth > 0;

	      if (!isBodyOverflowing && isModalOverflowing && !isRTL() || isBodyOverflowing && !isModalOverflowing && isRTL()) {
	        this._element.style.paddingLeft = `${scrollbarWidth}px`;
	      }

	      if (isBodyOverflowing && !isModalOverflowing && !isRTL() || !isBodyOverflowing && isModalOverflowing && isRTL()) {
	        this._element.style.paddingRight = `${scrollbarWidth}px`;
	      }
	    }

	    _resetAdjustments() {
	      this._element.style.paddingLeft = '';
	      this._element.style.paddingRight = '';
	    } // Static


	    static jQueryInterface(config, relatedTarget) {
	      return this.each(function () {
	        const data = Modal.getOrCreateInstance(this, config);

	        if (typeof config !== 'string') {
	          return;
	        }

	        if (typeof data[config] === 'undefined') {
	          throw new TypeError(`No method named "${config}"`);
	        }

	        data[config](relatedTarget);
	      });
	    }

	  }
	  /**
	   * ------------------------------------------------------------------------
	   * Data Api implementation
	   * ------------------------------------------------------------------------
	   */


	  EventHandler__default.default.on(document, EVENT_CLICK_DATA_API, SELECTOR_DATA_TOGGLE, function (event) {
	    const target = getElementFromSelector(this);

	    if (['A', 'AREA'].includes(this.tagName)) {
	      event.preventDefault();
	    }

	    EventHandler__default.default.one(target, EVENT_SHOW, showEvent => {
	      if (showEvent.defaultPrevented) {
	        // only register focus restorer if modal will actually get shown
	        return;
	      }

	      EventHandler__default.default.one(target, EVENT_HIDDEN, () => {
	        if (isVisible(this)) {
	          this.focus();
	        }
	      });
	    }); // avoid conflict when clicking moddal toggler while another one is open

	    const allReadyOpen = SelectorEngine__default.default.findOne(OPEN_SELECTOR);

	    if (allReadyOpen) {
	      Modal.getInstance(allReadyOpen).hide();
	    }

	    const data = Modal.getOrCreateInstance(target);
	    data.toggle(this);
	  });
	  enableDismissTrigger(Modal);
	  /**
	   * ------------------------------------------------------------------------
	   * jQuery
	   * ------------------------------------------------------------------------
	   * add .Modal to jQuery only if jQuery is present
	   */

	  defineJQueryPlugin(Modal);

	  return Modal;

	}));

	}(modal));

	var Modal = modal.exports;

	var offcanvas$1 = {exports: {}};

	/*!
	  * Bootstrap offcanvas.js v5.1.3 (https://getbootstrap.com/)
	  * Copyright 2011-2021 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
	  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	  */

	(function (module, exports) {
	(function (global, factory) {
	  module.exports = factory(selectorEngine.exports, manipulator.exports, eventHandler.exports, baseComponent.exports) ;
	})(commonjsGlobal, (function (SelectorEngine, Manipulator, EventHandler, BaseComponent) {
	  const _interopDefaultLegacy = e => e && typeof e === 'object' && 'default' in e ? e : { default: e };

	  const SelectorEngine__default = /*#__PURE__*/_interopDefaultLegacy(SelectorEngine);
	  const Manipulator__default = /*#__PURE__*/_interopDefaultLegacy(Manipulator);
	  const EventHandler__default = /*#__PURE__*/_interopDefaultLegacy(EventHandler);
	  const BaseComponent__default = /*#__PURE__*/_interopDefaultLegacy(BaseComponent);

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/index.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  const MILLISECONDS_MULTIPLIER = 1000;
	  const TRANSITION_END = 'transitionend'; // Shoutout AngusCroll (https://goo.gl/pxwQGp)

	  const toType = obj => {
	    if (obj === null || obj === undefined) {
	      return `${obj}`;
	    }

	    return {}.toString.call(obj).match(/\s([a-z]+)/i)[1].toLowerCase();
	  };

	  const getSelector = element => {
	    let selector = element.getAttribute('data-bs-target');

	    if (!selector || selector === '#') {
	      let hrefAttr = element.getAttribute('href'); // The only valid content that could double as a selector are IDs or classes,
	      // so everything starting with `#` or `.`. If a "real" URL is used as the selector,
	      // `document.querySelector` will rightfully complain it is invalid.
	      // See https://github.com/twbs/bootstrap/issues/32273

	      if (!hrefAttr || !hrefAttr.includes('#') && !hrefAttr.startsWith('.')) {
	        return null;
	      } // Just in case some CMS puts out a full URL with the anchor appended


	      if (hrefAttr.includes('#') && !hrefAttr.startsWith('#')) {
	        hrefAttr = `#${hrefAttr.split('#')[1]}`;
	      }

	      selector = hrefAttr && hrefAttr !== '#' ? hrefAttr.trim() : null;
	    }

	    return selector;
	  };

	  const getElementFromSelector = element => {
	    const selector = getSelector(element);
	    return selector ? document.querySelector(selector) : null;
	  };

	  const getTransitionDurationFromElement = element => {
	    if (!element) {
	      return 0;
	    } // Get transition-duration of the element


	    let {
	      transitionDuration,
	      transitionDelay
	    } = window.getComputedStyle(element);
	    const floatTransitionDuration = Number.parseFloat(transitionDuration);
	    const floatTransitionDelay = Number.parseFloat(transitionDelay); // Return 0 if element or transition duration is not found

	    if (!floatTransitionDuration && !floatTransitionDelay) {
	      return 0;
	    } // If multiple durations are defined, take the first


	    transitionDuration = transitionDuration.split(',')[0];
	    transitionDelay = transitionDelay.split(',')[0];
	    return (Number.parseFloat(transitionDuration) + Number.parseFloat(transitionDelay)) * MILLISECONDS_MULTIPLIER;
	  };

	  const triggerTransitionEnd = element => {
	    element.dispatchEvent(new Event(TRANSITION_END));
	  };

	  const isElement = obj => {
	    if (!obj || typeof obj !== 'object') {
	      return false;
	    }

	    if (typeof obj.jquery !== 'undefined') {
	      obj = obj[0];
	    }

	    return typeof obj.nodeType !== 'undefined';
	  };

	  const getElement = obj => {
	    if (isElement(obj)) {
	      // it's a jQuery object or a node element
	      return obj.jquery ? obj[0] : obj;
	    }

	    if (typeof obj === 'string' && obj.length > 0) {
	      return document.querySelector(obj);
	    }

	    return null;
	  };

	  const typeCheckConfig = (componentName, config, configTypes) => {
	    Object.keys(configTypes).forEach(property => {
	      const expectedTypes = configTypes[property];
	      const value = config[property];
	      const valueType = value && isElement(value) ? 'element' : toType(value);

	      if (!new RegExp(expectedTypes).test(valueType)) {
	        throw new TypeError(`${componentName.toUpperCase()}: Option "${property}" provided type "${valueType}" but expected type "${expectedTypes}".`);
	      }
	    });
	  };

	  const isVisible = element => {
	    if (!isElement(element) || element.getClientRects().length === 0) {
	      return false;
	    }

	    return getComputedStyle(element).getPropertyValue('visibility') === 'visible';
	  };

	  const isDisabled = element => {
	    if (!element || element.nodeType !== Node.ELEMENT_NODE) {
	      return true;
	    }

	    if (element.classList.contains('disabled')) {
	      return true;
	    }

	    if (typeof element.disabled !== 'undefined') {
	      return element.disabled;
	    }

	    return element.hasAttribute('disabled') && element.getAttribute('disabled') !== 'false';
	  };
	  /**
	   * Trick to restart an element's animation
	   *
	   * @param {HTMLElement} element
	   * @return void
	   *
	   * @see https://www.charistheo.io/blog/2021/02/restart-a-css-animation-with-javascript/#restarting-a-css-animation
	   */


	  const reflow = element => {
	    // eslint-disable-next-line no-unused-expressions
	    element.offsetHeight;
	  };

	  const getjQuery = () => {
	    const {
	      jQuery
	    } = window;

	    if (jQuery && !document.body.hasAttribute('data-bs-no-jquery')) {
	      return jQuery;
	    }

	    return null;
	  };

	  const DOMContentLoadedCallbacks = [];

	  const onDOMContentLoaded = callback => {
	    if (document.readyState === 'loading') {
	      // add listener on the first call when the document is in loading state
	      if (!DOMContentLoadedCallbacks.length) {
	        document.addEventListener('DOMContentLoaded', () => {
	          DOMContentLoadedCallbacks.forEach(callback => callback());
	        });
	      }

	      DOMContentLoadedCallbacks.push(callback);
	    } else {
	      callback();
	    }
	  };

	  const defineJQueryPlugin = plugin => {
	    onDOMContentLoaded(() => {
	      const $ = getjQuery();
	      /* istanbul ignore if */

	      if ($) {
	        const name = plugin.NAME;
	        const JQUERY_NO_CONFLICT = $.fn[name];
	        $.fn[name] = plugin.jQueryInterface;
	        $.fn[name].Constructor = plugin;

	        $.fn[name].noConflict = () => {
	          $.fn[name] = JQUERY_NO_CONFLICT;
	          return plugin.jQueryInterface;
	        };
	      }
	    });
	  };

	  const execute = callback => {
	    if (typeof callback === 'function') {
	      callback();
	    }
	  };

	  const executeAfterTransition = (callback, transitionElement, waitForTransition = true) => {
	    if (!waitForTransition) {
	      execute(callback);
	      return;
	    }

	    const durationPadding = 5;
	    const emulatedDuration = getTransitionDurationFromElement(transitionElement) + durationPadding;
	    let called = false;

	    const handler = ({
	      target
	    }) => {
	      if (target !== transitionElement) {
	        return;
	      }

	      called = true;
	      transitionElement.removeEventListener(TRANSITION_END, handler);
	      execute(callback);
	    };

	    transitionElement.addEventListener(TRANSITION_END, handler);
	    setTimeout(() => {
	      if (!called) {
	        triggerTransitionEnd(transitionElement);
	      }
	    }, emulatedDuration);
	  };

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/scrollBar.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  const SELECTOR_FIXED_CONTENT = '.fixed-top, .fixed-bottom, .is-fixed, .sticky-top';
	  const SELECTOR_STICKY_CONTENT = '.sticky-top';

	  class ScrollBarHelper {
	    constructor() {
	      this._element = document.body;
	    }

	    getWidth() {
	      // https://developer.mozilla.org/en-US/docs/Web/API/Window/innerWidth#usage_notes
	      const documentWidth = document.documentElement.clientWidth;
	      return Math.abs(window.innerWidth - documentWidth);
	    }

	    hide() {
	      const width = this.getWidth();

	      this._disableOverFlow(); // give padding to element to balance the hidden scrollbar width


	      this._setElementAttributes(this._element, 'paddingRight', calculatedValue => calculatedValue + width); // trick: We adjust positive paddingRight and negative marginRight to sticky-top elements to keep showing fullwidth


	      this._setElementAttributes(SELECTOR_FIXED_CONTENT, 'paddingRight', calculatedValue => calculatedValue + width);

	      this._setElementAttributes(SELECTOR_STICKY_CONTENT, 'marginRight', calculatedValue => calculatedValue - width);
	    }

	    _disableOverFlow() {
	      this._saveInitialAttribute(this._element, 'overflow');

	      this._element.style.overflow = 'hidden';
	    }

	    _setElementAttributes(selector, styleProp, callback) {
	      const scrollbarWidth = this.getWidth();

	      const manipulationCallBack = element => {
	        if (element !== this._element && window.innerWidth > element.clientWidth + scrollbarWidth) {
	          return;
	        }

	        this._saveInitialAttribute(element, styleProp);

	        const calculatedValue = window.getComputedStyle(element)[styleProp];
	        element.style[styleProp] = `${callback(Number.parseFloat(calculatedValue))}px`;
	      };

	      this._applyManipulationCallback(selector, manipulationCallBack);
	    }

	    reset() {
	      this._resetElementAttributes(this._element, 'overflow');

	      this._resetElementAttributes(this._element, 'paddingRight');

	      this._resetElementAttributes(SELECTOR_FIXED_CONTENT, 'paddingRight');

	      this._resetElementAttributes(SELECTOR_STICKY_CONTENT, 'marginRight');
	    }

	    _saveInitialAttribute(element, styleProp) {
	      const actualValue = element.style[styleProp];

	      if (actualValue) {
	        Manipulator__default.default.setDataAttribute(element, styleProp, actualValue);
	      }
	    }

	    _resetElementAttributes(selector, styleProp) {
	      const manipulationCallBack = element => {
	        const value = Manipulator__default.default.getDataAttribute(element, styleProp);

	        if (typeof value === 'undefined') {
	          element.style.removeProperty(styleProp);
	        } else {
	          Manipulator__default.default.removeDataAttribute(element, styleProp);
	          element.style[styleProp] = value;
	        }
	      };

	      this._applyManipulationCallback(selector, manipulationCallBack);
	    }

	    _applyManipulationCallback(selector, callBack) {
	      if (isElement(selector)) {
	        callBack(selector);
	      } else {
	        SelectorEngine__default.default.find(selector, this._element).forEach(callBack);
	      }
	    }

	    isOverflowing() {
	      return this.getWidth() > 0;
	    }

	  }

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/backdrop.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  const Default$2 = {
	    className: 'modal-backdrop',
	    isVisible: true,
	    // if false, we use the backdrop helper without adding any element to the dom
	    isAnimated: false,
	    rootElement: 'body',
	    // give the choice to place backdrop under different elements
	    clickCallback: null
	  };
	  const DefaultType$2 = {
	    className: 'string',
	    isVisible: 'boolean',
	    isAnimated: 'boolean',
	    rootElement: '(element|string)',
	    clickCallback: '(function|null)'
	  };
	  const NAME$2 = 'backdrop';
	  const CLASS_NAME_FADE = 'fade';
	  const CLASS_NAME_SHOW$1 = 'show';
	  const EVENT_MOUSEDOWN = `mousedown.bs.${NAME$2}`;

	  class Backdrop {
	    constructor(config) {
	      this._config = this._getConfig(config);
	      this._isAppended = false;
	      this._element = null;
	    }

	    show(callback) {
	      if (!this._config.isVisible) {
	        execute(callback);
	        return;
	      }

	      this._append();

	      if (this._config.isAnimated) {
	        reflow(this._getElement());
	      }

	      this._getElement().classList.add(CLASS_NAME_SHOW$1);

	      this._emulateAnimation(() => {
	        execute(callback);
	      });
	    }

	    hide(callback) {
	      if (!this._config.isVisible) {
	        execute(callback);
	        return;
	      }

	      this._getElement().classList.remove(CLASS_NAME_SHOW$1);

	      this._emulateAnimation(() => {
	        this.dispose();
	        execute(callback);
	      });
	    } // Private


	    _getElement() {
	      if (!this._element) {
	        const backdrop = document.createElement('div');
	        backdrop.className = this._config.className;

	        if (this._config.isAnimated) {
	          backdrop.classList.add(CLASS_NAME_FADE);
	        }

	        this._element = backdrop;
	      }

	      return this._element;
	    }

	    _getConfig(config) {
	      config = { ...Default$2,
	        ...(typeof config === 'object' ? config : {})
	      }; // use getElement() with the default "body" to get a fresh Element on each instantiation

	      config.rootElement = getElement(config.rootElement);
	      typeCheckConfig(NAME$2, config, DefaultType$2);
	      return config;
	    }

	    _append() {
	      if (this._isAppended) {
	        return;
	      }

	      this._config.rootElement.append(this._getElement());

	      EventHandler__default.default.on(this._getElement(), EVENT_MOUSEDOWN, () => {
	        execute(this._config.clickCallback);
	      });
	      this._isAppended = true;
	    }

	    dispose() {
	      if (!this._isAppended) {
	        return;
	      }

	      EventHandler__default.default.off(this._element, EVENT_MOUSEDOWN);

	      this._element.remove();

	      this._isAppended = false;
	    }

	    _emulateAnimation(callback) {
	      executeAfterTransition(callback, this._getElement(), this._config.isAnimated);
	    }

	  }

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/focustrap.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  const Default$1 = {
	    trapElement: null,
	    // The element to trap focus inside of
	    autofocus: true
	  };
	  const DefaultType$1 = {
	    trapElement: 'element',
	    autofocus: 'boolean'
	  };
	  const NAME$1 = 'focustrap';
	  const DATA_KEY$1 = 'bs.focustrap';
	  const EVENT_KEY$1 = `.${DATA_KEY$1}`;
	  const EVENT_FOCUSIN = `focusin${EVENT_KEY$1}`;
	  const EVENT_KEYDOWN_TAB = `keydown.tab${EVENT_KEY$1}`;
	  const TAB_KEY = 'Tab';
	  const TAB_NAV_FORWARD = 'forward';
	  const TAB_NAV_BACKWARD = 'backward';

	  class FocusTrap {
	    constructor(config) {
	      this._config = this._getConfig(config);
	      this._isActive = false;
	      this._lastTabNavDirection = null;
	    }

	    activate() {
	      const {
	        trapElement,
	        autofocus
	      } = this._config;

	      if (this._isActive) {
	        return;
	      }

	      if (autofocus) {
	        trapElement.focus();
	      }

	      EventHandler__default.default.off(document, EVENT_KEY$1); // guard against infinite focus loop

	      EventHandler__default.default.on(document, EVENT_FOCUSIN, event => this._handleFocusin(event));
	      EventHandler__default.default.on(document, EVENT_KEYDOWN_TAB, event => this._handleKeydown(event));
	      this._isActive = true;
	    }

	    deactivate() {
	      if (!this._isActive) {
	        return;
	      }

	      this._isActive = false;
	      EventHandler__default.default.off(document, EVENT_KEY$1);
	    } // Private


	    _handleFocusin(event) {
	      const {
	        target
	      } = event;
	      const {
	        trapElement
	      } = this._config;

	      if (target === document || target === trapElement || trapElement.contains(target)) {
	        return;
	      }

	      const elements = SelectorEngine__default.default.focusableChildren(trapElement);

	      if (elements.length === 0) {
	        trapElement.focus();
	      } else if (this._lastTabNavDirection === TAB_NAV_BACKWARD) {
	        elements[elements.length - 1].focus();
	      } else {
	        elements[0].focus();
	      }
	    }

	    _handleKeydown(event) {
	      if (event.key !== TAB_KEY) {
	        return;
	      }

	      this._lastTabNavDirection = event.shiftKey ? TAB_NAV_BACKWARD : TAB_NAV_FORWARD;
	    }

	    _getConfig(config) {
	      config = { ...Default$1,
	        ...(typeof config === 'object' ? config : {})
	      };
	      typeCheckConfig(NAME$1, config, DefaultType$1);
	      return config;
	    }

	  }

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/component-functions.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */

	  const enableDismissTrigger = (component, method = 'hide') => {
	    const clickEvent = `click.dismiss${component.EVENT_KEY}`;
	    const name = component.NAME;
	    EventHandler__default.default.on(document, clickEvent, `[data-bs-dismiss="${name}"]`, function (event) {
	      if (['A', 'AREA'].includes(this.tagName)) {
	        event.preventDefault();
	      }

	      if (isDisabled(this)) {
	        return;
	      }

	      const target = getElementFromSelector(this) || this.closest(`.${name}`);
	      const instance = component.getOrCreateInstance(target); // Method argument is left, for Alert and only, as it doesn't implement the 'hide' method

	      instance[method]();
	    });
	  };

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): offcanvas.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  /**
	   * ------------------------------------------------------------------------
	   * Constants
	   * ------------------------------------------------------------------------
	   */

	  const NAME = 'offcanvas';
	  const DATA_KEY = 'bs.offcanvas';
	  const EVENT_KEY = `.${DATA_KEY}`;
	  const DATA_API_KEY = '.data-api';
	  const EVENT_LOAD_DATA_API = `load${EVENT_KEY}${DATA_API_KEY}`;
	  const ESCAPE_KEY = 'Escape';
	  const Default = {
	    backdrop: true,
	    keyboard: true,
	    scroll: false
	  };
	  const DefaultType = {
	    backdrop: 'boolean',
	    keyboard: 'boolean',
	    scroll: 'boolean'
	  };
	  const CLASS_NAME_SHOW = 'show';
	  const CLASS_NAME_BACKDROP = 'offcanvas-backdrop';
	  const OPEN_SELECTOR = '.offcanvas.show';
	  const EVENT_SHOW = `show${EVENT_KEY}`;
	  const EVENT_SHOWN = `shown${EVENT_KEY}`;
	  const EVENT_HIDE = `hide${EVENT_KEY}`;
	  const EVENT_HIDDEN = `hidden${EVENT_KEY}`;
	  const EVENT_CLICK_DATA_API = `click${EVENT_KEY}${DATA_API_KEY}`;
	  const EVENT_KEYDOWN_DISMISS = `keydown.dismiss${EVENT_KEY}`;
	  const SELECTOR_DATA_TOGGLE = '[data-bs-toggle="offcanvas"]';
	  /**
	   * ------------------------------------------------------------------------
	   * Class Definition
	   * ------------------------------------------------------------------------
	   */

	  class Offcanvas extends BaseComponent__default.default {
	    constructor(element, config) {
	      super(element);
	      this._config = this._getConfig(config);
	      this._isShown = false;
	      this._backdrop = this._initializeBackDrop();
	      this._focustrap = this._initializeFocusTrap();

	      this._addEventListeners();
	    } // Getters


	    static get NAME() {
	      return NAME;
	    }

	    static get Default() {
	      return Default;
	    } // Public


	    toggle(relatedTarget) {
	      return this._isShown ? this.hide() : this.show(relatedTarget);
	    }

	    show(relatedTarget) {
	      if (this._isShown) {
	        return;
	      }

	      const showEvent = EventHandler__default.default.trigger(this._element, EVENT_SHOW, {
	        relatedTarget
	      });

	      if (showEvent.defaultPrevented) {
	        return;
	      }

	      this._isShown = true;
	      this._element.style.visibility = 'visible';

	      this._backdrop.show();

	      if (!this._config.scroll) {
	        new ScrollBarHelper().hide();
	      }

	      this._element.removeAttribute('aria-hidden');

	      this._element.setAttribute('aria-modal', true);

	      this._element.setAttribute('role', 'dialog');

	      this._element.classList.add(CLASS_NAME_SHOW);

	      const completeCallBack = () => {
	        if (!this._config.scroll) {
	          this._focustrap.activate();
	        }

	        EventHandler__default.default.trigger(this._element, EVENT_SHOWN, {
	          relatedTarget
	        });
	      };

	      this._queueCallback(completeCallBack, this._element, true);
	    }

	    hide() {
	      if (!this._isShown) {
	        return;
	      }

	      const hideEvent = EventHandler__default.default.trigger(this._element, EVENT_HIDE);

	      if (hideEvent.defaultPrevented) {
	        return;
	      }

	      this._focustrap.deactivate();

	      this._element.blur();

	      this._isShown = false;

	      this._element.classList.remove(CLASS_NAME_SHOW);

	      this._backdrop.hide();

	      const completeCallback = () => {
	        this._element.setAttribute('aria-hidden', true);

	        this._element.removeAttribute('aria-modal');

	        this._element.removeAttribute('role');

	        this._element.style.visibility = 'hidden';

	        if (!this._config.scroll) {
	          new ScrollBarHelper().reset();
	        }

	        EventHandler__default.default.trigger(this._element, EVENT_HIDDEN);
	      };

	      this._queueCallback(completeCallback, this._element, true);
	    }

	    dispose() {
	      this._backdrop.dispose();

	      this._focustrap.deactivate();

	      super.dispose();
	    } // Private


	    _getConfig(config) {
	      config = { ...Default,
	        ...Manipulator__default.default.getDataAttributes(this._element),
	        ...(typeof config === 'object' ? config : {})
	      };
	      typeCheckConfig(NAME, config, DefaultType);
	      return config;
	    }

	    _initializeBackDrop() {
	      return new Backdrop({
	        className: CLASS_NAME_BACKDROP,
	        isVisible: this._config.backdrop,
	        isAnimated: true,
	        rootElement: this._element.parentNode,
	        clickCallback: () => this.hide()
	      });
	    }

	    _initializeFocusTrap() {
	      return new FocusTrap({
	        trapElement: this._element
	      });
	    }

	    _addEventListeners() {
	      EventHandler__default.default.on(this._element, EVENT_KEYDOWN_DISMISS, event => {
	        if (this._config.keyboard && event.key === ESCAPE_KEY) {
	          this.hide();
	        }
	      });
	    } // Static


	    static jQueryInterface(config) {
	      return this.each(function () {
	        const data = Offcanvas.getOrCreateInstance(this, config);

	        if (typeof config !== 'string') {
	          return;
	        }

	        if (data[config] === undefined || config.startsWith('_') || config === 'constructor') {
	          throw new TypeError(`No method named "${config}"`);
	        }

	        data[config](this);
	      });
	    }

	  }
	  /**
	   * ------------------------------------------------------------------------
	   * Data Api implementation
	   * ------------------------------------------------------------------------
	   */


	  EventHandler__default.default.on(document, EVENT_CLICK_DATA_API, SELECTOR_DATA_TOGGLE, function (event) {
	    const target = getElementFromSelector(this);

	    if (['A', 'AREA'].includes(this.tagName)) {
	      event.preventDefault();
	    }

	    if (isDisabled(this)) {
	      return;
	    }

	    EventHandler__default.default.one(target, EVENT_HIDDEN, () => {
	      // focus on trigger when it is closed
	      if (isVisible(this)) {
	        this.focus();
	      }
	    }); // avoid conflict when clicking a toggler of an offcanvas, while another is open

	    const allReadyOpen = SelectorEngine__default.default.findOne(OPEN_SELECTOR);

	    if (allReadyOpen && allReadyOpen !== target) {
	      Offcanvas.getInstance(allReadyOpen).hide();
	    }

	    const data = Offcanvas.getOrCreateInstance(target);
	    data.toggle(this);
	  });
	  EventHandler__default.default.on(window, EVENT_LOAD_DATA_API, () => SelectorEngine__default.default.find(OPEN_SELECTOR).forEach(el => Offcanvas.getOrCreateInstance(el).show()));
	  enableDismissTrigger(Offcanvas);
	  /**
	   * ------------------------------------------------------------------------
	   * jQuery
	   * ------------------------------------------------------------------------
	   */

	  defineJQueryPlugin(Offcanvas);

	  return Offcanvas;

	}));

	}(offcanvas$1));

	var offcanvas = offcanvas$1.exports;

	var popover$1 = {exports: {}};

	var tooltip$1 = {exports: {}};

	/*!
	  * Bootstrap tooltip.js v5.1.3 (https://getbootstrap.com/)
	  * Copyright 2011-2021 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
	  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	  */

	(function (module, exports) {
	(function (global, factory) {
	  module.exports = factory(require$$0, data.exports, eventHandler.exports, manipulator.exports, selectorEngine.exports, baseComponent.exports) ;
	})(commonjsGlobal, (function (Popper, Data, EventHandler, Manipulator, SelectorEngine, BaseComponent) {
	  const _interopDefaultLegacy = e => e && typeof e === 'object' && 'default' in e ? e : { default: e };

	  function _interopNamespace(e) {
	    if (e && e.__esModule) return e;
	    const n = Object.create(null);
	    if (e) {
	      for (const k in e) {
	        if (k !== 'default') {
	          const d = Object.getOwnPropertyDescriptor(e, k);
	          Object.defineProperty(n, k, d.get ? d : {
	            enumerable: true,
	            get: () => e[k]
	          });
	        }
	      }
	    }
	    n.default = e;
	    return Object.freeze(n);
	  }

	  const Popper__namespace = /*#__PURE__*/_interopNamespace(Popper);
	  const Data__default = /*#__PURE__*/_interopDefaultLegacy(Data);
	  const EventHandler__default = /*#__PURE__*/_interopDefaultLegacy(EventHandler);
	  const Manipulator__default = /*#__PURE__*/_interopDefaultLegacy(Manipulator);
	  const SelectorEngine__default = /*#__PURE__*/_interopDefaultLegacy(SelectorEngine);
	  const BaseComponent__default = /*#__PURE__*/_interopDefaultLegacy(BaseComponent);

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/index.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  const MAX_UID = 1000000;

	  const toType = obj => {
	    if (obj === null || obj === undefined) {
	      return `${obj}`;
	    }

	    return {}.toString.call(obj).match(/\s([a-z]+)/i)[1].toLowerCase();
	  };
	  /**
	   * --------------------------------------------------------------------------
	   * Public Util Api
	   * --------------------------------------------------------------------------
	   */


	  const getUID = prefix => {
	    do {
	      prefix += Math.floor(Math.random() * MAX_UID);
	    } while (document.getElementById(prefix));

	    return prefix;
	  };

	  const isElement = obj => {
	    if (!obj || typeof obj !== 'object') {
	      return false;
	    }

	    if (typeof obj.jquery !== 'undefined') {
	      obj = obj[0];
	    }

	    return typeof obj.nodeType !== 'undefined';
	  };

	  const getElement = obj => {
	    if (isElement(obj)) {
	      // it's a jQuery object or a node element
	      return obj.jquery ? obj[0] : obj;
	    }

	    if (typeof obj === 'string' && obj.length > 0) {
	      return document.querySelector(obj);
	    }

	    return null;
	  };

	  const typeCheckConfig = (componentName, config, configTypes) => {
	    Object.keys(configTypes).forEach(property => {
	      const expectedTypes = configTypes[property];
	      const value = config[property];
	      const valueType = value && isElement(value) ? 'element' : toType(value);

	      if (!new RegExp(expectedTypes).test(valueType)) {
	        throw new TypeError(`${componentName.toUpperCase()}: Option "${property}" provided type "${valueType}" but expected type "${expectedTypes}".`);
	      }
	    });
	  };

	  const findShadowRoot = element => {
	    if (!document.documentElement.attachShadow) {
	      return null;
	    } // Can find the shadow root otherwise it'll return the document


	    if (typeof element.getRootNode === 'function') {
	      const root = element.getRootNode();
	      return root instanceof ShadowRoot ? root : null;
	    }

	    if (element instanceof ShadowRoot) {
	      return element;
	    } // when we don't find a shadow root


	    if (!element.parentNode) {
	      return null;
	    }

	    return findShadowRoot(element.parentNode);
	  };

	  const noop = () => {};

	  const getjQuery = () => {
	    const {
	      jQuery
	    } = window;

	    if (jQuery && !document.body.hasAttribute('data-bs-no-jquery')) {
	      return jQuery;
	    }

	    return null;
	  };

	  const DOMContentLoadedCallbacks = [];

	  const onDOMContentLoaded = callback => {
	    if (document.readyState === 'loading') {
	      // add listener on the first call when the document is in loading state
	      if (!DOMContentLoadedCallbacks.length) {
	        document.addEventListener('DOMContentLoaded', () => {
	          DOMContentLoadedCallbacks.forEach(callback => callback());
	        });
	      }

	      DOMContentLoadedCallbacks.push(callback);
	    } else {
	      callback();
	    }
	  };

	  const isRTL = () => document.documentElement.dir === 'rtl';

	  const defineJQueryPlugin = plugin => {
	    onDOMContentLoaded(() => {
	      const $ = getjQuery();
	      /* istanbul ignore if */

	      if ($) {
	        const name = plugin.NAME;
	        const JQUERY_NO_CONFLICT = $.fn[name];
	        $.fn[name] = plugin.jQueryInterface;
	        $.fn[name].Constructor = plugin;

	        $.fn[name].noConflict = () => {
	          $.fn[name] = JQUERY_NO_CONFLICT;
	          return plugin.jQueryInterface;
	        };
	      }
	    });
	  };

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/sanitizer.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  const uriAttributes = new Set(['background', 'cite', 'href', 'itemtype', 'longdesc', 'poster', 'src', 'xlink:href']);
	  const ARIA_ATTRIBUTE_PATTERN = /^aria-[\w-]*$/i;
	  /**
	   * A pattern that recognizes a commonly useful subset of URLs that are safe.
	   *
	   * Shoutout to Angular https://github.com/angular/angular/blob/12.2.x/packages/core/src/sanitization/url_sanitizer.ts
	   */

	  const SAFE_URL_PATTERN = /^(?:(?:https?|mailto|ftp|tel|file|sms):|[^#&/:?]*(?:[#/?]|$))/i;
	  /**
	   * A pattern that matches safe data URLs. Only matches image, video and audio types.
	   *
	   * Shoutout to Angular https://github.com/angular/angular/blob/12.2.x/packages/core/src/sanitization/url_sanitizer.ts
	   */

	  const DATA_URL_PATTERN = /^data:(?:image\/(?:bmp|gif|jpeg|jpg|png|tiff|webp)|video\/(?:mpeg|mp4|ogg|webm)|audio\/(?:mp3|oga|ogg|opus));base64,[\d+/a-z]+=*$/i;

	  const allowedAttribute = (attribute, allowedAttributeList) => {
	    const attributeName = attribute.nodeName.toLowerCase();

	    if (allowedAttributeList.includes(attributeName)) {
	      if (uriAttributes.has(attributeName)) {
	        return Boolean(SAFE_URL_PATTERN.test(attribute.nodeValue) || DATA_URL_PATTERN.test(attribute.nodeValue));
	      }

	      return true;
	    }

	    const regExp = allowedAttributeList.filter(attributeRegex => attributeRegex instanceof RegExp); // Check if a regular expression validates the attribute.

	    for (let i = 0, len = regExp.length; i < len; i++) {
	      if (regExp[i].test(attributeName)) {
	        return true;
	      }
	    }

	    return false;
	  };

	  const DefaultAllowlist = {
	    // Global attributes allowed on any supplied element below.
	    '*': ['class', 'dir', 'id', 'lang', 'role', ARIA_ATTRIBUTE_PATTERN],
	    a: ['target', 'href', 'title', 'rel'],
	    area: [],
	    b: [],
	    br: [],
	    col: [],
	    code: [],
	    div: [],
	    em: [],
	    hr: [],
	    h1: [],
	    h2: [],
	    h3: [],
	    h4: [],
	    h5: [],
	    h6: [],
	    i: [],
	    img: ['src', 'srcset', 'alt', 'title', 'width', 'height'],
	    li: [],
	    ol: [],
	    p: [],
	    pre: [],
	    s: [],
	    small: [],
	    span: [],
	    sub: [],
	    sup: [],
	    strong: [],
	    u: [],
	    ul: []
	  };
	  function sanitizeHtml(unsafeHtml, allowList, sanitizeFn) {
	    if (!unsafeHtml.length) {
	      return unsafeHtml;
	    }

	    if (sanitizeFn && typeof sanitizeFn === 'function') {
	      return sanitizeFn(unsafeHtml);
	    }

	    const domParser = new window.DOMParser();
	    const createdDocument = domParser.parseFromString(unsafeHtml, 'text/html');
	    const elements = [].concat(...createdDocument.body.querySelectorAll('*'));

	    for (let i = 0, len = elements.length; i < len; i++) {
	      const element = elements[i];
	      const elementName = element.nodeName.toLowerCase();

	      if (!Object.keys(allowList).includes(elementName)) {
	        element.remove();
	        continue;
	      }

	      const attributeList = [].concat(...element.attributes);
	      const allowedAttributes = [].concat(allowList['*'] || [], allowList[elementName] || []);
	      attributeList.forEach(attribute => {
	        if (!allowedAttribute(attribute, allowedAttributes)) {
	          element.removeAttribute(attribute.nodeName);
	        }
	      });
	    }

	    return createdDocument.body.innerHTML;
	  }

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): tooltip.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  /**
	   * ------------------------------------------------------------------------
	   * Constants
	   * ------------------------------------------------------------------------
	   */

	  const NAME = 'tooltip';
	  const DATA_KEY = 'bs.tooltip';
	  const EVENT_KEY = `.${DATA_KEY}`;
	  const CLASS_PREFIX = 'bs-tooltip';
	  const DISALLOWED_ATTRIBUTES = new Set(['sanitize', 'allowList', 'sanitizeFn']);
	  const DefaultType = {
	    animation: 'boolean',
	    template: 'string',
	    title: '(string|element|function)',
	    trigger: 'string',
	    delay: '(number|object)',
	    html: 'boolean',
	    selector: '(string|boolean)',
	    placement: '(string|function)',
	    offset: '(array|string|function)',
	    container: '(string|element|boolean)',
	    fallbackPlacements: 'array',
	    boundary: '(string|element)',
	    customClass: '(string|function)',
	    sanitize: 'boolean',
	    sanitizeFn: '(null|function)',
	    allowList: 'object',
	    popperConfig: '(null|object|function)'
	  };
	  const AttachmentMap = {
	    AUTO: 'auto',
	    TOP: 'top',
	    RIGHT: isRTL() ? 'left' : 'right',
	    BOTTOM: 'bottom',
	    LEFT: isRTL() ? 'right' : 'left'
	  };
	  const Default = {
	    animation: true,
	    template: '<div class="tooltip" role="tooltip">' + '<div class="tooltip-arrow"></div>' + '<div class="tooltip-inner"></div>' + '</div>',
	    trigger: 'hover focus',
	    title: '',
	    delay: 0,
	    html: false,
	    selector: false,
	    placement: 'top',
	    offset: [0, 0],
	    container: false,
	    fallbackPlacements: ['top', 'right', 'bottom', 'left'],
	    boundary: 'clippingParents',
	    customClass: '',
	    sanitize: true,
	    sanitizeFn: null,
	    allowList: DefaultAllowlist,
	    popperConfig: null
	  };
	  const Event = {
	    HIDE: `hide${EVENT_KEY}`,
	    HIDDEN: `hidden${EVENT_KEY}`,
	    SHOW: `show${EVENT_KEY}`,
	    SHOWN: `shown${EVENT_KEY}`,
	    INSERTED: `inserted${EVENT_KEY}`,
	    CLICK: `click${EVENT_KEY}`,
	    FOCUSIN: `focusin${EVENT_KEY}`,
	    FOCUSOUT: `focusout${EVENT_KEY}`,
	    MOUSEENTER: `mouseenter${EVENT_KEY}`,
	    MOUSELEAVE: `mouseleave${EVENT_KEY}`
	  };
	  const CLASS_NAME_FADE = 'fade';
	  const CLASS_NAME_MODAL = 'modal';
	  const CLASS_NAME_SHOW = 'show';
	  const HOVER_STATE_SHOW = 'show';
	  const HOVER_STATE_OUT = 'out';
	  const SELECTOR_TOOLTIP_INNER = '.tooltip-inner';
	  const SELECTOR_MODAL = `.${CLASS_NAME_MODAL}`;
	  const EVENT_MODAL_HIDE = 'hide.bs.modal';
	  const TRIGGER_HOVER = 'hover';
	  const TRIGGER_FOCUS = 'focus';
	  const TRIGGER_CLICK = 'click';
	  const TRIGGER_MANUAL = 'manual';
	  /**
	   * ------------------------------------------------------------------------
	   * Class Definition
	   * ------------------------------------------------------------------------
	   */

	  class Tooltip extends BaseComponent__default.default {
	    constructor(element, config) {
	      if (typeof Popper__namespace === 'undefined') {
	        throw new TypeError('Bootstrap\'s tooltips require Popper (https://popper.js.org)');
	      }

	      super(element); // private

	      this._isEnabled = true;
	      this._timeout = 0;
	      this._hoverState = '';
	      this._activeTrigger = {};
	      this._popper = null; // Protected

	      this._config = this._getConfig(config);
	      this.tip = null;

	      this._setListeners();
	    } // Getters


	    static get Default() {
	      return Default;
	    }

	    static get NAME() {
	      return NAME;
	    }

	    static get Event() {
	      return Event;
	    }

	    static get DefaultType() {
	      return DefaultType;
	    } // Public


	    enable() {
	      this._isEnabled = true;
	    }

	    disable() {
	      this._isEnabled = false;
	    }

	    toggleEnabled() {
	      this._isEnabled = !this._isEnabled;
	    }

	    toggle(event) {
	      if (!this._isEnabled) {
	        return;
	      }

	      if (event) {
	        const context = this._initializeOnDelegatedTarget(event);

	        context._activeTrigger.click = !context._activeTrigger.click;

	        if (context._isWithActiveTrigger()) {
	          context._enter(null, context);
	        } else {
	          context._leave(null, context);
	        }
	      } else {
	        if (this.getTipElement().classList.contains(CLASS_NAME_SHOW)) {
	          this._leave(null, this);

	          return;
	        }

	        this._enter(null, this);
	      }
	    }

	    dispose() {
	      clearTimeout(this._timeout);
	      EventHandler__default.default.off(this._element.closest(SELECTOR_MODAL), EVENT_MODAL_HIDE, this._hideModalHandler);

	      if (this.tip) {
	        this.tip.remove();
	      }

	      this._disposePopper();

	      super.dispose();
	    }

	    show() {
	      if (this._element.style.display === 'none') {
	        throw new Error('Please use show on visible elements');
	      }

	      if (!(this.isWithContent() && this._isEnabled)) {
	        return;
	      }

	      const showEvent = EventHandler__default.default.trigger(this._element, this.constructor.Event.SHOW);
	      const shadowRoot = findShadowRoot(this._element);
	      const isInTheDom = shadowRoot === null ? this._element.ownerDocument.documentElement.contains(this._element) : shadowRoot.contains(this._element);

	      if (showEvent.defaultPrevented || !isInTheDom) {
	        return;
	      } // A trick to recreate a tooltip in case a new title is given by using the NOT documented `data-bs-original-title`
	      // This will be removed later in favor of a `setContent` method


	      if (this.constructor.NAME === 'tooltip' && this.tip && this.getTitle() !== this.tip.querySelector(SELECTOR_TOOLTIP_INNER).innerHTML) {
	        this._disposePopper();

	        this.tip.remove();
	        this.tip = null;
	      }

	      const tip = this.getTipElement();
	      const tipId = getUID(this.constructor.NAME);
	      tip.setAttribute('id', tipId);

	      this._element.setAttribute('aria-describedby', tipId);

	      if (this._config.animation) {
	        tip.classList.add(CLASS_NAME_FADE);
	      }

	      const placement = typeof this._config.placement === 'function' ? this._config.placement.call(this, tip, this._element) : this._config.placement;

	      const attachment = this._getAttachment(placement);

	      this._addAttachmentClass(attachment);

	      const {
	        container
	      } = this._config;
	      Data__default.default.set(tip, this.constructor.DATA_KEY, this);

	      if (!this._element.ownerDocument.documentElement.contains(this.tip)) {
	        container.append(tip);
	        EventHandler__default.default.trigger(this._element, this.constructor.Event.INSERTED);
	      }

	      if (this._popper) {
	        this._popper.update();
	      } else {
	        this._popper = Popper__namespace.createPopper(this._element, tip, this._getPopperConfig(attachment));
	      }

	      tip.classList.add(CLASS_NAME_SHOW);

	      const customClass = this._resolvePossibleFunction(this._config.customClass);

	      if (customClass) {
	        tip.classList.add(...customClass.split(' '));
	      } // If this is a touch-enabled device we add extra
	      // empty mouseover listeners to the body's immediate children;
	      // only needed because of broken event delegation on iOS
	      // https://www.quirksmode.org/blog/archives/2014/02/mouse_event_bub.html


	      if ('ontouchstart' in document.documentElement) {
	        [].concat(...document.body.children).forEach(element => {
	          EventHandler__default.default.on(element, 'mouseover', noop);
	        });
	      }

	      const complete = () => {
	        const prevHoverState = this._hoverState;
	        this._hoverState = null;
	        EventHandler__default.default.trigger(this._element, this.constructor.Event.SHOWN);

	        if (prevHoverState === HOVER_STATE_OUT) {
	          this._leave(null, this);
	        }
	      };

	      const isAnimated = this.tip.classList.contains(CLASS_NAME_FADE);

	      this._queueCallback(complete, this.tip, isAnimated);
	    }

	    hide() {
	      if (!this._popper) {
	        return;
	      }

	      const tip = this.getTipElement();

	      const complete = () => {
	        if (this._isWithActiveTrigger()) {
	          return;
	        }

	        if (this._hoverState !== HOVER_STATE_SHOW) {
	          tip.remove();
	        }

	        this._cleanTipClass();

	        this._element.removeAttribute('aria-describedby');

	        EventHandler__default.default.trigger(this._element, this.constructor.Event.HIDDEN);

	        this._disposePopper();
	      };

	      const hideEvent = EventHandler__default.default.trigger(this._element, this.constructor.Event.HIDE);

	      if (hideEvent.defaultPrevented) {
	        return;
	      }

	      tip.classList.remove(CLASS_NAME_SHOW); // If this is a touch-enabled device we remove the extra
	      // empty mouseover listeners we added for iOS support

	      if ('ontouchstart' in document.documentElement) {
	        [].concat(...document.body.children).forEach(element => EventHandler__default.default.off(element, 'mouseover', noop));
	      }

	      this._activeTrigger[TRIGGER_CLICK] = false;
	      this._activeTrigger[TRIGGER_FOCUS] = false;
	      this._activeTrigger[TRIGGER_HOVER] = false;
	      const isAnimated = this.tip.classList.contains(CLASS_NAME_FADE);

	      this._queueCallback(complete, this.tip, isAnimated);

	      this._hoverState = '';
	    }

	    update() {
	      if (this._popper !== null) {
	        this._popper.update();
	      }
	    } // Protected


	    isWithContent() {
	      return Boolean(this.getTitle());
	    }

	    getTipElement() {
	      if (this.tip) {
	        return this.tip;
	      }

	      const element = document.createElement('div');
	      element.innerHTML = this._config.template;
	      const tip = element.children[0];
	      this.setContent(tip);
	      tip.classList.remove(CLASS_NAME_FADE, CLASS_NAME_SHOW);
	      this.tip = tip;
	      return this.tip;
	    }

	    setContent(tip) {
	      this._sanitizeAndSetContent(tip, this.getTitle(), SELECTOR_TOOLTIP_INNER);
	    }

	    _sanitizeAndSetContent(template, content, selector) {
	      const templateElement = SelectorEngine__default.default.findOne(selector, template);

	      if (!content && templateElement) {
	        templateElement.remove();
	        return;
	      } // we use append for html objects to maintain js events


	      this.setElementContent(templateElement, content);
	    }

	    setElementContent(element, content) {
	      if (element === null) {
	        return;
	      }

	      if (isElement(content)) {
	        content = getElement(content); // content is a DOM node or a jQuery

	        if (this._config.html) {
	          if (content.parentNode !== element) {
	            element.innerHTML = '';
	            element.append(content);
	          }
	        } else {
	          element.textContent = content.textContent;
	        }

	        return;
	      }

	      if (this._config.html) {
	        if (this._config.sanitize) {
	          content = sanitizeHtml(content, this._config.allowList, this._config.sanitizeFn);
	        }

	        element.innerHTML = content;
	      } else {
	        element.textContent = content;
	      }
	    }

	    getTitle() {
	      const title = this._element.getAttribute('data-bs-original-title') || this._config.title;

	      return this._resolvePossibleFunction(title);
	    }

	    updateAttachment(attachment) {
	      if (attachment === 'right') {
	        return 'end';
	      }

	      if (attachment === 'left') {
	        return 'start';
	      }

	      return attachment;
	    } // Private


	    _initializeOnDelegatedTarget(event, context) {
	      return context || this.constructor.getOrCreateInstance(event.delegateTarget, this._getDelegateConfig());
	    }

	    _getOffset() {
	      const {
	        offset
	      } = this._config;

	      if (typeof offset === 'string') {
	        return offset.split(',').map(val => Number.parseInt(val, 10));
	      }

	      if (typeof offset === 'function') {
	        return popperData => offset(popperData, this._element);
	      }

	      return offset;
	    }

	    _resolvePossibleFunction(content) {
	      return typeof content === 'function' ? content.call(this._element) : content;
	    }

	    _getPopperConfig(attachment) {
	      const defaultBsPopperConfig = {
	        placement: attachment,
	        modifiers: [{
	          name: 'flip',
	          options: {
	            fallbackPlacements: this._config.fallbackPlacements
	          }
	        }, {
	          name: 'offset',
	          options: {
	            offset: this._getOffset()
	          }
	        }, {
	          name: 'preventOverflow',
	          options: {
	            boundary: this._config.boundary
	          }
	        }, {
	          name: 'arrow',
	          options: {
	            element: `.${this.constructor.NAME}-arrow`
	          }
	        }, {
	          name: 'onChange',
	          enabled: true,
	          phase: 'afterWrite',
	          fn: data => this._handlePopperPlacementChange(data)
	        }],
	        onFirstUpdate: data => {
	          if (data.options.placement !== data.placement) {
	            this._handlePopperPlacementChange(data);
	          }
	        }
	      };
	      return { ...defaultBsPopperConfig,
	        ...(typeof this._config.popperConfig === 'function' ? this._config.popperConfig(defaultBsPopperConfig) : this._config.popperConfig)
	      };
	    }

	    _addAttachmentClass(attachment) {
	      this.getTipElement().classList.add(`${this._getBasicClassPrefix()}-${this.updateAttachment(attachment)}`);
	    }

	    _getAttachment(placement) {
	      return AttachmentMap[placement.toUpperCase()];
	    }

	    _setListeners() {
	      const triggers = this._config.trigger.split(' ');

	      triggers.forEach(trigger => {
	        if (trigger === 'click') {
	          EventHandler__default.default.on(this._element, this.constructor.Event.CLICK, this._config.selector, event => this.toggle(event));
	        } else if (trigger !== TRIGGER_MANUAL) {
	          const eventIn = trigger === TRIGGER_HOVER ? this.constructor.Event.MOUSEENTER : this.constructor.Event.FOCUSIN;
	          const eventOut = trigger === TRIGGER_HOVER ? this.constructor.Event.MOUSELEAVE : this.constructor.Event.FOCUSOUT;
	          EventHandler__default.default.on(this._element, eventIn, this._config.selector, event => this._enter(event));
	          EventHandler__default.default.on(this._element, eventOut, this._config.selector, event => this._leave(event));
	        }
	      });

	      this._hideModalHandler = () => {
	        if (this._element) {
	          this.hide();
	        }
	      };

	      EventHandler__default.default.on(this._element.closest(SELECTOR_MODAL), EVENT_MODAL_HIDE, this._hideModalHandler);

	      if (this._config.selector) {
	        this._config = { ...this._config,
	          trigger: 'manual',
	          selector: ''
	        };
	      } else {
	        this._fixTitle();
	      }
	    }

	    _fixTitle() {
	      const title = this._element.getAttribute('title');

	      const originalTitleType = typeof this._element.getAttribute('data-bs-original-title');

	      if (title || originalTitleType !== 'string') {
	        this._element.setAttribute('data-bs-original-title', title || '');

	        if (title && !this._element.getAttribute('aria-label') && !this._element.textContent) {
	          this._element.setAttribute('aria-label', title);
	        }

	        this._element.setAttribute('title', '');
	      }
	    }

	    _enter(event, context) {
	      context = this._initializeOnDelegatedTarget(event, context);

	      if (event) {
	        context._activeTrigger[event.type === 'focusin' ? TRIGGER_FOCUS : TRIGGER_HOVER] = true;
	      }

	      if (context.getTipElement().classList.contains(CLASS_NAME_SHOW) || context._hoverState === HOVER_STATE_SHOW) {
	        context._hoverState = HOVER_STATE_SHOW;
	        return;
	      }

	      clearTimeout(context._timeout);
	      context._hoverState = HOVER_STATE_SHOW;

	      if (!context._config.delay || !context._config.delay.show) {
	        context.show();
	        return;
	      }

	      context._timeout = setTimeout(() => {
	        if (context._hoverState === HOVER_STATE_SHOW) {
	          context.show();
	        }
	      }, context._config.delay.show);
	    }

	    _leave(event, context) {
	      context = this._initializeOnDelegatedTarget(event, context);

	      if (event) {
	        context._activeTrigger[event.type === 'focusout' ? TRIGGER_FOCUS : TRIGGER_HOVER] = context._element.contains(event.relatedTarget);
	      }

	      if (context._isWithActiveTrigger()) {
	        return;
	      }

	      clearTimeout(context._timeout);
	      context._hoverState = HOVER_STATE_OUT;

	      if (!context._config.delay || !context._config.delay.hide) {
	        context.hide();
	        return;
	      }

	      context._timeout = setTimeout(() => {
	        if (context._hoverState === HOVER_STATE_OUT) {
	          context.hide();
	        }
	      }, context._config.delay.hide);
	    }

	    _isWithActiveTrigger() {
	      for (const trigger in this._activeTrigger) {
	        if (this._activeTrigger[trigger]) {
	          return true;
	        }
	      }

	      return false;
	    }

	    _getConfig(config) {
	      const dataAttributes = Manipulator__default.default.getDataAttributes(this._element);
	      Object.keys(dataAttributes).forEach(dataAttr => {
	        if (DISALLOWED_ATTRIBUTES.has(dataAttr)) {
	          delete dataAttributes[dataAttr];
	        }
	      });
	      config = { ...this.constructor.Default,
	        ...dataAttributes,
	        ...(typeof config === 'object' && config ? config : {})
	      };
	      config.container = config.container === false ? document.body : getElement(config.container);

	      if (typeof config.delay === 'number') {
	        config.delay = {
	          show: config.delay,
	          hide: config.delay
	        };
	      }

	      if (typeof config.title === 'number') {
	        config.title = config.title.toString();
	      }

	      if (typeof config.content === 'number') {
	        config.content = config.content.toString();
	      }

	      typeCheckConfig(NAME, config, this.constructor.DefaultType);

	      if (config.sanitize) {
	        config.template = sanitizeHtml(config.template, config.allowList, config.sanitizeFn);
	      }

	      return config;
	    }

	    _getDelegateConfig() {
	      const config = {};

	      for (const key in this._config) {
	        if (this.constructor.Default[key] !== this._config[key]) {
	          config[key] = this._config[key];
	        }
	      } // In the future can be replaced with:
	      // const keysWithDifferentValues = Object.entries(this._config).filter(entry => this.constructor.Default[entry[0]] !== this._config[entry[0]])
	      // `Object.fromEntries(keysWithDifferentValues)`


	      return config;
	    }

	    _cleanTipClass() {
	      const tip = this.getTipElement();
	      const basicClassPrefixRegex = new RegExp(`(^|\\s)${this._getBasicClassPrefix()}\\S+`, 'g');
	      const tabClass = tip.getAttribute('class').match(basicClassPrefixRegex);

	      if (tabClass !== null && tabClass.length > 0) {
	        tabClass.map(token => token.trim()).forEach(tClass => tip.classList.remove(tClass));
	      }
	    }

	    _getBasicClassPrefix() {
	      return CLASS_PREFIX;
	    }

	    _handlePopperPlacementChange(popperData) {
	      const {
	        state
	      } = popperData;

	      if (!state) {
	        return;
	      }

	      this.tip = state.elements.popper;

	      this._cleanTipClass();

	      this._addAttachmentClass(this._getAttachment(state.placement));
	    }

	    _disposePopper() {
	      if (this._popper) {
	        this._popper.destroy();

	        this._popper = null;
	      }
	    } // Static


	    static jQueryInterface(config) {
	      return this.each(function () {
	        const data = Tooltip.getOrCreateInstance(this, config);

	        if (typeof config === 'string') {
	          if (typeof data[config] === 'undefined') {
	            throw new TypeError(`No method named "${config}"`);
	          }

	          data[config]();
	        }
	      });
	    }

	  }
	  /**
	   * ------------------------------------------------------------------------
	   * jQuery
	   * ------------------------------------------------------------------------
	   * add .Tooltip to jQuery only if jQuery is present
	   */


	  defineJQueryPlugin(Tooltip);

	  return Tooltip;

	}));

	}(tooltip$1));

	var tooltip = /*@__PURE__*/getDefaultExportFromCjs(tooltip$1.exports);

	/*!
	  * Bootstrap popover.js v5.1.3 (https://getbootstrap.com/)
	  * Copyright 2011-2021 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
	  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	  */

	(function (module, exports) {
	(function (global, factory) {
	  module.exports = factory(tooltip$1.exports) ;
	})(commonjsGlobal, (function (Tooltip) {
	  const _interopDefaultLegacy = e => e && typeof e === 'object' && 'default' in e ? e : { default: e };

	  const Tooltip__default = /*#__PURE__*/_interopDefaultLegacy(Tooltip);

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/index.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */

	  const getjQuery = () => {
	    const {
	      jQuery
	    } = window;

	    if (jQuery && !document.body.hasAttribute('data-bs-no-jquery')) {
	      return jQuery;
	    }

	    return null;
	  };

	  const DOMContentLoadedCallbacks = [];

	  const onDOMContentLoaded = callback => {
	    if (document.readyState === 'loading') {
	      // add listener on the first call when the document is in loading state
	      if (!DOMContentLoadedCallbacks.length) {
	        document.addEventListener('DOMContentLoaded', () => {
	          DOMContentLoadedCallbacks.forEach(callback => callback());
	        });
	      }

	      DOMContentLoadedCallbacks.push(callback);
	    } else {
	      callback();
	    }
	  };

	  const defineJQueryPlugin = plugin => {
	    onDOMContentLoaded(() => {
	      const $ = getjQuery();
	      /* istanbul ignore if */

	      if ($) {
	        const name = plugin.NAME;
	        const JQUERY_NO_CONFLICT = $.fn[name];
	        $.fn[name] = plugin.jQueryInterface;
	        $.fn[name].Constructor = plugin;

	        $.fn[name].noConflict = () => {
	          $.fn[name] = JQUERY_NO_CONFLICT;
	          return plugin.jQueryInterface;
	        };
	      }
	    });
	  };

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): popover.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  /**
	   * ------------------------------------------------------------------------
	   * Constants
	   * ------------------------------------------------------------------------
	   */

	  const NAME = 'popover';
	  const DATA_KEY = 'bs.popover';
	  const EVENT_KEY = `.${DATA_KEY}`;
	  const CLASS_PREFIX = 'bs-popover';
	  const Default = { ...Tooltip__default.default.Default,
	    placement: 'right',
	    offset: [0, 8],
	    trigger: 'click',
	    content: '',
	    template: '<div class="popover" role="tooltip">' + '<div class="popover-arrow"></div>' + '<h3 class="popover-header"></h3>' + '<div class="popover-body"></div>' + '</div>'
	  };
	  const DefaultType = { ...Tooltip__default.default.DefaultType,
	    content: '(string|element|function)'
	  };
	  const Event = {
	    HIDE: `hide${EVENT_KEY}`,
	    HIDDEN: `hidden${EVENT_KEY}`,
	    SHOW: `show${EVENT_KEY}`,
	    SHOWN: `shown${EVENT_KEY}`,
	    INSERTED: `inserted${EVENT_KEY}`,
	    CLICK: `click${EVENT_KEY}`,
	    FOCUSIN: `focusin${EVENT_KEY}`,
	    FOCUSOUT: `focusout${EVENT_KEY}`,
	    MOUSEENTER: `mouseenter${EVENT_KEY}`,
	    MOUSELEAVE: `mouseleave${EVENT_KEY}`
	  };
	  const SELECTOR_TITLE = '.popover-header';
	  const SELECTOR_CONTENT = '.popover-body';
	  /**
	   * ------------------------------------------------------------------------
	   * Class Definition
	   * ------------------------------------------------------------------------
	   */

	  class Popover extends Tooltip__default.default {
	    // Getters
	    static get Default() {
	      return Default;
	    }

	    static get NAME() {
	      return NAME;
	    }

	    static get Event() {
	      return Event;
	    }

	    static get DefaultType() {
	      return DefaultType;
	    } // Overrides


	    isWithContent() {
	      return this.getTitle() || this._getContent();
	    }

	    setContent(tip) {
	      this._sanitizeAndSetContent(tip, this.getTitle(), SELECTOR_TITLE);

	      this._sanitizeAndSetContent(tip, this._getContent(), SELECTOR_CONTENT);
	    } // Private


	    _getContent() {
	      return this._resolvePossibleFunction(this._config.content);
	    }

	    _getBasicClassPrefix() {
	      return CLASS_PREFIX;
	    } // Static


	    static jQueryInterface(config) {
	      return this.each(function () {
	        const data = Popover.getOrCreateInstance(this, config);

	        if (typeof config === 'string') {
	          if (typeof data[config] === 'undefined') {
	            throw new TypeError(`No method named "${config}"`);
	          }

	          data[config]();
	        }
	      });
	    }

	  }
	  /**
	   * ------------------------------------------------------------------------
	   * jQuery
	   * ------------------------------------------------------------------------
	   * add .Popover to jQuery only if jQuery is present
	   */


	  defineJQueryPlugin(Popover);

	  return Popover;

	}));

	}(popover$1));

	var popover = popover$1.exports;

	var scrollspy$1 = {exports: {}};

	/*!
	  * Bootstrap scrollspy.js v5.1.3 (https://getbootstrap.com/)
	  * Copyright 2011-2021 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
	  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	  */

	(function (module, exports) {
	(function (global, factory) {
	  module.exports = factory(eventHandler.exports, manipulator.exports, selectorEngine.exports, baseComponent.exports) ;
	})(commonjsGlobal, (function (EventHandler, Manipulator, SelectorEngine, BaseComponent) {
	  const _interopDefaultLegacy = e => e && typeof e === 'object' && 'default' in e ? e : { default: e };

	  const EventHandler__default = /*#__PURE__*/_interopDefaultLegacy(EventHandler);
	  const Manipulator__default = /*#__PURE__*/_interopDefaultLegacy(Manipulator);
	  const SelectorEngine__default = /*#__PURE__*/_interopDefaultLegacy(SelectorEngine);
	  const BaseComponent__default = /*#__PURE__*/_interopDefaultLegacy(BaseComponent);

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/index.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */

	  const toType = obj => {
	    if (obj === null || obj === undefined) {
	      return `${obj}`;
	    }

	    return {}.toString.call(obj).match(/\s([a-z]+)/i)[1].toLowerCase();
	  };

	  const getSelector = element => {
	    let selector = element.getAttribute('data-bs-target');

	    if (!selector || selector === '#') {
	      let hrefAttr = element.getAttribute('href'); // The only valid content that could double as a selector are IDs or classes,
	      // so everything starting with `#` or `.`. If a "real" URL is used as the selector,
	      // `document.querySelector` will rightfully complain it is invalid.
	      // See https://github.com/twbs/bootstrap/issues/32273

	      if (!hrefAttr || !hrefAttr.includes('#') && !hrefAttr.startsWith('.')) {
	        return null;
	      } // Just in case some CMS puts out a full URL with the anchor appended


	      if (hrefAttr.includes('#') && !hrefAttr.startsWith('#')) {
	        hrefAttr = `#${hrefAttr.split('#')[1]}`;
	      }

	      selector = hrefAttr && hrefAttr !== '#' ? hrefAttr.trim() : null;
	    }

	    return selector;
	  };

	  const getSelectorFromElement = element => {
	    const selector = getSelector(element);

	    if (selector) {
	      return document.querySelector(selector) ? selector : null;
	    }

	    return null;
	  };

	  const isElement = obj => {
	    if (!obj || typeof obj !== 'object') {
	      return false;
	    }

	    if (typeof obj.jquery !== 'undefined') {
	      obj = obj[0];
	    }

	    return typeof obj.nodeType !== 'undefined';
	  };

	  const getElement = obj => {
	    if (isElement(obj)) {
	      // it's a jQuery object or a node element
	      return obj.jquery ? obj[0] : obj;
	    }

	    if (typeof obj === 'string' && obj.length > 0) {
	      return document.querySelector(obj);
	    }

	    return null;
	  };

	  const typeCheckConfig = (componentName, config, configTypes) => {
	    Object.keys(configTypes).forEach(property => {
	      const expectedTypes = configTypes[property];
	      const value = config[property];
	      const valueType = value && isElement(value) ? 'element' : toType(value);

	      if (!new RegExp(expectedTypes).test(valueType)) {
	        throw new TypeError(`${componentName.toUpperCase()}: Option "${property}" provided type "${valueType}" but expected type "${expectedTypes}".`);
	      }
	    });
	  };

	  const getjQuery = () => {
	    const {
	      jQuery
	    } = window;

	    if (jQuery && !document.body.hasAttribute('data-bs-no-jquery')) {
	      return jQuery;
	    }

	    return null;
	  };

	  const DOMContentLoadedCallbacks = [];

	  const onDOMContentLoaded = callback => {
	    if (document.readyState === 'loading') {
	      // add listener on the first call when the document is in loading state
	      if (!DOMContentLoadedCallbacks.length) {
	        document.addEventListener('DOMContentLoaded', () => {
	          DOMContentLoadedCallbacks.forEach(callback => callback());
	        });
	      }

	      DOMContentLoadedCallbacks.push(callback);
	    } else {
	      callback();
	    }
	  };

	  const defineJQueryPlugin = plugin => {
	    onDOMContentLoaded(() => {
	      const $ = getjQuery();
	      /* istanbul ignore if */

	      if ($) {
	        const name = plugin.NAME;
	        const JQUERY_NO_CONFLICT = $.fn[name];
	        $.fn[name] = plugin.jQueryInterface;
	        $.fn[name].Constructor = plugin;

	        $.fn[name].noConflict = () => {
	          $.fn[name] = JQUERY_NO_CONFLICT;
	          return plugin.jQueryInterface;
	        };
	      }
	    });
	  };

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): scrollspy.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  /**
	   * ------------------------------------------------------------------------
	   * Constants
	   * ------------------------------------------------------------------------
	   */

	  const NAME = 'scrollspy';
	  const DATA_KEY = 'bs.scrollspy';
	  const EVENT_KEY = `.${DATA_KEY}`;
	  const DATA_API_KEY = '.data-api';
	  const Default = {
	    offset: 10,
	    method: 'auto',
	    target: ''
	  };
	  const DefaultType = {
	    offset: 'number',
	    method: 'string',
	    target: '(string|element)'
	  };
	  const EVENT_ACTIVATE = `activate${EVENT_KEY}`;
	  const EVENT_SCROLL = `scroll${EVENT_KEY}`;
	  const EVENT_LOAD_DATA_API = `load${EVENT_KEY}${DATA_API_KEY}`;
	  const CLASS_NAME_DROPDOWN_ITEM = 'dropdown-item';
	  const CLASS_NAME_ACTIVE = 'active';
	  const SELECTOR_DATA_SPY = '[data-bs-spy="scroll"]';
	  const SELECTOR_NAV_LIST_GROUP = '.nav, .list-group';
	  const SELECTOR_NAV_LINKS = '.nav-link';
	  const SELECTOR_NAV_ITEMS = '.nav-item';
	  const SELECTOR_LIST_ITEMS = '.list-group-item';
	  const SELECTOR_LINK_ITEMS = `${SELECTOR_NAV_LINKS}, ${SELECTOR_LIST_ITEMS}, .${CLASS_NAME_DROPDOWN_ITEM}`;
	  const SELECTOR_DROPDOWN = '.dropdown';
	  const SELECTOR_DROPDOWN_TOGGLE = '.dropdown-toggle';
	  const METHOD_OFFSET = 'offset';
	  const METHOD_POSITION = 'position';
	  /**
	   * ------------------------------------------------------------------------
	   * Class Definition
	   * ------------------------------------------------------------------------
	   */

	  class ScrollSpy extends BaseComponent__default.default {
	    constructor(element, config) {
	      super(element);
	      this._scrollElement = this._element.tagName === 'BODY' ? window : this._element;
	      this._config = this._getConfig(config);
	      this._offsets = [];
	      this._targets = [];
	      this._activeTarget = null;
	      this._scrollHeight = 0;
	      EventHandler__default.default.on(this._scrollElement, EVENT_SCROLL, () => this._process());
	      this.refresh();

	      this._process();
	    } // Getters


	    static get Default() {
	      return Default;
	    }

	    static get NAME() {
	      return NAME;
	    } // Public


	    refresh() {
	      const autoMethod = this._scrollElement === this._scrollElement.window ? METHOD_OFFSET : METHOD_POSITION;
	      const offsetMethod = this._config.method === 'auto' ? autoMethod : this._config.method;
	      const offsetBase = offsetMethod === METHOD_POSITION ? this._getScrollTop() : 0;
	      this._offsets = [];
	      this._targets = [];
	      this._scrollHeight = this._getScrollHeight();
	      const targets = SelectorEngine__default.default.find(SELECTOR_LINK_ITEMS, this._config.target);
	      targets.map(element => {
	        const targetSelector = getSelectorFromElement(element);
	        const target = targetSelector ? SelectorEngine__default.default.findOne(targetSelector) : null;

	        if (target) {
	          const targetBCR = target.getBoundingClientRect();

	          if (targetBCR.width || targetBCR.height) {
	            return [Manipulator__default.default[offsetMethod](target).top + offsetBase, targetSelector];
	          }
	        }

	        return null;
	      }).filter(item => item).sort((a, b) => a[0] - b[0]).forEach(item => {
	        this._offsets.push(item[0]);

	        this._targets.push(item[1]);
	      });
	    }

	    dispose() {
	      EventHandler__default.default.off(this._scrollElement, EVENT_KEY);
	      super.dispose();
	    } // Private


	    _getConfig(config) {
	      config = { ...Default,
	        ...Manipulator__default.default.getDataAttributes(this._element),
	        ...(typeof config === 'object' && config ? config : {})
	      };
	      config.target = getElement(config.target) || document.documentElement;
	      typeCheckConfig(NAME, config, DefaultType);
	      return config;
	    }

	    _getScrollTop() {
	      return this._scrollElement === window ? this._scrollElement.pageYOffset : this._scrollElement.scrollTop;
	    }

	    _getScrollHeight() {
	      return this._scrollElement.scrollHeight || Math.max(document.body.scrollHeight, document.documentElement.scrollHeight);
	    }

	    _getOffsetHeight() {
	      return this._scrollElement === window ? window.innerHeight : this._scrollElement.getBoundingClientRect().height;
	    }

	    _process() {
	      const scrollTop = this._getScrollTop() + this._config.offset;

	      const scrollHeight = this._getScrollHeight();

	      const maxScroll = this._config.offset + scrollHeight - this._getOffsetHeight();

	      if (this._scrollHeight !== scrollHeight) {
	        this.refresh();
	      }

	      if (scrollTop >= maxScroll) {
	        const target = this._targets[this._targets.length - 1];

	        if (this._activeTarget !== target) {
	          this._activate(target);
	        }

	        return;
	      }

	      if (this._activeTarget && scrollTop < this._offsets[0] && this._offsets[0] > 0) {
	        this._activeTarget = null;

	        this._clear();

	        return;
	      }

	      for (let i = this._offsets.length; i--;) {
	        const isActiveTarget = this._activeTarget !== this._targets[i] && scrollTop >= this._offsets[i] && (typeof this._offsets[i + 1] === 'undefined' || scrollTop < this._offsets[i + 1]);

	        if (isActiveTarget) {
	          this._activate(this._targets[i]);
	        }
	      }
	    }

	    _activate(target) {
	      this._activeTarget = target;

	      this._clear();

	      const queries = SELECTOR_LINK_ITEMS.split(',').map(selector => `${selector}[data-bs-target="${target}"],${selector}[href="${target}"]`);
	      const link = SelectorEngine__default.default.findOne(queries.join(','), this._config.target);
	      link.classList.add(CLASS_NAME_ACTIVE);

	      if (link.classList.contains(CLASS_NAME_DROPDOWN_ITEM)) {
	        SelectorEngine__default.default.findOne(SELECTOR_DROPDOWN_TOGGLE, link.closest(SELECTOR_DROPDOWN)).classList.add(CLASS_NAME_ACTIVE);
	      } else {
	        SelectorEngine__default.default.parents(link, SELECTOR_NAV_LIST_GROUP).forEach(listGroup => {
	          // Set triggered links parents as active
	          // With both <ul> and <nav> markup a parent is the previous sibling of any nav ancestor
	          SelectorEngine__default.default.prev(listGroup, `${SELECTOR_NAV_LINKS}, ${SELECTOR_LIST_ITEMS}`).forEach(item => item.classList.add(CLASS_NAME_ACTIVE)); // Handle special case when .nav-link is inside .nav-item

	          SelectorEngine__default.default.prev(listGroup, SELECTOR_NAV_ITEMS).forEach(navItem => {
	            SelectorEngine__default.default.children(navItem, SELECTOR_NAV_LINKS).forEach(item => item.classList.add(CLASS_NAME_ACTIVE));
	          });
	        });
	      }

	      EventHandler__default.default.trigger(this._scrollElement, EVENT_ACTIVATE, {
	        relatedTarget: target
	      });
	    }

	    _clear() {
	      SelectorEngine__default.default.find(SELECTOR_LINK_ITEMS, this._config.target).filter(node => node.classList.contains(CLASS_NAME_ACTIVE)).forEach(node => node.classList.remove(CLASS_NAME_ACTIVE));
	    } // Static


	    static jQueryInterface(config) {
	      return this.each(function () {
	        const data = ScrollSpy.getOrCreateInstance(this, config);

	        if (typeof config !== 'string') {
	          return;
	        }

	        if (typeof data[config] === 'undefined') {
	          throw new TypeError(`No method named "${config}"`);
	        }

	        data[config]();
	      });
	    }

	  }
	  /**
	   * ------------------------------------------------------------------------
	   * Data Api implementation
	   * ------------------------------------------------------------------------
	   */


	  EventHandler__default.default.on(window, EVENT_LOAD_DATA_API, () => {
	    SelectorEngine__default.default.find(SELECTOR_DATA_SPY).forEach(spy => new ScrollSpy(spy));
	  });
	  /**
	   * ------------------------------------------------------------------------
	   * jQuery
	   * ------------------------------------------------------------------------
	   * add .ScrollSpy to jQuery only if jQuery is present
	   */

	  defineJQueryPlugin(ScrollSpy);

	  return ScrollSpy;

	}));

	}(scrollspy$1));

	var scrollspy = scrollspy$1.exports;

	var tab$1 = {exports: {}};

	/*!
	  * Bootstrap tab.js v5.1.3 (https://getbootstrap.com/)
	  * Copyright 2011-2021 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
	  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	  */

	(function (module, exports) {
	(function (global, factory) {
	  module.exports = factory(eventHandler.exports, selectorEngine.exports, baseComponent.exports) ;
	})(commonjsGlobal, (function (EventHandler, SelectorEngine, BaseComponent) {
	  const _interopDefaultLegacy = e => e && typeof e === 'object' && 'default' in e ? e : { default: e };

	  const EventHandler__default = /*#__PURE__*/_interopDefaultLegacy(EventHandler);
	  const SelectorEngine__default = /*#__PURE__*/_interopDefaultLegacy(SelectorEngine);
	  const BaseComponent__default = /*#__PURE__*/_interopDefaultLegacy(BaseComponent);

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/index.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */

	  const getSelector = element => {
	    let selector = element.getAttribute('data-bs-target');

	    if (!selector || selector === '#') {
	      let hrefAttr = element.getAttribute('href'); // The only valid content that could double as a selector are IDs or classes,
	      // so everything starting with `#` or `.`. If a "real" URL is used as the selector,
	      // `document.querySelector` will rightfully complain it is invalid.
	      // See https://github.com/twbs/bootstrap/issues/32273

	      if (!hrefAttr || !hrefAttr.includes('#') && !hrefAttr.startsWith('.')) {
	        return null;
	      } // Just in case some CMS puts out a full URL with the anchor appended


	      if (hrefAttr.includes('#') && !hrefAttr.startsWith('#')) {
	        hrefAttr = `#${hrefAttr.split('#')[1]}`;
	      }

	      selector = hrefAttr && hrefAttr !== '#' ? hrefAttr.trim() : null;
	    }

	    return selector;
	  };

	  const getElementFromSelector = element => {
	    const selector = getSelector(element);
	    return selector ? document.querySelector(selector) : null;
	  };

	  const isDisabled = element => {
	    if (!element || element.nodeType !== Node.ELEMENT_NODE) {
	      return true;
	    }

	    if (element.classList.contains('disabled')) {
	      return true;
	    }

	    if (typeof element.disabled !== 'undefined') {
	      return element.disabled;
	    }

	    return element.hasAttribute('disabled') && element.getAttribute('disabled') !== 'false';
	  };
	  /**
	   * Trick to restart an element's animation
	   *
	   * @param {HTMLElement} element
	   * @return void
	   *
	   * @see https://www.charistheo.io/blog/2021/02/restart-a-css-animation-with-javascript/#restarting-a-css-animation
	   */


	  const reflow = element => {
	    // eslint-disable-next-line no-unused-expressions
	    element.offsetHeight;
	  };

	  const getjQuery = () => {
	    const {
	      jQuery
	    } = window;

	    if (jQuery && !document.body.hasAttribute('data-bs-no-jquery')) {
	      return jQuery;
	    }

	    return null;
	  };

	  const DOMContentLoadedCallbacks = [];

	  const onDOMContentLoaded = callback => {
	    if (document.readyState === 'loading') {
	      // add listener on the first call when the document is in loading state
	      if (!DOMContentLoadedCallbacks.length) {
	        document.addEventListener('DOMContentLoaded', () => {
	          DOMContentLoadedCallbacks.forEach(callback => callback());
	        });
	      }

	      DOMContentLoadedCallbacks.push(callback);
	    } else {
	      callback();
	    }
	  };

	  const defineJQueryPlugin = plugin => {
	    onDOMContentLoaded(() => {
	      const $ = getjQuery();
	      /* istanbul ignore if */

	      if ($) {
	        const name = plugin.NAME;
	        const JQUERY_NO_CONFLICT = $.fn[name];
	        $.fn[name] = plugin.jQueryInterface;
	        $.fn[name].Constructor = plugin;

	        $.fn[name].noConflict = () => {
	          $.fn[name] = JQUERY_NO_CONFLICT;
	          return plugin.jQueryInterface;
	        };
	      }
	    });
	  };

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): tab.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  /**
	   * ------------------------------------------------------------------------
	   * Constants
	   * ------------------------------------------------------------------------
	   */

	  const NAME = 'tab';
	  const DATA_KEY = 'bs.tab';
	  const EVENT_KEY = `.${DATA_KEY}`;
	  const DATA_API_KEY = '.data-api';
	  const EVENT_HIDE = `hide${EVENT_KEY}`;
	  const EVENT_HIDDEN = `hidden${EVENT_KEY}`;
	  const EVENT_SHOW = `show${EVENT_KEY}`;
	  const EVENT_SHOWN = `shown${EVENT_KEY}`;
	  const EVENT_CLICK_DATA_API = `click${EVENT_KEY}${DATA_API_KEY}`;
	  const CLASS_NAME_DROPDOWN_MENU = 'dropdown-menu';
	  const CLASS_NAME_ACTIVE = 'active';
	  const CLASS_NAME_FADE = 'fade';
	  const CLASS_NAME_SHOW = 'show';
	  const SELECTOR_DROPDOWN = '.dropdown';
	  const SELECTOR_NAV_LIST_GROUP = '.nav, .list-group';
	  const SELECTOR_ACTIVE = '.active';
	  const SELECTOR_ACTIVE_UL = ':scope > li > .active';
	  const SELECTOR_DATA_TOGGLE = '[data-bs-toggle="tab"], [data-bs-toggle="pill"], [data-bs-toggle="list"]';
	  const SELECTOR_DROPDOWN_TOGGLE = '.dropdown-toggle';
	  const SELECTOR_DROPDOWN_ACTIVE_CHILD = ':scope > .dropdown-menu .active';
	  /**
	   * ------------------------------------------------------------------------
	   * Class Definition
	   * ------------------------------------------------------------------------
	   */

	  class Tab extends BaseComponent__default.default {
	    // Getters
	    static get NAME() {
	      return NAME;
	    } // Public


	    show() {
	      if (this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE && this._element.classList.contains(CLASS_NAME_ACTIVE)) {
	        return;
	      }

	      let previous;
	      const target = getElementFromSelector(this._element);

	      const listElement = this._element.closest(SELECTOR_NAV_LIST_GROUP);

	      if (listElement) {
	        const itemSelector = listElement.nodeName === 'UL' || listElement.nodeName === 'OL' ? SELECTOR_ACTIVE_UL : SELECTOR_ACTIVE;
	        previous = SelectorEngine__default.default.find(itemSelector, listElement);
	        previous = previous[previous.length - 1];
	      }

	      const hideEvent = previous ? EventHandler__default.default.trigger(previous, EVENT_HIDE, {
	        relatedTarget: this._element
	      }) : null;
	      const showEvent = EventHandler__default.default.trigger(this._element, EVENT_SHOW, {
	        relatedTarget: previous
	      });

	      if (showEvent.defaultPrevented || hideEvent !== null && hideEvent.defaultPrevented) {
	        return;
	      }

	      this._activate(this._element, listElement);

	      const complete = () => {
	        EventHandler__default.default.trigger(previous, EVENT_HIDDEN, {
	          relatedTarget: this._element
	        });
	        EventHandler__default.default.trigger(this._element, EVENT_SHOWN, {
	          relatedTarget: previous
	        });
	      };

	      if (target) {
	        this._activate(target, target.parentNode, complete);
	      } else {
	        complete();
	      }
	    } // Private


	    _activate(element, container, callback) {
	      const activeElements = container && (container.nodeName === 'UL' || container.nodeName === 'OL') ? SelectorEngine__default.default.find(SELECTOR_ACTIVE_UL, container) : SelectorEngine__default.default.children(container, SELECTOR_ACTIVE);
	      const active = activeElements[0];
	      const isTransitioning = callback && active && active.classList.contains(CLASS_NAME_FADE);

	      const complete = () => this._transitionComplete(element, active, callback);

	      if (active && isTransitioning) {
	        active.classList.remove(CLASS_NAME_SHOW);

	        this._queueCallback(complete, element, true);
	      } else {
	        complete();
	      }
	    }

	    _transitionComplete(element, active, callback) {
	      if (active) {
	        active.classList.remove(CLASS_NAME_ACTIVE);
	        const dropdownChild = SelectorEngine__default.default.findOne(SELECTOR_DROPDOWN_ACTIVE_CHILD, active.parentNode);

	        if (dropdownChild) {
	          dropdownChild.classList.remove(CLASS_NAME_ACTIVE);
	        }

	        if (active.getAttribute('role') === 'tab') {
	          active.setAttribute('aria-selected', false);
	        }
	      }

	      element.classList.add(CLASS_NAME_ACTIVE);

	      if (element.getAttribute('role') === 'tab') {
	        element.setAttribute('aria-selected', true);
	      }

	      reflow(element);

	      if (element.classList.contains(CLASS_NAME_FADE)) {
	        element.classList.add(CLASS_NAME_SHOW);
	      }

	      let parent = element.parentNode;

	      if (parent && parent.nodeName === 'LI') {
	        parent = parent.parentNode;
	      }

	      if (parent && parent.classList.contains(CLASS_NAME_DROPDOWN_MENU)) {
	        const dropdownElement = element.closest(SELECTOR_DROPDOWN);

	        if (dropdownElement) {
	          SelectorEngine__default.default.find(SELECTOR_DROPDOWN_TOGGLE, dropdownElement).forEach(dropdown => dropdown.classList.add(CLASS_NAME_ACTIVE));
	        }

	        element.setAttribute('aria-expanded', true);
	      }

	      if (callback) {
	        callback();
	      }
	    } // Static


	    static jQueryInterface(config) {
	      return this.each(function () {
	        const data = Tab.getOrCreateInstance(this);

	        if (typeof config === 'string') {
	          if (typeof data[config] === 'undefined') {
	            throw new TypeError(`No method named "${config}"`);
	          }

	          data[config]();
	        }
	      });
	    }

	  }
	  /**
	   * ------------------------------------------------------------------------
	   * Data Api implementation
	   * ------------------------------------------------------------------------
	   */


	  EventHandler__default.default.on(document, EVENT_CLICK_DATA_API, SELECTOR_DATA_TOGGLE, function (event) {
	    if (['A', 'AREA'].includes(this.tagName)) {
	      event.preventDefault();
	    }

	    if (isDisabled(this)) {
	      return;
	    }

	    const data = Tab.getOrCreateInstance(this);
	    data.show();
	  });
	  /**
	   * ------------------------------------------------------------------------
	   * jQuery
	   * ------------------------------------------------------------------------
	   * add .Tab to jQuery only if jQuery is present
	   */

	  defineJQueryPlugin(Tab);

	  return Tab;

	}));

	}(tab$1));

	var tab = tab$1.exports;

	var toast = {exports: {}};

	/*!
	  * Bootstrap toast.js v5.1.3 (https://getbootstrap.com/)
	  * Copyright 2011-2021 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
	  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	  */

	(function (module, exports) {
	(function (global, factory) {
	  module.exports = factory(eventHandler.exports, manipulator.exports, baseComponent.exports) ;
	})(commonjsGlobal, (function (EventHandler, Manipulator, BaseComponent) {
	  const _interopDefaultLegacy = e => e && typeof e === 'object' && 'default' in e ? e : { default: e };

	  const EventHandler__default = /*#__PURE__*/_interopDefaultLegacy(EventHandler);
	  const Manipulator__default = /*#__PURE__*/_interopDefaultLegacy(Manipulator);
	  const BaseComponent__default = /*#__PURE__*/_interopDefaultLegacy(BaseComponent);

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/index.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */

	  const toType = obj => {
	    if (obj === null || obj === undefined) {
	      return `${obj}`;
	    }

	    return {}.toString.call(obj).match(/\s([a-z]+)/i)[1].toLowerCase();
	  };

	  const getSelector = element => {
	    let selector = element.getAttribute('data-bs-target');

	    if (!selector || selector === '#') {
	      let hrefAttr = element.getAttribute('href'); // The only valid content that could double as a selector are IDs or classes,
	      // so everything starting with `#` or `.`. If a "real" URL is used as the selector,
	      // `document.querySelector` will rightfully complain it is invalid.
	      // See https://github.com/twbs/bootstrap/issues/32273

	      if (!hrefAttr || !hrefAttr.includes('#') && !hrefAttr.startsWith('.')) {
	        return null;
	      } // Just in case some CMS puts out a full URL with the anchor appended


	      if (hrefAttr.includes('#') && !hrefAttr.startsWith('#')) {
	        hrefAttr = `#${hrefAttr.split('#')[1]}`;
	      }

	      selector = hrefAttr && hrefAttr !== '#' ? hrefAttr.trim() : null;
	    }

	    return selector;
	  };

	  const getElementFromSelector = element => {
	    const selector = getSelector(element);
	    return selector ? document.querySelector(selector) : null;
	  };

	  const isElement = obj => {
	    if (!obj || typeof obj !== 'object') {
	      return false;
	    }

	    if (typeof obj.jquery !== 'undefined') {
	      obj = obj[0];
	    }

	    return typeof obj.nodeType !== 'undefined';
	  };

	  const typeCheckConfig = (componentName, config, configTypes) => {
	    Object.keys(configTypes).forEach(property => {
	      const expectedTypes = configTypes[property];
	      const value = config[property];
	      const valueType = value && isElement(value) ? 'element' : toType(value);

	      if (!new RegExp(expectedTypes).test(valueType)) {
	        throw new TypeError(`${componentName.toUpperCase()}: Option "${property}" provided type "${valueType}" but expected type "${expectedTypes}".`);
	      }
	    });
	  };

	  const isDisabled = element => {
	    if (!element || element.nodeType !== Node.ELEMENT_NODE) {
	      return true;
	    }

	    if (element.classList.contains('disabled')) {
	      return true;
	    }

	    if (typeof element.disabled !== 'undefined') {
	      return element.disabled;
	    }

	    return element.hasAttribute('disabled') && element.getAttribute('disabled') !== 'false';
	  };
	  /**
	   * Trick to restart an element's animation
	   *
	   * @param {HTMLElement} element
	   * @return void
	   *
	   * @see https://www.charistheo.io/blog/2021/02/restart-a-css-animation-with-javascript/#restarting-a-css-animation
	   */


	  const reflow = element => {
	    // eslint-disable-next-line no-unused-expressions
	    element.offsetHeight;
	  };

	  const getjQuery = () => {
	    const {
	      jQuery
	    } = window;

	    if (jQuery && !document.body.hasAttribute('data-bs-no-jquery')) {
	      return jQuery;
	    }

	    return null;
	  };

	  const DOMContentLoadedCallbacks = [];

	  const onDOMContentLoaded = callback => {
	    if (document.readyState === 'loading') {
	      // add listener on the first call when the document is in loading state
	      if (!DOMContentLoadedCallbacks.length) {
	        document.addEventListener('DOMContentLoaded', () => {
	          DOMContentLoadedCallbacks.forEach(callback => callback());
	        });
	      }

	      DOMContentLoadedCallbacks.push(callback);
	    } else {
	      callback();
	    }
	  };

	  const defineJQueryPlugin = plugin => {
	    onDOMContentLoaded(() => {
	      const $ = getjQuery();
	      /* istanbul ignore if */

	      if ($) {
	        const name = plugin.NAME;
	        const JQUERY_NO_CONFLICT = $.fn[name];
	        $.fn[name] = plugin.jQueryInterface;
	        $.fn[name].Constructor = plugin;

	        $.fn[name].noConflict = () => {
	          $.fn[name] = JQUERY_NO_CONFLICT;
	          return plugin.jQueryInterface;
	        };
	      }
	    });
	  };

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): util/component-functions.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */

	  const enableDismissTrigger = (component, method = 'hide') => {
	    const clickEvent = `click.dismiss${component.EVENT_KEY}`;
	    const name = component.NAME;
	    EventHandler__default.default.on(document, clickEvent, `[data-bs-dismiss="${name}"]`, function (event) {
	      if (['A', 'AREA'].includes(this.tagName)) {
	        event.preventDefault();
	      }

	      if (isDisabled(this)) {
	        return;
	      }

	      const target = getElementFromSelector(this) || this.closest(`.${name}`);
	      const instance = component.getOrCreateInstance(target); // Method argument is left, for Alert and only, as it doesn't implement the 'hide' method

	      instance[method]();
	    });
	  };

	  /**
	   * --------------------------------------------------------------------------
	   * Bootstrap (v5.1.3): toast.js
	   * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
	   * --------------------------------------------------------------------------
	   */
	  /**
	   * ------------------------------------------------------------------------
	   * Constants
	   * ------------------------------------------------------------------------
	   */

	  const NAME = 'toast';
	  const DATA_KEY = 'bs.toast';
	  const EVENT_KEY = `.${DATA_KEY}`;
	  const EVENT_MOUSEOVER = `mouseover${EVENT_KEY}`;
	  const EVENT_MOUSEOUT = `mouseout${EVENT_KEY}`;
	  const EVENT_FOCUSIN = `focusin${EVENT_KEY}`;
	  const EVENT_FOCUSOUT = `focusout${EVENT_KEY}`;
	  const EVENT_HIDE = `hide${EVENT_KEY}`;
	  const EVENT_HIDDEN = `hidden${EVENT_KEY}`;
	  const EVENT_SHOW = `show${EVENT_KEY}`;
	  const EVENT_SHOWN = `shown${EVENT_KEY}`;
	  const CLASS_NAME_FADE = 'fade';
	  const CLASS_NAME_HIDE = 'hide'; // @deprecated - kept here only for backwards compatibility

	  const CLASS_NAME_SHOW = 'show';
	  const CLASS_NAME_SHOWING = 'showing';
	  const DefaultType = {
	    animation: 'boolean',
	    autohide: 'boolean',
	    delay: 'number'
	  };
	  const Default = {
	    animation: true,
	    autohide: true,
	    delay: 5000
	  };
	  /**
	   * ------------------------------------------------------------------------
	   * Class Definition
	   * ------------------------------------------------------------------------
	   */

	  class Toast extends BaseComponent__default.default {
	    constructor(element, config) {
	      super(element);
	      this._config = this._getConfig(config);
	      this._timeout = null;
	      this._hasMouseInteraction = false;
	      this._hasKeyboardInteraction = false;

	      this._setListeners();
	    } // Getters


	    static get DefaultType() {
	      return DefaultType;
	    }

	    static get Default() {
	      return Default;
	    }

	    static get NAME() {
	      return NAME;
	    } // Public


	    show() {
	      const showEvent = EventHandler__default.default.trigger(this._element, EVENT_SHOW);

	      if (showEvent.defaultPrevented) {
	        return;
	      }

	      this._clearTimeout();

	      if (this._config.animation) {
	        this._element.classList.add(CLASS_NAME_FADE);
	      }

	      const complete = () => {
	        this._element.classList.remove(CLASS_NAME_SHOWING);

	        EventHandler__default.default.trigger(this._element, EVENT_SHOWN);

	        this._maybeScheduleHide();
	      };

	      this._element.classList.remove(CLASS_NAME_HIDE); // @deprecated


	      reflow(this._element);

	      this._element.classList.add(CLASS_NAME_SHOW);

	      this._element.classList.add(CLASS_NAME_SHOWING);

	      this._queueCallback(complete, this._element, this._config.animation);
	    }

	    hide() {
	      if (!this._element.classList.contains(CLASS_NAME_SHOW)) {
	        return;
	      }

	      const hideEvent = EventHandler__default.default.trigger(this._element, EVENT_HIDE);

	      if (hideEvent.defaultPrevented) {
	        return;
	      }

	      const complete = () => {
	        this._element.classList.add(CLASS_NAME_HIDE); // @deprecated


	        this._element.classList.remove(CLASS_NAME_SHOWING);

	        this._element.classList.remove(CLASS_NAME_SHOW);

	        EventHandler__default.default.trigger(this._element, EVENT_HIDDEN);
	      };

	      this._element.classList.add(CLASS_NAME_SHOWING);

	      this._queueCallback(complete, this._element, this._config.animation);
	    }

	    dispose() {
	      this._clearTimeout();

	      if (this._element.classList.contains(CLASS_NAME_SHOW)) {
	        this._element.classList.remove(CLASS_NAME_SHOW);
	      }

	      super.dispose();
	    } // Private


	    _getConfig(config) {
	      config = { ...Default,
	        ...Manipulator__default.default.getDataAttributes(this._element),
	        ...(typeof config === 'object' && config ? config : {})
	      };
	      typeCheckConfig(NAME, config, this.constructor.DefaultType);
	      return config;
	    }

	    _maybeScheduleHide() {
	      if (!this._config.autohide) {
	        return;
	      }

	      if (this._hasMouseInteraction || this._hasKeyboardInteraction) {
	        return;
	      }

	      this._timeout = setTimeout(() => {
	        this.hide();
	      }, this._config.delay);
	    }

	    _onInteraction(event, isInteracting) {
	      switch (event.type) {
	        case 'mouseover':
	        case 'mouseout':
	          this._hasMouseInteraction = isInteracting;
	          break;

	        case 'focusin':
	        case 'focusout':
	          this._hasKeyboardInteraction = isInteracting;
	          break;
	      }

	      if (isInteracting) {
	        this._clearTimeout();

	        return;
	      }

	      const nextElement = event.relatedTarget;

	      if (this._element === nextElement || this._element.contains(nextElement)) {
	        return;
	      }

	      this._maybeScheduleHide();
	    }

	    _setListeners() {
	      EventHandler__default.default.on(this._element, EVENT_MOUSEOVER, event => this._onInteraction(event, true));
	      EventHandler__default.default.on(this._element, EVENT_MOUSEOUT, event => this._onInteraction(event, false));
	      EventHandler__default.default.on(this._element, EVENT_FOCUSIN, event => this._onInteraction(event, true));
	      EventHandler__default.default.on(this._element, EVENT_FOCUSOUT, event => this._onInteraction(event, false));
	    }

	    _clearTimeout() {
	      clearTimeout(this._timeout);
	      this._timeout = null;
	    } // Static


	    static jQueryInterface(config) {
	      return this.each(function () {
	        const data = Toast.getOrCreateInstance(this, config);

	        if (typeof config === 'string') {
	          if (typeof data[config] === 'undefined') {
	            throw new TypeError(`No method named "${config}"`);
	          }

	          data[config](this);
	        }
	      });
	    }

	  }

	  enableDismissTrigger(Toast);
	  /**
	   * ------------------------------------------------------------------------
	   * jQuery
	   * ------------------------------------------------------------------------
	   * add .Toast to jQuery only if jQuery is present
	   */

	  defineJQueryPlugin(Toast);

	  return Toast;

	}));

	}(toast));

	var Toast = toast.exports;

	var tinySlider = {};

	Object.defineProperty(tinySlider, '__esModule', { value: true });

	var win$1 = window;
	var raf = win$1.requestAnimationFrame || win$1.webkitRequestAnimationFrame || win$1.mozRequestAnimationFrame || win$1.msRequestAnimationFrame || function (cb) {
	  return setTimeout(cb, 16);
	};

	var win = window;
	var caf = win.cancelAnimationFrame || win.mozCancelAnimationFrame || function (id) {
	  clearTimeout(id);
	};

	function extend() {
	  var obj,
	      name,
	      copy,
	      target = arguments[0] || {},
	      i = 1,
	      length = arguments.length;

	  for (; i < length; i++) {
	    if ((obj = arguments[i]) !== null) {
	      for (name in obj) {
	        copy = obj[name];

	        if (target === copy) {
	          continue;
	        } else if (copy !== undefined) {
	          target[name] = copy;
	        }
	      }
	    }
	  }

	  return target;
	}

	function checkStorageValue(value) {
	  return ['true', 'false'].indexOf(value) >= 0 ? JSON.parse(value) : value;
	}

	function setLocalStorage(storage, key, value, access) {
	  if (access) {
	    try {
	      storage.setItem(key, value);
	    } catch (e) {}
	  }

	  return value;
	}

	function getSlideId() {
	  var id = window.tnsId;
	  window.tnsId = !id ? 1 : id + 1;
	  return 'tns' + window.tnsId;
	}

	function getBody() {
	  var doc = document,
	      body = doc.body;

	  if (!body) {
	    body = doc.createElement('body');
	    body.fake = true;
	  }

	  return body;
	}

	var docElement = document.documentElement;

	function setFakeBody(body) {
	  var docOverflow = '';

	  if (body.fake) {
	    docOverflow = docElement.style.overflow; //avoid crashing IE8, if background image is used

	    body.style.background = ''; //Safari 5.13/5.1.4 OSX stops loading if ::-webkit-scrollbar is used and scrollbars are visible

	    body.style.overflow = docElement.style.overflow = 'hidden';
	    docElement.appendChild(body);
	  }

	  return docOverflow;
	}

	function resetFakeBody(body, docOverflow) {
	  if (body.fake) {
	    body.remove();
	    docElement.style.overflow = docOverflow; // Trigger layout so kinetic scrolling isn't disabled in iOS6+
	    // eslint-disable-next-line

	    docElement.offsetHeight;
	  }
	}

	// get css-calc 
	function calc() {
	  var doc = document,
	      body = getBody(),
	      docOverflow = setFakeBody(body),
	      div = doc.createElement('div'),
	      result = false;
	  body.appendChild(div);

	  try {
	    var str = '(10px * 10)',
	        vals = ['calc' + str, '-moz-calc' + str, '-webkit-calc' + str],
	        val;

	    for (var i = 0; i < 3; i++) {
	      val = vals[i];
	      div.style.width = val;

	      if (div.offsetWidth === 100) {
	        result = val.replace(str, '');
	        break;
	      }
	    }
	  } catch (e) {}

	  body.fake ? resetFakeBody(body, docOverflow) : div.remove();
	  return result;
	}

	// get subpixel support value
	function percentageLayout() {
	  // check subpixel layout supporting
	  var doc = document,
	      body = getBody(),
	      docOverflow = setFakeBody(body),
	      wrapper = doc.createElement('div'),
	      outer = doc.createElement('div'),
	      str = '',
	      count = 70,
	      perPage = 3,
	      supported = false;
	  wrapper.className = "tns-t-subp2";
	  outer.className = "tns-t-ct";

	  for (var i = 0; i < count; i++) {
	    str += '<div></div>';
	  }

	  outer.innerHTML = str;
	  wrapper.appendChild(outer);
	  body.appendChild(wrapper);
	  supported = Math.abs(wrapper.getBoundingClientRect().left - outer.children[count - perPage].getBoundingClientRect().left) < 2;
	  body.fake ? resetFakeBody(body, docOverflow) : wrapper.remove();
	  return supported;
	}

	function mediaquerySupport() {
	  if (window.matchMedia || window.msMatchMedia) {
	    return true;
	  }

	  var doc = document,
	      body = getBody(),
	      docOverflow = setFakeBody(body),
	      div = doc.createElement('div'),
	      style = doc.createElement('style'),
	      rule = '@media all and (min-width:1px){.tns-mq-test{position:absolute}}',
	      position;
	  style.type = 'text/css';
	  div.className = 'tns-mq-test';
	  body.appendChild(style);
	  body.appendChild(div);

	  if (style.styleSheet) {
	    style.styleSheet.cssText = rule;
	  } else {
	    style.appendChild(doc.createTextNode(rule));
	  }

	  position = window.getComputedStyle ? window.getComputedStyle(div).position : div.currentStyle['position'];
	  body.fake ? resetFakeBody(body, docOverflow) : div.remove();
	  return position === "absolute";
	}

	// create and append style sheet
	function createStyleSheet(media, nonce) {
	  // Create the <style> tag
	  var style = document.createElement("style"); // style.setAttribute("type", "text/css");
	  // Add a media (and/or media query) here if you'd like!
	  // style.setAttribute("media", "screen")
	  // style.setAttribute("media", "only screen and (max-width : 1024px)")

	  if (media) {
	    style.setAttribute("media", media);
	  } // Add nonce attribute for Content Security Policy


	  if (nonce) {
	    style.setAttribute("nonce", nonce);
	  } // WebKit hack :(
	  // style.appendChild(document.createTextNode(""));
	  // Add the <style> element to the page


	  document.querySelector('head').appendChild(style);
	  return style.sheet ? style.sheet : style.styleSheet;
	}

	// cross browsers addRule method
	function addCSSRule(sheet, selector, rules, index) {
	  // return raf(function() {
	  'insertRule' in sheet ? sheet.insertRule(selector + '{' + rules + '}', index) : sheet.addRule(selector, rules, index); // });
	}

	// cross browsers addRule method
	function removeCSSRule(sheet, index) {
	  // return raf(function() {
	  'deleteRule' in sheet ? sheet.deleteRule(index) : sheet.removeRule(index); // });
	}

	function getCssRulesLength(sheet) {
	  var rule = 'insertRule' in sheet ? sheet.cssRules : sheet.rules;
	  return rule.length;
	}

	function toDegree(y, x) {
	  return Math.atan2(y, x) * (180 / Math.PI);
	}

	function getTouchDirection(angle, range) {
	  var direction = false,
	      gap = Math.abs(90 - Math.abs(angle));

	  if (gap >= 90 - range) {
	    direction = 'horizontal';
	  } else if (gap <= range) {
	    direction = 'vertical';
	  }

	  return direction;
	}

	// https://toddmotto.com/ditch-the-array-foreach-call-nodelist-hack/
	function forEach(arr, callback, scope) {
	  for (var i = 0, l = arr.length; i < l; i++) {
	    callback.call(scope, arr[i], i);
	  }
	}

	var classListSupport = ('classList' in document.createElement('_'));

	var hasClass = classListSupport ? function (el, str) {
	  return el.classList.contains(str);
	} : function (el, str) {
	  return el.className.indexOf(str) >= 0;
	};

	var addClass = classListSupport ? function (el, str) {
	  if (!hasClass(el, str)) {
	    el.classList.add(str);
	  }
	} : function (el, str) {
	  if (!hasClass(el, str)) {
	    el.className += ' ' + str;
	  }
	};

	var removeClass = classListSupport ? function (el, str) {
	  if (hasClass(el, str)) {
	    el.classList.remove(str);
	  }
	} : function (el, str) {
	  if (hasClass(el, str)) {
	    el.className = el.className.replace(str, '');
	  }
	};

	function hasAttr(el, attr) {
	  return el.hasAttribute(attr);
	}

	function getAttr(el, attr) {
	  return el.getAttribute(attr);
	}

	function isNodeList(el) {
	  // Only NodeList has the "item()" function
	  return typeof el.item !== "undefined";
	}

	function setAttrs(els, attrs) {
	  els = isNodeList(els) || els instanceof Array ? els : [els];

	  if (Object.prototype.toString.call(attrs) !== '[object Object]') {
	    return;
	  }

	  for (var i = els.length; i--;) {
	    for (var key in attrs) {
	      els[i].setAttribute(key, attrs[key]);
	    }
	  }
	}

	function removeAttrs(els, attrs) {
	  els = isNodeList(els) || els instanceof Array ? els : [els];
	  attrs = attrs instanceof Array ? attrs : [attrs];
	  var attrLength = attrs.length;

	  for (var i = els.length; i--;) {
	    for (var j = attrLength; j--;) {
	      els[i].removeAttribute(attrs[j]);
	    }
	  }
	}

	function arrayFromNodeList(nl) {
	  var arr = [];

	  for (var i = 0, l = nl.length; i < l; i++) {
	    arr.push(nl[i]);
	  }

	  return arr;
	}

	function hideElement(el, forceHide) {
	  if (el.style.display !== 'none') {
	    el.style.display = 'none';
	  }
	}

	function showElement(el, forceHide) {
	  if (el.style.display === 'none') {
	    el.style.display = '';
	  }
	}

	function isVisible(el) {
	  return window.getComputedStyle(el).display !== 'none';
	}

	function whichProperty(props) {
	  if (typeof props === 'string') {
	    var arr = [props],
	        Props = props.charAt(0).toUpperCase() + props.substr(1),
	        prefixes = ['Webkit', 'Moz', 'ms', 'O'];
	    prefixes.forEach(function (prefix) {
	      if (prefix !== 'ms' || props === 'transform') {
	        arr.push(prefix + Props);
	      }
	    });
	    props = arr;
	  }

	  var el = document.createElement('fakeelement');
	      props.length;

	  for (var i = 0; i < props.length; i++) {
	    var prop = props[i];

	    if (el.style[prop] !== undefined) {
	      return prop;
	    }
	  }

	  return false; // explicit for ie9-
	}

	function has3DTransforms(tf) {
	  if (!tf) {
	    return false;
	  }

	  if (!window.getComputedStyle) {
	    return false;
	  }

	  var doc = document,
	      body = getBody(),
	      docOverflow = setFakeBody(body),
	      el = doc.createElement('p'),
	      has3d,
	      cssTF = tf.length > 9 ? '-' + tf.slice(0, -9).toLowerCase() + '-' : '';
	  cssTF += 'transform'; // Add it to the body to get the computed style

	  body.insertBefore(el, null);
	  el.style[tf] = 'translate3d(1px,1px,1px)';
	  has3d = window.getComputedStyle(el).getPropertyValue(cssTF);
	  body.fake ? resetFakeBody(body, docOverflow) : el.remove();
	  return has3d !== undefined && has3d.length > 0 && has3d !== "none";
	}

	// get transitionend, animationend based on transitionDuration
	// @propin: string
	// @propOut: string, first-letter uppercase
	// Usage: getEndProperty('WebkitTransitionDuration', 'Transition') => webkitTransitionEnd
	function getEndProperty(propIn, propOut) {
	  var endProp = false;

	  if (/^Webkit/.test(propIn)) {
	    endProp = 'webkit' + propOut + 'End';
	  } else if (/^O/.test(propIn)) {
	    endProp = 'o' + propOut + 'End';
	  } else if (propIn) {
	    endProp = propOut.toLowerCase() + 'end';
	  }

	  return endProp;
	}

	// Test via a getter in the options object to see if the passive property is accessed
	var supportsPassive = false;

	try {
	  var opts = Object.defineProperty({}, 'passive', {
	    get: function () {
	      supportsPassive = true;
	    }
	  });
	  window.addEventListener("test", null, opts);
	} catch (e) {}

	var passiveOption = supportsPassive ? {
	  passive: true
	} : false;

	function addEvents(el, obj, preventScrolling) {
	  for (var prop in obj) {
	    var option = ['touchstart', 'touchmove'].indexOf(prop) >= 0 && !preventScrolling ? passiveOption : false;
	    el.addEventListener(prop, obj[prop], option);
	  }
	}

	function removeEvents(el, obj) {
	  for (var prop in obj) {
	    var option = ['touchstart', 'touchmove'].indexOf(prop) >= 0 ? passiveOption : false;
	    el.removeEventListener(prop, obj[prop], option);
	  }
	}

	function Events() {
	  return {
	    topics: {},
	    on: function (eventName, fn) {
	      this.topics[eventName] = this.topics[eventName] || [];
	      this.topics[eventName].push(fn);
	    },
	    off: function (eventName, fn) {
	      if (this.topics[eventName]) {
	        for (var i = 0; i < this.topics[eventName].length; i++) {
	          if (this.topics[eventName][i] === fn) {
	            this.topics[eventName].splice(i, 1);
	            break;
	          }
	        }
	      }
	    },
	    emit: function (eventName, data) {
	      data.type = eventName;

	      if (this.topics[eventName]) {
	        this.topics[eventName].forEach(function (fn) {
	          fn(data, eventName);
	        });
	      }
	    }
	  };
	}

	function jsTransform(element, attr, prefix, postfix, to, duration, callback) {
	  var tick = Math.min(duration, 10),
	      unit = to.indexOf('%') >= 0 ? '%' : 'px',
	      to = to.replace(unit, ''),
	      from = Number(element.style[attr].replace(prefix, '').replace(postfix, '').replace(unit, '')),
	      positionTick = (to - from) / duration * tick;
	  setTimeout(moveElement, tick);

	  function moveElement() {
	    duration -= tick;
	    from += positionTick;
	    element.style[attr] = prefix + from + unit + postfix;

	    if (duration > 0) {
	      setTimeout(moveElement, tick);
	    } else {
	      callback();
	    }
	  }
	}

	// Object.keys
	if (!Object.keys) {
	  Object.keys = function (object) {
	    var keys = [];

	    for (var name in object) {
	      if (Object.prototype.hasOwnProperty.call(object, name)) {
	        keys.push(name);
	      }
	    }

	    return keys;
	  };
	} // ChildNode.remove


	if (!("remove" in Element.prototype)) {
	  Element.prototype.remove = function () {
	    if (this.parentNode) {
	      this.parentNode.removeChild(this);
	    }
	  };
	}
	var tns = function (options) {
	  options = extend({
	    container: '.slider',
	    mode: 'carousel',
	    axis: 'horizontal',
	    items: 1,
	    gutter: 0,
	    edgePadding: 0,
	    fixedWidth: false,
	    autoWidth: false,
	    viewportMax: false,
	    slideBy: 1,
	    center: false,
	    controls: true,
	    controlsPosition: 'top',
	    controlsText: ['prev', 'next'],
	    controlsContainer: false,
	    prevButton: false,
	    nextButton: false,
	    nav: true,
	    navPosition: 'top',
	    navContainer: false,
	    navAsThumbnails: false,
	    arrowKeys: false,
	    speed: 300,
	    autoplay: false,
	    autoplayPosition: 'top',
	    autoplayTimeout: 5000,
	    autoplayDirection: 'forward',
	    autoplayText: ['start', 'stop'],
	    autoplayHoverPause: false,
	    autoplayButton: false,
	    autoplayButtonOutput: true,
	    autoplayResetOnVisibility: true,
	    animateIn: 'tns-fadeIn',
	    animateOut: 'tns-fadeOut',
	    animateNormal: 'tns-normal',
	    animateDelay: false,
	    loop: true,
	    rewind: false,
	    autoHeight: false,
	    responsive: false,
	    lazyload: false,
	    lazyloadSelector: '.tns-lazy-img',
	    touch: true,
	    mouseDrag: false,
	    swipeAngle: 15,
	    nested: false,
	    preventActionWhenRunning: false,
	    preventScrollOnTouch: false,
	    freezable: true,
	    onInit: false,
	    useLocalStorage: true,
	    nonce: false
	  }, options || {});
	  var doc = document,
	      win = window,
	      KEYS = {
	    ENTER: 13,
	    SPACE: 32,
	    LEFT: 37,
	    RIGHT: 39
	  },
	      tnsStorage = {},
	      localStorageAccess = options.useLocalStorage;

	  if (localStorageAccess) {
	    // check browser version and local storage access
	    var browserInfo = navigator.userAgent;
	    var uid = new Date();

	    try {
	      tnsStorage = win.localStorage;

	      if (tnsStorage) {
	        tnsStorage.setItem(uid, uid);
	        localStorageAccess = tnsStorage.getItem(uid) == uid;
	        tnsStorage.removeItem(uid);
	      } else {
	        localStorageAccess = false;
	      }

	      if (!localStorageAccess) {
	        tnsStorage = {};
	      }
	    } catch (e) {
	      localStorageAccess = false;
	    }

	    if (localStorageAccess) {
	      // remove storage when browser version changes
	      if (tnsStorage['tnsApp'] && tnsStorage['tnsApp'] !== browserInfo) {
	        ['tC', 'tPL', 'tMQ', 'tTf', 't3D', 'tTDu', 'tTDe', 'tADu', 'tADe', 'tTE', 'tAE'].forEach(function (item) {
	          tnsStorage.removeItem(item);
	        });
	      } // update browserInfo


	      localStorage['tnsApp'] = browserInfo;
	    }
	  }

	  var CALC = tnsStorage['tC'] ? checkStorageValue(tnsStorage['tC']) : setLocalStorage(tnsStorage, 'tC', calc(), localStorageAccess),
	      PERCENTAGELAYOUT = tnsStorage['tPL'] ? checkStorageValue(tnsStorage['tPL']) : setLocalStorage(tnsStorage, 'tPL', percentageLayout(), localStorageAccess),
	      CSSMQ = tnsStorage['tMQ'] ? checkStorageValue(tnsStorage['tMQ']) : setLocalStorage(tnsStorage, 'tMQ', mediaquerySupport(), localStorageAccess),
	      TRANSFORM = tnsStorage['tTf'] ? checkStorageValue(tnsStorage['tTf']) : setLocalStorage(tnsStorage, 'tTf', whichProperty('transform'), localStorageAccess),
	      HAS3DTRANSFORMS = tnsStorage['t3D'] ? checkStorageValue(tnsStorage['t3D']) : setLocalStorage(tnsStorage, 't3D', has3DTransforms(TRANSFORM), localStorageAccess),
	      TRANSITIONDURATION = tnsStorage['tTDu'] ? checkStorageValue(tnsStorage['tTDu']) : setLocalStorage(tnsStorage, 'tTDu', whichProperty('transitionDuration'), localStorageAccess),
	      TRANSITIONDELAY = tnsStorage['tTDe'] ? checkStorageValue(tnsStorage['tTDe']) : setLocalStorage(tnsStorage, 'tTDe', whichProperty('transitionDelay'), localStorageAccess),
	      ANIMATIONDURATION = tnsStorage['tADu'] ? checkStorageValue(tnsStorage['tADu']) : setLocalStorage(tnsStorage, 'tADu', whichProperty('animationDuration'), localStorageAccess),
	      ANIMATIONDELAY = tnsStorage['tADe'] ? checkStorageValue(tnsStorage['tADe']) : setLocalStorage(tnsStorage, 'tADe', whichProperty('animationDelay'), localStorageAccess),
	      TRANSITIONEND = tnsStorage['tTE'] ? checkStorageValue(tnsStorage['tTE']) : setLocalStorage(tnsStorage, 'tTE', getEndProperty(TRANSITIONDURATION, 'Transition'), localStorageAccess),
	      ANIMATIONEND = tnsStorage['tAE'] ? checkStorageValue(tnsStorage['tAE']) : setLocalStorage(tnsStorage, 'tAE', getEndProperty(ANIMATIONDURATION, 'Animation'), localStorageAccess); // get element nodes from selectors

	  var supportConsoleWarn = win.console && typeof win.console.warn === "function",
	      tnsList = ['container', 'controlsContainer', 'prevButton', 'nextButton', 'navContainer', 'autoplayButton'],
	      optionsElements = {};
	  tnsList.forEach(function (item) {
	    if (typeof options[item] === 'string') {
	      var str = options[item],
	          el = doc.querySelector(str);
	      optionsElements[item] = str;

	      if (el && el.nodeName) {
	        options[item] = el;
	      } else {
	        if (supportConsoleWarn) {
	          console.warn('Can\'t find', options[item]);
	        }

	        return;
	      }
	    }
	  }); // make sure at least 1 slide

	  if (options.container.children.length < 1) {
	    if (supportConsoleWarn) {
	      console.warn('No slides found in', options.container);
	    }

	    return;
	  } // update options


	  var responsive = options.responsive,
	      nested = options.nested,
	      carousel = options.mode === 'carousel' ? true : false;

	  if (responsive) {
	    // apply responsive[0] to options and remove it
	    if (0 in responsive) {
	      options = extend(options, responsive[0]);
	      delete responsive[0];
	    }

	    var responsiveTem = {};

	    for (var key in responsive) {
	      var val = responsive[key]; // update responsive
	      // from: 300: 2
	      // to:
	      //   300: {
	      //     items: 2
	      //   }

	      val = typeof val === 'number' ? {
	        items: val
	      } : val;
	      responsiveTem[key] = val;
	    }

	    responsive = responsiveTem;
	    responsiveTem = null;
	  } // update options


	  function updateOptions(obj) {
	    for (var key in obj) {
	      if (!carousel) {
	        if (key === 'slideBy') {
	          obj[key] = 'page';
	        }

	        if (key === 'edgePadding') {
	          obj[key] = false;
	        }

	        if (key === 'autoHeight') {
	          obj[key] = false;
	        }
	      } // update responsive options


	      if (key === 'responsive') {
	        updateOptions(obj[key]);
	      }
	    }
	  }

	  if (!carousel) {
	    updateOptions(options);
	  } // === define and set variables ===


	  if (!carousel) {
	    options.axis = 'horizontal';
	    options.slideBy = 'page';
	    options.edgePadding = false;
	    var animateIn = options.animateIn,
	        animateOut = options.animateOut,
	        animateDelay = options.animateDelay,
	        animateNormal = options.animateNormal;
	  }

	  var horizontal = options.axis === 'horizontal' ? true : false,
	      outerWrapper = doc.createElement('div'),
	      innerWrapper = doc.createElement('div'),
	      middleWrapper,
	      container = options.container,
	      containerParent = container.parentNode,
	      containerHTML = container.outerHTML,
	      slideItems = container.children,
	      slideCount = slideItems.length,
	      breakpointZone,
	      windowWidth = getWindowWidth(),
	      isOn = false;

	  if (responsive) {
	    setBreakpointZone();
	  }

	  if (carousel) {
	    container.className += ' tns-vpfix';
	  } // fixedWidth: viewport > rightBoundary > indexMax


	  var autoWidth = options.autoWidth,
	      fixedWidth = getOption('fixedWidth'),
	      edgePadding = getOption('edgePadding'),
	      gutter = getOption('gutter'),
	      viewport = getViewportWidth(),
	      center = getOption('center'),
	      items = !autoWidth ? Math.floor(getOption('items')) : 1,
	      slideBy = getOption('slideBy'),
	      viewportMax = options.viewportMax || options.fixedWidthViewportWidth,
	      arrowKeys = getOption('arrowKeys'),
	      speed = getOption('speed'),
	      rewind = options.rewind,
	      loop = rewind ? false : options.loop,
	      autoHeight = getOption('autoHeight'),
	      controls = getOption('controls'),
	      controlsText = getOption('controlsText'),
	      nav = getOption('nav'),
	      touch = getOption('touch'),
	      mouseDrag = getOption('mouseDrag'),
	      autoplay = getOption('autoplay'),
	      autoplayTimeout = getOption('autoplayTimeout'),
	      autoplayText = getOption('autoplayText'),
	      autoplayHoverPause = getOption('autoplayHoverPause'),
	      autoplayResetOnVisibility = getOption('autoplayResetOnVisibility'),
	      sheet = createStyleSheet(null, getOption('nonce')),
	      lazyload = options.lazyload,
	      lazyloadSelector = options.lazyloadSelector,
	      slidePositions,
	      // collection of slide positions
	  slideItemsOut = [],
	      cloneCount = loop ? getCloneCountForLoop() : 0,
	      slideCountNew = !carousel ? slideCount + cloneCount : slideCount + cloneCount * 2,
	      hasRightDeadZone = (fixedWidth || autoWidth) && !loop ? true : false,
	      rightBoundary = fixedWidth ? getRightBoundary() : null,
	      updateIndexBeforeTransform = !carousel || !loop ? true : false,
	      // transform
	  transformAttr = horizontal ? 'left' : 'top',
	      transformPrefix = '',
	      transformPostfix = '',
	      // index
	  getIndexMax = function () {
	    if (fixedWidth) {
	      return function () {
	        return center && !loop ? slideCount - 1 : Math.ceil(-rightBoundary / (fixedWidth + gutter));
	      };
	    } else if (autoWidth) {
	      return function () {
	        for (var i = 0; i < slideCountNew; i++) {
	          if (slidePositions[i] >= -rightBoundary) {
	            return i;
	          }
	        }
	      };
	    } else {
	      return function () {
	        if (center && carousel && !loop) {
	          return slideCount - 1;
	        } else {
	          return loop || carousel ? Math.max(0, slideCountNew - Math.ceil(items)) : slideCountNew - 1;
	        }
	      };
	    }
	  }(),
	      index = getStartIndex(getOption('startIndex')),
	      indexCached = index;
	      getCurrentSlide();
	      var indexMin = 0,
	      indexMax = !autoWidth ? getIndexMax() : null,
	      preventActionWhenRunning = options.preventActionWhenRunning,
	      swipeAngle = options.swipeAngle,
	      moveDirectionExpected = swipeAngle ? '?' : true,
	      running = false,
	      onInit = options.onInit,
	      events = new Events(),
	      // id, class
	  newContainerClasses = ' tns-slider tns-' + options.mode,
	      slideId = container.id || getSlideId(),
	      disable = getOption('disable'),
	      disabled = false,
	      freezable = options.freezable,
	      freeze = freezable && !autoWidth ? getFreeze() : false,
	      frozen = false,
	      controlsEvents = {
	    'click': onControlsClick,
	    'keydown': onControlsKeydown
	  },
	      navEvents = {
	    'click': onNavClick,
	    'keydown': onNavKeydown
	  },
	      hoverEvents = {
	    'mouseover': mouseoverPause,
	    'mouseout': mouseoutRestart
	  },
	      visibilityEvent = {
	    'visibilitychange': onVisibilityChange
	  },
	      docmentKeydownEvent = {
	    'keydown': onDocumentKeydown
	  },
	      touchEvents = {
	    'touchstart': onPanStart,
	    'touchmove': onPanMove,
	    'touchend': onPanEnd,
	    'touchcancel': onPanEnd
	  },
	      dragEvents = {
	    'mousedown': onPanStart,
	    'mousemove': onPanMove,
	    'mouseup': onPanEnd,
	    'mouseleave': onPanEnd
	  },
	      hasControls = hasOption('controls'),
	      hasNav = hasOption('nav'),
	      navAsThumbnails = autoWidth ? true : options.navAsThumbnails,
	      hasAutoplay = hasOption('autoplay'),
	      hasTouch = hasOption('touch'),
	      hasMouseDrag = hasOption('mouseDrag'),
	      slideActiveClass = 'tns-slide-active',
	      slideClonedClass = 'tns-slide-cloned',
	      imgCompleteClass = 'tns-complete',
	      imgEvents = {
	    'load': onImgLoaded,
	    'error': onImgFailed
	  },
	      imgsComplete,
	      liveregionCurrent,
	      preventScroll = options.preventScrollOnTouch === 'force' ? true : false; // controls


	  if (hasControls) {
	    var controlsContainer = options.controlsContainer,
	        controlsContainerHTML = options.controlsContainer ? options.controlsContainer.outerHTML : '',
	        prevButton = options.prevButton,
	        nextButton = options.nextButton,
	        prevButtonHTML = options.prevButton ? options.prevButton.outerHTML : '',
	        nextButtonHTML = options.nextButton ? options.nextButton.outerHTML : '',
	        prevIsButton,
	        nextIsButton;
	  } // nav


	  if (hasNav) {
	    var navContainer = options.navContainer,
	        navContainerHTML = options.navContainer ? options.navContainer.outerHTML : '',
	        navItems,
	        pages = autoWidth ? slideCount : getPages(),
	        pagesCached = 0,
	        navClicked = -1,
	        navCurrentIndex = getCurrentNavIndex(),
	        navCurrentIndexCached = navCurrentIndex,
	        navActiveClass = 'tns-nav-active',
	        navStr = 'Carousel Page ',
	        navStrCurrent = ' (Current Slide)';
	  } // autoplay


	  if (hasAutoplay) {
	    var autoplayDirection = options.autoplayDirection === 'forward' ? 1 : -1,
	        autoplayButton = options.autoplayButton,
	        autoplayButtonHTML = options.autoplayButton ? options.autoplayButton.outerHTML : '',
	        autoplayHtmlStrings = ['<span class=\'tns-visually-hidden\'>', ' animation</span>'],
	        autoplayTimer,
	        animating,
	        autoplayHoverPaused,
	        autoplayUserPaused,
	        autoplayVisibilityPaused;
	  }

	  if (hasTouch || hasMouseDrag) {
	    var initPosition = {},
	        lastPosition = {},
	        translateInit,
	        panStart = false,
	        rafIndex,
	        getDist = horizontal ? function (a, b) {
	      return a.x - b.x;
	    } : function (a, b) {
	      return a.y - b.y;
	    };
	  } // disable slider when slidecount <= items


	  if (!autoWidth) {
	    resetVariblesWhenDisable(disable || freeze);
	  }

	  if (TRANSFORM) {
	    transformAttr = TRANSFORM;
	    transformPrefix = 'translate';

	    if (HAS3DTRANSFORMS) {
	      transformPrefix += horizontal ? '3d(' : '3d(0px, ';
	      transformPostfix = horizontal ? ', 0px, 0px)' : ', 0px)';
	    } else {
	      transformPrefix += horizontal ? 'X(' : 'Y(';
	      transformPostfix = ')';
	    }
	  }

	  if (carousel) {
	    container.className = container.className.replace('tns-vpfix', '');
	  }

	  initStructure();
	  initSheet();
	  initSliderTransform(); // === COMMON FUNCTIONS === //

	  function resetVariblesWhenDisable(condition) {
	    if (condition) {
	      controls = nav = touch = mouseDrag = arrowKeys = autoplay = autoplayHoverPause = autoplayResetOnVisibility = false;
	    }
	  }

	  function getCurrentSlide() {
	    var tem = carousel ? index - cloneCount : index;

	    while (tem < 0) {
	      tem += slideCount;
	    }

	    return tem % slideCount + 1;
	  }

	  function getStartIndex(ind) {
	    ind = ind ? Math.max(0, Math.min(loop ? slideCount - 1 : slideCount - items, ind)) : 0;
	    return carousel ? ind + cloneCount : ind;
	  }

	  function getAbsIndex(i) {
	    if (i == null) {
	      i = index;
	    }

	    if (carousel) {
	      i -= cloneCount;
	    }

	    while (i < 0) {
	      i += slideCount;
	    }

	    return Math.floor(i % slideCount);
	  }

	  function getCurrentNavIndex() {
	    var absIndex = getAbsIndex(),
	        result;
	    result = navAsThumbnails ? absIndex : fixedWidth || autoWidth ? Math.ceil((absIndex + 1) * pages / slideCount - 1) : Math.floor(absIndex / items); // set active nav to the last one when reaches the right edge

	    if (!loop && carousel && index === indexMax) {
	      result = pages - 1;
	    }

	    return result;
	  }

	  function getItemsMax() {
	    // fixedWidth or autoWidth while viewportMax is not available
	    if (autoWidth || fixedWidth && !viewportMax) {
	      return slideCount - 1; // most cases
	    } else {
	      var str = fixedWidth ? 'fixedWidth' : 'items',
	          arr = [];

	      if (fixedWidth || options[str] < slideCount) {
	        arr.push(options[str]);
	      }

	      if (responsive) {
	        for (var bp in responsive) {
	          var tem = responsive[bp][str];

	          if (tem && (fixedWidth || tem < slideCount)) {
	            arr.push(tem);
	          }
	        }
	      }

	      if (!arr.length) {
	        arr.push(0);
	      }

	      return Math.ceil(fixedWidth ? viewportMax / Math.min.apply(null, arr) : Math.max.apply(null, arr));
	    }
	  }

	  function getCloneCountForLoop() {
	    var itemsMax = getItemsMax(),
	        result = carousel ? Math.ceil((itemsMax * 5 - slideCount) / 2) : itemsMax * 4 - slideCount;
	    result = Math.max(itemsMax, result);
	    return hasOption('edgePadding') ? result + 1 : result;
	  }

	  function getWindowWidth() {
	    return win.innerWidth || doc.documentElement.clientWidth || doc.body.clientWidth;
	  }

	  function getInsertPosition(pos) {
	    return pos === 'top' ? 'afterbegin' : 'beforeend';
	  }

	  function getClientWidth(el) {
	    if (el == null) {
	      return;
	    }

	    var div = doc.createElement('div'),
	        rect,
	        width;
	    el.appendChild(div);
	    rect = div.getBoundingClientRect();
	    width = rect.right - rect.left;
	    div.remove();
	    return width || getClientWidth(el.parentNode);
	  }

	  function getViewportWidth() {
	    var gap = edgePadding ? edgePadding * 2 - gutter : 0;
	    return getClientWidth(containerParent) - gap;
	  }

	  function hasOption(item) {
	    if (options[item]) {
	      return true;
	    } else {
	      if (responsive) {
	        for (var bp in responsive) {
	          if (responsive[bp][item]) {
	            return true;
	          }
	        }
	      }

	      return false;
	    }
	  } // get option:
	  // fixed width: viewport, fixedWidth, gutter => items
	  // others: window width => all variables
	  // all: items => slideBy


	  function getOption(item, ww) {
	    if (ww == null) {
	      ww = windowWidth;
	    }

	    if (item === 'items' && fixedWidth) {
	      return Math.floor((viewport + gutter) / (fixedWidth + gutter)) || 1;
	    } else {
	      var result = options[item];

	      if (responsive) {
	        for (var bp in responsive) {
	          // bp: convert string to number
	          if (ww >= parseInt(bp)) {
	            if (item in responsive[bp]) {
	              result = responsive[bp][item];
	            }
	          }
	        }
	      }

	      if (item === 'slideBy' && result === 'page') {
	        result = getOption('items');
	      }

	      if (!carousel && (item === 'slideBy' || item === 'items')) {
	        result = Math.floor(result);
	      }

	      return result;
	    }
	  }

	  function getSlideMarginLeft(i) {
	    return CALC ? CALC + '(' + i * 100 + '% / ' + slideCountNew + ')' : i * 100 / slideCountNew + '%';
	  }

	  function getInnerWrapperStyles(edgePaddingTem, gutterTem, fixedWidthTem, speedTem, autoHeightBP) {
	    var str = '';

	    if (edgePaddingTem !== undefined) {
	      var gap = edgePaddingTem;

	      if (gutterTem) {
	        gap -= gutterTem;
	      }

	      str = horizontal ? 'margin: 0 ' + gap + 'px 0 ' + edgePaddingTem + 'px;' : 'margin: ' + edgePaddingTem + 'px 0 ' + gap + 'px 0;';
	    } else if (gutterTem && !fixedWidthTem) {
	      var gutterTemUnit = '-' + gutterTem + 'px',
	          dir = horizontal ? gutterTemUnit + ' 0 0' : '0 ' + gutterTemUnit + ' 0';
	      str = 'margin: 0 ' + dir + ';';
	    }

	    if (!carousel && autoHeightBP && TRANSITIONDURATION && speedTem) {
	      str += getTransitionDurationStyle(speedTem);
	    }

	    return str;
	  }

	  function getContainerWidth(fixedWidthTem, gutterTem, itemsTem) {
	    if (fixedWidthTem) {
	      return (fixedWidthTem + gutterTem) * slideCountNew + 'px';
	    } else {
	      return CALC ? CALC + '(' + slideCountNew * 100 + '% / ' + itemsTem + ')' : slideCountNew * 100 / itemsTem + '%';
	    }
	  }

	  function getSlideWidthStyle(fixedWidthTem, gutterTem, itemsTem) {
	    var width;

	    if (fixedWidthTem) {
	      width = fixedWidthTem + gutterTem + 'px';
	    } else {
	      if (!carousel) {
	        itemsTem = Math.floor(itemsTem);
	      }

	      var dividend = carousel ? slideCountNew : itemsTem;
	      width = CALC ? CALC + '(100% / ' + dividend + ')' : 100 / dividend + '%';
	    }

	    width = 'width:' + width; // inner slider: overwrite outer slider styles

	    return nested !== 'inner' ? width + ';' : width + ' !important;';
	  }

	  function getSlideGutterStyle(gutterTem) {
	    var str = ''; // gutter maybe interger || 0
	    // so can't use 'if (gutter)'

	    if (gutterTem !== false) {
	      var prop = horizontal ? 'padding-' : 'margin-',
	          dir = horizontal ? 'right' : 'bottom';
	      str = prop + dir + ': ' + gutterTem + 'px;';
	    }

	    return str;
	  }

	  function getCSSPrefix(name, num) {
	    var prefix = name.substring(0, name.length - num).toLowerCase();

	    if (prefix) {
	      prefix = '-' + prefix + '-';
	    }

	    return prefix;
	  }

	  function getTransitionDurationStyle(speed) {
	    return getCSSPrefix(TRANSITIONDURATION, 18) + 'transition-duration:' + speed / 1000 + 's;';
	  }

	  function getAnimationDurationStyle(speed) {
	    return getCSSPrefix(ANIMATIONDURATION, 17) + 'animation-duration:' + speed / 1000 + 's;';
	  }

	  function initStructure() {
	    var classOuter = 'tns-outer',
	        classInner = 'tns-inner';
	        hasOption('gutter');
	    outerWrapper.className = classOuter;
	    innerWrapper.className = classInner;
	    outerWrapper.id = slideId + '-ow';
	    innerWrapper.id = slideId + '-iw'; // set container properties

	    if (container.id === '') {
	      container.id = slideId;
	    }

	    newContainerClasses += PERCENTAGELAYOUT || autoWidth ? ' tns-subpixel' : ' tns-no-subpixel';
	    newContainerClasses += CALC ? ' tns-calc' : ' tns-no-calc';

	    if (autoWidth) {
	      newContainerClasses += ' tns-autowidth';
	    }

	    newContainerClasses += ' tns-' + options.axis;
	    container.className += newContainerClasses; // add constrain layer for carousel

	    if (carousel) {
	      middleWrapper = doc.createElement('div');
	      middleWrapper.id = slideId + '-mw';
	      middleWrapper.className = 'tns-ovh';
	      outerWrapper.appendChild(middleWrapper);
	      middleWrapper.appendChild(innerWrapper);
	    } else {
	      outerWrapper.appendChild(innerWrapper);
	    }

	    if (autoHeight) {
	      var wp = middleWrapper ? middleWrapper : innerWrapper;
	      wp.className += ' tns-ah';
	    }

	    containerParent.insertBefore(outerWrapper, container);
	    innerWrapper.appendChild(container); // add id, class, aria attributes
	    // before clone slides

	    forEach(slideItems, function (item, i) {
	      addClass(item, 'tns-item');

	      if (!item.id) {
	        item.id = slideId + '-item' + i;
	      }

	      if (!carousel && animateNormal) {
	        addClass(item, animateNormal);
	      }

	      setAttrs(item, {
	        'aria-hidden': 'true',
	        'tabindex': '-1'
	      });
	    }); // ## clone slides
	    // carousel: n + slides + n
	    // gallery:      slides + n

	    if (cloneCount) {
	      var fragmentBefore = doc.createDocumentFragment(),
	          fragmentAfter = doc.createDocumentFragment();

	      for (var j = cloneCount; j--;) {
	        var num = j % slideCount,
	            cloneFirst = slideItems[num].cloneNode(true);
	        addClass(cloneFirst, slideClonedClass);
	        removeAttrs(cloneFirst, 'id');
	        fragmentAfter.insertBefore(cloneFirst, fragmentAfter.firstChild);

	        if (carousel) {
	          var cloneLast = slideItems[slideCount - 1 - num].cloneNode(true);
	          addClass(cloneLast, slideClonedClass);
	          removeAttrs(cloneLast, 'id');
	          fragmentBefore.appendChild(cloneLast);
	        }
	      }

	      container.insertBefore(fragmentBefore, container.firstChild);
	      container.appendChild(fragmentAfter);
	      slideItems = container.children;
	    }
	  }

	  function initSliderTransform() {
	    // ## images loaded/failed
	    if (hasOption('autoHeight') || autoWidth || !horizontal) {
	      var imgs = container.querySelectorAll('img'); // add img load event listener

	      forEach(imgs, function (img) {
	        var src = img.src;

	        if (!lazyload) {
	          // not data img
	          if (src && src.indexOf('data:image') < 0) {
	            img.src = '';
	            addEvents(img, imgEvents);
	            addClass(img, 'loading');
	            img.src = src; // data img
	          } else {
	            imgLoaded(img);
	          }
	        }
	      }); // set imgsComplete

	      raf(function () {
	        imgsLoadedCheck(arrayFromNodeList(imgs), function () {
	          imgsComplete = true;
	        });
	      }); // reset imgs for auto height: check visible imgs only

	      if (hasOption('autoHeight')) {
	        imgs = getImageArray(index, Math.min(index + items - 1, slideCountNew - 1));
	      }

	      lazyload ? initSliderTransformStyleCheck() : raf(function () {
	        imgsLoadedCheck(arrayFromNodeList(imgs), initSliderTransformStyleCheck);
	      });
	    } else {
	      // set container transform property
	      if (carousel) {
	        doContainerTransformSilent();
	      } // update slider tools and events


	      initTools();
	      initEvents();
	    }
	  }

	  function initSliderTransformStyleCheck() {
	    if (autoWidth && slideCount > 1) {
	      // check styles application
	      var num = loop ? index : slideCount - 1;

	      (function stylesApplicationCheck() {
	        var left = slideItems[num].getBoundingClientRect().left;
	        var right = slideItems[num - 1].getBoundingClientRect().right;
	        Math.abs(left - right) <= 1 ? initSliderTransformCore() : setTimeout(function () {
	          stylesApplicationCheck();
	        }, 16);
	      })();
	    } else {
	      initSliderTransformCore();
	    }
	  }

	  function initSliderTransformCore() {
	    // run Fn()s which are rely on image loading
	    if (!horizontal || autoWidth) {
	      setSlidePositions();

	      if (autoWidth) {
	        rightBoundary = getRightBoundary();

	        if (freezable) {
	          freeze = getFreeze();
	        }

	        indexMax = getIndexMax(); // <= slidePositions, rightBoundary <=

	        resetVariblesWhenDisable(disable || freeze);
	      } else {
	        updateContentWrapperHeight();
	      }
	    } // set container transform property


	    if (carousel) {
	      doContainerTransformSilent();
	    } // update slider tools and events


	    initTools();
	    initEvents();
	  }

	  function initSheet() {
	    // gallery:
	    // set animation classes and left value for gallery slider
	    if (!carousel) {
	      for (var i = index, l = index + Math.min(slideCount, items); i < l; i++) {
	        var item = slideItems[i];
	        item.style.left = (i - index) * 100 / items + '%';
	        addClass(item, animateIn);
	        removeClass(item, animateNormal);
	      }
	    } // #### LAYOUT
	    // ## INLINE-BLOCK VS FLOAT
	    // ## PercentageLayout:
	    // slides: inline-block
	    // remove blank space between slides by set font-size: 0
	    // ## Non PercentageLayout:
	    // slides: float
	    //         margin-right: -100%
	    //         margin-left: ~
	    // Resource: https://docs.google.com/spreadsheets/d/147up245wwTXeQYve3BRSAD4oVcvQmuGsFteJOeA5xNQ/edit?usp=sharing


	    if (horizontal) {
	      if (PERCENTAGELAYOUT || autoWidth) {
	        addCSSRule(sheet, '#' + slideId + ' > .tns-item', 'font-size:' + win.getComputedStyle(slideItems[0]).fontSize + ';', getCssRulesLength(sheet));
	        addCSSRule(sheet, '#' + slideId, 'font-size:0;', getCssRulesLength(sheet));
	      } else if (carousel) {
	        forEach(slideItems, function (slide, i) {
	          slide.style.marginLeft = getSlideMarginLeft(i);
	        });
	      }
	    } // ## BASIC STYLES


	    if (CSSMQ) {
	      // middle wrapper style
	      if (TRANSITIONDURATION) {
	        var str = middleWrapper && options.autoHeight ? getTransitionDurationStyle(options.speed) : '';
	        addCSSRule(sheet, '#' + slideId + '-mw', str, getCssRulesLength(sheet));
	      } // inner wrapper styles


	      str = getInnerWrapperStyles(options.edgePadding, options.gutter, options.fixedWidth, options.speed, options.autoHeight);
	      addCSSRule(sheet, '#' + slideId + '-iw', str, getCssRulesLength(sheet)); // container styles

	      if (carousel) {
	        str = horizontal && !autoWidth ? 'width:' + getContainerWidth(options.fixedWidth, options.gutter, options.items) + ';' : '';

	        if (TRANSITIONDURATION) {
	          str += getTransitionDurationStyle(speed);
	        }

	        addCSSRule(sheet, '#' + slideId, str, getCssRulesLength(sheet));
	      } // slide styles


	      str = horizontal && !autoWidth ? getSlideWidthStyle(options.fixedWidth, options.gutter, options.items) : '';

	      if (options.gutter) {
	        str += getSlideGutterStyle(options.gutter);
	      } // set gallery items transition-duration


	      if (!carousel) {
	        if (TRANSITIONDURATION) {
	          str += getTransitionDurationStyle(speed);
	        }

	        if (ANIMATIONDURATION) {
	          str += getAnimationDurationStyle(speed);
	        }
	      }

	      if (str) {
	        addCSSRule(sheet, '#' + slideId + ' > .tns-item', str, getCssRulesLength(sheet));
	      } // non CSS mediaqueries: IE8
	      // ## update inner wrapper, container, slides if needed
	      // set inline styles for inner wrapper & container
	      // insert stylesheet (one line) for slides only (since slides are many)

	    } else {
	      // middle wrapper styles
	      update_carousel_transition_duration(); // inner wrapper styles

	      innerWrapper.style.cssText = getInnerWrapperStyles(edgePadding, gutter, fixedWidth, autoHeight); // container styles

	      if (carousel && horizontal && !autoWidth) {
	        container.style.width = getContainerWidth(fixedWidth, gutter, items);
	      } // slide styles


	      var str = horizontal && !autoWidth ? getSlideWidthStyle(fixedWidth, gutter, items) : '';

	      if (gutter) {
	        str += getSlideGutterStyle(gutter);
	      } // append to the last line


	      if (str) {
	        addCSSRule(sheet, '#' + slideId + ' > .tns-item', str, getCssRulesLength(sheet));
	      }
	    } // ## MEDIAQUERIES


	    if (responsive && CSSMQ) {
	      for (var bp in responsive) {
	        // bp: convert string to number
	        bp = parseInt(bp);
	        var opts = responsive[bp],
	            str = '',
	            middleWrapperStr = '',
	            innerWrapperStr = '',
	            containerStr = '',
	            slideStr = '',
	            itemsBP = !autoWidth ? getOption('items', bp) : null,
	            fixedWidthBP = getOption('fixedWidth', bp),
	            speedBP = getOption('speed', bp),
	            edgePaddingBP = getOption('edgePadding', bp),
	            autoHeightBP = getOption('autoHeight', bp),
	            gutterBP = getOption('gutter', bp); // middle wrapper string

	        if (TRANSITIONDURATION && middleWrapper && getOption('autoHeight', bp) && 'speed' in opts) {
	          middleWrapperStr = '#' + slideId + '-mw{' + getTransitionDurationStyle(speedBP) + '}';
	        } // inner wrapper string


	        if ('edgePadding' in opts || 'gutter' in opts) {
	          innerWrapperStr = '#' + slideId + '-iw{' + getInnerWrapperStyles(edgePaddingBP, gutterBP, fixedWidthBP, speedBP, autoHeightBP) + '}';
	        } // container string


	        if (carousel && horizontal && !autoWidth && ('fixedWidth' in opts || 'items' in opts || fixedWidth && 'gutter' in opts)) {
	          containerStr = 'width:' + getContainerWidth(fixedWidthBP, gutterBP, itemsBP) + ';';
	        }

	        if (TRANSITIONDURATION && 'speed' in opts) {
	          containerStr += getTransitionDurationStyle(speedBP);
	        }

	        if (containerStr) {
	          containerStr = '#' + slideId + '{' + containerStr + '}';
	        } // slide string


	        if ('fixedWidth' in opts || fixedWidth && 'gutter' in opts || !carousel && 'items' in opts) {
	          slideStr += getSlideWidthStyle(fixedWidthBP, gutterBP, itemsBP);
	        }

	        if ('gutter' in opts) {
	          slideStr += getSlideGutterStyle(gutterBP);
	        } // set gallery items transition-duration


	        if (!carousel && 'speed' in opts) {
	          if (TRANSITIONDURATION) {
	            slideStr += getTransitionDurationStyle(speedBP);
	          }

	          if (ANIMATIONDURATION) {
	            slideStr += getAnimationDurationStyle(speedBP);
	          }
	        }

	        if (slideStr) {
	          slideStr = '#' + slideId + ' > .tns-item{' + slideStr + '}';
	        } // add up


	        str = middleWrapperStr + innerWrapperStr + containerStr + slideStr;

	        if (str) {
	          sheet.insertRule('@media (min-width: ' + bp / 16 + 'em) {' + str + '}', sheet.cssRules.length);
	        }
	      }
	    }
	  }

	  function initTools() {
	    // == slides ==
	    updateSlideStatus(); // == live region ==

	    outerWrapper.insertAdjacentHTML('afterbegin', '<div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide <span class="current">' + getLiveRegionStr() + '</span>  of ' + slideCount + '</div>');
	    liveregionCurrent = outerWrapper.querySelector('.tns-liveregion .current'); // == autoplayInit ==

	    if (hasAutoplay) {
	      var txt = autoplay ? 'stop' : 'start';

	      if (autoplayButton) {
	        setAttrs(autoplayButton, {
	          'data-action': txt
	        });
	      } else if (options.autoplayButtonOutput) {
	        outerWrapper.insertAdjacentHTML(getInsertPosition(options.autoplayPosition), '<button type="button" data-action="' + txt + '">' + autoplayHtmlStrings[0] + txt + autoplayHtmlStrings[1] + autoplayText[0] + '</button>');
	        autoplayButton = outerWrapper.querySelector('[data-action]');
	      } // add event


	      if (autoplayButton) {
	        addEvents(autoplayButton, {
	          'click': toggleAutoplay
	        });
	      }

	      if (autoplay) {
	        startAutoplay();

	        if (autoplayHoverPause) {
	          addEvents(container, hoverEvents);
	        }

	        if (autoplayResetOnVisibility) {
	          addEvents(container, visibilityEvent);
	        }
	      }
	    } // == navInit ==


	    if (hasNav) {
	      // will not hide the navs in case they're thumbnails

	      if (navContainer) {
	        setAttrs(navContainer, {
	          'aria-label': 'Carousel Pagination'
	        });
	        navItems = navContainer.children;
	        forEach(navItems, function (item, i) {
	          setAttrs(item, {
	            'data-nav': i,
	            'tabindex': '-1',
	            'aria-label': navStr + (i + 1),
	            'aria-controls': slideId
	          });
	        }); // generated nav
	      } else {
	        var navHtml = '',
	            hiddenStr = navAsThumbnails ? '' : 'style="display:none"';

	        for (var i = 0; i < slideCount; i++) {
	          // hide nav items by default
	          navHtml += '<button type="button" data-nav="' + i + '" tabindex="-1" aria-controls="' + slideId + '" ' + hiddenStr + ' aria-label="' + navStr + (i + 1) + '"></button>';
	        }

	        navHtml = '<div class="tns-nav" aria-label="Carousel Pagination">' + navHtml + '</div>';
	        outerWrapper.insertAdjacentHTML(getInsertPosition(options.navPosition), navHtml);
	        navContainer = outerWrapper.querySelector('.tns-nav');
	        navItems = navContainer.children;
	      }

	      updateNavVisibility(); // add transition

	      if (TRANSITIONDURATION) {
	        var prefix = TRANSITIONDURATION.substring(0, TRANSITIONDURATION.length - 18).toLowerCase(),
	            str = 'transition: all ' + speed / 1000 + 's';

	        if (prefix) {
	          str = '-' + prefix + '-' + str;
	        }

	        addCSSRule(sheet, '[aria-controls^=' + slideId + '-item]', str, getCssRulesLength(sheet));
	      }

	      setAttrs(navItems[navCurrentIndex], {
	        'aria-label': navStr + (navCurrentIndex + 1) + navStrCurrent
	      });
	      removeAttrs(navItems[navCurrentIndex], 'tabindex');
	      addClass(navItems[navCurrentIndex], navActiveClass); // add events

	      addEvents(navContainer, navEvents);
	    } // == controlsInit ==


	    if (hasControls) {
	      if (!controlsContainer && (!prevButton || !nextButton)) {
	        outerWrapper.insertAdjacentHTML(getInsertPosition(options.controlsPosition), '<div class="tns-controls" aria-label="Carousel Navigation" tabindex="0"><button type="button" data-controls="prev" tabindex="-1" aria-controls="' + slideId + '">' + controlsText[0] + '</button><button type="button" data-controls="next" tabindex="-1" aria-controls="' + slideId + '">' + controlsText[1] + '</button></div>');
	        controlsContainer = outerWrapper.querySelector('.tns-controls');
	      }

	      if (!prevButton || !nextButton) {
	        prevButton = controlsContainer.children[0];
	        nextButton = controlsContainer.children[1];
	      }

	      if (options.controlsContainer) {
	        setAttrs(controlsContainer, {
	          'aria-label': 'Carousel Navigation',
	          'tabindex': '0'
	        });
	      }

	      if (options.controlsContainer || options.prevButton && options.nextButton) {
	        setAttrs([prevButton, nextButton], {
	          'aria-controls': slideId,
	          'tabindex': '-1'
	        });
	      }

	      if (options.controlsContainer || options.prevButton && options.nextButton) {
	        setAttrs(prevButton, {
	          'data-controls': 'prev'
	        });
	        setAttrs(nextButton, {
	          'data-controls': 'next'
	        });
	      }

	      prevIsButton = isButton(prevButton);
	      nextIsButton = isButton(nextButton);
	      updateControlsStatus(); // add events

	      if (controlsContainer) {
	        addEvents(controlsContainer, controlsEvents);
	      } else {
	        addEvents(prevButton, controlsEvents);
	        addEvents(nextButton, controlsEvents);
	      }
	    } // hide tools if needed


	    disableUI();
	  }

	  function initEvents() {
	    // add events
	    if (carousel && TRANSITIONEND) {
	      var eve = {};
	      eve[TRANSITIONEND] = onTransitionEnd;
	      addEvents(container, eve);
	    }

	    if (touch) {
	      addEvents(container, touchEvents, options.preventScrollOnTouch);
	    }

	    if (mouseDrag) {
	      addEvents(container, dragEvents);
	    }

	    if (arrowKeys) {
	      addEvents(doc, docmentKeydownEvent);
	    }

	    if (nested === 'inner') {
	      events.on('outerResized', function () {
	        resizeTasks();
	        events.emit('innerLoaded', info());
	      });
	    } else if (responsive || fixedWidth || autoWidth || autoHeight || !horizontal) {
	      addEvents(win, {
	        'resize': onResize
	      });
	    }

	    if (autoHeight) {
	      if (nested === 'outer') {
	        events.on('innerLoaded', doAutoHeight);
	      } else if (!disable) {
	        doAutoHeight();
	      }
	    }

	    doLazyLoad();

	    if (disable) {
	      disableSlider();
	    } else if (freeze) {
	      freezeSlider();
	    }

	    events.on('indexChanged', additionalUpdates);

	    if (nested === 'inner') {
	      events.emit('innerLoaded', info());
	    }

	    if (typeof onInit === 'function') {
	      onInit(info());
	    }

	    isOn = true;
	  }

	  function destroy() {
	    // sheet
	    sheet.disabled = true;

	    if (sheet.ownerNode) {
	      sheet.ownerNode.remove();
	    } // remove win event listeners


	    removeEvents(win, {
	      'resize': onResize
	    }); // arrowKeys, controls, nav

	    if (arrowKeys) {
	      removeEvents(doc, docmentKeydownEvent);
	    }

	    if (controlsContainer) {
	      removeEvents(controlsContainer, controlsEvents);
	    }

	    if (navContainer) {
	      removeEvents(navContainer, navEvents);
	    } // autoplay


	    removeEvents(container, hoverEvents);
	    removeEvents(container, visibilityEvent);

	    if (autoplayButton) {
	      removeEvents(autoplayButton, {
	        'click': toggleAutoplay
	      });
	    }

	    if (autoplay) {
	      clearInterval(autoplayTimer);
	    } // container


	    if (carousel && TRANSITIONEND) {
	      var eve = {};
	      eve[TRANSITIONEND] = onTransitionEnd;
	      removeEvents(container, eve);
	    }

	    if (touch) {
	      removeEvents(container, touchEvents);
	    }

	    if (mouseDrag) {
	      removeEvents(container, dragEvents);
	    } // cache Object values in options && reset HTML


	    var htmlList = [containerHTML, controlsContainerHTML, prevButtonHTML, nextButtonHTML, navContainerHTML, autoplayButtonHTML];
	    tnsList.forEach(function (item, i) {
	      var el = item === 'container' ? outerWrapper : options[item];

	      if (typeof el === 'object' && el) {
	        var prevEl = el.previousElementSibling ? el.previousElementSibling : false,
	            parentEl = el.parentNode;
	        el.outerHTML = htmlList[i];
	        options[item] = prevEl ? prevEl.nextElementSibling : parentEl.firstElementChild;
	      }
	    }); // reset variables

	    tnsList = animateIn = animateOut = animateDelay = animateNormal = horizontal = outerWrapper = innerWrapper = container = containerParent = containerHTML = slideItems = slideCount = breakpointZone = windowWidth = autoWidth = fixedWidth = edgePadding = gutter = viewport = items = slideBy = viewportMax = arrowKeys = speed = rewind = loop = autoHeight = sheet = lazyload = slidePositions = slideItemsOut = cloneCount = slideCountNew = hasRightDeadZone = rightBoundary = updateIndexBeforeTransform = transformAttr = transformPrefix = transformPostfix = getIndexMax = index = indexCached = indexMin = indexMax = swipeAngle = moveDirectionExpected = running = onInit = events = newContainerClasses = slideId = disable = disabled = freezable = freeze = frozen = controlsEvents = navEvents = hoverEvents = visibilityEvent = docmentKeydownEvent = touchEvents = dragEvents = hasControls = hasNav = navAsThumbnails = hasAutoplay = hasTouch = hasMouseDrag = slideActiveClass = imgCompleteClass = imgEvents = imgsComplete = controls = controlsText = controlsContainer = controlsContainerHTML = prevButton = nextButton = prevIsButton = nextIsButton = nav = navContainer = navContainerHTML = navItems = pages = pagesCached = navClicked = navCurrentIndex = navCurrentIndexCached = navActiveClass = navStr = navStrCurrent = autoplay = autoplayTimeout = autoplayDirection = autoplayText = autoplayHoverPause = autoplayButton = autoplayButtonHTML = autoplayResetOnVisibility = autoplayHtmlStrings = autoplayTimer = animating = autoplayHoverPaused = autoplayUserPaused = autoplayVisibilityPaused = initPosition = lastPosition = translateInit = panStart = rafIndex = getDist = touch = mouseDrag = null; // check variables
	    // [animateIn, animateOut, animateDelay, animateNormal, horizontal, outerWrapper, innerWrapper, container, containerParent, containerHTML, slideItems, slideCount, breakpointZone, windowWidth, autoWidth, fixedWidth, edgePadding, gutter, viewport, items, slideBy, viewportMax, arrowKeys, speed, rewind, loop, autoHeight, sheet, lazyload, slidePositions, slideItemsOut, cloneCount, slideCountNew, hasRightDeadZone, rightBoundary, updateIndexBeforeTransform, transformAttr, transformPrefix, transformPostfix, getIndexMax, index, indexCached, indexMin, indexMax, resizeTimer, swipeAngle, moveDirectionExpected, running, onInit, events, newContainerClasses, slideId, disable, disabled, freezable, freeze, frozen, controlsEvents, navEvents, hoverEvents, visibilityEvent, docmentKeydownEvent, touchEvents, dragEvents, hasControls, hasNav, navAsThumbnails, hasAutoplay, hasTouch, hasMouseDrag, slideActiveClass, imgCompleteClass, imgEvents, imgsComplete, controls, controlsText, controlsContainer, controlsContainerHTML, prevButton, nextButton, prevIsButton, nextIsButton, nav, navContainer, navContainerHTML, navItems, pages, pagesCached, navClicked, navCurrentIndex, navCurrentIndexCached, navActiveClass, navStr, navStrCurrent, autoplay, autoplayTimeout, autoplayDirection, autoplayText, autoplayHoverPause, autoplayButton, autoplayButtonHTML, autoplayResetOnVisibility, autoplayHtmlStrings, autoplayTimer, animating, autoplayHoverPaused, autoplayUserPaused, autoplayVisibilityPaused, initPosition, lastPosition, translateInit, disX, disY, panStart, rafIndex, getDist, touch, mouseDrag ].forEach(function(item) { if (item !== null) { console.log(item); } });

	    for (var a in this) {
	      if (a !== 'rebuild') {
	        this[a] = null;
	      }
	    }

	    isOn = false;
	  } // === ON RESIZE ===
	  // responsive || fixedWidth || autoWidth || !horizontal


	  function onResize(e) {
	    raf(function () {
	      resizeTasks(getEvent(e));
	    });
	  }

	  function resizeTasks(e) {
	    if (!isOn) {
	      return;
	    }

	    if (nested === 'outer') {
	      events.emit('outerResized', info(e));
	    }

	    windowWidth = getWindowWidth();
	    var bpChanged,
	        breakpointZoneTem = breakpointZone,
	        needContainerTransform = false;

	    if (responsive) {
	      setBreakpointZone();
	      bpChanged = breakpointZoneTem !== breakpointZone; // if (hasRightDeadZone) { needContainerTransform = true; } // *?

	      if (bpChanged) {
	        events.emit('newBreakpointStart', info(e));
	      }
	    }

	    var indChanged,
	        itemsChanged,
	        itemsTem = items,
	        disableTem = disable,
	        freezeTem = freeze,
	        arrowKeysTem = arrowKeys,
	        controlsTem = controls,
	        navTem = nav,
	        touchTem = touch,
	        mouseDragTem = mouseDrag,
	        autoplayTem = autoplay,
	        autoplayHoverPauseTem = autoplayHoverPause,
	        autoplayResetOnVisibilityTem = autoplayResetOnVisibility,
	        indexTem = index;

	    if (bpChanged) {
	      var fixedWidthTem = fixedWidth,
	          autoHeightTem = autoHeight,
	          controlsTextTem = controlsText,
	          centerTem = center,
	          autoplayTextTem = autoplayText;

	      if (!CSSMQ) {
	        var gutterTem = gutter,
	            edgePaddingTem = edgePadding;
	      }
	    } // get option:
	    // fixed width: viewport, fixedWidth, gutter => items
	    // others: window width => all variables
	    // all: items => slideBy


	    arrowKeys = getOption('arrowKeys');
	    controls = getOption('controls');
	    nav = getOption('nav');
	    touch = getOption('touch');
	    center = getOption('center');
	    mouseDrag = getOption('mouseDrag');
	    autoplay = getOption('autoplay');
	    autoplayHoverPause = getOption('autoplayHoverPause');
	    autoplayResetOnVisibility = getOption('autoplayResetOnVisibility');

	    if (bpChanged) {
	      disable = getOption('disable');
	      fixedWidth = getOption('fixedWidth');
	      speed = getOption('speed');
	      autoHeight = getOption('autoHeight');
	      controlsText = getOption('controlsText');
	      autoplayText = getOption('autoplayText');
	      autoplayTimeout = getOption('autoplayTimeout');

	      if (!CSSMQ) {
	        edgePadding = getOption('edgePadding');
	        gutter = getOption('gutter');
	      }
	    } // update options


	    resetVariblesWhenDisable(disable);
	    viewport = getViewportWidth(); // <= edgePadding, gutter

	    if ((!horizontal || autoWidth) && !disable) {
	      setSlidePositions();

	      if (!horizontal) {
	        updateContentWrapperHeight(); // <= setSlidePositions

	        needContainerTransform = true;
	      }
	    }

	    if (fixedWidth || autoWidth) {
	      rightBoundary = getRightBoundary(); // autoWidth: <= viewport, slidePositions, gutter
	      // fixedWidth: <= viewport, fixedWidth, gutter

	      indexMax = getIndexMax(); // autoWidth: <= rightBoundary, slidePositions
	      // fixedWidth: <= rightBoundary, fixedWidth, gutter
	    }

	    if (bpChanged || fixedWidth) {
	      items = getOption('items');
	      slideBy = getOption('slideBy');
	      itemsChanged = items !== itemsTem;

	      if (itemsChanged) {
	        if (!fixedWidth && !autoWidth) {
	          indexMax = getIndexMax();
	        } // <= items
	        // check index before transform in case
	        // slider reach the right edge then items become bigger


	        updateIndex();
	      }
	    }

	    if (bpChanged) {
	      if (disable !== disableTem) {
	        if (disable) {
	          disableSlider();
	        } else {
	          enableSlider(); // <= slidePositions, rightBoundary, indexMax
	        }
	      }
	    }

	    if (freezable && (bpChanged || fixedWidth || autoWidth)) {
	      freeze = getFreeze(); // <= autoWidth: slidePositions, gutter, viewport, rightBoundary
	      // <= fixedWidth: fixedWidth, gutter, rightBoundary
	      // <= others: items

	      if (freeze !== freezeTem) {
	        if (freeze) {
	          doContainerTransform(getContainerTransformValue(getStartIndex(0)));
	          freezeSlider();
	        } else {
	          unfreezeSlider();
	          needContainerTransform = true;
	        }
	      }
	    }

	    resetVariblesWhenDisable(disable || freeze); // controls, nav, touch, mouseDrag, arrowKeys, autoplay, autoplayHoverPause, autoplayResetOnVisibility

	    if (!autoplay) {
	      autoplayHoverPause = autoplayResetOnVisibility = false;
	    }

	    if (arrowKeys !== arrowKeysTem) {
	      arrowKeys ? addEvents(doc, docmentKeydownEvent) : removeEvents(doc, docmentKeydownEvent);
	    }

	    if (controls !== controlsTem) {
	      if (controls) {
	        if (controlsContainer) {
	          showElement(controlsContainer);
	        } else {
	          if (prevButton) {
	            showElement(prevButton);
	          }

	          if (nextButton) {
	            showElement(nextButton);
	          }
	        }
	      } else {
	        if (controlsContainer) {
	          hideElement(controlsContainer);
	        } else {
	          if (prevButton) {
	            hideElement(prevButton);
	          }

	          if (nextButton) {
	            hideElement(nextButton);
	          }
	        }
	      }
	    }

	    if (nav !== navTem) {
	      if (nav) {
	        showElement(navContainer);
	        updateNavVisibility();
	      } else {
	        hideElement(navContainer);
	      }
	    }

	    if (touch !== touchTem) {
	      touch ? addEvents(container, touchEvents, options.preventScrollOnTouch) : removeEvents(container, touchEvents);
	    }

	    if (mouseDrag !== mouseDragTem) {
	      mouseDrag ? addEvents(container, dragEvents) : removeEvents(container, dragEvents);
	    }

	    if (autoplay !== autoplayTem) {
	      if (autoplay) {
	        if (autoplayButton) {
	          showElement(autoplayButton);
	        }

	        if (!animating && !autoplayUserPaused) {
	          startAutoplay();
	        }
	      } else {
	        if (autoplayButton) {
	          hideElement(autoplayButton);
	        }

	        if (animating) {
	          stopAutoplay();
	        }
	      }
	    }

	    if (autoplayHoverPause !== autoplayHoverPauseTem) {
	      autoplayHoverPause ? addEvents(container, hoverEvents) : removeEvents(container, hoverEvents);
	    }

	    if (autoplayResetOnVisibility !== autoplayResetOnVisibilityTem) {
	      autoplayResetOnVisibility ? addEvents(doc, visibilityEvent) : removeEvents(doc, visibilityEvent);
	    }

	    if (bpChanged) {
	      if (fixedWidth !== fixedWidthTem || center !== centerTem) {
	        needContainerTransform = true;
	      }

	      if (autoHeight !== autoHeightTem) {
	        if (!autoHeight) {
	          innerWrapper.style.height = '';
	        }
	      }

	      if (controls && controlsText !== controlsTextTem) {
	        prevButton.innerHTML = controlsText[0];
	        nextButton.innerHTML = controlsText[1];
	      }

	      if (autoplayButton && autoplayText !== autoplayTextTem) {
	        var i = autoplay ? 1 : 0,
	            html = autoplayButton.innerHTML,
	            len = html.length - autoplayTextTem[i].length;

	        if (html.substring(len) === autoplayTextTem[i]) {
	          autoplayButton.innerHTML = html.substring(0, len) + autoplayText[i];
	        }
	      }
	    } else {
	      if (center && (fixedWidth || autoWidth)) {
	        needContainerTransform = true;
	      }
	    }

	    if (itemsChanged || fixedWidth && !autoWidth) {
	      pages = getPages();
	      updateNavVisibility();
	    }

	    indChanged = index !== indexTem;

	    if (indChanged) {
	      events.emit('indexChanged', info());
	      needContainerTransform = true;
	    } else if (itemsChanged) {
	      if (!indChanged) {
	        additionalUpdates();
	      }
	    } else if (fixedWidth || autoWidth) {
	      doLazyLoad();
	      updateSlideStatus();
	      updateLiveRegion();
	    }

	    if (itemsChanged && !carousel) {
	      updateGallerySlidePositions();
	    }

	    if (!disable && !freeze) {
	      // non-mediaqueries: IE8
	      if (bpChanged && !CSSMQ) {
	        // middle wrapper styles
	        // inner wrapper styles
	        if (edgePadding !== edgePaddingTem || gutter !== gutterTem) {
	          innerWrapper.style.cssText = getInnerWrapperStyles(edgePadding, gutter, fixedWidth, speed, autoHeight);
	        }

	        if (horizontal) {
	          // container styles
	          if (carousel) {
	            container.style.width = getContainerWidth(fixedWidth, gutter, items);
	          } // slide styles


	          var str = getSlideWidthStyle(fixedWidth, gutter, items) + getSlideGutterStyle(gutter); // remove the last line and
	          // add new styles

	          removeCSSRule(sheet, getCssRulesLength(sheet) - 1);
	          addCSSRule(sheet, '#' + slideId + ' > .tns-item', str, getCssRulesLength(sheet));
	        }
	      } // auto height


	      if (autoHeight) {
	        doAutoHeight();
	      }

	      if (needContainerTransform) {
	        doContainerTransformSilent();
	        indexCached = index;
	      }
	    }

	    if (bpChanged) {
	      events.emit('newBreakpointEnd', info(e));
	    }
	  } // === INITIALIZATION FUNCTIONS === //


	  function getFreeze() {
	    if (!fixedWidth && !autoWidth) {
	      var a = center ? items - (items - 1) / 2 : items;
	      return slideCount <= a;
	    }

	    var width = fixedWidth ? (fixedWidth + gutter) * slideCount : slidePositions[slideCount],
	        vp = edgePadding ? viewport + edgePadding * 2 : viewport + gutter;

	    if (center) {
	      vp -= fixedWidth ? (viewport - fixedWidth) / 2 : (viewport - (slidePositions[index + 1] - slidePositions[index] - gutter)) / 2;
	    }

	    return width <= vp;
	  }

	  function setBreakpointZone() {
	    breakpointZone = 0;

	    for (var bp in responsive) {
	      bp = parseInt(bp); // convert string to number

	      if (windowWidth >= bp) {
	        breakpointZone = bp;
	      }
	    }
	  } // (slideBy, indexMin, indexMax) => index


	  var updateIndex = function () {
	    return loop ? carousel ? // loop + carousel
	    function () {
	      var leftEdge = indexMin,
	          rightEdge = indexMax;
	      leftEdge += slideBy;
	      rightEdge -= slideBy; // adjust edges when has edge paddings
	      // or fixed-width slider with extra space on the right side

	      if (edgePadding) {
	        leftEdge += 1;
	        rightEdge -= 1;
	      } else if (fixedWidth) {
	        if ((viewport + gutter) % (fixedWidth + gutter)) {
	          rightEdge -= 1;
	        }
	      }

	      if (cloneCount) {
	        if (index > rightEdge) {
	          index -= slideCount;
	        } else if (index < leftEdge) {
	          index += slideCount;
	        }
	      }
	    } : // loop + gallery
	    function () {
	      if (index > indexMax) {
	        while (index >= indexMin + slideCount) {
	          index -= slideCount;
	        }
	      } else if (index < indexMin) {
	        while (index <= indexMax - slideCount) {
	          index += slideCount;
	        }
	      }
	    } : // non-loop
	    function () {
	      index = Math.max(indexMin, Math.min(indexMax, index));
	    };
	  }();

	  function disableUI() {
	    if (!autoplay && autoplayButton) {
	      hideElement(autoplayButton);
	    }

	    if (!nav && navContainer) {
	      hideElement(navContainer);
	    }

	    if (!controls) {
	      if (controlsContainer) {
	        hideElement(controlsContainer);
	      } else {
	        if (prevButton) {
	          hideElement(prevButton);
	        }

	        if (nextButton) {
	          hideElement(nextButton);
	        }
	      }
	    }
	  }

	  function enableUI() {
	    if (autoplay && autoplayButton) {
	      showElement(autoplayButton);
	    }

	    if (nav && navContainer) {
	      showElement(navContainer);
	    }

	    if (controls) {
	      if (controlsContainer) {
	        showElement(controlsContainer);
	      } else {
	        if (prevButton) {
	          showElement(prevButton);
	        }

	        if (nextButton) {
	          showElement(nextButton);
	        }
	      }
	    }
	  }

	  function freezeSlider() {
	    if (frozen) {
	      return;
	    } // remove edge padding from inner wrapper


	    if (edgePadding) {
	      innerWrapper.style.margin = '0px';
	    } // add class tns-transparent to cloned slides


	    if (cloneCount) {
	      var str = 'tns-transparent';

	      for (var i = cloneCount; i--;) {
	        if (carousel) {
	          addClass(slideItems[i], str);
	        }

	        addClass(slideItems[slideCountNew - i - 1], str);
	      }
	    } // update tools


	    disableUI();
	    frozen = true;
	  }

	  function unfreezeSlider() {
	    if (!frozen) {
	      return;
	    } // restore edge padding for inner wrapper
	    // for mordern browsers


	    if (edgePadding && CSSMQ) {
	      innerWrapper.style.margin = '';
	    } // remove class tns-transparent to cloned slides


	    if (cloneCount) {
	      var str = 'tns-transparent';

	      for (var i = cloneCount; i--;) {
	        if (carousel) {
	          removeClass(slideItems[i], str);
	        }

	        removeClass(slideItems[slideCountNew - i - 1], str);
	      }
	    } // update tools


	    enableUI();
	    frozen = false;
	  }

	  function disableSlider() {
	    if (disabled) {
	      return;
	    }

	    sheet.disabled = true;
	    container.className = container.className.replace(newContainerClasses.substring(1), '');
	    removeAttrs(container, ['style']);

	    if (loop) {
	      for (var j = cloneCount; j--;) {
	        if (carousel) {
	          hideElement(slideItems[j]);
	        }

	        hideElement(slideItems[slideCountNew - j - 1]);
	      }
	    } // vertical slider


	    if (!horizontal || !carousel) {
	      removeAttrs(innerWrapper, ['style']);
	    } // gallery


	    if (!carousel) {
	      for (var i = index, l = index + slideCount; i < l; i++) {
	        var item = slideItems[i];
	        removeAttrs(item, ['style']);
	        removeClass(item, animateIn);
	        removeClass(item, animateNormal);
	      }
	    } // update tools


	    disableUI();
	    disabled = true;
	  }

	  function enableSlider() {
	    if (!disabled) {
	      return;
	    }

	    sheet.disabled = false;
	    container.className += newContainerClasses;
	    doContainerTransformSilent();

	    if (loop) {
	      for (var j = cloneCount; j--;) {
	        if (carousel) {
	          showElement(slideItems[j]);
	        }

	        showElement(slideItems[slideCountNew - j - 1]);
	      }
	    } // gallery


	    if (!carousel) {
	      for (var i = index, l = index + slideCount; i < l; i++) {
	        var item = slideItems[i],
	            classN = i < index + items ? animateIn : animateNormal;
	        item.style.left = (i - index) * 100 / items + '%';
	        addClass(item, classN);
	      }
	    } // update tools


	    enableUI();
	    disabled = false;
	  }

	  function updateLiveRegion() {
	    var str = getLiveRegionStr();

	    if (liveregionCurrent.innerHTML !== str) {
	      liveregionCurrent.innerHTML = str;
	    }
	  }

	  function getLiveRegionStr() {
	    var arr = getVisibleSlideRange(),
	        start = arr[0] + 1,
	        end = arr[1] + 1;
	    return start === end ? start + '' : start + ' to ' + end;
	  }

	  function getVisibleSlideRange(val) {
	    if (val == null) {
	      val = getContainerTransformValue();
	    }

	    var start = index,
	        end,
	        rangestart,
	        rangeend; // get range start, range end for autoWidth and fixedWidth

	    if (center || edgePadding) {
	      if (autoWidth || fixedWidth) {
	        rangestart = -(parseFloat(val) + edgePadding);
	        rangeend = rangestart + viewport + edgePadding * 2;
	      }
	    } else {
	      if (autoWidth) {
	        rangestart = slidePositions[index];
	        rangeend = rangestart + viewport;
	      }
	    } // get start, end
	    // - check auto width


	    if (autoWidth) {
	      slidePositions.forEach(function (point, i) {
	        if (i < slideCountNew) {
	          if ((center || edgePadding) && point <= rangestart + 0.5) {
	            start = i;
	          }

	          if (rangeend - point >= 0.5) {
	            end = i;
	          }
	        }
	      }); // - check percentage width, fixed width
	    } else {
	      if (fixedWidth) {
	        var cell = fixedWidth + gutter;

	        if (center || edgePadding) {
	          start = Math.floor(rangestart / cell);
	          end = Math.ceil(rangeend / cell - 1);
	        } else {
	          end = start + Math.ceil(viewport / cell) - 1;
	        }
	      } else {
	        if (center || edgePadding) {
	          var a = items - 1;

	          if (center) {
	            start -= a / 2;
	            end = index + a / 2;
	          } else {
	            end = index + a;
	          }

	          if (edgePadding) {
	            var b = edgePadding * items / viewport;
	            start -= b;
	            end += b;
	          }

	          start = Math.floor(start);
	          end = Math.ceil(end);
	        } else {
	          end = start + items - 1;
	        }
	      }

	      start = Math.max(start, 0);
	      end = Math.min(end, slideCountNew - 1);
	    }

	    return [start, end];
	  }

	  function doLazyLoad() {
	    if (lazyload && !disable) {
	      var arg = getVisibleSlideRange();
	      arg.push(lazyloadSelector);
	      getImageArray.apply(null, arg).forEach(function (img) {
	        if (!hasClass(img, imgCompleteClass)) {
	          // stop propagation transitionend event to container
	          var eve = {};

	          eve[TRANSITIONEND] = function (e) {
	            e.stopPropagation();
	          };

	          addEvents(img, eve);
	          addEvents(img, imgEvents); // update src

	          img.src = getAttr(img, 'data-src'); // update srcset

	          var srcset = getAttr(img, 'data-srcset');

	          if (srcset) {
	            img.srcset = srcset;
	          }

	          addClass(img, 'loading');
	        }
	      });
	    }
	  }

	  function onImgLoaded(e) {
	    imgLoaded(getTarget(e));
	  }

	  function onImgFailed(e) {
	    imgFailed(getTarget(e));
	  }

	  function imgLoaded(img) {
	    addClass(img, 'loaded');
	    imgCompleted(img);
	  }

	  function imgFailed(img) {
	    addClass(img, 'failed');
	    imgCompleted(img);
	  }

	  function imgCompleted(img) {
	    addClass(img, imgCompleteClass);
	    removeClass(img, 'loading');
	    removeEvents(img, imgEvents);
	  }

	  function getImageArray(start, end, imgSelector) {
	    var imgs = [];

	    if (!imgSelector) {
	      imgSelector = 'img';
	    }

	    while (start <= end) {
	      forEach(slideItems[start].querySelectorAll(imgSelector), function (img) {
	        imgs.push(img);
	      });
	      start++;
	    }

	    return imgs;
	  } // check if all visible images are loaded
	  // and update container height if it's done


	  function doAutoHeight() {
	    var imgs = getImageArray.apply(null, getVisibleSlideRange());
	    raf(function () {
	      imgsLoadedCheck(imgs, updateInnerWrapperHeight);
	    });
	  }

	  function imgsLoadedCheck(imgs, cb) {
	    // execute callback function if all images are complete
	    if (imgsComplete) {
	      return cb();
	    } // check image classes


	    imgs.forEach(function (img, index) {
	      if (!lazyload && img.complete) {
	        imgCompleted(img);
	      } // Check image.complete


	      if (hasClass(img, imgCompleteClass)) {
	        imgs.splice(index, 1);
	      }
	    }); // execute callback function if selected images are all complete

	    if (!imgs.length) {
	      return cb();
	    } // otherwise execute this functiona again


	    raf(function () {
	      imgsLoadedCheck(imgs, cb);
	    });
	  }

	  function additionalUpdates() {
	    doLazyLoad();
	    updateSlideStatus();
	    updateLiveRegion();
	    updateControlsStatus();
	    updateNavStatus();
	  }

	  function update_carousel_transition_duration() {
	    if (carousel && autoHeight) {
	      middleWrapper.style[TRANSITIONDURATION] = speed / 1000 + 's';
	    }
	  }

	  function getMaxSlideHeight(slideStart, slideRange) {
	    var heights = [];

	    for (var i = slideStart, l = Math.min(slideStart + slideRange, slideCountNew); i < l; i++) {
	      heights.push(slideItems[i].offsetHeight);
	    }

	    return Math.max.apply(null, heights);
	  } // update inner wrapper height
	  // 1. get the max-height of the visible slides
	  // 2. set transitionDuration to speed
	  // 3. update inner wrapper height to max-height
	  // 4. set transitionDuration to 0s after transition done


	  function updateInnerWrapperHeight() {
	    var maxHeight = autoHeight ? getMaxSlideHeight(index, items) : getMaxSlideHeight(cloneCount, slideCount),
	        wp = middleWrapper ? middleWrapper : innerWrapper;

	    if (wp.style.height !== maxHeight) {
	      wp.style.height = maxHeight + 'px';
	    }
	  } // get the distance from the top edge of the first slide to each slide
	  // (init) => slidePositions


	  function setSlidePositions() {
	    slidePositions = [0];
	    var attr = horizontal ? 'left' : 'top',
	        attr2 = horizontal ? 'right' : 'bottom',
	        base = slideItems[0].getBoundingClientRect()[attr];
	    forEach(slideItems, function (item, i) {
	      // skip the first slide
	      if (i) {
	        slidePositions.push(item.getBoundingClientRect()[attr] - base);
	      } // add the end edge


	      if (i === slideCountNew - 1) {
	        slidePositions.push(item.getBoundingClientRect()[attr2] - base);
	      }
	    });
	  } // update slide


	  function updateSlideStatus() {
	    var range = getVisibleSlideRange(),
	        start = range[0],
	        end = range[1];
	    forEach(slideItems, function (item, i) {
	      // show slides
	      if (i >= start && i <= end) {
	        if (hasAttr(item, 'aria-hidden')) {
	          removeAttrs(item, ['aria-hidden', 'tabindex']);
	          addClass(item, slideActiveClass);
	        } // hide slides

	      } else {
	        if (!hasAttr(item, 'aria-hidden')) {
	          setAttrs(item, {
	            'aria-hidden': 'true',
	            'tabindex': '-1'
	          });
	          removeClass(item, slideActiveClass);
	        }
	      }
	    });
	  } // gallery: update slide position


	  function updateGallerySlidePositions() {
	    var l = index + Math.min(slideCount, items);

	    for (var i = slideCountNew; i--;) {
	      var item = slideItems[i];

	      if (i >= index && i < l) {
	        // add transitions to visible slides when adjusting their positions
	        addClass(item, 'tns-moving');
	        item.style.left = (i - index) * 100 / items + '%';
	        addClass(item, animateIn);
	        removeClass(item, animateNormal);
	      } else if (item.style.left) {
	        item.style.left = '';
	        addClass(item, animateNormal);
	        removeClass(item, animateIn);
	      } // remove outlet animation


	      removeClass(item, animateOut);
	    } // removing '.tns-moving'


	    setTimeout(function () {
	      forEach(slideItems, function (el) {
	        removeClass(el, 'tns-moving');
	      });
	    }, 300);
	  } // set tabindex on Nav


	  function updateNavStatus() {
	    // get current nav
	    if (nav) {
	      navCurrentIndex = navClicked >= 0 ? navClicked : getCurrentNavIndex();
	      navClicked = -1;

	      if (navCurrentIndex !== navCurrentIndexCached) {
	        var navPrev = navItems[navCurrentIndexCached],
	            navCurrent = navItems[navCurrentIndex];
	        setAttrs(navPrev, {
	          'tabindex': '-1',
	          'aria-label': navStr + (navCurrentIndexCached + 1)
	        });
	        removeClass(navPrev, navActiveClass);
	        setAttrs(navCurrent, {
	          'aria-label': navStr + (navCurrentIndex + 1) + navStrCurrent
	        });
	        removeAttrs(navCurrent, 'tabindex');
	        addClass(navCurrent, navActiveClass);
	        navCurrentIndexCached = navCurrentIndex;
	      }
	    }
	  }

	  function getLowerCaseNodeName(el) {
	    return el.nodeName.toLowerCase();
	  }

	  function isButton(el) {
	    return getLowerCaseNodeName(el) === 'button';
	  }

	  function isAriaDisabled(el) {
	    return el.getAttribute('aria-disabled') === 'true';
	  }

	  function disEnableElement(isButton, el, val) {
	    if (isButton) {
	      el.disabled = val;
	    } else {
	      el.setAttribute('aria-disabled', val.toString());
	    }
	  } // set 'disabled' to true on controls when reach the edges


	  function updateControlsStatus() {
	    if (!controls || rewind || loop) {
	      return;
	    }

	    var prevDisabled = prevIsButton ? prevButton.disabled : isAriaDisabled(prevButton),
	        nextDisabled = nextIsButton ? nextButton.disabled : isAriaDisabled(nextButton),
	        disablePrev = index <= indexMin ? true : false,
	        disableNext = !rewind && index >= indexMax ? true : false;

	    if (disablePrev && !prevDisabled) {
	      disEnableElement(prevIsButton, prevButton, true);
	    }

	    if (!disablePrev && prevDisabled) {
	      disEnableElement(prevIsButton, prevButton, false);
	    }

	    if (disableNext && !nextDisabled) {
	      disEnableElement(nextIsButton, nextButton, true);
	    }

	    if (!disableNext && nextDisabled) {
	      disEnableElement(nextIsButton, nextButton, false);
	    }
	  } // set duration


	  function resetDuration(el, str) {
	    if (TRANSITIONDURATION) {
	      el.style[TRANSITIONDURATION] = str;
	    }
	  }

	  function getSliderWidth() {
	    return fixedWidth ? (fixedWidth + gutter) * slideCountNew : slidePositions[slideCountNew];
	  }

	  function getCenterGap(num) {
	    if (num == null) {
	      num = index;
	    }

	    var gap = edgePadding ? gutter : 0;
	    return autoWidth ? (viewport - gap - (slidePositions[num + 1] - slidePositions[num] - gutter)) / 2 : fixedWidth ? (viewport - fixedWidth) / 2 : (items - 1) / 2;
	  }

	  function getRightBoundary() {
	    var gap = edgePadding ? gutter : 0,
	        result = viewport + gap - getSliderWidth();

	    if (center && !loop) {
	      result = fixedWidth ? -(fixedWidth + gutter) * (slideCountNew - 1) - getCenterGap() : getCenterGap(slideCountNew - 1) - slidePositions[slideCountNew - 1];
	    }

	    if (result > 0) {
	      result = 0;
	    }

	    return result;
	  }

	  function getContainerTransformValue(num) {
	    if (num == null) {
	      num = index;
	    }

	    var val;

	    if (horizontal && !autoWidth) {
	      if (fixedWidth) {
	        val = -(fixedWidth + gutter) * num;

	        if (center) {
	          val += getCenterGap();
	        }
	      } else {
	        var denominator = TRANSFORM ? slideCountNew : items;

	        if (center) {
	          num -= getCenterGap();
	        }

	        val = -num * 100 / denominator;
	      }
	    } else {
	      val = -slidePositions[num];

	      if (center && autoWidth) {
	        val += getCenterGap();
	      }
	    }

	    if (hasRightDeadZone) {
	      val = Math.max(val, rightBoundary);
	    }

	    val += horizontal && !autoWidth && !fixedWidth ? '%' : 'px';
	    return val;
	  }

	  function doContainerTransformSilent(val) {
	    resetDuration(container, '0s');
	    doContainerTransform(val);
	  }

	  function doContainerTransform(val) {
	    if (val == null) {
	      val = getContainerTransformValue();
	    }

	    container.style[transformAttr] = transformPrefix + val + transformPostfix;
	  }

	  function animateSlide(number, classOut, classIn, isOut) {
	    var l = number + items;

	    if (!loop) {
	      l = Math.min(l, slideCountNew);
	    }

	    for (var i = number; i < l; i++) {
	      var item = slideItems[i]; // set item positions

	      if (!isOut) {
	        item.style.left = (i - index) * 100 / items + '%';
	      }

	      if (animateDelay && TRANSITIONDELAY) {
	        item.style[TRANSITIONDELAY] = item.style[ANIMATIONDELAY] = animateDelay * (i - number) / 1000 + 's';
	      }

	      removeClass(item, classOut);
	      addClass(item, classIn);

	      if (isOut) {
	        slideItemsOut.push(item);
	      }
	    }
	  } // make transfer after click/drag:
	  // 1. change 'transform' property for mordern browsers
	  // 2. change 'left' property for legacy browsers


	  var transformCore = function () {
	    return carousel ? function () {
	      resetDuration(container, '');

	      if (TRANSITIONDURATION || !speed) {
	        // for morden browsers with non-zero duration or
	        // zero duration for all browsers
	        doContainerTransform(); // run fallback function manually
	        // when duration is 0 / container is hidden

	        if (!speed || !isVisible(container)) {
	          onTransitionEnd();
	        }
	      } else {
	        // for old browser with non-zero duration
	        jsTransform(container, transformAttr, transformPrefix, transformPostfix, getContainerTransformValue(), speed, onTransitionEnd);
	      }

	      if (!horizontal) {
	        updateContentWrapperHeight();
	      }
	    } : function () {
	      slideItemsOut = [];
	      var eve = {};
	      eve[TRANSITIONEND] = eve[ANIMATIONEND] = onTransitionEnd;
	      removeEvents(slideItems[indexCached], eve);
	      addEvents(slideItems[index], eve);
	      animateSlide(indexCached, animateIn, animateOut, true);
	      animateSlide(index, animateNormal, animateIn); // run fallback function manually
	      // when transition or animation not supported / duration is 0

	      if (!TRANSITIONEND || !ANIMATIONEND || !speed || !isVisible(container)) {
	        onTransitionEnd();
	      }
	    };
	  }();

	  function render(e, sliderMoved) {
	    if (updateIndexBeforeTransform) {
	      updateIndex();
	    } // render when slider was moved (touch or drag) even though index may not change


	    if (index !== indexCached || sliderMoved) {
	      // events
	      events.emit('indexChanged', info());
	      events.emit('transitionStart', info());

	      if (autoHeight) {
	        doAutoHeight();
	      } // pause autoplay when click or keydown from user


	      if (animating && e && ['click', 'keydown'].indexOf(e.type) >= 0) {
	        stopAutoplay();
	      }

	      running = true;
	      transformCore();
	    }
	  }
	  /*
	   * Transfer prefixed properties to the same format
	   * CSS: -Webkit-Transform => webkittransform
	   * JS: WebkitTransform => webkittransform
	   * @param {string} str - property
	   *
	   */


	  function strTrans(str) {
	    return str.toLowerCase().replace(/-/g, '');
	  } // AFTER TRANSFORM
	  // Things need to be done after a transfer:
	  // 1. check index
	  // 2. add classes to visible slide
	  // 3. disable controls buttons when reach the first/last slide in non-loop slider
	  // 4. update nav status
	  // 5. lazyload images
	  // 6. update container height


	  function onTransitionEnd(event) {
	    // check running on gallery mode
	    // make sure trantionend/animationend events run only once
	    if (carousel || running) {
	      events.emit('transitionEnd', info(event));

	      if (!carousel && slideItemsOut.length > 0) {
	        for (var i = 0; i < slideItemsOut.length; i++) {
	          var item = slideItemsOut[i]; // set item positions

	          item.style.left = '';

	          if (ANIMATIONDELAY && TRANSITIONDELAY) {
	            item.style[ANIMATIONDELAY] = '';
	            item.style[TRANSITIONDELAY] = '';
	          }

	          removeClass(item, animateOut);
	          addClass(item, animateNormal);
	        }
	      }
	      /* update slides, nav, controls after checking ...
	       * => legacy browsers who don't support 'event'
	       *    have to check event first, otherwise event.target will cause an error
	       * => or 'gallery' mode:
	       *   + event target is slide item
	       * => or 'carousel' mode:
	       *   + event target is container,
	       *   + event.property is the same with transform attribute
	       */


	      if (!event || !carousel && event.target.parentNode === container || event.target === container && strTrans(event.propertyName) === strTrans(transformAttr)) {
	        if (!updateIndexBeforeTransform) {
	          var indexTem = index;
	          updateIndex();

	          if (index !== indexTem) {
	            events.emit('indexChanged', info());
	            doContainerTransformSilent();
	          }
	        }

	        if (nested === 'inner') {
	          events.emit('innerLoaded', info());
	        }

	        running = false;
	        indexCached = index;
	      }
	    }
	  } // # ACTIONS


	  function goTo(targetIndex, e) {
	    if (freeze) {
	      return;
	    } // prev slideBy


	    if (targetIndex === 'prev') {
	      onControlsClick(e, -1); // next slideBy
	    } else if (targetIndex === 'next') {
	      onControlsClick(e, 1); // go to exact slide
	    } else {
	      if (running) {
	        if (preventActionWhenRunning) {
	          return;
	        } else {
	          onTransitionEnd();
	        }
	      }

	      var absIndex = getAbsIndex(),
	          indexGap = 0;

	      if (targetIndex === 'first') {
	        indexGap = -absIndex;
	      } else if (targetIndex === 'last') {
	        indexGap = carousel ? slideCount - items - absIndex : slideCount - 1 - absIndex;
	      } else {
	        if (typeof targetIndex !== 'number') {
	          targetIndex = parseInt(targetIndex);
	        }

	        if (!isNaN(targetIndex)) {
	          // from directly called goTo function
	          if (!e) {
	            targetIndex = Math.max(0, Math.min(slideCount - 1, targetIndex));
	          }

	          indexGap = targetIndex - absIndex;
	        }
	      } // gallery: make sure new page won't overlap with current page


	      if (!carousel && indexGap && Math.abs(indexGap) < items) {
	        var factor = indexGap > 0 ? 1 : -1;
	        indexGap += index + indexGap - slideCount >= indexMin ? slideCount * factor : slideCount * 2 * factor * -1;
	      }

	      index += indexGap; // make sure index is in range

	      if (carousel && loop) {
	        if (index < indexMin) {
	          index += slideCount;
	        }

	        if (index > indexMax) {
	          index -= slideCount;
	        }
	      } // if index is changed, start rendering


	      if (getAbsIndex(index) !== getAbsIndex(indexCached)) {
	        render(e);
	      }
	    }
	  } // on controls click


	  function onControlsClick(e, dir) {
	    if (running) {
	      if (preventActionWhenRunning) {
	        return;
	      } else {
	        onTransitionEnd();
	      }
	    }

	    var passEventObject;

	    if (!dir) {
	      e = getEvent(e);
	      var target = getTarget(e);

	      while (target !== controlsContainer && [prevButton, nextButton].indexOf(target) < 0) {
	        target = target.parentNode;
	      }

	      var targetIn = [prevButton, nextButton].indexOf(target);

	      if (targetIn >= 0) {
	        passEventObject = true;
	        dir = targetIn === 0 ? -1 : 1;
	      }
	    }

	    if (rewind) {
	      if (index === indexMin && dir === -1) {
	        goTo('last', e);
	        return;
	      } else if (index === indexMax && dir === 1) {
	        goTo('first', e);
	        return;
	      }
	    }

	    if (dir) {
	      index += slideBy * dir;

	      if (autoWidth) {
	        index = Math.floor(index);
	      } // pass e when click control buttons or keydown


	      render(passEventObject || e && e.type === 'keydown' ? e : null);
	    }
	  } // on nav click


	  function onNavClick(e) {
	    if (running) {
	      if (preventActionWhenRunning) {
	        return;
	      } else {
	        onTransitionEnd();
	      }
	    }

	    e = getEvent(e);
	    var target = getTarget(e),
	        navIndex; // find the clicked nav item

	    while (target !== navContainer && !hasAttr(target, 'data-nav')) {
	      target = target.parentNode;
	    }

	    if (hasAttr(target, 'data-nav')) {
	      var navIndex = navClicked = Number(getAttr(target, 'data-nav')),
	          targetIndexBase = fixedWidth || autoWidth ? navIndex * slideCount / pages : navIndex * items,
	          targetIndex = navAsThumbnails ? navIndex : Math.min(Math.ceil(targetIndexBase), slideCount - 1);
	      goTo(targetIndex, e);

	      if (navCurrentIndex === navIndex) {
	        if (animating) {
	          stopAutoplay();
	        }

	        navClicked = -1; // reset navClicked
	      }
	    }
	  } // autoplay functions


	  function setAutoplayTimer() {
	    autoplayTimer = setInterval(function () {
	      onControlsClick(null, autoplayDirection);
	    }, autoplayTimeout);
	    animating = true;
	  }

	  function stopAutoplayTimer() {
	    clearInterval(autoplayTimer);
	    animating = false;
	  }

	  function updateAutoplayButton(action, txt) {
	    setAttrs(autoplayButton, {
	      'data-action': action
	    });
	    autoplayButton.innerHTML = autoplayHtmlStrings[0] + action + autoplayHtmlStrings[1] + txt;
	  }

	  function startAutoplay() {
	    setAutoplayTimer();

	    if (autoplayButton) {
	      updateAutoplayButton('stop', autoplayText[1]);
	    }
	  }

	  function stopAutoplay() {
	    stopAutoplayTimer();

	    if (autoplayButton) {
	      updateAutoplayButton('start', autoplayText[0]);
	    }
	  } // programaitcally play/pause the slider


	  function play() {
	    if (autoplay && !animating) {
	      startAutoplay();
	      autoplayUserPaused = false;
	    }
	  }

	  function pause() {
	    if (animating) {
	      stopAutoplay();
	      autoplayUserPaused = true;
	    }
	  }

	  function toggleAutoplay() {
	    if (animating) {
	      stopAutoplay();
	      autoplayUserPaused = true;
	    } else {
	      startAutoplay();
	      autoplayUserPaused = false;
	    }
	  }

	  function onVisibilityChange() {
	    if (doc.hidden) {
	      if (animating) {
	        stopAutoplayTimer();
	        autoplayVisibilityPaused = true;
	      }
	    } else if (autoplayVisibilityPaused) {
	      setAutoplayTimer();
	      autoplayVisibilityPaused = false;
	    }
	  }

	  function mouseoverPause() {
	    if (animating) {
	      stopAutoplayTimer();
	      autoplayHoverPaused = true;
	    }
	  }

	  function mouseoutRestart() {
	    if (autoplayHoverPaused) {
	      setAutoplayTimer();
	      autoplayHoverPaused = false;
	    }
	  } // keydown events on document


	  function onDocumentKeydown(e) {
	    e = getEvent(e);
	    var keyIndex = [KEYS.LEFT, KEYS.RIGHT].indexOf(e.keyCode);

	    if (keyIndex >= 0) {
	      onControlsClick(e, keyIndex === 0 ? -1 : 1);
	    }
	  } // on key control


	  function onControlsKeydown(e) {
	    e = getEvent(e);
	    var keyIndex = [KEYS.LEFT, KEYS.RIGHT].indexOf(e.keyCode);

	    if (keyIndex >= 0) {
	      if (keyIndex === 0) {
	        if (!prevButton.disabled) {
	          onControlsClick(e, -1);
	        }
	      } else if (!nextButton.disabled) {
	        onControlsClick(e, 1);
	      }
	    }
	  } // set focus


	  function setFocus(el) {
	    el.focus();
	  } // on key nav


	  function onNavKeydown(e) {
	    e = getEvent(e);
	    var curElement = doc.activeElement;

	    if (!hasAttr(curElement, 'data-nav')) {
	      return;
	    } // var code = e.keyCode,


	    var keyIndex = [KEYS.LEFT, KEYS.RIGHT, KEYS.ENTER, KEYS.SPACE].indexOf(e.keyCode),
	        navIndex = Number(getAttr(curElement, 'data-nav'));

	    if (keyIndex >= 0) {
	      if (keyIndex === 0) {
	        if (navIndex > 0) {
	          setFocus(navItems[navIndex - 1]);
	        }
	      } else if (keyIndex === 1) {
	        if (navIndex < pages - 1) {
	          setFocus(navItems[navIndex + 1]);
	        }
	      } else {
	        navClicked = navIndex;
	        goTo(navIndex, e);
	      }
	    }
	  }

	  function getEvent(e) {
	    e = e || win.event;
	    return isTouchEvent(e) ? e.changedTouches[0] : e;
	  }

	  function getTarget(e) {
	    return e.target || win.event.srcElement;
	  }

	  function isTouchEvent(e) {
	    return e.type.indexOf('touch') >= 0;
	  }

	  function preventDefaultBehavior(e) {
	    e.preventDefault ? e.preventDefault() : e.returnValue = false;
	  }

	  function getMoveDirectionExpected() {
	    return getTouchDirection(toDegree(lastPosition.y - initPosition.y, lastPosition.x - initPosition.x), swipeAngle) === options.axis;
	  }

	  function onPanStart(e) {
	    if (running) {
	      if (preventActionWhenRunning) {
	        return;
	      } else {
	        onTransitionEnd();
	      }
	    }

	    if (autoplay && animating) {
	      stopAutoplayTimer();
	    }

	    panStart = true;

	    if (rafIndex) {
	      caf(rafIndex);
	      rafIndex = null;
	    }

	    var $ = getEvent(e);
	    events.emit(isTouchEvent(e) ? 'touchStart' : 'dragStart', info(e));

	    if (!isTouchEvent(e) && ['img', 'a'].indexOf(getLowerCaseNodeName(getTarget(e))) >= 0) {
	      preventDefaultBehavior(e);
	    }

	    lastPosition.x = initPosition.x = $.clientX;
	    lastPosition.y = initPosition.y = $.clientY;

	    if (carousel) {
	      translateInit = parseFloat(container.style[transformAttr].replace(transformPrefix, ''));
	      resetDuration(container, '0s');
	    }
	  }

	  function onPanMove(e) {
	    if (panStart) {
	      var $ = getEvent(e);
	      lastPosition.x = $.clientX;
	      lastPosition.y = $.clientY;

	      if (carousel) {
	        if (!rafIndex) {
	          rafIndex = raf(function () {
	            panUpdate(e);
	          });
	        }
	      } else {
	        if (moveDirectionExpected === '?') {
	          moveDirectionExpected = getMoveDirectionExpected();
	        }

	        if (moveDirectionExpected) {
	          preventScroll = true;
	        }
	      }

	      if ((typeof e.cancelable !== 'boolean' || e.cancelable) && preventScroll) {
	        e.preventDefault();
	      }
	    }
	  }

	  function panUpdate(e) {
	    if (!moveDirectionExpected) {
	      panStart = false;
	      return;
	    }

	    caf(rafIndex);

	    if (panStart) {
	      rafIndex = raf(function () {
	        panUpdate(e);
	      });
	    }

	    if (moveDirectionExpected === '?') {
	      moveDirectionExpected = getMoveDirectionExpected();
	    }

	    if (moveDirectionExpected) {
	      if (!preventScroll && isTouchEvent(e)) {
	        preventScroll = true;
	      }

	      try {
	        if (e.type) {
	          events.emit(isTouchEvent(e) ? 'touchMove' : 'dragMove', info(e));
	        }
	      } catch (err) {}

	      var x = translateInit,
	          dist = getDist(lastPosition, initPosition);

	      if (!horizontal || fixedWidth || autoWidth) {
	        x += dist;
	        x += 'px';
	      } else {
	        var percentageX = TRANSFORM ? dist * items * 100 / ((viewport + gutter) * slideCountNew) : dist * 100 / (viewport + gutter);
	        x += percentageX;
	        x += '%';
	      }

	      container.style[transformAttr] = transformPrefix + x + transformPostfix;
	    }
	  }

	  function onPanEnd(e) {
	    if (panStart) {
	      if (rafIndex) {
	        caf(rafIndex);
	        rafIndex = null;
	      }

	      if (carousel) {
	        resetDuration(container, '');
	      }

	      panStart = false;
	      var $ = getEvent(e);
	      lastPosition.x = $.clientX;
	      lastPosition.y = $.clientY;
	      var dist = getDist(lastPosition, initPosition);

	      if (Math.abs(dist)) {
	        // drag vs click
	        if (!isTouchEvent(e)) {
	          // prevent "click"
	          var target = getTarget(e);
	          addEvents(target, {
	            'click': function preventClick(e) {
	              preventDefaultBehavior(e);
	              removeEvents(target, {
	                'click': preventClick
	              });
	            }
	          });
	        }

	        if (carousel) {
	          rafIndex = raf(function () {
	            if (horizontal && !autoWidth) {
	              var indexMoved = -dist * items / (viewport + gutter);
	              indexMoved = dist > 0 ? Math.floor(indexMoved) : Math.ceil(indexMoved);
	              index += indexMoved;
	            } else {
	              var moved = -(translateInit + dist);

	              if (moved <= 0) {
	                index = indexMin;
	              } else if (moved >= slidePositions[slideCountNew - 1]) {
	                index = indexMax;
	              } else {
	                var i = 0;

	                while (i < slideCountNew && moved >= slidePositions[i]) {
	                  index = i;

	                  if (moved > slidePositions[i] && dist < 0) {
	                    index += 1;
	                  }

	                  i++;
	                }
	              }
	            }

	            render(e, dist);
	            events.emit(isTouchEvent(e) ? 'touchEnd' : 'dragEnd', info(e));
	          });
	        } else {
	          if (moveDirectionExpected) {
	            onControlsClick(e, dist > 0 ? -1 : 1);
	          }
	        }
	      }
	    } // reset


	    if (options.preventScrollOnTouch === 'auto') {
	      preventScroll = false;
	    }

	    if (swipeAngle) {
	      moveDirectionExpected = '?';
	    }

	    if (autoplay && !animating) {
	      setAutoplayTimer();
	    }
	  } // === RESIZE FUNCTIONS === //
	  // (slidePositions, index, items) => vertical_conentWrapper.height


	  function updateContentWrapperHeight() {
	    var wp = middleWrapper ? middleWrapper : innerWrapper;
	    wp.style.height = slidePositions[index + items] - slidePositions[index] + 'px';
	  }

	  function getPages() {
	    var rough = fixedWidth ? (fixedWidth + gutter) * slideCount / viewport : slideCount / items;
	    return Math.min(Math.ceil(rough), slideCount);
	  }
	  /*
	   * 1. update visible nav items list
	   * 2. add "hidden" attributes to previous visible nav items
	   * 3. remove "hidden" attrubutes to new visible nav items
	   */


	  function updateNavVisibility() {
	    if (!nav || navAsThumbnails) {
	      return;
	    }

	    if (pages !== pagesCached) {
	      var min = pagesCached,
	          max = pages,
	          fn = showElement;

	      if (pagesCached > pages) {
	        min = pages;
	        max = pagesCached;
	        fn = hideElement;
	      }

	      while (min < max) {
	        fn(navItems[min]);
	        min++;
	      } // cache pages


	      pagesCached = pages;
	    }
	  }

	  function info(e) {
	    return {
	      container: container,
	      slideItems: slideItems,
	      navContainer: navContainer,
	      navItems: navItems,
	      controlsContainer: controlsContainer,
	      hasControls: hasControls,
	      prevButton: prevButton,
	      nextButton: nextButton,
	      items: items,
	      slideBy: slideBy,
	      cloneCount: cloneCount,
	      slideCount: slideCount,
	      slideCountNew: slideCountNew,
	      index: index,
	      indexCached: indexCached,
	      displayIndex: getCurrentSlide(),
	      navCurrentIndex: navCurrentIndex,
	      navCurrentIndexCached: navCurrentIndexCached,
	      pages: pages,
	      pagesCached: pagesCached,
	      sheet: sheet,
	      isOn: isOn,
	      event: e || {}
	    };
	  }

	  return {
	    version: '2.9.4',
	    getInfo: info,
	    events: events,
	    goTo: goTo,
	    play: play,
	    pause: pause,
	    isOn: isOn,
	    updateSliderHeight: updateInnerWrapperHeight,
	    refresh: initSliderTransform,
	    destroy: destroy,
	    rebuild: function () {
	      return tns(extend(options, optionsElements));
	    }
	  };
	};

	var tns_1 = tinySlider.tns = tns;

	/**
	 * File skip-link-focus-fix.js.
	 *
	 * Helps with accessibility for keyboard only users.
	 *
	 * Learn more: https://git.io/vWdr2
	 */
	(function () {
	  var isIe = /(trident|msie)/i.test(navigator.userAgent);

	  if (isIe && document.getElementById && window.addEventListener) {
	    window.addEventListener('hashchange', function () {
	      var id = location.hash.substring(1),
	          element;

	      if (!/^[A-z0-9_-]+$/.test(id)) {
	        return;
	      }

	      element = document.getElementById(id);

	      if (element) {
	        if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
	          element.tabIndex = -1;
	        }

	        element.focus();
	      }
	    }, false);
	  }
	})();

	/*
	* Theme configuration
	*
	* @package Wordtrap
	* @since wordtrap 1.0.0
	*/

	/* easing */
	jQuery.extend(jQuery.easing, {
	  def: 'easeOutQuad',
	  swing: function (x, t, b, c, d) {
	    return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	  },
	  easeOutQuad: function (x, t, b, c, d) {
	    return -c * (t /= d) * (t - 2) + b;
	  },
	  easeInOutQuart: function (x, t, b, c, d) {
	    if ((t /= d / 2) < 1) return c / 2 * t * t * t * t + b;
	    return -c / 2 * ((t -= 2) * t * t * t - 2) + b;
	  },
	  easeOutQuint: function (x, t, b, c, d) {
	    return c * ((t = t / d - 1) * t * t * t * t + 1) + b;
	  }
	}); // Theme

	window.theme = {};

	(function (theme, $) {

	  theme = theme || {};
	  $.extend(theme, {
	    // Breackpoints
	    breakpoints_sm: parseInt(wordtrap_vars.breakpoints_sm),
	    breakpoints_md: parseInt(wordtrap_vars.breakpoints_md),
	    breakpoints_lg: parseInt(wordtrap_vars.breakpoints_lg),
	    breakpoints_xl: parseInt(wordtrap_vars.breakpoints_xl),
	    breakpoints_xxl: parseInt(wordtrap_vars.breakpoints_xxl),
	    // Sticky header
	    sticky_header_xs: parseInt(wordtrap_vars.sticky_header_xs),
	    sticky_header_sm: parseInt(wordtrap_vars.sticky_header_sm),
	    sticky_header_md: parseInt(wordtrap_vars.sticky_header_md),
	    sticky_header_lg: parseInt(wordtrap_vars.sticky_header_lg),
	    sticky_header_xl: parseInt(wordtrap_vars.sticky_header_xl),
	    sticky_header_xxl: parseInt(wordtrap_vars.sticky_header_xxl),
	    sticky_header_height: 0,
	    // Woocommerce
	    product_thumbnails_columns: parseInt(wordtrap_vars.product_thumbnails_columns),
	    // Messages
	    loading: wordtrap_vars.loading,
	    // Request timeout
	    requestTimeout: function (fn, delay) {
	      var handler = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame;

	      if (!handler) {
	        return setTimeout(fn, delay);
	      }

	      var start,
	          rt = new Object();

	      function loop(timestamp) {
	        if (!start) {
	          start = timestamp;
	        }

	        var progress = timestamp - start;
	        progress >= delay ? fn.call() : rt.val = handler(loop);
	      }
	      rt.val = handler(loop);
	      return rt;
	    },
	    // Delete timeout
	    deleteTimeout: function (timeoutID) {
	      if (!timeoutID) {
	        return;
	      }

	      var handler = window.cancelAnimationFrame || window.webkitCancelAnimationFrame || window.mozCancelAnimationFrame;

	      if (!handler) {
	        return clearTimeout(timeoutID);
	      }

	      if (timeoutID.val) {
	        return handler(timeoutID.val);
	      }
	    },
	    // Admin bar height
	    adminBarHeight: function () {
	      var obj = document.getElementById('wpadminbar');

	      if (obj && obj.offsetHeight && window.innerWidth > 600) {
	        return obj.offsetHeight;
	      }

	      return 0;
	    },
	    // Request frame
	    requestFrame: function (fn) {
	      var handler = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame;

	      if (!handler) {
	        return setTimeout(fn, 1000 / 60);
	      }

	      var rt = new Object();
	      rt.val = handler(fn);
	      return rt;
	    },
	    scrollToElement: function ($element, timeout) {
	      if ($element.length) {
	        $('html, body').stop().animate({
	          scrollTop: $element.offset().top - theme.adminBarHeight() - theme.sticky_header_height - parseInt($('#primary').css('margin-top')) || 0
	        }, timeout, 'easeOutQuad');
	      }
	    },
	    addLoading: function ($element) {
	      if ($element.length) {
	        $element.addClass('ajax-loading-container');
	        $element.append('<div class="ajax-loading"><div role="status"><span class="visually-hidden">' + theme.loading + '</span></div></div>');
	      }
	    },
	    removeLoading: function ($element) {
	      if ($element.length) {
	        $element.find('> .ajax-loading').remove();
	        $element.removeClass('ajax-loading-container');
	      }
	    }
	  });
	})(window.theme, jQuery);
	/* Smart Resize  */


	(function ($, theme, sr) {
	  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/

	  var debounce = function (func, threshold, execAsap) {
	    var timeout;
	    return function debounced() {
	      var obj = this,
	          args = arguments;

	      function delayed() {
	        if (!execAsap) func.apply(obj, args);
	        timeout = null;
	      }

	      if (timeout && timeout.val) theme.deleteTimeout(timeout);else if (execAsap) func.apply(obj, args);
	      timeout = theme.requestTimeout(delayed, threshold || 100);
	    };
	  }; // smartresize 


	  jQuery.fn[sr] = function (fn) {
	    return fn ? this.on('resize', debounce(fn)) : this.trigger(sr);
	  };
	})(jQuery, window.theme, 'smartresize');

	/*
	* Javascript for the header 
	*
	* @package Wordtrap
	* @since wordtrap 1.0.0
	*/
	// Fixed Header
	(function (theme, $) {

	  theme = theme || {};
	  var instanceName = '__fixed_header';

	  var FixedHeader = function ($el, opts) {
	    return this.initialize($el, opts);
	  };

	  FixedHeader.defaults = {};
	  FixedHeader.prototype = {
	    initialize: function ($el, opts) {
	      if ($el.data(instanceName)) {
	        return this;
	      }

	      this.$el = $el;
	      this.setData().setOptions(opts).build();
	      return this;
	    },
	    setData: function () {
	      this.$el.data(instanceName, this);
	      return this;
	    },
	    setOptions: function (opts) {
	      this.options = $.extend(true, {}, FixedHeader.defaults, opts);
	      return this;
	    },
	    build: function () {
	      var self = this;
	      self.resize();
	      $(window).smartresize(function () {
	        self.resize();
	      });
	      window.addEventListener('scroll', function () {
	        theme.requestFrame(function () {
	          self.scroll();
	        });
	      }, {
	        passive: true
	      });
	      return self;
	    },
	    resize: function () {
	      var $el = this.$el,
	          height = $el.outerHeight(),
	          html_margin = parseFloat($('html').css('margin-top'));
	      $el.css('top', html_margin);
	      $('body').css('padding-top', height);
	      theme.sticky_header_height = height;
	      this.scroll();
	    },
	    scroll: function () {
	      var $el = this.$el,
	          scroll_top = $(window).scrollTop();

	      if ($('#wpadminbar').length && $('#wpadminbar').css('position') == 'absolute') {
	        $el.stop().css('top', $('#wpadminbar').height() - scroll_top < 0 ? 0 : $('#wpadminbar').height() - scroll_top);
	      }
	    }
	  }; // expose to scope

	  $.extend(theme, {
	    FixedHeader: FixedHeader
	  }); // jquery plugin

	  $.fn.themeFixedHeader = function (opts) {
	    return this.map(function () {
	      var $this = $(this);

	      if ($this.data(instanceName)) {
	        return $this.data(instanceName);
	      }

	      return new theme.FixedHeader($this, opts);
	    });
	  };
	})(window.theme, jQuery); // Sticky Header


	(function (theme, $) {

	  theme = theme || {};
	  var instanceName = '__sticky_header';

	  var StickyHeader = function ($el, opts) {
	    return this.initialize($el, opts);
	  };

	  StickyHeader.defaults = {
	    breakpoints_sm: theme.breakpoints_sm,
	    breakpoints_md: theme.breakpoints_md,
	    breakpoints_lg: theme.breakpoints_lg,
	    breakpoints_xl: theme.breakpoints_xl,
	    breakpoints_xxl: theme.breakpoints_xxl,
	    sticky_header_xs: theme.sticky_header_xs,
	    sticky_header_sm: theme.sticky_header_sm,
	    sticky_header_md: theme.sticky_header_md,
	    sticky_header_lg: theme.sticky_header_lg,
	    sticky_header_xl: theme.sticky_header_xl,
	    sticky_header_xxl: theme.sticky_header_xxl
	  };
	  StickyHeader.prototype = {
	    initialize: function ($el, opts) {
	      if ($el.data(instanceName)) {
	        return this;
	      }

	      this.$el = $el;
	      this.header = this.$el.parent();
	      this.header_main = this.$el.find('#header-main');

	      if (!this.header.length || !this.header_main.length) {
	        return this;
	      }

	      this.setData().setOptions(opts).reset().build().events();
	      return this;
	    },
	    setData: function () {
	      this.$el.data(instanceName, this);
	      return this;
	    },
	    setOptions: function (opts) {
	      this.options = $.extend(true, {}, StickyHeader.defaults, opts);
	      return this;
	    },
	    checkVisivility: function () {
	      var win_width = window.innerWidth,
	          options = this.options;

	      if (win_width >= options.breakpoints_xxl && !options.sticky_header_xxl || win_width >= options.breakpoints_xl && win_width < options.breakpoints_xxl && !options.sticky_header_xl || win_width >= options.breakpoints_lg && win_width < options.breakpoints_xl && !options.sticky_header_lg || win_width >= options.breakpoints_md && win_width < options.breakpoints_lg && !options.sticky_header_md || win_width >= options.breakpoints_sm && win_width < options.breakpoints_md && !options.sticky_header_sm || win_width < options.breakpoints_sm && !options.sticky_header_xs) {
	        return false;
	      }

	      return true;
	    },
	    reset: function () {
	      var self = this,
	          $el = this.$el;
	      self.header.removeClass('sticky-header');
	      self.header.css('height', '');
	      $el.stop().css('top', 0);
	      self.is_sticky = false;
	      self.prev_scroll_pos = $(window).scrollTop();
	      self.header_height = self.header.height() + parseInt(self.header.css('margin-top'));
	      self.header_main_height = self.header_main.height();
	      self.sticky_height = self.header_main.outerHeight();
	      theme.sticky_header_height = self.sticky_height;

	      if (!self.checkVisivility()) {
	        self.sticky_height = 0;
	      }

	      self.sticky_pos = self.header.offset().top + self.header_height - self.sticky_height - theme.adminBarHeight() + parseInt(self.header.css('border-top-width'));
	      return self;
	    },
	    build: function () {
	      var self = this,
	          $el = this.$el,
	          $html = $('html');

	      if (!self.is_sticky && window.innerHeight + self.header_height + theme.adminBarHeight() + parseInt(self.header.css('border-top-width')) >= $(document).height()) {
	        return self;
	      }

	      if (window.innerHeight > $(document.body).height()) window.scrollTo(0, 0);
	      var scroll_top = $(window).scrollTop();
	      $html.addClass('sticky-header-active');

	      if (scroll_top > this.prev_scroll_pos) {
	        $html.addClass('scroll-down');
	      } else {
	        $html.removeClass('scroll-down');
	      }

	      this.prev_scroll_pos = scroll_top;

	      if ($('#wpadminbar').length && $('#wpadminbar').css('position') == 'absolute') {
	        self.header.parent().stop().css('top', $('#wpadminbar').height() - scroll_top < 0 ? -$('#wpadminbar').height() : -scroll_top);
	      }

	      if (scroll_top > self.sticky_pos && self.checkVisivility()) {
	        if (!self.header.hasClass('sticky-header')) {
	          var header_height = self.header.outerHeight();
	          self.header.addClass('sticky-header').css('height', header_height);
	          $el.stop().css('top', theme.adminBarHeight());
	          self.is_sticky = true;
	        }
	      } else {
	        if (self.header.hasClass('sticky-header')) {
	          self.header.removeClass('sticky-header');
	          self.header.css('height', '');
	          $el.stop().css('top', 0);
	          self.is_sticky = false;
	        }
	      }

	      return self;
	    },
	    events: function () {
	      var self = this,
	          win_width = 0;
	      $(window).smartresize(function () {
	        if (win_width != window.innerWidth) {
	          self.reset().build();
	          win_width = window.innerWidth;
	        }
	      });
	      window.addEventListener('scroll', function () {
	        theme.requestFrame(function () {
	          self.build();
	        });
	      }, {
	        passive: true
	      });
	    }
	  }; // expose to scope

	  $.extend(theme, {
	    StickyHeader: StickyHeader
	  }); // jquery plugin

	  $.fn.themeStickyHeader = function (opts) {
	    return this.map(function () {
	      var $this = $(this);

	      if ($this.data(instanceName)) {
	        return $this.data(instanceName);
	      }

	      return new theme.StickyHeader($this, opts);
	    });
	  };
	})(window.theme, jQuery);

	/*
	* Javascript for the footer 
	*
	* @package Wordtrap
	* @since wordtrap 1.0.0
	*/
	// Reveal Footer
	(function (theme, $) {

	  theme = theme || {};
	  var instanceName = '__reveal_footer';

	  var RevealFooter = function ($el, opts) {
	    return this.initialize($el, opts);
	  };

	  RevealFooter.defaults = {};
	  RevealFooter.prototype = {
	    initialize: function ($el, opts) {
	      if ($el.data(instanceName)) {
	        return this;
	      }

	      this.$el = $el;
	      this.setData().setOptions(opts).build();
	      return this;
	    },
	    setData: function () {
	      this.$el.data(instanceName, this);
	      return this;
	    },
	    setOptions: function (opts) {
	      this.options = $.extend(true, {}, RevealFooter.defaults, opts);
	      return this;
	    },
	    build: function () {
	      var self = this;
	      self.resize();
	      $(window).smartresize(function () {
	        self.resize();
	      });
	      return self;
	    },
	    resize: function () {
	      var $el = this.$el,
	          page = $el.find('#page'),
	          height = $el.find('#footer').height();
	      page.css('margin-bottom', height);
	    }
	  }; // expose to scope

	  $.extend(theme, {
	    RevealFooter: RevealFooter
	  }); // jquery plugin

	  $.fn.themeRevealFooter = function (opts) {
	    return this.map(function () {
	      var $this = $(this);

	      if ($this.data(instanceName)) {
	        return $this.data(instanceName);
	      }

	      return new theme.RevealFooter($this, opts);
	    });
	  };
	})(window.theme, jQuery);

	/*
	* Javascript for the scroll to top 
	*
	* @package Wordtrap
	* @since wordtrap 1.0.0
	*/
	// Scroll to Top
	(function (theme, $) {

	  theme = theme || {};
	  var instanceName = '__scroll_to_top';

	  var ScrollToTop = function ($el, opts) {
	    return this.initialize($el, opts);
	  };

	  ScrollToTop.defaults = {
	    icon: 'fa fa-chevron-up',
	    trigger: 300,
	    id: 'scroll-to-top',
	    activeClass: 'show',
	    offsetX: 15,
	    offsetY: 15,
	    transitionDuration: 300,
	    scrollDuration: 300
	  };
	  ScrollToTop.prototype = {
	    initialize: function ($el, opts) {
	      if ($el.data(instanceName)) {
	        return this;
	      }

	      this.$el = $el;
	      this.setData().setOptions(opts).build();
	      return this;
	    },
	    setData: function () {
	      this.$el.data(instanceName, this);
	      return this;
	    },
	    setOptions: function (opts) {
	      this.options = $.extend(true, {}, ScrollToTop.defaults, opts);
	      return this;
	    },
	    build: function () {
	      var self = this;
	      var btn = $('<div id="' + self.options.id + '"></div>');
	      btn.prepend('<i class="' + self.options.icon + '"></i>');
	      btn.addClass(self.options.class);
	      btn.css({
	        transitionDuration: self.options.transitionDuration + 'ms',
	        right: self.options.offsetX,
	        bottom: self.options.offsetY
	      });
	      $(window).on('scroll', function () {
	        if ($(window).scrollTop() > self.options.trigger) {
	          btn.addClass(self.options.activeClass);
	        } else {
	          btn.removeClass(self.options.activeClass);
	        }
	      });
	      btn.on('click', function (e) {
	        e.preventDefault();
	        $('html, body').stop().animate({
	          scrollTop: 0
	        }, self.options.scrollDuration, 'easeOutQuad');
	      });
	      self.$el.append(btn);
	      return self;
	    }
	  }; // expose to scope

	  $.extend(theme, {
	    ScrollToTop: ScrollToTop
	  }); // jquery plugin

	  $.fn.themeScrollToTop = function (opts) {
	    return this.map(function () {
	      var $this = $(this);

	      if ($this.data(instanceName)) {
	        return $this.data(instanceName);
	      }

	      return new theme.ScrollToTop($this, opts);
	    });
	  };
	})(window.theme, jQuery);

	/*
	* Javascript for whatsapp sharing 
	*
	* @package Wordtrap
	* @since wordtrap 1.0.0
	*/
	// Whatsapp Sharing
	(function (theme, $) {

	  theme = theme || {};
	  var instanceName = '__whatsapp_sharing';

	  var WhatsAppSharing = function ($el, opts) {
	    return this.initialize($el, opts);
	  };

	  WhatsAppSharing.defaults = {};
	  WhatsAppSharing.prototype = {
	    initialize: function ($el, opts) {
	      if ($el.data(instanceName)) {
	        return this;
	      }

	      this.$el = $el;
	      this.setData().setOptions(opts).build();
	      return this;
	    },
	    setData: function () {
	      this.$el.data(instanceName, this);
	      return this;
	    },
	    setOptions: function (opts) {
	      this.options = $.extend(true, {}, WhatsAppSharing.defaults, opts);
	      return this;
	    },
	    build: function () {
	      var self = this; // WhatsApp Sharing

	      if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
	        self.$el.find('.share-whatsapp').show();
	      }

	      $(document).ajaxComplete(function (event, xhr, options) {
	        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
	          self.$el.find('.share-whatsapp').show();
	        }
	      });
	      return self;
	    }
	  }; // expose to scope

	  $.extend(theme, {
	    WhatsAppSharing: WhatsAppSharing
	  }); // jquery plugin

	  $.fn.themeWhatsAppSharing = function (opts) {
	    return this.map(function () {
	      var $this = $(this);

	      if ($this.data(instanceName)) {
	        return $this.data(instanceName);
	      }

	      return new theme.WhatsAppSharing($this, opts);
	    });
	  };
	})(window.theme, jQuery);

	/*
	* Theme initialize
	*
	* @package Wordtrap
	* @since wordtrap 1.0.0
	*/
	function wordtrap_init($wrap) {
	  (function ($) {
	    if (!$wrap) {
	      $wrap = jQuery(document.body);
	    }

	    $wrap.trigger('wordtrap_init_start'); // Fixed header

	    if ($.fn.themeFixedHeader) {
	      $(function () {
	        $wrap.find('.header-fixed').each(function () {
	          var $this = $(this);
	          $this.themeFixedHeader($this.data('options'));
	        });
	      });
	    } // Sticky header


	    if ($.fn.themeStickyHeader) {
	      $(function () {
	        $wrap.find('.header-wrap:not(.header-fixed)').each(function () {
	          var $this = $(this);
	          $this.themeStickyHeader($this.data('options'));
	        });
	      });
	    } // Reveal Footer


	    if ($.fn.themeRevealFooter && $wrap.hasClass('page-footer-reveal')) {
	      $(function () {
	        $wrap.each(function () {
	          var $this = $(this);
	          $this.themeRevealFooter($this.data('options'));
	        });
	      });
	    } // Scroll to Top


	    if ($.fn.themeScrollToTop) {
	      $(function () {
	        $wrap.each(function () {
	          var $this = $(this);
	          $this.themeScrollToTop($this.data('options'));
	        });
	      });
	    } // WhatsApp sharing


	    if ($.fn.themeWhatsAppSharing) {
	      $(function () {
	        $wrap.each(function () {
	          var $this = $(this);
	          $this.themeWhatsAppSharing($this.data('options'));
	        });
	      });
	    } // Posts Filter


	    if ($.fn.themePostsFilter) {
	      $(function () {
	        $wrap.find('.posts-filter-nav').each(function () {
	          var $this = $(this);
	          $this.themePostsFilter($this.data('options'));
	        });
	      });
	    } // Posts Masonry View


	    if ($.fn.themeMasonry) {
	      $(function () {
	        $wrap.find('.posts-view-masonry:not(.posts-slider)').each(function () {
	          var $this = $(this),
	              options = $this.data('options');

	          if (!options) {
	            options = {};
	          }

	          options.itemSelector = '.post-wrap';
	          $this.themeMasonry(options);
	        });
	      });
	    } // Posts Slider


	    if ($.fn.themeSlider) {
	      $(function () {
	        $wrap.find('.posts-slider').each(function () {
	          var $this = $(this);
	          $this.themeSlider($this.data('options'));
	        });
	      });
	    } // Posts Ajax Load


	    if ($.fn.themePostsAjaxLoad) {
	      $(function () {
	        $wrap.find('.posts-pagination-ajax').each(function () {
	          var $this = $(this);
	          $this.themePostsAjaxLoad($this.data('options'));
	        });
	      });
	    }
	  })(jQuery);
	}

	(function (theme, $) {

	  $(window).on('load', function () {
	    theme.initialized = true;
	  });
	  $(function () {
	    wordtrap_init();
	  });
	})(window.theme, jQuery);

	/*
	* Javascript for woocommerce
	*
	* @package Wordtrap
	* @since wordtrap 1.0.0
	*/
	function wordtrap_woocommerce_init($wrap) {
	  (function ($) {
	    if (!$wrap) {
	      $wrap = jQuery(document.body);
	    }

	    $wrap.trigger('wordtrap_woocommerce_init_start'); // Quantity Input

	    if ($.fn.themeQuantityInput) {
	      $(function () {
	        $wrap.find('.quantity').each(function () {
	          var $this = $(this);
	          $this.themeQuantityInput($this.data('options'));
	        });
	      });
	    } // Product Image


	    if ($.fn.themeProductImage) {
	      $(function () {
	        $wrap.find('.woocommerce-product-gallery').each(function () {
	          var $this = $(this);
	          $this.themeProductImage({
	            items: $this.data('columns')
	          });
	        });
	      });
	    }
	  })(jQuery);
	}

	(function (theme, $) {

	  $(function () {
	    wordtrap_woocommerce_init();
	  });
	})(window.theme, jQuery);

	/*
	* Javascript for the posts filter navigation 
	*
	* @package Wordtrap
	* @since wordtrap 1.0.0
	*/

	(function (theme, $) {

	  theme = theme || {};
	  var instanceName = '__posts_filter';

	  var PostsFilter = function ($el, opts) {
	    return this.initialize($el, opts);
	  };

	  PostsFilter.defaults = {};
	  PostsFilter.prototype = {
	    initialize: function ($el, opts) {
	      if ($el.data(instanceName)) {
	        return this;
	      }

	      this.$el = $el;
	      this.setData().setOptions(opts).build();
	      return this;
	    },
	    setData: function () {
	      this.$el.data(instanceName, this);
	      return this;
	    },
	    setOptions: function (opts) {
	      this.options = $.extend(true, {}, PostsFilter.defaults, opts);
	      return this;
	    },
	    build: function () {
	      var self = this;
	      self.$el.find('select, input').on('change', function () {
	        self.$el.find('form').submit();
	      });
	      return self;
	    }
	  }; // expose to scope

	  $.extend(theme, {
	    PostsFilter: PostsFilter
	  }); // jquery plugin

	  $.fn.themePostsFilter = function (opts) {
	    return this.map(function () {
	      var $this = $(this);

	      if ($this.data(instanceName)) {
	        return $this.data(instanceName);
	      }

	      return new theme.PostsFilter($this, opts);
	    });
	  };
	})(window.theme, jQuery); // Posts Ajax Load


	(function (theme, $) {

	  theme = theme || {};
	  var instanceName = '__posts_ajax_load';

	  var PostsAjaxLoad = function ($el, opts) {
	    return this.initialize($el, opts);
	  };

	  PostsAjaxLoad.defaults = {};
	  PostsAjaxLoad.prototype = {
	    initialize: function ($el, opts) {
	      if ($el.data(instanceName)) {
	        return this;
	      }

	      this.$el = $el;
	      this.setData().setOptions(opts).build();
	      return this;
	    },
	    setData: function () {
	      this.$el.data(instanceName, this);
	      return this;
	    },
	    setOptions: function (opts) {
	      this.options = $.extend(true, {}, PostsAjaxLoad.defaults, opts);
	      return this;
	    },
	    build: function () {
	      var self = this,
	          $el = this.$el;
	      $el.find('a.page-link').on('click', function (e) {
	        e.preventDefault();
	        var $this = $(this),
	            $main = $('#main');
	        theme.addLoading($el);
	        theme.scrollToElement($el);
	        $.ajax({
	          url: $this.attr('href'),
	          complete: function (data) {
	            var $response = $(data.responseText);
	            theme.removeLoading($el);
	            $main.html($response.find('#main').html());
	            wordtrap_init($main);
	            wordtrap_woocommerce_init($main);
	          }
	        });
	      });
	      return self;
	    }
	  }; // expose to scope

	  $.extend(theme, {
	    PostsAjaxLoad: PostsAjaxLoad
	  }); // jquery plugin

	  $.fn.themePostsAjaxLoad = function (opts) {
	    return this.map(function () {
	      var $this = $(this);

	      if ($this.data(instanceName)) {
	        return $this.data(instanceName);
	      }

	      return new theme.PostsAjaxLoad($this, opts);
	    });
	  };
	})(window.theme, jQuery);

	/*
	* Javascript for the masonry layout
	*
	* @package Wordtrap
	* @since wordtrap 1.0.0
	*/
	// Masonry
	(function (theme, $) {

	  theme = theme || {};
	  var instanceName = '__masonry';

	  var Masonry = function ($el, opts) {
	    return this.initialize($el, opts);
	  };

	  Masonry.defaults = {
	    itemSelector: 'li'
	  };
	  Masonry.prototype = {
	    initialize: function ($el, opts) {
	      if ($el.data(instanceName)) {
	        return this;
	      }

	      this.$el = $el;
	      this.setData().setOptions(opts).build();
	      return this;
	    },
	    setData: function () {
	      this.$el.data(instanceName, this);
	      return this;
	    },
	    setOptions: function (opts) {
	      this.options = $.extend(true, {}, Masonry.defaults, opts);
	      return this;
	    },
	    build: function () {
	      if (!$.fn.masonry) {
	        return this;
	      }

	      var $el = this.$el;
	      $el.masonry(this.options);
	      $el.masonry('on', 'layoutComplete', function () {
	        if (typeof this.options.callback == 'function') {
	          this.options.callback.call();
	        }
	      });
	      $el.masonry('layout');
	      return this;
	    }
	  }; // expose to scope

	  $.extend(theme, {
	    Masonry: Masonry
	  }); // jquery plugin

	  $.fn.themeMasonry = function (opts) {
	    return this.map(function () {
	      var $this = $(this);

	      if ($this.data(instanceName)) {
	        return $this.data(instanceName);
	      } else {
	        return new theme.Masonry($this, opts);
	      }
	    });
	  };
	})(window.theme, jQuery);

	/*
	* Javascript for the slider
	*
	* @package Wordtrap
	* @since wordtrap 1.0.0
	*/

	(function (theme, $) {

	  theme = theme || {};
	  var instanceName = '__slider';

	  var Slider = function ($el, opts) {
	    return this.initialize($el, opts);
	  }; // https://github.com/ganlanyuan/tiny-slider#options


	  Slider.defaults = $.extend({}, {
	    container: '.slider',
	    containerClass: '',
	    mode: 'carousel',
	    axis: 'horizontal',
	    items: 1,
	    gutter: 0,
	    edgePadding: 0,
	    fixedWidth: false,
	    autoWidth: false,
	    viewportMax: false,
	    slideBy: '1',
	    center: false,
	    controls: true,
	    controlsPosition: 'top',
	    controlsText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
	    controlsContainer: false,
	    prevButton: false,
	    nextButton: false,
	    nav: true,
	    navPosition: 'bottom',
	    navContainer: false,
	    navAsThumbnails: false,
	    arrowKeys: false,
	    speed: 300,
	    autoplay: false,
	    autoplayPosition: 'top',
	    autoplayTimeout: 5000,
	    autoplayDirection: 'forward',
	    autoplayText: ['<i class="fa fa-play"></i>', '<i class="fa fa-stop"></i>'],
	    autoplayHoverPause: false,
	    autoplayButton: false,
	    autoplayButtonOutput: false,
	    autoplayResetOnVisibility: true,
	    animateIn: 'tns-fadeIn',
	    animateOut: 'tns-fadeOut',
	    animateNormal: 'tns-normal',
	    animateDelay: false,
	    loop: true,
	    rewind: false,
	    autoHeight: false,
	    autoInnerHeight: false,
	    responsive: false,
	    lazyload: false,
	    lazyloadSelector: '.tns-lazy-img',
	    touch: true,
	    mouseDrag: false,
	    swipeAngle: 15,
	    preventActionWhenRunning: false,
	    preventScrollOnTouch: false,
	    nested: false,
	    freezable: true,
	    disable: false,
	    startIndex: 0,
	    onInit: false,
	    useLocalStorage: false,
	    nonce: false
	  });
	  Slider.prototype = {
	    initialize: function ($el, opts) {
	      if ($el.data(instanceName)) {
	        return this;
	      }

	      this.$el = $el;
	      this.slider = false;
	      this.setData().setOptions(opts).build();
	      return this;
	    },
	    setData: function () {
	      this.$el.data(instanceName, true);
	      return this;
	    },
	    setOptions: function (opts) {
	      this.options = $.extend(true, {}, Slider.defaults, opts);

	      if (this.options.axis === 'vertical') {
	        this.options.controlsText = ['<i class="fa fa-chevron-up"></i>', '<i class="fa fa-chevron-down"></i>'];
	      }

	      return this;
	    },
	    build: function () {
	      if (!tns_1) {
	        return this;
	      }

	      var self = this,
	          $el = self.$el,
	          options = self.options,
	          sm = options.sm,
	          md = options.md,
	          lg = options.lg,
	          xl = options.xl,
	          xxl = options.xxl;
	      options.container = $el.get(0);
	      $(options.container).parent().addClass(this.options.containerClass);

	      if ((sm || md || lg || xl || xxl) && !options.responsive) {
	        options.responsive = {};
	      }

	      if (sm) options.responsive[theme.breakpoints_sm] = sm;
	      if (md) options.responsive[theme.breakpoints_md] = md;
	      if (lg) options.responsive[theme.breakpoints_lg] = lg;
	      if (xl) options.responsive[theme.breakpoints_xl] = xl;
	      if (xxl) options.responsive[theme.breakpoints_xxl] = xxl;

	      if (options.autoHeight && options.autoInnerHeight) {
	        options.onInit = self.calcHeight;
	      }

	      var slider = tns_1(options);

	      if (options.autoHeight && options.autoInnerHeight) {
	        if (options.mode == 'gallery') {
	          slider.events.on('indexChanged', self.initHeight);
	          slider.events.on('indexChanged', self.calcHeight);
	        } else {
	          slider.events.on('indexChanged', self.initHeight);
	          slider.events.on('transitionStart', self.initHeight);
	          slider.events.on('transitionEnd', self.calcHeight);
	        }

	        $(window).smartresize(function () {
	          slider.goTo('next');
	        });
	      }

	      this.slider = slider;
	      return this;
	    },
	    initHeight: function (info, eventName) {
	      var slider_id = info.container.id,
	          $outer = $('#' + slider_id + '-ow');
	      $outer.find('.tns-item').stop().css({
	        height: 'auto'
	      });
	    },
	    calcHeight: function (info, eventName) {
	      var slider_id = info.container.id,
	          $middle = $('#' + slider_id + '-mw'),
	          $inner = $('#' + slider_id + '-iw');
	      setTimeout(function () {
	        if ($middle.length) {
	          $middle.find('.tns-item.tns-slide-active').stop().css({
	            height: $middle.height()
	          });
	        } else if ($inner.length) {
	          $inner.find('.tns-item.tns-slide-active').stop().css({
	            height: $inner.height()
	          });
	        }
	      }, 0);
	    },
	    goTo: function (index) {
	      this.slider.goTo(index);
	      return this;
	    }
	  }; // expose to scope

	  $.extend(theme, {
	    Slider: Slider
	  }); // jquery plugin

	  $.fn.themeSlider = function (opts) {
	    return this.map(function () {
	      var $this = $(this);

	      if ($this.data(instanceName)) {
	        return $this;
	      } else {
	        return new theme.Slider($this, opts);
	      }
	    });
	  };
	})(window.theme, jQuery);

	/*
	* Javascript for the quantity input 
	*
	* @package Wordtrap
	* @since wordtrap 1.0.0
	*/
	// Quantity input
	(function (theme, $) {

	  theme = theme || {};
	  var instanceName = '__quantity';

	  var QuantityInput = function ($el, opts) {
	    return this.initialize($el, opts);
	  };

	  QuantityInput.defaults = {
	    min: 0,
	    step: 1
	  };
	  QuantityInput.prototype = {
	    initialize: function ($el, opts) {
	      if ($el.data(instanceName)) {
	        return this;
	      }

	      this.$el = $el;
	      this.setData().setOptions(opts).build();
	      return this;
	    },
	    setData: function () {
	      this.$el.data(instanceName, this);
	      return this;
	    },
	    setOptions: function (opts) {
	      var $el = this.$el,
	          $input = $el.find('[type="number"]'),
	          input_options = {};
	      if ($input.attr('min')) input_options.min = $input.attr('min');
	      if ($input.attr('max')) input_options.max = $input.attr('max');
	      if ($input.attr('step')) input_options.step = $input.attr('step');
	      this.options = $.extend(true, {}, QuantityInput.defaults, input_options, opts);
	      return this;
	    },
	    build: function () {
	      var self = this,
	          $el = self.$el,
	          $input = $el.find('[type="number"]');
	      if (!$input.length) return;
	      $el.find('.minus').on('click', function () {
	        var changed = ($input.val() ? parseFloat($input.val()) : 0) - parseFloat(self.options.step);

	        if (typeof self.options.min != 'undefined' && changed < self.options.min) {
	          return;
	        }

	        $input.val(changed);
	      });
	      $el.find('.plus').on('click', function () {
	        var changed = ($input.val() ? parseFloat($input.val()) : 0) + parseFloat(self.options.step);

	        if (typeof self.options.max != 'undefined' && changed > self.options.max) {
	          return;
	        }

	        $input.val(changed);
	      });
	      return this;
	    }
	  }; // expose to scope

	  $.extend(theme, {
	    QuantityInput: QuantityInput
	  }); // jquery plugin

	  $.fn.themeQuantityInput = function (opts) {
	    return this.map(function () {
	      var $this = $(this);

	      if ($this.data(instanceName)) {
	        return $this.data(instanceName);
	      } else {
	        return new theme.QuantityInput($this, opts);
	      }
	    });
	  };
	})(window.theme, jQuery);

	/*
	* Javascript for the single product
	*
	* @package Wordtrap
	* @since wordtrap 1.0.0
	*/
	// Product Image
	(function (theme, $) {

	  theme = theme || {};
	  var instanceName = '__product_image';

	  var ProductImage = function ($el, opts) {
	    return this.initialize($el, opts);
	  };

	  ProductImage.defaults = {
	    items: 4
	  };
	  ProductImage.prototype = {
	    initialize: function ($el, opts) {
	      if ($el.data(instanceName)) {
	        return this;
	      }

	      this.$el = $el;
	      this.setData().setOptions(opts).build();
	      return this;
	    },
	    setData: function () {
	      this.$el.data(instanceName, this);
	      return this;
	    },
	    setOptions: function (opts) {
	      this.options = $.extend(true, {}, ProductImage.defaults, opts);
	      return this;
	    },
	    build: function () {
	      var self = this,
	          $el = self.$el,
	          $product = $el.closest('.product'),
	          $variation_form = $product.find('.variations_form'),
	          carousel;

	      if ($.fn.themeSlider) {
	        // Product thumbs carousel
	        if ($product.hasClass('product-thumbs-carousel')) {
	          carousel = $el.find('.flex-control-thumbs').themeSlider($.extend({
	            items: self.options.items,
	            gutter: 10,
	            nav: false,
	            loop: false
	          }, $product.data('carousel-options')));
	        } // Product view: Extended


	        if ($product.hasClass('product-view-extended')) {
	          carousel = $el.find('.woocommerce-product-gallery__wrapper').themeSlider($.extend({
	            containerClass: 'show-nav-center',
	            center: $el.find('.woocommerce-product-gallery__image').length === 1 ? true : false,
	            nav: false,
	            loop: false
	          }, $product.data('slider-options')));
	        }
	      }

	      self.initProductImages(); // Sticky info

	      if ($product.hasClass('product-sticky-info')) {
	        $product.find('.summary').css('top', theme.adminBarHeight() + theme.sticky_header_height + 15);
	        $(window).smartresize(function () {
	          $product.find('.summary').css('top', theme.adminBarHeight() + theme.sticky_header_height + 15);
	        });
	      }

	      var slider = $el.data('flexslider');

	      if (slider) {
	        $el.find('.flex-control-nav li').eq(0).addClass('active');

	        slider.vars.before = function (slider) {
	          $el.find('.flex-control-nav li').removeClass('active');
	          $el.find('.flex-control-nav li').eq(slider.animatingTo).addClass('active');
	        };
	      }

	      $variation_form.on('update_variation_values', function () {
	        setTimeout(function () {
	          if (carousel) {
	            if (slider) {
	              carousel.get(0).goTo(slider.currentSlide);
	            } else {
	              carousel.get(0).goTo(0);
	            }
	          }

	          self.initProductImages();
	        }, 200);
	      });
	      return this;
	    },
	    initProductImages: function () {
	      var $el = this.$el,
	          $product = $el.closest('.product'),
	          zoom_options = this.zoomOptions();

	      if (!($product.hasClass('product-view-extended') || $product.hasClass('product-thumbnails-grid')) || !zoom_options) {
	        return;
	      }

	      $el.find('.woocommerce-product-gallery__image').each(function () {
	        var $this = $(this),
	            galleryWidth = $this.width(),
	            image = $this.find('img');
	        $this.trigger('zoom.destroy');

	        if (image.data('large_image_width') > galleryWidth) {
	          $this.zoom(zoom_options);
	        }
	      });
	    },
	    zoomOptions: function () {
	      if ('function' === typeof $.fn.zoom && wc_single_product_params.zoom_enabled) {
	        var zoom_options = $.extend({
	          touch: false
	        }, wc_single_product_params.zoom_options);

	        if ('ontouchstart' in document.documentElement) {
	          zoom_options.on = 'click';
	        }

	        return zoom_options;
	      }

	      return false;
	    }
	  }; // expose to scope

	  $.extend(theme, {
	    ProductImage: ProductImage
	  }); // jquery plugin

	  $.fn.themeProductImage = function (opts) {
	    return this.map(function () {
	      var $this = $(this);

	      if ($this.data(instanceName)) {
	        return $this.data(instanceName);
	      } else {
	        return new theme.ProductImage($this, opts);
	      }
	    });
	  };
	})(window.theme, jQuery);

	/*
	* Javascript for events
	*
	* @package Wordtrap
	* @since wordtrap 1.0.0
	*/

	function wordtrap_woocommerce_events() {
	  (function ($) {
	    // Add view cart on thumbnail
	    $(document.body).on('added_to_cart', function (e, fragments, cart_hash, $button) {
	      var $view_cart_button = $button.parent().find('.added_to_cart');

	      if (!wc_add_to_cart_params.is_cart && $view_cart_button.length) {
	        var $cart_modal = $('#modal-cart-notification'),
	            $cart_toast = $('#toast-cart-notification'),
	            $product = $button.closest('.product'),
	            $product_thumbnail = $product.find('.product-thumbnail');

	        if ($cart_modal.length) {
	          var modal = new Modal($cart_modal.get(0)),
	              $cart_link = $cart_modal.find('.cart-link'),
	              $thumbail = $cart_modal.find('.product-thumbnail');
	          $cart_modal.find('.product-title').html($product.find('.woocommerce-loop-product__title').html());
	          $thumbail.html('');
	          $thumbail.append($product_thumbnail.find('img').clone().get(0));
	          $view_cart_button.addClass('btn btn-primary').removeClass('added_to_cart');
	          $cart_link.html('');
	          $cart_link.append($view_cart_button);
	          modal.show();
	          setTimeout(function () {
	            modal.hide();
	          }, 4000);
	          return;
	        }

	        if ($cart_toast.length) {
	          var $toast = $cart_toast.clone(),
	              $cart_link = $toast.find('.cart-link'),
	              $thumbail = $toast.find('.product-thumbnail');
	          $toast.removeAttr('id');
	          $toast.find('.product-title').html($product.find('.woocommerce-loop-product__title').html());
	          $thumbail.html('');
	          $thumbail.append($product_thumbnail.find('img').clone().get(0));
	          $view_cart_button.addClass('btn btn-primary btn-sm').removeClass('added_to_cart');
	          $cart_link.html('');
	          $cart_link.append($view_cart_button);
	          $('.toast-cart-notification-wrap').append($toast);
	          var toast = new Toast($toast.get(0));
	          toast.show();
	          return;
	        }

	        if ($button.closest('.product-thumbnail').length) {
	          return;
	        }

	        if ($product_thumbnail.length) {
	          if ($product_thumbnail.find('.added_to_cart').length === 0) {
	            $product_thumbnail.append($view_cart_button);
	          } else {
	            $view_cart_button.remove();
	          }
	        }
	      }
	    }); // Add quantity input

	    $(document.body).on('should_send_ajax_request.adding_to_cart', function (e, $button) {
	      var $quantity = $button.prev();

	      if ($quantity.length && $quantity.hasClass('quantity')) {
	        var $qty = $quantity.find('.qty');

	        if (!$qty.length) {
	          return false;
	        }

	        $button.attr('data-quantity', $qty.val());
	      }

	      return true;
	    });
	  })(jQuery);
	}

	(function (theme, $) {

	  $(function () {
	    wordtrap_woocommerce_events();
	  });
	})(window.theme, jQuery);

	exports.Alert = alert;
	exports.Button = button;
	exports.Carousel = carousel;
	exports.Collapse = collapse;
	exports.Dropdown = dropdown;
	exports.Modal = Modal;
	exports.Offcanvas = offcanvas;
	exports.Popover = popover;
	exports.Scrollspy = scrollspy;
	exports.Tab = tab;
	exports.Toast = Toast;
	exports.Tooltip = tooltip;
	exports.tns = tns_1;

	Object.defineProperty(exports, '__esModule', { value: true });

}));
//# sourceMappingURL=theme.js.map
