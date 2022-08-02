<template>
    <div>
        <div v-show="state === 'default'">
            <div class="flex justify-between mb-1">
                <span class="text-grey-darkest leading-normal text-sm">{{comment.comment_text}}</span>
                <br>
                <button v-if="editable" @click="state = 'editing'" class="ml-2 mt-1 mb-auto text-blue hover:text-blue-dark text-sm">Modifier</button>
            </div>
            <div class="text-muted text-grey-dark leading-normal text-xs">
                <span>{{comment.author.name}} <span class="mx-1 text-xs">&bull;</span>{{ comment.created_at | formatDate }}</span>
            </div>
        </div>
        <div v-show="state === 'editing'">
            <div class="mb-3">
                <h5 class="text-black text-sm">Modifer Commentaire</h5>
            </div>
            <textarea v-model="data.comment_text"
                placeholder="Update comment" style="min-width: 50%"
                class="bg-grey-lighter rounded leading-normal resize-none w-full h-24 py-2 px-3">
            </textarea>
            <div class="flex flex-col md:flex-row items-center mt-2">
                <b-button size="is-small" class="border border-blue bg-blue text-white hover:bg-blue-dark py-2 px-4 rounded tracking-wide mb-2 md:mb-0 md:mr-1" @click="saveEdit">Valider</b-button>
                <b-button size="is-small" class="border border-grey-darker text-grey-darker hover:bg-grey-dark hover:text-white py-2 px-4 rounded tracking-wide mb-2 md:mb-0 md:ml-1" @click="resetEdit">Annuler</b-button>
                <b-button size="is-small" class="text-red hover:bg-red hover:text-white py-2 px-4 rounded tracking-wide mb-2 md:mb-0 md:ml-auto" @click="deleteComment">Supprimer</b-button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "comment-item",
        props: {
            user: {
                required: true,
                type: Object,
            },
            comment: {
                required: true,
                type: Object,
            }
        },
        data() {
            return {
                state: 'default',
                data: {
                    comment_text: this.comment.comment_text,
                    commentable_type: this.comment.commentable_type,
                    commentable_id: this.comment.commentable_id,
                }
            }
        },
        methods: {
            resetEdit() {
                this.state = 'default';
                this.data.comment_text = this.comment.comment_text;
            },
            saveEdit() {
                this.state = 'default';
                this.$emit('comment-updated', {
                    'id': this.comment.id,
                    'uuid': this.comment.uuid,
                    'author': this.comment.author,
                    'comment_text': this.data.comment_text,
                });
            },
            deleteComment() {
                this.$emit('comment-deleted', {
                    'id': this.comment.id,
                    'uuid': this.comment.uuid,
                });
            }
        },
        computed: {
            editable() {
                return this.user.id === this.comment.author.id;
            }
        }
    }
</script>

<style scoped>

</style>
