<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionController extends Controller
{
    public function addPromotion()
    {
        return view('AdminPage.Promotion.addPromotion');
    }

    public function storePromotion(Request $request)
    {
        $request->validate([
            'pm_name' => 'required',
            'pm_description' => 'required',
            'pm_start_date' => 'required',
            'pm_end_date' => 'required',
            'pm_discount' => 'required',
        ]);

        $promotion = new Promotion();
        $promotion->pm_name = $request->pm_name;
        $promotion->pm_description = $request->pm_description;
        $promotion->pm_start_date = $request->pm_start_date;
        $promotion->pm_end_date = $request->pm_end_date;
        $promotion->pm_discount = $request->pm_discount;
        $promotion->save();

        return redirect()->route('admin.showPromotion');
    }

    public function editPromotion($id)
    {
        $promotion = Promotion::find($id);
        return view('AdminPage.Promotion.editPromotion', compact('promotion'));
    }

    public function updatePromotion(Request $request, $id)
    {
        $request->validate([
            'pm_name' => 'required|min:3|max:50',
            'pm_description' => 'required',
            'pm_start_date' => 'required',
            'pm_end_date' => 'required',
            'pm_discount' => 'required|min:1|max:100',
        ]);

        $promotion = Promotion::find($id);
        $promotion->pm_name = $request->pm_name;
        $promotion->pm_description = $request->pm_description;
        $promotion->pm_start_date = $request->pm_start_date;
        $promotion->pm_end_date = $request->pm_end_date;
        $promotion->pm_discount = $request->pm_discount;
        $promotion->save();

        return redirect()->route('admin.showPromotion');
    }

    public function deletePromotion($id)
    {
        $promotion = Promotion::find($id);
        $promotion->delete();

        return redirect()->route('admin.showPromotion');
    }

    public function searchPromotion(Request $request)
    {
        $keyword = $request->keyword;
        $promotions = Promotion::where('pm_name', 'like', "%$keyword%")
            ->orWhere('pm_discount', 'like', "%$keyword%")
            ->get();
        return view('AdminPage.Promotion.showPromotion', compact('promotions'));
    }

    public function infoPromotion($id)
    {
        $promotion = Promotion::find($id);
        return view('AdminPage.Promotion.infoPromotion', compact('promotion'));
    }

    public function showPromotion()
    {
        $promotions = Promotion::all();
        return view('AdminPage.Promotion.showPromotion', compact('promotions'));
    }

    public function lockPromotion($id)
    {
        $promotion = Promotion::find($id);
        $promotion->pm_status = 0;
        $promotion->save();

        return redirect()->route('admin.showPromotion');
    }
}
