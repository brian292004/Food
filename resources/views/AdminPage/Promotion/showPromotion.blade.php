@extends('layout')
@section('adminBody')
<div class="container">
    <h1 class="my-4">Quản lý Khuyến mãi</h1>

    <a href="{{ route('admin.addPromotion') }}" class="btn btn-primary mb-3">Thêm Khuyến mãi mới</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên Khuyến mãi</th>
                <th>Mô tả</th>
                <th>Giảm</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promotions as $promotion)
            <tr>
                <td>{{ $promotion->pm_name }}</td>
                <td>{{ $promotion->pm_description }}</td>
                <td>{{ $promotion->pm_discount }} %</td>
                <td>{{ $promotion->pm_start_date }}</td>
                <td>{{ $promotion->pm_end_date }}</td>
                <td>
                    <a href="{{ route('admin.editPromotion', $promotion->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.deletePromotion', $promotion->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection