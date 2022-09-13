<script>
  import { Line } from 'vue-chartjs'

  export default {
    extends: Line,
    props: ["chartData", "options"],
    data () {
      return {
      }
    },
    mounted () {
      this.renderChart(this.chartData, this.options)
    }
  }
</script>