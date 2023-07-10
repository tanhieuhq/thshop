<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'slug', 'description', 'detail_info', 'image', 'price', 'status', 'hot', 'user_id', 'cat_id'];

    public function productCat(){
        return $this->belongsTo('App\ProductCat','cat_id');
    }

    function user(){
        return $this->belongsTo('app\user');
    }

    function orders(){
        return $this->belongsToMany('App\Order', 'detail_orders');
    }

    function detail_order(){
        return $this->hasMany('App\Detail_order');
    }
}