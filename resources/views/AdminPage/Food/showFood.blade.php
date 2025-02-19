@extends('layout')
@section('adminBody')
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4 text-primary">Danh sách đồ ăn</h1>
        <div class="row mb-4">
            <div class="col-md-6">
                <form id="searchForm" action="{{ route('admin.searchFood') }}" method="get" class="d-flex">
                    <input type="text" class="form-control search-input" name="keyword" placeholder="Nhập từ khóa tìm kiếm..." 
                    aria-label="Search" aria-describedby="basic-addon2">
                    <button class="btn btn-primary ml-2" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </form>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('admin.addFood') }}" class="btn btn-primary">Thêm món ăn</a>
            </div>
        </div>
        @foreach($foods as $food)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/food_images/' . $food->food_image) }}" alt="{{ $food->food_name }}" class="img-fluid rounded-start food-image">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $food->shop->shop_name }}</h5>
                            <p class="card-text"><strong>Tên món:</strong> {{ $food->food_name }}</p>
                            <p class="card-text"><strong>Giá:</strong> {{ number_format($food->food_price, 0, ',', '.') }} VND</p>
                            <p class="card-text"><strong>Mô tả:</strong> {{ $food->food_description }}</p>
                            <p class="card-text"><strong>Đánh giá:</strong> {{ $food->food_rating }} / 5</p>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <div class="btn-button w-100" role="group" aria-label="Basic example">
                            <a href="{{ route('admin.editFood', ['id' => $food->id]) }}" class="btn btn-warning btn-circleFood btn-action">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="{{ route('admin.deleteFood', ['id' => $food->id]) }}" class="btn btn-danger btn-circleFood btn-action" onclick="return confirm('Bạn có chắc chắn muốn xóa món ăn này?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            <a href="{{ route('admin.infoFood', ['id' => $food->id]) }}" class="btn btn-info btn-circleFood btn-action">
                                <i class="fas fa-info-circle"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</body>
@endsection