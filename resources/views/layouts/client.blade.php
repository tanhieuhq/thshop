<!DOCTYPE html>
<html>

<head>
    <title>TH SHOP</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="http://localhost/thshop/" />
    <link href="{{ asset('css/bootstrap/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{asset('css/bootstrap/bootstrap.min.css')}}" rel="stylesheet" type="text/css" /> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ asset('reset.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/carousel/owl.carousel.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/carousel/owl.theme.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('responsive.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('js/jquery-2.2.4.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/elevatezoom-master/jquery.elevatezoom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/carousel/owl.carousel.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Z78YL7ZPTE"></script>
    <script>
       window.dataLayer = window.dataLayer || [];
       function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

    gtag('config', 'G-Z78YL7ZPTE');
    </script>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>

                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="" title="">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="{{ route('post.index') }}" title="">Blog</a>
                                </li>
                                <li>
                                    <a href="{{ route('page.index','gioi-thieu') }}" title="">Giới thiệu</a>
                                </li>
                                <li>
                                    <a href="{{ route('page.index','lien-he') }}" title="">Liên hệ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="logo" class="fl-left"><img
                                src="{{ url('/public/images/logo.png') }}" /></a>
                        {{-- <div id="search-wp" class="fl-left">
                            <form method="POST" action="">
                                <input type="text" name="s" id="s"
                                    placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                <button type="submit" id="sm-s">Tìm kiếm</button>
                            </form>
                        </div> --}}
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0938.768.932</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="{{ route('cart') }}" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num">{{ Cart::content()->count() }}</span>
                            </a>
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num">{{ Cart::content()->count() }}</span>
                                </div>
                                <div id="dropdown">
                                    <p class="desc">Có <span>{{ Cart::content()->count() }} sản phẩm</span> trong giỏ
                                        hàng</p>
                                    <ul class="list-cart">
                                        @foreach (Cart::content() as $item)
                                            <li class="clearfix">
                                                <a href="" title="" class="thumb fl-left">
                                                    <img src="{{ $item->options->image }}" alt="">
                                                </a>
                                                <div class="info fl-right">
                                                    <a href="" title=""
                                                        class="product-name">{{ $item->name }}</a>
                                                    <p class="price">
                                                        {{ number_format($item->price, 0, ',', '.') . 'đ' }}
                                                    </p>
                                                    <p class="qty">Số lượng: <span>{{ $item->qty }}</span></p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="total-price clearfix">
                                        <p class="title fl-left">Tổng:</p>
                                        <p class="price fl-right">{{ Cart::total() . 'đ' }}</p>
                                    </div>
                                    <div class="action-cart clearfix">
                                        <a href="{{ route('cart') }}" title="Giỏ hàng" class="view-cart fl-left">Giỏ
                                            hàng</a>
                                        <a href="{{ route('checkout') }}" title="Thanh toán"
                                            class="checkout fl-right">Thanh
                                            toán</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
            <div id="footer-wp">
                <div id="foot-body">
                    <div class="wp-inner clearfix">
                        <div class="block" id="info-company">
                            <h3 class="title">THSHOP</h3>
                            <p class="desc">THShop luôn cung cấp luôn là sản phẩm chính hãng có thông tin rõ ràng,
                                chính sách ưu đãi cực lớn cho khách hàng có thẻ thành viên.</p>
                            <div id="payment">
                                <div class="thumb">
                                    <img src="public/images/img-foot.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="block menu-ft" id="info-shop">
                            <h3 class="title">Thông tin cửa hàng</h3>
                            <ul class="list-item">
                                <li>
                                    <p>Hiệp Bình Chánh - Thủ Đức - HCM</p>
                                </li>
                                <li>
                                    <p>0938.768.932</p>
                                </li>
                                <li>
                                    <p>thshop@gmail.com</p>
                                </li>
                            </ul>
                        </div>
                        <div class="block menu-ft policy" id="info-shop">
                            <h3 class="title">Chính sách mua hàng</h3>
                            <ul class="list-item">
                                <li>
                                    <a href="{{ route('page.index','quy-dinh-chinh-sach') }}" title="">Quy định - chính sách</a>
                                </li>
                                <li>
                                    <a href="{{ route('page.index','chinh-sach-doi-tra') }}" title="">Chính sách đổi trả</a>
                                </li>
                                <li>
                                    <a href="{{ route('page.index','chinh-sach-bao-hanh') }}" title="">Chính sách bảo hành</a>
                                </li>
                                <li>
                                    <a href="{{ route('page.index','chinh-sach-giao-hang') }}" title="">Giao hàng - lắp đặt</a>
                                </li>
                            </ul>
                        </div>
                        {{-- <div class="block" id="newfeed">
                            <h3 class="title">Bảng tin</h3>
                            <p class="desc">Đăng ký với chung tôi để nhận được thông tin ưu đãi sớm nhất</p>
                            <div id="form-reg">
                                <form method="POST" action="">
                                    <input type="email" name="email" id="email"
                                        placeholder="Nhập email tại đây">
                                    <button type="submit" id="sm-reg">Đăng ký</button>
                                </form>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div id="foot-bot">
                    <div class="wp-inner">
                        <p id="copyright">© Bản quyền thuộc về unitop.vn | Php Master</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu-respon">
            <a href="?page=home" title="" class="logo">THSHOP</a>
            <div id="menu-respon-wp">
                @if (session('render_menu'))
                    {!! session('render_menu') !!}
                @endif
            </div>
        </div>
        <div id="btn-top"><img src="public/images/icon-to-top.png" alt="" /></div>
        <div id="fb-root"></div>
        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=849340975164592";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
</body>

</html>
