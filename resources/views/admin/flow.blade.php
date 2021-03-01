<canvas id="flow" width="480" height="270" class="chartjs-render-monitor"></canvas>


<script>
    $(function() {

            var config_flow = {
                type: 'line',
                data: {
                    labels: @json($days),
                    datasets: [{
                        label: '访问次数',
                        fill: false,
                        borderColor: 'green',
                        data: @json($all_flow),
                    }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: '今日访问次数：' + {{ $today_flow}}
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
                                labelString: '访问次数'
                            }
                        }]
                    }
                }
            };


            var ctx_flow = document.getElementById('flow').getContext('2d');
            new Chart(ctx_flow, config_flow);

        
    });
</script>