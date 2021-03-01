<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Result extends Model
{
    //
    public $guarded = [];

    // protected $appends = ['type'];


    public function getCreatedAtAttribute($created_at)
    {
        return date("Y-m-d H:i:s", strtotime($created_at));
    }

    
    public function getUpdatedAtAttribute($created_at)
    {
        return date("Y-m-d H:i:s", strtotime($created_at));
    }

    public function order() {
        return $this->hasOne(Order::class, 'order_no', 'order_no');
    }

    
    // public function getOrderTypeAttribute() {
    //     return $this->order()->first()->order_type;
    // }
}
