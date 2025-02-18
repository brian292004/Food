<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class FoodController extends Controller
{
    public function index()
    {
        $foods = Cache::remember('foods_list', 600, function () {
            return Product::select('id', 'name', 'image', 'price')
                ->orderBy('created_at', 'desc') // Sắp xếp theo thời gian mới nhất
                ->limit(20) // Giới hạn số lượng lấy ra (có thể điều chỉnh)
                ->get();
        });
        Log::info($foods);
        return view('UserPage.Food.food-list',compact('foods'));
    }

}
