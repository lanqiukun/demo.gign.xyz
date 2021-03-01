<canvas id="user" width="480" height="270" class="chartjs-render-monitor"></canvas>


<script>

$(function() {
    var config_user = {
        type: 'line',
        data: {
            labels: @json($days),
            datasets: [{
                label: '用户增长数量',
                fill: false,
                borderColor: 'coral',
                data: @json($all_user),
            }, {
                label: '短信总发送量',
                fill: false,
                borderColor: 'blue',
                data: @json($all_msg),
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: '今日新增：' + {{ $today_user }}
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: '日期'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: '用户'
                    }
                }]
            }
        }
    };

    var ctx_user = document.getElementById('user').getContext('2d');
    new Chart(ctx_user, config_user);

});
</script>