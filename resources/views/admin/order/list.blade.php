@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách đơn hàng</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="checkall">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Mã</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá trị</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col">Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $t = 1;
                        @endphp
                        @foreach ($orders as $item)
                            <tr>
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td>{{ $t++ }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->fullname }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->quantity_total }}</td>
                                <td>{{ number_format($item->amount_total, 0, ',', '.') . 'đ' }}</td>
                                <td><span
                                        class="badge @if ($item->status == 'Thành công') badge-success @else badge-warning @endif">{{ $item->status }}</span>
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td><a href="{{ route('detail.order', $item->id) }}" title="" class="tbody-text">Chi
                                        tiết</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
