<template>
    <div class="modal fade" id="addUpdateHowtoStep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-sm" id="howtostepModalLabel">{{ formTitle }}</h5>
                    <button type="button" class="close" @click="closeForm()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" @submit.prevent @keydown="howtostepForm.errors.clear()">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label text-xs">Titre</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control text-xs" id="title" name="title" autocomplete="title" autofocus placeholder="Titre" v-model="howtostepForm.title">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="howtostepForm.errors.has('title')" v-text="howtostepForm.errors.get('title')"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="code" class="col-sm-2 col-form-label text-xs">Code</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control text-xs" id="code" name="code" autocomplete="code" autofocus placeholder="Code" v-model="howtostepForm.code">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="howtostepForm.errors.has('code')" v-text="howtostepForm.errors.get('code')"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="posi" class="col-sm-2 col-form-label text-xs">Position</label>
                                <div class="col-sm-10">
                                    <input @keyup.enter="formKeyEnter()" type="text" class="form-control text-xs" id="posi" name="posi" required autocomplete="posi" autofocus placeholder="Position" v-model="howtostepForm.posi">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="howtostepForm.errors.has('posi')" v-text="howtostepForm.errors.get('posi')"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label text-xs">E-mail</label>
                                <div class="col-sm-10">
                                    <input @keyup.enter="formKeyEnter()" type="text" class="form-control text-xs" id="email" name="email" required autocomplete="email" autofocus placeholder="email" v-model="howtostepForm.email">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="howtostepForm.errors.has('email')" v-text="howtostepForm.errors.get('email')"></span>
                                </div>
                            </div>
                            <div class="form-group">
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer justify-content-between">
                    <b-button type="is-dark" size="is-small" @click="closeForm()">Fermer</b-button>
                    <b-button type="is-primary" size="is-small" :loading="loading" @click="updateHowtoStep()" :disabled="!isValidCreateForm" v-if="editing">Enregistrer</b-button>
                    <b-button type="is-danger" size="is-small" :loading="loading" @click="createHowtoStep()" :disabled="!isValidCreateForm" v-else>Creer Nouveau Truc & Astuce</b-button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'
    import HowtoStepBus from "./howtostepBus";

    class HowtoStep {
        constructor(howtostep) {
            this.title = howtostep.title || ''
            this.code = howtostep.code || ''
            this.numero_telephone = howtostep.numero_telephone || ''
            this.email = howtostep.email || ''
            this.esim_id = howtostep.esim_id || ''
            this.client_matched_selected = howtostep.client_matched_selected || null
        }
    }
    export default {
        name: "howtostep-addupdate",
        props: {
        },
        components: { Multiselect },
        mounted() {
            this.$parent.$on('create_new_howtostep', () => {

                console.log("create_new_howtostep ", esim_id)

                this.editing = false
                this.howtostep = new HowtoStep({
                    'esim_id': esim_id
                })
                this.howtostepForm = new Form(this.howtostep)

                this.formTitle = 'Creer Nouvelle Rubrique'

                $('#addUpdateHowtoStep').modal()
            })

            this.$parent.$on('edit_howtostep', ( howtostep ) => {
                this.editing = true
                this.howtostep = new HowtoStep(howtostep)
                this.howtostepForm = new Form(this.howtostep)
                this.howtostepId = howtostep.uuid

                this.formTitle = 'Modifier Client'

                $('#addUpdateHowtoStep').modal()
            })
        },
        created() {

        },
        data() {
            return {
                formTitle: 'Create HowtoStep',
                howtostep: {},
                howtostepForm: new Form(new HowtoStep({})),
                howtostepFormCheck: new Form(new HowtoStep({})),
                howtostepId: null,
                editing: false,
                loading: false,
                howtosteptypes: [],
                clientsMatched: [],
                searchClientsMatched: "",
            }
        },
        methods: {
            closeForm() {
                this.resetForm()
                $('#addUpdateHowtoStep').modal('hide')
            },
            resetForm() {

                //this.howtostepForm.client_matched_selected = null;
                this.howtostepForm.reset();
            },
            resetClientsMatched() {
                this.clientsMatched = [];
                this.resetClientsMatchedSelected();
            },
            resetClientsMatchedSelected() {
                this.howtostepForm.client_matched_selected = null;
            },
            formKeyEnter() {
                if (this.editing) {
                    this.updateHowtoStep()
                } else if(this.clientsMatched.length > 0) {
                    this.createHowtoStep()
                } else {
                    this.checkBeforeCreate()
                }
            },
            checkBeforeCreate() {
                this.loading = true
                this.howtostep = {
                    'nom_raison_sociale': this.howtostepForm.nom_raison_sociale,
                    'prenom': this.howtostepForm.prenom,
                    'numero_telephone': this.howtostepForm.numero_telephone,
                    'email': this.howtostepForm.email,
                    'esim_id': this.howtostepForm.esim_id,
                    'client_matched_selected': this.howtostepForm.client_matched_selected
                }
                this.howtostepFormCheck = new Form(this.howtostep)

                this.howtostepForm
                    .post('/howtosteps.checkbeforecreate')
                    .then(resp => {
                        this.loading = false

                        if (resp.data.action_type === 1) {
                            this.clientsMatched = resp.data.val
                            this.howtostepForm = this.howtostepFormCheck
                        } else {
                            this.clientSuccessfullyCreated(resp.data.val)
                        }
                    }).catch(error => {
                    this.loading = false
                });
            },
            createHowtoStep() {
                this.loading = true

                this.howtostepForm
                    .post('/howtosteps')
                    .then(resp => {
                        this.loading = false
                        //this.$parent.$emit('new_howtostep_created', newhowtostep)
                        this.clientSuccessfullyCreated(resp)
                    }).catch(error => {
                    this.loading = false
                });
            },
            clientSuccessfullyCreated(resp) {
                console.log(resp)
                this.$swal({
                    html: '<small>Client cree avec Succes !</small>',
                    icon: 'success',
                    timer: 3000
                }).then(() => {
                    $('#addUpdateHowtoStep').modal('hide')
                    this.resetForm()
                    let phonenum = resp[1]
                    window.location = '/howtosteps.previewpdf/' + phonenum.id
                })
            },
            updateHowtoStep() {
                this.loading = true

                this.howtostepForm
                    .put(`/howtosteps/${this.howtostepId}`,undefined)
                    .then(updhowtostep => {

                        this.loading = false

                        this.$swal({
                            html: '<small>Client modife avec Succes !</small>',
                            icon: 'success',
                            timer: 3000
                        }).then(() => {
                            HowtoStepBus.$emit('howtostep_updated', updhowtostep)
                            $('#addUpdateHowtoStep').modal('hide')
                        })
                    }).catch(error => {
                    this.loading = false
                });
            },
            clientMatchedSelectChanged() {
                console.log(this.howtostepForm.client_matched_selected)
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
