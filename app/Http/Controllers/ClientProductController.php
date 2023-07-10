<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ClientProductController extends Controller
{
    public function __construct()
    {
        get_data_index();
    }
    function detail($slug){
        $item=Product::where('slug',$slug)->first();
        $id=$item->id;
        $product = Product::find($id);
        $data['products']=get_product_list($product->cat_id);
        return view('client.product.detail',compact('product','data'));
    }

    function test(){
        return view('test');
    }
    
}
