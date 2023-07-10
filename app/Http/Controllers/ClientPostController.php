<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class ClientPostController extends Controller
{
    public function __construct()
    {
        get_data_index();
    }
    function index(){
        $posts=Post::all();
        return view('client.blog.blog',compact('posts'));
    }
    function detail($slug){
        $post=Post::where('slug',$slug)->first();
        return view('client.blog.detail',compact('post'));
    }
}
