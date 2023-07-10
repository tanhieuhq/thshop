@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách sản phẩm</h5>
                <div class="form-search form-inline">
                    <form action="" method="get">
                        <input type="" class="form-control form-search" placeholder="Tên sản phẩm" name="keyword"
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
                    <a href="?status=pending" class="text-primary">Đợi duyệt<span
                            class="text-muted">({{ $count[1] }})</span></a>
                    <a href="?status=trash" class="text-primary">Thùng rác<span
                            class="text-muted">({{ $count[2] }})</span></a>
                </div>
                <form action="{{ url('admin/product/action') }}" method="post">
                    @csrf
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" name="act">
                            <option value="">Chọn</option>
                            <option value="{{ key($act_list) }}">{{ $act_list[key($act_list)] }}</option>
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
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Ngày cập nhật</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Người thực hiện</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products->total() > 0)
                                @php
                                    $t = $products->firstItem();
                                @endphp
                                @foreach ($products as $item)
                                    @php
                                        $images = json_decode($item->image);
                                        $image = $images[0];
                                    @endphp
                                    <tr class="">
                                        <td>
                                            <input type="checkbox" name="check_list[]" value="{{ $item->id }}">
                                        </td>
                                        <td>{{ $t++ }}</td>
                                        <td>
                                            <div class="tbody-thumb"><img src="{{ url($image) }}" alt=""></div>
                                        </td>
                                        <td><a href="#">{{ $item->name }}</a></td>
                                        <td>{{ number_format($item->price).'đ' }}</td>
                                        <td>{{ $item->productCat->name }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td><span
                                                class="badge @if ($item->status == 'Đợi duyệt') badge-warning @else badge-success @endif">{{ $item->status }}</span>
                                        </td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>
                                            <a href="{{route('product.edit',$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white"
                                                type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-edit"></i></a>
                                            @if ($status != 'trash')
                                                <a href="{{ route('product.softDelete', $item->id) }}"
                                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                        class="fa fa-trash"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="11" class="bg-white">
                                        Không tìm thấy dữ liệu
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </form>
                {{ $products->appends(['status' => $status])->links() }}
            </div>
        </div>
    </div>
@endsection
