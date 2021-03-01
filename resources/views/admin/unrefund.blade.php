<canvas id="unrefund"  width="480" height="270" ></canvas>
<script>
    $(function() {


        var config_unrefund = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        {{$cx_unrefund}},
                        {{$wx_unrefund}},
                        {{$vin_unrefund}},
                        {{$jqx_unrefund}},
                        {{$njzt_unrefund}},
                        {{$cph_unrefund}},
                        {{$jszzt_unrefund}},
                        {{$wz_unrefund}},
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
                    text: '今日已支付未退款订单：' + {{$today_all_order_unrefund}}
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        };

        var ctx_unrefund = document.getElementById('unrefund').getContext('2d');
        new Chart(ctx_unrefund, config_unrefund);
    });
</script>