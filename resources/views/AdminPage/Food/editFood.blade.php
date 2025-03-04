@extends('layout')
@section('adminBody')
<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">Chỉnh sửa món ăn</h1>
    <form action="{{ route('admin.updateFood', $food->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group text-center mb-4">
            <label for="image" class="form-label">Hình ảnh</label>
            @if($food->food_image)
                <div class="mb-3">
                    <img src="{{ asset('storage/food_images/' . $food->food_image) }}" alt="{{ $food->food_name }}" class="img-fluid rounded" width="300">
                </div>
            @endif
            <input type="file" class="form-control-file" id="image" name="food_image">
        </div>

        <div class="form-group mb-4">
            <label for="name" class="form-label">Tên món ăn</label>
            <input type="text" class="form-control" id="name" name="food_name" value="{{ $food->food_name }}" required>
        </div>

        <div class="form-group mb-4">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="food_description" rows="3" required>{{ $food->food_description }}</textarea>
        </div>

        <div class="form-group mb-4">
            <label for="price" class="form-label">Giá</label>
            <input type="text" class="form-control" id="price" name="food_price" value="{{ number_format($food->food_price, 0, ',', '.') }}" required>
        </div>

        <div class="form-group mb-4">
            <label for="sale" class="form-label">Khuyến mãi</label>
            <select class="form-control" id="sale" name="sale_id">
                <option value="">Không có khuyến mãi</option>
                @foreach($sales as $sale)
                    <option value="{{ $sale->id }}" {{ $sale->id == $food->sale_id ? 'selected' : '' }}>{{ $sale->sale_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.showFood') }}" class="btn btn-secondary">Quay lại</a>
            <button type="submit" class="btn btn-primary">Cập nhật món ăn</button>
        </div>
    </form>
</div>
@endsection