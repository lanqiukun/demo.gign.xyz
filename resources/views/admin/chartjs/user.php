<canvas id="myChart" width="400" height="100"></canvas>
<script>
$(function () {
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
                label: '交易金额',
                data: [12, 19, 13, 25, 22, 23],
                backgroundColor: 'coral',
                borderWidth: 1,
                fill: false,
            },{
                label: '退款金额',
                data: [2, 4, 3, 5, 2, 3],
                backgroundColor: 'green',
                borderWidth: 1,
                fill: false,
                
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
});
</script>