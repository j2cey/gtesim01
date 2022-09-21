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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-md-6 col-sm-8 col-12">
                            <h5 class="card-title">Recap Hebdomadaire</h5>
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
                                    <strong>Affectations Hebdo</strong>
                                </p>

                                <div class="chart">
                                    <week-line-chart :key="week_chart_data_key" chartId="weekLineStats" :chartData="weekChartData"></week-line-chart>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <p class="text-center">
                                    <strong>Top Agences</strong>
                                </p>

                                <div class="progress-group" v-if="weekstats && weekstats.agence_first">
                                    <span class="progress-text">{{ weekstats.agence_first.label_full }}</span>
                                    <span class="float-right"><b>{{ weekstats.agence_first.count }}</b>/{{ weekstats.count }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" :style=" 'width:' + weekstats.agence_first.rate + '%; background-color:' + weekstats.agence_first.color.hex "></div>
                                    </div>
                                </div>

                                <div class="progress-group" v-if="weekstats && weekstats.agence_second">
                                    <span class="progress-text">{{ weekstats.agence_second.label_full }}</span>
                                    <span class="float-right"><b>{{ weekstats.agence_second.count }}</b>/{{ weekstats.count }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" :style=" 'width:' + weekstats.agence_second.rate + '%; background-color:' + weekstats.agence_second.color.hex "></div>
                                    </div>
                                </div>

                                <div class="progress-group" v-if="weekstats && weekstats.agence_third">
                                    <span class="progress-text">{{ weekstats.agence_third.label_full }}</span>
                                    <span class="float-right"><b>{{ weekstats.agence_third.count }}</b>/{{ weekstats.count }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" :style=" 'width:' + weekstats.agence_third.rate + '%; background-color:' + weekstats.agence_third.color.hex "></div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
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
                            <h5 class="card-title">Recap Mensuel</h5>
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
                                    <strong>Affectations Mensuelles</strong>
                                </p>

                                <div class="chart">
                                    <month-line-chart :key="month_chart_data_key" chartId="monthLineStats" :chartData="monthChartData"></month-line-chart>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <p class="text-center">
                                    <strong>Top Agences</strong>
                                </p>

                                <div class="progress-group" v-if="monthstats && monthstats.agence_first">
                                    <span class="progress-text">{{ monthstats.agence_first.label_full }}</span>
                                    <span class="float-right"><b>{{ monthstats.agence_first.count }}</b>/{{ monthstats.count }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" :style=" 'width:' + monthstats.agence_first.rate + '%; background-color:' + monthstats.agence_first.color.hex "></div>
                                    </div>
                                </div>

                                <div class="progress-group" v-if="monthstats && monthstats.agence_second">
                                    <span class="progress-text">{{ monthstats.agence_second.label_full }}</span>
                                    <span class="float-right"><b>{{ monthstats.agence_second.count }}</b>/{{ monthstats.count }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" :style=" 'width:' + monthstats.agence_second.rate + '%; background-color:' + monthstats.agence_second.color.hex "></div>
                                    </div>
                                </div>

                                <div class="progress-group" v-if="monthstats && monthstats.agence_third">
                                    <span class="progress-text">{{ monthstats.agence_third.label_full }}</span>
                                    <span class="float-right"><b>{{ monthstats.agence_third.count }}</b>/{{ monthstats.count }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" :style=" 'width:' + monthstats.agence_third.rate + '%; background-color:' + monthstats.agence_third.color.hex "></div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
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
                            <h5 class="card-title">Recap Annuel</h5>
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
                                    <strong>Affectations Annuelles</strong>
                                </p>

                                <div class="chart">
                                    <year-line-chart :key="year_chart_data_key" chartId="yearLineStats" :chartData="yearChartData"></year-line-chart>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <p class="text-center">
                                    <strong>Top Agences</strong>
                                </p>

                                <div class="progress-group" v-if="yearstats && yearstats.agence_first">
                                    <span class="progress-text">{{ yearstats.agence_first.label_full }}</span>
                                    <span class="float-right"><b>{{ yearstats.agence_first.count }}</b>/{{ yearstats.count }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" :style=" 'width:' + yearstats.agence_first.rate + '%; background-color:' + yearstats.agence_first.color.hex "></div>
                                    </div>
                                </div>

                                <div class="progress-group" v-if="yearstats && yearstats.agence_second">
                                    <span class="progress-text">{{ yearstats.agence_second.label_full }}</span>
                                    <span class="float-right"><b>{{ yearstats.agence_second.count }}</b>/{{ yearstats.count }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" :style=" 'width:' + yearstats.agence_second.rate + '%; background-color:' + yearstats.agence_second.color.hex "></div>
                                    </div>
                                </div>

                                <div class="progress-group" v-if="yearstats && yearstats.agence_third">
                                    <span class="progress-text">{{ yearstats.agence_third.label_full }}</span>
                                    <span class="float-right"><b>{{ yearstats.agence_third.count }}</b>/{{ yearstats.count }}</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar" :style=" 'width:' + yearstats.agence_third.rate + '%; background-color:' + yearstats.agence_third.color.hex "></div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
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
        data() {
            return {
                rawstats: null,

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

                month_chart_data_key: '_month_chart_data_' + 0,
                week_chart_data_key: '_week_chart_data_' + 0,
                year_chart_data_key: '_year_chart_data_' + 0,
            }
        },
        methods: {

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

            fetchrawstats() {
                axios.get('/dashboards.fetchrawstats')
                    .then(({data}) => {
                        //console.log("rawstats: ", data);
                        this.rawstats = data
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
                let month = this.currentmonth.value

                axios.get('/dashboards.fetchmonthstats/' + month)
                    .then(({data}) => {
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
                let week = this.currentweek.value

                axios.get('/dashboards.fetchweekstats/' + week)
                    .then(({data}) => {
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
                let year = this.currentyear.value

                axios.get('/dashboards.fetchyearstats/' + year)
                    .then(({data}) => {
                        this.yearstats = data
                        this.forceRerenderYearLineChart()
                        return data
                    });
            },

            getChartData(chartjsdata) {
                let cdata = null;

                if (chartjsdata) {
                    //console.log("computed monthChartData: ", this.monthstats)
                    //console.log("computed agences: ", Object.values( this.monthstats.agences ))
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
        }
    }
</script>

<style scoped>

</style>
