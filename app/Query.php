<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Query extends Model
{
    //
    protected $table = 'queries';

    public function order()
    {
        return $this->hasOne(Order::class, 'order_no', 'order_no');
    }
}
