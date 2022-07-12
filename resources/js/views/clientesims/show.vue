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
                        <a v-if="can('clientesim-print')" type="button" class="btn btn-tool text-success" data-toggle="tooltip" @click="showPreviewPDF(clientesim)">
                            <i class="fa fa-print"></i>
                        </a>
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
                            <label for="email" class="col-sm-2 col-form-label text-xs">Email</label>
                            <div class="col-sm-10">
                                <input readonly type="text" class="form-control form-control-sm border-0" style="background-color: white" id="email" name="email" placeholder="email" v-model="clientesim.email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="numero_telephone" class="col-sm-2 col-form-label text-xs">Numero Telephone</label>
                            <div class="col-sm-10">
                                <input readonly type="text" class="form-control form-control-sm border-0" style="background-color: white" id="numero_telephone" name="numero_telephone" placeholder="numero_telephone" v-model="clientesim.numero_telephone">
                            </div>
                        </div>
			<div class="form-group row">
                            <label for="imsi" class="col-sm-2 col-form-label text-xs">IMSI</label>
                            <div class="col-sm-10">
                                <input readonly type="text" class="form-control form-control-sm border-0" style="background-color: white" id="imsi" name="imsi" placeholder="imsi" v-model="clientesim.esim.imsi">
                            </div>
                        </div>
			<div class="form-group row">
                            <label for="iccid" class="col-sm-2 col-form-label text-xs">ICCID</label>
                            <div class="col-sm-10">
                                <input readonly type="text" class="form-control form-control-sm border-0" style="background-color: white" id="iccid" name="iccid" placeholder="iccid" v-model="clientesim.esim.iccid">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pin" class="col-sm-2 col-form-label text-xs">PIN</label>
                            <div class="col-sm-10">
                                <input readonly type="text" class="form-control form-control-sm border-0" style="background-color: white" id="pin" name="pin" placeholder="pin" v-model="clientesim.esim.pin">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="puk" class="col-sm-2 col-form-label text-xs">Puk</label>
                            <div class="col-sm-10">
                                <input readonly type="text" class="form-control form-control-sm border-0" style="background-color: white" id="puk" name="puk" placeholder="puk" v-model="clientesim.esim.puk">
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <AddUpdateClientesim :clientesim_prop="clientesim"></AddUpdateClientesim>
    </div>
</template>

<script>
    import AddUpdateClientesim from "./addupdate.vue";
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
        name: "clientesim-show",
        props: {
            clientesim_prop: {}
        },
        components: {
            AddUpdateClientesim
        },
        mounted() {
            ClientEsimBus.$on('clientesim_updated', (updclientesim) => {
                if (this.clientesim.id === updclientesim.id) {
                    this.clientesim = updclientesim
                }
            })
        },
        created() {

        },
        data() {
            return {
                clientesim: this.clientesim_prop,
                index: this.index_prop,
                collapse_icon: 'fas fa-chevron-down'
            }
        },
        methods: {
            editClientEsim(clientesim) {
                this.$emit('edit_clientesim', clientesim)
            },
            showPreviewPDF(clientesim) {
                /*ClientEsimBus.$emit('show_flowchart', clientesim)*/
                window.location = '/clientesims.previewpdf/' + clientesim.id
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

                        axios.delete(`/clientesims/${clientesim.id}`)
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
