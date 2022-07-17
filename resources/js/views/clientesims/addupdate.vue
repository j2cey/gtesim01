<template>
    <div class="modal fade" id="addUpdateClientEsim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-sm" id="clientesimModalLabel">{{ formTitle }}</h5>
                    <button type="button" class="close" @click="closeForm()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" @submit.prevent @keydown="clientesimForm.errors.clear()" v-if="clientsMatched.length === 0">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="nom_raison_sociale" class="col-sm-2 col-form-label text-xs">Nom / Raison Sociale</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control text-xs" id="nom_raison_sociale" name="nom_raison_sociale" autocomplete="nom_raison_sociale" autofocus placeholder="Nom / Raison Sociale" v-model="clientesimForm.nom_raison_sociale">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="clientesimForm.errors.has('nom_raison_sociale')" v-text="clientesimForm.errors.get('nom_raison_sociale')"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="prenom" class="col-sm-2 col-form-label text-xs">Prenom</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control text-xs" id="prenom" name="prenom" autocomplete="prenom" autofocus placeholder="Prenom" v-model="clientesimForm.prenom">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="clientesimForm.errors.has('prenom')" v-text="clientesimForm.errors.get('prenom')"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="numero_telephone" class="col-sm-2 col-form-label text-xs">Numero Telephone</label>
                                <div class="col-sm-10">
                                    <input @keyup.enter="formKeyEnter()" type="text" class="form-control text-xs" id="numero_telephone" name="numero_telephone" required autocomplete="numero_telephone" autofocus placeholder="Numero Telephone" v-model="clientesimForm.numero_telephone">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="clientesimForm.errors.has('numero_telephone')" v-text="clientesimForm.errors.get('numero_telephone')"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label text-xs">E-mail</label>
                                <div class="col-sm-10">
                                    <input @keyup.enter="formKeyEnter()" type="text" class="form-control text-xs" id="email" name="email" required autocomplete="email" autofocus placeholder="email" v-model="clientesimForm.email">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="clientesimForm.errors.has('email')" v-text="clientesimForm.errors.get('email')"></span>
                                </div>
                            </div>
                            <div class="form-group">
                            </div>
                        </div>
                    </form>

                    <div class="card-body p-0" v-else>
                        <h5 class="tw-text-blue-600 tw-text-sm tw-font-bold tw-mb-3 tw-border-b tw-border-gray-400 tw-pb-2">
                            <span class="text text-align-left">Creer une E-sim pour un client existant</span>
                            <span class="text text-align-right" v-if="clientesimForm.client_matched_selected">
                                <b-button size="is-small" type="is-info is-light" @click="createClientEsim()">Valider</b-button>
                                <b-button size="is-small" type="is-danger is-light" rounded @click="resetClientsMatchedSelected()">Annuler</b-button>
                            </span>
                        </h5>
                        <div class="card-body table-responsive p-0" style="min-height: 200px;">
                            <table class="table m-0">
                                <thead>
                                <tr class="text text-sm">
                                    <th></th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(client, index) in clientsMatched" :key="client.id" class="text text-xs">
                                    <td>
                                        <div class="text border-right">
                                            <b-radio @input="clientMatchedSelectChanged()" v-model="clientesimForm.client_matched_selected" size="is-small" :native-value="client.uuid" type="is-info is-light">
                                            </b-radio>
                                        </div>
                                    </td>
                                    <td><div class="text border-right">{{ client.nom_raison_sociale }}</div></td>
                                    <td><div class="text border-right">{{ client.prenom }}</div></td>
                                    <td>{{ client.created_at | formatDate }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <div class="buttons">
                        <b-button type="is-dark" size="is-small" @click="closeForm()">Fermer</b-button>
                        <b-button type="is-info" size="is-small" rounded @click="resetClientsMatched()" v-if="clientsMatched.length > 0">Retour</b-button>
                    </div>
                    <b-button type="is-primary" size="is-small" :loading="loading" @click="updateClientEsim()" :disabled="!isValidCreateForm" v-if="editing">Enregistrer</b-button>
                    <b-button type="is-primary" size="is-small" :loading="loading" @click="checkBeforeCreate()" :disabled="!isValidCreateForm" v-else-if="clientsMatched.length === 0">Creer Client</b-button>
                    <b-button type="is-danger" size="is-small" :loading="loading" @click="createClientEsim()" :disabled="!isValidCreateForm" v-else-if="! clientesimForm.client_matched_selected">Creer Nouveau Client</b-button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'
    import ClientEsimBus from "./clientesimBus";

    class ClientEsim {
        constructor(clientesim) {
            this.nom_raison_sociale = clientesim.nom_raison_sociale || ''
            this.prenom = clientesim.prenom || ''
            this.numero_telephone = clientesim.numero_telephone || ''
            this.email = clientesim.email || ''
            this.esim_id = clientesim.esim_id || ''
            this.client_matched_selected = clientesim.client_matched_selected || null
        }
    }
    export default {
        name: "clientesim-addupdate",
        props: {
        },
        components: { Multiselect },
        mounted() {
            this.$parent.$on('create_new_clientesim', (esim_id) => {

                console.log("create_new_clientesim ", esim_id)

                this.editing = false
                this.clientesim = new ClientEsim({
                    'esim_id': esim_id
                })
                this.clientesimForm = new Form(this.clientesim)

                this.formTitle = 'Creer Nouveau Client'

                $('#addUpdateClientEsim').modal()
            })

            this.$parent.$on('edit_clientesim', ( clientesim ) => {
                this.editing = true
                this.clientesim = new ClientEsim(clientesim)
                this.clientesimForm = new Form(this.clientesim)
                this.clientesimId = clientesim.uuid

                this.formTitle = 'Modifier Client'

                $('#addUpdateClientEsim').modal()
            })
        },
        created() {

        },
        data() {
            return {
                formTitle: 'Create ClientEsim',
                clientesim: {},
                clientesimForm: new Form(new ClientEsim({})),
                clientesimFormCheck: new Form(new ClientEsim({})),
                clientesimId: null,
                editing: false,
                loading: false,
                clientesimtypes: [],
                clientsMatched: [],
                searchClientsMatched: "",
            }
        },
        methods: {
            closeForm() {
                this.resetForm()
                $('#addUpdateClientEsim').modal('hide')
            },
            resetForm() {

                //this.clientesimForm.client_matched_selected = null;
                this.clientesimForm.reset();
            },
            resetClientsMatched() {
                this.clientsMatched = [];
                this.resetClientsMatchedSelected();
            },
            resetClientsMatchedSelected() {
                this.clientesimForm.client_matched_selected = null;
            },
            formKeyEnter() {
                if (this.editing) {
                    this.updateClientEsim()
                } else if(this.clientsMatched.length > 0) {
                    this.createClientEsim()
                } else {
                    this.checkBeforeCreate()
                }
            },
            checkBeforeCreate() {
                this.loading = true
                this.clientesim = {
                    'nom_raison_sociale': this.clientesimForm.nom_raison_sociale,
                    'prenom': this.clientesimForm.prenom,
                    'numero_telephone': this.clientesimForm.numero_telephone,
                    'email': this.clientesimForm.email,
                    'esim_id': this.clientesimForm.esim_id,
                    'client_matched_selected': this.clientesimForm.client_matched_selected
                }
                this.clientesimFormCheck = new Form(this.clientesim)

                this.clientesimForm
                    .post('/clientesims.checkbeforecreate')
                    .then(resp => {
                        this.loading = false

                        if (resp.data.action_type === 1) {
                            this.clientsMatched = resp.data.val
                            this.clientesimForm = this.clientesimFormCheck
                        } else {
                            this.clientSuccessfullyCreated(resp.data.val)
                        }
                    }).catch(error => {
                    this.loading = false
                });
            },
            createClientEsim() {
                this.loading = true

                this.clientesimForm
                    .post('/clientesims')
                    .then(resp => {
                        this.loading = false
                        //this.$parent.$emit('new_clientesim_created', newclientesim)
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
                    $('#addUpdateClientEsim').modal('hide')
                    this.resetForm()
                    let phonenum = resp[1]
                    window.location = '/clientesims.previewpdf/' + phonenum.id
                })
            },
            updateClientEsim() {
                this.loading = true

                this.clientesimForm
                    .put(`/clientesims/${this.clientesimId}`,undefined)
                    .then(updclientesim => {

                        this.loading = false

                        this.$swal({
                            html: '<small>Client modife avec Succes !</small>',
                            icon: 'success',
                            timer: 3000
                        }).then(() => {
                            ClientEsimBus.$emit('clientesim_updated', updclientesim)
                            $('#addUpdateClientEsim').modal('hide')
                        })
                    }).catch(error => {
                    this.loading = false
                });
            },
            clientMatchedSelectChanged() {
                console.log(this.clientesimForm.client_matched_selected)
            }
        },
        computed: {
            isValidCreateForm() {
                return !this.loading
            }
        }
    }
</script>
