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
                                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" v-model="searchEsims">
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
                                <span class="text text-xs">Numero</span>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 col-6">
                                <span class="text text-xs">IMSI</span>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6">
                                <span class="text text-xs">ICCID</span>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-2 col-6">
                                <span class="text text-xs">Date Attribution</span>
                            </div>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(esim, index) in filteredEsims" v-if="filteredEsims" :key="esim.id" class="text text-xs">
                    <td v-if="index < 10">

                        <div class="row">
                            <div class="col-sm-3 col-6 border-right">
                                <span class="text text-xs">
                                    <small v-if="esim.phonenum">{{ esim.phonenum.numero }}</small>
                                </span>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 col-6 border-right">
                                <span class="text text-xs">
                                    <small>{{ esim.imsi }}</small>
                                </span>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6 border-right">
                                <span class="text text-xs">
                                    <small>{{ esim.iccid }}</small>
                                </span>
                            </div>
                            <!-- /.col -->

                            <div class="col-sm-2 col-6">
                                <span class="text text-xs">
                                    <small v-if="esim.attributed_by">{{ esim.attributed_at | formatDate }}</small>
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
        name: "list-details",
        props: {
            esims_prop: [],
        },
        components: {
        },
        mounted() {
        },
        created() {
        },
        data() {
            return {
                esims: this.esims_prop,
                searchEsims: null,
            };
        },
        computed: {
            filteredEsims() {

                let tempEsims = this.esims

                if (this.searchEsims !== '' && this.searchEsims) {
                    tempEsims = tempEsims.filter((item) => {
                        return item.imsi
                            .toUpperCase()
                            .includes(this.searchEsims.toUpperCase())
                    })
                }

                // Sorting
                tempEsims = tempEsims.sort((a, b) => {
                    let fa = a.imsi.toLowerCase(), fb = b.imsi.toLowerCase()

                    if (fa > fb) {
                        return -1
                    }
                    if (fa < fb) {
                        return 1
                    }
                    return 0
                })

                if (!this.ascending) {
                    tempEsims.reverse()
                }
                // end Sorting

                return tempEsims
            }
        }
    }
</script>

<style scoped>

</style>
