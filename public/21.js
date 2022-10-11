(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[21],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/users/item.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/users/item.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _userBus__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./userBus */ "./resources/js/views/users/userBus.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: "user-item",
  props: {
    user_prop: {}
  },
  components: {
    RoleDisplay: function RoleDisplay() {
      return __webpack_require__.e(/*! import() */ 13).then(__webpack_require__.bind(null, /*! ../roles/display */ "./resources/js/views/roles/display.vue"));
    },
    StatusDisplay: function StatusDisplay() {
      return __webpack_require__.e(/*! import() */ 3).then(__webpack_require__.bind(null, /*! ../statuses/inline-display */ "./resources/js/views/statuses/inline-display.vue"));
    }
  },
  mounted: function mounted() {
    var _this = this;

    _userBus__WEBPACK_IMPORTED_MODULE_0__["default"].$on('user_updated', function (user) {
      if (_this.user.id === user.id) {
        _this.user = user;
      }
    });
  },
  created: function created() {
    var _this2 = this;

    axios.get('/users.fetchone/' + this.user_prop.id).then(function (_ref) {
      var data = _ref.data;
      return _this2.user = data;
    });
  },
  data: function data() {
    return {
      user: this.user_prop
    };
  },
  methods: {
    editUser: function editUser(user) {
      _userBus__WEBPACK_IMPORTED_MODULE_0__["default"].$emit('user_edit', user);
    },
    deleteUser: function deleteUser(user) {
      var _this3 = this;

      this.$swal({
        title: 'Etes-vous sure ?',
        text: "Vous ne pourrez pas revenir en arrière !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Oui, supprimer !',
        cancelButtonText: 'Annuler'
      }).then(function (result) {
        if (result.value) {
          axios["delete"]("/users/".concat(user.id)).then(function (resp) {
            _this3.$swal({
              html: '<small>Utilisateur supprimé avec succès !</small>',
              icon: 'success',
              timer: 3000
            }).then(function () {
              _this3.$emit('user_deleted', user);
            });
          })["catch"](function (error) {
            window.handleErrors(error);
          });
        }
      });
    }
  },
  computed: {}
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/users/item.vue?vue&type=template&id=53a7c7f9&scoped=true&":
/*!********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/users/item.vue?vue&type=template&id=53a7c7f9&scoped=true& ***!
  \********************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "row" }, [
    _c("div", { staticClass: "col-sm-3 col-6 border-right" }, [
      _c("span", { staticClass: "text text-sm" }, [
        _vm._v(_vm._s(_vm.user.name)),
      ]),
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "col-sm-3 col-6 border-right" }, [
      _c("span", { staticClass: "text text-xs" }, [
        _vm._v(_vm._s(_vm.user.email)),
      ]),
    ]),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "col-sm-2 col-6 border-right" },
      _vm._l(_vm.user.roles, function (role) {
        return _vm.user.roles
          ? _c(
              "div",
              { key: role.id },
              [_c("RoleDisplay", { attrs: { role_prop: role } })],
              1
            )
          : _vm._e()
      }),
      0
    ),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "col-sm-2 col-6 border-right" },
      [
        _vm.user.status
          ? _c("StatusDisplay", {
              key: _vm.user.id,
              attrs: {
                model_type_prop: _vm.user.model_type,
                model_id_prop: _vm.user.id,
                status_prop: _vm.user.status,
              },
            })
          : _vm._e(),
      ],
      1
    ),
    _vm._v(" "),
    _c("div", { staticClass: "col-sm-2 col-6" }, [
      _c("span", { staticClass: "text text-xs text-center" }, [
        _c(
          "a",
          {
            staticClass: "text text-success",
            on: {
              click: function ($event) {
                return _vm.editUser(_vm.user)
              },
            },
          },
          [
            _c("i", {
              staticClass: "fa fa-pencil-square-o",
              attrs: { "aria-hidden": "true" },
            }),
          ]
        ),
      ]),
      _vm._v(" "),
      _c("span", { staticClass: "text text-xs text-center" }, [
        _c(
          "a",
          {
            staticClass: "text text-danger",
            on: {
              click: function ($event) {
                return _vm.deleteUser(_vm.user)
              },
            },
          },
          [
            _c("i", {
              staticClass: "fa fa-trash",
              attrs: { "aria-hidden": "true" },
            }),
          ]
        ),
      ]),
    ]),
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/users/item.vue":
/*!*******************************************!*\
  !*** ./resources/js/views/users/item.vue ***!
  \*******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _item_vue_vue_type_template_id_53a7c7f9_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./item.vue?vue&type=template&id=53a7c7f9&scoped=true& */ "./resources/js/views/users/item.vue?vue&type=template&id=53a7c7f9&scoped=true&");
/* harmony import */ var _item_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./item.vue?vue&type=script&lang=js& */ "./resources/js/views/users/item.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _item_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _item_vue_vue_type_template_id_53a7c7f9_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _item_vue_vue_type_template_id_53a7c7f9_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "53a7c7f9",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/users/item.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/users/item.vue?vue&type=script&lang=js&":
/*!********************************************************************!*\
  !*** ./resources/js/views/users/item.vue?vue&type=script&lang=js& ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_item_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./item.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/users/item.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_item_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/users/item.vue?vue&type=template&id=53a7c7f9&scoped=true&":
/*!**************************************************************************************!*\
  !*** ./resources/js/views/users/item.vue?vue&type=template&id=53a7c7f9&scoped=true& ***!
  \**************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_item_vue_vue_type_template_id_53a7c7f9_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./item.vue?vue&type=template&id=53a7c7f9&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/users/item.vue?vue&type=template&id=53a7c7f9&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_item_vue_vue_type_template_id_53a7c7f9_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_item_vue_vue_type_template_id_53a7c7f9_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);