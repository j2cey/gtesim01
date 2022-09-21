(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[6],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/chartjs/linechartjs.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/chartjs/linechartjs.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "line-chartjs",
  mounted: function mounted() {
    var image = document.getElementById('source');
    var ctx = document.getElementById('myLineChart').getContext('2d');
    var chart = new Chart(ctx, {
      // The type of chart we want to create
      type: 'line',
      // The data for our dataset
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July"],
        datasets: [{
          label: "My Sales",
          backgroundColor: 'rgba(255, 99, 132,1)',
          borderColor: 'blue',
          borderWidth: 2,
          borderDash: [10],
          borderDashOffset: 10,
          borderCapStyle: "square",
          borderJoinStyle: "bevel",
          //cubicInterpolationMode: "monotone",
          fill: "start",
          lineTension: 0.4,
          // default 0.4
          pointBackgroundColor: ["red", "green", "blue", "yellow", "pink", "purple"],
          pointBorderColor: "pink",
          pointBorderWidth: 0,
          pointRadius: 10,
          //pointStyle: image,
          pointHitRadius: 20,
          pointHoverBackgroundColor: "purple",
          pointHoverBorderColor: "pink",
          data: [0, 50, 5, 2, 20, 30, 45]
        }]
      },
      // Configuration options go here
      options: {}
    });
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/chartjs/linechartjs.vue?vue&type=template&id=62acdc1c&scoped=true&":
/*!*****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/chartjs/linechartjs.vue?vue&type=template&id=62acdc1c&scoped=true& ***!
  \*****************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm._m(0)
}
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "bg-primary" }, [
      _c("h1", [_vm._v("Hello Line Chart")]),
      _vm._v(" "),
      _c("div", { staticClass: "container" }, [
        _c("div", { staticClass: "row align-items-center" }, [
          _c("div", { staticClass: "card col-md-6 offset-md-3" }, [
            _c("canvas", { attrs: { id: "myLineChart" } }),
          ]),
        ]),
      ]),
      _vm._v(" "),
      _c("img", {
        staticClass: "d-none",
        attrs: {
          id: "source",
          src: "https://www.glamouratiuk.com/include/thumbnail.asp?sFile=/file-manager/Products/Stencils/star-3.jpg&iWidth=65",
          width: "25",
          height: "25",
          alt: "",
        },
      }),
    ])
  },
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/chartjs/linechartjs.vue":
/*!****************************************************!*\
  !*** ./resources/js/views/chartjs/linechartjs.vue ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _linechartjs_vue_vue_type_template_id_62acdc1c_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./linechartjs.vue?vue&type=template&id=62acdc1c&scoped=true& */ "./resources/js/views/chartjs/linechartjs.vue?vue&type=template&id=62acdc1c&scoped=true&");
/* harmony import */ var _linechartjs_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./linechartjs.vue?vue&type=script&lang=js& */ "./resources/js/views/chartjs/linechartjs.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _linechartjs_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _linechartjs_vue_vue_type_template_id_62acdc1c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _linechartjs_vue_vue_type_template_id_62acdc1c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "62acdc1c",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/chartjs/linechartjs.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/chartjs/linechartjs.vue?vue&type=script&lang=js&":
/*!*****************************************************************************!*\
  !*** ./resources/js/views/chartjs/linechartjs.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_linechartjs_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./linechartjs.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/chartjs/linechartjs.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_linechartjs_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/chartjs/linechartjs.vue?vue&type=template&id=62acdc1c&scoped=true&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/views/chartjs/linechartjs.vue?vue&type=template&id=62acdc1c&scoped=true& ***!
  \***********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_linechartjs_vue_vue_type_template_id_62acdc1c_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./linechartjs.vue?vue&type=template&id=62acdc1c&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/chartjs/linechartjs.vue?vue&type=template&id=62acdc1c&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_linechartjs_vue_vue_type_template_id_62acdc1c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_linechartjs_vue_vue_type_template_id_62acdc1c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);