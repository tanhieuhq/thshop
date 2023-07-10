@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm trang
            </div>
            <div class="card-body">
                {!! Form::open(['url' => route('page.update',$page->id), 'method' => 'POST']) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Tiêu đề') !!}
                    {!! Form::text('title', $page->title, ['class' => 'form-control']) !!}
                    @error('title')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('content', 'Nội dung') !!}
                    {!! Form::textarea('content', $page->content, ['class' => 'form-control', 'id' => 'content']) !!}
                    @error('content')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('status', 'Trạng thái') !!}
                    <div class="form-check">
                        {!! Form::radio('status', 'Đợi duyệt', $page->status == 'Đợi duyệt'? 'checked':'', ['class' => 'form-check-input', 'id' => 'pending']) !!}
                        {!! Form::label('pending', 'Đợi duyệt') !!}
                    </div>
                    <div class="form-check">
                        {!! Form::radio('status', 'Công khai', $page->status == 'Công khai'? 'checked':'', ['class' => 'form-check-input', 'id' => 'public']) !!}
                        {!! Form::label('public', 'Công khai') !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::submit('Cập nhật', ['class' => 'btn btn-primary', 'name' => 'sm-update']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
