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
        <div class="product-catalog-product">
            <img src="https://storage.googleapis.com/a1aa/image/jEt4FfQ1mLDqfmRqZ5k_zMqrWo20ZBxM_GgR3Qs_AOM.jpg" alt="Product 1">
            <p>Thùng 48 Hộp Sữa Active Go Ít Đường</p>
            <p class="product-catalog-price">306.000đ</p>
            <p>Tặng 2 túi đựng bút</p>
        </div>
        <div class="product-catalog-product">
            <img src="https://storage.googleapis.com/a1aa/image/KSXOjg6o-Vm8od7pKQIkhcH8q1HqHveFmgUd1F4kQx8.jpg" alt="Product 2">
            <p>Coco Xim</p>
            <p class="product-catalog-price">10% OFF</p>
        </div>
        <div class="product-catalog-product">
            <img src="https://storage.googleapis.com/a1aa/image/Y7XYYA3mflf7Rxe6jtWCJlwqvacdumec8xpDByAY-Tw.jpg" alt="Product 3">
            <p>Fanta</p>
            <p class="product-catalog-price">15% OFF</p>
        </div>
        <div class="product-catalog-product">
            <img src="https://storage.googleapis.com/a1aa/image/aet9J2edaMQrLMFLIADdb63OL718SwJlxO_JamNw834.jpg" alt="Product 4">
            <p>Tea</p>
            <p class="product-catalog-price">5% OFF</p>
        </div>
    </div>
</div>
@endsection