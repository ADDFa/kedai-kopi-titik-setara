/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./app/Resources/js/functions/sweet-alert.js":
/*!***************************************************!*\
  !*** ./app/Resources/js/functions/sweet-alert.js ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   Confirm: () => (/* binding */ Confirm),\n/* harmony export */   Toast: () => (/* binding */ Toast)\n/* harmony export */ });\nconst Toast = Swal.mixin({\r\n    toast: true,\r\n    position: \"top-end\",\r\n    showConfirmButton: false,\r\n    timer: 3000,\r\n    timerProgressBar: true,\r\n    didOpen: (toast) => {\r\n        toast.onmouseenter = Swal.stopTimer\r\n        toast.onmouseleave = Swal.resumeTimer\r\n    }\r\n})\r\n\r\nconst Confirm = Swal.mixin({\r\n    showConfirmButton: true,\r\n    showCancelButton: true,\r\n    confirmButtonColor: \"oklch(0.637 0.237 25.331)\",\r\n    text: \"Anda yakin?\",\r\n    icon: \"warning\"\r\n})\r\n\n\n//# sourceURL=webpack://project/./app/Resources/js/functions/sweet-alert.js?");

/***/ }),

/***/ "./app/Resources/js/main.js":
/*!**********************************!*\
  !*** ./app/Resources/js/main.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _functions_sweet_alert__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./functions/sweet-alert */ \"./app/Resources/js/functions/sweet-alert.js\");\n\r\n\r\nconst messageElement = document.getElementById(\"message\")\r\nif (messageElement) {\r\n    const { icon } = messageElement.dataset\r\n\r\n    _functions_sweet_alert__WEBPACK_IMPORTED_MODULE_0__.Toast.fire({\r\n        icon: icon || \"success\",\r\n        text: messageElement.textContent\r\n    })\r\n}\r\n\r\nif (document.querySelector(`[data-action=\"confirm\"]`)) {\r\n    const buttons = document.querySelectorAll(`[data-action=\"confirm\"]`)\r\n\r\n    const handler = (ev) => {\r\n        const { target } = ev.currentTarget.dataset\r\n\r\n        _functions_sweet_alert__WEBPACK_IMPORTED_MODULE_0__.Confirm.fire().then((result) => {\r\n            if (!result.isConfirmed) return\r\n\r\n            // form\r\n            const form = document.createElement(\"form\")\r\n            form.style.display = \"none\"\r\n            form.action = target\r\n            form.method = \"POST\"\r\n\r\n            // input method\r\n            const method = document.createElement(\"input\")\r\n            method.name = \"_method\"\r\n            method.value = \"DELETE\"\r\n\r\n            // submit button\r\n            const submit = document.createElement(\"button\")\r\n            submit.type = \"submit\"\r\n\r\n            // append childs\r\n            form.append(method, submit)\r\n\r\n            // append to page\r\n            document.body.appendChild(form)\r\n\r\n            // send\r\n            form.submit()\r\n        })\r\n    }\r\n\r\n    buttons.forEach((btn) => {\r\n        btn.addEventListener(\"click\", handler)\r\n    })\r\n}\r\n\n\n//# sourceURL=webpack://project/./app/Resources/js/main.js?");

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
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
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
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./app/Resources/js/main.js");
/******/ 	
/******/ })()
;