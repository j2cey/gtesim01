<template>
    <div id="dashboardDetails">
        <div class="card">
            <header>
                <div class="card-header-title row">
                    <div class="col-md-6 col-sm-8 col-12">
                        <span class="text-purple text-sm">
                            Dashboard Details
                        </span>
                    </div>
                    <div class="col-md-6 col-sm-4 col-12 text-right">
                        <span class="text text-sm">

                        </span>
                    </div>
                </div>
                <!-- /.user-block -->
            </header>
            <!-- /.card-header -->
            <div class="card-content">

                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="card card-default">
                            <div class="card-body">
                                <form class="form" @submit.prevent @keydown="statForm.errors.clear()">
                                    <div class="form-group">
                                        <label for="m_select_departement" class="form-label text-xs">Agence</label>
                                        <multiselect
                                            id="m_select_departement"
                                            v-model="statForm.sel_departement"
                                            :options="departements"
                                            selected.sync="departements"

                                            value=""
                                            :searchable="true"
                                            :multiple="false"
                                            key="value"

                                            placeholder="Agence"
                                            label="intitule"
                                            track-by="id"
                                            :preselect-first="true"
                                            :disabled="loading"
                                        >
                                        </multiselect>
                                        <span class="invalid-feedback d-block text-xs" role="alert" v-if="statForm.errors.has('sel_departement')" v-text="statForm.errors.get('sel_departement')"></span>
                                        <span v-if="statForm.sel_departement" class="badge badge-default">
                                            <small>{{ statForm.sel_departement.intitule }}</small>
                                        </span>
                                    </div>

                                    <div class="form-group">
                                        <label for="sel_period" class="form-label text-xs">Periode</label>
                                        <vue2-datepicker range id="sel_period" lang="fr" style="width: 100%; height: 50%;" v-model="statForm.sel_period" format="DD-MM-YYYY" :disabled="loading"></vue2-datepicker>
                                        <span class="invalid-feedback d-block text-xs" role="alert" v-if="statForm.errors.has('sel_period')" v-text="statForm.errors.get('sel_period')"></span>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="buttons">
                                    <b-button type="is-light" size="is-small" data-dismiss="modal" @click="resetForm()">Annuler</b-button>
                                    <b-button type="is-primary is-light" size="is-small" :loading="loading" @click="launchSearch()" :disabled="!isValidCreateForm">Valider</b-button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9 col-sm-6 col-12">

                        <div class="card">
                            <div class="card-body">
                                <details-inner :key="innerdetails_key" :statdetails_prop="statdetails" :stat_agence_prop="stat_agence" :stat_period_prop="stat_period"></details-inner>
                            </div>
                            <!-- ./card-body -->
                            <div v-if="loading" class="overlay dark">
                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                            </div>
                        </div>

                    </div>
                    <!-- /.col -->
                </div>

            </div>
            <!-- /.card-body -->
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'

    class statData {
        constructor(statdata) {
            this.sel_departement = statdata.sel_departement || ''
            this.sel_period = statdata.sel_period || ''
        }
    }

    export default {
        name: "dashboard-details",
        props: {
            agence_prop: {
                type: [ Number, Object ]
            },
        },
        components: {
            Multiselect,
            detailsInner: () => import('./details-inner'),
        },
        created() {
            axios.get('/departements.fetchall')
                .then(({data}) => {
                    this.departements = data
                    this.launchInitAgence()
                });
        },
        data() {
            return {
                departements: [],
                statForm: new Form(new statData({})),
                statdetails: [],
                stat_agence: '',
                stat_period: '',

                commom_key: 0,
                innerdetails_key: '_innerdetails_0',

                loading: false
            }
        },
        methods: {
            forceRerenderInnerDetails() {
                this.commom_key += 1;
                this.innerdetails_key = '_innerdetails_' + this.commom_key;
            },
            resetForm() {
                this.statForm = new Form(new statData({}))
            },
            formKeyEnter() {
                if (this.editing) {
                    this.updateEsim()
                } else {
                    this.createEsim()
                }
            },
            launchInitAgence() {
                if ( this.agence_prop !== -1 ) {
                    this.statForm = new Form(new statData({}))
                    this.statForm.sel_departement = this.agence_prop

                    this.launchSearch()
                }
            },
            launchSearch() {
                this.loading = true
                let statForm_tmp = new Form(new statData({}))
                statForm_tmp.sel_departement = this.statForm.sel_departement
                statForm_tmp.sel_period = this.statForm.sel_period

                this.statForm
                    .post('/dashboards.details')
                    .then(result => {
                        this.loading = false

                        this.statdetails = result.data

                        this.stat_agence = result.departement
                        this.stat_period = result.period

                        this.forceRerenderInnerDetails()

                    }).catch(error => {
                    this.loading = false
                }).finally(
                    this.statForm = statForm_tmp
                );
            },
        },
        computed: {
            isValidPeriod() {
                return true
            },
            isValidCreateForm() {
                return !this.loading && ( this.statForm.sel_departement ) && this.isValidPeriod
            }
        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
    input.multiselect__input {
        font-size: 8px
    }
</style>
