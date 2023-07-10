<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Page extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'slug', 'content','status', 'user_id'];
    function user(){
        return $this->belongsTo('app\User');
    }
}
