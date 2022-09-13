<template>
    <div class="bg-primary">
        <h1>Hello Line Chart</h1>
        <div class="container">
            <div class="row align-items-center">
                <div class="card col-md-6 offset-md-3">
                    <canvas id="myLineChart"></canvas>
                </div>
            </div>
        </div>
        <img class="d-none" id="source" src="https://www.glamouratiuk.com/include/thumbnail.asp?sFile=/file-manager/Products/Stencils/star-3.jpg&iWidth=65" width="25" height="25" alt="">
    </div>
</template>

<script>
    export default {
        name: "line-chartjs",
        mounted() {
            var image = document.getElementById('source');
            var ctx = document.getElementById('myLineChart').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',

                // The data for our dataset
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July"],
                    datasets: [
                        {
                            label: "My Sales",
                            backgroundColor: 'rgba(255, 99, 132,1)',
                            borderColor: 'blue',
                            borderWidth: 2,
                            borderDash: [10],
                            borderDashOffset: 10,
                            borderCapStyle: "square",
                            borderJoinStyle: "bevel",
                            //cubicInterpolationMode: "monotone",
                            fill: "start",
                            lineTension: 0.4, // default 0.4
                            pointBackgroundColor: ["red","green","blue","yellow","pink","purple"],
                            pointBorderColor: "pink",
                            pointBorderWidth: 0,
                            pointRadius: 10,
                            //pointStyle: image,
                            pointHitRadius: 20,
                            pointHoverBackgroundColor: "purple",
                            pointHoverBorderColor: "pink",
                            data: [0, 50, 5, 2, 20, 30, 45],
                        }
                    ]
                },

                // Configuration options go here
                options: {}
            });
        }
    }
</script>

<style scoped>

</style>
