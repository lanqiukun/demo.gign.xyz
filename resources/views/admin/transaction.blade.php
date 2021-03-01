<canvas id="transaction" width="480" height="270" class="chartjs-render-monitor"></canvas>


<script>
    $(function() {

        var config_transaction = {
            type: 'line',
            data: {
                labels: @json($days),
                datasets: [{
                    label: '总交易额',
                    borderColor: 'cornflowerblue',
                    data: @json($all_total),
                    fill: false,
                }, {
                    label: '退款金额',
                    fill: false,
                    borderColor: 'coral',
                    data: @json($all_refund),
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: '全部项目（14天数据）'
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
                            labelString: '金额（元）'
                        }
                    }]
                }
            }
        };

        var ctx_transaction = document.getElementById('transaction').getContext('2d');
        new Chart(ctx_transaction, config_transaction);

    });
</script>