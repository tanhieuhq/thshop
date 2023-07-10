<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Ui\Presets\React;

class AdminPageController extends Controller
{

    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'page']);
            return $next($request);
        });
    }

    function index(Request $request)
    {
        $status = $request->input('status');
        $list_act = ['softDelete' => 'Xóa'];
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        if ($status == 'trash') {
            $list_act = ['forceDelete' => 'Xóa vĩnh viễn', 'restore' => 'Khôi phục'];
            $pages = Page::onlyTrashed()->where('title', 'like', "%$keyword%")->paginate(10);
        } elseif ($status == 'pending') {
            $pages = Page::where([
                ['status', '=', 'Đợi duyệt'],
                ['title', 'like', "%$keyword%"]
            ])->paginate(10);
        } else {
            $pages = Page::where([
                ['status', '=', 'Công khai'],
                ['title', 'like', "%$keyword%"]
            ])->paginate(10);
        }
        //return dd($pages);
        $puclic_count = Page::where('status', 'Công khai')->count();
        $pending_count = Page::where('status', 'Đợi duyệt')->count();
        $trash_count = Page::onlyTrashed()->count();
        $count = [$puclic_count, $pending_count, $trash_count];
        return view('admin.page.list', compact('pages', 'count', 'list_act', 'status'));
    }

    function edit($id)
    {
        $page = Page::find($id);
        return view('admin.page.edit', compact('page'));
    }

    function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required|max:500',
                'content' => 'required|max:30000'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không vượt quá :max ký tự'
            ],
            [
                'title' => 'Tiêu đề',
                'content' => 'Nội dung'
            ]
        );
        Page::where('id', $id)->update([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title'), '-'),
            'content' => $request->input('content'),
            'status' => $request->input('status'),
            'user_id' => Auth::id()
        ]);

        return redirect('admin/page/list')->with('status', 'Cập nhật trang thành công');
    }

    function create()
    {
        return view('admin.page.add');
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:500',
                'content' => 'required|max:30000'
            ],
            [
                'required' => ':attribute không được bỏ trống',
                'max' => ':attribute độ dài không được vượt quá :max ký tự',
            ],
            [
                'title' => 'Tiêu đề',
                'content' => 'Nội dung'
            ]
        );

        Page::create([
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title'), '-'),
            'content' => $request->input('content'),
            'status' => $request->input('status'),
            'user_id' => Auth::id()
        ]);
        return redirect('admin/page/list')->with('status', 'Đã thêm trang thành công');
        // for($i=1;$i<=100;$i++){
        //     Page::create([
        //         'title' => 'Tiêu để'.$i,
        //         'slug' => Str::slug('Tiêu để'.$i, '-'),
        //         'content' => 'Nội dung'.$i,
        //         'status' => 'Công khai',
        //         'user_id' => 1
        //     ]);
        // }
    }
    function softDelete($id)
    {
        Page::find($id)->delete();
        return redirect('admin/page/list')->with('status', 'Đã xóa trang thành công');
    }

    function action(Request $request)
    {
        $check_list = $request->input('check_list');
        if ($check_list) {
            $act = $request->input('act');
            if ($act == 'softDelete') {
                Page::destroy($check_list);
                return redirect('admin/page/list')->with('status', 'Đã xóa trang thành công');
            }
            if ($act == 'restore') {
                Page::withTrashed()
                    ->whereIn('id', $check_list)
                    ->restore();
                return redirect('admin/page/list')->with('status', 'Đã khôi phục trang thành công');
            }
            if ($act == 'forceDelete') {
                Page::withTrashed()
                    ->whereIn('id', $check_list)
                    ->forceDelete();
                return redirect('admin/page/list')->with('status', 'Đã xóa vĩnh viễn thành công');
            }
        } else {
            return redirect('admin/page/list')->with('status', 'Không có trang nào được chọn');
        }
    }
}