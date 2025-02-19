@extends('layout')
@section('adminBody')
<div class="container">
    <h1>Thêm Khuyến Mãi</h1>
    <form action="{{ route('admin.storePromotion') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên Khuyến Mãi</label>
            <input type="text" class="form-control" id="name" name="pm_name" required>
        </div>
        <div class="form-group">
            <label for="description">Mô Tả</label>
            <textarea class="form-control" id="description" name="pm_description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="discount">Giảm Giá (%)</label>
            <input type="text" class="form-control" id="discount" name="pm_discount" required>
        </div>
        <div class="form-group">
            <label for="start_date">Ngày Bắt Đầu</label>
            <input type="date" class="form-control" id="start_date" name="pm_start_date" required>
        </div>
        <div class="form-group">
            <label for="end_date">Ngày Kết Thúc</label>
            <input type="date" class="form-control" id="end_date" name="pm_end_date" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm Khuyến Mãi</button>
    </form>
</div>
@endsection