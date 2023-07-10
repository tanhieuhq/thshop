<?php

namespace App\Http\Controllers;

use App\ProductCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminProductCatController extends Controller
{
    function data_tree($data, $parent_id = 0, $level = 0) {
        $result = array();
        foreach ($data as $key => $item) {
            if ($item['parent_id'] == $parent_id) {
                $item['level'] = $level;
                $result[] = $item;
                unset($data[$key]);
                $child = $this->data_tree($data, $item['id'], $level + 1);
                $result = array_merge($result, $child);
            }
        }
        return $result;
    }
    function index(Request $request){
        $status = $request->input('status');
        $act_list = ['restore'=>'Khôi phục'];
        if($status=='trash'){
            $productCats = ProductCat::onlyTrashed()->get();
        }else{
            $productCats = $this->data_tree(ProductCat::all());
        }
        $trash_count = ProductCat::onlyTrashed()->count();
        $availabitity_count=ProductCat::all()->count();
        $count = [$availabitity_count, $trash_count];
        return view('admin.productcat.list',compact('productCats','count','status','act_list'));
    }

    function add(){
        $productCats = ProductCat::all();
        return view('admin.productcat.add',compact('productCats'));
    }
    function create(Request $request){
        $request->validate(
            [
                'name'=>'required|max:100',
                'parent_id'=>'required'
            ],
            [
                'required'=>':attribute không được để trống',
                'max'=>':attribute không vượt quá :max ký tự'
            ],
            [
                'name'=>'Tên danh mục',
                'parent_id'=>'Danh mục cha'
            ]
        );
        $input = $request->all();
        $input['slug'] = Str::slug($request->input('name'),'-');
        $input['user_id'] = Auth::id();
        $level=ProductCat::find($request->input('parent_id'))->level +1;
        $input['level']=$level;
        ProductCat::create($input);
        return redirect('admin/productcat/list')->with('status', 'Đã thêm danh mục thành công');
    }

    function softDelete($id){
        $productCats = ProductCat::all();
        $productCat = ProductCat::find($id);
        foreach($productCats as $item){
            if($item->level > $productCat->level){
                return redirect('admin/productcat/list')->with('status', 'Vui lòng xóa danh mục con trước khi xóa danh mục này');
            }
        }
        ProductCat::find($id)->delete();
        return redirect('admin/productcat/list')->with('status', 'Xóa danh mục thành công');
    }
    
    function action(Request $request){
        $check_list = $request->input('check_list');
        if($check_list){
            $act = $request->input('act');
            if($act=='restore'){
                ProductCat::withTrashed()->whereIn('id', $check_list)->restore();
                return redirect('admin/productcat/list')->with('status', 'Đã khôi phục danh mục thành công');
            }
        }else{
            return redirect('admin/productcat/list')->with('status', 'Vui lòng chọn tác vụ');
        }
    }

    function edit($id){
        $productCat= ProductCat::find($id);
        $productCats = ProductCat::all();
        return view('admin.productcat.edit',compact('productCat','productCats'));
    }
    function store(Request $request,$id){
        $request->validate(
            [
                'name'=>'required|max:100',
                'parent_id'=>'required'
            ],
            [
                'required'=>':attribute không được để trống',
                'max'=>':attribute không vượt quá :max ký tự'
            ],
            [
                'name'=>'Tên danh mục',
                'parent_id'=>'Danh mục cha'
            ]
        );
        $level=ProductCat::find($request->input('parent_id'))->level +1;
        ProductCat::where('id', $id)->update([
            'name'=>$request->input('name'),
            'slug'=>Str::slug($request->input('name'),'-'),
            'parent_id'=>$request->input('parent_id'),
            'user_id'=>Auth::id(),
            'level'=>$level
        ]);
        return redirect('admin/productcat/list')->with('status', 'Đã cập nhật danh mục thành công');
    }
}
