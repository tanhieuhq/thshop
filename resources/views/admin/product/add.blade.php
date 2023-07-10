@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm sản phẩm
            </div>
            <div class="card-body">
                <form action="{{ url('admin/product/create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Tên sản phẩm</label>
                                <input class="form-control" type="text" name="name" id="name">
                            </div>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <label for="price">Giá</label>
                                <input class="form-control" type="text" name="price" id="price" maxlength="12">
                            </div>
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="hot" id="hot"value="1">
                                    <label class="form-check-label" for="hot">
                                        Nổi bật
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="description">Mô tả sản phẩm</label>
                                <textarea name="description" class="form-control" id="description" cols="30" rows="5"></textarea>
                            </div>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="detail_info">Chi tiết sản phẩm</label>
                        <textarea name="detail_info" class="form-control" id="detail_info" cols="30" rows="5"></textarea>
                    </div>
                    @error('detail_info')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <div class="form-group">
                        <label>HÌnh ảnh</label><br>
                        <input type="file" id="uploadFile" name="uploadFile[]" multiple /><br><br>
                        <div id="imgPreview"></div>
                        @error('uploadFile')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <select class="form-control" name="cat_id">
                            <option value="">Chọn danh mục</option>
                            @foreach ($cats as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('cat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="pending" value="Đợi duyệt"
                                checked>
                            <label class="form-check-label" for="pending">
                                Chờ duyệt
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="public" value="Công khai">
                            <label class="form-check-label" for="public">
                                Công khai
                            </label>
                        </div>
                    </div>
                    
                    <button type="submit" name="add-product" value="add-product" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $("#uploadFile").change(function() {
            $('#imgPreview').html("");
            var total_file = document.getElementById("uploadFile").files.length;
            for (var i = 0; i < total_file; i++) {
                $('#imgPreview').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "'>");

            }
        });
        // $('form').ajaxForm(function() {
        //     alert("Uploaded SuccessFully");
        // });
    </script>
@endsection
