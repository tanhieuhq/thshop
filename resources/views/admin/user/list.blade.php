@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách thành viên</h5>
                <div class="form-search form-inline">
                    <form action="">
                        <input type="text" class="form-control form-search" name="keyword"
                            value="{{ request()->input('keyword') }}" placeholder="Tên thành viên">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                        <input type="hidden" name="status" value="{{$status}}">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="?status=all" class="text-primary">Tất cả<span
                            class="text-muted">({{ $count[0] }})</span></a>
                    <a href="?status=trash" class="text-primary">Thùng rác<span
                            class="text-muted">({{ $count[1] }})</span></a>
                </div>
                <form action="{{url('admin/user/action')}}" method="POST">
                    @csrf
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" name="act" id="">
                            <option>Chọn</option>
                            @foreach ($list_act as $k=>$act)
                            <option value="{{$k}}">{{$act}}</option>
                            @endforeach
                        </select>
                        <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                    </div>
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkall">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Họ tên</th>
                                {{-- <th scope="col">Username</th> --}}
                                <th scope="col">Email</th>
                                <th scope="col">Quyền</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users->total() > 0)
                                @php
                                    $t = 0;
                                @endphp
                                @foreach ($users as $item)
                                    @php
                                        $t++;
                                    @endphp
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="check_list[]" value="{{$item->id}}">
                                        </td>
                                        <th scope="row">{{ $t }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>Admintrator</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a href="{{route('user.edit',$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white"
                                                type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-edit"></i></a>
                                            @if (Auth::id() != $item->id && $status!='trash')
                                                <a href="{{ route('delete_user', $item->id) }}"
                                                    onclick="return confirm('Xác nhận xóa tài khoản')"
                                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                        class="fa fa-trash"></i></a>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="bg-white">Không tìm thấy bảng ghi</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </form>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
