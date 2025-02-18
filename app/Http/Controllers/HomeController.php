<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Cache::remember('featured_products', 600, function () {
            return Product::where('is_featured', 1)
                ->select('id', 'name', 'price', 'image')
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        });
        return view('UserPage.home', compact('featuredProducts'));
    }
}
