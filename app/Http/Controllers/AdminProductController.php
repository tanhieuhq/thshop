<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'product']);
            return $next($request);
        });
    }
    function index(Request $request)
    {
        // $product=Product::find(206);
        // return $product->productCat->name;
        //return dd($product);
        $status = $request->input('status');
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $act_list = ['softDelete' => 'Xóa'];
        if ($status == 'trash') {
            $act_list = ['restore' => 'Khôi phục'];
            $products = Product::onlyTrashed()->where('name', 'like', "%$keyword%")->paginate(10);
        } elseif ($status == 'pending') {
            $products = Product::where([['status', 'Đợi duyệt'], ['name', 'like', "%$keyword%"]])->paginate(10);
        } else {
            $products = Product::where([['status', 'Công khai'], ['name', 'like', "%$keyword%"]])->paginate(10);
        }
        $public_count = Product::where('status', 'Công khai')->count();
        $pending_count = Product::where('status', 'Đợi duyệt')->count();
        $trash_count = Product::onlyTrashed()->count();
        $count = [$public_count, $pending_count, $trash_count];
        return view('admin.product.list', compact('products', 'count', 'status', 'act_list'));
    }
    function add()
    {
        $cats = ProductCat::all();
        return view('admin.product.add', compact('cats'));
    }
    function create(Request $request)
    {
        // $input = $request->all();
        // return dd($input);
        $request->validate(
            [
                'name' => 'required|max:255',
                'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:12',
                'description' => 'required|max:1500',
                'detail_info' => 'required',
                'uploadFile' => 'required',
                'cat_id' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'price.regex' => ':attribute không đúng định dạng',
                'max' => ':attribute không vượt quá :max ký tự'
            ],
            [
                'name' => 'Tên sản phẩm',
                'price' => 'Giá sản phẩm',
                'description' => 'Mô tả',
                'detail_info' => 'Thông tin chi tiết',
                'uploadFile' => 'Ảnh',
                'cat' => 'Danh mục',
            ]
        );
        $input = $request->except('uploadFile');
        $files = $request->file('uploadFile');
        foreach ($files as $item) {
            $result = $item->move("public/uploads/products", $item->getClientOriginalName());
            $images[] = $result->getpathname();
        }
        $input['image'] = json_encode($images);
        $input['user_id'] = Auth::id();
        $input['slug'] = Str::slug($request->input('name', '-'));
        Product::create($input);
        return redirect('admin/product/list')->with('status', 'Đã thêm sản phẩm thành công');
    }
    function softDelete($id)
    {
        Product::find($id)->delete();
        return redirect('admin/product/list')->with('status', 'Xóa sản phẩm thành công');
    }

    function action(Request $request)
    {
        $check_list = $request->input('check_list');
        if ($check_list) {
            $act = $request->input('act');
            if ($act == 'softDelete') {
                Product::destroy($check_list);
                return redirect('admin/product/list')->with('status', 'Đã xóa sản phẩm thành công');
            }
            if ($act == 'restore') {
                Product::withTrashed()->whereIn('id', $check_list)->restore();
                return redirect('admin/product/list')->with('status', 'Đã khôi phục sản phẩm thành công');
            }
        } else {
            return redirect('admin/product/list')->with('status', 'Vui lòng chọn tác vụ');
        }
    }

    function edit($id)
    {
        $product = Product::find($id);
        $cats = ProductCat::all();
        return view('admin.product.edit', compact('product', 'cats'));
    }
    function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:12',
                'description' => 'required|max:1500',
                'detail_info' => 'required',
                'cat_id' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'price.regex' => ':attribute không đúng định dạng',
                'max' => ':attribute không vượt quá :max ký tự'
            ],
            [
                'name' => 'Tên sản phẩm',
                'price' => 'Giá sản phẩm',
                'description' => 'Mô tả',
                'detail_info' => 'Thông tin chi tiết',
                'cat' => 'Danh mục',
            ]
        );
        $product = Product::find($id);
        $input = $request->except(['uploadFile', '_token','update-product']);
        if ($request->file('uploadFile')) {
            File::delete(json_decode($product->image));
            $files = $request->file('uploadFile');
            foreach ($files as $item) {
                $result = $item->move("public/uploads/products", $item->getClientOriginalName());
                $images[] = $result->getpathname();
            }
            
            $input['image'] = json_encode($images);
        } else {
            $input['image'] = $product->image;
        }
        if(!$request->input('hot')){
            $input['hot'] = 0;
        }
        $input['user_id'] = Auth::id();
        $input['slug'] = Str::slug($request->input('name', '-'));
        Product::where('id', $id)->update($input);
        return redirect('admin/product/list')->with('status', 'Đã thêm sản phẩm thành công');
    }
}