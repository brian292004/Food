@extends('layout')
@section('adminBody')
<div class="container">
    <h1>Chi tiết món ăn</h1>
    <div class="card">
        <div class="card-header">
            <h2>{{ $food->food_name }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Tên món:</strong> {{ $food->shop->shop_name }}</p>
            <p><strong>Giá:</strong> {{number_format($food->food_price, 0, ',', '.')  }} VNĐ</p>
            <p><strong>Chi tiết món ăn:</strong> {{ $food->food_description }}</p>
            <p><strong>Giảm giá:</strong> 
            @if($food->saleFood && $food->saleFood->sale)
                {{ number_format($food->saleFood->sale->discount_percent,0)}}%
            @else
                Không có khuyến mãi
            @endif</p>
        </div>
    </div>
    <a href="{{ route('admin.showFood') }}" class="btn btn-primary mt-3">Back to Food List</a>
</div>
@endsection