<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Shop;
use App\Models\Sale\ShopFood;
use App\Models\Sale\Sale;
use App\Models\Sale\SaleFood;
use App\Models\Sale\SaleShop;

class ProductCatalogController extends Controller
{
    public function index()
    {   
        $foods = Food::with('saleFood.sale')->get();
        $Shop = Shop::all();
        $sales = Sale::all();
        return view('UserPage.Product catalog.product-catalog',compact(
            'foods',
            'Shop',
            'sales'
        ));
    }
}