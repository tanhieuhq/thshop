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
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">{{ $cat_name }}</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach ($data['products'] as $item)
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
                                    <a href="{{ route('buy.now', $item->slug) }}" title="Mua ngay" class="buy-now fl-right">Mua
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

