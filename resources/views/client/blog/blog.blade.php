@extends('layouts.client')
@section('content')
    <div id="main-content-wp" class="clearfix blog-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Blog</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="list-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title">Blog</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @foreach ($posts as $item)
                            <li class="clearfix">
                                <a href="{{route('post.detail',['slug'=>$item->slug])}}" title="" class="thumb fl-left">
                                    <img src="{{$item->thumbnail}}" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="{{route('post.detail',['slug'=>$item->slug])}}" title="" class="title">{{$item->title}}</a>
                                    <span class="create-date">{{$item->updated_at}}</span>
                                    <p class="desc">{!!Str::of($item->description)->limit(200)!!}</p>
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

