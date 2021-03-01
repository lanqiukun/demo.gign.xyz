<?php

namespace App\Admin\Actions;

use App\Admin\Controllers\OrderController;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\AlipayController;
use App\Http\Controllers\BDController;
use App\Order;

class Feedback extends RowAction
{
    public $name = '回传百度';

    public function handle(Model $model)
    {
        $result = BDController::feedback($model->bd_url, $model->price * 100);


        if ($result) {
            $model->update(['feedback_bd' => 1]);

            return $this->response()->success('该条记录回传成功')->refresh();
        }
        else
            return $this->response()->error('网络错误，请重试！');
    }
}
