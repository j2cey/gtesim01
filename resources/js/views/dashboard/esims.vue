<template>
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">eSIM Libres</span>
                        <span class="info-box-number">{{ rawstats ? rawstats.libres : 0 }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">eSIM affectées</span>
                        <span class="info-box-number">{{ rawstats ? rawstats.attribuees : 0 }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Clients eSIM</span>
                        <span class="info-box-number">{{ rawstats ? rawstats.clientsesim : 0 }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Utilisateurs actifs</span>
                        <span class="info-box-number">{{ rawstats ? rawstats.activesusers : 0 }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="row mb-3 no-gutters" style="padding: 0 !important;">
                    <div class="col-10">
                        <multiselect
                            id="m_select_departement"
                            v-model="currdepartement"
                            selected.sync="departements"
                            value=""
                            :options="departements"
                            :searchable="true"
                            :multiple="false"
                            label="intitule"
                            track-by="id"
                            key="id"
                            placeholder="Agence"
                            @input="fetchallstats"
                            :disabled="someFetchsAreLoading"
                        >
                        </multiselect>
                    </div>
                    <div class="col-2">
                        <b-button :loading="someFetchsAreLoading" type="is-light" size="is-small" @click="clearSelectedAgence()"><i class="fa fa-times"></i></b-button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3" v-if="agenceHasStats">
                <div class="info-box bg-danger">
                    <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text text-sm">eSIM affectées <small>(agence)</small> </span>
                        <span class="info-box-number">{{ agencestats ? agencestats.attribuees : 0 }} <span class="badge badge-light">{{ attribueesAgenceRate }}%</span> </span>

                        <div class="progress">
                            <div class="progress-bar" :style=" 'width:' + attribueesAgenceRate + '%;'"></div>
                        </div>
                        <span class="progress-description"></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up" v-if="agenceHasStats"></div>

            <div class="col-12 col-sm-6 col-md-3" v-if="agenceHasStats">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text text-sm">Clients eSIM <small>(agence)</small> </span>
                        <span class="info-box-number">{{ agencestats ? agencestats.clientsesim : 0 }} <span class="badge badge-light">{{ clientsesimAgenceRate }}%</span> </span>

                        <div class="progress">
                            <div class="progress-bar" :style=" 'width:' + clientsesimAgenceRate + '%;'"></div>
                        </div>
                        <span class="progress-description"></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3" v-if="agenceHasStats">
                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text text-sm">Utilisateurs actifs <small>(agence)</small> </span>
                        <span class="info-box-number">{{ agencestats ? agencestats.activesusers : 0 }} <span class="badge badge-light">{{ activesusersAgenceRate }}%</span> </span>

                        <div class="progress">
                            <div class="progress-bar" :style=" 'width:' + activesusersAgenceRate + '%;'"></div>
                        </div>
                        <span class="progress-description"><a @click="showDahboardDetails(currdepartement)" class="small-box-footer">Plus de details <i class="fas fa-arrow-circle-right"></i></a>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-md-6 col-sm-8 col-12">
                            <h5 class="card-title">Recap Hebdomadaire <small> {{ agenceHasStats ? " (" + currdepartement.intitule + ")" : "" }} </small> </h5>
                        </div>

                        <div class="col-md-6 col-sm-4 col-12 text-right">
                            <div class="btn-group">
                                <multiselect
                                    id="m_select_week"
                                    v-model="currentweek"
                                    selected.sync="weeksofyear"
                                    value=""
                                    :options="weeksofyear"
                                    :searchable="true"
                                    :multiple="false"
                                    label="label"
                                    track-by="value"
                                    key="value"
                                    placeholder="Semaine"
                                    @input="fetchweekstats"
                                >
                                </multiselect>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-center">
                                    <span class="text text-sm text-bold">Affectations Hebdo</span>
                                </p>

                                <div class="chart">
                                    <week-line-chart :key="week_chart_data_key" chartId="weekLineStats" :chartData="weekChartData"></week-line-chart>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <p class="text-center">
                                    <span class="text text-sm text-bold">{{ topPerformsLabel }}</span>
                                </p>

                                <div class="progress-group" v-if="weekstats && weekstats.statlabel_first">
                                    <span class="progress-text text text-xs">{{ weekstats.statlabel_first.label_full }}</span>
                                    <span class="float-right text text-sm"><b>{{ weekstats.statlabel_first.count }}</b>/{{ weekstats.count }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" :style=" 'width:' + weekstats.statlabel_first.rate + '%; background-color:' + weekstats.statlabel_first.color.hex "></div>
                                    </div>
                                </div>

                                <div class="progress-group" v-if="weekstats && weekstats.statlabel_second">
                                    <span class="progress-text text text-xs">{{ weekstats.statlabel_second.label_full }}</span>
                                    <span class="float-right text text-sm"><b>{{ weekstats.statlabel_second.count }}</b>/{{ weekstats.count }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" :style=" 'width:' + weekstats.statlabel_second.rate + '%; background-color:' + weekstats.statlabel_second.color.hex "></div>
                                    </div>
                                </div>

                                <div class="progress-group" v-if="weekstats && weekstats.statlabel_third">
                                    <span class="progress-text text text-xs">{{ weekstats.statlabel_third.label_full }}</span>
                                    <span class="float-right text text-sm"><b>{{ weekstats.statlabel_third.count }}</b>/{{ weekstats.count }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" :style=" 'width:' + weekstats.statlabel_third.rate + '%; background-color:' + weekstats.statlabel_third.color.hex "></div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
                    <div v-if="weekstats_loading" class="overlay dark">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-md-6 col-sm-8 col-12">
                            <h5 class="card-title">Recap Mensuel <small> {{ agenceHasStats ? " (" + currdepartement.intitule + ")" : "" }} </small> </h5>
                        </div>

                        <div class="col-md-6 col-sm-4 col-12 text-right">
                            <div class="btn-group">
                                <multiselect
                                    id="m_select_month"
                                    v-model="currentmonth"
                                    selected.sync="monthsofyear"
                                    value=""
                                    :options="monthsofyear"
                                    :searchable="true"
                                    :multiple="false"
                                    label="label"
                                    track-by="value"
                                    key="value"
                                    placeholder="Mois"
                                    @input="fetchmonthstats"
                                >
                                </multiselect>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-center">
                                    <span class="text text-sm text-bold">Affectations Mensuelles</span>
                                </p>

                                <div class="chart">
                                    <month-line-chart :key="month_chart_data_key" chartId="monthLineStats" :chartData="monthChartData"></month-line-chart>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <p class="text-center">
                                    <span class="text text-sm text-bold">{{ topPerformsLabel }}</span>
                                </p>

                                <div class="progress-group" v-if="monthstats && monthstats.statlabel_first">
                                    <span class="progress-text text text-xs">{{ monthstats.statlabel_first.label_full }}</span>
                                    <span class="float-right text text-sm"><b>{{ monthstats.statlabel_first.count }}</b>/{{ monthstats.count }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" :style=" 'width:' + monthstats.statlabel_first.rate + '%; background-color:' + monthstats.statlabel_first.color.hex "></div>
                                    </div>
                                </div>

                                <div class="progress-group" v-if="monthstats && monthstats.statlabel_second">
                                    <span class="progress-text text text-xs">{{ monthstats.statlabel_second.label_full }}</span>
                                    <span class="float-right text text-sm"><b>{{ monthstats.statlabel_second.count }}</b>/{{ monthstats.count }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" :style=" 'width:' + monthstats.statlabel_second.rate + '%; background-color:' + monthstats.statlabel_second.color.hex "></div>
                                    </div>
                                </div>

                                <div class="progress-group" v-if="monthstats && monthstats.statlabel_third">
                                    <span class="progress-text text text-xs">{{ monthstats.statlabel_third.label_full }}</span>
                                    <span class="float-right text text-sm"><b>{{ monthstats.statlabel_third.count }}</b>/{{ monthstats.count }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" :style=" 'width:' + monthstats.statlabel_third.rate + '%; background-color:' + monthstats.statlabel_third.color.hex "></div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
                    <div v-if="monthstats_loading" class="overlay dark">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-md-6 col-sm-8 col-12">
                            <h5 class="card-title">Recap Annuel <small> {{ agenceHasStats ? " (" + currdepartement.intitule + ")" : "" }} </small> </h5>
                        </div>

                        <div class="col-md-6 col-sm-4 col-12 text-right">
                            <div class="btn-group">
                                <multiselect
                                    id="m_select_year"
                                    v-model="currentyear"
                                    selected.sync="yearslist"
                                    value=""
                                    :options="yearslist"
                                    :searchable="true"
                                    :multiple="false"
                                    label="label"
                                    track-by="value"
                                    key="value"
                                    placeholder="Années"
                                    @input="fetchyearstats"
                                >
                                </multiselect>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-center">
                                    <span class="text text-sm text-bold">Affectations Annuelles</span>
                                </p>

                                <div class="chart">
                                    <year-line-chart :key="year_chart_data_key" chartId="yearLineStats" :chartData="yearChartData"></year-line-chart>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <p class="text-center">
                                    <span class="text text-sm text-bold">{{ topPerformsLabel }}</span>
                                </p>

                                <div class="progress-group" v-if="yearstats && yearstats.statlabel_first">
                                    <span class="progress-text text text-xs">{{ yearstats.statlabel_first.label_full }}</span>
                                    <span class="float-right text text-sm"><b>{{ yearstats.statlabel_first.count }}</b>/{{ yearstats.count }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" :style=" 'width:' + yearstats.statlabel_first.rate + '%; background-color:' + yearstats.statlabel_first.color.hex "></div>
                                    </div>
                                </div>

                                <div class="progress-group" v-if="yearstats && yearstats.statlabel_second">
                                    <span class="progress-text text text-xs">{{ yearstats.statlabel_second.label_full }}</span>
                                    <span class="float-right text text-sm"><b>{{ yearstats.statlabel_second.count }}</b>/{{ yearstats.count }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" :style=" 'width:' + yearstats.statlabel_second.rate + '%; background-color:' + yearstats.statlabel_second.color.hex "></div>
                                    </div>
                                </div>

                                <div class="progress-group" v-if="yearstats && yearstats.statlabel_third">
                                    <span class="progress-text text text-xs">{{ yearstats.statlabel_third.label_full }}</span>
                                    <span class="float-right text text-sm"><b>{{ yearstats.statlabel_third.count }}</b>/{{ yearstats.count }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" :style=" 'width:' + yearstats.statlabel_third.rate + '%; background-color:' + yearstats.statlabel_third.color.hex "></div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
                    <div v-if="yearstats_loading" class="overlay dark">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </div><!--/. container-fluid -->
</template>

<script>
    import Multiselect from 'vue-multiselect'
    //import monthLineChart from './lineChart'

    export default {
        name: "esims-dashboard",
        components: {
            Multiselect,
            monthLineChart: () => import('./lineChart'),
            weekLineChart: () => import('./lineChart'),
            yearLineChart: () => import('./lineChart'),
        },
        mounted() {
            this.initmonthstats()
            this.initweekstats()
            this.initrawstats()

            this.inityearstats()
        },
        created() {
            axios.get('/departements.fetchall')
                .then(({data}) => this.departements = data);
        },
        data() {
            return {
                rawstats: null,
                agencestats: null,

                monthsofyear: [],
                currentmonth: null,
                monthstats: null,

                weeksofyear: [],
                currentweek: null,
                weekstats: null,

                yearslist: [],
                currentyear: null,
                yearstats: null,

                month_key: 0,
                week_key: 0,
                year_key: 0,

                departements: [],
                currdepartement: null,

                month_chart_data_key: '_month_chart_data_' + 0,
                week_chart_data_key: '_week_chart_data_' + 0,
                year_chart_data_key: '_year_chart_data_' + 0,

                weekstats_loading: true,
                monthstats_loading: true,
                yearstats_loading: true,
            }
        },
        methods: {

            showDahboardDetails(agence) {
                window.location = '/dashboards.details/' + agence.id
            },

            forceRerenderMonthLineChart() {
                this.month_key += 1;
                this.month_chart_data_key = '_month_chart_data_' + this.month_key;
            },

            forceRerenderWeekLineChart() {
                this.week_key += 1;
                this.week_chart_data_key = '_week_chart_data_' + this.week_key;
            },

            forceRerenderYearLineChart() {
                this.year_key += 1;
                this.year_chart_data_key = '_year_chart_data_' + this.year_key;
            },

            inityearstats() {
                this.fetchcurrentyear(true)
                this.fetchyears()
            },

            initmonthstats() {
                this.fetchcurrentmonth(true)
                this.fetchmonthsofyear()
            },

            initweekstats() {
                this.fetchcurrentweek(true)
                this.fetchweeksofyear()
            },

            initrawstats() {
                this.fetchrawstats()
            },

            clearSelectedAgence() {

                if ( this.currdepartement !== null ) {
                    this.currdepartement = null
                    this.fetchallstats()
                }

            },

            fetchrawstats() {
                axios.get('/dashboards.fetchrawstats')
                    .then(({data}) => {
                        //console.log("rawstats: ", data);
                        this.rawstats = data
                        return data
                    });
            },

            fetchagencestats() {
                let agence = this.currdepartement ? this.currdepartement.id : -1
                axios.get('/dashboards.fetchagencestats/' + agence)
                    .then(({data}) => {
                        //console.log("rawstats: ", data);
                        this.agencestats = data
                        return data
                    });
            },

            fetchmonthsofyear() {
                axios.get('/dashboards.fetchmonthsofyear')
                    .then(({data}) => {
                        //console.log("monthsofyear: ", data);
                        this.monthsofyear = data
                        return data
                    });
            },
            async fetchcurrentmonth(fetchstats) {
                axios.get('/dashboards.fetchcurrentmonth')
                    .then(({data}) => {
                        //console.log("currentmonth: ", data);
                        this.currentmonth = data //{ label: "Juillet", value: 7 }
                        if (fetchstats) {
                            this.fetchmonthstats()
                        }
                        return data
                    });
            },
            fetchmonthstats() {
                this.monthstats_loading = true

                let month = this.currentmonth.value
                let agence = this.currdepartement ? this.currdepartement.id : -1

                axios.get('/dashboards.fetchmonthstats/' + month + '/' + agence)
                    .then(({data}) => {
                        this.monthstats_loading = false
                        //console.log("monthstats (" + month + "): ", data);
                        this.monthstats = data
                        this.forceRerenderMonthLineChart()
                        return data
                    });
            },

            fetchweeksofyear() {
                axios.get('/dashboards.fetchweeksofyear')
                    .then(({data}) => {
                        //console.log("weeksofyear: ", data);
                        this.weeksofyear = data
                        return data
                    });
            },
            async fetchcurrentweek(fetchstats) {
                axios.get('/dashboards.fetchcurrentweek')
                    .then(({data}) => {
                        //console.log("currentweek: ", data);
                        this.currentweek = data
                        if (fetchstats) {
                            this.fetchweekstats()
                        }
                        return data
                    });
            },
            fetchweekstats() {
                this.weekstats_loading = true

                let week = this.currentweek.value
                let agence = this.currdepartement ? this.currdepartement.id : -1

                axios.get('/dashboards.fetchweekstats/' + week + '/' + agence)
                    .then(({data}) => {
                        this.weekstats_loading = false

                        //console.log("monthstats (" + month + "): ", data);
                        this.weekstats = data
                        this.forceRerenderWeekLineChart()
                        return data
                    });
            },

            fetchyears() {
                axios.get('/dashboards.fetchyears')
                    .then(({data}) => {
                        this.yearslist = data
                        return data
                    });
            },
            async fetchcurrentyear(fetchstats) {
                axios.get('/dashboards.fetchcurrentyear')
                    .then(({data}) => {
                        //console.log("current year: ", data)
                        this.currentyear = data
                        if (fetchstats) {
                            this.fetchyearstats()
                        }
                        return data
                    });
            },
            fetchyearstats() {
                this.yearstats_loading = true

                let year = this.currentyear.value
                let agence = this.currdepartement ? this.currdepartement.id : -1

                axios.get('/dashboards.fetchyearstats/' + year + '/' + agence)
                    .then(({data}) => {
                        this.yearstats_loading = false

                        this.yearstats = data
                        this.forceRerenderYearLineChart()
                        return data
                    });
            },

            fetchallstats() {
                this.fetchagencestats()

                this.fetchweekstats()
                this.fetchmonthstats()
                this.fetchyearstats()
            },

            getChartData(chartjsdata) {
                let cdata = null;

                if (chartjsdata) {
                    cdata = {
                        labels: chartjsdata.labels,
                        datasets: []
                    };

                    var length = chartjsdata.datasets.length;
                    for (var i = 0; i < length; i++) {
                        // Do something with yourArray[i].
                        cdata.datasets[i] = {

                            pointBorderWidth: 0,
                            pointRadius: 1,

                            'label': chartjsdata.datasets[i].label,

                            'backgroundColor': chartjsdata.datasets[i].backgroundColor,
                            'borderColor': chartjsdata.datasets[i].borderColor,
                            'borderWidth': chartjsdata.datasets[i].borderWidth,
                            'fill': chartjsdata.datasets[i].fill,

                            pointBackgroundColor: 'black',
                            pointBorderColor: chartjsdata.datasets[i].backgroundColor,

                            'data': Object.values( chartjsdata.datasets[i].data )
                        }
                    }
                }

                return cdata;
            },
        },
        computed: {
            monthChartData() {
                return this.monthstats ? this.getChartData( this.monthstats.chartjsdata ) : null;
            },

            weekChartData() {
                return this.weekstats ? this.getChartData( this.weekstats.chartjsdata ) : null;
            },

            yearChartData() {
                return this.yearstats ? this.getChartData( this.yearstats.chartjsdata ) : null;
            },

            agenceHasStats() {
                return !!(this.currdepartement && this.agencestats);
                /*if (this.currdepartement && this.agencestats) {
                    return (this.agencestats.attribuees > 0) || (this.agencestats.clientsesim > 0) || (this.agencestats.activesusers > 0)
                } else {
                    return false
                }*/
            },
            attribueesAgenceRate() {
                return this.agencestats ? parseFloat( this.agencestats.attribuees / this.rawstats.attribuees ).toFixed(2) : null
            },
            clientsesimAgenceRate() {
                return this.agencestats ? parseFloat( this.agencestats.clientsesim / this.rawstats.clientsesim ).toFixed(2) : null
            },
            activesusersAgenceRate() {
                return this.agencestats ? parseFloat( this.agencestats.activesusers / this.rawstats.activesusers ).toFixed(2) : null
            },

            topPerformsLabel() {
                return this.agenceHasStats ? "Top Agents" : "Top Agences"
            },

            someFetchsAreLoading() {
                return this.weekstats_loading || this.monthstats_loading || this.yearstats_loading
            }
        }
    }
</script>

<style scoped>

</style>
