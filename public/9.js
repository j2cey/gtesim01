(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[9],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/esims/list-details.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/esims/list-details.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************/
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
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "list-details",
  props: {
    esims_prop: []
  },
  components: {},
  mounted: function mounted() {},
  created: function created() {},
  data: function data() {
    return {
      esims: this.esims_prop,
      searchEsims: null
    };
  },
  computed: {
    filteredEsims: function filteredEsims() {
      var _this = this;

      var tempEsims = this.esims;

      if (this.searchEsims !== '' && this.searchEsims) {
        tempEsims = tempEsims.filter(function (item) {
          return item.imsi.toUpperCase().includes(_this.searchEsims.toUpperCase());
        });
      } // Sorting


      tempEsims = tempEsims.sort(function (a, b) {
        var fa = a.imsi.toLowerCase(),
            fb = b.imsi.toLowerCase();

        if (fa > fb) {
          return -1;
        }

        if (fa < fb) {
          return 1;
        }

        return 0;
      });

      if (!this.ascending) {
        tempEsims.reverse();
      } // end Sorting


      return tempEsims;
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/esims/list-details.vue?vue&type=template&id=8f1a2480&scoped=true&":
/*!****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/esims/list-details.vue?vue&type=template&id=8f1a2480&scoped=true& ***!
  \****************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "card card-default" }, [
    _c("div", { staticClass: "card-body table-responsive p-0" }, [
      _c("table", { staticClass: "table table-head-fixed text-nowrap" }, [
        _c("thead", [
          _c("tr", [
            _c("th", [
              _c("div", { staticClass: "row" }, [
                _vm._m(0),
                _vm._v(" "),
                _c("div", { staticClass: "col-sm-3 col-2" }),
                _vm._v(" "),
                _c("div", { staticClass: "col-sm-3 col-2" }),
                _vm._v(" "),
                _c("div", { staticClass: "col-sm-6 col-6 align-right" }, [
                  _c("div", { staticClass: "btn-group" }, [
                    _c("div", { staticClass: "input-group input-group-sm" }, [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.searchEsims,
                            expression: "searchEsims",
                          },
                        ],
                        staticClass: "form-control form-control-navbar",
                        attrs: {
                          type: "search",
                          placeholder: "Search",
                          "aria-label": "Search",
                        },
                        domProps: { value: _vm.searchEsims },
                        on: {
                          input: function ($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.searchEsims = $event.target.value
                          },
                        },
                      }),
                      _vm._v(" "),
                      _vm._m(1),
                    ]),
                  ]),
                ]),
              ]),
              _vm._v(" "),
              _vm._m(2),
            ]),
          ]),
        ]),
        _vm._v(" "),
        _c(
          "tbody",
          _vm._l(_vm.filteredEsims, function (esim, index) {
            return _vm.filteredEsims
              ? _c("tr", { key: esim.id, staticClass: "text text-xs" }, [
                  index < 10
                    ? _c("td", [
                        _c("div", { staticClass: "row" }, [
                          _c(
                            "div",
                            { staticClass: "col-sm-3 col-6 border-right" },
                            [
                              _c("span", { staticClass: "text text-xs" }, [
                                esim.phonenum
                                  ? _c("small", [
                                      _vm._v(_vm._s(esim.phonenum.numero)),
                                    ])
                                  : _vm._e(),
                              ]),
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-sm-4 col-6 border-right" },
                            [
                              _c("span", { staticClass: "text text-xs" }, [
                                _c("small", [_vm._v(_vm._s(esim.imsi))]),
                              ]),
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "col-sm-3 col-6 border-right" },
                            [
                              _c("span", { staticClass: "text text-xs" }, [
                                _c("small", [_vm._v(_vm._s(esim.iccid))]),
                              ]),
                            ]
                          ),
                          _vm._v(" "),
                          _c("div", { staticClass: "col-sm-2 col-6" }, [
                            _c("span", { staticClass: "text text-xs" }, [
                              esim.attributed_by
                                ? _c("small", [
                                    _vm._v(
                                      _vm._s(
                                        _vm._f("formatDate")(esim.attributed_at)
                                      )
                                    ),
                                  ])
                                : _vm._e(),
                            ]),
                          ]),
                        ]),
                      ])
                    : _vm._e(),
                ])
              : _vm._e()
          }),
          0
        ),
      ]),
    ]),
  ])
}
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-sm-3 col-2" }, [
      _c("span", { staticClass: "text text-xs" }),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "input-group-append" }, [
      _c(
        "button",
        { staticClass: "btn btn-navbar", attrs: { type: "button" } },
        [_c("i", { staticClass: "fas fa-search" })]
      ),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "row" }, [
      _c("div", { staticClass: "col-sm-3 col-6" }, [
        _c("span", { staticClass: "text text-xs" }, [_vm._v("Numero")]),
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "col-sm-4 col-6" }, [
        _c("span", { staticClass: "text text-xs" }, [_vm._v("IMSI")]),
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "col-sm-3 col-6" }, [
        _c("span", { staticClass: "text text-xs" }, [_vm._v("ICCID")]),
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "col-sm-2 col-6" }, [
        _c("span", { staticClass: "text text-xs" }, [
          _vm._v("Date Attribution"),
        ]),
      ]),
    ])
  },
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/esims/list-details.vue":
/*!***************************************************!*\
  !*** ./resources/js/views/esims/list-details.vue ***!
  \***************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _list_details_vue_vue_type_template_id_8f1a2480_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./list-details.vue?vue&type=template&id=8f1a2480&scoped=true& */ "./resources/js/views/esims/list-details.vue?vue&type=template&id=8f1a2480&scoped=true&");
/* harmony import */ var _list_details_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./list-details.vue?vue&type=script&lang=js& */ "./resources/js/views/esims/list-details.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _list_details_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _list_details_vue_vue_type_template_id_8f1a2480_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _list_details_vue_vue_type_template_id_8f1a2480_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "8f1a2480",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/esims/list-details.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/esims/list-details.vue?vue&type=script&lang=js&":
/*!****************************************************************************!*\
  !*** ./resources/js/views/esims/list-details.vue?vue&type=script&lang=js& ***!
  \****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_list_details_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./list-details.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/esims/list-details.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_list_details_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/esims/list-details.vue?vue&type=template&id=8f1a2480&scoped=true&":
/*!**********************************************************************************************!*\
  !*** ./resources/js/views/esims/list-details.vue?vue&type=template&id=8f1a2480&scoped=true& ***!
  \**********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_list_details_vue_vue_type_template_id_8f1a2480_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./list-details.vue?vue&type=template&id=8f1a2480&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/esims/list-details.vue?vue&type=template&id=8f1a2480&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_list_details_vue_vue_type_template_id_8f1a2480_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_list_details_vue_vue_type_template_id_8f1a2480_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);