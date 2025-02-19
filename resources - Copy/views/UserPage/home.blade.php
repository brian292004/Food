@extends('component.Default.layoutU')

@section('title', 'Home')


@section('guestBody')

    <!-- Khối ngang 1: Banner (slider trượt ngang) -->
    <div id="bannerContainer">
        <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="slide active">
                <img src="img/image1.png" alt="Image 1">
                <div class="overlay-text">Text for Image 1</div>
            </div>
            <div class="slide">
                <img src="img/image1.png" alt="Image 2">
                <div class="overlay-text">Text for Image 2</div>
            </div>
        </div>
        <div id="bannerSidebar" class="carousel-item">
            <img src="img/image1.png" class="d-block w-100" alt="Banner 3">
            <div class="overlay-text">Text for Sidebar Image</div>
        </div>
    </div>

    <!-- Khối ngang 2: Danh mục nổi bật -->
    <section class="featured-categories py-4 text-center">
        <div class="d-flex justify-content-between align-items-center title-container">
            <h2 class="category-title" data-lang-key="featured_categories">Danh mục nổi bật</h2>
            <span class="update-date">{{ date('d/m/Y') }}</span>
            <div class="icons">
                <div class="icon-wrapper">
                    <svg class="icon-left" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                        width="24px" fill="#F3F3F3">
                        <path d="M400-80 0-480l400-400 71 71-329 329 329 329-71 71Z" />
                    </svg>
                </div>
                <div class="icon-wrapper">
                    <svg class="icon-right" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                        width="24px" fill="#F3F3F3">
                        <path d="m321-80-71-71 329-329-329-329 71-71 400 400L321-80Z" />
                    </svg>
                </div>
            </div>

        </div>

        <div class="container">
            <div class="row flex-nowrap overflow-auto" id="featured-products" data-total="{{ $featuredProducts->count() }}">
                @foreach($featuredProducts as $product)
                    <div class="col-md-3 col-sm-4 col-6 category-wrapper">
                        <div class="category-card">
                            <img src="{{  $product->food_image }}" class="img-fluid rounded" alt="{{ $product->food_name }}">
                            <div class="product-info">
                                <div class="product-name">{{ $product->food_name }}</div>
                                <div class="product-price">{{ number_format($product->food_price, 0, ',', '.') }} đ</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </section>

@endsection