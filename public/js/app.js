/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
//require('./bootstrap');
//window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// const app = new Vue({
//     el: '#app'
// });

/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/css-loader/index.js):\nModuleBuildError: Module build failed (from ./node_modules/sass-loader/lib/loader.js):\n\r\nundefined\r\n                           ^\r\n      Expected \"{\".\n  ╷\n2 │ window._ = require('lodash');\n  │                             ^\n  ╵\n  stdin 2:29  root stylesheet\r\n      in C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\resources\\js\\bootstrap.js (line 2, column 29)\n    at runLoaders (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\webpack\\lib\\NormalModule.js:301:20)\n    at C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\loader-runner\\lib\\LoaderRunner.js:367:11\n    at C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\loader-runner\\lib\\LoaderRunner.js:233:18\n    at context.callback (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\loader-runner\\lib\\LoaderRunner.js:111:13)\n    at render (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass-loader\\lib\\loader.js:52:13)\n    at Function.$2 (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:24388:48)\n    at wO.$2 (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:15315:15)\n    at uT.vr (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:9046:42)\n    at uT.vq (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:9048:32)\n    at iA.uD (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:8396:46)\n    at us.$0 (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:8538:7)\n    at Object.eH (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:1512:80)\n    at ad.ba (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:8459:3)\n    at iO.ba (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:8389:25)\n    at iO.cv (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:8376:6)\n    at py.cv (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:8166:35)\n    at Object.m (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:1383:19)\n    at C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:5070:51\n    at xe.a (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:1394:71)\n    at xe.$2 (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:8181:23)\n    at vR.$2 (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:8176:25)\n    at uT.vr (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:9046:42)\n    at uT.vq (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:9048:32)\n    at iA.uD (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:8396:46)\n    at us.$0 (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:8538:7)\n    at Object.eH (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:1512:80)\n    at ad.ba (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:8459:3)\n    at iO.ba (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:8389:25)\n    at iO.cv (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:8376:6)\n    at pz.$0 (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:8171:24)\n    at Object.Ie (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:1540:5)\n    at nF.Ir (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:1542:7)\n    at pD.$0 (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:8142:22)\n    at Jd (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:580:52)\n    at Immediate._onImmediate (C:\\Users\\EPHRAIM\\Desktop\\HNG\\kidstories\\node_modules\\sass\\sass.dart.js:589:51)\n    at runCallback (timers.js:810:20)");

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*****************************************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ./resources/js/bootstrap.js ***!
  \*****************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\Users\EPHRAIM\Desktop\HNG\kidstories\resources\js\app.js */"./resources/js/app.js");
__webpack_require__(/*! C:\Users\EPHRAIM\Desktop\HNG\kidstories\resources\sass\app.scss */"./resources/sass/app.scss");
module.exports = __webpack_require__(/*! C:\Users\EPHRAIM\Desktop\HNG\kidstories\resources\js\bootstrap.js */"./resources/js/bootstrap.js");


/***/ })

/******/ });