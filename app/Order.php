<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use app\Product;
class Order extends Model
{
    use SoftDeletes;
    protected $fillable = ['fullname', 'email', 'address','phone', 'note','amount_total'];
    function products(){
        return $this->belongsToMany('App\Product', 'detail_orders');
    }

    function detail_orders(){
        return $this->hasMany('App\Detail_order');
    }
}
