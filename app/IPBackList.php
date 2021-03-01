<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IPBackList extends Model
{
    //
    public $table = 'ipbacklist';

    // public $timestamps = false;

    public $guarded = [];

    public function getCreatedAtAttribute($created_at)
    {
        return date("Y-m-d H:i:s", strtotime($created_at));
    }
}
