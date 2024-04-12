<?php

use App\Http\Controllers\front\IndexController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


Route::get('/', [IndexController::class, 'index'])->name('front.home');
Route::get('/about-us', [IndexController::class, 'aboutUs'])->name('front.about-us');
Route::get('/our-products', [IndexController::class, 'ourProducts'])->name('products');
Route::get('/single-product', [IndexController::class, 'singleProductt'])->name('singleProduct');



//admin routes --------------------->
Route::get('/admin/login', [IndexController::class, 'adminlogin'])->name('adminlogin');
Route::get('/admin', [AdminController::class, 'index']);
