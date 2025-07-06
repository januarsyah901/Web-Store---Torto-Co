<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::orderBY('created_at', 'desc')
            ->paginate(12);
        return view('shop', compact('products'));
     }
}
