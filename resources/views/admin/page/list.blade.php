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
                    <form action="#">
                        <input type="text" class="form-control form-search" placeholder="Tiêu đề" name="keyword">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                        <input type="hidden" name="status" value="{{ $status }}">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="?status=public" class="text-primary">Công khai<span
                            class="text-muted">({{ $count[0] }})</span></a>
                    <a href="?status=pending" class="text-primary">Đợi duyệt<span
                            class="text-muted">({{ $count[1] }})</span></a>
                    <a href="?status=trash" class="text-primary">Thùng rác<span
                            class="text-muted">({{ $count[2] }})</span></a>
                </div>
                <form action="{{ url('admin/page/action') }}" method="POST">
                    @csrf
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" id="" name="act">
                            <option>Chọn</option>
                            @foreach ($list_act as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                        <input type="submit" name="btn-action" value="Áp dụng" class="btn btn-primary">
                    </div>
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input name="checkall" type="checkbox">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Tiêu đề</th>
                                {{-- <th scope="col">Nội dung</th> --}}
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Người thực hiện</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Ngày cập nhật</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($pages->total() > 0)
                                @php
                                    $t = $pages->firstItem();
                                @endphp
                                @foreach ($pages as $item)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="check_list[]" value="{{ $item->id }}">
                                        </td>
                                        <td scope="row">{{ $t }}</td>
                                        <td><a href="">{{ $item->title }}</a></td>
                                        {{-- <td>{!! Str::of($item->content)->limit(60) !!}</td> --}}
                                        <td><span
                                                class="badge @if ($item->status == 'Đợi duyệt') badge-warning @else badge-success @endif">{{ $item->status }}</span>
                                        </td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('page.edit', $item->id) }}"
                                                class="btn btn-success btn-sm rounded-0" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-edit"></i></a>
                                            <a href="{{ route('softDelete.page', $item->id) }}"
                                                onclick="return confirm('Xác nhận xóa trang')"
                                                class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip"
                                                data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @php
                                        $t++;
                                    @endphp
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="bg-white">Không tìm thấy dữ liệu</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </form>
                {{ $pages->appends(['status' => $status])->links() }}
            </div>
        </div>
    </div>
@endsection
