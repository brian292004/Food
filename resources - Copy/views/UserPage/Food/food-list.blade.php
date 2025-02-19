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
                <div class="food-list-card">
                    <img src="{{ $food->food_image }}" alt="{{ $food->food_name }}">
                    <h3>{{ $food->food_name }}</h3>
                    <p class="food-list-text-gray">${{ number_format($food->food_price, 2) }}</p>
                    <p class="food-list-text-gray">{{ $food->food_availability ?? 0 }} Bowls available</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection