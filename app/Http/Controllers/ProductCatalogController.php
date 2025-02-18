<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductCatalogController extends Controller
{
    public function index()
    {
        return view('UserPage.Product catalog.product-catalog');
    }
}
