<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    
                    <div class="col-md-4 col-sm-4 border-right">
                        
                        <div v-if="prevstep" class="description-block">
                            <h5 class="description-header">
                                <a href="#">
                                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
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
                                <a href="#">
                                    <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                </a>
                            </h5>
                            <span class="text text-xs">{{ nextstep.title }}</span>
                        </div>
                        <div v-else class="description-block">
                            <h5 class="description-header">
                                <a href="#">
                                    <i class="fa fa-stop-circle" aria-hidden="true"></i>
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
            posisteps_prop: {},
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
                currstep: this.posisteps_prop.current,
                prevstep: this.posisteps_prop.prev,
                nextstep: this.posisteps_prop.next,
                commom_key: 0,
                stepslist_key: this.howtothread_prop.id + '_' + 0,
                collapse_icon: 'fas fa-chevron-down',
                howtostepsgroup_collapse_icon: 'fas fa-chevron-down',
            }
        },
        methods: {
            
        },
        computed: {
            
        }
    }
</script>

<style scoped>

</style>
