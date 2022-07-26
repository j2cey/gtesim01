<template>
    <div class="modal fade" id="addUpdateHowToStep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <label for="step_title" class="col-sm-2 col-form-label text-xs">Titre Etape</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control text-xs" id="step_title" name="step_title" autocomplete="step_title" autofocus placeholder="Titre Etape" v-model="howtostepForm.step_title">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="howtostepForm.errors.has('step_title')" v-text="howtostepForm.errors.get('step_title')"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                              <label for="m_select_howto" class="col-sm-2 col-form-label text-xs">Rubrique</label>
                              <div class="col-sm-10 text-xs">
                                  <multiselect class="text text-xs"
                                    id="m_select_howto"
                                    v-model="howtostepForm.howto"
                                    selected.sync="howtostepForm.howto"
                                    value=""
                                    :options="howtos"
                                    :searchable="true"
                                    :multiple="false"
                                    label="title"
                                    track-by="id"
                                    key="id"
                                    placeholder="Rubrique"
                                  >
                                  </multiselect>
                                  <span class="invalid-feedback d-block text-xs" role="alert" v-if="howtostepForm.errors.has('howto')" v-text="howtostepForm.errors.get('howto')"></span>
                              </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label text-xs">Position</label>
                                <div class="col-sm-10">
                                    <b-field>
                                        <b-select size="is-small" expanded placeholder="Select a posi" v-model="howtostepForm.posi">
                                            <option v-for="option in getPositons" :value="option" :key="option">
                                                {{ option }}
                                            </option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label text-xs">Description</label>
                                <div class="col-sm-10">
                                    <input @keyup.enter="formKeyEnter()" type="text" class="form-control text-xs" id="description" name="posi" required autocomplete="description" autofocus placeholder="Description" v-model="howtostepForm.description">
                                    <span class="invalid-feedback d-block text-xs" role="alert" v-if="howtostepForm.errors.has('description')" v-text="howtostepForm.errors.get('description')"></span>
                                </div>
                            </div>
                            
                        </div>
                    </form>

                </div>
                <div class="modal-footer justify-content-between">
                    <b-button type="is-dark" size="is-small" @click="closeForm()">Fermer</b-button>
                    <b-button type="is-primary" size="is-small" :loading="loading" @click="updateHowToStep()" :disabled="!isValidCreateForm" v-if="editing">Enregistrer</b-button>
                    <b-button type="is-danger" size="is-small" :loading="loading" @click="createHowToStep()" :disabled="!isValidCreateForm" v-else>Creer Nouveelle Etape</b-button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'
    import HowtothreadBus from "./stepBus";

    class HowToStep {
        constructor(howtostep) {
            this.step_title = howtostep.step_title || ''
            this.posi = howtostep.posi || 1
            this.description = howtostep.description || ''
            this.howtothread = howtostep.howtothread || {}
            this.howto = howtostep.howto || {}
        }
    }
    export default {
        name: "howtostep-addupdate",
        props: {
        },
        components: { Multiselect },
        mounted() {
            this.$parent.$on('create_new_howtostep', ({ howtothread }) => {

                this.howtothread = howtothread;

                this.setPositionMax(howtothread);
                
                this.editing = false
                this.howtostep = new HowToStep({
                    'howtothread': howtothread
                })
                this.howtostepForm = new Form(this.howtostep)

                this.formTitle = 'Creer Nouvelle Etape'

                $('#addUpdateHowToStep').modal()
            })

            this.$parent.$on('edit_howtostep', ( howtostep ) => {
                console.log("howtostep to edit", howtostep)
                this.editing = true
                this.howtostep = new HowToStep(howtostep)
                this.howtostepForm = new Form(this.howtostep)
                this.howtostepId = howtostep.uuid

                this.formTitle = 'Modifier Tuto'

                $('#addUpdateHowToStep').modal()
            })
        },
        created() {
            axios.get('/howtos.fetchall')
                .then(({data}) => this.howtos = data);
        },
        data() {
            return {
                formTitle: 'Create HowToStep',
                howtostep: {},
                howtostepForm: new Form(new HowToStep({})),

                howtothread: null,
                howto: null,
                max_posi: 1,
                howtos: [],

                howtostepId: null,
                editing: false,
                loading: false,
            }
        },
        methods: {
            closeForm() {
                this.resetForm()
                $('#addUpdateHowToStep').modal('hide')
            },
            resetForm() {
                this.howtostepForm.reset();
            },
            formKeyEnter() {
                if (this.editing) {
                    this.updateHowToStep()
                } else {
                    this.createHowToStep()
                }
            },
            async setPositionMax(howtothread) {
              axios.get(`/howtothreads.posimax/${howtothread.id}`)
                .then(({data}) => this.max_posi = data);
            },
            createHowToStep() {
                this.loading = true

                this.howtostepForm
                    .post('/howtothreads.storestep')
                    .then(resp => {
                        this.loading = false

                        this.$swal({
                            html: '<small>Tuto créé avec Succes !</small>',
                            icon: 'success',
                            timer: 3000
                        }).then(() => {
                            $('#addUpdateHowToStep').modal('hide')
                            this.$parent.$emit('new_howtostep_created', resp)
                            this.resetForm()
                            window.location = '/howtosteps.show/' + resp.uuid
                        })
                    }).catch(error => {
                    this.loading = false
                });
            },
            updateHowToStep() {
                this.loading = true

                this.howtostepForm
                    .put(`/howtosteps/${this.howtostepId}`,undefined)
                    .then(resp => {

                        this.loading = false

                        this.$swal({
                            html: '<small>Tuto modifié avec Succes !</small>',
                            icon: 'success',
                            timer: 3000
                        }).then(() => {
                            HowtothreadBus.$emit('howtostep_updated', resp)
                            $('#addUpdateHowToStep').modal('hide')
                            window.location = '/howtosteps.show/' + resp.uuid
                        })
                    }).catch(error => {
                    this.loading = false
                });
            },
            addTag(e) {
                console.log("addTag: ", e)
                /*
                this.howtostepForm.tags.push({
                    name: e
                })
                */
            }
        },
        computed: {
            isValidCreateForm() {
                return !this.loading
            },
            getPositons() {
                let posis = [1];

                if ( this.posi_max > 1 ) {
                    for (let i = 2; i <= this.posi_max; i++) {
                        posis.push(i);
                    }
                    posis.push(this.posi_max + 1);
                }

                return posis;
            }
        }
    }
</script>

<style scoped>

</style>
