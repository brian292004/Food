<?php

namespace App\Http\Controllers;
use App\Models\Food;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Cache::remember('featured_products', 600, function () {
            return Food::where('food_is_featured', 1)
                ->select('id', 'food_name', 'food_price', 'food_image')
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        });
        return view('UserPage.home', compact('featuredProducts'));
    }
}