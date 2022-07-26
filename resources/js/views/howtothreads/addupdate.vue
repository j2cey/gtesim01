<template>
    <div class="modal fade" id="addUpdateHowToThread" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-sm" id="howtothreadModalLabel">{{ formTitle }}</h5>
                    <button type="button" class="close" @click="closeForm()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" @submit.prevent @keydown="howtothreadForm.errors.clear()">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label text-xs">Titre</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control text-xs" id="title" name="title" autocomplete="title" autofocus placeholder="Titre" v-model="howtothreadForm.title">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="howtothreadForm.errors.has('title')" v-text="howtothreadForm.errors.get('title')"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="code" class="col-sm-2 col-form-label text-xs">Code</label>
                                <div class="col-sm-10">
                                    <input readonly disabled type="text" class="form-control text-xs" id="code" name="code" autocomplete="code" autofocus placeholder="Code" v-model="howtothreadForm.code">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="howtothreadForm.errors.has('code')" v-text="howtothreadForm.errors.get('code')"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label text-xs">Description</label>
                                <div class="col-sm-10">
                                    <input @keyup.enter="formKeyEnter()" type="text" class="form-control text-xs" id="description" name="posi" required autocomplete="description" autofocus placeholder="Description" v-model="howtothreadForm.description">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="howtothreadForm.errors.has('description')" v-text="howtothreadForm.errors.get('description')"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <b-field label="Tags" class="col" label-position="on-border">
                                    <b-taginput
                                        name="tags"
                                        v-model="howtothreadForm.tags"
                                        :data="filteredTags"
                                        autocomplete
                                        :allow-new="allowNewTag"
                                        :open-on-focus="openOnFocusTag"
                                        field="name.en"
                                        icon="label"
                                        placeholder="Add a tag"
                                        @typing="getFilteredTags"
                                        size="is-small"
                                    >
                                    </b-taginput>
                                </b-field>
                            </div>
                            <div class="form-group row">

                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer justify-content-between">
                    <b-button type="is-dark" size="is-small" @click="closeForm()">Fermer</b-button>
                    <b-button type="is-primary" size="is-small" :loading="loading" @click="updateHowToThread()" :disabled="!isValidCreateForm" v-if="editing">Enregistrer</b-button>
                    <b-button type="is-danger" size="is-small" :loading="loading" @click="createHowToThread()" :disabled="!isValidCreateForm" v-else>Creer Nouveau Tuto</b-button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'
    import HowtothreadBus from "./howtothreadBus";

    class HowToThread {
        constructor(howtothread) {
            this.title = howtothread.title || ''
            this.code = howtothread.code || ''
            this.description = howtothread.description || ''
            this.tags = howtothread.tags || []
        }
    }
    export default {
        name: "howtothread-addupdate",
        props: {
        },
        components: { Multiselect },
        mounted() {
            this.$parent.$on('create_new_howtothread', () => {

                this.editing = false
                this.howtothread = new HowToThread({})
                this.howtothreadForm = new Form(this.howtothread)

                this.formTitle = 'Creer Nouveau Tuto'

                $('#addUpdateHowToThread').modal()
            })

            this.$parent.$on('edit_howtothread', ( howtothread ) => {
                console.log("howtothread to edit", howtothread)
                this.editing = true
                this.howtothread = new HowToThread(howtothread)
                this.howtothreadForm = new Form(this.howtothread)
                this.howtothreadId = howtothread.uuid

                this.formTitle = 'Modifier Tuto'

                $('#addUpdateHowToThread').modal()
            })
        },
        created() {
            axios.get('/tags.fetchall')
                .then(({data}) => this.tags = data);
        },
        data() {
            return {
                formTitle: 'Create HowToThread',
                howtothread: {},
                howtothreadForm: new Form(new HowToThread({})),
                howtothreadId: null,
                editing: false,
                loading: false,
                tags: [],
                filteredTags: this.tags,
                allowNewTag: true,
                openOnFocusTag: true,
            }
        },
        methods: {
            closeForm() {
                this.resetForm()
                $('#addUpdateHowToThread').modal('hide')
            },
            resetForm() {
                this.howtothreadForm.reset();
            },
            formKeyEnter() {
                if (this.editing) {
                    this.updateHowToThread()
                } else {
                    this.createHowToThread()
                }
            },
            createHowToThread() {
                this.loading = true

                this.howtothreadForm
                    .post('/howtothreads')
                    .then(resp => {
                        this.loading = false

                        this.$swal({
                            html: '<small>Tuto créé avec Succes !</small>',
                            icon: 'success',
                            timer: 3000
                        }).then(() => {
                            $('#addUpdateHowToThread').modal('hide')
                            this.$parent.$emit('new_howtothread_created', resp)
                            this.resetForm()
                            window.location = '/howtothreads.show/' + resp.uuid
                        })
                    }).catch(error => {
                    this.loading = false
                });
            },
            updateHowToThread() {
                this.loading = true

                this.howtothreadForm
                    .put(`/howtothreads/${this.howtothreadId}`,undefined)
                    .then(resp => {

                        this.loading = false

                        this.$swal({
                            html: '<small>Tuto modifié avec Succes !</small>',
                            icon: 'success',
                            timer: 3000
                        }).then(() => {
                            HowtothreadBus.$emit('howtothread_updated', resp)
                            $('#addUpdateHowToThread').modal('hide')
                            window.location = '/howtothreads.show/' + resp.uuid
                        })
                    }).catch(error => {
                    this.loading = false
                });
            },
            getFilteredTags(text) {
                //console.log("getFilteredTags", this.tags)
                this.filteredTags = this.tags.filter((option) => {
                    return option.name.en
                        .toString()
                        .toLowerCase()
                        .indexOf(text.toLowerCase()) >= 0
                })
            },
            getType(tag) {
                if (tag.id >= 1 && tag.id < 10) {
                    return 'is-primary'
                } else if (tag.id >= 10 && tag.id < 20) {
                    return 'is-danger'
                } else if (tag.id >= 20 && tag.id < 30) {
                    return 'is-warning'
                } else if (tag.id >= 30 && tag.id < 40) {
                    return 'is-success'
                } else if (tag.id >= 40 && tag.id < 50) {
                    return 'is-info'
                }
            },
            addTag(e) {
                console.log("addTag: ", e)
                /*
                this.howtothreadForm.tags.push({
                    name: e
                })
                */
            }
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
