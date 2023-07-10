@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Thông tin đơn hàng</h5>
            </div>
            <div id="content" class="detail-exhibition fl-right">
                <div class="section" id="info">
                    <ul class="list-item detail">
                        <li>
                            <h3 class="title">Mã đơn hàng</h3>
                            <span class="detail">{{$order->id}}</span>
                        </li>
                        <li>
                            <h3 class="title">Tên khách hàng</h3>
                            <span class="detail">{{$order->fullname}}</span>
                        </li>
                        <li>
                            <h3 class="title">Email</h3>
                            <span class="detail">{{$order->email}}</span>
                        </li>
                        <li>
                            <h3 class="title">Số điện thoại</h3>
                            <span class="detail">{{$order->phone}}</span>
                        </li>
                        <li>
                            <h3 class="title address">Địa chỉ giao hàng</h3>
                            <span class="detail">{{$order->address}}</span>
                        </li>
                        <form method="POST" action="{{route('update.order',$order->id)}}">
                            @csrf
                            <li>
                                <h3 class="title">Tình trạng đơn hàng</h3>
                                <select name="status">
                                    <option  value='0' <?php if ($order['status'] == 'Thành công') echo "selected='selected'"; ?>>Thành công</option>
                                    <option  value='1'<?php if ($order['status'] == 'Đang xử lý') echo "selected='selected'"; ?>>Đang xử lý</option>
                                    <option  value='2'<?php if ($order['status'] == 'Đã hủy') echo "selected='selected'"; ?>>Đã hủy</option>
                                </select>
                                <input type="submit" name="update_status" value="Cập nhật đơn hàng">
                            </li>
                        </form>
                    </ul>
                </div>
                <div class="section detail">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm đơn hàng</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table info-exhibition">
                            <thead>
                                <tr>
                                    <td class="thead-text">STT</td>
                                    <td class="thead-text">Ảnh sản phẩm</td>
                                    <td class="thead-text">Tên sản phẩm</td>
                                    <td class="thead-text">Đơn giá</td>
                                    <td class="thead-text">Số lượng</td>
                                    <td class="thead-text">Thành tiền</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($detail_order as $item) {
                                    $image= json_decode($item->product->image);
                                    ?>
                                    <tr>
                                        <td class="thead-text">1</td>
                                        <td class="thead-text">
                                            <div class="thumb">
                                                <img src="{{url($image[0])}}" alt="">
                                            </div>
                                        </td>
                                        <td class="thead-text">{{$item->product->name}}</td>
                                        <td class="thead-text">{{number_format( $item->price,0,',','.').'đ'}}</td>
                                        <td class="thead-text">{{$item->quantity}}</td>
                                        <td class="thead-text">{{number_format( $item->amount,0,',','.').'đ'}}</td>
                                    </tr>
                                    <?php
                                }
                                ?>
        
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="section detail">
                    <h3 class="section-title">Giá trị đơn hàng</h3>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <li>
                                <span class="total-fee">Tổng số lượng</span>
                                <span class="total">Tổng đơn hàng</span>
                            </li>
                            <li>
                                <span class="total-fee">{{$order->quantity_total}} sản phẩm</span>
                                <span class="total">{{number_format( $order->amount_total,0,',','.').'đ'}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
