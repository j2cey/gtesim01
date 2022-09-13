<template>
    <div class="bg-primary">
        <h1>Hello course</h1>
        <div class="m-5">
            <div class="card col-md-6 offset-md-3">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "course",
        mounted() {
            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',

                // The data for our dataset
                data: {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [{
                        label: "My First dataset",
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: [0, 10, 5, 2, 20, 30, 45],
                    }]
                },

                // Configuration options go here
                options: {}
            });
        }
    }
</script>

<style scoped>

</style>
