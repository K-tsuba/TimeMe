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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/time.js":
/*!******************************!*\
  !*** ./resources/js/time.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

var interval_id;
var start_click = false;
var time = 0;
var hour = 0;
var min = 0;
var sec = 0;

function start_timer() {
  var selectBox = document.getElementById('select_study_site');
  var start_button = document.getElementById('start');

  if (selectBox.options[0].selected === false) {
    start_button.disabled = false;

    if (start_click === false) {
      interval_id = setInterval(count_down, 1000);
      start_click = true;
      document.getElementById("start").disabled = true;
      document.getElementById("stop").disabled = false;
      document.getElementById("reset").disabled = false;
      var select = document.getElementById('select_study_site');
      var study_site_id = select.value;
      var token = document.getElementsByName('csrf-token').item(0).content;
      var request = new XMLHttpRequest();
      request.open('post', '/times/start_store/' + study_site_id, true);
      request.responseType = 'json';
      request.setRequestHeader('X-CSRF-Token', token);

      request.onload = function () {
        var data = this.response;
      };

      request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      request.send("status=start");
    }
  } else {
    alert("学習するサイトを選択してください。");
    start_click = false;
  }
}

function hoge(event) {
  if (start_click === true) {
    event = event || window.event;
    return event.returnValue = '表示させたいメッセージ';
  }
}

if (window.addEventListener) {
  window.addEventListener('beforeunload', hoge, false);
}

function count_down() {
  time++;
  hour = Math.floor(time / 3600);
  min = Math.floor(time / 60 % 60);
  sec = time % 60;
  var display = document.getElementById('display');
  display.innerHTML = hour + ':' + min + ':' + sec;
}

function stop_timer() {
  clearInterval(interval_id);
  start_click = false;
  var token = document.getElementsByName('csrf-token').item(0).content;
  var request = new XMLHttpRequest();
  request.open('post', '/times/stop_store', true);
  request.responseType = 'json';
  request.setRequestHeader('X-CSRF-Token', token);

  request.onload = function () {
    var data = this.response;
    console.log(data);
  };

  request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  request.send("status=stop");
  document.getElementById("stop").disabled = true;
}

function reset_timer() {
  time = 0;
  var hour = 0;
  var min = 0;
  var sec = 0;
  var reset = document.getElementById('display');
  reset.innerHTML = '0:0:0';
  document.getElementById("start").disabled = false;
  document.getElementById("stop").disabled = true;
  document.getElementById("reset").disabled = true;
}

window.onload = function () {
  var start = document.getElementById('start');
  start.addEventListener('click', start_timer, false);
  var stop = document.getElementById('stop');
  stop.addEventListener('click', stop_timer, false);
  var reset = document.getElementById('reset');
  reset.addEventListener('click', reset_timer, false);
}; // var apikey = 'AIzaSyCRj1tsmPrdQa7NC3TWwrVlDdpwUzQntSw' ;


var apikey = "AIzaSyCRj1tsmPrdQa7NC3TWwrVlDdpwUzQntSw";
var channelid = 'UCHrjqpLwUNY4BV017sq21Tw';
var maxresults = '1';
var url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&channelId=' + channelid + '&maxResults=' + maxresults + '&order=date&type=video&key=' + apikey;
var xhr = new XMLHttpRequest();
xhr.open('get', url);
xhr.send();

xhr.onreadystatechange = function () {
  if (xhr.readyState === 4 && xhr.status === 200) {
    var json = JSON.parse(xhr.responseText);
    var html = ""; // var thumnail = "";

    var videoid = "";
    var title = "";

    for (var i = 0; i < json.items.length; i++) {
      // thumbnail = json.items[i].snippet.thumbnails.default.url;
      videoid = json.items[i].id.videoId;
      title = json.items[i].snippet.title;
      html += '<div class="text-center"><iframe width="150" height="100" src="https://www.youtube.com/embed/' + videoid + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><a href="https://www.youtube.com/watch?v=' + videoid + '" target="_blank" class="text-white"><br>' + title + '<br></div>';
    }

    document.getElementById('youtubeList').innerHTML = html;
  }
};

/***/ }),

/***/ 1:
/*!************************************!*\
  !*** multi ./resources/js/time.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/ec2-user/environment/blog/resources/js/time.js */"./resources/js/time.js");


/***/ })

/******/ });