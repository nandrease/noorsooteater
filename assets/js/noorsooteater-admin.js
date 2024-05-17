/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ 222:
/***/ ((__unused_webpack_module, exports) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.ActionLinks = void 0;
const ActionLinks = ({
  image,
  alt,
  title,
  message,
  button,
  link
}) => {
  return /*#__PURE__*/React.createElement("div", {
    className: "noorsooteater__action_links"
  }, /*#__PURE__*/React.createElement("img", {
    src: image,
    alt: alt
  }), /*#__PURE__*/React.createElement("p", {
    className: "noorsooteater__action_links__title"
  }, title), /*#__PURE__*/React.createElement("p", {
    className: "noorsooteater__action_links__message"
  }, message), /*#__PURE__*/React.createElement("a", {
    className: "components-button is-secondary",
    href: link,
    target: "_blank",
    rel: "noreferrer"
  }, button));
};
exports.ActionLinks = ActionLinks;

/***/ }),

/***/ 3:
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


var _interopRequireDefault = __webpack_require__(836);
Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.SettingsPage = void 0;
var _react = __webpack_require__(196);
var _notices = __webpack_require__(961);
var _data = __webpack_require__(818);
var _i18n = __webpack_require__(736);
var _api = _interopRequireDefault(__webpack_require__(101));
var _components = __webpack_require__(609);
var _settingsPanel = __webpack_require__(230);
var _actionLinksPanel = __webpack_require__(995);
const Notices = () => {
  const notices = (0, _data.useSelect)(select => select(_notices.store).getNotices().filter(notice => 'snackbar' === notice.type), []);
  const {
    removeNotice
  } = (0, _data.useDispatch)(_notices.store);
  return /*#__PURE__*/React.createElement(_components.SnackbarList, {
    className: "edit-site-notices",
    notices: notices,
    onRemove: removeNotice
  });
};
const SETTINGS = {
  DESCRIPTION_META_TAG: '_description_meta_tag',
  SKIP_LINK: '_skip_link',
  HEADER_FOOTER: '_header_footer',
  PAGE_TITLE: '_page_title',
  NOORSOOTEATER_STYLE: '_noorsooteater_style',
  NOORSOOTEATER_THEME: '_noorsooteater_theme'
};
const SettingsPage = () => {
  const [hasLoaded, setHasLoaded] = (0, _react.useState)(false);
  const [settingsData, setSettingsData] = (0, _react.useState)({});
  const settingsPrefix = 'noorsooteater_settings';

  /**
   * Update settings data.
   *
   * @param {string} settingsName
   * @param {string} settingsValue
   */
  const updateSettings = (settingsName, settingsValue) => {
    setSettingsData({
      ...settingsData,
      [settingsName]: settingsValue
    });
  };

  /**
   * Save settings to server.
   */
  const saveSettings = () => {
    const data = {};
    Object.values(SETTINGS).forEach(value => data[`${settingsPrefix}${value}`] = settingsData[value] ? 'true' : '');
    const settings = new _api.default.models.Settings(data);
    settings.save();
    (0, _data.dispatch)('core/notices').createNotice('success', (0, _i18n.__)('Settings Saved', 'noorsooteater'), {
      type: 'snackbar',
      isDismissible: true
    });
  };
  (0, _react.useEffect)(() => {
    const fetchSettings = async () => {
      try {
        await _api.default.loadPromise;
        const settings = new _api.default.models.Settings();
        const response = await settings.fetch();
        const data = {};
        Object.values(SETTINGS).forEach(value => data[value] = response[`${settingsPrefix}${value}`]);
        setSettingsData(data);
        setHasLoaded(true);
      } catch (error) {
        // eslint-disable-next-line no-console
        console.error(error);
      }
    };
    if (hasLoaded) {
      return;
    }
    fetchSettings();
  }, [settingsData]);
  if (!hasLoaded) {
    return /*#__PURE__*/React.createElement(_components.Placeholder, null, /*#__PURE__*/React.createElement(_components.Spinner, null));
  }
  return /*#__PURE__*/React.createElement(_react.Fragment, null, /*#__PURE__*/React.createElement("div", {
    className: "noorsooteater__header"
  }, /*#__PURE__*/React.createElement("div", {
    className: "noorsooteater__container"
  }, /*#__PURE__*/React.createElement("div", {
    className: "noorsooteater__title"
  }, /*#__PURE__*/React.createElement("h1", null, (0, _i18n.__)('Noorsooteater Theme Settings', 'noorsooteater'))))), /*#__PURE__*/React.createElement("div", {
    className: "noorsooteater__main"
  }, /*#__PURE__*/React.createElement(_components.Panel, null, /*#__PURE__*/React.createElement(_settingsPanel.SettingsPanel, {
    SETTINGS,
    settingsData,
    updateSettings
  }), /*#__PURE__*/React.createElement(_components.Button, {
    isPrimary: true,
    onClick: saveSettings
  }, (0, _i18n.__)('Save Settings', 'noorsooteater'))), /*#__PURE__*/React.createElement(_actionLinksPanel.ActionLinksPanel, null)), /*#__PURE__*/React.createElement("div", {
    className: "noorsooteater__notices"
  }, /*#__PURE__*/React.createElement(Notices, null)));
};
exports.SettingsPage = SettingsPage;

/***/ }),

/***/ 995:
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.ActionLinksPanel = void 0;
var _i18n = __webpack_require__(736);
var _actionLinks = __webpack_require__(222);
const actionLinks = {
  'install-elementor': {
    image: noorsooteaterAdminData.templateDirectoryURI + '/assets/images/elementor.svg',
    alt: (0, _i18n.__)('Elementor', 'noorsooteater'),
    title: (0, _i18n.__)('Install Elementor', 'noorsooteater'),
    message: (0, _i18n.__)('Create cross-site header & footer using Elementor.', 'noorsooteater'),
    button: (0, _i18n.__)('Install Elementor', 'noorsooteater'),
    link: noorsooteaterAdminData.actionLinkURL
  },
  'activate-elementor': {
    image: noorsooteaterAdminData.templateDirectoryURI + '/assets/images/elementor.svg',
    alt: (0, _i18n.__)('Elementor', 'noorsooteater'),
    title: (0, _i18n.__)('Activate Elementor', 'noorsooteater'),
    message: (0, _i18n.__)('Create cross-site header & footer using Elementor.', 'noorsooteater'),
    button: (0, _i18n.__)('Activate Elementor', 'noorsooteater'),
    link: noorsooteaterAdminData.actionLinkURL
  },
  'activate-header-footer-experiment': {
    image: noorsooteaterAdminData.templateDirectoryURI + '/assets/images/elementor.svg',
    alt: (0, _i18n.__)('Elementor', 'noorsooteater'),
    title: (0, _i18n.__)('Style using Elementor', 'noorsooteater'),
    message: (0, _i18n.__)('Design your cross-site header & footer from Elementor’s "Site Settings" panel.', 'noorsooteater'),
    button: (0, _i18n.__)('Activate header & footer experiment', 'noorsooteater'),
    link: noorsooteaterAdminData.actionLinkURL
  },
  'style-header-footer': {
    image: noorsooteaterAdminData.templateDirectoryURI + '/assets/images/elementor.svg',
    alt: (0, _i18n.__)('Elementor', 'noorsooteater'),
    title: (0, _i18n.__)('Style cross-site header & footer', 'noorsooteater'),
    message: (0, _i18n.__)('Customize your cross-site header & footer from Elementor’s "Site Settings" panel.', 'noorsooteater'),
    button: (0, _i18n.__)('Start Designing', 'noorsooteater'),
    link: noorsooteaterAdminData.actionLinkURL
  }
};
const ActionLinksPanel = () => {
  if (!noorsooteaterAdminData.actionLinkType) {
    return;
  }
  return /*#__PURE__*/React.createElement(_actionLinks.ActionLinks, actionLinks[noorsooteaterAdminData.actionLinkType]);
};
exports.ActionLinksPanel = ActionLinksPanel;

/***/ }),

/***/ 230:
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

"use strict";


Object.defineProperty(exports, "__esModule", ({
  value: true
}));
exports.SettingsPanel = void 0;
var _i18n = __webpack_require__(736);
var _components = __webpack_require__(609);
const SettingsPanel = ({
  SETTINGS,
  settingsData,
  updateSettings
}) => {
  const protocol = window.location.protocol || 'https:';
  const hostname = window.location.hostname || 'example.com';
  const prefix = protocol + '//' + hostname;
  return /*#__PURE__*/React.createElement(_components.PanelBody, {
    title: (0, _i18n.__)('Noorsooteater Theme Settings', 'noorsooteater')
  }, /*#__PURE__*/React.createElement(_components.Notice, {
    status: "warning",
    isDismissible: "false"
  }, /*#__PURE__*/React.createElement(_components.Dashicon, {
    icon: "flag"
  }), (0, _i18n.__)('Be cautious, disabling some of the following options may break your website.', 'noorsooteater')), /*#__PURE__*/React.createElement(_components.ToggleControl, {
    label: (0, _i18n.__)('Disable description meta tag', 'noorsooteater'),
    help: (0, _i18n.__)('Remove the description meta tag in singular content pages that contain an excerpt.', 'noorsooteater'),
    checked: !!settingsData[SETTINGS.DESCRIPTION_META_TAG] || false,
    onChange: value => updateSettings(SETTINGS.DESCRIPTION_META_TAG, value)
  }), /*#__PURE__*/React.createElement("code", {
    className: "code-example"
  }, " <meta name=\"description\" content=\"...\" /> "), /*#__PURE__*/React.createElement(_components.ToggleControl, {
    label: (0, _i18n.__)('Disable skip link', 'noorsooteater'),
    help: (0, _i18n.__)('Remove the "Skip to content" link used by screen-readers and users navigating with a keyboard.', 'noorsooteater'),
    checked: !!settingsData[SETTINGS.SKIP_LINK] || false,
    onChange: value => updateSettings(SETTINGS.SKIP_LINK, value)
  }), /*#__PURE__*/React.createElement("code", {
    className: "code-example"
  }, " <a class=\"skip-link screen-reader-text\" href=\"#content\"> Skip to content </a> "), /*#__PURE__*/React.createElement(_components.ToggleControl, {
    label: (0, _i18n.__)('Disable cross-site header & footer', 'noorsooteater'),
    help: (0, _i18n.__)('Remove the header & footer sections from all pages, and their CSS/JS files.', 'noorsooteater'),
    checked: !!settingsData[SETTINGS.HEADER_FOOTER] || false,
    onChange: value => updateSettings(SETTINGS.HEADER_FOOTER, value)
  }), /*#__PURE__*/React.createElement("code", {
    className: "code-example"
  }, " <header id=\"site-header\" class=\"site-header\"> ... </header> "), /*#__PURE__*/React.createElement("code", {
    className: "code-example"
  }, " <footer id=\"site-footer\" class=\"site-footer\"> ... </footer> "), /*#__PURE__*/React.createElement(_components.ToggleControl, {
    label: (0, _i18n.__)('Disable page title', 'noorsooteater'),
    help: (0, _i18n.__)('Remove the section above the content that contains the main heading of the page.', 'noorsooteater'),
    checked: !!settingsData[SETTINGS.PAGE_TITLE] || false,
    onChange: value => updateSettings(SETTINGS.PAGE_TITLE, value)
  }), /*#__PURE__*/React.createElement("code", {
    className: "code-example"
  }, " <header class=\"page-header\"> <h1 class=\"entry-title\"> Post title </h1> </header> "), /*#__PURE__*/React.createElement(_components.ToggleControl, {
    label: (0, _i18n.__)('Unregister Norsooteater style.css', 'noorsooteater'),
    help: (0, _i18n.__)("Disable Norsooteater theme's style.css file which contains CSS reset rules for unified cross-browser view.", 'noorsooteater'),
    checked: !!settingsData[SETTINGS.NOORSOOTEATER_STYLE] || false,
    onChange: value => updateSettings(SETTINGS.NOORSOOTEATER_STYLE, value)
  }), /*#__PURE__*/React.createElement("code", {
    className: "code-example"
  }, " <link rel=\"stylesheet\" href=\"", prefix, "/wp-content/themes/noorsooteater/style.min.css\" /> "), /*#__PURE__*/React.createElement(_components.ToggleControl, {
    label: (0, _i18n.__)('Unregister Norsooteater theme.css', 'noorsooteater'),
    help: (0, _i18n.__)("Disable Norsooteater theme's theme.css file which contains CSS rules that style WordPress elements.", 'noorsooteater'),
    checked: !!settingsData[SETTINGS.NOORSOOTEATER_THEME] || false,
    onChange: value => updateSettings(SETTINGS.NOORSOOTEATER_THEME, value)
  }), /*#__PURE__*/React.createElement("code", {
    className: "code-example"
  }, " <link rel=\"stylesheet\" href=\"", prefix, "/wp-content/themes/noorsooteater/theme.min.css\" /> "));
};
exports.SettingsPanel = SettingsPanel;

/***/ }),

/***/ 100:
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ 196:
/***/ ((module) => {

"use strict";
module.exports = window["React"];

/***/ }),

/***/ 101:
/***/ ((module) => {

"use strict";
module.exports = window["wp"]["api"];

/***/ }),

/***/ 609:
/***/ ((module) => {

"use strict";
module.exports = window["wp"]["components"];

/***/ }),

/***/ 818:
/***/ ((module) => {

"use strict";
module.exports = window["wp"]["data"];

/***/ }),

/***/ 307:
/***/ ((module) => {

"use strict";
module.exports = window["wp"]["element"];

/***/ }),

/***/ 736:
/***/ ((module) => {

"use strict";
module.exports = window["wp"]["i18n"];

/***/ }),

/***/ 961:
/***/ ((module) => {

"use strict";
module.exports = window["wp"]["notices"];

/***/ }),

/***/ 836:
/***/ ((module) => {

function _interopRequireDefault(obj) {
  return obj && obj.__esModule ? obj : {
    "default": obj
  };
}
module.exports = _interopRequireDefault, module.exports.__esModule = true, module.exports["default"] = module.exports;

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";


__webpack_require__(100);
var _element = __webpack_require__(307);
var _settingsPage = __webpack_require__(3);
const App = () => {
  return /*#__PURE__*/React.createElement(_settingsPage.SettingsPage, null);
};
document.addEventListener('DOMContentLoaded', () => {
  const rootElement = document.getElementById('noorsooteater-settings');
  if (rootElement) {
    (0, _element.render)( /*#__PURE__*/React.createElement(App, null), rootElement);
  }
});
})();

/******/ })()
;