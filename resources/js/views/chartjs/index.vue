<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <div class="card-tools">
                        <div class="btn-group">
                            <button type="button" class="btn btn-tool" data-toggle="dropdown">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" user="menu">
                                <a v-for="(course, index) in courses" v-if="courses" :key="course.id" @click="goToCourse(course)" class="dropdown-item text-xs">{{ course.title }}</a>
                                <a class="dropdown-divider"></a>
                                <a @click="closeAll()" class="dropdown-item text-xs text-danger">Close</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 border-right">

                        <div v-if="prevcourse" class="description-block">
                            <h5 class="description-header">
                                <a @click="goToCourse(prevcourse)">
                                    <i class="fa fa-arrow-circle-left text-warning" aria-hidden="true"></i>
                                </a>
                            </h5>
                            <span class="text text-xs">{{ prevcourse.posi + '. ' + prevcourse.title }}</span>
                        </div>

                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4 col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><i class="fa fa-circle" aria-hidden="true"></i></h5>
                            <span class="text text-xs">{{ currcourse.posi + '. ' + currcourse.title }}</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4 col-sm-4">
                        <div v-if="nextcourse" class="description-block">
                            <h5 class="description-header">
                                <a @click="goToCourse(nextcourse)">
                                    <i class="fa fa-arrow-circle-right text-success" aria-hidden="true"></i>
                                </a>
                            </h5>
                            <span class="text text-xs">{{ nextcourse.posi + '. ' + nextcourse.title }}</span>
                        </div>
                        <div v-else class="description-block">
                            <h5 class="description-header">
                                <a @click="closeAll()">
                                    <i class="fa fa-stop-circle text-danger" aria-hidden="true"></i>
                                </a>
                            </h5>
                            <span class="text text-xs">Close</span>
                        </div>
                        <!-- /.description-block -->
                    </div>

                </div>

                <div class="card-body">
                    <component :ref="currcourse.id" :is="currcourse.component"></component>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "index",
        components: {
            course: () => import('./course'),
            linechartjs: () => import('./linechartjs'),
        },
        data() {
            return {
                courses: [
                    {
                        'id': 0,
                        'posi': 1,
                        'title': "Intro",
                        'component': "course"
                    },
                    {
                        'id': 1,
                        'posi': 2,
                        'title': "Line Chart",
                        'component': "linechartjs"
                    }
                ],
                currposi: 2,
                commom_key: 0,
                courseslist_key: '0' + '_' + 0,
                collapse_icon: 'fas fa-chevron-down',
                howtostepsgroup_collapse_icon: 'fas fa-chevron-down',
            }
        },
        methods: {
            goToCourse(step) {
                this.currposi = step.posi
            },
            closeAll() {
                window.location = '/'
            },
            getCourse(courseIndex) {
                if ( courseIndex >= 0 && courseIndex < this.courses.length ) {
                    return this.courses[courseIndex];
                } else {
                    return null;
                }
            }
        },
        computed: {
            currcourse() {
                let courseIndex = (this.currposi - 1)
                return this.getCourse(courseIndex)
            },
            prevcourse() {
                let courseIndex = (this.currposi - 2)
                return this.getCourse(courseIndex)
            },
            nextcourse() {
                let courseIndex = (this.currposi + 0)
                return this.getCourse(courseIndex)
            }
        }
    }
</script>

<style scoped>

</style>
