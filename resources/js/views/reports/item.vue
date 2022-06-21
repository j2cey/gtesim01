<template>
    <div :id="'reportwrapper_' + report.uuid">
        <div class="card">
            <header>
                <div class="card-header-title row">
                    <div class="col-md-6 col-sm-8 col-12">
                        <span class="text-purple text-sm" @click="reportCollapseClicked()" data-toggle="collapse" :data-parent="'#reportwrapper_' + report.uuid" :href="'#collapse-reports-'+index">
                            {{ report.title }}
                        </span>
                    </div>
                    <div class="col-md-6 col-sm-4 col-12 text-right">
                        <span class="text text-sm">
                            <a type="button" class="btn btn-tool text-success" data-toggle="tooltip" @click="showFlowchart(report)">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a type="button" class="btn btn-tool text-warning" data-toggle="tooltip" @click="editReport(report)">
                                <i class="fa fa-pencil-square-o"></i>
                            </a>
                            <a type="button" class="btn btn-tool" @click="reportCollapseClicked()" data-toggle="collapse" :data-parent="'#reportwrapper_' + report.uuid" :href="'#collapse-reports-'+index">
                                <i :class="currentReportCollapseIcon"></i>
                            </a>
                            <a type="button" class="btn btn-tool text-danger" @click="deleteReport(report.uuid, index)">
                                <i class="fas fa-trash"></i>
                            </a>
                        </span>
                    </div>
                </div>
                <!-- /.user-block -->
            </header>
            <!-- /.card-header -->
            <div :id="'collapse-reports-'+index" class="card-content panel-collapse collapse in">

                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="row card card-default">
                            <div class="card-body">
                                <dt class="text text-xs">Name</dt>
                                <dd class="text text-xs">{{ report.reporttype.name }}</dd>
                                <dt class="text text-xs">Description</dt>
                                <dd class="text text-xs">{{ report.description }}</dd>
                                <dt class="text text-xs">Created at</dt>
                                <dd class="text text-xs">{{ report.created_at | formatDate}}</dd>
                                <dd class="col-sm-8 offset-sm-4 text-xs"></dd>
                            </div>
                        </div>
                        <div class="row card card-default" :id="'reportalerts_' + report.id">
                            <header>
                                <div class="card-header-title row">
                                    <div class="col-md-6 col-sm-8 col-12">
                            <span class="text-olive text-xs" @click="collapseReportAlertsClicked()" data-toggle="collapse" :data-parent="'#reportalerts_' + report.id" :href="'#collapse-reportalerts-'+report.id">
                                Alerts
                            </span>
                                        <b-button size="is-small" type="is-ghost" @click="createReportAlert()"><i class="fas fa-plus"></i></b-button>
                                    </div>
                                    <div class="col-md-6 col-sm-4 col-12 text-right">
                                <span class="text text-sm">
                                    <a type="button" class="btn btn-tool" @click="collapseReportAlertsClicked()" data-toggle="collapse" :data-parent="'#reportalerts_' + report.id" :href="'#collapse-reportalerts-'+report.id">
                                        <i :class="currentReportAlertsCollapseIcon"></i>
                                    </a>
                                </span>
                                    </div>
                                </div>
                            </header>
                            <!-- /.card-header -->
                            <div :id="'collapse-reportalerts-'+report.id" class="card-content panel-collapse collapse in">

                                Loop Throught Alerts Here !

                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9 col-sm-6 col-12">

                        <ReportAttributes :report_prop="report" :reportattributes_prop="report.attributes"></ReportAttributes>

                    </div>
                    <!-- /.col -->
                </div>

            </div>
            <!-- /.card-body -->
            <AddUpdateReport></AddUpdateReport>
        </div>
    </div>
</template>

<script>
    import ReportAttributes from "../reportattributes/list";
    import AddUpdateReport from "./addupdate";

    import ReportBus from "./reportBus";

    export default {
        name: "report-item",
        props: {
            report_prop: {},
            index_prop: {}
        },
        components: {
            AddUpdateReport,
            ReportAttributes
        },
        mounted() {
            ReportBus.$on('report_updated', (updreport) => {
                if (this.report.id === updreport.id) {
                    this.report = updreport
                    window.noty({
                        message: 'Report successfully updated',
                        type: 'success'
                    })
                }
            })
        },
        created() {

        },
        data() {
            return {
                report: this.report_prop,
                index: this.index_prop,
                report_collapse_icon: 'fas fa-chevron-down',
                reportalerts_collapse_icon: 'fas fa-chevron-down'
            }
        },
        methods: {
            editReport(report) {
                ReportBus.$emit('edit_report', { report })
            },
            showFlowchart(report) {
                /*ReportBus.$emit('show_flowchart', report)*/
                window.location = '/reports.flowchart/' + report.uuid
            },
            deleteReport(id, key) {
                this.$swal({
                    html: '<small>Do you really want to delete this Report ?</small>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Oui',
                    cancelButtonText: 'Non'
                }).then((result) => {
                    if(result.value) {

                        axios.delete(`/reports/${id}`)
                            .then(resp => {

                                console.log('report delete resp: ', resp)

                                this.$swal({
                                    html: '<small>Report successfully deleted !</small>',
                                    icon: 'success',
                                    timer: 3000
                                }).then(() => {
                                    ReportBus.$emit('reportaction_deleted', {key, resp})
                                })
                            }).catch(error => {
                            window.handleErrors(error)
                        })

                    } else {
                        // stay here
                    }
                })
            },
            createReportAlert() {

            },
            reportCollapseClicked() {
                if (this.report_collapse_icon === 'fas fa-chevron-down') {
                    this.report_collapse_icon = 'fas fa-chevron-up';
                } else {
                    this.report_collapse_icon = 'fas fa-chevron-down';
                }
            },
            collapseReportAlertsClicked() {
                if (this.reportalerts_collapse_icon === 'fas fa-chevron-down') {
                    this.reportalerts_collapse_icon = 'fas fa-chevron-up';
                } else {
                    this.reportalerts_collapse_icon = 'fas fa-chevron-down';
                }
            }
        },
        computed: {
            currentReportCollapseIcon() {
                return this.report_collapse_icon;
            },
            currentReportAlertsCollapseIcon() {
                return this.reportalerts_collapse_icon;
            }
        }
    }
</script>

<style scoped>

</style>
