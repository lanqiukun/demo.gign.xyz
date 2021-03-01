<?php

namespace App\Admin\Actions\Pay;

use App\Admin\Controllers\OrderController;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\AlipayController;
use App\Http\Controllers\WechatpayController;
use App\Order;

class Refund extends RowAction
{
    public $name = '退款';

    public function handle(Model $model)
    {
        $order_no = $model->order_no;

        if ($model->pay_type == 1) {
            $result = WechatpayController::refund($model);
            if ($result == 1) {
                $model->refund_status = 2;
                
                $model->save();
                return $this->response()->success('订单 ' . $order_no . ' 退款成功')->refresh();
            }
            else 
                return $this->response()->error('操作失败，请重试！');

        } else {

            $result = AlipayController::refund($model);
    
    
            if ($result->code == 10000) {
                $order = Order::where('order_no', $order_no)->first();
    
                $order->refund_status = 2;
    
                $order->save();
    
                return $this->response()->success('订单 ' . $order_no . ' 退款成功')->refresh();
            } else
                return $this->response()->error('网络错误，请重试！');
        }


    }
}
