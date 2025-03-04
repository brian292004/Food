@extends('layout')
@section('adminBody')
<div class="container">
    <h1 class="my-4">Quản lý Khuyến mãi</h1>

    <a href="{{ route('admin.addSale') }}" class="btn btn-primary mb-3">Thêm Khuyến mãi mới</a>

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
            @foreach($sales as $sale)
            <tr>
                <td>{{ $sale->sale_name }}</td>
                <td>{{ $sale->sale_description }}</td>
                <td>{{ number_format($sale->discount_percent,0)}} %</td>
                <td>{{ $sale->start_time }}</td>
                <td>{{ $sale->end_time }}</td>
                <td>
                    <a href="{{ route('admin.editSale', $sale->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.deleteSale', $sale->id) }}" method="POST" style="display:inline-block;">
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