@extends('layouts.client')
@section('content')
    <div id="main-content-wp" class="home-page clearfix">
        <div class="wp-inner">
            <div id="main-content-wp" class="cart-page">
                <div class="section" id="breadcrumb-wp">
                    <div class="wp-inner">
                        <div class="section-detail">
                            <ul class="list-item clearfix">
                                <li>
                                    <a href="?page=home" title="">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="" title="">Thông tin đơn hàng</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="wrapper" class="wp-inner clearfix">
                    <div class="col-12">
                        <div class="section">
                            <div class="section-head w-75 m-3 mb-4 mr-auto ml-auto d-block text-center">
                                <div class="section-messs">
                                    <div class="text-success font-weight-bold h4 mb-2 d-block">
                                        <i class="fa-solid fa-circle-check"></i>
                                        Đặt hàng thành công
                                    </div>
                                    <p class="mb-0">Cảm ơn <span
                                            class="font-weight-bold h6 text-danger">{{ $order->fullname }}</span> đã cho
                                        chúng tôi
                                        cơ
                                        hội
                                        được cung ứng những sản phẩm cần thiết với bạn.</p>
                                    <p>Nhân viên của chúng tôi sẽ liên hệ với bạn để xác nhận đơn hàng, thời gian giao hàng
                                        nội
                                        thành
                                        chậm nhất là 48h.</p>
                                </div>
                            </div>
                            <div class="section-body">
                                <div class="order-code title h5 font-weight-bold">
                                    Mã đơn hàng: {{ $order->id }}
                                </div>
                                <div class="table-info-user">
                                    <h5 class="mb-1 mt-3">Thông tin khách hàng:</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead class="table-success">
                                                <tr>
                                                    <td>Họ tên</td>
                                                    <td>Số điện thoại</td>
                                                    <td>Email</td>
                                                    <td>Địa chỉ</td>
                                                    <td>Ghi chú</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $order->fullname }}</td>
                                                    <td>{{ $order->phone }}</td>
                                                    <td>{{ $order->email }}</td>
                                                    <td>
                                                        <p class="mb-0">{{ $order->address }}</p>
                                                    </td>
                                                    <td>{{ $order->note }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="table-order">
                                    <h5 class="mb-1 mt-3">Thông tin đơn hàng:</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-light">
                                            <thead class="table-success">
                                                <tr>
                                                    <td>Ảnh sản phẩm</td>
                                                    <td>Tên sản phẩm</td>
                                                    <td>Đơn giá</td>
                                                    <td>Số lượng</td>
                                                    <td>Thành tiền</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->detail_orders as $item)
                                                    @php
                                                        $product = $item->product;
                                                        $image = json_decode($product->image);
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            <img class="img-thumbnail rounded img-fluid d-block"
                                                                style="width: 75px;" src="{{ $image[0] }}"
                                                                alt="">
                                                        </td>
                                                        <td>{{ $item->product->name }}</td>
                                                        <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>{{ number_format($item->amount, 0, ',', '.') }}đ</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot class="table-success font-weight-bold">
                                                <tr>
                                                    <td colspan="4" class="thead-text text-center">Tổng tiền</td>
                                                    <td class="thead-text">
                                                        {{ number_format($order->amount_total, 0, ',', '.') }}đ</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
