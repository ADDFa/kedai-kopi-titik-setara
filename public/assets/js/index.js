/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./app/Resources/js/functions/sweet-alert.js":
/*!***************************************************!*\
  !*** ./app/Resources/js/functions/sweet-alert.js ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   Confirm: () => (/* binding */ Confirm),\n/* harmony export */   Toast: () => (/* binding */ Toast)\n/* harmony export */ });\nconst Toast = Swal.mixin({\r\n    toast: true,\r\n    position: \"top-end\",\r\n    showConfirmButton: false,\r\n    timer: 3000,\r\n    timerProgressBar: true,\r\n    didOpen: (toast) => {\r\n        toast.onmouseenter = Swal.stopTimer\r\n        toast.onmouseleave = Swal.resumeTimer\r\n    }\r\n})\r\n\r\nconst Confirm = Swal.mixin({\r\n    showConfirmButton: true,\r\n    showCancelButton: true,\r\n    confirmButtonColor: \"oklch(0.637 0.237 25.331)\",\r\n    text: \"Anda yakin?\",\r\n    icon: \"warning\"\r\n})\r\n\n\n//# sourceURL=webpack://project/./app/Resources/js/functions/sweet-alert.js?");

/***/ }),

/***/ "./app/Resources/js/main.js":
/*!**********************************!*\
  !*** ./app/Resources/js/main.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _pages_product__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./pages/product */ \"./app/Resources/js/pages/product.js\");\n/* harmony import */ var _pages_product__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_pages_product__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var _pages_menu__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./pages/menu */ \"./app/Resources/js/pages/menu.js\");\n/* harmony import */ var _pages_menu__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_pages_menu__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _functions_sweet_alert__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./functions/sweet-alert */ \"./app/Resources/js/functions/sweet-alert.js\");\n\r\n\r\n\r\n\r\nif (document.getElementById(\"message\")) {\r\n    const messageElement = document.getElementById(\"message\")\r\n    const { icon } = messageElement.dataset\r\n\r\n    _functions_sweet_alert__WEBPACK_IMPORTED_MODULE_2__.Toast.fire({\r\n        icon: icon || \"success\",\r\n        text: messageElement.textContent\r\n    })\r\n}\r\n\r\nif (document.querySelector(`[data-action=\"confirm\"]`)) {\r\n    const buttons = document.querySelectorAll(`[data-action=\"confirm\"]`)\r\n\r\n    const handler = (ev) => {\r\n        const { target } = ev.currentTarget.dataset\r\n\r\n        _functions_sweet_alert__WEBPACK_IMPORTED_MODULE_2__.Confirm.fire().then((result) => {\r\n            if (!result.isConfirmed) return\r\n\r\n            // form\r\n            const form = document.createElement(\"form\")\r\n            form.style.display = \"none\"\r\n            form.action = target\r\n            form.method = \"POST\"\r\n\r\n            // input method\r\n            const method = document.createElement(\"input\")\r\n            method.name = \"_method\"\r\n            method.value = \"DELETE\"\r\n\r\n            // submit button\r\n            const submit = document.createElement(\"button\")\r\n            submit.type = \"submit\"\r\n\r\n            // append childs\r\n            form.append(method, submit)\r\n\r\n            // append to page\r\n            document.body.appendChild(form)\r\n\r\n            // send\r\n            form.submit()\r\n        })\r\n    }\r\n\r\n    buttons.forEach((btn) => {\r\n        btn.addEventListener(\"click\", handler)\r\n    })\r\n}\r\n\n\n//# sourceURL=webpack://project/./app/Resources/js/main.js?");

/***/ }),

/***/ "./app/Resources/js/pages/menu.js":
/*!****************************************!*\
  !*** ./app/Resources/js/pages/menu.js ***!
  \****************************************/
/***/ (() => {

eval("const cartButtons = document.querySelectorAll(\"#add-to-cart\")\r\ncartButtons.forEach((cartButton) => {\r\n    const handleAddToCart = async (ev) => {\r\n        const { userId, productId } = ev.currentTarget.dataset\r\n        if (!userId || !productId) return (location.href = \"/sign-in\")\r\n\r\n        const container = document.querySelector(\r\n            `[data-name=\"user-total-product\"]`\r\n        )\r\n\r\n        const body = new FormData()\r\n        body.append(\"user_id\", userId)\r\n        body.append(\"product_id\", productId)\r\n        const response = await fetch(\"/cart\", {\r\n            method: \"POST\",\r\n            body\r\n        })\r\n\r\n        if (response.headers.get(\"Content-Type\").includes(\"application/json\")) {\r\n            const { total_product } = await response.json()\r\n            if (container) container.innerText = total_product\r\n        }\r\n    }\r\n\r\n    cartButton.addEventListener(\"click\", handleAddToCart)\r\n})\r\n\n\n//# sourceURL=webpack://project/./app/Resources/js/pages/menu.js?");

/***/ }),

/***/ "./app/Resources/js/pages/product.js":
/*!*******************************************!*\
  !*** ./app/Resources/js/pages/product.js ***!
  \*******************************************/
/***/ (() => {

eval("document.getElementById(\"product-table\")?.addEventListener(\"click\", (ev) => {\r\n    const clickedTbody = ev.target.closest(\"tbody\")\r\n    const clickedRow = ev.target.closest(\"tr\")\r\n    const clickedBtn = ev.target.closest(\"button\")\r\n\r\n    if (!clickedTbody || !clickedRow || clickedBtn) return\r\n\r\n    const { id } = clickedRow.dataset\r\n    location.href = `/product/${id}`\r\n})\r\n\n\n//# sourceURL=webpack://project/./app/Resources/js/pages/product.js?");

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
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
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