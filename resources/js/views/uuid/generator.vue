<template>
    <div class="modal fade" id="uuidGenerator" tabindex="-1" role="dialog" aria-labelledby="uuidModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-sm" id="uuidModalLabel">{{ formTitle }}</h5>
                    <button type="button" class="close" @click="closeForm()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" @submit.prevent>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="generated_uuid" class="col-sm-2 col-form-label text-xs">Generated uuId</label>
                                <div class="col-sm-10">
                                    <input disabled type="text" class="form-control text-xs" id="generated_uuid" name="generated_uuid" autocomplete="nom_raison_sociale" autofocus placeholder="Generated uuId" v-model="generated_uuid">
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer justify-content-between">
                    <b-button type="is-dark" size="is-small" @click="closeForm()">Close</b-button>
                    <b-button type="is-primary" size="is-small" :loading="loading" @click="generateUuid()" :disabled="!isValidCreateForm">Generate</b-button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<script>

    export default {
        name: "generator",
        props: {
        },
        components: { },
        mounted() {
            this.$parent.$on('uuid_generator_open', () => {

                this.editing = false
                this.generated_uuid = null

                this.formTitle = 'Generate Random UUID'

                $('#uuidGenerator').modal()
            })
        },
        created() {

        },
        data() {
            return {
                formTitle: 'UUID Generator',
                generated_uuid: null,
                editing: false,
                loading: false,
            }
        },
        methods: {
            closeForm() {
                this.resetForm()
                $('#uuidGenerator').modal('hide')
            },
            resetForm() {
                this.generated_uuid = null;
            },
            formKeyEnter() {
                if (this.editing) {
                    this.generateUuid()
                } else {
                    this.generateUuid()
                }
            },
            generateUuid() {
                this.loading = true

                axios.get('/uuid.generate')
                    .then(resp => {

                        this.loading = false
                        this.generated_uuid = resp.data

                    }).catch(error => {
                    this.loading = false
                });
            },
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
