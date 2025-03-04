@extends('component.Default.layoutU')

@section('title', 'detail')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="https://cdn.tailwindcss.com"></script>
@section('guestBody')
    <div class="food-detail-container">
        <div class="food-detail-shop-banner">
            <img src="https://storage.googleapis.com/a1aa/image/bUuPVWtiMRMRnpHY001Pkgbkqtz6lHipJ1mxEDoGH0w.jpg"
                alt="Interior of a modern grill house" />
            <div class="food-detail-shop-banner-content">
                <h1>Urban Grill House</h1>
                <div class="food-detail-shop-info">
                    <i class="fas fa-star"></i>
                    <span>4.7 (1205)</span>
                    <span>•</span>
                    <i class="fas fa-clock"></i>
                    <span>25-35 min</span>
                    <span>•</span>
                    <i class="fas fa-map-marker-alt"></i>
                    <span>1.2 miles away</span>
                </div>
            </div>
        </div>

        <!-- Hàng 1: Gồm 2 div trái & phải -->
        <div class="food-detail-row">
            <!-- Cột trái (Chứa nội dung sản phẩm) -->
            <div class="food-detail-column food-detail-left">
                <div class="food-detail-box">
                    <div class="food-detail-image-container">
                        <div class="food-detail-slider">
                            @foreach ($foodImages as $index => $image)
                                <div class="food-detail-slide {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset($image) }}" alt="Cơm cháy chiên mắm">
                                </div>
                            @endforeach
                        </div>
                        <div class="food-detail-badge">
                            <span class="food-detail-current-slide">1</span>/<span
                                class="food-detail-total-slides">{{ count($foodImages) }}</span>
                        </div>
                    </div>
                    <div class="food-detail-content">
                        <div class="food-detail-price">
                            @if ($food->sale_value == 0)
                                <span class="food-detail-current-price">{{ $food->food_price }}đ</span>
                            @else
                                <span class="food-detail-current-price">{{ $food->new_price }}đ</span>
                                <span class="food-detail-old-price">{{ $food->old_price }}đ</span>
                                <span class="food-detail-discount">-{{ $food->sale_value }}%</span>
                            @endif
                        </div>
                        @if ($food->sale_value != 0)
                            <div class="food-detail-promo">Tiết kiệm {{ $food->sale_value }}% với thưởng</div>
                        @endif
                        <div class="food-detail-product-name">{{ $food->food_name }}</div>
                        <div class="food-detail-description">{{ $food->food_description }}</div>
                        <div class="food-detail-shop-name">Được bán bởi {{ $food->shop_name }}</div>
                        <div class="food-detail-rating">
                            <span class="food-detail-star">⭐ {{ $food->food_average_rating }}</span>
                            <span>/ 5</span>
                            <span>({{ $food->food_total_feedbacks }} lượt phản hồi)</span>
                            <span class="food-detail-sold">Đã bán {{ $food->food_sold_count }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cột phải (Chứa nội dung khác) -->
            <div class="food-detail-column food-detail-right">
                <div class="food-detail-box">
                    <!-- Chọn loại hàng -->
                    <div class="food-detail-item">
                        <div class="option-container">
                            <label class="option-label">Các tùy chọn:</label>
                            <span class="option active" data-price="{{ $food->food_price }}"
                                onclick="selectOption(this)">Default</span>
                            <span class="option" data-price="{{ $food->food_price + 5000 }}"
                                onclick="selectOption(this)">Tùy chọn 1</span>
                            <span class="option" data-price="{{ $food->food_price + 10000 }}"
                                onclick="selectOption(this)">Tùy chọn 2</span>
                            <span class="option" data-price="{{ $food->food_price + 15000 }}"
                                onclick="selectOption(this)">Tùy chọn 3</span>
                        </div>
                    </div>

                    <!-- Chọn số lượng -->
                    <div class="flex items-center border rounded-full px-4 py-2 bg-white shadow">
                        <button class="text-xl font-semibold text-gray-700" onclick="changeQuantity(-1)">-</button>
                        <input type="number" id="quantity" value="1" min="1" readonly
                            class="mx-4 text-xl font-semibold text-gray-700 bg-transparent text-center w-12">
                        <button class="text-xl font-semibold text-gray-700" onclick="changeQuantity(1)">+</button>
                    </div> 
                    <!-- Địa chỉ nhận hàng -->
                    <div class="food-detail-item">
                        <label>Địa chỉ:</label>
                        <span id="user-address">{{ $user->address ?? 'Không có thông tin' }}</span>
                        <button class="change-btn" onclick="changeAddress()">Thay đổi</button>
                    </div>

                    <!-- Phương thức thanh toán -->
                    <div class="food-detail-item">
                        <label>Thanh toán:</label>
                        <div class="dropdown">
                            <button class="dropdown-btn" onclick="toggleDropdown()">
                                <i class="fa-solid fa-money-bill-wave"></i> <!-- Icon mặc định -->
                                <span id="selected-payment">Thanh toán khi nhận hàng</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li onclick="selectPayment('cod', 'fa-money-bill-wave', 'Thanh toán khi nhận hàng')">
                                    <i class="fa-solid fa-money-bill-wave"></i> Thanh toán khi nhận hàng (COD)
                                </li>
                                <li onclick="selectPayment('bank', 'fa-building-columns', 'Chuyển khoản ngân hàng')">
                                    <i class="fa-solid fa-building-columns"></i> Chuyển khoản ngân hàng
                                </li>
                                <li onclick="selectPayment('momo', 'fa-wallet', 'Ví MoMo')">
                                    <i class="fa-solid fa-wallet"></i> Ví MoMo
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Nút thao tác -->
                    <div class="food-detail-buttons">
                        <button class="cart-btn">🛒 Thêm vào giỏ hàng</button>
                        <button class="buy-btn">🛍 Mua ngay - <span id="buy-price">{{ $food->food_price }}đ</span></button>
                    </div>
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

        document.addEventListener('DOMContentLoaded', function () {
            const quantityInput = document.getElementById('quantity');
            const buyPrice = document.getElementById('buy-price');
            const basePrice = {{ $food->food_price }};

            function updatePrice() {
                const quantity = parseInt(quantityInput.value);
                buyPrice.textContent = (basePrice * quantity) + "đ";
            }

            window.changeQuantity = function (change) {
                let quantity = parseInt(quantityInput.value) + change;
                if (quantity < 1) quantity = 1;
                quantityInput.value = quantity;
                updatePrice();
            };

            window.changeAddress = function () {
                let newAddress = prompt("Nhập địa chỉ mới:");
                if (newAddress) {
                    document.getElementById('user-address').textContent = newAddress;
                }
            };

            window.toggleDropdown = function () {
                document.querySelector('.dropdown-menu').classList.toggle('show');
            };

            window.selectPayment = function (method, iconClass, text) {
                const dropdownBtn = document.querySelector('.dropdown-btn');
                dropdownBtn.innerHTML = `<i class="fa-solid ${iconClass}"></i> ${text}`;
                document.querySelector('.dropdown-menu').classList.remove('show');
            };

            // Close dropdown when clicking outside
            document.addEventListener('click', function (event) {
                const dropdown = document.querySelector('.dropdown');
                if (!dropdown.contains(event.target)) {
                    document.querySelector('.dropdown-menu').classList.remove('show');
                }
            });

            // Synchronized scrolling for left and right columns
            const foodDetailLeft = document.querySelector('.food-detail-left');
            const foodDetailRight = document.querySelector('.food-detail-right');

            function syncScroll(event) {
                const leftScrollHeight = foodDetailLeft.scrollHeight - foodDetailLeft.clientHeight;
                const rightScrollHeight = foodDetailRight.scrollHeight - foodDetailRight.clientHeight;

                const scrollRatio = event.target.scrollTop / event.target.scrollHeight;

                if (event.target === foodDetailLeft) {
                    foodDetailRight.scrollTop = scrollRatio * rightScrollHeight;
                } else {
                    foodDetailLeft.scrollTop = scrollRatio * leftScrollHeight;
                }
            }

            foodDetailLeft.addEventListener('scroll', syncScroll);
            foodDetailRight.addEventListener('scroll', syncScroll);
        });

        function selectOption(element) {
            // Bỏ class active khỏi tất cả lựa chọn
            document.querySelectorAll('.option').forEach(option => {
                option.classList.remove('active');
            });

            // Thêm class active cho lựa chọn được chọn
            element.classList.add('active');
        }
    </script>
@endsection