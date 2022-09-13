<template>
    <canvas :id="chartId"></canvas>
</template>

<script>
    //import Chart from 'chart.js';

    export default {
        name: "monthLineChart",
        props: {
            chartId: {
                type: String,
                default: 'line-chart'
            },
            datasetIdKey: {
                type: String,
                default: 'label'
            },
            width: {
                type: Number,
                default: 400
            },
            height: {
                type: Number,
                default: 400
            },
            cssClasses: {
                default: '',
                type: String
            },
            styles: {
                type: Object,
                default: () => {}
            },
            plugins: {
                type: Array,
                default: () => []
            },
            chartData: {},
            chartOptions: {}
        },
        mounted() {
            console.log("monthLineChart mounted ref: ", this.chartData)
            if (this.chartData) {
                var ctx = document.getElementById(this.chartId).getContext('2d');
                var cdata = this.chartData
                //new Chart(this.$refs.monthLineCanvas, {
                var chart = new Chart(ctx, {
                    // The type of chart we want to create
                    type: 'line',

                    // The data for our dataset
                    data: {
                        labels: this.chartData.labels,
                        datasets: this.chartData.datasets
                    },

                    // Configuration options go here
                    options: {
                        legend: {
                            display: true
                        },
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
