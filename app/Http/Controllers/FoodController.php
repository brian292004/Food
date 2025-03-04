<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Food;
use App\Models\Shop;
use App\Models\Sale\ShopFood;
use App\Models\Sale\Sale;
use App\Models\Sale\SaleFood;
use App\Models\Sale\SaleShop;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class FoodController extends Controller
{
    public function food()
    {
        $foods = Food::with('saleFood.sale')->get();
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
            'food_average_rating' => 'required',
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
        $food->food_average_rating = $request->food_average_rating;
        $food->save();

        return redirect()->route('admin.showFood');
    }

    public function editFood($id)
    {
        $food = Food::find($id);
        $Shop = Shop::all();
        $sales = Sale::all();
        return view('AdminPage.Food.editFood', compact(
            'food',
            'Shop',
            'sales'
        ));
    }

    public function updateFood(Request $request, $id)
    {
        $request->validate([
            'food_name' => 'required',
            'food_price' => 'required',
            'food_description' => 'required|min:5|max:255',
            'food_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'sale_id' => 'required',
        ]);
        // dd($request->all());
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

        if ($request->sale_id) {
            SaleFood::create([
                'food_id' => $food->id,
                'sale_id' => $request->sale_id
            ]);
        } 
        else{
            SaleFood::where('food_id', $food->id)->delete();
        }

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
            ->orWhere('food_average_rating', 'like', "%$keyword%")
            ->paginate(5);
        return view('AdminPage.Food.showFood', compact(
            'foods'
        ));
    }

    public function infoFood($id)
    {
        $food = Food::with('saleFood.sale')->find($id);
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
    public function foodDetail($id)
    {
        $food = DB::table('food AS f')
            ->select(
                'f.id AS food_id',  // Đặt bí danh để tránh nhầm lẫn với shop_id
                'f.food_name',
                'f.food_description',
                'f.food_price',
                'f.food_image',
                'f.food_is_featured',
                'f.food_sold_count',
                'f.food_total_feedbacks',
                'f.food_average_rating',
                'f.created_at',
                'f.updated_at',
                's.id AS shop_id',  // Đặt bí danh cho id của shop
                's.shop_name',
                's.shop_address',
                's.shop_phone',
                's.shop_email',
                's.shop_logo',
                's.shop_status',
                's.shop_support_email',
                's.shop_support_messenger',
                's.shop_description',
                's.shop_rating',
                DB::raw('f.food_price AS old_price'),
                DB::raw('COALESCE(
            GREATEST(
                COALESCE(MAX(sal_f.discount_amount), f.food_price * (COALESCE(MAX(sal_f.discount_percent), 0) / 100), 0),
                COALESCE(MAX(sal_s.discount_amount), f.food_price * (COALESCE(MAX(sal_s.discount_percent), 0) / 100), 0)
            ), 0
        ) AS sale_value'),
                DB::raw('f.food_price - COALESCE(
            GREATEST(
                COALESCE(MAX(sal_f.discount_amount), f.food_price * (COALESCE(MAX(sal_f.discount_percent), 0) / 100), 0),
                COALESCE(MAX(sal_s.discount_amount), f.food_price * (COALESCE(MAX(sal_s.discount_percent), 0) / 100), 0)
            ), 0
        ) AS new_price')
            )
            ->leftJoin('shops AS s', 'f.shop_id', '=', 's.id')
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
            ->where('f.id', $id)
            ->groupBy('f.id', 's.id')
            ->first();

        // Kiểm tra nếu món ăn không tồn tại
        if (!$food) {
            return abort(404, 'Món ăn không tồn tại');
        }
        // Lấy danh sách ảnh phụ từ bảng food_images
        $foodImages = DB::table('food_images')
            ->where('food_id', $id)
            ->pluck('image_url')
            ->toArray();
        array_unshift($foodImages, $food->food_image);
        $user = Auth::user();
        Log::info($user);
        return view('UserPage.Food.food-detail', compact('food', 'foodImages','user'));
    }
    //////////////////////////////////////////////////////////////////End Food Detail//////////////////////////////////////////////////////////////////
}