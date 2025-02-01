<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function adminShop(){
        return view('AdminPage.Shop.index');
    }
}
