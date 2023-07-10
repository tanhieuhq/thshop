@extends('layouts.client')
@section('content')
    <div id="main-content-wp" class="home-page clearfix">
        <div class="wp-inner">
            <div id="main-content-wp" class="checkout-page">
                <div class="section" id="breadcrumb-wp">
                    <div class="wp-inner">
                        <div class="section-detail">
                            <ul class="list-item clearfix">
                                <li>
                                    <a href="?page=home" title="">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="" title="">Thanh toán</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="wrapper" class="wp-inner clearfix">
                    <div class="section" id="customer-info-wp">
                        <div class="section-head">
                            <h1 class="section-title">Thông tin khách hàng</h1>
                        </div>
                        <div class="section-detail">
                            <form method="POST" action="cart/saveOrder" name="form-checkout" id="form-checkout">
                                @csrf
                                <div class="form-row clearfix">
                                    <div class="form-col fl-left">
                                        <label for="fullname">Họ tên</label>
                                        <input type="text" name="fullname" id="fullname">
                                        @error('fullname')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-col fl-right">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row clearfix">
                                    <div class="form-col fl-left">
                                        <label for="address">Địa chỉ</label>
                                        <input type="text" name="address" id="address">
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-col fl-right">
                                        <label for="phone">Số điện thoại</label>
                                        <input type="tel" name="phone" id="phone" maxlength="15">
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-col-note">
                                        <label for="notes">Ghi chú</label>
                                        <textarea name="note"></textarea><br>
                                        <input type="hidden" name="amount_total"
                                            value="{{ doubleval(str_replace('.', '', Cart::total())) }}">
                                        @error('note')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="section" id="order-review-wp">
                        <div class="section-head">
                            <h1 class="section-title">Thông tin đơn hàng</h1>
                        </div>
                        <div class="section-detail">
                            <table class="shop-table">
                                <thead>
                                    <tr>
                                        <td>Sản phẩm</td>
                                        <td>Tổng</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::content() as $item)
                                        <tr class="cart-item">
                                            <td class="product-name">{{ $item->name }}<strong
                                                    class="product-quantity">x{{ $item->qty }}</strong>
                                            </td>
                                            <td class="product-total">{{ number_format($item->total, 0, ',', '.') }}.đ</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="order-total">
                                        <td>Tổng đơn hàng:</td>
                                        <td><strong class="total-price">{{ Cart::total() }}.đ</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                            {{-- <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="direct-payment" name="payment-method" value="direct-payment">
                                <label for="direct-payment">Thanh toán tại cửa hàng</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payment-method" value="payment-home">
                                <label for="payment-home">Thanh toán tại nhà</label>
                            </li>
                        </ul>
                    </div> --}}
                            <div class="place-order-wp clearfix">
                                <input type="submit" id="order-now" value="Đặt hàng" form="form-checkout">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
