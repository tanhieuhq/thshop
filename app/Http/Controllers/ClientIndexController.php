<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
// use Gloudemans\Shoppingcart\Facades\Cart;
class ClientIndexController extends Controller
{
    public function __construct()
    {
        get_data_index();
    }
    function index(){
        $phones=get_product_list(1);
        $laptops=get_laptop_product_list(2);
        $data['phones']=$phones;
        $data['laptops']=$laptops;
        return view('index',compact('data'));
    }
}
