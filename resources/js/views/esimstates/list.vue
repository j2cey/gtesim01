<template>
    <div class="card card-default">

        <div class="card-body table-responsive p-0">
            <table class="table table-head-fixed text-nowrap">
                <thead>
                <tr>
                    <th>
                        <div class="row">
                            <div class="col-sm-3 col-2">
                                <span class="text text-xs"></span>
                            </div>
                            <div class="col-sm-3 col-2">
                            </div>
                            <div class="col-sm-3 col-2">
                            </div>
                            <div class="col-sm-6 col-6 align-right">
                                <div class="btn-group">
                                    <div class="input-group input-group-sm">
                                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" v-model="searchEsimStates">
                                        <div class="input-group-append">
                                            <button class="btn btn-navbar" type="button">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 col-6">
                                <span class="text text-xs">User</span>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 col-6">
                                <span class="text text-xs">Statut</span>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6">
                                <span class="text text-xs">Details</span>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-2 col-6">
                                <span class="text text-xs">Date</span>
                            </div>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(esimstate, index) in filteredEsimStates" v-if="filteredEsimStates" :key="esimstate.id" class="text text-xs">
                    <td v-if="index < 10">

                        <div class="row">
                            <div class="col-sm-3 col-6 border-right">
                                <span class="text text-xs">
                                    <small v-if="esimstate.user">{{ esimstate.user.name }}</small>
                                </span>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 col-6 border-right">
                                <span class="text text-xs">
                                    <small v-if="esimstate.statutesim">{{ esimstate.statutesim.libelle }}</small>
                                </span>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6 border-right">
                                <span class="text text-xs">
                                    <small>{{ esimstate.details }}</small>
                                </span>
                            </div>
                            <!-- /.col -->

                            <div class="col-sm-2 col-6">
                                <span class="text text-xs">
                                    <small v-if="esimstate.created_at">{{ esimstate.created_at | formatDate }}</small>
                                </span>
                            </div>
                            <!-- /.col -->

                        </div>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        name: "esimstate-list",
        props: {
            esimstates_prop: [],
        },
        components: {
        },
        mounted() {
        },
        created() {
        },
        data() {
            return {
                esimstates: this.esimstates_prop,
                searchEsimStates: null,
            };
        },
        computed: {
            filteredEsimStates() {

                let tempEsimStates = this.esimstates

                if (this.searchEsimStates !== '' && this.searchEsimStates) {
                    tempEsimStates = tempEsimStates.filter((item) => {
                        return item.details
                            .toUpperCase()
                            .includes(this.searchEsimStates.toUpperCase())
                    })
                }

                // Sorting
                tempEsimStates = tempEsimStates.sort((a, b) => {
                    let fa = a.details.toLowerCase(), fb = b.details.toLowerCase()

                    if (fa > fb) {
                        return -1
                    }
                    if (fa < fb) {
                        return 1
                    }
                    return 0
                })

                if (!this.ascending) {
                    tempEsimStates.reverse()
                }
                // end Sorting

                return tempEsimStates
            }
        }
    }
</script>

<style scoped>

</style>
