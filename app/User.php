<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    public $guarded = [];

    public function getCreatedAtAttribute($created_at)
    {
        return date("Y-m-d H:i:s", strtotime($created_at));
    }

    public function getUpdatedAtAttribute($updated_at)
    {
        return date("Y-m-d H:i:s", strtotime($updated_at));
    }
    
    function orders() {
        return $this->hasMany(Order::class, 'phone', 'phone');
    }

}
