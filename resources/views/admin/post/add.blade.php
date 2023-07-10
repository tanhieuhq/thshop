@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
            {!! Form::open(['url'=>'admin/post/store','method'=>'POST','files'=>true]) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Tiêu đề') !!}
                    {!! Form::text('title', '', ['class'=>'form-control','id'=>'title']) !!}
                    @error('title')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('description', 'Mô tả') !!}
                    {!! Form::textarea('description', '', ['class'=>'form-control','id'=>'description']) !!}
                    @error('description')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('content', 'Nội dung') !!}
                    {!! Form::textarea('content', '', ['class'=>'form-control','id'=>'content']) !!}
                    @error('content')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('thumbnail', 'Chọn ảnh đại diện') !!}
                    {!! Form::file('file', ['class'=>'form-control-file','id'=>'thumbnail']) !!}
                    @error('file')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('postcat', 'Danh mục') !!}
                    {!! Form::select('postcat', [''=>'Chọn danh mục','Tin tức'=>'Tin tức','Khuyến mãi'=>'Khuyến mãi'], '', ['class'=>'form-control','id'=>'postcat']) !!}
                    @error('postcat')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('', 'Trạng thái') !!}
                    <div class="form-check">
                        {!! Form::radio('status', 'Chờ duyệt', 'checked', ['class'=>'form-check-input','id'=>'pending']) !!}
                        {!! Form::label('pending', 'Chờ duyệt', ['class'=>'form-check-label']) !!}
                    </div>
                    <div class="form-check">
                        {!! Form::radio('status', 'Công khai', '', ['class'=>'form-check-input','id'=>'public']) !!}
                        {!! Form::label('public', 'Công khai', ['class'=>'form-check-label']) !!}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" value="sm-add-post" name="sm-add-post">Thêm mới</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection