<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCat extends Model
{
    use SoftDeletes;
    protected $table='product_cats';
    protected $fillable = ['name', 'slug','level', 'parent_id', 'user_id'];
    function user(){
        return $this->belongsTo('app\User');
    }

    public function products(){
        return $this->hasMany('app\Product');
    }
}
