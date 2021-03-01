<canvas id="order"  width="480" height="270" ></canvas>
<script>
    $(function() {

        var config_order = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        {{$cx}},
                        {{$wx}},
                        {{$vin}},
                        {{$jqx}},
                        {{$njzt}},
                        {{$cph}},
                        {{$jszzt}},
                        {{$wz}},
                    ],
                    backgroundColor: [
                        'cornflowerblue',
                        'crimson',
                        'darkgoldenrod',
                        'darkorchid',
                        'deepskyblue',
                        'darkviolet',
                        'coral',
                        'chartreuse',
                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    '出险',
                    '维保',
                    'VIN',
                    '交强险',
                    '年检',
                    '车牌号',
                    '驾驶证',
                    '违章',
                ]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: '今日成交订单：' + {{$today_order_sum}}
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        };

        var ctx_order = document.getElementById('order').getContext('2d');
        new Chart(ctx_order, config_order);
    });
</script>