<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\BDController;
use App\Order;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $start = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i')) - 660);
        $end = date('Y-m-d H:i:s', strtotime($start) + 120);

        // echo $start . PHP_EOL;
        // echo $end . PHP_EOL;



        $orders = Order::where('created_at', '>=', $start)->where('created_at', '<=', $end)->where('payment_status', 1)->get();

        foreach ($orders as $order) {
            logger('正在为订单号: ' . $order->order_no . '回传百度数据');
            $result = BDController::feedback($order->bd_url, $order->price * 100);
            logger($result);

            if ($result)
                $order->update(['feedback_bd' => 1]);
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
