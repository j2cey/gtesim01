<template>
    <div class="modal fade" id="addUpdatePhoneNum" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-sm" id="phonenumModalLabel">{{ formTitle }}</h5>
                    <button type="button" class="close" @click="closeForm()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" @submit.prevent @keydown="phonenumForm.errors.clear()">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="nom_raison_sociale" class="col-sm-2 col-form-label text-xs">Nom / Raison Sociale</label>
                                <div class="col-sm-10">
                                    <input disabled type="text" class="form-control text-xs" id="nom_raison_sociale" name="nom_raison_sociale" autocomplete="nom_raison_sociale" autofocus placeholder="Nom / Raison Sociale" v-model="phonenumForm.client_esim.nom_raison_sociale">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="prenom" class="col-sm-2 col-form-label text-xs">Prenom</label>
                                <div class="col-sm-10">
                                    <input disabled type="text" class="form-control text-xs" id="prenom" name="prenom" autocomplete="prenom" autofocus placeholder="Prenom" v-model="phonenumForm.client_esim.prenom">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="numero" class="col-sm-2 col-form-label text-xs">Numero Telephone</label>
                                <div class="col-sm-10">
                                    <input @keyup.enter="formKeyEnter()" type="text" class="form-control text-xs" id="numero" name="numero" required autocomplete="numero" autofocus placeholder="Numero Telephone" v-model="phonenumForm.numero">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="phonenumForm.errors.has('numero')" v-text="phonenumForm.errors.get('numero')"></span>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer justify-content-between">
                    <b-button type="is-dark" size="is-small" @click="closeForm()">Fermer</b-button>
                    <b-button type="is-primary" size="is-small" :loading="loading" @click="updatePhoneNum()" :disabled="!isValidCreateForm" v-if="editing">Enregistrer</b-button>
                    <b-button type="is-primary" size="is-small" :loading="loading" @click="createPhoneNum()" :disabled="!isValidCreateForm" v-else>Creer Client</b-button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<script>
    import Multiselect from "vue-multiselect";
    import PhoneNumBus from "./phonenumBus";

    class PhoneNum {
        constructor(phonenum) {
            this.numero = phonenum.numero || ''
            this.client_esim = phonenum.client_esim || ''
        }
    }
    export default {
        name: "addphonenum",
        props: {
        },
        components: { Multiselect },
        mounted() {
            this.$parent.$on('create_newphone_clientesim', (client_esim) => {

                console.log("create_newphone_clientesim ", client_esim)

                this.editing = false
                this.phonenum = new PhoneNum({
                    'client_esim': client_esim
                })
                this.phonenumForm = new Form(this.phonenum)

                this.formTitle = 'Creer Nouveau Numéro de Téléphone (e-sim)'

                $('#addUpdatePhoneNum').modal()
            })

            this.$parent.$on('edit_phonenum', ( phonenum ) => {
                this.editing = true
                this.phonenum = new PhoneNum(phonenum)
                this.phonenumForm = new Form(this.phonenum)
                this.phonenumId = phonenum.uuid

                this.formTitle = 'Modifier Numéro de Téléphone'

                $('#addUpdatePhoneNum').modal()
            })
        },
        created() {

        },
        data() {
            return {
                formTitle: 'Create PhoneNum',
                phonenum: {},
                phonenumForm: new Form(new PhoneNum({})),
                phonenumId: null,
                editing: false,
                loading: false,
            }
        },
        methods: {
            closeForm() {
                this.resetForm()
                $('#addUpdatePhoneNum').modal('hide')
            },
            resetForm() {
                this.phonenumForm.reset();
            },
            formKeyEnter() {
                if (this.editing) {
                    this.updatePhoneNum()
                } else {
                    this.createPhoneNum()
                }
            },
            createPhoneNum() {
                this.loading = true

                this.phonenumForm
                    .post('/clientesims.phonenums')
                    .then(phonenum => {
                        this.loading = false
                        //this.$parent.$emit('new_phonenum_created', newphonenum)
                        console.log(phonenum)
                        this.$swal({
                            html: '<small>Numero ajoute avec Succes !</small>',
                            icon: 'success',
                            timer: 3000
                        }).then(() => {
                            $('#addUpdatePhoneNum').modal('hide')
                            this.resetForm()
                            window.location = '/clientesims.previewpdf/' + phonenum.id
                        })
                    }).catch(error => {
                    this.loading = false
                });
            },
            updatePhoneNum() {
                this.loading = true

                this.phonenumForm
                    .put(`/clientesims.phonenums/${this.phonenumId}`,undefined)
                    .then(updphonenum => {

                        this.loading = false

                        this.$swal({
                            html: '<small>Client modife avec Succes !</small>',
                            icon: 'success',
                            timer: 3000
                        }).then(() => {
                            PhoneNumBus.$emit('phonenum_updated', updphonenum)
                            $('#addUpdatePhoneNum').modal('hide')
                        })
                    }).catch(error => {
                    this.loading = false
                });
            },
            clientMatchedSelectChanged() {
                console.log(this.phonenumForm.client_matched_selected)
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
