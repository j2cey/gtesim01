(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[1],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/comments/CommentItem.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/comments/CommentItem.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "comment-item",
  props: {
    user: {
      required: true,
      type: Object
    },
    comment: {
      required: true,
      type: Object
    }
  },
  data: function data() {
    return {
      state: 'default',
      data: {
        comment_text: this.comment.comment_text,
        commentable_type: this.comment.commentable_type,
        commentable_id: this.comment.commentable_id
      }
    };
  },
  methods: {
    resetEdit: function resetEdit() {
      this.state = 'default';
      this.data.comment_text = this.comment.comment_text;
    },
    saveEdit: function saveEdit() {
      this.state = 'default';
      this.$emit('comment-updated', {
        'id': this.comment.id,
        'uuid': this.comment.uuid,
        'author': this.comment.author,
        'comment_text': this.data.comment_text
      });
    },
    deleteComment: function deleteComment() {
      this.$emit('comment-deleted', {
        'id': this.comment.id,
        'uuid': this.comment.uuid
      });
    }
  },
  computed: {
    editable: function editable() {
      return this.user.id === this.comment.author.id;
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/comments/CommentsManager.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/comments/CommentsManager.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CommentItem__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CommentItem */ "./resources/js/views/comments/CommentItem.vue");
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
var local_comments = [{
  id: 1,
  comment_text: "How's it going?",
  edited: false,
  created_at: new Date().toLocaleString(),
  author: {
    id: 1,
    name: 'Nick Basile'
  }
}, {
  id: 2,
  comment_text: "Pretty good. Just making a painting.",
  edited: false,
  created_at: new Date().toLocaleString(),
  author: {
    id: 2,
    name: 'Bob Ross'
  }
}];


var Comment = /*#__PURE__*/_createClass(function Comment(comment) {
  _classCallCheck(this, Comment);

  this.commentable_type = comment.commentable_type || '';
  this.commentable_id = comment.commentable_id || '';
  this.comment_text = comment.comment_text || '';
});

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "comments-manager",
  props: {
    user_prop: {
      required: true,
      type: Object
    },
    comments_prop: [],
    commentable_type_prop: "",
    commentable_id_prop: 0
  },
  components: {
    comment: _CommentItem__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  data: function data() {
    return {
      state: 'default',
      user: this.user_prop,
      comments: this.comments_prop,
      commentForm: new Form(new Comment({
        commentable_type: this.commentable_type_prop,
        commentable_id: this.commentable_id_prop,
        comment_text: ''
      }))
    };
  },
  methods: {
    startEditing: function startEditing() {
      this.state = 'editing';
    },
    stopEditing: function stopEditing() {
      this.state = 'default';
      this.commentForm.comment_text = '';
    },
    saveComment: function saveComment() {
      var _this = this;

      var t = this;
      this.commentForm.post('/comments').then(function (resp) {
        console.log("comment created: ", resp);
        t.comments.unshift(resp);

        _this.stopEditing();
      })["catch"](function (error) {
        _this.loading = false;
      });
    },
    updateComment: function updateComment($event) {
      var t = this;
      var updateForm = new Form(new Comment({
        commentable_type: this.commentable_type_prop,
        commentable_id: this.commentable_id_prop,
        comment_text: $event.comment_text,
        author: $event.author,
        id: $event.id,
        uuid: $event.uuid
      }));
      updateForm.put("/comments/".concat($event.uuid), undefined).then(function (resp) {
        console.log("comment updated: ", resp);
        t.comments[t.commentIndex($event.id)].comment_text = resp.comment_text;
      });
    },
    deleteComment: function deleteComment($event) {
      var t = this;
      axios["delete"]("/comments/".concat($event.uuid)).then(function () {
        t.comments.splice(t.commentIndex($event.id), 1);
      });
    },
    commentIndex: function commentIndex(commentId) {
      return this.comments.findIndex(function (element) {
        return element.id === commentId;
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/comments/CommentItem.vue?vue&type=template&id=71901754&scoped=true&":
/*!******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/comments/CommentItem.vue?vue&type=template&id=71901754&scoped=true& ***!
  \******************************************************************************************************************************************************************************************************************************/
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
  return _c("div", [
    _c(
      "div",
      {
        directives: [
          {
            name: "show",
            rawName: "v-show",
            value: _vm.state === "default",
            expression: "state === 'default'",
          },
        ],
      },
      [
        _c("div", { staticClass: "flex justify-between mb-1" }, [
          _c(
            "span",
            { staticClass: "text-grey-darkest leading-normal text-sm" },
            [_vm._v(_vm._s(_vm.comment.comment_text))]
          ),
          _vm._v(" "),
          _c("br"),
          _vm._v(" "),
          _vm.editable
            ? _c(
                "button",
                {
                  staticClass:
                    "ml-2 mt-1 mb-auto text-blue hover:text-blue-dark text-sm",
                  on: {
                    click: function ($event) {
                      _vm.state = "editing"
                    },
                  },
                },
                [_vm._v("Modifier")]
              )
            : _vm._e(),
        ]),
        _vm._v(" "),
        _c(
          "div",
          { staticClass: "text-muted text-grey-dark leading-normal text-xs" },
          [
            _c("span", [
              _vm._v(_vm._s(_vm.comment.author.name) + " "),
              _c("span", { staticClass: "mx-1 text-xs" }, [_vm._v("•")]),
              _vm._v(_vm._s(_vm._f("formatDate")(_vm.comment.created_at))),
            ]),
          ]
        ),
      ]
    ),
    _vm._v(" "),
    _c(
      "div",
      {
        directives: [
          {
            name: "show",
            rawName: "v-show",
            value: _vm.state === "editing",
            expression: "state === 'editing'",
          },
        ],
      },
      [
        _vm._m(0),
        _vm._v(" "),
        _c("textarea", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.data.comment_text,
              expression: "data.comment_text",
            },
          ],
          staticClass:
            "bg-grey-lighter rounded leading-normal resize-none w-full h-24 py-2 px-3",
          staticStyle: { "min-width": "50%" },
          attrs: { placeholder: "Update comment" },
          domProps: { value: _vm.data.comment_text },
          on: {
            input: function ($event) {
              if ($event.target.composing) {
                return
              }
              _vm.$set(_vm.data, "comment_text", $event.target.value)
            },
          },
        }),
        _vm._v(" "),
        _c(
          "div",
          { staticClass: "flex flex-col md:flex-row items-center mt-2" },
          [
            _c(
              "b-button",
              {
                staticClass:
                  "border border-blue bg-blue text-white hover:bg-blue-dark py-2 px-4 rounded tracking-wide mb-2 md:mb-0 md:mr-1",
                attrs: { size: "is-small" },
                on: { click: _vm.saveEdit },
              },
              [_vm._v("Valider")]
            ),
            _vm._v(" "),
            _c(
              "b-button",
              {
                staticClass:
                  "border border-grey-darker text-grey-darker hover:bg-grey-dark hover:text-white py-2 px-4 rounded tracking-wide mb-2 md:mb-0 md:ml-1",
                attrs: { size: "is-small" },
                on: { click: _vm.resetEdit },
              },
              [_vm._v("Annuler")]
            ),
            _vm._v(" "),
            _c(
              "b-button",
              {
                staticClass:
                  "text-red hover:bg-red hover:text-white py-2 px-4 rounded tracking-wide mb-2 md:mb-0 md:ml-auto",
                attrs: { size: "is-small" },
                on: { click: _vm.deleteComment },
              },
              [_vm._v("Supprimer")]
            ),
          ],
          1
        ),
      ]
    ),
  ])
}
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "mb-3" }, [
      _c("h5", { staticClass: "text-black text-sm" }, [
        _vm._v("Modifer Commentaire"),
      ]),
    ])
  },
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/comments/CommentsManager.vue?vue&type=template&id=c7b58846&scoped=true&":
/*!**********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/comments/CommentsManager.vue?vue&type=template&id=c7b58846&scoped=true& ***!
  \**********************************************************************************************************************************************************************************************************************************/
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
    {
      staticClass:
        "container max-w-3xl mx-auto tw-p-0 bg-grey-lightest font-nunito py-4 px-5",
    },
    [
      _c("div", { staticClass: "bg-white rounded shadow-sm p-8 mb-4" }, [
        _vm._m(0),
        _vm._v(" "),
        _c("textarea", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.commentForm.comment_text,
              expression: "commentForm.comment_text",
            },
          ],
          staticClass:
            "bg-grey-lighter rounded leading-normal resize-none w-full py-2 px-3",
          class: [_vm.state === "editing" ? "h-24" : "h-10"],
          staticStyle: { "min-width": "50%", "min-height": "5px" },
          attrs: { placeholder: "Laissez un commentaire" },
          domProps: { value: _vm.commentForm.comment_text },
          on: {
            focus: _vm.startEditing,
            input: function ($event) {
              if ($event.target.composing) {
                return
              }
              _vm.$set(_vm.commentForm, "comment_text", $event.target.value)
            },
          },
        }),
        _vm._v(" "),
        _c(
          "div",
          {
            directives: [
              {
                name: "show",
                rawName: "v-show",
                value: _vm.state === "editing",
                expression: "state === 'editing'",
              },
            ],
            staticClass: "mt-3",
          },
          [
            _c(
              "b-button",
              {
                staticClass:
                  "border border-blue bg-blue text-white hover:bg-blue-dark py-2 px-4 rounded tracking-wide mr-1",
                attrs: { size: "is-small" },
                on: { click: _vm.saveComment },
              },
              [_vm._v("Valider")]
            ),
            _vm._v(" "),
            _c(
              "b-button",
              {
                staticClass:
                  "border border-grey-darker text-grey-darker hover:bg-grey-dark hover:text-white py-2 px-4 rounded tracking-wide ml-1",
                attrs: { size: "is-small" },
                on: { click: _vm.stopEditing },
              },
              [_vm._v("Annuler")]
            ),
          ],
          1
        ),
      ]),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "bg-white rounded shadow-sm p-8" },
        _vm._l(_vm.comments, function (comment, index) {
          return _c("comment", {
            key: comment.id,
            class: [index === _vm.comments.length - 1 ? "" : "mb-3"],
            attrs: { user: _vm.user, comment: comment },
            on: {
              "comment-updated": function ($event) {
                return _vm.updateComment($event)
              },
              "comment-deleted": function ($event) {
                return _vm.deleteComment($event)
              },
            },
          })
        }),
        1
      ),
    ]
  )
}
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "mb-4" }, [
      _c("h5", { staticClass: "text-black" }, [_vm._v("Commentaires")]),
    ])
  },
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/comments/CommentItem.vue":
/*!*****************************************************!*\
  !*** ./resources/js/views/comments/CommentItem.vue ***!
  \*****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CommentItem_vue_vue_type_template_id_71901754_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CommentItem.vue?vue&type=template&id=71901754&scoped=true& */ "./resources/js/views/comments/CommentItem.vue?vue&type=template&id=71901754&scoped=true&");
/* harmony import */ var _CommentItem_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CommentItem.vue?vue&type=script&lang=js& */ "./resources/js/views/comments/CommentItem.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _CommentItem_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _CommentItem_vue_vue_type_template_id_71901754_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _CommentItem_vue_vue_type_template_id_71901754_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "71901754",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/comments/CommentItem.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/comments/CommentItem.vue?vue&type=script&lang=js&":
/*!******************************************************************************!*\
  !*** ./resources/js/views/comments/CommentItem.vue?vue&type=script&lang=js& ***!
  \******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CommentItem_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./CommentItem.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/comments/CommentItem.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CommentItem_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/comments/CommentItem.vue?vue&type=template&id=71901754&scoped=true&":
/*!************************************************************************************************!*\
  !*** ./resources/js/views/comments/CommentItem.vue?vue&type=template&id=71901754&scoped=true& ***!
  \************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CommentItem_vue_vue_type_template_id_71901754_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./CommentItem.vue?vue&type=template&id=71901754&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/comments/CommentItem.vue?vue&type=template&id=71901754&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CommentItem_vue_vue_type_template_id_71901754_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CommentItem_vue_vue_type_template_id_71901754_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/views/comments/CommentsManager.vue":
/*!*********************************************************!*\
  !*** ./resources/js/views/comments/CommentsManager.vue ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CommentsManager_vue_vue_type_template_id_c7b58846_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CommentsManager.vue?vue&type=template&id=c7b58846&scoped=true& */ "./resources/js/views/comments/CommentsManager.vue?vue&type=template&id=c7b58846&scoped=true&");
/* harmony import */ var _CommentsManager_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CommentsManager.vue?vue&type=script&lang=js& */ "./resources/js/views/comments/CommentsManager.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _CommentsManager_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _CommentsManager_vue_vue_type_template_id_c7b58846_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _CommentsManager_vue_vue_type_template_id_c7b58846_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "c7b58846",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/comments/CommentsManager.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/comments/CommentsManager.vue?vue&type=script&lang=js&":
/*!**********************************************************************************!*\
  !*** ./resources/js/views/comments/CommentsManager.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CommentsManager_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./CommentsManager.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/comments/CommentsManager.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CommentsManager_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/comments/CommentsManager.vue?vue&type=template&id=c7b58846&scoped=true&":
/*!****************************************************************************************************!*\
  !*** ./resources/js/views/comments/CommentsManager.vue?vue&type=template&id=c7b58846&scoped=true& ***!
  \****************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CommentsManager_vue_vue_type_template_id_c7b58846_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./CommentsManager.vue?vue&type=template&id=c7b58846&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/comments/CommentsManager.vue?vue&type=template&id=c7b58846&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CommentsManager_vue_vue_type_template_id_c7b58846_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CommentsManager_vue_vue_type_template_id_c7b58846_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);