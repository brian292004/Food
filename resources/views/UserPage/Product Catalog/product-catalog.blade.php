@extends('component.Default.layoutU')

@section('title', 'Home')

@section('guestBody')
<div class="product-catalog-container">
    <!-- Banner Section -->
    <div class="product-catalog-grid product-catalog-grid-2">
        <div class="product-catalog-card">
            <div class="product-catalog-card-content">
                <h2>THỰC PHẨM SẠCH</h2>
                <p>Đồ ăn tươi ngon <br> Mỗi ngày</p>
                <a href="#" class="product-catalog-button">XEM THÊM</a>
            </div>
            <img src="https://storage.googleapis.com/a1aa/image/DxT-0uAHWcLKIV_6UnUeZrm8Ir8ID_Z0ULG-cMV_wAk.jpg" alt="Fresh grapes">
        </div>
        <div class="product-catalog-card">
            <div class="product-catalog-card-content">
                <h2>THỰC PHẨM TƯƠI</h2>
                <p>Giao nhanh <br> Chớp mắt</p>
                <a href="#" class="product-catalog-button" style="background:#facc15;">XEM THÊM</a>
            </div>
            <img src="https://storage.googleapis.com/a1aa/image/cDb7Lo0-n4N0BU61cRRz4eqmJCbJLedcBK3E7XrFmS8.jpg" alt="Fresh lemon">
        </div>
    </div>

    <!-- Product Section -->
    <h2 style="margin-top: 20px;">TRÁI CÂY NHẬP KHẨU</h2>
    <div class="product-catalog-grid product-catalog-grid-4">
        @foreach ($foods as $food)
            <div class="product-catalog-product" data-href="{{ route('food.detail', ['id' => $food->id]) }}">
                <img src="{{ asset('storage/food_images/' . $food->food_image) }}" alt="{{ $food->food_name }}" class="img-fluid">
                <strong class="product-catalog-address">{{$food->food_name}}</strong>
                <p class="product-catalog-price">{{number_format($food->food_price)}} VNĐ</p>
                <p class="product-catalog-address">Địa chỉ: {{$food->shop->shop_address}}</p>
                <hr>
                @if ($food->saleFood && $food->saleFood->sale)
                    <p class="product-catalog-price">Giảm: {{ number_format( $food->saleFood->sale->discount_percent,0) }}%</p>
                @else
                    <p class="product-catalog-price">Không có khuyến mãi</p>
                @endif
            </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var products = document.querySelectorAll('.product-catalog-product');
        products.forEach(function(product) {
            product.addEventListener('click', function() {
                var href = this.getAttribute('data-href');
                if (href) {
                    window.location.href = href;
                }
            });
        });
    });
</script>
@endsection