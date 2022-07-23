<template>
    <div class="modal fade" id="addUpdateHowTo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-sm" id="howtoModalLabel">{{ formTitle }}</h5>
                    <button type="button" class="close" @click="closeForm()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" @submit.prevent @keydown="howtoForm.errors.clear()">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label text-xs">Titre</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control text-xs" id="title" name="title" autocomplete="title" autofocus placeholder="Titre" v-model="howtoForm.title">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="howtoForm.errors.has('title')" v-text="howtoForm.errors.get('title')"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="m_select_howtotype" class="col-sm-2 col-form-label text-xs">Type</label>
                                <div class="col-sm-10 text-xs">
                                    <multiselect
                                        id="m_select_howtotype"
                                        v-model="howtoForm.howtotype"
                                        selected.sync="howto.howtotype"
                                        value=""
                                        :options="howtotypes"
                                        :searchable="true"
                                        :multiple="false"
                                        label="title"
                                        track-by="id"
                                        key="id"
                                        placeholder="Type"
                                    >
                                    </multiselect>
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="howtoForm.errors.has('roles')" v-text="howtoForm.errors.get('howtotype')"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="code" class="col-sm-2 col-form-label text-xs">Code</label>
                                <div class="col-sm-10">
                                    <input readonly disabled type="text" class="form-control text-xs" id="code" name="code" autocomplete="code" autofocus placeholder="Code" v-model="howtoForm.code">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="howtoForm.errors.has('code')" v-text="howtoForm.errors.get('code')"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="view" class="col-sm-2 col-form-label text-xs">Vue</label>
                                <div class="col-sm-10">
                                    <input @keyup.enter="formKeyEnter()" type="text" class="form-control text-xs" id="view" name="posi" required autocomplete="view" autofocus placeholder="Vue" v-model="howtoForm.view">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="howtoForm.errors.has('view')" v-text="howtoForm.errors.get('view')"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label text-xs">Description</label>
                                <div class="col-sm-10">
                                    <input @keyup.enter="formKeyEnter()" type="text" class="form-control text-xs" id="description" name="posi" required autocomplete="description" autofocus placeholder="Description" v-model="howtoForm.description">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="howtoForm.errors.has('description')" v-text="howtoForm.errors.get('description')"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <b-field label="Tags" class="col" label-position="on-border">
                                    <b-taginput
                                        name="tags"
                                        v-model="howtoForm.tags"
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
                    <b-button type="is-primary" size="is-small" :loading="loading" @click="updateHowTo()" :disabled="!isValidCreateForm" v-if="editing">Enregistrer</b-button>
                    <b-button type="is-danger" size="is-small" :loading="loading" @click="createHowTo()" :disabled="!isValidCreateForm" v-else>Creer Nouvelle Rubrique</b-button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'
    import HowtoBus from "./howtoBus";

    class HowTo {
        constructor(howto) {
            this.title = howto.title || ''
            this.code = howto.code || ''
            this.view = howto.view || ''
            this.description = howto.description || ''
            this.howtotype = howto.howtotype || {}
            this.tags = howto.tags || []
        }
    }
    export default {
        name: "howto-addupdate",
        props: {
        },
        components: { Multiselect },
        mounted() {
            this.$parent.$on('create_new_howto', () => {

                this.editing = false
                this.howto = new HowTo({})
                this.howtoForm = new Form(this.howto)

                this.formTitle = 'Creer Nouvelle Rubrique'

                $('#addUpdateHowTo').modal()
            })

            this.$parent.$on('edit_howto', ( howto ) => {
                console.log("howto to edit", howto)
                this.editing = true
                this.howto = new HowTo(howto)
                this.howtoForm = new Form(this.howto)
                this.howtoId = howto.uuid

                this.formTitle = 'Modifier Rubrique'

                $('#addUpdateHowTo').modal()
            })
        },
        created() {
            axios.get('/howtotypes.fetchall')
                .then(({data}) => this.howtotypes = data);
            axios.get('/tags.fetchall')
                .then(({data}) => this.tags = data);
        },
        data() {
            return {
                formTitle: 'Create HowToStep',
                howto: {},
                howtoForm: new Form(new HowTo({})),
                howtoId: null,
                editing: false,
                loading: false,
                howtotypes: [],
                tags: [],
                filteredTags: this.tags,
                allowNewTag: true,
                openOnFocusTag: true,
            }
        },
        methods: {
            closeForm() {
                this.resetForm()
                $('#addUpdateHowTo').modal('hide')
            },
            resetForm() {
                this.howtoForm.reset();
            },
            formKeyEnter() {
                if (this.editing) {
                    this.updateHowTo()
                } else {
                    this.checkBeforeCreate()
                }
            },
            createHowTo() {
                this.loading = true

                this.howtoForm
                    .post('/howtos')
                    .then(resp => {
                        this.loading = false

                        this.$swal({
                            html: '<small>Rubrique créée avec Succes !</small>',
                            icon: 'success',
                            timer: 3000
                        }).then(() => {
                            $('#addUpdateHowTo').modal('hide')
                            this.$parent.$emit('new_howto_created', resp)
                            this.resetForm()
                            window.location = '/howtos.edithtml/' + resp.id
                        })
                    }).catch(error => {
                    this.loading = false
                });
            },
            updateHowTo() {
                this.loading = true

                this.howtoForm
                    .put(`/howtos/${this.howtoId}`,undefined)
                    .then(resp => {

                        this.loading = false

                        this.$swal({
                            html: '<small>Rubrique modifiée avec Succes !</small>',
                            icon: 'success',
                            timer: 3000
                        }).then(() => {
                            HowtoBus.$emit('howto_updated', resp)
                            $('#addUpdateHowTo').modal('hide')
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
                this.howtoForm.tags.push({
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
