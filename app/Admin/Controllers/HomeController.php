<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SQLController;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Widgets\Callout;


class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title($title = '统计数据')
            ->row(function (Row $row) {

                for ($last = 14; $last >= 0; $last--)
                    $days[] = date('d', strtotime("-${last} day"));
    
                $all_total = SQLController::all_total();
                $all_refund = SQLController::all_refund();
                $row->column(1 / 3, new Box('交易金额', view('admin.transaction', compact(['days', 'all_total', 'all_refund']))));
                
                
                $today_user = DB::select('select count(distinct phone) as today_user from codes where DATE(used_at) = CURDATE() and used_at >= CURDATE();')[0]->today_user;
                $all_user = SQLController::all_user();
                $all_msg = SQLController::all_msg();
                $row->column(1 / 3, new Box('用户增长', view('admin.user', compact(['days', 'all_user','all_msg', 'today_user']))));
                

                $today_flow = DB::select('select count(id) as today_flow from records where DATE(created_at) = CURDATE() and created_at > CURDATE();')[0]->today_flow;
                $all_flow = SQLController::all_flow();
                $row->column(1 / 3, new Box('流量统计', view('admin.flow', compact(['days', 'all_flow', 'today_flow']))));




 
            })->row(function (Row $row) {

                $today_order_sum = DB::select('select count(id) as today_order_sum from orders where payment_status = 1 and created_at >= CURDATE()')[0]->today_order_sum;
                

                $cx     = DB::select('select count(id) as sum from  orders where order_type = 1   and payment_status = 1  and created_at >= CURDATE()')[0]->sum;
                $wx     = DB::select('select count(id) as sum from  orders where order_type = 2   and payment_status = 1  and created_at >= CURDATE()')[0]->sum;
                $vin    = DB::select('select count(id) as sum from  orders where order_type = 3   and payment_status = 1  and created_at >= CURDATE()')[0]->sum;
                $jqx    = DB::select('select count(id) as sum from  orders where order_type = 5   and payment_status = 1  and created_at >= CURDATE()')[0]->sum;
                $njzt   = DB::select('select count(id) as sum from  orders where order_type = 6   and payment_status = 1  and created_at >= CURDATE()')[0]->sum;
                $cph    = DB::select('select count(id) as sum from  orders where order_type = 9   and payment_status = 1  and created_at >= CURDATE()')[0]->sum;
                $jszzt  = DB::select('select count(id) as sum from  orders where order_type = 10  and payment_status = 1  and created_at >= CURDATE()')[0]->sum;
                $wz     = DB::select('select count(id) as sum from  orders where order_type = 11  and payment_status = 1  and created_at >= CURDATE()')[0]->sum;

                $row->column(1 / 3, new Box('今日成交订单', view('admin.order', compact(['cx', 'wx', 'vin', 'jqx', 'njzt', 'cph', 'jszzt', 'wz', 'today_order_sum']))));





                $today_all_order_refund = DB::select('select count(id) as today_all_order_refund from orders where refund_status = 2 and created_at >= CURDATE()')[0]->today_all_order_refund;
                

                $cx_refund     = DB::select('select count(id) as sum from  orders where order_type = 1   and refund_status = 2  and created_at >= CURDATE()')[0]->sum;
                $wx_refund     = DB::select('select count(id) as sum from  orders where order_type = 2   and refund_status = 2  and created_at >= CURDATE()')[0]->sum;
                $vin_refund    = DB::select('select count(id) as sum from  orders where order_type = 3   and refund_status = 2  and created_at >= CURDATE()')[0]->sum;
                $jqx_refund    = DB::select('select count(id) as sum from  orders where order_type = 5   and refund_status = 2  and created_at >= CURDATE()')[0]->sum;
                $njzt_refund   = DB::select('select count(id) as sum from  orders where order_type = 6   and refund_status = 2  and created_at >= CURDATE()')[0]->sum;
                $cph_refund    = DB::select('select count(id) as sum from  orders where order_type = 9   and refund_status = 2  and created_at >= CURDATE()')[0]->sum;
                $jszzt_refund  = DB::select('select count(id) as sum from  orders where order_type = 10  and refund_status = 2  and created_at >= CURDATE()')[0]->sum;
                $wz_refund     = DB::select('select count(id) as sum from  orders where order_type = 11  and refund_status = 2  and created_at >= CURDATE()')[0]->sum;

                $row->column(1 / 3, new Box('今日退款订单', view('admin.refund', compact(
                    ['cx_refund', 'wx_refund', 'vin_refund', 'jqx_refund', 'njzt_refund', 'cph_refund', 'jszzt_refund', 'wz_refund', 'today_all_order_refund']))));


                    
                $today_all_order_unrefund = DB::select('select count(id) as today_all_order_refund from orders where payment_status = 1 and refund_status = 0 and created_at >= CURDATE()')[0]->today_all_order_refund;
                

                $cx_unrefund     = DB::select('select count(id) as sum from  orders where order_type = 1  and payment_status = 1 and refund_status = 0  and created_at >= CURDATE()')[0]->sum;
                $wx_unrefund     = DB::select('select count(id) as sum from  orders where order_type = 2  and payment_status = 1 and refund_status = 0  and created_at >= CURDATE()')[0]->sum;
                $vin_unrefund    = DB::select('select count(id) as sum from  orders where order_type = 3  and payment_status = 1 and refund_status = 0  and created_at >= CURDATE()')[0]->sum;
                $jqx_unrefund    = DB::select('select count(id) as sum from  orders where order_type = 5  and payment_status = 1 and refund_status = 0  and created_at >= CURDATE()')[0]->sum;
                $njzt_unrefund   = DB::select('select count(id) as sum from  orders where order_type = 6  and payment_status = 1 and refund_status = 0  and created_at >= CURDATE()')[0]->sum;
                $cph_unrefund    = DB::select('select count(id) as sum from  orders where order_type = 9  and payment_status = 1 and refund_status = 0  and created_at >= CURDATE()')[0]->sum;
                $jszzt_unrefund  = DB::select('select count(id) as sum from  orders where order_type = 10 and payment_status = 1 and refund_status = 0  and created_at >= CURDATE()')[0]->sum;
                $wz_unrefund     = DB::select('select count(id) as sum from  orders where order_type = 11 and payment_status = 1 and refund_status = 0  and created_at >= CURDATE()')[0]->sum;

                $row->column(1 / 3, new Box('今日已支付未退款订单', view('admin.unrefund', compact(
                    ['cx_unrefund', 'wx_unrefund', 'vin_unrefund', 'jqx_unrefund', 'njzt_unrefund', 'cph_unrefund', 'jszzt_unrefund', 'wz_unrefund', 'today_all_order_unrefund']))));



            });

    }


}
