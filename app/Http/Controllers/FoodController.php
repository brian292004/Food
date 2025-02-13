<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Food;
use App\Models\Shop;

class FoodController extends Controller
{
    public function food(){
        $foods = Food::paginate(3);
        return view('AdminPage.Food.showFood',compact(
            'foods'
        ));
    }

    public function addFood(){
        $Shop = Shop::all();
        return view('AdminPage.Food.addFood',compact(
            'Shop'
        ));
    }

    public function storeFood(Request $request){
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
            $food_imageName = time().'.'.$food_image->getClientOriginalExtension();
            $path = $food_image->storeAs('food_images', $food_imageName, 'public');
            $food->food_image = $food_imageName;
        }
        $food->food_rating = $request->food_rating;
        $food->save();

        return redirect()->route('admin.showFood');
    }

    public function editFood($id){
        $food = Food::find($id);
        $Shop = Shop::all();
        return view('AdminPage.Food.editFood',compact(
            'food',
            'Shop'
        ));
    }

    public function updateFood(Request $request, $id){
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
            $food_imageName = time().'.'.$food_image->getClientOriginalExtension();
            $path = $food_image->storeAs('food_images', $food_imageName, 'public');
            $food->food_image = $food_imageName;
        }
        $food->save();

        return redirect()->route('admin.showFood');
    }

    public function deleteFood($id){
        $food = Food::find($id);
        $food->delete();
        return redirect()->route('admin.showFood');
    }

    public function searchFood(Request $request){
        $keyword = $request->keyword;
        $foods = Food::where('shop_name','like', "%$keyword%")
                ->orWhere('food_name', 'like', "%$keyword%")
                ->orWhere('food_price', 'like', "%$keyword%")
                ->orWhere('food_rating', 'like', "%$keyword%")
                ->paginate(5);
        return view('AdminPage.Food.showFood',compact(
            'foods'
        ));
    }

    public function infoFood($id){
        $food = Food::find($id);
        return view('AdminPage.Food.infoFood',compact(
            'food'
        ));
    }

    public function lockFood($id){
        $food = Food::find($id);
        if($food->food_status == 1){
            $food->food_status = 0;
        }else{
            $food->food_status = 1;
        }
        $food->save();
        return redirect()->route('admin.showFood');
    }
    
}
