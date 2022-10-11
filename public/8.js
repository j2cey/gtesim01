(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[8],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/dashboard/details-inner.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/dashboard/details-inner.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************/
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
  name: "details-inner",
  props: {
    statdetails_prop: {},
    stat_agence_prop: '',
    stat_period_prop: ''
  },
  components: {
    esimsListDetails: function esimsListDetails() {
      return __webpack_require__.e(/*! import() */ 9).then(__webpack_require__.bind(null, /*! ../esims/list-details */ "./resources/js/views/esims/list-details.vue"));
    }
  },
  data: function data() {
    return {
      statdetails: this.statdetails_prop,
      stat_agence: this.stat_agence_prop,
      stat_period: this.stat_period_prop,
      //data: this.workflowsteps_prop,
      isPaginated: true,
      isPaginationSimple: false,
      isPaginationRounded: true,
      paginationPosition: 'bottom',
      defaultSortDirection: 'asc',
      sortIcon: 'arrow-up',
      sortIconSize: 'is-small',
      currentPage: 1,
      perPage: 5,
      defaultOpenedDetails: [-1],
      showDetailIcon: true,
      useTransition: false,
      stickyHeaders: false,
      columns: [{
        field: 'id',
        key: 'id',
        label: 'ID',
        numeric: true,
        searchable: false,
        sortable: true
      }, {
        field: 'name',
        key: 'name',
        label: 'Nom',
        searchable: true,
        sortable: true
      }, {
        field: 'email',
        key: 'email',
        label: 'Email',
        searchable: true,
        sortable: true
      }, {
        field: 'departement',
        key: 'departement',
        label: 'Departement',
        searchable: false,
        sortable: true
      }, {
        field: 'esimsattributed',
        key: 'esimsattributed',
        label: 'Esim(s)',
        width: '100',
        centered: true,
        sortable: false
      }]
    };
  },
  methods: {
    showUser: function showUser(row) {},
    searchTitre: function searchTitre(row, input) {
      console.log('Searching Titre ...', row, input);
      return input && row.titre && row.titre.includes(input);
    },
    searchDescription: function searchDescription(row, input) {
      console.log('Searching Description ...', row, input);
      return input && row.description && row.description.includes(input);
    },
    searchDefault: function searchDefault(row, input) {
      console.log('Searching Default ...', row, input);
      return true;
    },
    columnTdAttrs: function columnTdAttrs(row, column) {
      if (row.id === 'Total') {
        if (column.label === 'ID') {
          return {
            colspan: 4,
            "class": 'has-text-weight-bold',
            style: {
              'text-align': 'left !important'
            }
          };
        } else if (column.label === 'Gender') {
          return {
            "class": 'has-text-weight-semibold'
          };
        } else {
          return {
            style: {
              display: 'none'
            }
          };
        }
      }

      return null;
    }
  },
  computed: {
    detailsAgenceText: function detailsAgenceText() {
      if (this.stat_agence) {
        return this.stat_agence.intitule;
      }

      return "";
    },
    detailsPeriodText: function detailsPeriodText() {
      if (this.stat_period) {
        return this.stat_period;
      }

      return "";
    },
    transitionName: function transitionName() {
      if (this.useTransition) {
        return 'fade';
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/dashboard/details-inner.vue?vue&type=template&id=b6632dbe&scoped=true&":
/*!*********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/dashboard/details-inner.vue?vue&type=template&id=b6632dbe&scoped=true& ***!
  \*********************************************************************************************************************************************************************************************************************************/
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
  return _c(
    "section",
    [
      _c("p", [
        _c("small", [_c("strong", [_vm._v(_vm._s(_vm.detailsAgenceText))])]),
        _vm._v(" "),
        _c("br"),
        _vm._v(" "),
        _c("small", [_vm._v(_vm._s(_vm.detailsPeriodText))]),
      ]),
      _vm._v(" "),
      _c(
        "b-field",
        { attrs: { grouped: "", "group-multiline": "" } },
        [
          _c(
            "b-select",
            {
              attrs: { disabled: !_vm.isPaginated },
              model: {
                value: _vm.perPage,
                callback: function ($$v) {
                  _vm.perPage = $$v
                },
                expression: "perPage",
              },
            },
            [
              _c("option", { attrs: { value: "5" } }, [_vm._v("5 par page")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "10" } }, [_vm._v("10 par page")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "15" } }, [_vm._v("15 par page")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "20" } }, [_vm._v("20 par page")]),
            ]
          ),
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "b-table",
        {
          ref: "table",
          attrs: {
            data: _vm.statdetails,
            "debounce-search": 1000,
            paginated: _vm.isPaginated,
            "per-page": _vm.perPage,
            "opened-detailed": _vm.defaultOpenedDetails,
            detailed: "",
            "detail-key": "id",
            "detail-transition": _vm.transitionName,
            "show-detail-icon": _vm.showDetailIcon,
            "current-page": _vm.currentPage,
            "pagination-simple": _vm.isPaginationSimple,
            "pagination-position": _vm.paginationPosition,
            "default-sort-direction": _vm.defaultSortDirection,
            "pagination-rounded": _vm.isPaginationRounded,
            "sort-icon": _vm.sortIcon,
            "sort-icon-size": _vm.sortIconSize,
            "sticky-header": _vm.stickyHeaders,
            "default-sort": "row.name",
            "aria-next-label": "Suivant",
            "aria-previous-label": "Precedent",
            "aria-page-label": "Page",
            "aria-current-label": "Current page",
            "before-destroy": false,
          },
          on: {
            "update:currentPage": function ($event) {
              _vm.currentPage = $event
            },
            "update:current-page": function ($event) {
              _vm.currentPage = $event
            },
          },
          scopedSlots: _vm._u([
            {
              key: "detail",
              fn: function (props) {
                return [
                  _c(
                    "b-field",
                    { attrs: { grouped: "", "group-multiline": "" } },
                    [
                      _c("div", { staticClass: "form-inline float-left" }, [
                        _c(
                          "span",
                          { staticClass: "help-inline pr-1 text-sm" },
                          [_vm._v(" eSIM(s) attribuee(s) ")]
                        ),
                      ]),
                    ]
                  ),
                  _vm._v(" "),
                  _c("hr"),
                  _vm._v(" "),
                  props.row.esimsattributed
                    ? _c("esimsListDetails", {
                        attrs: { esims_prop: props.row.esimsattributed },
                      })
                    : _vm._e(),
                ]
              },
            },
            {
              key: "empty",
              fn: function () {
                return [
                  _c("div", { staticClass: "has-text-centered" }, [
                    _vm._v("Aucune Données"),
                  ]),
                ]
              },
              proxy: true,
            },
          ]),
        },
        [
          _vm._l(_vm.columns, function (column) {
            return [
              _c(
                "b-table-column",
                _vm._b(
                  {
                    key: column.id,
                    attrs: { sortable: column.sortable },
                    scopedSlots: _vm._u(
                      [
                        column.searchable && !column.numeric
                          ? {
                              key: "searchable",
                              fn: function (props) {
                                return [
                                  _c("b-input", {
                                    attrs: {
                                      placeholder: "Rech...",
                                      icon: "magnify",
                                      size: "is-small",
                                      "icon-right": "close-circle",
                                      "icon-right-clickable": "",
                                    },
                                    on: {
                                      "icon-right-click": function ($event) {
                                        props.filters[props.column.field] = ""
                                      },
                                    },
                                    model: {
                                      value: props.filters[props.column.field],
                                      callback: function ($$v) {
                                        _vm.$set(
                                          props.filters,
                                          props.column.field,
                                          $$v
                                        )
                                      },
                                      expression:
                                        "props.filters[props.column.field]",
                                    },
                                  }),
                                ]
                              },
                            }
                          : null,
                        {
                          key: "default",
                          fn: function (props) {
                            return [
                              column.field === "id"
                                ? _c("span", { staticClass: "text-xs" }, [
                                    _vm._v(
                                      "\n                        " +
                                        _vm._s(props.row[column.field]) +
                                        "\n                    "
                                    ),
                                  ])
                                : column.field === "name"
                                ? _c(
                                    "span",
                                    {
                                      staticClass:
                                        "has-text-primary is-italic text-xs",
                                    },
                                    [
                                      _c(
                                        "a",
                                        {
                                          on: {
                                            click: function ($event) {
                                              return _vm.showUser(props.row)
                                            },
                                          },
                                        },
                                        [
                                          _vm._v(
                                            "\n                            " +
                                              _vm._s(props.row[column.field]) +
                                              "\n                        "
                                          ),
                                        ]
                                      ),
                                    ]
                                  )
                                : column.field === "esimsattributed"
                                ? _c(
                                    "span",
                                    [
                                      _c(
                                        "b-taglist",
                                        [
                                          _c(
                                            "b-tag",
                                            {
                                              attrs: {
                                                type: "is-primary is-light",
                                              },
                                            },
                                            [
                                              _vm._v(
                                                _vm._s(
                                                  props.row.esimsattributed
                                                    .length
                                                )
                                              ),
                                            ]
                                          ),
                                        ],
                                        1
                                      ),
                                    ],
                                    1
                                  )
                                : column.field === "departement"
                                ? _c(
                                    "span",
                                    {
                                      staticClass:
                                        "has-text-info is-italic text-xs",
                                    },
                                    [
                                      props.row.employe.departement
                                        ? _c("span", [
                                            _vm._v(
                                              "\n                            " +
                                                _vm._s(
                                                  props.row.employe.departement
                                                    .intitule
                                                ) +
                                                "\n                        "
                                            ),
                                          ])
                                        : _vm._e(),
                                    ]
                                  )
                                : _c("span", { staticClass: "text-xs" }, [
                                    _vm._v(
                                      "\n                        " +
                                        _vm._s(props.row[column.field]) +
                                        "\n                    "
                                    ),
                                  ]),
                            ]
                          },
                        },
                      ],
                      null,
                      true
                    ),
                  },
                  "b-table-column",
                  column,
                  false
                )
              ),
            ]
          }),
        ],
        2
      ),
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/dashboard/details-inner.vue":
/*!********************************************************!*\
  !*** ./resources/js/views/dashboard/details-inner.vue ***!
  \********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _details_inner_vue_vue_type_template_id_b6632dbe_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./details-inner.vue?vue&type=template&id=b6632dbe&scoped=true& */ "./resources/js/views/dashboard/details-inner.vue?vue&type=template&id=b6632dbe&scoped=true&");
/* harmony import */ var _details_inner_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./details-inner.vue?vue&type=script&lang=js& */ "./resources/js/views/dashboard/details-inner.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _details_inner_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _details_inner_vue_vue_type_template_id_b6632dbe_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _details_inner_vue_vue_type_template_id_b6632dbe_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "b6632dbe",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/dashboard/details-inner.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/dashboard/details-inner.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/views/dashboard/details-inner.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_details_inner_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./details-inner.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/dashboard/details-inner.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_details_inner_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/dashboard/details-inner.vue?vue&type=template&id=b6632dbe&scoped=true&":
/*!***************************************************************************************************!*\
  !*** ./resources/js/views/dashboard/details-inner.vue?vue&type=template&id=b6632dbe&scoped=true& ***!
  \***************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_details_inner_vue_vue_type_template_id_b6632dbe_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./details-inner.vue?vue&type=template&id=b6632dbe&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/dashboard/details-inner.vue?vue&type=template&id=b6632dbe&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_details_inner_vue_vue_type_template_id_b6632dbe_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_details_inner_vue_vue_type_template_id_b6632dbe_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);