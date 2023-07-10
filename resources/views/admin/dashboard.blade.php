@extends('layouts.admin')
@section('content')
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col">
                <a href="?status=success">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $order[0] }}</h5>
                            <p class="card-text">Đơn hàng giao dịch thành công</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="?status=pending">
                    <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                        <div class="card-header">ĐANG XỬ LÝ</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $order[1] }}</h5>
                            <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="?status=canceled">
                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header">ĐƠN HÀNG HỦY</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $order[2] }}</h5>
                            <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header">DOANH SỐ</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ number_format($order[4], 0, ',', '.') . 'đ' }}</h5>
                        <p class="card-text">Doanh số hệ thống</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end analytic  -->
        <div class="card">
            <div class="card-header font-weight-bold">
                ĐƠN HÀNG MỚI
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">STT</th>
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
                        @foreach ($order[3] as $item)
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
                {{ $order[3]->links() }}
            </div>
        </div>

    </div>
@endsection
