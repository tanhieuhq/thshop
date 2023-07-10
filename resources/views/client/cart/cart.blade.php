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
                                    <a href="" title="">Sản phẩm làm đẹp da</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="wrapper" class="wp-inner clearfix">
                    @if (Cart::count() > 0)
                        <form action="cart/update" method="POST">
                            @csrf
                            <div class="section" id="info-cart-wp">
                                <div class="section-detail table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td>Mã sản phẩm</td>
                                                <td>Ảnh sản phẩm</td>
                                                <td>Tên sản phẩm</td>
                                                <td>Giá sản phẩm</td>
                                                <td>Số lượng</td>
                                                <td colspan="2">Thành tiền</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (Cart::content() as $item)
                                                <tr>
                                                    <td id="code" data-id="{{ $item->id }}">{{ $item->id }}
                                                    </td>
                                                    <td>
                                                        <a href="" title="" class="thumb">
                                                            <img src="{{ $item->options->image }}" alt="">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('product.detail', $item->model->slug) }}" title=""
                                                            class="name-product">{{ $item->name }}</a>
                                                    </td>
                                                    <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                                                    <td>
                                                        <input id="num-order-cart" class="num-order"
                                                            data-id="{{ $item->rowId }}" type="number"
                                                            name="quantity_order[{{ $item->rowId }}]" min="1"
                                                            max="20" value="{{ $item->qty }}">
                                                    </td>
                                                    <td id="amount-{{ $item->rowId }}">
                                                        {{ number_format($item->total, 0, ',', '.') }}đ</td>
                                                    <td>
                                                        <a href="{{ route('cart.remove', $item->rowId) }}" title=""
                                                            class="del-product"><i class="fa fa-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7">
                                                    <div class="clearfix">
                                                        <p id="total-price" class="fl-right">Tổng giá:
                                                            <span>{{ Cart::total() }}đ</span>
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7">
                                                    <div class="clearfix">
                                                        <div class="fl-right">
                                                            {{-- <input type="submit" id="update-cart" name="btn-update-quantity" value="Cập nhật giỏ hàng"/> --}}
                                                            <a href="cart/checkout" title="" id="checkout-cart">Tiếp
                                                                tục</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            {{-- <input type="submit" value="Cập nhật giỏ hàng" name="btn_update" class="btn btn-primary"> --}}
                            <div class="section" id="action-cart-wp">
                                <div class="section-detail">
                                    <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhấn
                                        vào thanh
                                        toán để hoàn tất mua hàng.
                                    </p>

                                    <a href="?page=home" title="" id="buy-more">Mua tiếp</a><br />
                                    <a href="cart/destroy" title="" id="delete-cart">Xóa giỏ hàng</a>
                                </div>
                            </div>
                        </form>
                    @else
                        Giỏ hàng chưa có sản phẩm
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
