<template>
    <div class="modal fade" id="addUpdateClientEsim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-sm" id="clientesimModalLabel">{{ formTitle }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" @submit.prevent @keydown="clientesimForm.errors.clear()">
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

                </div>
                <div class="modal-footer justify-content-between">
                    <b-button type="is-dark" size="is-small" data-dismiss="modal">Fermer</b-button>
                    <b-button type="is-primary" size="is-small" :loading="loading" @click="updateClientEsim()" :disabled="!isValidCreateForm" v-if="editing">Enregistrer</b-button>
                    <b-button type="is-primary" size="is-small" :loading="loading" @click="createClientEsim()" :disabled="!isValidCreateForm" v-else>Creer Client</b-button>
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
                clientesimId: null,
                editing: false,
                loading: false,
                clientesimtypes: []
            }
        },
        methods: {
            formKeyEnter() {
                if (this.editing) {
                    this.updateClientEsim()
                } else {
                    this.createClientEsim()
                }
            },
            createClientEsim() {
                this.loading = true

                this.clientesimForm
                    .post('/clientesims')
                    .then(newclientesim => {
                        this.loading = false
                        //this.$parent.$emit('new_clientesim_created', newclientesim)
                        this.$swal({
                            html: '<small>Client cree avec Succes !</small>',
                            icon: 'success',
                            timer: 3000
                        }).then(() => {
                            $('#addUpdateClientEsim').modal('hide')
                            window.location = '/clientesims.previewpdf/' + newclientesim.id
                        })

                    }).catch(error => {
                    this.loading = false
                });
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
            }
        },
        computed: {
            isValidCreateForm() {
                return !this.loading
            }
        }
    }
</script>
