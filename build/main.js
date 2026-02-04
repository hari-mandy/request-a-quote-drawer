/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/main.scss"
/*!***********************!*\
  !*** ./src/main.scss ***!
  \***********************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }

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
/******/ 		// Check if module exists (development only)
/******/ 		if (__webpack_modules__[moduleId] === undefined) {
/******/ 			var e = new Error("Cannot find module '" + moduleId + "'");
/******/ 			e.code = 'MODULE_NOT_FOUND';
/******/ 			throw e;
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
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!*********************!*\
  !*** ./src/main.js ***!
  \*********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _main_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./main.scss */ "./src/main.scss");


// Function to reload the quote drawer content.
function reloadQuoteDrawer() {
  fetch(window.location.href).then(res => res.text()).then(html => {
    const doc = new DOMParser().parseFromString(html, 'text/html');
    const newContent = doc.querySelector('#quote-drawer > *');
    const drawer = document.querySelector('#quote-drawer');
    if (newContent && drawer) {
      drawer.innerHTML = newContent.parentElement.innerHTML;
      drawer.classList.add('is-open');
      document.body.style.overflow = 'hidden';
    }
  });
}

// Wait for AJAX to finish.
jQuery(document).ajaxComplete(function (event, xhr, settings) {
  if (!settings?.data) return;
  if (settings.data.includes('add_to_quote') || settings.data.includes('remove_quote_item') || settings.data.includes('update_quote')) {
    reloadQuoteDrawer();
  }
});

// Close drawer
document.addEventListener('click', function (e) {
  const closeTrigger = e.target.closest('.qd-overlay, .qd-close');
  if (!closeTrigger) return;
  const drawer = document.getElementById('quote-drawer');
  if (!drawer) return;
  drawer.classList.remove('is-open');
  document.body.style.overflow = '';
});
document.addEventListener('click', function (e) {
  const openMiniQuote = e.target.closest('.view-mini-quote-btn a');
  if (!openMiniQuote) return;
  const drawer = document.getElementById('quote-drawer');
  if (!drawer) return;
  drawer.classList.add('is-open');
  document.body.style.overflow = 'hidden';
});
})();

/******/ })()
;
//# sourceMappingURL=main.js.map