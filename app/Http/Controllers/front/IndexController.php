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
        $products = Product::all();
        return view('front.index',compact('products'));
    }

    public function aboutUs()
    {
        return view('front.aboutus');
    }

    public function contactUs()
    {
        return view('front.contactus');
    }

    public function ourProducts()
    {
        $products = Product::all();
        return view('products.products', compact('products'));
        // return view('products.products');
    }

    public function show($id)
    {
        $products = Product::all();
        $product = Product::findOrFail($id); // Changed $products to $product for singular item
        return view('products.singleProductt', compact('product','products')); // The view path should match
    }
}
