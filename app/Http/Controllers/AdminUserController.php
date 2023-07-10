<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'user']);
            return $next($request);
        });
    }
    function list(Request $request)
    {
        // return $request->input('status');
        $status = $request->input('status');
        $list_act = [
            'delete' => 'Xóa tạm thời'
        ];
        $keyword = '';
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
        if ($status == 'trash') {
            $users = User::onlyTrashed()->where('name', 'like', "%{$keyword}%")->paginate(2);
            $list_act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viễn'
            ];
        } else {
            $users = User::where('name', 'like', "%{$keyword}%")->paginate(2);
        }
        $all_count = User::count();
        $trash_count = User::onlyTrashed()->count();
        $count = [$all_count, $trash_count];
        return view('admin.user.list', compact('users', 'count', 'list_act','status'));
    }

    function add()
    {
        return view('admin.user.add');
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:225|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài tối thiếu :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'confirmed' => 'Xác nhận mật khẩu không thành công',
            ],
            [
                'name' => 'Tên người dùng',
                'email' => 'Email',
                'password' => 'Mật khẩu'
            ]
        );
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        return redirect('admin/user/list')->with('status', 'Đã thêm tài khoản thành công');

    }

    function delete($id)
    {
        if (Auth::id() != $id) {
            User::find($id)->delete();
            return redirect('admin/user/list')->with('status', 'Đã xóa tài khoản thành công');
        } else {
            return redirect('admin/user/list')->with('status', 'Không thể xóa tài khoản đang đăng nhập');
        }

    }
    function action(Request $request)
    {
        $check_list = $request->input('check_list');
        if ($check_list) {
            foreach ($check_list as $k => $id) {
                if (Auth::id() == $id) {
                    unset($check_list[$k]);
                }
            }

            if (!empty($check_list)) {
                $act = $request->input('act');
                if ($act == 'delete') {
                    User::destroy($check_list);
                    return redirect('admin/user/list')->with('status', 'Xóa tài khoản thành công');
                }
                if ($act == 'restore') {
                    User::withTrashed()
                        ->whereIn('id', $check_list)
                        ->restore();
                    return redirect('admin/user/list')->with('status', 'Khôi phục tài khoản thành công');
                }
                if ($act == 'forceDelete') {
                    User::withTrashed()
                        ->whereIn('id', $check_list)
                        ->forceDelete();
                    return redirect('admin/user/list')->with('status', 'Xóa tài khoản thành công');
                }
            }
            return redirect('admin/user/list')->with('status', 'Không thể xóa tài khoản đang đăng nhập');
        }
    }
    function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:8|confirmed',
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài tối thiếu :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'confirmed' => 'Xác nhận mật khẩu không thành công',
            ],
            [
                'name' => 'Tên người dùng',
                'password' => 'Mật khẩu'
            ]
        );
        User::where('id', $id)->update([
            'name'=>$request->input('name'),
            'password'=>Hash::make($request->input('password'))
        ]);
        return redirect('admin/user/list')->with('status', 'Đã cập nhật tài khoản thành công');
    }
}