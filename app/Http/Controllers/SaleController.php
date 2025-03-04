<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale\Sale;
use App\Models\Sale\SaleShop;
use App\Models\Sale\SaleFood;
use App\Models\Shop;
use App\Models\Food;

class SaleController extends Controller
{
    public function addSale()
    {
        return view('AdminPage.Sale.addSale');
    }

    public function storeSale(Request $request)
    {
        $request->validate([
            'sale_name' => 'required',
            'sale_description' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'discount_percent' => 'required',
        ]);

        $sales = new sale();
        $sales->sale_name = $request->sale_name;
        $sales->sale_description = $request->sale_description;
        $sales->start_time = $request->start_time;
        $sales->end_time = $request->end_time;
        $sales->discount_percent = $request->discount_percent;
        $sales->save();

        return redirect()->route('admin.showSale');
    }

    public function editSale($id)
    {
        $sales = Sale::find($id);
        return view('AdminPage.Sale.editSale', compact('sales'));
    }

    public function updateSale(Request $request, $id)
    {
        $request->validate([
            'sale_name' => 'required|min:3|max:50',
            'sale_description' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'discount_percent' => 'required|min:1|max:100',
        ]);

        $sales = sale::find($id);
        $sales->sale_name = $request->sale_name;
        $sales->sale_description = $request->sale_description;
        $sales->start_time = $request->start_time;
        $sales->end_time = $request->end_time;
        $sales->discount_percent = $request->discount_percent;
        $sales->save();

        return redirect()->route('admin.showSale');
    }

    public function deleteSale($id)
    {
        $sales = Sale::find($id);
        $sales->delete();

        return redirect()->route('admin.showSale');
    }

    public function searchsale(Request $request)
    {
        $keyword = $request->keyword;
        $sales = Sale::where('sale_name', 'like', "%$keyword%")
            ->orWhere('discount_percent', 'like', "%$keyword%")
            ->get();
        return view('AdminPage.Sale.showSale', compact('sales'));
    }

    public function infoSale($id)
    {
        $sales = Sale::find($id);
        return view('AdminPage.Sale.infoSale', compact('sales'));
    }

    public function showSale()
    {
        $sales = Sale::all();
        return view('AdminPage.Sale.showSale', compact('sales'));
    }
    // Tạo chương trình khuyến mãi mới
    // public function createSale(Request $request)
    // {
    //     $Sale = Sale::create([
    //         'sale_name' => $request->sale_name,
    //         'sale_description' => $request->sale_description,
    //         'discount_percent' => $request->discount_percent,
    //         'discount_amount' => $request->discount_amount,
    //         'start_time' => $request->start_time,
    //         'end_time' => $request->end_time,
    //         'is_active' => $request->is_active ?? true,
    //     ]);

    //     return response()->json(['message' => 'Sale created successfully', 'sale' => $Sale], 201);
    // }

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
        $Sale = Sale::with('shops', 'foods')->get();
        return response()->json($Sale);
    }
}
