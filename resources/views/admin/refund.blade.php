<canvas id="refund"  width="480" height="270" ></canvas>
<script>
    $(function() {

        var config_refund = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        {{$cx_refund}},
                        {{$wx_refund}},
                        {{$vin_refund}},
                        {{$jqx_refund}},
                        {{$njzt_refund}},
                        {{$cph_refund}},
                        {{$jszzt_refund}},
                        {{$wz_refund}},
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
                    text: '今日退款订单：' + {{$today_all_order_refund}}
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        };

        var ctx_refund = document.getElementById('refund').getContext('2d');
        new Chart(ctx_refund, config_refund);
    });
</script>