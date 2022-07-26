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
                    <div class="card" :id="'howtostep_' + howtothread.id">
                    <header>
                        <div class="card-header-title row">
                            <div class="col-md-6 col-sm-8 col-12">
                                <span class="text-olive text-xs" @click="collapseHowtostepsGroupClicked()" data-toggle="collapse" :data-parent="'#howtostepsgroup_' + howtothread.id" :href="'#collapse-howtostepsgroup-'+howtothread.id">
                                    Rubriques
                                </span>
                                <b-button size="is-small" type="is-ghost" @click="createHowToStep()"><i class="fas fa-plus"></i></b-button>
                            </div>
                            <div class="col-md-6 col-sm-4 col-12 text-right">
                                    <span class="text text-sm">
                                        <a type="button" class="btn btn-tool" @click="collapseHowtostepsGroupClicked()" data-toggle="collapse" :data-parent="'#howtostepsgroup_' + howtothread.id" :href="'#collapse-howtostepsgroup-'+howtothread.id">
                                            <i :class="currentHowtostepsGroupCollapseIcon"></i>
                                        </a>
                                    </span>
                            </div>
                        </div>
                    </header>
                    <!-- /.card-header -->
                    <div :id="'collapse-howtostepsgroup-'+howtothread.id" class="card-content panel-collapse collapse in">

                        

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            </div>

        </div>
        <!-- /.card-body -->
        <AddUpdateHowtostep></AddUpdateHowtostep>
    </div>
</template>

<script>
    import AddUpdateHowtostep from "./steps/addupdate";
    import HowToStepBus from "./steps/stepBus";
    import HowToThreadBus from "./howtothreadBus";

    export default {
        name: "howtothread-show",
        props: {
            howtothread_prop: {}
        },
        components: {
            AddUpdateHowtostep
        },
        mounted() {
            HowToThreadBus.$on('howtothread_updated', (updhowtothread) => {
                if (this.howtothread.id === updhowtothread.id) {
                    this.howtothread = updhowtothread
                }
            })
        },
        created() {
        },
        data() {
            return {
                howtothread: this.howtothread_prop,
                index: this.index_prop,
                collapse_icon: 'fas fa-chevron-down',
                howtostepsgroup_collapse_icon: 'fas fa-chevron-down',
            }
        },
        methods: {
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
            createHowToStep() {
                let howtothread = this.howtothread
                this.$emit('create_new_howtostep', { howtothread })
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
