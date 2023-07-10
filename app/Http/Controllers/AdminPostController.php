<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class AdminPostController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'post']);
            return $next($request);
        });
    }
    function index(Request $request)
    {
        $status = $request->input('status');
        $keyword = '';
        $keyword = $request->input('keyword');
        $act_list = ['softDelete'=>'Xóa'];
        if($status=='trash'){
            $act_list = ['forceDelete'=>'Xóa vĩnh viễn','restore'=>'Khôi phục'];
            $posts = Post::onlyTrashed()->paginate(5);
        }elseif($status=='pending'){
            $posts = Post::where([['title', 'like', "%$keyword%"], ['status', 'Chờ duyệt']])->paginate(5);
        }else{
            $posts = Post::where([['title','like',"%$keyword%"],['status', 'Công khai']])->paginate(5);
        }
        $public_count = Post::where('status', 'Công khai')->count();
        $pending_count = Post::where('status', 'Chờ duyệt')->count();
        $trash_count = Post::onlyTrashed()->count();
        $count = [$public_count,$pending_count,$trash_count];
        return view('admin.post.list',compact('posts','count','status','act_list'));
    }

    function add()
    {
        return view('admin.post.add');
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:500',
                'description' => 'required|max:2000',
                'content' => 'required|max:30000',
                'file' => 'required',
                'status' => 'required',
                'postcat' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được vượt quá :max ký tự'
            ],
            [
                'title' => 'Tiêu đề',
                'description' =>'Mô tả',
                'content' => 'Nội dung',
                'file' => 'Ảnh đại diện',
                'postcat' => 'Danh mục bài viết'
            ]
        );
        $input = $request->all();
        if ($request->hasFile('file')) {
            $input['thumbnail'] = $request->file->move("public/uploads", $request->file->getClientOriginalName());
        }
        $input['slug'] = Str::slug($request->input('title'), '-');
        $input['user_id'] = Auth::id();
        Post::create($input);
        return redirect('admin/post/list')->with('status', 'Thêm bài viết thành công');
    }
    function softDelete($id){
        Post::find($id)->delete();
        return redirect('admin/post/list')->with('status', 'Xóa bài viết thành công');
    }

    function action(Request $request){
        $check_list = $request->input('check_list');
        if($check_list){
            $act = $request->input('act');
        if($act=='softDelete'){
            Post::destroy($check_list);
            return redirect('admin/post/list')->with('status', 'Đã xóa bài viết thành công');
        }
        if($act=='forceDelete'){
            Post::withTrashed()->whereIn('id',$check_list)->forceDelete();
            return redirect('admin/post/list')->with('status', 'Đã xóa vĩnh viễn bài viết thành công');
        }
        if($act=='restore'){
            Post::withTrashed()->whereIn('id',$check_list)->restore();
            return redirect('admin/post/list')->with('status', 'Đã khôi phục bài viết thành công');
        }
        }else{
            return redirect('admin/post/list')->with('status', 'Vui lòng chọn tác vụ');
        }
    }
    function edit($id){
        $post = Post::find($id);
        return view('admin.post.edit',compact('post'));
    }

    function update(Request $request,$id){
        $request->validate(
            [
                'title' => 'required|max:500',
                'description' => 'required|max:2000',
                'content' => 'required|max:30000',
                // 'file' => 'required',
                'status' => 'required',
                'postcat' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được vượt quá :max ký tự'
            ],
            [
                'title' => 'Tiêu đề',
                'description' =>'Mô tả',
                'content' => 'Nội dung',
                // 'file' => 'Ảnh đại diện',
                'postcat' => 'Danh mục bài viết'
            ]
        );
        if ($request->hasFile('file')) {
            File::delete($request->input('current_thumbnail'));
            $thumbnail = $request->file->move("public/uploads", $request->file->getClientOriginalName());
        }else{
            $thumbnail = $request->input('current_thumbnail');
        }
        $input['slug'] = Str::slug($request->input('title'), '-');
        $input['user_id'] = Auth::id();
        Post::where('id',$id)->update([
            'title'=>$request->input('title'),
            'slug'=>Str::slug($request->input('title'), '-'),
            'description'=>$request->input('description'),
            'content'=>$request->input('content'),
            'thumbnail'=>$thumbnail,
            'status'=>$request->input('status'),
            'postcat'=>$request->input('postcat'),
            'user_id'=>Auth::id()
        ]);
        return redirect('admin/post/list')->with('status', 'Cập nhật bài viết thành công');
    }
}