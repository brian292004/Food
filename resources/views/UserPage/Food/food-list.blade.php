@extends('component.Default.layoutU')

@section('title', 'Home')

@section('guestBody')
    <div class="food-list-wrapper">
        <div class="food-list-container">
            <header class="food-list-header">
                <div>
                    <h1>Jaegar Resto</h1>
                    <p class="food-list-text-gray">Tuesday, 2 Feb 2021</p>
                </div>
                <input type="text" class="food-list-search-box" placeholder="Search for food, coffee, etc...">
            </header>
            <div class="flash-sale-food-container">
                <div class="flash-sale-food-header">
                    <div class="flash-sale-food-title">
                        <i class="fas fa-bolt"></i> Flash Sale
                    </div>
                    <span class="flash-sale-food-discount">Bấm Săn Deal - 70%</span>
                    <div class="flash-sale-food-timer">
                        <div>09</div><span>:</span>
                        <div>33</div><span>:</span>
                        <div>59</div>
                    </div>
                </div>
                <div class="flash-sale-food-grid">
                    <div class="flash-sale-food-product">
                        <img src="https://storage.googleapis.com/a1aa/image/Wc54jNgA6XKmTQIZw-cjonPP7eqh4fmSBnnch5BCIjo.jpg"
                            alt="Gaming mouse">
                        <span class="flash-sale-food-discount-tag">-70%</span>
                        <div class="flash-sale-food-price-info">
                            <div class="price-row">
                                <span class="flash-sale-food-new-price">1₫</span>
                                <span class="flash-sale-food-old-price">112.944₫</span>
                            </div>
                            <h3 class="flash-sale-food-name">Gaming mouse</h3>
                        </div>
                    </div>
                    <div class="flash-sale-food-product">
                        <img src="https://storage.googleapis.com/a1aa/image/jVhRquw7leMxHHXhGbXmoiF2IX8ymGcn8XAxVvsG7js.jpg"
                            alt="Electric shaver">
                        <span class="flash-sale-food-discount-tag">-70%</span>
                        <div class="flash-sale-food-price-info">
                            <div class="price-row">
                                <span class="flash-sale-food-new-price">1₫</span>
                                <span class="flash-sale-food-old-price">112.944₫</span>
                            </div>
                            <h3 class="flash-sale-food-name">Electric shaver</h3>
                        </div>
                    </div>
                    <div class="flash-sale-food-product">
                        <img src="https://storage.googleapis.com/a1aa/image/AklHt1jqWLnPmqK9D5uwwktcokhPTeXwewrisQfswqs.jpg"
                            alt="Pack of Cozy tea">
                        <span class="flash-sale-food-discount-tag">-70%</span>
                        <div class="flash-sale-food-price-info">
                            <div class="price-row">
                                <span class="flash-sale-food-new-price">1₫</span>
                                <span class="flash-sale-food-old-price">112.944₫</span>
                            </div>
                            <h3 class="flash-sale-food-name">Pack of Cozy tea</h3>
                        </div>
                    </div>
                    <div class="flash-sale-food-product">
                        <img src="https://storage.googleapis.com/a1aa/image/1rNKFD1WVZb0f0zn9wEXhCk3uQ_Dgovvg6E0CiLvVho.jpg"
                            alt="Black belt">
                        <span class="flash-sale-food-discount-tag">-70%</span>
                        <div class="flash-sale-food-price-info">
                            <div class="price-row">
                                <span class="flash-sale-food-new-price">1₫</span>
                                <span class="flash-sale-food-old-price">112.944₫</span>
                            </div>
                            <h3 class="flash-sale-food-name">Black belt</h3>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="food-list-nav">
                <a href="#">Hot Dishes</a>
                <a href="#" class="food-list-text-gray">Cold Dishes</a>
                <a href="#" class="food-list-text-gray">Soup</a>
                <a href="#" class="food-list-text-gray">Grill</a>
                <a href="#" class="food-list-text-gray">Appetizer</a>
                <a href="#" class="food-list-text-gray">Dessert</a>
            </nav>

            <h2>Choose Dishes</h2>

            <div class="food-list-grid">
                @foreach ($foods as $food)
                    <div class="food-list-card" data-id="{{ $food->food_id }}" >
                        <!-- Phần 1: Hình ảnh -->
                        <div class="food-image-container">
                            <img src="{{ $food->food_image }}" alt="{{ $food->food_name }}">
                        </div>

                        <!-- Phần 2: Tên món -->
                        <h3 class="food-list-name">{{ $food->food_name }}</h3>

                        <!-- Phần 3: Giá tiền -->
                        <div class="food-list-price-container">
                            @if ($food->discount_percent > 0 || $food->discount_amount > 0)
                                <span class="food-list-new-price">{{ number_format($food->new_price, 0) }}<span class="currency">Vnđ</span></span>
                                <span class="food-list-old-price">{{ number_format($food->old_price, 0) }}<span class="currency">Vnđ</span></span>
                            @else
                                <span class="food-list-regular-price">${{ number_format($food->old_price, 2) }}</span>
                            @endif
                        </div>

                        <!-- Phần 4: Số lượng còn lại -->
                        <div class="food-list-rating-sold">
                            <div class="food-list-rating">
                                ⭐ {{ number_format($food->food_average_rating, 1) }}
                            </div>
                            <div class="food-list-sold">
                                Đã bán: {{ $food->food_sold_count}}
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection