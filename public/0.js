(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/reports/item.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/reports/item.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _reportattributes_list__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../reportattributes/list */ "./resources/js/views/reportattributes/list.vue");
/* harmony import */ var _addupdate__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./addupdate */ "./resources/js/views/reports/addupdate.vue");
/* harmony import */ var _reportBus__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./reportBus */ "./resources/js/views/reports/reportBus.js");
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
  name: "report-item",
  props: {
    report_prop: {},
    index_prop: {}
  },
  components: {
    AddUpdateReport: _addupdate__WEBPACK_IMPORTED_MODULE_1__["default"],
    ReportAttributes: _reportattributes_list__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  mounted: function mounted() {
    var _this = this;

    _reportBus__WEBPACK_IMPORTED_MODULE_2__["default"].$on('report_updated', function (updreport) {
      if (_this.report.id === updreport.id) {
        _this.report = updreport;
        window.noty({
          message: 'Report successfully updated',
          type: 'success'
        });
      }
    });
  },
  created: function created() {},
  data: function data() {
    return {
      report: this.report_prop,
      index: this.index_prop,
      report_collapse_icon: 'fas fa-chevron-down',
      reportalerts_collapse_icon: 'fas fa-chevron-down'
    };
  },
  methods: {
    editReport: function editReport(report) {
      _reportBus__WEBPACK_IMPORTED_MODULE_2__["default"].$emit('edit_report', {
        report: report
      });
    },
    showFlowchart: function showFlowchart(report) {
      /*ReportBus.$emit('show_flowchart', report)*/
      window.location = '/reports.flowchart/' + report.uuid;
    },
    deleteReport: function deleteReport(id, key) {
      var _this2 = this;

      this.$swal({
        html: '<small>Do you really want to delete this Report ?</small>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Oui',
        cancelButtonText: 'Non'
      }).then(function (result) {
        if (result.value) {
          axios["delete"]("/reports/".concat(id)).then(function (resp) {
            console.log('report delete resp: ', resp);

            _this2.$swal({
              html: '<small>Report successfully deleted !</small>',
              icon: 'success',
              timer: 3000
            }).then(function () {
              _reportBus__WEBPACK_IMPORTED_MODULE_2__["default"].$emit('reportaction_deleted', {
                key: key,
                resp: resp
              });
            });
          })["catch"](function (error) {
            window.handleErrors(error);
          });
        } else {// stay here
        }
      });
    },
    createReportAlert: function createReportAlert() {},
    reportCollapseClicked: function reportCollapseClicked() {
      if (this.report_collapse_icon === 'fas fa-chevron-down') {
        this.report_collapse_icon = 'fas fa-chevron-up';
      } else {
        this.report_collapse_icon = 'fas fa-chevron-down';
      }
    },
    collapseReportAlertsClicked: function collapseReportAlertsClicked() {
      if (this.reportalerts_collapse_icon === 'fas fa-chevron-down') {
        this.reportalerts_collapse_icon = 'fas fa-chevron-up';
      } else {
        this.reportalerts_collapse_icon = 'fas fa-chevron-down';
      }
    }
  },
  computed: {
    currentReportCollapseIcon: function currentReportCollapseIcon() {
      return this.report_collapse_icon;
    },
    currentReportAlertsCollapseIcon: function currentReportAlertsCollapseIcon() {
      return this.reportalerts_collapse_icon;
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/reports/item.vue?vue&type=template&id=feec173c&scoped=true&":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/reports/item.vue?vue&type=template&id=feec173c&scoped=true& ***!
  \**********************************************************************************************************************************************************************************************************************/
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
  return _c("div", { attrs: { id: "reportwrapper_" + _vm.report.uuid } }, [
    _c(
      "div",
      { staticClass: "card" },
      [
        _c("header", [
          _c("div", { staticClass: "card-header-title row" }, [
            _c("div", { staticClass: "col-md-6 col-sm-8 col-12" }, [
              _c(
                "span",
                {
                  staticClass: "text-purple text-sm",
                  attrs: {
                    "data-toggle": "collapse",
                    "data-parent": "#reportwrapper_" + _vm.report.uuid,
                    href: "#collapse-reports-" + _vm.index,
                  },
                  on: {
                    click: function ($event) {
                      return _vm.reportCollapseClicked()
                    },
                  },
                },
                [
                  _vm._v(
                    "\n                        " +
                      _vm._s(_vm.report.title) +
                      "\n                    "
                  ),
                ]
              ),
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-6 col-sm-4 col-12 text-right" }, [
              _c("span", { staticClass: "text text-sm" }, [
                _c(
                  "a",
                  {
                    staticClass: "btn btn-tool text-success",
                    attrs: { type: "button", "data-toggle": "tooltip" },
                    on: {
                      click: function ($event) {
                        return _vm.showFlowchart(_vm.report)
                      },
                    },
                  },
                  [_c("i", { staticClass: "fa fa-eye" })]
                ),
                _vm._v(" "),
                _c(
                  "a",
                  {
                    staticClass: "btn btn-tool text-warning",
                    attrs: { type: "button", "data-toggle": "tooltip" },
                    on: {
                      click: function ($event) {
                        return _vm.editReport(_vm.report)
                      },
                    },
                  },
                  [_c("i", { staticClass: "fa fa-pencil-square-o" })]
                ),
                _vm._v(" "),
                _c(
                  "a",
                  {
                    staticClass: "btn btn-tool",
                    attrs: {
                      type: "button",
                      "data-toggle": "collapse",
                      "data-parent": "#reportwrapper_" + _vm.report.uuid,
                      href: "#collapse-reports-" + _vm.index,
                    },
                    on: {
                      click: function ($event) {
                        return _vm.reportCollapseClicked()
                      },
                    },
                  },
                  [_c("i", { class: _vm.currentReportCollapseIcon })]
                ),
                _vm._v(" "),
                _c(
                  "a",
                  {
                    staticClass: "btn btn-tool text-danger",
                    attrs: { type: "button" },
                    on: {
                      click: function ($event) {
                        return _vm.deleteReport(_vm.report.uuid, _vm.index)
                      },
                    },
                  },
                  [_c("i", { staticClass: "fas fa-trash" })]
                ),
              ]),
            ]),
          ]),
        ]),
        _vm._v(" "),
        _c(
          "div",
          {
            staticClass: "card-content panel-collapse collapse in",
            attrs: { id: "collapse-reports-" + _vm.index },
          },
          [
            _c("div", { staticClass: "row" }, [
              _c("div", { staticClass: "col-md-3 col-sm-6 col-12" }, [
                _c("div", { staticClass: "row card card-default" }, [
                  _c("div", { staticClass: "card-body" }, [
                    _c("dt", { staticClass: "text text-xs" }, [_vm._v("Name")]),
                    _vm._v(" "),
                    _c("dd", { staticClass: "text text-xs" }, [
                      _vm._v(_vm._s(_vm.report.reporttype.name)),
                    ]),
                    _vm._v(" "),
                    _c("dt", { staticClass: "text text-xs" }, [
                      _vm._v("Description"),
                    ]),
                    _vm._v(" "),
                    _c("dd", { staticClass: "text text-xs" }, [
                      _vm._v(_vm._s(_vm.report.description)),
                    ]),
                    _vm._v(" "),
                    _c("dt", { staticClass: "text text-xs" }, [
                      _vm._v("Created at"),
                    ]),
                    _vm._v(" "),
                    _c("dd", { staticClass: "text text-xs" }, [
                      _vm._v(
                        _vm._s(_vm._f("formatDate")(_vm.report.created_at))
                      ),
                    ]),
                    _vm._v(" "),
                    _c("dd", { staticClass: "col-sm-8 offset-sm-4 text-xs" }),
                  ]),
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    staticClass: "row card card-default",
                    attrs: { id: "reportalerts_" + _vm.report.id },
                  },
                  [
                    _c("header", [
                      _c("div", { staticClass: "card-header-title row" }, [
                        _c(
                          "div",
                          { staticClass: "col-md-6 col-sm-8 col-12" },
                          [
                            _c(
                              "span",
                              {
                                staticClass: "text-olive text-xs",
                                attrs: {
                                  "data-toggle": "collapse",
                                  "data-parent":
                                    "#reportalerts_" + _vm.report.id,
                                  href:
                                    "#collapse-reportalerts-" + _vm.report.id,
                                },
                                on: {
                                  click: function ($event) {
                                    return _vm.collapseReportAlertsClicked()
                                  },
                                },
                              },
                              [
                                _vm._v(
                                  "\n                            Alerts\n                        "
                                ),
                              ]
                            ),
                            _vm._v(" "),
                            _c(
                              "b-button",
                              {
                                attrs: { size: "is-small", type: "is-ghost" },
                                on: {
                                  click: function ($event) {
                                    return _vm.createReportAlert()
                                  },
                                },
                              },
                              [_c("i", { staticClass: "fas fa-plus" })]
                            ),
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "div",
                          {
                            staticClass: "col-md-6 col-sm-4 col-12 text-right",
                          },
                          [
                            _c("span", { staticClass: "text text-sm" }, [
                              _c(
                                "a",
                                {
                                  staticClass: "btn btn-tool",
                                  attrs: {
                                    type: "button",
                                    "data-toggle": "collapse",
                                    "data-parent":
                                      "#reportalerts_" + _vm.report.id,
                                    href:
                                      "#collapse-reportalerts-" + _vm.report.id,
                                  },
                                  on: {
                                    click: function ($event) {
                                      return _vm.collapseReportAlertsClicked()
                                    },
                                  },
                                },
                                [
                                  _c("i", {
                                    class: _vm.currentReportAlertsCollapseIcon,
                                  }),
                                ]
                              ),
                            ]),
                          ]
                        ),
                      ]),
                    ]),
                    _vm._v(" "),
                    _c(
                      "div",
                      {
                        staticClass: "card-content panel-collapse collapse in",
                        attrs: { id: "collapse-reportalerts-" + _vm.report.id },
                      },
                      [
                        _vm._v(
                          "\n\n                            Loop Throught Alerts Here !\n\n                        "
                        ),
                      ]
                    ),
                  ]
                ),
              ]),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "col-md-9 col-sm-6 col-12" },
                [
                  _c("ReportAttributes", {
                    attrs: {
                      report_prop: _vm.report,
                      reportattributes_prop: _vm.report.attributes,
                    },
                  }),
                ],
                1
              ),
            ]),
          ]
        ),
        _vm._v(" "),
        _c("AddUpdateReport"),
      ],
      1
    ),
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/reportattributes/list.vue":
/*!******************************************************!*\
  !*** ./resources/js/views/reportattributes/list.vue ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/vue-loader/lib/index.js):\nError: ENOENT: no such file or directory, open 'D:\\WorkPersoData\\PersoData\\VMs\\VagrantVMs\\ubuntu20.04\\www\\gtesim\\resources\\js\\views\\reportattributes\\list.vue'");

/***/ }),

/***/ "./resources/js/views/reports/item.vue":
/*!*********************************************!*\
  !*** ./resources/js/views/reports/item.vue ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _item_vue_vue_type_template_id_feec173c_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./item.vue?vue&type=template&id=feec173c&scoped=true& */ "./resources/js/views/reports/item.vue?vue&type=template&id=feec173c&scoped=true&");
/* harmony import */ var _item_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./item.vue?vue&type=script&lang=js& */ "./resources/js/views/reports/item.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _item_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _item_vue_vue_type_template_id_feec173c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _item_vue_vue_type_template_id_feec173c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "feec173c",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/reports/item.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/reports/item.vue?vue&type=script&lang=js&":
/*!**********************************************************************!*\
  !*** ./resources/js/views/reports/item.vue?vue&type=script&lang=js& ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_item_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./item.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/reports/item.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_item_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/reports/item.vue?vue&type=template&id=feec173c&scoped=true&":
/*!****************************************************************************************!*\
  !*** ./resources/js/views/reports/item.vue?vue&type=template&id=feec173c&scoped=true& ***!
  \****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_item_vue_vue_type_template_id_feec173c_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./item.vue?vue&type=template&id=feec173c&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/reports/item.vue?vue&type=template&id=feec173c&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_item_vue_vue_type_template_id_feec173c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_item_vue_vue_type_template_id_feec173c_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);