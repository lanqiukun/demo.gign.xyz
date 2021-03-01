<?php

namespace App\Admin\Actions\Pay;

use App\Admin\Controllers\OrderController;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\AlipayController;

class Status extends RowAction
{
    public $name = '更新订单状态';

    public function handle(Model $model)
    {
        $order_no = $model->order_no;

        $result = AlipayController::status($order_no);


        if ($result->code == 10000) {
            if (($result->trade_status == 'TRADE_SUCCESS' || $result->trade_status == 'TRADE_FINISHED')) 
                $model->update(['payment_status' => 1, 'paid_at' => $result->send_pay_date]);
            else
                $model->update(['payment_status' => 0, 'paid_at' => null]);
            return $this->response()->success('订单 ' . $order_no . ' 更新成功')->refresh();
        } else {
            return $this->response()->error('网络错误，请重试！');
        }
    }
}
