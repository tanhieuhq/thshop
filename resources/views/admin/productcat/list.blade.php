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
                <h5 class="m-0 ">Danh sách danh mục sản phẩm</h5>
                <a href="{{ url('admin/productcat/add') }}" class="btn btn-primary float-right" id="add-product-cat">Thêm
                    mới</a>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="?status=availability" class="text-primary">Hoạt động<span
                            class="text-muted">({{ $count[0] }})</span></a>
                    <a href="?status=trash" class="text-primary">Thùng rác<span
                            class="text-muted">({{ $count[1] }})</span></a>

                </div>
                <form action="{{ url('admin/productcat/action') }}" method="post">
                    @csrf
                    <div class="form-action form-inline py-3">
                        @if ($status == 'trash')
                            <select class="form-control mr-1" id="" name="act">
                                <option value="">Chọn</option>
                                <option value="{{ key($act_list) }}">{{ $act_list[key($act_list)] }}</option>
                            </select>
                            <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                        @endif
                    </div>
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input name="checkall" type="checkbox">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Thứ tự</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Ngày cập nhật</th>
                                <th scope="col">Người thực hiện</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($productCats) > 0)
                                @php
                                    $t = 1;
                                @endphp
                                @foreach ($productCats as $item)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="check_list[]" value="{{ $item->id }}">
                                        </td>
                                        <td scope="row">{{ $t }}</td>
                                        <td>@php
                                            echo str_repeat('--', $item['level']) . $item['name'];
                                        @endphp</td>
                                        <td>{{ $item->level }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>
                                            <a href="{{route('productCat.edit',$item->id)}}" class="btn btn-success btn-sm rounded-0" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-edit"></i></a>
                                            @if ($status != 'trash')
                                                <a href="{{ route('productCat.softDelete', $item->id) }}"
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
                                    <td><input type="checkbox"></td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection
