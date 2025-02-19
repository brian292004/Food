@extends('layout')
@section('adminBody')
<div class="container">
    <h1>Thêm Cửa Hàng Mới</h1>
    <form action="{{route('admin.storeShop')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên Cửa Hàng</label>
            <input type="text" class="form-control" id="shop_name" name="shop_name" required>
        </div>
        <div class="form-group">
            <label for="address">Địa Chỉ</label>
            <input type="text" class="form-control" id="shop_address" name="shop_address" required>
        </div>
        <div class="form-group">
            <label for="email">Địa chỉ email</label>
            <input type="email" class="form-control" id="shop_email" name="shop_email" required>
        </div>
        <div class="form-group">
            <label for="phone">Số Điện Thoại</label>
            <input type="text" class="form-control" id="shop_phone" name="shop_phone" required>
        </div>
        <div class="form-group">
            <label for="description">Mô Tả</label>
            <textarea class="form-control" id="shop_description" name="shop_description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Thêm Cửa Hàng</button>
    </form>
</div>
@endsection