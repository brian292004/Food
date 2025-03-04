<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sale;

class saleController extends Controller
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

        $sale = new sale();
        $sale->sale_name = $request->sale_name;
        $sale->sale_description = $request->sale_description;
        $sale->start_time = $request->start_time;
        $sale->end_time = $request->end_time;
        $sale->discount_percent = $request->discount_percent;
        $sale->save();

        return redirect()->route('admin.showSale');
    }

    public function editSale($id)
    {
        $sale = sale::find($id);
        return view('AdminPage.Sale.editSale', compact('sale'));
    }

    public function updatesale(Request $request, $id)
    {
        $request->validate([
            'sale_name' => 'required|min:3|max:50',
            'sale_description' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'discount_percent' => 'required|min:1|max:100',
        ]);

        $sale = sale::find($id);
        $sale->sale_name = $request->sale_name;
        $sale->sale_description = $request->sale_description;
        $sale->start_time = $request->start_time;
        $sale->end_time = $request->end_time;
        $sale->discount_percent = $request->discount_percent;
        $sale->save();

        return redirect()->route('admin.showSale');
    }

    public function deletesale($id)
    {
        $Sale = Sale::find($id);
        $sale->delete();

        return redirect()->route('admin.showSale');
    }

    public function searchsale(Request $request)
    {
        $keyword = $request->keyword;
        $Sale = Sale::where('sale_name', 'like', "%$keyword%")
            ->orWhere('discount_percent', 'like', "%$keyword%")
            ->get();
        return view('AdminPage.Sale.showSale', compact('Sale'));
    }

    public function infosale($id)
    {
        $sale = Sale::find($id);
        return view('AdminPage.Sale.infoSale', compact('sale'));
    }

    public function showSale()
    {
        $Sale = Sale::all();
        return view('AdminPage.Sale.showSale', compact('Sale'));
    }

    public function locksale($id)
    {
        $Sale = Sale::find($id);
        $sale->pm_status = 0;
        $sale->save();

        return redirect()->route('admin.showSale');
    }
}
