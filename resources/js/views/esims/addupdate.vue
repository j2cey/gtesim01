<template>
    <div class="modal fade" id="addUpdateEsim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-sm" id="esimModalLabel">{{ formTitle }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" @submit.prevent @keydown="esimForm.errors.clear()">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="imsi" class="col-sm-2 col-form-label text-xs">IMSI</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control text-xs" id="imsi" name="imsi" autocomplete="imsi" autofocus placeholder="IMSI" v-model="esimForm.imsi">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="esimForm.errors.has('imsi')" v-text="esimForm.errors.get('imsi')"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="iccid" class="col-sm-2 col-form-label text-xs">ICCID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control text-xs" id="iccid" name="iccid" autocomplete="iccid" autofocus placeholder="ICCID" v-model="esimForm.iccid">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="esimForm.errors.has('iccid')" v-text="esimForm.errors.get('iccid')"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ac" class="col-sm-2 col-form-label text-xs">AC</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control text-xs" id="ac" name="ac" autocomplete="ac" autofocus placeholder="AC" v-model="esimForm.ac">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="esimForm.errors.has('ac')" v-text="esimForm.errors.get('ac')"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pin" class="col-sm-2 col-form-label text-xs">PIN</label>
                                <div class="col-sm-10">
                                    <input @keyup.enter="formKeyEnter()" type="text" class="form-control text-xs" id="pin" name="pin" required autocomplete="pin" autofocus placeholder="PIN" v-model="esimForm.pin">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="esimForm.errors.has('pin')" v-text="esimForm.errors.get('pin')"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="puk" class="col-sm-2 col-form-label text-xs">PUK</label>
                                <div class="col-sm-10">
                                    <input @keyup.enter="formKeyEnter()" type="text" class="form-control text-xs" id="puk" name="puk" required autocomplete="puk" autofocus placeholder="PUK" v-model="esimForm.puk">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="esimForm.errors.has('puk')" v-text="esimForm.errors.get('puk')"></span>
                                </div>
                            </div>
                            <div class="form-group">
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer justify-content-between">
                    <b-button type="is-dark" size="is-small" data-dismiss="modal">Close</b-button>
                    <b-button type="is-primary" size="is-small" :loading="loading" @click="updateEsim()" :disabled="!isValidCreateForm" v-if="editing">Save</b-button>
                    <b-button type="is-primary" size="is-small" :loading="loading" @click="createEsim()" :disabled="!isValidCreateForm" v-else>Create Esim</b-button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'

    import EsimBus from "./esimBus";

    class Esim {
        constructor(esim) {
            this.imsi = esim.imsi || ''
            this.iccid = esim.iccid || ''
            this.ac = esim.ac || ''
            this.pin = esim.pin || ''
            this.puk = esim.puk || ''
        }
    }
    export default {
        name: "esim-addupdate",
        props: {
        },
        components: { Multiselect },
        mounted() {
            this.$parent.$on('create_new_esim', () => {

                console.log("create_new_esim ")

                this.editing = false
                this.esim = new Esim({})
                this.esimForm = new Form(this.esim)

                this.formTitle = 'Creer Nouveau Client'

                $('#addUpdateEsim').modal()
            })

            this.$parent.$on('edit_esim', ( esim ) => {
                this.editing = true
                this.esim = new Esim(esim)
                this.esimForm = new Form(this.esim)
                this.esimId = esim.uuid

                this.formTitle = 'Modifier Client'

                $('#addUpdateEsim').modal()
            })
        },
        created() {
            
        },
        data() {
            return {
                formTitle: 'Create Esim',
                esim: {},
                esimForm: new Form(new Esim({})),
                esimId: null,
                editing: false,
                loading: false,
                esimtypes: []
            }
        },
        methods: {
            formKeyEnter() {
                if (this.editing) {
                    this.updateEsim()
                } else {
                    this.createEsim()
                }
            },
            createEsim() {
                this.loading = true

                this.esimForm
                    .post('/esims')
                    .then(newesim => {
                        this.loading = false
                        //this.$parent.$emit('new_esim_created', newesim)
                        this.$swal({
                            html: '<small>Esim creee avec Succes !</small>',
                            icon: 'success',
                            timer: 3000
                        }).then(() => {
                            $('#addUpdateEsim').modal('hide')
                            window.location = '/esims'
                        })

                    }).catch(error => {
                    this.loading = false
                });
            },
            updateEsim() {
                this.loading = true

                this.esimForm
                    .put(`/esims/${this.esimId}`,undefined)
                    .then(updesim => {
                        this.loading = false
                        EsimBus.$emit('esim_updated', updesim)
                        $('#addUpdateEsim').modal('hide')
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
