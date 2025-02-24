@extends('component.Default.layoutU')

@section('title', 'Home')

@section('guestBody')
    <div class="food-detail-container">
        <!-- Hàng 1: Gồm 2 div trái & phải -->
        <div class="food-detail-row">
            <!-- Cột trái (Chứa nội dung sản phẩm) -->
            <div class="food-detail-column food-detail-left">
                <div class="food-detail-box">
                    <div class="food-detail-image-container">
                        <div class="food-detail-slider">
                            @foreach ($foodImages as $index => $image)
                                <div class="food-detail-slide {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ $image }}" alt="Cơm cháy chiên mắm">
                                </div>
                            @endforeach
                        </div>
                        <div class="food-detail-badge">
                            <span class="food-detail-current-slide">1</span>/<span class="food-detail-total-slides">{{ count($foodImages) }}</span>
                        </div>
                    </div>
                    <div class="food-detail-content">
                        <div class="food-detail-price">
                            <span class="food-detail-current-price">29.000đ</span>
                            <span class="food-detail-old-price">32.000đ</span>
                            <span class="food-detail-discount">-9%</span>
                        </div>
                        <div class="food-detail-promo">Tiết kiệm 8% với thưởng</div>
                        <div class="food-detail-product-name">500g cơm cháy chiên mắm vỡ loại 1</div>
                        <div class="food-detail-rating">
                            <span class="food-detail-star">⭐ 5.0</span>
                            <span>/ 5</span>
                            <span>(3)</span>
                            <span class="food-detail-sold">Đã bán 37</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cột phải (Chứa nội dung khác) -->
            <div class="food-detail-column food-detail-right">
                <div class="food-detail-box">
                    <h2>Nội dung bên phải</h2>
                    <p>Thêm nội dung bạn muốn ở đây...</p>
                </div>
            </div>
        </div>

        <!-- Hàng 2: Phần nội dung phía dưới -->
        <div class="food-detail-row food-detail-full-width">
            <div class="food-detail-box">
                <h2>Nội dung bên dưới</h2>
                <p>Phần này sẽ nằm dưới 2 div trên...</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slides = document.querySelectorAll('.food-detail-slide');
            const currentSlideElement = document.querySelector('.food-detail-current-slide');
            const totalSlidesElement = document.querySelector('.food-detail-total-slides');
            let currentSlide = 0;
            const totalSlides = slides.length;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.classList.toggle('active', i === index);
                });
                currentSlideElement.textContent = index + 1;
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % totalSlides;
                showSlide(currentSlide);
            }

            setInterval(nextSlide, 3000); // Change slide every 3 seconds
        });
    </script>
@endsection