<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleShop;
use App\Models\SaleFood;
use App\Models\Shop;
use App\Models\Food;

class SaleController extends Controller
{
    // Tạo chương trình khuyến mãi mới
    public function createSale(Request $request)
    {
        $sale = Sale::create([
            'sale_name' => $request->sale_name,
            'sale_description' => $request->sale_description,
            'discount_percent' => $request->discount_percent,
            'discount_amount' => $request->discount_amount,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'is_active' => $request->is_active ?? true,
        ]);

        return response()->json(['message' => 'Sale created successfully', 'sale' => $sale], 201);
    }

    // Gán khuyến mãi cho cửa hàng
    public function assignSaleToShop(Request $request)
    {
        SaleShop::create([
            'sale_id' => $request->sale_id,
            'shop_id' => $request->shop_id,
        ]);

        return response()->json(['message' => 'Sale assigned to shop successfully']);
    }

    // Gán khuyến mãi cho món ăn
    public function assignSaleToFood(Request $request)
    {
        SaleFood::create([
            'sale_id' => $request->sale_id,
            'food_id' => $request->food_id,
        ]);

        return response()->json(['message' => 'Sale assigned to food successfully']);
    }

    // Xem danh sách các chương trình khuyến mãi
    public function listSales()
    {
        $sales = Sale::with('shops', 'foods')->get();
        return response()->json($sales);
    }
}
