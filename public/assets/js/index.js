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
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _functions_sweet_alert__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./functions/sweet-alert */ \"./app/Resources/js/functions/sweet-alert.js\");\n/* harmony import */ var _pages_product__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./pages/product */ \"./app/Resources/js/pages/product.js\");\n/* harmony import */ var _pages_product__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_pages_product__WEBPACK_IMPORTED_MODULE_1__);\n/* harmony import */ var _pages_menu__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./pages/menu */ \"./app/Resources/js/pages/menu.js\");\n/* harmony import */ var _pages_menu__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_pages_menu__WEBPACK_IMPORTED_MODULE_2__);\n/* harmony import */ var _pages_cart__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./pages/cart */ \"./app/Resources/js/pages/cart.js\");\n/* harmony import */ var _pages_customer_order__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./pages/customer-order */ \"./app/Resources/js/pages/customer-order.js\");\n/* harmony import */ var _pages_customer_order__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_pages_customer_order__WEBPACK_IMPORTED_MODULE_4__);\n\r\n\r\n\r\n\r\n\r\n\r\nif (document.getElementById(\"message\")) {\r\n    const messageElement = document.getElementById(\"message\")\r\n    const { icon } = messageElement.dataset\r\n\r\n    _functions_sweet_alert__WEBPACK_IMPORTED_MODULE_0__.Toast.fire({\r\n        icon: icon || \"success\",\r\n        text: messageElement.textContent\r\n    })\r\n}\r\n\r\nconst handleConfirm = (ev) => {\r\n    const {\r\n        target,\r\n        icon = \"warning\",\r\n        text = \"Anda yakin?\"\r\n    } = ev.currentTarget.dataset\r\n\r\n    _functions_sweet_alert__WEBPACK_IMPORTED_MODULE_0__.Confirm.fire({ icon, text }).then((result) => {\r\n        if (!result.isConfirmed) return\r\n\r\n        // form\r\n        const form = document.createElement(\"form\")\r\n        form.style.display = \"none\"\r\n        form.action = target\r\n        form.method = \"POST\"\r\n\r\n        // input method\r\n        const method = document.createElement(\"input\")\r\n        method.name = \"_method\"\r\n        method.value = \"DELETE\"\r\n\r\n        // submit button\r\n        const submit = document.createElement(\"button\")\r\n        submit.type = \"submit\"\r\n\r\n        // append childs\r\n        form.append(method, submit)\r\n\r\n        // append to page\r\n        document.body.appendChild(form)\r\n\r\n        // send\r\n        form.submit()\r\n    })\r\n}\r\n\r\ndocument.querySelectorAll(`[data-action=\"confirm\"]`).forEach((btn) => {\r\n    btn.addEventListener(\"click\", handleConfirm)\r\n})\r\n\r\nconst toggleHandlers = {\r\n    dropdown(ev) {\r\n        const { target } = ev.currentTarget.dataset\r\n\r\n        const dropdownMenu = document.getElementById(target)\r\n        dropdownMenu?.classList.toggle(\"show\")\r\n    }\r\n}\r\n\r\nconst toggleButtons = document.querySelectorAll(`[data-toggle]`)\r\n\r\ntoggleButtons.forEach((btn) => {\r\n    const handleToggleClick = (ev) => {\r\n        const { toggle } = ev.currentTarget.dataset\r\n        if (toggleHandlers[toggle]) toggleHandlers[toggle](ev)\r\n    }\r\n\r\n    btn.addEventListener(\"click\", handleToggleClick)\r\n})\r\n\r\ndocument.addEventListener(\"click\", (ev) => {\r\n    toggleButtons.forEach((btn) => {\r\n        const { toggle } = btn.dataset\r\n\r\n        switch (toggle) {\r\n            case \"dropdown\":\r\n                const dropdownMenu = document.getElementById(btn.dataset.target)\r\n                if (btn.contains(ev.target) || dropdownMenu.contains(ev.target))\r\n                    return\r\n\r\n                dropdownMenu.classList.remove(\"show\")\r\n                break\r\n        }\r\n    })\r\n})\r\n\n\n//# sourceURL=webpack://project/./app/Resources/js/main.js?");

/***/ }),

/***/ "./app/Resources/js/pages/cart.js":
/*!****************************************!*\
  !*** ./app/Resources/js/pages/cart.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _functions_sweet_alert__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../functions/sweet-alert */ \"./app/Resources/js/functions/sweet-alert.js\");\n\r\n\r\nconst deleteCartProductsBtn = document.querySelectorAll(\r\n    `[data-name=\"delete-product-in-cart\"]`\r\n)\r\nconst addProductsBtn = document.querySelectorAll(`[data-name=\"add-product\"]`)\r\nconst reduceProductsBtn = document.querySelectorAll(\r\n    `[data-name=\"reduce-product\"]`\r\n)\r\nconst paymentMethod = document.getElementById(\"payment-method\")\r\n\r\nif (paymentMethod) {\r\n    const saveHistory = (data) => {\r\n        localStorage.setItem(\"_history\", JSON.stringify(data))\r\n    }\r\n\r\n    const history = JSON.parse(localStorage.getItem(\"_history\") || \"{}\")\r\n    if (!history.hasOwnProperty(\"payment-method\")) {\r\n        history[\"payment-method\"] = \"cash\"\r\n    }\r\n\r\n    paymentMethod.value = history[\"payment-method\"]\r\n    saveHistory(history)\r\n\r\n    paymentMethod.addEventListener(\"input\", (ev) => {\r\n        history[\"payment-method\"] = ev.currentTarget.value\r\n        saveHistory(history)\r\n    })\r\n}\r\n\r\ndeleteCartProductsBtn.forEach((btn) => {\r\n    const handleDelete = (ev) => {\r\n        const { target } = ev.currentTarget.dataset\r\n\r\n        _functions_sweet_alert__WEBPACK_IMPORTED_MODULE_0__.Confirm.fire({\r\n            text: \"Yakin untuk menghapus data produk?\"\r\n        }).then((result) => {\r\n            if (!result.isConfirmed) return\r\n\r\n            // form\r\n            const form = document.createElement(\"form\")\r\n            form.style.display = \"none\"\r\n            form.action = target\r\n            form.method = \"POST\"\r\n\r\n            // input method\r\n            const method = document.createElement(\"input\")\r\n            method.name = \"_method\"\r\n            method.value = \"DELETE\"\r\n\r\n            // submit button\r\n            const submit = document.createElement(\"button\")\r\n            submit.type = \"submit\"\r\n\r\n            // append childs\r\n            form.append(method, submit)\r\n\r\n            // append to page\r\n            document.body.appendChild(form)\r\n\r\n            // send\r\n            form.submit()\r\n        })\r\n    }\r\n\r\n    btn.addEventListener(\"click\", handleDelete)\r\n})\r\n\r\nconst updateTotal = (total) => {\r\n    const containers = document.querySelectorAll(`[data-name=\"total\"]`)\r\n\r\n    containers.forEach((container) => {\r\n        container.textContent = `Rp. ${total}`\r\n    })\r\n}\r\n\r\naddProductsBtn.forEach((btn) => {\r\n    const handleAddProduct = async (ev) => {\r\n        const { id } = ev.currentTarget.dataset\r\n\r\n        const productCase = document.querySelector(\r\n            `[data-name=\"product-total-value-${id}\"]`\r\n        )\r\n        if (!productCase) return\r\n\r\n        const container = document.querySelector(\r\n            `[data-name=\"user-total-product\"]`\r\n        )\r\n\r\n        try {\r\n            const response = await fetch(`/cart/add-product/${id}`, {\r\n                method: \"POST\"\r\n            })\r\n            if (!response.ok) throw new Error(await response.text())\r\n\r\n            const { qty, total } = await response.json()\r\n            productCase.textContent = qty\r\n            updateTotal(total)\r\n\r\n            let cartTotal = parseInt(container.textContent)\r\n            container.textContent = ++cartTotal\r\n        } catch (e) {\r\n            console.warn(e)\r\n        }\r\n    }\r\n\r\n    btn.addEventListener(\"click\", handleAddProduct)\r\n})\r\n\r\nreduceProductsBtn.forEach((btn) => {\r\n    const handleReduceProduct = async (ev) => {\r\n        const { id } = ev.currentTarget.dataset\r\n\r\n        const productCase = document.querySelector(\r\n            `[data-name=\"product-total-value-${id}\"]`\r\n        )\r\n        if (!productCase) return\r\n\r\n        const container = document.querySelector(\r\n            `[data-name=\"user-total-product\"]`\r\n        )\r\n\r\n        try {\r\n            const response = await fetch(`/cart/reduce-product/${id}`, {\r\n                method: \"POST\"\r\n            })\r\n            if (!response.ok) throw new Error(await response.text())\r\n\r\n            const { qty, total } = await response.json()\r\n            productCase.textContent = qty\r\n            updateTotal(total)\r\n\r\n            let cartTotal = parseInt(container.textContent)\r\n            container.textContent = --cartTotal\r\n        } catch (e) {\r\n            console.warn(e)\r\n        }\r\n    }\r\n\r\n    btn.addEventListener(\"click\", handleReduceProduct)\r\n})\r\n\n\n//# sourceURL=webpack://project/./app/Resources/js/pages/cart.js?");

/***/ }),

/***/ "./app/Resources/js/pages/customer-order.js":
/*!**************************************************!*\
  !*** ./app/Resources/js/pages/customer-order.js ***!
  \**************************************************/
/***/ (() => {

eval("document\r\n    .getElementById(\"customer-order-table\")\r\n    ?.addEventListener(\"click\", (event) => {\r\n        const clickedTbody = event.target.closest(\"tbody\")\r\n        const clickedRow = event.target.closest(\"tr\")\r\n        const clickedBtn = event.target.closest(\"button\")\r\n\r\n        if (!clickedTbody || !clickedRow || clickedBtn) return\r\n\r\n        const { id } = clickedRow.dataset\r\n        if (id) location.href = `/customer/order/${id}`\r\n    })\r\n\r\ndocument.getElementById(\"status\")?.addEventListener(\"input\", (ev) => {\r\n    const form = ev.currentTarget.form\r\n\r\n    form.submit()\r\n})\r\n\r\nif (location.search) {\r\n    const dataSearch = new URLSearchParams(location.search)\r\n\r\n    if (dataSearch.get(\"status\")) {\r\n        const el = document.querySelector(\r\n            `[value=\"${dataSearch.get(\"status\")}\"]`\r\n        )\r\n        el.parentElement\r\n            .querySelector(`[selected]`)\r\n            ?.removeAttribute(\"selected\")\r\n\r\n        el.setAttribute(\"selected\", \"\")\r\n    }\r\n}\r\n\n\n//# sourceURL=webpack://project/./app/Resources/js/pages/customer-order.js?");

/***/ }),

/***/ "./app/Resources/js/pages/menu.js":
/*!****************************************!*\
  !*** ./app/Resources/js/pages/menu.js ***!
  \****************************************/
/***/ (() => {

eval("const cartButtons = document.querySelectorAll(`[data-action=\"add-to-cart\"]`)\r\n\r\ncartButtons.forEach((cartButton) => {\r\n    const handleAddToCart = async () => {\r\n        const { userId, productId } = cartButton.dataset\r\n        if (!userId || !productId) return (location.href = \"/sign-in\")\r\n\r\n        const container = document.querySelector(\r\n            `[data-name=\"user-total-product\"]`\r\n        )\r\n\r\n        const body = new FormData()\r\n        body.append(\"user_id\", userId)\r\n        body.append(\"product_id\", productId)\r\n\r\n        try {\r\n            const response = await fetch(\"/cart\", {\r\n                method: \"POST\",\r\n                body\r\n            })\r\n\r\n            if (!response.ok) {\r\n                const message = `Status: [${response.status}] ${response.statusText}`\r\n                console.log(await response.text())\r\n                throw new Error(message)\r\n            }\r\n\r\n            const { total_product } = await response.json()\r\n            if (container) container.innerText = total_product\r\n        } catch (e) {\r\n            console.warn(e)\r\n        }\r\n    }\r\n\r\n    cartButton.addEventListener(\"click\", handleAddToCart)\r\n})\r\n\n\n//# sourceURL=webpack://project/./app/Resources/js/pages/menu.js?");

/***/ }),

/***/ "./app/Resources/js/pages/product.js":
/*!*******************************************!*\
  !*** ./app/Resources/js/pages/product.js ***!
  \*******************************************/
/***/ (() => {

eval("document.getElementById(\"product-table\")?.addEventListener(\"click\", (event) => {\r\n    const clickedTbody = event.target.closest(\"tbody\")\r\n    const clickedRow = event.target.closest(\"tr\")\r\n    const clickedBtn = event.target.closest(\"button\")\r\n\r\n    if (!clickedTbody || !clickedRow || clickedBtn) return\r\n\r\n    const { id } = clickedRow.dataset\r\n    if (id) location.href = `/product/${id}`\r\n})\r\n\n\n//# sourceURL=webpack://project/./app/Resources/js/pages/product.js?");

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