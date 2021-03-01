<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public $guarded = [];
    public $appends = ['type_name', 'report_url', 'link', 'show'];
    // public $timestamps = false;

    public function getCreatedAtAttribute($created_at)
    {
        return date("m-d H:i:s", strtotime($created_at));
    }

    
    public function getUpdatedAtAttribute($created_at)
    {
        return date("m-d H:i:s", strtotime($created_at));
    }
    
    public function query_item() {
        return $this->belongsTo(QueryItem::class, 'order_type', 'id');
    }

    public function getTypeNameAttribute() {
        return QueryItem::where('id', $this->order_type)->first()->title;
    }

    public function getReportUrlAttribute() {
        return '/result' . QueryItem::where('id', $this->order_type)->first()->page . '.html?order_no=' . $this->order_no;
    }


    public function getPaidAtAttribute($paid_at) {
        if ($paid_at == null)
            return '';
        return date("m-d H:i:s", strtotime($paid_at));
    }
    
    public function getLinkAttribute() {
        return 'https://qc.chekuan.top/result' . QueryItem::where('id', $this->order_type)->first()->page . '.html?order_no=' . $this->order_no;
    }
    

    public function getShowAttribute() {
        return '/admin/orders/' . $this->id;
    }
}
