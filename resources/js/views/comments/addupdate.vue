<template>
    <div class="card-footer">
        <form action="#" method="post">
            <img class="img-fluid img-circle img-sm" src="/images/default-user-image.png" alt="">
            <!-- .img-push is used to add margin to elements next to floating images -->
            <div class="img-push">
                <div class="block">
                    <input type="text" class="form-control form-control-sm" placeholder="Entrez le text puis appuyez la touche ENTRER pour laisser un commentaire">
                    <b-field>
                        <b-radio-button v-model="radioButton"
                                        native-value="Yep"
                                        type="is-success is-light is-outlined">
                            <b-icon icon="check"></b-icon>
                            <span>Yep</span>
                        </b-radio-button>

                        <b-radio-button v-model="radioButton"
                                        native-value="Nope"
                                        type="is-danger is-light is-outlined">
                            <b-icon icon="close"></b-icon>
                            <span>Nope</span>
                        </b-radio-button>
                    </b-field>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import CommentBus from "./commentBus";

    class Comment {
        constructor(comment) {
            this.comment_text = comment.comment_text || ''
            this.commentable_type = comment.commentable_type || ''
            this.commentable_id = comment.commentable_id || ''
        }
    }
    export default {
        name: "comment-addupdate",
        props: {
            commentable_type_prop: '',
            commentable_id_prop: ''
        },
        mounted() {
            CommentBus.$on('comment_create', (modelType, modelId) => {
                if (this.model_type_prop === modelType && this.model_id_prop === modelId) {
                    this.initCommentForm(modelType, modelId)
                }
            })
            CommentBus.$on('comment_edit', (comment, modelType, modelId) => {
                if (this.model_type_prop === modelType && this.model_id_prop === modelId) {
                    this.editing = true
                    this.comment = new Comment(comment)
                    this.commentForm = new Form(this.comment)
                    this.commentId = comment.uuid
                }
            })
        },
        created() {
            this.initCommentForm(this.model_type_prop, this.model_id_prop)
        },
        data() {
            return {
                comment: {},
                modelId: '',
                modelType: '',
                commentForm: new Form(new Comment({})),
                commentId: null,
                editing: false,
                loading: false
            }
        },
        methods: {
            initCommentForm(modelType, modelId) {
                this.editing = false
                this.comment = new Comment({})
                this.comment.model_type = modelType
                this.comment.model_id = modelId
                this.modelType = modelType
                this.modelId = modelId
                this.commentForm = new Form(this.comment)
            },
            createComment(modelType,modelId) {
                this.loading = true
                this.commentForm
                    .post('/comments')
                    .then(comment => {
                        this.loading = false
                        CommentBus.$emit('comment_created', {comment, modelType, modelId})
                    }).catch(error => {
                    this.loading = false
                });
            },
            updateComment(modelType,modelId) {
                this.loading = true
                this.commentForm
                    .put(`/comments/${this.commentId}`, undefined)
                    .then(comment => {
                        this.loading = false
                        this.initCommentForm(this.model_type_prop, this.model_id_prop)
                        CommentBus.$emit('comment_updated', {comment, modelType, modelId})
                    }).catch(error => {
                    this.loading = false
                });
            },
        },
        computed: {
            isValidCreateForm() {
                return !this.loading
            }
        }
    }
</script>

<style scoped>

</style>
