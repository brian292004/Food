<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Food;
use App\Models\Shop;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class FoodController extends Controller
{
    public function food()
    {
        $foods = Food::paginate(3);
        return view('AdminPage.Food.showFood', compact(
            'foods'
        ));
    }

    public function addFood()
    {
        $Shop = Shop::all();
        return view('AdminPage.Food.addFood', compact(
            'Shop'
        ));
    }

    public function storeFood(Request $request)
    {
        $request->validate([
            'food_name' => 'required',
            'food_price' => 'required',
            'food_description' => 'required|min:5|max:255',
            'food_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'food_rating' => 'required',
            'shop_id' => 'required',
        ]);
        $food = new Food();
        $food->food_name = $request->food_name;
        $food->food_price = $request->food_price;
        $food->food_description = $request->food_description;
        $food->shop_id = $request->shop_id;
        if ($request->hasFile('food_image')) {
            $food_image = $request->file('food_image');
            $food_imageName = time() . '.' . $food_image->getClientOriginalExtension();
            $path = $food_image->storeAs('food_images', $food_imageName, 'public');
            $food->food_image = $food_imageName;
        }
        $food->food_rating = $request->food_rating;
        $food->save();

        return redirect()->route('admin.showFood');
    }

    public function editFood($id)
    {
        $food = Food::find($id);
        $Shop = Shop::all();
        return view('AdminPage.Food.editFood', compact(
            'food',
            'Shop'
        ));
    }

    public function updateFood(Request $request, $id)
    {
        $request->validate([
            'food_name' => 'required',
            'food_price' => 'required',
            'food_description' => 'required|min:5|max:255',
            'food_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);
        $food = Food::find($id);
        $food->food_name = $request->food_name;
        $food->food_price = $request->food_price;
        $food->food_description = $request->food_description;
        if ($request->hasFile('food_image')) {
            $food_image = $request->file('food_image');
            $food_imageName = time() . '.' . $food_image->getClientOriginalExtension();
            $path = $food_image->storeAs('food_images', $food_imageName, 'public');
            $food->food_image = $food_imageName;
        }
        $food->save();

        return redirect()->route('admin.showFood');
    }

    public function deleteFood($id)
    {
        $food = Food::find($id);
        $food->delete();
        return redirect()->route('admin.showFood');
    }

    public function searchFood(Request $request)
    {
        $keyword = $request->keyword;
        $foods = Food::where('shop_name', 'like', "%$keyword%")
            ->orWhere('food_name', 'like', "%$keyword%")
            ->orWhere('food_price', 'like', "%$keyword%")
            ->orWhere('food_rating', 'like', "%$keyword%")
            ->paginate(5);
        return view('AdminPage.Food.showFood', compact(
            'foods'
        ));
    }

    public function infoFood($id)
    {
        $food = Food::find($id);
        return view('AdminPage.Food.infoFood', compact(
            'food'
        ));
    }

    public function lockFood($id)
    {
        $food = Food::find($id);
        if ($food->food_status == 1) {
            $food->food_status = 0;
        } else {
            $food->food_status = 1;
        }
        $food->save();
        return redirect()->route('admin.showFood');
    }








    //////////////////////////////////////////////////////////////////UserPage//////////////////////////////////////////////////////////////////
   //////////////////////////////////////////////////////////////////Food List//////////////////////////////////////////////////////////////////
    public function index()
    {
        $foods = Cache::remember('foods_list', 600, function () {
            return DB::table('food AS f')
                ->selectRaw("
                f.id AS food_id, 
                f.food_name, 
                f.food_image,
                f.food_price AS old_price, 
                COALESCE(MAX(sal.discount_percent), 0) AS discount_percent,  
                COALESCE(MAX(sal.discount_amount), 0) AS discount_amount,
                f.food_price - COALESCE(MAX(sal.discount_amount), f.food_price * (COALESCE(MAX(sal.discount_percent), 0) / 100), 0) AS new_price,
                f.shop_id, 
                s.shop_name,
                f.food_sold_count,
                f.food_average_rating
            ")
                ->leftJoin('sale_foods AS sf', 'f.id', '=', 'sf.food_id')
                ->leftJoin('sales AS sal_f', function ($join) {
                    $join->on('sf.sale_id', '=', 'sal_f.id')
                        ->where('sal_f.is_active', '=', 1)
                        ->whereRaw('NOW() BETWEEN sal_f.start_time AND sal_f.end_time');
                })
                ->leftJoin('sale_shops AS ss', 'f.shop_id', '=', 'ss.shop_id')
                ->leftJoin('sales AS sal_s', function ($join) {
                    $join->on('ss.sale_id', '=', 'sal_s.id')
                        ->where('sal_s.is_active', '=', 1)
                        ->whereRaw('NOW() BETWEEN sal_s.start_time AND sal_s.end_time');
                })
                ->leftJoin('shops AS s', 'f.shop_id', '=', 's.id')
                ->leftJoin(DB::raw("
                (SELECT 
                    id, 
                    MAX(discount_percent) AS discount_percent,
                    MAX(discount_amount) AS discount_amount
                FROM sales
                WHERE is_active = 1 
                AND NOW() BETWEEN start_time AND end_time
                GROUP BY id) AS sal"), function ($join) {
                    $join->whereRaw('sal.id IN (sf.sale_id, ss.sale_id)');
                })
                ->groupBy('f.id', 'f.food_name', 'f.food_image', 'f.food_price', 'f.shop_id', 's.shop_name', 'f.food_sold_count', 'f.food_average_rating')
                ->orderByDesc(DB::raw("COALESCE(MAX(sal.discount_amount), f.food_price * (COALESCE(MAX(sal.discount_percent), 0) / 100), 0)")) // Sắp xếp theo giá trị giảm nhiều nhất
                ->limit(20)
                ->get();
        });

        Log::info($foods);

        return view('UserPage.Food.food-list', compact('foods'));
    }

    //////////////////////////////////////////////////////////////////End Food List//////////////////////////////////////////////////////////////////
    
    //////////////////////////////////////////////////////////////////Food Detail//////////////////////////////////////////////////////////////////
    public function foodDetail($id){
        $food = Food::find($id);
        // Kiểm tra nếu món ăn không tồn tại
        if (!$food) {
            return abort(404, 'Món ăn không tồn tại');
        }
        $foodImages = json_decode($food->food_image, true);
        // Trả về view với dữ liệu
        return view('UserPage.Food.food-detail', compact('food','foodImages'));
    }
    //////////////////////////////////////////////////////////////////End Food Detail//////////////////////////////////////////////////////////////////
}