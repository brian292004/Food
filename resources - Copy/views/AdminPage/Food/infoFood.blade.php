@extends('layout')
@section('adminBody')
<div class="container">
    <h1>Food Information</h1>
    <div class="card">
        <div class="card-header">
            <h2>{{ $food->food_name }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Category:</strong> {{ $food->shop->shop_name }}</p>
            <p><strong>Price:</strong> {{number_format($food->food_price, 0, ',', '.')  }} VNĐ</p>
            <p><strong>Description:</strong> {{ $food->food_description }}</p>
            <p><strong>Available:</strong> {{ $food->available ? 'Yes' : 'No' }}</p>
        </div>
    </div>
    <a href="{{ route('admin.showFood') }}" class="btn btn-primary mt-3">Back to Food List</a>
</div>
@endsection