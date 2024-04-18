<?php

use App\Http\Controllers\front\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/', [IndexController::class, 'index'])->name('front.home');
Route::get('/about-us', [IndexController::class, 'aboutUs'])->name('front.about-us');
Route::get('/our-products', [IndexController::class, 'ourProducts'])->name('products');
Route::get('/products/{id}', [IndexController::class, 'show'])->name('products.show');


//admin routes --------------------->
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin-products', [AdminController::class, 'productsAdmin']);
Route::get('delete-product/{id}', [AdminController::class, 'deleteProduct'])->name('delete.product');
Route::post('/addnew-product', [AdminController::class, 'addnewProduct']);
Route::post('/update-product', [AdminController::class, 'updateProduct']);

// admin login ---------------------->
// Route::get('/login', 'AuthController@showLoginForm')->name('login');
// Route::post('/login', 'AuthController@login')->name('login.submit');
// Route::middleware('auth.admin')->group(function () {
//     Route::get('/admin', 'AdminController@index')->name('admin.dashboard');
// });
