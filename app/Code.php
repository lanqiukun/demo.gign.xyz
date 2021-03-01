<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    //
    public $guarded = [];


    public function getCreatedAtAttribute($created_at)
    {
        return date("Y-m-d H:i:s", strtotime($created_at));
    }
}
