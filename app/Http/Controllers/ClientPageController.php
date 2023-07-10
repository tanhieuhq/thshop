<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class ClientPageController extends Controller
{
    public function __construct()
    {
        get_data_index();
    }
    function index($slug){
        $item=Page::where('slug',$slug)->first();
        return view('client.page.detail',compact('item'));
    }
}
