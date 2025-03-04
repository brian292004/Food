@extends('layout')
@section('adminBody')
<div class="container">
    <h1>Thêm Khuyến Mãi</h1>
    <form action="{{ route('admin.storeSale') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên Khuyến Mãi</label>
            <input type="text" class="form-control" id="name" name="sale_name" required>
        </div>
        <div class="form-group">
            <label for="description">Mô Tả</label>
            <textarea class="form-control" id="description" name="sale_description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="discount">Giảm Giá (%)</label>
            <input type="text" class="form-control" id="discount" name="discount_percent" required>
        </div>
        <div class="form-group">
            <label for="start_date">Ngày Bắt Đầu</label>
            <input type="datetime-local" class="form-control" id="start_date" name="start_time" required>
        </div>
        <div class="form-group">
            <label for="end_date">Ngày Kết Thúc</label>
            <input type="datetime-local" class="form-control" id="end_date" name="end_time" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm Khuyến Mãi</button>
    </form>
</div>
@endsection