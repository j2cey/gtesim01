(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[15],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/roles/item-list.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/roles/item-list.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _roles_roleBus__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../roles/roleBus */ "./resources/js/views/roles/roleBus.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: "role-item-list",
  props: {
    list_title_prop: {
      "default": "Roles",
      type: String
    },
    roles_prop: {}
  },
  components: {
    RoleAddUpdate: function RoleAddUpdate() {
      return Promise.resolve(/*! import() */).then(__webpack_require__.bind(null, /*! ./addupdate */ "./resources/js/views/roles/addupdate.vue"));
    },
    RoleItem: function RoleItem() {
      return __webpack_require__.e(/*! import() */ 16).then(__webpack_require__.bind(null, /*! ./item */ "./resources/js/views/roles/item.vue"));
    }
  },
  mounted: function mounted() {
    var _this = this;

    _roles_roleBus__WEBPACK_IMPORTED_MODULE_0__["default"].$on('role_created', function (newrole) {
      _this.roles.push(newrole);

      _this.$emit('role_created', newrole);
    });
  },
  data: function data() {
    return {
      list_title: this.list_title_prop,
      roles: this.roles_prop,
      searchRoles: ""
    };
  },
  methods: {
    createRole: function createRole() {
      _roles_roleBus__WEBPACK_IMPORTED_MODULE_0__["default"].$emit('role_create');
    },
    deleteRole: function deleteRole($event) {
      console.log("role_deleted received at list: ", $event);
      var roleIndex = this.roles.findIndex(function (c) {
        return $event.id === c.id;
      });

      if (roleIndex !== -1) {
        this.roles.splice(roleIndex, 1);
      }
    }
  },
  computed: {
    filteredRoles: function filteredRoles() {
      var _this2 = this;

      var tempRoles = this.roles;

      if (this.searchRoles !== '' && this.searchRoles) {
        tempRoles = tempRoles.filter(function (item) {
          return item.name.toUpperCase().includes(_this2.searchRoles.toUpperCase());
        });
      } // Sorting


      tempRoles = tempRoles.sort(function (a, b) {
        var fa = a.name.toLowerCase(),
            fb = b.name.toLowerCase();

        if (fa > fb) {
          return -1;
        }

        if (fa < fb) {
          return 1;
        }

        return 0;
      });

      if (!this.ascending) {
        tempRoles.reverse();
      } // end Sorting


      return tempRoles;
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/roles/item-list.vue?vue&type=template&id=5f7ba697&scoped=true&":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/roles/item-list.vue?vue&type=template&id=5f7ba697&scoped=true& ***!
  \*************************************************************************************************************************************************************************************************************************/
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
    "div",
    { staticClass: "card collapsed-card" },
    [
      _c("div", { staticClass: "card-header" }, [
        _c(
          "h5",
          {
            staticClass: "btn btn-tool",
            attrs: { type: "button", "data-card-widget": "collapse" },
          },
          [
            _vm._v(
              "\n            " + _vm._s(_vm.list_title) + "\n            "
            ),
            _c("small", { staticClass: "text text-xs" }, [
              _vm._v(
                "\n                " +
                  _vm._s(
                    _vm.searchRoles === ""
                      ? ""
                      : " (" + _vm.filteredRoles.length + ")"
                  ) +
                  "\n            "
              ),
            ]),
          ]
        ),
        _vm._v(" "),
        _c("div", { staticClass: "card-tools" }),
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "card-body table-responsive p-0" }, [
        _c("table", { staticClass: "table table-head-fixed text-nowrap" }, [
          _c("thead", [
            _c("tr", [
              _c("th", [
                _c("div", { staticClass: "row" }, [
                  _c("div", { staticClass: "col-sm-3 col-6" }, [
                    _c(
                      "div",
                      { staticClass: "btn-group" },
                      [
                        _c(
                          "b-button",
                          {
                            attrs: {
                              size: "is-small",
                              type: "is-info is-light",
                            },
                            on: { click: _vm.createRole },
                          },
                          [_vm._v("Ajouter")]
                        ),
                      ],
                      1
                    ),
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-sm-3 col-6" }),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-sm-3 col-6" }),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-sm-3 col-6" }, [
                    _c("div", { staticClass: "btn-group" }, [
                      _c("div", { staticClass: "input-group input-group-sm" }, [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.searchRoles,
                              expression: "searchRoles",
                            },
                          ],
                          staticClass: "form-control form-control-navbar",
                          attrs: {
                            type: "search",
                            placeholder: "Search",
                            "aria-label": "Search",
                          },
                          domProps: { value: _vm.searchRoles },
                          on: {
                            input: function ($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.searchRoles = $event.target.value
                            },
                          },
                        }),
                        _vm._v(" "),
                        _vm._m(0),
                      ]),
                    ]),
                  ]),
                ]),
                _vm._v(" "),
                _vm._m(1),
              ]),
            ]),
          ]),
          _vm._v(" "),
          _c(
            "tbody",
            _vm._l(_vm.filteredRoles, function (role, index) {
              return _vm.filteredRoles
                ? _c("tr", { key: role.id, staticClass: "text text-xs" }, [
                    index < 10
                      ? _c(
                          "td",
                          [
                            role.name
                              ? _c("RoleItem", {
                                  attrs: { role_prop: role },
                                  on: { role_deleted: _vm.deleteRole },
                                })
                              : _vm._e(),
                          ],
                          1
                        )
                      : _vm._e(),
                  ])
                : _vm._e()
            }),
            0
          ),
        ]),
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "card-footer" }),
      _vm._v(" "),
      _c("RoleAddUpdate"),
    ],
    1
  )
}
var staticRenderFns = [
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
        _c("span", { staticClass: "text text-sm" }, [_vm._v("Name")]),
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "col-sm-4 col-6" }, [
        _c("span", { staticClass: "text text-sm" }, [_vm._v("Description")]),
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "col-sm-3 col-6" }, [
        _c("span", { staticClass: "text text-sm" }, [_vm._v("Permission(s)")]),
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "col-sm-2 col-6" }, [
        _c("span", { staticClass: "text text-sm" }),
      ]),
    ])
  },
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/roles/item-list.vue":
/*!************************************************!*\
  !*** ./resources/js/views/roles/item-list.vue ***!
  \************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _item_list_vue_vue_type_template_id_5f7ba697_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./item-list.vue?vue&type=template&id=5f7ba697&scoped=true& */ "./resources/js/views/roles/item-list.vue?vue&type=template&id=5f7ba697&scoped=true&");
/* harmony import */ var _item_list_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./item-list.vue?vue&type=script&lang=js& */ "./resources/js/views/roles/item-list.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _item_list_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _item_list_vue_vue_type_template_id_5f7ba697_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _item_list_vue_vue_type_template_id_5f7ba697_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "5f7ba697",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/roles/item-list.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/roles/item-list.vue?vue&type=script&lang=js&":
/*!*************************************************************************!*\
  !*** ./resources/js/views/roles/item-list.vue?vue&type=script&lang=js& ***!
  \*************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_item_list_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./item-list.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/roles/item-list.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_item_list_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/roles/item-list.vue?vue&type=template&id=5f7ba697&scoped=true&":
/*!*******************************************************************************************!*\
  !*** ./resources/js/views/roles/item-list.vue?vue&type=template&id=5f7ba697&scoped=true& ***!
  \*******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_item_list_vue_vue_type_template_id_5f7ba697_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./item-list.vue?vue&type=template&id=5f7ba697&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/roles/item-list.vue?vue&type=template&id=5f7ba697&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_item_list_vue_vue_type_template_id_5f7ba697_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_item_list_vue_vue_type_template_id_5f7ba697_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);