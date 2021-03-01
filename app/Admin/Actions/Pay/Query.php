<?php

namespace App\Admin\Actions\Pay;

use App\Admin\Controllers\OrderController;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\PayController;
use App\Order;
use App\Http\Controllers\QueryController;
use App\Result;

class Query extends RowAction
{
    public $name = '再次查询';

    public function handle(Model $model)
    {
        $order_no = $model->order_no;

        $exist = Result::where('order_no', $order_no)->get()->pop();

        if ($exist) {
            $result = json_decode($exist->response)->data->result;
            if ($result != 1)
                return $this->response()->error('订单 ' . $order_no . ' 已有查询结果')->refresh();
        }


        $result = QueryController::exec_query($order_no);


        if (isset($result['status']) && $result['status'] == 0) {
            return $this->response()->success('订单 ' . $order_no . ' 查询成功')->refresh();
        } else
            return $this->response()->error($result['msg'])->refresh();
    }
}
