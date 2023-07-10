<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_order extends Model
{
    protected $fillable = ['row_id', 'product_id', 'order_id', 'quantity', 'price', 'amount'];
    function product(){
        return $this->belongsTo('App\Product');
    }
    function order(){
        return $this->belongsTo('App\Order');
    }
}