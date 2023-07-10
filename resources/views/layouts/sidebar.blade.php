<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            @if (session('data_tree'))
                {!! session('data_tree') !!}
            @endif
        </div>
    </div>
    <div class="section" id="selling-wp">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm bán chạy</h3>
        </div>
        <div class="section-detail">
            <ul class="list-item">
                @foreach (session('hot_products') as $item)
                    @php
                        $images = json_decode($item->image);
                        $image = $images[0];
                    @endphp
                    <li class="clearfix">
                        <a href="{{ route('product.detail', ['slug'=>$item->slug]) }}" title=""
                            class="thumb fl-left">
                            <img src="{{ $image }}" alt="">
                        </a>
                        <div class="info fl-right">
                            <a href="{{ route('product.detail', ['slug'=>$item->slug]) }}" title=""
                                class="product-name">{{ $item->name }}</a>
                            <div class="price">
                                <span
                                    class="new">{{ number_format($item->price, 0, '.', ',') . 'đ' }}</span>
                                {{-- <span class="old">7.190.000đ</span> --}}
                            </div>
                            <a href="{{ route('buy.now', $item->slug) }}" title=""
                                class="buy-now">Mua ngay</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="" title="" class="thumb">
                <img src="public/images/banner.png" alt="">
            </a>
        </div>
    </div>
</div>