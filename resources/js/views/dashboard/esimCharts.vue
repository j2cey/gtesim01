<template>
  <div>
    <h3>Line Chart Example in Vue</h3>
    <div class="chart-div">
      <LineChart :chartData="datamonth" :chartOptions="chartOptions" />
    </div>
  </div>
</template>

<script>
import LineChart from '../charts/Line'

export default {
  name: 'EsimChart',
  props: {
    chartData_prop: []
  },
  components: { LineChart },
  created() {
      
  },
  mounted() {
    this.fetchmonthdata()
  },
  data() {
    return {
      datamonth: {},
      /*
      chartData: {
        labels: [
          'January',
          'February',
          'March',
          'April',
          'May',
          'June',
          'July'
        ],
        datasets: [
          {
            label: 'Data One',
            borderColor: '#4bcc96',
            borderWith: 4,
            pointBackgroundColor: '#000',
            fill: false,
            data: [40, 39, 10, 40, 39, 80, 40]
          }
        ]
      },
      */
      chartOptions: {
          scales: {
            x: {
              grid: {
                display: false
              },
              title: {
                display: true,
                text: "Jours",
                color: "purple",
                font: {
                  size: 12,
                  weight: "regular"
                }
              }
            },
            y: {
              grid: {
                color: "#ccc",
                borderDash: [20, 4],
                borderColor: "black",
                tickColor: "black"
              },
              title: {
                display: true,
                text: "eSims affectées",
                color: "green",
                font: {
                  size: 12,
                  weight: "regular"
                }
              }
            }
          },
          legend: {
            display: true
          },
          responsive: true,
          maintainAspectRatio: false
        }
    }
  },
  methods: {
    fetchmonthdata() {
      axios.get('/dashboards.chartdatamonth/' + '7')
          .then(({data}) => {
            console.log("chartdatamonth: ", data);
            this.datamonth = data
            return data
          });
    }
  }
}
</script>
<style>
</style>