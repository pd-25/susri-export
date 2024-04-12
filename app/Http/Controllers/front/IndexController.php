<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        return view('front.index');
    }

    public function aboutUs() {
        return view('front.aboutus');
    }
    public function ourProducts() {
        return view('products.products');
    }
    public function singleProductt() {
        return view('products.singleProduct');
    }
    public function adminlogin() {
        return view('admin.adminlogin');
    }
    public function adminPanel() {
        return view('admin.adminpanel');
    }
    
}
