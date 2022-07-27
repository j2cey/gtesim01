<template>
    <div class="card">
        <header>
            <div class="card-header-title row">
                <div class="col-md-3 col-sm-6 col-12">
                    <span class="text-purple text-sm">
                        {{ displayTitle }}
                    </span>
                </div>
                <div class="col-md-3 col-sm-6 col-12 text-right">
                    <span class="text text-sm">
                        <a v-if="can('howtothread-edit')" type="button" class="btn btn-tool text-warning" data-toggle="tooltip" @click="editHowToThread(howtothread)">
                            <i class="fa fa-pencil-square-o"></i>
                        </a>
                        <a v-if="can('howtothread-delete')" type="button" class="btn btn-tool text-danger" @click="deleteHowToThread(howtothread)">
                            <i class="fa fa-trash"></i>
                        </a>
                    </span>
                </div>
            </div>
            <!-- /.user-block -->
        </header>
        <!-- /.card-header -->
        <div class="card-content">

            <div class="row">
                <div class="col">
                    <dl class="row text-sm">
                        <dt class = "col-sm-4">
                            Titre
                        </dt>
                        <dd class = "col-sm-8">
                            {{ howtothread.title }}
                        </dd>
                        <dt class = "col-sm-4">
                            Description
                        </dt>
                        <dd class = "col-sm-8">
                            {{ howtothread.description }}
                        </dd>
                    </dl>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <HowToStepList :key="stepslist_key"  :howtothread_prop="howtothread" :howtosteps_prop="howtosteps" list_title_prop="Etapes" list_color_prop="success"></HowToStepList>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
    </div>
</template>

<script>
    import HowToStepBus from "./steps/stepBus";
    import HowToThreadBus from "./howtothreadBus";
    import HowToStepList from "./steps/list";

    export default {
        name: "howtothread-show",
        props: {
            howtothread_prop: {}
        },
        components: {
            HowToStepList
        },
        mounted() {
            HowToThreadBus.$on('howtothread_updated', (updhowtothread) => {
                if (this.howtothread.id === updhowtothread.id) {
                    this.howtothread = updhowtothread
                }
            })

            HowToThreadBus.$on('new_howtostep_created', (howtostep) => {
                if (this.howtothread.id === howtostep.how_to_thread_id) {
                    this.reloadHowToThread()
                }
            })

            HowToThreadBus.$on('howtostep_updated', (howtostep) => {
                if (this.howtothread.id === howtostep.how_to_thread_id) {
                    this.reloadHowToThread()
                }
            })

            this.$on('howtostep_deleted', (howtostep) => {
                if (this.howtothread.id === howtostep.how_to_thread_id) {
                    this.reloadHowToThread()
                }
            })
        },
        created() {
        },
        data() {
            return {
                howtothread: this.howtothread_prop,
                commom_key: 0,
                stepslist_key: this.howtothread_prop.id + '_' + 0,
                collapse_icon: 'fas fa-chevron-down',
                howtostepsgroup_collapse_icon: 'fas fa-chevron-down',
            }
        },
        methods: {
            forceRerenderStepsList() {
                this.commom_key += 1;
                this.stepslist_key = this.howtothread.id + '_' + this.commom_key;
            },
            editHowToThread(howtothread) {
                this.$emit('edit_howtothread', howtothread)
            },
            deleteHowToThread(howtothread) {
                this.$swal({
                    html: '<small>Voulez-vous vraiment supprimer ce Tuto ?</small>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Oui',
                    cancelButtonText: 'Non'
                }).then((result) => {
                    if(result.value) {

                        axios.delete(`/howtothreads/${howtothread.uuid}`)
                            .then(resp => {

                                console.log('howtothread delete resp: ', resp)

                                this.$swal({
                                    html: '<small>Tuto supprimé avec succès !</small>',
                                    icon: 'success',
                                    timer: 3000
                                }).then(() => {
                                    HowToThreadBus.$emit('howtothreadaction_deleted', {key, resp})
                                })
                            }).catch(error => {
                            window.handleErrors(error)
                        })

                    } else {
                        // stay here
                    }
                })
            },
            reloadHowToThread() {
                axios.get(`/howtothreads.fetchone/${this.howtothread.id}`)
                    .then((result => {
                        this.analysisrule = result.data;
                        this.$emit('howtothread_reloaded', { 'howtothread':result.data, 'howtosteps':result.data.steps });
                        //this.forceRerenderStepsList()
                    }))
                    .catch(error => {
                    window.handleErrors(error)
                });
            },
            collapseClicked() {
                if (this.collapse_icon === 'fas fa-chevron-down') {
                    this.collapse_icon = 'fas fa-chevron-up';
                } else {
                    this.collapse_icon = 'fas fa-chevron-down';
                }
            },
            collapseHowtostepsGroupClicked() {
                if (this.howtostepsgroup_collapse_icon === 'fas fa-chevron-down') {
                    this.howtostepsgroup_collapse_icon = 'fas fa-chevron-up';
                } else {
                    this.howtostepsgroup_collapse_icon = 'fas fa-chevron-down';
                }
            }
        },
        computed: {
            howtosteps() {
                return this.howtothread.steps
            },
            displayTitle() {
                return this.howtothread.title
            },
            currentCollapseIcon() {
                return this.collapse_icon;
            },
            currentHowtostepsGroupCollapseIcon() {
                return this.howtostepsgroup_collapse_icon;
            },
        }
    }
</script>

<style scoped>

</style>
