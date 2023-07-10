<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCat;
use Illuminate\Http\Request;

class ClientProductCatController extends Controller
{
    public function __construct()
    {
        get_data_index();
    }
    function index($slug){
        $item=ProductCat::where('slug',$slug)->first();
        $id=$item->id;
        $products=get_product_list($id);
        $data['products']=$products;
        $cat_name=ProductCat::find($id)->name;
        return view('client.product.productList',compact('data','cat_name'));
    }
}
