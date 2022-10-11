<template>
    <b-field grouped group-multiline>
        <div class="control">
            <b-taglist attached>
                <b-tag rounded :type="'is-'+ statusstyle + ' is-light'" v-model="statuscode">{{ statutesim.libelle }}</b-tag>
                <b-tag rounded type="is-ghost btn" v-if="can(statutesim_perm)" @click="cardModal"> <small> <i class="fa fa-refresh"></i> </small> </b-tag>
            </b-taglist>
        </div>
        <ModalForm></ModalForm>
    </b-field>
</template>

<script>
    import ModalForm from "./modalForm";
    import esimstatusBus from "../esimstatuses/esimstatusBus";

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        iconColor: 'white',
        customClass: {
            popup: 'colored-toast'
        },
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false
    })

    class StatutEsim {
        constructor(statutesim) {
            this.code = statutesim.code || ''
            this.model_type = statutesim.model_type || ''
            this.model_id = statutesim.model_id || ''
        }
    }

    export default {
        name: "statutesim-inline-display",
        props: {
            model_type_prop: "",
            model_id_prop: "",
            statutesim_prop: {},
            statutesim_perm_prop: {default: "esim-edit", type: String},
        },
        components: { ModalForm },
        mounted() {

            esimstatusBus.$on('esimstatus_updated', ( {model_type,model_id,statutesim} ) => {
                if (this.model_type_prop === model_type && this.model_id_prop === model_id) {
                    this.statutesim = statutesim
                }
            })
        },
        data() {
            return {
                statutesim: this.statutesim_prop,
                statuscode: this.statutesim_prop.code,
                statutesimForm: new Form( new StatutEsim( {
                    'code': this.statutesim_prop.code,
                    'model_type': this.model_type_prop,
                    'model_id': this.model_id_prop,
                } ) ),
                statutesim_perm: this.statutesim_perm_prop,
                editing: false,
                loading: false,
            }
        },
        methods: {
            cardModal() {
                let model_type = this.model_type_prop
                let model_id = this.model_id_prop
                let statutesim = this.statutesim_prop

                esimstatusBus.$emit("edit_esimstatus", {model_type,model_id,statutesim})
            },
            switchStatus(code) {
                if (code === 'active') {
                    this.saveStatus('inactive')
                } else {
                    this.saveStatus('active')
                }
            },
            statutEsimSetNext: function () {
                this.statusForm.code = code

                this.loading = true

                this.statusForm
                    .post('/statutesims.setnext')
                    .then(status => {
                        this.loading = false

                        Toast.fire({
                            icon: 'success',
                            title: 'Status changed to ' + status.name
                        }).then(() => {
                            this.status = status
                        })
                    }).catch(error => {
                    this.loading = false
                }).finally(
                    this.statutesimForm = new Form(new StatutEsim({
                        'code': this.status.code,
                        'model_type': this.model_type_prop,
                        'model_id': this.model_id_prop,
                    })),
                );

            },
        },
        computed: {
            isValidForm() {
                return !this.loading
            },
            statusstyle() {
                if (this.statutesim.code === "nouveau") {
                    return "primary"
                } else {
                    return "danger"
                }
            }
        }
    }
</script>

<style scoped>
    .colored-toast.swal2-icon-success {
        background-color: #a5dc86 !important;
    }

    .colored-toast.swal2-icon-error {
        background-color: #f27474 !important;
    }

    .colored-toast.swal2-icon-warning {
        background-color: #f8bb86 !important;
    }

    .colored-toast.swal2-icon-info {
        background-color: #3fc3ee !important;
    }

    .colored-toast.swal2-icon-question {
        background-color: #87adbd !important;
    }

    .colored-toast .swal2-title {
        color: white;
    }

    .colored-toast .swal2-close {
        color: white;
    }

    .colored-toast .swal2-html-container {
        color: white;
    }

</style>
