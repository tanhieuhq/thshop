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
                <h5 class="m-0 ">Danh sách bài viết</h5>
                <div class="form-search form-inline">
                    <form action="">
                        <input type="text" class="form-control form-search" placeholder="Tiêu đề" name="keyword"
                            value="{{ request()->input('keyword') }}">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                        <input type="hidden" name="status" value="{{ $status }}">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="?status=public" class="text-primary">Công khai<span
                            class="text-muted">({{ $count[0] }})</span></a>
                    <a href="?status=pending" class="text-primary">Chờ duyệt<span
                            class="text-muted">{{ $count[1] }})</span></a>
                    <a href="?status=trash" class="text-primary">Thùng rác<span
                            class="text-muted">({{ $count[2] }})</span></a>
                </div>
                <form action="{{ url('admin/post/action') }}" method="POST">
                    @csrf
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" id="" name="act">
                            <option>Chọn</option>
                            @foreach ($act_list as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                        <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                    </div>
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input name="checkall" type="checkbox">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Ngày cập nhật</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Người thực hiện</th>
                                @if ($status != 'trash')
                                    <th scope="col">Tác vụ</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if ($posts->total() > 0)
                                @php
                                    $t = $posts->firstItem();
                                @endphp
                                @foreach ($posts as $item)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="check_list[]" value="{{ $item->id }}">
                                        </td>
                                        <td scope="row">{{ $t }}</td>
                                        <td>
                                            <div class="tbody-thumb">
                                                <img src="{{ url($item->thumbnail) }}" alt="">
                                            </div>
                                        </td>
                                        <td><a href="">{{ $item->title }}</a></td>
                                        <td>{{ $item->postcat }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td><span
                                                class="badge @if ($item->status == 'Chờ duyệt') badge-warning @else badge-success @endif">{{ $item->status }}</span>
                                        </td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>
                                            @if ($status != 'trash')
                                                <a href="{{ route('post.edit', $item->id) }}"
                                                    class="btn btn-success btn-sm rounded-0" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                        class="fa fa-edit"></i></a>
                                                <a href="{{ route('post.softDelete', $item->id) }}"
                                                    onclick="return confirm('Xác nhận xóa trang')"
                                                    class="btn btn-danger btn-sm rounded-0" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                        class="fa fa-trash"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                        $t++;
                                    @endphp
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="bg-white">
                                        Không tìm thấy dữ liệu
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </form>
                {{ $posts->appends(['status' => $status])->links() }}
            </div>
        </div>
    </div>
@endsection
