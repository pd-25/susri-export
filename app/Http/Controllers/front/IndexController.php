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
        return view('front.index', compact('products'));
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

    // public function show($slug)
    // {
    //     $products = Product::all();
    //     $product = Product::findOrFail($slug); // Changed $products to $product for singular item
    //     return view('products.singleProductt', compact('product','products')); // The view path should match
    // }

    public function show($slug)
    {
        // Retrieve the product with the given slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // You may want to pass all products for related products or similar functionality
        $products = Product::all();

        // Return the view with the product details
        return view('products.singleProductt', compact('product', 'products'));
    }


    public function adminlogin()
    {
        return view('admin.logAdmin');
    }
}
