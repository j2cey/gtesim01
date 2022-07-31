<template>
    <div class="card-comment">
        <!-- User image -->
        <img class="img-circle img-sm" src="/images/default-user-image.png" alt="User Image">

        <div class="comment-text">
                    <span class="username">
                      Maria Gonzales
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
            It is a long established fact that a reader will be distracted
            by the readable content of a page when looking at its layout.
        </div>
        <!-- /.comment-text -->
    </div>
    <!-- /.card-comment -->
</template>

<script>
    import CommentBus from "./commentBus";
    class Comment {
        constructor(comment) {
            this.comment_text = comment.comment_text || ''
            this.commentable_type = comment.commentable_type || ''
            this.commentable_id = comment.commentable_id || ''
            this.posi = comment.posi || ''
        }
    }
    export default {
        name: "comment-item",
        props: {
            comment_prop: null,
            commentable_type_prop: '',
            commentable_id_prop: ''
        },
        data() {
            return {
                comment: this.comment_prop,
                commentable_type: this.commentable_type_prop,
                commentable_id: this.commentable_id_prop,
                commentForm: new Form(new Comment({})),
            }
        },
        mounted() {
            CommentBus.$on('comment_updated', (upd_data) => {
                if (this.comment.id === upd_data.comment.id) {
                    this.updateComment(upd_data.comment)
                }
            })
        },
        methods: {
            initCommentForm() {
                this.comment.commentable_type = this.commentable_type_prop
                this.comment.commentable_id = this.commentable_id_prop
                this.commentForm = new Form(this.comment)
            },
            editComment(comment,modelType, modelId) {
                CommentBus.$emit('comment_edit', comment,modelType,modelId)
            },
            updateComment(comment) {
                window.noty({
                    message: 'Comment successfully deleted',
                    type: 'success'
                })
                this.comment = comment
            },
            deleteComment(comment) {
                this.$swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if(result.value) {
                        this.initCommentForm();
                        this.commentForm
                            .put(`/comments/remove/${this.comment.uuid}`, undefined)
                            .then(resp => {
                                this.$parent.$emit('comment_deleted', comment)
                            }).catch(error => {
                            window.handleErrors(error)
                        })
                    }
                })
            }
        },
        computed: {
        }
    }
</script>

<style scoped>

</style>
