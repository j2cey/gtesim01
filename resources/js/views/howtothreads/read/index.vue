<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    
                    <div class="col-md-4 col-sm-4 border-right">
                        
                        <div v-if="prevstep" class="description-block">
                            <h5 class="description-header">
                                <a @click="goToStep(prevstep)">
                                    <i class="fa fa-arrow-circle-left text-warning" aria-hidden="true"></i>
                                </a>
                            </h5>
                            <span class="text text-xs">{{ prevstep.title }}</span>
                        </div>
                        
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4 col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><i class="fa fa-circle" aria-hidden="true"></i></h5>
                            <span class="text text-xs">{{ currstep.title }}</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4 col-sm-4">
                        <div v-if="nextstep" class="description-block">
                            <h5 class="description-header">
                                <a @click="goToStep(nextstep)">
                                    <i class="fa fa-arrow-circle-right text-success" aria-hidden="true"></i>
                                </a>
                            </h5>
                            <span class="text text-xs">{{ nextstep.title }}</span>
                        </div>
                        <div v-else class="description-block">
                            <h5 class="description-header">
                                <a @click="endReading()">
                                    <i class="fa fa-stop-circle text-danger" aria-hidden="true"></i>
                                </a>
                            </h5>
                            <span class="text text-xs">Terminé</span>
                        </div>
                        <!-- /.description-block -->
                    </div>

                </div>

                <htmleval :htmlcontent_prop="currstep.howto.htmlbody"></htmleval>
            </div>
        </div>
    </div>
</template>

<script>
    import htmleval from "./htmleval.vue";

    export default {
        name: "howtothread-read",
        props: {
            howtothread_prop: {},
        },
        components: {
            htmleval
        },
        mounted() {
            
        },
        created() {
        },
        data() {
            return {
                howtothread: this.howtothread_prop,
                currposi: 1,
                commom_key: 0,
                stepslist_key: this.howtothread_prop.id + '_' + 0,
                collapse_icon: 'fas fa-chevron-down',
                howtostepsgroup_collapse_icon: 'fas fa-chevron-down',
            }
        },
        methods: {
            goToStep(step) {
                /*
                axios.get(`/howtosteps.relativesteps/${step.id}`)
                .then(({data}) => {
                    let posisteps = data
                    this.currstep = posisteps.current
                    this.prevstep = posisteps.prev
                    this.nextstep = posisteps.next

                    this.$emit('htmlcontent_reloaded', { 'htmlcontent':posisteps.current.howto.htmlbody });
                });
                */
               this.currposi = step.posi
               let currstep = this.currstep
               this.$emit('htmlcontent_reloaded', { 'htmlcontent':currstep.howto.htmlbody });
            },
            endReading() {
                window.location = '/howtothreads'
            },
            getStep(stepIndex) {
                if ( stepIndex >= 0 && stepIndex < this.howtothread.steps.length ) {
                    return this.howtothread.steps[stepIndex];
                } else {
                    return null;
                }
            }
        },
        computed: {
            currstep() {
                let stepIndex = (this.currposi - 1)
                return this.getStep(stepIndex)
            },
            prevstep() {
                let stepIndex = (this.currposi - 2)
                return this.getStep(stepIndex)
            },
            nextstep() {
                let stepIndex = (this.currposi + 0)
                return this.getStep(stepIndex)
            }
        }
    }
</script>

<style scoped>

</style>
