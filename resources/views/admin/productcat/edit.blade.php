@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập nhật danh mục
        </div>
        <div class="card-body">
            <form action="{{route('productCat.store',$productCat->id)}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Tên danh mục</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{$productCat->name}}">
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Danh mục cha</label>
                    <select class="form-control" name="parent_id">
                        <option value="" >Chọn</option>
                        <option value="0">Danh mục gốc</option>
                        @foreach ($productCats as $item)
                            <option value="{{$item->id}}" {{$item->id==$productCat->parent_id?'selected':''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <button type="submit" name="btn-update" value="Cập nhật" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection