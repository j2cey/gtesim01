<template>
    <div class="card collapsed-card border-0">

        <header>
            <div class="card-header-title row">
                <div class="col-md-6 col-sm-8 col-12">
                    <span :class="'text-' + list_color + ' text-xs'" @click="collapseHowToStepClicked()" data-card-widget="collapse">
                        {{ list_title }}
                    </span>
                    <b-button size="is-small" type="is-ghost" @click="createHowToStep()"><i class="fas fa-plus"></i></b-button>
                </div>
                <div class="col-md-6 col-sm-4 col-12 text-right">
                    <span v-if="howtosteps" class="text text-xs">
                        <b-tag v-if="howtosteps.length < 1" type="is-danger is-light" size="is-small">{{ howtosteps.length }}</b-tag>
                        <b-tag v-else-if="howtosteps.length === 1" type="is-success is-light" size="is-small">{{ howtosteps.length }}</b-tag>
                        <b-tag v-else type="is-danger is-light" size="is-small">{{ howtosteps.length }}</b-tag>

                        <a type="button" class="btn btn-tool" @click="collapseHowToStepClicked()" data-card-widget="collapse">
                            <i :class="currentHowToStepCollapseIcon"></i>
                        </a>
                    </span>
                </div>
            </div>
            <!-- /.user-block -->
        </header>
        <!-- /.card-header -->

        <div class="card-body p-0">
            <div class="card-body table-responsive p-0" style="min-height: 200px;">
                <table class="table m-0">
                    <thead v-if="howtosteps">
                    <tr class="text text-sm">
                        <th>#</th>
                        <th>Num. Ordre</th>
                        <th>Titre Etape</th>
                        <th>Titre Rubrique</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(howtostep, index) in howtosteps_list" v-if="howtosteps_list.length" class="text text-xs">
                        <td>{{ howtostep.id }}</td>
                        <td>
                            <span class="badge badge-default">{{ howtostep.posi }}</span>
                        </td>
                        <td>{{ howtostep.title }}</td>
                        <td>{{ howtostep.howto.title }}</td>
                        <td>{{ howtostep.description }}</td>
                        <td>
                            <div class="block">
                                <span @click="editHowToStep(howtostep)"> <i class="fa fa-pencil-square-o text-warning"></i> </span>
                                <span @click="deleteHowToStep(howtostep)"> <i class="fa fa-trash text-danger"></i> </span>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer -->
        <HowtostepAddUpdate></HowtostepAddUpdate>
    </div>
    <!-- /.card -->
</template>

<script>
    import HowtostepAddUpdate from "./addupdate";
    import HowToStepBus from "./stepBus";
    import HowtothreadBus from "../howtothreadBus";

    export default {
        name: "howtostep-list",
        props: {
            howtothread_prop: {},
            howtosteps_prop: [],
            list_title_prop: "",
            list_color_prop: "",
        },
        watch: {
            howtosteps_prop: function (newValue, oldValue) {
                console.log("howtosteps_prop watched: ", newValue, oldValue)
                this.howtosteps = newValue
            },
        },
        components: {
            HowtostepAddUpdate
        },
        mounted() {
            this.$on('new_howtostep_created', (howtostep) => {
                if (this.howtothread.id === howtostep.how_to_thread_id) {
                    //this.addHowToStepToList(howtostep)
                    HowtothreadBus.$emit('new_howtostep_created', howtostep)
                }
            })
            HowToStepBus.$on('howtostep_updated', (howtostep) => {
                if (this.howtothread.id === howtostep.how_to_thread_id) {
                    //this.updateHowToStepFromList(howtostep)
                    HowtothreadBus.$emit('howtostep_updated', howtostep)
                }
            })
            this.$parent.$on('howtothread_reloaded', ({ howtothread, howtosteps }) => {
                console.log('howtothread_reloaded receive on list ', howtothread, howtosteps)
                if (this.howtothread.id === howtothread.id) {
                    this.howtosteps = howtosteps
                    console.log('list set', this.howtosteps)
                }
            })
        },
        created() {
            //axios.get('/howtosteptypes.fetchall').then(({data}) => this.howtosteptypes = data);
        },
        data() {
            return {
                howtothread: this.howtothread_prop,
                howtosteps: this.howtosteps_prop,
                list_title: this.list_title_prop,
                list_color: this.list_color_prop,
                editing: false,
                loading: false,
                howtostep_collapse_icon: 'fas fa-chevron-down'
            }
        },
        methods: {
            createHowToStep() {
                let howtothreadId = this.howtothread.id
                let stepscount = this.howtothread.steps.length
                this.$emit('create_new_howtostep', { howtothreadId, stepscount })
            },
            editHowToStep(howtostep) {
                let stepscount = this.howtothread.steps.length
                this.$emit('edit_howtostep', { howtostep, stepscount })
            },
            collapseHowToStepClicked() {
                if (this.howtostep_collapse_icon === 'fas fa-chevron-down') {
                    this.howtostep_collapse_icon = 'fas fa-chevron-up';
                } else {
                    this.howtostep_collapse_icon = 'fas fa-chevron-down';
                }
            },
            addHowToStepToList(howtostep) {
                let howtostepIndex = this.howtosteps.findIndex(c => {
                    return howtostep.id === c.id
                })
                // if this howtostep doesn't exists in the list
                if (howtostepIndex === -1) {
                    this.howtosteps.push(howtostep)
                }
            },
            updateHowToStepFromList(howtostep) {
                let howtostepIndex = this.reportattributes.findIndex(s => {
                    return howtostep.id === s.id
                })
                // if this howtostep belongs to the list
                if (howtostepIndex > -1) {
                    this.howtosteps.splice(howtostepIndex, 1, howtostep)
                }
            },
            deleteHowToStep(howtostep) {
                this.$swal({
                    title: '<small>Are you sure ?</small>',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if(result.value) {
                        axios.delete(`/howtosteps/${howtostep.uuid}`)
                            .then(resp => {
                                this.$swal({
                                    html: '<small>HowToStep successfully deleted !</small>',
                                    icon: 'success',
                                    timer: 3000
                                }).then(() => {
                                    this.$parent.$emit('howtostep_deleted', howtostep)
                                })
                            }).catch(error => {
                            window.handleErrors(error)
                        })
                    }
                })
            }
        },
        computed: {
            isValidCreateForm() {
                return !this.loading
            },
            currentHowToStepCollapseIcon() {
                return this.howtostep_collapse_icon;
            },
            howtosteps_list() {
                return this.howtosteps
            }
        }
    }
</script>

<style scoped>

</style>
