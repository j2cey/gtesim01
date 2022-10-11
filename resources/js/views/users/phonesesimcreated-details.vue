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
                                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" v-model="searchPhones">
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
                                <span class="text text-xs">Date</span>
                            </div>
                        </div>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(phonenum, index) in filteredPhones" v-if="filteredPhones" :key="phonenum.id" class="text text-xs">
                    <td v-if="index < 10">

                        <div class="row">
                            <div class="col-sm-3 col-6 border-right">
                                <span class="text text-xs">
                                    <small>{{ phonenum.numero }}</small>
                                </span>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 col-6 border-right">
                                <span class="text text-xs">
                                    <small>{{ phonenum.esim.imsi }}</small>
                                </span>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6 border-right">
                                <span class="text text-xs">
                                    <small>{{ phonenum.esim.iccid }}</small>
                                </span>
                            </div>
                            <!-- /.col -->

                            <div class="col-sm-2 col-6">
                                <span class="text text-xs">
                                    <small>{{ phonenum.created_at | formatDate }}</small>
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
        name: "phonesesimcreated-details",
        props: {
            phonenums_prop: [],
        },
        components: {
        },
        mounted() {
        },
        created() {
        },
        data() {
            return {
                phonenums: this.phonenums_prop,
                searchPhones: null,
            };
        },
        computed: {
            filteredPhones() {

                let tempPhones = this.phonenums

                if (this.searchPhones !== '' && this.searchPhones) {
                    tempPhones = tempPhones.filter((item) => {
                        return item.numero
                            .toUpperCase()
                            .includes(this.searchPhones.toUpperCase())
                    })
                }

                // Sorting
                tempPhones = tempPhones.sort((a, b) => {
                    let fa = a.numero.toLowerCase(), fb = b.numero.toLowerCase()

                    if (fa > fb) {
                        return -1
                    }
                    if (fa < fb) {
                        return 1
                    }
                    return 0
                })

                if (!this.ascending) {
                    tempPhones.reverse()
                }
                // end Sorting

                return tempPhones
            }
        }
    }
</script>

<style scoped>

</style>
