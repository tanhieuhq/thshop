@extends('layouts.client')
@section('content')
@php
    if(isset($_SESSION['visits'])){
        unset($_SESSION['visits']);
    }
@endphp
    <div id="main-content-wp" class="home-page clearfix">
        <div class="wp-inner">
            <div class="main-content fl-right">
                <div class="section" id="slider-wp">
                    <div class="section-detail">
                        <div class="item">
                            <img src="public/images/slider-01.png" alt="">
                        </div>
                        <div class="item">
                            <img src="public/images/slider-02.png" alt="">
                        </div>
                        <div class="item">
                            <img src="public/images/slider-03.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="section" id="support-wp">
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <li>
                                <div class="thumb">
                                    <img src="public/images/icon-1.png">
                                </div>
                                <h3 class="title">Miễn phí vận chuyển</h3>
                                <p class="desc">Tới tận tay khách hàng</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="public/images/icon-2.png">
                                </div>
                                <h3 class="title">Tư vấn 24/7</h3>
                                <p class="desc">1900.9999</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="public/images/icon-3.png">
                                </div>
                                <h3 class="title">Tiết kiệm hơn</h3>
                                <p class="desc">Với nhiều ưu đãi cực lớn</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="public/images/icon-4.png">
                                </div>
                                <h3 class="title">Thanh toán nhanh</h3>
                                <p class="desc">Hỗ trợ nhiều hình thức</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="public/images/icon-5.png">
                                </div>
                                <h3 class="title">Đặt hàng online</h3>
                                <p class="desc">Thao tác đơn giản</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="section" id="list-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Điện thoại</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            @foreach ($data['phones'] as $item)
                                @php
                                    $images = json_decode($item->image);
                                    $image = $images[0];
                                @endphp
                                <li>
                                    <a href="{{ route('product.detail', ['slug'=>$item->slug]) }}" title="" class="thumb">
                                        <img src="{{ url($image) }}">
                                    </a>
                                    <a href="{{ route('product.detail', ['slug'=>$item->slug]) }}" title=""
                                        class="product-name">{!! Str::of($item->name)->limit(40) !!}</a>
                                    <div class="price">
                                        <span class="new">{{ number_format($item->price) . 'đ' }}</span>
                                        {{-- <span class="old">8.990.000đđ</span> --}}
                                    </div>
                                    <div class="action clearfix">
                                        <a href="{{ route('cart.add', $item->slug) }}" title="Thêm giỏ hàng"
                                            class="add-cart fl-left">Thêm
                                            giỏ hàng</a>
                                        <a href="{{ route('buy.now', $item->slug) }}" title="Mua ngay"
                                            class="buy-now fl-right">Mua
                                            ngay</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="section" id="list-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Laptop</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            @foreach ($data['laptops'] as $item)
                                @php
                                    $images = json_decode($item->image);
                                    $image = $images[0];
                                @endphp
                                <li>
                                    <a href="{{ route('product.detail', ['slug'=>$item->slug]) }}" title="" class="thumb">
                                        <img src="{{ url($image) }}">
                                    </a>
                                    <a href="{{ route('product.detail', ['slug'=>$item->slug]) }}" title=""
                                        class="product-name">{!! Str::of($item->name)->limit(40) !!}</a>
                                    <div class="price">
                                        <span class="new">{{ number_format($item->price) . 'đ' }}</span>
                                        {{-- <span class="old">8.990.000đđ</span> --}}
                                    </div>
                                    <div class="action clearfix">
                                        <a href="{{ route('cart.add', $item->slug) }}" title="Thêm giỏ hàng"
                                            class="add-cart fl-left">Thêm
                                            giỏ hàng</a>
                                        <a href="{{ route('buy.now', $item->slug) }}" title="Mua ngay"
                                            class="buy-now fl-right">Mua
                                            ngay</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @include('layouts.sidebar')
        </div>
    </div>
@endsection
