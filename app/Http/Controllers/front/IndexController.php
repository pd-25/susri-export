<?php

namespace App\Http\Controllers\front;

use App\Models\Product;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function aboutUs()
    {
        return view('front.aboutus');
    }

    public function ourProducts()
    {
        $products = Product::all();
        return view('products.products', compact('products'));
        return view('products.products');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id); // Changed $products to $product for singular item
        return view('products.singleProductt', compact('product')); // The view path should match
    }
}
