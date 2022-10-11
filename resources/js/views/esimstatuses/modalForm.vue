<template>
    <div class="modal fade" id="esimStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-sm" id="esimModalLabel">{{ formTitle }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form role="form" @submit.prevent @keydown="statusForm.errors.clear()">
                        <div class="form-group">
                            <label for="m_select">Status</label>
                            <multiselect
                                id="m_select"
                                v-model="statusForm.statutesim"
                                selected.sync="statusForm.statutesim"
                                value=""
                                :options="statuses"
                                :searchable="true"
                                :multiple="false"
                                label="libelle"
                                track-by="id"
                                key="id"
                                placeholder="Status"
                            >
                            </multiselect>
                        </div>
                    </form>

                </div>
                <div class="modal-footer justify-content-between">
                    <b-button type="is-default" size="is-small" data-dismiss="modal">Close</b-button>
                    <b-button type="is-primary" size="is-small" :loading="loading" class="btn btn-primary" @click="saveChanges()" :disabled="!isValidForm">Save changes</b-button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</template>

<script>
    import Multiselect from 'vue-multiselect'
    import esimstatusBus from "./esimstatusBus";

    /*const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        iconColor: 'white',
        customClass: {
            popup: 'colored-toast'
        },
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false
    })*/

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    class StatusForm {
        constructor(statusform) {
            this.model_type = statusform.model_type || ''
            this.model_id = statusform.model_id || ''
            this.statutesim = statusform.statutesim || ''
        }
    }

    export default {
        name: "modalForm",
        mounted() {

            esimstatusBus.$on('edit_esimstatus', ( {model_type,model_id,statutesim} ) => {

                this.editing = true

                this.statusform = new StatusForm({
                    'model_type': model_type,
                    'model_id': model_id,
                    'statutesim': statutesim,
                })

                this.statusForm = new Form(this.statusform)

                this.formTitle = 'Edit Esim Status'

                $('#esimStatusModal').modal()
            })
        },
        components: { Multiselect },
        created() {
            axios.get('/statutesims.fetchall')
                .then(({data}) => this.statuses = data);
        },
        data() {
            return {
                formTitle: 'Add Status',
                statusForm: new Form(new StatusForm({})),
                statusform: {},

                editing: false,
                loading: false,
                statuses: []
            }
        },
        methods: {
            formKeyEnter() {
                this.saveChanges()
            },
            saveChanges() {
                this.loading = true

                this.statusForm
                    .post('/statutesims.modelupdate')
                    .then(resp => {
                        this.loading = false

                        if (this.statusform.statutesim.code === resp.code) {

                            Toast.fire({
                                icon: 'warning',
                                title: 'Status NOT changed '
                            }).then(() => {
                                $('#esimStatusModal').modal('hide')
                            })

                        } else {

                            Toast.fire({
                                icon: 'success',
                                title: 'Status changed to ' + resp.libelle
                            }).then(() => {

                                this.statusform.statutesim = resp

                                let model_type = this.statusform.model_type
                                let model_id = this.statusform.model_id
                                let statutesim = resp

                                esimstatusBus.$emit("esimstatus_updated", {model_type, model_id, statutesim})

                                $('#esimStatusModal').modal('hide')
                            })
                        }
                    }).catch(error => {
                    this.loading = false
                }).finally(
                    this.statusForm = new Form( new StatusForm(this.statusform) ),
                );
            }
        },
        computed: {
            isValidForm() {
                return !this.loading
            }
        }
    }
</script>

<style scoped>

</style>
