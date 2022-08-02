<template>
    <div class="container max-w-3xl mx-auto tw-p-0 bg-grey-lightest font-nunito py-4 px-5">
        <div class="bg-white rounded shadow-sm p-8 mb-4">
            <div class="mb-4">
                <h5 class="text-black">Commentaires</h5>
            </div>
            <textarea v-model="commentForm.comment_text" placeholder="Laissez un commentaire" style="min-width: 50%; min-height: 5px;"
                class="bg-grey-lighter rounded leading-normal resize-none w-full py-2 px-3"
                :class="[state === 'editing' ? 'h-24' : 'h-10']" @focus="startEditing">
            </textarea>
            <div v-show="state === 'editing'" class="mt-3">
                <b-button size="is-small" class="border border-blue bg-blue text-white hover:bg-blue-dark py-2 px-4 rounded tracking-wide mr-1" @click="saveComment">Valider</b-button>
                <b-button size="is-small" class="border border-grey-darker text-grey-darker hover:bg-grey-dark hover:text-white py-2 px-4 rounded tracking-wide ml-1" @click="stopEditing">Annuler</b-button>
            </div>
        </div>

        <div class="bg-white rounded shadow-sm p-8">
            <comment v-for="(comment, index) in comments"
                    :key="comment.id"
                    :user="user"
                    :comment="comment"
                    :class="[index === comments.length - 1 ? '' : 'mb-3']"
                    @comment-updated="updateComment($event)"
                    @comment-deleted="deleteComment($event)">
            </comment>
        </div>
    </div>
</template>

<script>
    const local_comments = [
        {
            id: 1,
            comment_text: "How's it going?",
            edited: false,
            created_at: new Date().toLocaleString(),
            author: {
                id: 1,
                name: 'Nick Basile',
            }
        },
        {
            id: 2,
            comment_text: "Pretty good. Just making a painting.",
            edited: false,
            created_at: new Date().toLocaleString(),
            author: {
                id: 2,
                name: 'Bob Ross',
            }
        }
    ]

    import comment from './CommentItem'

    class Comment {
        constructor(comment) {
            this.commentable_type = comment.commentable_type || ''
            this.commentable_id = comment.commentable_id || ''
            this.comment_text = comment.comment_text || ''
        }
    }
    export default {
        name: "comments-manager",
        props: {
            user_prop: {
                required: true,
                type: Object,
            },
            comments_prop: [],
            commentable_type_prop: "",
            commentable_id_prop: 0
        },
        components: {
            comment
        },
        data() {
            return {
                state: 'default',
                user: this.user_prop,
                comments: this.comments_prop,
                commentForm: new Form(new Comment({
                    commentable_type: this.commentable_type_prop,
                    commentable_id: this.commentable_id_prop,
                    comment_text: '',
                })),
            }
        },
        methods: {
            startEditing() {
                this.state = 'editing';
            },
            stopEditing() {
                this.state = 'default';
                this.commentForm.comment_text = '';
            },
            saveComment() {
                const t = this;

                this.commentForm
                    .post('/comments')
                    .then(resp => {

                        console.log("comment created: ", resp)
                        t.comments.unshift(resp);

                        this.stopEditing();

                    }).catch(error => {
                    this.loading = false
                });
            },
            updateComment($event) {
                const t = this;
                let updateForm = new Form(new Comment({
                        commentable_type: this.commentable_type_prop,
                        commentable_id: this.commentable_id_prop,
                        comment_text: $event.comment_text,
                        author: $event.author,
                        id: $event.id,
                        uuid: $event.uuid,
                    }));
                updateForm.put(`/comments/${$event.uuid}`, undefined)
                .then(resp => {
                    console.log("comment updated: ", resp)
                    t.comments[t.commentIndex($event.id)].comment_text = resp.comment_text;
                })
            },
            deleteComment($event) {
                const t = this;
                axios.delete(`/comments/${$event.uuid}`)
                    .then(() => {
                        t.comments.splice(t.commentIndex($event.id), 1);
                    })
            },
            commentIndex(commentId) {
                return this.comments.findIndex((element) => {
                    return element.id === commentId;
                });
            }
        }
    }
</script>

<style scoped>

</style>
