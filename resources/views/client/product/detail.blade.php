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
                <div class="secion" id="breadcrumb-wp">
                    <div class="secion-detail">
                        <ul class="list-item clearfix">
                            <li>
                                <a href="" title="">Trang chủ</a>
                            </li>
                            <li>
                                <a href="" title="">Điện thoại</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="section" id="detail-product-wp">
                    <div class="section-detail clearfix">
                        <div class="thumb-wp fl-left">
                            @php
                                $images = str_replace('\\', '/', json_decode($product->image));
                            @endphp
                            <a href="" title="" id="main-thumb">
                                <img id="zoom" src="{{ $images[0] }}"
                                    data-zoom-image="public/uploads/products/dien-thoai-iphone-14-pro-256gb-den-1.jpg" />
                            </a>
                            <div id="list-thumb">
                                @foreach ($images as $item)
                                    <a href="" data-image="{{ $item }}"
                                        data-zoom-image="{{ $item }}">
                                        <img id="zoom" src="{{ $item }}" />
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="thumb-respon-wp fl-left">
                            <img src="{{ $images[0] }}" alt="">
                        </div>
                        <div class="info fl-right">
                            <h3 class="product-name">{{ $product->name }}</h3>
                            <div class="desc">
                                {!! $product->description !!}
                            </div>
                            <p class="price">{{ number_format($product->price, 0, '.', ',') . 'đ' }}</p>
                            <form action="{{ route('cart.add', $product->slug) }}" method="POST">
                                @csrf
                                <div id="num-order-wp">
                                    <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                    <input type="text" name="num-order" value="1" id="num-order">
                                    <a title="" id="plus"><i class="fa fa-plus"></i></a>
                                </div>
                                {{-- <a href="{{ route('cart.add', $product->slug) }}" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a> --}}
                                <input class="add-cart" type="submit" name="add-cart" value="Thêm giỏ hàng" />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section" id="post-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Mô tả sản phẩm</h3>
                    </div>
                    <div class="section-detail">
                        {!! $product->detail_info !!}
                    </div>
                </div>
                <div class="section" id="same-category-wp">
                    <div class="section-head">
                        <h3 class="section-title">Cùng chuyên mục</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @foreach ($data['products'] as $item)
                                @php
                                    $images = json_decode($item->image);
                                    $image = $images[0];
                                @endphp
                                <li>
                                    <a href="{{ route('product.detail', $item->slug) }}" title="" class="thumb">
                                        <img src="{{ $image }}">
                                    </a>
                                    <a href="{{ route('product.detail', $item->slug) }}" title=""
                                        class="product-name">{!! Str::of($item->name)->limit(40) !!}</a>
                                    <div class="price">
                                        <span class="new">{{ number_format($item->price) . 'đ' }}</span>
                                        {{-- <span class="old">20.900.000đ</span> --}}
                                    </div>
                                    <div class="action clearfix">
                                        <a href="{{ route('cart.add', $item->slug) }}" title=""
                                            class="add-cart fl-left">Thêm
                                            giỏ hàng</a>
                                        <a href="{{ route('buy.now', $item->slug) }}" title=""
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

