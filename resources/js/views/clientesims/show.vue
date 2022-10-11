<template>
    <div class="card">
        <header>
            <div class="card-header-title row">
                <div class="col-md-3 col-sm-8 col-12">
                    <span class="text-purple text-sm">
                        {{ displayTitle }}
                    </span>
                </div>
                <div class="col-md-3 col-sm-4 col-12 text-right">
                    <span class="text text-sm">
                        <a v-if="can('clientesim-edit')" type="button" class="btn btn-tool text-warning" data-toggle="tooltip" @click="editClientEsim(clientesim)">
                            <i class="fa fa-pencil-square-o"></i>
                        </a>
                        <a v-if="can('clientesim-delete')" type="button" class="btn btn-tool text-danger" @click="deleteClientEsim(clientesim)">
                            <i class="fas fa-trash"></i>
                        </a>
                    </span>
                </div>
            </div>
            <!-- /.user-block -->
        </header>
        <!-- /.card-header -->
        <div class="card-content">

            <div class="row">

                <div class="col-md-12">

                    <form role="form">
                        <div class="form-group row">
                            <label for="nom_raison_sociale" class="col-sm-2 col-form-label text-xs">Nom / Raison Sociale</label>
                            <div class="col-sm-10">
                                <input readonly type="text" class="form-control form-control-sm border-0" style="background-color: white" id="nom_raison_sociale" name="nom_raison_sociale" placeholder="Type" v-model="clientesim.nom_raison_sociale">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="prenom" class="col-sm-2 col-form-label text-xs">Prenom</label>
                            <div class="col-sm-10">
                                <input readonly type="text" class="form-control form-control-sm border-0" style="background-color: white" id="prenom" name="prenom" placeholder="prenom" v-model="clientesim.prenom">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-xs">Emails</label>
                            <div class="col-sm-10">
                                <div class="card-body p-0">
                                    <div class="card-body table-responsive p-0" style="min-height: 200px;">
                                        <table class="table m-0">
                                            <tbody>
                                            <tr v-for="(emailaddress, index) in clientesim.emailaddresses" :key="emailaddress.id" class="tw-text-xs">
                                                <td><div class="tw-text-xs">{{ emailaddress.email }}</div></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label text-xs">
                                <span class="text text-align-left">Numéros Téléphone</span>
                                <span class="text text-align-right">
                                    <b-button v-if="can('clientesim-esim-attach')" size="is-small" type="is-success is-light" @click="$emit('create_newphone_clientesim', clientesim)"><i class="fas fa-plus"></i></b-button>
                                </span>
                            </label>
                            <div class="col-sm-10">
                                <div class="card-body p-0">
                                    <div class="card-body table-responsive p-0" style="min-height: 200px;">
                                        <table class="table m-0">
                                            <thead>
                                            <tr class="tw-text-xs">
                                                <th>Numero</th>
                                                <th>IMSI</th>
                                                <th>ICCID</th>
                                                <th>PIN</th>
                                                <th>PUK</th>
                                                <th>Date</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(phonenum, index) in clientesim.phonenums" :key="phonenum.id" class="tw-text-xs">
                                                <td><div class="text tw-text-xs border-right">
                                                    <a v-if="can('esim-phonenum-edit')" class="text text-sm text-primary" data-toggle="tooltip" @click="$emit('edit_phonenum', phonenum)">
                                                        <small>{{ phonenum.numero }}</small>
                                                    </a>
                                                    <small v-else>{{ phonenum.numero }}</small>
                                                </div></td>
                                                <td><div class="text tw-text-xs border-right">
                                                    <a v-if="can('esim-show')" class="text text-sm text-primary" data-toggle="tooltip" @click="showEsim(phonenum.esim)">
                                                        <small>{{ phonenum.esim.imsi }}</small>
                                                    </a>
                                                </div></td>
                                                <td><div class="text tw-text-xs border-right">{{ phonenum.esim.iccid }}</div></td>
                                                <td><div class="text tw-text-xs border-right">{{ phonenum.esim.pin }}</div></td>
                                                <td><div class="text tw-text-xs border-right">{{ phonenum.esim.puk }}</div></td>
                                                <td>{{ phonenum.created_at | formatDate }}</td>
                                                <td>
                                                    <div class="text tw-text-xs">
                                                        <a v-if="can('clientesim-print')" type="button" class="btn btn-tool btn-sm text-success" data-toggle="tooltip" @click="showPreviewPDF(phonenum)">
                                                            <i class="fa fa-print"></i>
                                                        </a>
                                                        <a v-if="can('clientesim-esim-attach')" type="button" class="btn btn-tool btn-sm text-warning" data-toggle="tooltip" :disabled="loading" @click="changePhoneNumEsim(phonenum)">
                                                            <i class="fa fa-recycle"></i>
                                                        </a>
                                                        <a v-if="can('clientesim-deletephone')" type="button" class="btn btn-tool btn-sm text-danger" data-toggle="tooltip" :disabled="loading" @click="deletePhoneNum(phonenum)">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <AddUpdateClientesim :clientesim_prop="clientesim"></AddUpdateClientesim>
        <AddPhoneNum></AddPhoneNum>
    </div>
</template>

<script>
    import AddUpdateClientesim from "./addupdate.vue";
    import AddPhoneNum from "./addphonenum";
    import ClientEsimBus from "./clientesimBus";
    import ClientEsimServices from '../clientesims/clientEsimServices'
    import PhoneNumBus from "./phonenumBus";

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
        name: "clientesim-show",
        props: {
            clientesim_prop: {}
        },
        components: {
            AddUpdateClientesim, AddPhoneNum
        },
        mounted() {
            ClientEsimBus.$on('clientesim_updated', (updclientesim) => {
                if (this.clientesim.id === updclientesim.id) {
                    this.clientesim = updclientesim
                }
            })

            ClientEsimBus.$on('phonenum_esim_changed', ({phonenum, clientesim}) => {
                if (this.clientesim.id === clientesim.id) {
                    this.updatePhoneNum(phonenum)
                }
            })

            ClientEsimBus.$on('phonenum_deleted', ({phonenum, clientesim}) => {
                if (this.clientesim.id === clientesim.id) {
                    this.removePhoneNum(phonenum)
                }
            })

            PhoneNumBus.$on('phonenum_updated', (phonenum) => {
                if (this.clientesim.model_type === phonenum.hasphonenum_type && this.clientesim.id === phonenum.hasphonenum_id) {
                    this.updatePhoneNum(phonenum)
                }
            })
        },
        created() {

        },
        data() {
            return {
                clientesim: this.clientesim_prop,
                index: this.index_prop,
                collapse_icon: 'fas fa-chevron-down',
                loading: false,
            }
        },
        methods: {
            editClientEsim(clientesim) {
                this.$emit('edit_clientesim', clientesim)
            },
            showPreviewPDF(phonenum) {
                ClientEsimServices.showPreviewPDF(phonenum)
            },
            showEsim(esim) {
                window.location = '/esims/' + esim.uuid
            },
            deleteClientEsim(clientesim) {
                this.$swal({
                    html: '<small>Voulez-vous vraiment supprimer ce Client ?</small>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Oui',
                    cancelButtonText: 'Non'
                }).then((result) => {
                    if(result.value) {
                        axios.delete(`/clientesims/${clientesim.uuid}`)
                            .then(resp => {

                                console.log('clientesim delete resp: ', resp)

                                this.$swal({
                                    html: '<small>ClientEsim supprimé avec succès !</small>',
                                    icon: 'success',
                                    timer: 3000
                                }).then(() => {
                                    ClientEsimBus.$emit('clientesimaction_deleted', {key, resp})
                                })
                            }).catch(error => {
                            window.handleErrors(error)
                        })

                    } else {
                        // stay here
                    }
                })
            },
            changePhoneNumEsim(phonenum) {
                ClientEsimServices.changePhoneNumEsim(phonenum, this.clientesim)
            },
            updatePhoneNum(phonenum) {
                let phonenumIndex = this.clientesim.phonenums.findIndex(p => {
                    return phonenum.id === p.id
                })
                if (phonenumIndex !== -1) {
                    this.clientesim.phonenums.splice(phonenumIndex, 1, phonenum)
                }
            },
            deletePhoneNum(phonenum) {
                ClientEsimServices.deletePhoneNum(phonenum, this.clientesim)
            },
            removePhoneNum(phonenum) {
                let phonenumIndex = this.clientesim.phonenums.findIndex(p => {
                    return phonenum.id === p.id
                })
                if (phonenumIndex !== -1) {
                    this.clientesim.phonenums.splice(phonenumIndex, 1)
                }
            },
            collapseClicked() {
                if (this.collapse_icon === 'fas fa-chevron-down') {
                    this.collapse_icon = 'fas fa-chevron-up';
                } else {
                    this.collapse_icon = 'fas fa-chevron-down';
                }
            }
        },
        computed: {
            displayTitle() {
                return this.clientesim.nom_raison_sociale + ' ' + this.clientesim.prenom
            },
            currentCollapseIcon() {
                return this.collapse_icon;
            }
        }
    }
</script>

<style scoped>

</style>
