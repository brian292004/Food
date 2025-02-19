<!-- filepath: /d:/php/Dự án PHP/orderFood/resources/views/AdminPage/Food/addFood.blade.php -->
@extends('layout')
@section('adminBody')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Thêm món ăn mới</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.storeFood') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên món ăn</label>
                            <input type="text" class="form-control" id="food_name" name="food_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Giá</label>
                            <input type="number" class="form-control" id="food_price" name="food_price" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="food_description" name="food_description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Đánh giá</label>
                            <input type="number" class="form-control" id="food_rating" name="food_rating" step="0.1" max="5" required>
                        </div>
                        <div class="mb-3">
                            <label for="shop_id" class="form-label">Cửa hàng</label>
                            <select class="form-control" id="shop_id" name="shop_id" required>
                                @foreach($Shop as $shop)
                                    <option value="{{ $shop->id }}">{{ $shop->shop_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="food_image" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" id="food_image" name="food_image" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm món ăn</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection